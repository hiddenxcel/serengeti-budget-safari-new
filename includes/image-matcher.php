<?php
declare(strict_types=1);

/**
 * Auto-matches safari packages to images from the EXISTING photo library
 * (assets/images/{gallery,hero,wildlife}/) by scoring filename keywords
 * against the safari's own text. No external APIs, no AI image generation —
 * the library is small and generic (no per-destination photos), so matches
 * will often fall back to generic wildlife/hero shots rather than a perfect
 * destination-specific photo. That is a real, accepted limitation of
 * "match from the existing library," not a bug to solve around.
 *
 * assets/images/team/ is deliberately excluded — those are people/vehicle/
 * park-gate photos, not scenery/wildlife, and would produce wrong matches.
 */

// Filename words that describe composition/framing rather than subject —
// excluded so they don't inflate matches against unrelated safari text that
// happens to contain, say, "view".
const IMAGE_MATCHER_COMPOSITION_WORDS = [
    'close', 'up', 'wide', 'view', 'portrait', 'panorama', 'walk', 'shade',
];

const IMAGE_MATCHER_STOPWORDS = [
    'the', 'a', 'an', 'and', 'of', 'in', 'to', 'with', 'for', 'is', 'this',
    'our', 'you', 'your', 'on', 'at', 'by', 'from', 'day', 'days',
];

const IMAGE_MATCHER_LIBRARY_FOLDERS = ['gallery', 'hero', 'wildlife'];

// Honest fallback when a safari's text has zero keyword overlap with the
// library (a realistic outcome given the small, generic photo set) — a
// safari should never end up with no images at all.
const IMAGE_MATCHER_FALLBACK = [
    'main_image' => 'wildlife/lion-pride-zebra-kill.jpg',
    'gallery' => [
        'hero/ngorongoro-crater-panorama.jpg',
        'gallery/savanna-sunrise-acacia-trees.jpg',
        'gallery/zebras-savanna-plains.jpg',
        'wildlife/cheetah-alert-grassland.jpg',
    ],
];

/**
 * Scans the library folders and returns each image's path (relative to
 * assets/images/) plus its filename-derived keyword list. Paths returned
 * here are the ONLY paths ever considered "known" by the matcher — callers
 * validating a client-submitted suggestion must check membership against
 * this list's paths, never trust a submitted path directly.
 */
function image_matcher_library(): array
{
    static $library = null;
    if ($library !== null) {
        return $library;
    }

    $library = [];
    $baseDir = BASE_PATH . '/assets/images/';

    foreach (IMAGE_MATCHER_LIBRARY_FOLDERS as $folder) {
        $files = glob($baseDir . $folder . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [];
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $keywords = array_filter(
                explode('-', strtolower($filename)),
                static fn(string $word): bool => $word !== '' && !in_array($word, IMAGE_MATCHER_COMPOSITION_WORDS, true)
            );

            $library[] = [
                'path' => $folder . '/' . basename($file),
                'folder' => $folder,
                'keywords' => array_values($keywords),
            ];
        }
    }

    return $library;
}

/**
 * Tokenizes one or more text fields into a word => frequency map. Only
 * English fields should be passed in — the image library's keywords are
 * English filenames, so matching Italian text against them would silently
 * never match. This is a stated scope decision, not an oversight.
 */
function image_matcher_tokenize_text(string ...$fields): array
{
    $text = strtolower(implode(' ', $fields));
    $text = preg_replace('/[^a-z0-9\s]/', ' ', $text) ?? '';
    $words = preg_split('/\s+/', trim($text)) ?: [];

    $counts = [];
    foreach ($words as $word) {
        if ($word === '' || in_array($word, IMAGE_MATCHER_STOPWORDS, true)) {
            continue;
        }
        $counts[$word] = ($counts[$word] ?? 0) + 1;
    }

    return $counts;
}

/**
 * Scores one image's keywords against the safari's body token counts and
 * destination tokens. Base weight 3 per matching keyword, plus up to 5 bonus
 * points for repeated mentions (capped so one obsessively-repeated word
 * can't dominate), plus +2 if the keyword is also a destination word
 * specifically (a stronger signal than an incidental description mention).
 */
function image_matcher_score(array $imageKeywords, array $bodyTokenCounts, array $destinationTokens): int
{
    $score = 0;

    foreach ($imageKeywords as $keyword) {
        if (isset($bodyTokenCounts[$keyword])) {
            $score += 3 + min($bodyTokenCounts[$keyword], 5);
        }
        if (isset($destinationTokens[$keyword])) {
            $score += 2;
        }
    }

    return $score;
}

/**
 * Main entry point. Scores every library image against the safari's English
 * text fields, returns the best single main_image plus 3-6 distinct gallery
 * suggestions. Deterministic: ties are broken by folder preference
 * (wildlife/gallery over hero — heroes are generic site-wide banners, less
 * suited to one safari's own gallery), then alphabetically by path, so
 * re-running "Suggest images" on unchanged data always gives the same
 * result.
 *
 * @return array{main_image: string, gallery: array<int, string>}
 */
function image_matcher_suggest(array $safari, int $galleryCount = 5): array
{
    $galleryCount = max(3, min(6, $galleryCount));

    $bodyTokens = image_matcher_tokenize_text(
        (string) ($safari['title_en'] ?? ''),
        (string) ($safari['destination'] ?? ''),
        (string) ($safari['short_description_en'] ?? ''),
        (string) ($safari['description_en'] ?? '')
    );
    $destinationTokens = image_matcher_tokenize_text((string) ($safari['destination'] ?? ''));

    $scored = [];
    foreach (image_matcher_library() as $entry) {
        $entry['score'] = image_matcher_score($entry['keywords'], $bodyTokens, $destinationTokens);
        $scored[] = $entry;
    }

    $folderRank = ['wildlife' => 0, 'gallery' => 0, 'hero' => 1];

    usort($scored, static function (array $a, array $b) use ($folderRank): int {
        if ($a['score'] !== $b['score']) {
            return $b['score'] <=> $a['score'];
        }
        $rankA = $folderRank[$a['folder']] ?? 1;
        $rankB = $folderRank[$b['folder']] ?? 1;
        if ($rankA !== $rankB) {
            return $rankA <=> $rankB;
        }
        return $a['path'] <=> $b['path'];
    });

    if (empty($scored) || $scored[0]['score'] === 0) {
        return IMAGE_MATCHER_FALLBACK;
    }

    $mainImage = $scored[0]['path'];
    $gallery = [];
    foreach ($scored as $entry) {
        if ($entry['path'] === $mainImage) {
            continue;
        }
        $gallery[] = $entry['path'];
        if (count($gallery) >= $galleryCount) {
            break;
        }
    }

    return ['main_image' => $mainImage, 'gallery' => $gallery];
}

/**
 * Validates that every path in $submittedPaths corresponds to a real,
 * currently-discovered library image — used when accepting a client-
 * submitted suggestion (suggested_gallery_images[]) so a tampered POST body
 * can never insert an arbitrary path into safari_images (closes a path-
 * traversal vector). Returns only the subset that matched.
 */
function image_matcher_filter_known_paths(array $submittedPaths): array
{
    $known = array_column(image_matcher_library(), 'path');
    return array_values(array_intersect($submittedPaths, $known));
}
