<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/4-day-luxury-flyin-safari.php';
$pageMetaTitle = 'lux2_meta_title';
$pageMetaDescription = 'lux2_meta_description';

require dirname(__DIR__) . '/includes/header.php';

$days = [
    1 => ['tl_count' => 2, 'location' => 'Serengeti'],
    2 => ['tl_count' => 2, 'location' => 'Serengeti'],
    3 => ['tl_count' => 2, 'location' => 'Serengeti'],
    4 => ['tl_count' => 2, 'location' => 'Serengeti'],
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
                    <span><?= e(t('lux2_hero_title')) ?></span>
                </nav>

                <div class="tour-header-row">
                    <div>
                        <h1><?= e(t('lux2_hero_title')) ?></h1>
                        <div class="tour-meta-row">
                            <span><?= icon('location-dot') ?> <?= e(t('lux2_fact_start_val')) ?>, Central &amp; Northern Serengeti</span>
                            <span><?= icon('calendar-check') ?> <?= e(t('lux2_fact_duration_val')) ?></span>
                            <span><?= icon('plane') ?> <?= e(t('lux2_fact_pickup_val')) ?></span>
                        </div>
                    </div>
                    <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about the 4-Day Luxury Fly-In Safari from Zanzibar.') ?>" class="btn btn-success btn-shine" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('lux2_calc_cta')) ?></a>
                </div>

                <div class="tour-gallery">
                    <a class="tour-gallery-main" href="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" target="_blank" rel="noopener">
                        <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Zebras on the Serengeti plains" loading="lazy" />
                    </a>
                    <div class="tour-gallery-side">
                        <a href="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" alt="Male lion portrait" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/wildlife/cheetah-scanning-savanna.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/wildlife/cheetah-scanning-savanna.jpg') ?>" alt="Cheetah scanning the savanna" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" alt="Leopard resting in a tree" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/team/clients-serengeti-park-gate-1.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/team/clients-serengeti-park-gate-1.jpg') ?>" alt="Guests arriving at the Serengeti park gate" loading="lazy" />
                            <span class="tour-gallery-more">+2</span>
                        </a>
                    </div>
                </div>

                <div class="tour-detail-layout">
                    <div>
                        <div class="tour-intro">
                            <p><?= e(t('lux2_intro_p1')) ?></p>
                            <p><?= e(t('lux2_intro_p2')) ?></p>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux2_highlights_heading')) ?></h3>
                            <ul class="tour-highlights">
                                <li><?= e(t('lux2_highlight_1')) ?></li>
                                <li><?= e(t('lux2_highlight_2')) ?></li>
                                <li><?= e(t('lux2_highlight_3')) ?></li>
                            </ul>
                        </div>

                        <div class="tour-block">
                            <div class="tour-inc-exc-wrap">
                                <div>
                                    <h3><?= e(t('lux2_included_heading')) ?></h3>
                                    <ul class="tour-inc-exc yes">
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_1')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_2')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_3')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_4')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_5')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('lux2_included_6')) ?></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3><?= e(t('lux2_excluded_heading')) ?></h3>
                                    <ul class="tour-inc-exc no">
                                        <li><?= icon('times-circle') ?> <?= e(t('lux2_excluded_1')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux2_excluded_2')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux2_excluded_3')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('lux2_excluded_4')) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux2_itinerary_title')) ?></h3>
                            <?php foreach ($days as $dayNum => $dayInfo): ?>
                            <div style="margin-bottom:1.4rem;">
                                <div style="display:flex;align-items:baseline;gap:0.6rem;margin-bottom:0.6rem;">
                                    <span style="font-family:var(--font-display);font-weight:800;font-size:0.85rem;color:var(--gold-dark);text-transform:uppercase;letter-spacing:0.04em;"><?= e(t('lux2_day' . $dayNum . '_label')) ?></span>
                                    <span style="font-weight:700;color:var(--black);font-size:0.98rem;"><?= e(t('lux2_day' . $dayNum . '_heading')) ?></span>
                                </div>
                                <div class="tour-itinerary-list">
                                    <?php for ($tl = 1; $tl <= $dayInfo['tl_count']; $tl++): ?>
                                    <div class="tour-itinerary-day">
                                        <div>
                                            <div class="tour-itinerary-day-label"><?= e(t('lux2_day' . $dayNum . '_tl' . $tl . '_time')) ?></div>
                                            <div class="tour-itinerary-day-loc"><?= icon('location-dot') ?> <?= e($dayInfo['location']) ?></div>
                                        </div>
                                        <div class="tour-itinerary-day-body">
                                            <h4><?= e(t('lux2_day' . $dayNum . '_tl' . $tl . '_title')) ?></h4>
                                            <p><?= e(t('lux2_day' . $dayNum . '_tl' . $tl . '_desc')) ?></p>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="tour-itinerary-day-accommodation" style="margin-top:0.6rem;display:flex;align-items:center;gap:0.6rem;font-size:0.85rem;color:var(--text-secondary);">
                                    <?= icon('bed') ?>
                                    <span><strong><?= e(t('lux2_day' . $dayNum . '_accommodation')) ?></strong> · <?= e(t('lux2_day' . $dayNum . '_meals')) ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux2_why_title')) ?></h3>
                            <div class="grid-2">
                                <?php foreach ([1, 2, 3, 4] as $w): ?>
                                <div>
                                    <strong style="display:block;font-size:0.92rem;color:var(--black);margin-bottom:0.25rem;"><?= e(t('lux2_why' . $w . '_title')) ?></strong>
                                    <p style="font-size:0.86rem;color:var(--text-secondary);line-height:1.6;margin:0;"><?= e(t('lux2_why' . $w . '_desc')) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('lux2_faq_title')) ?></h3>
                            <div class="faq-column">
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux2_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux2_faq_a1')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux2_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux2_faq_a2')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux2_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux2_faq_a3')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('lux2_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('lux2_faq_a4')) ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="tour-sidebar">
                        <div class="tour-price-banner">
                            <div class="label"><?= e(t('lux2_price_banner_label')) ?></div>
                            <div class="value">$2,900 <small style="font-size:0.85rem;font-weight:600;">/ pp sharing</small></div>
                            <div class="sub"><?= e(t('lux2_price_banner_group')) ?></div>
                        </div>

                        <div class="tour-enquiry-card">
                            <div class="sidebar-enquiry-success">
                                <?= icon('circle-check') ?>
                                <h4><?= e(t('contact_form_success_title')) ?></h4>
                                <p><?= e(t('contact_form_success_desc')) ?></p>
                                <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            </div>

                            <form class="sidebar-enquiry-form" data-tour-name="<?= e(t('lux2_hero_title')) ?>">
                                <h3><?= e(t('lux2_enquiry_title')) ?></h3>
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
                                        <label><?= e(t('lux2_enquiry_adults')) ?></label>
                                        <input type="number" name="adults" min="1" max="20" value="2" />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t('lux2_enquiry_children')) ?></label>
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

                                <button type="submit" class="btn btn-primary btn-lg btn-shine"><?= e(t('lux2_enquiry_submit')) ?></button>
                            </form>
                        </div>

                        <div class="tour-quick-contact-card">
                            <h4><?= e(t('lux2_quick_contact_title')) ?></h4>
                            <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about the 4-Day Luxury Fly-In Safari from Zanzibar.') ?>" class="tour-quick-contact-btn whatsapp btn-shine" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                                <span><?= e(t('lux2_quick_contact_whatsapp')) ?></span>
                            </a>
                            <a href="mailto:info@serengetibudgetsafari.com?subject=<?= urlencode('Enquiry: 4-Day Luxury Fly-In Safari from Zanzibar') ?>" class="tour-quick-contact-btn email">
                                <?= icon('envelope') ?>
                                <span><?= e(t('lux2_quick_contact_email')) ?></span>
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
