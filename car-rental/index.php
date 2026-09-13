<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'car-rental';
$altPath = 'car-rental/';
$pageMetaTitle = 'carrental_meta_title';
$pageMetaDescription = 'carrental_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/team/ranger-clients-safari-vehicle-logo.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(badge_tagline('carrental_hero_badge')) ?></span>
                <h1><span><?= e(t('carrental_hero_title_1')) ?></span> <?= e(t('carrental_hero_title_2')) ?></h1>
                <p class="hero-sub"><?= e(t('carrental_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('carrental_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to rent a car with a driver.') ?>" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_why_badge')) ?></span>
                    <h2><?= e(t('carrental_why_title')) ?></h2>
                    <p><?= e(t('carrental_why_intro')) ?></p>
                </div>

                <div class="grid-3">
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/team/client-ranger-company-vehicle-2.jpg') ?>" alt="<?= e(t('carrental_why1_title')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('carrental_why1_title')) ?></h3>
                            <p><?= e(t('carrental_why1_desc')) ?></p>
                        </div>
                    </div>
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-3.jpg') ?>" alt="<?= e(t('carrental_why2_title')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('carrental_why2_title')) ?></h3>
                            <p><?= e(t('carrental_why2_desc')) ?></p>
                        </div>
                    </div>
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/team/clients-company-vehicle-portrait-2.jpg') ?>" alt="<?= e(t('carrental_why3_title')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('carrental_why3_title')) ?></h3>
                            <p><?= e(t('carrental_why3_desc')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_fleet_badge')) ?></span>
                    <h2><?= e(t('carrental_fleet_title')) ?></h2>
                    <p><?= e(t('carrental_fleet_intro')) ?></p>
                </div>

                <div class="route-grid featured">
                    <a href="<?= url('contact.php') ?>" class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-4.jpg') ?>" alt="<?= e(t('carrental_car1_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('carrental_car1_price')) ?></span>
                            <span class="route-card-success highest"><?= e(t('carrental_car1_seats')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('carrental_car1_tagline')) ?></span>
                            <h3><?= e(t('carrental_car1_name')) ?></h3>
                            <p><?= e(t('carrental_car1_desc')) ?></p>
                        </div>
                    </a>
                    <a href="<?= url('contact.php') ?>" class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-1.jpg') ?>" alt="<?= e(t('carrental_car2_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('carrental_car2_price')) ?></span>
                            <span class="route-card-success high"><?= e(t('carrental_car2_seats')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('carrental_car2_tagline')) ?></span>
                            <h3><?= e(t('carrental_car2_name')) ?></h3>
                            <p><?= e(t('carrental_car2_desc')) ?></p>
                        </div>
                    </a>
                </div>

                <p class="mt-3" style="margin-top:1.3rem;"><em><?= e(t('carrental_fleet_note')) ?></em></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <h2 class="section-title"><?= e(t('carrental_included_title')) ?></h2>
                <p class="subtitle"><?= e(t('carrental_included_subtitle')) ?></p>

                <div class="included-icon-grid">
                    <div>
                        <h3><?= e(t('carrental_included_heading')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_5')) ?></li>
                        </ul>
                    </div>
                    <div>
                        <h3><?= e(t('carrental_excluded_heading')) ?></h3>
                        <ul class="included-icon-list no">
                            <li><?= icon('times-circle') ?> <?= e(t('carrental_excluded_1')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('carrental_excluded_2')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('carrental_excluded_3')) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_uses_badge')) ?></span>
                    <h2><?= e(t('carrental_uses_title')) ?></h2>
                </div>
                <div class="grid-2">
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_use1_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_use1_title')) ?></h3>
                        <p><?= e(t('carrental_use1_desc')) ?></p>
                    </article>
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_use2_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_use2_title')) ?></h3>
                        <p><?= e(t('carrental_use2_desc')) ?></p>
                    </article>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <h2 class="section-title"><?= e(t('carrental_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a4')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('carrental_cta_title')) ?></h2>
            <p><?= e(t('carrental_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to rent a car with a driver.') ?>" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('carrental_cta_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('carrental_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
