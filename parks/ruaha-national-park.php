<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/ruaha-national-park.php';
$pageMetaTitle = 'ruaha_meta_title';
$pageMetaDescription = 'ruaha_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-paw"></i> <?= e(t('ruaha_hero_badge')) ?></span>
                <h1><?= e(t('ruaha_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('ruaha_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('ruaha_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('ruaha_intro_badge')) ?></span>
                    <h2><?= e(t('ruaha_intro_title')) ?></h2>
                </div>
                <p><?= e(t('ruaha_intro_p1')) ?></p>
                <p><?= e(t('ruaha_intro_p2')) ?></p>
                <p><?= e(t('ruaha_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_area')) ?></span><span class="fact-value">20,226 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_rank')) ?></span><span class="fact-value"><?= e(t('ruaha_fact_rank_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_lions')) ?></span><span class="fact-value">~10% <?= e(t('ruaha_fact_lions_of_world')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_elephants')) ?></span><span class="fact-value">~12,000</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_kudu')) ?></span><span class="fact-value"><?= e(t('ruaha_fact_kudu_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_stay')) ?></span><span class="fact-value">3&ndash;4 <?= e(t('ruaha_fact_days')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_from_dar')) ?></span><span class="fact-value">~2h <?= e(t('ruaha_fact_by_air')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('ruaha_fact_visitors')) ?></span><span class="fact-value"><?= e(t('ruaha_fact_visitors_value')) ?></span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('compass') ?> <?= e(t('ruaha_regions_badge')) ?></span>
                    <h2><?= e(t('ruaha_regions_title')) ?></h2>
                    <p><?= e(t('ruaha_regions_intro')) ?></p>
                </div>

                <h3><?= e(t('ruaha_region_river_name')) ?></h3>
                <p><?= e(t('ruaha_region_river_desc')) ?></p>

                <h3><?= e(t('ruaha_region_miombo_name')) ?></h3>
                <p><?= e(t('ruaha_region_miombo_desc')) ?></p>

                <h3><?= e(t('ruaha_region_baobab_name')) ?></h3>
                <p><?= e(t('ruaha_region_baobab_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('ruaha_wildlife_badge')) ?></span>
                    <h2><?= e(t('ruaha_wildlife_title')) ?></h2>
                    <p><?= e(t('ruaha_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🦁 <?= e(t('ruaha_animal_lion')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('ruaha_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🦓 <?= e(t('ruaha_animal_zebra')) ?></span>
                    <span class="wildlife-tag">🦒 <?= e(t('ruaha_animal_giraffe')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('ruaha_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🦌 <?= e(t('ruaha_animal_kudu')) ?></span>
                    <span class="wildlife-tag">🐆 <?= e(t('ruaha_animal_leopard')) ?></span>
                    <span class="wildlife-tag">🐕 <?= e(t('ruaha_animal_wilddog')) ?></span>
                    <span class="wildlife-tag">🐈 <?= e(t('ruaha_animal_cheetah')) ?></span>
                    <span class="wildlife-tag">🦛 <?= e(t('ruaha_animal_hippo')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('ruaha_wildlife_p1')) ?></p>
                <p><?= e(t('ruaha_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('calendar-days') ?> <?= e(t('ruaha_when_badge')) ?></span>
                    <h2><?= e(t('ruaha_when_title')) ?></h2>
                    <p><?= e(t('ruaha_when_intro')) ?></p>
                </div>
                <p><?= e(t('ruaha_when_p1')) ?></p>
                <p><?= e(t('ruaha_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('bed') ?> <?= e(t('ruaha_stay_badge')) ?></span>
                    <h2><?= e(t('ruaha_stay_title')) ?></h2>
                    <p><?= e(t('ruaha_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('campground') ?></div>
                            <h3><?= e(t('ruaha_stay_budget_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('ruaha_stay_budget_price')) ?></p>
                        </div>
                        <p><?= e(t('ruaha_stay_budget_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('hotel') ?></div>
                            <h3><?= e(t('ruaha_stay_mid_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('ruaha_stay_mid_price')) ?></p>
                        </div>
                        <p><?= e(t('ruaha_stay_mid_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('star') ?></div>
                            <h3><?= e(t('ruaha_stay_luxury_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('ruaha_stay_luxury_price')) ?></p>
                        </div>
                        <p><?= e(t('ruaha_stay_luxury_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('ruaha_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('money-bill-wave') ?> <?= e(t('ruaha_fees_badge')) ?></span>
                    <h2><?= e(t('ruaha_fees_title')) ?></h2>
                    <p><?= e(t('ruaha_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('ruaha_table_category')) ?></th>
                                <th><?= e(t('ruaha_table_adult')) ?></th>
                                <th><?= e(t('ruaha_table_child')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('ruaha_fee_entry')) ?></td><td>$35.40</td><td>$5.90</td></tr>
                            <tr><td><?= e(t('ruaha_fee_concession')) ?></td><td>$29.50</td><td>$5.90</td></tr>
                            <tr><td><?= e(t('ruaha_fee_campsite')) ?></td><td>$29.50</td><td>$5.90</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('ruaha_fees_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('camera-retro') ?> <?= e(t('ruaha_gallery_badge')) ?></span>
                    <h2><?= e(t('ruaha_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" alt="Male lion portrait, mane" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/lion-resting-near-waterhole.jpg') ?>" alt="Lion resting near a waterhole" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/lion-resting-grass.jpg') ?>" alt="Lion resting in the grass" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_3')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/leopard-tree-branch-close-up.jpg') ?>" alt="Leopard on a tree branch, close up" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_4')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="Elephant family on a sunset walk" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_5')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Spotted hyena on the savanna" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('ruaha_gallery_caption_6')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('ruaha_back_to_parks')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('ruaha_faq_badge')) ?></span>
                    <h2><?= e(t('ruaha_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('ruaha_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('ruaha_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('ruaha_cta_title')) ?></h2>
            <p><?= e(t('ruaha_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('ruaha_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('ruaha_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
