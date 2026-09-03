<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'home';
$altPath = '';
$bodyClass = 'home-page';

$testimonials = db()->query(
    "SELECT * FROM testimonials WHERE status = 'published' ORDER BY sort_order ASC, created_at DESC LIMIT 9"
)->fetchAll();

require __DIR__ . '/includes/header.php';
?>

    <section class="hero" id="hero" aria-labelledby="heroTitle">
        <div class="hero-video-wrapper">
            <img class="hero-video" src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater panorama" />
            <div class="hero-overlay"></div>
            <div class="hero-gradient-overlay"></div>
        </div>

        <div class="hero-content">
            <p class="hero-eyebrow"><?= e(t('hero_eyebrow')) ?></p>
            <h1 class="hero-heading" id="heroTitle"><?= e(t('hero_heading')) ?></h1>
            <a href="<?= url('safari/') ?>" class="hero-cta"><?= e(t('hero_cta')) ?> <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="hero-scroll-indicator">
            <span><?= e(t('hero_scroll')) ?></span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <section class="about-us-section" aria-labelledby="aboutUsTitle">
        <div class="container">
            <div class="about-us-wrapper">
                <div class="about-us-photos">
                    <img class="about-us-photo-main" src="<?= asset('images/team/client-with-maasai-village.jpg') ?>"
                        alt="Serengeti Budget Safari guest visiting a Maasai village" loading="lazy" width="900" height="1200" />
                    <img class="about-us-photo-secondary" src="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>"
                        alt="Serengeti Budget Safari guide with a guest at Ngorongoro" loading="lazy" width="900" height="1200" />
                </div>
                <div class="about-us-content">
                    <span class="story-badge"><i class="fas fa-compass"></i> <?= e(t('about_badge')) ?></span>
                    <div class="mask-reveal">
                        <h2 id="aboutUsTitle"><?= e(t('about_title_1')) ?> <span><?= e(t('about_title_2')) ?></span></h2>
                    </div>
                    <p><?= e(t('about_p1')) ?></p>
                    <p><?= e(t('about_p2')) ?></p>
                    <div class="about-us-actions">
                        <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('about_cta')) ?></a>
                        <div class="about-us-call">
                            <span class="call-icon"><i class="fas fa-phone"></i></span>
                            <div>
                                <span><?= e(t('about_call')) ?></span>
                                <a href="tel:+255697612865">+255 697 612 865</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stories-grid-section" aria-labelledby="storiesTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-book-open"></i> <?= e(t('stories_badge')) ?></span>
                <h2 id="storiesTitle"><?= e(t('stories_title')) ?></h2>
            </div>

            <div class="stories-grid">
                <button type="button" class="story-preview-card" data-story="leopard">
                    <div class="story-preview-image">
                        <span class="story-preview-badge">Ndutu</span>
                        <img src="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" alt="Leopard resting in a tree at Ndutu" loading="lazy" width="800" height="533" />
                    </div>
                    <div class="story-preview-body">
                        <span class="story-preview-author"><?= e(t('story_leopard_author')) ?></span>
                        <h3><?= e(t('story_leopard_title')) ?></h3>
                        <p class="story-preview-excerpt"><?= e(t('story_leopard_excerpt')) ?></p>
                        <div class="story-preview-footer">
                            <span class="story-preview-time"><?= e(t('stories_reading_time')) ?><strong>2 min</strong></span>
                            <span class="story-read-btn"><?= e(t('stories_read')) ?> <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </button>

                <button type="button" class="story-preview-card" data-story="kilimanjaro">
                    <div class="story-preview-image">
                        <span class="story-preview-badge">Kilimanjaro</span>
                        <img src="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" alt="Male lion portrait, Serengeti" loading="lazy" width="800" height="600" />
                    </div>
                    <div class="story-preview-body">
                        <span class="story-preview-author"><?= e(t('story_kili_author')) ?></span>
                        <h3><?= e(t('story_kili_title')) ?></h3>
                        <p class="story-preview-excerpt"><?= e(t('story_kili_excerpt')) ?></p>
                        <div class="story-preview-footer">
                            <span class="story-preview-time"><?= e(t('stories_reading_time')) ?><strong>2 min</strong></span>
                            <span class="story-read-btn"><?= e(t('stories_read')) ?> <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </button>

                <button type="button" class="story-preview-card" data-story="maasai">
                    <div class="story-preview-image">
                        <span class="story-preview-badge">Cultural Tour</span>
                        <img src="<?= asset('images/team/client-with-maasai-village.jpg') ?>" alt="Guests with the Maasai village" loading="lazy" width="800" height="600" />
                    </div>
                    <div class="story-preview-body">
                        <span class="story-preview-author"><?= e(t('story_maasai_author')) ?></span>
                        <h3><?= e(t('story_maasai_title')) ?></h3>
                        <p class="story-preview-excerpt"><?= e(t('story_maasai_excerpt')) ?></p>
                        <div class="story-preview-footer">
                            <span class="story-preview-time"><?= e(t('stories_reading_time')) ?><strong>2 min</strong></span>
                            <span class="story-read-btn"><?= e(t('stories_read')) ?> <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <div class="story-modal-overlay" id="storyModalOverlay">
        <div class="story-modal" role="dialog" aria-modal="true">
            <button type="button" class="story-modal-close" id="storyModalClose" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
            <div id="storyModalBody">

                <div class="story-content" data-story-content="leopard" hidden>
                    <span class="story-badge"><i class="fas fa-paw"></i> <?= e(t('story_leopard_badge')) ?></span>
                    <h3><?= e(t('story_leopard_title')) ?></h3>
                    <p><em><?= e(t('story_leopard_quote')) ?></em></p>
                    <div class="guide-quote">
                        <p><i class="fas fa-quote-left" style="color:#d4a843; margin-right:0.5rem;"></i> <?= e(t('story_leopard_body')) ?></p>
                    </div>
                    <p><?= e(t('story_leopard_context')) ?></p>
                    <div class="story-meta">
                        <span><i class="fas fa-clock"></i> <?= e(t('story_leopard_meta_time')) ?></span>
                        <span><i class="fas fa-map-pin"></i> <?= e(t('story_leopard_meta_place')) ?></span>
                        <span class="highlight-tag"><i class="fas fa-user-tie"></i> <?= e(t('story_leopard_author')) ?></span>
                    </div>
                    <div class="story-cta">
                        <a href="<?= url('parks/serengeti-national-park.php') ?>" class="btn btn-primary btn-sm"><?= e(t('story_leopard_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                        <a href="https://wa.me/255697612865" class="btn btn-outline btn-sm" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('story_ask_more')) ?></a>
                    </div>
                </div>

                <div class="story-content" data-story-content="kilimanjaro" hidden>
                    <span class="story-badge"><i class="fas fa-mountain"></i> <?= e(t('story_kili_badge')) ?></span>
                    <h3><?= e(t('story_kili_title')) ?></h3>
                    <p><em><?= e(t('story_kili_quote')) ?></em></p>
                    <div class="guide-quote">
                        <p><i class="fas fa-quote-left" style="color:#2980b9; margin-right:0.5rem;"></i> <?= e(t('story_kili_body')) ?></p>
                    </div>
                    <p><?= e(t('story_kili_context')) ?></p>
                    <div class="story-meta">
                        <span><i class="fas fa-clock"></i> <?= e(t('story_kili_meta_time')) ?></span>
                        <span><i class="fas fa-map-pin"></i> <?= e(t('story_kili_meta_place')) ?></span>
                        <span class="highlight-tag"><i class="fas fa-user-tie"></i> <?= e(t('story_kili_author')) ?></span>
                    </div>
                    <div class="story-cta">
                        <a href="<?= url('trekking/') ?>" class="btn btn-primary btn-sm"><?= e(t('story_kili_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                        <a href="https://wa.me/255697612865" class="btn btn-outline btn-sm" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('story_ask_more')) ?></a>
                    </div>
                </div>

                <div class="story-content" data-story-content="maasai" hidden>
                    <span class="story-badge"><i class="fas fa-users"></i> <?= e(t('story_maasai_badge')) ?></span>
                    <h3><?= e(t('story_maasai_title')) ?></h3>
                    <p><em><?= e(t('story_maasai_quote')) ?></em></p>
                    <div class="guide-quote">
                        <p><i class="fas fa-quote-left" style="color:#d4a843; margin-right:0.5rem;"></i> <?= e(t('story_maasai_body')) ?></p>
                    </div>
                    <p><?= e(t('story_maasai_context')) ?></p>
                    <div class="story-meta">
                        <span><i class="fas fa-clock"></i> <?= e(t('story_maasai_meta_time')) ?></span>
                        <span><i class="fas fa-map-pin"></i> <?= e(t('story_maasai_meta_place')) ?></span>
                        <span class="highlight-tag"><i class="fas fa-user-tie"></i> <?= e(t('story_maasai_author')) ?></span>
                    </div>
                    <div class="story-cta">
                        <a href="<?= url('day-trips/') ?>" class="btn btn-primary btn-sm"><?= e(t('story_maasai_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                        <a href="https://wa.me/255697612865" class="btn btn-outline btn-sm" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('story_ask_more')) ?></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="safari-types-section has-pin-scroll" id="safariTypesPinSection" aria-labelledby="offerTitle">
        <div class="safari-types-pin-wrap">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-compass"></i> <?= e(t('safari_types_badge')) ?></span>
                    <h2 id="offerTitle"><?= e(t('safari_types_title')) ?></h2>
                    <p><?= e(t('safari_types_intro')) ?></p>
                </div>

                <div class="safari-types-slider" id="safariTypesSlider">
                    <div class="safari-types-track" id="safariTypesTrack">
                        <a href="<?= url('safari/') ?>" class="safari-type-card" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');">
                            <span class="type-icon"><i class="fas fa-wallet"></i></span>
                            <h3><?= e(t('safari_type_budget_title')) ?></h3>
                            <p><?= e(t('safari_type_budget_desc')) ?></p>
                        </a>
                        <a href="<?= url('safari/') ?>" class="safari-type-card" style="background-image:url('<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>');">
                            <span class="type-icon"><i class="fas fa-gem"></i></span>
                            <h3><?= e(t('safari_type_luxury_title')) ?></h3>
                            <p><?= e(t('safari_type_luxury_desc')) ?></p>
                        </a>
                        <a href="<?= url('safari/') ?>" class="safari-type-card" style="background-image:url('<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>');">
                            <span class="type-icon"><i class="fas fa-user-friends"></i></span>
                            <h3><?= e(t('safari_type_private_title')) ?></h3>
                            <p><?= e(t('safari_type_private_desc')) ?></p>
                        </a>
                        <a href="<?= url('safari/') ?>" class="safari-type-card" style="background-image:url('<?= asset('images/team/ranger-clients-safari-vehicle-logo.jpg') ?>');">
                            <span class="type-icon"><i class="fas fa-users"></i></span>
                            <h3><?= e(t('safari_type_group_title')) ?></h3>
                            <p><?= e(t('safari_type_group_desc')) ?></p>
                        </a>
                        <a href="<?= url('day-trips/') ?>" class="safari-type-card" style="background-image:url('<?= asset('images/team/client-with-maasai-village.jpg') ?>');">
                            <span class="type-icon"><i class="fas fa-hiking"></i></span>
                            <h3><?= e(t('safari_type_daytrips_title')) ?></h3>
                            <p><?= e(t('safari_type_daytrips_desc')) ?></p>
                        </a>
                    </div>
                    <button type="button" class="stories-slider-arrow prev" id="safariTypesPrev" aria-label="Previous safari type"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="stories-slider-arrow next" id="safariTypesNext" aria-label="Next safari type"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="comparison" aria-labelledby="comparisonTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-balance-scale"></i> <?= e(t('comparison_badge')) ?></span>
                <h2 id="comparisonTitle"><?= e(t('comparison_title')) ?></h2>
                <p><?= e(t('comparison_intro')) ?></p>
            </div>
            <div class="comparison-grid">
                <svg class="comparison-divider" viewBox="0 0 40 400" preserveAspectRatio="none" aria-hidden="true" focusable="false">
                    <path d="M20 0 C 34 60, 6 120, 20 180 C 34 240, 6 300, 20 360 C 26 380, 20 390, 20 400" />
                </svg>
                <div class="comparison-card">
                    <div class="comparison-card-head">
                        <span class="comparison-icon"><i class="fas fa-wallet"></i></span>
                        <h3><?= e(t('comparison_budget_title')) ?></h3>
                        <p class="comparison-tagline"><?= e(t('comparison_budget_tagline')) ?></p>
                    </div>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_budget_1')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_budget_2')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_budget_3')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_budget_4')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_budget_5')) ?></li>
                    </ul>
                    <div class="comparison-price"><span class="comparison-price-label"><?= e(t('comparison_from')) ?></span> €650 <span class="comparison-price-unit"><?= e(t('comparison_per_person')) ?></span></div>
                    <a href="<?= url('safari/') ?>" class="btn btn-outline"><?= e(t('comparison_budget_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="comparison-card featured">
                    <span class="comparison-badge"><?= e(t('comparison_luxury_badge')) ?></span>
                    <div class="comparison-card-head">
                        <span class="comparison-icon"><i class="fas fa-gem"></i></span>
                        <h3><?= e(t('comparison_luxury_title')) ?></h3>
                        <p class="comparison-tagline"><?= e(t('comparison_luxury_tagline')) ?></p>
                    </div>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_luxury_1')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_luxury_2')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_luxury_3')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_luxury_4')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= e(t('comparison_luxury_5')) ?></li>
                    </ul>
                    <div class="comparison-price"><span class="comparison-price-label"><?= e(t('comparison_from')) ?></span> €1,800 <span class="comparison-price-unit"><?= e(t('comparison_per_person')) ?></span></div>
                    <a href="<?= url('safari/') ?>" class="btn btn-primary"><?= e(t('comparison_luxury_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="top-destinations-section" aria-labelledby="destinationsTitle">
        <div class="container">
            <div class="top-destinations-header">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-map-marked-alt"></i> <?= e(t('destinations_badge')) ?></span>
                    <h2 id="destinationsTitle"><?= e(t('destinations_title_1')) ?> <span class="script-accent"><?= e(t('destinations_title_2')) ?></span></h2>
                    <p><?= e(t('destinations_intro')) ?></p>
                </div>
                <div class="destinations-slider-arrows">
                    <button type="button" class="stories-slider-arrow prev" id="destinationsPrev" aria-label="Previous destination"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="stories-slider-arrow next" id="destinationsNext" aria-label="Next destination"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="destinations-slider" id="destinationsSlider">
                <div class="destinations-track" id="destinationsTrack">
                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="destination-card">
                        <span class="destination-index">01</span>
                        <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Serengeti National Park" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Serengeti</h3></div>
                    </a>
                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="destination-card">
                        <span class="destination-index">02</span>
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Ngorongoro</h3></div>
                    </a>
                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="destination-card">
                        <span class="destination-index">03</span>
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Elephant under an acacia tree" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Tarangire</h3></div>
                    </a>
                    <a href="<?= url('parks/serengeti-national-park.php') ?>#zones" class="destination-card">
                        <span class="destination-index">04</span>
                        <img src="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>" alt="Cheetahs in the southern Serengeti" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Ndutu</h3></div>
                    </a>
                    <a href="<?= url('parks/arusha-national-park.php') ?>" class="destination-card">
                        <span class="destination-index">05</span>
                        <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Arusha National Park" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Arusha</h3></div>
                    </a>
                    <a href="<?= url('parks/lake-manyara-national-park.php') ?>" class="destination-card">
                        <span class="destination-index">06</span>
                        <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Lake Manyara National Park" loading="lazy" width="900" height="600" />
                        <div class="destination-body"><h3>Lake Manyara</h3></div>
                    </a>
                    <a href="<?= url('parks/') ?>" class="destination-card destination-card-more">
                        <span class="destination-more-icon"><i class="fas fa-arrow-right"></i></span>
                        <h3><?= e(t('destinations_see_all')) ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="trust-authority" aria-labelledby="trustTitle">
        <div class="container">
            <div class="trust-authority-intro centered">
                <span class="section-badge"><i class="fas fa-medal"></i> <?= e(t('trust_badge')) ?></span>
                <h2 id="trustTitle"><?= e(t('trust_title')) ?></h2>
            </div>
            <div class="trust-authority-panel">
                <div class="trust-authority-grid">
                    <div class="trust-stat">
                        <span class="trust-icon"><i class="fas fa-smile-beam"></i></span>
                        <span class="trust-number">3,000+</span>
                        <span class="trust-label"><?= e(t('trust_travellers')) ?></span>
                    </div>
                    <div class="trust-stat">
                        <span class="trust-icon"><i class="fas fa-calendar-check"></i></span>
                        <span class="trust-number">10+</span>
                        <span class="trust-label"><?= e(t('trust_years')) ?></span>
                    </div>
                    <div class="trust-stat">
                        <span class="trust-icon"><i class="fas fa-star"></i></span>
                        <span class="trust-number">98%</span>
                        <span class="trust-label"><?= e(t('trust_satisfaction')) ?></span>
                    </div>
                    <div class="trust-stat">
                        <span class="trust-icon"><i class="fas fa-user-tie"></i></span>
                        <span class="trust-number">12</span>
                        <span class="trust-label"><?= e(t('trust_guides')) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="best-packages-section" aria-labelledby="packagesTitle">
        <div class="container">
            <div class="best-packages-intro centered">
                <span class="section-badge"><i class="fas fa-star"></i> <?= e(t('packages_badge')) ?></span>
                <h2 id="packagesTitle"><?= e(t('packages_title')) ?></h2>
                <p><?= e(t('packages_intro')) ?></p>
                <a href="<?= url('safari/') ?>" class="btn btn-primary"><?= e(t('packages_see_all')) ?></a>
            </div>

            <div class="best-packages-slider">
                <button type="button" class="slider-nav-arrow prev" id="packagesPrev" aria-label="Previous package"><i class="fas fa-arrow-left"></i></button>
                <button type="button" class="slider-nav-arrow next" id="packagesNext" aria-label="Next package"><i class="fas fa-arrow-right"></i></button>
                <div class="best-packages-track" id="packagesTrack">
                    <a href="<?= url('safari/') ?>" class="package-card">
                        <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="<?= e(t('package_1day_title')) ?>" loading="lazy" width="640" height="853" />
                        <span class="package-badge"><?= e(t('package_1day_badge')) ?></span>
                        <div class="package-body">
                            <h3><?= e(t('package_1day_title')) ?></h3>
                            <p class="package-meta"><?= e(t('package_1day_meta')) ?></p>
                            <div class="package-footer">
                                <span class="package-price">€200 <small><?= e(t('package_from')) ?></small></span>
                                <span class="package-arrow"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= url('safari/') ?>" class="package-card">
                        <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="<?= e(t('package_3day_title')) ?>" loading="lazy" width="640" height="853" />
                        <span class="package-badge"><?= e(t('package_3day_badge')) ?></span>
                        <div class="package-body">
                            <h3><?= e(t('package_3day_title')) ?></h3>
                            <p class="package-meta"><?= e(t('package_3day_meta')) ?></p>
                            <div class="package-footer">
                                <span class="package-price">€850 <small><?= e(t('package_from')) ?></small></span>
                                <span class="package-arrow"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= url('safari/') ?>" class="package-card">
                        <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="<?= e(t('package_4day_title')) ?>" loading="lazy" width="640" height="853" />
                        <span class="package-badge"><?= e(t('package_4day_badge')) ?></span>
                        <div class="package-body">
                            <h3><?= e(t('package_4day_title')) ?></h3>
                            <p class="package-meta"><?= e(t('package_4day_meta')) ?></p>
                            <div class="package-footer">
                                <span class="package-price">€1,250 <small><?= e(t('package_from')) ?></small></span>
                                <span class="package-arrow"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= url('safari/') ?>" class="package-card">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="<?= e(t('package_5day_title')) ?>" loading="lazy" width="640" height="853" />
                        <span class="package-badge"><?= e(t('package_5day_badge')) ?></span>
                        <div class="package-body">
                            <h3><?= e(t('package_5day_title')) ?></h3>
                            <p class="package-meta"><?= e(t('package_5day_meta')) ?></p>
                            <div class="package-footer">
                                <span class="package-price">€1,450 <small><?= e(t('package_from')) ?></small></span>
                                <span class="package-arrow"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="ai-planner" aria-labelledby="plannerTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-wand-magic-sparkles"></i> <?= e(t('planner_badge')) ?></span>
                <h2 id="plannerTitle"><?= e(t('planner_title')) ?></h2>
                <p><?= e(t('planner_intro')) ?></p>
            </div>

            <div class="planner-chat" id="plannerChat" data-step="0">
                <div class="planner-chat-header">
                    <span class="planner-chat-avatar"><img src="<?= asset('images/logo.svg') ?>" alt="" loading="lazy" width="32" height="32" /></span>
                    <div class="planner-chat-header-text">
                        <strong>Safari Assistant</strong>
                        <span class="planner-chat-status"><i class="fas fa-circle"></i> Online now</span>
                    </div>
                    <div class="planner-chat-progress" aria-hidden="true">
                        <span class="planner-progress-dot" data-dot="0"></span>
                        <span class="planner-progress-dot" data-dot="1"></span>
                        <span class="planner-progress-dot" data-dot="2"></span>
                        <span class="planner-progress-dot" data-dot="3"></span>
                    </div>
                </div>

                <div class="planner-chat-thread" id="plannerThread">
                    <div class="planner-msg planner-msg-bot">
                        <span class="planner-msg-avatar"><img src="<?= asset('images/logo.svg') ?>" alt="" loading="lazy" width="20" height="20" /></span>
                        <div class="planner-msg-bubble"><?= e(t('planner_greeting')) ?></div>
                    </div>
                </div>

                <form class="planner-form" id="plannerForm">
                    <div class="planner-step active" data-step="0">
                        <div class="planner-options" data-name="days" data-question="<?= e(t('planner_step1_q')) ?>">
                            <button type="button" data-value="2">2-3 days</button>
                            <button type="button" data-value="4">4-5 days</button>
                            <button type="button" data-value="6">6-7 days</button>
                            <button type="button" data-value="8">8+ days</button>
                        </div>
                    </div>
                    <div class="planner-step" data-step="1">
                        <div class="planner-options" data-name="budget" data-question="<?= e(t('planner_step2_q')) ?>">
                            <button type="button" data-value="economico">€€ Budget</button>
                            <button type="button" data-value="standard">€€€ Standard</button>
                            <button type="button" data-value="lusso">€€€€ Luxury</button>
                        </div>
                    </div>
                    <div class="planner-step" data-step="2">
                        <div class="planner-options" data-name="month" data-question="<?= e(t('planner_step3_q')) ?>">
                            <button type="button" data-value="jan-mar">Jan-Mar</button>
                            <button type="button" data-value="apr-jun">Apr-Jun</button>
                            <button type="button" data-value="jul-sep">Jul-Sep</button>
                            <button type="button" data-value="oct-dec">Oct-Dec</button>
                        </div>
                    </div>
                    <div class="planner-step" data-step="3">
                        <div class="planner-options" data-name="interest" data-question="<?= e(t('planner_step4_q')) ?>">
                            <button type="button" data-value="wildlife">🦁 Big Five</button>
                            <button type="button" data-value="migration">🦒 Migration</button>
                            <button type="button" data-value="trekking">🏔️ Trekking</button>
                            <button type="button" data-value="beach">🏝️ Beach</button>
                        </div>
                    </div>
                </form>

                <div class="planner-result" id="plannerResult">
                    <div class="planner-result-content"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section bg-light" aria-labelledby="whenTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-calendar-alt"></i> <?= e(t('when_badge')) ?></span>
                <h2 id="whenTitle"><?= e(t('when_title')) ?></h2>
                <p><?= e(t('when_intro')) ?></p>
            </div>

            <div class="month-card-grid">
                <div class="month-card">
                    <div class="month-icon">☀️</div>
                    <h4><?= e(t('when_dry_period')) ?></h4>
                    <div class="month-temp"><?= e(t('when_dry_temp')) ?></div>
                    <div class="month-desc"><?= e(t('when_dry_desc')) ?></div>
                    <span class="month-tag good"><?= e(t('when_dry_tag')) ?></span>
                </div>
                <div class="month-card">
                    <div class="month-icon">🌤️</div>
                    <h4><?= e(t('when_calving_period')) ?></h4>
                    <div class="month-temp"><?= e(t('when_calving_temp')) ?></div>
                    <div class="month-desc"><?= e(t('when_calving_desc')) ?></div>
                    <span class="month-tag good"><?= e(t('when_calving_tag')) ?></span>
                </div>
                <div class="month-card">
                    <div class="month-icon">🌦️</div>
                    <h4><?= e(t('when_short_rains_period')) ?></h4>
                    <div class="month-temp"><?= e(t('when_short_rains_temp')) ?></div>
                    <div class="month-desc"><?= e(t('when_short_rains_desc')) ?></div>
                    <span class="month-tag mid"><?= e(t('when_short_rains_tag')) ?></span>
                </div>
                <div class="month-card">
                    <div class="month-icon">🌧️</div>
                    <h4><?= e(t('when_long_rains_period')) ?></h4>
                    <div class="month-temp"><?= e(t('when_long_rains_temp')) ?></div>
                    <div class="month-desc"><?= e(t('when_long_rains_desc')) ?></div>
                    <span class="month-tag rain"><?= e(t('when_long_rains_tag')) ?></span>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-section" aria-labelledby="galleryTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-camera-retro"></i> <?= e(t('gallery_badge')) ?></span>
                <h2 id="galleryTitle"><?= e(t('gallery_title')) ?></h2>
                <p><?= e(t('gallery_intro')) ?></p>
            </div>

            <div class="gallery-grid" id="galleryGrid">
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" data-caption="Leopard in a tree">
                    <img src="<?= asset('images/gallery/leopard-in-tree-wide-view.jpg') ?>" alt="Leopard in a tree" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Leopard in a tree</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" data-caption="Elephant family at sunset">
                    <img src="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>" alt="Elephant family at sunset" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Elephant family at sunset</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" data-caption="Monkey family">
                    <img src="<?= asset('images/wildlife/vervet-monkey-family.jpg') ?>" alt="Vervet monkey family" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Monkey family</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/lion-resting-near-waterhole.jpg') ?>" data-caption="King of the savannah">
                    <img src="<?= asset('images/gallery/lion-resting-near-waterhole.jpg') ?>" alt="Lion resting near a waterhole" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">King of the savannah</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" data-caption="Hyena on the move">
                    <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Hyena in the savanna" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Hyena on the move</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" data-caption="Herd of zebras">
                    <img src="<?= asset('images/gallery/zebras-savanna-plains.jpg') ?>" alt="Zebras on the savanna plains" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Herd of zebras</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" data-caption="Watching hippos">
                    <img src="<?= asset('images/gallery/tourists-watching-hippos-river.jpg') ?>" alt="Guests watching hippos" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Watching hippos</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" data-caption="Savanna sunrise">
                    <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Savanna sunrise" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Savanna sunrise</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" data-caption="Elephant portrait">
                    <img src="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" alt="Elephant close-up" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Elephant portrait</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" data-caption="White rhino">
                    <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="White rhino grazing" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">White rhino</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/wildlife/cheetah-alert-grassland.jpg') ?>" data-caption="Cheetah on alert">
                    <img src="<?= asset('images/wildlife/cheetah-alert-grassland.jpg') ?>" alt="Cheetah in the grassland" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Cheetah on alert</span></div>
                </button>
                <button type="button" class="gallery-grid-item" data-full="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" data-caption="Grazing zebras">
                    <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Zebra herd grazing" loading="lazy" width="800" height="800" />
                    <div class="gallery-masonry-overlay"><span class="gallery-masonry-caption">Grazing zebras</span></div>
                </button>
            </div>
        </div>

        <div class="gallery-lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Gallery image viewer" hidden>
            <button type="button" class="gallery-lightbox-close" id="galleryLightboxClose" aria-label="Close">&times;</button>
            <button type="button" class="gallery-lightbox-nav prev" id="galleryLightboxPrev" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
            <figure class="gallery-lightbox-figure">
                <img loading="lazy" src="" alt="" id="galleryLightboxImg" />
                <figcaption id="galleryLightboxCaption"></figcaption>
            </figure>
            <button type="button" class="gallery-lightbox-nav next" id="galleryLightboxNext" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <section class="journey-steps-section" aria-labelledby="storyTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-book-open"></i> <?= e(t('journey_badge')) ?></span>
                <h2 id="storyTitle"><?= e(t('journey_title')) ?></h2>
                <p><?= e(t('journey_intro')) ?></p>
            </div>
            <div class="journey-steps-grid">
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-plane-arrival"></i></span>
                    <h3><?= e(t('journey_arrival_title')) ?></h3>
                    <p><?= e(t('journey_arrival_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-compass"></i></span>
                    <h3><?= e(t('journey_adventure_title')) ?></h3>
                    <p><?= e(t('journey_adventure_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-paw"></i></span>
                    <h3><?= e(t('journey_wildlife_title')) ?></h3>
                    <p><?= e(t('journey_wildlife_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-users"></i></span>
                    <h3><?= e(t('journey_people_title')) ?></h3>
                    <p><?= e(t('journey_people_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-gem"></i></span>
                    <h3><?= e(t('journey_luxury_title')) ?></h3>
                    <p><?= e(t('journey_luxury_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-clipboard-list"></i></span>
                    <h3><?= e(t('journey_planning_title')) ?></h3>
                    <p><?= e(t('journey_planning_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-check-circle"></i></span>
                    <h3><?= e(t('journey_booking_title')) ?></h3>
                    <p><?= e(t('journey_booking_desc')) ?></p>
                </div>
                <div class="journey-step">
                    <span class="journey-step-number"><i class="fas fa-star"></i></span>
                    <h3><?= e(t('journey_dream_title')) ?></h3>
                    <p><?= e(t('journey_dream_desc')) ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="youtube-shorts-section" id="shorts" aria-labelledby="shortsTitle">
        <div class="youtube-shorts-bg-icons" aria-hidden="true">
            <i class="fas fa-play-circle"></i>
            <i class="fas fa-clapperboard"></i>
            <i class="fas fa-film"></i>
            <i class="fas fa-video"></i>
            <i class="fas fa-play-circle"></i>
            <i class="fas fa-film"></i>
            <i class="fas fa-clapperboard"></i>
            <i class="fas fa-play-circle"></i>
        </div>
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fab fa-youtube"></i> <?= e(t('shorts_badge')) ?></span>
                <h2 id="shortsTitle"><?= e(t('shorts_title')) ?></h2>
                <p><?= e(t('shorts_intro')) ?></p>
            </div>
            <div class="shorts-grid">

                <div class="short-item" data-video="MNKLVNZqHO4">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/MNKLVNZqHO4/maxresdefault.jpg" alt="<?= e(t('shorts_leopard')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-MNKLVNZqHO4" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">🔥 New</span>
                    <div class="short-overlay"><?= e(t('shorts_leopard')) ?></div>
                </div>

                <div class="short-item" data-video="caRo1yXX5u4">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/caRo1yXX5u4/maxresdefault.jpg" alt="<?= e(t('shorts_migration')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-caRo1yXX5u4" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">🦒 Migration</span>
                    <div class="short-overlay"><?= e(t('shorts_migration')) ?></div>
                </div>

                <div class="short-item" data-video="vYTu9vgcDFQ">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/vYTu9vgcDFQ/maxresdefault.jpg" alt="<?= e(t('shorts_kilimanjaro')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-vYTu9vgcDFQ" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">🏔️ Summit</span>
                    <div class="short-overlay"><?= e(t('shorts_kilimanjaro')) ?></div>
                </div>

                <div class="short-item" data-video="CnYu6niUNeI">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/CnYu6niUNeI/maxresdefault.jpg" alt="<?= e(t('shorts_guide')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-CnYu6niUNeI" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">👤 Guide</span>
                    <div class="short-overlay"><?= e(t('shorts_guide')) ?></div>
                </div>

                <div class="short-item" data-video="9xu-WdDuK0c">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/9xu-WdDuK0c/maxresdefault.jpg" alt="<?= e(t('shorts_testimonial')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-9xu-WdDuK0c" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">⭐ Testimonial</span>
                    <div class="short-overlay"><?= e(t('shorts_testimonial')) ?></div>
                </div>

                <div class="short-item" data-video="1wkb-sYGmeM">
                    <div class="thumbnail-wrapper">
                        <img src="https://img.youtube.com/vi/1wkb-sYGmeM/maxresdefault.jpg" alt="<?= e(t('shorts_maasai')) ?>" loading="lazy">
                        <div class="play-btn"><i class="fas fa-play-circle"></i></div>
                    </div>
                    <div class="video-wrapper">
                        <iframe id="player-1wkb-sYGmeM" src="" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                    <span class="short-badge">👥 Maasai</span>
                    <div class="short-overlay"><?= e(t('shorts_maasai')) ?></div>
                </div>

            </div>

            <div class="text-center" style="margin-top:1.5rem;">
                <a href="https://www.youtube.com/@serengetibudgetsafari" target="_blank" rel="noopener" class="btn btn-secondary"
                   style="background:#ff0000;color:#fff;padding:0.7rem 2rem;border-radius:50px;display:inline-flex;align-items:center;gap:0.6rem;text-decoration:none;transition:all 0.3s ease;">
                    <i class="fab fa-youtube"></i> <?= e(t('shorts_visit_channel')) ?> <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <?php if ($testimonials): ?>
    <section class="testimonials-section" id="testimonials" aria-labelledby="testimonialsTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-quote-left"></i> <?= e(t('testimonials_badge')) ?></span>
                <h2 id="testimonialsTitle"><?= e(t('testimonials_title')) ?></h2>
                <p><?= e(t('testimonials_intro')) ?></p>
            </div>

            <div class="testimonials-grid">
                <?php foreach ($testimonials as $tItem): ?>
                <?php
                    $tQuote = ($lang === 'it' && !empty($tItem['quote_it'])) ? $tItem['quote_it'] : $tItem['quote_en'];
                    $tInitial = mb_strtoupper(mb_substr($tItem['guest_name'], 0, 1));
                ?>
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar-fallback" aria-hidden="true"><?= e($tInitial) ?></div>
                        <div>
                            <div class="testimonial-name"><?= e($tItem['guest_name']) ?></div>
                            <?php if (!empty($tItem['guest_country'])): ?>
                            <div class="testimonial-meta"><?= e($tItem['guest_country']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="testimonial-rating" aria-label="<?= (int) $tItem['rating'] ?> out of 5 stars">
                        <?= str_repeat('★', (int) $tItem['rating']) . str_repeat('☆', 5 - (int) $tItem['rating']) ?>
                    </div>
                    <blockquote>&ldquo;<?= e($tQuote) ?>&rdquo;</blockquote>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="faq-mega" id="faq" aria-labelledby="faqTitle">
        <div class="container">
            <div class="section-title-left centered">
                <span class="section-badge"><i class="fas fa-question-circle"></i> <?= e(t('faq_badge')) ?></span>
                <h2 id="faqTitle"><?= e(t('faq_title')) ?></h2>
                <p><?= e(t('faq_intro')) ?></p>
            </div>
            <div class="faq-mega-grid">
                <div class="faq-column">
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q1')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q2')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q3')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a3')) ?></p></div>
                    </div>
                </div>
                <div class="faq-column">
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q4')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q5')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><?= e(t('faq_q6')) ?></div>
                        <div class="faq-answer"><p><?= e(t('faq_a6')) ?></p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="experiences-slider-section" aria-labelledby="experiencesTitle">
        <div class="container">
            <div class="experiences-slider-header">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-spa"></i> <?= e(t('experiences_badge')) ?></span>
                    <h2 id="experiencesTitle"><?= e(t('experiences_title')) ?></h2>
                    <p><?= e(t('experiences_intro')) ?></p>
                </div>
                <div class="experiences-slider-nav">
                    <button type="button" class="experiences-arrow prev" id="experiencesPrev" aria-label="Previous experience"><i class="fas fa-arrow-left"></i></button>
                    <button type="button" class="experiences-arrow next" id="experiencesNext" aria-label="Next experience"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="experiences-slider" id="experiencesSlider">
                <div class="experiences-track" id="experiencesTrack">
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-binoculars"></i></div>
                        <h3><?= e(t('exp_game_drives_title')) ?></h3>
                        <p><?= e(t('exp_game_drives_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-kiwi-bird"></i></div>
                        <h3><?= e(t('exp_migration_title')) ?></h3>
                        <p><?= e(t('exp_migration_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-plane-departure"></i></div>
                        <h3><?= e(t('exp_balloon_title')) ?></h3>
                        <p><?= e(t('exp_balloon_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-utensils"></i></div>
                        <h3><?= e(t('exp_dinner_title')) ?></h3>
                        <p><?= e(t('exp_dinner_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-hiking"></i></div>
                        <h3><?= e(t('exp_trekking_title')) ?></h3>
                        <p><?= e(t('exp_trekking_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-camera"></i></div>
                        <h3><?= e(t('exp_photo_title')) ?></h3>
                        <p><?= e(t('exp_photo_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-star"></i></div>
                        <h3><?= e(t('exp_night_title')) ?></h3>
                        <p><?= e(t('exp_night_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-heart"></i></div>
                        <h3><?= e(t('exp_maasai_title')) ?></h3>
                        <p><?= e(t('exp_maasai_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-person-hiking"></i></div>
                        <h3><?= e(t('exp_walking_title')) ?></h3>
                        <p><?= e(t('exp_walking_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-dove"></i></div>
                        <h3><?= e(t('exp_birds_title')) ?></h3>
                        <p><?= e(t('exp_birds_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-umbrella-beach"></i></div>
                        <h3><?= e(t('exp_zanzibar_title')) ?></h3>
                        <p><?= e(t('exp_zanzibar_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-person-swimming"></i></div>
                        <h3><?= e(t('exp_snorkeling_title')) ?></h3>
                        <p><?= e(t('exp_snorkeling_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-water"></i></div>
                        <h3><?= e(t('exp_materuni_title')) ?></h3>
                        <p><?= e(t('exp_materuni_desc')) ?></p>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-people-group"></i></div>
                        <h3><?= e(t('exp_cultural_title')) ?></h3>
                        <p><?= e(t('exp_cultural_desc')) ?></p>
                    </div>
                </div>
            </div>

            <div class="experiences-dots" id="experiencesDots" aria-hidden="true"></div>
        </div>
    </section>

    <section class="final-cta-emotional" id="booking" aria-labelledby="finalCtaTitle">
        <div class="container">
            <div class="final-cta-content centered">
                <span class="final-cta-quote"><?= e(t('final_cta_quote')) ?></span>
                <h2 id="finalCtaTitle"><?= e(t('final_cta_title')) ?></h2>
                <p><?= e(t('final_cta_intro')) ?></p>
                <div class="btn-group">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary btn-lg"><?= e(t('final_cta_request')) ?> <i class="fas fa-arrow-right"></i></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>
