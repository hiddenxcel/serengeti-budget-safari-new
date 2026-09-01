<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/seo-crawler.php';
require_once dirname(__DIR__, 2) . '/includes/seo-analyzer.php';
require_once dirname(__DIR__, 2) . '/includes/seo-scoring.php';
require_once dirname(__DIR__, 2) . '/includes/seo-issues.php';
require_once dirname(__DIR__, 2) . '/includes/groq.php';

header('Content-Type: application/json');
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['error' => 'Your session expired, please refresh the page.']);
    exit;
}

$action = (string) ($_POST['action'] ?? '');

if ($action === 'start') {
    seo_chunk_handle_start();
    exit;
}

$auditId = (int) ($_POST['audit_id'] ?? 0);
if ($auditId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing or invalid audit_id.']);
    exit;
}

seo_chunk_handle_continue($auditId);

function seo_chunk_handle_start(): void
{
    $settings = db()->query('SELECT * FROM seo_settings WHERE id = 1')->fetch();

    if (empty($settings['website_url'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Configure a website URL in SEO Settings before running an audit.']);
        return;
    }

    $seedUrl = rtrim($settings['website_url'], '/') . '/';
    $state = [
        'queue' => [['url' => $seedUrl, 'depth' => 0]],
        'visited' => [$seedUrl => true],
        'inbound_links' => [],
    ];

    $stmt = db()->prepare(
        'INSERT INTO seo_audits (status, target_url, crawl_queue_json, started_by) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute(['running', $settings['website_url'], json_encode($state), current_admin()['id']]);
    $auditId = (int) db()->lastInsertId();

    echo json_encode(['audit_id' => $auditId, 'done' => false, 'phase' => 'discovering', 'pages_discovered' => 1, 'pages_crawled' => 0]);
}

function seo_chunk_handle_continue(int $auditId): void
{
    $stmt = db()->prepare('SELECT * FROM seo_audits WHERE id = ?');
    $stmt->execute([$auditId]);
    $audit = $stmt->fetch();

    if (!$audit) {
        http_response_code(404);
        echo json_encode(['error' => 'Audit not found.']);
        return;
    }

    if ($audit['status'] !== 'running') {
        echo json_encode(['done' => true, 'phase' => $audit['status'], 'audit_id' => $auditId]);
        return;
    }

    $settings = db()->query('SELECT * FROM seo_settings WHERE id = 1')->fetch();
    $seedUrl = rtrim($audit['target_url'], '/') . '/';
    $scopeHost = seo_crawl_scope_host($seedUrl);
    $scopeIsPrivate = seo_crawl_is_private_ip((string) parse_url($seedUrl, PHP_URL_HOST));

    $state = json_decode((string) $audit['crawl_queue_json'], true);
    if (!is_array($state)) {
        seo_chunk_fail($auditId, 'Crawl state was corrupted.');
        return;
    }

    try {
        $crawledThisChunk = [];
        $onPageCrawled = function (string $url, array $fetch, array $links) use (&$crawledThisChunk, $auditId) {
            $facts = seo_analyze_page($url, $fetch['body'], $fetch['status'], $fetch['headers'], $fetch['response_time_ms']);
            $facts['internal_link_count'] = count($links);

            $lang = $facts['lang'];
            $path = (string) parse_url($url, PHP_URL_PATH);

            $stmt = db()->prepare(
                'INSERT INTO seo_pages (audit_id, url, path, lang, http_status, redirect_to, response_time_ms, content_bytes,
                    title, title_length, meta_description, meta_description_length, h1_count, word_count, canonical_url,
                    is_noindex, internal_link_count, image_count, images_missing_alt, schema_types_json, content_hash, facts_json)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $auditId, $url, $path, $lang, $fetch['status'],
                !empty($fetch['redirect_chain']) ? end($fetch['redirect_chain'])['to'] : null,
                $fetch['response_time_ms'], strlen($fetch['body']),
                $facts['title'], $facts['title_length'], $facts['meta_description'], $facts['meta_description_length'],
                $facts['h1_count'], $facts['word_count'], $facts['canonical_url'], $facts['is_noindex'] ? 1 : 0,
                $facts['internal_link_count'], $facts['image_count'], $facts['images_missing_alt'],
                json_encode($facts['schema_types']), $facts['content_hash'], json_encode($facts),
            ]);

            $crawledThisChunk[] = [
                'url' => $url,
                'http_status' => $fetch['status'],
                'redirect_chain' => $fetch['redirect_chain'],
                'response_time_ms' => $fetch['response_time_ms'],
                'links' => $links,
                'facts' => $facts,
            ];
        };

        $result = seo_crawl_run_chunk(
            $state, $scopeHost, $scopeIsPrivate,
            (int) $settings['request_timeout_seconds'], (int) $settings['max_pages'], (int) $settings['max_depth'],
            (int) $audit['pages_crawled'], $onPageCrawled
        );

        $newPagesCrawled = $audit['pages_crawled'] + $result['pages_processed'];
        $newPagesDiscovered = count($result['state']['visited']);

        if (!$result['done']) {
            db()->prepare('UPDATE seo_audits SET pages_discovered = ?, pages_crawled = ?, crawl_queue_json = ? WHERE id = ?')
                ->execute([$newPagesDiscovered, $newPagesCrawled, json_encode($result['state']), $auditId]);

            echo json_encode([
                'done' => false, 'phase' => 'crawling', 'audit_id' => $auditId,
                'pages_discovered' => $newPagesDiscovered, 'pages_crawled' => $newPagesCrawled,
                'current_url' => $result['current_url'],
            ]);
            return;
        }

        // Terminal chunk: run post-crawl passes, score, build issues, finish.
        seo_chunk_finalize($auditId, $audit, $settings, $result['state'], $seedUrl, $scopeHost, $scopeIsPrivate, $newPagesCrawled, $newPagesDiscovered);
    } catch (\Throwable $e) {
        error_log('SEO audit chunk failed: ' . $e->getMessage());
        seo_chunk_fail($auditId, 'An unexpected error occurred while processing this audit.');
    }
}

function seo_chunk_finalize(int $auditId, array $audit, array $settings, array $finalState, string $seedUrl, string $scopeHost, bool $scopeIsPrivate, int $pagesCrawled, int $pagesDiscovered): void
{
    $pageRows = db()->prepare('SELECT * FROM seo_pages WHERE audit_id = ?');
    $pageRows->execute([$auditId]);
    $rows = $pageRows->fetchAll();

    $pages = [];
    $hreflangByUrl = [];
    foreach ($rows as $row) {
        $facts = json_decode((string) $row['facts_json'], true) ?: [];
        $pages[] = [
            'id' => $row['id'],
            'url' => $row['url'],
            'http_status' => $row['http_status'] !== null ? (int) $row['http_status'] : null,
            'response_time_ms' => (int) $row['response_time_ms'],
            'redirect_chain' => [],
            'facts' => $facts,
        ];
        $hreflangByUrl[$row['url']] = $facts['hreflang'] ?? [];
    }

    $inboundAndOrphans = seo_crawl_compute_inbound_and_orphans($finalState['inbound_links'], $pages, $seedUrl);
    $hreflangResults = seo_crawl_check_hreflang_reciprocity($hreflangByUrl);

    foreach ($pages as &$page) {
        $page['hreflang_ok'] = $hreflangResults[$page['url']] ?? null;
    }
    unset($page);

    $urlToId = [];
    $statusByUrl = [];
    foreach ($rows as $row) {
        $urlToId[$row['url']] = $row['id'];
        $statusByUrl[$row['url']] = $row['http_status'] !== null ? (int) $row['http_status'] : null;
    }

    // Broken-link attribution: walk inbound_links (child url => [{url: parent, anchor_text}])
    // and flag any child with a 4xx/5xx status, carrying the real anchor text through.
    $brokenLinks = [];
    foreach ($finalState['inbound_links'] as $targetUrl => $sources) {
        $targetStatus = $statusByUrl[$targetUrl] ?? null;
        if ($targetStatus !== null && $targetStatus >= 400) {
            foreach ($sources as $source) {
                $brokenLinks[] = [
                    'source_url' => $source['url'],
                    'target_url' => $targetUrl,
                    'status' => $targetStatus,
                    'anchor_text' => $source['anchor_text'],
                ];
            }
        }
    }

    $robotsSitemap = seo_crawl_fetch_robots_and_sitemap($seedUrl, $scopeHost, $scopeIsPrivate, (int) $settings['request_timeout_seconds']);

    $crawlMeta = [
        'robots_present' => $robotsSitemap['robots_present'],
        'sitemap_present' => $robotsSitemap['sitemap_present'],
        'orphans' => $inboundAndOrphans['orphans'],
        'broken_links' => $brokenLinks,
    ];

    $pagespeedResult = seo_fetch_pagespeed_result($seedUrl);

    $scoreResult = seo_score_audit($pages, $crawlMeta, $pagespeedResult);
    $issues = seo_build_issues($pages, $crawlMeta, $scoreResult['near_duplicates']);

    $issueInsert = db()->prepare(
        'INSERT INTO seo_issues (audit_id, page_id, category, severity, issue_code, message, source_url, target_url, anchor_text)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    foreach ($issues as $issue) {
        $pageId = $issue['page_url'] !== null ? ($urlToId[$issue['page_url']] ?? null) : null;
        $issueInsert->execute([
            $auditId, $pageId, $issue['category'], $issue['severity'], $issue['issue_code'], $issue['message'],
            $issue['source_url'] ?? null, $issue['target_url'] ?? null, $issue['anchor_text'] ?? null,
        ]);
    }

    // Update hreflang_ok flag on each seo_pages row for the indexability scorer's own re-reads (page-detail, history).
    $hreflangUpdate = db()->prepare('UPDATE seo_pages SET hreflang_ok = ? WHERE id = ?');
    foreach ($pages as $page) {
        $hreflangUpdate->execute([$page['hreflang_ok'] === null ? null : ($page['hreflang_ok'] ? 1 : 0), $urlToId[$page['url']]]);
    }

    $aiRecommendations = seo_maybe_run_ai_search_readiness($pages);

    db()->prepare(
        'UPDATE seo_audits SET status = ?, pages_discovered = ?, pages_crawled = ?, overall_score = ?,
            score_technical = ?, score_onpage = ?, score_content = ?, score_indexability = ?, score_links = ?,
            score_images = ?, score_structured_data = ?, score_performance = ?, performance_scored = ?,
            crawl_queue_json = NULL, ai_search_recommendations_json = ?, completed_at = NOW()
         WHERE id = ?'
    )->execute([
        'completed', $pagesDiscovered, $pagesCrawled, $scoreResult['overall'],
        $scoreResult['scores']['technical'], $scoreResult['scores']['onpage'], $scoreResult['scores']['content'],
        $scoreResult['scores']['indexability'], $scoreResult['scores']['links'], $scoreResult['scores']['images'],
        $scoreResult['scores']['structured_data'], $scoreResult['scores']['performance'],
        $scoreResult['performance_scored'] ? 1 : 0, $aiRecommendations ? json_encode($aiRecommendations) : null,
        $auditId,
    ]);

    echo json_encode(['done' => true, 'phase' => 'complete', 'audit_id' => $auditId, 'overall_score' => $scoreResult['overall']]);
}

/**
 * PageSpeed Insights, called once per audit against the homepage only (not
 * every page) to stay within free-tier quota. Returns null (not a
 * fabricated score) if PAGESPEED_API_KEY isn't configured or the call fails.
 */
function seo_fetch_pagespeed_result(string $homepageUrl): ?array
{
    if (!defined('PAGESPEED_API_KEY') || PAGESPEED_API_KEY === '') {
        return null;
    }

    $endpoint = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?' . http_build_query([
        'url' => $homepageUrl,
        'key' => PAGESPEED_API_KEY,
        'strategy' => 'mobile',
    ]);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 30]);
    $response = curl_exec($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        error_log('PageSpeed API non-200: ' . $httpCode);
        return null;
    }

    $data = json_decode((string) $response, true);
    $score = $data['lighthouseResult']['categories']['performance']['score'] ?? null;

    if (!is_numeric($score)) {
        return null;
    }

    return ['score' => (int) round($score * 100)];
}

/**
 * One Groq call for the whole audit (not per page) — "AI search readiness"
 * is inherently a site-wide judgment. Skips gracefully if Groq isn't
 * configured; never blocks or fails the deterministic audit.
 */
function seo_maybe_run_ai_search_readiness(array $pages): ?array
{
    if (!defined('GROQ_API_KEY') || GROQ_API_KEY === '') {
        return null;
    }

    $faqCount = 0;
    $schemaBeyondDefault = 0;
    $sampleTitles = [];
    foreach ($pages as $page) {
        if (!empty($page['facts']['has_faq_content'])) {
            $faqCount++;
        }
        $types = $page['facts']['schema_types'] ?? [];
        if (count(array_diff($types, ['TravelAgency'])) > 0) {
            $schemaBeyondDefault++;
        }
        if (count($sampleTitles) < 8 && !empty($page['facts']['title'])) {
            $sampleTitles[] = $page['facts']['title'];
        }
    }

    $summary = [
        'total_pages' => count($pages),
        'pages_with_faq_sections' => $faqCount,
        'pages_with_page_specific_schema' => $schemaBeyondDefault,
        'sample_titles' => $sampleTitles,
    ];

    $result = groq_analyze_ai_search_readiness($summary);

    return $result['ok'] ? $result['data'] : null;
}

function seo_chunk_fail(int $auditId, string $message): void
{
    db()->prepare('UPDATE seo_audits SET status = ?, error_message = ?, crawl_queue_json = NULL, completed_at = NOW() WHERE id = ?')
        ->execute(['failed', $message, $auditId]);
    echo json_encode(['done' => true, 'phase' => 'failed', 'error' => $message, 'audit_id' => $auditId]);
}
