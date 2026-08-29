<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'contact';
$altPath = 'contact.php';
$pageMetaTitle = 'contact_meta_title';
$pageMetaDescription = 'contact_meta_description';

require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-comments"></i> <?= e(t('contact_hero_badge')) ?></span>
                <h1><?= e(t('contact_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('contact_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="contact-layout">
                    <div class="contact-form-card">

                        <div class="contact-success" id="contactSuccess">
                            <i class="fas fa-circle-check"></i>
                            <h2><?= e(t('contact_form_success_title')) ?></h2>
                            <p><?= e(t('contact_form_success_desc')) ?></p>
                            <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        </div>

                        <form id="contactForm">
                            <h2><?= e(t('contact_form_title')) ?></h2>

                            <div class="contact-form-error" id="contactFormError"><?= e(t('contact_form_required')) ?></div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="cf-name"><?= e(t('contact_form_name')) ?> *</label>
                                    <input type="text" id="cf-name" name="name" required />
                                </div>
                                <div class="contact-field">
                                    <label for="cf-email"><?= e(t('contact_form_email')) ?> *</label>
                                    <input type="email" id="cf-email" name="email" required />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="cf-phone"><?= e(t('contact_form_phone')) ?></label>
                                    <input type="tel" id="cf-phone" name="phone" />
                                </div>
                                <div class="contact-field">
                                    <label for="cf-country"><?= e(t('contact_form_country')) ?></label>
                                    <input type="text" id="cf-country" name="country" />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="cf-interest"><?= e(t('contact_form_interest')) ?></label>
                                    <select id="cf-interest" name="interest">
                                        <option value="<?= e(t('contact_form_interest_safari')) ?>"><?= e(t('contact_form_interest_safari')) ?></option>
                                        <option value="<?= e(t('contact_form_interest_trekking')) ?>"><?= e(t('contact_form_interest_trekking')) ?></option>
                                        <option value="<?= e(t('contact_form_interest_zanzibar')) ?>"><?= e(t('contact_form_interest_zanzibar')) ?></option>
                                        <option value="<?= e(t('contact_form_interest_group')) ?>"><?= e(t('contact_form_interest_group')) ?></option>
                                        <option value="<?= e(t('contact_form_interest_other')) ?>"><?= e(t('contact_form_interest_other')) ?></option>
                                    </select>
                                </div>
                                <div class="contact-field">
                                    <label for="cf-travelers"><?= e(t('contact_form_travelers')) ?></label>
                                    <input type="number" id="cf-travelers" name="travelers" min="1" max="20" value="2" />
                                </div>
                            </div>

                            <div class="contact-field">
                                <label for="cf-dates"><?= e(t('contact_form_dates')) ?></label>
                                <input type="text" id="cf-dates" name="dates" placeholder="<?= e(t('contact_form_dates_placeholder')) ?>" />
                            </div>

                            <div class="contact-field">
                                <label for="cf-message"><?= e(t('contact_form_message')) ?> *</label>
                                <textarea id="cf-message" name="message" placeholder="<?= e(t('contact_form_message_placeholder')) ?>" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg"><?= e(t('contact_form_submit')) ?> <i class="fab fa-whatsapp"></i></button>
                            <p class="contact-privacy-note"><?= e(t('contact_form_privacy')) ?></p>
                        </form>
                    </div>

                    <div>
                        <h2 style="font-size:1.1rem;margin-bottom:1.2rem;"><?= e(t('contact_info_title')) ?></h2>
                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fab fa-whatsapp"></i></span>
                                <div>
                                    <strong><?= e(t('contact_info_whatsapp')) ?></strong>
                                    <a href="https://wa.me/255697612865" target="_blank" rel="noopener">+255 697 612 865</a>
                                    <p><?= e(t('contact_info_whatsapp_desc')) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fas fa-envelope"></i></span>
                                <div>
                                    <strong><?= e(t('contact_info_email')) ?></strong>
                                    <a href="mailto:serengetibudgetsafari@gmail.com">serengetibudgetsafari@gmail.com</a>
                                    <p><?= e(t('contact_info_email_desc')) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fas fa-phone-alt"></i></span>
                                <div>
                                    <strong><?= e(t('contact_info_phone')) ?></strong>
                                    <a href="tel:+255697612865">+255 697 612 865</a>
                                    <p><?= e(t('contact_info_phone_desc')) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                <div>
                                    <strong><?= e(t('contact_info_office')) ?></strong>
                                    <p style="margin-top:0.15rem;"><?= e(t('contact_info_office_desc')) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fas fa-clock"></i></span>
                                <div>
                                    <strong><?= e(t('contact_info_hours')) ?></strong>
                                    <p style="margin-top:0.15rem;"><?= e(t('contact_info_hours_desc')) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <h2 class="section-title"><?= e(t('contact_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('contact_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('contact_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('contact_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('contact_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('contact_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('contact_faq_a3')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
$extraScripts = ['js/contact-form.js'];
require __DIR__ . '/includes/footer.php';
?>
