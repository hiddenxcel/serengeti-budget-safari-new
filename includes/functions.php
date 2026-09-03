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
