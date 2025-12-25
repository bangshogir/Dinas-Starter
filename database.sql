SET FOREIGN_KEY_CHECKS=0;
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dinasstarter2_db.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('published','draft','archived') NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint unsigned DEFAULT NULL,
  `author_id` bigint unsigned NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_status_published_at_index` (`status`,`published_at`),
  KEY `articles_category_id_index` (`category_id`),
  KEY `articles_author_id_index` (`author_id`),
  KEY `articles_is_featured_index` (`is_featured`),
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `article_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.articles: ~4 rows (approximately)
DELETE FROM `articles`;
INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `excerpt`, `featured_image`, `status`, `is_featured`, `category_id`, `author_id`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Selamat Datang di Website Dinas Baru', 'selamat-datang-di-website-dinas-baru', '<p>Kami sangat senang dapat mengumumkan peluncuran website resmi dinas kami yang baru. Website ini hadir dengan desain yang lebih modern dan fitur-fitur yang lebih baik untuk melayani Anda.</p><p>Beberapa fitur unggulan yang dapat Anda nikmati:</p><ul><li>Sistem informasi yang terintegrasi</li><li>Layanan online yang lebih mudah</li><li>Informasi terkini dan akurat</li><li>Komunikasi yang lebih transparan</li></ul><p>Kami berkomitmen untuk terus meningkatkan layanan kami demi kepentingan masyarakat.</p>', 'Kami senang menyambut Anda di website resmi dinas kami yang baru dengan fitur-fitur canggih.', NULL, 'published', 1, 1, 1, '2025-12-02 20:11:21', '2025-12-02 20:11:21', '2025-12-02 20:11:21', NULL),
	(2, 'Program Vaksinasi Gratis 2025', 'program-vaksinasi-gratis-2025', '<p>Dalam rangka meningkatkan kesehatan masyarakat, dinas akan menyelenggarakan program vaksinasi gratis tahun 2025. Program ini terbuka bagi seluruh warga tanpa terkecuali.</p><p>Detail program:</p><ul><li>Jadwal vaksinasi: Setiap Senin dan Rabu, pukul 08:00 - 15:00</li><li>Lokasi: Puskesmas Utama dan Fasilitas Kesehatan Kelurahan</li><li>Jenis vaksin: Influenza, Hepatitis B, dan Campak</li><li>Syarat: Membawa KTP atau kartu keluarga</li></ul><p>Untuk informasi lebih lanjut, silakan hubungi hotline dinas di nomor berikut.</p>', 'Dinas menyelenggarakan program vaksinasi gratis bagi seluruh masyarakat.', NULL, 'published', 1, 2, 1, '2025-12-01 20:11:21', '2025-12-02 20:11:21', '2025-12-03 22:24:46', '2025-12-03 22:24:46'),
	(3, 'Cara Mengurus Surat Keterangan Online', 'cara-mengurus-surat-keterangan-online', '<p>Mengurus surat keterangan sekarang menjadi lebih mudah dengan sistem online kami. Ikuti langkah-langkah berikut:</p><ol><li>Daftar akun di website resmi dinas</li><li>Login dengan menggunakan email dan password</li><li>Pilih jenis surat keterangan yang dibutuhkan</li><li>Isi formulir online dengan data yang benar</li><li>Unggah dokumen pendukung (KTP, KK, dll)</li><li>Submit permohonan dan tunggu proses verifikasi</li><li>Surat keterangan akan selesai dalam 3-5 hari kerja</li></ol><p>Persyaratan dokumen:</p><ul><li> Fotokopi KTP</li><li> Fotokopi Kartu Keluarga</li><li> Pas foto terbaru (3x4, latar merah)</li><li> Dokumen pendukung sesuai jenis surat</li></ul>', 'Panduan lengkap mengurus surat keterangan secara online melalui website resmi.', 'articles/featured/V96HnHMD9LFDVrcemucZLmzToXL5AhWFIgKJIclO.png', 'published', 0, 3, 1, '2025-11-30 20:11:00', '2025-12-02 20:11:21', '2025-12-23 21:14:04', NULL),
	(4, 'Test Bikin Artikel', 'tes-bikin-artikel', '<p>asdasdasda</p>', 'sdasdasda', 'articles/featured/bs7CNkTmfMJRVjIvFvP6FSp9HWDxGJYVTletXCfz.png', 'published', 0, 4, 1, '2025-12-03 07:02:00', '2025-12-03 07:03:37', '2025-12-04 21:24:23', NULL);

-- Dumping structure for table dinasstarter2_db.article_categories
DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text,
  `parent_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_categories_slug_unique` (`slug`),
  KEY `article_categories_is_active_sort_order_index` (`is_active`,`sort_order`),
  KEY `article_categories_parent_id_index` (`parent_id`),
  CONSTRAINT `article_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `article_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.article_categories: ~4 rows (approximately)
DELETE FROM `article_categories`;
INSERT INTO `article_categories` (`id`, `name`, `slug`, `description`, `parent_id`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'Pengumuman', 'pengumuman', 'Pengumuman dan informasi penting dari dinas', NULL, 1, 1, '2025-12-02 20:11:20', '2025-12-02 20:11:20'),
	(2, 'Berita Terkini', 'berita-terkini', 'Berita dan update terbaru dari dinas', NULL, 1, 2, '2025-12-02 20:11:20', '2025-12-02 20:11:20'),
	(3, 'Layanan', 'layanan', 'Informasi tentang layanan yang disediakan oleh dinas', NULL, 1, 3, '2025-12-02 20:11:20', '2025-12-02 20:11:20'),
	(4, 'Info Penting', 'info-penting', NULL, NULL, 1, 4, '2025-12-03 07:02:35', '2025-12-03 07:02:35');

-- Dumping structure for table dinasstarter2_db.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table dinasstarter2_db.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table dinasstarter2_db.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table dinasstarter2_db.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table dinasstarter2_db.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table dinasstarter2_db.market_prices
DROP TABLE IF EXISTS `market_prices`;
CREATE TABLE IF NOT EXISTS `market_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commodity_name` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `trend_status` varchar(255) NOT NULL DEFAULT 'stabil',
  `trend_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.market_prices: ~4 rows (approximately)
DELETE FROM `market_prices`;
INSERT INTO `market_prices` (`id`, `commodity_name`, `price`, `unit`, `trend_status`, `trend_percentage`, `created_at`, `updated_at`) VALUES
	(1, 'Beras Premium', 20000.00, 'Kg', 'naik', 33.33, '2025-12-22 21:23:49', '2025-12-22 21:52:20'),
	(2, 'Daging Sapi', 124000.00, 'Kg', 'naik', 12.73, '2025-12-22 21:23:49', '2025-12-22 22:03:46'),
	(3, 'Cabai Merah', 45000.00, 'Kg', 'naik', 5.00, '2025-12-22 21:23:49', '2025-12-22 21:23:49'),
	(4, 'Minyak Goreng', 14000.00, 'Liter', 'stabil', 0.00, '2025-12-22 21:23:49', '2025-12-22 21:23:49');

-- Dumping structure for table dinasstarter2_db.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.migrations: ~9 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_12_01_021038_create_permission_tables', 1),
	(5, '2025_12_03_010508_create_profil_dinas_table', 2),
	(6, '2025_12_03_035504_create_article_categories_table', 3),
	(7, '2025_12_03_035504_create_articles_table', 3),
	(8, '2025_12_23_051830_create_market_prices_table', 4),
	(9, '2025_12_24_063520_add_kepala_dinas_fields_to_profil_dinas_table', 5);

-- Dumping structure for table dinasstarter2_db.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(125) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;

-- Dumping structure for table dinasstarter2_db.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(125) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.model_has_roles: ~3 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3);

-- Dumping structure for table dinasstarter2_db.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table dinasstarter2_db.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.permissions: ~25 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'users.create', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(2, 'users.read', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(3, 'users.update', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(4, 'users.delete', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(5, 'roles.create', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(6, 'roles.read', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(7, 'roles.update', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(8, 'roles.delete', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(9, 'permissions.create', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(10, 'permissions.read', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(11, 'permissions.update', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(12, 'permissions.delete', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(13, 'articles.create', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(14, 'articles.read', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(15, 'articles.update', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(16, 'articles.delete', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(17, 'content.create', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(18, 'content.read', 'web', '2025-12-02 13:24:41', '2025-12-02 13:24:41'),
	(19, 'content.update', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(20, 'content.delete', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(21, 'system.manage', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(22, 'system.settings', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(23, 'system.backup', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(24, 'profil-dinas.read', 'web', '2025-12-02 17:06:21', '2025-12-02 17:06:21'),
	(25, 'profil-dinas.update', 'web', '2025-12-02 17:06:21', '2025-12-02 17:06:21');

-- Dumping structure for table dinasstarter2_db.profil_dinas
DROP TABLE IF EXISTS `profil_dinas`;
CREATE TABLE IF NOT EXISTS `profil_dinas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_dinas` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `alamat_kantor` text,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `social_media_links` longtext DEFAULT NULL,
  `logo_tanpa_text` varchar(255) DEFAULT NULL,
  `logo_dengan_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kepala_dinas_nama` varchar(255) DEFAULT NULL,
  `kepala_dinas_foto` varchar(255) DEFAULT NULL,
  `kepala_dinas_sambutan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.profil_dinas: ~1 rows (approximately)
DELETE FROM `profil_dinas`;
INSERT INTO `profil_dinas` (`id`, `nama_dinas`, `sub_title`, `alamat_kantor`, `nomor_telepon`, `email`, `social_media_links`, `logo_tanpa_text`, `logo_dengan_text`, `created_at`, `updated_at`, `kepala_dinas_nama`, `kepala_dinas_foto`, `kepala_dinas_sambutan`) VALUES
	(1, 'DISKUMINDAG', 'Dinas Koperasi, Usaha Mikro, Perindustrian, dan Perdagangan Kabupaten Landak', 'Jl. H. M. Amin Pagatan Kec. Kusan Hilir Kab. Landak', '+6282157860777', 'bangshogir@gmail.com', '{"twitter": "https://www.facebook.com/?locale=id_ID", "youtube": "https://www.facebook.com/?locale=id_ID", "facebook": "https://www.facebook.com/?locale=id_ID", "instagram": "https://www.facebook.com/?locale=id_ID"}', 'logos/JtVE2xT26X619GtSL7FaYcxvoah30bLXTGVrFcxR.png', 'logos/4BHtkJQB8caqlqd7Wfr2PPvUNxMH9oNk4EOdsmFM.png', '2025-12-02 19:02:35', '2025-12-24 15:52:21', NULL, 'kepala_dinas/XJDpdhbehMcIdeajlU90yH0sdn8aDXaPuXmdRwyD.jpg', NULL);

-- Dumping structure for table dinasstarter2_db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.roles: ~3 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(2, 'Admin', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(3, 'Author', 'web', '2025-12-02 13:24:42', '2025-12-02 13:24:42');

-- Dumping structure for table dinasstarter2_db.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.role_has_permissions: ~43 rows (approximately)
DELETE FROM `role_has_permissions`;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(2, 2),
	(3, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(24, 2),
	(25, 2),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3);

-- Dumping structure for table dinasstarter2_db.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('coyPhoWlwRhbAZflrPrjBosUvAzhahb7bC8pKfjk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUt5UVZrYVl0MkRNM1hOcUlmaFhYaGUzRzVDNnJ1QUtEV1o3NHl0aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766632288);

-- Dumping structure for table dinasstarter2_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dinasstarter2_db.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'superadmin@example.com', '2025-12-02 13:24:42', '$2y$12$6JUvV.SkYdIo23MLtT0Cp.X0CLAYMgrUK/s.6OX7ON4nQTywcyTc.', NULL, '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(2, 'Admin User', 'admin@example.com', '2025-12-02 13:24:42', '$2y$12$BDZcJ4m.Yr1cx6uzNRwAgOyFdFmeAp0jYxB1pw0Lumt5KXDWJ2e4i', NULL, '2025-12-02 13:24:42', '2025-12-02 13:24:42'),
	(3, 'Author User', 'author@example.com', '2025-12-02 13:24:43', '$2y$12$X2LXTnXuChWNZxD2f.aS9.DF//SIXH19SeDXY7PLeFl6gf4pPILAC', NULL, '2025-12-02 13:24:43', '2025-12-02 13:24:43');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

SET FOREIGN_KEY_CHECKS=1;
