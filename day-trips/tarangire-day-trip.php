<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'day-trips';
$altPath = 'day-trips/tarangire-day-trip.php';
$pageMetaTitle = 'daytrip_tarangire_meta_title';
$pageMetaDescription = 'daytrip_tarangire_meta_description';
$bodyClass = 'has-mobile-booking-bar';

$priceTiers = [
    ['upTo' => 1, 'pp' => 450],
    ['upTo' => 2, 'pp' => 300],
    ['upTo' => 3, 'pp' => 275],
    ['upTo' => 4, 'pp' => 255],
    ['upTo' => 5, 'pp' => 240],
    ['upTo' => 20, 'pp' => 225],
];
$tiersJson = e(json_encode($priceTiers));
$waTemplate = e(t('daytrip_wa_template'));

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('daytrip_tarangire_type')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('daytrip_tarangire_budget')) ?></span>
            </div>
            <h1><?= e(t('daytrip_tarangire_hero_title')) ?></h1>
            <p class="detail-hero-route"><i class="fas fa-location-dot"></i> <?= e(t('daytrip_tarangire_hero_route')) ?></p>
            <div class="detail-hero-price">
                <?= e(t('daytrip_hero_from')) ?>
                <strong>€300 <small style="font-size:1rem;font-weight:500;"><?= e(t('daytrip_hero_pp')) ?></small></strong>
            </div>
            <div class="btn-group" style="margin-top:1.4rem;">
                <a href="#booking" class="btn btn-primary btn-lg"><?= e(t('daytrip_hero_book')) ?></a>
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('daytrip_hero_whatsapp')) ?></a>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="quick-info-bar">
            <div class="quick-info-item"><i class="fas fa-location-dot"></i><span><?= e(t('daytrip_qi_start')) ?></span><strong><?= e(t('daytrip_tarangire_start_val')) ?></strong></div>
            <div class="quick-info-item"><i class="fas fa-clock"></i><span><?= e(t('daytrip_qi_duration')) ?></span><strong><?= e(t('daytrips_1day')) ?></strong></div>
            <div class="quick-info-item"><i class="fas fa-truck-monster"></i><span><?= e(t('daytrip_qi_transport')) ?></span><strong><?= e(t('daytrip_qi_transport_val')) ?></strong></div>
            <div class="quick-info-item"><i class="fas fa-users"></i><span><?= e(t('daytrip_qi_group')) ?></span><strong><?= e(t('daytrip_qi_group_val')) ?></strong></div>
            <div class="quick-info-item"><i class="fas fa-calendar-check"></i><span><?= e(t('daytrip_qi_availability')) ?></span><strong><?= e(t('daytrip_qi_availability_val')) ?></strong></div>
        </div>
    </div>

    <main>
        <div class="container" style="padding-top:2.5rem;">
            <div class="safari-detail-layout">
                <div class="safari-detail-main">

                    <section style="margin-bottom:2.5rem;">
                        <div class="detail-gallery">
                            <a href="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Lion pride Tarangire" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under acacia tree" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" alt="Elephant portrait" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="Elephant family sunset walk" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Zebra herd" loading="lazy" />
                                <span class="detail-gallery-more"><?= e(t('daytrip_gallery_view_all')) ?></span>
                            </a>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-circle-info"></i> <?= e(t('daytrip_overview_badge')) ?></span>
                            <h2><?= e(t('daytrip_tarangire_overview_title')) ?></h2>
                        </div>
                        <p><?= e(t('daytrip_tarangire_overview_p1')) ?></p>

                        <h3 style="margin-top:1.5rem;"><?= e(t('daytrip_love_title')) ?></h3>
                        <ul class="love-list">
                            <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_tarangire_love_1')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_tarangire_love_2')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_tarangire_love_3')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_tarangire_love_4')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_tarangire_love_5')) ?></li>
                        </ul>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-binoculars"></i> <?= e(t('daytrip_experience_badge')) ?></span>
                            <h2><?= e(t('daytrip_experience_title')) ?></h2>
                        </div>
                        <div class="features-grid">
                            <div class="feature-tile"><i class="fas fa-paw"></i><div><span><?= e(t('daytrip_exp_wildlife')) ?></span><strong><?= e(t('daytrip_tarangire_exp_wildlife_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-tree"></i><div><span><?= e(t('daytrip_exp_landscape')) ?></span><strong><?= e(t('daytrip_tarangire_exp_landscape_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-truck-monster"></i><div><span><?= e(t('daytrip_exp_drive')) ?></span><strong><?= e(t('daytrip_exp_drive_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-camera"></i><div><span><?= e(t('daytrip_exp_photo')) ?></span><strong><?= e(t('daytrip_exp_photo_val')) ?></strong></div></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-clock"></i> <?= e(t('daytrip_timeline_badge')) ?></span>
                            <h2><?= e(t('daytrip_timeline_title')) ?></h2>
                        </div>
                        <div class="day-timeline">
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">06:30</div>
                                <strong><?= e(t('daytrip_tarangire_tl1_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl1_desc')) ?></p>
                            </div>
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">09:00</div>
                                <strong><?= e(t('daytrip_tarangire_tl2_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl2_desc')) ?></p>
                            </div>
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">12:30</div>
                                <strong><?= e(t('daytrip_tarangire_tl3_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl3_desc')) ?></p>
                            </div>
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">13:30</div>
                                <strong><?= e(t('daytrip_tarangire_tl4_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl4_desc')) ?></p>
                            </div>
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">16:30</div>
                                <strong><?= e(t('daytrip_tarangire_tl5_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl5_desc')) ?></p>
                            </div>
                            <div class="day-timeline-item">
                                <span class="day-timeline-dot"></span>
                                <div class="day-timeline-time">19:00</div>
                                <strong><?= e(t('daytrip_tarangire_tl6_title')) ?></strong>
                                <p><?= e(t('daytrip_tarangire_tl6_desc')) ?></p>
                            </div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-route"></i> <?= e(t('daytrip_route_badge')) ?></span>
                            <h2><?= e(t('daytrip_route_title')) ?></h2>
                        </div>
                        <div class="route-strip">
                            <div class="route-strip-stop"><span class="route-strip-dot"><i class="fas fa-plane-arrival"></i></span><span><?= e(t('daytrip_tarangire_start_val')) ?></span></div>
                            <i class="fas fa-arrow-right route-strip-arrow"></i>
                            <a href="<?= url('parks/tarangire-national-park.php') ?>" class="route-strip-stop linked"><span class="route-strip-dot"><i class="fas fa-paw"></i></span><span><?= e(t('daytrip_tarangire_route_park')) ?></span></a>
                            <i class="fas fa-arrow-right route-strip-arrow"></i>
                            <div class="route-strip-stop"><span class="route-strip-dot"><i class="fas fa-flag-checkered"></i></span><span><?= e(t('daytrip_tarangire_start_val')) ?></span></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="included-icon-grid">
                            <div>
                                <h3><?= e(t('daytrip_included_heading')) ?></h3>
                                <ul class="included-icon-list yes">
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_1')) ?></li>
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_2')) ?></li>
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_3')) ?></li>
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_4')) ?></li>
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_5')) ?></li>
                                    <li><i class="fas fa-check-circle"></i> <?= e(t('daytrip_included_6')) ?></li>
                                </ul>
                            </div>
                            <div>
                                <h3><?= e(t('daytrip_excluded_heading')) ?></h3>
                                <ul class="included-icon-list no">
                                    <li><i class="fas fa-times-circle"></i> <?= e(t('daytrip_excluded_1')) ?></li>
                                    <li><i class="fas fa-times-circle"></i> <?= e(t('daytrip_excluded_2')) ?></li>
                                    <li><i class="fas fa-times-circle"></i> <?= e(t('daytrip_excluded_3')) ?></li>
                                    <li><i class="fas fa-times-circle"></i> <?= e(t('daytrip_excluded_4')) ?></li>
                                    <li><i class="fas fa-times-circle"></i> <?= e(t('daytrip_excluded_5')) ?></li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-list-check"></i> <?= e(t('daytrip_features_badge')) ?></span>
                            <h2><?= e(t('daytrip_features_title')) ?></h2>
                        </div>
                        <div class="features-grid">
                            <div class="feature-tile"><i class="fas fa-user-shield"></i><div><span><?= e(t('daytrip_feature_type')) ?></span><strong><?= e(t('daytrip_feature_type_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-calendar-check"></i><div><span><?= e(t('daytrip_feature_start')) ?></span><strong><?= e(t('daytrip_qi_availability_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-bed"></i><div><span><?= e(t('daytrip_feature_accommodation')) ?></span><strong><?= e(t('daytrip_feature_accommodation_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-user-tie"></i><div><span><?= e(t('daytrip_feature_guide')) ?></span><strong><?= e(t('daytrip_feature_guide_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-truck-monster"></i><div><span><?= e(t('daytrip_feature_transport')) ?></span><strong><?= e(t('daytrip_qi_transport_val')) ?></strong></div></div>
                            <div class="feature-tile"><i class="fas fa-child"></i><div><span><?= e(t('daytrip_feature_family')) ?></span><strong><?= e(t('daytrip_feature_family_val')) ?></strong></div></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('daytrip_wildlife_badge')) ?></span>
                            <h2><?= e(t('daytrip_wildlife_title')) ?></h2>
                            <p><?= e(t('daytrip_wildlife_note')) ?></p>
                        </div>
                        <div class="tag-cloud">
                            <span>🐘 <?= e(t('daytrip_tarangire_wl_elephant')) ?></span>
                            <span>🦁 <?= e(t('daytrip_tarangire_wl_lion')) ?></span>
                            <span>🦒 <?= e(t('daytrip_tarangire_wl_giraffe')) ?></span>
                            <span>🦓 <?= e(t('daytrip_tarangire_wl_zebra')) ?></span>
                            <span>🐃 <?= e(t('daytrip_tarangire_wl_buffalo')) ?></span>
                            <span>🐗 <?= e(t('daytrip_tarangire_wl_warthog')) ?></span>
                        </div>
                    </section>

                    <section id="pricing" style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-calculator"></i> <?= e(t('daytrip_pricing_badge')) ?></span>
                            <h2><?= e(t('daytrip_pricing_title')) ?></h2>
                            <p><?= e(t('daytrip_pricing_intro')) ?></p>
                        </div>
                        <div class="price-calc"
                             data-currency="€"
                             data-tiers='<?= $tiersJson ?>'
                             data-wa-template="<?= $waTemplate ?>">
                            <div class="price-calc-heading"><?= e(t('daytrip_pricing_title')) ?></div>
                            <div class="price-calc-subtext"><?= e(t('daytrip_pricing_intro')) ?></div>
                            <div class="price-calc-row">
                                <span class="price-calc-label"><?= e(t('booking_card_travelers')) ?></span>
                                <div class="price-calc-stepper">
                                    <button type="button" class="price-calc-minus" aria-label="Fewer travellers">−</button>
                                    <input type="number" class="price-calc-people" value="2" min="1" max="20" inputmode="numeric" />
                                    <button type="button" class="price-calc-plus" aria-label="More travellers">+</button>
                                </div>
                            </div>
                            <div class="price-calc-breakdown">
                                <div class="price-calc-line">
                                    <span><?= e(t('daytrip_hero_pp')) ?></span>
                                    <span class="price-calc-per-person">€300</span>
                                </div>
                                <div class="price-calc-total-line">
                                    <span><?= e(t('booking_card_total')) ?></span>
                                    <span class="price-calc-total">€600</span>
                                </div>
                            </div>
                            <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success price-calc-whatsapp"><i class="fab fa-whatsapp"></i> <?= e(t('booking_card_whatsapp')) ?></a>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-map-location-dot"></i> <?= e(t('daytrip_pickup_badge')) ?></span>
                            <h2><?= e(t('daytrip_pickup_title2')) ?></h2>
                        </div>
                        <div class="getting-there-grid">
                            <div class="getting-there-item"><i class="fas fa-hotel"></i><strong><?= e(t('daytrip_pickup_where')) ?></strong><span><?= e(t('daytrip_pickup_where_val')) ?></span></div>
                            <div class="getting-there-item"><i class="fas fa-clock"></i><strong><?= e(t('daytrip_pickup_time')) ?></strong><span>06:30 AM</span></div>
                            <div class="getting-there-item"><i class="fas fa-flag-checkered"></i><strong><?= e(t('daytrip_pickup_return')) ?></strong><span>~19:00</span></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-suitcase"></i> <?= e(t('daytrip_bring_badge')) ?></span>
                            <h2><?= e(t('daytrip_bring_title2')) ?></h2>
                        </div>
                        <div class="tag-cloud">
                            <span><i class="fas fa-passport"></i> <?= e(t('daytrip_bring_1')) ?></span>
                            <span><i class="fas fa-shirt"></i> <?= e(t('daytrip_bring_2')) ?></span>
                            <span><i class="fas fa-hat-cowboy"></i> <?= e(t('daytrip_bring_3')) ?></span>
                            <span><i class="fas fa-glasses"></i> <?= e(t('daytrip_bring_4')) ?></span>
                            <span><i class="fas fa-pump-soap"></i> <?= e(t('daytrip_bring_5')) ?></span>
                            <span><i class="fas fa-camera"></i> <?= e(t('daytrip_bring_6')) ?></span>
                            <span><i class="fas fa-shoe-prints"></i> <?= e(t('daytrip_bring_7')) ?></span>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <h2 class="section-title"><?= e(t('daytrip_faq_title')) ?></h2>
                        <div class="faq-column">
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('daytrip_tarangire_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('daytrip_tarangire_faq_a1')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('daytrip_tarangire_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('daytrip_tarangire_faq_a2')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('daytrip_tarangire_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('daytrip_tarangire_faq_a3')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('daytrip_tarangire_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('daytrip_tarangire_faq_a4')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('daytrip_tarangire_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('daytrip_tarangire_faq_a5')) ?></p></div></div>
                        </div>
                    </section>

                    <section>
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-compass"></i> <?= e(t('daytrip_related_badge')) ?></span>
                            <h2><?= e(t('daytrip_related_title')) ?></h2>
                        </div>
                        <div class="grid-3">
                            <a href="<?= url('contact.php') ?>" class="day-trip-card">
                                <div class="day-trip-card-img">
                                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater day trip" loading="lazy" />
                                    <span class="day-trip-card-duration"><?= e(t('daytrips_1day')) ?></span>
                                </div>
                                <div class="day-trip-card-body">
                                    <h3><?= e(t('daytrip_ngorongoro_title')) ?></h3>
                                    <div class="day-trip-card-footer">
                                        <div class="price-tag">€230 <small><?= e(t('daytrips_from_pp')) ?></small></div>
                                        <span class="popular-package-arrow"><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                            <a href="<?= url('contact.php') ?>" class="day-trip-card">
                                <div class="day-trip-card-img">
                                    <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Lake Manyara day trip" loading="lazy" />
                                    <span class="day-trip-card-duration"><?= e(t('daytrips_1day')) ?></span>
                                </div>
                                <div class="day-trip-card-body">
                                    <h3><?= e(t('daytrip_manyara_title')) ?></h3>
                                    <div class="day-trip-card-footer">
                                        <div class="price-tag"><?= e(t('daytrips_ask_price')) ?></div>
                                        <span class="popular-package-arrow"><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                            <a href="<?= url('contact.php') ?>" class="day-trip-card">
                                <div class="day-trip-card-img">
                                    <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Arusha National Park day trip" loading="lazy" />
                                    <span class="day-trip-card-duration"><?= e(t('daytrips_halfday')) ?></span>
                                </div>
                                <div class="day-trip-card-body">
                                    <h3><?= e(t('daytrip_arushanp_title')) ?></h3>
                                    <div class="day-trip-card-footer">
                                        <div class="price-tag"><?= e(t('daytrips_ask_price')) ?></div>
                                        <span class="popular-package-arrow"><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>

                </div>

                <aside class="booking-card-wrap" id="booking">
                    <div class="booking-card"
                         data-currency="€"
                         data-tiers='<?= $tiersJson ?>'
                         data-wa-template="<?= $waTemplate ?>">
                        <div class="booking-card-title"><?= e(t('daytrip_booking_card_title')) ?></div>
                        <div class="booking-card-from"><?= e(t('daytrip_hero_from')) ?></div>
                        <div class="booking-card-price"><span class="booking-price-per-person">€300</span> <small><?= e(t('daytrip_hero_pp')) ?></small></div>

                        <div class="booking-card-field">
                            <label><?= e(t('booking_card_travelers')) ?></label>
                            <div class="booking-card-stepper">
                                <button type="button" class="booking-people-minus">−</button>
                                <input type="number" class="booking-people-input" value="2" min="1" max="20" inputmode="numeric" />
                                <button type="button" class="booking-people-plus">+</button>
                            </div>
                        </div>

                        <div class="booking-card-field">
                            <label><?= e(t('booking_card_date')) ?></label>
                            <input type="date" class="booking-date-input" />
                        </div>

                        <div class="booking-card-field">
                            <label><?= e(t('daytrip_booking_type')) ?></label>
                            <select>
                                <option><?= e(t('booking_card_private')) ?></option>
                                <option><?= e(t('booking_card_group')) ?></option>
                            </select>
                        </div>

                        <div class="booking-card-total">
                            <span><?= e(t('booking_card_total')) ?></span>
                            <strong class="booking-total-price">€600</strong>
                        </div>

                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-primary booking-card-whatsapp booking-whatsapp-link"><?= e(t('daytrip_booking_card_book')) ?></a>
                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success booking-card-whatsapp booking-whatsapp-link"><i class="fab fa-whatsapp"></i> <?= e(t('booking_card_whatsapp')) ?></a>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('daytrip_final_title')) ?></h2>
            <p><?= e(t('daytrip_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="#booking" class="btn btn-primary btn-lg"><?= e(t('daytrip_final_book')) ?></a>
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('daytrip_final_whatsapp')) ?></a>
            </div>
        </div>
    </section>

    <div class="mobile-booking-bar"
         data-currency="€"
         data-tiers='<?= $tiersJson ?>'
         data-wa-template="<?= $waTemplate ?>">
        <div class="mobile-booking-bar-price">
            <?= e(t('booking_mobile_from')) ?>
            <strong><span class="booking-price-per-person">€300</span> <?= e(t('daytrip_hero_pp')) ?></strong>
        </div>
        <a href="#booking" class="btn btn-primary"><?= e(t('daytrip_hero_book')) ?></a>
    </div>

<?php
$extraScripts = ['js/price-calculator.js', 'js/safari-detail.js'];
require dirname(__DIR__) . '/includes/footer.php';
?>
