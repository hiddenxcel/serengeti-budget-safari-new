<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/lake-manyara-national-park.php';
$pageMetaTitle = 'manyara_meta_title';
$pageMetaDescription = 'manyara_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(park_tagline('manyara_hero_badge')) ?></span>
                <h1><?= e(t('manyara_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('manyara_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('manyara_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_intro_badge')) ?></span>
                    <h2><?= e(t('manyara_intro_title')) ?></h2>
                </div>
                <p><?= e(t('manyara_intro_p1')) ?></p>
                <p><?= e(t('manyara_intro_p2')) ?></p>
                <p><?= e(t('manyara_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_area')) ?></span><span class="fact-value">325 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_established')) ?></span><span class="fact-value">1960</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_birds')) ?></span><span class="fact-value">400+</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_lions')) ?></span><span class="fact-value"><?= e(t('manyara_fact_lions_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_night_drives')) ?></span><span class="fact-value"><?= e(t('manyara_fact_only_park')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_stay')) ?></span><span class="fact-value"><?= e(t('manyara_fact_stay_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_from_arusha')) ?></span><span class="fact-value">126 km / 1.5&ndash;2h</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('manyara_fact_entry')) ?></span><span class="fact-value">$59.00</span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_zones_badge')) ?></span>
                    <h2><?= e(t('manyara_zones_title')) ?></h2>
                    <p><?= e(t('manyara_zones_intro')) ?></p>
                </div>

                <h3><?= e(t('manyara_zone_forest_name')) ?></h3>
                <p><?= e(t('manyara_zone_forest_desc')) ?></p>

                <h3><?= e(t('manyara_zone_lakeshore_name')) ?></h3>
                <p><?= e(t('manyara_zone_lakeshore_desc')) ?></p>

                <h3><?= e(t('manyara_zone_escarpment_name')) ?></h3>
                <p><?= e(t('manyara_zone_escarpment_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_wildlife_badge')) ?></span>
                    <h2><?= e(t('manyara_wildlife_title')) ?></h2>
                    <p><?= e(t('manyara_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🦁 <?= e(t('manyara_animal_lion')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('manyara_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🦛 <?= e(t('manyara_animal_hippo')) ?></span>
                    <span class="wildlife-tag">🐒 <?= e(t('manyara_animal_baboon')) ?></span>
                    <span class="wildlife-tag">🐵 <?= e(t('manyara_animal_monkey')) ?></span>
                    <span class="wildlife-tag">🦩 <?= e(t('manyara_animal_flamingo')) ?></span>
                    <span class="wildlife-tag">🦓 <?= e(t('manyara_animal_zebra')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('manyara_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🐆 <?= e(t('manyara_animal_leopard')) ?></span>
                    <span class="wildlife-tag">🐕 <?= e(t('manyara_animal_hyena')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('manyara_wildlife_p1')) ?></p>
                <p><?= e(t('manyara_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_when_badge')) ?></span>
                    <h2><?= e(t('manyara_when_title')) ?></h2>
                    <p><?= e(t('manyara_when_intro')) ?></p>
                </div>
                <p><?= e(t('manyara_when_p1')) ?></p>
                <p><?= e(t('manyara_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_stay_badge')) ?></span>
                    <h2><?= e(t('manyara_stay_title')) ?></h2>
                    <p><?= e(t('manyara_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('campground') ?></div>
                            <h3><?= e(t('manyara_stay_budget_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('manyara_stay_budget_price')) ?></p>
                        </div>
                        <p><?= e(t('manyara_stay_budget_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('hotel') ?></div>
                            <h3><?= e(t('manyara_stay_mid_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('manyara_stay_mid_price')) ?></p>
                        </div>
                        <p><?= e(t('manyara_stay_mid_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('star') ?></div>
                            <h3><?= e(t('manyara_stay_luxury_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('manyara_stay_luxury_price')) ?></p>
                        </div>
                        <p><?= e(t('manyara_stay_luxury_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('manyara_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_fees_badge')) ?></span>
                    <h2><?= e(t('manyara_fees_title')) ?></h2>
                    <p><?= e(t('manyara_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('manyara_table_category')) ?></th>
                                <th><?= e(t('manyara_table_adult')) ?></th>
                                <th><?= e(t('manyara_table_child')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('manyara_fee_entry')) ?></td><td>$59.00</td><td>$17.70</td></tr>
                            <tr><td><?= e(t('manyara_fee_concession')) ?></td><td>$47.20</td><td>$11.80</td></tr>
                            <tr><td><?= e(t('manyara_fee_campsite')) ?></td><td>$35.40</td><td>$5.90</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('manyara_fees_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_gallery_badge')) ?></span>
                    <h2><?= e(t('manyara_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Spotted hyena on the savanna" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/leopard-tree-branch-close-up.jpg') ?>" alt="Leopard resting on a tree branch" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Tourists watching hippos in the water" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_3')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Vervet monkey family in the forest" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_4')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/spotted-hyena-close-up.jpg') ?>" alt="Spotted hyena close up" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_5')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" alt="Leopard resting in a tree" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('manyara_gallery_caption_6')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('manyara_back_to_parks')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('manyara_faq_badge')) ?></span>
                    <h2><?= e(t('manyara_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('manyara_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('manyara_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('manyara_cta_title')) ?></h2>
            <p><?= e(t('manyara_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('manyara_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('manyara_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
