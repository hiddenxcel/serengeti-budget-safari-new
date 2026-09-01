-- Serengeti Budget Safari — Booking + Admin schema
-- Phase 1: core tables only (users, customers, safaris, safari_days, pricing_tiers,
-- bookings, booking_travelers, payments, inquiries). More tables (departures,
-- reviews, notifications, etc.) are added in later phases as needed.

CREATE DATABASE IF NOT EXISTS serengeti_new
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE serengeti_new;

-- ---------------------------------------------------------------------------
-- Admin / staff users (NOT customers — see `customers` below)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL DEFAULT 'staff',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    last_login_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Customers (the people who submit booking requests — not site logins)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS customers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(40) NULL,
    country VARCHAR(80) NULL,
    notes TEXT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_customers_email (email)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Safaris (admin-managed packages — replaces hardcoded package PHP files
-- incrementally; legacy hardcoded pages keep working until migrated)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS safaris (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(160) NOT NULL UNIQUE,
    title_en VARCHAR(190) NOT NULL,
    title_it VARCHAR(190) NOT NULL,
    meta_title_en VARCHAR(70) NULL,
    meta_title_it VARCHAR(70) NULL,
    short_description_en VARCHAR(500) NULL,
    short_description_it VARCHAR(500) NULL,
    meta_description_en VARCHAR(320) NULL,
    meta_description_it VARCHAR(320) NULL,
    description_en TEXT NULL,
    description_it TEXT NULL,
    duration_days SMALLINT UNSIGNED NOT NULL DEFAULT 1,
    safari_type VARCHAR(60) NULL COMMENT 'e.g. budget, luxury, migration, family',
    destination VARCHAR(120) NULL,
    start_location VARCHAR(120) NULL,
    end_location VARCHAR(120) NULL,
    main_image VARCHAR(255) NULL,
    status ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
    imported_from_pdf_at DATETIME NULL,
    created_by INT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_safaris_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_safaris_status (status)
) ENGINE=InnoDB;

-- Gallery images for a safari (main_image above covers the hero/cover shot)
CREATE TABLE IF NOT EXISTS safari_images (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    safari_id INT UNSIGNED NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    sort_order SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    CONSTRAINT fk_safari_images_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Day-by-day itinerary
CREATE TABLE IF NOT EXISTS safari_days (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    safari_id INT UNSIGNED NOT NULL,
    day_number SMALLINT UNSIGNED NOT NULL,
    title_en VARCHAR(190) NULL,
    title_it VARCHAR(190) NULL,
    description_en TEXT NULL,
    description_it TEXT NULL,
    activities_en TEXT NULL,
    activities_it TEXT NULL,
    meals VARCHAR(120) NULL COMMENT 'e.g. Breakfast, Lunch, Dinner',
    accommodation VARCHAR(190) NULL,
    image_path VARCHAR(255) NULL,
    CONSTRAINT fk_safari_days_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE CASCADE,
    UNIQUE KEY uniq_safari_day (safari_id, day_number)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Pricing: per-safari group-size ladder (replaces hardcoded data-tiers JSON)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS pricing_tiers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    safari_id INT UNSIGNED NOT NULL,
    up_to_travelers SMALLINT UNSIGNED NOT NULL COMMENT 'tier applies when traveler count <= this value',
    price_per_person DECIMAL(10,2) NOT NULL,
    currency CHAR(3) NOT NULL DEFAULT 'USD',
    CONSTRAINT fk_pricing_tiers_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE CASCADE,
    UNIQUE KEY uniq_safari_tier (safari_id, up_to_travelers)
) ENGINE=InnoDB;

-- Optional per-safari surcharges/child pricing (nullable — not all safaris set these)
CREATE TABLE IF NOT EXISTS safari_pricing_options (
    safari_id INT UNSIGNED NOT NULL PRIMARY KEY,
    child_price_per_person DECIMAL(10,2) NULL,
    single_supplement DECIMAL(10,2) NULL,
    private_supplement DECIMAL(10,2) NULL,
    CONSTRAINT fk_pricing_options_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Bookings (request-based — no payment gateway; staff confirm payment off-site)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS bookings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(20) NOT NULL UNIQUE COMMENT 'e.g. TZ1042',
    safari_id INT UNSIGNED NULL,
    customer_id INT UNSIGNED NOT NULL,
    travel_date DATE NULL,
    adults SMALLINT UNSIGNED NOT NULL DEFAULT 1,
    children SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    estimated_total DECIMAL(10,2) NULL,
    currency CHAR(3) NOT NULL DEFAULT 'USD',
    special_requests TEXT NULL,
    status ENUM('pending', 'confirmed', 'partially_paid', 'paid', 'cancelled', 'completed')
        NOT NULL DEFAULT 'pending',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_bookings_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE SET NULL,
    CONSTRAINT fk_bookings_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE RESTRICT,
    INDEX idx_bookings_status (status),
    INDEX idx_bookings_travel_date (travel_date)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Payments (manual/off-site records only — never card data)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS payments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id INT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency CHAR(3) NOT NULL DEFAULT 'USD',
    method ENUM('bank_transfer', 'mobile_money', 'cash', 'other') NOT NULL DEFAULT 'other',
    paid_at DATE NOT NULL,
    note VARCHAR(255) NULL,
    recorded_by INT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payments_booking FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    CONSTRAINT fk_payments_recorded_by FOREIGN KEY (recorded_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Generic contact-form / lead inquiries (kept separate from firm bookings)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(40) NULL,
    country VARCHAR(80) NULL,
    interest VARCHAR(160) NULL,
    message TEXT NULL,
    status ENUM('new', 'contacted', 'closed') NOT NULL DEFAULT 'new',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- Phase 11: Group-joining departures (fixed-date, shared-vehicle safaris).
-- capacity - confirmed bookings = live seats available. Not linked to a
-- `safaris` row by foreign key on purpose — group departures are often a
-- named itinerary that may or may not have its own detail page yet.
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS departures (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    safari_id INT UNSIGNED NULL,
    itinerary_label VARCHAR(190) NOT NULL COMMENT 'e.g. "4-Day Big Five Safari" — shown even if safari_id is null',
    departure_date DATE NOT NULL,
    price_per_person DECIMAL(10,2) NOT NULL,
    currency CHAR(3) NOT NULL DEFAULT 'USD',
    capacity SMALLINT UNSIGNED NOT NULL DEFAULT 6,
    status ENUM('open', 'cancelled') NOT NULL DEFAULT 'open' COMMENT 'admin can manually cancel a departure',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_departures_safari FOREIGN KEY (safari_id) REFERENCES safaris(id) ON DELETE SET NULL,
    INDEX idx_departures_date (departure_date)
) ENGINE=InnoDB;

-- Links a booking to the specific departure it joined (nullable — most
-- bookings are private/custom trips, not group departures).
ALTER TABLE bookings
    ADD COLUMN departure_id INT UNSIGNED NULL AFTER safari_id,
    ADD CONSTRAINT fk_bookings_departure FOREIGN KEY (departure_id) REFERENCES departures(id) ON DELETE SET NULL;

-- ---------------------------------------------------------------------------
-- Testimonials. Modeled on the simpler site-wide (not per-safari) pattern
-- used elsewhere in the industry, per explicit user direction. Admin-entered
-- only — no public submission form, since every testimonial must be
-- something staff can vouch for, never fabricated.
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS testimonials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    guest_name VARCHAR(150) NOT NULL,
    guest_country VARCHAR(100) NULL,
    quote_en TEXT NOT NULL,
    quote_it TEXT NULL COMMENT 'optional — falls back to quote_en if not translated',
    rating TINYINT UNSIGNED NOT NULL DEFAULT 5 COMMENT '1-5 stars',
    sort_order SMALLINT NOT NULL DEFAULT 0,
    status ENUM('published', 'hidden') NOT NULL DEFAULT 'published',
    created_by INT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_testimonials_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT chk_testimonials_rating CHECK (rating BETWEEN 1 AND 5),
    INDEX idx_testimonials_status (status)
) ENGINE=InnoDB;

-- Site-wide SEO Intelligence Center (admin/seo/) — distinct from the
-- per-safari SEO checklist columns on `safaris` above.
CREATE TABLE IF NOT EXISTS seo_audits (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    status ENUM('running', 'completed', 'failed', 'cancelled') NOT NULL DEFAULT 'running',
    target_url VARCHAR(255) NOT NULL,
    pages_discovered SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    pages_crawled SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    overall_score TINYINT UNSIGNED NULL,
    score_technical TINYINT UNSIGNED NULL,
    score_onpage TINYINT UNSIGNED NULL,
    score_content TINYINT UNSIGNED NULL,
    score_indexability TINYINT UNSIGNED NULL,
    score_links TINYINT UNSIGNED NULL,
    score_images TINYINT UNSIGNED NULL,
    score_structured_data TINYINT UNSIGNED NULL,
    score_performance TINYINT UNSIGNED NULL,
    performance_scored TINYINT(1) NOT NULL DEFAULT 0,
    crawl_queue_json MEDIUMTEXT NULL,
    ai_search_recommendations_json VARCHAR(2000) NULL,
    error_message VARCHAR(500) NULL,
    started_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    completed_at DATETIME NULL,
    started_by INT UNSIGNED NULL,
    CONSTRAINT fk_seo_audits_started_by FOREIGN KEY (started_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_seo_audits_status (status),
    INDEX idx_seo_audits_started_at (started_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seo_pages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    audit_id INT UNSIGNED NOT NULL,
    url VARCHAR(500) NOT NULL,
    path VARCHAR(255) NOT NULL,
    lang ENUM('en', 'it') NULL,
    http_status SMALLINT UNSIGNED NULL,
    redirect_to VARCHAR(500) NULL,
    response_time_ms INT UNSIGNED NULL,
    content_bytes INT UNSIGNED NULL,
    title VARCHAR(255) NULL,
    title_length SMALLINT UNSIGNED NULL,
    meta_description VARCHAR(500) NULL,
    meta_description_length SMALLINT UNSIGNED NULL,
    h1_count TINYINT UNSIGNED NULL,
    word_count INT UNSIGNED NULL,
    canonical_url VARCHAR(500) NULL,
    is_noindex TINYINT(1) NOT NULL DEFAULT 0,
    internal_link_count SMALLINT UNSIGNED NULL,
    inbound_link_count SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    image_count SMALLINT UNSIGNED NULL,
    images_missing_alt SMALLINT UNSIGNED NULL,
    schema_types_json VARCHAR(255) NULL,
    hreflang_ok TINYINT(1) NULL,
    content_hash CHAR(40) NULL,
    facts_json MEDIUMTEXT NULL,
    crawled_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_seo_pages_audit FOREIGN KEY (audit_id) REFERENCES seo_audits(id) ON DELETE CASCADE,
    INDEX idx_seo_pages_audit (audit_id),
    INDEX idx_seo_pages_url (audit_id, url(191))
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seo_issues (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    audit_id INT UNSIGNED NOT NULL,
    page_id INT UNSIGNED NULL,
    category ENUM('technical', 'onpage', 'content', 'indexability', 'links', 'images', 'structured_data', 'performance', 'international', 'trust') NOT NULL,
    severity ENUM('critical', 'warning', 'info') NOT NULL,
    issue_code VARCHAR(60) NOT NULL,
    message VARCHAR(500) NOT NULL,
    source_url VARCHAR(500) NULL,
    target_url VARCHAR(500) NULL,
    anchor_text VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_seo_issues_audit FOREIGN KEY (audit_id) REFERENCES seo_audits(id) ON DELETE CASCADE,
    CONSTRAINT fk_seo_issues_page FOREIGN KEY (page_id) REFERENCES seo_pages(id) ON DELETE CASCADE,
    INDEX idx_seo_issues_audit (audit_id),
    INDEX idx_seo_issues_severity (audit_id, severity),
    INDEX idx_seo_issues_code (audit_id, issue_code)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seo_settings (
    id TINYINT UNSIGNED PRIMARY KEY DEFAULT 1,
    website_url VARCHAR(255) NOT NULL DEFAULT '',
    max_pages SMALLINT UNSIGNED NOT NULL DEFAULT 200,
    max_depth TINYINT UNSIGNED NOT NULL DEFAULT 10,
    request_timeout_seconds TINYINT UNSIGNED NOT NULL DEFAULT 10,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
