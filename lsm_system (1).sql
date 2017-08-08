-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2017 at 03:18 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsm_system`
--
CREATE DATABASE IF NOT EXISTS `lsm_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lsm_system`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leaves`
--

DROP TABLE IF EXISTS `tbl_leaves`;
CREATE TABLE `tbl_leaves` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `reason` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_leaves`
--

INSERT INTO `tbl_leaves` (`id`, `transaction_code`, `employee_id`, `supervisor_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, '001', 1, 4, '2017-07-20 00:00:00', '2017-07-21 00:00:00', 'sick', 1, '2017-07-20 10:23:25', '2017-07-20 02:30:51'),
(2, '002', 1, 5, '2017-07-24 00:00:00', '2017-07-25 00:00:00', 'I am very busy urgent tasks.', 0, '2017-07-24 04:54:54', '2017-07-23 21:54:54'),
(3, '003', 8, 4, '2017-07-25 00:00:00', '2017-07-25 00:00:00', 'I am bc.', 0, '2017-07-25 00:26:25', '2017-07-25 00:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-07-25 02:54:03', '2017-07-24 19:54:03'),
(2, 'HR', '2017-07-25 04:01:09', '2017-07-24 21:01:09'),
(3, 'CEO', '2017-07-25 04:01:27', '2017-07-24 21:01:27'),
(4, 'Supervisor', '2017-07-25 04:01:39', '2017-07-24 21:01:39'),
(5, 'Employee', '2017-07-25 04:01:48', '2017-07-24 21:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `position` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage_by` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `position`, `department`, `gender`, `total_date`, `manage_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'phalla chab', 'phalla@gmail.com', '$2y$10$c8H37vgaEXnO0A9hfXmHXOkEWxjWsVndPicjna5xI84h7n9xDg0/u', 1, 'GM', 'Account', 'Female', '18', 1, 'VOGHZOgyRU2mPviEkMgtNmtgQbnCYJb5wRpbED7IVMDOlH4LB7Yqcgp7PQwU', '2017-07-19 20:37:53', '2017-07-23 23:42:38'),
(4, 'Saray', 'saray@gmail.com', '$2y$10$c8H37vgaEXnO0A9hfXmHXOkEWxjWsVndPicjna5xI84h7n9xDg0/u', 2, 'HR', 'IT', 'Female', '12', 1, 'DV86zNSUoelR8Xn8STyVDP52zW7rFGrmJjcm8fDE5y2XRKTLaFmmn3zdnWZG', '2017-07-20 02:15:10', '2017-07-24 21:56:56'),
(5, 'sokly', 'sokly@gmail.com', '$2y$10$M9AjBX5MMETuu3VoR5StYOAtBvPUVDLIwJnzVLjHxQ.Q7PfSuZI.y', 5, 'HR', 'HR', 'Female', '18', 1, NULL, '2017-07-23 18:34:24', '2017-07-24 21:02:58'),
(6, 'sara', 'sara@gmail.com', '$2y$10$0ppzzPhVjjeQVSVjeKLXp.8FZ5Y/KJuL7fGTgKOaHecCEfSFNyF26', 3, 'IT support', 'IT', 'Female', '18', 1, 'zSWrAs4Y9nsXA4OxBFW2Eorb471yI4YmgnnNxWuEr6odov6IGRmcZiCYlDUW', '2017-07-23 18:35:08', '2017-07-24 21:03:13'),
(7, 'lala', 'lala@gmail.com', '$2y$10$ysG8O3e0AphtfFL1Ni7aS.Ak.jf4.dsopcAsBxPmPkuJ0c81k64WW', 5, 'recept', 'HR', 'Female', '18', 1, 'wcsclTpGrnDY9XLhr1Hzt8awmoNY6cd7s0KOq4AMbkHsm63oaig7z4kQc2TM', '2017-07-24 03:01:24', '2017-07-24 21:03:33'),
(8, 'Sokna', 'sokna@gmail.com', '$2y$10$vrjA7lYjHjHWakhOhOSzUOJo89upm/22XnoMaPHlbnz3c7iI.GSEy', 4, 'Senior Developer', 'IT', 'Female', '18', 4, NULL, '2017-07-25 00:06:24', '2017-07-25 00:17:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
