# Production Deployment Checklist

Not yet done — complete these before the booking/admin system goes live on real hosting.

## Before deploy

- [ ] Set `APP_DEBUG` to `false` in `config/config.php` (currently `true` for XAMPP development — this stops PHP from ever displaying raw errors/stack traces/file paths to visitors).
- [ ] Update `SITE_URL` in `config/config.php` from `http://serengeti.local:8080` to the real production domain, using `https://`.
- [ ] Once served over HTTPS, flip `secure => false` to `secure => true` in the `session_set_cookie_params()` call in `config/config.php` (currently false because XAMPP serves plain HTTP — leaving it false in production would still work but forgoes a real protection).
- [ ] Change the admin password (`admin/change-password.php`) away from any password used during development/testing.
- [ ] Export the local `serengeti_new` database and import it on the production MySQL server; update `DB_HOST`/`DB_NAME`/`DB_USER`/`DB_PASS` in `config/config.php` to the production credentials (never reuse the local blank-password root account in production).
- [ ] Confirm `database/.htaccess` (denies all web access to the `database/` folder) is present and working on the production server — some hosts disable `.htaccess` by default (`AllowOverride None`); verify with a direct request to `/database/schema.sql` and confirm it 403s.
- [ ] Set real PHP `display_errors=Off` / `log_errors=On` at the server/php.ini level too, not just via `ini_set()` in `config.php` (defense in depth — a fatal error before `config.php` finishes loading would otherwise still be affected only by the server default).
- [ ] Decide on and configure SMTP credentials if real email notifications (Phase 10) are wanted — currently deferred, the site works fully without them (WhatsApp-first).

## Data hygiene

- [ ] Confirm no test/seed data remains in `safaris`, `bookings`, `customers`, `payments`, `departures` tables (all Phase 1–15 development testing was cleaned up after each session, but do one final check with `SELECT COUNT(*) FROM <table>` before going live).
- [ ] Populate real group-departure dates in `admin/departures/` — the public `safari/groups.php` page currently shows a clearly-labeled illustrative example table when no real departures exist in the DB.
- [ ] Review and, if needed, populate real per-safari pricing tiers via `admin/safaris/edit.php` for every safari that should be bookable — safaris not yet migrated into the DB still use their original hardcoded fallback pricing (3-day and 5-day Serengeti packages).

## Known gaps (deliberately deferred, not bugs)

- No online payment gateway — by design, payment is arranged off-site by staff (confirmed business decision).
- No automated email notifications — blocked on SMTP credentials; an in-admin "Recent Activity" feed covers new bookings/payments in the meantime.
- Currency handling is USD-only in the database schema even though some public pages historically displayed € — if the business takes bookings in multiple real currencies, revisit `admin/reports/index.php` and `admin/customers/view.php`'s revenue totals, which currently sum `payments.amount` without grouping by currency.
- `require_role()` exists in `admin/includes/auth.php` but is unused — every admin account currently has identical (full) access regardless of the `role` column. Fine for a single-admin/small-staff setup; wire it in if a restricted "staff" role is ever needed.

## Verified working (2026-08-30, this session)

Full booking lifecycle (1/2/6 travelers, with children, invalid dates, cancellation, partial→full payment), admin CRUD (safari create/edit/price-change/publish), invoice generation, and a security probe pass (unauthorized admin access on all 7 protected pages, SQL injection payloads, XSS payloads in booking name/special-requests fields, forged CSRF tokens) were all tested live against this codebase and passed. See project memory for full detail per phase.
