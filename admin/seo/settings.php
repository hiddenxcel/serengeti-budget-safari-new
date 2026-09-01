<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'SEO Settings';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $websiteUrl = trim((string) ($_POST['website_url'] ?? ''));
        $maxPages = max(1, min(1000, (int) ($_POST['max_pages'] ?? 200)));
        $maxDepth = max(1, min(50, (int) ($_POST['max_depth'] ?? 10)));
        $timeout = max(1, min(60, (int) ($_POST['request_timeout_seconds'] ?? 10)));

        $validated = filter_var($websiteUrl, FILTER_VALIDATE_URL);
        $scheme = $validated ? parse_url($validated, PHP_URL_SCHEME) : null;

        if ($websiteUrl === '' || !$validated || !in_array($scheme, ['http', 'https'], true)) {
            $errors[] = 'Website URL must be a valid http:// or https:// address.';
        }

        if (!$errors) {
            db()->prepare(
                'UPDATE seo_settings SET website_url = ?, max_pages = ?, max_depth = ?, request_timeout_seconds = ? WHERE id = 1'
            )->execute([rtrim($websiteUrl, '/'), $maxPages, $maxDepth, $timeout]);

            header('Location: ' . admin_base_url() . '/seo/settings.php?saved=1');
            exit;
        }
    }
}

$settings = db()->query('SELECT * FROM seo_settings WHERE id = 1')->fetch();
$pagespeedConfigured = defined('PAGESPEED_API_KEY') && PAGESPEED_API_KEY !== '';
$groqConfigured = defined('GROQ_API_KEY') && GROQ_API_KEY !== '';

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if (!empty($_GET['saved'])): ?>
    <div class="admin-success-msg">Settings saved.</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<form method="post" action="">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Crawl Target</h2>
        <div class="admin-form-group">
            <label for="website_url">Website URL to audit</label>
            <input type="text" id="website_url" name="website_url" required value="<?= e($settings['website_url'] ?? '') ?>" placeholder="http://localhost:8080/serengeti-new" />
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="max_pages">Maximum pages</label>
                <input type="number" id="max_pages" name="max_pages" min="1" max="1000" value="<?= e((string) ($settings['max_pages'] ?? 200)) ?>" />
            </div>
            <div class="admin-form-group">
                <label for="max_depth">Maximum crawl depth</label>
                <input type="number" id="max_depth" name="max_depth" min="1" max="50" value="<?= e((string) ($settings['max_depth'] ?? 10)) ?>" />
            </div>
            <div class="admin-form-group">
                <label for="request_timeout_seconds">Request timeout (seconds)</label>
                <input type="number" id="request_timeout_seconds" name="request_timeout_seconds" min="1" max="60" value="<?= e((string) ($settings['request_timeout_seconds'] ?? 10)) ?>" />
            </div>
        </div>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Optional Integrations</h2>
        <p style="margin:0 0 0.5rem;">PageSpeed Insights API: <strong><?= $pagespeedConfigured ? 'Configured' : 'Not configured' ?></strong></p>
        <?php if (!$pagespeedConfigured): ?>
            <p style="margin:0 0 0.5rem;color:var(--admin-muted,#666);font-size:0.9rem;">Add <code>define('PAGESPEED_API_KEY', '...');</code> to <code>config/secrets.php</code> to enable the Performance category. Without it, Performance is excluded from the score rather than shown as zero.</p>
        <?php endif; ?>
        <p style="margin:0 0 0.5rem;">Groq AI (meta/alt-text suggestions): <strong><?= $groqConfigured ? 'Configured' : 'Not configured' ?></strong></p>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn primary">Save Settings</button>
    </div>
</form>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
