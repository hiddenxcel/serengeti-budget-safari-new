<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/groq.php';

header('Content-Type: application/json');
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Your session expired, please refresh the page.']);
    exit;
}

if (!rate_limit_check('seo_suggest_meta', 15, 300)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests — please wait a moment.']);
    exit;
}

$pageId = (int) ($_POST['page_id'] ?? 0);
$stmt = db()->prepare('SELECT * FROM seo_pages WHERE id = ?');
$stmt->execute([$pageId]);
$page = $stmt->fetch();

if (!$page) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'error' => 'Page not found.']);
    exit;
}

$facts = json_decode((string) $page['facts_json'], true) ?: [];
$facts['url'] = $page['url'];
$facts['content_snippet'] = mb_substr((string) $page['meta_description'], 0, 200);

$result = groq_generate_meta_title($facts);

if (!$result['ok']) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => $result['error']]);
    exit;
}

echo json_encode(['ok' => true, 'data' => $result['data']]);
