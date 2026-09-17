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
$extraStyles = ['css/guide.css'];

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

                <div class="carrental-hero-prices">
                    <div class="carrental-hero-price-card">
                        <span class="carrental-hero-price-icon"><?= icon('truck-field') ?></span>
                        <div>
                            <span class="carrental-hero-price-label"><?= e(t('carrental_car1_name')) ?></span>
                            <span class="carrental-hero-price-value"><?= e(t('carrental_car1_price')) ?></span>
                        </div>
                    </div>
                    <div class="carrental-hero-price-card">
                        <span class="carrental-hero-price-icon"><?= icon('truck-monster') ?></span>
                        <div>
                            <span class="carrental-hero-price-label"><?= e(t('carrental_car2_name')) ?></span>
                            <span class="carrental-hero-price-value"><?= e(t('carrental_car2_price')) ?></span>
                        </div>
                    </div>
                </div>

                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('carrental_hero_cta_quote')) ?></a>
                    <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to rent a car with a driver.') ?>" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>

                <div class="hero-features">
                    <span><?= icon('calendar-check') ?> <?= e(t('carrental_hero_stat_1')) ?></span>
                    <span><?= icon('shield-alt') ?> <?= e(t('carrental_hero_stat_2')) ?></span>
                    <span><?= icon('user-tie') ?> <?= e(t('carrental_hero_stat_3')) ?></span>
                    <span><?= icon('star') ?> <?= e(t('carrental_hero_stat_4')) ?></span>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><?= icon('shield-alt') ?> <?= e(t('carrental_trust_1')) ?></span>
            <span class="guide-trust-badge"><?= icon('droplet') ?> <?= e(t('carrental_trust_2')) ?></span>
            <span class="guide-trust-badge"><?= icon('truck-monster') ?> <?= e(t('carrental_trust_3')) ?></span>
            <span class="guide-trust-badge"><?= icon('headset') ?> <?= e(t('carrental_trust_4')) ?></span>
            <span class="guide-trust-badge"><?= icon('globe-africa') ?> <?= e(t('carrental_trust_5')) ?></span>
            <span class="guide-trust-badge"><?= icon('clipboard-list') ?> <?= e(t('carrental_trust_6')) ?></span>
            <span class="guide-trust-badge"><i class="fab fa-whatsapp"></i> <?= e(t('carrental_trust_7')) ?></span>
            <span class="guide-trust-badge"><?= icon('star') ?> <?= e(t('carrental_trust_8')) ?></span>
        </div>
    </div>

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

                <div class="grid-2" style="margin-top:2rem;">
                    <div class="guide-box pro-tip">
                        <h3 style="margin-top:0;"><?= e(t('carrental_choose_title')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_choose_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_choose_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_choose_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_choose_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_choose_5')) ?></li>
                        </ul>
                    </div>
                    <div class="guide-box highlight">
                        <h3 style="margin-top:0;"><?= e(t('carrental_arrange_title')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_arrange_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_arrange_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_arrange_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_arrange_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_arrange_5')) ?></li>
                        </ul>
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
                    <div class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-4.jpg') ?>" alt="<?= e(t('carrental_car1_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('carrental_car1_price')) ?></span>
                            <span class="route-card-success highest"><?= e(t('carrental_car1_seats')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('carrental_car1_tagline')) ?></span>
                            <h3><?= e(t('carrental_car1_name')) ?></h3>
                            <p><?= e(t('carrental_car1_desc')) ?></p>
                            <ul class="included-icon-list yes">
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car1_feat1')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car1_feat2')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car1_feat3')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car1_feat4')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car1_feat5')) ?></li>
                            </ul>
                            <a href="<?= url('contact.php') ?>" class="btn btn-primary" style="margin-top:1rem;width:100%;text-align:center;"><?= e(t('carrental_hero_cta_quote')) ?></a>
                        </div>
                    </div>
                    <div class="route-card featured">
                        <div class="route-card-img">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-1.jpg') ?>" alt="<?= e(t('carrental_car2_name')) ?>" loading="lazy" />
                            <span class="route-card-days"><?= e(t('carrental_car2_price')) ?></span>
                            <span class="route-card-success high"><?= e(t('carrental_car2_seats')) ?></span>
                        </div>
                        <div class="route-card-body">
                            <span class="route-card-tagline"><?= e(t('carrental_car2_tagline')) ?></span>
                            <h3><?= e(t('carrental_car2_name')) ?></h3>
                            <p><?= e(t('carrental_car2_desc')) ?></p>
                            <ul class="included-icon-list yes">
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car2_feat1')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car2_feat2')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car2_feat3')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car2_feat4')) ?></li>
                                <li><?= icon('check-circle') ?> <?= e(t('carrental_car2_feat5')) ?></li>
                            </ul>
                            <a href="<?= url('contact.php') ?>" class="btn btn-primary" style="margin-top:1rem;width:100%;text-align:center;"><?= e(t('carrental_hero_cta_quote')) ?></a>
                        </div>
                    </div>
                </div>

                <p class="mt-3" style="margin-top:1.3rem;"><em><?= e(t('carrental_fleet_note')) ?></em></p>

                <div class="section-title-left centered" style="margin-top:2.5rem;">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_routes_badge')) ?></span>
                    <h2><?= e(t('carrental_routes_title')) ?></h2>
                    <p><?= e(t('carrental_routes_intro')) ?></p>
                </div>

                <div class="grid-3">
                    <article class="card">
                        <h3 style="margin-top:0;"><?= e(t('carrental_route1_name')) ?></h3>
                        <p><strong><?= e(t('carrental_route1_stops')) ?></strong></p>
                        <p><?= e(t('carrental_route1_desc')) ?></p>
                    </article>
                    <article class="card">
                        <h3 style="margin-top:0;"><?= e(t('carrental_route2_name')) ?></h3>
                        <p><strong><?= e(t('carrental_route2_stops')) ?></strong></p>
                        <p><?= e(t('carrental_route2_desc')) ?></p>
                    </article>
                    <article class="card">
                        <h3 style="margin-top:0;"><?= e(t('carrental_route3_name')) ?></h3>
                        <p><strong><?= e(t('carrental_route3_stops')) ?></strong></p>
                        <p><?= e(t('carrental_route3_desc')) ?></p>
                    </article>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <h2><?= e(t('carrental_included_title')) ?></h2>
                    <p><?= e(t('carrental_included_subtitle')) ?></p>
                </div>

                <div class="included-icon-grid">
                    <div>
                        <h3><?= e(t('carrental_included_heading')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_5')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('carrental_included_6')) ?></li>
                        </ul>
                    </div>
                    <div>
                        <h3><?= e(t('carrental_excluded_heading')) ?></h3>
                        <ul class="included-icon-list no">
                            <li><?= icon('times-circle') ?> <?= e(t('carrental_excluded_1')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('carrental_excluded_2')) ?></li>
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
                <div class="grid-3">
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
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_usecase3_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_usecase3_title')) ?></h3>
                        <p><?= e(t('carrental_usecase3_desc')) ?></p>
                    </article>
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_usecase4_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_usecase4_title')) ?></h3>
                        <p><?= e(t('carrental_usecase4_desc')) ?></p>
                    </article>
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_usecase5_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_usecase5_title')) ?></h3>
                        <p><?= e(t('carrental_usecase5_desc')) ?></p>
                    </article>
                    <article class="card">
                        <span class="badge"><?= e(t('carrental_usecase6_badge')) ?></span>
                        <h3 style="margin-top:.6rem;"><?= e(t('carrental_usecase6_title')) ?></h3>
                        <p><?= e(t('carrental_usecase6_desc')) ?></p>
                    </article>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_dest_badge')) ?></span>
                    <h2><?= e(t('carrental_dest_title')) ?></h2>
                    <p><?= e(t('carrental_dest_intro')) ?></p>
                </div>

                <h3><?= e(t('carrental_dest_group1_title')) ?></h3>
                <div class="tag-cloud" style="margin-bottom:1.5rem;">
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group1_item1')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group1_item2')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group1_item3')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group1_item4')) ?></span>
                </div>

                <h3><?= e(t('carrental_dest_group2_title')) ?></h3>
                <div class="tag-cloud" style="margin-bottom:1.5rem;">
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item1')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item2')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item3')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item4')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item5')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group2_item6')) ?></span>
                </div>

                <h3><?= e(t('carrental_dest_group3_title')) ?></h3>
                <div class="tag-cloud">
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item1')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item2')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item3')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item4')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item5')) ?></span>
                    <span><?= icon('map-pin') ?> <?= e(t('carrental_dest_group3_item6')) ?></span>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_driver_badge')) ?></span>
                    <h2><?= e(t('carrental_driver_title')) ?></h2>
                    <p><?= e(t('carrental_driver_intro')) ?></p>
                </div>

                <h3><?= e(t('carrental_driver_help_title')) ?></h3>
                <ul class="included-icon-list yes">
                    <li><?= icon('check-circle') ?> <strong><?= e(t('carrental_driver_help1_label')) ?></strong> <?= e(t('carrental_driver_help1_desc')) ?></li>
                    <li><?= icon('check-circle') ?> <strong><?= e(t('carrental_driver_help2_label')) ?></strong> <?= e(t('carrental_driver_help2_desc')) ?></li>
                    <li><?= icon('check-circle') ?> <strong><?= e(t('carrental_driver_help3_label')) ?></strong> <?= e(t('carrental_driver_help3_desc')) ?></li>
                    <li><?= icon('check-circle') ?> <strong><?= e(t('carrental_driver_help4_label')) ?></strong> <?= e(t('carrental_driver_help4_desc')) ?></li>
                    <li><?= icon('check-circle') ?> <strong><?= e(t('carrental_driver_help5_label')) ?></strong> <?= e(t('carrental_driver_help5_desc')) ?></li>
                </ul>

                <div class="guide-box pro-tip"><p><?= e(t('carrental_driver_tip')) ?></p></div>
                <div class="guide-box highlight"><p><?= e(t('carrental_driver_licensed')) ?></p></div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_compare_badge')) ?></span>
                    <h2><?= e(t('carrental_compare_title')) ?></h2>
                    <p><?= e(t('carrental_compare_intro')) ?></p>
                </div>

                <div class="article-table-wrap">
                    <table class="article-table">
                        <thead>
                            <tr>
                                <th><?= e(t('carrental_compare_h1')) ?></th>
                                <th><?= e(t('carrental_compare_h2')) ?></th>
                                <th><?= e(t('carrental_compare_h3')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong><?= e(t('carrental_compare_r1_label')) ?></strong></td><td><?= e(t('carrental_compare_r1_self')) ?></td><td><?= e(t('carrental_compare_r1_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r2_label')) ?></strong></td><td><?= e(t('carrental_compare_r2_self')) ?></td><td><?= e(t('carrental_compare_r2_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r3_label')) ?></strong></td><td><?= e(t('carrental_compare_r3_self')) ?></td><td><?= e(t('carrental_compare_r3_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r4_label')) ?></strong></td><td><?= e(t('carrental_compare_r4_self')) ?></td><td><?= e(t('carrental_compare_r4_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r5_label')) ?></strong></td><td><?= e(t('carrental_compare_r5_self')) ?></td><td><?= e(t('carrental_compare_r5_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r6_label')) ?></strong></td><td><?= e(t('carrental_compare_r6_self')) ?></td><td><?= e(t('carrental_compare_r6_driver')) ?></td></tr>
                            <tr><td><strong><?= e(t('carrental_compare_r7_label')) ?></strong></td><td><?= e(t('carrental_compare_r7_self')) ?></td><td><?= e(t('carrental_compare_r7_driver')) ?></td></tr>
                        </tbody>
                    </table>
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
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a8')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('carrental_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('carrental_faq_a9')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('carrental_whofor_badge')) ?></span>
                    <h2><?= e(t('carrental_whofor_title')) ?></h2>
                    <p><?= e(t('carrental_whofor_intro')) ?></p>
                </div>

                <div class="tag-cloud">
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item1')) ?></span>
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item2')) ?></span>
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item3')) ?></span>
                    <span><?= icon('camera') ?> <?= e(t('carrental_whofor_item4')) ?></span>
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item5')) ?></span>
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item6')) ?></span>
                    <span><?= icon('umbrella-beach') ?> <?= e(t('carrental_whofor_item7')) ?></span>
                    <span><?= icon('users') ?> <?= e(t('carrental_whofor_item8')) ?></span>
                    <span><?= icon('map') ?> <?= e(t('carrental_whofor_item9')) ?></span>
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
