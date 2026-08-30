<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/best-time-to-visit-tanzania.php';
$pageMetaTitle = 'blogbest_meta_title';
$pageMetaDescription = 'blogbest_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_guides')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogbest_updated')) ?></span>
            </div>
            <h1><?= e(t('blogbest_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogbest_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><i class="fas fa-user-pen"></i> <?= e(t('blogbest_author')) ?></span>
                <span><i class="fas fa-clock"></i> 7 <?= e(t('blog_min_read')) ?></span>
                <span><i class="fas fa-calendar"></i> <?= e(t('blogbest_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><i class="fas fa-bolt"></i> <?= e(t('blogbest_quick_badge')) ?></span>
                    <h2><?= e(t('blogbest_quick_title')) ?></h2>
                    <p><?= e(t('blogbest_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-sun"></i></span>
                            <div><h4><?= e(t('blogbest_qq1_q')) ?></h4><p><?= e(t('blogbest_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-baby"></i></span>
                            <div><h4><?= e(t('blogbest_qq2_q')) ?></h4><p><?= e(t('blogbest_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-water"></i></span>
                            <div><h4><?= e(t('blogbest_qq3_q')) ?></h4><p><?= e(t('blogbest_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-wallet"></i></span>
                            <div><h4><?= e(t('blogbest_qq4_q')) ?></h4><p><?= e(t('blogbest_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-users"></i></span>
                            <div><h4><?= e(t('blogbest_qq5_q')) ?></h4><p><?= e(t('blogbest_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-temperature-low"></i></span>
                            <div><h4><?= e(t('blogbest_qq6_q')) ?></h4><p><?= e(t('blogbest_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogbest_see_faq')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><i class="fas fa-list-ul"></i> <?= e(t('blogbest_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#short-answer">💡 <?= e(t('blogbest_toc_1')) ?></a></li>
                        <li><a href="#seasons">🌧️ <?= e(t('blogbest_toc_2')) ?></a></li>
                        <li><a href="#month-by-month">📅 <?= e(t('blogbest_toc_3')) ?></a></li>
                        <li><a href="#by-interest">🤔 <?= e(t('blogbest_toc_4')) ?></a></li>
                        <li><a href="#temperatures">🌡️ <?= e(t('blogbest_toc_5')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogbest_toc_6')) ?></a></li>
                    </ul>
                </nav>

                <!-- Short answer -->
                <section id="short-answer" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-circle-info"></i> <?= e(t('blogbest_s1_badge')) ?></span>
                    <h2><?= e(t('blogbest_s1_title')) ?></h2>
                    <p><?= t('blogbest_s1_p1') ?></p>
                    <p><?= e(t('blogbest_s1_p2')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogbest_t1_h1')) ?></th><th><?= e(t('blogbest_t1_h2')) ?></th><th><?= e(t('blogbest_t1_h3')) ?></th><th><?= e(t('blogbest_t1_h4')) ?></th><th><?= e(t('blogbest_t1_h5')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogbest_t1_r1_a')) ?></td><td>Jun–Oct</td><td><?= e(t('blogbest_t1_r1_c')) ?></td><td><?= e(t('blogbest_t1_r1_d')) ?></td><td><?= e(t('blogbest_t1_r1_e')) ?></td></tr>
                                <tr><td><?= e(t('blogbest_t1_r2_a')) ?></td><td>Jan–Feb</td><td><?= e(t('blogbest_t1_r2_c')) ?></td><td><?= e(t('blogbest_t1_r2_d')) ?></td><td><?= e(t('blogbest_t1_r2_e')) ?></td></tr>
                                <tr><td><?= e(t('blogbest_t1_r3_a')) ?></td><td>Nov–Dec</td><td><?= e(t('blogbest_t1_r3_c')) ?></td><td><?= e(t('blogbest_t1_r3_d')) ?></td><td><?= e(t('blogbest_t1_r3_e')) ?></td></tr>
                                <tr><td><?= e(t('blogbest_t1_r4_a')) ?></td><td>Mar–May</td><td><?= e(t('blogbest_t1_r4_c')) ?></td><td><?= e(t('blogbest_t1_r4_d')) ?></td><td><?= e(t('blogbest_t1_r4_e')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
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

                <!-- The two rainy seasons -->
                <section id="seasons" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-cloud-rain"></i> <?= e(t('blogbest_s2_badge')) ?></span>
                    <h2><?= e(t('blogbest_s2_title')) ?></h2>
                    <p><?= e(t('blogbest_s2_p1')) ?></p>

                    <h3><?= e(t('blogbest_s2_sub1_title')) ?></h3>
                    <p><?= e(t('blogbest_s2_sub1_p')) ?></p>

                    <h3><?= e(t('blogbest_s2_sub2_title')) ?></h3>
                    <p><?= e(t('blogbest_s2_sub2_p')) ?></p>

                    <div class="migration-badge" style="margin-top:1.4rem;">
                        <i class="fas fa-lightbulb"></i>
                        <span><strong><?= e(t('blogbest_s2_note_t')) ?></strong> <?= e(t('blogbest_s2_note_d')) ?></span>
                    </div>
                </section>

                <!-- Month by month -->
                <section id="month-by-month" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-calendar-days"></i> <?= e(t('blogbest_s3_badge')) ?></span>
                    <h2><?= e(t('blogbest_s3_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogbest_t2_h1')) ?></th><th><?= e(t('blogbest_t2_h2')) ?></th><th><?= e(t('blogbest_t2_h3')) ?></th><th><?= e(t('blogbest_t2_h4')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogbest_m1_name')) ?></strong></td><td><?= e(t('blogbest_m1_weather')) ?></td><td><?= e(t('blogbest_m1_highlights')) ?></td><td><?= e(t('blogbest_m1_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m2_name')) ?></strong></td><td><?= e(t('blogbest_m2_weather')) ?></td><td><?= e(t('blogbest_m2_highlights')) ?></td><td><?= e(t('blogbest_m2_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m3_name')) ?></strong></td><td><?= e(t('blogbest_m3_weather')) ?></td><td><?= e(t('blogbest_m3_highlights')) ?></td><td><?= e(t('blogbest_m3_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m4_name')) ?></strong></td><td><?= e(t('blogbest_m4_weather')) ?></td><td><?= e(t('blogbest_m4_highlights')) ?></td><td><?= e(t('blogbest_m4_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m5_name')) ?></strong></td><td><?= e(t('blogbest_m5_weather')) ?></td><td><?= e(t('blogbest_m5_highlights')) ?></td><td><?= e(t('blogbest_m5_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m6_name')) ?></strong></td><td><?= e(t('blogbest_m6_weather')) ?></td><td><?= e(t('blogbest_m6_highlights')) ?></td><td><?= e(t('blogbest_m6_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m7_name')) ?></strong></td><td><?= e(t('blogbest_m7_weather')) ?></td><td><?= e(t('blogbest_m7_highlights')) ?></td><td><?= e(t('blogbest_m7_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m8_name')) ?></strong></td><td><?= e(t('blogbest_m8_weather')) ?></td><td><?= e(t('blogbest_m8_highlights')) ?></td><td><?= e(t('blogbest_m8_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m9_name')) ?></strong></td><td><?= e(t('blogbest_m9_weather')) ?></td><td><?= e(t('blogbest_m9_highlights')) ?></td><td><?= e(t('blogbest_m9_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m10_name')) ?></strong></td><td><?= e(t('blogbest_m10_weather')) ?></td><td><?= e(t('blogbest_m10_highlights')) ?></td><td><?= e(t('blogbest_m10_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m11_name')) ?></strong></td><td><?= e(t('blogbest_m11_weather')) ?></td><td><?= e(t('blogbest_m11_highlights')) ?></td><td><?= e(t('blogbest_m11_verdict')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_m12_name')) ?></strong></td><td><?= e(t('blogbest_m12_weather')) ?></td><td><?= e(t('blogbest_m12_highlights')) ?></td><td><?= e(t('blogbest_m12_verdict')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Best time by what you want -->
                <section id="by-interest" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-circle-question"></i> <?= e(t('blogbest_s4_badge')) ?></span>
                    <h2><?= e(t('blogbest_s4_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogbest_t3_h1')) ?></th><th><?= e(t('blogbest_t3_h2')) ?></th><th><?= e(t('blogbest_t3_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogbest_w1_want')) ?></strong></td><td>Jun–Oct</td><td><?= e(t('blogbest_w1_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w2_want')) ?></strong></td><td>Aug–Sep</td><td><?= e(t('blogbest_w2_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w3_want')) ?></strong></td><td>Late Jan–Feb</td><td><?= e(t('blogbest_w3_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w4_want')) ?></strong></td><td>Apr–May</td><td><?= e(t('blogbest_w4_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w5_want')) ?></strong></td><td>Apr–May, Nov</td><td><?= e(t('blogbest_w5_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w6_want')) ?></strong></td><td>Nov–Apr</td><td><?= e(t('blogbest_w6_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w7_want')) ?></strong></td><td>Nov–Dec, Feb</td><td><?= e(t('blogbest_w7_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w8_want')) ?></strong></td><td>Jan–Feb, Jun–Oct</td><td><?= e(t('blogbest_w8_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w9_want')) ?></strong></td><td>Jun–Oct, Dec–Feb</td><td><?= e(t('blogbest_w9_why')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogbest_w10_want')) ?></strong></td><td>Jun–Oct</td><td><?= e(t('blogbest_w10_why')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Temperatures -->
                <section id="temperatures" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-temperature-half"></i> <?= e(t('blogbest_s5_badge')) ?></span>
                    <h2><?= e(t('blogbest_s5_title')) ?></h2>
                    <p><?= e(t('blogbest_s5_p1')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogbest_t4_h1')) ?></th><th><?= e(t('blogbest_t4_h2')) ?></th><th><?= e(t('blogbest_t4_h3')) ?></th><th><?= e(t('blogbest_t4_h4')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogbest_c1_place')) ?></td><td>2,300 m</td><td>16–20 °C</td><td><strong>5–10 °C</strong></td></tr>
                                <tr><td><?= e(t('blogbest_c2_place')) ?></td><td>1,500 m</td><td>24–28 °C</td><td>13–15 °C</td></tr>
                                <tr><td><?= e(t('blogbest_c3_place')) ?></td><td>1,400 m</td><td>22–26 °C</td><td>13–16 °C</td></tr>
                                <tr><td><?= e(t('blogbest_c4_place')) ?></td><td>1,100 m</td><td>28–32 °C</td><td>15–17 °C</td></tr>
                                <tr><td><?= e(t('blogbest_c5_place')) ?></td><td><?= e(t('blogbest_sea_level')) ?></td><td>28–32 °C</td><td>23–25 °C</td></tr>
                                <tr><td><?= e(t('blogbest_c6_place')) ?></td><td>5,895 m</td><td>−7 to −20 °C</td><td><?= e(t('blogbest_colder')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><?= e(t('blogbest_s5_p2')) ?></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('blogbest_faq_badge')) ?></span>
                    <h2><?= e(t('blogbest_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q9')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q10')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q11')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q12')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q13')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a13')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbest_faq_q14')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogbest_faq_a14')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><i class="fas fa-link"></i> <?= e(t('blogbest_related_badge')) ?></span>
                    <h2><?= e(t('blogbest_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><i class="fas fa-money-bill-wave"></i> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-arrows-turn-right"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('parks/kilimanjaro-national-park.php') ?>" class="related-link"><i class="fas fa-mountain-sun"></i> <?= e(t('blogbest_related_kili')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><i class="fas fa-book"></i> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><i class="fas fa-binoculars"></i> <?= e(t('blogcost_related_itineraries')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogbest_final_title')) ?></h2>
            <p><?= e(t('blogbest_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogbest_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogbest_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
