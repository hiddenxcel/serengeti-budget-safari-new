<?php
declare(strict_types=1);

/**
 * Render a Lucide icon (assets/icons/<name>.svg) inline, sized to the
 * current font-size via 1em so it drops in wherever a Font Awesome <i>
 * used to sit. $class is appended for any extra styling/JS hooks the
 * call site needs (mirrors the old "fa-x extra-class" pattern). $style
 * covers the handful of call sites that set an inline color/margin
 * directly on the old <i> tag — stroke follows CSS `color`, so an inline
 * `color:` in $style tints the icon the same way it tinted the font glyph.
 */
function icon(string $name, string $class = '', string $style = ''): string
{
    static $cache = [];

    if (!isset($cache[$name])) {
        $file = BASE_PATH . '/assets/icons/' . $name . '.svg';
        if (!is_file($file)) {
            $cache[$name] = '';
        } else {
            $svg = (string) file_get_contents($file);
            $svg = preg_replace('/<!--.*?-->\s*/s', '', $svg) ?? $svg;
            $svg = preg_replace('/\s(width|height|class)="[^"]*"/', '', $svg) ?? $svg;
            $svg = preg_replace(
                '/<svg/',
                '<svg class="icon icon-' . e($name) . '" width="1em" height="1em"',
                $svg,
                1
            ) ?? $svg;
            $cache[$name] = trim($svg);
        }
    }

    $markup = $cache[$name];
    if ($markup === '') {
        return '';
    }

    if ($class !== '') {
        $markup = preg_replace('/class="icon /', 'class="icon ' . e($class) . ' ', $markup, 1) ?? $markup;
    }

    if ($style !== '') {
        $markup = preg_replace('/<svg /', '<svg style="' . e($style) . '" ', $markup, 1) ?? $markup;
    }

    return $markup;
}

function base_url(): string
{
    static $base = null;

    if ($base === null) {
        $script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $base = rtrim(preg_replace('#/(en|it)(/.*)?$#', '', $script), '/');
    }

    return $base;
}

function current_lang(): string
{
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

    return in_array('it', $segments, true) ? 'it' : 'en';
}

function load_lang(string $lang): array
{
    $file = BASE_PATH . '/lang/' . $lang . '.php';
    return is_file($file) ? require $file : [];
}

function t(string $key): string
{
    global $strings;
    return $strings[$key] ?? $key;
}

function url(string $path): string
{
    global $lang;
    $path = ltrim($path, '/');
    return base_url() . '/' . $lang . '/' . $path;
}

function asset(string $path): string
{
    return base_url() . '/assets/' . ltrim($path, '/');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Split a "<strong>Short title</strong> — long explanation" string (the
 * convention used for guide-page tips) into [summary, body] for use as
 * an accordion <summary>/<p> pair. Falls back to the whole string as the
 * summary if the em-dash separator isn't found.
 */
function guide_split_tip(string $html): array
{
    if (preg_match('/^(<strong>.*?<\/strong>)\s*—\s*(.*)$/su', $html, $m)) {
        return [trim($m[1]), trim($m[2])];
    }
    return [$html, ''];
}

/**
 * Short cursive tagline shown under a guide-page section H2 (see
 * .guide-section-head in guide.css). Keyed by the section's <h2 id>,
 * which is shared across the four guide pages (budget/day-trips/
 * migration/luxury), so one table covers all of them.
 */
function guide_tagline(string $sectionId): string
{
    static $taglines = [
        'en' => [
            'introduction'    => 'The real story',
            'quick-answer'    => 'Straight to the point',
            'trips'           => 'So many options',
            'packages'        => 'Pick your adventure',
            'cost-breakdown'  => 'No surprises',
            'prices'          => 'No surprises',
            'parks'           => 'Where the wild things are',
            'lodges'          => 'Sleep in style',
            'route'           => 'Follow the herds',
            'months'          => 'Timing is everything',
            'crossings'       => 'The main event',
            'calving'         => 'New life on the plains',
            'accommodation'   => 'Rest easy',
            'experiences'     => 'Beyond the game drive',
            'local-tips'      => 'From our own guides',
            'best-time'       => 'When to go',
            'packing'         => "Don't forget this",
            'itineraries'     => 'Day by day',
            'faq'             => 'Your questions, answered',
            'book'            => "Let's make it happen",
        ],
        'it' => [
            'introduction'    => 'La storia vera',
            'quick-answer'    => 'Andiamo dritti al punto',
            'trips'           => 'Tante possibilità',
            'packages'        => 'Scegli la tua avventura',
            'cost-breakdown'  => 'Senza sorprese',
            'prices'          => 'Senza sorprese',
            'parks'           => 'Dove vive la natura selvaggia',
            'lodges'          => 'Dormire con stile',
            'route'           => 'Seguendo le mandrie',
            'months'          => 'Il tempismo è tutto',
            'crossings'       => "L'evento principale",
            'calving'         => 'Nuova vita nella savana',
            'accommodation'   => 'Riposa tranquillo',
            'experiences'     => 'Oltre il game drive',
            'local-tips'      => 'Dalle nostre guide',
            'best-time'       => 'Quando partire',
            'packing'         => 'Non dimenticarlo',
            'itineraries'     => 'Giorno per giorno',
            'faq'             => 'Le tue domande, con risposta',
            'book'            => 'Rendiamolo realtà',
        ],
    ];

    $lang = current_lang();
    return $taglines[$lang][$sectionId] ?? $taglines['en'][$sectionId] ?? '';
}

/**
 * Short cursive tagline shown in place of a removed .section-badge /
 * .hero-badge, keyed by that badge's own translation key (e.g.
 * "parks_northern_badge") so every page with badges gets one lookup
 * table instead of new per-page lang keys.
 */
function badge_tagline(string $badgeKey): string
{
    static $taglines = [
        'en' => [
            'parks_hero_badge'        => 'Nine parks, one country',
            'parks_northern_badge'    => 'The classic route',
            'parks_southern_badge'    => 'Off the beaten path',
            'parks_compare_badge'     => 'Side by side',
            'parks_which_badge'       => 'Not sure where to start?',
            'parks_faq_badge'         => 'Your questions, answered',

            'trekking_hero_badge'     => 'Above the clouds',
            'trekking_routes_badge'   => 'Pick your path',
            'trekking_other_badge'    => 'Beyond Kilimanjaro',
            'trekking_guide_badge'    => 'Go deeper',

            'zanzibar_hero_badge'     => 'Sand, spice and sea',
            'zanzibar_why_badge'      => 'The perfect add-on',
            'zanzibar_gallery_badge'  => 'The island',
            'zanzibar_beaches_badge'  => 'Choose your coast',
            'zanzibar_excursions_badge' => 'Beyond the beach',
            'zanzibar_when_badge'     => 'Timing is everything',
            'zanzibar_practical_badge' => 'Good to know',

            'about_story_badge'       => 'How it all began',
            'about_why_badge'         => 'Why travel with us',
            'about_team_badge'        => 'The people behind it',
            'about_home_badge'        => 'Our home',
            'about_mission_badge'     => 'What drives us',

            'blog_hero_badge'         => 'Straight from Arusha',
            'blog_latest_badge'       => 'Fresh off the press',
            'blog_plan_badge'         => 'Plan your trip',
            'blog_popular_badge'      => 'Reader favorites',
            'blog_explore_badge'      => 'Keep exploring',
            'blog_before_badge'       => 'Before you go',
            'blog_newsletter_badge'   => "Don't miss out",

            'daytrips_hero_badge'     => 'No overnight needed',
            'daytrips_grid_badge'     => 'Pick your day',
            'daytrips_know_badge'     => 'Good to know',

            'safari_hero_badge'       => 'Find your perfect trip',
            'booking_hero_badge'      => "Let's lock in your dates",
            'contact_hero_badge'      => "We'd love to hear from you",
            'mytrip_hero_badge'       => 'Everything in one place',
            'saved_hero_badge'        => 'Your shortlist',

            // Blog articles — recurring badges shared across posts
            'blogbest_quick_badge' => 'Quick answers', 'blogbig5_quick_badge' => 'Quick answers',
            'blogmig_quick_badge' => 'Quick answers', 'blogcost_quick_badge' => 'Quick answers',
            'blogkenya_quick_badge' => 'Quick answers', 'blogsvn_quick_badge' => 'Quick answers',
            'blogvisa_quick_badge' => 'Quick answers', 'blogtip_quick_badge' => 'Quick answers',
            'blogvax_quick_badge' => 'Quick answers', 'blogpack_quick_badge' => 'Quick answers',
            'blogstay_quick_badge' => 'Quick answers',
            'blogbest_faq_badge' => 'Your questions, answered', 'blogcost_faq_badge' => 'Your questions, answered',
            'blogkenya_faq_badge' => 'Your questions, answered', 'blogsvn_faq_badge' => 'Your questions, answered',
            'blogvisa_faq_badge' => 'Your questions, answered', 'blogtip_faq_badge' => 'Your questions, answered',
            'blogvax_faq_badge' => 'Your questions, answered', 'blogpack_faq_badge' => 'Your questions, answered',
            'blogstay_faq_badge' => 'Your questions, answered',
            'blogbest_related_badge' => 'Keep exploring', 'blogvisa_related_badge' => 'Keep exploring',
            'blogtip_related_badge' => 'Keep exploring', 'blogvax_related_badge' => 'Keep exploring',
            'blogpack_related_badge' => 'Keep exploring', 'blogcost_related_badge' => 'Keep exploring',
            'blogkenya_related_badge' => 'Keep exploring', 'blogstay_related_badge' => 'Keep exploring',

            // best-time-to-visit-tanzania
            'blogbest_s1_badge' => 'The short version', 'blogbest_s2_badge' => 'Four seasons, one country',
            'blogbest_s3_badge' => 'Month by month', 'blogbest_s4_badge' => 'What matters to you',
            'blogbest_s5_badge' => 'Rain, sun and everything between',

            // big-five-tanzania
            'blogbig5_s1_badge' => 'Where the name comes from', 'blogbig5_s2_badge' => 'Meet the five',
            'blogbig5_s3_badge' => 'Give yourself the best odds', 'blogbig5_s4_badge' => "There's more out there",

            // great-migration-month-by-month
            'blogmig_s1_badge' => 'The short version', 'blogmig_s2_badge' => 'Twelve months, one journey',
            'blogmig_s3_badge' => 'New life on the plains', 'blogmig_s4_badge' => 'The main event',
            'blogmig_s5_badge' => 'Where to sleep', 'blogmig_s6_badge' => 'Making it happen',
            'blogmig_s7_badge' => 'Setting the record straight',

            // how-much-does-a-safari-cost
            'blogcost_s1_badge' => 'The short version', 'blogcost_s2_badge' => 'Where it starts',
            'blogcost_s3_badge' => 'Your biggest choice', 'blogcost_s4_badge' => 'Shared or private',
            'blogcost_s5_badge' => 'The small stuff adds up', 'blogcost_s6_badge' => 'Smart moves',
            'blogcost_s7_badge' => 'Real numbers',

            // kenya-vs-tanzania-safari
            'blogkenya_s1_badge' => 'The short version', 'blogkenya_s2_badge' => 'Side by side',
            'blogkenya_s3_badge' => 'Chasing the herds', 'blogkenya_s4_badge' => 'On the ground',
            'blogkenya_s5_badge' => 'Making the call',

            // serengeti-vs-ngorongoro
            'blogsvn_s1_badge' => 'The short version', 'blogsvn_s2_badge' => 'Side by side',
            'blogsvn_s3_badge' => 'Endless plains', 'blogsvn_s4_badge' => "Africa's Eden",
            'blogsvn_s5_badge' => 'Why not both',

            // tanzania-visa-and-entry
            'blogvisa_s1_badge' => 'Two ways in', 'blogvisa_s2_badge' => 'What you will need',
            'blogvisa_s3_badge' => 'Adding the island', 'blogvisa_s4_badge' => 'Staying healthy',

            // tipping-on-safari
            'blogtip_s1_badge' => 'The unwritten rule', 'blogtip_s2_badge' => 'On the road',
            'blogtip_s3_badge' => 'On the mountain', 'blogtip_s4_badge' => 'Cash, currency and timing',

            // vaccinations-and-health
            'blogvax_s0_badge' => 'Read this first', 'blogvax_s1_badge' => 'What you will need',
            'blogvax_s2_badge' => 'The real risk', 'blogvax_s3_badge' => 'Eating and drinking safely',
            'blogvax_s4_badge' => 'Thin air', 'blogvax_s5_badge' => 'Just in case',
            'blogvax_s6_badge' => 'Odds and ends',

            // what-to-pack-for-safari
            'blogpack_s1_badge' => 'Less is more', 'blogpack_s2_badge' => 'What to wear',
            'blogpack_s3_badge' => 'Staying well', 'blogpack_s4_badge' => 'Capturing the moment',
            'blogpack_s5_badge' => "Don't forget these", 'blogpack_s6_badge' => 'Leave it at home',

            // where-to-stay-on-safari
            'blogstay_s1_badge' => 'The short version', 'blogstay_s2_badge' => 'Location vs. luxury',
            'blogstay_s3_badge' => 'What you actually get', 'blogstay_s4_badge' => 'Making the call',

            // safari package pages
            'pkg3d_hero_badge' => 'Fan favorite', 'pkg3d_itinerary_badge' => 'What your days look like',
            'pkg3d_gallery_badge' => 'A preview of the trip',
            'pkg5d_overview_badge' => 'At a glance', 'pkg5d_route_badge' => 'Where you will go',
            'pkg5d_itinerary_badge' => 'What your days look like', 'pkg5d_accommodation_badge' => 'Rest easy',
            'pkg5d_features_badge' => 'What is included', 'pkg5d_pricing_badge' => 'No hidden fees',
            'pkg5d_expect_badge' => 'Set your expectations', 'pkg5d_getting_badge' => 'The practical bits',
            'pkg5d_why_badge' => 'Why travel with us',
            'groups_hero_badge' => 'Split the cost, not the experience', 'groups_how_badge' => 'How it works',
            'groups_why_badge' => 'Why travel as a group', 'groups_departures_badge' => 'Upcoming dates',

            // day-trips/tarangire-day-trip
            'daytrip_overview_badge' => 'At a glance', 'daytrip_experience_badge' => 'What the day feels like',
            'daytrip_timeline_badge' => 'Hour by hour', 'daytrip_route_badge' => 'Where you will go',
            'daytrip_features_badge' => 'What is included', 'daytrip_wildlife_badge' => 'What you will see',
            'daytrip_pricing_badge' => 'No hidden fees', 'daytrip_pickup_badge' => 'The practical bits',
            'daytrip_bring_badge' => 'What to pack', 'daytrip_related_badge' => 'Keep exploring',
        ],
        'it' => [
            'parks_hero_badge'        => 'Nove parchi, un paese',
            'parks_northern_badge'    => 'Il percorso classico',
            'parks_southern_badge'    => 'Fuori dai sentieri battuti',
            'parks_compare_badge'     => 'A confronto',
            'parks_which_badge'       => 'Non sai da dove iniziare?',
            'parks_faq_badge'         => 'Le tue domande, con risposta',

            'trekking_hero_badge'     => 'Sopra le nuvole',
            'trekking_routes_badge'   => 'Scegli il tuo percorso',
            'trekking_other_badge'    => 'Oltre il Kilimanjaro',
            'trekking_guide_badge'    => 'Approfondisci',

            'zanzibar_hero_badge'     => 'Sabbia, spezie e mare',
            'zanzibar_why_badge'      => "L'aggiunta perfetta",
            'zanzibar_gallery_badge'  => "L'isola",
            'zanzibar_beaches_badge'  => 'Scegli la tua costa',
            'zanzibar_excursions_badge' => 'Oltre la spiaggia',
            'zanzibar_when_badge'     => 'Il tempismo è tutto',
            'zanzibar_practical_badge' => 'Utile da sapere',

            'about_story_badge'       => 'Come è iniziato tutto',
            'about_why_badge'         => 'Perché viaggiare con noi',
            'about_team_badge'        => 'Le persone dietro',
            'about_home_badge'        => 'Casa nostra',
            'about_mission_badge'     => 'Cosa ci guida',

            'blog_hero_badge'         => 'Direttamente da Arusha',
            'blog_latest_badge'       => 'Appena pubblicato',
            'blog_plan_badge'         => 'Pianifica il tuo viaggio',
            'blog_popular_badge'      => 'I preferiti dai lettori',
            'blog_explore_badge'      => 'Continua a esplorare',
            'blog_before_badge'       => 'Prima di partire',
            'blog_newsletter_badge'   => 'Non perdertelo',

            'daytrips_hero_badge'     => 'Senza pernottamento',
            'daytrips_grid_badge'     => 'Scegli la tua giornata',
            'daytrips_know_badge'     => 'Utile da sapere',

            'safari_hero_badge'       => 'Trova il viaggio perfetto',
            'booking_hero_badge'      => 'Blocchiamo le tue date',
            'contact_hero_badge'      => 'Ci piacerebbe sentirti',
            'mytrip_hero_badge'       => 'Tutto in un unico posto',
            'saved_hero_badge'        => 'La tua lista dei preferiti',

            // Blog articles — recurring badges shared across posts
            'blogbest_quick_badge' => 'Risposte rapide', 'blogbig5_quick_badge' => 'Risposte rapide',
            'blogmig_quick_badge' => 'Risposte rapide', 'blogcost_quick_badge' => 'Risposte rapide',
            'blogkenya_quick_badge' => 'Risposte rapide', 'blogsvn_quick_badge' => 'Risposte rapide',
            'blogvisa_quick_badge' => 'Risposte rapide', 'blogtip_quick_badge' => 'Risposte rapide',
            'blogvax_quick_badge' => 'Risposte rapide', 'blogpack_quick_badge' => 'Risposte rapide',
            'blogstay_quick_badge' => 'Risposte rapide',
            'blogbest_faq_badge' => 'Le tue domande, con risposta', 'blogcost_faq_badge' => 'Le tue domande, con risposta',
            'blogkenya_faq_badge' => 'Le tue domande, con risposta', 'blogsvn_faq_badge' => 'Le tue domande, con risposta',
            'blogvisa_faq_badge' => 'Le tue domande, con risposta', 'blogtip_faq_badge' => 'Le tue domande, con risposta',
            'blogvax_faq_badge' => 'Le tue domande, con risposta', 'blogpack_faq_badge' => 'Le tue domande, con risposta',
            'blogstay_faq_badge' => 'Le tue domande, con risposta',
            'blogbest_related_badge' => 'Continua a esplorare', 'blogvisa_related_badge' => 'Continua a esplorare',
            'blogtip_related_badge' => 'Continua a esplorare', 'blogvax_related_badge' => 'Continua a esplorare',
            'blogpack_related_badge' => 'Continua a esplorare', 'blogcost_related_badge' => 'Continua a esplorare',
            'blogkenya_related_badge' => 'Continua a esplorare', 'blogstay_related_badge' => 'Continua a esplorare',

            // best-time-to-visit-tanzania
            'blogbest_s1_badge' => 'In breve', 'blogbest_s2_badge' => 'Quattro stagioni, un paese',
            'blogbest_s3_badge' => 'Mese per mese', 'blogbest_s4_badge' => 'Cosa conta per te',
            'blogbest_s5_badge' => 'Pioggia, sole e tutto il resto',

            // big-five-tanzania
            'blogbig5_s1_badge' => 'Da dove viene il nome', 'blogbig5_s2_badge' => 'Ecco i cinque',
            'blogbig5_s3_badge' => 'Massimizza le tue possibilità', 'blogbig5_s4_badge' => "C'è molto altro",

            // great-migration-month-by-month
            'blogmig_s1_badge' => 'In breve', 'blogmig_s2_badge' => 'Dodici mesi, un viaggio',
            'blogmig_s3_badge' => 'Nuova vita nella savana', 'blogmig_s4_badge' => "L'evento principale",
            'blogmig_s5_badge' => 'Dove dormire', 'blogmig_s6_badge' => 'Organizzare il viaggio',
            'blogmig_s7_badge' => 'Mettiamo le cose in chiaro',

            // how-much-does-a-safari-cost
            'blogcost_s1_badge' => 'In breve', 'blogcost_s2_badge' => 'Da dove si parte',
            'blogcost_s3_badge' => 'La scelta più importante', 'blogcost_s4_badge' => 'Condiviso o privato',
            'blogcost_s5_badge' => 'I piccoli costi si sommano', 'blogcost_s6_badge' => 'Mosse intelligenti',
            'blogcost_s7_badge' => 'Numeri reali',

            // kenya-vs-tanzania-safari
            'blogkenya_s1_badge' => 'In breve', 'blogkenya_s2_badge' => 'A confronto',
            'blogkenya_s3_badge' => 'Sulle tracce delle mandrie', 'blogkenya_s4_badge' => 'Sul campo',
            'blogkenya_s5_badge' => 'La scelta finale',

            // serengeti-vs-ngorongoro
            'blogsvn_s1_badge' => 'In breve', 'blogsvn_s2_badge' => 'A confronto',
            'blogsvn_s3_badge' => 'Pianure infinite', 'blogsvn_s4_badge' => "L'Eden d'Africa",
            'blogsvn_s5_badge' => 'Perché non entrambi',

            // tanzania-visa-and-entry
            'blogvisa_s1_badge' => 'Due modi per entrare', 'blogvisa_s2_badge' => 'Cosa ti serve',
            'blogvisa_s3_badge' => "Aggiungere l'isola", 'blogvisa_s4_badge' => 'Restare in salute',

            // tipping-on-safari
            'blogtip_s1_badge' => 'La regola non scritta', 'blogtip_s2_badge' => 'Sulla strada',
            'blogtip_s3_badge' => 'Sulla montagna', 'blogtip_s4_badge' => 'Contanti, valuta e tempistica',

            // vaccinations-and-health
            'blogvax_s0_badge' => 'Leggi questo per primo', 'blogvax_s1_badge' => 'Cosa ti serve',
            'blogvax_s2_badge' => 'Il rischio reale', 'blogvax_s3_badge' => 'Mangiare e bere in sicurezza',
            'blogvax_s4_badge' => 'Aria sottile', 'blogvax_s5_badge' => 'Per ogni evenienza',
            'blogvax_s6_badge' => 'Dettagli pratici',

            // what-to-pack-for-safari
            'blogpack_s1_badge' => 'Meno è meglio', 'blogpack_s2_badge' => 'Cosa indossare',
            'blogpack_s3_badge' => 'Stare bene', 'blogpack_s4_badge' => "Catturare l'attimo",
            'blogpack_s5_badge' => 'Non dimenticare questi', 'blogpack_s6_badge' => 'Lascialo a casa',

            // where-to-stay-on-safari
            'blogstay_s1_badge' => 'In breve', 'blogstay_s2_badge' => 'Posizione o lusso',
            'blogstay_s3_badge' => 'Cosa ottieni davvero', 'blogstay_s4_badge' => 'La scelta finale',

            // safari package pages
            'pkg3d_hero_badge' => 'Il più scelto', 'pkg3d_itinerary_badge' => 'Come sono le tue giornate',
            'pkg3d_gallery_badge' => 'Un assaggio del viaggio',
            'pkg5d_overview_badge' => 'In sintesi', 'pkg5d_route_badge' => 'Dove andrai',
            'pkg5d_itinerary_badge' => 'Come sono le tue giornate', 'pkg5d_accommodation_badge' => 'Riposa tranquillo',
            'pkg5d_features_badge' => "Cosa è incluso", 'pkg5d_pricing_badge' => 'Nessun costo nascosto',
            'pkg5d_expect_badge' => 'Cosa aspettarti', 'pkg5d_getting_badge' => 'Gli aspetti pratici',
            'pkg5d_why_badge' => 'Perché viaggiare con noi',
            'groups_hero_badge' => 'Dividi il costo, non l\'esperienza', 'groups_how_badge' => 'Come funziona',
            'groups_why_badge' => 'Perché viaggiare in gruppo', 'groups_departures_badge' => 'Prossime partenze',

            // day-trips/tarangire-day-trip
            'daytrip_overview_badge' => 'In sintesi', 'daytrip_experience_badge' => "Com'è la giornata",
            'daytrip_timeline_badge' => 'Ora per ora', 'daytrip_route_badge' => 'Dove andrai',
            'daytrip_features_badge' => 'Cosa è incluso', 'daytrip_wildlife_badge' => 'Cosa vedrai',
            'daytrip_pricing_badge' => 'Nessun costo nascosto', 'daytrip_pickup_badge' => 'Gli aspetti pratici',
            'daytrip_bring_badge' => 'Cosa portare', 'daytrip_related_badge' => 'Continua a esplorare',
        ],
    ];

    $lang = current_lang();
    return $taglines[$lang][$badgeKey] ?? $taglines['en'][$badgeKey] ?? '';
}

/**
 * Tagline for a park destination page's badge, e.g. "serengeti_wildlife_badge"
 * or "kilimanjaro_routes_badge". These 9 pages (parks/*-national-park.php,
 * ngorongoro-conservation-area.php) share a set of common section suffixes
 * (intro/wildlife/when/stay/fees/gallery/faq/hero) plus a handful of
 * park-specific ones (regions/zones/migration/maasai/walking/routes/
 * compare/activities/access). Matching by suffix means one table covers
 * all 9 parks instead of ~90 individual keys.
 */
function park_tagline(string $badgeKey): string
{
    static $bySuffix = [
        'en' => [
            'hero'       => 'Straight from our guides',
            'intro'      => 'The essentials',
            'wildlife'   => 'What you will see',
            'when'       => 'Timing is everything',
            'stay'       => 'Where to sleep',
            'fees'       => 'No surprises',
            'gallery'    => 'A thousand words each',
            'faq'        => 'Your questions, answered',
            'regions'    => 'Know before you go',
            'zones'      => 'Know before you go',
            'areas'      => 'Know before you go',
            'migration'  => 'The main event',
            'maasai'     => 'The people of this land',
            'walking'    => 'Off the vehicle, into the bush',
            'routes'     => 'Pick your path',
            'compare'    => 'Side by side',
            'activities' => 'More than a game drive',
            'access'     => 'Getting there',
        ],
        'it' => [
            'hero'       => 'Direttamente dalle nostre guide',
            'intro'      => "L'essenziale",
            'wildlife'   => 'Cosa vedrai',
            'when'       => 'Il tempismo è tutto',
            'stay'       => 'Dove dormire',
            'fees'       => 'Senza sorprese',
            'gallery'    => 'Mille parole ciascuna',
            'faq'        => 'Le tue domande, con risposta',
            'regions'    => 'Da sapere prima di partire',
            'zones'      => 'Da sapere prima di partire',
            'areas'      => 'Da sapere prima di partire',
            'migration'  => "L'evento principale",
            'maasai'     => 'Il popolo di questa terra',
            'walking'    => 'Fuori dal veicolo, dentro la savana',
            'routes'     => 'Scegli il tuo percorso',
            'compare'    => 'A confronto',
            'activities' => 'Molto più di un game drive',
            'access'     => 'Come arrivare',
        ],
    ];

    if (!preg_match('/^[a-z]+_([a-z]+)_badge$/', $badgeKey, $m)) {
        return '';
    }
    $lang = current_lang();
    return $bySuffix[$lang][$m[1]] ?? $bySuffix['en'][$m[1]] ?? '';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify(?string $token): bool
{
    return is_string($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generic session+IP-keyed rate limiter for public unauthenticated
 * endpoints (booking submission, My Trip lookup) that have no per-user
 * account to key a limit on. Not a substitute for a real WAF/reverse-proxy
 * rate limit, but stops naive scripted abuse from a single session.
 *
 * Returns true if the action is allowed to proceed (and records this
 * attempt); returns false if the caller has exceeded $maxAttempts within
 * $windowSeconds and should be rejected.
 */
function rate_limit_check(string $bucket, int $maxAttempts, int $windowSeconds): bool
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = 'rl_' . $bucket . '_' . sha1($ip);
    $data = $_SESSION[$key] ?? ['count' => 0, 'first_at' => time()];

    if ((time() - $data['first_at']) >= $windowSeconds) {
        $data = ['count' => 0, 'first_at' => time()];
    }

    if ($data['count'] >= $maxAttempts) {
        return false;
    }

    $data['count']++;
    $_SESSION[$key] = $data;

    return true;
}

/**
 * Fetch a safari's pricing tiers from the database by slug, in the
 * {upTo, pp} shape assets/js/price-calculator.js expects. Returns the
 * given $fallback array unchanged if the safari doesn't exist in the DB
 * yet (or has no tiers) — lets pages migrate to DB-driven pricing one at
 * a time without breaking ones that aren't migrated yet.
 */
function pricing_tiers_for_slug(string $slug, array $fallback = []): array
{
    try {
        $stmt = db()->prepare(
            'SELECT pt.up_to_travelers, pt.price_per_person
             FROM pricing_tiers pt
             INNER JOIN safaris s ON s.id = pt.safari_id
             WHERE s.slug = ?
             ORDER BY pt.up_to_travelers ASC'
        );
        $stmt->execute([$slug]);
        $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
        return $fallback;
    }

    if (!$rows) {
        return $fallback;
    }

    return array_map(
        static fn(array $row): array => [
            'upTo' => (int) $row['up_to_travelers'],
            'pp' => (float) $row['price_per_person'],
        ],
        $rows
    );
}
