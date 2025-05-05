-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 10:42 AM
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
-- Database: `bank_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `target`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'pasang tenda', 3, 5, '2025-04-21 18:34:47', '2025-04-21 18:34:47'),
(2, 'api unggun', 10, 4, '2025-04-22 20:10:48', '2025-04-22 20:10:48'),
(3, 'bawa air', 15, 5, '2025-04-22 20:14:20', '2025-04-22 20:14:20'),
(4, 'kebersihan', 20, 4, '2025-04-23 17:40:07', '2025-04-23 17:40:07'),
(5, 'kesehatan', 10, 4, '2025-04-23 17:40:26', '2025-04-23 17:40:26'),
(6, 'konstruksi', 5, 1, '2025-04-27 22:37:28', '2025-04-27 22:37:28'),
(7, 'cocok tanam', 11, 1, '2025-04-27 22:37:42', '2025-04-27 22:37:42'),
(8, 'buang sampah', 4, 5, '2025-04-28 00:06:07', '2025-04-28 00:06:07'),
(10, 'bongkar muat', 10, 2, '2025-05-01 19:58:01', '2025-05-01 19:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1746407758),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1746407758;', 1746407758);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'aut', '2025-03-19 21:10:09', '2025-03-19 21:10:09'),
(2, 'nesciunt', '2025-03-19 21:10:09', '2025-03-19 21:10:09'),
(3, 'eum', '2025-03-19 21:10:09', '2025-03-19 21:10:09'),
(4, 'lambung', '2025-03-30 10:11:34', '2025-03-30 10:11:34'),
(5, 'pramuka', '2025-03-30 10:11:40', '2025-03-30 10:11:40'),
(6, 'unmul', '2025-03-31 07:03:02', '2025-03-31 07:03:02'),
(7, 'atlit', '2025-04-07 19:05:51', '2025-04-07 19:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `civilians`
--

CREATE TABLE `civilians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `born_place` varchar(255) NOT NULL,
  `born_date` date NOT NULL,
  `nik` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `married_status` tinyint(1) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilians`
--

INSERT INTO `civilians` (`id`, `full_name`, `gender`, `born_place`, `born_date`, `nik`, `home_address`, `married_status`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Cinthia Gina Halimah S.Ked', '1', 'officia', '2017-10-18', '1549715036231221', 'Jl. repudiandae', 1, '08147253752', '2025-03-19 21:10:09', '2025-03-31 07:03:55'),
(2, 'Hasim Dongoran M.Farm', '1', 'odit', '1972-02-26', '3365477663632122', 'Jl. repellat', 1, '081102064395', '2025-03-19 21:10:09', '2025-03-28 22:22:37'),
(3, 'Tantri Namaga M.Pd', '0', 'quod', '2007-04-04', '2142628614682354', 'Jl. rem', 1, '082103414992', '2025-03-19 21:10:09', '2025-03-28 22:21:55'),
(6, 'Adli Suryadin', '0', 'zzz', '2003-12-09', '1234567890123456', 'Jln.mangga 3', 0, '085249361531', '2025-03-24 18:32:47', '2025-03-24 18:32:47'),
(7, 'fff', '0', 'fff', '2025-03-14', '1234567890123456', 'Jl. Perjuangan ', 0, '085249361531', '2025-03-30 10:10:56', '2025-03-30 10:10:56'),
(8, 'lofi', '1', 'bbb', '2018-06-17', '1354828505295746', 'Jl. Perjuangan 3', 1, '085249361531', '2025-04-07 18:20:34', '2025-04-07 18:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `civilian_jobs`
--

CREATE TABLE `civilian_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_place` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilian_jobs`
--

INSERT INTO `civilian_jobs` (`id`, `job_place`, `created_at`, `updated_at`) VALUES
(1, 'sunt', '2025-03-19 21:10:09', '2025-03-19 21:10:09'),
(2, 'nihil', '2025-03-19 21:10:09', '2025-03-19 21:10:09'),
(3, 'at', '2025-03-19 21:10:09', '2025-03-19 21:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `civilian_pivot_activities`
--

CREATE TABLE `civilian_pivot_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `civilian_id` bigint(20) UNSIGNED NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilian_pivot_activities`
--

INSERT INTO `civilian_pivot_activities` (`id`, `activity_id`, `civilian_id`, `progress`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '2025-04-23 21:20:20', '2025-04-27 22:51:31'),
(2, 4, 2, 9, '2025-04-24 19:43:54', '2025-05-04 23:06:04'),
(3, 5, 2, 8, '2025-04-24 19:43:54', '2025-04-28 00:09:52'),
(4, 1, 1, 3, '2025-04-24 21:44:25', '2025-04-29 18:22:48'),
(5, 3, 1, 16, '2025-04-24 21:44:25', '2025-04-29 18:22:48'),
(6, 6, 7, 1, '2025-04-27 22:38:06', '2025-04-27 22:49:01'),
(7, 7, 7, 2, '2025-04-27 22:38:06', '2025-04-27 22:52:40'),
(8, 6, 8, 2, '2025-04-27 22:48:26', '2025-04-27 22:50:53'),
(9, 7, 8, 1, '2025-04-27 22:48:26', '2025-04-27 22:48:26'),
(10, 8, 1, 3, '2025-04-29 18:21:48', '2025-04-30 17:23:05'),
(11, 6, 2, 0, '2025-04-30 10:40:21', '2025-05-04 23:04:03'),
(12, 7, 2, 2, '2025-04-30 10:40:21', '2025-04-30 10:42:29'),
(14, 10, 3, 2, '2025-05-01 19:58:24', '2025-05-04 22:54:37'),
(15, 1, 8, 1, '2025-05-04 21:48:11', '2025-05-04 21:48:11'),
(16, 3, 8, 0, '2025-05-04 21:48:11', '2025-05-04 21:48:11'),
(17, 8, 8, 0, '2025-05-04 21:48:11', '2025-05-04 21:48:11'),
(18, 10, 7, 1, '2025-05-04 23:14:11', '2025-05-04 23:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `civilian_pivot_categories`
--

CREATE TABLE `civilian_pivot_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `civilian_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilian_pivot_categories`
--

INSERT INTO `civilian_pivot_categories` (`id`, `civilian_id`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 6, 3, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 2, 3, NULL, NULL),
(6, 7, 1, NULL, NULL),
(7, 7, 2, NULL, NULL),
(8, 1, 5, NULL, NULL),
(9, 1, 6, NULL, NULL),
(10, 8, 1, NULL, NULL),
(11, 8, 5, NULL, NULL),
(12, 2, 1, NULL, NULL),
(13, 2, 4, NULL, NULL),
(14, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `civilian_pivot_jobs`
--

CREATE TABLE `civilian_pivot_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `civilian_id` bigint(20) UNSIGNED NOT NULL,
  `civilian_job_id` bigint(20) UNSIGNED NOT NULL,
  `accepted_date` varchar(255) NOT NULL,
  `retirement_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilian_pivot_jobs`
--

INSERT INTO `civilian_pivot_jobs` (`id`, `civilian_id`, `civilian_job_id`, `accepted_date`, `retirement_date`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2013', '2021', '2025-03-24 18:32:47', '2025-03-24 18:32:47'),
(2, 3, 1, '2012', '2021', '2025-03-28 22:21:55', '2025-03-28 22:21:55'),
(3, 2, 2, '2013', '2018', '2025-03-28 22:22:37', '2025-03-28 22:22:37'),
(4, 7, 3, '2012', '2021', '2025-03-30 10:10:56', '2025-03-30 10:10:56'),
(5, 1, 2, '2017', 'Sekarang', '2025-03-31 07:03:55', '2025-03-31 07:03:55'),
(6, 8, 2, '2014', '2023', '2025-04-07 18:20:34', '2025-04-07 18:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `civilian_pivot_subscriptions`
--

CREATE TABLE `civilian_pivot_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `civilian_id` bigint(20) UNSIGNED NOT NULL,
  `paid_months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `debit` decimal(12,2) NOT NULL DEFAULT 0.00 COMMENT 'Total pembayaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civilian_pivot_subscriptions`
--

INSERT INTO `civilian_pivot_subscriptions` (`id`, `subscription_id`, `civilian_id`, `paid_months`, `created_at`, `updated_at`, `debit`) VALUES
(22, 4, 1, '[\"2025-04\"]', '2025-04-10 19:48:50', '2025-05-04 23:31:52', 300000.00),
(23, 1, 2, '[\"2025-03\",\"2025-04\"]', '2025-04-10 19:48:55', '2025-05-01 22:09:28', 200000.00),
(24, 3, 3, '[\"2025-03\"]', '2025-04-10 19:49:08', '2025-04-28 00:07:41', 300000.00),
(25, 6, 8, '[\"2025-04\",\"2025-05\",\"2025-06\"]', '2025-05-04 17:56:33', '2025-05-05 00:13:33', 300000.00);

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_education` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `expense_date` date DEFAULT NULL,
  `is_income` tinyint(1) NOT NULL DEFAULT 0,
  `subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `civilian_pivot_subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_name`, `amount`, `expense_date`, `is_income`, `subscription_id`, `civilian_pivot_subscription_id`, `created_at`, `updated_at`) VALUES
(27, 'iuran Hasim Dongoran M.Farm', 100000.00, NULL, 1, 1, 23, '2025-04-16 00:23:31', '2025-04-16 00:23:31'),
(31, 'aaaa', 100000.00, NULL, 0, 1, NULL, '2025-04-20 20:47:32', '2025-04-20 20:47:32'),
(32, 'iuran Tantri Namaga M.Pd', 300000.00, NULL, 1, 3, 24, '2025-04-28 00:07:41', '2025-04-28 00:07:41'),
(33, 'iuran Hasim Dongoran M.Farm', 100000.00, NULL, 1, 1, 23, '2025-05-01 22:09:28', '2025-05-01 22:09:28'),
(41, 'sss', 800.00, NULL, 0, 1, NULL, '2025-05-04 23:20:25', '2025-05-04 23:20:25'),
(48, 'iuran lofi', 100000.00, NULL, 1, 6, 25, '2025-05-05 00:13:00', '2025-05-05 00:13:00'),
(49, 'iuran lofi', 100000.00, NULL, 1, 6, 25, '2025-05-05 00:13:03', '2025-05-05 00:13:03'),
(50, 'iuran lofi', 100000.00, NULL, 1, 6, 25, '2025-05-05 00:13:33', '2025-05-05 00:13:33'),
(52, 'Saldo Awal', 10000000.00, NULL, 1, 6, NULL, '2025-05-05 00:18:54', '2025-05-05 00:18:54');

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
-- Table structure for table `liabilities`
--

CREATE TABLE `liabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `born_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `last_education` varchar(255) NOT NULL,
  `civilian_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liabilities`
--

INSERT INTO `liabilities` (`id`, `full_name`, `born_date`, `gender`, `last_education`, `civilian_id`, `created_at`, `updated_at`) VALUES
(1, 'fff', '2020-06-09', 'Pria', 'Belum menempuh pendidikan', 6, '2025-03-24 18:32:47', '2025-03-24 18:32:47'),
(2, 'ggg', '2025-03-12', 'Pria', 'D4/S1', 3, '2025-03-28 22:21:55', '2025-03-28 22:21:55'),
(3, 'eee', '2025-02-24', 'Wanita', 'S3', 2, '2025-03-28 22:22:37', '2025-03-28 22:22:37'),
(4, 'vvv', '2025-03-04', 'Pria', 'SMP sederajat', 7, '2025-03-30 10:10:56', '2025-03-30 10:10:56'),
(5, 'vvv', '2025-02-27', 'Pria', 'SD sederajat', 1, '2025-03-31 07:03:55', '2025-03-31 07:03:55'),
(6, 'Adli Suryadin', '2024-02-08', 'Wanita', 'SMP sederajat', 8, '2025-04-07 18:20:34', '2025-04-07 18:20:34');

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
(4, '2024_03_20_045609_create_educations_table', 1),
(5, '2025_01_08_054529_create_civilians_table', 1),
(6, '2025_02_27_093999_create_liabilities_table', 1),
(7, '2025_03_08_054226_create_categories_table', 1),
(8, '2025_03_08_054644_create_civilian_pivot_categories_table', 1),
(9, '2025_03_08_055226_create_civilian_jobs_table', 1),
(10, '2025_03_08_081240_create_subscriptions_table', 1),
(11, '2025_03_10_073803_create_civilian_pivot_jobs_table', 1),
(12, '2025_03_17_025741_create_civilian_pivot_subscriptions_table', 1),
(13, '2025_03_28_204135_add_paid_months_to_civilian_pivot_subscription', 2),
(14, '2025_03_31_170906_alter_civilian_pivot_subscriptions_paid_months', 3),
(15, '2025_04_09_015333_alter_table_civilian_pivot_subscriptions_drop_column_temp_amount', 4),
(16, '2025_04_09_081826_create_expenses_table', 5),
(17, '2025_04_09_082235_alter_table_civilian_pivot_subscriptions_add_column_total_paid', 5),
(18, '2025_04_09_084032_create_expenses_table', 6),
(19, '2025_04_10_062046_change_amount_type_in_subscriptions_table', 7),
(20, '2025_04_11_015606_modify_civilian_pivot_subscriptions_table', 8),
(21, '2025_04_11_040812_add_civilian_pivot_subscription_id_to_expenses', 9),
(22, '2025_04_15_025419_add_is_income_to_expenses_table', 10),
(23, '2025_04_15_035727_add_expense_date_to_expenses_table', 11),
(24, '2025_04_21_030535_create_detail_categories_table', 12),
(25, '2025_04_22_015954_create_activities_table', 13),
(26, '2025_04_24_032117_create_civilian_pivot_activities_table', 14),
(27, '2025_05_02_063137_add_initial_balance_to_subscriptions', 15);

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
('4BYwLT9s9X9Ortqu4xDNsjRcV87dfmdeeWLUB5fJ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiMXEwWXJGRWV1VzBEc0ZydlRCNDNSTUFjR0tFMXFnYVB0VE92bVhtMyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAva2V1YW5nYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkU2NJY2ZQY1J5MmRVbUNZVU0yLzVHZW44ZUZBL3BQUU1DWGJHb1M1d2dHZEZpbjVuOHpjU0siO3M6ODoiZmlsYW1lbnQiO2E6MDp7fXM6NjoidGFibGVzIjthOjE6e3M6MjM6Ikxpc3REYXRhV2FyZ2FzX3Blcl9wYWdlIjtzOjI6IjEwIjt9fQ==', 1746434422);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `initial_balance` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `category_id`, `created_at`, `updated_at`, `amount`, `initial_balance`) VALUES
(1, 'air A', 1, '2025-03-20 00:16:49', '2025-05-04 22:31:46', 1000.00, NULL),
(2, 'air B', 3, '2025-03-20 00:17:06', '2025-03-20 00:17:06', 1500.00, NULL),
(3, 'listrik C', 2, '2025-03-20 00:17:18', '2025-05-04 18:03:34', 3000.00, NULL),
(4, 'sampah unmul', 6, '2025-03-31 07:04:23', '2025-05-04 22:39:54', 3000.00, NULL),
(5, 'sampah lambung', 4, '2025-03-31 07:04:48', '2025-05-04 17:47:09', 2200.00, NULL),
(6, 'listrik A', 5, '2025-05-04 17:56:04', '2025-05-05 00:18:54', 1000.00, 10000000.00);

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
(1, 'adli', 'admin@admin.id', NULL, '$2y$12$ScIcfPcRy2dUmCYUM2/5Gen8eFA/pPQMCXbGoS5wgGdFin5n8zcSK', NULL, '2025-03-19 21:09:34', '2025-03-19 21:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_category_id_foreign` (`category_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civilians`
--
ALTER TABLE `civilians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civilian_jobs`
--
ALTER TABLE `civilian_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civilian_pivot_activities`
--
ALTER TABLE `civilian_pivot_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilian_pivot_activities_activity_id_foreign` (`activity_id`),
  ADD KEY `civilian_pivot_activities_civilian_id_foreign` (`civilian_id`);

--
-- Indexes for table `civilian_pivot_categories`
--
ALTER TABLE `civilian_pivot_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilian_pivot_categories_civilian_id_foreign` (`civilian_id`),
  ADD KEY `civilian_pivot_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `civilian_pivot_jobs`
--
ALTER TABLE `civilian_pivot_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilian_pivot_jobs_civilian_id_foreign` (`civilian_id`),
  ADD KEY `civilian_pivot_jobs_civilian_job_id_foreign` (`civilian_job_id`);

--
-- Indexes for table `civilian_pivot_subscriptions`
--
ALTER TABLE `civilian_pivot_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilian_pivot_subscriptions_subscription_id_foreign` (`subscription_id`),
  ADD KEY `civilian_pivot_subscriptions_civilian_id_foreign` (`civilian_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_subscription_id_foreign` (`subscription_id`),
  ADD KEY `expenses_civilian_pivot_subscription_id_foreign` (`civilian_pivot_subscription_id`);

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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liabilities`
--
ALTER TABLE `liabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liabilities_civilian_id_foreign` (`civilian_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `civilians`
--
ALTER TABLE `civilians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `civilian_jobs`
--
ALTER TABLE `civilian_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `civilian_pivot_activities`
--
ALTER TABLE `civilian_pivot_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `civilian_pivot_categories`
--
ALTER TABLE `civilian_pivot_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `civilian_pivot_jobs`
--
ALTER TABLE `civilian_pivot_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `civilian_pivot_subscriptions`
--
ALTER TABLE `civilian_pivot_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liabilities`
--
ALTER TABLE `liabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `civilian_pivot_activities`
--
ALTER TABLE `civilian_pivot_activities`
  ADD CONSTRAINT `civilian_pivot_activities_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `civilian_pivot_activities_civilian_id_foreign` FOREIGN KEY (`civilian_id`) REFERENCES `civilians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `civilian_pivot_categories`
--
ALTER TABLE `civilian_pivot_categories`
  ADD CONSTRAINT `civilian_pivot_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `civilian_pivot_categories_civilian_id_foreign` FOREIGN KEY (`civilian_id`) REFERENCES `civilians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `civilian_pivot_jobs`
--
ALTER TABLE `civilian_pivot_jobs`
  ADD CONSTRAINT `civilian_pivot_jobs_civilian_id_foreign` FOREIGN KEY (`civilian_id`) REFERENCES `civilians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `civilian_pivot_jobs_civilian_job_id_foreign` FOREIGN KEY (`civilian_job_id`) REFERENCES `civilian_jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `civilian_pivot_subscriptions`
--
ALTER TABLE `civilian_pivot_subscriptions`
  ADD CONSTRAINT `civilian_pivot_subscriptions_civilian_id_foreign` FOREIGN KEY (`civilian_id`) REFERENCES `civilians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `civilian_pivot_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_civilian_pivot_subscription_id_foreign` FOREIGN KEY (`civilian_pivot_subscription_id`) REFERENCES `civilian_pivot_subscriptions` (`id`),
  ADD CONSTRAINT `expenses_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liabilities`
--
ALTER TABLE `liabilities`
  ADD CONSTRAINT `liabilities_civilian_id_foreign` FOREIGN KEY (`civilian_id`) REFERENCES `civilians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
