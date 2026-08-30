<?php
declare(strict_types=1);

function admin_booking_statuses(): array
{
    return ['pending', 'confirmed', 'partially_paid', 'paid', 'cancelled', 'completed'];
}
