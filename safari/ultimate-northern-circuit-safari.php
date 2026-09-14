<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/ultimate-northern-circuit-safari.php';
$pageMetaTitle = 'pkgnc_meta_title';
$pageMetaDescription = 'pkgnc_meta_description';

require dirname(__DIR__) . '/includes/header.php';

$days = [
    1 => ['tl_count' => 3, 'location' => 'Arusha'],
    2 => ['tl_count' => 3, 'location' => 'Tarangire'],
    3 => ['tl_count' => 3, 'location' => 'Ngorongoro &amp; Serengeti'],
    4 => ['tl_count' => 3, 'location' => 'Serengeti'],
    5 => ['tl_count' => 3, 'location' => 'Lake Manyara'],
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
                    <a href="<?= url('safari/budget-safari-guide.php') ?>"><?= e(t('nav_safari_budget')) ?></a>
                    <span class="sep">/</span>
                    <span><?= e(t('pkgnc_hero_title')) ?></span>
                </nav>

                <div class="tour-header-row">
                    <div>
                        <h1><?= e(t('pkgnc_hero_title')) ?></h1>
                        <div class="tour-meta-row">
                            <span><?= icon('location-dot') ?> <?= e(t('pkgnc_fact_start_val')) ?>, Northern Circuit</span>
                            <span><?= icon('calendar-check') ?> <?= e(t('pkgnc_fact_duration_val')) ?></span>
                            <span><?= icon('bus') ?> <?= e(t('pkgnc_fact_pickup_val')) ?></span>
                        </div>
                    </div>
                    <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about The Ultimate Northern Circuit safari.') ?>" class="btn btn-success btn-shine" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('pkgnc_calc_cta')) ?></a>
                </div>

                <div class="tour-gallery">
                    <a class="tour-gallery-main" href="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" target="_blank" rel="noopener">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Panoramic view of Ngorongoro Crater" loading="lazy" />
                    </a>
                    <div class="tour-gallery-side">
                        <a href="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under acacia tree in Tarangire" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Zebras on the Serengeti plains" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" alt="Leopard resting in a tree" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Tourists watching hippos at Lake Manyara" loading="lazy" />
                            <span class="tour-gallery-more">+2</span>
                        </a>
                    </div>
                </div>

                <div class="tour-detail-layout">
                    <div>
                        <div class="tour-intro">
                            <p><?= e(t('pkgnc_intro_p1')) ?></p>
                            <p><?= e(t('pkgnc_intro_p2')) ?></p>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('pkgnc_highlights_heading')) ?></h3>
                            <ul class="tour-highlights">
                                <li><?= e(t('pkgnc_highlight_1')) ?></li>
                                <li><?= e(t('pkgnc_highlight_2')) ?></li>
                                <li><?= e(t('pkgnc_highlight_3')) ?></li>
                            </ul>
                        </div>

                        <div class="tour-block">
                            <div class="tour-inc-exc-wrap">
                                <div>
                                    <h3><?= e(t('pkgnc_included_heading')) ?></h3>
                                    <ul class="tour-inc-exc yes">
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_1')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_2')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_3')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_4')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_5')) ?></li>
                                        <li><?= icon('check-circle') ?> <?= e(t('pkgnc_included_6')) ?></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3><?= e(t('pkgnc_excluded_heading')) ?></h3>
                                    <ul class="tour-inc-exc no">
                                        <li><?= icon('times-circle') ?> <?= e(t('pkgnc_excluded_1')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('pkgnc_excluded_2')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('pkgnc_excluded_3')) ?></li>
                                        <li><?= icon('times-circle') ?> <?= e(t('pkgnc_excluded_4')) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('pkgnc_itinerary_title')) ?></h3>
                            <?php foreach ($days as $dayNum => $dayInfo): ?>
                            <div style="margin-bottom:1.4rem;">
                                <div style="display:flex;align-items:baseline;gap:0.6rem;margin-bottom:0.6rem;">
                                    <span style="font-family:var(--font-display);font-weight:800;font-size:0.85rem;color:var(--gold-dark);text-transform:uppercase;letter-spacing:0.04em;"><?= e(t('pkgnc_day' . $dayNum . '_label')) ?></span>
                                    <span style="font-weight:700;color:var(--black);font-size:0.98rem;"><?= e(t('pkgnc_day' . $dayNum . '_heading')) ?></span>
                                </div>
                                <div class="tour-itinerary-list">
                                    <?php for ($tl = 1; $tl <= $dayInfo['tl_count']; $tl++): ?>
                                    <div class="tour-itinerary-day">
                                        <div>
                                            <div class="tour-itinerary-day-label"><?= e(t('pkgnc_day' . $dayNum . '_tl' . $tl . '_time')) ?></div>
                                            <div class="tour-itinerary-day-loc"><?= icon('location-dot') ?> <?= e($dayInfo['location']) ?></div>
                                        </div>
                                        <div class="tour-itinerary-day-body">
                                            <h4><?= e(t('pkgnc_day' . $dayNum . '_tl' . $tl . '_title')) ?></h4>
                                            <p><?= e(t('pkgnc_day' . $dayNum . '_tl' . $tl . '_desc')) ?></p>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('pkgnc_pricing_heading')) ?></h3>
                            <p style="color:var(--text-secondary);font-size:0.88rem;margin-bottom:1rem;"><?= e(t('pkgnc_pricing_note')) ?></p>
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:0.8rem;">
                                <?php
                                $pricingTiers = [
                                    2 => 1450, 3 => 1200, 4 => 1050, 5 => 1000, 6 => 950, 7 => 925,
                                ];
                                foreach ($pricingTiers as $guests => $pp):
                                ?>
                                <div style="text-align:center;background:var(--gray-100);border-radius:10px;padding:0.9rem 0.6rem;">
                                    <div style="font-size:0.78rem;color:var(--text-secondary);margin-bottom:0.3rem;"><?= (int) $guests ?> <?= e(t('pkgnc_pricing_guests')) ?></div>
                                    <div style="font-family:var(--font-display);font-weight:800;font-size:1.15rem;color:var(--black);">$<?= number_format($pp) ?></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('pkgnc_why_title')) ?></h3>
                            <div class="grid-2">
                                <?php foreach ([1, 2, 3, 4, 5, 6, 7] as $w): ?>
                                <div>
                                    <strong style="display:block;font-size:0.92rem;color:var(--black);margin-bottom:0.25rem;"><?= e(t('pkgnc_why' . $w . '_title')) ?></strong>
                                    <p style="font-size:0.86rem;color:var(--text-secondary);line-height:1.6;margin:0;"><?= e(t('pkgnc_why' . $w . '_desc')) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t('pkgnc_faq_title')) ?></h3>
                            <div class="faq-column">
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('pkgnc_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('pkgnc_faq_a1')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('pkgnc_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('pkgnc_faq_a2')) ?></p></div>
                                </div>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t('pkgnc_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t('pkgnc_faq_a3')) ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside class="tour-sidebar">
                        <div class="tour-price-banner">
                            <div class="label"><?= e(t('pkgnc_price_banner_label')) ?></div>
                            <div class="value">$925 <small style="font-size:0.85rem;font-weight:600;">/ pp (7+ travellers)</small></div>
                            <div class="sub">$1,450 pp <?= e(t('pkgnc_price_banner_group')) ?></div>
                        </div>

                        <div class="tour-enquiry-card">
                            <div class="sidebar-enquiry-success">
                                <?= icon('circle-check') ?>
                                <h4><?= e(t('contact_form_success_title')) ?></h4>
                                <p><?= e(t('contact_form_success_desc')) ?></p>
                                <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            </div>

                            <form class="sidebar-enquiry-form" data-tour-name="<?= e(t('pkgnc_hero_title')) ?>">
                                <h3><?= e(t('pkgnc_enquiry_title')) ?></h3>
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
                                        <label><?= e(t('pkgnc_enquiry_adults')) ?></label>
                                        <input type="number" name="adults" min="1" max="20" value="2" />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t('pkgnc_enquiry_children')) ?></label>
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

                                <button type="submit" class="btn btn-primary btn-lg btn-shine"><?= e(t('pkgnc_enquiry_submit')) ?></button>
                            </form>
                        </div>

                        <div class="tour-quick-contact-card">
                            <h4><?= e(t('pkgnc_quick_contact_title')) ?></h4>
                            <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I would like to enquire about The Ultimate Northern Circuit safari.') ?>" class="tour-quick-contact-btn whatsapp btn-shine" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                                <span><?= e(t('pkgnc_quick_contact_whatsapp')) ?></span>
                            </a>
                            <a href="mailto:info@serengetibudgetsafari.com?subject=<?= urlencode('Enquiry: The Ultimate Northern Circuit') ?>" class="tour-quick-contact-btn email">
                                <?= icon('envelope') ?>
                                <span><?= e(t('pkgnc_quick_contact_email')) ?></span>
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
