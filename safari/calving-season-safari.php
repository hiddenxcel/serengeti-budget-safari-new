<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/calving-season-safari.php';
$pageMetaTitle = 'mig1_meta_title';
$pageMetaDescription = 'mig1_meta_description';
$extraStyles = ['css/guide.css'];

require dirname(__DIR__) . '/includes/header.php';

$P = 'mig1';
$optionCount = 5;
$optionDays = [1 => 5, 2 => 4, 3 => 5, 4 => 4, 5 => 6];
?>

    <main style="padding-top:var(--header-height);">
        <section class="detail-section" style="padding-top:1.6rem;padding-bottom:3.5rem;">
            <div class="container">
                <nav class="tour-breadcrumb">
                    <a href="<?= url('') ?>"><?= e(t('nav_home')) ?></a>
                    <span class="sep">/</span>
                    <a href="<?= url('safari/') ?>"><?= e(t('nav_safaris')) ?></a>
                    <span class="sep">/</span>
                    <a href="<?= url('safari/great-migration-guide.php') ?>"><?= e(t('nav_safari_migration')) ?></a>
                    <span class="sep">/</span>
                    <span><?= e(t($P . '_hero_title')) ?></span>
                </nav>

                <div class="tour-header-row">
                    <div>
                        <h1><?= e(t($P . '_hero_title')) ?></h1>
                        <div class="tour-meta-row">
                            <span><?= icon('calendar-check') ?> <?= e(t($P . '_fact_months_val')) ?></span>
                            <span><?= icon('location-dot') ?> <?= e(t($P . '_fact_region_val')) ?></span>
                            <span><?= icon('route') ?> <?= e(t($P . '_fact_options_val')) ?></span>
                        </div>
                    </div>
                    <a href="https://wa.me/255697612865?text=<?= urlencode(t($P . '_wa_intro')) ?>" class="btn btn-success btn-shine" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t($P . '_calc_cta')) ?></a>
                </div>

                <div class="tour-gallery">
                    <a class="tour-gallery-main" href="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" target="_blank" rel="noopener">
                        <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="<?= e(t($P . '_hero_title')) ?>" loading="lazy" />
                    </a>
                    <div class="tour-gallery-side">
                        <a href="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>" alt="Great Migration wildlife" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/wildlife/lion-resting-grass.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/wildlife/lion-resting-grass.jpg') ?>" alt="Great Migration wildlife" loading="lazy" />
                        </a>
                        <a href="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" target="_blank" rel="noopener">
                            <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Great Migration wildlife" loading="lazy" />
                            <span class="tour-gallery-more">+2</span>
                        </a>
                    </div>
                </div>

                <div class="tour-detail-layout">
                    <div>
                        <div class="tour-intro">
                            <p><?= e(t($P . '_intro_p1')) ?></p>
                            <p><?= e(t($P . '_intro_p2')) ?></p>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t($P . '_highlights_heading')) ?></h3>
                            <ul class="tour-highlights">
                                <li><?= e(t($P . '_highlight_1')) ?></li>
                                <li><?= e(t($P . '_highlight_2')) ?></li>
                                <li><?= e(t($P . '_highlight_3')) ?></li>
                            </ul>
                        </div>

                        <div class="guide-box highlight">
                            <p><?= t($P . '_honesty_box') ?></p>
                        </div>

                        <div class="tour-block">
                            <div class="tour-inc-exc-wrap">
                                <div>
                                    <h3><?= e(t($P . '_included_heading')) ?></h3>
                                    <ul class="tour-inc-exc yes">
                                        <?php foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $inc): ?>
                                        <li><?= icon('check-circle') ?> <?= e(t($P . '_included_' . $inc)) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div>
                                    <h3><?= e(t($P . '_excluded_heading')) ?></h3>
                                    <ul class="tour-inc-exc no">
                                        <?php foreach ([1, 2, 3, 4, 5, 6] as $exc): ?>
                                        <li><?= icon('times-circle') ?> <?= e(t($P . '_excluded_' . $exc)) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <p class="mig-balloon-note"><?= icon('circle-info') ?> <?= e(t($P . '_balloon_note')) ?></p>
                        </div>

                        <!-- ITINERARY OPTIONS -->
                        <div class="tour-block">
                            <h3><?= e(t($P . '_itinerary_title')) ?></h3>
                            <p class="mig-itinerary-intro"><?= e(t($P . '_itinerary_intro')) ?></p>

                            <?php for ($o = 1; $o <= $optionCount; $o++): ?>
                            <div class="guide-itinerary-card mig-option-card">
                                <h4>
                                    <span>
                                        <?php if (t($P . '_opt' . $o . '_popular') !== $P . '_opt' . $o . '_popular'): ?>
                                        <span class="badge-popular mig-option-badge"><?= e(t($P . '_opt' . $o . '_popular')) ?></span>
                                        <?php endif; ?>
                                        <?= e(t($P . '_opt' . $o . '_name')) ?>
                                    </span>
                                    <span class="guide-itinerary-days"><?= e(t($P . '_opt' . $o . '_days')) ?></span>
                                </h4>
                                <div class="guide-itinerary-route"><?= e(t($P . '_opt' . $o . '_route')) ?></div>
                                <?php if (t($P . '_opt' . $o . '_note') !== $P . '_opt' . $o . '_note'): ?>
                                <p class="mig-option-note"><em><?= e(t($P . '_opt' . $o . '_note')) ?></em></p>
                                <?php endif; ?>
                                <ul class="mig-option-days">
                                    <?php for ($d = 1; $d <= $optionDays[$o]; $d++): ?>
                                    <li><strong><?= e(t($P . '_opt' . $o . '_daylabel' . $d)) ?>:</strong> <?= e(t($P . '_opt' . $o . '_day' . $d)) ?></li>
                                    <?php endfor; ?>
                                </ul>
                                <div class="guide-itinerary-price"><span class="from-label"><?= e(t('mgg_from')) ?></span> <?= e(t($P . '_opt' . $o . '_price')) ?> <small><?= e(t('mgg_pp')) ?></small></div>
                                <a href="https://wa.me/255697612865?text=<?= urlencode(sprintf('%s %s', t($P . '_wa_option_prefix'), t($P . '_opt' . $o . '_name'))) ?>" class="btn btn-primary mig-option-cta" target="_blank" rel="noopener"><?= e(t($P . '_opt_cta')) ?></a>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t($P . '_accommodation_heading')) ?></h3>
                            <div class="guide-item-grid">
                                <?php foreach (['budget', 'midrange', 'premium'] as $tier): ?>
                                <div class="guide-item-card">
                                    <h4><?= e(t($P . '_acc_' . $tier . '_name')) ?></h4>
                                    <p><?= e(t($P . '_acc_' . $tier . '_desc')) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="guide-box pro-tip"><p><?= t($P . '_acc_tip') ?></p></div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t($P . '_why_title')) ?></h3>
                            <div class="grid-2">
                                <?php foreach ([1, 2, 3, 4] as $w): ?>
                                <div>
                                    <strong style="display:block;font-size:0.92rem;color:var(--black);margin-bottom:0.25rem;"><?= e(t($P . '_why' . $w . '_title')) ?></strong>
                                    <p style="font-size:0.86rem;color:var(--text-secondary);line-height:1.6;margin:0;"><?= e(t($P . '_why' . $w . '_desc')) ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tour-block">
                            <h3><?= e(t($P . '_faq_title')) ?></h3>
                            <div class="faq-column">
                                <?php foreach ([1, 2, 3, 4] as $f): ?>
                                <div class="faq-item-acc">
                                    <div class="faq-question-acc"><?= e(t($P . '_faq_q' . $f)) ?> <span><?= icon('chevron-down') ?></span></div>
                                    <div class="faq-answer-acc"><p><?= e(t($P . '_faq_a' . $f)) ?></p></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <aside class="tour-sidebar">
                        <div class="tour-price-banner">
                            <div class="label"><?= e(t($P . '_price_banner_label')) ?></div>
                            <div class="value"><?= e(t($P . '_price_banner_value')) ?> <small style="font-size:0.85rem;font-weight:600;"><?= e(t('mgg_pp')) ?></small></div>
                            <div class="sub"><?= e(t($P . '_price_banner_sub')) ?></div>
                        </div>

                        <div class="tour-enquiry-card">
                            <div class="sidebar-enquiry-success">
                                <?= icon('circle-check') ?>
                                <h4><?= e(t('contact_form_success_title')) ?></h4>
                                <p><?= e(t('contact_form_success_desc')) ?></p>
                                <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            </div>

                            <form class="sidebar-enquiry-form" data-tour-name="<?= e(t($P . '_hero_title')) ?>">
                                <h3><?= e(t($P . '_enquiry_title')) ?></h3>
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
                                        <label><?= e(t($P . '_enquiry_adults')) ?></label>
                                        <input type="number" name="adults" min="1" max="20" value="2" />
                                    </div>
                                    <div class="contact-field">
                                        <label><?= e(t($P . '_enquiry_children')) ?></label>
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

                                <button type="submit" class="btn btn-primary btn-lg btn-shine"><?= e(t($P . '_enquiry_submit')) ?></button>
                            </form>
                        </div>

                        <div class="tour-quick-contact-card">
                            <h4><?= e(t($P . '_quick_contact_title')) ?></h4>
                            <a href="https://wa.me/255697612865?text=<?= urlencode(t($P . '_wa_intro')) ?>" class="tour-quick-contact-btn whatsapp btn-shine" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                                <span><?= e(t($P . '_quick_contact_whatsapp')) ?></span>
                            </a>
                            <a href="mailto:info@serengetibudgetsafari.com?subject=<?= urlencode(t($P . '_email_subject')) ?>" class="tour-quick-contact-btn email">
                                <?= icon('envelope') ?>
                                <span><?= e(t($P . '_quick_contact_email')) ?></span>
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
