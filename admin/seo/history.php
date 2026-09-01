<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Audit History';

$audits = db()->query(
    "SELECT * FROM seo_audits WHERE status IN ('completed','failed','cancelled') ORDER BY started_at DESC LIMIT 50"
)->fetchAll();

// Latest-vs-previous diff (only meaningful when at least 2 completed audits exist)
$completed = array_values(array_filter($audits, static fn($a) => $a['status'] === 'completed'));
$diff = null;
if (count($completed) >= 2) {
    $latest = $completed[0];
    $previous = $completed[1];

    $latestIssues = db()->prepare('SELECT issue_code FROM seo_issues WHERE audit_id = ?');
    $latestIssues->execute([$latest['id']]);
    $latestCodes = array_count_values(array_column($latestIssues->fetchAll(), 'issue_code'));

    $prevIssues = db()->prepare('SELECT issue_code FROM seo_issues WHERE audit_id = ?');
    $prevIssues->execute([$previous['id']]);
    $prevCodes = array_count_values(array_column($prevIssues->fetchAll(), 'issue_code'));

    $newCodes = array_diff_key($latestCodes, $prevCodes);
    $resolvedCodes = array_diff_key($prevCodes, $latestCodes);

    $diff = [
        'score_delta' => (int) $latest['overall_score'] - (int) $previous['overall_score'],
        'previous_score' => (int) $previous['overall_score'],
        'latest_score' => (int) $latest['overall_score'],
        'new_issue_types' => $newCodes,
        'resolved_issue_types' => $resolvedCodes,
    ];
}

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if ($diff): ?>
<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Latest vs Previous</h2>
    <p style="font-size:1.5rem;font-weight:700;">
        <?= (int) $diff['previous_score'] ?> → <?= (int) $diff['latest_score'] ?>
        <span style="font-size:1rem;color:<?= $diff['score_delta'] >= 0 ? 'var(--admin-success,green)' : 'var(--admin-danger,red)' ?>;">
            (<?= $diff['score_delta'] >= 0 ? '+' : '' ?><?= $diff['score_delta'] ?>)
        </span>
    </p>
    <?php if ($diff['new_issue_types']): ?>
        <p><strong>New issue types:</strong> <?= implode(', ', array_map(static fn($c, $n) => "$c ($n)", array_keys($diff['new_issue_types']), $diff['new_issue_types'])) ?></p>
    <?php endif; ?>
    <?php if ($diff['resolved_issue_types']): ?>
        <p><strong>Resolved issue types:</strong> <?= implode(', ', array_map(static fn($c, $n) => "$c ($n)", array_keys($diff['resolved_issue_types']), $diff['resolved_issue_types'])) ?></p>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">All Audits</h2>
    <?php if (!$audits): ?>
        <div class="admin-empty-state">No audits have been run yet.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Date</th><th>Status</th><th>Target</th><th>Pages Crawled</th><th>Score</th><th></th></tr></thead>
            <tbody>
                <?php foreach ($audits as $a): ?>
                <tr>
                    <td><?= e($a['started_at']) ?></td>
                    <td><span class="admin-badge <?= $a['status'] === 'completed' ? 'published' : ($a['status'] === 'failed' ? 'draft' : 'archived') ?>"><?= e(ucfirst($a['status'])) ?></span></td>
                    <td><?= e($a['target_url']) ?></td>
                    <td><?= (int) $a['pages_crawled'] ?></td>
                    <td><?= $a['overall_score'] === null ? '—' : (int) $a['overall_score'] . '/100' ?></td>
                    <td><a href="<?= admin_base_url() ?>/seo/pages.php?audit_id=<?= (int) $a['id'] ?>" class="admin-btn">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
