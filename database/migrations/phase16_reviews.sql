-- Testimonials. Run once against an existing serengeti_new database that
-- predates this migration. Modeled on latestsafaricode's `testimonials`
-- table per the user's explicit instruction: simple, site-wide, not
-- per-safari. Admin-entered only — no public submission form, since every
-- testimonial must be something staff can vouch for, never fabricated.
USE serengeti_new;

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
