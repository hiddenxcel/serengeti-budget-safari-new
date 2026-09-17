<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/3-day-luxury-tanzania-safari.php';
$pageMetaTitle = 'lux1_meta_title';
$pageMetaDescription = 'lux1_meta_description';

require dirname(__DIR__) . '/includes/header.php';

$days = [
    1 => ['tl_count' => 2, 'location' => 'Arusha'],
    2 => ['tl_count' => 3, 'location' => 'Tarangire'],
    3 => ['tl_count' => 3, 'location' => 'Ngorongoro'],
];
?>

    <main style="padding-top:var(--header-height);">
        <section class="detail-section" style="padding-top:1.6rem;padding-bottom:3.5rem;">
            <div class="container">
                <nav class="tour-breadcrumb">
                    <a href="<?= url('') ?>"><?= e(t('nav_home')) ?></a>
                    <span class="sep">/</span>
                    <a href="<?= url('safari/') ?>"><?= e(t('nav_safaris')) ?></a>
                    <span class="sep">/</span>
                    <a href="<?= url('safari/luxury-safari-guide.php') ?>"><?= e(t('nav_safari_luxury')) ?></a>
                    <span class="sep">/</span>
                    <span><?= e(t('lux1_hero_title')) ?></span>
                </nav>

                <div class="tour-header-row">
                    <div>
                        <h1><?= e(t('lux1_hero_title')) ?></h1>
                        <div class="tour-meta-row">
                            <span><?= icon('location-dot') ?> <?= e(t('lux1_fact_start_val')) ?>, Tarangire &amp; Ngorongoro</span>
                            <span><?= icon('calendar-check') ?> <?= e(t('lux1_fact_duration_val')) ?></span>
                            <span><?= icon('bus') ?> <?= e(t('lux1_fact_pickup_val')) ?></span>
                        </div>
                    </div>
                    <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about the 3-Day Luxury Tanzania Safari.') ?>" class="btn btn-success btn-shine" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('lux1_calc_cta')) ?></a>
                </div>

                <div class="tour-gallery">
                    <a class="tour-gallery-main" href="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" target="_blank" rel="noopener">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater panorama" loading="lazy" />
                    </a>
                    <div class="tour-gallery-side">
                        <a href="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under acacia tree in Tarangire" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>" alt="Guide with guests at the Ngorongoro viewpoint" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="Rhino grazing on the crater floor" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/team/ranger-clients-company-vehicle-3.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/team/ranger-clients-company-vehicle-3.jpg') ?>" alt="Guests with guide on a luxury safari vehicle" loading="lazy" />
                            <span class="tour-gallery-more">+2</span>
                        </a>
                    </div>
                </div>

                <div class="tour-detail-layout">
                    <div>
                        <div class="tour-intro">
                            <p><?= e(t('lux1_intro_p1')) ?></p>
                            <p><?= e(t('lux1_intro_p2')) ?></p>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux1_highlights_heading')) ?></h3>
                            <ul class="tour-highlights">
                                <li><?= e(t('lux1_highlight_1')) ?></li>
                                <li><?= e(t('lux1_highlight_2')) ?></li>
                                <li><?= e(t('lux1_highlight_3')) ?></li>
                            </ul>
                        </div>

                        <div class="tour-block">
                            <div class="tour-inc-exc-wrap">
                                <div>
                                    <h3><?= e(t('lux1_included_heading')) ?></h3>
                                    <ul class="tour-inc-exc yes">
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_1')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_2')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_3')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_4')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_5')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux1_included_6')) ?></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3><?= e(t('lux1_excluded_heading')) ?></h3>
                                    <ul class="tour-inc-exc no">
                                        <li><?= icon('times-circle') ?> <?= e(t('lux1_excluded_1')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux1_excluded_2')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux1_excluded_3')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux1_excluded_4')) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux1_itinerary_title')) ?></h3>
                            <?php foreach ($days as $dayNum => $dayInfo): ?>
                            <div style="margin-bottom:1.4rem;">
                                <div style="display:flex;align-items:baseline;gap:0.6rem;margin-bottom:0.6rem;">
                                    <span style="font-family:var(--font-display);font-weight:800;font-size:0.85rem;color:var(--gold-dark);text-transform:uppercase;letter-spacing:0.04em;"><?= e(t('lux1_day' . $dayNum . '_label')) ?></span>
                                    <span style="font-weight:700;color:var(--black);font-size:0.98rem;"><?= e(t('lux1_day' . $dayNum . '_heading')) ?></span>
                                </div>
                                <div class="tour-itinerary-list">
                                    <?php for ($tl = 1; $tl <= $dayInfo['tl_count']; $tl++): ?>
                                    <div class="tour-itinerary-day">
                                        <div>
                                            <div class="tour-itinerary-day-label"><?= e(t('lux1_day' . $dayNum . '_tl' . $tl . '_time')) ?></div>
                                            <div class="tour-itinerary-day-loc"><?= icon('location-dot') ?> <?= e($dayInfo['location']) ?></div>
                                        </div>
                                        <div class="tour-itinerary-day-body">
                                            <h4><?= e(t('lux1_day' . $dayNum . '_tl' . $tl . '_title')) ?></h4>
                                            <p><?= e(t('lux1_day' . $dayNum . '_tl' . $tl . '_desc')) ?></p>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="tour-itinerary-day-accommodation" style="margin-top:0.6rem;display:flex;align-items:center;gap:0.6rem;font-size:0.85rem;color:var(--text-secondary);">
                                    <?= icon('bed') ?>
                                    <span><strong><?= e(t('lux1_day' . $dayNum . '_accommodation')) ?></strong> · <?= e(t('lux1_day' . $dayNum . '_meals')) ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux1_why_title')) ?></h3>
                            <div class="grid-2">
                                <?php foreach ([1, 2, 3, 4] as $w): ?>
                                <div>
                                    <strong style="display:block;font-size:0.92rem;color:var(--black);margin-bottom:0.25rem;"><?= e(t('lux1_why' . $w . '_title')) ?></strong>
                                    <p style="font-size:0.86rem;color:var(--text-secondary);line-height:1.6;margin:0;"><?= e(t('lux1_why' . $w . '_desc')) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux1_faq_title')) ?></h3>
                            <div class="faq-column">
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux1_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux1_faq_a1')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux1_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux1_faq_a2')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux1_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux1_faq_a3')) ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="tour-sidebar">
                        <div class="tour-price-banner">
                            <div class="label"><?= e(t('lux1_price_banner_label')) ?></div>
                            <div class="value">$1,700 <small style="font-size:0.85rem;font-weight:600;">/ pp sharing</small></div>
                            <div class="sub"><?= e(t('lux1_price_banner_group')) ?></div>
                        </div>

                        <div class="tour-enquiry-card">
                            <div class="sidebar-enquiry-success">
                                <?= icon('circle-check') ?>
                                <h4><?= e(t('contact_form_success_title')) ?></h4>
                                <p><?= e(t('contact_form_success_desc')) ?></p>
                                <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            </div>

                            <form class="sidebar-enquiry-form" data-tour-name="<?= e(t('lux1_hero_title')) ?>">
                                <h3><?= e(t('lux1_enquiry_title')) ?></h3>
                                <div class="sidebar-enquiry-error"><?= e(t('contact_form_required')) ?></div>

                                <div class="contact-form-row">
                                    <div class="contact-field">
                                        <label><?= e(t('contact_form_name')) ?> *</label>
                                        <input type="text" name="name" required />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t('contact_form_email')) ?> *</label>
                                        <input type="email" name="email" required />
                                    </div>
                                </div>

                                <div class="contact-form-row">
                                    <div class="contact-field">
                                        <label><?= e(t('contact_form_country')) ?></label>
                                        <input type="text" name="country" />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t('contact_form_phone')) ?></label>
                                        <input type="tel" name="phone" />
                                    </div>
                                </div>

                                <div class="contact-form-row">
                                    <div class="contact-field">
                                        <label><?= e(t('lux1_enquiry_adults')) ?></label>
                                        <input type="number" name="adults" min="1" max="20" value="2" />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t('lux1_enquiry_children')) ?></label>
                                        <input type="number" name="children" min="0" max="10" value="0" />
                                    </div>
                                </div>

                                <div class="contact-field">
                                    <label><?= e(t('contact_form_dates')) ?></label>
                                    <input type="text" name="dates" placeholder="<?= e(t('contact_form_dates_placeholder')) ?>" />
                                </div>

                                <div class="contact-field">
                                    <label><?= e(t('contact_form_message')) ?></label>
                                    <textarea name="message" placeholder="<?= e(t('contact_form_message_placeholder')) ?>"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-shine"><?= e(t('lux1_enquiry_submit')) ?></button>
                            </form>
                        </div>

                        <div class="tour-quick-contact-card">
                            <h4><?= e(t('lux1_quick_contact_title')) ?></h4>
                            <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about the 3-Day Luxury Tanzania Safari.') ?>" class="tour-quick-contact-btn whatsapp btn-shine" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                                <span><?= e(t('lux1_quick_contact_whatsapp')) ?></span>
                            </a>
                            <a href="mailto:info@serengetibudgetsafari.com?subject=<?= urlencode('Enquiry: 3-Day Luxury Tanzania Safari') ?>" class="tour-quick-contact-btn email">
                                <?= icon('envelope') ?>
                                <span><?= e(t('lux1_quick_contact_email')) ?></span>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>

<?php
$extraScripts = ['js/sidebar-enquiry.js', 'js/tour-sidebar-pin.js'];
require dirname(__DIR__) . '/includes/footer.php';
?>
