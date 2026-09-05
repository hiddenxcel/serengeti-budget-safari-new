<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/budget-safari-guide.php';
$pageMetaTitle = 'bsg_meta_title';
$pageMetaDescription = 'bsg_meta_description';
$extraStyles = ['css/guide.css'];
$extraScripts = ['js/guide.js'];

require dirname(__DIR__) . '/includes/header.php';
?>

    <div id="guide-progress-bar"></div>
    <button id="guide-back-top" aria-label="Back to top"><?= icon('arrow-up') ?></button>
    <button id="guide-floating-cta" class="show"><?= icon('paper-plane') ?> <?= e(t('bsg_hero_cta_quote')) ?></button>
    <div class="guide-toast" id="guide-toast"></div>

    <!-- ===== BOOKING MODAL ===== -->
    <div class="guide-modal-overlay" id="guideBookingModal">
        <div class="guide-modal-box">
            <button class="guide-close-modal" id="guideCloseModal" aria-label="Close">&times;</button>
            <h3 id="guideModalTitle"><?= e(t('bsg_book_title')) ?></h3>
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
                        <label for="guideModalDate">Preferred Start Date</label>
                        <input type="date" id="guideModalDate">
                    </div>
                </div>
                <div class="guide-form-group">
                    <label for="guideModalMessage">Special Requests</label>
                    <textarea id="guideModalMessage"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;"><?= e(t('bsg_book_now')) ?></button>
            </form>
            <div class="guide-modal-success" id="guideModalSuccess">
                <h3>✅ <?= e(t('bsg_book_now')) ?></h3>
                <p><?= e(t('bsg_book_p1')) ?></p>
            </div>
        </div>
    </div>

    <!-- ===== HERO ===== -->
    <section class="guide-hero">
        <div class="container guide-container">
            <h1><?= e(t('bsg_h1')) ?></h1>
            <p class="guide-intro"><?= e(t('bsg_hero_intro')) ?></p>
        </div>
    </section>

    <div class="container guide-container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><?= icon('check-circle') ?> <?= e(t('bsg_trust_1')) ?></span>
            <span class="guide-trust-badge"><?= icon('tags') ?> <?= e(t('bsg_trust_2')) ?></span>
            <span class="guide-trust-badge"><?= icon('shield-alt') ?> <?= e(t('bsg_trust_3')) ?></span>
            <span class="guide-trust-badge"><?= icon('truck-monster') ?> <?= e(t('bsg_trust_4')) ?></span>
            <span class="guide-trust-badge"><?= icon('globe-africa') ?> <?= e(t('bsg_trust_5')) ?></span>
            <span class="guide-trust-badge"><?= icon('clipboard-list') ?> <?= e(t('bsg_trust_6')) ?></span>
        </div>
    </div>

    <main>
        <div class="container guide-container">
            <div class="guide-layout guide-page">

                <!-- ===== TOC SIDEBAR (accordion on mobile, static sticky rail on desktop) ===== -->
                <details class="guide-toc" open>
                    <summary><?= icon('list') ?> <span class="guide-toc-summary-title"><?= e(t('bsg_toc_title')) ?></span> <span class="guide-toc-mobile-label"><?= e(t('bsg_toc_jump')) ?></span> <?= icon('chevron-down', 'guide-toc-chevron') ?></summary>
                    <ul>
                        <li><a href="#introduction"><?= e(t('bsg_toc_intro')) ?></a></li>
                        <li><a href="#quick-answer"><?= e(t('bsg_toc_quick_answer')) ?></a></li>
                        <li><a href="#packages"><?= e(t('bsg_toc_packages')) ?></a></li>
                        <li><a href="#cost-breakdown"><?= e(t('bsg_toc_cost')) ?></a></li>
                        <li><a href="#parks"><?= e(t('bsg_toc_parks')) ?></a></li>
                        <li><a href="#accommodation"><?= e(t('bsg_toc_accommodation')) ?></a></li>
                        <li><a href="#local-tips"><?= e(t('bsg_toc_tips')) ?></a></li>
                        <li><a href="#best-time"><?= e(t('bsg_toc_best_time')) ?></a></li>
                        <li><a href="#itineraries"><?= e(t('bsg_toc_itineraries')) ?></a></li>
                        <li><a href="#faq"><?= e(t('bsg_toc_faq')) ?></a></li>
                        <li><a href="#book"><?= e(t('bsg_toc_book')) ?></a></li>
                    </ul>
                </details>

                <!-- ===== MAIN CONTENT ===== -->
                <div class="guide-main">

                    <!-- INTRODUCTION -->
                    <div class="guide-section-head">
                        <h2 id="introduction"><?= e(t('bsg_intro_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('introduction')) ?></span>
                        <p class="guide-intro-lead"><?= t('bsg_intro_p1') ?></p>
                    </div>
                    <details class="guide-expandable-text">
                        <p><?= t('bsg_intro_p2') ?></p>
                        <p><?= t('bsg_intro_p3') ?></p>
                        <div class="guide-quote-card">
                            <span class="guide-quote-icon"><?= icon('quote-left') ?></span>
                            <p><?= t('bsg_intro_box') ?></p>
                        </div>
                        <summary class="guide-expand-toggle">
                            <span class="expand-label-more"><?= e(t('bsg_read_more')) ?></span>
                            <span class="expand-label-less"><?= e(t('bsg_read_less')) ?></span>
                            <?= icon('chevron-down') ?>
                        </summary>
                    </details>

                    <!-- QUICK ANSWER -->
                    <div class="guide-section-head">
                        <h2 id="quick-answer"><?= e(t('bsg_quick_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('quick-answer')) ?></span>
                        <p><?= t('bsg_quick_p1') ?></p>
                    </div>
                    <div class="guide-factor-grid">
                        <div class="guide-factor-card"><p><?= t('bsg_quick_li1') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('bsg_quick_li2') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('bsg_quick_li3') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('bsg_quick_li4') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('bsg_quick_li5') ?></p></div>
                    </div>
                    <div class="guide-price-answer">
                        <div class="guide-price-answer-figure"><?= e(t('bsg_price_highlight')) ?></div>
                        <p><?= t('bsg_quick_p2') ?></p>
                        <a href="#cost-breakdown" class="guide-price-answer-link"><?= e(t('bsg_quick_see_breakdown')) ?> <?= icon('arrow-right') ?></a>
                    </div>
                    <div class="guide-box pro-tip"><p><?= t('bsg_quick_pro') ?></p></div>

                    <!-- PACKAGES -->
                    <div class="guide-section-head">
                        <h2 id="packages"><?= e(t('bsg_packages_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('packages')) ?></span>
                        <p><?= e(t('bsg_packages_p1')) ?></p>
                    </div>
                    <ul class="guide-checklist">
                        <li><?= e(t('bsg_packages_inc1')) ?></li>
                        <li><?= e(t('bsg_packages_inc2')) ?></li>
                        <li><?= e(t('bsg_packages_inc3')) ?></li>
                        <li><?= e(t('bsg_packages_inc4')) ?></li>
                        <li><?= e(t('bsg_packages_inc5')) ?></li>
                        <li><?= e(t('bsg_packages_inc6')) ?></li>
                    </ul>

                    <div class="guide-package-grid">
                        <?php
                        $packages = [
                            ['n' => 1, 'popular' => false],
                            ['n' => 2, 'popular' => false],
                            ['n' => 3, 'popular' => true],
                            ['n' => 4, 'popular' => false],
                            ['n' => 5, 'popular' => false],
                            ['n' => 6, 'popular' => false],
                        ];
                        foreach ($packages as $pkg):
                            $i = $pkg['n'];
                        ?>
                        <div class="guide-package-card">
                            <?php if ($pkg['popular']): ?>
                                <span class="badge-popular"><?= e(t('bsg_pkg' . $i . '_popular')) ?></span>
                            <?php endif; ?>
                            <span class="guide-days"><?= e(t('bsg_pkg' . $i . '_days')) ?></span>
                            <h3><?= t('bsg_pkg' . $i . '_name') ?></h3>
                            <div class="guide-route"><?= t('bsg_pkg' . $i . '_route') ?></div>
                            <div class="guide-price"><span class="from-label"><?= e(t('bsg_from')) ?></span><?= e(t('bsg_pkg' . $i . '_price')) ?> <small><?= e(t('bsg_pp')) ?></small></div>
                            <ul class="guide-features">
                                <li><?= t('bsg_pkg' . $i . '_f1') ?></li>
                                <li><?= t('bsg_pkg' . $i . '_f2') ?></li>
                                <li><?= t('bsg_pkg' . $i . '_f3') ?></li>
                                <li><?= t('bsg_pkg' . $i . '_f4') ?></li>
                            </ul>
                            <span class="guide-trust-small"><?= icon('fire') ?> <?= e(t('bsg_pkg' . $i . '_trust')) ?></span>
                            <button type="button" class="btn btn-primary" data-package="<?= e(t('bsg_pkg' . $i . '_name')) ?>" data-price="<?= e(t('bsg_pkg' . $i . '_price')) ?>"><?= e(t('bsg_book_now')) ?></button>
                            <div class="guide-guarantee"><?= e(t('bsg_guarantee')) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <p style="text-align:center;"><strong><?= sprintf(t('bsg_packages_custom'), url('contact.php')) ?></strong></p>

                    <!-- COST BREAKDOWN -->
                    <div class="guide-section-head">
                        <h2 id="cost-breakdown"><?= e(t('bsg_cost_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('cost-breakdown')) ?></span>
                        <p><?= e(t('bsg_cost_p1')) ?></p>
                    </div>
                    <div class="guide-table-wrap">
                        <table>
                            <thead>
                                <tr><th><?= e(t('bsg_cost_th1')) ?></th><th><?= e(t('bsg_cost_th2')) ?></th><th><?= e(t('bsg_cost_th3')) ?></th></tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td><strong><?= t('bsg_cost_row' . $i . '_label') ?></strong></td>
                                    <td><?= e(t('bsg_cost_row' . $i . '_desc')) ?></td>
                                    <td><?= e(t('bsg_cost_row' . $i . '_pct')) ?></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="guide-box insider"><p><?= t('bsg_cost_insider') ?></p></div>

                    <!-- PARKS -->
                    <div class="guide-section-head">
                        <h2 id="parks"><?= e(t('bsg_parks_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('parks')) ?></span>
                        <p><?= e(t('bsg_parks_p1')) ?></p>
                    </div>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('bsg_park' . $i . '_name') ?> <span class="guide-tier-tag <?= e(t('bsg_park' . $i . '_tier')) ?>"><?= e(t('bsg_park' . $i . '_tier')) ?></span></h4>
                            <p><span class="guide-fee-pill"><?= e(t('bsg_park' . $i . '_fee')) ?></span></p>
                            <details class="guide-item-more">
                                <p><?= t('bsg_park' . $i . '_desc') ?></p>
                                <p><small><?= t('bsg_park' . $i . '_best') ?></small></p>
                                <summary class="guide-item-toggle">
                                    <span class="expand-label-more"><?= e(t('bsg_read_more')) ?></span>
                                    <span class="expand-label-less"><?= e(t('bsg_read_less')) ?></span>
                                    <?= icon('chevron-down') ?>
                                </summary>
                            </details>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <p><em><?= e(t('bsg_parks_legend')) ?></em></p>
                    <div class="guide-box highlight"><p><?= t('bsg_parks_strategy') ?></p></div>

                    <!-- ACCOMMODATION -->
                    <div class="guide-section-head">
                        <h2 id="accommodation"><?= e(t('bsg_acc_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('accommodation')) ?></span>
                        <p><?= e(t('bsg_acc_p1')) ?></p>
                    </div>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('bsg_acc' . $i . '_name') ?></h4>
                            <p><strong><?= t('bsg_acc' . $i . '_price') ?></strong></p>
                            <p><?= icon('map-marker-alt') ?> <?= t('bsg_acc' . $i . '_loc') ?></p>
                            <p><?= t('bsg_acc' . $i . '_desc') ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <div class="guide-box pro-tip"><p><?= t('bsg_acc_tip') ?></p></div>

                    <!-- LOCAL TIPS -->
                    <div class="guide-section-head">
                        <h2 id="local-tips"><?= e(t('bsg_tips_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('local-tips')) ?></span>
                        <p><?= e(t('bsg_tips_p1')) ?></p>
                    </div>
                    <?php for ($i = 1; $i <= 10; $i++):
                        [$tipSummary, $tipBody] = guide_split_tip(t('bsg_tip' . $i));
                    ?>
                        <details class="guide-tip">
                            <summary><span><span class="tip-number"><?= $i ?>.</span> <?= $tipSummary ?></span> <?= icon('chevron-down', 'tip-chevron') ?></summary>
                            <p><?= $tipBody ?></p>
                        </details>
                    <?php endfor; ?>

                    <!-- BEST TIME -->
                    <div class="guide-section-head">
                        <h2 id="best-time"><?= e(t('bsg_best_time_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('best-time')) ?></span>
                        <p><?= e(t('bsg_best_time_p1')) ?></p>
                    </div>
                    <div class="guide-month-grid">
                        <?php
                        $months = [
                            'jan' => 'high', 'feb' => 'high', 'mar' => 'shoulder', 'apr' => '',
                            'may' => '', 'jun' => 'high', 'jul' => 'high', 'aug' => 'high',
                            'sep' => 'high', 'oct' => 'shoulder', 'nov' => 'shoulder', 'dec' => 'shoulder',
                        ];
                        $monthLabels = ['jan' => 'Jan', 'feb' => 'Feb', 'mar' => 'Mar', 'apr' => 'Apr', 'may' => 'May', 'jun' => 'Jun', 'jul' => 'Jul', 'aug' => 'Aug', 'sep' => 'Sep', 'oct' => 'Oct', 'nov' => 'Nov', 'dec' => 'Dec'];
                        foreach ($months as $key => $tier):
                        ?>
                        <div class="guide-month-cell <?= e($tier) ?>">
                            <strong><?= e($monthLabels[$key]) ?></strong>
                            <span><?= e(t('bsg_month_' . $key)) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="guide-box highlight"><p><?= t('bsg_best_time_box') ?></p></div>

                    <!-- ITINERARIES -->
                    <div class="guide-section-head">
                        <h2 id="itineraries"><?= e(t('bsg_itin_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('itineraries')) ?></span>
                        <p><?= e(t('bsg_itin_p1')) ?></p>
                    </div>
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                    <div class="guide-itinerary-card">
                        <h4><?= t('bsg_itin' . $i . '_name') ?> <span class="guide-itinerary-days"><?= e(t('bsg_itin' . $i . '_days')) ?></span></h4>
                        <div class="guide-itinerary-route"><?= t('bsg_itin' . $i . '_route') ?></div>
                        <div class="guide-itinerary-detail"><p><?= t('bsg_itin' . $i . '_detail') ?></p></div>
                        <div class="guide-itinerary-price"><?= e(t('bsg_itin' . $i . '_price')) ?></div>
                    </div>
                    <?php endfor; ?>

                    <!-- FAQ -->
                    <div class="guide-section-head">
                        <h2 id="faq"><?= e(t('bsg_faq_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('faq')) ?></span>
                    </div>
                    <div class="faq-column">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="faq-item-acc">
                            <div class="faq-question-acc"><?= e(t('bsg_faq_q' . $i)) ?> <span><?= icon('chevron-down') ?></span></div>
                            <div class="faq-answer-acc"><p><?= e(t('bsg_faq_a' . $i)) ?></p></div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- BOOKING FORM -->
                    <div class="guide-section-head">
                        <h2 id="book"><?= e(t('bsg_book_title')) ?></h2>
                        <span class="guide-section-tagline"><?= e(guide_tagline('book')) ?></span>
                        <p><?= e(t('bsg_book_p1')) ?></p>
                    </div>
                    <div class="guide-cta-box">
                        <h3><?= e(t('bsg_cta_title')) ?></h3>
                        <p><?= e(t('bsg_cta_p')) ?></p>
                        <div class="btn-group" style="justify-content:center;">
                            <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('bsg_cta_button')) ?></a>
                        </div>
                    </div>

                    <!-- SHARE / PRINT -->
                    <div class="guide-share-row">
                        <div class="guide-share-buttons">
                            <span><?= e(t('bsg_share_label')) ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="mailto:?subject=<?= rawurlencode(t('bsg_h1')) ?>&amp;body=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" class="guide-share-btn"><?= icon('envelope') ?> Email</a>
                        </div>
                        <button type="button" class="guide-print-btn"><?= icon('print') ?> <?= e(t('bsg_print')) ?></button>
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
