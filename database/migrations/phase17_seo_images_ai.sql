-- Phase 17: SEO meta fields + PDF-import tracking on safaris.
-- Run once against an existing serengeti_new database that predates this
-- migration. Additive only — safe to run against the live seeded DB.
-- safari_images already existed since Phase 1 but was never written to;
-- this phase is its first real writer (see admin/safaris/edit.php changes),
-- so no schema change is needed for it here.
USE serengeti_new;

ALTER TABLE safaris
    ADD COLUMN meta_title_en VARCHAR(70) NULL AFTER title_it,
    ADD COLUMN meta_title_it VARCHAR(70) NULL AFTER meta_title_en,
    ADD COLUMN meta_description_en VARCHAR(320) NULL AFTER short_description_it,
    ADD COLUMN meta_description_it VARCHAR(320) NULL AFTER meta_description_en,
    ADD COLUMN imported_from_pdf_at DATETIME NULL AFTER status;
