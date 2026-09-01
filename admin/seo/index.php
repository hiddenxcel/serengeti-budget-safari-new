<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/seo-issues.php';

require_admin();

$pageTitle = 'SEO Health';

$latest = db()->query(
    "SELECT * FROM seo_audits WHERE status = 'completed' ORDER BY completed_at DESC LIMIT 1"
)->fetch();

$issues = [];
$recommendations = [];
$counts = ['critical' => 0, 'warning' => 0, 'info' => 0];

if ($latest) {
    $issuesStmt = db()->prepare('SELECT * FROM seo_issues WHERE audit_id = ?');
    $issuesStmt->execute([$latest['id']]);
    $issues = $issuesStmt->fetchAll();

    foreach ($issues as $issue) {
        $counts[$issue['severity']]++;
    }

    $recommendations = seo_issues_group_for_recommendations(array_map(static function ($i) {
        return ['issue_code' => $i['issue_code'], 'category' => $i['category'], 'severity' => $i['severity'], 'message' => $i['message']];
    }, $issues));
}

$scoreLabels = [
    'score_technical' => 'Technical', 'score_onpage' => 'On-Page', 'score_content' => 'Content',
    'score_indexability' => 'Indexability', 'score_links' => 'Links', 'score_images' => 'Images',
    'score_structured_data' => 'Structured Data', 'score_performance' => 'Performance',
];

function seo_health_label(int $score): string
{
    if ($score >= 80) return 'Good';
    if ($score >= 50) return 'Needs Work';
    return 'Poor';
}

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div></div>
    <a href="<?= admin_base_url() ?>/seo/run-audit.php" class="admin-btn primary">Run Full Audit</a>
</div>

<?php if (!$latest): ?>
    <div class="admin-card">
        <div class="admin-empty-state">No completed audit yet. Configure a website URL in <a href="<?= admin_base_url() ?>/seo/settings.php">SEO Settings</a>, then run your first audit.</div>
    </div>
<?php else: ?>
    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">SEO Health Score</h2>
        <div style="font-size:2.5rem;font-weight:700;"><?= (int) $latest['overall_score'] ?> / 100</div>
        <div style="font-size:1rem;color:var(--admin-muted,#666);"><?= e(seo_health_label((int) $latest['overall_score'])) ?></div>
        <?php if (!$latest['performance_scored']): ?>
            <p style="margin-top:0.5rem;font-size:0.85rem;color:var(--admin-muted,#666);">Performance not included — configure PageSpeed Insights API in <a href="<?= admin_base_url() ?>/seo/settings.php">Settings</a> to add this category.</p>
        <?php endif; ?>
        <p style="font-size:0.85rem;color:var(--admin-muted,#666);">Last audit: <?= e($latest['completed_at']) ?> · <?= (int) $latest['pages_crawled'] ?> pages crawled, <?= (int) $latest['pages_discovered'] ?> discovered.</p>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Category Breakdown</h2>
        <div class="admin-stats-grid">
            <?php foreach ($scoreLabels as $col => $label): ?>
                <div class="admin-stat-card">
                    <div class="admin-stat-number"><?= $latest[$col] === null ? 'N/A' : (int) $latest[$col] ?></div>
                    <div class="admin-stat-label"><?= e($label) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Issues</h2>
        <p>
            <span class="admin-badge draft">Critical: <?= $counts['critical'] ?></span>
            <span class="admin-badge published">Warning: <?= $counts['warning'] ?></span>
            <span class="admin-badge archived">Info: <?= $counts['info'] ?></span>
        </p>
        <a href="<?= admin_base_url() ?>/seo/issues.php?audit_id=<?= (int) $latest['id'] ?>" class="admin-btn">View All Issues</a>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Top Recommendations</h2>
        <?php if (!$recommendations): ?>
            <div class="admin-empty-state">No issues found.</div>
        <?php else: ?>
            <ul style="list-style:none;padding:0;margin:0;">
                <?php foreach (array_slice($recommendations, 0, 5) as $rec): ?>
                    <li style="padding:0.5rem 0;border-bottom:1px solid #eee;">
                        <span class="admin-badge <?= $rec['severity'] === 'critical' ? 'draft' : ($rec['severity'] === 'warning' ? 'published' : 'archived') ?>"><?= e(ucfirst($rec['severity'])) ?></span>
                        <strong><?= e(str_replace('_', ' ', ucfirst($rec['issue_code']))) ?></strong>
                        — <?= (int) $rec['affected_count'] ?> affected page(s)
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="<?= admin_base_url() ?>/seo/recommendations.php?audit_id=<?= (int) $latest['id'] ?>" class="admin-btn" style="margin-top:0.75rem;">View All Recommendations</a>
        <?php endif; ?>
    </div>

    <div class="admin-toolbar">
        <a href="<?= admin_base_url() ?>/seo/pages.php?audit_id=<?= (int) $latest['id'] ?>" class="admin-btn">Pages</a>
        <a href="<?= admin_base_url() ?>/seo/history.php" class="admin-btn">History</a>
        <a href="<?= admin_base_url() ?>/seo/settings.php" class="admin-btn">Settings</a>
        <a href="<?= admin_base_url() ?>/seo/export-report.php?audit_id=<?= (int) $latest['id'] ?>" class="admin-btn">Export Report</a>
    </div>
<?php endif; ?>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
