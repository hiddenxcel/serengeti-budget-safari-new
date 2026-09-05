<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'about';
$altPath = 'about.php';
$pageMetaTitle = 'about_meta_title';
$pageMetaDescription = 'about_meta_description';

// TODO: replace via admin — company facts (year founded, stats, team) once real data is confirmed.
$foundedYear = 2019;
$yearsExperience = date('Y') - $foundedYear;

$stats = [
    ['number' => '500+', 'label' => t('about_stat_travelers')],
    ['number' => $yearsExperience . '+', 'label' => t('about_stat_years')],
    ['number' => '9', 'label' => t('about_stat_parks')],
    ['number' => '25+', 'label' => t('about_stat_routes')],
];

// TODO: replace via admin — real team names, roles and photos.
$team = [
    ['name' => t('about_team_1_name'), 'role' => t('about_team_1_role'), 'bio' => t('about_team_1_bio'), 'img' => 'team/ranger-clients-safari-vehicle-logo.jpg'],
    ['name' => t('about_team_2_name'), 'role' => t('about_team_2_role'), 'bio' => t('about_team_2_bio'), 'img' => 'team/guide-client-ngorongoro-viewpoint.jpg'],
    ['name' => t('about_team_3_name'), 'role' => t('about_team_3_role'), 'bio' => t('about_team_3_bio'), 'img' => 'team/ranger-clients-company-vehicle-1.jpg'],
];

require __DIR__ . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:4rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/team/client-with-maasai-village.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content" style="text-align:center;max-width:820px;margin:0 auto;">
            <h1><?= e(t('about_hero_title')) ?></h1>
            <p class="detail-hero-route" style="justify-content:center;display:flex;"><?= e(t('about_hero_sub')) ?></p>
            <div class="btn-group" style="justify-content:center;margin-top:1rem;">
                <a href="<?= url('safari/') ?>" class="btn btn-primary btn-lg"><?= e(t('about_hero_cta1')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('about_hero_cta2')) ?></a>
            </div>
        </div>
    </section>

    <main>
        <!-- Short introduction -->
        <section class="about-us-section" aria-labelledby="aboutIntroTitle">
            <div class="container">
                <div class="about-us-wrapper">
                    <div class="about-us-photos">
                        <img class="about-us-photo-main" src="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>" alt="Guide with guests at Ngorongoro" loading="lazy" width="900" height="1200" />
                        <img class="about-us-photo-secondary" src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Lion pride Tarangire" loading="lazy" width="900" height="1200" />
                    </div>
                    <div class="about-us-content">
                        <span class="story-badge"><?= icon('compass') ?> <?= e(t('about_intro_badge')) ?></span>
                        <h2 id="aboutIntroTitle"><?= e(t('about_intro_title')) ?></h2>
                        <p><?= e(t('about_intro_p1')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our story -->
        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('about_story_badge')) ?></span>
                    <h2><?= e(t('about_story_title')) ?></h2>
                    <p><?= e(t('about_story_intro')) ?></p>
                </div>
                <div class="story-timeline">
                    <div class="story-timeline-item">
                        <span class="story-timeline-dot"></span>
                        <div class="story-timeline-year"><?= $foundedYear ?></div>
                        <strong><?= e(t('about_story_y1_title')) ?></strong>
                        <p><?= e(t('about_story_y1_desc')) ?></p>
                    </div>
                    <div class="story-timeline-item">
                        <span class="story-timeline-dot"></span>
                        <div class="story-timeline-year"><?= $foundedYear + 2 ?></div>
                        <strong><?= e(t('about_story_y2_title')) ?></strong>
                        <p><?= e(t('about_story_y2_desc')) ?></p>
                    </div>
                    <div class="story-timeline-item">
                        <span class="story-timeline-dot"></span>
                        <div class="story-timeline-year"><?= $foundedYear + 4 ?></div>
                        <strong><?= e(t('about_story_y3_title')) ?></strong>
                        <p><?= e(t('about_story_y3_desc')) ?></p>
                    </div>
                    <div class="story-timeline-item">
                        <span class="story-timeline-dot"></span>
                        <div class="story-timeline-year"><?= date('Y') ?></div>
                        <strong><?= e(t('about_story_y4_title')) ?></strong>
                        <p><?= e(t('about_story_y4_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why different -->
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('about_why_badge')) ?></span>
                    <h2><?= e(t('about_why_title')) ?></h2>
                </div>
                <div class="trust-grid">
                    <div class="trust-item"><?= icon('earth-africa') ?><div><strong><?= e(t('about_why_1_title')) ?></strong><p><?= e(t('about_why_1_desc')) ?></p></div></div>
                    <div class="trust-item"><?= icon('compass') ?><div><strong><?= e(t('about_why_2_title')) ?></strong><p><?= e(t('about_why_2_desc')) ?></p></div></div>
                    <div class="trust-item"><?= icon('user-tie') ?><div><strong><?= e(t('about_why_3_title')) ?></strong><p><?= e(t('about_why_3_desc')) ?></p></div></div>
                    <div class="trust-item"><?= icon('tag') ?><div><strong><?= e(t('about_why_4_title')) ?></strong><p><?= e(t('about_why_4_desc')) ?></p></div></div>
                    <div class="trust-item"><?= icon('headset') ?><div><strong><?= e(t('about_why_5_title')) ?></strong><p><?= e(t('about_why_5_desc')) ?></p></div></div>
                    <div class="trust-item"><?= icon('seedling') ?><div><strong><?= e(t('about_why_6_title')) ?></strong><p><?= e(t('about_why_6_desc')) ?></p></div></div>
                </div>
            </div>
        </section>

        <!-- Meet the team -->
        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('about_team_badge')) ?></span>
                    <h2><?= e(t('about_team_title')) ?></h2>
                    <p><?= e(t('about_team_intro')) ?></p>
                </div>
                <div class="team-grid">
                    <?php foreach ($team as $member): ?>
                    <div class="team-card">
                        <div class="team-card-img">
                            <img src="<?= asset('images/' . $member['img']) ?>" alt="<?= e($member['name']) ?>" loading="lazy" />
                        </div>
                        <div class="team-card-body">
                            <h3><?= e($member['name']) ?></h3>
                            <span class="team-card-role"><?= e($member['role']) ?></span>
                            <p><?= e($member['bio']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Tanzania is our home -->
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('about_home_badge')) ?></span>
                    <h2><?= e(t('about_home_title')) ?></h2>
                    <p><?= e(t('about_home_intro')) ?></p>
                </div>
                <div class="about-destinations-grid">
                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Serengeti" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_serengeti')) ?></strong><small><?= e(t('about_dest_serengeti_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_ngorongoro')) ?></strong><small><?= e(t('about_dest_ngorongoro_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Tarangire" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_tarangire')) ?></strong><small><?= e(t('about_dest_tarangire_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('trekking/') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" alt="Kilimanjaro" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_kili')) ?></strong><small><?= e(t('about_dest_kili_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('zanzibar/') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Zanzibar" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_zanzibar')) ?></strong><small><?= e(t('about_dest_zanzibar_sub')) ?></small></span>
                    </a>
                </div>
                <div style="text-align:center;margin-top:2rem;">
                    <a href="<?= url('parks/') ?>" class="btn btn-primary"><?= e(t('about_home_cta')) ?></a>
                </div>
            </div>
        </section>

        <!-- Numbers + mission/promise -->
        <section class="detail-section bg-light">
            <div class="container">
                <div class="grid-4" style="margin-bottom:3rem;">
                    <?php foreach ($stats as $stat): ?>
                    <div class="stat-card">
                        <div class="stat-number"><?= e($stat['number']) ?></div>
                        <div class="stat-label"><?= e($stat['label']) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('about_mission_badge')) ?></span>
                    <h2><?= e(t('about_mission_title')) ?></h2>
                    <p><?= e(t('about_mission_text')) ?></p>
                </div>

                <ul class="love-list" style="max-width:560px;margin:1.5rem auto 0;">
                    <li><?= icon('check-circle') ?> <?= e(t('about_promise_1')) ?></li>
                    <li><?= icon('check-circle') ?> <?= e(t('about_promise_2')) ?></li>
                    <li><?= icon('check-circle') ?> <?= e(t('about_promise_3')) ?></li>
                    <li><?= icon('check-circle') ?> <?= e(t('about_promise_4')) ?></li>
                </ul>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('about_final_title')) ?></h2>
            <p><?= e(t('about_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="<?= url('safari/') ?>" class="btn btn-primary btn-lg"><?= e(t('about_final_safaris')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('about_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require __DIR__ . '/includes/footer.php';
?>
