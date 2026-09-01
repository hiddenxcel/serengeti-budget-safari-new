<?php
declare(strict_types=1);

/**
 * Turns one page's raw HTML into a structured "facts" array via
 * DOMDocument/DOMXPath. Pure function — no DB access, no curl. All scoring
 * and issue-generation logic reads from this array; nothing here decides
 * what's "good" or "bad", only what IS.
 */

const SEO_ANALYZER_STOPWORDS = [
    'the', 'a', 'an', 'and', 'of', 'in', 'to', 'with', 'for', 'is', 'this',
    'our', 'you', 'your', 'on', 'at', 'by', 'from', 'it', 'we', 'be', 'are',
];

/**
 * @param array<string,string> $headers response headers from the fetch (lowercased keys)
 * @return array structured facts for this page
 */
function seo_analyze_page(string $url, string $html, ?int $httpStatus, array $headers, int $responseTimeMs): array
{
    $facts = [
        'url' => $url,
        'lang' => seo_analyze_detect_lang($url),
        'http_status' => $httpStatus,
        'response_time_ms' => $responseTimeMs,
        'content_bytes' => strlen($html),
        'title' => null,
        'title_length' => 0,
        'meta_description' => null,
        'meta_description_length' => 0,
        'canonical_url' => null,
        'robots_meta' => [],
        'is_noindex' => false,
        'x_robots_tag' => $headers['x-robots-tag'] ?? null,
        'headings' => [],
        'h1_count' => 0,
        'word_count' => 0,
        'content_hash' => null,
        'content_word_set' => [],
        'hreflang' => [],
        'og' => [],
        'twitter' => [],
        'schema_types' => [],
        'schema_valid' => true,
        'images' => [],
        'image_count' => 0,
        'images_missing_alt' => 0,
        'internal_links' => [],
        'internal_link_count' => 0,
        'external_link_count' => 0,
        'has_faq_content' => false,
    ];

    if ($httpStatus === null || $httpStatus < 200 || $httpStatus >= 300 || trim($html) === '') {
        return $facts;
    }

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    seo_analyze_title($xpath, $facts);
    seo_analyze_meta_description($xpath, $facts);
    seo_analyze_canonical($xpath, $facts, $url);
    seo_analyze_robots_meta($xpath, $facts);
    seo_analyze_headings($xpath, $facts);
    seo_analyze_hreflang($xpath, $facts);
    seo_analyze_open_graph($xpath, $facts);
    seo_analyze_structured_data($xpath, $facts);
    seo_analyze_images($xpath, $facts);
    seo_analyze_content($xpath, $facts);

    return $facts;
}

function seo_analyze_detect_lang(string $url): ?string
{
    $path = (string) parse_url($url, PHP_URL_PATH);
    if (preg_match('#^/en(/|$)#', $path)) {
        return 'en';
    }
    if (preg_match('#^/it(/|$)#', $path)) {
        return 'it';
    }
    return null;
}

function seo_analyze_title(DOMXPath $xpath, array &$facts): void
{
    $node = $xpath->query('//title')->item(0);
    if ($node) {
        $title = trim($node->textContent);
        $facts['title'] = $title !== '' ? $title : null;
        $facts['title_length'] = mb_strlen($title);
    }
}

function seo_analyze_meta_description(DOMXPath $xpath, array &$facts): void
{
    $node = $xpath->query('//meta[translate(@name, "DESCRIPTION", "description")="description"]/@content')->item(0);
    if ($node) {
        $desc = trim($node->nodeValue);
        $facts['meta_description'] = $desc !== '' ? $desc : null;
        $facts['meta_description_length'] = mb_strlen($desc);
    }
}

function seo_analyze_canonical(DOMXPath $xpath, array &$facts, string $url): void
{
    $node = $xpath->query('//link[translate(@rel, "CANONICAL", "canonical")="canonical"]/@href')->item(0);
    if ($node) {
        $facts['canonical_url'] = trim($node->nodeValue) ?: null;
    }
}

function seo_analyze_robots_meta(DOMXPath $xpath, array &$facts): void
{
    $node = $xpath->query('//meta[translate(@name, "ROBOTS", "robots")="robots"]/@content')->item(0);
    if ($node) {
        $tokens = array_map('trim', explode(',', strtolower($node->nodeValue)));
        $facts['robots_meta'] = $tokens;
        $facts['is_noindex'] = in_array('noindex', $tokens, true);
    }

    if (!$facts['is_noindex'] && $facts['x_robots_tag'] !== null) {
        $facts['is_noindex'] = str_contains(strtolower($facts['x_robots_tag']), 'noindex');
    }
}

function seo_analyze_headings(DOMXPath $xpath, array &$facts): void
{
    $headings = [];
    foreach (range(1, 6) as $level) {
        foreach ($xpath->query("//h{$level}") as $node) {
            $text = trim($node->textContent);
            $headings[] = ['level' => $level, 'text' => $text];
            if ($level === 1) {
                $facts['h1_count']++;
            }
            if ($text !== '' && preg_match('/faq|frequently asked/i', $text)) {
                $facts['has_faq_content'] = true;
            }
        }
    }
    $facts['headings'] = $headings;
}

function seo_analyze_hreflang(DOMXPath $xpath, array &$facts): void
{
    $set = [];
    foreach ($xpath->query('//link[translate(@rel,"ALTERNATE","alternate")="alternate"][@hreflang]') as $node) {
        $lang = strtolower(trim($node->getAttribute('hreflang')));
        $href = trim($node->getAttribute('href'));
        if ($lang !== '' && $href !== '') {
            $set[$lang] = $href;
        }
    }
    $facts['hreflang'] = $set;
}

function seo_analyze_open_graph(DOMXPath $xpath, array &$facts): void
{
    $ogKeys = ['og:title', 'og:description', 'og:type', 'og:url', 'og:image'];
    foreach ($ogKeys as $key) {
        $node = $xpath->query('//meta[@property="' . $key . '"]/@content')->item(0);
        $facts['og'][$key] = $node ? trim($node->nodeValue) : null;
    }

    $twitterKeys = ['twitter:card', 'twitter:title', 'twitter:description', 'twitter:image'];
    foreach ($twitterKeys as $key) {
        $node = $xpath->query('//meta[@name="' . $key . '"]/@content')->item(0);
        $facts['twitter'][$key] = $node ? trim($node->nodeValue) : null;
    }
}

function seo_analyze_structured_data(DOMXPath $xpath, array &$facts): void
{
    $types = [];
    $allValid = true;

    foreach ($xpath->query('//script[@type="application/ld+json"]') as $node) {
        $decoded = json_decode(trim($node->textContent), true);
        if (!is_array($decoded) || !isset($decoded['@context']) || !isset($decoded['@type'])) {
            $allValid = false;
            continue;
        }
        $typeValue = $decoded['@type'];
        if (is_array($typeValue)) {
            foreach ($typeValue as $t) {
                $types[] = (string) $t;
            }
        } else {
            $types[] = (string) $typeValue;
        }
    }

    $facts['schema_types'] = array_values(array_unique($types));
    $facts['schema_valid'] = $allValid;
}

function seo_analyze_images(DOMXPath $xpath, array &$facts): void
{
    $images = [];
    $missingAlt = 0;

    foreach ($xpath->query('//img') as $node) {
        $alt = $node->hasAttribute('alt') ? trim($node->getAttribute('alt')) : '';
        $hasAlt = $alt !== '';
        if (!$hasAlt) {
            $missingAlt++;
        }
        $images[] = [
            'src' => $node->getAttribute('src'),
            'alt' => $alt,
            'has_alt' => $hasAlt,
            'has_width' => $node->hasAttribute('width'),
            'has_height' => $node->hasAttribute('height'),
            'is_lazy' => strtolower($node->getAttribute('loading')) === 'lazy',
        ];
    }

    $facts['images'] = $images;
    $facts['image_count'] = count($images);
    $facts['images_missing_alt'] = $missingAlt;
}

function seo_analyze_content(DOMXPath $xpath, array &$facts): void
{
    $textNodes = $xpath->query('//body//text()[not(ancestor::script) and not(ancestor::style) and not(ancestor::noscript)]');
    $text = '';
    foreach ($textNodes as $node) {
        $text .= ' ' . $node->textContent;
    }

    $text = trim(preg_replace('/\s+/', ' ', $text) ?? '');
    $facts['word_count'] = $text === '' ? 0 : str_word_count($text);

    $normalized = strtolower(preg_replace('/[^a-z0-9\s]/i', ' ', $text) ?? '');
    $words = array_filter(
        preg_split('/\s+/', trim($normalized)) ?: [],
        static fn(string $w): bool => $w !== '' && !in_array($w, SEO_ANALYZER_STOPWORDS, true) && strlen($w) > 2
    );

    $wordSet = array_values(array_unique($words));
    sort($wordSet);
    $facts['content_word_set'] = $wordSet;
    $facts['content_hash'] = sha1(implode(' ', $wordSet));
}

/**
 * Jaccard similarity of two pages' content word sets — used for the
 * near-duplicate content pass in seo-scoring.php. |A∩B| / |A∪B|.
 */
function seo_analyze_jaccard_similarity(array $wordSetA, array $wordSetB): float
{
    if (empty($wordSetA) && empty($wordSetB)) {
        return 0.0;
    }

    $setA = array_flip($wordSetA);
    $setB = array_flip($wordSetB);
    $intersection = count(array_intersect_key($setA, $setB));
    $union = count($setA) + count($setB) - $intersection;

    return $union > 0 ? $intersection / $union : 0.0;
}
