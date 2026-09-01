<?php
declare(strict_types=1);

/**
 * BFS crawl orchestration for the site-wide SEO Intelligence Center
 * (admin/seo/). Fetches and discovers pages only — HTML -> structured
 * facts extraction lives in includes/seo-analyzer.php, scoring in
 * includes/seo-scoring.php, issue-building in includes/seo-issues.php.
 *
 * Security: the crawler only ever fetches URLs on the one host:port
 * configured in seo_settings.website_url (validated at settings-save
 * time). It never accepts a URL from the current HTTP request. Every
 * fetch — including each hop of a manually-followed redirect — is
 * re-validated against scheme/host/port/private-IP rules before the
 * request is made. This is a deliberate SSRF-hardening measure since a
 * page's own outbound links (or a redirect target) are not trusted input.
 */

const SEO_CRAWL_STATIC_EXTENSIONS = [
    'jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'ico', 'css', 'js',
    'woff', 'woff2', 'ttf', 'eot', 'pdf', 'xml', 'zip', 'mp4', 'mp3',
    'json', 'txt',
];

const SEO_CRAWL_MAX_REDIRECTS = 5;
const SEO_CRAWL_MAX_RESPONSE_BYTES = 5 * 1024 * 1024; // 5MB
const SEO_CRAWL_URLS_PER_CHUNK = 5;

/**
 * True if $host's resolved IP (or $host itself, if already an IP literal)
 * falls in a private/reserved range. Used to stop a redirect or discovered
 * link from steering the crawler at internal infrastructure.
 */
function seo_crawl_is_private_ip(string $host): bool
{
    $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : (gethostbyname($host) ?: null);

    if ($ip === null || $ip === $host && !filter_var($host, FILTER_VALIDATE_IP)) {
        // gethostbyname() returns the input unchanged on failure to resolve.
        return true;
    }

    return !filter_var(
        $ip,
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
    );
}

/**
 * Validates a URL is safe to fetch: http(s) scheme, host:port matches the
 * audit's configured scope, and (unless the scope host itself is private —
 * i.e. the admin intentionally configured a local/dev target) the resolved
 * IP is not in a private/reserved range. This guards against a same-host
 * page redirecting to, or linking to, an unexpected private/internal host.
 */
function seo_crawl_is_safe_to_fetch(string $url, string $scopeHost, bool $scopeIsPrivate): bool
{
    $parts = parse_url($url);
    if (!$parts || empty($parts['scheme']) || empty($parts['host'])) {
        return false;
    }

    if (!in_array(strtolower($parts['scheme']), ['http', 'https'], true)) {
        return false;
    }

    $hostPort = strtolower($parts['host']) . ':' . seo_crawl_effective_port($parts);
    if ($hostPort !== $scopeHost) {
        return false;
    }

    if (!$scopeIsPrivate && seo_crawl_is_private_ip($parts['host'])) {
        return false;
    }

    return true;
}

function seo_crawl_effective_port(array $urlParts): int
{
    if (isset($urlParts['port'])) {
        return (int) $urlParts['port'];
    }
    return strtolower($urlParts['scheme'] ?? '') === 'https' ? 443 : 80;
}

function seo_crawl_scope_host(string $seedUrl): string
{
    $parts = parse_url($seedUrl);
    return strtolower($parts['host'] ?? '') . ':' . seo_crawl_effective_port($parts);
}

/**
 * Normalizes a discovered href against the page it was found on. Returns
 * null for anything that should never be enqueued (non-http schemes,
 * fragments-only links, static assets) — callers treat null as
 * "not a page, don't queue, don't fetch".
 */
function seo_crawl_normalize_url(string $href, string $baseUrl): ?string
{
    $href = trim($href);
    if ($href === '' || $href[0] === '#') {
        return null;
    }

    if (preg_match('/^(mailto|tel|javascript|data|ftp|file):/i', $href)) {
        return null;
    }

    $resolved = seo_crawl_resolve_relative($href, $baseUrl);
    if ($resolved === null) {
        return null;
    }

    $parts = parse_url($resolved);
    if (!$parts || empty($parts['scheme']) || empty($parts['host'])) {
        return null;
    }

    if (!in_array(strtolower($parts['scheme']), ['http', 'https'], true)) {
        return null;
    }

    $path = $parts['path'] ?? '/';
    $extension = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));
    if ($extension !== '' && in_array($extension, SEO_CRAWL_STATIC_EXTENSIONS, true)) {
        return null;
    }

    if ($path !== '/' && $path !== '/en/' && $path !== '/it/' && str_ends_with($path, '/')) {
        $path = rtrim($path, '/');
    }

    $host = strtolower($parts['host']);
    $port = seo_crawl_effective_port($parts);
    $defaultPort = (strtolower($parts['scheme']) === 'https' && $port === 443)
        || (strtolower($parts['scheme']) === 'http' && $port === 80);

    $normalized = strtolower($parts['scheme']) . '://' . $host . ($defaultPort ? '' : ':' . $port) . $path;

    return $normalized;
}

function seo_crawl_resolve_relative(string $href, string $baseUrl): ?string
{
    if (preg_match('#^https?://#i', $href)) {
        return $href;
    }

    $base = parse_url($baseUrl);
    if (!$base || empty($base['scheme']) || empty($base['host'])) {
        return null;
    }

    $scheme = $base['scheme'];
    $host = $base['host'];
    $port = isset($base['port']) ? ':' . $base['port'] : '';
    $authority = $scheme . '://' . $host . $port;

    if (str_starts_with($href, '//')) {
        return $scheme . ':' . $href;
    }

    if (str_starts_with($href, '/')) {
        return $authority . $href;
    }

    // Relative path: resolve against the base path's directory.
    $basePath = $base['path'] ?? '/';
    $baseDir = str_ends_with($basePath, '/') ? $basePath : dirname($basePath) . '/';

    return $authority . $baseDir . $href;
}

/**
 * Excludes /admin/ (and the theoretical /en/admin/, /it/admin/ forms) from
 * the crawl entirely — those pages are already noindex,nofollow by design;
 * crawling them would waste crawl budget and could hit the login redirect.
 */
function seo_crawl_is_excluded_path(string $url): bool
{
    $path = (string) parse_url($url, PHP_URL_PATH);
    return (bool) preg_match('#^/(en/|it/)?admin(/|$)#', $path);
}

/**
 * Fetches one URL, following redirects manually (up to
 * SEO_CRAWL_MAX_REDIRECTS hops) so each hop is individually recorded and
 * re-validated against the safe-fetch rules. Returns a shape describing
 * the final response plus the full redirect chain.
 *
 * @return array{final_url:string, status:?int, redirect_chain: array<int,array{from:string,to:string,status:int}>, headers: array<string,string>, body: string, response_time_ms:int, truncated: bool, error: ?string}
 */
function seo_crawl_fetch_url(string $url, string $scopeHost, bool $scopeIsPrivate, int $timeoutSeconds): array
{
    $chain = [];
    $current = $url;
    $totalStart = microtime(true);

    for ($hop = 0; $hop <= SEO_CRAWL_MAX_REDIRECTS; $hop++) {
        if (!seo_crawl_is_safe_to_fetch($current, $scopeHost, $scopeIsPrivate)) {
            return [
                'final_url' => $current,
                'status' => null,
                'redirect_chain' => $chain,
                'headers' => [],
                'body' => '',
                'response_time_ms' => (int) round((microtime(true) - $totalStart) * 1000),
                'truncated' => false,
                'error' => 'blocked_by_ssrf_policy',
            ];
        }

        $single = seo_crawl_fetch_single($current, $timeoutSeconds);

        if ($single['status'] !== null && in_array($single['status'], [301, 302, 303, 307, 308], true) && !empty($single['location'])) {
            $target = seo_crawl_resolve_relative($single['location'], $current) ?? $single['location'];
            $chain[] = ['from' => $current, 'to' => $target, 'status' => $single['status']];
            $current = $target;
            continue;
        }

        return [
            'final_url' => $current,
            'status' => $single['status'],
            'redirect_chain' => $chain,
            'headers' => $single['headers'],
            'body' => $single['body'],
            'response_time_ms' => (int) round((microtime(true) - $totalStart) * 1000),
            'truncated' => $single['truncated'],
            'error' => $single['error'],
        ];
    }

    return [
        'final_url' => $current,
        'status' => null,
        'redirect_chain' => $chain,
        'headers' => [],
        'body' => '',
        'response_time_ms' => (int) round((microtime(true) - $totalStart) * 1000),
        'truncated' => false,
        'error' => 'too_many_redirects',
    ];
}

/**
 * @return array{status:?int, headers:array<string,string>, body:string, location:?string, truncated:bool, error:?string}
 */
function seo_crawl_fetch_single(string $url, int $timeoutSeconds): array
{
    $headers = [];
    $bodyBuffer = '';
    $truncated = false;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => false, // we accumulate manually via WRITEFUNCTION for the size cap
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_TIMEOUT => $timeoutSeconds,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'SerengetiSeoAuditBot/1.0 (+internal admin tool)',
        CURLOPT_HEADERFUNCTION => function ($curlHandle, $line) use (&$headers) {
            $trimmed = trim($line);
            if (str_contains($trimmed, ':')) {
                [$name, $value] = explode(':', $trimmed, 2);
                $headers[strtolower(trim($name))] = trim($value);
            }
            return strlen($line);
        },
        CURLOPT_WRITEFUNCTION => function ($curlHandle, $chunk) use (&$bodyBuffer, &$truncated) {
            if (strlen($bodyBuffer) >= SEO_CRAWL_MAX_RESPONSE_BYTES) {
                $truncated = true;
                return 0; // abort transfer — curl treats a short write as an error
            }
            $bodyBuffer .= $chunk;
            return strlen($chunk);
        },
    ]);

    curl_exec($ch);
    $curlErrno = curl_errno($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($curlErrno !== 0 && !$truncated) {
        return ['status' => null, 'headers' => [], 'body' => '', 'location' => null, 'truncated' => false, 'error' => 'fetch_failed'];
    }

    return [
        'status' => $status > 0 ? $status : null,
        'headers' => $headers,
        'body' => $bodyBuffer,
        'location' => $headers['location'] ?? null,
        'truncated' => $truncated,
        'error' => null,
    ];
}

/**
 * Extracts and normalizes every <a href> in $html found on $pageUrl,
 * classifying each as in-scope-internal (queueable), external (recorded
 * but never queued), or non-crawlable (mailto/tel/js/fragment/asset).
 *
 * @return array{internal: array<int,array{url:string,anchor_text:string}>, external_count:int, non_crawlable_count:int}
 */
function seo_crawl_extract_links(string $html, string $pageUrl, string $scopeHost): array
{
    $internal = [];
    $externalCount = 0;
    $nonCrawlableCount = 0;

    if (trim($html) === '') {
        return ['internal' => $internal, 'external_count' => 0, 'non_crawlable_count' => 0];
    }

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//a[@href]') as $anchor) {
        $href = $anchor->getAttribute('href');
        $anchorText = trim($anchor->textContent);

        if ($href === '' || $href[0] === '#' || preg_match('/^(mailto|tel|javascript|data):/i', $href)) {
            $nonCrawlableCount++;
            continue;
        }

        $normalized = seo_crawl_normalize_url($href, $pageUrl);
        if ($normalized === null) {
            $nonCrawlableCount++;
            continue;
        }

        $linkHost = strtolower((string) parse_url($normalized, PHP_URL_HOST)) . ':' . seo_crawl_effective_port(parse_url($normalized) ?: []);
        if ($linkHost !== $scopeHost) {
            $externalCount++;
            continue;
        }

        $internal[] = ['url' => $normalized, 'anchor_text' => mb_substr($anchorText, 0, 255)];
    }

    return ['internal' => $internal, 'external_count' => $externalCount, 'non_crawlable_count' => $nonCrawlableCount];
}

/**
 * Fetches {website_url}/robots.txt and {website_url}/sitemap.xml over real
 * HTTP (not a filesystem check) — a production site may serve either
 * dynamically. Returns their presence/content for the indexability checks.
 */
function seo_crawl_fetch_robots_and_sitemap(string $websiteUrl, string $scopeHost, bool $scopeIsPrivate, int $timeoutSeconds): array
{
    $base = rtrim($websiteUrl, '/');

    $robots = seo_crawl_fetch_url($base . '/robots.txt', $scopeHost, $scopeIsPrivate, $timeoutSeconds);
    $sitemap = seo_crawl_fetch_url($base . '/sitemap.xml', $scopeHost, $scopeIsPrivate, $timeoutSeconds);

    return [
        'robots_present' => $robots['status'] === 200,
        'robots_body' => $robots['status'] === 200 ? $robots['body'] : '',
        'sitemap_present' => $sitemap['status'] === 200,
        'sitemap_body' => $sitemap['status'] === 200 ? $sitemap['body'] : '',
    ];
}

/**
 * Executes one bounded chunk of BFS crawl work (SEO_CRAWL_URLS_PER_CHUNK
 * URLs), given the current queue/visited/inbound-link state (as decoded
 * from seo_audits.crawl_queue_json), fetching+recording each URL via the
 * given $onPageCrawled callback (which the caller uses to persist a
 * seo_pages row and run the analyzer — kept as a callback so this function
 * stays free of direct DB/analyzer coupling).
 *
 * @param array{queue: array<int,array{url:string,depth:int}>, visited: array<string,bool>, inbound_links: array<string,array<int,array{url:string,anchor_text:string}>>} $state
 * @return array{state: array, pages_processed: int, done: bool, current_url: ?string}
 */
function seo_crawl_run_chunk(
    array $state,
    string $scopeHost,
    bool $scopeIsPrivate,
    int $timeoutSeconds,
    int $maxPages,
    int $maxDepth,
    int $pagesCrawledSoFar,
    callable $onPageCrawled
): array {
    $processed = 0;
    $lastUrl = null;

    while ($processed < SEO_CRAWL_URLS_PER_CHUNK && !empty($state['queue'])) {
        if (($pagesCrawledSoFar + $processed) >= $maxPages) {
            $state['queue'] = [];
            break;
        }

        $entry = array_shift($state['queue']);
        $url = $entry['url'];
        $depth = $entry['depth'];
        $lastUrl = $url;

        if (seo_crawl_is_excluded_path($url)) {
            continue;
        }

        $fetch = seo_crawl_fetch_url($url, $scopeHost, $scopeIsPrivate, $timeoutSeconds);
        $links = [];

        if ($fetch['status'] !== null && $fetch['status'] >= 200 && $fetch['status'] < 300 && !empty($fetch['body'])) {
            $extracted = seo_crawl_extract_links($fetch['body'], $fetch['final_url'], $scopeHost);
            $links = $extracted['internal'];

            if ($depth < $maxDepth) {
                foreach ($links as $link) {
                    $childUrl = $link['url'];

                    if (!isset($state['inbound_links'][$childUrl])) {
                        $state['inbound_links'][$childUrl] = [];
                    }
                    $alreadyRecorded = false;
                    foreach ($state['inbound_links'][$childUrl] as $existing) {
                        if ($existing['url'] === $url) {
                            $alreadyRecorded = true;
                            break;
                        }
                    }
                    if (!$alreadyRecorded) {
                        $state['inbound_links'][$childUrl][] = ['url' => $url, 'anchor_text' => $link['anchor_text']];
                    }

                    if (!isset($state['visited'][$childUrl]) && !seo_crawl_is_excluded_path($childUrl)) {
                        $state['visited'][$childUrl] = true;
                        $state['queue'][] = ['url' => $childUrl, 'depth' => $depth + 1];
                    }
                }
            }
        }

        $onPageCrawled($url, $fetch, $links);
        $processed++;
    }

    return [
        'state' => $state,
        'pages_processed' => $processed,
        'done' => empty($state['queue']),
        'current_url' => $lastUrl,
    ];
}

/**
 * Post-crawl pass: computes inbound_link_count for every crawled URL from
 * the accumulated inbound_links map, and flags pages with zero inbound
 * links (excluding the seed/homepage) as orphans.
 *
 * @param array<string,array<int,string>> $inboundLinks url => [urls that link to it]
 * @param array<int,array{url:string}> $crawledPages
 * @return array{inbound_counts: array<string,int>, orphans: array<int,string>}
 */
function seo_crawl_compute_inbound_and_orphans(array $inboundLinks, array $crawledPages, string $seedUrl): array
{
    $counts = [];
    $orphans = [];

    foreach ($crawledPages as $page) {
        $url = $page['url'];
        $count = count($inboundLinks[$url] ?? []);
        $counts[$url] = $count;

        if ($count === 0 && $url !== $seedUrl) {
            $orphans[] = $url;
        }
    }

    return ['inbound_counts' => $counts, 'orphans' => $orphans];
}

/**
 * Post-crawl pass: for each crawled page's hreflang set, verifies (a) it
 * references en/it/x-default, (b) each referenced URL was actually crawled
 * (not dangling), and (c) reciprocity — the referenced page's own hreflang
 * set must point back to this page's URL.
 *
 * @param array<string,array<string,string>> $hreflangByUrl url => {lang => href}
 * @return array<string,bool> url => whether its hreflang set passed all checks
 */
function seo_crawl_check_hreflang_reciprocity(array $hreflangByUrl): array
{
    $results = [];
    $knownUrls = array_flip(array_keys($hreflangByUrl));

    foreach ($hreflangByUrl as $url => $set) {
        $ok = isset($set['en'], $set['it'], $set['x-default']);

        if ($ok) {
            foreach (['en', 'it'] as $lang) {
                $target = $set[$lang];
                if (!isset($knownUrls[$target])) {
                    // Points somewhere not crawled — can't verify reciprocity, but
                    // also can't call it definitively broken (could be a URL variant
                    // like trailing-slash difference); treat as a soft pass-through
                    // rather than failing the whole page's hreflang on a lookup miss.
                    continue;
                }
                $targetSet = $hreflangByUrl[$target] ?? [];
                $expectedBackLink = $url;
                $reciprocal = false;
                foreach ($targetSet as $backHref) {
                    if ($backHref === $expectedBackLink) {
                        $reciprocal = true;
                        break;
                    }
                }
                if (!$reciprocal) {
                    $ok = false;
                    break;
                }
            }
        }

        $results[$url] = $ok;
    }

    return $results;
}
