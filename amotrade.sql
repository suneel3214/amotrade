-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2022 at 08:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amotrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `system_city_id` int(10) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `district` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `authenticator`
--

CREATE TABLE `authenticator` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `business_profiles`
--

CREATE TABLE `business_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `business_sub_type` varchar(191) DEFAULT NULL,
  `contact_person` varchar(191) DEFAULT NULL,
  `verification_status` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_status` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `bio` varchar(191) DEFAULT NULL,
  `establishment` varchar(191) DEFAULT NULL,
  `employees_number` varchar(191) DEFAULT NULL,
  `turnover` varchar(191) DEFAULT NULL,
  `nature_of_business` varchar(191) DEFAULT NULL,
  `profile_baseurl` varchar(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_profiles`
--

INSERT INTO `business_profiles` (`id`, `user_id`, `profile_image`, `business_sub_type`, `contact_person`, `verification_status`, `email`, `email_verified_status`, `website`, `bio`, `establishment`, `employees_number`, `turnover`, `nature_of_business`, `profile_baseurl`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 10, NULL, 'Dealer', NULL, 'Applied', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-07-08 00:36:41', '2022-07-08 00:36:41'),
(5, 11, NULL, 'Dealer', NULL, 'Applied', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-07-08 12:55:54', '2022-07-08 12:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `commodities`
--

CREATE TABLE `commodities` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `system_comm_id` int(10) NOT NULL,
  `industry` varchar(191) DEFAULT NULL,
  `category` varchar(191) DEFAULT NULL,
  `varient` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commodities`
--

INSERT INTO `commodities` (`id`, `business_id`, `system_comm_id`, `industry`, `category`, `varient`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, '2022-07-11 19:49:38', '2022-07-11 19:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `doc_type` varchar(191) DEFAULT NULL,
  `doc_id` int(10) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `verified_status` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 411747 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656357582, 1656357582),
(2, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 785270 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656699234, 1656699234),
(3, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 265195 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656699379, 1656699379),
(4, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 466118 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656699415, 1656699415),
(5, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 148927 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656699472, 1656699472),
(6, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MobileVerification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MobileVerification\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\MobileVerification\\\":9:{s:35:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000mobile\\\";s:10:\\\"8817056896\\\";s:32:\\\"\\u0000App\\\\Jobs\\\\MobileVerification\\u0000otp\\\";s:58:\\\"Use 818832 as the code to verify your phone number on AMOT\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1656699542, 1656699542);

-- --------------------------------------------------------

--
-- Table structure for table `master_categories`
--

CREATE TABLE `master_categories` (
  `id` int(10) NOT NULL,
  `industry_id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_categories`
--

INSERT INTO `master_categories` (`id`, `industry_id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pulses', 1, '2022-07-11 18:59:14', '2022-07-11 18:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE `master_city` (
  `id` int(10) NOT NULL,
  `district_id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) NOT NULL,
  `longitude` varchar(191) NOT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_commodities`
--

CREATE TABLE `master_commodities` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `search_tags` text DEFAULT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_commodities`
--

INSERT INTO `master_commodities` (`id`, `category_id`, `unit_id`, `name`, `image`, `display_name`, `search_tags`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Chana', 'chana.jpeg', 'Chana', 'Chana, muter', 1, '2022-07-11 19:04:08', '2022-07-11 19:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `master_country`
--

CREATE TABLE `master_country` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_district`
--

CREATE TABLE `master_district` (
  `id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `name` int(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_industries`
--

CREATE TABLE `master_industries` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_industries`
--

INSERT INTO `master_industries` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Agriculture ', 1, '2022-07-11 18:57:57', '2022-07-11 21:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `master_specification`
--

CREATE TABLE `master_specification` (
  `id` int(11) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE `master_state` (
  `id` int(11) NOT NULL,
  `country_id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `short_name` varchar(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_units`
--

CREATE TABLE `master_units` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_varients`
--

CREATE TABLE `master_varients` (
  `id` int(10) NOT NULL,
  `commodity_id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `search_tags` text DEFAULT NULL,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_numbers`
--

CREATE TABLE `mobile_numbers` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `number` varchar(191) DEFAULT NULL,
  `is_visible` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(191) DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `mobile_number` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `mobile_verified_at` datetime DEFAULT NULL,
  `business_type` varchar(191) DEFAULT NULL,
  `business_name` varchar(191) DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `terms_check` int(10) NOT NULL DEFAULT 0,
  `is_active` int(10) NOT NULL DEFAULT 0,
  `user_type` varchar(191) DEFAULT NULL,
  `referral_code` varchar(191) DEFAULT NULL,
  `session_id` int(10) DEFAULT NULL,
  `device_id` varchar(191) DEFAULT NULL,
  `language_id` int(10) DEFAULT NULL,
  `registration` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `designation`, `mobile_number`, `password`, `code`, `mobile_verified_at`, `business_type`, `business_name`, `location`, `terms_check`, `is_active`, `user_type`, `referral_code`, `session_id`, `device_id`, `language_id`, `registration`, `created_at`, `updated_at`) VALUES
(9, 'Amit Dahnagr', NULL, '8817056896', NULL, '$2y$10$aPfjr7WzQF7UVWoDF33ZNef0Qb91slM/vd/J.5JmC18GFh7WN3BhG', NULL, 'Trade', 'SKYLLO', 'Amit Dahnagr', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, '2022-06-28 00:38:14', '2022-07-07 23:14:44'),
(10, 'amit', 'software', '8085107775', NULL, '$2y$10$XW9WJRklq7XBG1SZwzQzKui42gW4cqBbWx8Qw.qayUngMlf2QHchK', NULL, 'Trade', 'skyllo', 'ind', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, '2022-07-07 23:10:40', '2022-07-08 00:38:35'),
(11, 'Swapnil Jain', 'CEO', '9899299006', NULL, '$2y$10$cLgzKZu1QXUsLxTGBgKUl.SdhtWIYirVla2kTjBGwhLo0ps9gIJqi', NULL, 'Broker', 'AMO', 'Indore', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, '2022-07-08 12:46:34', '2022-07-08 12:55:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authenticator`
--
ALTER TABLE `authenticator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_profiles`
--
ALTER TABLE `business_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commodities`
--
ALTER TABLE `commodities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_categories`
--
ALTER TABLE `master_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_city`
--
ALTER TABLE `master_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_commodities`
--
ALTER TABLE `master_commodities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_country`
--
ALTER TABLE `master_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_district`
--
ALTER TABLE `master_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_industries`
--
ALTER TABLE `master_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_specification`
--
ALTER TABLE `master_specification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_units`
--
ALTER TABLE `master_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_varients`
--
ALTER TABLE `master_varients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_numbers`
--
ALTER TABLE `mobile_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authenticator`
--
ALTER TABLE `authenticator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_profiles`
--
ALTER TABLE `business_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commodities`
--
ALTER TABLE `commodities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_categories`
--
ALTER TABLE `master_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_city`
--
ALTER TABLE `master_city`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_commodities`
--
ALTER TABLE `master_commodities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_country`
--
ALTER TABLE `master_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_district`
--
ALTER TABLE `master_district`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_industries`
--
ALTER TABLE `master_industries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_specification`
--
ALTER TABLE `master_specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_units`
--
ALTER TABLE `master_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_varients`
--
ALTER TABLE `master_varients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobile_numbers`
--
ALTER TABLE `mobile_numbers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
