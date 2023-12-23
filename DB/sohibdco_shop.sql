-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2023 at 08:34 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sohibdco_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(191) DEFAULT NULL,
  `event` varchar(191) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\User', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"name\":\"Superadmin\",\"user_type\":\"Superadmin\",\"admin_id\":null,\"email\":\"superadmin@gmail.com\",\"invoice_slug\":\"SUP\",\"phone\":\"01739898764\",\"shop_id\":null,\"package_id\":\"1\",\"refer_id\":\"Sup00001\",\"password\":\"$2y$10$jQHiF2GIXJDf689zHk2SPezDnLYv.NVEPw93e9YeY0vs53dG\\/ky8m\",\"image\":\"not-found.webp\",\"account_expire_date\":null,\"last_login\":null,\"created_user_id\":\"1\",\"updated_user_id\":\"1\",\"email_verified_at\":null,\"ip_address\":\"101.2.160.0\",\"admin_employee_status\":\"1\",\"lock\":\"0\",\"otp\":null,\"status\":\"1\",\"deleted_at\":null,\"remember_token\":null,\"created_at\":\"2023-11-12T02:45:37.000000Z\",\"updated_at\":\"2023-11-12T02:45:37.000000Z\"}}', NULL, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(2, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"Superadmin\",\"user_type\":\"Superadmin\",\"admin_id\":null,\"email\":\"superadmin@gmail.com\",\"invoice_slug\":\"SUP\",\"phone\":\"01739898764\",\"shop_id\":null,\"package_id\":1,\"refer_id\":\"Sup00001\",\"password\":\"$2y$10$jQHiF2GIXJDf689zHk2SPezDnLYv.NVEPw93e9YeY0vs53dG\\/ky8m\",\"image\":\"not-found.webp\",\"account_expire_date\":null,\"last_login\":\"2023-11-12 08:47:39\",\"created_user_id\":1,\"updated_user_id\":1,\"email_verified_at\":null,\"ip_address\":\"101.2.160.0\",\"admin_employee_status\":1,\"lock\":0,\"otp\":null,\"status\":1,\"deleted_at\":null,\"remember_token\":null,\"created_at\":\"2023-11-12T02:45:37.000000Z\",\"updated_at\":\"2023-11-12T02:47:39.000000Z\"},\"old\":{\"id\":1,\"name\":\"Superadmin\",\"user_type\":\"Superadmin\",\"admin_id\":null,\"email\":\"superadmin@gmail.com\",\"invoice_slug\":\"SUP\",\"phone\":\"01739898764\",\"shop_id\":null,\"package_id\":1,\"refer_id\":\"Sup00001\",\"password\":\"$2y$10$jQHiF2GIXJDf689zHk2SPezDnLYv.NVEPw93e9YeY0vs53dG\\/ky8m\",\"image\":\"not-found.webp\",\"account_expire_date\":null,\"last_login\":null,\"created_user_id\":1,\"updated_user_id\":1,\"email_verified_at\":null,\"ip_address\":\"101.2.160.0\",\"admin_employee_status\":1,\"lock\":0,\"otp\":null,\"status\":1,\"deleted_at\":null,\"remember_token\":null,\"created_at\":\"2023-11-12T02:45:37.000000Z\",\"updated_at\":\"2023-11-12T02:45:37.000000Z\"}}', NULL, '2023-11-12 02:47:39', '2023-11-12 02:47:39'),
(3, 'default', 'created', 'App\\Models\\User', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"name\":\"Zahidul Islam\",\"user_type\":\"Admin\",\"admin_id\":null,\"email\":\"admin1234@gmail.com\",\"invoice_slug\":\"SB\",\"phone\":\"01773838967\",\"shop_id\":null,\"package_id\":1,\"refer_id\":\"Zah00001\",\"password\":\"$2y$10$8vGKCbggrBi9hApr01YVQuTqBGRtP\\/veE0rY\\/DyNX4K1T68i1WJvu\",\"image\":\"https:\\/\\/shop.sohibd.com\\/storage\\/files\\/1\\/profile\\/71758.jpg\",\"account_expire_date\":null,\"last_login\":null,\"created_user_id\":1,\"updated_user_id\":1,\"email_verified_at\":\"2023-11-12T02:49:22.000000Z\",\"ip_address\":\"103.148.178.5\",\"admin_employee_status\":1,\"lock\":0,\"otp\":null,\"status\":1,\"deleted_at\":null,\"remember_token\":null,\"created_at\":\"2023-11-12T02:49:22.000000Z\",\"updated_at\":\"2023-11-12T02:49:22.000000Z\"}}', NULL, '2023-11-12 02:49:22', '2023-11-12 02:49:22'),
(4, 'default', 'created', 'App\\Models\\Product', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"brand_id\":4,\"product_name\":\"Badam\",\"barcode\":\"796046585\",\"unit\":\"KG\",\"rack_number\":\"10\",\"weight_size\":\"1\",\"made_in\":\"BANGLADESH\",\"product_full_name\":\"Badam 1 KG ( Pran )\",\"slug\":\"badam-1-kg-pran\",\"sku\":\"BAD1KG\",\"purchase_price\":60,\"average_price\":60,\"sale_price\":10,\"vat\":0,\"discount\":0,\"old_discount\":0,\"path\":\"storage\\/files\\/shares\\/uploads\\/2\",\"photo\":\"badam65503e3094e49.png\",\"expire_date\":\"2023-11-16\",\"category_id\":83,\"sub_category_id\":null,\"created_user_id\":2,\"updated_user_id\":2,\"low_quantity\":1,\"description\":\"<p>dfsfsadfds<\\/p>\",\"status\":1,\"deleted_at\":null,\"created_at\":\"12 Nov 2023 02 : 11\",\"updated_at\":\"2023-11-12T02:53:36.000000Z\"}}', NULL, '2023-11-12 02:53:36', '2023-11-12 02:53:36'),
(5, 'default', 'created', 'App\\Models\\Product', 'created', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"brand_id\":1,\"product_name\":\"Badam\",\"barcode\":\"761287950\",\"unit\":\"KG\",\"rack_number\":\"10\",\"weight_size\":\"1\",\"made_in\":\"BANGLADESH\",\"product_full_name\":\"Badam 1 KG ( Bombe )\",\"slug\":\"badam-1-kg-bombe\",\"sku\":\"BAD1KG\",\"purchase_price\":60,\"average_price\":60,\"sale_price\":10,\"vat\":0,\"discount\":0,\"old_discount\":0,\"path\":\"storage\\/files\\/shares\\/backend\",\"photo\":\"not_found.webp\",\"expire_date\":\"2023-11-16\",\"category_id\":83,\"sub_category_id\":null,\"created_user_id\":2,\"updated_user_id\":2,\"low_quantity\":1,\"description\":\"<p>dfsfsadfds<\\/p>\",\"status\":1,\"deleted_at\":null,\"created_at\":\"12 Nov 2023 02 : 11\",\"updated_at\":\"2023-11-12T02:54:27.000000Z\"}}', NULL, '2023-11-12 02:54:27', '2023-11-12 02:54:27'),
(6, 'default', 'created', 'App\\Models\\Product', 'created', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"admin_id\":2,\"employee_id\":null,\"brand_id\":5,\"product_name\":\"Badam\",\"barcode\":\"835627488\",\"unit\":\"KG\",\"rack_number\":\"10\",\"weight_size\":\"1\",\"made_in\":\"BANGLADESH\",\"product_full_name\":\"Badam 1 KG ( Bosundhora )\",\"slug\":\"badam-1-kg-bosundhora\",\"sku\":\"BAD1KG\",\"purchase_price\":60,\"average_price\":60,\"sale_price\":10,\"vat\":0,\"discount\":0,\"old_discount\":0,\"path\":\"storage\\/files\\/shares\\/backend\",\"photo\":\"not_found.webp\",\"expire_date\":\"2023-11-16\",\"category_id\":83,\"sub_category_id\":null,\"created_user_id\":2,\"updated_user_id\":2,\"low_quantity\":1,\"description\":\"<p>dfsfsadfds<\\/p>\",\"status\":1,\"deleted_at\":null,\"created_at\":\"12 Nov 2023 02 : 11\",\"updated_at\":\"2023-11-12T02:54:44.000000Z\"}}', NULL, '2023-11-12 02:54:44', '2023-11-12 02:54:44'),
(7, 'default', 'created', 'App\\Models\\Purchase', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000001\",\"reference\":null,\"shop_id\":1,\"supplier_id\":1,\"type\":\"Direct\",\"requisition_id\":null,\"date\":\"2023-11-12\",\"total_vat\":0,\"total_discount\":0,\"total_quantity\":1,\"extra_discount_percent\":0,\"sub_total\":60,\"payment_method\":\"Cash\",\"paid\":0,\"due\":60,\"grand_total\":60,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"12th November, 2023, 02:55 am\",\"updated_at\":\"2023-11-12T02:55:45.000000Z\"}}', NULL, '2023-11-12 02:55:45', '2023-11-12 02:55:45'),
(8, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000001\",\"purchase_id\":1,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":0,\"due\":60,\"note\":\"Purchase Invoice\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:55 am\",\"updated_at\":\"2023-11-12T02:55:45.000000Z\"}}', NULL, '2023-11-12 02:55:45', '2023-11-12 02:55:45'),
(9, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000002\",\"purchase_id\":null,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":50,\"due\":0,\"note\":\"dfgdga\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:56 am\",\"updated_at\":\"2023-11-12T02:56:09.000000Z\"}}', NULL, '2023-11-12 02:56:09', '2023-11-12 02:56:09'),
(10, 'default', 'updated', 'App\\Models\\SupplierDue', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000002\",\"purchase_id\":null,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":60,\"due\":0,\"note\":\"dfgdga\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:56 am\",\"updated_at\":\"2023-11-12T02:56:26.000000Z\"},\"old\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000002\",\"purchase_id\":null,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":50,\"due\":0,\"note\":\"dfgdga\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:56 am\",\"updated_at\":\"2023-11-12T02:56:09.000000Z\"}}', NULL, '2023-11-12 02:56:26', '2023-11-12 02:56:26'),
(11, 'default', 'created', 'App\\Models\\PurchaseReturn', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000001\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0,\"total_discount\":0,\"sub_total\":60,\"payment_method\":\"Cash\",\"paid\":60,\"due\":0,\"grand_total\":60,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T02:57:15.000000Z\",\"updated_at\":\"2023-11-12T02:57:15.000000Z\"}}', NULL, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(12, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000003\",\"purchase_id\":null,\"purchase_return_id\":1,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":60,\"due\":0,\"note\":\"Purchase Return Invoice\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:57 am\",\"updated_at\":\"2023-11-12T02:57:15.000000Z\"}}', NULL, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(13, 'default', 'updated', 'App\\Models\\PurchaseReturn', 'updated', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000001\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0,\"total_discount\":0,\"sub_total\":60,\"payment_method\":\"Cash\",\"paid\":60,\"due\":0,\"grand_total\":60,\"return_quantity\":1,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T02:57:15.000000Z\",\"updated_at\":\"2023-11-12T02:57:15.000000Z\"},\"old\":{\"id\":1,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000001\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0,\"total_discount\":0,\"sub_total\":60,\"payment_method\":\"Cash\",\"paid\":60,\"due\":0,\"grand_total\":60,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T02:57:15.000000Z\",\"updated_at\":\"2023-11-12T02:57:15.000000Z\"}}', NULL, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(14, 'default', 'created', 'App\\Models\\Product', 'created', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":4,\"admin_id\":2,\"employee_id\":null,\"brand_id\":2,\"product_name\":\"lichu\",\"barcode\":\"921900590\",\"unit\":\"PCS\",\"rack_number\":\"10\",\"weight_size\":\"1\",\"made_in\":\"BANGLADESH\",\"product_full_name\":\"lichu 1 PCS ( Amrto )\",\"slug\":\"lichu-1-pcs-amrto\",\"sku\":\"LIC1PC\",\"purchase_price\":4,\"average_price\":4,\"sale_price\":5,\"vat\":5,\"discount\":0,\"old_discount\":0,\"path\":\"storage\\/files\\/shares\\/backend\",\"photo\":\"not_found.webp\",\"expire_date\":\"2023-11-16\",\"category_id\":83,\"sub_category_id\":null,\"created_user_id\":2,\"updated_user_id\":2,\"low_quantity\":1,\"description\":\"<p>dfsfsadfds<\\/p>\",\"status\":1,\"deleted_at\":null,\"created_at\":\"12 Nov 2023 02 : 11\",\"updated_at\":\"2023-11-12T02:58:13.000000Z\"}}', NULL, '2023-11-12 02:58:13', '2023-11-12 02:58:13'),
(15, 'default', 'created', 'App\\Models\\Purchase', 'created', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000002\",\"reference\":null,\"shop_id\":1,\"supplier_id\":1,\"type\":\"Direct\",\"requisition_id\":null,\"date\":\"2023-11-12\",\"total_vat\":0.40000000000000002220446049250313080847263336181640625,\"total_discount\":0,\"total_quantity\":2,\"extra_discount_percent\":0,\"sub_total\":8,\"payment_method\":\"Cash\",\"paid\":0,\"due\":8.4000000000000003552713678800500929355621337890625,\"grand_total\":8.4000000000000003552713678800500929355621337890625,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"12th November, 2023, 02:59 am\",\"updated_at\":\"2023-11-12T02:59:12.000000Z\"}}', NULL, '2023-11-12 02:59:12', '2023-11-12 02:59:12'),
(16, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":4,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000004\",\"purchase_id\":2,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":0,\"due\":8,\"note\":\"Purchase Invoice\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 02:59 am\",\"updated_at\":\"2023-11-12T02:59:12.000000Z\"}}', NULL, '2023-11-12 02:59:12', '2023-11-12 02:59:12'),
(17, 'default', 'created', 'App\\Models\\PurchaseReturn', 'created', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000002\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0.40000000000000002220446049250313080847263336181640625,\"total_discount\":0,\"sub_total\":7.5999999999999996447286321199499070644378662109375,\"payment_method\":\"Cash\",\"paid\":7.5999999999999996447286321199499070644378662109375,\"due\":0,\"grand_total\":8,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T03:00:08.000000Z\",\"updated_at\":\"2023-11-12T03:00:08.000000Z\"}}', NULL, '2023-11-12 03:00:08', '2023-11-12 03:00:08'),
(18, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 5, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":5,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000005\",\"purchase_id\":null,\"purchase_return_id\":2,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":7.5999999999999996447286321199499070644378662109375,\"due\":0,\"note\":\"Purchase Return Invoice\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 03:00 am\",\"updated_at\":\"2023-11-12T03:00:08.000000Z\"}}', NULL, '2023-11-12 03:00:08', '2023-11-12 03:00:08'),
(19, 'default', 'updated', 'App\\Models\\PurchaseReturn', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000002\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0.40000000000000002220446049250313080847263336181640625,\"total_discount\":0,\"sub_total\":7.5999999999999996447286321199499070644378662109375,\"payment_method\":\"Cash\",\"paid\":7.5999999999999996447286321199499070644378662109375,\"due\":0,\"grand_total\":8,\"return_quantity\":2,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T03:00:08.000000Z\",\"updated_at\":\"2023-11-12T03:00:08.000000Z\"},\"old\":{\"id\":2,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000002\",\"shop_id\":1,\"supplier_id\":1,\"date\":\"2023-11-12\",\"total_vat\":0.40000000000000002220446049250313080847263336181640625,\"total_discount\":0,\"sub_total\":7.5999999999999996447286321199499070644378662109375,\"payment_method\":\"Cash\",\"paid\":7.5999999999999996447286321199499070644378662109375,\"due\":0,\"grand_total\":8,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"2023-11-12T03:00:08.000000Z\",\"updated_at\":\"2023-11-12T03:00:08.000000Z\"}}', NULL, '2023-11-12 03:00:08', '2023-11-12 03:00:08'),
(20, 'default', 'created', 'App\\Models\\Purchase', 'created', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"admin_id\":2,\"employee_id\":null,\"invoice_no\":\"SB000003\",\"reference\":null,\"shop_id\":1,\"supplier_id\":1,\"type\":\"Direct\",\"requisition_id\":null,\"date\":\"2023-11-12\",\"total_vat\":0.40000000000000002220446049250313080847263336181640625,\"total_discount\":0,\"total_quantity\":2,\"extra_discount_percent\":0,\"sub_total\":8,\"payment_method\":\"Cash\",\"paid\":8,\"due\":0.40000000000000002220446049250313080847263336181640625,\"grand_total\":8.4000000000000003552713678800500929355621337890625,\"return_quantity\":0,\"created_user_id\":2,\"updated_user_id\":2,\"description\":null,\"status\":1,\"deleted_at\":null,\"created_at\":\"12th November, 2023, 03:03 am\",\"updated_at\":\"2023-11-12T03:03:26.000000Z\"}}', NULL, '2023-11-12 03:03:26', '2023-11-12 03:03:26'),
(21, 'default', 'created', 'App\\Models\\SupplierDue', 'created', 6, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":6,\"admin_id\":2,\"employee_id\":null,\"supplier_id\":1,\"invoice_no\":\"SB000006\",\"purchase_id\":3,\"purchase_return_id\":null,\"payment_method\":\"Cash\",\"bank_name\":null,\"bank_account_number\":null,\"phone_number\":null,\"transaction_number\":null,\"paid\":8,\"due\":8,\"note\":\"Purchase Invoice\",\"created_user_id\":2,\"updated_user_id\":2,\"created_at\":\"12th November, 2023, 03:03 am\",\"updated_at\":\"2023-11-12T03:03:26.000000Z\"}}', NULL, '2023-11-12 03:03:26', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_user_id` bigint(20) NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `admin_id`, `employee_id`, `brand_name`, `slug`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Bombe', 'bombe', 2, 2, 1, '2023-11-12 02:49:41', '2023-11-12 02:49:41'),
(2, 2, NULL, 'Amrto', 'amrto', 2, 2, 1, '2023-11-12 02:49:46', '2023-11-12 02:49:46'),
(3, 2, NULL, 'Reem Food', 'reem-food', 2, 2, 1, '2023-11-12 02:49:50', '2023-11-12 02:49:50'),
(4, 2, NULL, 'Pran', 'pran', 2, 2, 1, '2023-11-12 02:49:54', '2023-11-12 02:49:54'),
(5, 2, NULL, 'Bosundhora', 'bosundhora', 2, 2, 1, '2023-11-12 02:49:59', '2023-11-12 02:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `superadmin_id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SOAP', 'soap', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(2, 1, 'SHAMPOO', 'shampoo', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(3, 1, 'CHOCOLATE', 'chocolate', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(4, 1, 'CONDITIONER', 'conditioner', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(5, 1, 'RICE', 'rice', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(6, 1, 'FOOD SUPPLIMENT', 'food-suppliment', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(7, 1, 'CAKE', 'cake', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(8, 1, 'BISCUITS', 'biscuits', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(9, 1, 'PEANUTS', 'peanuts', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(10, 1, 'TOOTHPASTE', 'toothpaste', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(11, 1, 'TOOTHBRUSH', 'toothbrush', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(12, 1, 'FACEWASH MEN', 'facewash-men', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(13, 1, 'FACEWASH WOMEN', 'facewash-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(14, 1, 'BODY SPRAY MEN', 'body-spray-men', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(15, 1, 'BODY SPRAY WOMEN', 'body-spray-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(16, 1, 'LOTION', 'lotion', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(17, 1, 'CREAM MEN', 'cream-men', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(18, 1, 'CREAM WOMEN', 'cream-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(19, 1, 'AIR FRESHENER', 'air-freshener', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(20, 1, 'HAIR OIL MEN', 'hair-oil-men', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(21, 1, 'HAIR OIL WOMEN', 'hair-oil-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(22, 1, 'TOILET CLEANER', 'toilet-cleaner', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(23, 1, 'PERFUME MEN', 'perfume-men', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(24, 1, 'PERFUME WOMEN', 'perfume-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(25, 1, 'DISH WASH', 'dish-wash', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(26, 1, 'FABRIC WASH', 'fabric-wash', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(27, 1, 'FLOOR CLEANER', 'floor-cleaner', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(28, 1, 'GLASS CLEANER', 'glass-cleaner', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(29, 1, 'HAND WASH', 'hand-wash', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(30, 1, 'BABY ITEMS', 'baby-items', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(31, 1, 'HAIR SERUM', 'hair-serum', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(32, 1, 'SKIN SERUM', 'skin-serum', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(33, 1, 'HAIR GEL WOMEN', 'hair-gel-women', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(34, 1, 'HAIR GEL MEN', 'hair-gel-men', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(35, 1, 'HAIR COLOR', 'hair-color', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(36, 1, 'SHOWER GEL', 'shower-gel', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(37, 1, 'SANITARY PAD', 'sanitary-pad', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(38, 1, 'ADULT DIAPER', 'adult-diaper', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(39, 1, 'HAIR REMOVER', 'hair-remover', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(40, 1, 'SHAVING ITEM', 'shaving-item', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(41, 1, 'OLIVE OIL', 'olive-oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(42, 1, 'MAKE UP ITEMS', 'make-up-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(43, 1, 'TALCOM POWDER', 'talcom-powder', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(44, 1, 'FACE POWDER', 'face-powder', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(45, 1, 'TEA ITEMS', 'tea-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(46, 1, 'DEODORANT', 'deodorant', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(47, 1, 'FOOT CARE', 'foot-care', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(48, 1, 'LIP ITEMS', 'lip-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(49, 1, 'FACIAL ITEMS', 'facial-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(50, 1, 'MEHEDY', 'mehedy', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(51, 1, 'HONEY', 'honey', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(52, 1, 'HERBAL PRODUCTS', 'herbal-products', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(53, 1, 'SOYABIN OIL', 'soyabin-oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(54, 1, 'PALM OIL', 'palm-oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(55, 1, 'SUNFLOWER OIL', 'sunflower-oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(56, 1, 'SUGAR', 'sugar', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(57, 1, 'ATTA', 'atta', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(58, 1, 'FLOUR', 'flour', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(59, 1, 'SUJI', 'suji', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(60, 1, 'SPICES', 'spices', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(61, 1, 'SALT', 'salt', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(62, 1, 'SAUCE', 'sauce', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(63, 1, 'GLYCERIN', 'glycerin', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(64, 1, 'TOOTH POWDER', 'tooth-powder', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(65, 1, 'MOUTHWASH', 'mouthwash', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(66, 1, 'AEROSOL', 'aerosol', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(67, 1, 'COEL', 'coel', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(68, 1, 'MOIDA', 'moida', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(69, 1, 'COLONGE SPRAY', 'colonge-spray', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(70, 1, 'EU DE PERFUME', 'eu-de-perfume', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(71, 1, 'BODY SPRAY', 'body-spray', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(72, 1, 'MINERAL WATER', 'mineral-water', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(73, 1, 'BEVERAGE', 'beverage', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(74, 1, 'MUSTARD OIL', 'mustard-oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(75, 1, 'CAKE SPICES', 'cake-spices', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(76, 1, 'MOTHER CARE', 'mother-care', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(77, 1, 'DRY FOOD', 'dry-food', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(78, 1, 'SOUP', 'soup', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(79, 1, 'NOODLES', 'noodles', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(80, 1, 'COFFEE ITEMS', 'coffee-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(81, 1, 'KOKO CRUNCH', 'koko-crunch', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(82, 1, 'CHANACHUR', 'chanachur', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(83, 1, 'PICKLE', 'pickle', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(84, 1, 'DRY FRUITS', 'dry-fruits', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(85, 1, 'CHIPS', 'chips', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(86, 1, 'SEMAI', 'semai', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(87, 1, 'JUICE', 'juice', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(88, 1, 'MILK ITEMS', 'milk-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(89, 1, 'DAAL', 'daal', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(90, 1, 'TISSUE', 'tissue', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(91, 1, 'OINTMENT', 'ointment', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(92, 1, 'BODY WASH', 'body-wash', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(93, 1, 'KITCHEN ITEMS', 'kitchen-items', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(94, 1, 'STUDY', 'study', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(95, 1, 'TOY', 'toy', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(96, 1, 'BABY CARE', 'baby-care', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(97, 1, 'BAGS', 'bags', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(98, 1, 'GHEE', 'ghee', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(99, 1, 'SUNGLASS', 'sunglass', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(100, 1, 'EWER', 'ewer', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(101, 1, 'WRIST WATCH', 'wrist-watch', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(102, 1, 'JELLY', 'jelly', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(103, 1, 'LIQUID VAPOURER', 'liquid-vapourer', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(104, 1, 'MUM', 'mum', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(105, 1, 'OIL', 'oil', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(106, 1, 'FACE MASK', 'face-mask', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(107, 1, 'BODY POWDER', 'body-powder', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(108, 1, 'ANTISEPTIC', 'antiseptic', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(109, 1, 'UMBRELLA', 'umbrella', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(110, 1, 'JEWELRY BOX', 'jewelry-box', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(111, 1, 'SPICE', 'spice', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(112, 1, 'HOME APPLIANCE', 'home-appliance', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(113, 1, 'GROOMING KIT', 'grooming-kit', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `reply` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_name` varchar(191) DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `superadmin_id`, `country_name`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'BANGLADESH', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(2, 1, 'AFGHANISTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(3, 1, 'ALBANIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(4, 1, 'ALGERIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(5, 1, 'ANDORRA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(6, 1, 'ANGOLA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(7, 1, 'ANGUILLA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(8, 1, 'ANTARCTICA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(9, 1, 'ARGENTINA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(10, 1, 'ARMENIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(11, 1, 'ARUBA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(12, 1, 'AUSTRALIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(13, 1, 'AUSTRIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(14, 1, 'AZERBAIJAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(15, 1, 'BAHAMAS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(16, 1, 'BAHRAIN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(17, 1, 'BARBADOS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(18, 1, 'BELARUS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(19, 1, 'BELGIUM', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(20, 1, 'BELIZE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(21, 1, 'BENIN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(22, 1, 'BERMUDA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(23, 1, 'BHUTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(24, 1, 'BOLIVIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(25, 1, 'BOTSWANA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(26, 1, 'BOUVET ISLAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(27, 1, 'BRAZIL', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(28, 1, 'BULGARIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(29, 1, 'BURKINA FASO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(30, 1, 'BURUNDI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(31, 1, 'CAMBODIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(32, 1, 'CAMEROON', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(33, 1, 'CANADA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(34, 1, 'CHAD', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(35, 1, 'CHILE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(36, 1, 'CHINA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(37, 1, 'COLOMBIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(38, 1, 'COMOROS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(39, 1, 'CONGO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(40, 1, 'CROATIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(41, 1, 'CUBA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(42, 1, 'CYPRUS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(43, 1, 'DENMARK', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(44, 1, 'DJIBOUTI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(45, 1, 'DOMINICA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(46, 1, 'EGYPT', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(47, 1, 'FIJI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(48, 1, 'FINLAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(49, 1, 'FRANCE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(50, 1, 'GABON', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(51, 1, 'GAMBIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(52, 1, 'GEORGIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(53, 1, 'GERMANY', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(54, 1, 'GHANA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(55, 1, 'GIBRALTAR', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(56, 1, 'GREECE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(57, 1, 'GREENLAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(58, 1, 'GRENADA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(59, 1, 'GUADELOUPE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(60, 1, 'GUAM', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(61, 1, 'GUATEMALA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(62, 1, 'GUINEA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(63, 1, 'GUINEA-BISSAU', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(64, 1, 'GUYANA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(65, 1, 'HAITI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(66, 1, 'HONG KONG', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(67, 1, 'HUNGARY', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(68, 1, 'ICELAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(69, 1, 'INDIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(70, 1, 'INDONESIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(71, 1, 'IRAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(72, 1, 'IRAQ', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(73, 1, 'IRELAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(74, 1, 'ISRAEL', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(75, 1, 'ITALY', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(76, 1, 'JAMAICA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(77, 1, 'JAPAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(78, 1, 'JORDAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(79, 1, 'KAZAKSTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(80, 1, 'KENYA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(81, 1, 'KIRIBATI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(82, 1, 'KOREA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(83, 1, 'KUWAIT', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(84, 1, 'KYRGYZSTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(85, 1, 'LATVIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(86, 1, 'LEBANON', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(87, 1, 'LESOTHO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(88, 1, 'LIBERIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(89, 1, 'MALAYSIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(90, 1, 'MALDIVES', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(91, 1, 'MALI', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(92, 1, 'MALTA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(93, 1, 'MEXICO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(94, 1, 'MONACO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(95, 1, 'MONGOLIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(96, 1, 'MONTSERRAT', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(97, 1, 'MOROCCO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(98, 1, 'MOZAMBIQUE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(99, 1, 'MYANMAR', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(100, 1, 'NAMIBIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(101, 1, 'NAURU', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(102, 1, 'NEPAL', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(103, 1, 'NETHERLANDS', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(104, 1, 'NICARAGUA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(105, 1, 'NIGER', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(106, 1, 'NIGERIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(107, 1, 'NIUE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(108, 1, 'NORWAY', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(109, 1, 'OMAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(110, 1, 'PAKISTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(111, 1, 'PALAU', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(112, 1, 'QATAR', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(113, 1, 'REUNION', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(114, 1, 'ROMANIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(115, 1, 'RUSSIAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(116, 1, 'SAUDI ARABIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(117, 1, 'SENEGAL', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(118, 1, 'SEYCHELLES', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(119, 1, 'SIERRA LEONE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(120, 1, 'SINGAPORE', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(121, 1, 'SLOVAKIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(122, 1, 'SLOVENIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(123, 1, 'SOMALIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(124, 1, 'SRI LANKA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(125, 1, 'SWAZILAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(126, 1, 'SWEDEN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(127, 1, 'SWITZERLAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(128, 1, 'TAJIKISTAN', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(129, 1, 'THAILAND', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(130, 1, 'TOGO', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(131, 1, 'TOKELAU', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(132, 1, 'TONGA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(133, 1, 'TUNISIA', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(134, 1, 'TURKEY', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(135, 1, 'TURKMENISTAN', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(136, 1, 'TURKS', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(137, 1, 'TUVALU', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(138, 1, 'UGANDA', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(139, 1, 'UKRAINE', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(140, 1, 'ARAB EMIRATES', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(141, 1, 'UNITED KINGDOM', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(142, 1, 'UNITED STATES', 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(191) NOT NULL,
  `card_number` varchar(191) NOT NULL,
  `customer_phone` varchar(191) DEFAULT NULL,
  `customer_email` varchar(191) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `discount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_due` double(30,2) NOT NULL DEFAULT 0.00,
  `total_paid` double(30,2) NOT NULL DEFAULT 0.00,
  `total_balance` double(30,2) NOT NULL DEFAULT 0.00,
  `birth_date` date DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `admin_id`, `employee_id`, `customer_name`, `card_number`, `customer_phone`, `customer_email`, `address`, `discount`, `total_due`, `total_paid`, `total_balance`, `birth_date`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Ridwan', 'SB0000000001', '01773515225', 'test@gmail.com', 'Natore', 0.00, 0.00, 0.00, 0.00, NULL, 2, 2, 1, '2023-11-12 02:51:29', '2023-11-12 02:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer_dues`
--

CREATE TABLE `customer_dues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `bank_account_number` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `transaction_number` varchar(191) DEFAULT NULL,
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `note` varchar(350) DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damage_products`
--

CREATE TABLE `damage_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT 0.00,
  `total_damage_stock` double(16,2) NOT NULL DEFAULT 0.00,
  `grand_total` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damage_product_details`
--

CREATE TABLE `damage_product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `damage_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_expire_date` date DEFAULT NULL,
  `qty` double(16,2) NOT NULL,
  `purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_price` double(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `databackups`
--

CREATE TABLE `databackups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `backup_date` date NOT NULL,
  `file_size` varchar(191) NOT NULL,
  `file_path` varchar(350) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `superadmin_id`, `discount`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(2, 1, 1.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(3, 1, 2.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(4, 1, 3.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(5, 1, 4.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(6, 1, 5.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(7, 1, 6.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(8, 1, 7.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(9, 1, 8.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(10, 1, 9.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(11, 1, 10.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(12, 1, 11.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(13, 1, 12.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(14, 1, 13.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(15, 1, 14.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(16, 1, 15.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(17, 1, 16.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(18, 1, 17.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(19, 1, 18.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(20, 1, 19.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(21, 1, 20.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(22, 1, 21.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(23, 1, 22.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(24, 1, 23.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(25, 1, 24.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(26, 1, 25.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(27, 1, 26.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(28, 1, 27.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(29, 1, 28.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(30, 1, 29.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(31, 1, 30.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(32, 1, 31.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(33, 1, 32.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(34, 1, 33.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(35, 1, 34.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(36, 1, 35.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(37, 1, 36.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(38, 1, 37.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(39, 1, 38.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(40, 1, 39.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(41, 1, 40.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(42, 1, 41.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(43, 1, 42.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(44, 1, 43.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(45, 1, 44.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(46, 1, 45.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(47, 1, 46.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(48, 1, 47.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(49, 1, 48.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(50, 1, 49.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(51, 1, 50.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(52, 1, 51.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(53, 1, 52.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(54, 1, 53.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(55, 1, 54.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(56, 1, 55.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(57, 1, 56.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(58, 1, 57.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(59, 1, 58.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(60, 1, 59.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(61, 1, 60.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(62, 1, 61.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(63, 1, 62.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(64, 1, 63.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(65, 1, 64.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(66, 1, 65.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(67, 1, 66.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(68, 1, 67.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(69, 1, 68.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(70, 1, 69.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(71, 1, 70.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(72, 1, 71.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(73, 1, 72.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(74, 1, 73.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(75, 1, 74.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(76, 1, 75.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(77, 1, 76.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(78, 1, 77.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(79, 1, 78.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(80, 1, 79.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(81, 1, 80.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(82, 1, 81.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(83, 1, 82.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(84, 1, 83.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(85, 1, 84.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(86, 1, 85.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(87, 1, 86.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(88, 1, 87.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(89, 1, 88.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(90, 1, 89.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(91, 1, 90.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(92, 1, 91.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(93, 1, 92.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(94, 1, 93.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(95, 1, 94.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(96, 1, 95.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(97, 1, 96.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(98, 1, 97.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(99, 1, 98.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(100, 1, 99.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(101, 1, 100.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expense_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expense_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `bank_account_number` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `transaction_number` varchar(191) DEFAULT NULL,
  `path` varchar(191) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expense_name` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `superadmin_id`, `expense_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'House Rent', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(2, 1, 'Transform', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(3, 1, 'Guest', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(4, 1, 'Net Bill', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39'),
(5, 1, 'Other', 1, '2023-11-12 02:45:39', '2023-11-12 02:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"3596adbe-197f-49ff-a61b-6f2602f7af1b\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:36:\\\"Hi Superadmin . Your Last Login  At \\\";}s:2:\\\"id\\\";s:36:\\\"4914aed3-9119-4502-9f8a-39de0b2801b5\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1699757259, 1699757259);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(423, '2014_10_12_000000_create_users_table', 1),
(424, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(425, '2014_10_12_100000_create_password_resets_table', 1),
(426, '2019_08_19_000000_create_failed_jobs_table', 1),
(427, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(428, '2021_01_16_173440_create_contacts_table', 1),
(429, '2022_05_09_073243_create_permission_tables', 1),
(430, '2023_01_23_062218_create_jobs_table', 1),
(431, '2023_01_23_062235_create_notifications_table', 1),
(432, '2023_01_24_084018_create_settings_table', 1),
(433, '2023_01_24_084046_create_sliders_table', 1),
(434, '2023_01_24_084255_create_profiles_table', 1),
(435, '2023_02_17_172425_create_payments_table', 1),
(436, '2023_02_17_174833_create_packages_table', 1),
(437, '2023_02_17_181754_create_wallets_table', 1),
(438, '2023_03_10_084317_create_pages_table', 1),
(439, '2023_03_17_054013_create_brands_table', 1),
(440, '2023_03_17_084849_create_units_table', 1),
(441, '2023_03_17_155948_create_countries_table', 1),
(442, '2023_03_17_183549_create_categories_table', 1),
(443, '2023_03_17_190438_create_shops_table', 1),
(444, '2023_03_17_192445_create_sub_categories_table', 1),
(445, '2023_03_17_195621_create_vats_table', 1),
(446, '2023_03_17_205636_create_discounts_table', 1),
(447, '2023_03_18_070420_create_products_table', 1),
(448, '2023_04_02_154859_create_suppliers_table', 1),
(449, '2023_04_03_025618_create_purchases_table', 1),
(450, '2023_04_06_053635_create_databackups_table', 1),
(451, '2023_04_12_012516_create_supplier_dues_table', 1),
(452, '2023_04_12_012553_create_customers_table', 1),
(453, '2023_04_12_012559_create_customer_dues_table', 1),
(454, '2023_04_24_154348_create_purchase_details_table', 1),
(455, '2023_05_29_172037_create_activity_log_table', 1),
(456, '2023_05_29_172038_add_event_column_to_activity_log_table', 1),
(457, '2023_05_29_172039_add_batch_uuid_column_to_activity_log_table', 1),
(458, '2023_07_15_162110_create_shop_current_stocks_table', 1),
(459, '2023_09_09_092610_create_sales_table', 1),
(460, '2023_09_10_084608_create_sale_details_table', 1),
(461, '2023_09_29_150355_create_setups_table', 1),
(462, '2023_10_03_080320_create_purchase_returns_table', 1),
(463, '2023_10_03_080332_create_purchase_return_details_table', 1),
(464, '2023_10_03_081036_create_sale_returns_table', 1),
(465, '2023_10_03_081051_create_sale_return_details_table', 1),
(466, '2023_10_09_084032_create_stock_adjustments_table', 1),
(467, '2023_10_09_084047_create_stock_adjustment_details_table', 1),
(468, '2023_10_14_090212_create_product_discounts_table', 1),
(469, '2023_10_16_235148_create_damage_products_table', 1),
(470, '2023_10_16_235202_create_damage_product_details_table', 1),
(471, '2023_10_21_083637_create_stock_transfers_table', 1),
(472, '2023_10_21_083646_create_stock_transfer_details_table', 1),
(473, '2023_10_21_203743_create_expense_heads_table', 1),
(474, '2023_10_21_204539_create_expenses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `price` double(16,2) DEFAULT NULL,
  `employee_manage` int(11) NOT NULL DEFAULT 1,
  `shop` int(11) NOT NULL DEFAULT 1,
  `duration` int(11) NOT NULL DEFAULT 30,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `superadmin_id`, `package_name`, `slug`, `price`, `employee_manage`, `shop`, `duration`, `features`, `description`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 'small', 2.00, 1, 1, 30, '[\"Unlimited Product Upload\"]', 'Unlimited Product Upload', 1, 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `page_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` varchar(191) DEFAULT NULL,
  `json_screma` varchar(5000) DEFAULT NULL,
  `keyword` varchar(500) DEFAULT NULL,
  `header_description` mediumtext DEFAULT NULL,
  `footer_description` mediumtext DEFAULT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'default.png',
  `view` int(11) NOT NULL DEFAULT 0,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_name` varchar(191) NOT NULL DEFAULT 'Cash',
  `image` varchar(350) NOT NULL DEFAULT 'not-found.webp',
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `superadmin_id`, `payment_name`, `image`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash', 'not-found.webp', 1, 1, 1, NULL, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(2, 1, 'Bkash', 'not-found.webp', 1, 1, 1, NULL, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(3, 1, 'Bank', 'not-found.webp', 1, 1, 1, NULL, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(4, 1, 'Other', 'not-found.webp', 1, 1, 1, NULL, '2023-11-12 02:45:38', '2023-11-12 02:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'barcode-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(2, 'barcode-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(3, 'barcode-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(4, 'barcode-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(5, 'brand-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(6, 'brand-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(7, 'brand-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(8, 'brand-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(9, 'customer-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(10, 'customer-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(11, 'customer-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(12, 'customer-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(13, 'customer-due-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(14, 'customer-due-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(15, 'customer-due-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(16, 'customer-due-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(17, 'damage-product-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(18, 'damage-product-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(19, 'damage-product-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(20, 'damage-product-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(21, 'employee-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(22, 'employee-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(23, 'employee-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(24, 'employee-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(25, 'expense-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(26, 'expense-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(27, 'expense-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(28, 'expense-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(29, 'product-exchange-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(30, 'product-exchange-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(31, 'product-exchange-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(32, 'product-exchange-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(33, 'product-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(34, 'product-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(35, 'product-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(36, 'product-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(37, 'product-discount-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(38, 'product-discount-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(39, 'product-discount-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(40, 'product-discount-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(41, 'stock-transfer-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(42, 'stock-transfer-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(43, 'stock-transfer-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(44, 'stock-transfer-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(45, 'purchase-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(46, 'purchase-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(47, 'purchase-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(48, 'purchase-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(49, 'purchase-return-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(50, 'purchase-return-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(51, 'purchase-return-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(52, 'purchase-return-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(53, 'role-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(54, 'role-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(55, 'role-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(56, 'role-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(57, 'shop-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(58, 'shop-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(59, 'shop-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(60, 'shop-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(61, 'shop-current-stock-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(62, 'shop-current-stock-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(63, 'shop-current-stock-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(64, 'shop-current-stock-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(65, 'supplier-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(66, 'supplier-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(67, 'supplier-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(68, 'supplier-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(69, 'supplier-due-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(70, 'supplier-due-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(71, 'supplier-due-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(72, 'supplier-due-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(73, 'sale-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(74, 'sale-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(75, 'sale-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(76, 'sale-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(77, 'sale-return-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(78, 'sale-return-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(79, 'sale-return-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(80, 'sale-return-delete', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(81, 'stock-adjustment-list', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(82, 'stock-adjustment-create', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(83, 'stock-adjustment-edit', 'web', '2023-11-12 02:45:36', '2023-11-12 02:45:36'),
(84, 'stock-adjustment-delete', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(85, 'user-list', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(86, 'user-create', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(87, 'user-edit', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(88, 'user-delete', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(89, 'product-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(90, 'purchase-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(91, 'sale-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(92, 'transfer-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(93, 'damage-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(94, 'expense-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(95, 'damage-product-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(96, 'purchase-return-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(97, 'sale-return-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(98, 'supplier-due-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(99, 'customer-due-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(100, 'activity-report', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `unit` enum('PCS','CARTON','KG','GM','PACKET','ML','DZN','BOX','BAG','PACKAGE','TRAY','EACH','CTN','ROFTA','TIN') NOT NULL DEFAULT 'PCS',
  `rack_number` varchar(191) DEFAULT NULL,
  `weight_size` varchar(191) DEFAULT NULL,
  `made_in` varchar(191) NOT NULL DEFAULT 'Bangladesh',
  `product_full_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `average_price` double(16,2) NOT NULL DEFAULT 0.00,
  `sale_price` double(16,2) NOT NULL DEFAULT 0.00,
  `vat` double(10,2) NOT NULL DEFAULT 0.00,
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `old_discount` double(10,2) NOT NULL DEFAULT 0.00,
  `path` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `low_quantity` int(11) NOT NULL DEFAULT 0,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `employee_id`, `brand_id`, `product_name`, `barcode`, `unit`, `rack_number`, `weight_size`, `made_in`, `product_full_name`, `slug`, `sku`, `purchase_price`, `average_price`, `sale_price`, `vat`, `discount`, `old_discount`, `path`, `photo`, `expire_date`, `category_id`, `sub_category_id`, `created_user_id`, `updated_user_id`, `low_quantity`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 4, 'Badam', '796046585', 'KG', '10', '1', 'BANGLADESH', 'Badam 1 KG ( Pran )', 'badam-1-kg-pran', 'BAD1KG', 60.00, 60.00, 10.00, 0.00, 0.00, 0.00, 'storage/files/shares/uploads/2', 'badam65503e3094e49.png', '2023-11-16', 83, NULL, 2, 2, 1, '<p>dfsfsadfds</p>', 1, NULL, '2023-11-12 02:53:36', '2023-11-12 02:53:36'),
(2, 2, NULL, 1, 'Badam', '761287950', 'KG', '10', '1', 'BANGLADESH', 'Badam 1 KG ( Bombe )', 'badam-1-kg-bombe', 'BAD1KG', 60.00, 60.00, 10.00, 0.00, 0.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', '2023-11-16', 83, NULL, 2, 2, 1, '<p>dfsfsadfds</p>', 1, NULL, '2023-11-12 02:54:27', '2023-11-12 02:54:27'),
(3, 2, NULL, 5, 'Badam', '835627488', 'KG', '10', '1', 'BANGLADESH', 'Badam 1 KG ( Bosundhora )', 'badam-1-kg-bosundhora', 'BAD1KG', 60.00, 60.00, 10.00, 0.00, 0.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', '2023-11-16', 83, NULL, 2, 2, 1, '<p>dfsfsadfds</p>', 1, NULL, '2023-11-12 02:54:44', '2023-11-12 02:54:44'),
(4, 2, NULL, 2, 'lichu', '921900590', 'PCS', '10', '1', 'BANGLADESH', 'lichu 1 PCS ( Amrto )', 'lichu-1-pcs-amrto', 'LIC1PC', 4.00, 4.00, 5.00, 5.00, 0.00, 0.00, 'storage/files/shares/backend', 'not_found.webp', '2023-11-16', 83, NULL, 2, 2, 1, '<p>dfsfsadfds</p>', 1, NULL, '2023-11-12 02:58:13', '2023-11-12 02:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `product_new_discount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL DEFAULT 'Male',
  `refer_code` varchar(191) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `package_start_date` date NOT NULL DEFAULT '2023-11-12',
  `package_end_date` date DEFAULT NULL,
  `country` varchar(191) NOT NULL DEFAULT 'Bangladesh',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `position`, `gender`, `refer_code`, `rating`, `comment`, `package_start_date`, `package_end_date`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Male', 'shop2023', NULL, NULL, '2023-11-12', NULL, 'Bangladesh', '2023-11-12 02:45:37', '2023-11-12 02:45:37'),
(2, 2, NULL, 'Male', '33', NULL, NULL, '2023-11-12', '2023-12-12', 'Bangladesh', '2023-11-12 02:49:22', '2023-11-12 02:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('Direct','Requisition') NOT NULL DEFAULT 'Direct',
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT 0.00,
  `total_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_quantity` double(16,2) NOT NULL DEFAULT 0.00,
  `extra_discount_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(16,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `grand_total` double(16,2) NOT NULL DEFAULT 0.00,
  `return_quantity` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `admin_id`, `employee_id`, `invoice_no`, `reference`, `shop_id`, `supplier_id`, `type`, `requisition_id`, `date`, `total_vat`, `total_discount`, `total_quantity`, `extra_discount_percent`, `sub_total`, `payment_method`, `paid`, `due`, `grand_total`, `return_quantity`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'SB000001', NULL, 1, 1, 'Direct', NULL, '2023-11-12', 0.00, 0.00, 1.00, 0.00, 60.00, 'Cash', 0.00, 60.00, 60.00, 0.00, 2, 2, NULL, 1, NULL, '2023-11-12 02:55:45', '2023-11-12 02:55:45'),
(2, 2, NULL, 'SB000002', NULL, 1, 1, 'Direct', NULL, '2023-11-12', 0.40, 0.00, 2.00, 0.00, 8.00, 'Cash', 0.00, 8.40, 8.40, 0.00, 2, 2, NULL, 1, NULL, '2023-11-12 02:59:12', '2023-11-12 02:59:12'),
(3, 2, NULL, 'SB000003', NULL, 1, 1, 'Direct', NULL, '2023-11-12', 0.40, 0.00, 2.00, 0.00, 8.00, 'Cash', 8.00, 0.40, 8.40, 0.00, 2, 2, NULL, 1, NULL, '2023-11-12 03:03:26', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `qty` double(16,2) NOT NULL,
  `already_return_qty` double(16,2) NOT NULL DEFAULT 0.00,
  `average_purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_price` double(16,2) NOT NULL DEFAULT 0.00,
  `product_expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `admin_id`, `product_id`, `product_name`, `qty`, `already_return_qty`, `average_purchase_price`, `purchase_price`, `vat_percent`, `vat_amount`, `total_price`, `product_expire_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 'Badam 1 KG ( Bosundhora ) (835627488)', 1.00, 1.00, 60.00, 60.00, 0.00, 0.00, 60.00, '2023-11-16', '2023-11-12 02:55:45', '2023-11-12 02:57:15'),
(2, 2, 2, 4, 'lichu 1 PCS ( Amrto ) (921900590)', 2.00, 2.00, 4.00, 4.00, 5.00, 0.40, 8.00, '2023-11-16', '2023-11-12 02:59:12', '2023-11-12 03:00:08'),
(3, 3, 2, 4, 'lichu 1 PCS ( Amrto ) (921900590)', 2.00, 0.00, 4.00, 4.00, 5.00, 0.40, 8.00, '2023-11-16', '2023-11-12 03:03:26', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT 0.00,
  `total_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(16,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `grand_total` double(16,2) NOT NULL DEFAULT 0.00,
  `return_quantity` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `admin_id`, `employee_id`, `invoice_no`, `shop_id`, `supplier_id`, `date`, `total_vat`, `total_discount`, `sub_total`, `payment_method`, `paid`, `due`, `grand_total`, `return_quantity`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'SB000001', 1, 1, '2023-11-12', 0.00, 0.00, 60.00, 'Cash', 60.00, 0.00, 60.00, 1.00, 2, 2, NULL, 1, NULL, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(2, 2, NULL, 'SB000002', 1, 1, '2023-11-12', 0.40, 0.00, 7.60, 'Cash', 7.60, 0.00, 8.00, 2.00, 2, 2, NULL, 1, NULL, '2023-11-12 03:00:08', '2023-11-12 03:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `return_qty` double(16,2) NOT NULL DEFAULT 0.00,
  `purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_price` double(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_return_details`
--

INSERT INTO `purchase_return_details` (`id`, `purchase_return_id`, `admin_id`, `product_id`, `product_name`, `return_qty`, `purchase_price`, `vat_percent`, `vat_amount`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 'Badam 1 KG ( Bosundhora ) (835627488)', 1.00, 60.00, 0.00, 0.00, 60.00, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(2, 2, 2, 4, 'lichu 1 PCS ( Amrto ) (921900590)', 2.00, 4.00, 5.00, 0.40, 8.00, '2023-11-12 03:00:08', '2023-11-12 03:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `admin_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin1', 'web', '2023-11-12 02:45:37', '2023-11-12 02:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
(98, 1),
(99, 1),
(100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT 0.00,
  `discount` double(16,2) NOT NULL DEFAULT 0.00,
  `other_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `sub_total` double(16,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `pay_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `change_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `extra_discount_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `total_loss_profit_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_quantity` double(16,2) NOT NULL DEFAULT 0.00,
  `grand_total` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `qty` double(16,2) NOT NULL,
  `already_return_qty` double(16,2) NOT NULL DEFAULT 0.00,
  `average_purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `sale_price` double(16,2) NOT NULL DEFAULT 0.00,
  `loss_profit_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `discount_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `discount_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_price` double(16,2) NOT NULL DEFAULT 0.00,
  `product_expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT 0.00,
  `discount` double(16,2) NOT NULL DEFAULT 0.00,
  `other_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `return_quantity` double(16,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) NOT NULL DEFAULT 'Cash',
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `grand_total` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_details`
--

CREATE TABLE `sale_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `return_qty` double(16,2) NOT NULL DEFAULT 0.00,
  `sale_price` double(16,2) NOT NULL DEFAULT 0.00,
  `loss_profit_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `vat_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `discount_percent` double(16,2) NOT NULL DEFAULT 0.00,
  `discount_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `total_price` double(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `project_name` varchar(191) DEFAULT NULL,
  `website_name` varchar(500) DEFAULT NULL,
  `website_title` varchar(500) DEFAULT NULL,
  `refer_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `address` varchar(500) DEFAULT NULL,
  `currency_name` varchar(30) DEFAULT NULL,
  `currency_symbole` varchar(30) DEFAULT NULL,
  `bin_number` varchar(191) DEFAULT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `print_headline` varchar(300) DEFAULT NULL,
  `print_message` varchar(191) DEFAULT NULL,
  `printing_logo` varchar(300) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `favicon` varchar(300) NOT NULL DEFAULT 'default.png',
  `logo` varchar(500) NOT NULL DEFAULT 'default.png',
  `background_image` varchar(500) NOT NULL DEFAULT 'default.png',
  `facebook` varchar(300) DEFAULT NULL,
  `youtube` varchar(300) DEFAULT NULL,
  `twitter` varchar(300) DEFAULT NULL,
  `instagram` varchar(300) DEFAULT NULL,
  `created_user_id` bigint(20) NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `superadmin_id`, `company_name`, `project_name`, `website_name`, `website_title`, `refer_amount`, `address`, `currency_name`, `currency_symbole`, `bin_number`, `vat_number`, `print_headline`, `print_message`, `printing_logo`, `phone`, `email`, `favicon`, `logo`, `background_image`, `facebook`, `youtube`, `twitter`, `instagram`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'SohiBD Soft LTD', 'Shop Management', 'Shop Sohibd', 'Shop Sohibd software', 500.00, '30 Commercial Road Mirpur, Dhaka', 'BDT', '৳', '125487456545552', '12548', 'Shop POS  Software', 'Thanks to use Shop Management software', 'printlogo.jpg', '(281) 809-0090', 'info@sohibd.com', 'uploads/setting/default.png', 'uploads/setting/default.png', 'default.png', '#', '#', '#', '#', 1, 1, '2023-11-12 02:45:37', '2023-11-12 02:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `setups`
--

CREATE TABLE `setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `owner_name` varchar(191) DEFAULT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `company_logo` varchar(191) DEFAULT NULL,
  `default_shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `default_brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `default_unit` varchar(50) DEFAULT NULL,
  `default_vat` double NOT NULL DEFAULT 0,
  `default_discount` double NOT NULL DEFAULT 0,
  `default_supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `default_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sms_user` varchar(191) NOT NULL DEFAULT 'zahidul1994',
  `sms_password` varchar(191) NOT NULL DEFAULT 'zahid22932044',
  `sms_rate` double(8,2) NOT NULL DEFAULT 0.25,
  `sms_type` enum('Masking','Non-Masking') NOT NULL DEFAULT 'Non-Masking',
  `sms_status` tinyint(4) NOT NULL DEFAULT 0,
  `sms_text` varchar(300) NOT NULL DEFAULT 'Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#',
  `currency_name` varchar(20) NOT NULL DEFAULT 'BDT',
  `currency_icon` varchar(16) NOT NULL DEFAULT '৳',
  `bin_number` varchar(50) DEFAULT NULL,
  `vat_number` varchar(30) DEFAULT NULL,
  `printing_logo` varchar(300) DEFAULT NULL,
  `print_first_note` varchar(191) NOT NULL DEFAULT 'You cannot exchange any product',
  `print_second_note` varchar(191) NOT NULL DEFAULT 'Thank For Shopping',
  `office_phone` varchar(50) DEFAULT NULL,
  `office_email` varchar(191) DEFAULT NULL,
  `company_address` varchar(300) DEFAULT NULL,
  `facebook` varchar(300) DEFAULT NULL,
  `youtube` varchar(300) DEFAULT NULL,
  `twitter` varchar(300) DEFAULT NULL,
  `instagram` varchar(300) DEFAULT NULL,
  `web_address` varchar(400) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setups`
--

INSERT INTO `setups` (`id`, `admin_id`, `owner_name`, `company_name`, `company_logo`, `default_shop_id`, `default_brand_id`, `default_unit`, `default_vat`, `default_discount`, `default_supplier_id`, `default_customer_id`, `sms_user`, `sms_password`, `sms_rate`, `sms_type`, `sms_status`, `sms_text`, `currency_name`, `currency_icon`, `bin_number`, `vat_number`, `printing_logo`, `print_first_note`, `print_second_note`, `office_phone`, `office_email`, `company_address`, `facebook`, `youtube`, `twitter`, `instagram`, `web_address`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'SohiBD', 'https://shop.sohibd.com/storage/files/1/profile/71758.jpg', 1, 4, 'PCS', 0, 0, 1, 1, 'zahidul1994', 'zahid22932044', 0.25, 'Non-Masking', 0, 'Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#', 'BDT', '৳', '12548', '555424', 'https://shop.sohibd.com/storage/files/1/profile/71758.jpg', 'You cannot exchange any product', 'Thank For Shopping', '01773838967', 'admin1234@gmail.com', 'Natoer Bangladesh', NULL, NULL, NULL, NULL, 'sohibd.com', NULL, '2023-11-12 02:49:22', '2023-11-12 02:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `shop_phone` varchar(191) DEFAULT NULL,
  `shop_email` varchar(191) DEFAULT NULL,
  `shop_address` varchar(400) DEFAULT NULL,
  `created_user_id` bigint(20) NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `admin_id`, `shop_name`, `slug`, `shop_phone`, `shop_email`, `shop_address`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sohi Shop', 'sohi-shop', '01739898764', 'mjahid1990@gmail.com', 'Natore', 2, 2, 1, NULL, '2023-11-12 02:50:37', '2023-11-12 02:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `shop_current_stocks`
--

CREATE TABLE `shop_current_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `last_purchase_price` double(16,2) NOT NULL DEFAULT 0.00,
  `last_sale_price` double(16,2) NOT NULL DEFAULT 0.00,
  `last_purchase_discount` double(16,2) NOT NULL DEFAULT 0.00,
  `last_purchase_vat` double(10,2) NOT NULL DEFAULT 0.00,
  `stock_qty` double(16,2) NOT NULL DEFAULT 0.00,
  `old_discount` double(10,2) NOT NULL DEFAULT 0.00,
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_current_stocks`
--

INSERT INTO `shop_current_stocks` (`id`, `admin_id`, `shop_id`, `product_id`, `product_name`, `sku`, `barcode`, `last_purchase_price`, `last_sale_price`, `last_purchase_discount`, `last_purchase_vat`, `stock_qty`, `old_discount`, `discount`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 'Badam', 'BAD1KG', '835627488', 60.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2023-11-16', 1, '2023-11-12 02:55:45', '2023-11-12 02:57:15'),
(2, 2, 1, 4, 'lichu', 'LIC1PC', '921900590', 4.00, 5.00, 0.00, 5.00, 2.00, 0.00, 0.00, '2023-11-16', 1, '2023-11-12 02:59:12', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link_text` varchar(100) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'default.png',
  `created_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `total_previous_stock` double(30,2) NOT NULL DEFAULT 0.00,
  `total_current_stock` double(30,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_details`
--

CREATE TABLE `stock_adjustment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_adjustment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `previous_qty` double(16,2) NOT NULL,
  `current_qty` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `total_stock` double(16,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) NOT NULL,
  `updated_user_id` bigint(20) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer_details`
--

CREATE TABLE `stock_transfer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_transfer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `current_stock_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_name` varchar(191) NOT NULL,
  `supplier_phone` varchar(191) DEFAULT NULL,
  `supplier_email` varchar(191) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `total_due` double(30,2) NOT NULL DEFAULT 0.00,
  `total_paid` double(30,2) NOT NULL DEFAULT 0.00,
  `total_balance` double(30,2) NOT NULL DEFAULT 0.00,
  `description` mediumtext DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `admin_id`, `employee_id`, `supplier_name`, `supplier_phone`, `supplier_email`, `address`, `total_due`, `total_paid`, `total_balance`, `description`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Abdus Salam', '01708380243', 'supplier@gmail.com', 'Natore', 8.40, 68.00, -59.60, NULL, 2, 2, 1, '2023-11-12 02:51:08', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_dues`
--

CREATE TABLE `supplier_dues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `bank_account_number` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `transaction_number` varchar(191) DEFAULT NULL,
  `paid` double(16,2) NOT NULL DEFAULT 0.00,
  `due` double(16,2) NOT NULL DEFAULT 0.00,
  `note` varchar(350) DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_dues`
--

INSERT INTO `supplier_dues` (`id`, `admin_id`, `employee_id`, `supplier_id`, `invoice_no`, `purchase_id`, `purchase_return_id`, `payment_method`, `bank_name`, `bank_account_number`, `phone_number`, `transaction_number`, `paid`, `due`, `note`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'SB000001', 1, NULL, 'Cash', NULL, NULL, NULL, NULL, 0.00, 60.00, 'Purchase Invoice', 2, 2, '2023-11-12 02:55:45', '2023-11-12 02:55:45'),
(2, 2, NULL, 1, 'SB000002', NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, 60.00, 0.00, 'dfgdga', 2, 2, '2023-11-12 02:56:09', '2023-11-12 02:56:26'),
(3, 2, NULL, 1, 'SB000003', NULL, 1, 'Cash', NULL, NULL, NULL, NULL, 60.00, 0.00, 'Purchase Return Invoice', 2, 2, '2023-11-12 02:57:15', '2023-11-12 02:57:15'),
(4, 2, NULL, 1, 'SB000004', 2, NULL, 'Cash', NULL, NULL, NULL, NULL, 0.00, 8.00, 'Purchase Invoice', 2, 2, '2023-11-12 02:59:12', '2023-11-12 02:59:12'),
(5, 2, NULL, 1, 'SB000005', NULL, 2, 'Cash', NULL, NULL, NULL, NULL, 7.60, 0.00, 'Purchase Return Invoice', 2, 2, '2023-11-12 03:00:08', '2023-11-12 03:00:08'),
(6, 2, NULL, 1, 'SB000006', 3, NULL, 'Cash', NULL, NULL, NULL, NULL, 8.00, 8.00, 'Purchase Invoice', 2, 2, '2023-11-12 03:03:26', '2023-11-12 03:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_name` varchar(191) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `superadmin_id`, `unit_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'PCS', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(2, 1, 'CARTON', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(3, 1, 'KG', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(4, 1, 'GM', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(5, 1, 'PACKET', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(6, 1, 'ML', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(7, 1, 'DZN', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(8, 1, 'BOX', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(9, 1, 'BAG', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(10, 1, 'PACKAGE', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(11, 1, 'TRAY', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(12, 1, 'EACH', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(13, 1, 'CTN', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(14, 1, 'ROFTA', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(15, 1, 'TIN', 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `user_type` enum('Superadmin','Admin','Employee','Staff') NOT NULL DEFAULT 'Admin',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `invoice_slug` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `refer_id` varchar(30) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'not-found.webp',
  `account_expire_date` date DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_user_id` bigint(20) NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '101.2.160.0',
  `admin_employee_status` tinyint(4) NOT NULL DEFAULT 1,
  `lock` tinyint(4) NOT NULL DEFAULT 0,
  `otp` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `admin_id`, `email`, `invoice_slug`, `phone`, `shop_id`, `package_id`, `refer_id`, `password`, `image`, `account_expire_date`, `last_login`, `created_user_id`, `updated_user_id`, `email_verified_at`, `ip_address`, `admin_employee_status`, `lock`, `otp`, `status`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'Superadmin', NULL, 'superadmin@gmail.com', 'SUP', '01739898764', NULL, 1, 'Sup00001', '$2y$10$jQHiF2GIXJDf689zHk2SPezDnLYv.NVEPw93e9YeY0vs53dG/ky8m', 'not-found.webp', NULL, '2023-11-12 02:47:39', 1, 1, NULL, '101.2.160.0', 1, 0, NULL, 1, NULL, NULL, '2023-11-12 02:45:37', '2023-11-12 02:47:39'),
(2, 'Zahidul Islam', 'Admin', NULL, 'admin1234@gmail.com', 'SB', '01773838967', NULL, 1, 'Zah00001', '$2y$10$8vGKCbggrBi9hApr01YVQuTqBGRtP/veE0rY/DyNX4K1T68i1WJvu', 'https://shop.sohibd.com/storage/files/1/profile/71758.jpg', NULL, NULL, 1, 1, '2023-11-12 02:49:22', '103.148.178.5', 1, 0, NULL, 1, NULL, NULL, '2023-11-12 02:49:22', '2023-11-12 02:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vat` double(10,2) NOT NULL DEFAULT 0.00,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vats`
--

INSERT INTO `vats` (`id`, `superadmin_id`, `vat`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(2, 1, 1.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(3, 1, 2.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(4, 1, 3.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(5, 1, 4.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(6, 1, 5.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(7, 1, 6.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(8, 1, 7.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(9, 1, 8.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(10, 1, 9.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(11, 1, 10.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(12, 1, 11.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(13, 1, 12.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(14, 1, 13.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(15, 1, 14.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(16, 1, 15.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(17, 1, 16.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(18, 1, 17.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(19, 1, 18.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(20, 1, 19.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(21, 1, 20.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(22, 1, 21.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(23, 1, 22.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(24, 1, 23.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(25, 1, 24.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(26, 1, 25.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(27, 1, 26.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(28, 1, 27.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(29, 1, 28.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(30, 1, 29.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(31, 1, 30.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(32, 1, 31.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(33, 1, 32.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(34, 1, 33.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(35, 1, 34.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(36, 1, 35.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(37, 1, 36.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(38, 1, 37.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(39, 1, 38.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(40, 1, 39.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(41, 1, 40.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(42, 1, 41.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(43, 1, 42.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(44, 1, 43.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(45, 1, 44.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(46, 1, 45.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(47, 1, 46.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(48, 1, 47.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(49, 1, 48.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(50, 1, 49.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(51, 1, 50.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(52, 1, 51.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(53, 1, 52.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(54, 1, 53.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(55, 1, 54.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(56, 1, 55.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(57, 1, 56.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(58, 1, 57.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(59, 1, 58.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(60, 1, 59.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(61, 1, 60.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(62, 1, 61.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(63, 1, 62.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(64, 1, 63.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(65, 1, 64.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(66, 1, 65.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(67, 1, 66.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(68, 1, 67.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(69, 1, 68.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(70, 1, 69.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(71, 1, 70.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(72, 1, 71.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(73, 1, 72.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(74, 1, 73.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(75, 1, 74.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(76, 1, 75.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(77, 1, 76.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(78, 1, 77.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(79, 1, 78.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(80, 1, 79.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(81, 1, 80.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(82, 1, 81.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(83, 1, 82.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(84, 1, 83.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(85, 1, 84.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(86, 1, 85.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(87, 1, 86.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(88, 1, 87.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(89, 1, 88.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(90, 1, 89.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(91, 1, 90.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(92, 1, 91.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(93, 1, 92.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(94, 1, 93.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(95, 1, 94.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(96, 1, 95.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(97, 1, 96.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(98, 1, 97.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(99, 1, 98.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(100, 1, 99.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38'),
(101, 1, 100.00, 1, 1, 1, '2023-11-12 02:45:38', '2023-11-12 02:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `debit` double(16,4) NOT NULL DEFAULT 0.0000,
  `credit` double(16,4) NOT NULL DEFAULT 0.0000,
  `type` enum('reffer','commission','join','payment','withdraw','renew','receive','sms','other') DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_dues`
--
ALTER TABLE `customer_dues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_products`
--
ALTER TABLE `damage_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_product_details`
--
ALTER TABLE `damage_product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databackups`
--
ALTER TABLE `databackups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setups`
--
ALTER TABLE `setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_current_stocks`
--
ALTER TABLE `shop_current_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer_details`
--
ALTER TABLE `stock_transfer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
