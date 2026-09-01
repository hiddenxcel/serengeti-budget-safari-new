<?php
declare(strict_types=1);

// Flip to false when deploying to production — this must never show raw
// PHP errors/stack traces/file paths to visitors. Left true here since this
// is still the XAMPP development environment (SITE_URL below confirms it).
define('APP_DEBUG', true);

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
}

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax',
    // 'secure' is intentionally left false while the site is served over
    // plain HTTP on XAMPP (SITE_URL below) — flip to true once deployed
    // behind HTTPS, or the session cookie will silently stop being sent.
    'secure' => false,
]);
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'serengeti_new');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SITE_URL', 'http://serengeti.local:8080');
define('BASE_PATH', dirname(__DIR__));

// Optional local/server-only secrets (Groq API key etc). Gitignored — see
// config/secrets.example.php. If missing, GROQ_API_KEY stays undefined and
// AI-dependent admin features degrade to a friendly error instead of a fatal.
if (is_file(__DIR__ . '/secrets.php')) {
    require_once __DIR__ . '/secrets.php';
}

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    return $pdo;
}
