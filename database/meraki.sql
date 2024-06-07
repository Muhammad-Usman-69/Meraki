-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 01:30 PM
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
  `work_id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `user_name` text NOT NULL,
  `time` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `work_id`, `user_id`, `user_name`, `time`, `comment`) VALUES
('xr2DX', 11, 'Xp8OwYlF', 'admin', '2024-06-06T06:00', 'All Hail Lelouch');

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
('johndoe', 'John Doe', 'symiti@imagepoet.net', '$2y$10$UpK3Gjx60j9rJ6h4uRAnae6sGmO7Ln0Y0L3F7GeWSfyoTV0MAH8PG', 'none', 1, 0, 0),
('johndoe119', 'John Doe', 'usmansaleem@gmail.com', '$2y$10$pea4pK2Hd/AuFNYU0nOsQ./vUuZQrNNXl4Qhi.KPgYGtXrExfSCJW', 'none', 0, 0, 0);

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
('johndoea', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` varchar(30) NOT NULL,
  `work_id` int(11) NOT NULL,
  `work_title` varchar(50) NOT NULL,
  `work_desc` varchar(300) NOT NULL,
  `work_time` text NOT NULL,
  `work_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work_id`, `work_title`, `work_desc`, `work_time`, `work_status`) VALUES
('admin', 1, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-01-20T00:00', 'finished'),
('admin', 6, 'Lorem ipsum dolor', 'Lorem 1 ipsum dolor sit amet 1 consectetur adipisicing elit. Laudantium quam awdcorrupti adipisci voluptatum facere, omnis nulla expedita fuga molestiae nodoloremque, earum fugiat dolores nesciunt a u', '2025-01-21T03:06', 'progress'),
('admin', 7, 'Lorem ipsum 3 dolor sit amet consectetur adipisic', 'Lorem ipsum 3 dolor sit amet consectetur adipisicing elit. Laudantium quam corrupti adipisci voluptatum facere, omnis nulla expedita fuga molestiae non doloremque, earum fugiat dolores nesciunt a ulla', '2024-01-20T15:06', 'finished'),
('admin', 8, 'Add security options', 'add function so that update handler and mark handler verify user.', '2024-01-22T11:00', 'progress'),
('admin', 9, 'lorem', 'lorem', '2024-01-19T02:57', 'finished'),
('admin', 10, 'lopppe', 'as', '2024-02-03T09:57', 'progress'),
('admin', 11, 'adaw', 'dawdwa', '2024-01-04T09:57', 'progress'),
('admin', 12, 'awwdawda', 'dawdwadwa', '2024-01-19T09:58', 'finished'),
('admin', 13, 'faa', 'fafa', '2024-01-19T11:25', 'finished'),
('admin', 14, 'a', 'a', '2024-01-19T23:22', 'finished'),
('admin', 16, 'adawaa', 'awd', '2024-01-19T11:26', 'progress'),
('admin', 18, 'ak', 'm4', '2024-01-29T09:12', 'progress'),
('admin', 19, 'adwa', 'awd', '2024-01-29T09:29', 'finished'),
('johndoe119', 20, 'Make A Dashboard', 'add dashboard {done}\r\nadmin can see all task\r\nadmin can assign task to people\r\nadmin can assign task to two people\r\nuser can put comments {done}\r\nadmin can active/inactive user\r\nadmin can add new acco', '2025-03-22T05:30', 'finished');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`),
  ADD UNIQUE KEY `work_title` (`work_title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
