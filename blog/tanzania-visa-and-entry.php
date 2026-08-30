<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/tanzania-visa-and-entry.php';
$pageMetaTitle = 'blogvisa_meta_title';
$pageMetaDescription = 'blogvisa_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/team/clients-serengeti-park-gate-1.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_tips')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogvisa_updated')) ?></span>
            </div>
            <h1><?= e(t('blogvisa_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogvisa_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><i class="fas fa-user-pen"></i> <?= e(t('blogvisa_author')) ?></span>
                <span><i class="fas fa-clock"></i> 5 <?= e(t('blog_min_read')) ?></span>
                <span><i class="fas fa-calendar"></i> <?= e(t('blogvisa_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><i class="fas fa-bolt"></i> <?= e(t('blogvisa_quick_badge')) ?></span>
                    <h2><?= e(t('blogvisa_quick_title')) ?></h2>
                    <p><?= e(t('blogvisa_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <div><h4><?= e(t('blogvisa_qq1_q')) ?></h4><p><?= e(t('blogvisa_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-globe"></i></span>
                            <div><h4><?= e(t('blogvisa_qq2_q')) ?></h4><p><?= e(t('blogvisa_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-clock"></i></span>
                            <div><h4><?= e(t('blogvisa_qq3_q')) ?></h4><p><?= e(t('blogvisa_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-passport"></i></span>
                            <div><h4><?= e(t('blogvisa_qq4_q')) ?></h4><p><?= e(t('blogvisa_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-umbrella-beach"></i></span>
                            <div><h4><?= e(t('blogvisa_qq5_q')) ?></h4><p><?= e(t('blogvisa_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-syringe"></i></span>
                            <div><h4><?= e(t('blogvisa_qq6_q')) ?></h4><p><?= e(t('blogvisa_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogvisa_see_faq')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><i class="fas fa-list-ul"></i> <?= e(t('blogvisa_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#two-routes">🛂 <?= e(t('blogvisa_toc_1')) ?></a></li>
                        <li><a href="#requirements">📋 <?= e(t('blogvisa_toc_2')) ?></a></li>
                        <li><a href="#zanzibar">🏝️ <?= e(t('blogvisa_toc_3')) ?></a></li>
                        <li><a href="#yellow-fever">💉 <?= e(t('blogvisa_toc_4')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogvisa_toc_5')) ?></a></li>
                    </ul>
                </nav>

                <!-- The two routes -->
                <section id="two-routes" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-passport"></i> <?= e(t('blogvisa_s1_badge')) ?></span>
                    <h2><?= e(t('blogvisa_s1_title')) ?></h2>
                    <p><?= t('blogvisa_s1_p1') ?></p>

                    <h3><?= e(t('blogvisa_s1_sub1')) ?></h3>
                    <p><?= t('blogvisa_s1_p2') ?></p>

                    <h3><?= e(t('blogvisa_s1_sub2')) ?></h3>
                    <p><?= e(t('blogvisa_s1_p3')) ?></p>

                    <div class="migration-badge">
                        <i class="fas fa-triangle-exclamation"></i>
                        <span><strong><?= e(t('blogvisa_s1_warn_t')) ?></strong> <?= t('blogvisa_s1_warn_d') ?></span>
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

                <!-- Requirements -->
                <section id="requirements" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-clipboard-check"></i> <?= e(t('blogvisa_s2_badge')) ?></span>
                    <h2><?= e(t('blogvisa_s2_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><i class="fas fa-check-circle"></i> <strong><?= e(t('blogvisa_s2_i1_t')) ?></strong> <?= t('blogvisa_s2_i1_d') ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= t('blogvisa_s2_i2') ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= t('blogvisa_s2_i3') ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= t('blogvisa_s2_i4') ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= t('blogvisa_s2_i5') ?></li>
                    </ul>

                    <h3><?= e(t('blogvisa_s2_sub1')) ?></h3>
                    <p><?= t('blogvisa_s2_p1') ?></p>
                </section>

                <!-- Zanzibar -->
                <section id="zanzibar" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-umbrella-beach"></i> <?= e(t('blogvisa_s3_badge')) ?></span>
                    <h2><?= e(t('blogvisa_s3_title')) ?></h2>
                    <p><?= t('blogvisa_s3_p1') ?></p>
                    <p><?= t('blogvisa_s3_p2') ?></p>
                    <p><?= e(t('blogvisa_s3_p3')) ?></p>
                </section>

                <!-- Yellow fever -->
                <section id="yellow-fever" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-syringe"></i> <?= e(t('blogvisa_s4_badge')) ?></span>
                    <h2><?= e(t('blogvisa_s4_title')) ?></h2>
                    <p><?= t('blogvisa_s4_p1') ?></p>
                    <p><?= t('blogvisa_s4_p2') ?></p>
                    <p><?= e(t('blogvisa_s4_p3')) ?></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('blogvisa_faq_badge')) ?></span>
                    <h2><?= e(t('blogvisa_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q5')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q6')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q7')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q8')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q9')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q10')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q11')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q12')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q13')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a13')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogvisa_faq_q14')) ?> <span><i class="fas fa-chevron-down"></i></span></div><div class="faq-answer-acc"><p><?= e(t('blogvisa_faq_a14')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><i class="fas fa-link"></i> <?= e(t('blogvisa_related_badge')) ?></span>
                    <h2><?= e(t('blogvisa_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><i class="fas fa-money-bill-wave"></i> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-kiwi-bird"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><i class="fas fa-book"></i> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><i class="fas fa-binoculars"></i> <?= e(t('blogcost_related_itineraries')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><i class="fas fa-envelope"></i> <?= e(t('blogvisa_related_contact')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogvisa_final_title')) ?></h2>
            <p><?= e(t('blogvisa_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogvisa_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogvisa_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
