<?php
declare(strict_types=1);

function admin_slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
    return trim($text, '-');
}

function admin_unique_safari_slug(string $base, ?int $excludeId = null): string
{
    $slug = admin_slugify($base);
    if ($slug === '') {
        $slug = 'safari';
    }

    $original = $slug;
    $i = 2;

    while (true) {
        $sql = 'SELECT COUNT(*) FROM safaris WHERE slug = ?' . ($excludeId ? ' AND id != ?' : '');
        $params = $excludeId ? [$slug, $excludeId] : [$slug];
        $stmt = db()->prepare($sql);
        $stmt->execute($params);

        if ((int) $stmt->fetchColumn() === 0) {
            return $slug;
        }

        $slug = $original . '-' . $i;
        $i++;
    }
}

function admin_safari_statuses(): array
{
    return ['draft', 'published', 'archived'];
}

function admin_safari_types(): array
{
    return ['budget', 'luxury', 'migration', 'family', 'group_joining'];
}
