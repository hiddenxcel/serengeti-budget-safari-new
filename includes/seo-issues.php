<?php
declare(strict_types=1);

/**
 * Turns per-page facts + crawl metadata into a flat list of issue rows
 * shaped for direct insertion into seo_issues. This is the single place
 * that decides severity levels — seo-scoring.php only computes numbers,
 * this file explains what's wrong in human terms.
 *
 * Each returned issue: category, severity, issue_code, message, and
 * optionally page_url (resolved to page_id by the caller, which has DB
 * access), source_url/target_url/anchor_text for link-shaped issues.
 */

/**
 * @param array<int,array> $pages seo_pages-shaped rows + 'facts'
 * @param array{robots_present:bool, sitemap_present:bool, orphans:array<int,string>, broken_links: array<int,array{source_url:string,target_url:string,status:int,anchor_text:string}>} $crawlMeta
 * @param array<int,array{a:string,b:string,similarity:float}> $nearDuplicates
 * @return array<int,array>
 */
function seo_build_issues(array $pages, array $crawlMeta, array $nearDuplicates): array
{
    $issues = [];

    seo_issues_sitewide($issues, $crawlMeta, $pages);
    seo_issues_broken_links($issues, $crawlMeta);
    seo_issues_orphans($issues, $crawlMeta);
    seo_issues_near_duplicates($issues, $nearDuplicates);

    foreach ($pages as $page) {
        seo_issues_per_page($issues, $page);
    }

    return $issues;
}

function seo_issues_sitewide(array &$issues, array $crawlMeta, array $pages): void
{
    if (empty($crawlMeta['robots_present'])) {
        $issues[] = [
            'category' => 'indexability', 'severity' => 'warning', 'issue_code' => 'robots_txt_missing',
            'message' => 'robots.txt is not accessible at the configured website root.',
            'page_url' => null,
        ];
    }

    if (empty($crawlMeta['sitemap_present'])) {
        $issues[] = [
            'category' => 'indexability', 'severity' => 'warning', 'issue_code' => 'sitemap_xml_missing',
            'message' => 'sitemap.xml is not accessible at the configured website root.',
            'page_url' => null,
        ];
    }

    $ogImages = [];
    $schemaTypeSets = [];
    foreach ($pages as $page) {
        $ogImage = $page['facts']['og']['og:image'] ?? null;
        if ($ogImage) {
            $ogImages[$ogImage] = true;
        }
        $types = $page['facts']['schema_types'] ?? [];
        foreach ($types as $t) {
            $schemaTypeSets[$t] = true;
        }
    }

    if (count($ogImages) === 1 && count($pages) > 1) {
        $issues[] = [
            'category' => 'onpage', 'severity' => 'info', 'issue_code' => 'og_image_duplicated_sitewide',
            'message' => 'The same og:image is used on every crawled page — social share previews will look identical regardless of which page is shared.',
            'page_url' => null,
        ];
    }

    if (count($schemaTypeSets) <= 1 && !empty($pages)) {
        $issues[] = [
            'category' => 'structured_data', 'severity' => 'info', 'issue_code' => 'no_page_specific_schema',
            'message' => 'Only one structured-data type (' . implode(', ', array_keys($schemaTypeSets)) . ') is emitted, identical on every page. Page-specific schema (e.g. TouristTrip, FAQPage, BreadcrumbList) is missing.',
            'page_url' => null,
        ];
    }
}

function seo_issues_broken_links(array &$issues, array $crawlMeta): void
{
    foreach ($crawlMeta['broken_links'] ?? [] as $broken) {
        $issues[] = [
            'category' => 'links', 'severity' => 'critical', 'issue_code' => 'broken_link',
            'message' => sprintf('Link to %s returns HTTP %d.', $broken['target_url'], $broken['status']),
            'page_url' => $broken['source_url'],
            'source_url' => $broken['source_url'],
            'target_url' => $broken['target_url'],
            'anchor_text' => $broken['anchor_text'],
        ];
    }
}

function seo_issues_orphans(array &$issues, array $crawlMeta): void
{
    foreach ($crawlMeta['orphans'] ?? [] as $url) {
        $issues[] = [
            'category' => 'links', 'severity' => 'warning', 'issue_code' => 'orphan_page',
            'message' => 'No other crawled page links to this URL.',
            'page_url' => $url,
        ];
    }
}

function seo_issues_near_duplicates(array &$issues, array $nearDuplicates): void
{
    foreach ($nearDuplicates as $dup) {
        $pct = (int) round($dup['similarity'] * 100);
        $issues[] = [
            'category' => 'content', 'severity' => 'warning', 'issue_code' => 'near_duplicate_content',
            'message' => sprintf('%d%% similar content to %s.', $pct, $dup['b']),
            'page_url' => $dup['a'],
        ];
        $issues[] = [
            'category' => 'content', 'severity' => 'warning', 'issue_code' => 'near_duplicate_content',
            'message' => sprintf('%d%% similar content to %s.', $pct, $dup['a']),
            'page_url' => $dup['b'],
        ];
    }
}

function seo_issues_per_page(array &$issues, array $page): void
{
    $facts = $page['facts'];
    $url = $page['url'];

    if (($page['http_status'] ?? 0) >= 400) {
        return; // broken pages already covered by seo_issues_broken_links from the link that pointed here
    }

    if (empty($facts['title'])) {
        $issues[] = ['category' => 'onpage', 'severity' => 'critical', 'issue_code' => 'missing_title', 'message' => 'Page has no <title> tag.', 'page_url' => $url];
    } elseif ($facts['title_length'] < 30 || $facts['title_length'] > 60) {
        $issues[] = ['category' => 'onpage', 'severity' => 'info', 'issue_code' => 'title_length', 'message' => sprintf('Title is %d characters (recommended: 30-60).', $facts['title_length']), 'page_url' => $url];
    }

    if (empty($facts['meta_description'])) {
        $issues[] = ['category' => 'onpage', 'severity' => 'warning', 'issue_code' => 'missing_meta_description', 'message' => 'Page has no meta description.', 'page_url' => $url];
    } elseif ($facts['meta_description_length'] < 70 || $facts['meta_description_length'] > 160) {
        $issues[] = ['category' => 'onpage', 'severity' => 'info', 'issue_code' => 'meta_description_length', 'message' => sprintf('Meta description is %d characters (recommended: 70-160).', $facts['meta_description_length']), 'page_url' => $url];
    }

    if (($facts['h1_count'] ?? 0) === 0) {
        $issues[] = ['category' => 'onpage', 'severity' => 'warning', 'issue_code' => 'missing_h1', 'message' => 'Page has no H1 heading.', 'page_url' => $url];
    } elseif ($facts['h1_count'] > 1) {
        $issues[] = ['category' => 'onpage', 'severity' => 'info', 'issue_code' => 'multiple_h1', 'message' => sprintf('Page has %d H1 headings (recommended: exactly 1).', $facts['h1_count']), 'page_url' => $url];
    }

    if (!empty($facts['is_noindex'])) {
        $issues[] = ['category' => 'indexability', 'severity' => 'critical', 'issue_code' => 'unexpected_noindex', 'message' => 'Page is marked noindex.', 'page_url' => $url];
    }

    $canonical = $facts['canonical_url'] ?? null;
    if ($canonical === null) {
        $issues[] = ['category' => 'indexability', 'severity' => 'info', 'issue_code' => 'missing_canonical', 'message' => 'Page has no canonical tag.', 'page_url' => $url];
    } elseif (rtrim($canonical, '/') !== rtrim($url, '/')) {
        $issues[] = ['category' => 'indexability', 'severity' => 'warning', 'issue_code' => 'canonical_mismatch', 'message' => sprintf('Canonical points to %s, not this page\'s own URL.', $canonical), 'page_url' => $url];
    }

    if (isset($page['hreflang_ok']) && $page['hreflang_ok'] === false) {
        $issues[] = ['category' => 'international', 'severity' => 'warning', 'issue_code' => 'hreflang_reciprocity_failed', 'message' => 'This page\'s hreflang tags do not reciprocally link with its language alternates.', 'page_url' => $url];
    }

    $wordCount = $facts['word_count'] ?? 0;
    $linkCount = $facts['internal_link_count'] ?? 0;
    $isLinkHeavy = $linkCount > 0 && $wordCount > 0 && ($linkCount / max($wordCount, 1)) > 0.15;
    if ($wordCount < SEO_SCORE_THIN_CONTENT_WORDS && !$isLinkHeavy) {
        $issues[] = ['category' => 'content', 'severity' => 'info', 'issue_code' => 'thin_content', 'message' => sprintf('Only %d words of content.', $wordCount), 'page_url' => $url];
    }

    if (($facts['images_missing_alt'] ?? 0) > 0) {
        $issues[] = ['category' => 'images', 'severity' => 'warning', 'issue_code' => 'images_missing_alt', 'message' => sprintf('%d of %d images have no alt text.', $facts['images_missing_alt'], $facts['image_count']), 'page_url' => $url];
    }

    if (empty($facts['schema_valid'])) {
        $issues[] = ['category' => 'structured_data', 'severity' => 'warning', 'issue_code' => 'invalid_structured_data', 'message' => 'A structured-data (JSON-LD) block on this page is not valid JSON or is missing @context/@type.', 'page_url' => $url];
    }
}

/**
 * Groups a flat issue list by issue_code for the Recommendations view,
 * ranked by severity then affected-page count.
 *
 * @return array<int,array{issue_code:string, category:string, severity:string, message_sample:string, affected_count:int}>
 */
function seo_issues_group_for_recommendations(array $issues): array
{
    $severityRank = ['critical' => 0, 'warning' => 1, 'info' => 2];
    $groups = [];

    foreach ($issues as $issue) {
        $code = $issue['issue_code'];
        if (!isset($groups[$code])) {
            $groups[$code] = [
                'issue_code' => $code,
                'category' => $issue['category'],
                'severity' => $issue['severity'],
                'message_sample' => $issue['message'],
                'affected_count' => 0,
            ];
        }
        $groups[$code]['affected_count']++;
    }

    $result = array_values($groups);
    usort($result, static function ($a, $b) use ($severityRank) {
        $rankDiff = $severityRank[$a['severity']] <=> $severityRank[$b['severity']];
        if ($rankDiff !== 0) {
            return $rankDiff;
        }
        return $b['affected_count'] <=> $a['affected_count'];
    });

    return $result;
}
