<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/kilimanjaro-national-park.php';
$pageMetaTitle = 'kilimanjaro_meta_title';
$pageMetaDescription = 'kilimanjaro_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('mountain-sun') ?> <?= e(t('kilimanjaro_hero_badge')) ?></span>
                <h1><?= e(t('kilimanjaro_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('kilimanjaro_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('kilimanjaro_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('kilimanjaro_intro_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_intro_title')) ?></h2>
                </div>
                <p><?= e(t('kilimanjaro_intro_p1')) ?></p>
                <p><?= e(t('kilimanjaro_intro_p2')) ?></p>
                <p><?= e(t('kilimanjaro_intro_p3')) ?></p>

                <div class="fact-box" style="margin-top:1.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_area')) ?></span><span class="fact-value">1,688 km&sup2;</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_summit')) ?></span><span class="fact-value">5,895m</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_status')) ?></span><span class="fact-value">UNESCO 1987</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_routes')) ?></span><span class="fact-value">7</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_success')) ?></span><span class="fact-value">~65%</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_duration')) ?></span><span class="fact-value">5&ndash;9 <?= e(t('kilimanjaro_fact_days')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_from_arusha')) ?></span><span class="fact-value">~2h</span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('kilimanjaro_fact_climbers')) ?></span><span class="fact-value">~35,000/<?= e(t('kilimanjaro_fact_year')) ?></span></div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('route') ?> <?= e(t('kilimanjaro_routes_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_routes_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_routes_intro')) ?></p>
                </div>

                <h3><?= e(t('kilimanjaro_route_marangu_name')) ?></h3>
                <p><?= e(t('kilimanjaro_route_marangu_desc')) ?></p>

                <h3><?= e(t('kilimanjaro_route_machame_name')) ?></h3>
                <p><?= e(t('kilimanjaro_route_machame_desc')) ?></p>

                <h3><?= e(t('kilimanjaro_route_lemosho_name')) ?></h3>
                <p><?= e(t('kilimanjaro_route_lemosho_desc')) ?></p>

                <h3><?= e(t('kilimanjaro_route_rongai_name')) ?></h3>
                <p><?= e(t('kilimanjaro_route_rongai_desc')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('table-columns') ?> <?= e(t('kilimanjaro_compare_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_compare_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_compare_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('kilimanjaro_table_route')) ?></th>
                                <th><?= e(t('kilimanjaro_table_days')) ?></th>
                                <th><?= e(t('kilimanjaro_table_sleeping')) ?></th>
                                <th><?= e(t('kilimanjaro_table_scenery')) ?></th>
                                <th><?= e(t('kilimanjaro_table_success')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong>Machame</strong></td><td>6&ndash;7</td><td><?= e(t('kilimanjaro_sleep_tents')) ?></td><td><?= e(t('kilimanjaro_scenery_varied')) ?></td><td>~85%</td></tr>
                            <tr><td><strong>Lemosho</strong></td><td>7&ndash;8</td><td><?= e(t('kilimanjaro_sleep_tents')) ?></td><td><?= e(t('kilimanjaro_scenery_best')) ?></td><td>~90%</td></tr>
                            <tr><td><strong><?= e(t('kilimanjaro_northern_circuit')) ?></strong></td><td>9</td><td><?= e(t('kilimanjaro_sleep_tents')) ?></td><td><?= e(t('kilimanjaro_scenery_full')) ?></td><td>~95%</td></tr>
                            <tr><td><strong>Marangu</strong></td><td>5&ndash;6</td><td><?= e(t('kilimanjaro_sleep_huts')) ?></td><td><?= e(t('kilimanjaro_scenery_direct')) ?></td><td>~50&ndash;60%</td></tr>
                            <tr><td><strong>Rongai</strong></td><td>6&ndash;7</td><td><?= e(t('kilimanjaro_sleep_tents')) ?></td><td><?= e(t('kilimanjaro_scenery_dry')) ?></td><td>~80%</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('kilimanjaro_compare_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('kilimanjaro_wildlife_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_wildlife_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_wildlife_intro')) ?></p>
                </div>

                <div class="badge-group">
                    <span class="wildlife-tag">🐒 <?= e(t('kilimanjaro_animal_colobus')) ?></span>
                    <span class="wildlife-tag">🐒 <?= e(t('kilimanjaro_animal_blue_monkey')) ?></span>
                    <span class="wildlife-tag">🦌 <?= e(t('kilimanjaro_animal_bushbuck')) ?></span>
                    <span class="wildlife-tag">🐘 <?= e(t('kilimanjaro_animal_elephant')) ?></span>
                    <span class="wildlife-tag">🐃 <?= e(t('kilimanjaro_animal_buffalo')) ?></span>
                    <span class="wildlife-tag">🐦 <?= e(t('kilimanjaro_animal_raven')) ?></span>
                    <span class="wildlife-tag">🐦 <?= e(t('kilimanjaro_animal_sunbird')) ?></span>
                    <span class="wildlife-tag">🌿 <?= e(t('kilimanjaro_animal_groundsel')) ?></span>
                </div>

                <p style="margin-top:1.2rem;"><?= e(t('kilimanjaro_wildlife_p1')) ?></p>
                <p><?= e(t('kilimanjaro_wildlife_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('calendar-days') ?> <?= e(t('kilimanjaro_when_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_when_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_when_intro')) ?></p>
                </div>
                <p><?= e(t('kilimanjaro_when_p1')) ?></p>
                <p><?= e(t('kilimanjaro_when_p2')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('campground') ?> <?= e(t('kilimanjaro_stay_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_stay_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_stay_intro')) ?></p>
                </div>

                <div class="comparison-grid">
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('campground') ?></div>
                            <h3><?= e(t('kilimanjaro_stay_camping_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('kilimanjaro_stay_camping_price')) ?></p>
                        </div>
                        <p><?= e(t('kilimanjaro_stay_camping_desc')) ?></p>
                    </div>
                    <div class="comparison-card featured">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('house-chimney') ?></div>
                            <h3><?= e(t('kilimanjaro_stay_huts_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('kilimanjaro_stay_huts_price')) ?></p>
                        </div>
                        <p><?= e(t('kilimanjaro_stay_huts_desc')) ?></p>
                    </div>
                    <div class="comparison-card">
                        <div class="comparison-card-head">
                            <div class="comparison-icon"><?= icon('star') ?></div>
                            <h3><?= e(t('kilimanjaro_stay_private_title')) ?></h3>
                            <p class="comparison-tagline"><?= e(t('kilimanjaro_stay_private_price')) ?></p>
                        </div>
                        <p><?= e(t('kilimanjaro_stay_private_desc')) ?></p>
                    </div>
                </div>

                <p class="subtitle" style="margin-top:1.5rem;"><?= e(t('kilimanjaro_stay_note')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('money-bill-wave') ?> <?= e(t('kilimanjaro_fees_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_fees_title')) ?></h2>
                    <p><?= e(t('kilimanjaro_fees_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('kilimanjaro_table_category')) ?></th>
                                <th><?= e(t('kilimanjaro_table_adult')) ?></th>
                                <th><?= e(t('kilimanjaro_table_child')) ?></th>
                                <th><?= e(t('kilimanjaro_table_basis')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><?= e(t('kilimanjaro_fee_conservation')) ?></td><td>$82.60</td><td>$23.60</td><td><?= e(t('kilimanjaro_fee_basis_day')) ?></td></tr>
                            <tr><td><?= e(t('kilimanjaro_fee_camping')) ?></td><td>$59.00</td><td>$11.80</td><td><?= e(t('kilimanjaro_fee_basis_night')) ?></td></tr>
                            <tr><td><?= e(t('kilimanjaro_fee_huts')) ?></td><td>$70.80</td><td>$23.60</td><td><?= e(t('kilimanjaro_fee_basis_night')) ?></td></tr>
                            <tr><td><?= e(t('kilimanjaro_fee_rescue')) ?></td><td>$23.60</td><td>$23.60</td><td><?= e(t('kilimanjaro_fee_basis_once')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('kilimanjaro_fees_note')) ?></p>
                <p class="subtitle"><?= e(t('kilimanjaro_fees_example')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('camera-retro') ?> <?= e(t('kilimanjaro_gallery_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_gallery_title')) ?></h2>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Sunrise over the acacia plains near the Kilimanjaro region" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('kilimanjaro_gallery_caption_1')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Monkey family in the lower montane forest" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('kilimanjaro_gallery_caption_2')) ?></span></div>
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant near the lower slopes landscape" loading="lazy" width="800" height="800" />
                        <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption"><?= e(t('kilimanjaro_gallery_caption_3')) ?></span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('kilimanjaro_back_to_parks')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('kilimanjaro_faq_badge')) ?></span>
                    <h2><?= e(t('kilimanjaro_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('kilimanjaro_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('kilimanjaro_faq_a8')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('kilimanjaro_cta_title')) ?></h2>
            <p><?= e(t('kilimanjaro_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('kilimanjaro_cta_whatsapp')) ?></a>
                <a href="<?= url('safari/') ?>" class="btn btn-light btn-lg"><?= e(t('kilimanjaro_cta_safaris')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
