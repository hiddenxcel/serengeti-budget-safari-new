-- Phase 11: Group-joining departures. Run once against an existing
-- serengeti_new database that predates this migration.
USE serengeti_new;

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

ALTER TABLE bookings
    ADD COLUMN departure_id INT UNSIGNED NULL AFTER safari_id,
    ADD CONSTRAINT fk_bookings_departure FOREIGN KEY (departure_id) REFERENCES departures(id) ON DELETE SET NULL;
