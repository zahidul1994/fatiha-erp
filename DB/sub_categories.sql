-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2023 at 06:05 PM
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
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `superadmin_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `sub_category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `superadmin_id`, `category_id`, `sub_category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'CHINIGURA', 'chinigura', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(2, 1, 5, 'MINIKET', 'miniket', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(3, 1, 5, 'NAJIRSHAIL', 'najirshail', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(4, 1, 5, 'PAIJAM', 'paijam', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(5, 1, 5, 'BASMATI', 'basmati', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(6, 1, 18, 'DAY CREAM', 'day-cream', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(7, 1, 18, 'NIGHT CREAM', 'night-cream', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(8, 1, 18, 'EYE CREAM', 'eye-cream', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(9, 1, 26, 'WASHING POWDER', 'washing-powder', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(10, 1, 26, 'BALL SOAP', 'ball-soap', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(11, 1, 26, 'FABRIC BRIGHTENER', 'fabric-brightener', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(12, 1, 26, 'LIQUID WASH', 'liquid-wash', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(13, 1, 30, 'CREAM', 'cream', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(14, 1, 30, 'LOTION', 'lotion', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(15, 1, 30, 'SHAMPOO', 'shampoo', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(16, 1, 30, 'HAIR OIL', 'hair-oil', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(17, 1, 30, 'TOOTHPASTE', 'toothpaste', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(18, 1, 30, 'BRUSH', 'brush', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(19, 1, 30, 'BODY OIL', 'body-oil', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(20, 1, 30, 'SOAP', 'soap', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(21, 1, 30, 'TOP TO TOY', 'top-to-toy', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(22, 1, 30, 'DIAPER', 'diaper', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(23, 1, 30, 'WET TISSUE', 'wet-tissue', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(24, 1, 30, 'TALCOM POWDER', 'talcom-powder', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(25, 1, 30, 'FOOD SUPPLIMENT', 'food-suppliment', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(26, 1, 30, 'FEEDER', 'feeder', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(27, 1, 30, 'NIPLES', 'niples', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(28, 1, 30, 'COTTON BUDS', 'cotton-buds', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(29, 1, 35, 'MEN COLOR', 'men-color', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(30, 1, 35, 'WOMEN COLOR', 'women-color', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(31, 1, 37, 'BELT', 'belt', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(32, 1, 37, 'PANTY', 'panty', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(33, 1, 41, 'BODY', 'body', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(34, 1, 41, 'FOOD OIL', 'food-oil', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(35, 1, 41, 'FACE & HAND', 'face-hand', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(36, 1, 41, 'HAIR', 'hair', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(37, 1, 45, 'BLACK TEA', 'black-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(38, 1, 45, 'BOP TEA', 'bop-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(39, 1, 45, 'DUST TEA', 'dust-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(40, 1, 45, 'TULSI TEA', 'tulsi-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(41, 1, 45, 'MASALA TEA', 'masala-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(42, 1, 45, 'GREEN TEA', 'green-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(43, 1, 45, 'LEMONGRASS TEA', 'lemongrass-tea', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(44, 1, 47, 'SPRAY', 'spray', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(45, 1, 48, 'LIPBALM', 'lipbalm', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(46, 1, 48, 'LIP GEL', 'lip-gel', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(47, 1, 48, 'LIP THERAPY', 'lip-therapy', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(48, 1, 49, 'UPTAN', 'uptan', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(49, 1, 49, 'SCRUB', 'scrub', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(50, 1, 49, 'ALOEVERA GEL', 'aloevera-gel', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(51, 1, 49, 'SKIN TONER', 'skin-toner', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(52, 1, 49, 'PEEL-OFF MASK', 'peel-off-mask', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(53, 1, 49, 'FACE PACK', 'face-pack', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(54, 1, 62, 'TOMATO SAUCE', 'tomato-sauce', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(55, 1, 62, 'SOYA SAUCE', 'soya-sauce', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(56, 1, 62, 'GARLIC SAUCE', 'garlic-sauce', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(57, 1, 62, 'CHILLI SAUCE', 'chilli-sauce', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(58, 1, 72, 'MUM', 'mum', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(59, 1, 72, 'JIBON', 'jibon', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(60, 1, 72, 'FRESH', 'fresh', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(61, 1, 72, 'AQUAFINA', 'aquafina', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(62, 1, 72, 'IFAD', 'ifad', 1, '2023-10-09 18:04:07', '2023-10-09 18:04:07'),
(63, 1, 73, '7UP', '7up', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(64, 1, 73, 'COCA COLA', 'coca-cola', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(65, 1, 73, 'MIRINDA', 'mirinda', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(66, 1, 73, 'SPRITE', 'sprite', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(67, 1, 73, 'MOUNTAIN DEU', 'mountain-deu', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(68, 1, 73, 'PEPSI', 'pepsi', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(69, 1, 73, 'GLUCOSE', 'glucose', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(70, 1, 73, 'CURD', 'curd', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(71, 1, 75, 'BAKING POWDER', 'baking-powder', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(72, 1, 75, 'CUSTARD POWDER', 'custard-powder', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(73, 1, 75, 'COCO POWDER', 'coco-powder', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(74, 1, 75, 'CORN POWDER', 'corn-powder', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(75, 1, 76, 'FOOD', 'food', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(76, 1, 77, 'CASHEW NUT', 'cashew-nut', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(77, 1, 77, 'PESTA  NUT', 'pesta-nut', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(78, 1, 77, 'CHINA NUTS', 'china-nuts', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(79, 1, 77, 'ALMONDS', 'almonds', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(80, 1, 77, 'AKHROT', 'akhrot', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(81, 1, 77, 'MURI', 'muri', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(82, 1, 80, 'BLACK MINI PACK', 'black-mini-pack', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(83, 1, 80, 'MIXED PACK', 'mixed-pack', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(84, 1, 80, 'RAW COFFEE', 'raw-coffee', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(85, 1, 80, 'COFFEE MATE', 'coffee-mate', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(86, 1, 83, 'MANGO', 'mango', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(87, 1, 83, 'OLIVE', 'olive', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(88, 1, 83, 'TETUL', 'tetul', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(89, 1, 83, 'MIX PICKLE', 'mix-pickle', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(90, 1, 83, 'BOROI', 'boroi', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(91, 1, 83, 'GARLIC', 'garlic', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(92, 1, 88, 'POWDER', 'powder', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(93, 1, 88, 'LIQUID', 'liquid', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(94, 1, 88, 'CREAME', 'creame', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(95, 1, 89, 'MUG', 'mug', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(96, 1, 89, 'MUSUR', 'musur', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(97, 1, 89, 'BUT', 'but', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(98, 1, 89, 'KHESARI', 'khesari', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(99, 1, 89, 'MASHKALAI', 'mashkalai', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(100, 1, 93, 'MAJUNI', 'majuni', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(101, 1, 93, 'DISHWASH BAR', 'dishwash-bar', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(102, 1, 93, 'DISHWASH LIQUID', 'dishwash-liquid', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08'),
(103, 1, 93, 'POT', 'pot', 1, '2023-10-09 18:04:08', '2023-10-09 18:04:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_sub_category_name_unique` (`sub_category_name`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  ADD KEY `sub_categories_superadmin_id_foreign` (`superadmin_id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_categories_superadmin_id_foreign` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
