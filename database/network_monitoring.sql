-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2026 at 08:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `alert_type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `device_name` varchar(100) DEFAULT NULL,
  `severity` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `alert_type`, `message`, `device_name`, `severity`, `status`, `created_at`) VALUES
(2, 'High Bandwidth', 'Student PC is using excessive bandwidth', 'PC-01', 'Medium', 'Unread', '2026-07-20 13:53:45'),
(3, 'Device Added', 'New device connected to network', 'Laptop-05', 'Low', 'Unread', '2026-07-20 13:53:45'),
(4, 'Offline Device', 'Device is offline', 'PC-01', 'High', 'Unread', '2026-07-20 14:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `bandwidth`
--

CREATE TABLE `bandwidth` (
  `id` int(11) NOT NULL,
  `device_name` varchar(100) DEFAULT NULL,
  `upload_speed` decimal(5,2) DEFAULT NULL,
  `download_speed` decimal(5,2) DEFAULT NULL,
  `usage_percent` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `available_bandwidth` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bandwidth`
--

INSERT INTO `bandwidth` (`id`, `device_name`, `upload_speed`, `download_speed`, `usage_percent`, `status`, `created_at`, `available_bandwidth`) VALUES
(1, 'Router', 2.50, 5.50, 8, 'Normal', '2026-07-16 15:04:26', NULL),
(2, 'Switch', 1.20, 3.40, 5, 'Normal', '2026-07-16 15:04:26', NULL),
(3, 'Server', 15.50, 50.00, 65, 'High', '2026-07-16 15:04:26', NULL),
(4, 'PC-01', 3.50, 8.20, 12, 'Normal', '2026-07-16 15:04:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `device_name` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `device_type` varchar(50) NOT NULL,
  `status` enum('Online','Offline') DEFAULT 'Offline',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `ip_address`, `mac_address`, `device_type`, `status`, `created_at`) VALUES
(1, 'Router', '192.168.1.1', 'AA:BB:CC:DD:EE:01', 'Router', 'Online', '2026-07-13 07:26:34'),
(2, 'Switch', '192.168.1.2', 'AA:BB:CC:DD:EE:02', 'Switch', 'Online', '2026-07-13 07:26:34'),
(3, 'Server', '192.168.1.10', 'AA:BB:CC:DD:EE:03', 'Server', 'Online', '2026-07-13 07:26:34'),
(4, 'PC-01', '192.168.1.101', 'AA:BB:CC:DD:EE:04', 'PC', 'Offline', '2026-07-13 07:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(100) DEFAULT NULL,
  `ssid` varchar(100) DEFAULT NULL,
  `bandwidth_limit` int(11) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `theme` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `ssid`, `bandwidth_limit`, `admin_email`, `theme`) VALUES
(1, 'Smart Network Monitoring System', 'Office-WiFi', 100, 'admin@gmail.com', 'Dark');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '', 'admin123', 'admin', '2026-07-07 18:34:26'),
(2, 'admin', 'admin@example.com', 'admin123', 'admin', '2026-07-21 16:05:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bandwidth`
--
ALTER TABLE `bandwidth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bandwidth`
--
ALTER TABLE `bandwidth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
