# Serengeti Budget Safari — Website Rebuild

A from-scratch rebuild of the Serengeti Budget Safari website: plain PHP (no framework), bilingual (English / Italiano), built with shared header/footer partials and a translation-key system so both languages stay in sync.

## Stack

- PHP 8.2 (no framework — includes/partials pattern)
- Plain CSS (single `assets/css/main.css`), vanilla JS (`assets/js/main.js`)
- MySQL (planned, for an upcoming booking system — not yet wired up)

## Structure

- `index.php` — canonical page content lives here at the site root for each page (e.g. `safari/index.php`, `parks/index.php`)
- `en/<page>/index.php` and `it/<page>/index.php` — one-line wrappers that `require` the canonical file, so URLs resolve per language
- `includes/header.php` / `includes/footer.php` — shared layout, SEO meta, mega-menu navigation
- `lang/en.php` / `lang/it.php` — translation strings, same keys, real translations (not machine placeholders)
- `assets/images/{hero,wildlife,gallery,team}/` — real photography from the operator's own safaris
- `config/config.php` — local dev DB config (XAMPP defaults, not production credentials)

## Local development

Requires PHP + MySQL (e.g. via XAMPP). Point Apache's document root at this folder and visit `/en/` or `/it/`.

Run `composer install` after cloning (PDF import for the admin panel depends on `smalot/pdfparser`). Copy `config/secrets.example.php` to `config/secrets.php` and fill in `GROQ_API_KEY` (and optionally `PAGESPEED_API_KEY`) — both are gitignored and never committed. Apply any new files under `database/migrations/` in order against the live database.

## Pages built so far

Home, Safaris (packages listing + Group Joining Safaris), Parks (listing + Serengeti detail page), Trekking, Zanzibar.
