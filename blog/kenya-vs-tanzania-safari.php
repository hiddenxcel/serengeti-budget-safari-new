<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/kenya-vs-tanzania-safari.php';
$pageMetaTitle = 'blogkenya_meta_title';
$pageMetaDescription = 'blogkenya_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/cheetah-alert-grassland.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_destinations')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogkenya_updated')) ?></span>
            </div>
            <h1><?= e(t('blogkenya_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogkenya_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogkenya_author')) ?></span>
                <span><?= icon('clock') ?> 6 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogkenya_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><?= icon('bolt') ?> <?= e(t('blogkenya_quick_badge')) ?></span>
                    <h2><?= e(t('blogkenya_quick_title')) ?></h2>
                    <p><?= e(t('blogkenya_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('arrows-turn-right') ?></span>
                            <div><h4><?= e(t('blogkenya_qq1_q')) ?></h4><p><?= e(t('blogkenya_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('baby') ?></span>
                            <div><h4><?= e(t('blogkenya_qq2_q')) ?></h4><p><?= e(t('blogkenya_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('wallet') ?></span>
                            <div><h4><?= e(t('blogkenya_qq3_q')) ?></h4><p><?= e(t('blogkenya_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('users') ?></span>
                            <div><h4><?= e(t('blogkenya_qq4_q')) ?></h4><p><?= e(t('blogkenya_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('clock') ?></span>
                            <div><h4><?= e(t('blogkenya_qq5_q')) ?></h4><p><?= e(t('blogkenya_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('mountain-sun') ?></span>
                            <div><h4><?= e(t('blogkenya_qq6_q')) ?></h4><p><?= e(t('blogkenya_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogkenya_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogkenya_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#short-answer">💡 <?= e(t('blogkenya_toc_1')) ?></a></li>
                        <li><a href="#comparison">📊 <?= e(t('blogkenya_toc_2')) ?></a></li>
                        <li><a href="#migration">🐃 <?= e(t('blogkenya_toc_3')) ?></a></li>
                        <li><a href="#experience">👁️ <?= e(t('blogkenya_toc_4')) ?></a></li>
                        <li><a href="#choosing">🤔 <?= e(t('blogkenya_toc_5')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogkenya_toc_6')) ?></a></li>
                    </ul>
                </nav>

                <!-- Short answer -->
                <section id="short-answer" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('blogkenya_s1_badge')) ?></span>
                    <h2><?= e(t('blogkenya_s1_title')) ?></h2>
                    <p><?= e(t('blogkenya_s1_p1')) ?></p>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogkenya_s1_li1_t')) ?></strong> — <?= e(t('blogkenya_s1_li1_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogkenya_s1_li2_t')) ?></strong> — <?= e(t('blogkenya_s1_li2_d')) ?></li>
                    </ul>
                    <p><?= e(t('blogkenya_s1_p2')) ?></p>
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

                <!-- Side by side comparison -->
                <section id="comparison" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('table-columns') ?> <?= e(t('blogkenya_s2_badge')) ?></span>
                    <h2><?= e(t('blogkenya_s2_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogkenya_t1_h1')) ?></th><th><?= e(t('blogkenya_t1_h2')) ?></th><th><?= e(t('blogkenya_t1_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogkenya_t1_r1_a')) ?></td><td>Serengeti 14,763 km²</td><td>Masai Mara 1,510 km²</td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r2_a')) ?></td><td><?= e(t('blogkenya_t1_r2_b')) ?></td><td><?= e(t('blogkenya_t1_r2_c')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r3_a')) ?></td><td>✓ Ndutu, Jan–Feb</td><td>✗</td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r4_a')) ?></td><td>✓ <?= e(t('blogkenya_t1_r4_b')) ?></td><td>✓ Mara</td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r5_a')) ?></td><td>$59–82.60/<?= e(t('blogkenya_day')) ?></td><td><?= e(t('blogkenya_t1_r5_c')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r6_a')) ?></td><td><?= e(t('blogkenya_higher')) ?></td><td><?= e(t('blogkenya_lower')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r7_a')) ?></td><td><?= e(t('blogkenya_t1_r7_b')) ?></td><td><?= e(t('blogkenya_t1_r7_c')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r8_a')) ?></td><td><?= e(t('blogkenya_prohibited')) ?></td><td><?= e(t('blogkenya_t1_r8_c')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r9_a')) ?></td><td><?= e(t('blogkenya_t1_r9_b')) ?></td><td><?= e(t('blogkenya_t1_r9_c')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r10_a')) ?></td><td>Kilimanjaro 5,895 m</td><td>Mount Kenya 5,199 m</td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r11_a')) ?></td><td>Zanzibar</td><td>Diani, Watamu</td></tr>
                                <tr><td><?= e(t('blogkenya_t1_r12_a')) ?></td><td><?= e(t('blogkenya_t1_r12_b')) ?></td><td><?= e(t('blogkenya_t1_r12_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Migration -->
                <section id="migration" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('arrows-turn-right') ?> <?= e(t('blogkenya_s3_badge')) ?></span>
                    <h2><?= e(t('blogkenya_s3_title')) ?></h2>
                    <p><?= e(t('blogkenya_s3_p1')) ?></p>
                    <p><?= t('blogkenya_s3_p2') ?></p>
                    <p><?= t('blogkenya_s3_p3') ?></p>
                    <p><?= t('blogkenya_s3_p4') ?></p>
                </section>

                <!-- Experience -->
                <section id="experience" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('eye') ?> <?= e(t('blogkenya_s4_badge')) ?></span>
                    <h2><?= e(t('blogkenya_s4_title')) ?></h2>
                    <h3><?= e(t('blogkenya_s4_sub1')) ?></h3>
                    <p><?= e(t('blogkenya_s4_p1')) ?></p>
                    <h3><?= e(t('blogkenya_s4_sub2')) ?></h3>
                    <p><?= e(t('blogkenya_s4_p2')) ?></p>
                    <div class="migration-badge">
                        <?= icon('star') ?>
                        <span><strong><?= e(t('blogkenya_s4_note_t')) ?></strong> <?= e(t('blogkenya_s4_note_d')) ?></span>
                    </div>
                </section>

                <!-- Choosing -->
                <section id="choosing" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('circle-question') ?> <?= e(t('blogkenya_s5_badge')) ?></span>
                    <h2><?= e(t('blogkenya_s5_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogkenya_t2_h1')) ?></th><th><?= e(t('blogkenya_t2_h2')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogkenya_t2_r1_a')) ?></td><td><strong>Tanzania</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r2_a')) ?></td><td><strong>Tanzania</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r3_a')) ?></td><td><strong>Tanzania</strong> (Zanzibar)</td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r4_a')) ?></td><td><strong>Tanzania</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r5_a')) ?></td><td><strong>Tanzania</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r6_a')) ?></td><td><strong>Kenya</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r7_a')) ?></td><td><strong>Kenya</strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r8_a')) ?></td><td><strong>Kenya</strong> <?= e(t('blogkenya_conservancies')) ?></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r9_a')) ?></td><td><strong><?= e(t('blogkenya_either')) ?></strong></td></tr>
                                <tr><td><?= e(t('blogkenya_t2_r10_a')) ?></td><td><strong>Tanzania</strong> <?= e(t('blogkenya_southern_circuit')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <h3><?= e(t('blogkenya_s5_sub1')) ?></h3>
                    <p><?= t('blogkenya_s5_p1') ?></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('blogkenya_faq_badge')) ?></span>
                    <h2><?= e(t('blogkenya_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q10')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q11')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogkenya_faq_q12')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogkenya_faq_a12')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><?= icon('link') ?> <?= e(t('blogkenya_related_badge')) ?></span>
                    <h2><?= e(t('blogkenya_related_title')) ?></h2>
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
            <h2><?= e(t('blogkenya_final_title')) ?></h2>
            <p><?= e(t('blogkenya_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogkenya_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogkenya_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
