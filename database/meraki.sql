-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 01:17 PM
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
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `time` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `message`, `user_id`, `user_name`, `time`, `date`) VALUES
(1, 'Hello World!', 'admin', 'admin', 'June 10 at 3:16 pm', '2024-06-11'),
(2, 'Hi MOM', 'johndoe', 'John Doe', 'June 10 at 3:15 pm', '2024-06-11'),
(20, 'hi', 'admin', 'admin', 'June 11 at 11:57 am', '2024-06-11'),
(24, 'hello senor', 'admin', 'admin', 'June 11 at 12:08 pm', '2024-06-11'),
(58, 'sawcon', 'admin', 'admin', 'June 12 at 3:40 pm', '2024-06-12');

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
('6hPfZ', 124, 'admin', 'admin', '2024-06-12T12:04', 'Done THis/ THAT'),
('wscVJ', 124, 'admin', 'admin', '2024-06-12T12:04', 'All Hail Lelouch');

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
('johndoe', 124, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-06-12T13:56', 'progress');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `img` text NOT NULL DEFAULT '../profile/images/default.png',
  `status` int(1) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `img`, `status`, `admin`, `active`) VALUES
('admin', 'admin', 'usmansaleem4446996@gmail.com', '$2y$10$qZQ0EqmjNcpWF/pbRvF6xOk5L7yo4CdMPyWmbuCCdKf.LfQbA9GdW', '../profile/images/66696f526b6f60.74730033.png', 1, 1, 1),
('admin433', 'admin', 'usmansaleem444@gmail.com', '$2y$10$lXhb.hT.4wZSc.GzPB2mQ.6Q8V1dM8ZAm5MALd51rrkY.kT1oqQnq', '../profile/images/66681e9fc41ae4.14952695.jpg', 0, 0, 1),
('johndoe', 'John Doe', 'symiti@imagepoet.net', '$2y$10$UpK3Gjx60j9rJ6h4uRAnae6sGmO7Ln0Y0L3F7GeWSfyoTV0MAH8PG', '../profile/images/default.png', 1, 0, 1),
('johndoe119', 'John Doe', 'usmansaleem@gmail.com', '$2y$10$pea4pK2Hd/AuFNYU0nOsQ./vUuZQrNNXl4Qhi.KPgYGtXrExfSCJW', '../profile/images/default.png', 0, 0, 1),
('johndoe923', 'John Doe', 'example@example.com', '$2y$10$pgFPAjQfNmxMpxe57oNJ4eSNcc1FevAZtgVJdPOlThNqwnZQJmz6G', '../profile/images/default.png', 0, 0, 1);

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
('admin433', 'UyDn0xEERPEdhRCqFGBKLyqd4iDovVRaEZH2nRrUP3uU5GBX7JHqv2PAO5SnY98t'),
('APOCGCPy', 'Ll3cmhVPQkREvOEymoxrQWexbUp51jYiqVN2ugbZuZVdl7Sv91hRm2xXGtC0ntZg'),
('johndoe1', NULL),
('johndoe9', NULL),
('johndoea', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
