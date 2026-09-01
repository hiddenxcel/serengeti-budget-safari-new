<?php
declare(strict_types=1);

/**
 * The ONLY file that talks to Groq. Each task below builds its own prompt
 * and calls groq_chat() exactly once — no task function calls another one.
 * This is deliberate: the business asked for "one API call, one job", never
 * a single mega-prompt handling extraction + translation + SEO together.
 */

/**
 * Low-level transport. Never throws — callers get a uniform
 * {ok, data, error} shape so a Groq outage or bad key renders a friendly
 * admin-error instead of a fatal page. Never returns the API key, request
 * headers, or the raw provider response body in the error string — only a
 * safe, generic message; full detail goes to error_log() for diagnosis.
 */
function groq_chat(string $systemPrompt, string $userPrompt, bool $jsonMode = true, int $timeoutSeconds = 45): array
{
    if (!defined('GROQ_API_KEY') || GROQ_API_KEY === '') {
        return ['ok' => false, 'data' => null, 'error' => 'AI features are not configured on this server.'];
    }

    $payload = [
        'model' => defined('GROQ_MODEL') ? GROQ_MODEL : 'openai/gpt-oss-120b',
        'temperature' => 0.2,
        'messages' => [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $userPrompt],
        ],
    ];

    if ($jsonMode) {
        $payload['response_format'] = ['type' => 'json_object'];
    }

    $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . GROQ_API_KEY,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
        CURLOPT_TIMEOUT => $timeoutSeconds,
        CURLOPT_CONNECTTIMEOUT => 10,
    ]);

    $response = curl_exec($ch);
    $curlErrno = curl_errno($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($curlErrno !== 0) {
        error_log('Groq API curl error (' . $curlErrno . '): ' . curl_strerror($curlErrno));
        return ['ok' => false, 'data' => null, 'error' => 'Could not reach the AI service. Please try again.'];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        error_log('Groq API non-2xx response, HTTP ' . $httpCode . ': ' . substr((string) $response, 0, 500));
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned an error (HTTP ' . $httpCode . ').'];
    }

    $envelope = json_decode((string) $response, true);
    if (!is_array($envelope) || !isset($envelope['choices'][0]['message']['content'])) {
        error_log('Groq API unexpected envelope shape: ' . substr((string) $response, 0, 500));
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned an unexpected response.'];
    }

    $content = (string) $envelope['choices'][0]['message']['content'];
    $data = json_decode($content, true);

    if (!is_array($data)) {
        error_log('Groq API content was not valid JSON: ' . substr($content, 0, 500));
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return ['ok' => true, 'data' => $data, 'error' => null];
}

/**
 * Task A: PDF text -> structured English safari data. English only —
 * translation is a deliberately separate call (see below).
 */
function groq_extract_safari_from_text(string $pdfText): array
{
    $types = implode(', ', admin_safari_types());

    $system = "You are a data extraction tool for a safari tour operator. "
        . "You will be given raw text extracted from a safari itinerary PDF. "
        . "Extract ONLY facts that are actually present in the text — never invent or guess "
        . "details that aren't there; use null or an empty value instead. "
        . "Respond with ONLY a JSON object with exactly these keys: "
        . "title (string), short_description (string, 1-2 sentences), description (string, longer overview), "
        . "duration_days (integer), safari_type (one of: {$types}, or null if unclear), "
        . "destination (string, main park/region name), start_location (string or null), end_location (string or null), "
        . "days (array of objects, one per itinerary day, each with: day_number (integer), title (string), "
        . "description (string), activities (string), meals (string, e.g. \"B, L, D\"), accommodation (string)), "
        . "pricing_tiers (array of objects, each with: up_to_travelers (integer), price_per_person (number), currency (3-letter code)). "
        . "If pricing or itinerary days aren't present in the text, return an empty array for that key.";

    $result = groq_chat($system, $pdfText);
    if (!$result['ok']) {
        return $result;
    }

    if (!groq_validate_extracted_safari_shape($result['data'])) {
        error_log('Groq extraction response failed schema validation: ' . substr(json_encode($result['data']), 0, 500));
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return $result;
}

/**
 * Defensive schema check on the extraction task's response, before it is
 * ever allowed into a session draft or the admin form. Rejects anything
 * that doesn't match the expected shape/types rather than trusting the
 * model's output blindly.
 */
function groq_validate_extracted_safari_shape(mixed $data): bool
{
    if (!is_array($data) || !isset($data['title']) || !is_string($data['title']) || trim($data['title']) === '') {
        return false;
    }

    if (isset($data['duration_days']) && !is_numeric($data['duration_days'])) {
        return false;
    }

    foreach (['days', 'pricing_tiers'] as $listKey) {
        if (isset($data[$listKey]) && !is_array($data[$listKey])) {
            return false;
        }
    }

    if (isset($data['days']) && is_array($data['days'])) {
        foreach ($data['days'] as $day) {
            if (!is_array($day)) {
                return false;
            }
        }
    }

    if (isset($data['pricing_tiers']) && is_array($data['pricing_tiers'])) {
        foreach ($data['pricing_tiers'] as $tier) {
            if (!is_array($tier)) {
                return false;
            }
        }
    }

    return true;
}

/**
 * Task B: translate a structured English safari data array to Italian.
 * Deliberately a second, independent Groq call — never merged with
 * extraction. Only text fields are sent; numbers/currency are not touched.
 */
function groq_translate_safari_to_italian(array $englishSafariData): array
{
    $translatable = [
        'title' => $englishSafariData['title'] ?? '',
        'short_description' => $englishSafariData['short_description'] ?? '',
        'description' => $englishSafariData['description'] ?? '',
        'days' => array_map(static function ($day) {
            return [
                'day_number' => $day['day_number'] ?? null,
                'title' => $day['title'] ?? '',
                'description' => $day['description'] ?? '',
                'activities' => $day['activities'] ?? '',
                'accommodation' => $day['accommodation'] ?? '',
            ];
        }, is_array($englishSafariData['days'] ?? null) ? $englishSafariData['days'] : []),
    ];

    $system = 'You are a professional Italian tourism copywriter. You will be given a JSON object '
        . 'of English safari-tour text fields. Translate every text value to natural, fluent Italian '
        . '(not a literal word-for-word translation) suitable for a tourism website. Preserve numbers, '
        . 'proper nouns (park names like "Serengeti", "Ngorongoro", "Tarangire"), and the exact same '
        . 'JSON structure and keys you were given, including day_number values unchanged. '
        . 'Respond with ONLY the translated JSON object, same shape as the input.';

    $result = groq_chat($system, json_encode($translatable, JSON_UNESCAPED_UNICODE));
    if (!$result['ok']) {
        return $result;
    }

    if (!is_array($result['data']) || !isset($result['data']['title']) || !is_string($result['data']['title'])) {
        error_log('Groq translation response failed schema validation: ' . substr(json_encode($result['data']), 0, 500));
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return $result;
}

/**
 * Task C: suggest SEO meta title/description in both languages. Fully
 * separate from the two calls above, and from the rule-based score in
 * includes/seo-helpers.php. On-demand only — never called automatically.
 */
function groq_suggest_seo_meta(array $safari): array
{
    $system = 'You are an SEO copywriter for a Tanzania safari tour operator. Given a safari package\'s '
        . 'title, destination, duration, and short description, write search-engine-optimized meta tags. '
        . 'Respond with ONLY a JSON object with exactly these keys: '
        . 'meta_title_en (string, 30-60 characters), meta_title_it (string, 30-60 characters, Italian), '
        . 'meta_description_en (string, 70-155 characters), meta_description_it (string, 70-155 characters, Italian). '
        . 'Nothing else in the response.';

    $userPrompt = json_encode([
        'title' => $safari['title_en'] ?? '',
        'destination' => $safari['destination'] ?? '',
        'duration_days' => $safari['duration_days'] ?? null,
        'short_description' => $safari['short_description_en'] ?? '',
    ], JSON_UNESCAPED_UNICODE);

    $result = groq_chat($system, (string) $userPrompt, true, 20);
    if (!$result['ok']) {
        return $result;
    }

    $required = ['meta_title_en', 'meta_title_it', 'meta_description_en', 'meta_description_it'];
    foreach ($required as $key) {
        if (!isset($result['data'][$key]) || !is_string($result['data'][$key])) {
            error_log('Groq SEO-suggestion response failed schema validation: ' . substr(json_encode($result['data']), 0, 500));
            return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
        }
    }

    return $result;
}

/**
 * Site-wide SEO Intelligence Center (admin/seo/) task functions below.
 * Same "one call, one job" rule as the per-safari tasks above.
 */

/**
 * Suggests an improved title/meta description for one crawled page flagged
 * by the SEO audit. Language-aware: states explicitly which language the
 * response must be written in rather than letting the model guess.
 */
function groq_generate_meta_title(array $pageFacts): array
{
    $lang = ($pageFacts['lang'] ?? 'en') === 'it' ? 'Italian' : 'English';

    $system = "You are an SEO copywriter for a Tanzania safari tour operator's website. Given a page's URL, "
        . "current title (may be missing, too long, or duplicated), main heading, and a short content snippet, "
        . "write an improved SEO title tag (30-60 characters) and meta description (70-155 characters). "
        . "Write the response in {$lang} — the same language as the provided content. "
        . 'Respond with ONLY a JSON object with exactly these keys: suggested_title, suggested_description.';

    $userPrompt = json_encode([
        'url' => $pageFacts['url'] ?? '',
        'current_title' => $pageFacts['title'] ?? '',
        'h1_text' => $pageFacts['headings'][0]['text'] ?? '',
        'content_snippet' => mb_substr((string) ($pageFacts['content_snippet'] ?? ''), 0, 200),
    ], JSON_UNESCAPED_UNICODE);

    $result = groq_chat($system, (string) $userPrompt);
    if (!$result['ok']) {
        return $result;
    }

    if (!isset($result['data']['suggested_title'], $result['data']['suggested_description'])
        || !is_string($result['data']['suggested_title']) || !is_string($result['data']['suggested_description'])
    ) {
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return $result;
}

/**
 * Suggests alt text for one flagged image. The model cannot see the actual
 * image in this implementation — the prompt is deliberately honest about
 * that limitation rather than pretending otherwise; the calling admin UI
 * must show the same caveat to whoever uses the suggestion.
 */
function groq_generate_alt_text(array $imageFacts): array
{
    $system = 'You are writing accessible, SEO-appropriate alt text for a photo on a Tanzania safari tourism website. '
        . 'You cannot see the actual image — base your suggestion ONLY on the filename, the page it appears on, and '
        . 'the page title/context given. If the filename gives no real information, respond with a generic-but-honest '
        . 'placeholder rather than inventing implausible specific detail. '
        . 'Respond with ONLY a JSON object with key "suggested_alt" (string, under 125 characters).';

    $userPrompt = json_encode([
        'image_src' => $imageFacts['src'] ?? '',
        'page_title' => $imageFacts['page_title'] ?? '',
        'page_url' => $imageFacts['page_url'] ?? '',
    ], JSON_UNESCAPED_UNICODE);

    $result = groq_chat($system, (string) $userPrompt);
    if (!$result['ok']) {
        return $result;
    }

    if (!isset($result['data']['suggested_alt']) || !is_string($result['data']['suggested_alt'])) {
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return $result;
}

/**
 * One call for the WHOLE audit (not per page) — "AI search readiness" is
 * inherently a site-wide judgment, not a per-page fact. Informal/heuristic
 * assessment, explicitly not an official Google/AI-provider metric.
 */
function groq_analyze_ai_search_readiness(array $siteFactsSummary): array
{
    $system = 'You are evaluating a tourism website\'s readiness for AI-powered search/answer engines. '
        . 'This is an informal, non-official assessment, not a Google ranking metric. '
        . 'Given this summary of a site\'s structure, suggest the 3 highest-impact improvements, in English. '
        . 'Respond with ONLY a JSON object with key "recommendations" (array of up to 3 strings).';

    $result = groq_chat($system, (string) json_encode($siteFactsSummary, JSON_UNESCAPED_UNICODE));
    if (!$result['ok']) {
        return $result;
    }

    if (!isset($result['data']['recommendations']) || !is_array($result['data']['recommendations'])) {
        return ['ok' => false, 'data' => null, 'error' => 'The AI service returned data in an unexpected format.'];
    }

    return $result;
}
