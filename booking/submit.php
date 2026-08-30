<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

header('Content-Type: application/json');

function booking_json_error(string $message, int $code = 400): void
{
    http_response_code($code);
    echo json_encode(['ok' => false, 'error' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    booking_json_error('Invalid request method.', 405);
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    booking_json_error('Your session expired. Please refresh the page and try again.');
}

$firstName = trim((string) ($_POST['first_name'] ?? ''));
$lastName = trim((string) ($_POST['last_name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$country = trim((string) ($_POST['country'] ?? ''));
$adults = max(1, min(20, (int) ($_POST['adults'] ?? 1)));
$children = max(0, min(20, (int) ($_POST['children'] ?? 0)));
$travelDate = trim((string) ($_POST['travel_date'] ?? ''));
$specialRequests = trim((string) ($_POST['special_requests'] ?? ''));
$safariId = (int) ($_POST['safari_id'] ?? 0);
$safariTitle = trim((string) ($_POST['safari_title'] ?? ''));
$fallbackPp = ($_POST['fallback_pp'] ?? '') !== '' ? (float) $_POST['fallback_pp'] : null;
$fallbackCurrency = trim((string) ($_POST['fallback_currency'] ?? 'USD')) ?: 'USD';

if ($firstName === '' || $lastName === '' || $email === '') {
    booking_json_error('Please fill in your name and email.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    booking_json_error('Please enter a valid email address.');
}

if ($travelDate !== '') {
    $date = DateTime::createFromFormat('Y-m-d', $travelDate);
    if (!$date || $date < new DateTime('today')) {
        booking_json_error('Please choose a valid travel date (today or later).');
    }
}

$safari = null;
if ($safariId > 0) {
    $stmt = db()->prepare('SELECT * FROM safaris WHERE id = ?');
    $stmt->execute([$safariId]);
    $safari = $stmt->fetch() ?: null;
}

// Compute price server-side — never trust the client-side estimate.
$currency = $fallbackCurrency;
$pricePerPerson = $fallbackPp;

if ($safari) {
    $tiersStmt = db()->prepare('SELECT up_to_travelers, price_per_person, currency FROM pricing_tiers WHERE safari_id = ? ORDER BY up_to_travelers');
    $tiersStmt->execute([$safari['id']]);
    $tiers = $tiersStmt->fetchAll();

    $totalTravelers = $adults + $children;
    $selected = null;
    foreach ($tiers as $tier) {
        if ($totalTravelers <= (int) $tier['up_to_travelers']) {
            $selected = $tier;
            break;
        }
    }
    if (!$selected && $tiers) {
        $selected = end($tiers);
    }

    if ($selected) {
        $pricePerPerson = (float) $selected['price_per_person'];
        $currency = $selected['currency'];
    }
}

$estimatedTotal = $pricePerPerson !== null ? $pricePerPerson * ($adults + $children) : null;

try {
    db()->beginTransaction();

    // Find or create the customer by email (simple match — no accounts/passwords).
    $customerStmt = db()->prepare('SELECT id FROM customers WHERE email = ? LIMIT 1');
    $customerStmt->execute([$email]);
    $customerId = $customerStmt->fetchColumn();

    if ($customerId) {
        db()->prepare('UPDATE customers SET first_name = ?, last_name = ?, phone = ?, country = ? WHERE id = ?')
            ->execute([$firstName, $lastName, $phone ?: null, $country ?: null, $customerId]);
    } else {
        db()->prepare('INSERT INTO customers (first_name, last_name, email, phone, country) VALUES (?, ?, ?, ?, ?)')
            ->execute([$firstName, $lastName, $email, $phone ?: null, $country ?: null]);
        $customerId = db()->lastInsertId();
    }

    // Generate a unique human-readable reference like TZ1042.
    do {
        $reference = 'TZ' . random_int(1000, 9999);
        $existsStmt = db()->prepare('SELECT COUNT(*) FROM bookings WHERE reference = ?');
        $existsStmt->execute([$reference]);
    } while ((int) $existsStmt->fetchColumn() > 0);

    $notes = $specialRequests;
    if (!$safari && $safariTitle !== '') {
        $notes = "Package: $safariTitle" . ($notes ? "\n\n$notes" : '');
    }

    db()->prepare(
        'INSERT INTO bookings (reference, safari_id, customer_id, travel_date, adults, children, estimated_total, currency, special_requests, status)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "pending")'
    )->execute([
        $reference,
        $safari ? $safari['id'] : null,
        $customerId,
        $travelDate ?: null,
        $adults,
        $children,
        $estimatedTotal,
        $currency,
        $notes ?: null,
    ]);

    db()->commit();
} catch (Throwable $e) {
    db()->rollBack();
    booking_json_error('We could not save your booking. Please try again or contact us on WhatsApp.', 500);
}

echo json_encode([
    'ok' => true,
    'reference' => $reference,
    'estimated_total' => $estimatedTotal,
    'currency' => $currency,
]);
