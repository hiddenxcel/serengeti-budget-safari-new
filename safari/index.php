<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/';
$pageMetaTitle = 'safari_meta_title';
$pageMetaDescription = 'safari_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(badge_tagline('safari_hero_badge')) ?></span>
                <h1><?= e(t('safari_hero_title')) ?></h1>
                <p class="hero-sub" id="listingResultsSub">10 <?= e(t('safari_results_found')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">

                <div class="quick-filters" id="quickFilters">
                    <button type="button" class="quick-filter-chip active" data-quick-type="">All</button>
                    <button type="button" class="quick-filter-chip" data-quick-type="budget">Budget</button>
                    <button type="button" class="quick-filter-chip" data-quick-type="bigfive">Big Five</button>
                    <button type="button" class="quick-filter-chip" data-quick-type="migration">Migration</button>
                    <button type="button" class="quick-filter-chip" data-quick-type="luxury">Luxury</button>
                    <button type="button" class="quick-filter-chip" data-quick-type="zanzibar">Zanzibar</button>
                </div>

                <div class="text-center">
                    <button type="button" class="more-filters-toggle" id="moreFiltersToggle">
                        <?= e(t('safari_filter_label')) ?> <?= icon('chevron-down') ?>
                    </button>
                </div>

                <div class="more-filters-panel" id="moreFiltersPanel">
                    <select class="listing-select" id="filterExperience" aria-label="<?= e(t('safari_filter_experience')) ?>">
                        <option value=""><?= e(t('safari_filter_experience')) ?></option>
                        <option value="Big Five">Big Five</option>
                        <option value="Predators">Predators</option>
                        <option value="Migration">Migration</option>
                        <option value="Photography">Photography</option>
                        <option value="Elephants">Elephants</option>
                        <option value="Rhino">Rhino</option>
                        <option value="Beach">Beach</option>
                        <option value="Spa">Spa</option>
                    </select>
                    <select class="listing-select" id="filterAccommodation" aria-label="<?= e(t('safari_filter_accommodation')) ?>">
                        <option value=""><?= e(t('safari_filter_accommodation')) ?></option>
                        <option value="Camping">Camping</option>
                        <option value="Lodge">Lodge</option>
                        <option value="Tented Camp">Tented Camp</option>
                        <option value="Private Suite">Private Suite</option>
                    </select>
                    <select class="listing-select" id="filterLocation" aria-label="<?= e(t('safari_filter_location')) ?>">
                        <option value=""><?= e(t('safari_filter_location')) ?></option>
                        <option value="Tarangire">Tarangire</option>
                        <option value="Ngorongoro">Ngorongoro</option>
                        <option value="Serengeti">Serengeti</option>
                        <option value="Zanzibar">Zanzibar</option>
                        <option value="Northern Circuit">Northern Circuit</option>
                    </select>
                    <select class="listing-select" id="filterDuration" aria-label="<?= e(t('safari_filter_duration')) ?>">
                        <option value=""><?= e(t('safari_filter_duration')) ?></option>
                        <option value="1-2">1–2 days</option>
                        <option value="3-5">3–5 days</option>
                        <option value="6-8">6–8 days</option>
                        <option value="9-14">9–14 days</option>
                    </select>
                    <button type="button" class="listing-sort" id="sortToggle"><?= icon('arrow-down-wide-short') ?> <?= e(t('safari_sort')) ?></button>
                </div>

                <p class="popular-packages-title"><?= icon('fire') ?> Popular now</p>
                <div class="popular-packages-grid">
                    <a href="<?= url('safari/3-day-serengeti-safari.php') ?>" class="popular-package-card">
                        <div class="popular-package-img">
                            <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="3 Days Serengeti Safari" loading="lazy" />
                            <span class="popular-package-badge">⭐ Best Seller</span>
                        </div>
                        <div class="popular-package-body">
                            <h3>3 Days Serengeti Safari</h3>
                            <div class="pkg-dest">Serengeti Central &amp; Ngorongoro</div>
                            <div class="popular-package-footer">
                                <div class="price-tag">€1,000 <small>from · <?= e(t('safari_pp')) ?></small></div>
                                <span class="popular-package-arrow"><?= icon('arrow-right') ?></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= url('contact.php') ?>" class="popular-package-card">
                        <div class="popular-package-img">
                            <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="5 Days Migration Safari" loading="lazy" />
                            <span class="popular-package-badge">⭐ Best Seller</span>
                        </div>
                        <div class="popular-package-body">
                            <h3>5 Days Migration Safari</h3>
                            <div class="pkg-dest">Serengeti North + Ngorongoro</div>
                            <div class="popular-package-footer">
                                <div class="price-tag">€1,100 <small>from · <?= e(t('safari_pp')) ?></small></div>
                                <span class="popular-package-arrow"><?= icon('arrow-right') ?></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= url('safari/5-day-serengeti-ngorongoro-safari.php') ?>" class="popular-package-card">
                        <div class="popular-package-img">
                            <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="5 Days Serengeti and Ngorongoro Safari" loading="lazy" />
                            <span class="popular-package-badge">🌿 Budget</span>
                        </div>
                        <div class="popular-package-body">
                            <h3>5 Days Serengeti &amp; Ngorongoro</h3>
                            <div class="pkg-dest">Tarangire · Serengeti · Ngorongoro</div>
                            <div class="popular-package-footer">
                                <div class="price-tag">€650 <small>from · <?= e(t('safari_pp')) ?></small></div>
                                <span class="popular-package-arrow"><?= icon('arrow-right') ?></span>
                            </div>
                        </div>
                    </a>
                </div>

                <p class="listing-count"><strong id="listingCount">10</strong> <?= e(t('safari_results_found')) ?></p>

                <div class="package-grid-home" id="safariGrid">

                    <div class="package-card-home" data-type="budget" data-experience="Elephants Baobab Birdwatching" data-accommodation="Camping" data-location="Tarangire" data-days="1" data-price="200">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>');">
                            <span class="pkg-badge">🌿 Budget</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">Day Trip · Budget</span>
                            <h3>1 Day Tarangire Safari</h3>
                            <div class="pkg-dest">Tarangire National Park</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (206)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> Full-day game drive, elephants &amp; baobabs</li>
                                <li><?= icon('check') ?> Picnic lunch inside the park</li>
                                <li><?= icon('check') ?> Park fees included</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 206+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€200 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="budget" data-experience="Big Five Rhino" data-accommodation="Camping" data-location="Ngorongoro" data-days="2" data-price="650">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>');">
                            <span class="pkg-badge">🌿 Budget</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">2 Days · Budget</span>
                            <h3>2 Days Tarangire &amp; Ngorongoro Safari</h3>
                            <div class="pkg-dest">Ngorongoro Crater</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (187)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 1 night camping / budget lodge</li>
                                <li><?= icon('check') ?> Full-day crater descent, Big Five &amp; rhino</li>
                                <li><?= icon('check') ?> All meals + drinking water</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 187+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€650 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="bigfive" data-experience="Big Five Predators" data-accommodation="Tented Camp" data-location="Serengeti" data-days="3" data-price="1000">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>');">
                            <span class="pkg-badge best">⭐ Best Seller</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">3 Days · Big Five</span>
                            <h3>3 Days Serengeti Safari</h3>
                            <div class="pkg-dest">Serengeti Central &amp; Ngorongoro</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (191)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 2 nights tented camp</li>
                                <li><?= icon('check') ?> Big Five &amp; predator tracking</li>
                                <li><?= icon('check') ?> Professional driver-guide</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 191+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€1,000 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('safari/3-day-serengeti-safari.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('safari/3-day-serengeti-safari.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="bigfive" data-experience="Big Five Photography" data-accommodation="Lodge" data-location="Northern Circuit" data-days="4" data-price="1250">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>');">
                            <span class="pkg-badge">🐆 Big Five</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">4 Days · Big Five</span>
                            <h3>4 Days Big Five Safari</h3>
                            <div class="pkg-dest">Tarangire + Ngorongoro + Serengeti</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (193)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 3 nights lodge / tented camp</li>
                                <li><?= icon('check') ?> Full Big Five circuit</li>
                                <li><?= icon('check') ?> All meals + drinking water</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 193+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€1,250 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="migration" data-experience="Migration Photography" data-accommodation="Tented Camp" data-location="Serengeti" data-days="5" data-price="1100">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>');">
                            <span class="pkg-badge best">⭐ Best Seller</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">5 Days · Migration</span>
                            <h3>5 Days Migration Safari</h3>
                            <div class="pkg-dest">Serengeti North + Ngorongoro</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (164)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 4 nights tented camp</li>
                                <li><?= icon('check') ?> Full migration season coverage</li>
                                <li><?= icon('check') ?> Mara River crossing points</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 164+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€1,100 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="flyin" data-experience="" data-accommodation="Lodge" data-location="Serengeti" data-days="6" data-price="1800">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>');">
                            <span class="pkg-badge luxury">✈️ Fly-in</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">6 Days · Fly-in</span>
                            <h3>6 Days Fly-in Safari</h3>
                            <div class="pkg-dest">Serengeti + Ngorongoro</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (142)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> Light-aircraft transfers, no long drives</li>
                                <li><?= icon('check') ?> 5 nights lodge accommodation</li>
                                <li><?= icon('check') ?> All park fees included</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 142+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€1,800 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="luxury" data-experience="Spa" data-accommodation="Private Suite" data-location="Northern Circuit" data-days="7" data-price="2500">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>');">
                            <span class="pkg-badge luxury">👑 Luxury</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">7 Days · Luxury</span>
                            <h3>7 Days Luxury Safari</h3>
                            <div class="pkg-dest">Full Northern Circuit</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (98)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 6 nights private suite lodges</li>
                                <li><?= icon('check') ?> Private vehicle &amp; guide</li>
                                <li><?= icon('check') ?> Spa &amp; sundowner experiences</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 98+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€2,500 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="migration" data-experience="Migration Big Five" data-accommodation="Tented Camp" data-location="Serengeti" data-days="8" data-price="2100">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');">
                            <span class="pkg-badge best">⭐ Best Seller</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">8 Days · Migration</span>
                            <h3>8 Days Great Migration Safari</h3>
                            <div class="pkg-dest">Serengeti North + Central</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (176)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 7 nights tented camp</li>
                                <li><?= icon('check') ?> Northern + Central Serengeti circuit</li>
                                <li><?= icon('check') ?> Mara River crossings &amp; Big Five</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 176+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€2,100 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="zanzibar" data-experience="Beach" data-accommodation="Lodge" data-location="Zanzibar" data-days="10" data-price="2800">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>');">
                            <span class="pkg-badge">🏝️ Safari + Zanzibar</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">10 Days · Combo</span>
                            <h3>10 Days Safari + Zanzibar</h3>
                            <div class="pkg-dest">Serengeti + Ngorongoro + Zanzibar</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (121)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> 6 days safari + 4 days beach</li>
                                <li><?= icon('check') ?> Domestic flights to Zanzibar included</li>
                                <li><?= icon('check') ?> Beachfront lodge stay</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 121+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€2,800 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                    <div class="package-card-home" data-type="honeymoon" data-experience="Spa Beach" data-accommodation="Private Suite" data-location="Zanzibar" data-days="14" data-price="3800">
                        <div class="pkg-img" style="background-image:url('<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>');">
                            <span class="pkg-badge luxury">❤️ Honeymoon</span>
                        </div>
                        <div class="pkg-body">
                            <span class="pkg-days">14 Days · Honeymoon</span>
                            <h3>14 Days Honeymoon Safari</h3>
                            <div class="pkg-dest">Northern Circuit + Zanzibar</div>
                            <div class="pkg-rating"><span class="review-stars">★★★★★</span> (87)</div>
                            <ul class="pkg-features">
                                <li><?= icon('check') ?> Private suite lodges, Northern Circuit + Zanzibar</li>
                                <li><?= icon('check') ?> Private bush dinner under the stars</li>
                                <li><?= icon('check') ?> Couples spa treatment</li>
                            </ul>
                            <div class="pkg-social-proof"><?= icon('users') ?> 87+ <?= e(t('safari_booked_suffix')) ?></div>
                            <div class="pkg-footer">
                                <div class="price-tag">€3,800 <small>from &middot; <?= e(t('safari_pp')) ?></small></div>
                                <a href="<?= url('contact.php') ?>" class="pkg-arrow" aria-label="<?= e(t('safari_view_details')) ?>"><?= icon('arrow-right') ?></a>
                            </div>
                            <a href="<?= url('contact.php') ?>" class="pkg-book-btn"><?= e(t('safari_book_now')) ?></a>
                            <p class="pkg-guarantee"><?= e(t('safari_guarantee')) ?></p>
                        </div>
                    </div>

                </div>

                <p class="listing-empty" id="listingEmpty"><?= e(t('safari_no_match')) ?> <a href="<?= url('contact.php') ?>"><?= e(t('safari_contact_us')) ?></a> <?= e(t('safari_build_one')) ?></p>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <h2 class="section-title"><?= e(t('safari_parks_title')) ?></h2>
                <p class="subtitle"><?= e(t('safari_parks_subtitle')) ?></p>

                <div class="park-preview-grid">
                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Serengeti National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_3plus')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Serengeti</h3>
                            <p><?= e(t('safari_park_serengeti_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Conservation Area" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_1')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Ngorongoro</h3>
                            <p><?= e(t('safari_park_ngorongoro_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Tarangire National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_1to2')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Tarangire</h3>
                            <p><?= e(t('safari_park_tarangire_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/lake-manyara-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Lake Manyara National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_half')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Lake Manyara</h3>
                            <p><?= e(t('safari_park_manyara_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                </div>

                <h3 style="margin-bottom:0.5rem;"><?= e(t('safari_parks_beyond_title')) ?></h3>
                <p class="subtitle"><?= e(t('safari_parks_beyond_desc')) ?></p>

                <div class="park-preview-grid cols-3">
                    <a href="<?= url('parks/nyerere-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="Nyerere National Park (Selous)" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_3to4')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Nyerere (Selous)</h3>
                            <p><?= e(t('safari_park_nyerere_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/ruaha-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Ruaha National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_3to4')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Ruaha</h3>
                            <p><?= e(t('safari_park_ruaha_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/mikumi-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Mikumi National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('safari_parks_days_1to2')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3>Mikumi</h3>
                            <p><?= e(t('safari_park_mikumi_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('safari_parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container text-center">
                <h2 class="section-title"><?= e(t('safari_included_title')) ?></h2>
                <p class="subtitle"><?= e(t('safari_included_subtitle')) ?></p>

                <div class="included-icon-grid">
                    <div>
                        <h3><?= e(t('safari_included_heading')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_1')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_2')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_3')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_4')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_5')) ?></li>
                            <li><?= icon('check-circle') ?> <?= e(t('safari_included_6')) ?></li>
                        </ul>
                    </div>
                    <div>
                        <h3><?= e(t('safari_excluded_heading')) ?></h3>
                        <ul class="included-icon-list no">
                            <li><?= icon('times-circle') ?> <?= e(t('safari_excluded_1')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('safari_excluded_2')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('safari_excluded_3')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('safari_excluded_4')) ?></li>
                            <li><?= icon('times-circle') ?> <?= e(t('safari_excluded_5')) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('parks/') ?>" class="btn btn-outline"><?= e(t('safari_parks_compare_all')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container text-center">
                <h2 class="section-title"><?= e(t('safari_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('safari_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('safari_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('safari_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('safari_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('safari_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('safari_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('safari_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('safari_faq_a4')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('safari_cta_title')) ?></h2>
            <p><?= e(t('safari_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('safari_cta_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('safari_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php
$extraScripts = ['js/safari-listing.js'];
require dirname(__DIR__) . '/includes/footer.php';
?>
