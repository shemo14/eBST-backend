-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2019 at 04:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eBST`
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
(1, 'site_name', 'اوامر الشبكة', '2019-03-07 09:09:29', '2019-03-07 09:09:29');

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

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
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
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '2019_03_10_112800_create_comments_table', 6);

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
  `service_id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL,
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
(65, 'dashboard', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(66, 'permissionslist', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(67, 'addpermissionspage', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(68, 'addpermission', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(69, 'editpermissionpage', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(70, 'updatepermission', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(71, 'deletepermission', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(72, 'admins', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(73, 'addadmin', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(74, 'updateadmin', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(75, 'deleteadmin', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(76, 'deleteadmins', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(77, 'users', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(78, 'adduser', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(79, 'updateuser', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(80, 'deleteuser', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(81, 'deleteusers', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(82, 'send-fcm', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(83, 'categories', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(84, 'addCategory', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(85, 'updateCategory', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(86, 'deleteCategory', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(87, 'deleteCategories', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(88, 'allreports', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(89, 'deletereports', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(90, 'settings', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(91, 'sitesetting', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(92, 'about', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(93, 'add-social', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(94, 'update-social', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32'),
(95, 'delete-social', 1, '2019-03-07 12:37:32', '2019-03-07 12:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` double(8,2) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'قام Admin قام بحذف العديد من الاقسام', 1, '30.117.186.209', 'US', '', '', 1, '2019-03-10 07:11:08', '2019-03-10 07:11:08');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `active` int(11) NOT NULL DEFAULT '0',
  `checked` int(11) NOT NULL DEFAULT '0',
  `role` int(11) NOT NULL DEFAULT '0',
  `lat` decimal(16,14) DEFAULT NULL,
  `lng` decimal(16,14) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `code`, `avatar`, `active`, `checked`, `role`, `lat`, `lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$YlAZYU1yRQN4cjtWcfKzSO86RSPAxBbmtuZ6PapafDJqc49ULiRKe', '01024963844', NULL, 'default.png', 1, 1, 1, NULL, NULL, NULL, '2019-03-07 09:14:04', '2019-03-07 09:17:59');

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
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `comments_service_id_foreign` (`service_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `content_reports`
--
ALTER TABLE `content_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favs_service_id_foreign` (`service_id`),
  ADD KEY `favs_user_id_foreign` (`user_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`);

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
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_service_id_foreign` (`service_id`),
  ADD KEY `rates_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_reports`
--
ALTER TABLE `content_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favs`
--
ALTER TABLE `favs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_reports`
--
ALTER TABLE `content_reports`
  ADD CONSTRAINT `content_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
