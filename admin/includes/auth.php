<?php
declare(strict_types=1);

require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/includes/functions.php';

const ADMIN_SESSION_KEY = 'admin_user';
const ADMIN_LOGIN_MAX_ATTEMPTS = 5;
const ADMIN_LOGIN_LOCKOUT_SECONDS = 300;

function admin_base_url(): string
{
    static $base = null;

    if ($base === null) {
        $script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $base = rtrim(preg_replace('#/admin(/.*)?$#', '', $script), '/') . '/admin';
    }

    return $base;
}

function admin_logged_in(): bool
{
    return isset($_SESSION[ADMIN_SESSION_KEY]['id']);
}

function current_admin(): ?array
{
    return $_SESSION[ADMIN_SESSION_KEY] ?? null;
}

function require_admin(): void
{
    if (!admin_logged_in()) {
        header('Location: ' . admin_base_url() . '/login.php');
        exit;
    }
}

function require_role(string ...$roles): void
{
    require_admin();
    $user = current_admin();
    if (!in_array($user['role'] ?? '', $roles, true)) {
        http_response_code(403);
        exit('Forbidden: insufficient role.');
    }
}

function admin_login_attempt_key(string $email): string
{
    return 'login_attempts_' . sha1(strtolower($email));
}

function admin_login_locked(string $email): bool
{
    $key = admin_login_attempt_key($email);
    $data = $_SESSION[$key] ?? null;

    if (!$data) {
        return false;
    }

    if ($data['count'] >= ADMIN_LOGIN_MAX_ATTEMPTS && (time() - $data['first_at']) < ADMIN_LOGIN_LOCKOUT_SECONDS) {
        return true;
    }

    if ((time() - $data['first_at']) >= ADMIN_LOGIN_LOCKOUT_SECONDS) {
        unset($_SESSION[$key]);
    }

    return false;
}

function admin_register_failed_attempt(string $email): void
{
    $key = admin_login_attempt_key($email);
    $data = $_SESSION[$key] ?? ['count' => 0, 'first_at' => time()];

    if ((time() - $data['first_at']) >= ADMIN_LOGIN_LOCKOUT_SECONDS) {
        $data = ['count' => 0, 'first_at' => time()];
    }

    $data['count']++;
    $_SESSION[$key] = $data;
}

function admin_clear_failed_attempts(string $email): void
{
    unset($_SESSION[admin_login_attempt_key($email)]);
}

function admin_attempt_login(string $email, string $password): ?string
{
    $email = trim($email);

    if ($email === '' || $password === '') {
        return 'Please enter both email and password.';
    }

    if (admin_login_locked($email)) {
        return 'Too many failed attempts. Please try again in a few minutes.';
    }

    $stmt = db()->prepare('SELECT id, name, email, password_hash, role, is_active FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !$user['is_active'] || !password_verify($password, $user['password_hash'])) {
        admin_register_failed_attempt($email);
        return 'Invalid email or password.';
    }

    admin_clear_failed_attempts($email);
    session_regenerate_id(true);

    $_SESSION[ADMIN_SESSION_KEY] = [
        'id' => (int) $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'],
    ];

    db()->prepare('UPDATE users SET last_login_at = NOW() WHERE id = ?')->execute([$user['id']]);

    return null;
}

function admin_logout(): void
{
    unset($_SESSION[ADMIN_SESSION_KEY]);
    session_regenerate_id(true);
}

function admin_nav_active(string $needle): string
{
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
    return str_contains($script, '/admin/' . $needle) ? ' class="active"' : '';
}
