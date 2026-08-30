<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/vaccinations-and-health.php';
$pageMetaTitle = 'blogvax_meta_title';
$pageMetaDescription = 'blogvax_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_tips')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogvax_updated')) ?></span>
            </div>
            <h1><?= e(t('blogvax_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogvax_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><i class="fas fa-user-pen"></i> <?= e(t('blogvax_author')) ?></span>
                <span><i class="fas fa-clock"></i> 7 <?= e(t('blog_min_read')) ?></span>
                <span><i class="fas fa-calendar"></i> <?= e(t('blogvax_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><i class="fas fa-bolt"></i> <?= e(t('blogvax_quick_badge')) ?></span>
                    <h2><?= e(t('blogvax_quick_title')) ?></h2>
                    <p><?= e(t('blogvax_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-syringe"></i></span>
                            <div><h4><?= e(t('blogvax_qq1_q')) ?></h4><p><?= e(t('blogvax_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-mosquito"></i></span>
                            <div><h4><?= e(t('blogvax_qq2_q')) ?></h4><p><?= e(t('blogvax_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-droplet"></i></span>
                            <div><h4><?= e(t('blogvax_qq3_q')) ?></h4><p><?= e(t('blogvax_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-shield-halved"></i></span>
                            <div><h4><?= e(t('blogvax_qq4_q')) ?></h4><p><?= e(t('blogvax_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-mountain-sun"></i></span>
                            <div><h4><?= e(t('blogvax_qq5_q')) ?></h4><p><?= e(t('blogvax_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-clock"></i></span>
                            <div><h4><?= e(t('blogvax_qq6_q')) ?></h4><p><?= e(t('blogvax_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogvax_see_faq')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><i class="fas fa-list-ul"></i> <?= e(t('blogvax_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#disclaimer">⚠️ <?= e(t('blogvax_toc_1')) ?></a></li>
                        <li><a href="#vaccinations">💉 <?= e(t('blogvax_toc_2')) ?></a></li>
                        <li><a href="#malaria">🦟 <?= e(t('blogvax_toc_3')) ?></a></li>
                        <li><a href="#food-water">🍽️ <?= e(t('blogvax_toc_4')) ?></a></li>
                        <li><a href="#altitude">🫁 <?= e(t('blogvax_toc_5')) ?></a></li>
                        <li><a href="#insurance">🛡️ <?= e(t('blogvax_toc_6')) ?></a></li>
                        <li><a href="#other">🩹 <?= e(t('blogvax_toc_7')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogvax_toc_8')) ?></a></li>
                    </ul>
                </nav>

                <!-- Disclaimer -->
                <section id="disclaimer" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-triangle-exclamation"></i> <?= e(t('blogvax_s0_badge')) ?></span>
                    <h2><?= e(t('blogvax_s0_title')) ?></h2>
                    <div class="migration-badge">
                        <i class="fas fa-circle-info"></i>
                        <span><strong><?= e(t('blogvax_s0_warn_t')) ?></strong> <?= t('blogvax_s0_warn_d') ?></span>
                    </div>
                    <p><?= e(t('blogvax_s0_p1')) ?></p>
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

                <!-- Vaccinations -->
                <section id="vaccinations" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-syringe"></i> <?= e(t('blogvax_s1_badge')) ?></span>
                    <h2><?= e(t('blogvax_s1_title')) ?></h2>
                    <h3><?= e(t('blogvax_s1_sub1')) ?></h3>
                    <p><?= t('blogvax_s1_p1') ?></p>
                    <h3><?= e(t('blogvax_s1_sub2')) ?></h3>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogvax_t1_h1')) ?></th><th><?= e(t('blogvax_t1_h2')) ?></th><th><?= e(t('blogvax_t1_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong><?= e(t('blogvax_t1_r1_a')) ?></strong></td><td><?= e(t('blogvax_t1_r1_b')) ?></td><td><?= e(t('blogvax_t1_r1_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogvax_t1_r2_a')) ?></strong></td><td><?= e(t('blogvax_t1_r2_b')) ?></td><td><?= e(t('blogvax_t1_r2_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogvax_t1_r3_a')) ?></strong></td><td><?= e(t('blogvax_t1_r3_b')) ?></td><td><?= e(t('blogvax_t1_r3_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogvax_t1_r4_a')) ?></strong></td><td><?= e(t('blogvax_t1_r4_b')) ?></td><td><?= e(t('blogvax_t1_r4_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogvax_t1_r5_a')) ?></strong></td><td><?= e(t('blogvax_t1_r5_b')) ?></td><td><?= e(t('blogvax_t1_r5_c')) ?></td></tr>
                                <tr><td><strong><?= e(t('blogvax_t1_r6_a')) ?></strong></td><td><?= e(t('blogvax_t1_r6_b')) ?></td><td><?= e(t('blogvax_t1_r6_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Malaria -->
                <section id="malaria" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-mosquito"></i> <?= e(t('blogvax_s2_badge')) ?></span>
                    <h2><?= e(t('blogvax_s2_title')) ?></h2>
                    <p><?= t('blogvax_s2_p1') ?></p>
                    <h3><?= e(t('blogvax_s2_sub1')) ?></h3>
                    <p><?= t('blogvax_s2_p2') ?></p>
                    <h3><?= e(t('blogvax_s2_sub2')) ?></h3>
                    <p><?= e(t('blogvax_s2_p3')) ?></p>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s2_b1_t')) ?></strong> <?= e(t('blogvax_s2_b1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s2_b2_t')) ?></strong> <?= e(t('blogvax_s2_b2_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s2_b3_t')) ?></strong> <?= e(t('blogvax_s2_b3_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s2_b4_t')) ?></strong> <?= e(t('blogvax_s2_b4_d')) ?></li>
                    </ul>
                    <div class="migration-badge" style="margin-top:1.4rem;">
                        <i class="fas fa-triangle-exclamation"></i>
                        <span><strong><?= e(t('blogvax_s2_warn_t')) ?></strong> <?= e(t('blogvax_s2_warn_d')) ?></span>
                    </div>
                </section>

                <!-- Food & water -->
                <section id="food-water" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-utensils"></i> <?= e(t('blogvax_s3_badge')) ?></span>
                    <h2><?= e(t('blogvax_s3_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s3_i1_t')) ?></strong> <?= e(t('blogvax_s3_i1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s3_i2')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s3_i3')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s3_i4')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s3_i5')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s3_i6')) ?></li>
                    </ul>
                    <p><?= e(t('blogvax_s3_p1')) ?></p>
                </section>

                <!-- Altitude -->
                <section id="altitude" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-lungs"></i> <?= e(t('blogvax_s4_badge')) ?></span>
                    <h2><?= e(t('blogvax_s4_title')) ?></h2>
                    <p><?= e(t('blogvax_s4_p1')) ?></p>
                    <p><?= e(t('blogvax_s4_p2')) ?></p>
                    <p><?= t('blogvax_s4_p3') ?> <a href="<?= url('parks/kilimanjaro-national-park.php') ?>"><?= e(t('blogvax_s4_link')) ?></a>.</p>
                </section>

                <!-- Travel insurance -->
                <section id="insurance" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-shield-halved"></i> <?= e(t('blogvax_s5_badge')) ?></span>
                    <h2><?= e(t('blogvax_s5_title')) ?></h2>
                    <p><?= e(t('blogvax_s5_p1')) ?></p>
                    <p><?= e(t('blogvax_s5_p2')) ?></p>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s5_i1_t')) ?></strong> <?= e(t('blogvax_s5_i1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s5_i2')) ?></strong></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s5_i3_t')) ?></strong> <?= e(t('blogvax_s5_i3_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('blogvax_s5_i4')) ?></li>
                    </ul>
                    <p><?= t('blogvax_s5_p3') ?></p>
                </section>

                <!-- Other practical points -->
                <section id="other" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-kit-medical"></i> <?= e(t('blogvax_s6_badge')) ?></span>
                    <h2><?= e(t('blogvax_s6_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i1_t')) ?></strong> <?= e(t('blogvax_s6_i1_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i2_t')) ?></strong> <?= e(t('blogvax_s6_i2_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i3_t')) ?></strong> <?= e(t('blogvax_s6_i3_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i4_t')) ?></strong> <?= e(t('blogvax_s6_i4_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i5_t')) ?></strong> <?= e(t('blogvax_s6_i5_d')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvax_s6_i6_t')) ?></strong> <?= e(t('blogvax_s6_i6_d')) ?></li>
                    </ul>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('blogvax_faq_badge')) ?></span>
                    <h2><?= e(t('blogvax_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q9')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q10')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q11')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q12')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvax_faq_q13')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvax_faq_a13')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><i class="fas fa-link"></i> <?= e(t('blogvax_related_badge')) ?></span>
                    <h2><?= e(t('blogvax_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><i class="fas fa-wallet"></i> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-crow"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><i class="fas fa-book"></i> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><i class="fas fa-binoculars"></i> <?= e(t('blogcost_related_itineraries')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-envelope"></i> <?= e(t('blogvax_related_contact')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogvax_final_title')) ?></h2>
            <p><?= e(t('blogvax_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogvax_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogvax_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
