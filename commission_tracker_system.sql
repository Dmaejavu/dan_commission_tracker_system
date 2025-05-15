-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 06:07 PM
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
-- Database: `commission_tracker_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agentID` int(11) NOT NULL,
  `agentname` varchar(50) NOT NULL,
  `comrate` double NOT NULL,
  `area` enum('Davao','Samal','Cotabato','Mati') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agentID`, `agentname`, `comrate`, `area`, `created_at`, `updated_at`) VALUES
(1, 'Paul Oborskies', 0.3, 'Samal', NULL, '2025-05-14 09:08:41'),
(2, 'Dan Abdul Ajaym', 0.2, 'Cotabato', NULL, NULL),
(3, 'Wiley Da Fred', 0.2, 'Mati', NULL, NULL),
(4, 'Skibidi Jose', 0.2, 'Samal', NULL, NULL),
(5, 'Vee Nigeer', 0.5, 'Davao', '2025-05-06 06:19:01', '2025-05-06 06:19:01'),
(7, 'tung tung sahur', 0.3, 'Cotabato', '2025-05-08 07:07:46', '2025-05-08 07:52:12'),
(8, 'Gelo Belo', 0.4, 'Davao', '2025-05-10 00:13:01', '2025-05-12 06:36:36'),
(10, 'BOMBARDINO CROCODILLO', 0.4, 'Davao', '2025-05-12 06:29:03', '2025-05-12 06:36:28'),
(11, 'Paul Theives', 0.4, 'Davao', '2025-05-12 06:37:43', '2025-05-12 06:37:43'),
(12, 'Master Baiter', 0.9, 'Davao', '2025-05-12 07:55:02', '2025-05-12 07:55:02'),
(13, 'tralelo tralala', 0.2, 'Davao', '2025-05-12 16:05:22', '2025-05-12 16:05:22'),
(14, 'Wiley Da Friendly Ghost', 0.2, 'Davao', '2025-05-14 08:57:29', '2025-05-14 17:27:25'),
(15, 'Basher Amp', 0.1, 'Samal', '2025-05-14 17:27:52', '2025-05-14 17:27:52');

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
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `cardID` int(11) NOT NULL,
  `banktype` enum('BDO','BPI','CBC') NOT NULL,
  `cardtype` enum('Silver','Gold','Platinum') NOT NULL,
  `prices` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`cardID`, `banktype`, `cardtype`, `prices`) VALUES
(1, 'BDO', 'Silver', 5000),
(2, 'BDO', 'Gold', 10000),
(3, 'BDO', 'Platinum', 15000),
(4, 'BPI', 'Silver', 4500),
(5, 'BPI', 'Gold', 9500),
(6, 'BPI', 'Platinum', 14500),
(7, 'CBC', 'Silver', 10000),
(8, 'CBC', 'Gold', 12000),
(9, 'CBC', 'Platinum', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `comID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `agentID` int(11) NOT NULL,
  `totalcom` double NOT NULL,
  `clientname` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Canceled') NOT NULL,
  `cardID` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2025_05_02_172332_create_cache_table', 1),
(3, '2025_05_02_172332_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(60) NOT NULL,
  `position` enum('Admin','Owner','UnitManager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `position`) VALUES
(1, 'admin1', '$2y$12$2/jgRFUemqScQ2.4Bn1SOuVfUB7CGA7C60koz1Q/ti2eugxjnV9rO', 'Admin'),
(2, 'owner1', '$2y$12$jIkym5rw9DTzneKpX0iAiuqCJk0fPg.TzVbQwC2PxFHUJRwBNsUpO', 'Owner'),
(3, 'unitmanager1', '$2y$12$PJcYtDRphy91EGIyWuws6eVgQ.YPNG.KddpbLmaUY2OpX9B7qnZQG', 'UnitManager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agentID`);

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
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`cardID`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`comID`),
  ADD KEY `commissions_userid_foreign` (`userID`),
  ADD KEY `commissions_agentid_foreign` (`agentID`),
  ADD KEY `commissions_cardid_foreign` (`cardID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `comID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `commissions_agentid_foreign` FOREIGN KEY (`agentID`) REFERENCES `agents` (`agentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `commissions_cardid_foreign` FOREIGN KEY (`cardID`) REFERENCES `cards` (`cardID`) ON DELETE CASCADE,
  ADD CONSTRAINT `commissions_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
