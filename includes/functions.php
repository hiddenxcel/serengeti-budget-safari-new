<?php
declare(strict_types=1);

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
