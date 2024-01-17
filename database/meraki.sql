-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 08:37 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`) VALUES
(1, 'admin', 'usmansaleem4446996@gmail.com', '$2y$10$qZQ0EqmjNcpWF/pbRvF6xOk5L7yo4CdMPyWmbuCCdKf.LfQbA9GdW');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `work_title` varchar(50) NOT NULL,
  `work_desc` text NOT NULL,
  `work_time` text NOT NULL,
  `work_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `work_id`, `work_title`, `work_desc`, `work_time`, `work_status`) VALUES
(1, 1, 'Complete the project of meraki!', 'Complete the project of meraki! As soon as possible so that You improve. Put back end, add funtionablity in your project.', '2024-01-20T00:00', 'progress'),
(1, 6, 'Lorem ipsum dolor sit amet consectetur', 'Lorem 1 ipsum dolor sit amet 1 consectetur adipisicing elit. Laudantium quam awdcorrupti adipisci voluptatum facere, omnis nulla expedita fuga molestiae nodoloremque, earum fugiat dolores nesciunt a ullam eius tempore fugit vitae quaerat. Eum sint veniam, laboriosam voluptas perferendis, asperiores praesentium aliquam placeat ducimus porro delectus possimus! Culpa iste nobiawds, id consectetur magni facilis soluta est, rerum laboriosam aliquid illum modi cumque deleniti impedit. Cumque explicabo, distinctio veniam temporibus unde esse rem ad provident eaque vitae, doloremque corrupti quasi. Nisi, maxime vero! Dolor modi dignissimos recusandae unde amet officiis fuga est nam beatae repellendus atque reiciendis, temporibus quo voluptates qui cum natus! Nihil unde quisquam adipisci maiores deserunt blanditiis perferendis ipsum cupiditate odio, similique, quod eaque hic incidunt, animi nesciunt commodi dolorum qui? Itaque quasi soluta in dolorem placeat obcaecati quis nam quae, exercitationem eveniet, nesciunt dicta, corrupti voluptas nostrum architecto maxime magnam ex provident harum facilis reiciendis blanditiis ducimus doloremque. Possimus natus et rem iure explicabo adipisci vel deleniti libero non doloremque fugiat, mollitia minima quo sunt qui voluptate quia eius eos enim aperiam facere ipsum! At libero similique, placeat ex vitae fuga facilis, dolores totam a quaerat sit soluta repudiandae minima eius molestias? Vel, inventore? Enim nulla fuga dolor!\r\n\r\n', '2025-01-21T03:06', 'progress'),
(1, 7, 'Lorem ipsum 3 dolor sit amet consectetur adipisici', 'Lorem ipsum 3 dolor sit amet consectetur adipisicing elit. Laudantium quam corrupti adipisci voluptatum facere, omnis nulla expedita fuga molestiae non doloremque, earum fugiat dolores nesciunt a ullam eius tempore fugit vitae quaerat. Eum sint veniam, laboriosam voluptas perferendis, asperiores praesentium aliquam placeat ducimus porro delectus possimus! Culpa iste nobis, id consectetur magni facilis soluta est, rerum laboriosam aliquid illum modi cumque deleniti impedit. Cumque explicabo, distinctio veniam temporibus unde esse rem ad provident eaque vitae, doloremque corrupti quasi. Nisi, maxime vero! Dolor modi dignissimos recusandae unde amet officiis fuga est nam beatae repellendus atque reiciendis, temporibus quo voluptates qui cum natus! Nihil unde quisquam adipisci maiores deserunt blanditiis perferendis ipsum cupiditate odio, similique, quod eaque hic incidunt, animi nesciunt commodi dolorum qui? Itaque quasi soluta in dolorem placeat obcaecati quis nam quae, exercitationem eveniet, nesciunt dicta, corrupti voluptas nostrum architecto maxime magnam ex provident harum facilis reiciendis blanditiis ducimus doloremque. Possimus natus et rem iure explicabo adipisci vel deleniti libero non doloremque fugiat, mollitia minima quo sunt qui voluptate quia eius eos enim aperiam facere ipsum! At libero similique, placeat ex vitae fuga facilis, dolores totam a quaerat sit soluta repudiandae minima eius molestias? Vel, inventore? Enim nulla fuga dolor!\r\n\r\n', '2024-01-20T15:06', 'progress');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
