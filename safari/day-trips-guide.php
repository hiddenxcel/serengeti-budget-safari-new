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
    <button id="guide-back-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>
    <button id="guide-floating-cta" class="show"><i class="fas fa-paper-plane"></i> <?= e(t('dtg_hero_cta_quote')) ?></button>
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
            <span class="hero-badge"><i class="fas fa-map-marked-alt"></i> <?= e(t('dtg_badge')) ?></span>
            <h1><?= e(t('dtg_h1')) ?></h1>
            <div class="guide-price-highlight"><?= e(t('dtg_price_highlight')) ?> <small><?= e(t('dtg_price_highlight_small')) ?></small></div>
            <p class="guide-intro"><?= e(t('dtg_hero_intro')) ?></p>
            <div class="guide-hero-actions">
                <a href="#packages" class="btn btn-primary"><?= e(t('dtg_hero_cta_packages')) ?></a>
                <a href="#book" class="btn btn-light"><?= e(t('dtg_hero_cta_quote')) ?></a>
            </div>
            <div class="guide-hero-stats">
                <div><strong>15+</strong> <?= e(t('dtg_stat_trips')) ?></div>
                <div><strong>4.8★</strong> <?= e(t('dtg_stat_reviews')) ?></div>
                <div><strong>100%</strong> <?= e(t('dtg_stat_local')) ?></div>
                <div><strong>15+</strong> <?= e(t('dtg_stat_years')) ?></div>
            </div>
        </div>
    </section>

    <div class="container guide-container">
        <div class="guide-trust-badges">
            <span class="guide-trust-badge"><i class="fas fa-check-circle"></i> <?= e(t('dtg_trust_1')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-tags"></i> <?= e(t('dtg_trust_2')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-shield-alt"></i> <?= e(t('dtg_trust_3')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-truck-monster"></i> <?= e(t('dtg_trust_4')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-globe-africa"></i> <?= e(t('dtg_trust_5')) ?></span>
            <span class="guide-trust-badge"><i class="fas fa-clipboard-list"></i> <?= e(t('dtg_trust_6')) ?></span>
        </div>
    </div>

    <main>
        <div class="container guide-container">
            <div class="guide-layout guide-page">

                <!-- ===== TOC SIDEBAR ===== -->
                <aside class="guide-toc">
                    <h3><?= e(t('dtg_toc_title')) ?></h3>
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
                </aside>

                <!-- ===== MAIN CONTENT ===== -->
                <div class="guide-main">

                    <!-- INTRODUCTION -->
                    <h2 id="introduction"><?= e(t('dtg_intro_title')) ?></h2>
                    <p><?= e(t('dtg_intro_p1')) ?></p>
                    <p><?= e(t('dtg_intro_p2')) ?></p>
                    <div class="guide-box highlight"><p><?= t('dtg_intro_box') ?></p></div>

                    <!-- ALL TRIPS -->
                    <h2 id="trips"><?= e(t('dtg_trips_title')) ?></h2>
                    <p><?= e(t('dtg_trips_p1')) ?></p>
                    <div class="guide-item-grid">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="guide-item-card">
                            <h4><?= t('dtg_trip' . $i . '_name') ?></h4>
                            <p><?= t('dtg_trip' . $i . '_desc') ?></p>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- PACKAGES -->
                    <h2 id="packages"><?= e(t('dtg_packages_title')) ?></h2>
                    <p><?= e(t('dtg_packages_p1')) ?></p>
                    <ul>
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
                            <span class="guide-trust-small"><i class="fas fa-fire"></i> <?= e(t('dtg_pkg' . $i . '_trust')) ?></span>
                            <button type="button" class="btn btn-primary" data-package="<?= e(t('dtg_pkg' . $i . '_name')) ?>" data-price="<?= e(t('dtg_pkg' . $i . '_price')) ?>"><?= e(t('dtg_book_now')) ?></button>
                            <div class="guide-guarantee"><?= e(t('dtg_guarantee')) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <p style="text-align:center;"><strong><?= sprintf(t('dtg_packages_custom'), url('contact.php')) ?></strong></p>

                    <!-- LOCAL TIPS -->
                    <h2 id="local-tips"><?= e(t('dtg_tips_title')) ?></h2>
                    <p><?= e(t('dtg_tips_p1')) ?></p>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="guide-tip"><p><?= t('dtg_tip' . $i) ?></p></div>
                    <?php endfor; ?>

                    <!-- PRICE GUIDE -->
                    <h2 id="prices"><?= e(t('dtg_prices_title')) ?></h2>
                    <p><?= e(t('dtg_prices_p1')) ?></p>
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
                    <h2 id="best-time"><?= e(t('dtg_best_time_title')) ?></h2>
                    <p><?= e(t('dtg_best_time_p1')) ?></p>
                    <ul>
                        <li><?= t('dtg_best_time_li1') ?></li>
                        <li><?= t('dtg_best_time_li2') ?></li>
                        <li><?= t('dtg_best_time_li3') ?></li>
                        <li><?= t('dtg_best_time_li4') ?></li>
                    </ul>
                    <div class="guide-box highlight"><p><?= t('dtg_best_time_box') ?></p></div>

                    <!-- PACKING -->
                    <h2 id="packing"><?= e(t('dtg_packing_title')) ?></h2>
                    <p><?= e(t('dtg_packing_p1')) ?></p>
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
                    <h2 id="faq"><?= e(t('dtg_faq_title')) ?></h2>
                    <div class="faq-column">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="faq-item-acc">
                            <div class="faq-question-acc"><?= e(t('dtg_faq_q' . $i)) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                            <div class="faq-answer-acc"><p><?= e(t('dtg_faq_a' . $i)) ?></p></div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- BOOKING FORM -->
                    <h2 id="book"><?= e(t('dtg_book_title')) ?></h2>
                    <p><?= e(t('dtg_book_p1')) ?></p>
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
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" target="_blank" rel="noopener" class="guide-share-btn"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="mailto:?subject=<?= rawurlencode(t('dtg_h1')) ?>&amp;body=<?= urlencode(SITE_URL . base_url() . '/' . $lang . '/' . $altPath) ?>" class="guide-share-btn"><i class="fas fa-envelope"></i> Email</a>
                        </div>
                        <button type="button" class="guide-print-btn"><i class="fas fa-print"></i> <?= e(t('dtg_print')) ?></button>
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
