-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 10:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebst`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 0, 2, '2019-04-11 13:56:48', '2019-04-11 13:56:48'),
(4, 0, 2, '2019-04-18 08:14:00', '2019-04-18 08:14:00'),
(6, 0, 2, '2019-05-07 18:23:37', '2019-05-07 18:23:37'),
(7, 0, 2, '2019-05-07 20:06:59', '2019-05-07 20:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `app_reports`
--

CREATE TABLE `app_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `comment_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_reports`
--

INSERT INTO `app_reports` (`id`, `report`, `product_id`, `comment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test report', NULL, 1, 2, '2019-04-23 07:14:30', '2019-04-23 07:14:30'),
(2, 'test  product report', NULL, 1, 2, '2019-04-23 07:40:21', '2019-04-23 07:40:21'),
(3, 'Test', NULL, 1, 2, '2019-05-07 10:52:03', '2019-05-07 10:52:03'),
(4, 'Fuck comment', NULL, 1, 2, '2019-05-07 10:57:05', '2019-05-07 10:57:05'),
(5, 'ووةزززوز', NULL, 1, 2, '2019-05-15 11:05:19', '2019-05-15 11:05:19'),
(6, 'Wtf', NULL, 2, 2, '2019-05-16 06:45:55', '2019-05-16 06:45:55'),
(7, 'N can cncn', NULL, 1, 2, '2019-05-16 06:57:18', '2019-05-16 06:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'اوامر الشبكة', '2019-03-07 09:09:29', '2019-03-07 09:09:29'),
(2, 'about_ar', 'وصف التطبيق بالعربية تجريبي', NULL, '2019-05-22 20:20:48'),
(3, 'about_en', 'app desc of app in English testing', NULL, '2019-05-22 20:20:48'),
(4, 'policy_ar', 'الشروط و الاحكام بالعربية', NULL, NULL),
(5, 'policy_en', 'this is roles and policy for my app', NULL, NULL),
(6, 'address_ar', 'مصر ,القاهره', NULL, NULL),
(7, 'email', 'info@aait.sa', NULL, NULL),
(8, 'phone', '0102345678', NULL, NULL),
(9, 'address_en', 'egypt, cairo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `image`, `created_at`, `updated_at`) VALUES
(1, 'جوالات', 'mobiles', '5cb2f44216bc0-1555231810-7Chz6ky7Aq.jpg', '2019-04-14 06:50:10', '2019-04-14 06:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test comment', 1, 2, '2019-04-23 06:28:13', '2019-04-23 06:28:13'),
(2, 'Fest cmment...', 1, 2, '2019-05-07 08:56:02', '2019-05-07 08:56:02'),
(3, 'Tezt', 1, 2, '2019-05-07 09:54:10', '2019-05-07 09:54:10'),
(4, 'Ooooo', 1, 2, '2019-05-07 20:09:37', '2019-05-07 20:09:37'),
(5, 'تومس فوكن شيلبي 💀💀', 7, 2, '2019-05-08 10:12:38', '2019-05-08 10:12:38'),
(6, 'اتت', 2, 2, '2019-05-16 06:26:52', '2019-05-16 06:26:52'),
(7, 'Etfoooo', 2, 2, '2019-05-16 06:46:20', '2019-05-16 06:46:20'),
(8, 'Tggg', 2, 2, '2019-05-16 06:51:06', '2019-05-16 06:51:06'),
(9, 'Vvvv', 1, 2, '2019-05-16 06:52:54', '2019-05-16 06:52:54'),
(10, 'Jfjcbhdy', 1, 2, '2019-05-16 06:56:05', '2019-05-16 06:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_reports`
--

CREATE TABLE `content_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(4, 'مصر', 'Egypt', '2019-04-14 11:33:31', '2019-04-14 11:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_price` double(8,2) DEFAULT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`id`, `name`, `desc`, `extra_price`, `offer_id`, `created_at`, `updated_at`) VALUES
(3, 'iphone', 'desc of my exchange iphone', NULL, 4, '2019-04-23 12:41:47', '2019-04-23 12:41:47'),
(4, 'iphone', 'desc of my exchange iphone', NULL, 5, '2019-04-23 12:43:15', '2019-04-23 12:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favs`
--

INSERT INTO `favs` (`id`, `product_id`, `user_id`, `device_id`, `created_at`, `updated_at`) VALUES
(13, 7, NULL, 'ExponentPushToken[pERkEXIhkigJr3gkEv23vQ]', '2019-05-10 16:04:24', '2019-05-10 16:04:24'),
(31, 1, 2, NULL, '2019-05-15 11:05:55', '2019-05-15 11:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `type`, `key`, `created_at`, `updated_at`) VALUES
(1, '1554998208_21565.png', 'ads', 3, '2019-04-11 13:56:48', '2019-04-11 13:56:48'),
(2, '1554998208_96780.png', 'ads', 3, '2019-04-11 13:56:48', '2019-04-11 13:56:48'),
(3, '1555253184_38250.png', 'product', 1, '2019-04-14 12:46:24', '2019-04-14 12:46:24'),
(4, '1555253184_27377.png', 'product', 3, '2019-04-14 12:46:24', '2019-04-14 12:46:24'),
(5, '1555253204_39913.png', 'product', 4, '2019-04-14 12:46:44', '2019-04-14 12:46:44'),
(6, '1555253204_47172.png', 'product', 4, '2019-04-14 12:46:44', '2019-04-14 12:46:44'),
(7, '1555253219_89158.png', 'product', 2, '2019-04-14 12:46:59', '2019-04-14 12:46:59'),
(8, '1555253219_85171.png', 'product', 5, '2019-04-14 12:46:59', '2019-04-14 12:46:59'),
(9, '1555582440_78608.png', 'ads', 4, '2019-04-18 08:14:00', '2019-04-18 08:14:00'),
(10, '1555582440_68498.png', 'ads', 4, '2019-04-18 08:14:00', '2019-04-18 08:14:00'),
(11, '1555845026_88231.png', 'product', 6, '2019-04-21 09:10:26', '2019-04-21 09:10:26'),
(12, '1555845026_97965.png', 'product', 6, '2019-04-21 09:10:26', '2019-04-21 09:10:26'),
(13, '1556030507_21830.png', 'exchange', 3, '2019-04-23 12:41:47', '2019-04-23 12:41:47'),
(14, '1556030507_79428.png', 'exchange', 3, '2019-04-23 12:41:47', '2019-04-23 12:41:47'),
(15, '1556030595_82275.png', 'exchange', 4, '2019-04-23 12:43:15', '2019-04-23 12:43:15'),
(16, '1556030595_98743.png', 'exchange', 4, '2019-04-23 12:43:15', '2019-04-23 12:43:15'),
(17, '1557260617_69666.png', 'ads', 6, '2019-05-07 18:23:37', '2019-05-07 18:23:37'),
(18, '1557260617_66412.png', 'ads', 6, '2019-05-07 18:23:37', '2019-05-07 18:23:37'),
(19, '1557260617_61359.png', 'ads', 6, '2019-05-07 18:23:37', '2019-05-07 18:23:37'),
(20, '1557260617_21088.png', 'ads', 6, '2019-05-07 18:23:39', '2019-05-07 18:23:39'),
(21, '1557260619_76872.png', 'ads', 6, '2019-05-07 18:23:39', '2019-05-07 18:23:39'),
(22, '1557260619_65187.png', 'ads', 6, '2019-05-07 18:23:39', '2019-05-07 18:23:39'),
(23, '1557266819_70759.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(24, '1557266819_96559.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(25, '1557266819_45486.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(26, '1557266819_68479.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(27, '1557266819_86598.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(28, '1557266819_19019.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(29, '1557266819_28046.png', 'ads', 7, '2019-05-07 20:06:59', '2019-05-07 20:06:59'),
(30, '1557266819_64473.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(31, '1557266822_82879.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(32, '1557266822_90830.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(33, '1557266822_50558.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(34, '1557266822_39737.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(35, '1557266822_88616.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(36, '1557266822_58348.png', 'ads', 7, '2019-05-07 20:07:02', '2019-05-07 20:07:02'),
(37, '1557266822_87760.png', 'ads', 7, '2019-05-07 20:07:05', '2019-05-07 20:07:05'),
(38, '1557316927_65739.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(39, '1557316927_65563.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(40, '1557316927_67867.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(41, '1557316927_51997.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(42, '1557316927_71096.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(43, '1557316927_29460.png', 'product', 7, '2019-05-08 10:02:07', '2019-05-08 10:02:07'),
(44, '1557316927_91197.png', 'product', 7, '2019-05-08 10:02:13', '2019-05-08 10:02:13'),
(45, '1557528080_75385.png', 'product', 8, '2019-05-10 20:41:20', '2019-05-10 20:41:20'),
(46, '1557528080_51468.png', 'product', 8, '2019-05-10 20:41:23', '2019-05-10 20:41:23'),
(47, '1557683057_35844.png', 'product', 3, '2019-05-12 15:44:20', '2019-05-12 15:44:20'),
(48, '1557683060_42064.png', 'product', 3, '2019-05-12 15:44:20', '2019-05-12 15:44:20'),
(49, '1557699306_11284.png', 'product', 9, '2019-05-12 20:15:06', '2019-05-12 20:15:06'),
(50, '1557699306_31066.png', 'product', 9, '2019-05-12 20:15:06', '2019-05-12 20:15:06'),
(51, '1558527213_72338.png', 'product', 15, '2019-05-22 10:13:33', '2019-05-22 10:13:33'),
(52, '1558527213_45993.png', 'product', 15, '2019-05-22 10:13:33', '2019-05-22 10:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_26_110013_create_roles_table', 1),
(4, '2018_06_26_110120_create_permissions_table', 1),
(5, '2018_07_01_104552_create_reports_table', 1),
(6, '2018_07_01_123905_create_app_seetings_table', 1),
(7, '2018_07_02_074616_create_socials_table', 1),
(8, '2019_03_07_114041_create_categories_table', 2),
(9, '2019_03_10_091303_create_ads_table', 3),
(10, '2019_03_10_091338_create_images_table', 3),
(11, '2019_03_10_092426_create_notifications_table', 4),
(12, '2019_03_10_093344_create_services_table', 5),
(13, '2019_03_10_111809_create_reports_table', 6),
(14, '2019_03_10_111828_create_rates_table', 6),
(15, '2019_03_10_111840_create_favs_table', 6),
(16, '2019_03_10_112800_create_comments_table', 6),
(17, '2019_04_14_094700_create_countries_table', 7),
(18, '2019_04_14_134623_create_products_table', 8),
(19, '2019_04_22_093714_create_views_table', 9),
(20, '2019_04_23_084644_create_app_reports_table', 10),
(21, '2019_04_23_095309_create_offers_table', 11),
(22, '2019_04_23_100426_create_auctions_table', 12),
(23, '2019_04_23_101507_create_exchanges_table', 13),
(24, '2019_05_22_225611_create_contact_uses_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `offer_id` int(10) UNSIGNED DEFAULT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `type`, `status`, `product_id`, `user_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, NULL, '2019-04-23 12:36:16', '2019-05-15 07:21:06'),
(4, 3, 1, 1, 2, NULL, '2019-04-23 12:41:47', '2019-05-15 07:14:56'),
(5, 2, 1, 1, 2, NULL, '2019-04-23 12:43:15', '2019-05-15 07:43:52'),
(6, 1, 1, 1, 2, NULL, '2019-05-12 19:52:40', '2019-05-15 07:15:11'),
(7, 1, 0, 2, 2, NULL, '2019-05-16 06:27:17', '2019-05-16 06:27:17'),
(8, 1, 2, 1, 2, NULL, '2019-05-16 06:39:26', '2019-05-16 07:02:28'),
(9, 1, 0, 2, 2, NULL, '2019-05-16 06:40:08', '2019-05-16 06:40:08'),
(10, 1, 0, 2, 2, NULL, '2019-05-16 06:41:03', '2019-05-16 06:41:03'),
(11, 1, 0, 2, 2, NULL, '2019-05-16 06:42:59', '2019-05-16 06:42:59'),
(12, 1, 0, 2, 2, NULL, '2019-05-16 06:44:55', '2019-05-16 06:44:55'),
(13, 1, 0, 3, 2, NULL, '2019-05-19 09:50:29', '2019-05-19 09:50:29');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permissions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permissions`, `role_id`, `created_at`, `updated_at`) VALUES
(248, 'dashboard', 1, '2019-05-22 21:29:05', '2019-05-22 21:29:05'),
(249, 'permissionslist', 1, '2019-05-22 21:29:05', '2019-05-22 21:29:05'),
(250, 'addpermissionspage', 1, '2019-05-22 21:29:05', '2019-05-22 21:29:05'),
(251, 'addpermission', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(252, 'editpermissionpage', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(253, 'updatepermission', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(254, 'deletepermission', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(255, 'admins', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(256, 'addadmin', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(257, 'updateadmin', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(258, 'deleteadmin', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(259, 'deleteadmins', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(260, 'users', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(261, 'adduser', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(262, 'updateuser', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(263, 'deleteuser', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(264, 'deleteusers', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(265, 'send-fcm', 1, '2019-05-22 21:29:06', '2019-05-22 21:29:06'),
(266, 'categories', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(267, 'addCategory', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(268, 'updateCategory', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(269, 'deleteCategory', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(270, 'deleteCategories', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(271, 'ads', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(272, 'addAd', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(273, 'updateAd', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(274, 'deleteAd', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(275, 'deleteAds', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(276, 'contact-us', 1, '2019-05-22 21:29:07', '2019-05-22 21:29:07'),
(277, 'deleteMsg', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(278, 'replayMsg', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(279, 'deleteAllMsg', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(280, 'countries', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(281, 'addCountry', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(282, 'updateCountry', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(283, 'deleteCountry', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(284, 'deleteCountries', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(285, 'allreports', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(286, 'deletereports', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(287, 'settings', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(288, 'sitesetting', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(289, 'about', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(290, 'add-social', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(291, 'update-social', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(292, 'delete-social', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(293, 'post-about-app', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08'),
(294, 'post-policy', 1, '2019-05-22 21:29:08', '2019-05-22 21:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `exchange_price` double(8,2) DEFAULT NULL,
  `exchange_product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` double(8,2) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `category_id`, `price`, `type`, `exchange_price`, `exchange_product`, `max_price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'desc', 1, 100.00, 1, 20.00, 'test2', 200.00, 2, '2019-04-14 12:44:16', '2019-04-14 12:44:16'),
(2, 'test', 'desc', 1, 100.00, 1, 20.00, 'test2', 200.00, 2, '2019-04-14 12:44:46', '2019-04-14 12:44:46'),
(3, 'test 😂', 'desc', 1, 1000.00, 1, 20.00, 'test2', 200.00, 2, '2019-04-14 12:46:24', '2019-05-12 15:44:17'),
(4, 'test', 'desc', 1, 100.00, 1, 20.00, 'test2', NULL, 2, '2019-04-14 12:46:44', '2019-04-14 12:46:44'),
(5, 'test', 'desc', 1, 100.00, 1, NULL, 'test2', NULL, 2, '2019-04-14 12:46:59', '2019-04-14 12:46:59'),
(7, 'منتج فشيخ 😎', 'هذا وصف لمنتج ملوش اي ٣٠ لازمه ف الحيااه وصف هزلي غير قابل للاخذ بجديه 😒 😒\nالبط يقوم فرحان م النوم يغطس و يعوم كدا طول اليوم 🦆', 1, 200.00, 1, NULL, NULL, NULL, 2, '2019-05-08 10:02:06', '2019-05-08 10:02:06'),
(8, 'اسم', 'وصف', 1, 200.00, 1, NULL, NULL, NULL, 2, '2019-05-10 20:41:20', '2019-05-10 20:41:20'),
(15, 'Product nams', 'Desc of product', 1, NULL, 2, NULL, NULL, 100.00, 8, '2019-05-22 10:13:33', '2019-05-22 10:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` double(8,2) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rate`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 4.00, 1, 2, '2019-04-16 11:56:14', '2019-05-15 11:05:58'),
(4, 3.00, 7, 2, '2019-05-08 10:13:40', '2019-05-08 10:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `event` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` int(11) NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `event`, `supervisor`, `ip`, `country`, `city`, `area`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'قام Admin جوالات 1تعديل قسم ', 1, '186.232.200.212', 'BR', 'Curionopolis', 'Para', 1, '2019-03-07 12:36:00', '2019-03-07 12:36:00'),
(2, 'قام Admin اضافة قسم', 1, '60.64.15.86', 'JP', '', '', 1, '2019-03-10 06:24:00', '2019-03-10 06:24:00'),
(3, 'قام Admin تعديل قسم فثسف ddd', 1, '205.209.188.141', 'US', 'San Jose', 'California', 1, '2019-03-10 06:24:15', '2019-03-10 06:24:15'),
(4, 'قام Admin بحذف القسم', 1, '110.199.229.15', 'CN', '', '', 1, '2019-03-10 07:10:55', '2019-03-10 07:10:55'),
(5, 'قام Admin قام بحذف العديد من الاقسام', 1, '30.117.186.209', 'US', '', '', 1, '2019-03-10 07:11:08', '2019-03-10 07:11:08'),
(6, 'قام Admin اضافة قسم', 1, '52.69.141.226', 'JP', 'Tokyo', 'Tokyo', 1, '2019-04-14 06:50:10', '2019-04-14 06:50:10'),
(7, 'قام Admin اضافة دولة', 1, '172.19.136.9', '', '', '', 1, '2019-04-14 11:26:00', '2019-04-14 11:26:00'),
(8, 'قام Admin اضافة دولة', 1, '4.14.51.151', 'US', 'Omaha', 'Nebraska', 1, '2019-04-14 11:26:33', '2019-04-14 11:26:33'),
(9, 'قام Admin تعديل دولة مصر 2', 1, '120.171.70.158', 'ID', '', '', 1, '2019-04-14 11:31:34', '2019-04-14 11:31:34'),
(10, 'قام Admin اضافة دولة', 1, '231.71.196.174', '', '', '', 1, '2019-04-14 11:32:59', '2019-04-14 11:32:59'),
(11, 'قام Admin بحذف دولة', 1, '210.66.227.85', 'TW', '', '', 1, '2019-04-14 11:33:07', '2019-04-14 11:33:07'),
(12, 'قام Admin قام بحذف العديد من الدول', 1, '154.58.93.232', 'US', 'Washington', 'District of Columbia', 1, '2019-04-14 11:33:19', '2019-04-14 11:33:19'),
(13, 'قام Admin اضافة دولة', 1, '207.147.216.253', 'US', '', '', 1, '2019-04-14 11:33:32', '2019-04-14 11:33:32'),
(14, 'قام Admin بتحديث بيانات التطبيق', 1, '111.60.34.174', 'CN', 'Wuhan', 'Hubei', 1, '2019-05-22 20:20:50', '2019-05-22 20:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'مدير عام', '2019-03-07 09:09:29', '2019-03-07 09:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `peer_exchange` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_exchange` double(8,2) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `site_name`, `url`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.facebook.com', '5ce5d06918fea-1558564969-wbBQ3H22sJ.jpg', '2019-05-22 20:42:49', '2019-05-22 20:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `active` int(11) NOT NULL DEFAULT '0',
  `checked` int(11) NOT NULL DEFAULT '0',
  `role` int(11) NOT NULL DEFAULT '0',
  `lat` decimal(16,14) DEFAULT NULL,
  `lng` decimal(16,14) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `isNotify` int(10) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `desc`, `password`, `phone`, `country_id`, `code`, `avatar`, `active`, `checked`, `role`, `lat`, `lng`, `type`, `device_id`, `lang`, `isNotify`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'aait@aait.sa', NULL, '$2y$10$rgPC9pcjRqWtZzF/ZFSni.ikfFG/zLUC9MrLRXRDNhaIrLI7PNrq2', '01024963844', 4, NULL, 'default.png', 1, 1, 1, NULL, NULL, 0, NULL, 'ar', 1, NULL, '2019-03-07 09:14:04', '2019-03-07 09:17:59'),
(2, 'shams', 'shams@email.com', NULL, '$2y$10$S1LVuHHRzHMz7Y.5JXike.sfHx0B0gDO8x7OMgUJqoD.eFoTIqHr6', '0102345678', 4, '2437', 'default.png', 1, 1, 0, NULL, NULL, 0, 'ExponentPushToken[ezkfbZHQgfourweMmojfns]', 'ar', 1, NULL, '2019-04-10 12:13:12', '2019-05-19 10:35:01'),
(3, 'shams', 'shams_@email.com', NULL, '$2y$10$zXAXJS2okGrE1O97bYAOy.g/zJi9rq41CJyNcMB.2IAYuwol7zWcu', '0102345677', 4, '5295', 'default.png', 1, 0, 0, NULL, NULL, 1, 'ExponentPushToken[hV2H35Mm4JEBNdw4i1-SaZ]', 'en', 1, NULL, '2019-05-18 15:36:15', '2019-05-18 15:36:15'),
(8, 'Mohamed', 'mohamed@email.com', NULL, '$2y$10$JEHqIuX2vxxEMQqO90H2m.iMEbkPYbFG73DqG/D.6CqaltXWgPBna', '0100234567', 4, '9556', 'default.png', 1, 1, 0, NULL, NULL, 0, 'ExponentPushToken[hV2H35Mm4JEBNdw4i1-SaZ]', 'en', 1, NULL, '2019-05-18 16:33:58', '2019-05-18 16:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ads_user_id_foreign` (`user_id`);

--
-- Indexes for table `app_reports`
--
ALTER TABLE `app_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_reports_product_id_foreign` (`product_id`),
  ADD KEY `app_reports_comment_id_foreign` (`comment_id`),
  ADD KEY `app_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auctions_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_service_id_foreign` (`product_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_reports`
--
ALTER TABLE `content_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exchanges_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favs_user_id_foreign` (`user_id`),
  ADD KEY `favs_service_id_foreign` (`product_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_product_id_foreign` (`product_id`),
  ADD KEY `offers_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_user_id_foreign` (`user_id`),
  ADD KEY `rates_service_id_foreign` (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_user_id_foreign` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_reports`
--
ALTER TABLE `app_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_reports`
--
ALTER TABLE `content_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favs`
--
ALTER TABLE `favs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_reports`
--
ALTER TABLE `app_reports`
  ADD CONSTRAINT `app_reports_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `auctions_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_service_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_reports`
--
ALTER TABLE `content_reports`
  ADD CONSTRAINT `content_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD CONSTRAINT `exchanges_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_service_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_service_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
