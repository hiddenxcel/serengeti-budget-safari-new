<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__) . '/includes/safari-helpers.php';

require_admin();

$pageTitle = 'Safaris';

// Handle quick row actions (publish/draft/archive/duplicate/delete) via POST + CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Invalid request.');
    }

    $action = (string) ($_POST['action'] ?? '');
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        if ($action === 'set_status' && in_array($_POST['status'] ?? '', admin_safari_statuses(), true)) {
            db()->prepare('UPDATE safaris SET status = ? WHERE id = ?')->execute([$_POST['status'], $id]);
        } elseif ($action === 'duplicate') {
            $stmt = db()->prepare('SELECT * FROM safaris WHERE id = ?');
            $stmt->execute([$id]);
            $safari = $stmt->fetch();

            if ($safari) {
                $newSlug = admin_unique_safari_slug($safari['slug'] . '-copy');
                $insert = db()->prepare('INSERT INTO safaris
                    (slug, title_en, title_it, meta_title_en, meta_title_it, short_description_en, short_description_it,
                     meta_description_en, meta_description_it, description_en, description_it,
                     duration_days, safari_type, destination, start_location, end_location, main_image, status, created_by)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "draft", ?)');
                $insert->execute([
                    $newSlug,
                    $safari['title_en'] . ' (Copy)',
                    $safari['title_it'] . ' (Copia)',
                    $safari['meta_title_en'],
                    $safari['meta_title_it'],
                    $safari['short_description_en'],
                    $safari['short_description_it'],
                    $safari['meta_description_en'],
                    $safari['meta_description_it'],
                    $safari['description_en'],
                    $safari['description_it'],
                    $safari['duration_days'],
                    $safari['safari_type'],
                    $safari['destination'],
                    $safari['start_location'],
                    $safari['end_location'],
                    $safari['main_image'],
                    current_admin()['id'],
                ]);
                $newId = (int) db()->lastInsertId();

                $days = db()->prepare('SELECT * FROM safari_days WHERE safari_id = ? ORDER BY day_number');
                $days->execute([$id]);
                $dayInsert = db()->prepare('INSERT INTO safari_days
                    (safari_id, day_number, title_en, title_it, description_en, description_it, activities_en, activities_it, meals, accommodation, image_path)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                foreach ($days->fetchAll() as $day) {
                    $dayInsert->execute([
                        $newId, $day['day_number'], $day['title_en'], $day['title_it'],
                        $day['description_en'], $day['description_it'], $day['activities_en'], $day['activities_it'],
                        $day['meals'], $day['accommodation'], $day['image_path'],
                    ]);
                }

                $tiers = db()->prepare('SELECT * FROM pricing_tiers WHERE safari_id = ?');
                $tiers->execute([$id]);
                $tierInsert = db()->prepare('INSERT INTO pricing_tiers (safari_id, up_to_travelers, price_per_person, currency) VALUES (?, ?, ?, ?)');
                foreach ($tiers->fetchAll() as $tier) {
                    $tierInsert->execute([$newId, $tier['up_to_travelers'], $tier['price_per_person'], $tier['currency']]);
                }

                $images = db()->prepare('SELECT * FROM safari_images WHERE safari_id = ? ORDER BY sort_order');
                $images->execute([$id]);
                $imageInsert = db()->prepare('INSERT INTO safari_images (safari_id, image_path, sort_order) VALUES (?, ?, ?)');
                foreach ($images->fetchAll() as $image) {
                    $imageInsert->execute([$newId, $image['image_path'], $image['sort_order']]);
                }
            }
        } elseif ($action === 'delete') {
            db()->prepare('DELETE FROM safaris WHERE id = ?')->execute([$id]);
        }
    }

    header('Location: ' . admin_base_url() . '/safaris/index.php' . (isset($_GET['status']) ? '?status=' . urlencode($_GET['status']) : ''));
    exit;
}

$statusFilter = $_GET['status'] ?? 'all';
$search = trim((string) ($_GET['q'] ?? ''));

$where = [];
$params = [];

if (in_array($statusFilter, admin_safari_statuses(), true)) {
    $where[] = 'status = ?';
    $params[] = $statusFilter;
}

if ($search !== '') {
    $where[] = '(title_en LIKE ? OR title_it LIKE ? OR slug LIKE ?)';
    $like = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

$sql = 'SELECT * FROM safaris';
if ($where) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= ' ORDER BY updated_at DESC';

$stmt = db()->prepare($sql);
$stmt->execute($params);
$safaris = $stmt->fetchAll();

$counts = db()->query('SELECT status, COUNT(*) c FROM safaris GROUP BY status')->fetchAll(PDO::FETCH_KEY_PAIR);

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div class="admin-filter-bar">
        <a href="?status=all" class="<?= $statusFilter === 'all' ? 'active' : '' ?>">All (<?= array_sum($counts) ?>)</a>
        <?php foreach (admin_safari_statuses() as $s): ?>
            <a href="?status=<?= e($s) ?>" class="<?= $statusFilter === $s ? 'active' : '' ?>"><?= ucfirst($s) ?> (<?= $counts[$s] ?? 0 ?>)</a>
        <?php endforeach; ?>
    </div>
    <a href="<?= admin_base_url() ?>/safaris/edit.php" class="admin-btn primary">+ Add Safari</a>
</div>

<form method="get" class="admin-card" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:end;">
    <input type="hidden" name="status" value="<?= e($statusFilter) ?>" />
    <div class="admin-form-group" style="flex:1;min-width:220px;margin-bottom:0;">
        <label for="q">Search by title or slug</label>
        <input type="text" id="q" name="q" value="<?= e($search) ?>" placeholder="e.g. Serengeti" />
    </div>
    <button type="submit" class="admin-btn">Search</button>
</form>

<div class="admin-card">
    <?php if (!$safaris): ?>
        <div class="admin-empty-state">No safaris found. <a href="<?= admin_base_url() ?>/safaris/edit.php">Add your first safari</a>.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($safaris as $safari): ?>
                <tr>
                    <td>
                        <strong><?= e($safari['title_en']) ?></strong><br>
                        <span style="color:#888;font-size:0.8rem;"><?= e($safari['slug']) ?></span>
                    </td>
                    <td><?= e($safari['safari_type'] ?? '—') ?></td>
                    <td><?= (int) $safari['duration_days'] ?> day<?= (int) $safari['duration_days'] === 1 ? '' : 's' ?></td>
                    <td><span class="admin-badge <?= e($safari['status']) ?>"><?= ucfirst($safari['status']) ?></span></td>
                    <td><?= e(date('d M Y', strtotime($safari['updated_at']))) ?></td>
                    <td>
                        <div class="admin-row-actions">
                            <a class="admin-btn" href="<?= admin_base_url() ?>/safaris/edit.php?id=<?= $safari['id'] ?>">Edit</a>

                            <form method="post" action="?status=<?= e($statusFilter) ?>" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $safari['id'] ?>" />
                                <input type="hidden" name="action" value="duplicate" />
                                <button type="submit" class="admin-btn">Duplicate</button>
                            </form>

                            <?php if ($safari['status'] !== 'published'): ?>
                            <form method="post" action="?status=<?= e($statusFilter) ?>" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $safari['id'] ?>" />
                                <input type="hidden" name="action" value="set_status" />
                                <input type="hidden" name="status" value="published" />
                                <button type="submit" class="admin-btn">Publish</button>
                            </form>
                            <?php else: ?>
                            <form method="post" action="?status=<?= e($statusFilter) ?>" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $safari['id'] ?>" />
                                <input type="hidden" name="action" value="set_status" />
                                <input type="hidden" name="status" value="draft" />
                                <button type="submit" class="admin-btn">Unpublish</button>
                            </form>
                            <?php endif; ?>

                            <?php if ($safari['status'] !== 'archived'): ?>
                            <form method="post" action="?status=<?= e($statusFilter) ?>" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $safari['id'] ?>" />
                                <input type="hidden" name="action" value="set_status" />
                                <input type="hidden" name="status" value="archived" />
                                <button type="submit" class="admin-btn">Archive</button>
                            </form>
                            <?php endif; ?>

                            <form method="post" action="?status=<?= e($statusFilter) ?>" style="display:inline;" onsubmit="return confirm('Delete this safari permanently? This cannot be undone.');">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $safari['id'] ?>" />
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
