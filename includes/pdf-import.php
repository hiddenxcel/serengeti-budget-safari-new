<?php
declare(strict_types=1);

// Guarded include — the rest of the admin panel must keep working even if
// Composer hasn't been run on a given environment yet.
if (is_file(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}

const PDF_IMPORT_MAX_BYTES = 8 * 1024 * 1024; // 8MB
const PDF_IMPORT_MAX_PAGES = 20;
const PDF_IMPORT_MAX_CHARS = 15000;

/**
 * Validates a $_FILES['itinerary_pdf'] entry. Returns null if valid, or a
 * friendly error string. Checks extension, actual sniffed MIME type (not
 * the client-supplied, spoofable $file['type']), the %PDF- magic-byte
 * header, and size — belt-and-suspenders against a renamed non-PDF file.
 */
function pdf_import_validate_upload(?array $file): ?string
{
    if ($file === null || !isset($file['error'])) {
        return 'No file was uploaded.';
    }

    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            return 'No file was selected.';
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return 'The file is too large.';
        case UPLOAD_ERR_PARTIAL:
            return 'The file upload was interrupted. Please try again.';
        default:
            return 'The file could not be uploaded.';
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        return 'Invalid upload.';
    }

    if ($file['size'] <= 0 || $file['size'] > PDF_IMPORT_MAX_BYTES) {
        return 'The file must be a PDF under 8MB.';
    }

    $extension = strtolower((string) pathinfo((string) $file['name'], PATHINFO_EXTENSION));
    if ($extension !== 'pdf') {
        return 'Only PDF files are accepted.';
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $finfo !== false ? finfo_file($finfo, $file['tmp_name']) : false;
    if ($finfo !== false) {
        finfo_close($finfo);
    }
    if ($mime !== 'application/pdf') {
        return 'The uploaded file does not look like a valid PDF.';
    }

    $header = @file_get_contents($file['tmp_name'], false, null, 0, 5);
    if ($header !== '%PDF-') {
        return 'The uploaded file does not look like a valid PDF.';
    }

    return null;
}

/**
 * Moves a validated upload into storage/tmp_uploads/ under a random name —
 * never trust the original filename. Returns the absolute path.
 */
function pdf_import_store_temp(array $file): string
{
    $dir = BASE_PATH . '/storage/tmp_uploads';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $path = $dir . '/' . bin2hex(random_bytes(16)) . '.pdf';

    if (!move_uploaded_file($file['tmp_name'], $path)) {
        throw new RuntimeException('Could not store the uploaded file.');
    }

    return $path;
}

/**
 * Extracts text from a PDF at $absolutePath, capped to PDF_IMPORT_MAX_PAGES
 * pages and PDF_IMPORT_MAX_CHARS characters before it is ever sent to Groq
 * (bounds both worst-case parse time and Groq token cost/latency).
 * Throws on a malformed/unreadable PDF — callers must catch.
 */
function pdf_import_extract_text(string $absolutePath): string
{
    if (!class_exists(\Smalot\PdfParser\Parser::class)) {
        throw new RuntimeException('PDF import is not configured on this server.');
    }

    $parser = new \Smalot\PdfParser\Parser();
    $document = $parser->parseFile($absolutePath);

    $pages = $document->getPages();
    $text = '';
    $pageCount = 0;

    foreach ($pages as $page) {
        if ($pageCount >= PDF_IMPORT_MAX_PAGES) {
            break;
        }
        $text .= $page->getText() . "\n";
        $pageCount++;
    }

    $text = trim($text);

    if (mb_strlen($text) > PDF_IMPORT_MAX_CHARS) {
        $text = mb_substr($text, 0, PDF_IMPORT_MAX_CHARS);
    }

    return $text;
}

/**
 * Deletes a temp upload; safe to call even if the file is already gone.
 * Always called in a try/finally so no uploaded PDF outlives the single
 * request that processed it.
 */
function pdf_import_delete_temp(string $absolutePath): void
{
    if (is_file($absolutePath)) {
        @unlink($absolutePath);
    }
}

/**
 * Orchestrates the full pipeline: validate -> store -> extract -> delete ->
 * Groq extraction -> Groq translation. Returns
 * ['ok' => bool, 'data' => ?array, 'error' => ?string, 'warning' => ?string].
 * If translation fails after a successful English extraction, the English
 * data is still returned (with a warning) rather than discarding it.
 */
function pdf_import_run(?array $file): array
{
    $validationError = pdf_import_validate_upload($file);
    if ($validationError !== null) {
        return ['ok' => false, 'data' => null, 'error' => $validationError, 'warning' => null];
    }

    $tempPath = pdf_import_store_temp($file);

    try {
        $text = pdf_import_extract_text($tempPath);
    } catch (\Throwable $e) {
        error_log('PDF extraction failed: ' . $e->getMessage());
        return [
            'ok' => false,
            'data' => null,
            'error' => "Couldn't read text from this PDF — it may be a scanned image rather than text. Try a text-based PDF or fill the form manually.",
            'warning' => null,
        ];
    } finally {
        pdf_import_delete_temp($tempPath);
    }

    if (mb_strlen($text) < 50) {
        return [
            'ok' => false,
            'data' => null,
            'error' => "Couldn't read enough text from this PDF — it may be a scanned image rather than text. Try a text-based PDF or fill the form manually.",
            'warning' => null,
        ];
    }

    $extraction = groq_extract_safari_from_text($text);
    if (!$extraction['ok']) {
        return ['ok' => false, 'data' => null, 'error' => $extraction['error'], 'warning' => null];
    }

    $englishData = $extraction['data'];
    $merged = pdf_import_map_english_fields($englishData);
    $warning = null;

    $translation = groq_translate_safari_to_italian($englishData);
    if ($translation['ok']) {
        $merged = pdf_import_merge_italian_fields($merged, $translation['data']);
    } else {
        $warning = 'English content was imported successfully, but the Italian translation failed: ' . $translation['error'];
    }

    return ['ok' => true, 'data' => $merged, 'error' => null, 'warning' => $warning];
}

/**
 * Maps groq_extract_safari_from_text()'s English-only shape onto the
 * _en-suffixed field names admin/safaris/edit.php's form already uses.
 */
function pdf_import_map_english_fields(array $data): array
{
    $days = [];
    foreach ((is_array($data['days'] ?? null) ? $data['days'] : []) as $day) {
        if (!is_array($day)) {
            continue;
        }
        $days[] = [
            'title_en' => (string) ($day['title'] ?? ''),
            'title_it' => '',
            'description_en' => (string) ($day['description'] ?? ''),
            'description_it' => '',
            'activities_en' => (string) ($day['activities'] ?? ''),
            'activities_it' => '',
            'meals' => (string) ($day['meals'] ?? ''),
            'accommodation' => (string) ($day['accommodation'] ?? ''),
        ];
    }

    $tiers = [];
    foreach ((is_array($data['pricing_tiers'] ?? null) ? $data['pricing_tiers'] : []) as $tier) {
        if (!is_array($tier) || empty($tier['up_to_travelers']) || empty($tier['price_per_person'])) {
            continue;
        }
        $tiers[] = [
            'up_to_travelers' => (int) $tier['up_to_travelers'],
            'price_per_person' => (float) $tier['price_per_person'],
            'currency' => (string) ($tier['currency'] ?? 'USD'),
        ];
    }

    return [
        'title_en' => (string) ($data['title'] ?? ''),
        'title_it' => '',
        'short_description_en' => (string) ($data['short_description'] ?? ''),
        'short_description_it' => '',
        'description_en' => (string) ($data['description'] ?? ''),
        'description_it' => '',
        'duration_days' => (int) ($data['duration_days'] ?? max(1, count($days))),
        'safari_type' => $data['safari_type'] ?? null,
        'destination' => (string) ($data['destination'] ?? ''),
        'start_location' => (string) ($data['start_location'] ?? ''),
        'end_location' => (string) ($data['end_location'] ?? ''),
        'days' => $days,
        'tiers' => $tiers,
    ];
}

/**
 * Overlays a successful Italian translation response onto the already-
 * mapped English-shaped array.
 */
function pdf_import_merge_italian_fields(array $merged, array $italian): array
{
    $merged['title_it'] = (string) ($italian['title'] ?? '');
    $merged['short_description_it'] = (string) ($italian['short_description'] ?? '');
    $merged['description_it'] = (string) ($italian['description'] ?? '');

    $italianDays = is_array($italian['days'] ?? null) ? $italian['days'] : [];
    foreach ($italianDays as $i => $day) {
        if (!isset($merged['days'][$i]) || !is_array($day)) {
            continue;
        }
        $merged['days'][$i]['title_it'] = (string) ($day['title'] ?? '');
        $merged['days'][$i]['description_it'] = (string) ($day['description'] ?? '');
        $merged['days'][$i]['activities_it'] = (string) ($day['activities'] ?? '');
    }

    return $merged;
}
