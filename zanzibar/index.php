<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'zanzibar';
$altPath = 'zanzibar/';
$pageMetaTitle = 'zanzibar_meta_title';
$pageMetaDescription = 'zanzibar_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(badge_tagline('zanzibar_hero_badge')) ?></span>
                <h1><span><?= e(t('zanzibar_hero_title_1')) ?></span> <?= e(t('zanzibar_hero_title_2')) ?></h1>
                <p class="hero-sub"><?= e(t('zanzibar_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('zanzibar_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="glance-strip">
            <div class="glance-item">
                <?= icon('moon') ?>
                <div><strong><?= e(t('zanzibar_glance_duration')) ?></strong><span><?= e(t('zanzibar_glance_duration_label')) ?></span></div>
            </div>
            <div class="glance-item">
                <?= icon('plane') ?>
                <div><strong><?= e(t('zanzibar_glance_flight')) ?></strong><span><?= e(t('zanzibar_glance_flight_label')) ?></span></div>
            </div>
            <div class="glance-item">
                <?= icon('sun') ?>
                <div><strong><?= e(t('zanzibar_glance_temp')) ?></strong><span><?= e(t('zanzibar_glance_temp_label')) ?></span></div>
            </div>
            <div class="glance-item">
                <?= icon('link') ?>
                <div><strong><?= e(t('zanzibar_glance_pairs')) ?></strong><span><?= e(t('zanzibar_glance_pairs_label')) ?></span></div>
            </div>
        </div>
    </div>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_why_badge')) ?></span>
                    <h2><?= e(t('zanzibar_why_title')) ?></h2>
                </div>

                <div class="why-add-grid">
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('arrows-left-right') ?></span>
                        <h3><?= e(t('zanzibar_why_1_title')) ?></h3>
                        <p><?= e(t('zanzibar_why_1_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('earth-africa') ?></span>
                        <h3><?= e(t('zanzibar_why_2_title')) ?></h3>
                        <p><?= e(t('zanzibar_why_2_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('suitcase-rolling') ?></span>
                        <h3><?= e(t('zanzibar_why_3_title')) ?></h3>
                        <p><?= e(t('zanzibar_why_3_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_gallery_badge')) ?></span>
                    <h2><?= e(t('zanzibar_gallery_title')) ?></h2>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Savanna sunrise before the flight to Zanzibar" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="Elephant family at sunset" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater panorama" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Zebras on the savanna plains" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Guests watching hippos" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" alt="Elephant close-up" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_beaches_badge')) ?></span>
                    <h2><?= e(t('zanzibar_beaches_title')) ?></h2>
                    <p><?= e(t('zanzibar_beaches_intro')) ?></p>
                </div>

                <div class="grid-3">
                    <div class="beach-card">
                        <div class="beach-card-img">
                            <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="<?= e(t('zanzibar_beach_north_name')) ?>" loading="lazy" />
                            <span class="beach-card-region"><?= e(t('zanzibar_beach_north_region')) ?></span>
                        </div>
                        <div class="beach-card-body">
                            <h3><?= e(t('zanzibar_beach_north_name')) ?></h3>
                            <p><?= e(t('zanzibar_beach_north_desc')) ?></p>
                            <span class="beach-card-best"><?= e(t('zanzibar_beach_north_best')) ?></span>
                        </div>
                    </div>
                    <div class="beach-card">
                        <div class="beach-card-img">
                            <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="<?= e(t('zanzibar_beach_se_name')) ?>" loading="lazy" />
                            <span class="beach-card-region"><?= e(t('zanzibar_beach_se_region')) ?></span>
                        </div>
                        <div class="beach-card-body">
                            <h3><?= e(t('zanzibar_beach_se_name')) ?></h3>
                            <p><?= e(t('zanzibar_beach_se_desc')) ?></p>
                            <span class="beach-card-best"><?= e(t('zanzibar_beach_se_best')) ?></span>
                        </div>
                    </div>
                    <div class="beach-card">
                        <div class="beach-card-img">
                            <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="<?= e(t('zanzibar_beach_east_name')) ?>" loading="lazy" />
                            <span class="beach-card-region"><?= e(t('zanzibar_beach_east_region')) ?></span>
                        </div>
                        <div class="beach-card-body">
                            <h3><?= e(t('zanzibar_beach_east_name')) ?></h3>
                            <p><?= e(t('zanzibar_beach_east_desc')) ?></p>
                            <span class="beach-card-best"><?= e(t('zanzibar_beach_east_best')) ?></span>
                        </div>
                    </div>
                </div>

                <div class="alert" style="background:rgba(41,128,185,.08);border-left:4px solid #2980b9;border-radius:var(--radius-sm);padding:1rem 1.2rem;margin:1.6rem 0;">
                    <p style="margin:0;"><?= t('zanzibar_tide_note') ?></p>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_excursions_badge')) ?></span>
                    <h2><?= e(t('zanzibar_excursions_title')) ?></h2>
                </div>
                <div class="grid-3">
                    <div class="info-card">
                        <span class="icon-wrap"><?= icon('city') ?></span>
                        <h3><?= e(t('zanzibar_exc_stonetown_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_stonetown_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <span class="icon-wrap"><i class="fas fa-pepper-hot"></i></span>
                        <h3><?= e(t('zanzibar_exc_spice_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_spice_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <span class="icon-wrap"><?= icon('sailboat') ?></span>
                        <h3><?= e(t('zanzibar_exc_safariblue_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_safariblue_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <span class="icon-wrap"><?= icon('tree') ?></span>
                        <h3><?= e(t('zanzibar_exc_jozani_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_jozani_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <span class="icon-wrap"><?= icon('fish') ?></span>
                        <h3><?= e(t('zanzibar_exc_mnemba_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_mnemba_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <span class="icon-wrap"><i class="fas fa-dungeon"></i></span>
                        <h3><?= e(t('zanzibar_exc_prison_title')) ?></h3>
                        <p><?= e(t('zanzibar_exc_prison_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_when_badge')) ?></span>
                    <h2><?= e(t('zanzibar_when_title')) ?></h2>
                </div>
                <div class="month-card-grid">
                    <div class="month-card">
                        <div class="month-icon">☀️</div>
                        <h4><?= e(t('zanzibar_when_dry_period')) ?></h4>
                        <div class="month-temp"><?= e(t('zanzibar_when_dry_temp')) ?></div>
                        <div class="month-desc"><?= e(t('zanzibar_when_dry_desc')) ?></div>
                        <span class="month-tag good"><?= e(t('zanzibar_when_dry_tag')) ?></span>
                    </div>
                    <div class="month-card">
                        <div class="month-icon">🌤️</div>
                        <h4><?= e(t('zanzibar_when_summer_period')) ?></h4>
                        <div class="month-temp"><?= e(t('zanzibar_when_summer_temp')) ?></div>
                        <div class="month-desc"><?= e(t('zanzibar_when_summer_desc')) ?></div>
                        <span class="month-tag good"><?= e(t('zanzibar_when_summer_tag')) ?></span>
                    </div>
                    <div class="month-card">
                        <div class="month-icon">🌧️</div>
                        <h4><?= e(t('zanzibar_when_long_rains_period')) ?></h4>
                        <div class="month-temp"><?= e(t('zanzibar_when_long_rains_temp')) ?></div>
                        <div class="month-desc"><?= e(t('zanzibar_when_long_rains_desc')) ?></div>
                        <span class="month-tag rain"><?= e(t('zanzibar_when_long_rains_tag')) ?></span>
                    </div>
                    <div class="month-card">
                        <div class="month-icon">🌦️</div>
                        <h4><?= e(t('zanzibar_when_nov_period')) ?></h4>
                        <div class="month-temp"><?= e(t('zanzibar_when_nov_temp')) ?></div>
                        <div class="month-desc"><?= e(t('zanzibar_when_nov_desc')) ?></div>
                        <span class="month-tag mid"><?= e(t('zanzibar_when_nov_tag')) ?></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="featured-package-banner">
                    <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="<?= e(t('zanzibar_featured_title')) ?>" loading="lazy" />
                    <div class="featured-package-content">
                        <span class="featured-package-badge"><?= e(t('zanzibar_featured_badge')) ?></span>
                        <h3><?= e(t('zanzibar_featured_title')) ?></h3>
                        <p><?= e(t('zanzibar_featured_desc')) ?></p>
                        <div class="featured-package-price"><?= e(t('zanzibar_featured_price')) ?></div>
                        <a href="<?= url('safari/') ?>" class="btn btn-primary"><?= e(t('zanzibar_featured_cta')) ?> <?= icon('arrow-right') ?></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('zanzibar_practical_badge')) ?></span>
                    <h2><?= e(t('zanzibar_practical_title')) ?></h2>
                </div>
                <div class="grid-2">
                    <div class="info-card">
                        <h3><?= e(t('zanzibar_practical_entry_title')) ?></h3>
                        <p><?= e(t('zanzibar_practical_entry_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('zanzibar_practical_dress_title')) ?></h3>
                        <p><?= e(t('zanzibar_practical_dress_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('zanzibar_practical_flight_title')) ?></h3>
                        <p><?= e(t('zanzibar_practical_flight_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('zanzibar_practical_malaria_title')) ?></h3>
                        <p><?= e(t('zanzibar_practical_malaria_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <h2 class="section-title"><?= e(t('zanzibar_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('zanzibar_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('zanzibar_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('zanzibar_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('zanzibar_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('zanzibar_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('zanzibar_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('zanzibar_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('zanzibar_faq_a4')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('zanzibar_cta_title')) ?></h2>
            <p><?= e(t('zanzibar_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('zanzibar_cta_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('zanzibar_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
