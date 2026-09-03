<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/luxury-safari-guide.php';
$pageMetaTitle = 'lsg_meta_title';
$pageMetaDescription = 'lsg_meta_description';
$extraStyles = ['css/guide.css'];
$extraScripts = ['js/guide.js'];

require dirname(__DIR__) . '/includes/header.php';
?>

    <div id="guide-progress-bar"></div>
    <button id="guide-back-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>
    <button id="guide-floating-cta" class="show"><i class="fas fa-paper-plane"></i> <?= e(t('lsg_hero_cta_quote')) ?></button>
    <div class="guide-toast" id="guide-toast"></div>

    <!-- ===== BOOKING MODAL ===== -->
    <div class="guide-modal-overlay" id="guideBookingModal">
        <div class="guide-modal-box">
            <button class="guide-close-modal" id="guideCloseModal" aria-label="Close">&times;</button>
            <h3 id="guideModalTitle"><?= e(t('lsg_book_title')) ?></h3>
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
                <button type="submit" class="btn btn-primary" style="width:100%;"><?= e(t('lsg_book_now')) ?></button>
            </form>
            <div class="guide-modal-success" id="guideModalSuccess">
                <h3>✅ <?= e(t('lsg_book_now')) ?></h3>
                <p><?= e(t('lsg_book_p1')) ?></p>
            </div>
        </div>
    </div>

    <!-- ===== HERO ===== -->
    <section class="guide-hero">
        <div class="container guide-container">
            <h1><?= e(t('lsg_h1')) ?></h1>
            <p class="guide-intro"><?= e(t('lsg_hero_intro')) ?></p>
        </div>
    </section>

    <div class="container guide-container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><i class="fas fa-check-circle"></i> <?= e(t('lsg_trust_1')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-award"></i> <?= e(t('lsg_trust_2')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-shield-alt"></i> <?= e(t('lsg_trust_3')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-truck-monster"></i> <?= e(t('lsg_trust_4')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-hotel"></i> <?= e(t('lsg_trust_5')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-clipboard-list"></i> <?= e(t('lsg_trust_6')) ?></span>
        </div>
    </div>

    <main>
        <div class="container guide-container">
            <div class="guide-layout guide-page">

                <!-- ===== TOC SIDEBAR ===== -->
                <aside class="guide-toc">
                    <h3><?= e(t('lsg_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#introduction"><?= e(t('lsg_toc_intro')) ?></a></li>
                        <li><a href="#quick-answer"><?= e(t('lsg_toc_quick_answer')) ?></a></li>
                        <li><a href="#packages"><?= e(t('lsg_toc_packages')) ?></a></li>
                        <li><a href="#cost-breakdown"><?= e(t('lsg_toc_cost')) ?></a></li>
                        <li><a href="#lodges"><?= e(t('lsg_toc_lodges')) ?></a></li>
                        <li><a href="#experiences"><?= e(t('lsg_toc_experiences')) ?></a></li>
                        <li><a href="#best-time"><?= e(t('lsg_toc_best_time')) ?></a></li>
                        <li><a href="#itineraries"><?= e(t('lsg_toc_itineraries')) ?></a></li>
                        <li><a href="#faq"><?= e(t('lsg_toc_faq')) ?></a></li>
                        <li><a href="#book"><?= e(t('lsg_toc_book')) ?></a></li>
                    </ul>
                </aside>

                <!-- ===== MAIN CONTENT ===== -->
                <div class="guide-main">

                    <!-- INTRODUCTION -->
                    <h2 id="introduction"><?= e(t('lsg_intro_title')) ?></h2>
                    <p class="guide-intro-lead"><?= t('lsg_intro_p1') ?></p>
                    <p><?= t('lsg_intro_p2') ?></p>
                    <p><?= t('lsg_intro_p3') ?></p>
                    <div class="guide-quote-card">
                        <span class="guide-quote-icon"><i class="fas fa-quote-left"></i></span>
                        <p><?= t('lsg_intro_box') ?></p>
                    </div>

                    <!-- QUICK ANSWER -->
                    <h2 id="quick-answer"><?= e(t('lsg_quick_title')) ?></h2>
                    <p><?= t('lsg_quick_p1') ?></p>
                    <div class="guide-factor-grid">
                        <div class="guide-factor-card"><p><?= t('lsg_quick_li1') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('lsg_quick_li2') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('lsg_quick_li3') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('lsg_quick_li4') ?></p></div>
                        <div class="guide-factor-card"><p><?= t('lsg_quick_li5') ?></p></div>
                    </div>
                    <div class="guide-price-answer">
                        <div class="guide-price-answer-figure"><?= e(t('lsg_price_highlight')) ?></div>
                        <p><?= t('lsg_quick_p2') ?></p>
                    </div>
                    <div class="guide-box pro-tip"><p><?= t('lsg_quick_pro') ?></p></div>

                    <!-- PACKAGES -->
                    <h2 id="packages"><?= e(t('lsg_packages_title')) ?></h2>
                    <p><?= e(t('lsg_packages_p1')) ?></p>
                    <ul class="guide-checklist">
                        <li><?= e(t('lsg_packages_inc1')) ?></li>
                        <li><?= e(t('lsg_packages_inc2')) ?></li>
                        <li><?= e(t('lsg_packages_inc3')) ?></li>
                        <li><?= e(t('lsg_packages_inc4')) ?></li>
                        <li><?= e(t('lsg_packages_inc5')) ?></li>
                        <li><?= e(t('lsg_packages_inc6')) ?></li>
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
                                <span class="badge-popular"><?= e(t('lsg_pkg' . $i . '_popular')) ?></span>
                            <?php endif; ?>
                            <span class="guide-days"><?= e(t('lsg_pkg' . $i . '_days')) ?></span>
                            <h3><?= t('lsg_pkg' . $i . '_name') ?></h3>
                            <div class="guide-route"><?= t('lsg_pkg' . $i . '_route') ?></div>
                            <div class="guide-price"><span class="from-label"><?= e(t('lsg_from')) ?></span><?= e(t('lsg_pkg' . $i . '_price')) ?> <small><?= e(t('lsg_pp')) ?></small></div>
                            <ul class="guide-features">
                                <li><?= t('lsg_pkg' . $i . '_f1') ?></li>
                                <li><?= t('lsg_pkg' . $i . '_f2') ?></li>
                                <li><?= t('lsg_pkg' . $i . '_f3') ?></li>
                                <li><?= t('lsg_pkg' . $i . '_f4') ?></li>
                            </ul>
                            <span class="guide-trust-small"><i class="fas fa-star"></i> <?= e(t('lsg_pkg' . $i . '_trust')) ?></span>
                            <button type="button" class="btn btn-primary" data-package="<?= e(t('lsg_pkg' . $i . '_name')) ?>" data-price="<?= e(t('lsg_pkg' . $i . '_price')) ?>"><?= e(t('lsg_book_now')) ?></button>
                            <div class="guide-guarantee"><?= e(t('lsg_guarantee')) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <p style="text-align:center;"><strong><?= sprintf(t('lsg_packages_custom'), url('contact.php')) ?></strong></p>

                    <!-- COST BREAKDOWN -->
                    <h2 id="cost-breakdown"><?= e(t('lsg_cost_title')) ?></h2>
                    <p><?= e(t('lsg_cost_p1')) ?></p>
                    <div class="guide-table-wrap">
                        <table>
                            <thead>
                                <tr><th><?= e(t('lsg_cost_th1')) ?></th><th><?= e(t('lsg_cost_th2')) ?></th><th><?= e(t('lsg_cost_th3')) ?></th></tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td><strong><?= t('lsg_cost_row' . $i . '_label') ?></strong></td>
                                    <td><?= e(t('lsg_cost_row' . $i . '_desc')) ?></td>
                                    <td><?= e(t('lsg_cost_row' . $i . '_pct')) ?></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="guide-box insider"><p><?= t('lsg_cost_insider') ?></p></div>

                    <!-- LODGES -->
                    <h2 id="lodges"><?= e(t('lsg_lodges_title')) ?></h2>
                    <p><?= e(t('lsg_lodges_p1')) ?></p>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('lsg_lodge' . $i . '_name') ?> <span class="guide-tier-tag lodge-rating">★★★★★</span></h4>
                            <p><span class="guide-fee-pill"><?= e(t('lsg_lodge' . $i . '_fee')) ?></span></p>
                            <p><?= t('lsg_lodge' . $i . '_desc') ?></p>
                            <p><small><?= t('lsg_lodge' . $i . '_best') ?></small></p>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- EXPERIENCES -->
                    <h2 id="experiences"><?= e(t('lsg_exp_title')) ?></h2>
                    <p><?= e(t('lsg_exp_p1')) ?></p>
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="guide-tip"><p><?= t('lsg_exp' . $i) ?></p></div>
                    <?php endfor; ?>
                    <div class="guide-box highlight"><p><?= t('lsg_exp_box') ?></p></div>

                    <!-- BEST TIME -->
                    <h2 id="best-time"><?= e(t('lsg_best_time_title')) ?></h2>
                    <p><?= e(t('lsg_best_time_p1')) ?></p>
                    <div class="guide-month-grid">
                        <?php
                        $months = [
                            'jan' => 'high', 'feb' => 'shoulder', 'mar' => 'shoulder', 'apr' => '',
                            'may' => '', 'jun' => 'high', 'jul' => 'high', 'aug' => 'high',
                            'sep' => 'high', 'oct' => 'shoulder', 'nov' => 'shoulder', 'dec' => 'shoulder',
                        ];
                        $monthLabels = ['jan' => 'Jan', 'feb' => 'Feb', 'mar' => 'Mar', 'apr' => 'Apr', 'may' => 'May', 'jun' => 'Jun', 'jul' => 'Jul', 'aug' => 'Aug', 'sep' => 'Sep', 'oct' => 'Oct', 'nov' => 'Nov', 'dec' => 'Dec'];
                        foreach ($months as $key => $tier):
                        ?>
                        <div class="guide-month-cell <?= e($tier) ?>">
                            <strong><?= e($monthLabels[$key]) ?></strong>
                            <span><?= e(t('lsg_month_' . $key)) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="guide-box highlight"><p><?= t('lsg_best_time_box') ?></p></div>

                    <!-- ITINERARIES -->
                    <h2 id="itineraries"><?= e(t('lsg_itin_title')) ?></h2>
                    <p><?= e(t('lsg_itin_p1')) ?></p>
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                    <div class="guide-itinerary-card">
                        <h4><?= t('lsg_itin' . $i . '_name') ?> <span class="guide-itinerary-days"><?= e(t('lsg_itin' . $i . '_days')) ?></span></h4>
                        <div class="guide-itinerary-route"><?= t('lsg_itin' . $i . '_route') ?></div>
                        <div class="guide-itinerary-detail"><p><?= t('lsg_itin' . $i . '_detail') ?></p></div>
                        <div class="guide-itinerary-price"><?= e(t('lsg_itin' . $i . '_price')) ?></div>
                    </div>
                    <?php endfor; ?>

                    <!-- FAQ -->
                    <h2 id="faq"><?= e(t('lsg_faq_title')) ?></h2>
                    <div class="faq-column">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="faq-item-acc">
                            <div class="faq-question-acc"><?= e(t('lsg_faq_q' . $i)) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                            <div class="faq-answer-acc"><p><?= e(t('lsg_faq_a' . $i)) ?></p></div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- BOOKING FORM -->
                    <h2 id="book"><?= e(t('lsg_book_title')) ?></h2>
                    <p><?= e(t('lsg_book_p1')) ?></p>
                    <div class="guide-cta-box">
                        <h3><?= e(t('lsg_cta_title')) ?></h3>
                        <p><?= e(t('lsg_cta_p')) ?></p>
                        <div class="btn-group" style="justify-content:center;">
                            <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('lsg_cta_button')) ?></a>
                        </div>
                    </div>

                    <!-- SHARE / PRINT -->
                    <div class="guide-share-row">
                        <div class="guide-share-buttons">
                            <span><?= e(t('lsg_share_label')) ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="mailto:?subject=<?= rawurlencode(t('lsg_h1')) ?>&amp;body=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" class="guide-share-btn"><i class="fas fa-envelope"></i> Email</a>
                        </div>
                        <button type="button" class="guide-print-btn"><i class="fas fa-print"></i> <?= e(t('lsg_print')) ?></button>
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
