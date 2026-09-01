<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Crawled Pages';

$auditId = (int) ($_GET['audit_id'] ?? 0);
if ($auditId <= 0) {
    $latest = db()->query("SELECT id FROM seo_audits WHERE status = 'completed' ORDER BY completed_at DESC LIMIT 1")->fetch();
    $auditId = $latest ? (int) $latest['id'] : 0;
}

$search = trim((string) ($_GET['q'] ?? ''));
$sort = (string) ($_GET['sort'] ?? 'url');
$allowedSorts = ['url', 'http_status', 'word_count', 'internal_link_count', 'image_count'];
if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'url';
}
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 25;
$offset = ($page - 1) * $perPage;

$where = ['audit_id = ?'];
$params = [$auditId];
if ($search !== '') {
    $where[] = '(url LIKE ? OR title LIKE ?)';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
}
$whereSql = implode(' AND ', $where);

$totalStmt = db()->prepare("SELECT COUNT(*) FROM seo_pages WHERE $whereSql");
$totalStmt->execute($params);
$total = (int) $totalStmt->fetchColumn();

$stmt = db()->prepare("SELECT * FROM seo_pages WHERE $whereSql ORDER BY $sort ASC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$pages = $stmt->fetchAll();

$issueCountsStmt = db()->prepare('SELECT page_id, COUNT(*) as cnt FROM seo_issues WHERE audit_id = ? AND page_id IS NOT NULL GROUP BY page_id');
$issueCountsStmt->execute([$auditId]);
$issueCounts = array_column($issueCountsStmt->fetchAll(), 'cnt', 'page_id');

$totalPages = (int) ceil($total / $perPage);

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <form method="get" style="display:flex;gap:0.5rem;">
        <input type="hidden" name="audit_id" value="<?= (int) $auditId ?>" />
        <input type="text" name="q" placeholder="Search URL or title..." value="<?= e($search) ?>" />
        <button type="submit" class="admin-btn">Search</button>
    </form>
</div>

<div class="admin-card">
    <?php if (!$pages): ?>
        <div class="admin-empty-state">No pages found for this audit.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>URL</th><th>Status</th><th>Title</th><th>Words</th><th>Images</th><th>Issues</th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $p): ?>
                <tr>
                    <td style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= e($p['path']) ?></td>
                    <td><?= (int) $p['http_status'] ?></td>
                    <td style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= e((string) $p['title']) ?></td>
                    <td><?= (int) $p['word_count'] ?></td>
                    <td><?= (int) $p['image_count'] ?></td>
                    <td><?= (int) ($issueCounts[$p['id']] ?? 0) ?></td>
                    <td><a href="<?= admin_base_url() ?>/seo/page-detail.php?page_id=<?= (int) $p['id'] ?>" class="admin-btn">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($totalPages > 1): ?>
        <div style="margin-top:1rem;display:flex;gap:0.5rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?audit_id=<?= (int) $auditId ?>&q=<?= urlencode($search) ?>&sort=<?= e($sort) ?>&page=<?= $i ?>" class="admin-btn<?= $i === $page ? ' primary' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
