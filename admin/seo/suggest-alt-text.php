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

if (!rate_limit_check('seo_suggest_alt', 20, 300)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests — please wait a moment.']);
    exit;
}

$pageId = (int) ($_POST['page_id'] ?? 0);
$imageSrc = mb_substr((string) ($_POST['image_src'] ?? ''), 0, 500);

$stmt = db()->prepare('SELECT url, title FROM seo_pages WHERE id = ?');
$stmt->execute([$pageId]);
$page = $stmt->fetch();

if (!$page) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'error' => 'Page not found.']);
    exit;
}

$result = groq_generate_alt_text([
    'src' => $imageSrc,
    'page_title' => $page['title'],
    'page_url' => $page['url'],
]);

if (!$result['ok']) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => $result['error']]);
    exit;
}

echo json_encode(['ok' => true, 'data' => $result['data']]);
