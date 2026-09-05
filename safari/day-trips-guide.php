<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'day-trips';
$altPath = 'safari/day-trips-guide.php';
$pageMetaTitle = 'dtg_meta_title';
$pageMetaDescription = 'dtg_meta_description';
$extraStyles = ['css/guide.css'];
$extraScripts = ['js/guide.js'];

require dirname(__DIR__) . '/includes/header.php';
?>

    <div id="guide-progress-bar"></div>
    <button id="guide-back-top" aria-label="Back to top"><?= icon('arrow-up') ?></button>
    <button id="guide-floating-cta" class="show"><?= icon('paper-plane') ?> <?= e(t('dtg_hero_cta_quote')) ?></button>
    <div class="guide-toast" id="guide-toast"></div>

    <!-- ===== BOOKING MODAL ===== -->
    <div class="guide-modal-overlay" id="guideBookingModal">
        <div class="guide-modal-box">
            <button class="guide-close-modal" id="guideCloseModal" aria-label="Close">&times;</button>
            <h3 id="guideModalTitle"><?= e(t('dtg_book_title')) ?></h3>
            <div class="guide-modal-summary">
                <strong id="guideModalPackageName"></strong>
                <span id="guideModalPackagePrice"></span>
            </div>
            <form id="guideBookingFormModal">
                <div class="guide-form-group">
                    <label for="guideModalName"><?= e(t('bsg_form_name')) ?> *</label>
                    <input type="text" id="guideModalName" required>
                </div>
                <div class="guide-form-group">
                    <label for="guideModalEmail"><?= e(t('bsg_form_email')) ?> *</label>
                    <input type="email" id="guideModalEmail" required placeholder="you@example.com">
                </div>
                <div class="guide-form-group">
                    <label for="guideModalPhone"><?= e(t('bsg_form_phone')) ?></label>
                    <input type="tel" id="guideModalPhone" placeholder="+44 123 456 789">
                </div>
                <div class="guide-form-row">
                    <div class="guide-form-group">
                        <label for="guideModalTravelers">Travelers</label>
                        <select id="guideModalTravelers">
                            <option value="1">1</option>
                            <option value="2" selected>2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6+</option>
                        </select>
                    </div>
                    <div class="guide-form-group">
                        <label for="guideModalDate">Preferred Date</label>
                        <input type="date" id="guideModalDate">
                    </div>
                </div>
                <div class="guide-form-group">
                    <label for="guideModalMessage">Special Requests</label>
                    <textarea id="guideModalMessage"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;"><?= e(t('dtg_book_now')) ?></button>
            </form>
            <div class="guide-modal-success" id="guideModalSuccess">
                <h3>✅ <?= e(t('dtg_book_now')) ?></h3>
                <p><?= e(t('dtg_book_p1')) ?></p>
            </div>
        </div>
    </div>

    <!-- ===== HERO ===== -->
    <section class="guide-hero">
        <div class="container guide-container">
            <h1><?= e(t('dtg_h1')) ?></h1>
            <p class="guide-intro"><?= e(t('dtg_hero_intro')) ?></p>
        </div>
    </section>

    <div class="container guide-container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><?= icon('check-circle') ?> <?= e(t('dtg_trust_1')) ?></span>
            <span class="guide-trust-badge"><?= icon('tags') ?> <?= e(t('dtg_trust_2')) ?></span>
            <span class="guide-trust-badge"><?= icon('shield-alt') ?> <?= e(t('dtg_trust_3')) ?></span>
            <span class="guide-trust-badge"><?= icon('truck-monster') ?> <?= e(t('dtg_trust_4')) ?></span>
            <span class="guide-trust-badge"><?= icon('globe-africa') ?> <?= e(t('dtg_trust_5')) ?></span>
            <span class="guide-trust-badge"><?= icon('clipboard-list') ?> <?= e(t('dtg_trust_6')) ?></span>
        </div>
    </div>

    <main>
        <div class="container guide-container">
            <div class="guide-layout guide-page">

                <!-- ===== TOC SIDEBAR (accordion on mobile, static sticky rail on desktop) ===== -->
                <details class="guide-toc" open>
                    <summary><?= icon('list') ?> <span class="guide-toc-summary-title"><?= e(t('dtg_toc_title')) ?></span> <span class="guide-toc-mobile-label"><?= e(t('bsg_toc_jump')) ?></span> <?= icon('chevron-down', 'guide-toc-chevron') ?></summary>
                    <ul>
                        <li><a href="#introduction"><?= e(t('dtg_toc_intro')) ?></a></li>
                        <li><a href="#trips"><?= e(t('dtg_toc_trips')) ?></a></li>
                        <li><a href="#packages"><?= e(t('dtg_toc_packages')) ?></a></li>
                        <li><a href="#local-tips"><?= e(t('dtg_toc_tips')) ?></a></li>
                        <li><a href="#prices"><?= e(t('dtg_toc_prices')) ?></a></li>
                        <li><a href="#best-time"><?= e(t('dtg_toc_best_time')) ?></a></li>
                        <li><a href="#packing"><?= e(t('dtg_toc_packing')) ?></a></li>
                        <li><a href="#faq"><?= e(t('dtg_toc_faq')) ?></a></li>
                        <li><a href="#book"><?= e(t('dtg_toc_book')) ?></a></li>
                    </ul>
                </details>

                <!-- ===== MAIN CONTENT ===== -->
                <div class="guide-main">

                    <!-- INTRODUCTION -->
                    <div class="guide-section-head">
                        <h2 id="introduction"><?= e(t('dtg_intro_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('introduction')) ?></span>
                        <p class="guide-intro-lead"><?= e(t('dtg_intro_p1')) ?></p>
                    </div>
                    <details class="guide-expandable-text">
                        <p><?= e(t('dtg_intro_p2')) ?></p>
                        <div class="guide-quote-card">
                            <span class="guide-quote-icon"><?= icon('quote-left') ?></span>
                            <p><?= t('dtg_intro_box') ?></p>
                        </div>
                        <summary class="guide-expand-toggle">
                            <span class="expand-label-more"><?= e(t('bsg_read_more')) ?></span>
                            <span class="expand-label-less"><?= e(t('bsg_read_less')) ?></span>
                            <?= icon('chevron-down') ?>
                        </summary>
                    </details>

                    <!-- ALL TRIPS -->
                    <div class="guide-section-head">
                        <h2 id="trips"><?= e(t('dtg_trips_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('trips')) ?></span>
                        <p><?= e(t('dtg_trips_p1')) ?></p>
                    </div>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('dtg_trip' . $i . '_name') ?></h4>
                            <p><?= t('dtg_trip' . $i . '_desc') ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- PACKAGES -->
                    <div class="guide-section-head">
                        <h2 id="packages"><?= e(t('dtg_packages_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('packages')) ?></span>
                        <p><?= e(t('dtg_packages_p1')) ?></p>
                    </div>
                    <ul class="guide-checklist">
                        <li><?= e(t('dtg_packages_inc1')) ?></li>
                        <li><?= e(t('dtg_packages_inc2')) ?></li>
                        <li><?= e(t('dtg_packages_inc3')) ?></li>
                        <li><?= e(t('dtg_packages_inc4')) ?></li>
                        <li><?= e(t('dtg_packages_inc5')) ?></li>
                        <li><?= e(t('dtg_packages_inc6')) ?></li>
                    </ul>

                    <div class="guide-package-grid">
                        <?php
                        $packages = [
                            ['n' => 1, 'popular' => false],
                            ['n' => 2, 'popular' => false],
                            ['n' => 3, 'popular' => false],
                            ['n' => 4, 'popular' => true],
                            ['n' => 5, 'popular' => false],
                            ['n' => 6, 'popular' => false],
                        ];
                        foreach ($packages as $pkg):
                            $i = $pkg['n'];
                        ?>
                        <div class="guide-package-card">
                            <?php if ($pkg['popular']): ?>
                                <span class="badge-popular"><?= e(t('dtg_pkg' . $i . '_popular')) ?></span>
                            <?php endif; ?>
                            <span class="guide-days"><?= e(t('dtg_pkg' . $i . '_days')) ?></span>
                            <h3><?= t('dtg_pkg' . $i . '_name') ?></h3>
                            <div class="guide-route"><?= t('dtg_pkg' . $i . '_route') ?></div>
                            <div class="guide-price"><span class="from-label"><?= e(t('dtg_from')) ?></span><?= e(t('dtg_pkg' . $i . '_price')) ?> <small><?= e(t('dtg_pp')) ?></small></div>
                            <ul class="guide-features">
                                <li><?= t('dtg_pkg' . $i . '_f1') ?></li>
                                <li><?= t('dtg_pkg' . $i . '_f2') ?></li>
                                <li><?= t('dtg_pkg' . $i . '_f3') ?></li>
                                <li><?= t('dtg_pkg' . $i . '_f4') ?></li>
                            </ul>
                            <span class="guide-trust-small"><?= icon('fire') ?> <?= e(t('dtg_pkg' . $i . '_trust')) ?></span>
                            <button type="button" class="btn btn-primary" data-package="<?= e(t('dtg_pkg' . $i . '_name')) ?>" data-price="<?= e(t('dtg_pkg' . $i . '_price')) ?>"><?= e(t('dtg_book_now')) ?></button>
                            <div class="guide-guarantee"><?= e(t('dtg_guarantee')) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <p style="text-align:center;"><strong><?= sprintf(t('dtg_packages_custom'), url('contact.php')) ?></strong></p>

                    <!-- LOCAL TIPS -->
                    <div class="guide-section-head">
                        <h2 id="local-tips"><?= e(t('dtg_tips_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('local-tips')) ?></span>
                        <p><?= e(t('dtg_tips_p1')) ?></p>
                    </div>
                    <?php for ($i = 1; $i <= 8; $i++):
                        [$tipSummary, $tipBody] = guide_split_tip(t('dtg_tip' . $i));
                    ?>
                        <details class="guide-tip">
                            <summary><span><span class="tip-number"><?= $i ?>.</span> <?= $tipSummary ?></span> <?= icon('chevron-down', 'tip-chevron') ?></summary>
                            <p><?= $tipBody ?></p>
                        </details>
                    <?php endfor; ?>

                    <!-- PRICE GUIDE -->
                    <div class="guide-section-head">
                        <h2 id="prices"><?= e(t('dtg_prices_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('prices')) ?></span>
                        <p><?= e(t('dtg_prices_p1')) ?></p>
                    </div>
                    <div class="guide-table-wrap">
                        <table>
                            <thead>
                                <tr><th><?= e(t('dtg_prices_th1')) ?></th><th><?= e(t('dtg_prices_th2')) ?></th><th><?= e(t('dtg_prices_th3')) ?></th></tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                <tr>
                                    <td><strong><?= t('dtg_prices_row' . $i . '_label') ?></strong></td>
                                    <td><?= e(t('dtg_prices_row' . $i . '_dist')) ?></td>
                                    <td><?= e(t('dtg_prices_row' . $i . '_price')) ?></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="guide-box insider"><p><?= t('dtg_prices_insider') ?></p></div>

                    <!-- BEST TIME -->
                    <div class="guide-section-head">
                        <h2 id="best-time"><?= e(t('dtg_best_time_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('best-time')) ?></span>
                        <p><?= e(t('dtg_best_time_p1')) ?></p>
                    </div>
                    <ul>
                        <li><?= t('dtg_best_time_li1') ?></li>
                        <li><?= t('dtg_best_time_li2') ?></li>
                        <li><?= t('dtg_best_time_li3') ?></li>
                        <li><?= t('dtg_best_time_li4') ?></li>
                    </ul>
                    <div class="guide-box highlight"><p><?= t('dtg_best_time_box') ?></p></div>

                    <!-- PACKING -->
                    <div class="guide-section-head">
                        <h2 id="packing"><?= e(t('dtg_packing_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('packing')) ?></span>
                        <p><?= e(t('dtg_packing_p1')) ?></p>
                    </div>
                    <ul>
                        <li><?= e(t('dtg_packing_li1')) ?></li>
                        <li><?= e(t('dtg_packing_li2')) ?></li>
                        <li><?= e(t('dtg_packing_li3')) ?></li>
                        <li><?= e(t('dtg_packing_li4')) ?></li>
                        <li><?= e(t('dtg_packing_li5')) ?></li>
                        <li><?= e(t('dtg_packing_li6')) ?></li>
                        <li><?= e(t('dtg_packing_li7')) ?></li>
                    </ul>

                    <!-- FAQ -->
                    <div class="guide-section-head">
                        <h2 id="faq"><?= e(t('dtg_faq_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('faq')) ?></span>
                    </div>
                    <div class="faq-column">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="faq-item-acc">
                            <div class="faq-question-acc"><?= e(t('dtg_faq_q' . $i)) ?> <span><?= icon('chevron-down') ?></span></div>
                            <div class="faq-answer-acc"><p><?= e(t('dtg_faq_a' . $i)) ?></p></div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- BOOKING FORM -->
                    <div class="guide-section-head">
                        <h2 id="book"><?= e(t('dtg_book_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('book')) ?></span>
                        <p><?= e(t('dtg_book_p1')) ?></p>
                    </div>
                    <div class="guide-cta-box">
                        <h3><?= e(t('dtg_cta_title')) ?></h3>
                        <p><?= e(t('dtg_cta_p')) ?></p>
                        <div class="btn-group" style="justify-content:center;">
                            <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('dtg_cta_button')) ?></a>
                        </div>
                    </div>

                    <!-- SHARE / PRINT -->
                    <div class="guide-share-row">
                        <div class="guide-share-buttons">
                            <span><?= e(t('dtg_share_label')) ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="mailto:?subject=<?= rawurlencode(t('dtg_h1')) ?>&amp;body=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" class="guide-share-btn"><?= icon('envelope') ?> Email</a>
                        </div>
                        <button type="button" class="guide-print-btn"><?= icon('print') ?> <?= e(t('dtg_print')) ?></button>
                    </div>

                </div>
                <!-- end guide-main -->
            </div>
            <!-- end guide-layout -->
        </div>
    </main>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
