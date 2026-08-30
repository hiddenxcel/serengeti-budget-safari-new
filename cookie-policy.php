<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'legal';
$altPath = 'cookie-policy.php';
$pageMetaTitle = 'cookies_meta_title';
$pageMetaDescription = 'cookies_meta_description';

require __DIR__ . '/includes/header.php';
?>

    <main>
        <section class="detail-section">
            <div class="container legal-body">
                <h1 class="section-title"><?= e(t('cookies_h1')) ?></h1>
                <p class="legal-updated"><?= e(t('legal_updated')) ?></p>
                <p><?= e(t('cookies_intro')) ?></p>

                <h2><?= e(t('cookies_h2_1')) ?></h2>
                <p><?= e(t('cookies_technical_intro')) ?></p>
                <div class="article-table-wrap">
                    <table class="article-table">
                        <thead>
                            <tr><th><?= e(t('cookies_th_name')) ?></th><th><?= e(t('cookies_th_purpose')) ?></th><th><?= e(t('cookies_th_duration')) ?></th></tr>
                        </thead>
                        <tbody>
                            <tr><td>sbs-lang</td><td><?= e(t('cookies_row_lang_purpose')) ?></td><td><?= e(t('cookies_row_lang_duration')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p><?= t('cookies_technical_note') ?></p>

                <h2><?= e(t('cookies_h2_2')) ?></h2>
                <p><?= e(t('cookies_third_party_intro')) ?></p>
                <ul>
                    <li><strong>Google Fonts</strong> — <?= e(t('cookies_gfonts_purpose')) ?>. <a href="https://policies.google.com/privacy" target="_blank" rel="noopener"><?= e(t('cookies_google_notice')) ?></a></li>
                    <li><strong>Font Awesome (Cloudflare CDN)</strong> — <?= e(t('cookies_fa_purpose')) ?>. <a href="https://www.cloudflare.com/privacypolicy/" target="_blank" rel="noopener"><?= e(t('cookies_cloudflare_notice')) ?></a></li>
                </ul>

                <h2><?= e(t('cookies_h2_3')) ?></h2>
                <p><?= e(t('cookies_embed_p1')) ?></p>

                <h2><?= e(t('cookies_h2_4')) ?></h2>
                <p><?= e(t('cookies_notuse_p1')) ?></p>

                <h2><?= e(t('cookies_h2_5')) ?></h2>
                <p><?= e(t('cookies_manage_intro')) ?></p>
                <ul>
                    <li><strong>Chrome:</strong> <?= e(t('cookies_manage_chrome')) ?></li>
                    <li><strong>Safari:</strong> <?= e(t('cookies_manage_safari')) ?></li>
                    <li><strong>Firefox:</strong> <?= e(t('cookies_manage_firefox')) ?></li>
                    <li><strong>Edge:</strong> <?= e(t('cookies_manage_edge')) ?></li>
                </ul>
                <p><?= e(t('cookies_manage_note')) ?></p>

                <h2><?= e(t('cookies_h2_6')) ?></h2>
                <p><?= t('cookies_contact_p1') ?></p>

                <p style="margin-top:2rem;">
                    <a href="<?= url('privacy-policy.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_privacy')) ?></a>
                    <a href="<?= url('terms-and-conditions.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_terms')) ?></a>
                </p>
            </div>
        </section>
    </main>

<?php
require __DIR__ . '/includes/footer.php';
?>
