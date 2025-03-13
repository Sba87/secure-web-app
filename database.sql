-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 12:37 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure_web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_attempts`
--

CREATE TABLE `password_reset_attempts` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_reset_attempts`
--

INSERT INTO `password_reset_attempts` (`id`, `email`, `timestamp`) VALUES
(1, '102702@oryx.edu.qa', '2025-03-13 08:16:11'),
(2, '102702@oryx.edu.qa', '2025-03-13 08:16:28'),
(3, '102702@oryx.edu.qa', '2025-03-13 09:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`id`, `username`, `filename`, `uploaded_at`) VALUES
(1, 'saoud', 'scriptalert(\'XSS Attack!\');script.txt', '2025-03-13 09:42:25'),
(2, 'saoud', 'scriptalert(\'XSS Attack!\');script.txt', '2025-03-13 09:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `reset_token`, `reset_expiry`) VALUES
(1, 'saoud', 'oryx@gmail.com', '$2y$10$QK0D/VTvIs3nkBRRKK/rjeMn6kxe8Nh3VYoUF0LqzD.xphq0OSnpK', '2025-03-10 22:15:42', NULL, NULL),
(2, 'saoud', 'oryx@gmail.com', '$2y$10$.I0EMMcJswSt8Kvy7cZAjuxhr6Pm9FtZZRkuliu7FqWNflSNQPnVG', '2025-03-10 22:55:54', NULL, NULL),
(3, 'saoud', 'oryx@gmail.com', '$2y$10$WKJ7Rb0DtkA2jkpORmHCDOO709mRfdfC/SaUnE147FCksZrGLCiGC', '2025-03-10 22:55:55', NULL, NULL),
(4, 'test', 'test@gmail.com', '$2y$10$QRA4ZDSqaEAW.jpeg0NNOuhMc7neQl8RZOFp8fAli33tYz1nTFJL.', '2025-03-10 23:00:24', NULL, NULL),
(5, 'test1111', '102702@oryx.edu.qa', '$2y$10$oopwh8JNhw0f9dwFAeYfb.Sr4PVlPt/ZM./bXc6/tNXYjmyZcSfAq', '2025-03-13 04:50:16', 'dc9fe2431b1df94ea664dadd5622310d', '2025-03-13 08:26:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset_attempts`
--
ALTER TABLE `password_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
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
-- AUTO_INCREMENT for table `password_reset_attempts`
--
ALTER TABLE `password_reset_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
