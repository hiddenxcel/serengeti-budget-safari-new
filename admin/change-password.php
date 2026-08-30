<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

require_admin();

$pageTitle = 'Change Password';
$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $currentPassword = (string) ($_POST['current_password'] ?? '');
        $newPassword = (string) ($_POST['new_password'] ?? '');
        $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

        $stmt = db()->prepare('SELECT password_hash FROM users WHERE id = ?');
        $stmt->execute([current_admin()['id']]);
        $hash = $stmt->fetchColumn();

        if (!$hash || !password_verify($currentPassword, $hash)) {
            $errors[] = 'Your current password is incorrect.';
        } elseif (strlen($newPassword) < 10) {
            $errors[] = 'New password must be at least 10 characters.';
        } elseif ($newPassword !== $confirmPassword) {
            $errors[] = 'New password and confirmation do not match.';
        } else {
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            db()->prepare('UPDATE users SET password_hash = ? WHERE id = ?')->execute([$newHash, current_admin()['id']]);
            $success = 'Password changed successfully.';
        }
    }
}

require __DIR__ . '/includes/layout-head.php';
?>
<?php if ($success): ?>
    <div class="admin-success-msg"><?= e($success) ?></div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<div class="admin-card" style="max-width:420px;">
    <form method="post" action="">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
        <div class="admin-form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required autocomplete="current-password" />
        </div>
        <div class="admin-form-group">
            <label for="new_password">New Password (min 10 characters)</label>
            <input type="password" id="new_password" name="new_password" required minlength="10" autocomplete="new-password" />
        </div>
        <div class="admin-form-group">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required minlength="10" autocomplete="new-password" />
        </div>
        <button type="submit" class="admin-btn primary">Change Password</button>
    </form>
</div>
<?php require __DIR__ . '/includes/layout-foot.php'; ?>
