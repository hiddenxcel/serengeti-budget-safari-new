<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/seo-issues.php';

require_admin();

$auditId = (int) ($_GET['audit_id'] ?? 0);

$stmt = db()->prepare('SELECT * FROM seo_audits WHERE id = ?');
$stmt->execute([$auditId]);
$audit = $stmt->fetch();

if (!$audit) {
    http_response_code(404);
    exit('Audit not found.');
}

$issuesStmt = db()->prepare('SELECT * FROM seo_issues WHERE audit_id = ?');
$issuesStmt->execute([$auditId]);
$issues = $issuesStmt->fetchAll();
$grouped = seo_issues_group_for_recommendations($issues);

$counts = ['critical' => 0, 'warning' => 0, 'info' => 0];
foreach ($issues as $i) {
    $counts[$i['severity']]++;
}

$topPagesStmt = db()->prepare(
    'SELECT sp.url, COUNT(*) as issue_count FROM seo_issues si JOIN seo_pages sp ON sp.id = si.page_id
     WHERE si.audit_id = ? GROUP BY sp.id ORDER BY issue_count DESC LIMIT 10'
);
$topPagesStmt->execute([$auditId]);
$topPages = $topPagesStmt->fetchAll();

$categories = [
    'score_technical' => 'Technical SEO', 'score_onpage' => 'On-Page SEO', 'score_content' => 'Content',
    'score_indexability' => 'Indexability', 'score_links' => 'Links', 'score_images' => 'Images',
    'score_structured_data' => 'Structured Data', 'score_performance' => 'Performance',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SEO Report — <?= e($audit['started_at']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 2rem auto; color: #222; }
        h1 { font-size: 1.5rem; } h2 { font-size: 1.1rem; margin-top: 2rem; border-bottom: 1px solid #ddd; padding-bottom: 0.3rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 0.5rem; }
        th, td { text-align: left; padding: 0.4rem; border-bottom: 1px solid #eee; font-size: 0.9rem; }
        .score { font-size: 2.5rem; font-weight: bold; }
        .print-btn { margin-bottom: 1rem; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">Print / Save as PDF</button>

    <h1>SEO Health Report</h1>
    <p><strong>Website:</strong> <?= e($audit['target_url']) ?><br />
    <strong>Audit date:</strong> <?= e($audit['completed_at']) ?><br />
    <strong>Pages crawled:</strong> <?= (int) $audit['pages_crawled'] ?></p>

    <div class="score"><?= (int) $audit['overall_score'] ?> / 100</div>
    <?php if (!$audit['performance_scored']): ?>
        <p><em>Performance not included in this score — PageSpeed Insights API not configured.</em></p>
    <?php endif; ?>

    <h2>Category Scores</h2>
    <table>
        <?php foreach ($categories as $col => $label): ?>
            <tr><td><?= e($label) ?></td><td><?= $audit[$col] === null ? 'N/A' : (int) $audit[$col] . '/100' ?></td></tr>
        <?php endforeach; ?>
    </table>

    <h2>Issue Summary</h2>
    <p>Critical: <?= $counts['critical'] ?> · Warning: <?= $counts['warning'] ?> · Info: <?= $counts['info'] ?></p>

    <h2>Top Recommendations</h2>
    <table>
        <thead><tr><th>Priority</th><th>Issue</th><th>Affected Pages</th></tr></thead>
        <?php foreach (array_slice($grouped, 0, 10) as $g): ?>
            <tr><td><?= e(ucfirst($g['severity'])) ?></td><td><?= e(str_replace('_', ' ', ucfirst($g['issue_code']))) ?></td><td><?= (int) $g['affected_count'] ?></td></tr>
        <?php endforeach; ?>
    </table>

    <h2>Top Affected Pages</h2>
    <table>
        <thead><tr><th>URL</th><th>Issues</th></tr></thead>
        <?php foreach ($topPages as $p): ?>
            <tr><td><?= e($p['url']) ?></td><td><?= (int) $p['issue_count'] ?></td></tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
