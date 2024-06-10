-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 11:03 AM
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
-- Database: `meraki`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` varchar(5) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `user_name` text NOT NULL,
  `time` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `task_id`, `user_id`, `user_name`, `time`, `comment`) VALUES
('3D8wb', 1, 'admin', 'admin', '2024-06-10T02:00', 'dawdawdawdaaw');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` varchar(30) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_title` varchar(50) NOT NULL,
  `task_desc` varchar(300) NOT NULL,
  `task_time` text NOT NULL,
  `task_status` varchar(10) NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_id`, `task_title`, `task_desc`, `task_time`, `task_status`) VALUES
('admin', 1, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-01-21T00:00', 'progress'),
('johndoe', 124, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-06-12T13:56', 'progress'),
('johndoe119', 125, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-06-12T13:56', 'progress');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `img` text NOT NULL,
  `status` int(1) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `img`, `status`, `admin`, `active`) VALUES
('admin', 'admin', 'usmansaleem4446996@gmail.com', '$2y$10$qZQ0EqmjNcpWF/pbRvF6xOk5L7yo4CdMPyWmbuCCdKf.LfQbA9GdW', '65c756a1d9d021.98410873.png', 1, 1, 1),
('johndoe', 'John Doe', 'symiti@imagepoet.net', '$2y$10$UpK3Gjx60j9rJ6h4uRAnae6sGmO7Ln0Y0L3F7GeWSfyoTV0MAH8PG', 'none', 1, 0, 1),
('johndoe119', 'John Doe', 'usmansaleem@gmail.com', '$2y$10$pea4pK2Hd/AuFNYU0nOsQ./vUuZQrNNXl4Qhi.KPgYGtXrExfSCJW', 'none', 0, 0, 1),
('johndoe923', 'John Doe', 'example@example.com', '$2y$10$pgFPAjQfNmxMpxe57oNJ4eSNcc1FevAZtgVJdPOlThNqwnZQJmz6G', 'none', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` varchar(8) NOT NULL,
  `verification_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `verification_code`) VALUES
('APOCGCPy', 'Ll3cmhVPQkREvOEymoxrQWexbUp51jYiqVN2ugbZuZVdl7Sv91hRm2xXGtC0ntZg'),
('johndoe1', NULL),
('johndoe9', NULL),
('johndoea', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `verification_id` (`verification_code`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
