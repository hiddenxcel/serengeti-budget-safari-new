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

if (!rate_limit_check('suggest_seo', 10, 300)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests — please wait a moment.']);
    exit;
}

// Cap input length before it's ever sent to Groq.
$safari = [
    'title_en' => mb_substr((string) ($_POST['title_en'] ?? ''), 0, 200),
    'destination' => mb_substr((string) ($_POST['destination'] ?? ''), 0, 200),
    'duration_days' => (int) ($_POST['duration_days'] ?? 0),
    'short_description_en' => mb_substr((string) ($_POST['short_description_en'] ?? ''), 0, 1000),
];

$result = groq_suggest_seo_meta($safari);

if (!$result['ok']) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => $result['error']]);
    exit;
}

echo json_encode(['ok' => true, 'data' => $result['data']]);
