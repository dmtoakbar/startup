-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2024 at 06:55 AM
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
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

CREATE TABLE `admindetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `alternate_mobile_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT 'Admin User',
  `user_status` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_login_time` timestamp NULL DEFAULT NULL,
  `last_log_out_time` timestamp NULL DEFAULT NULL,
  `email_verify_token_id` varchar(255) NOT NULL,
  `email_verify_token_key` varchar(255) NOT NULL,
  `email_verify_expiry_time` int(11) NOT NULL,
  `password_forget_token_id` varchar(255) DEFAULT NULL,
  `password_forget_token_key` varchar(255) DEFAULT NULL,
  `password_forget_expiry_time` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`id`, `email`, `mobile_number`, `alternate_mobile_number`, `address`, `profile_img`, `department`, `user_type`, `user_status`, `last_login_ip`, `last_login_time`, `last_log_out_time`, `email_verify_token_id`, `email_verify_token_key`, `email_verify_expiry_time`, `password_forget_token_id`, `password_forget_token_key`, `password_forget_expiry_time`, `created_at`, `updated_at`) VALUES
(5, 'dmtoakbar@gmail.com', '9026296803', '', 'village & post: marathua saraiya', 'admin_profile1727841887.jpeg', 'Director', 'Admin User', 'Approved', '127.0.0.1', '2024-10-11 19:53:26', '2024-10-03 11:10:51', 'bieYhQq8IUhiKQpRR0d9DLYylAQcGd', 'VM831uY1f6VJfLaaQJojqGI7ARAy26cmZRhb9JdabMkHbJZ7D3MjQcdHGkZp', 1727843271, NULL, NULL, NULL, '2024-10-01 22:27:51', '2024-10-11 19:53:26'),
(6, 'dmtoakbfar@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Admin User', NULL, NULL, NULL, NULL, 'EKrXm7TommSsI8we69oQVL1FrBHHGr', 'UpEjeRo6yozQoP0Bc6d2vNRMD8PwSiWdogOwsofOmVE5pBm57cqy0RNTftY3', 1727844606, NULL, NULL, NULL, '2024-10-01 22:50:06', '2024-10-01 22:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousels`
--

INSERT INTO `carousels` (`id`, `title`, `describe`, `image`, `link`, `created_at`, `updated_at`) VALUES
(2, 'cds exam interview', 'quick offer', 'carousel1718358726.jpeg', 'go to', '2024-06-14 03:53:50', '2024-06-14 04:22:06'),
(3, 'seonc title', 'kumar', 'carousel1718809899.jpeg', '.com', '2024-06-19 09:41:39', '2024-06-19 09:41:39'),
(4, 'third title', 'gogd', 'carousel1718809929.jpeg', 'go to', '2024-06-19 09:42:09', '2024-06-19 09:42:09'),
(5, 'forutn', 'f', 'carousel1718810185.jpeg', 'go to', '2024-06-19 09:46:25', '2024-06-19 09:46:25'),
(6, 'fa', 'quick offer', 'carousel1718810855.jpeg', 'go to', '2024-06-19 09:57:35', '2024-06-19 09:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

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
-- Table structure for table `homecontentnames`
--

CREATE TABLE `homecontentnames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homecontentnames`
--

INSERT INTO `homecontentnames` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Carousel', '2024-06-13 10:28:53', '2024-06-13 10:28:53'),
(2, 'Content', '2024-06-13 10:30:15', '2024-06-13 10:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_02_174534_create_services_table', 2),
(5, '2024_06_09_065131_create_services_table', 3),
(6, '2024_06_09_065505_services', 4),
(7, '2024_06_09_065749_create_services_table', 5),
(8, '2024_06_10_181654_create_tests_table', 6),
(9, '2024_06_11_085147_create_questionpaperfronts_table', 7),
(10, '2024_06_11_093114_create_questionpapers_table', 8),
(11, '2024_06_11_094621_create_questionpapers_table', 9),
(12, '2024_06_11_111846_create_questionpaperfronts_table', 10),
(13, '2024_06_11_171746_create_questionpaperfronts_table', 11),
(14, '2024_06_11_181130_create_subjects_table', 12),
(15, '2024_06_13_033741_create_homecontentnames_table', 13),
(16, '2024_06_13_175358_create_carousels_table', 14),
(17, '2024_06_26_135948_create_studentusers_table', 15),
(18, '2024_06_28_141933_create_studentusers_table', 16),
(19, '2024_06_28_145526_create_studentusers_table', 17),
(20, '2024_07_01_073708_create_studentusers_table', 18),
(21, '2024_07_10_152358_create_questionpaperfronts_table', 19),
(22, '2024_07_10_161304_create_questionpaperfronts_table', 20),
(23, '2024_09_08_060501_create_admindetails_table', 21),
(24, '2024_09_10_192237_create_admindetails_table', 22),
(25, '2024_09_12_133346_create_admindetails_table', 23),
(26, '2024_09_12_170944_create_admindetails_table', 24),
(27, '2024_09_15_104723_create_studentusers_table', 25),
(28, '2024_09_23_035151_create_services_table', 26),
(29, '2024_10_03_191638_create_justchecks_table', 27),
(30, '2024_10_03_194138_create_tests_table', 28),
(31, '2024_10_03_205704_create_tests_table', 29),
(32, '2024_10_04_020125_create_subjects_table', 30),
(33, '2024_10_04_021943_create_tests_table', 31),
(34, '2024_10_04_114815_create_questionpaperfronts_table', 32),
(35, '2024_10_04_145801_create_questionpapers_table', 33),
(36, '2024_10_04_191551_create_services_table', 34),
(37, '2024_10_09_164733_create_tests_table', 35),
(38, '2024_10_09_181814_create_tests_table', 36),
(39, '2024_10_10_013756_create_paymentsetups_table', 37),
(40, '2024_10_10_024529_create_paymentsetups_table', 38),
(41, '2024_10_10_034907_create_paymentsetups_table', 39),
(42, '2024_10_11_162106_create_questionpaperfronts_table', 40);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentsetups`
--

CREATE TABLE `paymentsetups` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `normal_discount` varchar(255) NOT NULL,
  `coupon` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coupon`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentsetups`
--

INSERT INTO `paymentsetups` (`id`, `name`, `price`, `normal_discount`, `coupon`, `created_at`, `updated_at`) VALUES
('9d358771-3482-4e71-92b2-cedf7dafc2fc', 'amit kumar', '34', '34', '[{\"TCUP349\":\"30\"},{\"TCU83490\":\"5\"},{\"GREUERIO\":\"43\"}]', '2024-10-09 22:21:51', '2024-10-10 03:40:20'),
('9d358779-add4-47ee-ac28-a072c79cdc9a', '343', '43', '43', 'null', '2024-10-09 22:21:57', '2024-10-10 23:55:08'),
('9d358782-cb4d-4464-8081-397877459600', '3443', '3443', '34433', '[{\"DFAFAF\":\"3\"},{\"FSAFAF\":\"34\"},{\"REERRE\":\"3434\"},[\"3243\"],{\"KURIJDF\":\"34\"},{\"DFJLAFJL\":\"4334\"}]', '2024-10-09 22:22:03', '2024-10-11 01:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `questionpaperfronts`
--

CREATE TABLE `questionpaperfronts` (
  `id` char(36) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Disapproved',
  `sub_title` varchar(255) NOT NULL,
  `duration` double NOT NULL,
  `total_question` double NOT NULL,
  `total_number` double NOT NULL,
  `minus_per_wrong_question` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questionpaperfronts`
--

INSERT INTO `questionpaperfronts` (`id`, `test_name`, `name`, `status`, `sub_title`, `duration`, `total_question`, `total_number`, `minus_per_wrong_question`, `description`, `payment_id`, `created_at`, `updated_at`) VALUES
('9d38986d-9a2b-401c-b28c-c479ac623952', 'ssc', 'ssc mts', 'Approved', 'scc mts 2021', 32, 43, 342, '342', '<p>342</p>', '9d358771-3482-4e71-92b2-cedf7dafc2fc', '2024-10-11 10:56:50', '2024-10-11 12:08:51'),
('9d38b934-9ccc-4131-b33c-9b6304a34056', 'ssc', 'ssc mts', 'Approved', 'scc mts 2021', 324, 43, 43, '34', '<p>32</p>', NULL, '2024-10-11 12:28:29', '2024-10-11 12:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `questionpapers`
--

CREATE TABLE `questionpapers` (
  `id` char(36) NOT NULL,
  `questionpaperfronts_id` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `direction` longtext DEFAULT NULL,
  `question` longtext NOT NULL,
  `mark` double NOT NULL,
  `negative` double NOT NULL,
  `a` longtext NOT NULL,
  `b` longtext NOT NULL,
  `c` longtext NOT NULL,
  `d` longtext NOT NULL,
  `e` longtext DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Disapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
('9d2faadc-8ae9-49b4-b9c8-3abe9ecee1e2', 'Test', 'Approved', '2024-10-07 00:25:56', '2024-10-07 00:40:42'),
('9d2faaee-276d-485a-811d-1fb81cb29df6', 'Course', 'Approved', '2024-10-07 00:26:07', '2024-10-07 00:40:35'),
('9d2faafd-f738-42f8-a680-fc6d828f6c15', 'Job', 'Approved', '2024-10-07 00:26:17', '2024-10-07 00:37:11'),
('9d2fab09-480d-4db3-b6ee-19a966624758', 'Blog', 'Approved', '2024-10-07 00:26:25', '2024-10-07 00:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R6wbMcRnkTEhJOgy9XuUlcxgiNzytqW6lCNwSHxl', 68, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN0xheENkc1FUdVB0TVkyaHdFUVNzWTRGb1NoSHZoZ1R3UkI5b0sycCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njg7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6MTM6ImFkbWluLWNhcHRjaGEiO3M6NjoiNzQ0OTljIjtzOjIxOiJsb2dnZWQtcGFzc3dvcmQtaW5wdXQiO3M6ODoiQXBwbGVAMDEiO30=', 1728700659),
('VicK4TIoaPZjffby8bGWYKTMzFpNJFxLuNX9uIZF', 68, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaFcwV1VrZHlWTG1RNFh4Wmdib0pJeEVVdUlHVW91TzZBY0xSZFc0RSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njg7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vZmZpY2UvcXVlc3Rpb25wYXBlciI7fXM6MTM6ImFkbWluLWNhcHRjaGEiO3M6NjoiZjBkY2I0IjtzOjIxOiJsb2dnZWQtcGFzc3dvcmQtaW5wdXQiO3M6ODoiQXBwbGVAMDEiO30=', 1728670092);

-- --------------------------------------------------------

--
-- Table structure for table `studentusers`
--

CREATE TABLE `studentusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_status` varchar(255) DEFAULT 'Approved',
  `otp` int(11) DEFAULT NULL,
  `is_otp_verified` enum('0','1') DEFAULT '0',
  `otp_expiry` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentusers`
--

INSERT INTO `studentusers` (`id`, `name`, `email`, `mobile_number`, `password`, `user_status`, `otp`, `is_otp_verified`, `otp_expiry`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Amit Kumar', 'dmtoakbar@gmail.com', '9026296803', '$2y$12$P42ohpez.yBzHbXm7QOV..kK68VLO/5D6hs5aYDN6tdvTuZJAKcj.', 'Restricted', 234993, '1', 1726398047, NULL, '2024-09-15 05:20:47', '2024-09-22 21:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Disapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
('9d2955b7-dc30-4109-91fb-ca0235989bcc', 'English', 'Approved', '2024-10-03 20:52:53', '2024-10-03 21:13:51'),
('9d2955e5-6a9a-4b1f-8b14-caea8ad7118b', 'Reasoning', 'Approved', '2024-10-03 20:53:23', '2024-10-03 21:13:58'),
('9d2955eb-abe4-4aba-915f-008f72955edc', 'Math', 'Disapproved', '2024-10-03 20:53:27', '2024-10-03 21:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Disapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `description`, `img`, `status`, `created_at`, `updated_at`) VALUES
('d40a7a16-61ae-4d30-8860-edccbd549f18', 'ssc', 'good very day', 'test1728663972.jpeg', 'Approved', '2024-10-11 10:56:12', '2024-10-11 10:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
(68, 'amit kumar', 'dmtoakbar@gmail.com', '2024-10-01 22:29:55', '$2y$12$P.L/bHLhAxBshrtIBWTQpO2eWMOfXjA64SeD8mVh2HOBfGnE0iEQO', 'Xwi2Yele3K1YbjUhj9TVB1medNKUN6fpksYRytnxDSuRb2Ia4EK9yzzGLlOx', '2024-10-01 22:27:51', '2024-10-03 11:10:51'),
(69, 'amit kumar', 'dmtoakbfar@gmail.com', NULL, '$2y$12$VE.rnr9ju4stabCWHI0qMuWfcUH9VtVlUS7ODrUlJkv80A8jajKgO', NULL, '2024-10-01 22:50:06', '2024-10-01 22:50:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admindetails_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homecontentnames`
--
ALTER TABLE `homecontentnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paymentsetups`
--
ALTER TABLE `paymentsetups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentsetups_name_unique` (`name`);

--
-- Indexes for table `questionpaperfronts`
--
ALTER TABLE `questionpaperfronts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionpapers`
--
ALTER TABLE `questionpapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `studentusers`
--
ALTER TABLE `studentusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
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
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homecontentnames`
--
ALTER TABLE `homecontentnames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `studentusers`
--
ALTER TABLE `studentusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
