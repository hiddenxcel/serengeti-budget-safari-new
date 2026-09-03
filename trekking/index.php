<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'trekking';
$altPath = 'trekking/';
$pageMetaTitle = 'trekking_meta_title';
$pageMetaDescription = 'trekking_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('mountain') ?> <?= e(t('trekking_hero_badge')) ?></span>
                <h1><span><?= e(t('trekking_hero_title_1')) ?></span> <?= e(t('trekking_hero_title_2')) ?></h1>
                <p class="hero-sub"><?= e(t('trekking_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('trekking_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('route') ?> <?= e(t('trekking_routes_badge')) ?></span>
                    <h2><?= e(t('trekking_routes_title')) ?></h2>
                    <p><?= e(t('trekking_routes_intro')) ?></p>
                </div>

                <div class="route-grid featured">
                    <a href="<?= url('contact.php') ?>" class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="<?= e(t('trekking_route_lemosho_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('trekking_route_lemosho_days')) ?></span>
                            <span class="route-card-success highest"><?= e(t('trekking_route_lemosho_success')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('trekking_route_lemosho_tagline')) ?></span>
                            <h3><?= e(t('trekking_route_lemosho_name')) ?></h3>
                            <p><?= e(t('trekking_route_lemosho_desc')) ?></p>
                        </div>
                    </a>
                    <a href="<?= url('contact.php') ?>" class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="<?= e(t('trekking_route_machame_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('trekking_route_machame_days')) ?></span>
                            <span class="route-card-success high"><?= e(t('trekking_route_machame_success')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('trekking_route_machame_tagline')) ?></span>
                            <h3><?= e(t('trekking_route_machame_name')) ?></h3>
                            <p><?= e(t('trekking_route_machame_desc')) ?></p>
                        </div>
                    </a>
                </div>

                <div class="route-grid">
                    <a href="<?= url('contact.php') ?>" class="route-card">
                        <div class="route-card-img">
                            <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="<?= e(t('trekking_route_northern_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('trekking_route_northern_days')) ?></span>
                            <span class="route-card-success highest"><?= e(t('trekking_route_northern_success')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('trekking_route_northern_tagline')) ?></span>
                            <h3><?= e(t('trekking_route_northern_name')) ?></h3>
                            <p><?= e(t('trekking_route_northern_desc')) ?></p>
                        </div>
                    </a>
                    <a href="<?= url('contact.php') ?>" class="route-card">
                        <div class="route-card-img">
                            <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="<?= e(t('trekking_route_rongai_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('trekking_route_rongai_days')) ?></span>
                            <span class="route-card-success good"><?= e(t('trekking_route_rongai_success')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('trekking_route_rongai_tagline')) ?></span>
                            <h3><?= e(t('trekking_route_rongai_name')) ?></h3>
                            <p><?= e(t('trekking_route_rongai_desc')) ?></p>
                        </div>
                    </a>
                    <a href="<?= url('contact.php') ?>" class="route-card">
                        <div class="route-card-img">
                            <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="<?= e(t('trekking_route_marangu_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('trekking_route_marangu_days')) ?></span>
                            <span class="route-card-success lower"><?= e(t('trekking_route_marangu_success')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('trekking_route_marangu_tagline')) ?></span>
                            <h3><?= e(t('trekking_route_marangu_name')) ?></h3>
                            <p><?= e(t('trekking_route_marangu_desc')) ?></p>
                        </div>
                    </a>
                </div>

                <p class="mt-3" style="margin-top:1.3rem;"><em><?= e(t('trekking_routes_note')) ?></em></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <h2 class="section-title"><?= e(t('trekking_included_title')) ?></h2>
                <p class="subtitle"><?= e(t('trekking_included_subtitle')) ?></p>

                <div class="included-icon-grid">
                    <div>
                        <h3><?= e(t('trekking_included_heading')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_5')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_6')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('trekking_included_7')) ?></li>
                        </ul>
                    </div>
                    <div>
                        <h3><?= e(t('trekking_excluded_heading')) ?></h3>
                        <ul class="included-icon-list no">
                            <li><?= icon('times-circle') ?> <?= e(t('trekking_excluded_1')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('trekking_excluded_2')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('trekking_excluded_3')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('trekking_excluded_4')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('trekking_excluded_5')) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('mountain-sun') ?> <?= e(t('trekking_other_badge')) ?></span>
                    <h2><?= e(t('trekking_other_title')) ?></h2>
                </div>
                <div class="grid-3">
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="<?= e(t('trekking_meru_name')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('trekking_meru_name')) ?></h3>
                            <p><?= e(t('trekking_meru_desc')) ?></p>
                        </div>
                    </div>
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="<?= e(t('trekking_lengai_name')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('trekking_lengai_name')) ?></h3>
                            <p><?= e(t('trekking_lengai_desc')) ?></p>
                        </div>
                    </div>
                    <div class="mountain-card">
                        <div class="mountain-card-img">
                            <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="<?= e(t('trekking_usambara_name')) ?>" loading="lazy" />
                        </div>
                        <div class="mountain-card-body">
                            <h3><?= e(t('trekking_usambara_name')) ?></h3>
                            <p><?= e(t('trekking_usambara_desc')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('book-open') ?> <?= e(t('trekking_guide_badge')) ?></span>
                    <h2><?= e(t('trekking_guide_title')) ?></h2>
                    <p><?= e(t('trekking_guide_intro')) ?></p>
                </div>
                <div class="grid-2">
                    <article class="card">
                        <span class="badge"><?= e(t('trekking_guide_kili_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('trekking_guide_kili_title')) ?></h3>
                        <p><?= e(t('trekking_guide_kili_desc')) ?></p>
                        <a href="<?= url('parks/kilimanjaro-national-park.php') ?>" class="btn btn-primary btn-sm"><?= e(t('trekking_guide_kili_cta')) ?> <?= icon('arrow-right') ?></a>
                    </article>
                    <article class="card">
                        <span class="badge"><?= e(t('trekking_guide_meru_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('trekking_guide_meru_title')) ?></h3>
                        <p><?= e(t('trekking_guide_meru_desc')) ?></p>
                        <a href="<?= url('parks/arusha-national-park.php') ?>" class="btn btn-primary btn-sm"><?= e(t('trekking_guide_meru_cta')) ?> <?= icon('arrow-right') ?></a>
                    </article>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <h2 class="section-title"><?= e(t('trekking_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('trekking_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('trekking_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('trekking_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('trekking_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('trekking_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('trekking_faq_a3')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('trekking_cta_title')) ?></h2>
            <p><?= e(t('trekking_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('trekking_cta_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('trekking_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
