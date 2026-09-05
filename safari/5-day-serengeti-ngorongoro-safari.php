<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/5-day-serengeti-ngorongoro-safari.php';
$pageMetaTitle = 'pkg5d_meta_title';
$pageMetaDescription = 'pkg5d_meta_description';
$bodyClass = 'has-mobile-booking-bar';

$priceTiers = pricing_tiers_for_slug('5-day-serengeti-ngorongoro-safari', [
    ['upTo' => 1, 'pp' => 850],
    ['upTo' => 2, 'pp' => 650],
    ['upTo' => 3, 'pp' => 580],
    ['upTo' => 4, 'pp' => 530],
    ['upTo' => 5, 'pp' => 500],
    ['upTo' => 20, 'pp' => 470],
]);
$tiersJson = e(json_encode($priceTiers));

$currentMonth = (int) date('n');
$isMigrationSeason = $currentMonth >= 7 && $currentMonth <= 10;
$waTemplate = e(t('booking_wa_template'));

$waMessage = str_replace(
    ['{people}', '{pp}', '{total}', '{date}', '{accommodation}'],
    ['2', '€650', '€1,300', '—', t('booking_card_acc_budget')],
    t('booking_wa_template')
);

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('pkg5d_type')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('pkg5d_budget')) ?></span>
            </div>
            <h1><?= e(t('pkg5d_hero_title')) ?></h1>
            <p class="detail-hero-route"><?= icon('location-dot') ?> <?= e(t('pkg5d_hero_route')) ?></p>
            <div class="detail-hero-price">
                <?= e(t('pkg5d_hero_from')) ?>
                <strong>€650 <small style="font-size:1rem;font-weight:500;"><?= e(t('pkg5d_hero_pp')) ?></small></strong>
            </div>
            <div class="detail-hero-quickfacts">
                <span><?= icon('calendar-days') ?> <?= e(t('pkg5d_qf_days')) ?></span>
                <span><?= icon('user-shield') ?> <?= e(t('pkg5d_qf_private')) ?></span>
                <span><?= icon('truck-monster') ?> <?= e(t('pkg5d_qf_jeep')) ?></span>
                <span><?= icon('users') ?> <?= e(t('pkg5d_qf_max')) ?></span>
                <span><?= icon('language') ?> <?= e(t('pkg5d_qf_guide')) ?></span>
            </div>
            <div class="btn-group" style="margin-top:1.4rem;">
                <a href="#booking" class="btn btn-primary btn-lg"><?= e(t('pkg5d_hero_book')) ?></a>
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('pkg5d_hero_whatsapp')) ?></a>
                <button type="button" class="save-safari-btn"
                        data-safari-id="5-day-serengeti-ngorongoro-safari"
                        data-safari-title="<?= e(t('pkg5d_hero_title')) ?>"
                        data-safari-price="€650"
                        data-safari-url="<?= e(url('safari/5-day-serengeti-ngorongoro-safari.php')) ?>"
                        data-safari-image="<?= e(asset('images/hero/ngorongoro-crater-panorama.jpg')) ?>"
                        data-saved-text="<?= e(t('save_safari_saved')) ?>">
                    <?= icon('heart') ?> <span class="save-safari-label"><?= e(t('save_safari_add')) ?></span>
                </button>
            </div>
        </div>
    </section>

    <main>
        <div class="container" style="padding-top:2.5rem;">
            <div class="safari-detail-layout">
                <div class="safari-detail-main">

                    <section style="margin-bottom:2.5rem;">
                        <div class="detail-gallery">
                            <a href="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Lion pride" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under acacia tree" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>" alt="Guide with guests" loading="lazy" />
                            </a>
                            <a href="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" target="_blank" rel="noopener">
                                <img src="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" alt="Leopard in a tree" loading="lazy" />
                                <span class="detail-gallery-more"><?= e(t('pkg5d_gallery_view_all')) ?></span>
                            </a>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_overview_badge')) ?></span>
                            <h2><?= e(t('pkg5d_overview_title')) ?></h2>
                        </div>
                        <p><?= e(t('pkg5d_overview_p1')) ?></p>
                        <p><?= e(t('pkg5d_overview_p2')) ?></p>

                        <h3 style="margin-top:1.5rem;"><?= e(t('pkg5d_love_title')) ?></h3>
                        <ul class="love-list">
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_5')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('pkg5d_love_6')) ?></li>
                        </ul>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_route_badge')) ?></span>
                            <h2><?= e(t('pkg5d_route_title')) ?></h2>
                        </div>
                        <div class="route-strip">
                            <div class="route-strip-stop"><span class="route-strip-dot"><?= icon('plane-arrival') ?></span><span><?= e(t('pkg5d_route_arusha')) ?></span></div>
                            <?= icon('arrow-right', 'route-strip-arrow') ?>
                            <a href="<?= url('parks/tarangire-national-park.php') ?>" class="route-strip-stop linked"><span class="route-strip-dot"><i class="fas fa-paw"></i></span><span><?= e(t('pkg5d_route_tarangire')) ?></span></a>
                            <?= icon('arrow-right', 'route-strip-arrow') ?>
                            <a href="<?= url('parks/serengeti-national-park.php') ?>" class="route-strip-stop linked"><span class="route-strip-dot"><i class="fas fa-crow"></i></span><span><?= e(t('pkg5d_route_serengeti')) ?></span></a>
                            <?= icon('arrow-right', 'route-strip-arrow') ?>
                            <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="route-strip-stop linked"><span class="route-strip-dot"><?= icon('mountain') ?></span><span><?= e(t('pkg5d_route_ngorongoro')) ?></span></a>
                            <?= icon('arrow-right', 'route-strip-arrow') ?>
                            <div class="route-strip-stop"><span class="route-strip-dot"><?= icon('flag-checkered') ?></span><span><?= e(t('pkg5d_route_arusha')) ?></span></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_itinerary_badge')) ?></span>
                            <h2><?= e(t('pkg5d_itinerary_title')) ?></h2>
                            <p><?= e(t('pkg5d_itinerary_intro')) ?></p>
                        </div>

                        <div class="itinerary-accordion">
                            <?php
                            $days = [1, 2, 3, 4, 5];
                            foreach ($days as $d):
                            ?>
                            <div class="itinerary-day">
                                <button type="button" class="itinerary-day-toggle">
                                    <span class="itinerary-day-number"><?= $d ?></span>
                                    <span class="itinerary-day-heading">
                                        <strong>Day <?= $d ?></strong>
                                        <small><?= e(t('pkg5d_day' . $d . '_title')) ?></small>
                                    </span>
                                    <?= icon('chevron-down') ?>
                                </button>
                                <div class="itinerary-day-body">
                                    <div class="itinerary-day-tags">
                                        <span><?= icon('route') ?> <?= e(t('pkg5d_day' . $d . '_drive')) ?></span>
                                        <span><?= icon('utensils') ?> <?= e(t('pkg5d_day' . $d . '_meals')) ?></span>
                                        <span><?= icon('campground') ?> <?= e(t('pkg5d_day' . $d . '_stay')) ?></span>
                                    </div>
                                    <p><?= e(t('pkg5d_day' . $d . '_desc')) ?></p>
                                    <div class="itinerary-day-tags">
                                        <span><?= icon('binoculars') ?> <?= e(t('pkg5d_day' . $d . '_act1')) ?></span>
                                        <span><?= icon('check') ?> <?= e(t('pkg5d_day' . $d . '_act2')) ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_accommodation_badge')) ?></span>
                            <h2><?= e(t('pkg5d_accommodation_title')) ?></h2>
                        </div>
                        <div class="itinerary-accordion">
                            <?php foreach ([1, 2, 3, 4] as $d): ?>
                            <div class="itinerary-day-accommodation">
                                <?= icon('bed') ?>
                                <div>
                                    <strong>Day <?= $d ?> — <?= e(t('pkg5d_day' . $d . '_stay')) ?></strong>
                                    <div style="font-size:0.8rem;color:var(--text-secondary);"><?= e(t('pkg5d_accommodation_tier')) ?> · <?= e(t('pkg5d_day' . $d . '_meals')) ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_features_badge')) ?></span>
                            <h2><?= e(t('pkg5d_features_title')) ?></h2>
                        </div>
                        <div class="features-grid">
                            <div class="feature-tile"><?= icon('user-shield') ?><div><span><?= e(t('pkg5d_feature_type')) ?></span><strong><?= e(t('pkg5d_feature_type_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('calendar-days') ?><div><span><?= e(t('pkg5d_feature_duration')) ?></span><strong><?= e(t('pkg5d_feature_duration_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('truck-monster') ?><div><span><?= e(t('pkg5d_feature_transport')) ?></span><strong><?= e(t('pkg5d_feature_transport_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('users') ?><div><span><?= e(t('pkg5d_feature_group')) ?></span><strong><?= e(t('pkg5d_feature_group_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('language') ?><div><span><?= e(t('pkg5d_feature_guide')) ?></span><strong><?= e(t('pkg5d_feature_guide_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('campground') ?><div><span><?= e(t('pkg5d_feature_accommodation')) ?></span><strong><?= e(t('pkg5d_feature_accommodation_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('calendar-check') ?><div><span><?= e(t('pkg5d_feature_start')) ?></span><strong><?= e(t('pkg5d_feature_start_val')) ?></strong></div></div>
                            <div class="feature-tile"><?= icon('child-reaching') ?><div><span><?= e(t('pkg5d_feature_age')) ?></span><strong><?= e(t('pkg5d_feature_age_val')) ?></strong></div></div>
                        </div>
                    </section>

                    <section id="pricing" style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_pricing_badge')) ?></span>
                            <h2><?= e(t('pkg5d_pricing_title')) ?></h2>
                            <p><?= e(t('pkg5d_pricing_intro')) ?></p>
                        </div>
                        <div class="price-calc"
                             data-currency="€"
                             data-tiers='<?= $tiersJson ?>'
                             data-wa-template="<?= $waTemplate ?>">
                            <div class="price-calc-heading"><?= e(t('pkg5d_pricing_title')) ?></div>
                            <div class="price-calc-subtext"><?= e(t('pkg5d_pricing_intro')) ?></div>
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
                                    <span><?= e(t('pkg5d_hero_pp')) ?></span>
                                    <span class="price-calc-per-person">€650</span>
                                </div>
                                <div class="price-calc-total-line">
                                    <span><?= e(t('booking_card_total')) ?></span>
                                    <span class="price-calc-total">€1,300</span>
                                </div>
                            </div>
                            <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success price-calc-whatsapp"><i class="fab fa-whatsapp"></i> <?= e(t('booking_card_whatsapp')) ?></a>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="included-icon-grid">
                            <div>
                                <h3><?= e(t('pkg5d_included_heading')) ?></h3>
                                <ul class="included-icon-list yes">
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_1')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_2')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_3')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_4')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_5')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_6')) ?></li>
                                    <li><?= icon('check-circle') ?> <?= e(t('pkg5d_included_7')) ?></li>
                                </ul>
                            </div>
                            <div>
                                <h3><?= e(t('pkg5d_excluded_heading')) ?></h3>
                                <ul class="included-icon-list no">
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_1')) ?></li>
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_2')) ?></li>
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_3')) ?></li>
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_4')) ?></li>
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_5')) ?></li>
                                    <li><?= icon('times-circle') ?> <?= e(t('pkg5d_excluded_6')) ?></li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_expect_badge')) ?></span>
                            <h2><?= e(t('pkg5d_expect_title')) ?></h2>
                        </div>
                        <h3><?= e(t('pkg5d_wildlife_heading')) ?></h3>
                        <div class="tag-cloud" style="margin-bottom:1.5rem;">
                            <span>🦁 <?= e(t('pkg5d_wildlife_lion')) ?></span>
                            <span>🐘 <?= e(t('pkg5d_wildlife_elephant')) ?></span>
                            <span>🦒 <?= e(t('pkg5d_wildlife_giraffe')) ?></span>
                            <span>🦓 <?= e(t('pkg5d_wildlife_zebra')) ?></span>
                            <span>🐆 <?= e(t('pkg5d_wildlife_leopard')) ?></span>
                            <span>🐃 <?= e(t('pkg5d_wildlife_buffalo')) ?></span>
                        </div>
                        <h3><?= e(t('pkg5d_activities_heading')) ?></h3>
                        <div class="tag-cloud">
                            <span><?= icon('binoculars') ?> <?= e(t('pkg5d_activity_gamedrives')) ?></span>
                            <span><?= icon('camera') ?> <?= e(t('pkg5d_activity_photo')) ?></span>
                            <span><?= icon('sun') ?> <?= e(t('pkg5d_activity_sunrise')) ?></span>
                            <span><?= icon('moon') ?> <?= e(t('pkg5d_activity_sunset')) ?></span>
                        </div>
                        <?php if ($isMigrationSeason): ?>
                        <div class="migration-badge">
                            <i class="fas fa-kiwi-bird"></i>
                            <span><strong><?= e(t('pkg5d_migration_in_season')) ?></strong> — <?= e(t('pkg5d_migration_in_season_desc')) ?></span>
                        </div>
                        <?php else: ?>
                        <div class="migration-badge">
                            <i class="fas fa-kiwi-bird"></i>
                            <span><strong><?= e(t('pkg5d_migration_out_season')) ?></strong> — <?= e(t('pkg5d_migration_out_season_desc')) ?></span>
                        </div>
                        <?php endif; ?>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <h2 class="section-title"><?= e(t('pkg5d_faq_title')) ?></h2>
                        <div class="faq-column">
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a1')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a2')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a3')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a4')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a5')) ?></p></div></div>
                            <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('pkg5d_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('pkg5d_faq_a6')) ?></p></div></div>
                        </div>
                    </section>

                    <section style="margin-bottom:2.5rem;">
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_getting_badge')) ?></span>
                            <h2><?= e(t('pkg5d_getting_title')) ?></h2>
                        </div>
                        <div class="getting-there-grid">
                            <div class="getting-there-item"><?= icon('plane-arrival') ?><strong><?= e(t('pkg5d_getting_start')) ?></strong><span><?= e(t('pkg5d_getting_start_val')) ?></span></div>
                            <div class="getting-there-item"><?= icon('flag-checkered') ?><strong><?= e(t('pkg5d_getting_end')) ?></strong><span><?= e(t('pkg5d_getting_end_val')) ?></span></div>
                            <div class="getting-there-item"><?= icon('plane') ?><strong><?= e(t('pkg5d_getting_airport')) ?></strong><span><?= e(t('pkg5d_getting_airport_val')) ?></span></div>
                        </div>
                    </section>

                    <section>
                        <div class="section-title-left centered">
                            <span class="section-tagline"><?= e(badge_tagline('pkg5d_why_badge')) ?></span>
                            <h2><?= e(t('pkg5d_why_title')) ?></h2>
                        </div>
                        <div class="trust-grid">
                            <div class="trust-item"><?= icon('user-tie') ?><div><strong><?= e(t('pkg5d_why_1_title')) ?></strong><p><?= e(t('pkg5d_why_1_desc')) ?></p></div></div>
                            <div class="trust-item"><?= icon('tag') ?><div><strong><?= e(t('pkg5d_why_2_title')) ?></strong><p><?= e(t('pkg5d_why_2_desc')) ?></p></div></div>
                            <div class="trust-item"><?= icon('sliders') ?><div><strong><?= e(t('pkg5d_why_3_title')) ?></strong><p><?= e(t('pkg5d_why_3_desc')) ?></p></div></div>
                            <div class="trust-item"><?= icon('headset') ?><div><strong><?= e(t('pkg5d_why_4_title')) ?></strong><p><?= e(t('pkg5d_why_4_desc')) ?></p></div></div>
                            <div class="trust-item"><?= icon('shield-halved') ?><div><strong><?= e(t('pkg5d_why_5_title')) ?></strong><p><?= e(t('pkg5d_why_5_desc')) ?></p></div></div>
                        </div>
                    </section>

                </div>

                <aside class="booking-card-wrap" id="booking">
                    <div class="booking-card"
                         data-currency="€"
                         data-tiers='<?= $tiersJson ?>'
                         data-wa-template="<?= $waTemplate ?>">
                        <div class="booking-card-title"><?= e(t('booking_card_title')) ?></div>
                        <div class="booking-card-from"><?= e(t('pkg5d_hero_from')) ?></div>
                        <div class="booking-card-price"><span class="booking-price-per-person">€650</span> <small><?= e(t('pkg5d_hero_pp')) ?></small></div>

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
                            <label><?= e(t('booking_card_accommodation')) ?></label>
                            <select class="booking-accommodation-select">
                                <option><?= e(t('booking_card_acc_budget')) ?></option>
                                <option><?= e(t('booking_card_acc_mid')) ?></option>
                                <option><?= e(t('booking_card_acc_luxury')) ?></option>
                            </select>
                        </div>

                        <div class="booking-card-field">
                            <label><?= e(t('booking_card_private_group')) ?></label>
                            <select>
                                <option><?= e(t('booking_card_private')) ?></option>
                                <option><?= e(t('booking_card_group')) ?></option>
                            </select>
                        </div>

                        <div class="booking-card-total">
                            <span><?= e(t('booking_card_total')) ?></span>
                            <strong class="booking-total-price">€1,300</strong>
                        </div>

                        <a href="<?= url('booking/?safari=5-day-serengeti-ngorongoro-safari&title=' . rawurlencode(t('pkg5d_hero_title') ?: '5-Day Serengeti & Ngorongoro Safari') . '&pp=' . $priceTiers[0]['pp'] . '&adults=2') ?>" class="btn btn-primary booking-card-book-link"><?= e(t('booking_card_book')) ?></a>
                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success booking-card-whatsapp booking-whatsapp-link"><i class="fab fa-whatsapp"></i> <?= e(t('booking_card_whatsapp')) ?></a>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('pkg5d_final_title')) ?></h2>
            <p><?= e(t('pkg5d_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="#booking" class="btn btn-primary btn-lg"><?= e(t('pkg5d_final_book')) ?></a>
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('pkg5d_final_whatsapp')) ?></a>
            </div>
        </div>
    </section>

    <div class="mobile-booking-bar"
         data-currency="€"
         data-tiers='<?= $tiersJson ?>'
         data-wa-template="<?= $waTemplate ?>">
        <div class="mobile-booking-bar-price">
            <?= e(t('booking_mobile_from')) ?>
            <strong><span class="booking-price-per-person">€650</span> <?= e(t('pkg5d_hero_pp')) ?></strong>
        </div>
        <a href="#booking" class="btn btn-primary"><?= e(t('pkg5d_hero_book')) ?></a>
    </div>

<?php
$extraScripts = ['js/price-calculator.js', 'js/safari-detail.js'];
require dirname(__DIR__) . '/includes/footer.php';
?>
