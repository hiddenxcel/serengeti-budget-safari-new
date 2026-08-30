<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

if (admin_logged_in()) {
    header('Location: ' . admin_base_url() . '/index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Your session expired, please try again.';
    } else {
        $error = admin_attempt_login((string) ($_POST['email'] ?? ''), (string) ($_POST['password'] ?? ''));
        if ($error === null) {
            header('Location: ' . admin_base_url() . '/index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Serengeti Budget Safari</title>
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" href="<?= admin_base_url() ?>/assets/admin.css" />
</head>
<body class="admin-login-page">
    <div class="admin-login-card">
        <h1>Admin Login</h1>
        <?php if ($error): ?>
            <div class="admin-error"><?= e($error) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
            <div class="admin-form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus value="<?= e($_POST['email'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" class="admin-btn primary" style="width:100%;">Log in</button>
        </form>
    </div>
</body>
</html>
