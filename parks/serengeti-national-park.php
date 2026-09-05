<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/serengeti-national-park.php';
$pageMetaTitle = 'serengeti_meta_title';
$pageMetaDescription = 'serengeti_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(park_tagline('serengeti_hero_badge')) ?></span>
                <h1><?= e(t('serengeti_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('serengeti_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('serengeti_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_intro_badge')) ?></span>
                    <h2><?= e(t('serengeti_intro_title')) ?></h2>
                </div>
                <p><?= e(t('serengeti_intro_p1')) ?></p>
                <p><?= e(t('serengeti_intro_p2')) ?></p>
                <p><?= e(t('serengeti_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_area')) ?></span><span class="fact-value">14,763 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_established')) ?></span><span class="fact-value">1951</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_status')) ?></span><span class="fact-value">UNESCO</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_lions')) ?></span><span class="fact-value">~3,000</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_wildebeest')) ?></span><span class="fact-value">~1.3M</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_stay')) ?></span><span class="fact-value">2&ndash;4 <?= e(t('serengeti_fact_nights')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_from_arusha')) ?></span><span class="fact-value">325 km / 7&ndash;8h</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('serengeti_fact_by_air')) ?></span><span class="fact-value">~1h15</span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_regions_badge')) ?></span>
                    <h2><?= e(t('serengeti_regions_title')) ?></h2>
                    <p><?= e(t('serengeti_regions_intro')) ?></p>
                </div>

                <h3><?= e(t('serengeti_region_seronera_name')) ?></h3>
                <p><?= e(t('serengeti_region_seronera_desc')) ?></p>

                <h3><?= e(t('serengeti_region_ndutu_name')) ?></h3>
                <p><?= e(t('serengeti_region_ndutu_desc')) ?></p>

                <h3><?= e(t('serengeti_region_western_name')) ?></h3>
                <p><?= e(t('serengeti_region_western_desc')) ?></p>

                <h3><?= e(t('serengeti_region_kogatende_name')) ?></h3>
                <p><?= e(t('serengeti_region_kogatende_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_migration_badge')) ?></span>
                    <h2><?= e(t('serengeti_migration_title')) ?></h2>
                    <p><?= e(t('serengeti_migration_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('serengeti_table_months')) ?></th>
                                <th><?= e(t('serengeti_table_where')) ?></th>
                                <th><?= e(t('serengeti_table_what_happens')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong>Dec&ndash;Mar</strong></td><td><?= e(t('serengeti_mig_ndutu')) ?></td><td><?= e(t('serengeti_mig_calving')) ?></td></tr>
                            <tr><td><strong>Apr&ndash;May</strong></td><td><?= e(t('serengeti_mig_moving_nw')) ?></td><td><?= e(t('serengeti_mig_rains')) ?></td></tr>
                            <tr><td><strong>Jun&ndash;Jul</strong></td><td><?= e(t('serengeti_mig_western')) ?></td><td><?= e(t('serengeti_mig_grumeti')) ?></td></tr>
                            <tr><td><strong>Jul&ndash;Oct</strong></td><td><?= e(t('serengeti_mig_northern')) ?></td><td><?= e(t('serengeti_mig_mara')) ?></td></tr>
                            <tr><td><strong>Nov&ndash;Dec</strong></td><td><?= e(t('serengeti_mig_returning')) ?></td><td><?= e(t('serengeti_mig_south')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('serengeti_migration_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_wildlife_badge')) ?></span>
                    <h2><?= e(t('serengeti_wildlife_title')) ?></h2>
                    <p><?= e(t('serengeti_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🦁 <?= e(t('serengeti_animal_lion')) ?></span>
                    <span class="wildlife-tag">🐆 <?= e(t('serengeti_animal_leopard')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('serengeti_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('serengeti_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🐈 <?= e(t('serengeti_animal_cheetah')) ?></span>
                    <span class="wildlife-tag">🦓 <?= e(t('serengeti_animal_zebra')) ?></span>
                    <span class="wildlife-tag">🦒 <?= e(t('serengeti_animal_giraffe')) ?></span>
                    <span class="wildlife-tag">🐕 <?= e(t('serengeti_animal_hyena')) ?></span>
                    <span class="wildlife-tag">🦏 <?= e(t('serengeti_animal_rhino')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('serengeti_wildlife_p1')) ?></p>
                <p><?= e(t('serengeti_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_when_badge')) ?></span>
                    <h2><?= e(t('serengeti_when_title')) ?></h2>
                    <p><?= e(t('serengeti_when_intro')) ?></p>
                </div>
                <p><?= e(t('serengeti_when_p1')) ?></p>
                <p><?= e(t('serengeti_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_stay_badge')) ?></span>
                    <h2><?= e(t('serengeti_stay_title')) ?></h2>
                    <p><?= e(t('serengeti_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('campground') ?></div>
                            <h3><?= e(t('serengeti_stay_budget_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('serengeti_stay_budget_price')) ?></p>
                        </div>
                        <p><?= e(t('serengeti_stay_budget_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('hotel') ?></div>
                            <h3><?= e(t('serengeti_stay_mid_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('serengeti_stay_mid_price')) ?></p>
                        </div>
                        <p><?= e(t('serengeti_stay_mid_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('star') ?></div>
                            <h3><?= e(t('serengeti_stay_luxury_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('serengeti_stay_luxury_price')) ?></p>
                        </div>
                        <p><?= e(t('serengeti_stay_luxury_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('serengeti_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_fees_badge')) ?></span>
                    <h2><?= e(t('serengeti_fees_title')) ?></h2>
                    <p><?= e(t('serengeti_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('serengeti_table_category')) ?></th>
                                <th><?= e(t('serengeti_table_adult')) ?></th>
                                <th><?= e(t('serengeti_table_child')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('serengeti_fee_entry')) ?></td><td>$82.60</td><td>$23.60</td></tr>
                            <tr><td><?= e(t('serengeti_fee_concession')) ?></td><td>$59.00</td><td>$11.80</td></tr>
                            <tr><td><?= e(t('serengeti_fee_campsite')) ?></td><td>$35.40</td><td>$5.90</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('serengeti_fees_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_gallery_badge')) ?></span>
                    <h2><?= e(t('serengeti_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Lion pride with a zebra kill" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" alt="Leopard resting in a tree" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Zebra herd grazing on the savanna" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_3')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>" alt="Cheetahs resting in the shade" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_4')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Lion pride stalking zebra" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_5')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" alt="Leopard in a tree, wide view" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('serengeti_gallery_caption_6')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('serengeti_back_to_parks')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(park_tagline('serengeti_faq_badge')) ?></span>
                    <h2><?= e(t('serengeti_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('serengeti_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('serengeti_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('serengeti_cta_title')) ?></h2>
            <p><?= e(t('serengeti_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('serengeti_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('serengeti_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
