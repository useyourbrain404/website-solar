-- ==========================================================
-- AK ENERGIES - Admin Panel Database
-- Import this file through phpMyAdmin (Import tab) into a
-- new, empty database. No command-line MySQL needed.
-- ==========================================================

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- Table: admins
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default login -> username: admin | password: admin123
-- CHANGE THIS PASSWORD after first login.
INSERT INTO `admins` (`username`, `password`, `full_name`) VALUES
('admin', '$2y$10$sEQMVjhRdcULA2ewkdNqHOZrEM3Fc.xeKEEuMABBjKwiRcJObR6G6', 'Administrator');

-- --------------------------------------------------------
-- Table: services
-- Card fields (listing page) + detail fields (details page)
-- live on the same record, matching the two service screens.
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,               -- e.g. "Solar Panel Installation"
  `slug` VARCHAR(170) NOT NULL UNIQUE,
  `short_description` TEXT,                    -- card blurb under the title
  `card_image` VARCHAR(255) DEFAULT NULL,       -- listing card photo
  `tag_label` VARCHAR(100) DEFAULT NULL,        -- e.g. "PROFESSIONAL WORKERS"
  `heading` VARCHAR(200) DEFAULT NULL,          -- e.g. "Expert Solar Installation"
  `long_description` LONGTEXT,                  -- rich text, details page paragraph
  `detail_image1` VARCHAR(255) DEFAULT NULL,    -- large detail photo
  `detail_image2` VARCHAR(255) DEFAULT NULL,    -- overlapping smaller detail photo
  `status` ENUM('active','inactive') DEFAULT 'active',
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: projects
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,               -- e.g. "BrightHome Energy"
  `slug` VARCHAR(170) NOT NULL UNIQUE,
  `card_image` VARCHAR(255) DEFAULT NULL,       -- listing card photo
  `intro_description` TEXT,                     -- rich text intro paragraph on details page
  `status` ENUM('active','inactive') DEFAULT 'active',
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: project_goals  ("Client Goal" checklist)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_goals` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT NOT NULL,
  `goal_text` VARCHAR(255) NOT NULL,
  `sort_order` INT DEFAULT 0,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: project_results  ("Impact & Results" checklist)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_results` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT NOT NULL,
  `result_text` VARCHAR(255) NOT NULL,
  `sort_order` INT DEFAULT 0,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: project_images  (gallery strip at bottom of details page)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_images` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `sort_order` INT DEFAULT 0,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: enquiries  ("Get a Quote" / contact form submissions)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(30) DEFAULT NULL,
  `service_interested` VARCHAR(150) DEFAULT NULL,
  `message` TEXT,
  `status` ENUM('new','contacted','closed') DEFAULT 'new',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
