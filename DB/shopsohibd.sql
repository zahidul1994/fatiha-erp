-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2023 at 03:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopsohibd`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `admin_id`, `employee_id`, `brand_name`, `slug`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Pran', 'pran', 2, 2, 1, '2023-10-28 13:16:11', '2023-10-28 13:16:11'),
(2, 2, NULL, 'Bombe', 'bombe', 2, 2, 1, '2023-10-28 13:16:36', '2023-10-28 13:16:36'),
(3, 2, NULL, 'Cocola', 'cocola', 2, 2, 1, '2023-10-28 13:18:27', '2023-10-28 13:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `superadmin_id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SOAP', 'soap', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(2, 1, 'SHAMPOO', 'shampoo', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(3, 1, 'CHOCOLATE', 'chocolate', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(4, 1, 'CONDITIONER', 'conditioner', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(5, 1, 'RICE', 'rice', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(6, 1, 'FOOD SUPPLIMENT', 'food-suppliment', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(7, 1, 'CAKE', 'cake', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(8, 1, 'BISCUITS', 'biscuits', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(9, 1, 'PEANUTS', 'peanuts', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(10, 1, 'TOOTHPASTE', 'toothpaste', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(11, 1, 'TOOTHBRUSH', 'toothbrush', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(12, 1, 'FACEWASH MEN', 'facewash-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(13, 1, 'FACEWASH WOMEN', 'facewash-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(14, 1, 'BODY SPRAY MEN', 'body-spray-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(15, 1, 'BODY SPRAY WOMEN', 'body-spray-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(16, 1, 'LOTION', 'lotion', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(17, 1, 'CREAM MEN', 'cream-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(18, 1, 'CREAM WOMEN', 'cream-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(19, 1, 'AIR FRESHENER', 'air-freshener', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(20, 1, 'HAIR OIL MEN', 'hair-oil-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(21, 1, 'HAIR OIL WOMEN', 'hair-oil-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(22, 1, 'TOILET CLEANER', 'toilet-cleaner', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(23, 1, 'PERFUME MEN', 'perfume-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(24, 1, 'PERFUME WOMEN', 'perfume-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(25, 1, 'DISH WASH', 'dish-wash', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(26, 1, 'FABRIC WASH', 'fabric-wash', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(27, 1, 'FLOOR CLEANER', 'floor-cleaner', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(28, 1, 'GLASS CLEANER', 'glass-cleaner', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(29, 1, 'HAND WASH', 'hand-wash', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(30, 1, 'BABY ITEMS', 'baby-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(31, 1, 'HAIR SERUM', 'hair-serum', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(32, 1, 'SKIN SERUM', 'skin-serum', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(33, 1, 'HAIR GEL WOMEN', 'hair-gel-women', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(34, 1, 'HAIR GEL MEN', 'hair-gel-men', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(35, 1, 'HAIR COLOR', 'hair-color', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(36, 1, 'SHOWER GEL', 'shower-gel', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(37, 1, 'SANITARY PAD', 'sanitary-pad', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(38, 1, 'ADULT DIAPER', 'adult-diaper', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(39, 1, 'HAIR REMOVER', 'hair-remover', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(40, 1, 'SHAVING ITEM', 'shaving-item', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(41, 1, 'OLIVE OIL', 'olive-oil', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(42, 1, 'MAKE UP ITEMS', 'make-up-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(43, 1, 'TALCOM POWDER', 'talcom-powder', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(44, 1, 'FACE POWDER', 'face-powder', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(45, 1, 'TEA ITEMS', 'tea-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(46, 1, 'DEODORANT', 'deodorant', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(47, 1, 'FOOT CARE', 'foot-care', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(48, 1, 'LIP ITEMS', 'lip-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(49, 1, 'FACIAL ITEMS', 'facial-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(50, 1, 'MEHEDY', 'mehedy', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(51, 1, 'HONEY', 'honey', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(52, 1, 'HERBAL PRODUCTS', 'herbal-products', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(53, 1, 'SOYABIN OIL', 'soyabin-oil', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(54, 1, 'PALM OIL', 'palm-oil', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(55, 1, 'SUNFLOWER OIL', 'sunflower-oil', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(56, 1, 'SUGAR', 'sugar', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(57, 1, 'ATTA', 'atta', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(58, 1, 'FLOUR', 'flour', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(59, 1, 'SUJI', 'suji', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(60, 1, 'SPICES', 'spices', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(61, 1, 'SALT', 'salt', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(62, 1, 'SAUCE', 'sauce', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(63, 1, 'GLYCERIN', 'glycerin', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(64, 1, 'TOOTH POWDER', 'tooth-powder', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(65, 1, 'MOUTHWASH', 'mouthwash', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(66, 1, 'AEROSOL', 'aerosol', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(67, 1, 'COEL', 'coel', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(68, 1, 'MOIDA', 'moida', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(69, 1, 'COLONGE SPRAY', 'colonge-spray', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(70, 1, 'EU DE PERFUME', 'eu-de-perfume', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(71, 1, 'BODY SPRAY', 'body-spray', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(72, 1, 'MINERAL WATER', 'mineral-water', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(73, 1, 'BEVERAGE', 'beverage', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(74, 1, 'MUSTARD OIL', 'mustard-oil', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(75, 1, 'CAKE SPICES', 'cake-spices', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(76, 1, 'MOTHER CARE', 'mother-care', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(77, 1, 'DRY FOOD', 'dry-food', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(78, 1, 'SOUP', 'soup', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(79, 1, 'NOODLES', 'noodles', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(80, 1, 'COFFEE ITEMS', 'coffee-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(81, 1, 'KOKO CRUNCH', 'koko-crunch', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(82, 1, 'CHANACHUR', 'chanachur', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(83, 1, 'PICKLE', 'pickle', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(84, 1, 'DRY FRUITS', 'dry-fruits', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(85, 1, 'CHIPS', 'chips', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(86, 1, 'SEMAI', 'semai', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(87, 1, 'JUICE', 'juice', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(88, 1, 'MILK ITEMS', 'milk-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(89, 1, 'DAAL', 'daal', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(90, 1, 'TISSUE', 'tissue', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(91, 1, 'OINTMENT', 'ointment', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(92, 1, 'BODY WASH', 'body-wash', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(93, 1, 'KITCHEN ITEMS', 'kitchen-items', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(94, 1, 'STUDY', 'study', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(95, 1, 'TOY', 'toy', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(96, 1, 'BABY CARE', 'baby-care', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(97, 1, 'BAGS', 'bags', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(98, 1, 'GHEE', 'ghee', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(99, 1, 'SUNGLASS', 'sunglass', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(100, 1, 'EWER', 'ewer', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(101, 1, 'WRIST WATCH', 'wrist-watch', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(102, 1, 'JELLY', 'jelly', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(103, 1, 'LIQUID VAPOURER', 'liquid-vapourer', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(104, 1, 'MUM', 'mum', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(105, 1, 'OIL', 'oil', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(106, 1, 'FACE MASK', 'face-mask', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(107, 1, 'BODY POWDER', 'body-powder', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(108, 1, 'ANTISEPTIC', 'antiseptic', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(109, 1, 'UMBRELLA', 'umbrella', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(110, 1, 'JEWELRY BOX', 'jewelry-box', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(111, 1, 'SPICE', 'spice', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(112, 1, 'HOME APPLIANCE', 'home-appliance', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(113, 1, 'GROOMING KIT', 'grooming-kit', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipaddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci,
  `reply` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_user_id` bigint UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `superadmin_id`, `country_name`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'BANGLADESH', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(2, 1, 'AFGHANISTAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(3, 1, 'ALBANIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(4, 1, 'ALGERIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(5, 1, 'ANDORRA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(6, 1, 'ANGOLA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(7, 1, 'ANGUILLA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(8, 1, 'ANTARCTICA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(9, 1, 'ARGENTINA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(10, 1, 'ARMENIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(11, 1, 'ARUBA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(12, 1, 'AUSTRALIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(13, 1, 'AUSTRIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(14, 1, 'AZERBAIJAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(15, 1, 'BAHAMAS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(16, 1, 'BAHRAIN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(17, 1, 'BARBADOS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(18, 1, 'BELARUS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(19, 1, 'BELGIUM', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(20, 1, 'BELIZE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(21, 1, 'BENIN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(22, 1, 'BERMUDA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(23, 1, 'BHUTAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(24, 1, 'BOLIVIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(25, 1, 'BOTSWANA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(26, 1, 'BOUVET ISLAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(27, 1, 'BRAZIL', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(28, 1, 'BULGARIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(29, 1, 'BURKINA FASO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(30, 1, 'BURUNDI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(31, 1, 'CAMBODIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(32, 1, 'CAMEROON', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(33, 1, 'CANADA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(34, 1, 'CHAD', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(35, 1, 'CHILE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(36, 1, 'CHINA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(37, 1, 'COLOMBIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(38, 1, 'COMOROS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(39, 1, 'CONGO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(40, 1, 'CROATIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(41, 1, 'CUBA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(42, 1, 'CYPRUS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(43, 1, 'DENMARK', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(44, 1, 'DJIBOUTI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(45, 1, 'DOMINICA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(46, 1, 'EGYPT', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(47, 1, 'FIJI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(48, 1, 'FINLAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(49, 1, 'FRANCE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(50, 1, 'GABON', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(51, 1, 'GAMBIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(52, 1, 'GEORGIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(53, 1, 'GERMANY', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(54, 1, 'GHANA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(55, 1, 'GIBRALTAR', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(56, 1, 'GREECE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(57, 1, 'GREENLAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(58, 1, 'GRENADA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(59, 1, 'GUADELOUPE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(60, 1, 'GUAM', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(61, 1, 'GUATEMALA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(62, 1, 'GUINEA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(63, 1, 'GUINEA-BISSAU', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(64, 1, 'GUYANA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(65, 1, 'HAITI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(66, 1, 'HONG KONG', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(67, 1, 'HUNGARY', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(68, 1, 'ICELAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(69, 1, 'INDIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(70, 1, 'INDONESIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(71, 1, 'IRAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(72, 1, 'IRAQ', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(73, 1, 'IRELAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(74, 1, 'ISRAEL', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(75, 1, 'ITALY', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(76, 1, 'JAMAICA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(77, 1, 'JAPAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(78, 1, 'JORDAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(79, 1, 'KAZAKSTAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(80, 1, 'KENYA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(81, 1, 'KIRIBATI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(82, 1, 'KOREA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(83, 1, 'KUWAIT', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(84, 1, 'KYRGYZSTAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(85, 1, 'LATVIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(86, 1, 'LEBANON', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(87, 1, 'LESOTHO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(88, 1, 'LIBERIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(89, 1, 'MALAYSIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(90, 1, 'MALDIVES', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(91, 1, 'MALI', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(92, 1, 'MALTA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(93, 1, 'MEXICO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(94, 1, 'MONACO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(95, 1, 'MONGOLIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(96, 1, 'MONTSERRAT', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(97, 1, 'MOROCCO', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(98, 1, 'MOZAMBIQUE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(99, 1, 'MYANMAR', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(100, 1, 'NAMIBIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(101, 1, 'NAURU', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(102, 1, 'NEPAL', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(103, 1, 'NETHERLANDS', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(104, 1, 'NICARAGUA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(105, 1, 'NIGER', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(106, 1, 'NIGERIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(107, 1, 'NIUE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(108, 1, 'NORWAY', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(109, 1, 'OMAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(110, 1, 'PAKISTAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(111, 1, 'PALAU', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(112, 1, 'QATAR', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(113, 1, 'REUNION', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(114, 1, 'ROMANIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(115, 1, 'RUSSIAN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(116, 1, 'SAUDI ARABIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(117, 1, 'SENEGAL', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(118, 1, 'SEYCHELLES', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(119, 1, 'SIERRA LEONE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(120, 1, 'SINGAPORE', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(121, 1, 'SLOVAKIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(122, 1, 'SLOVENIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(123, 1, 'SOMALIA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(124, 1, 'SRI LANKA', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(125, 1, 'SWAZILAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(126, 1, 'SWEDEN', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(127, 1, 'SWITZERLAND', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(128, 1, 'TAJIKISTAN', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(129, 1, 'THAILAND', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(130, 1, 'TOGO', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(131, 1, 'TOKELAU', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(132, 1, 'TONGA', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(133, 1, 'TUNISIA', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(134, 1, 'TURKEY', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(135, 1, 'TURKMENISTAN', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(136, 1, 'TURKS', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(137, 1, 'TUVALU', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(138, 1, 'UGANDA', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(139, 1, 'UKRAINE', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(140, 1, 'ARAB EMIRATES', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(141, 1, 'UNITED KINGDOM', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(142, 1, 'UNITED STATES', 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(16,2) NOT NULL DEFAULT '0.00',
  `birth_date` date DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `admin_id`, `employee_id`, `customer_name`, `card_number`, `customer_phone`, `customer_email`, `address`, `discount`, `birth_date`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Zahidul islam', 'S00000000001', '+8801739898764', 'zahidul.starit@gmail.com', 'Dhaka', 0.00, NULL, 2, 2, 1, '2023-10-28 14:45:59', '2023-10-28 14:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `customer_dues`
--

CREATE TABLE `customer_dues` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `sale_return_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `note` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_dues`
--

INSERT INTO `customer_dues` (`id`, `admin_id`, `employee_id`, `customer_id`, `invoice_no`, `sale_id`, `sale_return_id`, `payment_method`, `bank_name`, `bank_account_number`, `phone_number`, `transaction_number`, `paid`, `due`, `note`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'S0000001', 1, NULL, 'Cash', NULL, NULL, NULL, NULL, 0.00, 318.30, 'Sale Invoice', 2, 2, '2023-10-28 16:43:59', '2023-10-28 16:46:30'),
(2, 2, NULL, 1, 'S0000002', NULL, 1, 'Cash', NULL, NULL, NULL, NULL, 172.80, 0.00, 'Sale Return Invoice', 2, 2, '2023-10-29 01:46:50', '2023-10-29 01:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `damage_products`
--

CREATE TABLE `damage_products` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `total_damage_stock` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `damage_products`
--

INSERT INTO `damage_products` (`id`, `admin_id`, `employee_id`, `shop_id`, `date`, `total_vat`, `total_damage_stock`, `grand_total`, `created_user_id`, `updated_user_id`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, '2023-10-28', 1.50, 1.00, 150.00, 2, 2, NULL, 1, NULL, '2023-10-28 17:05:32', '2023-10-28 17:05:32'),
(2, 2, NULL, 1, '2023-10-28', 1.50, 1.00, 150.00, 2, 2, NULL, 1, NULL, '2023-10-28 17:08:24', '2023-10-28 17:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `damage_product_details`
--

CREATE TABLE `damage_product_details` (
  `id` bigint UNSIGNED NOT NULL,
  `damage_product_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_expire_date` date DEFAULT NULL,
  `qty` double(16,2) NOT NULL,
  `purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `damage_product_details`
--

INSERT INTO `damage_product_details` (`id`, `damage_product_id`, `product_id`, `product_name`, `product_expire_date`, `qty`, `purchase_price`, `vat_percent`, `vat_amount`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'canacur 1 KG ( Bombe )', NULL, 1.00, 150.00, 1.00, 1.50, 150.00, '2023-10-28 17:05:32', '2023-10-28 17:05:32'),
(2, 2, 2, 'canacur 1 KG ( Bombe )', NULL, 1.00, 150.00, 1.00, 1.50, 150.00, '2023-10-28 17:08:24', '2023-10-28 17:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `databackups`
--

CREATE TABLE `databackups` (
  `id` bigint UNSIGNED NOT NULL,
  `backup_date` date NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(350) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `superadmin_id`, `discount`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(2, 1, 1.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(3, 1, 2.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(4, 1, 3.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(5, 1, 4.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(6, 1, 5.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(7, 1, 6.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(8, 1, 7.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(9, 1, 8.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(10, 1, 9.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(11, 1, 10.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(12, 1, 11.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(13, 1, 12.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(14, 1, 13.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(15, 1, 14.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(16, 1, 15.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(17, 1, 16.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(18, 1, 17.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(19, 1, 18.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(20, 1, 19.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(21, 1, 20.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(22, 1, 21.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(23, 1, 22.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(24, 1, 23.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(25, 1, 24.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(26, 1, 25.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(27, 1, 26.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(28, 1, 27.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(29, 1, 28.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(30, 1, 29.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(31, 1, 30.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(32, 1, 31.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(33, 1, 32.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(34, 1, 33.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(35, 1, 34.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(36, 1, 35.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(37, 1, 36.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(38, 1, 37.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(39, 1, 38.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(40, 1, 39.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(41, 1, 40.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(42, 1, 41.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(43, 1, 42.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(44, 1, 43.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(45, 1, 44.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(46, 1, 45.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(47, 1, 46.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(48, 1, 47.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(49, 1, 48.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(50, 1, 49.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(51, 1, 50.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(52, 1, 51.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(53, 1, 52.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(54, 1, 53.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(55, 1, 54.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(56, 1, 55.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(57, 1, 56.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(58, 1, 57.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(59, 1, 58.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(60, 1, 59.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(61, 1, 60.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(62, 1, 61.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(63, 1, 62.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(64, 1, 63.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(65, 1, 64.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(66, 1, 65.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(67, 1, 66.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(68, 1, 67.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(69, 1, 68.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(70, 1, 69.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(71, 1, 70.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(72, 1, 71.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(73, 1, 72.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(74, 1, 73.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(75, 1, 74.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(76, 1, 75.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(77, 1, 76.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(78, 1, 77.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(79, 1, 78.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(80, 1, 79.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(81, 1, 80.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(82, 1, 81.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(83, 1, 82.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(84, 1, 83.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(85, 1, 84.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(86, 1, 85.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(87, 1, 86.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(88, 1, 87.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(89, 1, 88.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(90, 1, 89.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(91, 1, 90.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(92, 1, 91.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(93, 1, 92.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(94, 1, 93.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(95, 1, 94.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(96, 1, 95.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(97, 1, 96.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(98, 1, 97.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(99, 1, 98.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(100, 1, 99.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(101, 1, 100.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `expense_head_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `expense_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `admin_id`, `employee_id`, `expense_head_id`, `date`, `shop_id`, `expense_amount`, `payment_method`, `notes`, `bank_name`, `bank_account_number`, `phone_number`, `transaction_number`, `path`, `attachment`, `status`, `created_user_id`, `updated_user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, '2023-10-29', 1, 5000.00, 'Bkash', 'sd dsfas fsdf', NULL, NULL, '43535434534', 'sd fsdfsdf sd', 'storage/files/shares/uploads/2', 'cusershpappdatalocaltempphp199ct653dc31caa822.jpg', 1, 2, 2, NULL, '2023-10-29 02:27:40', '2023-10-29 02:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `expense_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `superadmin_id`, `expense_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'House Rent', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(2, 1, 'Transform', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(3, 1, 'Guest', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(4, 1, 'Net Bill', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30'),
(5, 1, 'Other', 1, '2023-10-28 09:42:30', '2023-10-28 09:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"7bc651e9-5f9f-40d8-96d4-8027c19bf07a\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:40:\\\"Hi Shohidul Islam . Your Last Login  At \\\";}s:2:\\\"id\\\";s:36:\\\"976596b9-9b9f-4526-9488-ad52c57e5123\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1698497344, 1698497344),
(2, 'default', '{\"uuid\":\"aba8a13f-e28a-4248-9743-32735bf7363f\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:59:\\\"Hi Shohidul Islam . Your Last Login  At 2023-10-28 18:49:04\\\";}s:2:\\\"id\\\";s:36:\\\"a9198141-4e76-4613-92c4-d65bce8ec6d1\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1698543412, 1698543412),
(3, 'default', '{\"uuid\":\"c2196690-a732-4d22-86ce-b3f7d396c4ca\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:52:\\\"Hi Superadmin . You Have Receive  a Payment  TK 5000\\\";}s:2:\\\"id\\\";s:36:\\\"63ad7a5d-e2dd-47af-a7a4-54fe00db78bc\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1698544227, 1698544227),
(4, 'default', '{\"uuid\":\"1f7f2657-d16c-46cb-82fe-3ca369662bd7\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:36:\\\"Hi Superadmin . Your Last Login  At \\\";}s:2:\\\"id\\\";s:36:\\\"7d7711a4-1ab4-4934-bc1d-eb2b5396e380\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1698544313, 1698544313);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(319, '2014_10_12_000000_create_users_table', 1),
(320, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(321, '2014_10_12_100000_create_password_resets_table', 1),
(322, '2019_08_19_000000_create_failed_jobs_table', 1),
(323, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(324, '2021_01_16_173440_create_contacts_table', 1),
(325, '2022_05_09_073243_create_permission_tables', 1),
(326, '2023_01_23_062218_create_jobs_table', 1),
(327, '2023_01_23_062235_create_notifications_table', 1),
(328, '2023_01_24_084018_create_settings_table', 1),
(329, '2023_01_24_084046_create_sliders_table', 1),
(330, '2023_01_24_084255_create_profiles_table', 1),
(331, '2023_02_17_172425_create_payments_table', 1),
(332, '2023_02_17_174833_create_packages_table', 1),
(333, '2023_02_17_181754_create_wallets_table', 1),
(334, '2023_03_10_084317_create_pages_table', 1),
(335, '2023_03_17_054013_create_brands_table', 1),
(336, '2023_03_17_084849_create_units_table', 1),
(337, '2023_03_17_155948_create_countries_table', 1),
(338, '2023_03_17_183549_create_categories_table', 1),
(339, '2023_03_17_190438_create_shops_table', 1),
(340, '2023_03_17_192445_create_sub_categories_table', 1),
(341, '2023_03_17_195621_create_vats_table', 1),
(342, '2023_03_17_205636_create_discounts_table', 1),
(343, '2023_03_18_070420_create_products_table', 1),
(344, '2023_04_02_154859_create_suppliers_table', 1),
(345, '2023_04_03_025618_create_purchases_table', 1),
(346, '2023_04_06_053635_create_databackups_table', 1),
(347, '2023_04_12_012516_create_supplier_dues_table', 1),
(348, '2023_04_12_012553_create_customers_table', 1),
(349, '2023_04_12_012559_create_customer_dues_table', 1),
(350, '2023_04_24_154348_create_purchase_details_table', 1),
(351, '2023_05_29_172037_create_activity_log_table', 1),
(352, '2023_05_29_172038_add_event_column_to_activity_log_table', 1),
(353, '2023_05_29_172039_add_batch_uuid_column_to_activity_log_table', 1),
(354, '2023_07_15_162110_create_shop_current_stocks_table', 1),
(355, '2023_09_09_092610_create_sales_table', 1),
(356, '2023_09_10_084608_create_sale_details_table', 1),
(357, '2023_09_29_150355_create_setups_table', 1),
(358, '2023_10_03_080320_create_purchase_returns_table', 1),
(359, '2023_10_03_080332_create_purchase_return_details_table', 1),
(360, '2023_10_03_081036_create_sale_returns_table', 1),
(361, '2023_10_03_081051_create_sale_return_details_table', 1),
(362, '2023_10_09_084032_create_stock_adjustments_table', 1),
(363, '2023_10_09_084047_create_stock_adjustment_details_table', 1),
(364, '2023_10_14_090212_create_product_discounts_table', 1),
(365, '2023_10_16_235148_create_damage_products_table', 1),
(366, '2023_10_16_235202_create_damage_product_details_table', 1),
(367, '2023_10_21_083637_create_stock_transfers_table', 1),
(368, '2023_10_21_083646_create_stock_transfer_details_table', 1),
(369, '2023_10_21_203743_create_expense_heads_table', 1),
(370, '2023_10_21_204539_create_expenses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `package_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(16,2) DEFAULT NULL,
  `employee_manage` int NOT NULL DEFAULT '1',
  `shop` int NOT NULL DEFAULT '1',
  `duration` int NOT NULL DEFAULT '30',
  `features` json DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `superadmin_id`, `package_name`, `slug`, `price`, `employee_manage`, `shop`, `duration`, `features`, `description`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 'small', 2.00, 1, 1, 30, '[\"Unlimited Product Upload\"]', 'Unlimited Product Upload', 1, 1, 1, '2023-10-28 09:42:28', '2023-10-28 09:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json_screma` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `footer_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `view` int NOT NULL DEFAULT '0',
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `payment_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `image` varchar(350) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-found.webp',
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `superadmin_id`, `payment_name`, `image`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash', 'not-found.webp', 1, 1, 1, NULL, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(2, 1, 'Bkash', 'not-found.webp', 1, 1, 1, NULL, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(3, 1, 'Bank', 'not-found.webp', 1, 1, 1, NULL, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(4, 1, 'Other', 'not-found.webp', 1, 1, 1, NULL, '2023-10-28 09:42:29', '2023-10-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'barcode-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(2, 'barcode-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(3, 'barcode-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(4, 'barcode-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(5, 'brand-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(6, 'brand-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(7, 'brand-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(8, 'brand-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(9, 'customer-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(10, 'customer-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(11, 'customer-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(12, 'customer-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(13, 'customer-due-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(14, 'customer-due-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(15, 'customer-due-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(16, 'customer-due-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(17, 'damage-product-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(18, 'damage-product-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(19, 'damage-product-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(20, 'damage-product-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(21, 'employee-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(22, 'employee-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(23, 'employee-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(24, 'employee-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(25, 'expense-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(26, 'expense-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(27, 'expense-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(28, 'expense-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(29, 'product-exchange-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(30, 'product-exchange-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(31, 'product-exchange-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(32, 'product-exchange-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(33, 'product-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(34, 'product-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(35, 'product-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(36, 'product-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(37, 'product-discount-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(38, 'product-discount-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(39, 'product-discount-edit', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(40, 'product-discount-delete', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(41, 'stock-transfer-list', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(42, 'stock-transfer-create', 'web', '2023-10-28 09:42:27', '2023-10-28 09:42:27'),
(43, 'stock-transfer-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(44, 'stock-transfer-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(45, 'purchase-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(46, 'purchase-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(47, 'purchase-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(48, 'purchase-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(49, 'purchase-return-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(50, 'purchase-return-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(51, 'purchase-return-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(52, 'purchase-return-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(53, 'role-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(54, 'role-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(55, 'role-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(56, 'role-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(57, 'shop-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(58, 'shop-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(59, 'shop-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(60, 'shop-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(61, 'shop-current-stock-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(62, 'shop-current-stock-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(63, 'shop-current-stock-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(64, 'shop-current-stock-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(65, 'supplier-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(66, 'supplier-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(67, 'supplier-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(68, 'supplier-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(69, 'supplier-due-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(70, 'supplier-due-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(71, 'supplier-due-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(72, 'supplier-due-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(73, 'sale-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(74, 'sale-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(75, 'sale-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(76, 'sale-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(77, 'sale-return-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(78, 'sale-return-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(79, 'sale-return-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(80, 'sale-return-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(81, 'stock-adjustment-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(82, 'stock-adjustment-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(83, 'stock-adjustment-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(84, 'stock-adjustment-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(85, 'user-list', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(86, 'user-create', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(87, 'user-edit', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(88, 'user-delete', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(89, 'product-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(90, 'purchase-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(91, 'sale-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(92, 'transfer-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(93, 'purchase-return-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(94, 'sale-return-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(95, 'customer-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(96, 'supplier-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(97, 'damage-report', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` enum('PCS','CARTON','KG','GM','PACKET','ML','DZN','BOX','BAG','PACKAGE','TRAY','EACH','CTN','ROFTA','TIN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PCS',
  `rack_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `made_in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangladesh',
  `product_full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `average_price` double(16,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `vat` double(10,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `old_discount` double(10,2) NOT NULL DEFAULT '0.00',
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint UNSIGNED DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `low_quantity` int NOT NULL DEFAULT '0',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `employee_id`, `brand_id`, `product_name`, `barcode`, `unit`, `rack_number`, `weight_size`, `made_in`, `product_full_name`, `slug`, `sku`, `purchase_price`, `average_price`, `sale_price`, `vat`, `discount`, `old_discount`, `path`, `photo`, `expire_date`, `category_id`, `sub_category_id`, `created_user_id`, `updated_user_id`, `low_quantity`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'canacur', '5392438', 'KG', NULL, '1', 'BANGLADESH', 'canacur 1 KG ( Pran )', 'canacur-1-kg-pran', 'CAN1KG', 120.00, 360.00, 150.00, 2.00, 2.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', NULL, 66, NULL, 2, 2, 0, '<p>sad fsdf sdfds</p>', 1, NULL, '2023-10-28 13:31:41', '2023-10-28 14:21:12'),
(2, 2, NULL, 2, 'canacur', '523830774', 'KG', NULL, '1', 'BANGLADESH', 'canacur 1 KG ( Bombe )', 'canacur-1-kg-bombe', 'CAN1KG', 150.00, 300.00, 180.00, 1.00, 1.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', NULL, 96, NULL, 2, 2, 0, '<p>dsa fads sdf</p>', 1, NULL, '2023-10-28 13:32:29', '2023-10-28 14:20:41'),
(3, 2, NULL, 3, 'canacur', '124978017', 'KG', NULL, '1', 'BANGLADESH', 'canacur 1 KG ( Cocola )', 'canacur-1-kg-cocola', 'CAN1KG', 150.00, 300.00, 180.00, 1.00, 1.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', NULL, 96, NULL, 2, 2, 0, '<p>dsa fads sdf</p>', 1, NULL, '2023-10-28 13:32:50', '2023-10-28 14:20:41'),
(4, 2, NULL, 3, 'biscut', '244500872', 'KG', NULL, '1', 'BANGLADESH', 'biscut 1 KG ( Cocola )', 'biscut-1-kg-cocola', 'BIS1KG', 150.00, 150.00, 180.00, 1.00, 1.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', NULL, 96, NULL, 2, 2, 0, '<p>dsa fads sdf</p>', 0, NULL, '2023-10-28 13:41:04', '2023-10-28 13:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint UNSIGNED DEFAULT NULL,
  `product_ids` json DEFAULT NULL,
  `product_new_discount` double(10,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_discounts`
--

INSERT INTO `product_discounts` (`id`, `admin_id`, `employee_id`, `title`, `shop_id`, `brand_id`, `category_id`, `sub_category_id`, `product_ids`, `product_new_discount`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'EID DISCOUNT', 1, NULL, NULL, NULL, '[\"1\", \"2\", \"3\"]', 5.00, 2, 2, '2023-10-28 16:15:40', '2023-10-28 16:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `refer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_start_date` date NOT NULL DEFAULT '2023-10-28',
  `package_end_date` date DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangladesh',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `position`, `gender`, `refer_code`, `rating`, `comment`, `package_start_date`, `package_end_date`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 'Male', 'shop2023', NULL, NULL, '2023-10-28', NULL, 'BANGLADESH', '2023-10-28 09:42:28', '2023-10-29 02:11:35'),
(2, 2, 'Amin', 'Male', NULL, 5, 'adfasf sadf sdaff dfsda fsd', '2023-10-28', '2023-11-27', 'BANGLADESH', '2023-10-28 09:44:04', '2023-10-29 02:36:31'),
(3, 3, NULL, 'Male', NULL, NULL, NULL, '2023-10-28', NULL, 'Bangladesh', '2023-10-29 02:35:17', '2023-10-29 02:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('Direct','Requisition') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Direct',
  `requisition_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `total_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(16,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `return_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `admin_id`, `employee_id`, `invoice_no`, `reference`, `shop_id`, `supplier_id`, `type`, `requisition_id`, `date`, `total_vat`, `total_discount`, `sub_total`, `payment_method`, `paid`, `due`, `grand_total`, `return_quantity`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'S0000001', NULL, 1, 2, 'Direct', NULL, '2023-10-28', 6.90, 0.00, 570.00, 'Cash', 0.00, 576.90, 576.90, 0.00, 2, 2, NULL, 1, NULL, '2023-10-28 14:20:41', '2023-10-28 14:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(16,2) NOT NULL,
  `already_return_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `average_purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `product_expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `product_name`, `qty`, `already_return_qty`, `average_purchase_price`, `purchase_price`, `vat_percent`, `vat_amount`, `total_price`, `product_expire_date`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'canacur 1 KG ( Cocola ) (124978017)', 2.00, 0.00, 150.00, 150.00, 1.00, 3.00, 300.00, NULL, '2023-10-28 14:20:41', '2023-10-28 14:20:41'),
(2, 1, 2, 'canacur 1 KG ( Bombe ) (523830774)', 1.00, 1.00, 150.00, 150.00, 1.00, 1.50, 150.00, NULL, '2023-10-28 14:20:41', '2023-10-29 01:38:52'),
(3, 1, 1, 'canacur 1 KG ( Pran ) (5392438)', 1.00, 1.00, 120.00, 120.00, 2.00, 2.40, 120.00, NULL, '2023-10-28 14:20:41', '2023-10-29 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `total_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(16,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `return_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `admin_id`, `employee_id`, `invoice_no`, `shop_id`, `supplier_id`, `date`, `total_vat`, `total_discount`, `sub_total`, `payment_method`, `paid`, `due`, `grand_total`, `return_quantity`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'S0000001', 1, 2, '2023-10-29', 3.90, 0.00, 270.00, 'Cash', 273.90, 0.00, 273.90, 2.00, 2, 2, 'baze product', 1, NULL, '2023-10-29 01:38:52', '2023-10-29 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_return_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_return_details`
--

INSERT INTO `purchase_return_details` (`id`, `purchase_return_id`, `product_id`, `product_name`, `return_qty`, `purchase_price`, `vat_percent`, `vat_amount`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'canacur 1 KG ( Bombe ) (523830774)', 1.00, 150.00, 1.00, 1.50, 150.00, '2023-10-29 01:38:52', '2023-10-29 01:38:52'),
(2, 1, 1, 'canacur 1 KG ( Pran ) (5392438)', 1.00, 120.00, 2.00, 2.40, 120.00, '2023-10-29 01:38:52', '2023-10-29 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `admin_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin1', 'web', '2023-10-28 09:42:28', '2023-10-28 09:42:28'),
(2, 2, 'Test2', 'web', '2023-10-29 02:34:25', '2023-10-29 02:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

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
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `discount` double(16,2) NOT NULL DEFAULT '0.00',
  `other_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(16,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `pay_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `change_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `admin_id`, `employee_id`, `invoice_no`, `reference`, `shop_id`, `customer_id`, `date`, `total_vat`, `discount`, `other_discount`, `total_discount`, `sub_total`, `payment_method`, `paid`, `pay_amount`, `change_amount`, `due`, `grand_total`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'S0000001', NULL, 1, 1, '2023-10-28', 4.80, 16.50, 0.00, 16.50, 330.00, 'Cash', 0.00, 0.00, 0.00, 318.30, 318.30, 2, 2, 'fcdsafdasf', 1, NULL, '2023-10-28 16:43:59', '2023-10-28 16:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(16,2) NOT NULL,
  `already_return_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `average_purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `loss_profit_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `product_expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `product_name`, `qty`, `already_return_qty`, `average_purchase_price`, `sale_price`, `loss_profit_amount`, `vat_percent`, `vat_amount`, `discount_percent`, `discount_amount`, `total_price`, `product_expire_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'canacur 1 KG ( Pran )', 1.00, 0.00, 360.00, 150.00, -210.00, 2.00, 3.00, 5.00, 7.50, 145.50, NULL, '2023-10-28 16:43:59', '2023-10-28 16:46:29'),
(2, 1, 3, 'canacur 1 KG ( Cocola )', 1.00, 1.00, 300.00, 180.00, -120.00, 1.00, 1.80, 5.00, 9.00, 172.80, NULL, '2023-10-28 16:46:29', '2023-10-29 01:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `discount` double(16,2) NOT NULL DEFAULT '0.00',
  `other_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `return_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_returns`
--

INSERT INTO `sale_returns` (`id`, `admin_id`, `employee_id`, `invoice_no`, `shop_id`, `customer_id`, `date`, `total_vat`, `discount`, `other_discount`, `total_discount`, `return_quantity`, `payment_method`, `paid`, `due`, `grand_total`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'S0000001', 1, 1, '2023-10-29', 1.80, 9.00, 0.00, 9.00, 1.00, 'Cash', 172.80, 0.00, 172.80, 2, 2, NULL, 1, NULL, '2023-10-29 01:46:50', '2023-10-29 01:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_details`
--

CREATE TABLE `sale_return_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_return_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `loss_profit_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_return_details`
--

INSERT INTO `sale_return_details` (`id`, `sale_return_id`, `product_id`, `product_name`, `return_qty`, `sale_price`, `loss_profit_amount`, `vat_percent`, `vat_amount`, `discount_percent`, `discount_amount`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'canacur 1 KG ( Cocola )', 1.00, 180.00, 0.00, 1.00, 1.80, 5.00, 9.00, 172.80, '2023-10-29 01:46:50', '2023-10-29 01:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refer_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbole` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_headline` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `printing_logo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `logo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `facebook` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `superadmin_id`, `company_name`, `project_name`, `website_name`, `website_title`, `refer_amount`, `address`, `currency_name`, `currency_symbole`, `bin_number`, `vat_number`, `print_headline`, `print_message`, `printing_logo`, `phone`, `email`, `favicon`, `logo`, `facebook`, `youtube`, `twitter`, `instagram`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'SohiBD Soft LTD', 'Shop Management', 'Shop Sohibd', 'Shop Sohibd software', 500.00, '30 Commercial Road Mirpur, Dhaka', 'BDT', '৳', '125487456545552', '12548', 'Shop POS  Software', 'Thanks to use Shop Management software', 'printlogo.jpg', '(281) 809-0090', 'info@sohibd.com', 'https://shopsohibd.test/storage/files/shares/uploads/1/sohibd-soft-ltd653dc00cf07f1.jpg', 'https://shopsohibd.test/storage/files/shares/uploads/1/sohibd-soft-ltd653dc00d0c38a.png', '#', '#', '#', '#', 1, 1, '2023-10-28 09:42:28', '2023-10-29 02:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `setups`
--

CREATE TABLE `setups` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `owner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_shop_id` bigint UNSIGNED DEFAULT NULL,
  `default_supplier_id` bigint UNSIGNED DEFAULT NULL,
  `default_customer_id` bigint UNSIGNED DEFAULT NULL,
  `sms_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'zahidul1994',
  `sms_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'zahid22932044',
  `sms_rate` double(8,2) NOT NULL DEFAULT '0.25',
  `sms_type` enum('Masking','Non-Masking') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non-Masking',
  `sms_status` tinyint NOT NULL DEFAULT '0',
  `sms_text` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#',
  `currency_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `currency_icon` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '৳',
  `bin_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `printing_logo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_first_note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'You cannot exchange any product',
  `print_second_note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Thank For Shopping',
  `office_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_address` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setups`
--

INSERT INTO `setups` (`id`, `admin_id`, `owner_name`, `company_name`, `company_logo`, `default_shop_id`, `default_supplier_id`, `default_customer_id`, `sms_user`, `sms_password`, `sms_rate`, `sms_type`, `sms_status`, `sms_text`, `currency_name`, `currency_icon`, `bin_number`, `vat_number`, `printing_logo`, `print_first_note`, `print_second_note`, `office_phone`, `office_email`, `company_address`, `facebook`, `youtube`, `twitter`, `instagram`, `web_address`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Sohibd IT', 'http://shopsohibd.test/storage/files/shares/uploads/2/653cc1f7e186d.jpg', 1, 2, NULL, 'zahidul1994', 'zahid22932044', 0.25, 'Non-Masking', 0, 'Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#', 'BDT', '৳', '465465456456', '54465456456', 'storage/files/shares/uploads/2/653d08dd7943e.jpg', 'You cannot exchange any product', 'Thank For Shopping', '0 1768309464', 'admin1234@gmail.com', 'Natore Bangladesh', NULL, NULL, NULL, NULL, 'sohibd.com', '<p>&nbsp;dfadsf asdfsa fsdf dsfsd</p>', '2023-10-28 09:44:04', '2023-10-28 14:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `shop_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `admin_id`, `shop_name`, `slug`, `shop_phone`, `shop_email`, `shop_address`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sohibd Super Shop', 'sohibd-super-shop', '01739898764', 'zahidul.starit@gmail.com', 'Dhaka', 2, 2, 1, NULL, '2023-10-28 14:07:11', '2023-10-28 14:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `shop_current_stocks`
--

CREATE TABLE `shop_current_stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `last_sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `last_purchase_discount` double(16,2) NOT NULL DEFAULT '0.00',
  `last_purchase_vat` double(10,2) NOT NULL DEFAULT '0.00',
  `stock_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `old_discount` double(10,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `expire_date` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_current_stocks`
--

INSERT INTO `shop_current_stocks` (`id`, `admin_id`, `shop_id`, `product_id`, `product_name`, `sku`, `barcode`, `last_purchase_price`, `last_sale_price`, `last_purchase_discount`, `last_purchase_vat`, `stock_qty`, `old_discount`, `discount`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 'canacur', 'CAN1KG', '124978017', 150.00, 180.00, 1.00, 1.00, 2.00, 1.00, 5.00, NULL, 1, '2023-10-28 14:20:41', '2023-10-29 01:46:50'),
(2, 2, 1, 2, 'canacur', 'CAN1KG', '523830774', 150.00, 180.00, 1.00, 1.00, 1.00, 1.00, 5.00, NULL, 1, '2023-10-28 14:20:41', '2023-10-29 01:38:52'),
(3, 2, 1, 1, 'canacur', 'CAN1KG', '5392438', 120.00, 150.00, 2.00, 2.00, -1.00, 2.00, 5.00, NULL, 1, '2023-10-28 14:20:41', '2023-10-29 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `link_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_user_id` bigint UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint UNSIGNED DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `total_previous_stock` double(30,2) NOT NULL DEFAULT '0.00',
  `total_current_stock` double(30,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`id`, `admin_id`, `employee_id`, `shop_id`, `date`, `total_previous_stock`, `total_current_stock`, `created_user_id`, `updated_user_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, 1, '2023-10-28', 3.00, 6.00, 2, 2, NULL, 1, '2023-10-28 16:38:20', '2023-10-28 16:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_details`
--

CREATE TABLE `stock_adjustment_details` (
  `id` bigint UNSIGNED NOT NULL,
  `stock_adjustment_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_qty` double(16,2) NOT NULL,
  `current_qty` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_adjustment_details`
--

INSERT INTO `stock_adjustment_details` (`id`, `stock_adjustment_id`, `product_id`, `product_name`, `previous_qty`, `current_qty`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'canacur 1 KG ( Bombe )', 1.00, 4.00, '2023-10-28 16:38:20', '2023-10-28 16:41:39'),
(2, 4, 3, 'canacur 1 KG ( Cocola )', 2.00, 2.00, '2023-10-28 16:41:40', '2023-10-28 16:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `from_shop_id` bigint UNSIGNED DEFAULT NULL,
  `to_shop_id` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_stock` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer_details`
--

CREATE TABLE `stock_transfer_details` (
  `id` bigint UNSIGNED NOT NULL,
  `stock_transfer_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `current_stock_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_qty` double(16,2) NOT NULL,
  `transfer_qty` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `sub_category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `superadmin_id`, `category_id`, `sub_category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'CHINIGURA', 'chinigura', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(2, 1, 5, 'MINIKET', 'miniket', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(3, 1, 5, 'NAJIRSHAIL', 'najirshail', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(4, 1, 5, 'PAIJAM', 'paijam', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(5, 1, 5, 'BASMATI', 'basmati', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(6, 1, 18, 'DAY CREAM', 'day-cream', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(7, 1, 18, 'NIGHT CREAM', 'night-cream', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(8, 1, 18, 'EYE CREAM', 'eye-cream', 1, '2023-10-29 03:03:03', '2023-10-29 03:03:03'),
(9, 1, 26, 'WASHING POWDER', 'washing-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(10, 1, 26, 'BALL SOAP', 'ball-soap', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(11, 1, 26, 'FABRIC BRIGHTENER', 'fabric-brightener', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(12, 1, 26, 'LIQUID WASH', 'liquid-wash', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(13, 1, 30, 'CREAM', 'cream', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(14, 1, 30, 'LOTION', 'lotion', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(15, 1, 30, 'SHAMPOO', 'shampoo', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(16, 1, 30, 'HAIR OIL', 'hair-oil', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(17, 1, 30, 'TOOTHPASTE', 'toothpaste', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(18, 1, 30, 'BRUSH', 'brush', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(19, 1, 30, 'BODY OIL', 'body-oil', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(20, 1, 30, 'SOAP', 'soap', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(21, 1, 30, 'TOP TO TOY', 'top-to-toy', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(22, 1, 30, 'DIAPER', 'diaper', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(23, 1, 30, 'WET TISSUE', 'wet-tissue', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(24, 1, 30, 'TALCOM POWDER', 'talcom-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(25, 1, 30, 'FOOD SUPPLIMENT', 'food-suppliment', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(26, 1, 30, 'FEEDER', 'feeder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(27, 1, 30, 'NIPLES', 'niples', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(28, 1, 30, 'COTTON BUDS', 'cotton-buds', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(29, 1, 35, 'MEN COLOR', 'men-color', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(30, 1, 35, 'WOMEN COLOR', 'women-color', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(31, 1, 37, 'BELT', 'belt', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(32, 1, 37, 'PANTY', 'panty', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(33, 1, 41, 'BODY', 'body', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(34, 1, 41, 'FOOD OIL', 'food-oil', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(35, 1, 41, 'FACE & HAND', 'face-hand', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(36, 1, 41, 'HAIR', 'hair', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(37, 1, 45, 'BLACK TEA', 'black-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(38, 1, 45, 'BOP TEA', 'bop-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(39, 1, 45, 'DUST TEA', 'dust-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(40, 1, 45, 'TULSI TEA', 'tulsi-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(41, 1, 45, 'MASALA TEA', 'masala-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(42, 1, 45, 'GREEN TEA', 'green-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(43, 1, 45, 'LEMONGRASS TEA', 'lemongrass-tea', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(44, 1, 47, 'SPRAY', 'spray', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(45, 1, 48, 'LIPBALM', 'lipbalm', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(46, 1, 48, 'LIP GEL', 'lip-gel', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(47, 1, 48, 'LIP THERAPY', 'lip-therapy', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(48, 1, 49, 'UPTAN', 'uptan', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(49, 1, 49, 'SCRUB', 'scrub', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(50, 1, 49, 'ALOEVERA GEL', 'aloevera-gel', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(51, 1, 49, 'SKIN TONER', 'skin-toner', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(52, 1, 49, 'PEEL-OFF MASK', 'peel-off-mask', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(53, 1, 49, 'FACE PACK', 'face-pack', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(54, 1, 62, 'TOMATO SAUCE', 'tomato-sauce', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(55, 1, 62, 'SOYA SAUCE', 'soya-sauce', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(56, 1, 62, 'GARLIC SAUCE', 'garlic-sauce', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(57, 1, 62, 'CHILLI SAUCE', 'chilli-sauce', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(58, 1, 72, 'MUM', 'mum', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(59, 1, 72, 'JIBON', 'jibon', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(60, 1, 72, 'FRESH', 'fresh', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(61, 1, 72, 'AQUAFINA', 'aquafina', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(62, 1, 72, 'IFAD', 'ifad', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(63, 1, 73, '7UP', '7up', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(64, 1, 73, 'COCA COLA', 'coca-cola', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(65, 1, 73, 'MIRINDA', 'mirinda', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(66, 1, 73, 'SPRITE', 'sprite', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(67, 1, 73, 'MOUNTAIN DEU', 'mountain-deu', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(68, 1, 73, 'PEPSI', 'pepsi', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(69, 1, 73, 'GLUCOSE', 'glucose', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(70, 1, 73, 'CURD', 'curd', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(71, 1, 75, 'BAKING POWDER', 'baking-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(72, 1, 75, 'CUSTARD POWDER', 'custard-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(73, 1, 75, 'COCO POWDER', 'coco-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(74, 1, 75, 'CORN POWDER', 'corn-powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(75, 1, 76, 'FOOD', 'food', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(76, 1, 77, 'CASHEW NUT', 'cashew-nut', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(77, 1, 77, 'PESTA  NUT', 'pesta-nut', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(78, 1, 77, 'CHINA NUTS', 'china-nuts', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(79, 1, 77, 'ALMONDS', 'almonds', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(80, 1, 77, 'AKHROT', 'akhrot', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(81, 1, 77, 'MURI', 'muri', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(82, 1, 80, 'BLACK MINI PACK', 'black-mini-pack', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(83, 1, 80, 'MIXED PACK', 'mixed-pack', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(84, 1, 80, 'RAW COFFEE', 'raw-coffee', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(85, 1, 80, 'COFFEE MATE', 'coffee-mate', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(86, 1, 83, 'MANGO', 'mango', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(87, 1, 83, 'OLIVE', 'olive', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(88, 1, 83, 'TETUL', 'tetul', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(89, 1, 83, 'MIX PICKLE', 'mix-pickle', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(90, 1, 83, 'BOROI', 'boroi', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(91, 1, 83, 'GARLIC', 'garlic', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(92, 1, 88, 'POWDER', 'powder', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(93, 1, 88, 'LIQUID', 'liquid', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(94, 1, 88, 'CREAME', 'creame', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(95, 1, 89, 'MUG', 'mug', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(96, 1, 89, 'MUSUR', 'musur', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(97, 1, 89, 'BUT', 'but', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(98, 1, 89, 'KHESARI', 'khesari', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(99, 1, 89, 'MASHKALAI', 'mashkalai', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(100, 1, 93, 'MAJUNI', 'majuni', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(101, 1, 93, 'DISHWASH BAR', 'dishwash-bar', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(102, 1, 93, 'DISHWASH LIQUID', 'dishwash-liquid', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04'),
(103, 1, 93, 'POT', 'pot', 1, '2023-10-29 03:03:04', '2023-10-29 03:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `admin_id`, `employee_id`, `supplier_name`, `supplier_phone`, `supplier_email`, `address`, `description`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'zahidul islam', '01739898764', 'zahidul.starit@gmail.com', 'Dhaka', NULL, 2, 2, 1, '2023-10-28 14:09:14', '2023-10-28 14:09:14'),
(2, 2, NULL, 'Himu Khan', '01773515369', 'zahidul.starit@gmail.com', 'Dhaka', NULL, 2, 2, 1, '2023-10-28 14:10:24', '2023-10-28 14:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_dues`
--

CREATE TABLE `supplier_dues` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_return_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `note` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_dues`
--

INSERT INTO `supplier_dues` (`id`, `admin_id`, `employee_id`, `supplier_id`, `invoice_no`, `purchase_id`, `purchase_return_id`, `payment_method`, `bank_name`, `bank_account_number`, `phone_number`, `transaction_number`, `paid`, `due`, `note`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2, 'S0000001', 1, NULL, 'Cash', NULL, NULL, NULL, NULL, 0.00, 576.90, 'Purchase Invoice', 2, 2, '2023-10-28 14:20:41', '2023-10-28 14:20:41'),
(2, 2, NULL, 2, 'S0000002', NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, 576.00, 0.00, 'pore taka dibo', 2, 2, '2023-10-28 14:36:30', '2023-10-28 14:37:42'),
(3, 2, NULL, 2, 'S0000003', NULL, 1, 'Cash', NULL, NULL, NULL, NULL, 273.90, 0.00, 'Purchase Return Invoice', 2, 2, '2023-10-29 01:38:52', '2023-10-29 01:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `superadmin_id`, `unit_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'PCS', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(2, 1, 'CARTON', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(3, 1, 'KG', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(4, 1, 'GM', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(5, 1, 'PACKET', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(6, 1, 'ML', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(7, 1, 'DZN', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(8, 1, 'BOX', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(9, 1, 'BAG', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(10, 1, 'PACKAGE', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(11, 1, 'TRAY', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(12, 1, 'EACH', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(13, 1, 'CTN', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(14, 1, 'ROFTA', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(15, 1, 'TIN', 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('Superadmin','Admin','Employee','Staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint UNSIGNED DEFAULT NULL,
  `package_id` bigint UNSIGNED DEFAULT NULL,
  `refer_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-found.webp',
  `account_expire_date` date DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '101.2.160.0',
  `admin_employee_status` tinyint NOT NULL DEFAULT '1',
  `lock` tinyint NOT NULL DEFAULT '0',
  `otp` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `admin_id`, `email`, `invoice_slug`, `phone`, `shop_id`, `package_id`, `refer_id`, `password`, `image`, `account_expire_date`, `last_login`, `created_user_id`, `updated_user_id`, `email_verified_at`, `ip_address`, `admin_employee_status`, `lock`, `otp`, `status`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'Superadmin', NULL, 'superadmin@gmail.com', 'SUP', '01739898764', NULL, 1, 'Sup00001', '$2y$10$vgbvemKKOAaG7LfhoQyeE.FLyI2CNF6cNuQ/yRqZRE1L8JPnDu6hK', 'https://shopsohibd.test/storage/files/shares/uploads/1/superadmin653dbf579a9ca.jpg', NULL, '2023-10-29 01:51:53', 1, 1, NULL, '127.0.0.1', 1, 0, NULL, 1, NULL, NULL, '2023-10-28 09:42:28', '2023-10-29 02:11:35'),
(2, 'Shohidul Islam', 'Admin', NULL, 'admin1234@gmail.com', 'S', '0 1768309464', NULL, 1, 'Sho00001', '$2y$10$2uYIZ/0gaC/bN8Im.BMmRus7o3l//rOc5nitCw1Zg.ruHSfWVa6Da', 'http://shopsohibd.test/storage/files/shares/uploads/2/653cc1f7e186d.jpg', NULL, '2023-10-29 01:36:52', 1, 2, '2023-10-28 09:44:04', '127.0.0.1', 1, 0, NULL, 1, NULL, NULL, '2023-10-28 09:44:04', '2023-10-29 01:36:52'),
(3, 'Zahidul islam', 'Employee', 2, 'himustarit@gmail.com', NULL, '11739898764', 1, NULL, NULL, '$2y$10$CJ00WONu8QIouFSI4zF3OO.tIMN9ipV0yJizpK42BtNgAJDTv21Eq', 'http://shopsohibd.test/storage/files/shares/uploads/2/users/zahidul-islam653dc4e566527.jpg', NULL, NULL, 2, 2, '2023-10-29 02:35:17', '127.0.0.1', 1, 0, NULL, 1, NULL, NULL, '2023-10-29 02:35:17', '2023-10-29 02:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `vat` double(10,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vats`
--

INSERT INTO `vats` (`id`, `superadmin_id`, `vat`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(2, 1, 1.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(3, 1, 2.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(4, 1, 3.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(5, 1, 4.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(6, 1, 5.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(7, 1, 6.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(8, 1, 7.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(9, 1, 8.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(10, 1, 9.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(11, 1, 10.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(12, 1, 11.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(13, 1, 12.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(14, 1, 13.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(15, 1, 14.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(16, 1, 15.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(17, 1, 16.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(18, 1, 17.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(19, 1, 18.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(20, 1, 19.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(21, 1, 20.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(22, 1, 21.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(23, 1, 22.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(24, 1, 23.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(25, 1, 24.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(26, 1, 25.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(27, 1, 26.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(28, 1, 27.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(29, 1, 28.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(30, 1, 29.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(31, 1, 30.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(32, 1, 31.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(33, 1, 32.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(34, 1, 33.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(35, 1, 34.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(36, 1, 35.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(37, 1, 36.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(38, 1, 37.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(39, 1, 38.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(40, 1, 39.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(41, 1, 40.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(42, 1, 41.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(43, 1, 42.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(44, 1, 43.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(45, 1, 44.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(46, 1, 45.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(47, 1, 46.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(48, 1, 47.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(49, 1, 48.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(50, 1, 49.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(51, 1, 50.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(52, 1, 51.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(53, 1, 52.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(54, 1, 53.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(55, 1, 54.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(56, 1, 55.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(57, 1, 56.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(58, 1, 57.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(59, 1, 58.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(60, 1, 59.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(61, 1, 60.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(62, 1, 61.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(63, 1, 62.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(64, 1, 63.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(65, 1, 64.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(66, 1, 65.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(67, 1, 66.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(68, 1, 67.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(69, 1, 68.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(70, 1, 69.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(71, 1, 70.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(72, 1, 71.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(73, 1, 72.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(74, 1, 73.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(75, 1, 74.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(76, 1, 75.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(77, 1, 76.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(78, 1, 77.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(79, 1, 78.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(80, 1, 79.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(81, 1, 80.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(82, 1, 81.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(83, 1, 82.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(84, 1, 83.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(85, 1, 84.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(86, 1, 85.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(87, 1, 86.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(88, 1, 87.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(89, 1, 88.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(90, 1, 89.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(91, 1, 90.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(92, 1, 91.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(93, 1, 92.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(94, 1, 93.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(95, 1, 94.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(96, 1, 95.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(97, 1, 96.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(98, 1, 97.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(99, 1, 98.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(100, 1, 99.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29'),
(101, 1, 100.00, 1, 1, 1, '2023-10-28 09:42:29', '2023-10-28 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `debit` double(16,4) NOT NULL DEFAULT '0.0000',
  `credit` double(16,4) NOT NULL DEFAULT '0.0000',
  `type` enum('reffer','commission','join','payment','withdraw','renew','receive','sms','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` json DEFAULT NULL,
  `created_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `updated_user_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `superadmin_id`, `admin_id`, `user_id`, `debit`, `credit`, `type`, `payment_id`, `note`, `details`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 0.0000, 5000.0000, 'receive', 1, 'fdsfdsf dsfds', '\"65465464\"', 2, 2, 0, NULL, '2023-10-29 01:50:27', '2023-10-29 01:50:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_admin_id_foreign` (`admin_id`),
  ADD KEY `brands_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_admin_id_foreign` (`admin_id`),
  ADD KEY `customers_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `customer_dues`
--
ALTER TABLE `customer_dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_dues_admin_id_foreign` (`admin_id`),
  ADD KEY `customer_dues_employee_id_foreign` (`employee_id`),
  ADD KEY `customer_dues_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `damage_products`
--
ALTER TABLE `damage_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `damage_products_admin_id_foreign` (`admin_id`),
  ADD KEY `damage_products_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `damage_product_details`
--
ALTER TABLE `damage_product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `damage_product_details_damage_product_id_foreign` (`damage_product_id`);

--
-- Indexes for table `databackups`
--
ALTER TABLE `databackups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_admin_id_foreign` (`admin_id`),
  ADD KEY `expenses_employee_id_foreign` (`employee_id`),
  ADD KEY `expenses_expense_head_id_foreign` (`expense_head_id`);

--
-- Indexes for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_heads_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_name_unique` (`page_name`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_full_name_brand_id_unique` (`product_full_name`,`brand_id`),
  ADD KEY `products_admin_id_foreign` (`admin_id`),
  ADD KEY `products_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discounts_admin_id_foreign` (`admin_id`),
  ADD KEY `product_discounts_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_admin_id_foreign` (`admin_id`),
  ADD KEY `purchases_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_returns_admin_id_foreign` (`admin_id`),
  ADD KEY `purchase_returns_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_return_details_purchase_return_id_foreign` (`purchase_return_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `roles_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_admin_id_foreign` (`admin_id`),
  ADD KEY `sales_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_returns_admin_id_foreign` (`admin_id`),
  ADD KEY `sale_returns_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_return_details_sale_return_id_foreign` (`sale_return_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `setups`
--
ALTER TABLE `setups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setups_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `shop_current_stocks`
--
ALTER TABLE `shop_current_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_current_stocks_shop_id_product_id_unique` (`shop_id`,`product_id`),
  ADD KEY `shop_current_stocks_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustments_admin_id_foreign` (`admin_id`),
  ADD KEY `stock_adjustments_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustment_details_stock_adjustment_id_foreign` (`stock_adjustment_id`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transfers_admin_id_foreign` (`admin_id`),
  ADD KEY `stock_transfers_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `stock_transfer_details`
--
ALTER TABLE `stock_transfer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transfer_details_stock_transfer_id_foreign` (`stock_transfer_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_superadmin_id_foreign` (`superadmin_id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_admin_id_foreign` (`admin_id`),
  ADD KEY `suppliers_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_dues_admin_id_foreign` (`admin_id`),
  ADD KEY `supplier_dues_employee_id_foreign` (`employee_id`),
  ADD KEY `supplier_dues_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vats_superadmin_id_foreign` (`superadmin_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_admin_id_foreign` (`admin_id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_dues`
--
ALTER TABLE `customer_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `damage_products`
--
ALTER TABLE `damage_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `damage_product_details`
--
ALTER TABLE `damage_product_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `databackups`
--
ALTER TABLE `databackups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setups`
--
ALTER TABLE `setups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_current_stocks`
--
ALTER TABLE `shop_current_stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer_details`
--
ALTER TABLE `stock_transfer_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brands_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_dues`
--
ALTER TABLE `customer_dues`
  ADD CONSTRAINT `customer_dues_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_dues_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_dues_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `damage_products`
--
ALTER TABLE `damage_products`
  ADD CONSTRAINT `damage_products_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `damage_products_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `damage_product_details`
--
ALTER TABLE `damage_product_details`
  ADD CONSTRAINT `damage_product_details_damage_product_id_foreign` FOREIGN KEY (`damage_product_id`) REFERENCES `damage_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_expense_head_id_foreign` FOREIGN KEY (`expense_head_id`) REFERENCES `expense_heads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD CONSTRAINT `expense_heads_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_discounts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_returns_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD CONSTRAINT `purchase_return_details_purchase_return_id_foreign` FOREIGN KEY (`purchase_return_id`) REFERENCES `purchase_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD CONSTRAINT `sale_returns_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_returns_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  ADD CONSTRAINT `sale_return_details_sale_return_id_foreign` FOREIGN KEY (`sale_return_id`) REFERENCES `sale_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setups`
--
ALTER TABLE `setups`
  ADD CONSTRAINT `setups_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_current_stocks`
--
ALTER TABLE `shop_current_stocks`
  ADD CONSTRAINT `shop_current_stocks_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_current_stocks_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  ADD CONSTRAINT `stock_adjustment_details_stock_adjustment_id_foreign` FOREIGN KEY (`stock_adjustment_id`) REFERENCES `stock_adjustments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD CONSTRAINT `stock_transfers_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transfer_details`
--
ALTER TABLE `stock_transfer_details`
  ADD CONSTRAINT `stock_transfer_details_stock_transfer_id_foreign` FOREIGN KEY (`stock_transfer_id`) REFERENCES `stock_transfers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_categories_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suppliers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  ADD CONSTRAINT `supplier_dues_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_dues_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_dues_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vats`
--
ALTER TABLE `vats`
  ADD CONSTRAINT `vats_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
