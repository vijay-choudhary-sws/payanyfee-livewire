-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 06:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payanyfee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Web Journey', 'admin@gmail.com', 'webjourney', '$2y$10$7kdH18sN73yjUgu2LJbX..53ucF8DCE7WKa13tVSFX7YamtD0r0di', '2023-12-06 03:28:35', '2023-12-06 03:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'test demo', 5000, '2023-12-11 06:12:33', '2023-12-11 06:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_fee` varchar(255) NOT NULL,
  `total_sets` int(11) NOT NULL,
  `available_sets` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `course_fee`, `total_sets`, `available_sets`, `status`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'demo', '500', 400, 20, 0, '2023-12-11 07:51:06', '2023-12-13 01:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
(6, '2023_12_06_084450_create_admins_table', 2),
(7, '2023_12_07_103956_create_school_table', 3),
(8, '2023_12_07_103956_create_schools_table', 4),
(9, '2023_12_08_071832_create_schools_table', 5),
(10, '2023_12_08_072108_create_schools_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `nationalitys`
--

DROP TABLE IF EXISTS `nationalitys`;
CREATE TABLE `nationalitys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nationalitys`
--

INSERT INTO `nationalitys` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'test test', '2023-12-11 06:45:41', '2023-12-11 06:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(4, 'cccc', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(5, 'ddd', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(6, 'tttt', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(7, 'enum', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 07:58:28'),
(10, 'uuu', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 08:17:28'),
(13, 'abc', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 08:09:29'),
(14, 'ffff', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(17, 'aaa', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(18, 'aaaa', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(19, 'bbb', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(20, 'cccc', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(21, 'ddd', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(22, 'tttt', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(23, 'enum', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 07:58:28'),
(24, 'ddffff', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(25, 'ok', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 07:58:38'),
(28, 'apple', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(29, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(30, 'ffff', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(32, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(33, 'aaa', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(34, 'aaaa', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(35, 'bbb', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(36, 'cccc', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(37, 'ddd', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(38, 'tttt', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(39, 'enum', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 07:58:28'),
(40, 'ddffff', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(42, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(43, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(44, 'apple', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(45, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(46, 'ffff', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(47, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(48, 'Titlefhfjhf', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57'),
(49, 'aaa', 'Descriptionergr', '2023-12-13 06:48:09', '2023-12-13 06:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'test test', '2023-12-11 04:52:17', '2023-12-11 04:53:15'),
(2, 'demo demo', '2023-12-11 04:52:47', '2023-12-11 04:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', NULL, '$2y$12$p8yaoW.E.9Aga8BuN6hg5ewTohKyYM45il.7vnt/Es5rXzoR41Q0C', 'CTceZoOjibItsEBYgQV5u1cxnBXuwovb6S1t7sTfjiGTStSMD1QKHs2rQabU', '2023-12-06 03:14:27', '2023-12-06 03:14:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalitys`
--
ALTER TABLE `nationalitys`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nationalitys`
--
ALTER TABLE `nationalitys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
