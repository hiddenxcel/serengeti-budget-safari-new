<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'legal';
$altPath = 'terms-and-conditions.php';
$pageMetaTitle = 'terms_meta_title';
$pageMetaDescription = 'terms_meta_description';

require __DIR__ . '/includes/header.php';
?>

    <main>
        <section class="detail-section">
            <div class="container legal-body">
                <h1 class="section-title"><?= e(t('terms_h1')) ?></h1>
                <p class="legal-updated"><?= e(t('legal_updated')) ?></p>
                <p><?= t('terms_intro') ?></p>

                <div class="legal-note">
                    <p><strong><?= e(t('terms_note_title')) ?></strong> <?= e(t('terms_note_body')) ?></p>
                </div>

                <h2><?= e(t('terms_h2_1')) ?></h2>
                <ul>
                    <li><?= e(t('terms_booking_i1')) ?></li>
                    <li><?= e(t('terms_booking_i2')) ?></li>
                    <li><?= e(t('terms_booking_i3')) ?></li>
                    <li><?= e(t('terms_booking_i4')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_2')) ?></h2>
                <ul>
                    <li><?= e(t('terms_prices_i1')) ?></li>
                    <li><?= e(t('terms_prices_i2')) ?></li>
                    <li><?= e(t('terms_prices_i3')) ?></li>
                    <li><?= e(t('terms_prices_i4')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_3')) ?></h2>
                <ul>
                    <li><strong><?= e(t('terms_pay_deposit_t')) ?></strong> <?= e(t('terms_pay_deposit_d')) ?></li>
                    <li><strong><?= e(t('terms_pay_balance_t')) ?></strong> <?= e(t('terms_pay_balance_d')) ?></li>
                    <li><?= e(t('terms_pay_i3')) ?></li>
                    <li><?= e(t('terms_pay_i4')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_4')) ?></h2>
                <p><?= e(t('terms_cancel_intro')) ?></p>
                <div class="article-table-wrap">
                    <table class="article-table">
                        <thead>
                            <tr><th><?= e(t('terms_cancel_th1')) ?></th><th><?= e(t('terms_cancel_th2')) ?></th></tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('terms_cancel_r1_a')) ?></td><td><?= e(t('terms_cancel_r1_b')) ?></td></tr>
                            <tr><td><?= e(t('terms_cancel_r2_a')) ?></td><td><?= e(t('terms_cancel_r2_b')) ?></td></tr>
                            <tr><td><?= e(t('terms_cancel_r3_a')) ?></td><td><?= e(t('terms_cancel_r3_b')) ?></td></tr>
                            <tr><td><?= e(t('terms_cancel_r4_a')) ?></td><td><?= e(t('terms_cancel_r4_b')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p><?= e(t('terms_cancel_note')) ?></p>

                <h2><?= e(t('terms_h2_5')) ?></h2>
                <ul>
                    <li><?= e(t('terms_changes_i1')) ?></li>
                    <li><?= e(t('terms_changes_i2')) ?></li>
                    <li><?= e(t('terms_changes_i3')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_6')) ?></h2>
                <p><?= t('terms_insurance_p1') ?></p>

                <h2><?= e(t('terms_h2_7')) ?></h2>
                <ul>
                    <li><?= e(t('terms_docs_i1')) ?></li>
                    <li><?= e(t('terms_docs_i2')) ?></li>
                    <li><?= e(t('terms_docs_i3')) ?></li>
                    <li><?= e(t('terms_docs_i4')) ?></li>
                    <li><?= e(t('terms_docs_i5')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_8')) ?></h2>
                <ul>
                    <li><?= e(t('terms_liability_i1')) ?></li>
                    <li><?= e(t('terms_liability_i2')) ?></li>
                    <li><?= e(t('terms_liability_i3')) ?></li>
                    <li><?= e(t('terms_liability_i4')) ?></li>
                    <li><?= e(t('terms_liability_i5')) ?></li>
                </ul>

                <h2><?= e(t('terms_h2_9')) ?></h2>
                <p><?= e(t('terms_conduct_p1')) ?></p>

                <h2><?= e(t('terms_h2_10')) ?></h2>
                <p><?= t('terms_complaints_p1') ?></p>

                <h2><?= e(t('terms_h2_11')) ?></h2>
                <p><?= e(t('terms_law_p1')) ?></p>

                <div class="legal-contact">
                    <p><strong><?= e(t('terms_contact_title')) ?></strong><br />
                        <?= t('terms_contact_body') ?></p>
                </div>

                <p style="margin-top:2rem;">
                    <a href="<?= url('privacy-policy.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_privacy')) ?></a>
                    <a href="<?= url('cookie-policy.php') ?>" class="btn btn-outline btn-sm"><?= e(t('legal_nav_cookies')) ?></a>
                </p>
            </div>
        </section>
    </main>

<?php
require __DIR__ . '/includes/footer.php';
?>
