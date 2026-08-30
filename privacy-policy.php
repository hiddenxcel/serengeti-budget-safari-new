<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'legal';
$altPath = 'privacy-policy.php';
$pageMetaTitle = 'privacy_meta_title';
$pageMetaDescription = 'privacy_meta_description';

require __DIR__ . '/includes/header.php';
?>

    <main>
        <section class="detail-section">
            <div class="container legal-body">
                <h1 class="section-title"><?= e(t('privacy_h1')) ?></h1>
                <p class="legal-updated"><?= e(t('legal_updated')) ?></p>
                <p><?= t('privacy_intro') ?></p>

                <h2><?= e(t('privacy_h2_1')) ?></h2>
                <p><strong>Serengeti Budget Safari</strong><br />
                    Arusha, Tanzania<br />
                    <?= e(t('legal_email_label')) ?>: <a href="mailto:serengetibudgetsafari@gmail.com">serengetibudgetsafari@gmail.com</a><br />
                    <?= e(t('legal_phone_label')) ?>: <a href="https://wa.me/255697612865" rel="noopener">+255 697 612 865</a></p>

                <h2><?= e(t('privacy_h2_2')) ?></h2>
                <h3><?= e(t('privacy_h3_1')) ?></h3>
                <ul>
                    <li><?= e(t('privacy_you_i1')) ?></li>
                    <li><?= e(t('privacy_you_i2')) ?></li>
                    <li><?= e(t('privacy_you_i3')) ?></li>
                    <li><?= e(t('privacy_you_i4')) ?></li>
                    <li><?= e(t('privacy_you_i5')) ?></li>
                </ul>
                <h3><?= e(t('privacy_h3_2')) ?></h3>
                <ul>
                    <li><?= e(t('privacy_auto_i1')) ?></li>
                    <li><?= e(t('privacy_auto_i2')) ?></li>
                    <li><?= e(t('privacy_auto_i3')) ?></li>
                </ul>

                <h2><?= e(t('privacy_h2_3')) ?></h2>
                <ul>
                    <li><?= t('privacy_why_i1') ?></li>
                    <li><?= t('privacy_why_i2') ?></li>
                    <li><?= t('privacy_why_i3') ?></li>
                    <li><?= t('privacy_why_i4') ?></li>
                </ul>
                <p><?= e(t('privacy_why_note')) ?></p>

                <h2><?= e(t('privacy_h2_4')) ?></h2>
                <p><?= e(t('privacy_share_intro')) ?></p>
                <ul>
                    <li><?= e(t('privacy_share_i1')) ?></li>
                    <li><?= e(t('privacy_share_i2')) ?></li>
                    <li><?= e(t('privacy_share_i3')) ?></li>
                    <li><?= e(t('privacy_share_i4')) ?></li>
                    <li><?= e(t('privacy_share_i5')) ?></li>
                </ul>
                <p><?= e(t('privacy_share_note')) ?></p>

                <h2><?= e(t('privacy_h2_5')) ?></h2>
                <ul>
                    <li><?= t('privacy_keep_i1') ?></li>
                    <li><?= t('privacy_keep_i2') ?></li>
                    <li><?= t('privacy_keep_i3') ?></li>
                </ul>

                <h2><?= e(t('privacy_h2_6')) ?></h2>
                <p><?= t('privacy_cookies_p1') ?> <a href="<?= url('cookie-policy.php') ?>"><?= e(t('privacy_cookies_link')) ?></a>.</p>

                <h2><?= e(t('privacy_h2_7')) ?></h2>
                <p><?= e(t('privacy_rights_intro')) ?></p>
                <ul>
                    <li><?= e(t('privacy_rights_i1')) ?></li>
                    <li><?= e(t('privacy_rights_i2')) ?></li>
                    <li><?= e(t('privacy_rights_i3')) ?></li>
                    <li><?= e(t('privacy_rights_i4')) ?></li>
                    <li><?= e(t('privacy_rights_i5')) ?></li>
                    <li><?= e(t('privacy_rights_i6')) ?></li>
                </ul>
                <p><?= t('privacy_rights_note') ?></p>

                <h2><?= e(t('privacy_h2_8')) ?></h2>
                <p><?= e(t('privacy_security_p1')) ?></p>

                <h2><?= e(t('privacy_h2_9')) ?></h2>
                <p><?= e(t('privacy_children_p1')) ?></p>

                <h2><?= e(t('privacy_h2_10')) ?></h2>
                <p><?= e(t('privacy_changes_p1')) ?></p>

                <div class="legal-contact">
                    <p><strong><?= e(t('legal_contact_title')) ?></strong><br />
                        <?= t('legal_contact_body') ?></p>
                </div>

                <p style="margin-top:2rem;">
                    <a href="<?= url('terms-and-conditions.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_terms')) ?></a>
                    <a href="<?= url('cookie-policy.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_cookies')) ?></a>
                </p>
            </div>
        </section>
    </main>

<?php
require __DIR__ . '/includes/footer.php';
?>
