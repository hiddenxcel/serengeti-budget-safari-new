<?php
declare(strict_types=1);

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'serengeti_new');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SITE_URL', 'http://serengeti.local:8080');
define('BASE_PATH', dirname(__DIR__));

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
