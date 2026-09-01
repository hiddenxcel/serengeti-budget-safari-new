-- Phase 18: Site-wide SEO Intelligence Center (admin/seo/).
-- Distinct from the per-safari SEO checklist added in phase17 — this
-- audits the entire crawled website, not one safari's own DB fields.
-- Run once against an existing serengeti_new database. Additive only.
USE serengeti_new;

CREATE TABLE IF NOT EXISTS seo_audits (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    status ENUM('running', 'completed', 'failed', 'cancelled') NOT NULL DEFAULT 'running',
    target_url VARCHAR(255) NOT NULL COMMENT 'seo_settings.website_url snapshotted at audit start',
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
    crawl_queue_json MEDIUMTEXT NULL COMMENT 'BFS queue/visited/inbound-link state between chunk requests; NULL once completed',
    ai_search_recommendations_json VARCHAR(2000) NULL COMMENT 'optional Groq groq_analyze_ai_search_readiness() result, one call per audit',
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
    facts_json MEDIUMTEXT NULL COMMENT 'full structured facts array from seo_analyze_page() for this URL',
    crawled_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_seo_pages_audit FOREIGN KEY (audit_id) REFERENCES seo_audits(id) ON DELETE CASCADE,
    INDEX idx_seo_pages_audit (audit_id),
    INDEX idx_seo_pages_url (audit_id, url(191))
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS seo_issues (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    audit_id INT UNSIGNED NOT NULL,
    page_id INT UNSIGNED NULL COMMENT 'NULL for site-wide issues e.g. robots.txt missing',
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

INSERT INTO seo_settings (id, website_url) VALUES (1, '') ON DUPLICATE KEY UPDATE id = id;
