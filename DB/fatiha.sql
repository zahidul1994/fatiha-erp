-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2024 at 11:17 AM
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
-- Database: `fatiha`
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

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\User', 'created', 1, NULL, NULL, '{\"attributes\": {\"id\": 1, \"otp\": null, \"lock\": 0, \"name\": \"Superadmin\", \"email\": \"superadmin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898764\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm\", \"refer_id\": \"Sup00001\", \"user_type\": \"Superadmin\", \"created_at\": \"2023-12-30T06:21:13.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": null, \"package_id\": 1, \"updated_at\": \"2023-12-30T06:21:13.000000Z\", \"invoice_slug\": \"SUP\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2023-12-30 06:21:13', '2023-12-30 06:21:13'),
(2, 'default', 'created', 'App\\Models\\User', 'created', 2, NULL, NULL, '{\"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": null, \"package_id\": 1, \"updated_at\": \"2023-12-30T06:21:14.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2023-12-30 06:21:14', '2023-12-30 06:21:14'),
(3, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": null, \"package_id\": 1, \"updated_at\": \"2023-12-30T06:21:14.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2023-12-30 21:12:35\", \"package_id\": 1, \"updated_at\": \"2023-12-30T15:12:35.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2023-12-30 15:12:35', '2023-12-30 15:12:35'),
(4, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"id\": 1, \"otp\": null, \"lock\": 0, \"name\": \"Superadmin\", \"email\": \"superadmin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898764\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm\", \"refer_id\": \"Sup00001\", \"user_type\": \"Superadmin\", \"created_at\": \"2023-12-30T06:21:13.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": null, \"package_id\": 1, \"updated_at\": \"2023-12-30T06:21:13.000000Z\", \"invoice_slug\": \"SUP\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 1, \"otp\": null, \"lock\": 0, \"name\": \"Superadmin\", \"email\": \"superadmin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898764\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm\", \"refer_id\": \"Sup00001\", \"user_type\": \"Superadmin\", \"created_at\": \"2023-12-30T06:21:13.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2023-12-31 21:49:42\", \"package_id\": 1, \"updated_at\": \"2023-12-31T15:49:42.000000Z\", \"invoice_slug\": \"SUP\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2023-12-31 15:49:42', '2023-12-31 15:49:42'),
(5, 'default', 'created', 'App\\Models\\Product', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\": {\"at\": 1, \"cd\": 1, \"id\": 1, \"rd\": 1, \"sd\": 1, \"ait\": 1, \"atv\": 1, \"sku\": \"TES1BO\", \"vat\": 1, \"path\": \"storage/files/shares/uploads/2\", \"slug\": \"tesat-1-box-test-product\", \"unit\": \"BOX\", \"photo\": \"tesat65919088bea91.jpg\", \"status\": 1, \"hs_code\": \"382130543534526\", \"made_in\": \"AFGHANISTAN\", \"admin_id\": 2, \"at_value\": 1.77, \"brand_id\": 1, \"cd_value\": 1.73, \"discount\": 1, \"lc_value\": 170, \"rd_value\": 1.73, \"sd_value\": 1.77, \"ait_value\": 1.73, \"atv_value\": 1.77, \"vat_value\": 1.77, \"created_at\": \"31 Dec 2023 16 : 12\", \"deleted_at\": null, \"govt_price\": 1.36, \"other_cost\": 1, \"sale_price\": 250, \"total_duty\": 7, \"unit_price\": 1.36, \"updated_at\": \"2023-12-31T16:02:16.000000Z\", \"bank_charge\": 1, \"cd_rd_total\": 176.87, \"description\": \"<p>d fasdf ds f</p>\", \"employee_id\": null, \"expire_date\": \"2023-12-23\", \"rack_number\": null, \"weight_size\": \"1\", \"convert_rate\": 125, \"low_quantity\": 0, \"old_discount\": 0, \"product_name\": \"tesat\", \"average_price\": 188.48, \"carrying_value\": 0, \"clearing_after\": 1, \"purchase_price\": 188.48, \"carrying_charge\": 0, \"clearing_before\": 1, \"created_user_id\": 2, \"insurance_after\": 1, \"updated_user_id\": 2, \"insurance_before\": 1, \"bank_charge_value\": 1.73, \"product_full_name\": \"tesat 1 BOX ( test product )\", \"clearing_after_value\": 1.73, \"clearing_before_value\": 0.01, \"duty_assessment_value\": 173.4, \"insurance_after_value\": 1.73, \"insurance_before_value\": 0.01}}', NULL, '2023-12-31 16:02:16', '2023-12-31 16:02:16'),
(6, 'default', 'created', 'App\\Models\\Product', 'created', 2, 'App\\Models\\User', 2, '{\"attributes\": {\"at\": 1, \"cd\": 1, \"id\": 2, \"rd\": 1, \"sd\": 1, \"ait\": 1, \"atv\": 1, \"sku\": \"TES1BO\", \"vat\": 1, \"path\": \"storage/files/shares/backend\", \"slug\": \"tesat-1-box-iglu\", \"unit\": \"BOX\", \"photo\": \"not_found.webp\", \"status\": 1, \"hs_code\": \"934718719\", \"made_in\": \"AFGHANISTAN\", \"admin_id\": 2, \"at_value\": 1.77, \"brand_id\": 2, \"cd_value\": 1.73, \"discount\": 1, \"lc_value\": 170, \"rd_value\": 1.73, \"sd_value\": 1.77, \"ait_value\": 1.73, \"atv_value\": 1.77, \"vat_value\": 1.77, \"created_at\": \"31 Dec 2023 16 : 12\", \"deleted_at\": null, \"govt_price\": 1.36, \"other_cost\": 1, \"sale_price\": 250, \"total_duty\": 7, \"unit_price\": 1.36, \"updated_at\": \"2023-12-31T16:02:31.000000Z\", \"bank_charge\": 1, \"cd_rd_total\": 176.87, \"description\": \"<p>d fasdf ds f</p>\", \"employee_id\": null, \"expire_date\": \"2023-12-23\", \"rack_number\": null, \"weight_size\": \"1\", \"convert_rate\": 125, \"low_quantity\": 0, \"old_discount\": 0, \"product_name\": \"tesat\", \"average_price\": 188.48, \"carrying_value\": 0, \"clearing_after\": 1, \"purchase_price\": 188.48, \"carrying_charge\": 0, \"clearing_before\": 1, \"created_user_id\": 2, \"insurance_after\": 1, \"updated_user_id\": 2, \"insurance_before\": 1, \"bank_charge_value\": 1.73, \"product_full_name\": \"tesat 1 BOX ( iglu )\", \"clearing_after_value\": 1.73, \"clearing_before_value\": 0.01, \"duty_assessment_value\": 173.4, \"insurance_after_value\": 1.73, \"insurance_before_value\": 0.01}}', NULL, '2023-12-31 16:02:31', '2023-12-31 16:02:31'),
(7, 'default', 'updated', 'App\\Models\\Product', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"at\": 1, \"cd\": 1, \"id\": 2, \"rd\": 1, \"sd\": 1, \"ait\": 1, \"atv\": 1, \"sku\": \"TES1BO\", \"vat\": 1, \"path\": \"storage/files/shares/backend\", \"slug\": \"tesat-1-box-iglu\", \"unit\": \"BOX\", \"photo\": \"not_found.webp\", \"status\": 1, \"hs_code\": \"934718719\", \"made_in\": \"AFGHANISTAN\", \"admin_id\": 2, \"at_value\": 1.77, \"brand_id\": 2, \"cd_value\": 1.73, \"discount\": 1, \"lc_value\": 170, \"rd_value\": 1.73, \"sd_value\": 1.77, \"ait_value\": 1.73, \"atv_value\": 1.77, \"vat_value\": 1.77, \"created_at\": \"31 Dec 2023 16 : 12\", \"deleted_at\": null, \"govt_price\": 1.36, \"other_cost\": 1, \"sale_price\": 250, \"total_duty\": 7, \"unit_price\": 1.36, \"updated_at\": \"2023-12-31T16:02:31.000000Z\", \"bank_charge\": 1, \"cd_rd_total\": 176.87, \"description\": \"<p>d fasdf ds f</p>\", \"employee_id\": null, \"expire_date\": \"2023-12-23\", \"rack_number\": null, \"weight_size\": \"1\", \"convert_rate\": 125, \"low_quantity\": 0, \"old_discount\": 0, \"product_name\": \"tesat\", \"average_price\": 188.48, \"carrying_value\": 0, \"clearing_after\": 1, \"purchase_price\": 188.48, \"carrying_charge\": 0, \"clearing_before\": 1, \"created_user_id\": 2, \"insurance_after\": 1, \"updated_user_id\": 2, \"insurance_before\": 1, \"bank_charge_value\": 1.73, \"product_full_name\": \"tesat 1 BOX ( iglu )\", \"clearing_after_value\": 1.73, \"clearing_before_value\": 0.01, \"duty_assessment_value\": 173.4, \"insurance_after_value\": 1.73, \"insurance_before_value\": 0.01}, \"attributes\": {\"at\": 1, \"cd\": 1, \"id\": 2, \"rd\": 1, \"sd\": 1, \"ait\": 1, \"atv\": 1, \"sku\": \"TES1BO\", \"vat\": 1, \"path\": \"storage/files/shares/uploads/2\", \"slug\": \"tesat-1-box-iglu\", \"unit\": \"BOX\", \"photo\": \"tesat659190a724965.jpg\", \"status\": 1, \"hs_code\": \"934718719\", \"made_in\": \"AFGHANISTAN\", \"admin_id\": 2, \"at_value\": 1.77, \"brand_id\": 2, \"cd_value\": 1.73, \"discount\": 1, \"lc_value\": 170, \"rd_value\": 1.73, \"sd_value\": 1.77, \"ait_value\": 1.73, \"atv_value\": 1.77, \"vat_value\": 1.77, \"created_at\": \"31 Dec 2023 16 : 12\", \"deleted_at\": null, \"govt_price\": 1.36, \"other_cost\": 1, \"sale_price\": 200, \"total_duty\": 7, \"unit_price\": 1.36, \"updated_at\": \"2023-12-31T16:02:47.000000Z\", \"bank_charge\": 1, \"cd_rd_total\": 176.87, \"description\": \"<p>d fasdf ds f</p>\", \"employee_id\": null, \"expire_date\": \"2023-12-23\", \"rack_number\": null, \"weight_size\": \"1\", \"convert_rate\": 125, \"low_quantity\": 0, \"old_discount\": 0, \"product_name\": \"tesat\", \"average_price\": 188.48, \"carrying_value\": 0, \"clearing_after\": 1, \"purchase_price\": 188.48, \"carrying_charge\": 0, \"clearing_before\": 1, \"created_user_id\": 2, \"insurance_after\": 1, \"updated_user_id\": 2, \"insurance_before\": 1, \"bank_charge_value\": 1.73, \"product_full_name\": \"tesat 1 BOX ( iglu )\", \"clearing_after_value\": 1.73, \"clearing_before_value\": 0.01, \"duty_assessment_value\": 173.4, \"insurance_after_value\": 1.73, \"insurance_before_value\": 0.01}}', NULL, '2023-12-31 16:02:47', '2023-12-31 16:02:47'),
(8, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2023-12-30 21:12:35\", \"package_id\": 1, \"updated_at\": \"2023-12-30T15:12:35.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-03 00:16:54\", \"package_id\": 1, \"updated_at\": \"2024-01-02T18:16:54.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2024-01-02 18:16:54', '2024-01-02 18:16:54'),
(9, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-03 00:16:54\", \"package_id\": 1, \"updated_at\": \"2024-01-02T18:16:54.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-05 09:13:53\", \"package_id\": 1, \"updated_at\": \"2024-01-05T03:13:53.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2024-01-05 03:13:53', '2024-01-05 03:13:53'),
(10, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-05 09:13:53\", \"package_id\": 1, \"updated_at\": \"2024-01-05T03:13:53.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-05 23:51:25\", \"package_id\": 1, \"updated_at\": \"2024-01-05T17:51:25.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2024-01-05 17:51:26', '2024-01-05 17:51:26'),
(11, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-05 23:51:25\", \"package_id\": 1, \"updated_at\": \"2024-01-05T17:51:25.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-06 09:17:59\", \"package_id\": 1, \"updated_at\": \"2024-01-06T03:17:59.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2024-01-06 03:17:59', '2024-01-06 03:17:59'),
(12, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"id\": 1, \"otp\": null, \"lock\": 0, \"name\": \"Superadmin\", \"email\": \"superadmin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898764\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm\", \"refer_id\": \"Sup00001\", \"user_type\": \"Superadmin\", \"created_at\": \"2023-12-30T06:21:13.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2023-12-31 21:49:42\", \"package_id\": 1, \"updated_at\": \"2023-12-31T15:49:42.000000Z\", \"invoice_slug\": \"SUP\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 1, \"otp\": null, \"lock\": 0, \"name\": \"Superadmin\", \"email\": \"superadmin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898764\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm\", \"refer_id\": \"Sup00001\", \"user_type\": \"Superadmin\", \"created_at\": \"2023-12-30T06:21:13.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-06 10:08:28\", \"package_id\": 1, \"updated_at\": \"2024-01-06T04:08:28.000000Z\", \"invoice_slug\": \"SUP\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}}', NULL, '2024-01-06 04:08:28', '2024-01-06 04:08:28'),
(13, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"101.2.160.0\", \"last_login\": \"2024-01-06 09:17:59\", \"package_id\": 1, \"updated_at\": \"2024-01-06T03:17:59.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": null, \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 09:17:59\", \"package_id\": 1, \"updated_at\": \"2024-01-06T04:08:46.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-06 04:08:46', '2024-01-06 04:08:46'),
(14, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 09:17:59\", \"package_id\": 1, \"updated_at\": \"2024-01-06T04:08:46.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 14:15:26\", \"package_id\": 1, \"updated_at\": \"2024-01-06T08:15:26.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-06 08:15:26', '2024-01-06 08:15:26'),
(15, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 14:15:26\", \"package_id\": 1, \"updated_at\": \"2024-01-06T08:15:26.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 20:44:35\", \"package_id\": 1, \"updated_at\": \"2024-01-06T14:44:35.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-06 14:44:36', '2024-01-06 14:44:36'),
(16, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-06 20:44:35\", \"package_id\": 1, \"updated_at\": \"2024-01-06T14:44:35.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-07 11:39:25\", \"package_id\": 1, \"updated_at\": \"2024-01-07T05:39:25.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-07 05:39:25', '2024-01-07 05:39:25'),
(17, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-07 11:39:25\", \"package_id\": 1, \"updated_at\": \"2024-01-07T05:39:25.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-07 18:38:45\", \"package_id\": 1, \"updated_at\": \"2024-01-07T12:38:45.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-07 12:38:46', '2024-01-07 12:38:46'),
(18, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"old\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-07 18:38:45\", \"package_id\": 1, \"updated_at\": \"2024-01-07T12:38:45.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}, \"attributes\": {\"id\": 2, \"otp\": null, \"lock\": 0, \"name\": \"Admin\", \"email\": \"admin@gmail.com\", \"image\": \"not-found.webp\", \"phone\": \"01739898766\", \"status\": 1, \"shop_id\": null, \"admin_id\": null, \"password\": \"$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m\", \"refer_id\": null, \"user_type\": \"Admin\", \"created_at\": \"2023-12-30T06:21:14.000000Z\", \"deleted_at\": null, \"ip_address\": \"127.0.0.1\", \"last_login\": \"2024-01-08 10:58:59\", \"package_id\": 1, \"updated_at\": \"2024-01-08T04:58:59.000000Z\", \"invoice_slug\": \"fat\", \"remember_token\": null, \"created_user_id\": 1, \"updated_user_id\": 1, \"email_verified_at\": null, \"account_expire_date\": \"2024-02-05\", \"admin_employee_status\": 1}}', NULL, '2024-01-08 04:58:59', '2024-01-08 04:58:59');

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
(1, 2, NULL, 'test product', 'test-product', 2, 2, 1, '2023-12-31 16:00:48', '2023-12-31 16:00:48'),
(2, 2, NULL, 'iglu', 'iglu', 2, 2, 1, '2023-12-31 16:00:54', '2023-12-31 16:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `brokers`
--

CREATE TABLE `brokers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `broker_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `broker_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `broker_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` double(30,2) NOT NULL DEFAULT '0.00',
  `total_paid` double(30,2) NOT NULL DEFAULT '0.00',
  `total_balance` double(30,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brokers`
--

INSERT INTO `brokers` (`id`, `admin_id`, `employee_id`, `broker_name`, `card_number`, `broker_phone`, `broker_email`, `address`, `total_due`, `total_paid`, `total_balance`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'zahidul islam', 'fat000000001', '0173987345435', '987345435@gmail.com', 'zahidl', 0.00, 0.00, 0.00, 2, 2, 1, '2023-12-31 16:00:28', '2023-12-31 16:00:28');

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
(1, 1, 'SOAP', 'soap', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(2, 1, 'SHAMPOO', 'shampoo', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(3, 1, 'CHOCOLATE', 'chocolate', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(4, 1, 'CONDITIONER', 'conditioner', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(5, 1, 'RICE', 'rice', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(6, 1, 'FOOD SUPPLIMENT', 'food-suppliment', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(7, 1, 'CAKE', 'cake', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(8, 1, 'BISCUITS', 'biscuits', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(9, 1, 'PEANUTS', 'peanuts', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(10, 1, 'TOOTHPASTE', 'toothpaste', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(11, 1, 'TOOTHBRUSH', 'toothbrush', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(12, 1, 'FACEWASH MEN', 'facewash-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(13, 1, 'FACEWASH WOMEN', 'facewash-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(14, 1, 'BODY SPRAY MEN', 'body-spray-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(15, 1, 'BODY SPRAY WOMEN', 'body-spray-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(16, 1, 'LOTION', 'lotion', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(17, 1, 'CREAM MEN', 'cream-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(18, 1, 'CREAM WOMEN', 'cream-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(19, 1, 'AIR FRESHENER', 'air-freshener', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(20, 1, 'HAIR OIL MEN', 'hair-oil-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(21, 1, 'HAIR OIL WOMEN', 'hair-oil-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(22, 1, 'TOILET CLEANER', 'toilet-cleaner', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(23, 1, 'PERFUME MEN', 'perfume-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(24, 1, 'PERFUME WOMEN', 'perfume-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(25, 1, 'DISH WASH', 'dish-wash', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(26, 1, 'FABRIC WASH', 'fabric-wash', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(27, 1, 'FLOOR CLEANER', 'floor-cleaner', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(28, 1, 'GLASS CLEANER', 'glass-cleaner', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(29, 1, 'HAND WASH', 'hand-wash', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(30, 1, 'BABY ITEMS', 'baby-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(31, 1, 'HAIR SERUM', 'hair-serum', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(32, 1, 'SKIN SERUM', 'skin-serum', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(33, 1, 'HAIR GEL WOMEN', 'hair-gel-women', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(34, 1, 'HAIR GEL MEN', 'hair-gel-men', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(35, 1, 'HAIR COLOR', 'hair-color', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(36, 1, 'SHOWER GEL', 'shower-gel', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(37, 1, 'SANITARY PAD', 'sanitary-pad', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(38, 1, 'ADULT DIAPER', 'adult-diaper', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(39, 1, 'HAIR REMOVER', 'hair-remover', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(40, 1, 'SHAVING ITEM', 'shaving-item', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(41, 1, 'OLIVE OIL', 'olive-oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(42, 1, 'MAKE UP ITEMS', 'make-up-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(43, 1, 'TALCOM POWDER', 'talcom-powder', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(44, 1, 'FACE POWDER', 'face-powder', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(45, 1, 'TEA ITEMS', 'tea-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(46, 1, 'DEODORANT', 'deodorant', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(47, 1, 'FOOT CARE', 'foot-care', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(48, 1, 'LIP ITEMS', 'lip-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(49, 1, 'FACIAL ITEMS', 'facial-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(50, 1, 'MEHEDY', 'mehedy', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(51, 1, 'HONEY', 'honey', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(52, 1, 'HERBAL PRODUCTS', 'herbal-products', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(53, 1, 'SOYABIN OIL', 'soyabin-oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(54, 1, 'PALM OIL', 'palm-oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(55, 1, 'SUNFLOWER OIL', 'sunflower-oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(56, 1, 'SUGAR', 'sugar', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(57, 1, 'ATTA', 'atta', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(58, 1, 'FLOUR', 'flour', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(59, 1, 'SUJI', 'suji', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(60, 1, 'SPICES', 'spices', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(61, 1, 'SALT', 'salt', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(62, 1, 'SAUCE', 'sauce', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(63, 1, 'GLYCERIN', 'glycerin', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(64, 1, 'TOOTH POWDER', 'tooth-powder', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(65, 1, 'MOUTHWASH', 'mouthwash', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(66, 1, 'AEROSOL', 'aerosol', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(67, 1, 'COEL', 'coel', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(68, 1, 'MOIDA', 'moida', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(69, 1, 'COLONGE SPRAY', 'colonge-spray', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(70, 1, 'EU DE PERFUME', 'eu-de-perfume', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(71, 1, 'BODY SPRAY', 'body-spray', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(72, 1, 'MINERAL WATER', 'mineral-water', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(73, 1, 'BEVERAGE', 'beverage', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(74, 1, 'MUSTARD OIL', 'mustard-oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(75, 1, 'CAKE SPICES', 'cake-spices', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(76, 1, 'MOTHER CARE', 'mother-care', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(77, 1, 'DRY FOOD', 'dry-food', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(78, 1, 'SOUP', 'soup', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(79, 1, 'NOODLES', 'noodles', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(80, 1, 'COFFEE ITEMS', 'coffee-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(81, 1, 'KOKO CRUNCH', 'koko-crunch', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(82, 1, 'CHANACHUR', 'chanachur', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(83, 1, 'PICKLE', 'pickle', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(84, 1, 'DRY FRUITS', 'dry-fruits', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(85, 1, 'CHIPS', 'chips', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(86, 1, 'SEMAI', 'semai', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(87, 1, 'JUICE', 'juice', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(88, 1, 'MILK ITEMS', 'milk-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(89, 1, 'DAAL', 'daal', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(90, 1, 'TISSUE', 'tissue', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(91, 1, 'OINTMENT', 'ointment', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(92, 1, 'BODY WASH', 'body-wash', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(93, 1, 'KITCHEN ITEMS', 'kitchen-items', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(94, 1, 'STUDY', 'study', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(95, 1, 'TOY', 'toy', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(96, 1, 'BABY CARE', 'baby-care', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(97, 1, 'BAGS', 'bags', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(98, 1, 'GHEE', 'ghee', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(99, 1, 'SUNGLASS', 'sunglass', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(100, 1, 'EWER', 'ewer', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(101, 1, 'WRIST WATCH', 'wrist-watch', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(102, 1, 'JELLY', 'jelly', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(103, 1, 'LIQUID VAPOURER', 'liquid-vapourer', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(104, 1, 'MUM', 'mum', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(105, 1, 'OIL', 'oil', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(106, 1, 'FACE MASK', 'face-mask', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(107, 1, 'BODY POWDER', 'body-powder', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(108, 1, 'ANTISEPTIC', 'antiseptic', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(109, 1, 'UMBRELLA', 'umbrella', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(110, 1, 'JEWELRY BOX', 'jewelry-box', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(111, 1, 'SPICE', 'spice', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(112, 1, 'HOME APPLIANCE', 'home-appliance', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(113, 1, 'GROOMING KIT', 'grooming-kit', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16');

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
(1, 1, 'BANGLADESH', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(2, 1, 'AFGHANISTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(3, 1, 'ALBANIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(4, 1, 'ALGERIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(5, 1, 'ANDORRA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(6, 1, 'ANGOLA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(7, 1, 'ANGUILLA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(8, 1, 'ANTARCTICA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(9, 1, 'ARGENTINA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(10, 1, 'ARMENIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(11, 1, 'ARUBA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(12, 1, 'AUSTRALIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(13, 1, 'AUSTRIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(14, 1, 'AZERBAIJAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(15, 1, 'BAHAMAS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(16, 1, 'BAHRAIN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(17, 1, 'BARBADOS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(18, 1, 'BELARUS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(19, 1, 'BELGIUM', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(20, 1, 'BELIZE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(21, 1, 'BENIN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(22, 1, 'BERMUDA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(23, 1, 'BHUTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(24, 1, 'BOLIVIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(25, 1, 'BOTSWANA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(26, 1, 'BOUVET ISLAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(27, 1, 'BRAZIL', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(28, 1, 'BULGARIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(29, 1, 'BURKINA FASO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(30, 1, 'BURUNDI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(31, 1, 'CAMBODIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(32, 1, 'CAMEROON', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(33, 1, 'CANADA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(34, 1, 'CHAD', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(35, 1, 'CHILE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(36, 1, 'CHINA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(37, 1, 'COLOMBIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(38, 1, 'COMOROS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(39, 1, 'CONGO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(40, 1, 'CROATIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(41, 1, 'CUBA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(42, 1, 'CYPRUS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(43, 1, 'DENMARK', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(44, 1, 'DJIBOUTI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(45, 1, 'DOMINICA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(46, 1, 'EGYPT', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(47, 1, 'FIJI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(48, 1, 'FINLAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(49, 1, 'FRANCE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(50, 1, 'GABON', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(51, 1, 'GAMBIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(52, 1, 'GEORGIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(53, 1, 'GERMANY', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(54, 1, 'GHANA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(55, 1, 'GIBRALTAR', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(56, 1, 'GREECE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(57, 1, 'GREENLAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(58, 1, 'GRENADA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(59, 1, 'GUADELOUPE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(60, 1, 'GUAM', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(61, 1, 'GUATEMALA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(62, 1, 'GUINEA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(63, 1, 'GUINEA-BISSAU', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(64, 1, 'GUYANA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(65, 1, 'HAITI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(66, 1, 'HONG KONG', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(67, 1, 'HUNGARY', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(68, 1, 'ICELAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(69, 1, 'INDIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(70, 1, 'INDONESIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(71, 1, 'IRAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(72, 1, 'IRAQ', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(73, 1, 'IRELAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(74, 1, 'ISRAEL', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(75, 1, 'ITALY', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(76, 1, 'JAMAICA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(77, 1, 'JAPAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(78, 1, 'JORDAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(79, 1, 'KAZAKSTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(80, 1, 'KENYA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(81, 1, 'KIRIBATI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(82, 1, 'KOREA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(83, 1, 'KUWAIT', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(84, 1, 'KYRGYZSTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(85, 1, 'LATVIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(86, 1, 'LEBANON', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(87, 1, 'LESOTHO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(88, 1, 'LIBERIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(89, 1, 'MALAYSIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(90, 1, 'MALDIVES', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(91, 1, 'MALI', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(92, 1, 'MALTA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(93, 1, 'MEXICO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(94, 1, 'MONACO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(95, 1, 'MONGOLIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(96, 1, 'MONTSERRAT', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(97, 1, 'MOROCCO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(98, 1, 'MOZAMBIQUE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(99, 1, 'MYANMAR', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(100, 1, 'NAMIBIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(101, 1, 'NAURU', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(102, 1, 'NEPAL', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(103, 1, 'NETHERLANDS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(104, 1, 'NICARAGUA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(105, 1, 'NIGER', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(106, 1, 'NIGERIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(107, 1, 'NIUE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(108, 1, 'NORWAY', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(109, 1, 'OMAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(110, 1, 'PAKISTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(111, 1, 'PALAU', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(112, 1, 'QATAR', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(113, 1, 'REUNION', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(114, 1, 'ROMANIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(115, 1, 'RUSSIAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(116, 1, 'SAUDI ARABIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(117, 1, 'SENEGAL', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(118, 1, 'SEYCHELLES', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(119, 1, 'SIERRA LEONE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(120, 1, 'SINGAPORE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(121, 1, 'SLOVAKIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(122, 1, 'SLOVENIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(123, 1, 'SOMALIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(124, 1, 'SRI LANKA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(125, 1, 'SWAZILAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(126, 1, 'SWEDEN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(127, 1, 'SWITZERLAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(128, 1, 'TAJIKISTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(129, 1, 'THAILAND', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(130, 1, 'TOGO', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(131, 1, 'TOKELAU', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(132, 1, 'TONGA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(133, 1, 'TUNISIA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(134, 1, 'TURKEY', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(135, 1, 'TURKMENISTAN', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(136, 1, 'TURKS', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(137, 1, 'TUVALU', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(138, 1, 'UGANDA', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(139, 1, 'UKRAINE', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(140, 1, 'ARAB EMIRATES', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(141, 1, 'UNITED KINGDOM', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(142, 1, 'UNITED STATES', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `currency_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_rate` double(10,2) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `admin_id`, `currency_name`, `currency_symbol`, `currency_rate`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'USD', '$', 90.00, 1, 2, 2, '2023-12-30 16:22:19', '2023-12-31 16:03:56'),
(2, 2, 'NDT', '৳', 1.00, 1, 2, 2, '2023-12-30 16:33:36', '2023-12-31 16:03:13'),
(3, 2, 'Pound', '€', 125.00, 1, 2, 2, '2023-12-31 16:03:44', '2023-12-31 16:03:44');

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
  `bin_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_due` double(30,2) NOT NULL DEFAULT '0.00',
  `total_paid` double(30,2) NOT NULL DEFAULT '0.00',
  `total_balance` double(30,2) NOT NULL DEFAULT '0.00',
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

INSERT INTO `customers` (`id`, `admin_id`, `employee_id`, `customer_name`, `card_number`, `customer_phone`, `customer_email`, `bin_number`, `address`, `discount`, `total_due`, `total_paid`, `total_balance`, `birth_date`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Zahidul islam', 'fat000000001', '017398987644', '017439898764@gmail.com', '43534534', 'adsfasf ds', 0.00, 0.00, 0.00, 0.00, NULL, 2, 2, 1, '2023-12-31 15:58:42', '2023-12-31 15:58:42'),
(2, 2, NULL, 'jara', 'fat000000002', '017398987645', '01739898764@gmail.com', '345345345', 'adfasdfsadf', 0.00, 0.00, 0.00, 0.00, NULL, 2, 2, 1, '2023-12-31 15:59:09', '2023-12-31 15:59:09');

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

-- --------------------------------------------------------

--
-- Table structure for table `damage_product_details`
--

CREATE TABLE `damage_product_details` (
  `id` bigint UNSIGNED NOT NULL,
  `damage_product_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
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
(1, 1, 0.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(2, 1, 1.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(3, 1, 2.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(4, 1, 3.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(5, 1, 4.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(6, 1, 5.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(7, 1, 6.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(8, 1, 7.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(9, 1, 8.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(10, 1, 9.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(11, 1, 10.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(12, 1, 11.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(13, 1, 12.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(14, 1, 13.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(15, 1, 14.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(16, 1, 15.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(17, 1, 16.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(18, 1, 17.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(19, 1, 18.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(20, 1, 19.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(21, 1, 20.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(22, 1, 21.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(23, 1, 22.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(24, 1, 23.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(25, 1, 24.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(26, 1, 25.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(27, 1, 26.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(28, 1, 27.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(29, 1, 28.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(30, 1, 29.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(31, 1, 30.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(32, 1, 31.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(33, 1, 32.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(34, 1, 33.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(35, 1, 34.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(36, 1, 35.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(37, 1, 36.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(38, 1, 37.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(39, 1, 38.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(40, 1, 39.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(41, 1, 40.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(42, 1, 41.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(43, 1, 42.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(44, 1, 43.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(45, 1, 44.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(46, 1, 45.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(47, 1, 46.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(48, 1, 47.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(49, 1, 48.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(50, 1, 49.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(51, 1, 50.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(52, 1, 51.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(53, 1, 52.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(54, 1, 53.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(55, 1, 54.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(56, 1, 55.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(57, 1, 56.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(58, 1, 57.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(59, 1, 58.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(60, 1, 59.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(61, 1, 60.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(62, 1, 61.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(63, 1, 62.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(64, 1, 63.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(65, 1, 64.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(66, 1, 65.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(67, 1, 66.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(68, 1, 67.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(69, 1, 68.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(70, 1, 69.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(71, 1, 70.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(72, 1, 71.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(73, 1, 72.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(74, 1, 73.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(75, 1, 74.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(76, 1, 75.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(77, 1, 76.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(78, 1, 77.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(79, 1, 78.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(80, 1, 79.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(81, 1, 80.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(82, 1, 81.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(83, 1, 82.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(84, 1, 83.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(85, 1, 84.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(86, 1, 85.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(87, 1, 86.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(88, 1, 87.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(89, 1, 88.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(90, 1, 89.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(91, 1, 90.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(92, 1, 91.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(93, 1, 92.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(94, 1, 93.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(95, 1, 94.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(96, 1, 95.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(97, 1, 96.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(98, 1, 97.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(99, 1, 98.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(100, 1, 99.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(101, 1, 100.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16');

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
(1, 1, 'House Rent', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(2, 1, 'Transform', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(3, 1, 'Guest', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(4, 1, 'Net Bill', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(5, 1, 'Other', 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16');

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
(1, 'default', '{\"uuid\":\"91d4d0d2-dc07-44ba-b502-e690397050d6\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:31:\\\"Hi Admin . Your Last Login  At \\\";}s:2:\\\"id\\\";s:36:\\\"dba31a7c-e652-42aa-821d-732de8fff9c5\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1703949155, 1703949155),
(2, 'default', '{\"uuid\":\"b9e355d7-caa7-4bee-8c4e-1dbb51c9fc93\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:36:\\\"Hi Superadmin . Your Last Login  At \\\";}s:2:\\\"id\\\";s:36:\\\"a6c3ea33-3c60-4b05-b911-6b8dc7cced6c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704037782, 1704037782),
(3, 'default', '{\"uuid\":\"7062e7eb-72cf-4a8c-a6c0-0f38b1cea882\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2023-12-30 21:12:35\\\";}s:2:\\\"id\\\";s:36:\\\"f1b6f203-82f7-43ff-a68f-58e3200fee65\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704219414, 1704219414),
(4, 'default', '{\"uuid\":\"d59f8a03-da34-48b3-9980-20580e2a3f8e\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-03 00:16:54\\\";}s:2:\\\"id\\\";s:36:\\\"2e576486-2ba4-4f1d-9dbb-74d84f625bc4\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704424433, 1704424433),
(5, 'default', '{\"uuid\":\"5c0e5c7f-d469-4a38-90a7-363cf83311f4\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-05 09:13:53\\\";}s:2:\\\"id\\\";s:36:\\\"bfd11d22-ef05-4c33-a091-0079768e1c1b\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704477085, 1704477085),
(6, 'default', '{\"uuid\":\"6b9b9b27-2966-4036-83d1-3b154845c7e0\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-05 23:51:25\\\";}s:2:\\\"id\\\";s:36:\\\"78cdcc06-883f-4162-bd60-c4cbba5d0b02\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704511079, 1704511079),
(7, 'default', '{\"uuid\":\"18b4423e-ec85-4e05-91dc-af93bfaafd7e\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:55:\\\"Hi Superadmin . Your Last Login  At 2023-12-31 21:49:42\\\";}s:2:\\\"id\\\";s:36:\\\"1e1c2ede-439b-4012-88fb-b9dfb9a4951e\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704514108, 1704514108),
(8, 'default', '{\"uuid\":\"839dca2f-4a20-4ba3-a1ce-f90826abb64d\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-06 09:17:59\\\";}s:2:\\\"id\\\";s:36:\\\"a33148cf-ebe1-4f6b-807c-e7a3e7ab69cc\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704528926, 1704528926),
(9, 'default', '{\"uuid\":\"922cdeda-a288-434a-9297-e3d3329e1649\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-06 14:15:26\\\";}s:2:\\\"id\\\";s:36:\\\"8b67b782-d114-4c6e-8690-1b07e35b22fd\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704552275, 1704552275),
(10, 'default', '{\"uuid\":\"86b92bf2-71c4-4cbd-bc5f-d58a6da991a2\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-06 20:44:35\\\";}s:2:\\\"id\\\";s:36:\\\"4cced6a0-8034-4d6e-9534-7657200480eb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704605965, 1704605965),
(11, 'default', '{\"uuid\":\"36d37cc4-ed0e-4dfd-9e80-cac03b2547b3\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-07 11:39:25\\\";}s:2:\\\"id\\\";s:36:\\\"0df25bd3-4b83-4ede-a409-2c72f7b9cf92\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704631125, 1704631125),
(12, 'default', '{\"uuid\":\"df8de89c-b6bb-4062-92d8-63f079f55eed\",\"displayName\":\"App\\\\Notifications\\\\Usernotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:34:\\\"App\\\\Notifications\\\\Usernotification\\\":2:{s:40:\\\"\\u0000App\\\\Notifications\\\\Usernotification\\u0000data\\\";a:1:{s:7:\\\"message\\\";s:50:\\\"Hi Admin . Your Last Login  At 2024-01-07 18:38:45\\\";}s:2:\\\"id\\\";s:36:\\\"4a812b5e-b4ed-442e-9bbd-71ce6ec2a179\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1704689939, 1704689939);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_01_16_173440_create_contacts_table', 1),
(7, '2022_05_09_073243_create_permission_tables', 1),
(8, '2023_01_23_062218_create_jobs_table', 1),
(9, '2023_01_23_062235_create_notifications_table', 1),
(10, '2023_01_24_084018_create_settings_table', 1),
(11, '2023_01_24_084046_create_sliders_table', 1),
(12, '2023_01_24_084255_create_profiles_table', 1),
(13, '2023_02_17_172425_create_payments_table', 1),
(14, '2023_02_17_174833_create_packages_table', 1),
(15, '2023_02_17_181754_create_wallets_table', 1),
(16, '2023_03_10_084317_create_pages_table', 1),
(17, '2023_03_16_181114_create_warehouses_table', 1),
(18, '2023_03_17_054013_create_brands_table', 1),
(19, '2023_03_17_084849_create_units_table', 1),
(20, '2023_03_17_155948_create_countries_table', 1),
(21, '2023_03_17_183549_create_categories_table', 1),
(22, '2023_03_17_190438_create_shops_table', 1),
(23, '2023_03_17_192445_create_sub_categories_table', 1),
(24, '2023_03_17_195621_create_vats_table', 1),
(25, '2023_03_17_205636_create_discounts_table', 1),
(26, '2023_03_18_070420_create_products_table', 1),
(28, '2023_04_03_025618_create_purchases_table', 1),
(29, '2023_04_06_053635_create_databackups_table', 1),
(30, '2023_04_11_012553_create_brokers_table', 1),
(31, '2023_04_12_012516_create_supplier_dues_table', 1),
(32, '2023_04_12_012553_create_customers_table', 1),
(33, '2023_04_12_012559_create_customer_dues_table', 1),
(34, '2023_04_24_154348_create_purchase_details_table', 1),
(35, '2023_05_29_172037_create_activity_log_table', 1),
(36, '2023_05_29_172038_add_event_column_to_activity_log_table', 1),
(37, '2023_05_29_172039_add_batch_uuid_column_to_activity_log_table', 1),
(38, '2023_07_15_162110_create_shop_current_stocks_table', 1),
(39, '2023_09_07_092610_create_work_orders_table', 1),
(40, '2023_09_08_092610_create_work_order_details_table', 1),
(41, '2023_09_09_092610_create_sales_table', 1),
(42, '2023_09_10_084608_create_sale_details_table', 1),
(43, '2023_09_29_150355_create_setups_table', 1),
(44, '2023_10_03_080320_create_purchase_returns_table', 1),
(45, '2023_10_03_080332_create_purchase_return_details_table', 1),
(46, '2023_10_03_081036_create_sale_returns_table', 1),
(47, '2023_10_03_081051_create_sale_return_details_table', 1),
(48, '2023_10_09_084032_create_stock_adjustments_table', 1),
(49, '2023_10_09_084047_create_stock_adjustment_details_table', 1),
(50, '2023_10_14_090212_create_product_discounts_table', 1),
(51, '2023_10_16_235148_create_damage_products_table', 1),
(52, '2023_10_16_235202_create_damage_product_details_table', 1),
(53, '2023_10_21_083637_create_stock_transfers_table', 1),
(54, '2023_10_21_083646_create_stock_transfer_details_table', 1),
(55, '2023_10_21_203743_create_expense_heads_table', 1),
(56, '2023_10_21_204539_create_expenses_table', 1),
(57, '2023_11_27_210739_create_prospective_customers_table', 1),
(58, '2023_12_30_210801_create_currencies_table', 2),
(59, '2023_12_30_224700_create_ports_table', 3),
(61, '2023_04_02_154859_create_suppliers_table', 4),
(64, '2024_01_06_110009_create_requisitions_table', 5),
(65, '2024_01_06_110107_create_requisition_details_table', 5);

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
(1, 'App\\Models\\User', 2);

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
(1, 1, 'Small', 'small', 2.00, 1, 1, 30, '[\"Unlimited Product Upload\"]', 'Unlimited Product Upload', 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15');

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
(1, 1, 'Cash', 'not-found.webp', 1, 1, 1, NULL, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(2, 1, 'Bkash', 'not-found.webp', 1, 1, 1, NULL, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(3, 1, 'Bank', 'not-found.webp', 1, 1, 1, NULL, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(4, 1, 'Other', 'not-found.webp', 1, 1, 1, NULL, '2023-12-30 06:21:15', '2023-12-30 06:21:15');

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
(1, 'barcode-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(2, 'barcode-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(3, 'barcode-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(4, 'barcode-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(5, 'broker-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(6, 'broker-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(7, 'broker-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(8, 'broker-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(9, 'brand-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(10, 'brand-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(11, 'brand-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(12, 'brand-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(13, 'customer-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(14, 'customer-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(15, 'customer-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(16, 'customer-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(17, 'customer-due-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(18, 'customer-due-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(19, 'customer-due-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(20, 'customer-due-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(21, 'damage-product-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(22, 'damage-product-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(23, 'damage-product-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(24, 'damage-product-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(25, 'employee-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(26, 'employee-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(27, 'employee-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(28, 'employee-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(29, 'expense-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(30, 'expense-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(31, 'expense-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(32, 'expense-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(33, 'product-exchange-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(34, 'product-exchange-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(35, 'product-exchange-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(36, 'product-exchange-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(37, 'product-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(38, 'product-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(39, 'product-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(40, 'product-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(41, 'product-discount-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(42, 'product-discount-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(43, 'product-discount-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(44, 'product-discount-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(45, 'stock-transfer-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(46, 'stock-transfer-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(47, 'stock-transfer-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(48, 'stock-transfer-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(49, 'purchase-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(50, 'purchase-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(51, 'purchase-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(52, 'purchase-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(53, 'role-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(54, 'role-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(55, 'role-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(56, 'role-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(57, 'shop-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(58, 'shop-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(59, 'shop-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(60, 'shop-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(61, 'shop-current-stock-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(62, 'shop-current-stock-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(63, 'shop-current-stock-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(64, 'shop-current-stock-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(65, 'supplier-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(66, 'supplier-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(67, 'supplier-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(68, 'supplier-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(69, 'supplier-due-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(70, 'supplier-due-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(71, 'supplier-due-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(72, 'supplier-due-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(73, 'sale-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(74, 'sale-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(75, 'sale-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(76, 'sale-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(77, 'stock-adjustment-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(78, 'stock-adjustment-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(79, 'stock-adjustment-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(80, 'stock-adjustment-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(81, 'user-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(82, 'user-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(83, 'user-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(84, 'user-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(85, 'product-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(86, 'purchase-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(87, 'sale-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(88, 'transfer-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(89, 'damage-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(90, 'expense-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(91, 'damage-product-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(92, 'supplier-due-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(93, 'customer-due-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(94, 'activity-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(95, 'loss-profit-report', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(96, 'warehouse-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(97, 'warehouse-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(98, 'warehouse-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(99, 'warehouse-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(100, 'wallet-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(101, 'wallet-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(102, 'wallet-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(103, 'wallet-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(104, 'work-order-list', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(105, 'work-order-create', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(106, 'work-order-edit', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(107, 'work-order-delete', 'web', '2023-12-30 06:21:12', '2023-12-30 06:21:12'),
(108, 'currency-list', 'web', '2023-12-30 15:45:28', '2023-12-30 15:45:28'),
(109, 'currency-create', 'web', '2023-12-30 15:45:28', '2023-12-30 15:45:28'),
(110, 'currency-edit', 'web', '2023-12-30 15:45:28', '2023-12-30 15:45:28'),
(111, 'currency-delete', 'web', '2023-12-30 15:45:28', '2023-12-30 15:45:28'),
(112, 'port-list', 'web', '2023-12-30 16:52:41', '2023-12-30 16:52:41'),
(113, 'port-create', 'web', '2023-12-30 16:52:41', '2023-12-30 16:52:41'),
(114, 'port-edit', 'web', '2023-12-30 16:52:41', '2023-12-30 16:52:41'),
(115, 'port-delete', 'web', '2023-12-30 16:52:41', '2023-12-30 16:52:41'),
(116, 'requisition-list', 'web', '2024-01-06 08:51:34', '2024-01-06 08:51:34'),
(117, 'requisition-create', 'web', '2024-01-06 08:51:34', '2024-01-06 08:51:34'),
(118, 'requisition-edit', 'web', '2024-01-06 08:51:34', '2024-01-06 08:51:34'),
(119, 'requisition-delete', 'web', '2024-01-06 08:51:34', '2024-01-06 08:51:34');

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
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `port_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port_address` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id`, `admin_id`, `port_name`, `port_address`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Cox Bazar', 'Chottogram', 1, 2, 2, '2023-12-30 17:12:51', '2023-12-31 16:04:23'),
(2, 2, 'Hili port', 'Dhaka', 1, 2, 2, '2023-12-31 16:05:36', '2023-12-31 16:05:36');

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
  `hs_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` enum('PCS','CARTON','KG','GM','PACKET','ML','DZN','BOX','BAG','PACKAGE','TRAY','EACH','CTN','ROFTA','TIN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PCS',
  `rack_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `made_in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangladesh',
  `product_full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(16,2) NOT NULL DEFAULT '0.00',
  `govt_price` double(16,2) NOT NULL DEFAULT '0.00',
  `insurance_before` double(16,2) NOT NULL DEFAULT '0.00',
  `insurance_before_value` double(16,2) NOT NULL DEFAULT '0.00',
  `clearing_before` double(16,2) NOT NULL DEFAULT '0.00',
  `clearing_before_value` double(16,2) NOT NULL DEFAULT '0.00',
  `convert_rate` double(16,2) NOT NULL DEFAULT '0.00',
  `duty_assessment_value` double(16,2) NOT NULL DEFAULT '0.00',
  `cd` double(16,2) NOT NULL DEFAULT '0.00',
  `cd_value` double(16,2) NOT NULL DEFAULT '0.00',
  `rd` double(16,2) NOT NULL DEFAULT '0.00',
  `rd_value` double(16,2) NOT NULL DEFAULT '0.00',
  `cd_rd_total` double(16,2) NOT NULL DEFAULT '0.00',
  `sd` double(16,2) NOT NULL DEFAULT '0.00',
  `sd_value` double(16,2) NOT NULL DEFAULT '0.00',
  `vat` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_value` double(16,2) NOT NULL DEFAULT '0.00',
  `ait` double(16,2) NOT NULL DEFAULT '0.00',
  `ait_value` double(16,2) NOT NULL DEFAULT '0.00',
  `at` double(16,2) NOT NULL DEFAULT '0.00',
  `at_value` double(16,2) NOT NULL DEFAULT '0.00',
  `atv` double(16,2) NOT NULL DEFAULT '0.00',
  `atv_value` double(16,2) NOT NULL DEFAULT '0.00',
  `total_duty` double(16,2) NOT NULL DEFAULT '0.00',
  `insurance_after` double(16,2) NOT NULL DEFAULT '0.00',
  `insurance_after_value` double(16,2) NOT NULL DEFAULT '0.00',
  `bank_charge` double(16,2) NOT NULL DEFAULT '0.00',
  `bank_charge_value` double(16,2) NOT NULL DEFAULT '0.00',
  `clearing_after` double(16,2) NOT NULL DEFAULT '0.00',
  `clearing_after_value` double(16,2) NOT NULL DEFAULT '0.00',
  `carrying_charge` double(16,2) NOT NULL DEFAULT '0.00',
  `carrying_value` double(16,2) NOT NULL DEFAULT '0.00',
  `lc_value` double(16,2) NOT NULL DEFAULT '0.00',
  `other_cost` double(16,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `average_price` double(16,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `old_discount` double(10,2) NOT NULL DEFAULT '0.00',
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
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

INSERT INTO `products` (`id`, `admin_id`, `employee_id`, `brand_id`, `product_name`, `hs_code`, `unit`, `rack_number`, `weight_size`, `made_in`, `product_full_name`, `slug`, `sku`, `unit_price`, `govt_price`, `insurance_before`, `insurance_before_value`, `clearing_before`, `clearing_before_value`, `convert_rate`, `duty_assessment_value`, `cd`, `cd_value`, `rd`, `rd_value`, `cd_rd_total`, `sd`, `sd_value`, `vat`, `vat_value`, `ait`, `ait_value`, `at`, `at_value`, `atv`, `atv_value`, `total_duty`, `insurance_after`, `insurance_after_value`, `bank_charge`, `bank_charge_value`, `clearing_after`, `clearing_after_value`, `carrying_charge`, `carrying_value`, `lc_value`, `other_cost`, `purchase_price`, `average_price`, `sale_price`, `discount`, `old_discount`, `path`, `photo`, `expire_date`, `created_user_id`, `updated_user_id`, `low_quantity`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'tesat', '382130543534526', 'BOX', NULL, '1', 'AFGHANISTAN', 'tesat 1 BOX ( test product )', 'tesat-1-box-test-product', 'TES1BO', 1.36, 1.36, 1.00, 0.01, 1.00, 0.01, 125.00, 173.40, 1.00, 1.73, 1.00, 1.73, 176.87, 1.00, 1.77, 1.00, 1.77, 1.00, 1.73, 1.00, 1.77, 1.00, 1.77, 7.00, 1.00, 1.73, 1.00, 1.73, 1.00, 1.73, 0.00, 0.00, 170.00, 1.00, 188.48, 188.48, 250.00, 1.00, 0.00, 'storage/files/shares/uploads/2', 'tesat65919088bea91.jpg', '2023-12-23', 2, 2, 0, '<p>d fasdf ds f</p>', 1, NULL, '2023-12-31 16:02:16', '2023-12-31 16:02:16'),
(2, 2, NULL, 2, 'tesat', '934718719', 'BOX', NULL, '1', 'AFGHANISTAN', 'tesat 1 BOX ( iglu )', 'tesat-1-box-iglu', 'TES1BO', 1.36, 1.36, 1.00, 0.01, 1.00, 0.01, 125.00, 173.40, 1.00, 1.73, 1.00, 1.73, 176.87, 1.00, 1.77, 1.00, 1.77, 1.00, 1.73, 1.00, 1.77, 1.00, 1.77, 7.00, 1.00, 1.73, 1.00, 1.73, 1.00, 1.73, 0.00, 0.00, 170.00, 1.00, 188.48, 188.48, 200.00, 1.00, 0.00, 'storage/files/shares/uploads/2', 'tesat659190a724965.jpg', '2023-12-23', 2, 2, 0, '<p>d fasdf ds f</p>', 1, NULL, '2023-12-31 16:02:31', '2023-12-31 16:02:47');

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
  `package_start_date` date NOT NULL DEFAULT '2023-12-30',
  `package_end_date` date DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangladesh',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `position`, `gender`, `refer_code`, `rating`, `comment`, `package_start_date`, `package_end_date`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Male', 'shop2023', NULL, NULL, '2023-12-30', NULL, 'Bangladesh', '2023-12-30 06:21:13', '2023-12-30 06:21:13'),
(2, 2, NULL, 'Male', NULL, NULL, NULL, '2024-01-06', '2024-02-05', 'Bangladesh', '2023-12-30 06:21:14', '2024-01-06 04:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `prospective_customers`
--

CREATE TABLE `prospective_customers` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `total_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `extra_discount_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(16,2) NOT NULL DEFAULT '0.00',
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

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_return_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_order_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `total_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('Pending','Accept','Reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `purchase_status` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `admin_id`, `employee_id`, `invoice_no`, `date`, `work_order_id`, `supplier_id`, `total_quantity`, `created_user_id`, `updated_user_id`, `description`, `status`, `purchase_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'fat00001', '2024-01-06', 6, 1, 16.00, 2, 2, 'hjkhjkhkjjk n hgjhg jb', 'Reject', 'No', NULL, '2024-01-06 17:18:00', '2024-01-07 07:07:30'),
(6, 2, NULL, 'fat00002', '2024-01-07', 6, 1, 1.00, 2, 2, NULL, 'Pending', 'No', NULL, '2024-01-07 05:52:53', '2024-01-07 05:52:53'),
(7, 2, NULL, 'fat00003', '2024-01-07', NULL, 1, 1.00, 2, 2, 'das fdsaf ds', 'Reject', 'No', NULL, '2024-01-07 05:54:16', '2024-01-07 07:07:26'),
(8, 2, NULL, 'fat00004', '2024-01-08', 8, 2, 8100.00, 2, 2, 'asd fads fsad', 'Pending', 'No', NULL, '2024-01-07 15:46:21', '2024-01-08 10:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_details`
--

CREATE TABLE `requisition_details` (
  `id` bigint UNSIGNED NOT NULL,
  `requisition_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_details`
--

INSERT INTO `requisition_details` (`id`, `requisition_id`, `admin_id`, `product_id`, `product_name`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 15.00, '2024-01-06 17:18:00', '2024-01-06 17:24:28'),
(2, 1, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 1.00, '2024-01-06 17:24:28', '2024-01-06 17:24:28'),
(3, 6, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 1.00, '2024-01-07 05:52:53', '2024-01-07 05:52:53'),
(4, 7, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 1.00, '2024-01-07 05:54:16', '2024-01-07 05:54:16'),
(5, 8, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 100.00, '2024-01-07 15:46:21', '2024-01-07 15:46:21'),
(6, 8, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 8000.00, '2024-01-08 10:50:10', '2024-01-08 10:50:10');

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
(1, 1, 'Superadmin1', 'web', '2023-12-30 06:21:14', '2023-12-30 06:21:14');

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
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1);

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
  `extra_discount_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `total_loss_profit_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
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
  `return_loss_profit_amount` double(16,2) NOT NULL DEFAULT '0.00',
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

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_details`
--

CREATE TABLE `sale_return_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_return_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_qty` double(16,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(16,2) NOT NULL DEFAULT '0.00',
  `average_purchase_price` double(16,2) NOT NULL DEFAULT '0.00',
  `return_loss_profit_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_percent` double(16,2) NOT NULL DEFAULT '0.00',
  `discount_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `background_image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
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

INSERT INTO `settings` (`id`, `superadmin_id`, `company_name`, `project_name`, `website_name`, `website_title`, `refer_amount`, `address`, `currency_name`, `currency_symbole`, `bin_number`, `vat_number`, `print_headline`, `print_message`, `printing_logo`, `phone`, `email`, `favicon`, `logo`, `background_image`, `facebook`, `youtube`, `twitter`, `instagram`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'SohiBD Soft LTD', 'Shop Management', 'Shop Sohibd', 'Shop Sohibd software', 500.00, '30 Commercial Road Mirpur, Dhaka', 'BDT', '৳', '125487456545552', '12548', 'Shop POS  Software', 'Thanks to use Shop Management software', 'printlogo.jpg', '(281) 809-0090', 'info@sohibd.com', 'uploads/setting/default.png', 'uploads/setting/default.png', 'default.png', '#', '#', '#', '#', 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15');

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
  `default_brand_id` bigint UNSIGNED DEFAULT NULL,
  `default_unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_vat` double NOT NULL DEFAULT '0',
  `default_discount` double NOT NULL DEFAULT '0',
  `default_converted_rate` double NOT NULL DEFAULT '100',
  `default_supplier_id` bigint UNSIGNED DEFAULT NULL,
  `default_customer_id` bigint UNSIGNED DEFAULT NULL,
  `sms_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'biz1994',
  `sms_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '22932044',
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noapi',
  `api_secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nokey',
  `sender_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noid',
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

INSERT INTO `setups` (`id`, `admin_id`, `owner_name`, `company_name`, `company_logo`, `default_shop_id`, `default_brand_id`, `default_unit`, `default_vat`, `default_discount`, `default_converted_rate`, `default_supplier_id`, `default_customer_id`, `sms_user`, `sms_password`, `api_key`, `api_secret`, `sender_id`, `sms_rate`, `sms_type`, `sms_status`, `sms_text`, `currency_name`, `currency_icon`, `bin_number`, `vat_number`, `printing_logo`, `print_first_note`, `print_second_note`, `office_phone`, `office_email`, `company_address`, `facebook`, `youtube`, `twitter`, `instagram`, `web_address`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Admin', 'not-found.jpg', NULL, NULL, NULL, 0, 0, 100, NULL, NULL, 'biz1994', '22932044', 'noapi', 'nokey', 'noid', 0.25, 'Non-Masking', 0, 'Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#', 'BDT', '৳', NULL, NULL, NULL, 'You cannot exchange any product', 'Thank For Shopping', '01739898766', 'admin@gmail.com', 'Dhaka', NULL, NULL, NULL, NULL, 'sohibd.com', '<p>Ki dor</p>', '2023-12-30 06:21:14', '2024-01-06 04:08:46');

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
  `hs_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_details`
--

CREATE TABLE `stock_adjustment_details` (
  `id` bigint UNSIGNED NOT NULL,
  `stock_adjustment_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `admin_id` bigint UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due` double(30,2) NOT NULL DEFAULT '0.00',
  `total_paid` double(30,2) NOT NULL DEFAULT '0.00',
  `total_balance` double(30,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint UNSIGNED NOT NULL,
  `updated_user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `admin_id`, `employee_id`, `supplier_name`, `card_number`, `supplier_phone`, `supplier_email`, `supplier_country`, `bank_account_name`, `bank_account_number`, `swift_code`, `bank_currency`, `bank_name`, `bank_address`, `supplier_address`, `total_due`, `total_paid`, `total_balance`, `created_user_id`, `updated_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'zadfgfgfd', 'fat000000001', '44535434234234', 'adsfds@gmail.com', NULL, 'dsf dsaf sdf ds', '3345345', '435345', 'Pound', 'a dfads fsdaf', 'ads fdas fsdfs', 'fadsf dsa', 0.00, 0.00, 0.00, 2, 2, 1, '2024-01-06 04:11:19', '2024-01-06 04:57:31'),
(2, 2, NULL, 'Nur', 'fat000000002', '657567567', 'adsfdsdds@gmail.com', NULL, 'asd fsdaf sda', '43543543', '435435', 'USD', '45345345', 'f dsafas dfsad fsd', 'd fdafdsaf sda', 0.00, 0.00, 0.00, 2, 2, 1, '2024-01-07 15:44:54', '2024-01-07 15:44:54');

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
(1, 1, 'PCS', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(2, 1, 'CARTON', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(3, 1, 'KG', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(4, 1, 'GM', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(5, 1, 'PACKET', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(6, 1, 'ML', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(7, 1, 'DZN', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(8, 1, 'BOX', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(9, 1, 'BAG', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(10, 1, 'PACKAGE', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(11, 1, 'TRAY', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(12, 1, 'EACH', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(13, 1, 'CTN', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(14, 1, 'ROFTA', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(15, 1, 'TIN', 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15');

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
(1, 'Superadmin', 'Superadmin', NULL, 'superadmin@gmail.com', 'SUP', '01739898764', NULL, 1, 'Sup00001', '$2y$10$VE.GjW0vGngfxWbT1T9Jbe9XffhjFCqQwvlb0KhOS8jhxGIqlwhEm', 'not-found.webp', NULL, '2024-01-06 04:08:28', 1, 1, NULL, '101.2.160.0', 1, 0, NULL, 1, NULL, NULL, '2023-12-30 06:21:13', '2024-01-06 04:08:28'),
(2, 'Admin', 'Admin', NULL, 'admin@gmail.com', 'fat', '01739898766', NULL, 1, NULL, '$2y$10$D.Dn2u1m864QxWcEMJsG6uF.UaPVdokT4sSV3jNCIuJIei9fkw32m', 'not-found.webp', '2024-02-05', '2024-01-08 04:58:59', 1, 1, NULL, '127.0.0.1', 1, 0, NULL, 1, NULL, NULL, '2023-12-30 06:21:14', '2024-01-08 04:58:59');

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
(1, 1, 0.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(2, 1, 1.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(3, 1, 2.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(4, 1, 3.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(5, 1, 4.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(6, 1, 5.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(7, 1, 6.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(8, 1, 7.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(9, 1, 8.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(10, 1, 9.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(11, 1, 10.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(12, 1, 11.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(13, 1, 12.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(14, 1, 13.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(15, 1, 14.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(16, 1, 15.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(17, 1, 16.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(18, 1, 17.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(19, 1, 18.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(20, 1, 19.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(21, 1, 20.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(22, 1, 21.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(23, 1, 22.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(24, 1, 23.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(25, 1, 24.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(26, 1, 25.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(27, 1, 26.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(28, 1, 27.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(29, 1, 28.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(30, 1, 29.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(31, 1, 30.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(32, 1, 31.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(33, 1, 32.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(34, 1, 33.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(35, 1, 34.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(36, 1, 35.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(37, 1, 36.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(38, 1, 37.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(39, 1, 38.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(40, 1, 39.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(41, 1, 40.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(42, 1, 41.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(43, 1, 42.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(44, 1, 43.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(45, 1, 44.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(46, 1, 45.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(47, 1, 46.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(48, 1, 47.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(49, 1, 48.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(50, 1, 49.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(51, 1, 50.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(52, 1, 51.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(53, 1, 52.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(54, 1, 53.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(55, 1, 54.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(56, 1, 55.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(57, 1, 56.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(58, 1, 57.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(59, 1, 58.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(60, 1, 59.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(61, 1, 60.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(62, 1, 61.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(63, 1, 62.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(64, 1, 63.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(65, 1, 64.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(66, 1, 65.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(67, 1, 66.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(68, 1, 67.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(69, 1, 68.00, 1, 1, 1, '2023-12-30 06:21:15', '2023-12-30 06:21:15'),
(70, 1, 69.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(71, 1, 70.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(72, 1, 71.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(73, 1, 72.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(74, 1, 73.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(75, 1, 74.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(76, 1, 75.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(77, 1, 76.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(78, 1, 77.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(79, 1, 78.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(80, 1, 79.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(81, 1, 80.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(82, 1, 81.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(83, 1, 82.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(84, 1, 83.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(85, 1, 84.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(86, 1, 85.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(87, 1, 86.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(88, 1, 87.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(89, 1, 88.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(90, 1, 89.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(91, 1, 90.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(92, 1, 91.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(93, 1, 92.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(94, 1, 93.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(95, 1, 94.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(96, 1, 95.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(97, 1, 96.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(98, 1, 97.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(99, 1, 98.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(100, 1, 99.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16'),
(101, 1, 100.00, 1, 1, 1, '2023-12-30 06:21:16', '2023-12-30 06:21:16');

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
  `type` enum('refer','commission','join','payment','withdraw','renew','receive','sms','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_address` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` bigint NOT NULL DEFAULT '1',
  `updated_user_id` bigint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `admin_id`, `warehouse_name`, `slug`, `warehouse_phone`, `warehouse_email`, `warehouse_address`, `created_user_id`, `updated_user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sohibd', 'sohibd', '01739898764', '01739898764@gmail.com', 'dfg afgsdfadsfasdf', 2, 2, 1, NULL, '2024-01-08 09:06:51', '2024-01-08 09:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `broker_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `total_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(16,2) NOT NULL DEFAULT '0.00',
  `paid` double(16,2) NOT NULL DEFAULT '0.00',
  `pay_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `due` double(16,2) NOT NULL DEFAULT '0.00',
  `convert_rate` double(16,2) NOT NULL DEFAULT '0.00',
  `currency_name` varchar(198) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port_name` varchar(198) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requisition_status` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `broker_bonus` double(16,2) NOT NULL DEFAULT '0.00',
  `total_quantity` double(16,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(16,2) NOT NULL DEFAULT '0.00',
  `created_user_id` bigint NOT NULL,
  `updated_user_id` bigint NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('Quotation','WorkOrder','Reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Quotation',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `admin_id`, `employee_id`, `invoice_no`, `date`, `broker_id`, `customer_id`, `total_vat`, `sub_total`, `paid`, `pay_amount`, `due`, `convert_rate`, `currency_name`, `port_name`, `requisition_status`, `broker_bonus`, `total_quantity`, `grand_total`, `created_user_id`, `updated_user_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'fat00001', '2024-01-03', 1, 2, 220.00, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Cox Bazar', 'No', 0.00, 110.00, 4158000.00, 2, 2, 'fadfdsa fsd', 'Quotation', NULL, '2024-01-02 18:47:12', '2024-01-02 18:47:12'),
(2, 2, NULL, 'fat00002', '2024-01-03', 1, 1, 2.50, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Hili port', 'No', 0.00, 1.00, 22725.00, 2, 2, 'fdsa fsdafs', 'Quotation', NULL, '2024-01-02 18:52:41', '2024-01-02 18:52:41'),
(3, 2, NULL, 'fat00003', '2024-01-03', 1, 1, 5.00, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Cox Bazar', 'No', 0.00, 2.00, 45900.00, 2, 2, 'fsdfsdafs', 'Quotation', NULL, '2024-01-02 18:54:04', '2024-01-02 18:54:04'),
(4, 2, NULL, 'fat00004', '2023-12-08', 1, 1, 2.50, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Cox Bazar', 'No', 0.00, 1.00, 22725.00, 2, 2, 'fsdfsdaf', 'Quotation', NULL, '2024-01-02 19:01:49', '2024-01-02 19:01:49'),
(5, 2, NULL, 'fat00005', '2024-01-03', 1, 1, 2.00, 0.00, 0.00, 0.00, 0.00, 1.00, 'NDT', 'Cox Bazar', 'No', 0.00, 1.00, 202.00, 2, 2, NULL, 'Quotation', NULL, '2024-01-02 19:07:26', '2024-01-02 19:07:26'),
(6, 2, NULL, 'fat00006', '2023-12-02', 1, 1, 302.00, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Cox Bazar', 'Yes', 0.00, 13.00, 612180.00, 2, 2, NULL, 'WorkOrder', NULL, '2024-01-02 19:08:01', '2024-01-07 05:52:53'),
(7, 2, NULL, 'fat00007', '2024-01-05', 1, 1, 245.00, 0.00, 0.00, 0.00, 0.00, 120.00, 'USD', 'Cox Bazar', 'No', 0.00, 21.00, 3260400.00, 2, 2, 'ad asfds', 'Reject', NULL, '2024-01-05 06:04:15', '2024-01-05 06:08:17'),
(8, 2, NULL, 'fat00008', '2024-01-07', 1, 2, 250.00, 0.00, 0.00, 0.00, 0.00, 90.00, 'USD', 'Cox Bazar', 'Yes', 0.00, 100.00, 4500000.00, 2, 2, 'gfdsfgdsg', 'WorkOrder', NULL, '2024-01-07 15:43:45', '2024-01-07 15:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_details`
--

CREATE TABLE `work_order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `work_order_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(16,2) NOT NULL,
  `product_vat` double(16,2) NOT NULL DEFAULT '0.00',
  `product_vat_amount` double(16,2) NOT NULL DEFAULT '0.00',
  `product_price` double(16,2) NOT NULL DEFAULT '0.00',
  `product_total_price` double(16,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_order_details`
--

INSERT INTO `work_order_details` (`id`, `work_order_id`, `admin_id`, `product_id`, `product_name`, `qty`, `product_vat`, `product_vat_amount`, `product_price`, `product_total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 110.00, 1.00, 220.00, 200.00, 46200.00, '2024-01-02 18:47:12', '2024-01-02 18:47:12'),
(2, 2, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 1.00, 1.00, 2.50, 250.00, 252.50, '2024-01-02 18:52:41', '2024-01-02 18:52:41'),
(3, 3, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 2.00, 1.00, 5.00, 250.00, 510.00, '2024-01-02 18:54:04', '2024-01-02 18:54:04'),
(4, 4, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 1.00, 1.00, 2.50, 250.00, 252.50, '2024-01-02 19:01:49', '2024-01-02 19:01:49'),
(5, 5, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 1.00, 1.00, 2.00, 200.00, 202.00, '2024-01-02 19:07:26', '2024-01-02 19:07:26'),
(6, 6, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 12.00, 10.00, 300.00, 250.00, 6600.00, '2024-01-02 19:08:01', '2024-01-05 04:57:01'),
(7, 6, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 1.00, 1.00, 2.00, 200.00, 202.00, '2024-01-05 04:57:01', '2024-01-05 04:57:01'),
(8, 7, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 10.00, 1.00, 25.00, 250.00, 2750.00, '2024-01-05 06:04:15', '2024-01-05 06:04:15'),
(9, 7, 2, 2, 'tesat 1 BOX ( iglu ) (934718719)', 11.00, 1.00, 220.00, 2000.00, 24420.00, '2024-01-05 06:06:08', '2024-01-05 06:06:08'),
(10, 8, 2, 1, 'tesat 1 BOX ( test product ) (382130543534526)', 100.00, 1.00, 250.00, 250.00, 50000.00, '2024-01-07 15:43:45', '2024-01-07 15:44:09');

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
-- Indexes for table `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brokers_admin_id_foreign` (`admin_id`),
  ADD KEY `brokers_employee_id_foreign` (`employee_id`);

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
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_admin_id_foreign` (`admin_id`);

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
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ports_admin_id_foreign` (`admin_id`);

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
-- Indexes for table `prospective_customers`
--
ALTER TABLE `prospective_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prospective_customers_superadmin_id_foreign` (`superadmin_id`);

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
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_admin_id_foreign` (`admin_id`),
  ADD KEY `requisitions_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `requisition_details`
--
ALTER TABLE `requisition_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisition_details_requisition_id_foreign` (`requisition_id`);

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
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_orders_admin_id_foreign` (`admin_id`),
  ADD KEY `work_orders_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `work_order_details`
--
ALTER TABLE `work_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_order_details_work_order_id_foreign` (`work_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brokers`
--
ALTER TABLE `brokers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_dues`
--
ALTER TABLE `customer_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_products`
--
ALTER TABLE `damage_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_product_details`
--
ALTER TABLE `damage_product_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prospective_customers`
--
ALTER TABLE `prospective_customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requisition_details`
--
ALTER TABLE `requisition_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_details`
--
ALTER TABLE `sale_return_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_current_stocks`
--
ALTER TABLE `shop_current_stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_dues`
--
ALTER TABLE `supplier_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_order_details`
--
ALTER TABLE `work_order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Constraints for table `brokers`
--
ALTER TABLE `brokers`
  ADD CONSTRAINT `brokers_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brokers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `ports`
--
ALTER TABLE `ports`
  ADD CONSTRAINT `ports_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `prospective_customers`
--
ALTER TABLE `prospective_customers`
  ADD CONSTRAINT `prospective_customers_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `requisitions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requisitions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisition_details`
--
ALTER TABLE `requisition_details`
  ADD CONSTRAINT `requisition_details_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD CONSTRAINT `work_orders_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `work_orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_order_details`
--
ALTER TABLE `work_order_details`
  ADD CONSTRAINT `work_order_details_work_order_id_foreign` FOREIGN KEY (`work_order_id`) REFERENCES `work_orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
