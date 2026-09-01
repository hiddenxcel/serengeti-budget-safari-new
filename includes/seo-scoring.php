<?php
declare(strict_types=1);

/**
 * Turns per-page facts (from includes/seo-analyzer.php) plus crawl-level
 * metadata into 8 category scores (0-100 each) and one weighted overall
 * score. Every deduction here traces to a real check against real fetched
 * data — nothing is fabricated. Pure functions: no DB access.
 */

const SEO_SCORE_WEIGHTS = [
    'technical' => 20,
    'onpage' => 20,
    'content' => 15,
    'indexability' => 15,
    'links' => 10,
    'images' => 10,
    'structured_data' => 5,
    'performance' => 5,
];

const SEO_SCORE_THIN_CONTENT_WORDS = 150;
const SEO_SCORE_SLOW_RESPONSE_MS = 3000;
const SEO_SCORE_DUPLICATE_THRESHOLD = 0.85;

/**
 * @param array<int,array> $pages each element is a seo_pages-row-shaped array plus 'facts' (the full analyzer output)
 * @param array{robots_present:bool, sitemap_present:bool, orphans:array<int,string>} $crawlMeta
 * @param ?array{score:int} $pagespeedResult null if not configured/failed
 * @return array{scores: array<string,?int>, overall: int, performance_scored: bool, near_duplicates: array<int,array{a:string,b:string,similarity:float}>}
 */
function seo_score_audit(array $pages, array $crawlMeta, ?array $pagespeedResult): array
{
    $nearDuplicates = seo_score_find_near_duplicates($pages);

    $scores = [
        'technical' => seo_score_technical($pages),
        'onpage' => seo_score_onpage($pages),
        'content' => seo_score_content($pages, $nearDuplicates),
        'indexability' => seo_score_indexability($pages, $crawlMeta),
        'links' => seo_score_links($pages, $crawlMeta),
        'images' => seo_score_images($pages),
        'structured_data' => seo_score_structured_data($pages),
        'performance' => $pagespeedResult['score'] ?? null,
    ];

    $performanceScored = $pagespeedResult !== null;

    $weightSum = 0;
    $weightedTotal = 0.0;
    foreach ($scores as $category => $score) {
        if ($score === null) {
            continue;
        }
        $weight = SEO_SCORE_WEIGHTS[$category];
        $weightSum += $weight;
        $weightedTotal += ($score / 100) * $weight;
    }

    $overall = $weightSum > 0 ? (int) round(($weightedTotal / $weightSum) * 100) : 0;

    return [
        'scores' => $scores,
        'overall' => $overall,
        'performance_scored' => $performanceScored,
        'near_duplicates' => $nearDuplicates,
    ];
}

function seo_score_technical(array $pages): int
{
    if (empty($pages)) {
        return 100;
    }

    $score = 100.0;
    $total = count($pages);
    $brokenCount = 0;
    $redirectChainCount = 0;
    $slowCount = 0;

    foreach ($pages as $page) {
        $status = $page['http_status'] ?? null;
        if ($status !== null && $status >= 400) {
            $brokenCount++;
        }
        if (!empty($page['redirect_chain']) && count($page['redirect_chain']) > 1) {
            $redirectChainCount++;
        }
        if (($page['response_time_ms'] ?? 0) > SEO_SCORE_SLOW_RESPONSE_MS) {
            $slowCount++;
        }
    }

    $score -= ($brokenCount / $total) * 100 * 0.6;
    $score -= ($redirectChainCount / $total) * 100 * 0.2;
    $score -= ($slowCount / $total) * 100 * 0.2;

    return (int) max(0, round($score));
}

function seo_score_onpage(array $pages): int
{
    $indexable = array_filter($pages, static fn($p) => empty($p['facts']['is_noindex']) && ($p['http_status'] ?? 0) === 200);
    if (empty($indexable)) {
        return 100;
    }

    $totalRatio = 0.0;
    foreach ($indexable as $page) {
        $facts = $page['facts'];
        $checks = 0;
        $passed = 0;

        $checks++;
        $titleLen = $facts['title_length'] ?? 0;
        if ($titleLen >= 30 && $titleLen <= 60) {
            $passed++;
        }

        $checks++;
        $descLen = $facts['meta_description_length'] ?? 0;
        if ($descLen >= 70 && $descLen <= 160) {
            $passed++;
        }

        $checks++;
        if (($facts['h1_count'] ?? 0) === 1) {
            $passed++;
        }

        $totalRatio += $passed / $checks;
    }

    return (int) round(($totalRatio / count($indexable)) * 100);
}

function seo_score_content(array $pages, array $nearDuplicates): int
{
    $indexable = array_filter($pages, static fn($p) => empty($p['facts']['is_noindex']) && ($p['http_status'] ?? 0) === 200);
    if (empty($indexable)) {
        return 100;
    }

    $score = 100.0;
    $total = count($indexable);
    $thinCount = 0;

    foreach ($indexable as $page) {
        $facts = $page['facts'];
        $wordCount = $facts['word_count'] ?? 0;
        $linkCount = $facts['internal_link_count'] ?? 0;

        // Listing/index pages are legitimately link-heavy and text-light —
        // don't penalize them for being "thin" when links dominate content.
        $isLinkHeavyListing = $linkCount > 0 && $wordCount > 0 && ($linkCount / max($wordCount, 1)) > 0.15;

        if ($wordCount < SEO_SCORE_THIN_CONTENT_WORDS && !$isLinkHeavyListing) {
            $thinCount++;
        }
    }

    $score -= ($thinCount / $total) * 100 * 0.6;

    $duplicatePenalty = min(40, count($nearDuplicates) * 8);
    $score -= $duplicatePenalty;

    return (int) max(0, round($score));
}

/**
 * @return array<int,array{a:string,b:string,similarity:float}>
 */
function seo_score_find_near_duplicates(array $pages): array
{
    $byLang = ['en' => [], 'it' => []];
    foreach ($pages as $page) {
        $lang = $page['facts']['lang'] ?? null;
        if (isset($byLang[$lang]) && !empty($page['facts']['content_word_set'])) {
            $byLang[$lang][] = $page;
        }
    }

    $duplicates = [];
    foreach ($byLang as $group) {
        $count = count($group);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $similarity = seo_analyze_jaccard_similarity(
                    $group[$i]['facts']['content_word_set'],
                    $group[$j]['facts']['content_word_set']
                );
                if ($similarity >= SEO_SCORE_DUPLICATE_THRESHOLD) {
                    $duplicates[] = [
                        'a' => $group[$i]['url'],
                        'b' => $group[$j]['url'],
                        'similarity' => $similarity,
                    ];
                }
            }
        }
    }

    return $duplicates;
}

function seo_score_indexability(array $pages, array $crawlMeta): int
{
    $score = 100.0;

    if (empty($crawlMeta['robots_present'])) {
        $score -= 10;
    }
    if (empty($crawlMeta['sitemap_present'])) {
        $score -= 10;
    }

    $total = count($pages) ?: 1;
    $unexpectedNoindex = 0;
    $mismatchedCanonical = 0;
    $hreflangFailures = 0;

    foreach ($pages as $page) {
        $facts = $page['facts'];
        if (!empty($facts['is_noindex'])) {
            $unexpectedNoindex++;
        }
        $canonical = $facts['canonical_url'] ?? null;
        if ($canonical !== null && rtrim($canonical, '/') !== rtrim($page['url'], '/')) {
            $mismatchedCanonical++;
        }
        if (isset($page['hreflang_ok']) && $page['hreflang_ok'] === false) {
            $hreflangFailures++;
        }
    }

    $score -= ($unexpectedNoindex / $total) * 100 * 0.3;
    $score -= ($mismatchedCanonical / $total) * 100 * 0.2;
    $score -= ($hreflangFailures / $total) * 100 * 0.3;

    return (int) max(0, round($score));
}

function seo_score_links(array $pages, array $crawlMeta): int
{
    $total = count($pages) ?: 1;
    $score = 100.0;

    $orphanCount = count($crawlMeta['orphans'] ?? []);
    $brokenCount = count(array_filter($pages, static fn($p) => ($p['http_status'] ?? 0) >= 400));

    $score -= ($orphanCount / $total) * 100 * 0.5;
    $score -= ($brokenCount / $total) * 100 * 0.5;

    return (int) max(0, round($score));
}

function seo_score_images(array $pages): int
{
    $totalImages = 0;
    $missingAlt = 0;
    $missingDims = 0;
    $notLazy = 0;

    foreach ($pages as $page) {
        foreach ($page['facts']['images'] ?? [] as $image) {
            $totalImages++;
            if (!$image['has_alt']) {
                $missingAlt++;
            }
            if (!$image['has_width'] || !$image['has_height']) {
                $missingDims++;
            }
            if (!$image['is_lazy']) {
                $notLazy++;
            }
        }
    }

    if ($totalImages === 0) {
        return 100;
    }

    $altScore = (($totalImages - $missingAlt) / $totalImages) * 100;
    $dimsScore = (($totalImages - $missingDims) / $totalImages) * 100;
    $lazyScore = (($totalImages - $notLazy) / $totalImages) * 100;

    // Alt text weighted heaviest (accessibility/SEO-critical); dims/lazy are minor.
    $combined = ($altScore * 0.7) + ($dimsScore * 0.2) + ($lazyScore * 0.1);

    return (int) round($combined);
}

function seo_score_structured_data(array $pages): int
{
    $withSchema = 0;
    $allTypes = [];

    foreach ($pages as $page) {
        $types = $page['facts']['schema_types'] ?? [];
        if (!empty($types)) {
            $withSchema++;
            foreach ($types as $t) {
                $allTypes[$t] = true;
            }
        }
    }

    $total = count($pages) ?: 1;

    if ($withSchema === 0) {
        return 0;
    }

    $score = 100.0;
    if ($withSchema < $total) {
        $score -= (($total - $withSchema) / $total) * 100 * 0.3;
    }

    // Only one schema type site-wide (e.g. TravelAgency on every page, never
    // page-specific like TouristTrip/FAQPage/Product) is a real, significant
    // gap — this is the deliberate, expected low score on this real site
    // until per-page schema is added, not a scorer bug.
    if (count($allTypes) <= 1) {
        $score -= 50;
    }

    return (int) max(0, round($score));
}
