-- KAS - Full schema + active seeders SQL import
-- Generated from Laravel migrations and active DatabaseSeeder registrations
-- Import target: MySQL 8+
-- This script drops existing tables if they exist, recreates them, then inserts seed data.
-- Included seeders: AdminUserSeeder, CrmWorkflowSeeder
-- Not included by default: WebsiteStaticSeeder (not registered in DatabaseSeeder)

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `crm_activities`;
DROP TABLE IF EXISTS `opportunities`;
DROP TABLE IF EXISTS `leads`;
DROP TABLE IF EXISTS `kpi_metrics`;
DROP TABLE IF EXISTS `quotes`;
DROP TABLE IF EXISTS `cache_locks`;
DROP TABLE IF EXISTS `cache`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `testimonials`;
DROP TABLE IF EXISTS `project_images`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `contact_messages`;
DROP TABLE IF EXISTS `company`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `projects`;
DROP TABLE IF EXISTS `clients`;
DROP TABLE IF EXISTS `activity_sectors`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `role` enum('ADMIN','EDITOR') NOT NULL DEFAULT 'EDITOR',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activity_sectors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_class` varchar(100) DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sector_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `logo_url` varchar(500) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo_path` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_sector_id_foreign` (`sector_id`),
  CONSTRAINT `clients_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `activity_sectors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sector_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_desc` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `main_image_url` varchar(500) DEFAULT NULL,
  `main_image_path` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`),
  KEY `projects_sector_id_foreign` (`sector_id`),
  KEY `projects_client_id_foreign` (`client_id`),
  CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `projects_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `activity_sectors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_desc` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon_class` varchar(100) DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `company` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(500) DEFAULT NULL,
  `logo_path` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('NEW','IN_PROGRESS','CLOSED') NOT NULL DEFAULT 'NEW',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sector_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_sector_id_foreign` (`sector_id`),
  CONSTRAINT `products_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `activity_sectors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `project_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_project_id_foreign` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(150) NOT NULL,
  `client_role` varchar(150) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `avatar_url` varchar(500) DEFAULT NULL,
  `avatar_path` varchar(500) DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`),
  CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `quotes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `service_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `status` enum('NEW','IN_PROGRESS','SENT','ACCEPTED','REJECTED') NOT NULL DEFAULT 'NEW',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_service_id_foreign` (`service_id`),
  KEY `quotes_project_id_foreign` (`project_id`),
  CONSTRAINT `quotes_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotes_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kpi_metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` int unsigned NOT NULL DEFAULT 0,
  `unit` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `formula_rule` varchar(1000) DEFAULT NULL,
  `data_snapshot` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` smallint unsigned NOT NULL DEFAULT 1,
  `last_calculated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kpi_metrics_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `leads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(50) NOT NULL DEFAULT 'WEBSITE_CONTACT',
  `fullname` varchar(150) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `sector_id` bigint unsigned DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'NEW',
  `score` tinyint unsigned NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `owner_id` bigint unsigned DEFAULT NULL,
  `converted_client_id` bigint unsigned DEFAULT NULL,
  `last_contact_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_email_index` (`email`),
  KEY `leads_status_index` (`status`),
  KEY `leads_sector_id_foreign` (`sector_id`),
  KEY `leads_owner_id_foreign` (`owner_id`),
  KEY `leads_converted_client_id_foreign` (`converted_client_id`),
  CONSTRAINT `leads_converted_client_id_foreign` FOREIGN KEY (`converted_client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `leads_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `leads_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `activity_sectors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `opportunities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `name` varchar(180) NOT NULL,
  `amount` decimal(14,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) NOT NULL DEFAULT 'EUR',
  `stage` varchar(30) NOT NULL DEFAULT 'DISCOVERY',
  `probability` tinyint unsigned NOT NULL DEFAULT 20,
  `expected_close_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'OPEN',
  `owner_id` bigint unsigned DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opportunities_stage_index` (`stage`),
  KEY `opportunities_status_index` (`status`),
  KEY `opportunities_lead_id_foreign` (`lead_id`),
  KEY `opportunities_client_id_foreign` (`client_id`),
  KEY `opportunities_owner_id_foreign` (`owner_id`),
  CONSTRAINT `opportunities_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `opportunities_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `opportunities_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `crm_activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `opportunity_id` bigint unsigned DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'TASK',
  `subject` varchar(180) NOT NULL,
  `description` text DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `owner_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crm_activities_status_index` (`status`),
  KEY `crm_activities_lead_id_foreign` (`lead_id`),
  KEY `crm_activities_client_id_foreign` (`client_id`),
  KEY `crm_activities_opportunity_id_foreign` (`opportunity_id`),
  KEY `crm_activities_owner_id_foreign` (`owner_id`),
  CONSTRAINT `crm_activities_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `crm_activities_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `crm_activities_opportunity_id_foreign` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `crm_activities_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_01_14_061114_create_activity_sectors_table', 1),
(6, '2026_01_14_062914_create_clients_table', 1),
(7, '2026_01_14_064826_create_projects_table', 1),
(8, '2026_01_14_065914_create_services_table', 1),
(9, '2026_01_20_065914_create_company_table', 1),
(10, '2026_01_20_065914_create_contact_messages_table', 1),
(11, '2026_01_20_065914_create_products_table', 1),
(12, '2026_01_20_065914_create_project_images_table', 1),
(13, '2026_01_20_065914_create_testimonials_table', 1),
(14, '2026_01_22_141405_create_sessions_table', 1),
(15, '2026_01_22_145326_create_cache_table', 1),
(16, '2026_01_23_210717_create_quotes_table', 1),
(17, '2026_01_29_212529_add_short_desc_to_products_table', 1),
(18, '2026_01_29_213138_add_display_order_to_products_table', 1),
(19, '2026_03_26_180000_create_kpi_metrics_table', 1),
(20, '2026_03_26_190000_add_local_image_paths_to_components', 1),
(21, '2026_03_26_200000_create_leads_table', 1),
(22, '2026_03_26_200100_create_opportunities_table', 1),
(23, '2026_03_26_200200_create_crm_activities_table', 1);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `fullname`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin KAS', 'admin@kas.local', '2026-03-26 10:00:00', '$2y$10$vA3/ZPhadKc/YCynw.c./.ev5/hrxb7GdU/MnSIgFVtllKcbPak/C', 'Administrateur KAS', 'ADMIN', NULL, '2026-03-26 10:00:00', '2026-03-26 10:00:00'),
(2, 'Nadia Sales', 'crm.owner1@kas.local', '2026-03-26 10:00:00', '$2y$10$YkJxm8SpxWyMQSoG3g7vP.bdrki8ogQ9/4Exy0sqTV0d/xjQUrQxy', 'Nadia Sales Manager', 'ADMIN', NULL, '2026-03-26 10:00:00', '2026-03-26 10:00:00'),
(3, 'Karim BizDev', 'crm.owner2@kas.local', '2026-03-26 10:00:00', '$2y$10$YkJxm8SpxWyMQSoG3g7vP.bdrki8ogQ9/4Exy0sqTV0d/xjQUrQxy', 'Karim Business Developer', 'ADMIN', NULL, '2026-03-26 10:00:00', '2026-03-26 10:00:00');

INSERT INTO `activity_sectors` (`id`, `name`, `description`, `icon_class`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Industrie', 'Automatisation et optimisation de processus industriels.', 'fas fa-briefcase', 1, 1, '2026-03-26 10:05:00', '2026-03-26 10:05:00'),
(2, 'Logistique', 'Pilotage transport, stock et operations supply chain.', 'fas fa-briefcase', 2, 1, '2026-03-26 10:05:00', '2026-03-26 10:05:00'),
(3, 'Sante', 'Digitalisation des parcours patients et outils medicaux.', 'fas fa-briefcase', 3, 1, '2026-03-26 10:05:00', '2026-03-26 10:05:00'),
(4, 'Finance', 'Solutions de conformite, KYC et pilotage de risque.', 'fas fa-briefcase', 4, 1, '2026-03-26 10:05:00', '2026-03-26 10:05:00'),
(5, 'Education', 'Plateformes d apprentissage et gestion academique.', 'fas fa-briefcase', 5, 1, '2026-03-26 10:05:00', '2026-03-26 10:05:00');

INSERT INTO `clients` (`id`, `sector_id`, `name`, `logo_url`, `website_url`, `description`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'AFG Industrie', NULL, 'https://afgindustrie.tn', 'Compte client alimente par le seeder CRM workflow.', NULL, '2026-03-26 10:06:00', '2026-03-26 10:06:00'),
(2, 2, 'Blue Harbor Logistics', NULL, 'https://blueharborlogistics.tn', 'Compte client alimente par le seeder CRM workflow.', NULL, '2026-03-26 10:06:00', '2026-03-26 10:06:00'),
(3, 3, 'MedCare Group', NULL, 'https://medcaregroup.tn', 'Compte client alimente par le seeder CRM workflow.', NULL, '2026-03-26 10:06:00', '2026-03-26 10:06:00'),
(4, 4, 'FinTrust', NULL, 'https://fintrust.tn', 'Compte client alimente par le seeder CRM workflow.', NULL, '2026-03-26 10:06:00', '2026-03-26 10:06:00'),
(5, 5, 'EduSmart', NULL, 'https://edusmart.tn', 'Compte client alimente par le seeder CRM workflow.', NULL, '2026-03-26 10:06:00', '2026-03-26 10:06:00');

INSERT INTO `leads` (`id`, `source`, `fullname`, `email`, `phone`, `company`, `sector_id`, `status`, `score`, `notes`, `owner_id`, `converted_client_id`, `last_contact_at`, `created_at`, `updated_at`) VALUES
(1, 'WEBSITE_CONTACT', 'Rami Ben Salah', 'rami.bensalah@afg-industrie.tn', '+21650111222', 'AFG Industrie', 1, 'QUALIFIED', 72, 'Interesse par un portail fournisseur et une API de synchronisation ERP.', 2, NULL, '2026-03-22 09:00:00', '2026-03-26 10:10:00', '2026-03-26 10:10:00'),
(2, 'REFERRAL', 'Sara Kharrat', 'sara.kharrat@blueharbor.tn', '+21652123456', 'Blue Harbor Logistics', 2, 'NURTURING', 58, 'Besoin exprime: suivi en temps reel des operations et dashboard transport.', 3, NULL, '2026-03-17 10:00:00', '2026-03-26 10:10:00', '2026-03-26 10:10:00'),
(3, 'WEBSITE_CONTACT', 'Noura Trabelsi', 'noura.trabelsi@medcare-group.tn', '+21655099887', 'MedCare Group', 3, 'CONVERTED', 91, 'Lead converti suite a validation du POC et signature du lot 1.', 2, 3, '2026-03-24 11:00:00', '2026-03-26 10:10:00', '2026-03-26 10:10:00'),
(4, 'EVENT', 'Yassine Gharbi', 'y.gharbi@fintrust.tn', '+21658666444', 'FinTrust', 4, 'LOST', 33, 'Budget reporte sur exercice suivant. A relancer au prochain trimestre.', 3, NULL, '2026-02-28 08:30:00', '2026-03-26 10:10:00', '2026-03-26 10:10:00'),
(5, 'WEBSITE_CONTACT', 'Amel Jaziri', 'amel.jaziri@edusmart.tn', '+21654777888', 'EduSmart', 5, 'NEW', 44, 'Premier contact recu via formulaire. Qualification en attente.', 2, NULL, '2026-03-25 14:00:00', '2026-03-26 10:10:00', '2026-03-26 10:10:00');

INSERT INTO `opportunities` (`id`, `lead_id`, `client_id`, `name`, `amount`, `currency`, `stage`, `probability`, `expected_close_date`, `status`, `owner_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Portail fournisseurs AFG', 42000.00, 'EUR', 'PROPOSAL', 65, '2026-04-16', 'OPEN', 2, 'Proposition envoyee. Attente retour sur planning d integration.', '2026-03-26 10:15:00', '2026-03-26 10:15:00'),
(2, 2, NULL, 'Dashboard transport Blue Harbor', 28000.00, 'EUR', 'QUALIFICATION', 40, '2026-05-10', 'OPEN', 3, 'Cadrage en cours avec equipe operations et IT interne.', '2026-03-26 10:15:00', '2026-03-26 10:15:00'),
(3, 3, 3, 'Plateforme patient MedCare - Lot 1', 76000.00, 'EUR', 'WON', 100, '2026-03-23', 'WON', 2, 'Contrat signe. Kickoff planifie.', '2026-03-26 10:15:00', '2026-03-26 10:15:00'),
(4, 4, NULL, 'Refonte parcours KYC FinTrust', 35000.00, 'EUR', 'LOST', 0, '2026-03-08', 'LOST', 3, 'Perdu sur contrainte budget, mais relation maintenue.', '2026-03-26 10:15:00', '2026-03-26 10:15:00');

INSERT INTO `crm_activities` (`id`, `lead_id`, `client_id`, `opportunity_id`, `type`, `subject`, `description`, `due_at`, `completed_at`, `status`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'CALL', 'Call de qualification fonctionnelle', 'Validation des priorites metier et des connecteurs ERP cibles.', '2026-03-20 09:00:00', '2026-03-20 10:00:00', 'DONE', 2, '2026-03-26 10:20:00', '2026-03-26 10:20:00'),
(2, 1, NULL, 1, 'EMAIL', 'Envoi proposition commerciale', 'Proposition et macro-planning envoyes au sponsor.', '2026-03-24 14:00:00', '2026-03-24 14:30:00', 'DONE', 2, '2026-03-26 10:20:00', '2026-03-26 10:20:00'),
(3, 2, NULL, 2, 'MEETING', 'Atelier process transport', 'Atelier de cadrage avec operations et data manager.', '2026-03-29 11:00:00', NULL, 'PENDING', 3, '2026-03-26 10:20:00', '2026-03-26 10:20:00'),
(4, 3, 3, 3, 'TASK', 'Preparation kickoff projet', 'Verifier backlog initial, planning sprint 0 et gouvernance.', '2026-03-31 09:30:00', NULL, 'PENDING', 2, '2026-03-26 10:20:00', '2026-03-26 10:20:00'),
(5, 4, NULL, 4, 'NOTE', 'Motif de perte et plan de relance', 'Opportunity perdue pour budget. Relance prevue debut prochain trimestre.', '2026-03-12 16:00:00', '2026-03-12 16:30:00', 'DONE', 3, '2026-03-26 10:20:00', '2026-03-26 10:20:00'),
(6, 5, NULL, NULL, 'TASK', 'Qualification initiale du lead', 'Premier appel a planifier pour comprendre le besoin EdTech.', '2026-03-27 09:00:00', NULL, 'PENDING', 2, '2026-03-26 10:20:00', '2026-03-26 10:20:00');

SET FOREIGN_KEY_CHECKS = 1;

-- Login credentials from this SQL seed:
-- admin@kas.local / Admin@123456
-- crm.owner1@kas.local / Owner@123456
-- crm.owner2@kas.local / Owner@123456
