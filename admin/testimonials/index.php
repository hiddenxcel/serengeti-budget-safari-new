<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Testimonials';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Invalid request.');
    }

    $action = (string) ($_POST['action'] ?? '');
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0 && $action === 'hide') {
        db()->prepare("UPDATE testimonials SET status = 'hidden' WHERE id = ?")->execute([$id]);
    } elseif ($id > 0 && $action === 'publish') {
        db()->prepare("UPDATE testimonials SET status = 'published' WHERE id = ?")->execute([$id]);
    } elseif ($id > 0 && $action === 'delete') {
        db()->prepare('DELETE FROM testimonials WHERE id = ?')->execute([$id]);
    }

    header('Location: ' . admin_base_url() . '/testimonials/index.php');
    exit;
}

$testimonials = db()->query('SELECT * FROM testimonials ORDER BY sort_order ASC, created_at DESC')->fetchAll();

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div></div>
    <a href="<?= admin_base_url() ?>/testimonials/edit.php" class="admin-btn primary">+ Add Testimonial</a>
</div>

<div class="admin-card">
    <?php if (!$testimonials): ?>
        <div class="admin-empty-state">No testimonials yet. Add a real guest review to start showing them on the site.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Guest</th>
                    <th>Rating</th>
                    <th>Quote</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $t): ?>
                <tr>
                    <td><strong><?= e($t['guest_name']) ?></strong><br><span style="color:#888;font-size:0.8rem;"><?= e($t['guest_country'] ?: '—') ?></span></td>
                    <td><?= str_repeat('★', (int) $t['rating']) . str_repeat('☆', 5 - (int) $t['rating']) ?></td>
                    <td style="max-width:320px;"><?= e(mb_strimwidth($t['quote_en'], 0, 110, '…')) ?></td>
                    <td><span class="admin-badge <?= $t['status'] === 'published' ? 'published' : 'draft' ?>"><?= ucfirst($t['status']) ?></span></td>
                    <td>
                        <div class="admin-row-actions">
                            <a class="admin-btn" href="<?= admin_base_url() ?>/testimonials/edit.php?id=<?= $t['id'] ?>">Edit</a>
                            <?php if ($t['status'] === 'published'): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $t['id'] ?>" />
                                <input type="hidden" name="action" value="hide" />
                                <button type="submit" class="admin-btn">Hide</button>
                            </form>
                            <?php else: ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $t['id'] ?>" />
                                <input type="hidden" name="action" value="publish" />
                                <button type="submit" class="admin-btn">Publish</button>
                            </form>
                            <?php endif; ?>
                            <form method="post" style="display:inline;" onsubmit="return confirm('Delete this testimonial permanently?');">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $t['id'] ?>" />
                                <input type="hidden" name="action" value="delete" />
                                <button type="submit" class="admin-btn danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
