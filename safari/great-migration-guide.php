<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/great-migration-guide.php';
$pageMetaTitle = 'mgg_meta_title';
$pageMetaDescription = 'mgg_meta_description';
$extraStyles = ['css/guide.css'];
$extraScripts = ['js/guide.js'];

require dirname(__DIR__) . '/includes/header.php';
?>

    <div id="guide-progress-bar"></div>
    <button id="guide-back-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>
    <button id="guide-floating-cta" class="show"><i class="fas fa-paper-plane"></i> <?= e(t('mgg_hero_cta_quote')) ?></button>
    <div class="guide-toast" id="guide-toast"></div>

    <!-- ===== BOOKING MODAL ===== -->
    <div class="guide-modal-overlay" id="guideBookingModal">
        <div class="guide-modal-box">
            <button class="guide-close-modal" id="guideCloseModal" aria-label="Close">&times;</button>
            <h3 id="guideModalTitle"><?= e(t('mgg_book_title')) ?></h3>
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
                <button type="submit" class="btn btn-primary" style="width:100%;"><?= e(t('mgg_book_now')) ?></button>
            </form>
            <div class="guide-modal-success" id="guideModalSuccess">
                <h3>✅ <?= e(t('mgg_book_now')) ?></h3>
                <p><?= e(t('mgg_book_p1')) ?></p>
            </div>
        </div>
    </div>

    <!-- ===== HERO ===== -->
    <section class="guide-hero">
        <div class="container guide-container">
            <span class="hero-badge"><i class="fas fa-paw"></i> <?= e(t('mgg_badge')) ?></span>
            <h1><?= e(t('mgg_h1')) ?></h1>
            <div class="guide-price-highlight"><?= e(t('mgg_price_highlight')) ?> <small><?= e(t('mgg_price_highlight_small')) ?></small></div>
            <p class="guide-intro"><?= e(t('mgg_hero_intro')) ?></p>
            <div class="guide-hero-actions">
                <a href="#packages" class="btn btn-primary"><?= e(t('mgg_hero_cta_packages')) ?></a>
                <a href="#book" class="btn btn-light"><?= e(t('mgg_hero_cta_quote')) ?></a>
            </div>
            <div class="guide-hero-stats">
                <div><strong>1.5M+</strong> <?= e(t('mgg_stat_wildebeest')) ?></div>
                <div><strong>200K+</strong> <?= e(t('mgg_stat_zebras')) ?></div>
                <div><strong>800+</strong> <?= e(t('mgg_stat_km')) ?></div>
                <div><strong>15+</strong> <?= e(t('mgg_stat_years')) ?></div>
                <div><strong>30+</strong> <?= e(t('mgg_stat_tips')) ?></div>
            </div>
        </div>
    </section>

    <div class="container guide-container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><i class="fas fa-check-circle"></i> <?= e(t('mgg_trust_1')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-paw"></i> <?= e(t('mgg_trust_2')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-shield-alt"></i> <?= e(t('mgg_trust_3')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-user-tie"></i> <?= e(t('mgg_trust_4')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-award"></i> <?= e(t('mgg_trust_5')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-clipboard-list"></i> <?= e(t('mgg_trust_6')) ?></span>
        </div>
    </div>

    <main>
        <div class="container guide-container">
            <div class="guide-layout guide-page">

                <!-- ===== TOC SIDEBAR ===== -->
                <aside class="guide-toc">
                    <h3><?= e(t('mgg_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#introduction"><?= e(t('mgg_toc_intro')) ?></a></li>
                        <li><a href="#route"><?= e(t('mgg_toc_route')) ?></a></li>
                        <li><a href="#months"><?= e(t('mgg_toc_months')) ?></a></li>
                        <li><a href="#packages"><?= e(t('mgg_toc_packages')) ?></a></li>
                        <li><a href="#crossings"><?= e(t('mgg_toc_crossings')) ?></a></li>
                        <li><a href="#calving"><?= e(t('mgg_toc_calving')) ?></a></li>
                        <li><a href="#accommodation"><?= e(t('mgg_toc_accommodation')) ?></a></li>
                        <li><a href="#best-time"><?= e(t('mgg_toc_best_time')) ?></a></li>
                        <li><a href="#itineraries"><?= e(t('mgg_toc_itineraries')) ?></a></li>
                        <li><a href="#local-tips"><?= e(t('mgg_toc_tips')) ?></a></li>
                        <li><a href="#faq"><?= e(t('mgg_toc_faq')) ?></a></li>
                        <li><a href="#book"><?= e(t('mgg_toc_book')) ?></a></li>
                    </ul>
                </aside>

                <!-- ===== MAIN CONTENT ===== -->
                <div class="guide-main">

                    <!-- INTRODUCTION -->
                    <h2 id="introduction"><?= e(t('mgg_intro_title')) ?></h2>
                    <p><?= t('mgg_intro_p1') ?></p>
                    <p><?= t('mgg_intro_p2') ?></p>
                    <p><?= t('mgg_intro_p3') ?></p>
                    <div class="guide-box highlight"><p><?= t('mgg_intro_box') ?></p></div>

                    <!-- ROUTE -->
                    <h2 id="route"><?= e(t('mgg_route_title')) ?></h2>
                    <p><?= e(t('mgg_route_p1')) ?></p>
                    <div class="guide-box highlight"><p><?= t('mgg_route_box') ?></p></div>
                    <div class="guide-box pro-tip"><p><?= t('mgg_route_tip') ?></p></div>

                    <!-- MONTH BY MONTH -->
                    <h2 id="months"><?= t('mgg_months_title') ?></h2>
                    <p><?= e(t('mgg_months_p1')) ?></p>
                    <div class="guide-month-grid">
                        <?php
                        $months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
                        $monthLabels = ['jan' => 'Jan', 'feb' => 'Feb', 'mar' => 'Mar', 'apr' => 'Apr', 'may' => 'May', 'jun' => 'Jun', 'jul' => 'Jul', 'aug' => 'Aug', 'sep' => 'Sep', 'oct' => 'Oct', 'nov' => 'Nov', 'dec' => 'Dec'];
                        $tiers = ['jan' => 'high', 'feb' => 'high', 'mar' => 'shoulder', 'apr' => '', 'may' => '', 'jun' => 'high', 'jul' => 'high', 'aug' => 'high', 'sep' => 'high', 'oct' => 'shoulder', 'nov' => 'shoulder', 'dec' => 'shoulder'];
                        foreach ($months as $m):
                        ?>
                        <div class="guide-month-cell <?= e($tiers[$m]) ?>">
                            <strong><?= e($monthLabels[$m]) ?></strong>
                            <span><?= e(t('mgg_month_' . $m)) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="guide-item-grid">
                        <?php foreach ($months as $m): ?>
                        <div class="guide-item-card">
                            <h4><?= e($monthLabels[$m]) ?></h4>
                            <p><i class="fas fa-map-marker-alt"></i> <?= t('mgg_m_' . $m . '_loc') ?></p>
                            <p><?= e(t('mgg_m_' . $m . '_desc')) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- PACKAGES -->
                    <h2 id="packages"><?= e(t('mgg_packages_title')) ?></h2>
                    <p><?= e(t('mgg_packages_p1')) ?></p>
                    <ul>
                        <li><?= e(t('mgg_packages_inc1')) ?></li>
                        <li><?= e(t('mgg_packages_inc2')) ?></li>
                        <li><?= e(t('mgg_packages_inc3')) ?></li>
                        <li><?= e(t('mgg_packages_inc4')) ?></li>
                        <li><?= e(t('mgg_packages_inc5')) ?></li>
                        <li><?= e(t('mgg_packages_inc6')) ?></li>
                    </ul>

                    <div class="guide-package-grid">
                        <?php
                        $packages = [
                            ['n' => 1, 'popular' => false],
                            ['n' => 2, 'popular' => true],
                            ['n' => 3, 'popular' => false],
                            ['n' => 4, 'popular' => false],
                            ['n' => 5, 'popular' => false],
                            ['n' => 6, 'popular' => false],
                        ];
                        foreach ($packages as $pkg):
                            $i = $pkg['n'];
                        ?>
                        <div class="guide-package-card">
                            <?php if ($pkg['popular']): ?>
                                <span class="badge-popular"><?= e(t('mgg_pkg' . $i . '_popular')) ?></span>
                            <?php endif; ?>
                            <span class="guide-days"><?= e(t('mgg_pkg' . $i . '_days')) ?></span>
                            <h3><?= t('mgg_pkg' . $i . '_name') ?></h3>
                            <div class="guide-route"><?= t('mgg_pkg' . $i . '_route') ?></div>
                            <div class="guide-price"><span class="from-label"><?= e(t('mgg_from')) ?></span><?= e(t('mgg_pkg' . $i . '_price')) ?> <small><?= e(t('mgg_pp')) ?></small></div>
                            <ul class="guide-features">
                                <li><?= t('mgg_pkg' . $i . '_f1') ?></li>
                                <li><?= t('mgg_pkg' . $i . '_f2') ?></li>
                                <li><?= t('mgg_pkg' . $i . '_f3') ?></li>
                                <li><?= t('mgg_pkg' . $i . '_f4') ?></li>
                            </ul>
                            <span class="guide-trust-small"><i class="fas fa-fire"></i> <?= e(t('mgg_pkg' . $i . '_trust')) ?></span>
                            <button type="button" class="btn btn-primary" data-package="<?= e(t('mgg_pkg' . $i . '_name')) ?>" data-price="<?= e(t('mgg_pkg' . $i . '_price')) ?>"><?= e(t('mgg_book_now')) ?></button>
                            <div class="guide-guarantee"><?= e(t('mgg_guarantee')) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <p style="text-align:center;"><strong><?= sprintf(t('mgg_packages_custom'), url('contact.php')) ?></strong></p>

                    <!-- RIVER CROSSINGS -->
                    <h2 id="crossings"><?= e(t('mgg_crossings_title')) ?></h2>
                    <p><?= e(t('mgg_crossings_p1')) ?></p>
                    <h3><?= e(t('mgg_crossings_grumeti_title')) ?></h3>
                    <p><?= e(t('mgg_crossings_grumeti_p')) ?></p>
                    <div class="guide-box highlight"><p><?= t('mgg_crossings_grumeti_tip') ?></p></div>
                    <h3><?= e(t('mgg_crossings_mara_title')) ?></h3>
                    <p><?= e(t('mgg_crossings_mara_p')) ?></p>
                    <div class="guide-box highlight"><p><?= t('mgg_crossings_mara_tip') ?></p></div>
                    <div class="guide-box pro-tip"><p><?= t('mgg_crossings_pro') ?></p></div>

                    <!-- CALVING -->
                    <h2 id="calving"><?= e(t('mgg_calving_title')) ?></h2>
                    <p><?= t('mgg_calving_p1') ?></p>
                    <p><?= e(t('mgg_calving_p2')) ?></p>
                    <div class="guide-box insider"><p><?= t('mgg_calving_box') ?></p></div>

                    <!-- ACCOMMODATION -->
                    <h2 id="accommodation"><?= e(t('mgg_acc_title')) ?></h2>
                    <p><?= e(t('mgg_acc_p1')) ?></p>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('mgg_acc' . $i . '_name') ?></h4>
                            <p><strong><?= t('mgg_acc' . $i . '_price') ?></strong></p>
                            <p><i class="fas fa-map-marker-alt"></i> <?= t('mgg_acc' . $i . '_loc') ?></p>
                            <p><?= t('mgg_acc' . $i . '_desc') ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <div class="guide-box pro-tip"><p><?= t('mgg_acc_tip') ?></p></div>

                    <!-- BEST TIME -->
                    <h2 id="best-time"><?= e(t('mgg_best_time_title')) ?></h2>
                    <p><?= e(t('mgg_best_time_p1')) ?></p>
                    <div class="guide-month-grid">
                        <?php foreach ($months as $m): ?>
                        <div class="guide-month-cell <?= e($tiers[$m]) ?>">
                            <strong><?= e($monthLabels[$m]) ?></strong>
                            <span><?= e(t('mgg_month_' . $m)) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="guide-box highlight"><p><?= t('mgg_best_time_box') ?></p></div>

                    <!-- ITINERARIES -->
                    <h2 id="itineraries"><?= e(t('mgg_itin_title')) ?></h2>
                    <p><?= e(t('mgg_itin_p1')) ?></p>
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                    <div class="guide-itinerary-card">
                        <h4><?= t('mgg_itin' . $i . '_name') ?> <span class="guide-itinerary-days"><?= e(t('mgg_itin' . $i . '_days')) ?></span></h4>
                        <div class="guide-itinerary-route"><?= t('mgg_itin' . $i . '_route') ?></div>
                        <div class="guide-itinerary-detail"><p><?= t('mgg_itin' . $i . '_detail') ?></p></div>
                        <div class="guide-itinerary-price"><?= e(t('mgg_itin' . $i . '_price')) ?></div>
                    </div>
                    <?php endfor; ?>

                    <!-- LOCAL TIPS -->
                    <h2 id="local-tips"><?= e(t('mgg_tips_title')) ?></h2>
                    <p><?= e(t('mgg_tips_p1')) ?></p>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="guide-tip"><p><?= t('mgg_tip' . $i) ?></p></div>
                    <?php endfor; ?>

                    <!-- FAQ -->
                    <h2 id="faq"><?= e(t('mgg_faq_title')) ?></h2>
                    <div class="faq-column">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="faq-item-acc">
                            <div class="faq-question-acc"><?= e(t('mgg_faq_q' . $i)) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                            <div class="faq-answer-acc"><p><?= e(t('mgg_faq_a' . $i)) ?></p></div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- BOOKING FORM -->
                    <h2 id="book"><?= e(t('mgg_book_title')) ?></h2>
                    <p><?= e(t('mgg_book_p1')) ?></p>
                    <div class="guide-cta-box">
                        <h3><?= e(t('mgg_cta_title')) ?></h3>
                        <p><?= e(t('mgg_cta_p')) ?></p>
                        <div class="btn-group" style="justify-content:center;">
                            <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('mgg_cta_button')) ?></a>
                        </div>
                    </div>

                    <!-- SHARE / PRINT -->
                    <div class="guide-share-row">
                        <div class="guide-share-buttons">
                            <span><?= e(t('mgg_share_label')) ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="mailto:?subject=<?= rawurlencode(t('mgg_h1')) ?>&amp;body=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" class="guide-share-btn"><i class="fas fa-envelope"></i> Email</a>
                        </div>
                        <button type="button" class="guide-print-btn"><i class="fas fa-print"></i> <?= e(t('mgg_print')) ?></button>
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
