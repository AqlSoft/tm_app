-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2025 at 04:41 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashier_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `roles_name` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `userName`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `last_login_ip`, `last_login_at`, `roles_name`) VALUES
(1, 'Yosra  Ziad', 'yosra0029@gmail.com', NULL, '$2y$12$9.2mcFjTpjxTs.c27bSkh.XX9KwThZYJU/5ALcobIfh6LrCFPMQ4K', NULL, 1, NULL, NULL, '2025-02-05 08:37:40', '2025-02-05 08:37:42', NULL, NULL, NULL),
(2, 'AtefAql', 'atefaql@gmail.com', NULL, '$2y$12$CAHgRv8PFfcw54R2dLLb7OUXTRLx62WLkc/9sa929Cyl9g71WM7rW', NULL, 1, NULL, NULL, '2025-02-05 08:40:22', '2025-02-05 08:40:22', NULL, NULL, NULL),
(3, 'AtefAql1', 'atefaql00@gmail.com', NULL, '$2y$12$95Z/r54xHMvLSmSEnhOUWerysmJrDlVDgfspFCZKGH34BE8K/O60G', NULL, 1, NULL, NULL, '2025-02-05 08:52:06', '2025-02-05 08:52:06', NULL, NULL, NULL),
(4, 'AtefAql102', 'atefaql00882@gmail.com', NULL, '$2y$12$MpQAYxEa8D.2Pwyxc2MY9uOqHcugjURiEMZHrR7qzbKTbVLEjrYRu', NULL, 1, NULL, NULL, '2025-02-05 12:33:46', '2025-02-05 12:33:47', NULL, NULL, NULL),
(5, 'ali atef', 'atefaql777@gmail.com', NULL, '$2y$12$Jh7YIsGAVsJfe8wIMYpvd.zyl.eresCKLxfEYneRDmtbuqWBLYWle', NULL, 1, NULL, NULL, '2025-02-05 12:48:52', '2025-02-05 12:48:52', NULL, NULL, NULL),
(6, 'ali atef9', 'atefaql7787@gmail.com', NULL, '$2y$12$JCyvigYwWbguLBK87UDOIOZ2sAVSwe9qZL.DqBybSXFU/ZP5Ukyvi', NULL, 1, NULL, NULL, '2025-02-05 12:50:05', '2025-02-05 12:50:05', NULL, NULL, NULL),
(7, 'yoyo', 'yoyoatef@gmail.com', NULL, '$2y$12$ut5D.T.lM99aX1sXeGcS5eSlaGDCfFvjzUcTsrqEJL6pFuAmU0Eri', NULL, 1, NULL, NULL, '2025-02-05 12:51:13', '2025-02-05 12:51:13', NULL, NULL, NULL),
(8, 'yoyo11', 'yoyoatef1@gmail.com', NULL, '$2y$12$u95ua9VMbhujVMfY10EFGu33frP/I6XRHlEHztcn1.B7Exp2qIGDa', NULL, 1, NULL, NULL, '2025-02-05 12:53:21', '2025-02-05 12:53:21', NULL, NULL, NULL),
(9, 'Yousra_20', 'atefakl80@gmail.com', NULL, '$2y$12$/qznLKZNt2iym9QWkwgNBOJjKgdMcIxfxYGIDwUa6MBU4BzAZmmL.', NULL, 1, NULL, NULL, '2025-02-06 11:03:54', '2025-02-06 11:03:54', NULL, NULL, NULL),
(10, 'Yousra_2099', 'atefakl80999@gmail.com', NULL, '$2y$12$cnp09R7JYY/HKV63NRLGoO6DqDZsVMEA0nIImbT7UkXq5UXxxD2M6', NULL, 1, NULL, NULL, '2025-02-06 11:12:58', '2025-02-06 11:12:58', NULL, NULL, NULL),
(11, 'Yousra_2', 'yousra@ziad.com', NULL, '$2y$12$HrI8F2rmiQsAYCtZjI/f8OfR4CY3pazMQY5W45k6tXd3jOaFGlz96', 'SJBewP1GKXkLP3OF2QRclmMEIOKlkpTEiqSjNipQchm7bC92CRChL3gt3gUk', 1, NULL, 9, '2024-10-19 13:59:40', '2025-02-07 17:35:58', '::1', '2025-01-22 08:51:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `city`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Anonymous Customer', 'abc@d.com', NULL, NULL, NULL, NULL, '2025-03-02 19:06:52', '2025-03-02 19:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_categories`
--

DROP TABLE IF EXISTS `items_categories`;
CREATE TABLE IF NOT EXISTS `items_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_brief` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_categories`
--

INSERT INTO `items_categories` (`id`, `cat_name`, `cat_brief`, `status`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Main Dishes', 'Main Dishes', 1, 1, '2024-12-03 18:57:34', '2024-12-03 18:57:34', NULL),
(46, 'Beverages', 'Beverages', 1, 1, '2024-12-03 18:57:34', '2024-12-03 18:57:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE IF NOT EXISTS `meals` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `unit_id` bigint DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `cost_price`, `sell_price`, `description`, `status`, `unit_id`, `image`, `barcode`, `category_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fried Checken QRT with Rice', 10.00, 15.00, 'Fried Checken QRT with Rice', 'active', 3, NULL, 'MEAL250301246580', 10, 11, 11, '2025-03-01 19:55:17', '2025-03-01 22:23:08', NULL),
(2, 'Fried Checken HLF with Rice', 18.00, 27.00, 'Fried Checken HALF with Rice', 'active', 3, NULL, 'MEAL250301246581', 10, 11, 11, '2025-03-01 21:36:53', '2025-03-01 22:24:20', NULL),
(3, 'Fried Checken CMP with Rice', 34.00, 51.00, 'Fried Checken Complete with Rice', 'active', 3, NULL, 'MEAL250301246582', 10, 11, 11, '2025-03-01 21:38:31', '2025-03-01 22:24:30', NULL),
(4, 'Charcoal Checken QRT with Rice', 11.00, 16.50, 'Charcoal Checken QRT with Rice', 'active', 3, NULL, 'MEAL250302183044', 10, 11, 11, '2025-03-01 22:30:15', '2025-03-01 22:30:15', NULL),
(5, 'Charcoal Checken HLF with Rice', 19.00, 28.50, 'Charcoal Checken Half with Rice', 'active', 3, NULL, 'MEAL250302173276', 10, 11, 11, '2025-03-01 22:31:08', '2025-03-01 22:31:08', NULL),
(6, 'Charcoal Checken CMP with Rice', 35.00, 52.50, 'Charcoal Checken Complete with Rice', 'active', 3, NULL, 'MEAL250302308033', 10, 11, 11, '2025-03-01 22:31:53', '2025-03-01 22:31:53', NULL),
(7, 'Grilled Checken QRT with Rice', 9.00, 13.50, 'Grilled Checken QRT with Rice', 'active', 3, NULL, 'MEAL250302511174', 10, 11, 11, '2025-03-02 13:00:57', '2025-03-02 13:00:57', NULL),
(8, 'Grilled Checken HLF with Rice', 17.00, 28.50, 'Grilled Checken Half with Rice', 'active', 3, NULL, 'MEAL250302518825', 10, 11, 11, '2025-03-02 13:01:18', '2025-03-02 13:01:18', NULL),
(9, 'Grilled Checken CMP with Rice', 33.00, 48.00, 'Grilled Checken Complete with Rice', 'active', 3, NULL, 'MEAL250302597011', 10, 11, 11, '2025-03-02 13:02:00', '2025-03-02 13:02:00', NULL),
(10, 'Pepsi Can 330 ml free sugar', 2.50, 3.75, 'Pepsi Cans free sugar', 'active', 3, NULL, 'MEAL250302419431', 26, 11, 11, '2025-03-02 13:09:07', '2025-03-02 13:09:07', NULL),
(11, 'Pepsi Can 240 ml free sugar', 1.75, 2.50, 'Pepsi Cans free sugar', 'active', 3, NULL, 'MEAL250302591752', 26, 11, 11, '2025-03-02 13:12:16', '2025-03-02 13:12:16', NULL),
(12, 'Pepsi BOT 200 ml free sugar', 1.50, 2.25, 'Pepsi Cans and bottles free sugar', 'active', 3, NULL, 'MEAL250302719284', 26, 11, 11, '2025-03-02 13:13:04', '2025-03-02 13:18:33', NULL),
(13, 'Cola BOT 200 ml free sugar', 1.50, 2.25, 'Coca cola Cans and bottles free sugar', 'active', 3, NULL, 'MEAL250302148790', 26, 11, 11, '2025-03-02 13:18:02', '2025-03-02 13:18:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meal_categories`
--

DROP TABLE IF EXISTS `meal_categories`;
CREATE TABLE IF NOT EXISTS `meal_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_categories`
--

INSERT INTO `meal_categories` (`id`, `name`, `description`, `parent_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Root Category', 'root cat', NULL, 0, 0, '2025-03-01 21:11:05', '2025-03-01 21:11:05'),
(2, 'Meals', 'No description available', 1, 11, 11, '2025-03-01 18:44:57', '2025-03-01 18:44:57'),
(3, 'Sandwiches', 'No description available', 1, 11, 11, '2025-03-01 18:47:41', '2025-03-01 18:47:41'),
(4, 'Pastries', 'No description available', 1, 11, 11, '2025-03-01 18:48:24', '2025-03-01 18:48:24'),
(5, 'Garnishes', 'No description available', 1, 11, 11, '2025-03-01 18:48:34', '2025-03-01 18:48:34'),
(6, 'Canned', 'No description available', 1, 11, 11, '2025-03-01 18:49:00', '2025-03-01 18:49:00'),
(7, 'Juices', 'No description available', 1, 11, 11, '2025-03-01 18:49:09', '2025-03-01 18:49:09'),
(8, 'Desserts', 'No description available', 1, 11, 11, '2025-03-01 18:55:30', '2025-03-01 18:55:30'),
(9, 'Fast Meals', 'No description available', 2, 11, 11, '2025-03-01 18:55:56', '2025-03-01 18:55:56'),
(10, 'Basic Meals', 'No description available', 2, 11, 11, '2025-03-01 18:58:23', '2025-03-01 18:58:23'),
(11, 'Local Dishes', 'Local Dishes from folklor', 2, 11, 11, '2025-03-01 18:59:12', '2025-03-01 18:59:12'),
(12, 'Beef Sandwiches', 'Beef Sandwiches and al animals meat Sandwiches', 3, 11, 11, '2025-03-01 19:01:09', '2025-03-01 19:01:09'),
(13, 'Checken Sandwiches', 'Checken Sandwiches', 3, 11, 11, '2025-03-01 19:01:45', '2025-03-01 19:01:45'),
(14, 'Vegetarian', 'Vegetarian Sandwiches', 3, 11, 11, '2025-03-01 19:02:40', '2025-03-01 19:02:40'),
(15, 'Toasts', 'Toasts', 4, 11, 11, '2025-03-01 19:03:42', '2025-03-01 19:03:42'),
(16, 'Pizzas', 'Pizzas', 4, 11, 11, '2025-03-01 19:04:10', '2025-03-01 19:04:10'),
(17, 'Sweet pastries', 'Sweet pastries', 4, 11, 11, '2025-03-01 19:05:16', '2025-03-01 19:05:16'),
(18, 'Salty pastries', 'Salty pastries', 4, 11, 11, '2025-03-01 19:05:35', '2025-03-01 19:05:35'),
(19, 'Salades', 'Salades', 5, 11, 11, '2025-03-01 19:09:19', '2025-03-01 19:09:19'),
(20, 'pickle', 'Nice pickle chips, by the way.', 5, 11, 11, '2025-03-01 19:13:08', '2025-03-01 19:13:08'),
(21, 'Canned Beefs', 'Canned Beefs', 6, 11, 11, '2025-03-01 19:16:46', '2025-03-01 19:16:46'),
(22, 'Canned vegitables', 'Canned vegitables', 6, 11, 11, '2025-03-01 19:17:13', '2025-03-01 19:17:13'),
(23, 'Canned Fruites', 'Canned Fruites', 6, 11, 11, '2025-03-01 19:18:37', '2025-03-01 19:18:37'),
(24, 'Fresh Juice', 'Fresh Juice', 7, 11, 11, '2025-03-01 19:19:32', '2025-03-01 19:19:32'),
(25, 'Canned Juice', 'Canned Juice', 7, 11, 11, '2025-03-01 19:19:50', '2025-03-01 19:19:50'),
(26, 'Soft Drinks', 'Soft Drinks', 7, 11, 11, '2025-03-01 19:21:30', '2025-03-01 19:21:30'),
(27, 'Cold Drinks', 'Cold Drinks', 7, 11, 11, '2025-03-01 19:21:45', '2025-03-01 19:21:45'),
(28, 'Eastern', 'No description available', 8, 11, 11, '2025-03-01 19:23:58', '2025-03-01 19:23:58'),
(29, 'Western', 'No description available', 8, 11, 11, '2025-03-01 19:24:10', '2025-03-01 19:24:10'),
(30, 'Fruit Salad', 'No description available', 8, 11, 11, '2025-03-01 19:24:35', '2025-03-01 19:24:35'),
(31, 'Icecreams', 'No description available', 8, 11, 11, '2025-03-01 19:24:52', '2025-03-01 19:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_05_133410_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `old_orders`
--

DROP TABLE IF EXISTS `old_orders`;
CREATE TABLE IF NOT EXISTS `old_orders` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `due_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `wait_number` int DEFAULT NULL,
  `status` enum('creating','inprogress','delvered','returned','refused') COLLATE utf8mb4_unicode_ci DEFAULT 'inprogress',
  `category` enum('indoor','outdoor','delivery','service') COLLATE utf8mb4_unicode_ci DEFAULT 'outdoor',
  `created_by` bigint NOT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_orders`
--

INSERT INTO `old_orders` (`id`, `serial_number`, `customer_id`, `order_date`, `due_date`, `wait_number`, `status`, `category`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ODR250302011-491259', 1, '2025-03-02 23:49:29', '2025-03-02 20:49:20', NULL, 'inprogress', 'outdoor', 11, 11, '2025-03-02 17:49:29', '2025-03-02 17:49:29'),
(2, 'ODR250302011-169160', 1, '2025-03-02 23:51:01', '2025-03-02 20:50:50', NULL, 'inprogress', 'outdoor', 11, 11, '2025-03-02 17:51:01', '2025-03-02 17:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `old_order_items`
--

DROP TABLE IF EXISTS `old_order_items`;
CREATE TABLE IF NOT EXISTS `old_order_items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `quantity` bigint NOT NULL,
  `unit_id` bigint NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `serial_number` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `customer_id` bigint NOT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` smallint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parties_created_by` (`created_by`),
  KEY `fk_parties_updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `serial_number`, `order_date`, `customer_id`, `notes`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`) VALUES
(1, '777777777', '2025-02-25 17:27:29', 1, NULL, '2025-02-25 11:27:29', '2025-02-28 03:55:31', 1, 1, NULL),
(4, '1234567', '2025-03-03 00:00:00', 1, NULL, '2025-03-03 01:52:15', '2025-03-03 05:40:04', 2, 10, 10),
(5, '9996655', '2025-03-03 00:00:00', 1, NULL, '2025-03-03 01:58:24', '2025-03-03 01:58:24', 2, 10, NULL),
(6, NULL, '2025-03-03 00:00:00', 1, NULL, '2025-03-03 13:06:00', '2025-03-03 13:06:00', 1, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `quantity` bigint NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `category_id`, `product_id`, `order_id`, `quantity`, `unit_id`, `price`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 1, 2, 1, 100.00, 'kjjdhdd', NULL, '2025-03-01 14:58:46', NULL, NULL),
(4, 46, 4, 1, 1, 1, 700.00, ',,,\',\',.\'', '2025-03-03 13:21:10', '2025-03-03 13:21:10', 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

DROP TABLE IF EXISTS `parties`;
CREATE TABLE IF NOT EXISTS `parties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('customer','supplier') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parties_email_unique` (`email`(191)),
  KEY `fk_parties_created_by` (`created_by`),
  KEY `fk_parties_updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `phone`, `email`, `address`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'yosra', '777777777', 'yosra@gmail.com', 'yemen', 'customer', NULL, NULL, NULL, NULL),
(3, 'Atef Aql', '0547660005', NULL, 'Egypt', 'customer', '2025-03-03 03:47:13', '2025-03-03 03:47:13', 10, NULL),
(4, 'Ali  Aql', '0547660005999', NULL, 'Egypt', 'customer', '2025-03-03 05:55:10', '2025-03-03 05:55:10', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `payment_method` smallint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` smallint NOT NULL DEFAULT '1',
  `from_account` bigint NOT NULL,
  `to_account` bigint NOT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `quantity` int NOT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `unit_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT '1',
  `updated_by` bigint UNSIGNED DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cost_price`, `sale_price`, `quantity`, `status`, `category_id`, `unit_id`, `created_at`, `description`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Meat Dishes', 300.00, 400.00, 4, 1, 1, 1, '2025-02-23 09:31:07', NULL, 1, 1, '2025-02-23 09:31:07'),
(3, 'Fish Dishes', 300.00, 500.00, 4, 1, 1, 1, '2025-02-23 09:31:10', NULL, 1, 1, '2025-02-23 09:31:10'),
(4, 'Hot Beverages', 300.00, 700.00, 4, 1, 46, 1, '2025-02-23 09:31:20', NULL, 1, 1, '2025-02-23 09:31:20'),
(5, 'Cold Beverages', 300.00, 350.00, 4, 1, 46, 1, '2025-02-23 09:31:20', NULL, 1, 1, '2025-02-23 09:31:20'),
(6, 'Energy Drinks', 400.00, 355.00, 4, 0, 46, 1, '2025-02-23 09:54:47', NULL, 1, 10, '2025-02-23 13:29:53'),
(8, 'Pasta', 300.00, 450.00, 4, 1, 1, 1, '2025-02-23 09:54:49', NULL, 1, 1, '2025-02-23 09:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices`
--

DROP TABLE IF EXISTS `purchase_invoices`;
CREATE TABLE IF NOT EXISTS `purchase_invoices` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices`
--

DROP TABLE IF EXISTS `sales_invoices`;
CREATE TABLE IF NOT EXISTS `sales_invoices` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `client_id` bigint DEFAULT NULL,
  `vat_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `invoice_total` decimal(10,2) DEFAULT NULL,
  `vat_amount` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `payment_day` date DEFAULT NULL,
  `order_id` bigint NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` smallint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice_items`
--

DROP TABLE IF EXISTS `sales_invoice_items`;
CREATE TABLE IF NOT EXISTS `sales_invoice_items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `invoice_id` bigint NOT NULL,
  `quantity` bigint NOT NULL,
  `unit_id` bigint NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('as7k38rRBaWPvzRr2ZHqnnLY0tdkaXVov9VzKYbd', 11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidmUxMlVvWVFYRDJVSGpUQUZYYmlSZUdjRllkcmtvWjNrRzlubkV6VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly93d3cuY2FzaGllci5sb2NhbC9hZG1pbi9jbGllbnRzL2luZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTt9', 1741019009);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `abbr`, `unit_type`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'gram', 'g', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(2, 'kilogram', 'kg', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(3, 'piece', 'pc', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(4, 'portion', 'portion', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(5, 'milliliter', 'mL', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(6, 'liter', 'L', NULL, NULL, '2025-03-01 22:22:52', '2025-03-01 22:22:52', NULL),
(7, 'gram', 'g', 'weight', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL),
(8, 'kilogram', 'kg', 'weight', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL),
(9, 'piece', 'pc', 'count', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL),
(10, 'portion', 'portion', 'count', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL),
(11, 'milliliter', 'mL', 'volume', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL),
(12, 'liter', 'L', 'volume', NULL, '2025-03-01 22:23:28', '2025-03-01 22:23:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-02-07 17:17:22', '$2y$12$tm5hJvKI9q0t2lXVJgLk7OcFQ3pwvlgXNakKk5UIC9dGYQfbWXUH2', 'iun68XnzAy', '2025-02-07 17:17:22', '2025-02-07 17:17:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
