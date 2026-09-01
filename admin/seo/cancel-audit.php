<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

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

$auditId = (int) ($_POST['audit_id'] ?? 0);
if ($auditId <= 0) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Missing or invalid audit_id.']);
    exit;
}

$stmt = db()->prepare("UPDATE seo_audits SET status = 'cancelled', completed_at = NOW(), crawl_queue_json = NULL WHERE id = ? AND status = 'running'");
$stmt->execute([$auditId]);

echo json_encode(['ok' => true, 'cancelled' => $stmt->rowCount() > 0]);
