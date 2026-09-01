<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageId = (int) ($_GET['page_id'] ?? 0);

$stmt = db()->prepare('SELECT * FROM seo_pages WHERE id = ?');
$stmt->execute([$pageId]);
$page = $stmt->fetch();

if (!$page) {
    http_response_code(404);
    exit('Page not found.');
}

$facts = json_decode((string) $page['facts_json'], true) ?: [];

$issuesStmt = db()->prepare('SELECT * FROM seo_issues WHERE page_id = ? ORDER BY FIELD(severity, "critical", "warning", "info")');
$issuesStmt->execute([$pageId]);
$issues = $issuesStmt->fetchAll();

$pageTitle = 'Page Detail';
$groqConfigured = defined('GROQ_API_KEY') && GROQ_API_KEY !== '';

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;word-break:break-all;"><?= e($page['url']) ?></h2>
    <p>HTTP Status: <strong><?= (int) $page['http_status'] ?></strong> · Response time: <?= (int) $page['response_time_ms'] ?>ms · Size: <?= (int) $page['content_bytes'] ?> bytes</p>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">On-Page</h2>
    <p><strong>Title</strong> (<?= (int) $page['title_length'] ?> chars): <?= e((string) $page['title']) ?></p>
    <p><strong>Meta Description</strong> (<?= (int) $page['meta_description_length'] ?> chars): <?= e((string) $page['meta_description']) ?></p>
    <p><strong>H1 count:</strong> <?= (int) $page['h1_count'] ?> · <strong>Word count:</strong> <?= (int) $page['word_count'] ?></p>
    <p><strong>Canonical:</strong> <?= e((string) $page['canonical_url']) ?></p>
    <p><strong>Robots:</strong> <?= $page['is_noindex'] ? 'noindex' : 'indexable' ?></p>
    <?php if ($groqConfigured): ?>
        <button type="button" class="admin-btn" id="suggestMetaBtn">Suggest improved title/description with AI</button>
        <div id="suggestMetaResult" style="margin-top:0.5rem;"></div>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Heading Structure</h2>
    <?php if (empty($facts['headings'])): ?>
        <div class="admin-empty-state">No headings found.</div>
    <?php else: ?>
        <ul>
            <?php foreach ($facts['headings'] as $h): ?>
                <li>H<?= (int) $h['level'] ?>: <?= e($h['text']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Hreflang</h2>
    <?php if (empty($facts['hreflang'])): ?>
        <div class="admin-empty-state">No hreflang tags found.</div>
    <?php else: ?>
        <ul>
            <?php foreach ($facts['hreflang'] as $lang => $href): ?>
                <li><?= e($lang) ?>: <?= e($href) ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Reciprocity: <?= $page['hreflang_ok'] === null ? 'not checked' : ($page['hreflang_ok'] ? 'OK' : 'FAILED') ?></p>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Open Graph / Twitter</h2>
    <ul>
        <?php foreach (($facts['og'] ?? []) as $k => $v): ?>
            <li><?= e($k) ?>: <?= e((string) $v) ?></li>
        <?php endforeach; ?>
        <?php foreach (($facts['twitter'] ?? []) as $k => $v): ?>
            <li><?= e($k) ?>: <?= e((string) $v) ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Structured Data</h2>
    <p>Types found: <?= e(implode(', ', $facts['schema_types'] ?? []) ?: 'none') ?> — <?= !empty($facts['schema_valid']) ? 'valid' : 'invalid/missing fields' ?></p>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Images (<?= (int) $page['image_count'] ?>, <?= (int) $page['images_missing_alt'] ?> missing alt)</h2>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Src</th><th>Alt</th><th>Dimensions</th><th>Lazy</th><th></th></tr></thead>
            <tbody>
                <?php foreach (($facts['images'] ?? []) as $i => $img): ?>
                <tr>
                    <td style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= e($img['src']) ?></td>
                    <td><?= $img['has_alt'] ? e($img['alt']) : '<span class="admin-badge draft">missing</span>' ?></td>
                    <td><?= ($img['has_width'] && $img['has_height']) ? 'set' : 'missing' ?></td>
                    <td><?= $img['is_lazy'] ? 'yes' : 'no' ?></td>
                    <td>
                        <?php if (!$img['has_alt'] && $groqConfigured): ?>
                            <button type="button" class="admin-btn suggest-alt-btn" data-src="<?= e($img['src']) ?>" data-index="<?= $i ?>">Suggest alt text</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="suggestAltResult"></div>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Issues on this page</h2>
    <?php if (!$issues): ?>
        <div class="admin-empty-state">No issues found for this page.</div>
    <?php else: ?>
        <ul style="list-style:none;padding:0;">
            <?php foreach ($issues as $issue): ?>
                <li style="padding:0.5rem 0;border-bottom:1px solid #eee;">
                    <span class="admin-badge <?= $issue['severity'] === 'critical' ? 'draft' : ($issue['severity'] === 'warning' ? 'published' : 'archived') ?>"><?= e(ucfirst($issue['severity'])) ?></span>
                    <?= e($issue['message']) ?>
                    <?php if ($issue['target_url']): ?>
                        <br /><small>→ <?= e($issue['target_url']) ?><?= $issue['anchor_text'] ? ' ("' . e($issue['anchor_text']) . '")' : '' ?></small>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php if ($groqConfigured): ?>
<script>
var csrfToken = <?= json_encode(csrf_token()) ?>;

var suggestMetaBtn = document.getElementById('suggestMetaBtn');
if (suggestMetaBtn) {
    suggestMetaBtn.addEventListener('click', function () {
        var resultBox = document.getElementById('suggestMetaResult');
        resultBox.textContent = 'Thinking...';
        var body = new URLSearchParams();
        body.set('csrf_token', csrfToken);
        body.set('page_id', <?= (int) $pageId ?>);
        fetch('suggest-meta.php', { method: 'POST', body: body })
            .then(function (r) { return r.json(); })
            .then(function (json) {
                if (!json.ok) { resultBox.textContent = json.error || 'Failed.'; return; }
                resultBox.innerHTML = '<strong>Suggested title:</strong> ' + json.data.suggested_title +
                    '<br><strong>Suggested description:</strong> ' + json.data.suggested_description;
            })
            .catch(function () { resultBox.textContent = 'Could not reach the server.'; });
    });
}

document.querySelectorAll('.suggest-alt-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var resultBox = document.getElementById('suggestAltResult');
        resultBox.textContent = 'Thinking...';
        var body = new URLSearchParams();
        body.set('csrf_token', csrfToken);
        body.set('page_id', <?= (int) $pageId ?>);
        body.set('image_src', btn.dataset.src);
        fetch('suggest-alt-text.php', { method: 'POST', body: body })
            .then(function (r) { return r.json(); })
            .then(function (json) {
                if (!json.ok) { resultBox.textContent = json.error || 'Failed.'; return; }
                resultBox.innerHTML = '<strong>Suggested alt text for ' + btn.dataset.src + ':</strong> ' + json.data.suggested_alt +
                    '<br><small>AI suggestion based on filename/context — verify against the actual image.</small>';
            })
            .catch(function () { resultBox.textContent = 'Could not reach the server.'; });
    });
});
</script>
<?php endif; ?>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
