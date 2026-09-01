<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/seo-issues.php';

require_admin();

$pageTitle = 'SEO Recommendations';

$auditId = (int) ($_GET['audit_id'] ?? 0);
if ($auditId <= 0) {
    $latest = db()->query("SELECT id FROM seo_audits WHERE status = 'completed' ORDER BY completed_at DESC LIMIT 1")->fetch();
    $auditId = $latest ? (int) $latest['id'] : 0;
}

$stmt = db()->prepare('SELECT * FROM seo_issues WHERE audit_id = ?');
$stmt->execute([$auditId]);
$issues = $stmt->fetchAll();

$grouped = seo_issues_group_for_recommendations($issues);

$audit = null;
if ($auditId) {
    $auditStmt = db()->prepare('SELECT ai_search_recommendations_json FROM seo_audits WHERE id = ?');
    $auditStmt->execute([$auditId]);
    $audit = $auditStmt->fetch();
}
$aiRecs = $audit && $audit['ai_search_recommendations_json'] ? json_decode($audit['ai_search_recommendations_json'], true) : null;

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Prioritized Recommendations</h2>
    <?php if (!$grouped): ?>
        <div class="admin-empty-state">No issues found — nothing to recommend.</div>
    <?php else: ?>
        <?php foreach ($grouped as $g): ?>
        <div class="admin-card" style="background:#fafafa;">
            <span class="admin-badge <?= $g['severity'] === 'critical' ? 'draft' : ($g['severity'] === 'warning' ? 'published' : 'archived') ?>"><?= e(ucfirst($g['severity'])) ?> Priority</span>
            <h3 style="margin:0.5rem 0;"><?= e(str_replace('_', ' ', ucfirst($g['issue_code']))) ?></h3>
            <p>Affected pages: <strong><?= (int) $g['affected_count'] ?></strong></p>
            <p><?= e($g['message_sample']) ?></p>
            <a href="<?= admin_base_url() ?>/seo/issues.php?audit_id=<?= (int) $auditId ?>&severity=<?= e($g['severity']) ?>" class="admin-btn">View Pages</a>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php if ($aiRecs && !empty($aiRecs['recommendations'])): ?>
<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">AI Search Readiness — Informal Assessment</h2>
    <p style="color:var(--admin-muted,#666);font-size:0.85rem;">Not an official Google or AI-provider metric — a heuristic assessment generated once per audit.</p>
    <ul>
        <?php foreach ($aiRecs['recommendations'] as $rec): ?>
            <li><?= e($rec) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
