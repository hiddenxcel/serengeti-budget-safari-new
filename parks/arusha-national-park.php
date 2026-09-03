<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/arusha-national-park.php';
$pageMetaTitle = 'arusha_meta_title';
$pageMetaDescription = 'arusha_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('person-hiking') ?> <?= e(t('arusha_hero_badge')) ?></span>
                <h1><?= e(t('arusha_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('arusha_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('arusha_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('arusha_intro_badge')) ?></span>
                    <h2><?= e(t('arusha_intro_title')) ?></h2>
                </div>
                <p><?= e(t('arusha_intro_p1')) ?></p>
                <p><?= e(t('arusha_intro_p2')) ?></p>
                <p><?= e(t('arusha_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_area')) ?></span><span class="fact-value">552 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_established')) ?></span><span class="fact-value">1960</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_meru')) ?></span><span class="fact-value">4,566m</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_birds')) ?></span><span class="fact-value">400+</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_lions')) ?></span><span class="fact-value"><?= e(t('arusha_fact_lions_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_stay')) ?></span><span class="fact-value"><?= e(t('arusha_fact_stay_value')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_from_arusha')) ?></span><span class="fact-value">25 km / 40 min</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('arusha_fact_from_airport')) ?></span><span class="fact-value">~1h</span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('compass') ?> <?= e(t('arusha_regions_badge')) ?></span>
                    <h2><?= e(t('arusha_regions_title')) ?></h2>
                    <p><?= e(t('arusha_regions_intro')) ?></p>
                </div>

                <h3><?= e(t('arusha_region_ngurdoto_name')) ?></h3>
                <p><?= e(t('arusha_region_ngurdoto_desc')) ?></p>

                <h3><?= e(t('arusha_region_momella_name')) ?></h3>
                <p><?= e(t('arusha_region_momella_desc')) ?></p>

                <h3><?= e(t('arusha_region_meru_name')) ?></h3>
                <p><?= e(t('arusha_region_meru_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('person-hiking') ?> <?= e(t('arusha_walking_badge')) ?></span>
                    <h2><?= e(t('arusha_walking_title')) ?></h2>
                    <p><?= e(t('arusha_walking_intro')) ?></p>
                </div>
                <p><?= e(t('arusha_walking_p1')) ?></p>
                <p><?= e(t('arusha_walking_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('arusha_wildlife_badge')) ?></span>
                    <h2><?= e(t('arusha_wildlife_title')) ?></h2>
                    <p><?= e(t('arusha_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🦒 <?= e(t('arusha_animal_giraffe')) ?></span>
                    <span class="wildlife-tag">🐒 <?= e(t('arusha_animal_colobus')) ?></span>
                    <span class="wildlife-tag">🦓 <?= e(t('arusha_animal_zebra')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('arusha_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🦌 <?= e(t('arusha_animal_waterbuck')) ?></span>
                    <span class="wildlife-tag">🦩 <?= e(t('arusha_animal_flamingo')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('arusha_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🐗 <?= e(t('arusha_animal_warthog')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('arusha_wildlife_p1')) ?></p>
                <p><?= e(t('arusha_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('calendar-days') ?> <?= e(t('arusha_when_badge')) ?></span>
                    <h2><?= e(t('arusha_when_title')) ?></h2>
                    <p><?= e(t('arusha_when_intro')) ?></p>
                </div>
                <p><?= e(t('arusha_when_p1')) ?></p>
                <p><?= e(t('arusha_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('bed') ?> <?= e(t('arusha_stay_badge')) ?></span>
                    <h2><?= e(t('arusha_stay_title')) ?></h2>
                    <p><?= e(t('arusha_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('city') ?></div>
                            <h3><?= e(t('arusha_stay_town_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('arusha_stay_town_price')) ?></p>
                        </div>
                        <p><?= e(t('arusha_stay_town_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('hotel') ?></div>
                            <h3><?= e(t('arusha_stay_lodge_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('arusha_stay_lodge_price')) ?></p>
                        </div>
                        <p><?= e(t('arusha_stay_lodge_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('campground') ?></div>
                            <h3><?= e(t('arusha_stay_camp_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('arusha_stay_camp_price')) ?></p>
                        </div>
                        <p><?= e(t('arusha_stay_camp_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('arusha_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('money-bill-wave') ?> <?= e(t('arusha_fees_badge')) ?></span>
                    <h2><?= e(t('arusha_fees_title')) ?></h2>
                    <p><?= e(t('arusha_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('arusha_table_category')) ?></th>
                                <th><?= e(t('arusha_table_adult')) ?></th>
                                <th><?= e(t('arusha_table_child')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('arusha_fee_entry')) ?></td><td>$59.00</td><td>$11.80</td></tr>
                            <tr><td><?= e(t('arusha_fee_concession')) ?></td><td>$59.00</td><td>$11.80</td></tr>
                            <tr><td><?= e(t('arusha_fee_campsite')) ?></td><td>$35.40</td><td>$5.90</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('arusha_fees_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('camera-retro') ?> <?= e(t('arusha_gallery_badge')) ?></span>
                    <h2><?= e(t('arusha_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Vervet monkey family in the forest" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Savanna sunrise over acacia trees" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Visitors watching hippos on the Momella lakes" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_3')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Zebras on the plains" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_4')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under an acacia tree" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_5')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Crater panorama, similar in shape to Ngurdoto Crater" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('arusha_gallery_caption_6')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('arusha_back_to_parks')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('arusha_faq_badge')) ?></span>
                    <h2><?= e(t('arusha_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('arusha_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('arusha_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('arusha_cta_title')) ?></h2>
            <p><?= e(t('arusha_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('arusha_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('arusha_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
