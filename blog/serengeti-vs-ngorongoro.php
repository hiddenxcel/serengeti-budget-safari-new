<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/serengeti-vs-ngorongoro.php';
$pageMetaTitle = 'blogsvn_meta_title';
$pageMetaDescription = 'blogsvn_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_destinations')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogsvn_updated')) ?></span>
            </div>
            <h1><?= e(t('blogsvn_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogsvn_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogcost_author')) ?></span>
                <span><?= icon('clock') ?> 6 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogcost_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><?= icon('bolt') ?> <?= e(t('blogsvn_quick_badge')) ?></span>
                    <h2><?= e(t('blogsvn_quick_title')) ?></h2>
                    <p><?= e(t('blogsvn_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('ruler-combined') ?></span>
                            <div><h4><?= e(t('blogsvn_qq1_q')) ?></h4><p><?= e(t('blogsvn_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-rhino"></i></span>
                            <div><h4><?= e(t('blogsvn_qq2_q')) ?></h4><p><?= e(t('blogsvn_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-kiwi-bird"></i></span>
                            <div><h4><?= e(t('blogsvn_qq3_q')) ?></h4><p><?= e(t('blogsvn_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('clock') ?></span>
                            <div><h4><?= e(t('blogsvn_qq4_q')) ?></h4><p><?= e(t('blogsvn_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('money-bill-wave') ?></span>
                            <div><h4><?= e(t('blogsvn_qq5_q')) ?></h4><p><?= e(t('blogsvn_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('check-double') ?></span>
                            <div><h4><?= e(t('blogsvn_qq6_q')) ?></h4><p><?= e(t('blogsvn_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogsvn_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogsvn_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#short-answer">💡 <?= e(t('blogsvn_toc_1')) ?></a></li>
                        <li><a href="#side-by-side">📊 <?= e(t('blogsvn_toc_2')) ?></a></li>
                        <li><a href="#serengeti">🦓 <?= e(t('blogsvn_toc_3')) ?></a></li>
                        <li><a href="#ngorongoro">🌋 <?= e(t('blogsvn_toc_4')) ?></a></li>
                        <li><a href="#together">🗺️ <?= e(t('blogsvn_toc_5')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogsvn_toc_6')) ?></a></li>
                    </ul>
                </nav>

                <!-- Short answer -->
                <section id="short-answer" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('blogsvn_s1_badge')) ?></span>
                    <h2><?= e(t('blogsvn_s1_title')) ?></h2>
                    <p><?= t('blogsvn_s1_p1') ?></p>
                    <p><?= e(t('blogsvn_s1_p2')) ?></p>
                </section>

                <!-- Related safari CTA -->
                <a href="<?= url('safari/5-day-serengeti-ngorongoro-safari.php') ?>" class="article-safari-cta">
                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="5-Day Serengeti & Ngorongoro Safari" loading="lazy" />
                    <div class="article-safari-cta-body">
                        <span><?= e(t('blogsvn_cta_label')) ?></span>
                        <strong><?= e(t('blogcost_cta_title')) ?></strong>
                        <em><?= e(t('blogcost_cta_price')) ?></em>
                    </div>
                    <?= icon('arrow-right', '', 'font-size:1.3rem;') ?>
                </a>

                <!-- Side by side -->
                <section id="side-by-side" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('scale-balanced') ?> <?= e(t('blogsvn_s2_badge')) ?></span>
                    <h2><?= e(t('blogsvn_s2_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogsvn_t1_h1')) ?></th><th>Serengeti</th><th>Ngorongoro</th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogsvn_t1_r1_a')) ?></td><td>14,763 km²</td><td>260 km² (<?= e(t('blogsvn_crater_floor')) ?>)</td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r2_a')) ?></td><td>1951</td><td>1959</td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r3_a')) ?></td><td><?= e(t('blogsvn_t1_r3_b')) ?></td><td><?= e(t('blogsvn_t1_r3_c')) ?></td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r4_a')) ?></td><td>$82.60 / 24h</td><td>$82.60 / 24h + $295 <?= e(t('blogsvn_per_vehicle')) ?></td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r5_a')) ?></td><td><?= e(t('blogsvn_t1_r5_b')) ?></td><td><?= e(t('blogsvn_t1_r5_c')) ?></td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r6_a')) ?></td><td>~3,000</td><td><?= e(t('blogsvn_t1_r6_c')) ?></td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r7_a')) ?></td><td>—</td><td>~30</td></tr>
                                <tr><td><?= e(t('blogsvn_t1_r8_a')) ?></td><td><?= e(t('blogsvn_t1_r8_b')) ?></td><td><?= e(t('blogsvn_t1_r8_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-size:0.85rem;color:var(--text-secondary);"><em><?= e(t('blogsvn_s2_note')) ?></em></p>
                </section>

                <!-- Serengeti -->
                <section id="serengeti" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-paw"></i> <?= e(t('blogsvn_s3_badge')) ?></span>
                    <h2><?= e(t('blogsvn_s3_title')) ?></h2>
                    <p><?= t('blogsvn_s3_p1') ?></p>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s3_i1')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s3_i2')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s3_i3')) ?></li>
                    </ul>
                    <p><?= e(t('blogsvn_s3_p2')) ?> <a href="<?= url('parks/serengeti-national-park.php') ?>"><?= e(t('blogsvn_s3_link')) ?> →</a></p>
                </section>

                <!-- Ngorongoro -->
                <section id="ngorongoro" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('mountain') ?> <?= e(t('blogsvn_s4_badge')) ?></span>
                    <h2><?= e(t('blogsvn_s4_title')) ?></h2>
                    <p><?= t('blogsvn_s4_p1') ?></p>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s4_i1')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s4_i2')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogsvn_s4_i3')) ?></li>
                    </ul>
                    <div class="migration-badge">
                        <?= icon('triangle-exclamation') ?>
                        <span><strong><?= e(t('blogsvn_s4_warn_t')) ?></strong> <?= e(t('blogsvn_s4_warn_d')) ?></span>
                    </div>
                    <p style="margin-top:1rem;"><?= e(t('blogsvn_s4_p2')) ?> <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>"><?= e(t('blogsvn_s4_link')) ?> →</a></p>
                </section>

                <!-- Together -->
                <section id="together" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('route') ?> <?= e(t('blogsvn_s5_badge')) ?></span>
                    <h2><?= e(t('blogsvn_s5_title')) ?></h2>
                    <p><?= t('blogsvn_s5_p1') ?></p>
                    <p><?= e(t('blogsvn_s5_p2')) ?></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('blogsvn_faq_badge')) ?></span>
                    <h2><?= e(t('blogsvn_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogsvn_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogsvn_faq_a6')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><?= icon('link') ?> <?= e(t('blogcost_related_badge')) ?></span>
                    <h2><?= e(t('blogcost_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><?= icon('wallet') ?> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-kiwi-bird"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/big-five-tanzania.php') ?>" class="related-link"><i class="fas fa-paw"></i> <?= e(t('blog_art_bigfive_title')) ?></a>
                        <a href="<?= url('parks/') ?>" class="related-link"><?= icon('map') ?> <?= e(t('blogsvn_related_parks')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><?= icon('book') ?> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><?= icon('binoculars') ?> <?= e(t('blogcost_related_itineraries')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogsvn_final_title')) ?></h2>
            <p><?= e(t('blogsvn_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogcost_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogcost_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
