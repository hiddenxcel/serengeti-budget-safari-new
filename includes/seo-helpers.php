<?php
declare(strict_types=1);

/**
 * Rule-based SEO scoring for a single safari. Zero API calls — fully
 * independent of Groq uptime/cost. Each check is a fixed point value; the
 * total sums to 100. Deliberately checks EN and IT completeness as separate
 * checks (not just the _en fields), so a safari with perfect English and an
 * empty Italian translation cannot score 100/100.
 *
 * @param array $safari Must include: title_en, title_it, slug,
 *   short_description_en, short_description_it, description_en,
 *   description_it, destination, main_image, meta_title_en, meta_title_it,
 *   meta_description_en, meta_description_it.
 * @param int $dayCount Number of itinerary day rows currently saved.
 * @param int $galleryImageCount Number of safari_images rows currently saved.
 * @return array{score:int, checks: array<int, array{label:string, passed:bool, message:string}>}
 */
function seo_analyze_safari(array $safari, int $dayCount, int $galleryImageCount): array
{
    $checks = [];

    $checks[] = seo_check_meta_title($safari, 'en', 'Meta title (English)', 9);
    $checks[] = seo_check_meta_title($safari, 'it', 'Meta title (Italian)', 9);
    $checks[] = seo_check_meta_description($safari, 'en', 'Meta description (English)', 9);
    $checks[] = seo_check_meta_description($safari, 'it', 'Meta description (Italian)', 9);
    $checks[] = seo_check_keyword_in_title($safari, 'en', 'Destination keyword in English title', 4);
    $checks[] = seo_check_keyword_in_title($safari, 'it', 'Destination keyword in Italian title', 4);
    $checks[] = seo_check_slug_quality($safari, 9);
    $checks[] = seo_check_short_description($safari, 'en', 'Short description (English)', 7);
    $checks[] = seo_check_short_description($safari, 'it', 'Short description (Italian)', 6);
    $checks[] = seo_check_full_description($safari, 'en', 'Full description (English)', 7);
    $checks[] = seo_check_full_description($safari, 'it', 'Full description (Italian)', 6);
    $checks[] = seo_check_main_image($safari, 9);
    $checks[] = seo_check_gallery_images($galleryImageCount, 6);
    $checks[] = seo_check_itinerary_complete($safari, $dayCount, 6);

    $score = 0;
    foreach ($checks as $check) {
        $score += $check['points_awarded'];
        unset($check); // no-op, keeps intent obvious
    }

    // Strip the internal points_awarded/points_possible keys before returning
    // — callers only need label/passed/message for rendering.
    $publicChecks = array_map(static function (array $check): array {
        return [
            'label' => $check['label'],
            'passed' => $check['passed'],
            'message' => $check['message'],
        ];
    }, $checks);

    return ['score' => min(100, $score), 'checks' => $publicChecks];
}

function seo_check_meta_title(array $safari, string $lang, string $label, int $points): array
{
    $value = trim((string) ($safari['meta_title_' . $lang] ?? ''));
    $len = mb_strlen($value);
    $passed = $len >= 15 && $len <= 70;

    $message = $value === ''
        ? 'Add a dedicated SEO title (aim for 30-60 characters).'
        : ($passed ? 'Good length.' : 'Adjust length — aim for 30-60 characters.');

    return seo_result($label, $passed, $message, $passed ? $points : 0);
}

function seo_check_meta_description(array $safari, string $lang, string $label, int $points): array
{
    $value = trim((string) ($safari['meta_description_' . $lang] ?? ''));
    $len = mb_strlen($value);
    $passed = $len >= 70 && $len <= 160;

    $message = $value === ''
        ? 'Add a meta description (aim for 70-160 characters).'
        : ($passed ? 'Good length.' : 'Adjust length — aim for 70-160 characters.');

    return seo_result($label, $passed, $message, $passed ? $points : 0);
}

function seo_check_keyword_in_title(array $safari, string $lang, string $label, int $points): array
{
    $destination = trim((string) ($safari['destination'] ?? ''));
    $title = (string) ($safari['title_' . $lang] ?? '');

    if ($destination === '') {
        return seo_result($label, false, 'Set a destination first so this can be checked.', 0);
    }

    $passed = mb_stripos($title, $destination) !== false;
    $message = $passed
        ? 'Destination name appears in the title.'
        : sprintf('Consider mentioning "%s" in the title.', $destination);

    return seo_result($label, $passed, $message, $passed ? $points : 0);
}

function seo_check_slug_quality(array $safari, int $points): array
{
    $slug = (string) ($safari['slug'] ?? '');
    $passed = $slug !== ''
        && preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $slug) === 1
        && mb_strlen($slug) <= 75;

    $message = $passed
        ? 'Slug is clean and reasonably short.'
        : 'Slug should be lowercase, hyphenated, and under ~75 characters.';

    return seo_result('Slug quality', $passed, $message, $passed ? $points : 0);
}

function seo_check_short_description(array $safari, string $lang, string $label, int $points): array
{
    $value = trim((string) ($safari['short_description_' . $lang] ?? ''));
    $passed = mb_strlen($value) >= 50;

    $message = $passed
        ? 'Good length.'
        : 'Add at least 50 characters of short description.';

    return seo_result($label, $passed, $message, $passed ? $points : 0);
}

function seo_check_full_description(array $safari, string $lang, string $label, int $points): array
{
    $value = trim((string) ($safari['description_' . $lang] ?? ''));
    $passed = mb_strlen($value) >= 300;

    $message = $passed
        ? 'Good amount of on-page content.'
        : 'Add more detail — aim for at least 300 characters.';

    return seo_result($label, $passed, $message, $passed ? $points : 0);
}

function seo_check_main_image(array $safari, int $points): array
{
    $passed = trim((string) ($safari['main_image'] ?? '')) !== '';
    $message = $passed ? 'Main image is set.' : 'No main image set yet.';

    return seo_result('Main image present', $passed, $message, $passed ? $points : 0);
}

function seo_check_gallery_images(int $galleryImageCount, int $points): array
{
    $passed = $galleryImageCount >= 3;
    $message = $passed
        ? sprintf('%d gallery images.', $galleryImageCount)
        : 'Add at least 3 gallery images.';

    return seo_result('Gallery images (3+)', $passed, $message, $passed ? $points : 0);
}

function seo_check_itinerary_complete(array $safari, int $dayCount, int $points): array
{
    $duration = (int) ($safari['duration_days'] ?? 0);
    $passed = $duration > 0 && $dayCount >= $duration;

    $message = $passed
        ? 'Itinerary covers the full duration.'
        : sprintf('Itinerary has %d of %d day(s) filled in.', $dayCount, max($duration, 0));

    return seo_result('Itinerary structure complete', $passed, $message, $passed ? $points : 0);
}

function seo_result(string $label, bool $passed, string $message, int $pointsAwarded): array
{
    return [
        'label' => $label,
        'passed' => $passed,
        'message' => $message,
        'points_awarded' => $pointsAwarded,
    ];
}
