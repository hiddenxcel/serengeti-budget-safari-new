<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/where-to-stay-on-safari.php';
$pageMetaTitle = 'blogstay_meta_title';
$pageMetaDescription = 'blogstay_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_guides')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogstay_updated')) ?></span>
            </div>
            <h1><?= e(t('blogstay_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogstay_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogstay_author')) ?></span>
                <span><?= icon('clock') ?> 7 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogstay_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_quick_badge')) ?></span>
                    <h2><?= e(t('blogstay_quick_title')) ?></h2>
                    <p><?= e(t('blogstay_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('scale-balanced') ?></span>
                            <div><h4><?= e(t('blogstay_qq1_q')) ?></h4><p><?= e(t('blogstay_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('ticket') ?></span>
                            <div><h4><?= e(t('blogstay_qq2_q')) ?></h4><p><?= e(t('blogstay_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('wallet') ?></span>
                            <div><h4><?= e(t('blogstay_qq3_q')) ?></h4><p><?= e(t('blogstay_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('star') ?></span>
                            <div><h4><?= e(t('blogstay_qq4_q')) ?></h4><p><?= e(t('blogstay_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('arrows-turn-right') ?></span>
                            <div><h4><?= e(t('blogstay_qq5_q')) ?></h4><p><?= e(t('blogstay_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('calendar-check') ?></span>
                            <div><h4><?= e(t('blogstay_qq6_q')) ?></h4><p><?= e(t('blogstay_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogcost_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogstay_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#types">🛏️ <?= e(t('blogstay_toc_1')) ?></a></li>
                        <li><a href="#inside-outside">⚖️ <?= e(t('blogstay_toc_2')) ?></a></li>
                        <li><a href="#what-its-like">👁️ <?= e(t('blogstay_toc_3')) ?></a></li>
                        <li><a href="#choosing">🤔 <?= e(t('blogstay_toc_4')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogstay_toc_5')) ?></a></li>
                    </ul>
                </nav>

                <!-- The five types -->
                <section id="types" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_s1_badge')) ?></span>
                    <h2><?= e(t('blogstay_s1_title')) ?></h2>
                    <p><?= e(t('blogstay_s1_p1')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogstay_t1_h1')) ?></th><th><?= e(t('blogstay_t1_h2')) ?></th><th><?= e(t('blogstay_t1_h3')) ?></th><th><?= e(t('blogstay_t1_h4')) ?></th></tr></thead>
                            <tbody>
                                <tr>
                                    <td><strong><?= e(t('blogstay_t1_r1_a')) ?></strong></td>
                                    <td><?= t('blogstay_t1_r1_b') ?></td>
                                    <td><?= e(t('blogstay_t1_r1_c')) ?></td>
                                    <td><?= e(t('blogstay_t1_r1_d')) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogstay_t1_r2_a')) ?></strong></td>
                                    <td>$60–150</td>
                                    <td><?= e(t('blogstay_t1_r2_c')) ?></td>
                                    <td><?= e(t('blogstay_t1_r2_d')) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogstay_t1_r3_a')) ?></strong></td>
                                    <td>$150–400</td>
                                    <td><?= e(t('blogstay_t1_r3_c')) ?></td>
                                    <td><?= e(t('blogstay_t1_r3_d')) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogstay_t1_r4_a')) ?></strong></td>
                                    <td>$200–600</td>
                                    <td><?= e(t('blogstay_t1_r4_c')) ?></td>
                                    <td><?= e(t('blogstay_t1_r4_d')) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogstay_t1_r5_a')) ?></strong></td>
                                    <td>$300–700</td>
                                    <td><?= e(t('blogstay_t1_r5_c')) ?></td>
                                    <td><?= e(t('blogstay_t1_r5_d')) ?></td>
                                </tr>
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
                    <?= icon('arrow-right', '', 'font-size:1.3rem;') ?>
                </a>

                <!-- Inside or outside -->
                <section id="inside-outside" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_s2_badge')) ?></span>
                    <h2><?= e(t('blogstay_s2_title')) ?></h2>
                    <p><?= e(t('blogstay_s2_p1')) ?></p>

                    <h3><?= e(t('blogstay_s2_sub1')) ?></h3>
                    <p><?= t('blogstay_s2_p2') ?></p>

                    <h3><?= e(t('blogstay_s2_sub2')) ?></h3>
                    <p><?= e(t('blogstay_s2_p3')) ?></p>

                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th></th><th><?= e(t('blogstay_t2_h1')) ?></th><th><?= e(t('blogstay_t2_h2')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogstay_t2_r1_a')) ?></td><td><?= e(t('blogstay_t2_r1_b')) ?></td><td><?= e(t('blogstay_t2_r1_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t2_r2_a')) ?></td><td><?= e(t('blogstay_t2_r2_b')) ?></td><td><?= e(t('blogstay_t2_r2_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t2_r3_a')) ?></td><td><?= e(t('blogstay_t2_r3_b')) ?></td><td><?= e(t('blogstay_t2_r3_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t2_r4_a')) ?></td><td><?= e(t('blogstay_t2_r4_b')) ?></td><td><?= e(t('blogstay_t2_r4_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t2_r5_a')) ?></td><td><?= e(t('blogstay_t2_r5_b')) ?></td><td><?= e(t('blogstay_t2_r5_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="migration-badge">
                        <?= icon('lightbulb') ?>
                        <span><strong><?= e(t('blogstay_tip_t')) ?></strong> <?= e(t('blogstay_tip_d')) ?></span>
                    </div>
                </section>

                <!-- What each is really like -->
                <section id="what-its-like" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_s3_badge')) ?></span>
                    <h2><?= e(t('blogstay_s3_title')) ?></h2>

                    <h3><?= e(t('blogstay_s3_sub1')) ?></h3>
                    <p><?= e(t('blogstay_s3_p1')) ?></p>
                    <p><?= e(t('blogstay_s3_p2')) ?></p>

                    <h3><?= e(t('blogstay_s3_sub2')) ?></h3>
                    <p><?= e(t('blogstay_s3_p3')) ?></p>

                    <h3><?= e(t('blogstay_s3_sub3')) ?></h3>
                    <p><?= e(t('blogstay_s3_p4')) ?></p>

                    <h3><?= e(t('blogstay_s3_sub4')) ?></h3>
                    <p><?= e(t('blogstay_s3_p5')) ?></p>
                </section>

                <!-- How to choose -->
                <section id="choosing" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_s4_badge')) ?></span>
                    <h2><?= e(t('blogstay_s4_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogstay_t3_h1')) ?></th><th><?= e(t('blogstay_t3_h2')) ?></th><th><?= e(t('blogstay_t3_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogstay_t3_r1_a')) ?></td><td><?= e(t('blogstay_t3_r1_b')) ?></td><td><?= e(t('blogstay_t3_r1_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r2_a')) ?></td><td><?= e(t('blogstay_t3_r2_b')) ?></td><td><?= e(t('blogstay_t3_r2_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r3_a')) ?></td><td><?= e(t('blogstay_t3_r3_b')) ?></td><td><?= e(t('blogstay_t3_r3_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r4_a')) ?></td><td><?= e(t('blogstay_t3_r4_b')) ?></td><td><?= e(t('blogstay_t3_r4_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r5_a')) ?></td><td><?= e(t('blogstay_t3_r5_b')) ?></td><td><?= e(t('blogstay_t3_r5_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r6_a')) ?></td><td><?= e(t('blogstay_t3_r6_b')) ?></td><td><?= e(t('blogstay_t3_r6_c')) ?></td></tr>
                                <tr><td><?= e(t('blogstay_t3_r7_a')) ?></td><td><?= e(t('blogstay_t3_r7_b')) ?></td><td><?= e(t('blogstay_t3_r7_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3><?= e(t('blogstay_s4_sub1')) ?></h3>
                    <ul class="included-icon-list yes">
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask1')) ?></li>
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask2')) ?></li>
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask3')) ?></li>
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask4')) ?></li>
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask5')) ?></li>
                        <li><?= icon('circle-question') ?> <?= e(t('blogstay_ask6')) ?></li>
                    </ul>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_faq_badge')) ?></span>
                    <h2><?= e(t('blogstay_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q10')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q11')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q12')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogstay_faq_q13')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogstay_faq_a13')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogstay_related_badge')) ?></span>
                    <h2><?= e(t('blogstay_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><?= icon('money-bill-wave') ?> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><?= icon('arrows-turn-right') ?> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><?= icon('book') ?> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><?= icon('binoculars') ?> <?= e(t('blogcost_related_itineraries')) ?></a>
                        <a href="<?= url('parks/serengeti-national-park.php') ?>" class="related-link"><i class="fas fa-paw"></i> <?= e(t('nav_safaris_featured_title')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogstay_final_title')) ?></h2>
            <p><?= e(t('blogstay_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogstay_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogstay_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
