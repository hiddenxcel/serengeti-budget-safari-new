<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/how-much-does-a-safari-cost.php';
$pageMetaTitle = 'blogcost_meta_title';
$pageMetaDescription = 'blogcost_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_budget')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogcost_updated')) ?></span>
            </div>
            <h1><?= e(t('blogcost_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogcost_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><i class="fas fa-user-pen"></i> <?= e(t('blogcost_author')) ?></span>
                <span><i class="fas fa-clock"></i> 8 <?= e(t('blog_min_read')) ?></span>
                <span><i class="fas fa-calendar"></i> <?= e(t('blogcost_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><i class="fas fa-bolt"></i> <?= e(t('blogcost_quick_badge')) ?></span>
                    <h2><?= e(t('blogcost_quick_title')) ?></h2>
                    <p><?= e(t('blogcost_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-wallet"></i></span>
                            <div><h4><?= e(t('blogcost_qq1_q')) ?></h4><p><?= e(t('blogcost_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-crown"></i></span>
                            <div><h4><?= e(t('blogcost_qq2_q')) ?></h4><p><?= e(t('blogcost_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-ticket"></i></span>
                            <div><h4><?= e(t('blogcost_qq3_q')) ?></h4><p><?= e(t('blogcost_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-users"></i></span>
                            <div><h4><?= e(t('blogcost_qq4_q')) ?></h4><p><?= e(t('blogcost_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-plus"></i></span>
                            <div><h4><?= e(t('blogcost_qq5_q')) ?></h4><p><?= e(t('blogcost_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-triangle-exclamation"></i></span>
                            <div><h4><?= e(t('blogcost_qq6_q')) ?></h4><p><?= e(t('blogcost_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogcost_see_faq')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><i class="fas fa-list-ul"></i> <?= e(t('blogcost_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#short-answer">💡 <?= e(t('blogcost_toc_1')) ?></a></li>
                        <li><a href="#park-fees">🎫 <?= e(t('blogcost_toc_2')) ?></a></li>
                        <li><a href="#accommodation">🏕️ <?= e(t('blogcost_toc_3')) ?></a></li>
                        <li><a href="#vehicle">🚙 <?= e(t('blogcost_toc_4')) ?></a></li>
                        <li><a href="#not-included">➕ <?= e(t('blogcost_toc_5')) ?></a></li>
                        <li><a href="#save">💰 <?= e(t('blogcost_toc_6')) ?></a></li>
                        <li><a href="#examples">🧾 <?= e(t('blogcost_toc_7')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogcost_toc_8')) ?></a></li>
                    </ul>
                </nav>

                <!-- Short answer -->
                <section id="short-answer" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-circle-info"></i> <?= e(t('blogcost_s1_badge')) ?></span>
                    <h2><?= e(t('blogcost_s1_title')) ?></h2>
                    <p><?= t('blogcost_s1_p1') ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t1_h1')) ?></th><th><?= e(t('blogcost_t1_h2')) ?></th><th><?= e(t('blogcost_t1_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogcost_t1_r1_a')) ?></strong></td><td>€200–250</td><td><?= e(t('blogcost_t1_r1_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogcost_t1_r2_a')) ?></strong></td><td>€250–350</td><td><?= e(t('blogcost_t1_r2_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogcost_t1_r3_a')) ?></strong></td><td>€400+</td><td><?= e(t('blogcost_t1_r3_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogcost_t1_r4_a')) ?></strong></td><td>€600+</td><td><?= e(t('blogcost_t1_r4_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><?= e(t('blogcost_s1_p2')) ?></p>
                </section>

                <!-- Related safari CTA (embedded mid-article) -->
                <a href="<?= url('safari/5-day-serengeti-ngorongoro-safari.php') ?>" class="article-safari-cta">
                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="5-Day Serengeti & Ngorongoro Safari" loading="lazy" />
                    <div class="article-safari-cta-body">
                        <span><?= e(t('blogcost_cta_label')) ?></span>
                        <strong><?= e(t('blogcost_cta_title')) ?></strong>
                        <em><?= e(t('blogcost_cta_price')) ?></em>
                    </div>
                    <i class="fas fa-arrow-right" style="font-size:1.3rem;"></i>
                </a>

                <!-- Park fees -->
                <section id="park-fees" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-ticket"></i> <?= e(t('blogcost_s2_badge')) ?></span>
                    <h2><?= e(t('blogcost_s2_title')) ?></h2>
                    <p><?= t('blogcost_s2_p1') ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t2_h1')) ?></th><th><?= e(t('blogcost_t2_h2')) ?></th><th><?= e(t('blogcost_t2_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td>Serengeti</td><td>$82.60</td><td>$59.00</td></tr>
                                <tr><td>Ngorongoro</td><td>$82.60 + $295 <?= e(t('blogcost_per_vehicle')) ?></td><td>$59.00</td></tr>
                                <tr><td>Tarangire</td><td>$59.00</td><td>$47.20</td></tr>
                                <tr><td>Lake Manyara</td><td>$59.00</td><td>$47.20</td></tr>
                                <tr><td>Ruaha / Mikumi</td><td>$35.40</td><td>—</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <h3><?= e(t('blogcost_s2_example_title')) ?></h3>
                    <p><?= e(t('blogcost_s2_example_intro')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t3_h1')) ?></th><th><?= e(t('blogcost_t3_h2')) ?></th><th><?= e(t('blogcost_t3_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogcost_t3_r1_a')) ?></td><td>$59.00 × 2</td><td>$118.00</td></tr>
                                <tr><td><?= e(t('blogcost_t3_r2_a')) ?></td><td>$82.60 × 2 × 2</td><td>$330.40</td></tr>
                                <tr><td><?= e(t('blogcost_t3_r3_a')) ?></td><td>$82.60 × 2</td><td>$165.20</td></tr>
                                <tr><td><?= e(t('blogcost_t3_r4_a')) ?></td><td><?= e(t('blogcost_per_vehicle')) ?></td><td>$295.00</td></tr>
                                <tr><td><strong><?= e(t('blogcost_t3_r5_a')) ?></strong></td><td></td><td><strong>≈ $908.60</strong></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><?= e(t('blogcost_s2_p2')) ?></p>
                </section>

                <!-- Accommodation -->
                <section id="accommodation" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-bed"></i> <?= e(t('blogcost_s3_badge')) ?></span>
                    <h2><?= e(t('blogcost_s3_title')) ?></h2>
                    <p><?= e(t('blogcost_s3_p1')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t4_h1')) ?></th><th><?= e(t('blogcost_t4_h2')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogcost_t4_r1_a')) ?></td><td>$35.40 <?= e(t('blogcost_plus_camping')) ?></td></tr>
                                <tr><td><?= e(t('blogcost_t4_r2_a')) ?></td><td>$60–150</td></tr>
                                <tr><td><?= e(t('blogcost_t4_r3_a')) ?></td><td>$150–400 <?= e(t('blogcost_plus_concession')) ?></td></tr>
                                <tr><td><?= e(t('blogcost_t4_r4_a')) ?></td><td>$200–600 <?= e(t('blogcost_plus_concession')) ?></td></tr>
                                <tr><td><?= e(t('blogcost_t4_r5_a')) ?></td><td>$300–700 <?= e(t('blogcost_plus_concession')) ?></td></tr>
                                <tr><td><?= e(t('blogcost_t4_r6_a')) ?></td><td>$700–1,500+</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><?= t('blogcost_s3_p2') ?></p>
                    <p><a href="<?= url('contact.php') ?>"><?= e(t('blogcost_s3_link')) ?> →</a></p>
                </section>

                <!-- Vehicle & guide -->
                <section id="vehicle" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-truck-field"></i> <?= e(t('blogcost_s4_badge')) ?></span>
                    <h2><?= e(t('blogcost_s4_title')) ?></h2>
                    <p><?= t('blogcost_s4_p1') ?></p>
                    <p><?= e(t('blogcost_s4_p2')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t5_h1')) ?></th><th><?= e(t('blogcost_t5_h2')) ?></th><th><?= e(t('blogcost_t5_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td>2 <?= e(t('blogcost_people')) ?></td><td>50% <?= e(t('blogcost_each')) ?></td><td><?= e(t('blogcost_t5_r1_c')) ?></td></tr>
                                <tr><td>4 <?= e(t('blogcost_people')) ?></td><td>25% <?= e(t('blogcost_each')) ?></td><td><?= e(t('blogcost_t5_r2_c')) ?></td></tr>
                                <tr><td>6 <?= e(t('blogcost_people')) ?></td><td>17% <?= e(t('blogcost_each')) ?></td><td><?= e(t('blogcost_t5_r3_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><?= t('blogcost_s4_p3') ?></p>
                </section>

                <!-- Not included -->
                <section id="not-included" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-plus"></i> <?= e(t('blogcost_s5_badge')) ?></span>
                    <h2><?= e(t('blogcost_s5_title')) ?></h2>
                    <ul class="included-icon-list no">
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s5_i1_t')) ?></strong> — <?= e(t('blogcost_s5_i1_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s5_i2_t')) ?></strong> — <?= e(t('blogcost_s5_i2_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s5_i3_t')) ?></strong> — <?= e(t('blogcost_s5_i3_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s5_i4_t')) ?></strong> — <?= e(t('blogcost_s5_i4_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <?= e(t('blogcost_s5_i5')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s5_i6_t')) ?></strong> — <?= e(t('blogcost_s5_i6_d')) ?></li>
                    </ul>
                    <p style="margin-top:1rem;"><?= t('blogcost_s5_p1') ?></p>
                </section>

                <!-- How to save -->
                <section id="save" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-piggy-bank"></i> <?= e(t('blogcost_s6_badge')) ?></span>
                    <h2><?= e(t('blogcost_s6_title')) ?></h2>
                    <h3><?= e(t('blogcost_s6_sub1')) ?></h3>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save1_t')) ?></strong> — <?= e(t('blogcost_s6_save1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save2_t')) ?></strong> — <?= e(t('blogcost_s6_save2_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save3_t')) ?></strong> — <?= e(t('blogcost_s6_save3_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save4_t')) ?></strong> — <?= e(t('blogcost_s6_save4_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save5_t')) ?></strong> — <?= e(t('blogcost_s6_save5_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogcost_s6_save6_t')) ?></strong> — <?= e(t('blogcost_s6_save6_d')) ?></li>
                    </ul>
                    <h3 style="margin-top:1.4rem;"><?= e(t('blogcost_s6_sub2')) ?></h3>
                    <ul class="included-icon-list no">
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s6_false1_t')) ?></strong> — <?= e(t('blogcost_s6_false1_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s6_false2_t')) ?></strong> — <?= e(t('blogcost_s6_false2_d')) ?></li>
                        <li><i class="fas fa-times-circle"></i> <strong><?= e(t('blogcost_s6_false3_t')) ?></strong> — <?= e(t('blogcost_s6_false3_d')) ?></li>
                    </ul>
                    <div class="migration-badge" style="margin-top:1.4rem;">
                        <i class="fas fa-triangle-exclamation"></i>
                        <span><strong><?= e(t('blogcost_s6_warn_t')) ?></strong> <?= e(t('blogcost_s6_warn_d')) ?></span>
                    </div>
                </section>

                <!-- Real examples -->
                <section id="examples" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-receipt"></i> <?= e(t('blogcost_s7_badge')) ?></span>
                    <h2><?= e(t('blogcost_s7_title')) ?></h2>
                    <p><?= e(t('blogcost_s7_intro')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogcost_t6_h1')) ?></th><th><?= e(t('blogcost_t1_r1_a')) ?></th><th><?= e(t('blogcost_t1_r2_a')) ?></th><th><?= e(t('blogcost_t1_r4_a')) ?></th></tr></thead>
                            <tbody>
                                <tr><td>2 <?= e(t('blogcost_days_tarangire_ngoro')) ?></td><td>~€400</td><td>~€600</td><td>~€1,200</td></tr>
                                <tr><td>3 <?= e(t('blogcost_days_serengeti_ngoro')) ?></td><td>~€750</td><td>~€1,050</td><td>~€1,800</td></tr>
                                <tr><td>4 <?= e(t('blogcost_days_bigfive')) ?></td><td>~€1,000</td><td>~€1,400</td><td>~€2,400</td></tr>
                                <tr><td>6 <?= e(t('blogcost_days_migration')) ?></td><td>~€1,500</td><td>~€2,100</td><td>~€3,600</td></tr>
                                <tr><td>10 <?= e(t('blogcost_days_zanzibar')) ?></td><td>~€2,800</td><td>~€3,500</td><td>~€6,000</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-size:0.85rem;color:var(--text-secondary);"><em><?= e(t('blogcost_s7_note')) ?></em></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('blogcost_faq_badge')) ?></span>
                    <h2><?= e(t('blogcost_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogcost_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogcost_faq_a8')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><i class="fas fa-link"></i> <?= e(t('blogcost_related_badge')) ?></span>
                    <h2><?= e(t('blogcost_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-bed"></i> <?= e(t('blog_art_stay_title')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-calendar-days"></i> <?= e(t('blog_art_besttime_title')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-hand-holding-dollar"></i> <?= e(t('blog_art_tipping_title')) ?></a>
                        <a href="<?= url('parks/serengeti-national-park.php') ?>" class="related-link"><i class="fas fa-paw"></i> <?= e(t('nav_safaris_featured_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><i class="fas fa-book"></i> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><i class="fas fa-binoculars"></i> <?= e(t('blogcost_related_itineraries')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogcost_final_title')) ?></h2>
            <p><?= e(t('blogcost_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogcost_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogcost_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
