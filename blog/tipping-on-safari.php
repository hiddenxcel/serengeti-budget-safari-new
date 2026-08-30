<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/tipping-on-safari.php';
$pageMetaTitle = 'blogtip_meta_title';
$pageMetaDescription = 'blogtip_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/team/ranger-clients-company-vehicle-1.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_tips')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogtip_updated')) ?></span>
            </div>
            <h1><?= e(t('blogtip_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogtip_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><i class="fas fa-user-pen"></i> <?= e(t('blogtip_author')) ?></span>
                <span><i class="fas fa-clock"></i> 4 <?= e(t('blog_min_read')) ?></span>
                <span><i class="fas fa-calendar"></i> <?= e(t('blogtip_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><i class="fas fa-bolt"></i> <?= e(t('blogtip_quick_badge')) ?></span>
                    <h2><?= e(t('blogtip_quick_title')) ?></h2>
                    <p><?= e(t('blogtip_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-binoculars"></i></span>
                            <div><h4><?= e(t('blogtip_qq1_q')) ?></h4><p><?= e(t('blogtip_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-bed"></i></span>
                            <div><h4><?= e(t('blogtip_qq2_q')) ?></h4><p><?= e(t('blogtip_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-mountain-sun"></i></span>
                            <div><h4><?= e(t('blogtip_qq3_q')) ?></h4><p><?= e(t('blogtip_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <div><h4><?= e(t('blogtip_qq4_q')) ?></h4><p><?= e(t('blogtip_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-calendar-check"></i></span>
                            <div><h4><?= e(t('blogtip_qq5_q')) ?></h4><p><?= e(t('blogtip_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-circle-exclamation"></i></span>
                            <div><h4><?= e(t('blogtip_qq6_q')) ?></h4><p><?= e(t('blogtip_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogtip_see_faq')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><i class="fas fa-list-ul"></i> <?= e(t('blogtip_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#why">💡 <?= e(t('blogtip_toc_1')) ?></a></li>
                        <li><a href="#safari-tips">🚙 <?= e(t('blogtip_toc_2')) ?></a></li>
                        <li><a href="#kilimanjaro-tips">⛰️ <?= e(t('blogtip_toc_3')) ?></a></li>
                        <li><a href="#practical">💵 <?= e(t('blogtip_toc_4')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogtip_toc_5')) ?></a></li>
                    </ul>
                </nav>

                <!-- Why it matters -->
                <section id="why" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-circle-info"></i> <?= e(t('blogtip_s1_badge')) ?></span>
                    <h2><?= e(t('blogtip_s1_title')) ?></h2>
                    <p><?= e(t('blogtip_s1_p1')) ?></p>
                    <p><?= e(t('blogtip_s1_p2')) ?></p>
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

                <!-- Safari tipping -->
                <section id="safari-tips" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-binoculars"></i> <?= e(t('blogtip_s2_badge')) ?></span>
                    <h2><?= e(t('blogtip_s2_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogtip_t1_h1')) ?></th><th><?= e(t('blogtip_t1_h2')) ?></th><th><?= e(t('blogtip_t1_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogtip_t1_r1_a')) ?></strong></td><td>$20–25 <?= e(t('blogtip_per_day')) ?></td><td><?= e(t('blogtip_t1_r1_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogtip_t1_r2_a')) ?></strong></td><td>$10–15 <?= e(t('blogtip_per_day')) ?></td><td><?= e(t('blogtip_t1_r2_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogtip_t1_r3_a')) ?></strong></td><td>$10–15 <?= e(t('blogtip_per_day')) ?></td><td><?= e(t('blogtip_t1_r3_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogtip_t1_r4_a')) ?></strong></td><td>$5–10</td><td><?= e(t('blogtip_t1_r4_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogtip_t1_r5_a')) ?></strong></td><td>5–10%</td><td><?= e(t('blogtip_t1_r5_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3><?= e(t('blogtip_s2_example_title')) ?></h3>
                    <p><?= e(t('blogtip_s2_example_intro')) ?></p>
                    <ul>
                        <li><?= t('blogtip_s2_ex_li1') ?></li>
                        <li><?= t('blogtip_s2_ex_li2') ?></li>
                        <li><?= t('blogtip_s2_ex_li3') ?></li>
                    </ul>
                </section>

                <!-- Kilimanjaro tipping -->
                <section id="kilimanjaro-tips" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-mountain-sun"></i> <?= e(t('blogtip_s3_badge')) ?></span>
                    <h2><?= e(t('blogtip_s3_title')) ?></h2>
                    <p><?= t('blogtip_s3_p1') ?></p>

                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogtip_t2_h1')) ?></th><th><?= e(t('blogtip_t2_h2')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogtip_t2_r1_a')) ?></strong></td><td>$20–25</td></tr>
                                <tr><td><strong><?= e(t('blogtip_t2_r2_a')) ?></strong></td><td>$15–18</td></tr>
                                <tr><td><strong><?= e(t('blogtip_t2_r3_a')) ?></strong></td><td>$12–15</td></tr>
                                <tr><td><strong><?= e(t('blogtip_t2_r4_a')) ?></strong></td><td>$8–10</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3><?= e(t('blogtip_s3_sub_title')) ?></h3>
                    <p><?= t('blogtip_s3_p2') ?></p>
                    <p><?= e(t('blogtip_s3_p3')) ?></p>

                    <div class="migration-badge" style="margin-top:1.4rem;">
                        <i class="fas fa-lightbulb"></i>
                        <span><strong><?= e(t('blogtip_s3_note_t')) ?></strong> <?= e(t('blogtip_s3_note_d')) ?></span>
                    </div>
                </section>

                <!-- Practical points -->
                <section id="practical" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-hand-holding-dollar"></i> <?= e(t('blogtip_s4_badge')) ?></span>
                    <h2><?= e(t('blogtip_s4_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i1_t')) ?></strong> — <?= e(t('blogtip_s4_i1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i2_t')) ?></strong> — <?= e(t('blogtip_s4_i2_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i3_t')) ?></strong> — <?= e(t('blogtip_s4_i3_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i4_t')) ?></strong> — <?= e(t('blogtip_s4_i4_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i5_t')) ?></strong> — <?= e(t('blogtip_s4_i5_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogtip_s4_i6_t')) ?></strong> — <?= e(t('blogtip_s4_i6_d')) ?></li>
                    </ul>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('blogtip_faq_badge')) ?></span>
                    <h2><?= e(t('blogtip_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q9')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q10')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q11')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogtip_faq_q12')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogtip_faq_a12')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><i class="fas fa-link"></i> <?= e(t('blogtip_related_badge')) ?></span>
                    <h2><?= e(t('blogtip_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><i class="fas fa-money-bill-wave"></i> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-earth-africa"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><i class="fas fa-book"></i> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><i class="fas fa-binoculars"></i> <?= e(t('blogcost_related_itineraries')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-envelope"></i> <?= e(t('blogtip_related_contact')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogtip_final_title')) ?></h2>
            <p><?= e(t('blogtip_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogtip_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogtip_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
