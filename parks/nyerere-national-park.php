<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/nyerere-national-park.php';
$pageMetaTitle = 'nyerere_meta_title';
$pageMetaDescription = 'nyerere_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-water"></i> <?= e(t('nyerere_hero_badge')) ?></span>
                <h1><?= e(t('nyerere_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('nyerere_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('nyerere_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-circle-info"></i> <?= e(t('nyerere_intro_badge')) ?></span>
                    <h2><?= e(t('nyerere_intro_title')) ?></h2>
                </div>
                <p><?= e(t('nyerere_intro_p1')) ?></p>
                <p><?= e(t('nyerere_intro_p2')) ?></p>
                <p><?= e(t('nyerere_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_area')) ?></span><span class="fact-value">30,893 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_rank')) ?></span><span class="fact-value"><?= e(t('nyerere_fact_rank_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_established')) ?></span><span class="fact-value">2019</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_status')) ?></span><span class="fact-value">UNESCO</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_boat')) ?></span><span class="fact-value"><?= e(t('nyerere_fact_boat_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_wilddog')) ?></span><span class="fact-value"><?= e(t('nyerere_fact_wilddog_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_stay')) ?></span><span class="fact-value">3&ndash;4 <?= e(t('nyerere_fact_nights')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('nyerere_fact_from_dar')) ?></span><span class="fact-value">~45 <?= e(t('nyerere_fact_minutes')) ?></span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-compass"></i> <?= e(t('nyerere_regions_badge')) ?></span>
                    <h2><?= e(t('nyerere_regions_title')) ?></h2>
                    <p><?= e(t('nyerere_regions_intro')) ?></p>
                </div>

                <h3><?= e(t('nyerere_region_rufiji_name')) ?></h3>
                <p><?= e(t('nyerere_region_rufiji_desc')) ?></p>

                <h3><?= e(t('nyerere_region_stieglers_name')) ?></h3>
                <p><?= e(t('nyerere_region_stieglers_desc')) ?></p>

                <h3><?= e(t('nyerere_region_south_name')) ?></h3>
                <p><?= e(t('nyerere_region_south_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-ship"></i> <?= e(t('nyerere_activities_badge')) ?></span>
                    <h2><?= e(t('nyerere_activities_title')) ?></h2>
                    <p><?= e(t('nyerere_activities_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('nyerere_table_activity')) ?></th>
                                <th><?= e(t('nyerere_table_duration')) ?></th>
                                <th><?= e(t('nyerere_table_highlight')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong><?= e(t('nyerere_act_boat_name')) ?></strong></td><td>2&ndash;3h</td><td><?= e(t('nyerere_act_boat_desc')) ?></td></tr>
                            <tr><td><strong><?= e(t('nyerere_act_walking_name')) ?></strong></td><td>2&ndash;3h</td><td><?= e(t('nyerere_act_walking_desc')) ?></td></tr>
                            <tr><td><strong><?= e(t('nyerere_act_flycamp_name')) ?></strong></td><td>1 <?= e(t('nyerere_act_flycamp_unit')) ?></td><td><?= e(t('nyerere_act_flycamp_desc')) ?></td></tr>
                            <tr><td><strong><?= e(t('nyerere_act_drive_name')) ?></strong></td><td>3&ndash;4h</td><td><?= e(t('nyerere_act_drive_desc')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('nyerere_activities_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('nyerere_wildlife_badge')) ?></span>
                    <h2><?= e(t('nyerere_wildlife_title')) ?></h2>
                    <p><?= e(t('nyerere_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🦛 <?= e(t('nyerere_animal_hippo')) ?></span>
                    <span class="wildlife-tag">🐊 <?= e(t('nyerere_animal_crocodile')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('nyerere_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🦁 <?= e(t('nyerere_animal_lion')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('nyerere_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🐕 <?= e(t('nyerere_animal_wilddog')) ?></span>
                    <span class="wildlife-tag">🐆 <?= e(t('nyerere_animal_leopard')) ?></span>
                    <span class="wildlife-tag">🦓 <?= e(t('nyerere_animal_zebra')) ?></span>
                    <span class="wildlife-tag">🦏 <?= e(t('nyerere_animal_rhino')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('nyerere_wildlife_p1')) ?></p>
                <p><?= e(t('nyerere_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-calendar-days"></i> <?= e(t('nyerere_when_badge')) ?></span>
                    <h2><?= e(t('nyerere_when_title')) ?></h2>
                    <p><?= e(t('nyerere_when_intro')) ?></p>
                </div>
                <p><?= e(t('nyerere_when_p1')) ?></p>
                <p><?= e(t('nyerere_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-bed"></i> <?= e(t('nyerere_stay_badge')) ?></span>
                    <h2><?= e(t('nyerere_stay_title')) ?></h2>
                    <p><?= e(t('nyerere_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><i class="fas fa-campground"></i></div>
                            <h3><?= e(t('nyerere_stay_budget_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('nyerere_stay_budget_price')) ?></p>
                        </div>
                        <p><?= e(t('nyerere_stay_budget_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><i class="fas fa-hotel"></i></div>
                            <h3><?= e(t('nyerere_stay_mid_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('nyerere_stay_mid_price')) ?></p>
                        </div>
                        <p><?= e(t('nyerere_stay_mid_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><i class="fas fa-star"></i></div>
                            <h3><?= e(t('nyerere_stay_luxury_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('nyerere_stay_luxury_price')) ?></p>
                        </div>
                        <p><?= e(t('nyerere_stay_luxury_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('nyerere_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-money-bill-wave"></i> <?= e(t('nyerere_fees_badge')) ?></span>
                    <h2><?= e(t('nyerere_fees_title')) ?></h2>
                    <p><?= e(t('nyerere_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('nyerere_table_category')) ?></th>
                                <th><?= e(t('nyerere_table_adult')) ?></th>
                                <th><?= e(t('nyerere_table_child')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('nyerere_fee_entry')) ?></td><td>$59.00</td><td>$17.70</td></tr>
                            <tr><td><?= e(t('nyerere_fee_concession')) ?></td><td>$47.20</td><td>$11.80</td></tr>
                            <tr><td><?= e(t('nyerere_fee_campsite')) ?></td><td>$35.40</td><td>$5.90</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('nyerere_fees_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-camera-retro"></i> <?= e(t('nyerere_gallery_badge')) ?></span>
                    <h2><?= e(t('nyerere_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Tourists watching hippos on the river" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="White rhino grazing" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="Elephant family on a sunset walk" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_3')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/lion-resting-near-waterhole.jpg') ?>" alt="Lion resting near a waterhole" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_4')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Spotted hyena on the savanna" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_5')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under an acacia tree" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('nyerere_gallery_caption_6')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('nyerere_back_to_parks')) ?> <i class="fas fa-arrow-right"></i></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('nyerere_faq_badge')) ?></span>
                    <h2><?= e(t('nyerere_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('nyerere_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('nyerere_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('nyerere_cta_title')) ?></h2>
            <p><?= e(t('nyerere_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('nyerere_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('nyerere_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
