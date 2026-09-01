<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/image-matcher.php';

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

if (!rate_limit_check('suggest_images', 20, 300)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests — please wait a moment.']);
    exit;
}

$safari = [
    'title_en' => (string) ($_POST['title_en'] ?? ''),
    'destination' => (string) ($_POST['destination'] ?? ''),
    'short_description_en' => (string) ($_POST['short_description_en'] ?? ''),
    'description_en' => (string) ($_POST['description_en'] ?? ''),
];

$suggestion = image_matcher_suggest($safari);

echo json_encode(['ok' => true, 'data' => $suggestion]);
