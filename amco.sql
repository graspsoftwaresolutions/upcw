-- phpMyAdmin SQL Dump
-- version 4.9.5deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2020 at 06:48 PM
-- Server version: 8.0.20-0ubuntu0.19.10.1
-- PHP Version: 7.3.11-0ubuntu0.19.10.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amco`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `company_name` text NOT NULL,
  `status` int DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Maybank', 1, '2020-02-11 16:39:29', '2020-02-11 03:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `company_branches`
--

CREATE TABLE `company_branches` (
  `id` int NOT NULL,
  `company_id` bigint NOT NULL,
  `branch_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_branches`
--

INSERT INTO `company_branches` (`id`, `company_id`, `branch_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test one2', 1, NULL, '2020-05-26 09:48:14'),
(2, 1, 'test btanch', 1, NULL, '2020-05-27 04:38:45'),
(3, 1, 'Center A', 1, NULL, '2020-05-29 12:53:31'),
(4, 1, 'CenterB', 1, NULL, '2020-05-29 12:53:32'),
(5, 1, 'branch as', 1, NULL, '2020-05-30 10:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberprofiles`
--

CREATE TABLE `memberprofiles` (
  `id` bigint UNSIGNED NOT NULL,
  `member_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ic_no_new` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `race` int DEFAULT NULL,
  `race_name` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ic_no_old` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sex` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `postal_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `company_name` int DEFAULT NULL,
  `company_names` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `member_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `employee_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telephone_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telephone_no_office` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telephone_no_hp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entrance_fee` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `monthly_fee` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `recommended_by` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_by` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `member_status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `resign_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberprofiles`
--

INSERT INTO `memberprofiles` (`id`, `member_name`, `ic_no_new`, `race`, `race_name`, `ic_no_old`, `sex`, `dob`, `doj`, `address`, `postal_code`, `company_name`, `company_names`, `position`, `member_no`, `employee_no`, `telephone_no`, `telephone_no_office`, `telephone_no_hp`, `email_id`, `entrance_fee`, `monthly_fee`, `recommended_by`, `supported_by`, `member_status`, `resign_date`, `resign_remark`, `created_at`) VALUES
(1, 'test usdsd', '453453', 2, NULL, NULL, 'female', '2020-05-16', '2019-01-03', NULL, NULL, 1, NULL, NULL, '658435', NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL, '1', NULL, NULL, '2020-05-26 04:18:14'),
(2, 'Murugan', '22222', 2, NULL, NULL, 'female', '0000-00-00', '2020-11-01', NULL, NULL, 1, NULL, NULL, '95865', NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL, '2', '2020-05-30', 'test', '2020-05-26 23:08:44'),
(3, 'Shyni', '22224442', NULL, NULL, NULL, NULL, NULL, '2020-11-01', NULL, NULL, 1, NULL, NULL, '95864', NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, NULL, '1', NULL, NULL, '2020-05-26 23:08:45'),
(4, 'Aminah Binti Alias', '700324015872', NULL, NULL, NULL, NULL, NULL, '2021-01-01', NULL, NULL, 1, NULL, NULL, '10463', NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL, '1', NULL, NULL, '2020-05-29 07:23:31'),
(5, 'Nursyazana Binti Mohd Sanu', '227015124', 2, NULL, NULL, 'female', '2020-05-01', '2021-01-02', NULL, NULL, 1, NULL, NULL, '10479', NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL, '1', NULL, NULL, '2020-05-29 07:23:32'),
(6, 'Ti Shu Sien', '435435435435', NULL, NULL, NULL, NULL, NULL, '2021-01-01', NULL, NULL, 1, NULL, NULL, '10480', NULL, NULL, NULL, NULL, NULL, NULL, '40', NULL, NULL, '1', NULL, NULL, '2020-05-29 07:23:33'),
(7, 'New muruhan', '12121', 3, NULL, NULL, 'male', '2020-05-15', '2020-05-20', 'dfdgfd', '43534543', 1, NULL, 'dfd', '123456', '98765', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '2020-05-29 08:25:46'),
(8, 'Muruhhas', '3434545', 2, NULL, NULL, 'female', '2020-05-07', '2020-05-06', 'sdfdsf', '635245', 1, NULL, NULL, '354685', '95555', NULL, NULL, NULL, '354685@amco.com', NULL, NULL, NULL, NULL, '1', NULL, NULL, '2020-05-30 02:04:08'),
(9, 'testuser', '12345678', 3, NULL, NULL, 'male', '2020-05-20', '2020-05-30', 'hhhhhhhhhhhh', '635204', 1, NULL, 'test', '56878', '98754', '44444', '888888', '25', '56878@amco.com', '5', '8', NULL, NULL, '1', NULL, NULL, '2020-05-30 02:43:21'),
(10, 'Tets muruhan', '454544', NULL, NULL, NULL, NULL, NULL, '2024-01-01', NULL, NULL, 1, NULL, NULL, '1254', NULL, NULL, NULL, NULL, NULL, '10', '15', NULL, NULL, '1', NULL, NULL, '2020-05-30 05:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2014_10_12_000000_create_users_table', 2),
(6, '2020_02_02_070842_create_memberprofiles_table', 3),
(7, '2020_02_03_053615_create_reports_table', 4),
(8, '2020_02_04_162552_create_races_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'MALAY', 1, NULL),
(2, 'CHINESE', 1, NULL),
(3, 'INDIAN', 1, NULL),
(4, 'OTHERS', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statusmonth`
--

CREATE TABLE `statusmonth` (
  `id` int NOT NULL,
  `statusMonth` date DEFAULT NULL,
  `ToMonth` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusmonth`
--

INSERT INTO `statusmonth` (`id`, `statusMonth`, `ToMonth`, `created_at`, `updated_at`) VALUES
(1, '2019-01-01', NULL, '2020-05-26 09:48:13', '2020-05-26 04:18:13'),
(2, '2020-01-01', NULL, '2020-05-26 09:49:12', '2020-05-26 04:19:12'),
(3, '2020-02-01', NULL, '2020-05-26 09:49:14', '2020-05-26 04:19:14'),
(4, '2020-04-01', NULL, '2020-05-26 12:50:39', '2020-05-26 07:20:39'),
(5, '2020-05-01', NULL, '2020-05-26 12:50:43', '2020-05-26 07:20:43'),
(6, '2020-11-01', NULL, '2020-05-27 04:38:43', '2020-05-26 23:08:43'),
(7, '2020-12-01', NULL, '2020-05-27 04:38:46', '2020-05-26 23:08:46'),
(8, '2021-01-01', NULL, '2020-05-29 12:53:30', '2020-05-29 07:23:30'),
(9, '2021-02-01', NULL, '2020-05-29 12:53:34', '2020-05-29 07:23:34'),
(10, '2021-03-01', NULL, '2020-05-29 12:53:36', '2020-05-29 07:23:36'),
(11, '2021-04-01', NULL, '2020-05-29 12:53:37', '2020-05-29 07:23:37'),
(12, '2023-01-01', NULL, '2020-05-30 10:31:20', '2020-05-30 05:01:20'),
(13, '2023-02-01', NULL, '2020-05-30 10:31:22', '2020-05-30 05:01:22'),
(14, '2024-01-01', NULL, '2020-05-30 10:34:39', '2020-05-30 05:04:39'),
(15, '2024-02-01', NULL, '2020-05-30 10:34:42', '2020-05-30 05:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `subcompany`
--

CREATE TABLE `subcompany` (
  `id` int NOT NULL,
  `statusMonth_id` int NOT NULL,
  `company_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcompany`
--

INSERT INTO `subcompany` (`id`, `statusMonth_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-05-26 09:48:13', '2020-05-26 04:18:13'),
(2, 2, 1, '2020-05-26 09:49:13', '2020-05-26 04:19:13'),
(3, 3, 1, '2020-05-26 09:49:14', '2020-05-26 04:19:14'),
(4, 4, 1, '2020-05-26 12:50:40', '2020-05-26 07:20:40'),
(5, 5, 1, '2020-05-26 12:50:43', '2020-05-26 07:20:43'),
(6, 6, 1, '2020-05-27 04:38:44', '2020-05-26 23:08:44'),
(7, 7, 1, '2020-05-27 04:38:46', '2020-05-26 23:08:46'),
(8, 8, 1, '2020-05-29 12:53:30', '2020-05-29 07:23:30'),
(9, 9, 1, '2020-05-29 12:53:34', '2020-05-29 07:23:34'),
(10, 10, 1, '2020-05-29 12:53:36', '2020-05-29 07:23:36'),
(11, 11, 1, '2020-05-29 12:53:38', '2020-05-29 07:23:38'),
(12, 12, 1, '2020-05-30 10:31:20', '2020-05-30 05:01:20'),
(13, 13, 1, '2020-05-30 10:31:23', '2020-05-30 05:01:23'),
(14, 14, 1, '2020-05-30 10:34:40', '2020-05-30 05:04:40'),
(15, 15, 1, '2020-05-30 10:34:43', '2020-05-30 05:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_member`
--

CREATE TABLE `subscription_member` (
  `id` int NOT NULL,
  `subcompany_id` int DEFAULT NULL,
  `member_code` int DEFAULT NULL,
  `sub_cid` int DEFAULT NULL,
  `member_name` varchar(250) DEFAULT NULL,
  `member_no` varchar(250) DEFAULT NULL,
  `member_ic` varchar(250) DEFAULT NULL,
  `subs` float(14,2) NOT NULL,
  `welfare_fee` double NOT NULL,
  `entrance_fee` double NOT NULL,
  `insur` float(14,2) DEFAULT NULL,
  `match_no` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_member`
--

INSERT INTO `subscription_member` (`id`, `subcompany_id`, `member_code`, `sub_cid`, `member_name`, `member_no`, `member_ic`, `subs`, `welfare_fee`, `entrance_fee`, `insur`, `match_no`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 1, 'test usdsd', '658435', '453453', 15.00, 1, 10, NULL, 3, 1, '2020-05-26 09:49:15', '2020-05-26 04:19:15'),
(4, 4, 1, 1, 'test usdsd', '658435', '453453', 15.00, 1, 10, NULL, 3, 1, '2020-05-26 12:50:42', '2020-05-26 07:20:42'),
(5, 5, 1, 1, 'test usdsd', '658435', '453453', 15.00, 1, 10, NULL, 3, 1, '2020-05-26 12:50:43', '2020-05-26 07:20:43'),
(6, 6, 2, 2, 'Murugan', '95865', '22222', 15.00, 1, 10, NULL, 1, 1, '2020-05-27 04:38:45', '2020-05-26 23:08:45'),
(7, 6, 3, 2, 'Shyni', '95864', '22224442', 15.00, 1, 0, NULL, 1, 1, '2020-05-27 04:38:46', '2020-05-26 23:08:46'),
(8, 7, 2, 2, 'Murugan', '95865', '22222', 15.00, 1, 10, NULL, 3, 1, '2020-05-27 04:38:47', '2020-05-26 23:08:47'),
(9, 7, 3, 2, 'Shyni', '95864', '22224442', 15.00, 1, 0, NULL, 3, 1, '2020-05-27 04:38:47', '2020-05-26 23:08:47'),
(10, 8, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, -20, NULL, 1, 1, '2020-05-29 12:53:32', '2020-05-29 07:23:32'),
(11, 8, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, -20, NULL, 1, 1, '2020-05-29 12:53:33', '2020-05-29 07:23:33'),
(12, 8, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, -20, NULL, 1, 1, '2020-05-29 12:53:34', '2020-05-29 07:23:34'),
(13, 9, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:35', '2020-05-29 07:23:35'),
(14, 9, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:35', '2020-05-29 07:23:35'),
(15, 9, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:35', '2020-05-29 07:23:35'),
(16, 10, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:37', '2020-05-29 07:23:37'),
(17, 10, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:37', '2020-05-29 07:23:37'),
(18, 10, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:37', '2020-05-29 07:23:37'),
(19, 11, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:38', '2020-05-29 07:23:38'),
(20, 11, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:38', '2020-05-29 07:23:38'),
(21, 11, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, -20, NULL, 3, 1, '2020-05-29 12:53:39', '2020-05-29 07:23:39'),
(22, 12, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:20', '2020-05-30 05:01:20'),
(23, 12, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:21', '2020-05-30 05:01:21'),
(24, 12, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:21', '2020-05-30 05:01:21'),
(25, 13, 4, 3, 'Aminah Binti Alias', '10463', '700324015872', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:23', '2020-05-30 05:01:23'),
(26, 13, 5, 4, 'Nursyazana Binti Mohd Sanu', '10479', '227015124', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:23', '2020-05-30 05:01:23'),
(27, 13, 6, 4, 'Ti Shu Sien', '10480', '435435435435', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:31:24', '2020-05-30 05:01:24'),
(28, 14, 10, 5, 'Tets muruhan', '1254', '454544', 15.00, 1, 10, NULL, 1, 1, '2020-05-30 10:34:42', '2020-05-30 05:04:42'),
(29, 15, 10, 5, 'Tets muruhan', '1254', '454544', 15.00, 1, 10, NULL, 3, 1, '2020-05-30 10:34:43', '2020-05-30 05:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `sub_match_master`
--

CREATE TABLE `sub_match_master` (
  `id` int NOT NULL,
  `match_name` varchar(250) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_match_master`
--

INSERT INTO `sub_match_master` (`id`, `match_name`, `status`) VALUES
(1, 'Member Number Matched', 1),
(2, 'Member Number Not Matched', 1),
(3, 'Mis-Match Member Name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, 1, '$2y$10$gCKielyYqjEpTUjwtok.zu9igcVPyb2qnR.1eNCi3nca3hTncwKgC', NULL, '2020-01-31 22:25:41', '2020-01-31 22:25:41'),
(2, 'User', 'user@user.com', NULL, 0, '$2y$10$gCKielyYqjEpTUjwtok.zu9igcVPyb2qnR.1eNCi3nca3hTncwKgC', NULL, '2020-01-31 22:25:41', '2020-01-31 22:25:41'),
(3, 'New muruhan', '123456@amco.com', NULL, 0, '$2y$10$GQVW7OtkzZ1k41eIcTcmY.kJ.BgeqlDxdPNc3I.ldpuMNnctLttw6', NULL, NULL, NULL),
(4, 'Muruhhas', '354685@amco.com', NULL, 0, '$2y$10$FtHFkLtWpg/fhnmSuulLP.eWqICqZ3dRn8sYj7RRt9Cc9SzH3inRO', NULL, NULL, NULL),
(5, 'testuser', '56878@amco.com', NULL, 0, '$2y$10$gp3DotCIXJtdg5BQZXZkkuPKHc/gPJnuKlXzbuAQUXY/51df48TMK', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_branches`
--
ALTER TABLE `company_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberprofiles`
--
ALTER TABLE `memberprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statusmonth`
--
ALTER TABLE `statusmonth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcompany`
--
ALTER TABLE `subcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_member`
--
ALTER TABLE `subscription_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_match_master`
--
ALTER TABLE `sub_match_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `company_branches`
--
ALTER TABLE `company_branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberprofiles`
--
ALTER TABLE `memberprofiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statusmonth`
--
ALTER TABLE `statusmonth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subcompany`
--
ALTER TABLE `subcompany`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscription_member`
--
ALTER TABLE `subscription_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sub_match_master`
--
ALTER TABLE `sub_match_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
