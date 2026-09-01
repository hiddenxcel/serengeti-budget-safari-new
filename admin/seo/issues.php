<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'SEO Issues';

$auditId = (int) ($_GET['audit_id'] ?? 0);
if ($auditId <= 0) {
    $latest = db()->query("SELECT id FROM seo_audits WHERE status = 'completed' ORDER BY completed_at DESC LIMIT 1")->fetch();
    $auditId = $latest ? (int) $latest['id'] : 0;
}

$severityFilter = (string) ($_GET['severity'] ?? '');
$categoryFilter = (string) ($_GET['category'] ?? '');

$where = ['si.audit_id = ?'];
$params = [$auditId];
if (in_array($severityFilter, ['critical', 'warning', 'info'], true)) {
    $where[] = 'si.severity = ?';
    $params[] = $severityFilter;
}
if ($categoryFilter !== '') {
    $where[] = 'si.category = ?';
    $params[] = $categoryFilter;
}
$whereSql = implode(' AND ', $where);

$stmt = db()->prepare(
    "SELECT si.*, sp.url as page_url FROM seo_issues si LEFT JOIN seo_pages sp ON sp.id = si.page_id
     WHERE $whereSql ORDER BY FIELD(si.severity, 'critical', 'warning', 'info') LIMIT 300"
);
$stmt->execute($params);
$issues = $stmt->fetchAll();

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-filter-bar">
    <a href="?audit_id=<?= (int) $auditId ?>" class="<?= $severityFilter === '' ? 'active' : '' ?>">All</a>
    <a href="?audit_id=<?= (int) $auditId ?>&severity=critical" class="<?= $severityFilter === 'critical' ? 'active' : '' ?>">Critical</a>
    <a href="?audit_id=<?= (int) $auditId ?>&severity=warning" class="<?= $severityFilter === 'warning' ? 'active' : '' ?>">Warning</a>
    <a href="?audit_id=<?= (int) $auditId ?>&severity=info" class="<?= $severityFilter === 'info' ? 'active' : '' ?>">Info</a>
</div>

<div class="admin-card">
    <?php if (!$issues): ?>
        <div class="admin-empty-state">No issues match this filter.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Severity</th><th>Category</th><th>Issue</th><th>Page</th></tr></thead>
            <tbody>
                <?php foreach ($issues as $issue): ?>
                <tr>
                    <td><span class="admin-badge <?= $issue['severity'] === 'critical' ? 'draft' : ($issue['severity'] === 'warning' ? 'published' : 'archived') ?>"><?= e(ucfirst($issue['severity'])) ?></span></td>
                    <td><?= e($issue['category']) ?></td>
                    <td><?= e($issue['message']) ?></td>
                    <td><?php if ($issue['page_url']): ?><a href="<?= admin_base_url() ?>/seo/page-detail.php?page_id=<?= (int) $issue['page_id'] ?>"><?= e($issue['page_url']) ?></a><?php else: ?>Site-wide<?php endif; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
