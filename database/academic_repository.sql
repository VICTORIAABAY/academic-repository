-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2022 at 10:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic_repository`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(2, 'book'),
(1, 'past paper');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education_level`
--

CREATE TABLE `tbl_education_level` (
  `education_level_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repository`
--

CREATE TABLE `tbl_repository` (
  `repository_id` int(11) NOT NULL,
  `reposotory_name` varchar(50) NOT NULL,
  `visibility` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `owner` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_repository`
--

INSERT INTO `tbl_repository` (`repository_id`, `reposotory_name`, `visibility`, `description`, `data_created`, `owner`, `is_deleted`) VALUES
(1, 'najma', 'private', 'repository fro pastpaper', '2022-06-11 18:40:31', 3, 0),
(2, 'this is new repository', 'public', 'repository fro pastpaper', '2022-06-11 18:44:10', 3, 1),
(3, 'luggiestar_new', 'private', 'repository fro pastpaper', '2022-06-11 18:45:34', 3, 1),
(4, 'shija', 'private', 'repository fro pastpaper', '2022-06-29 18:28:45', 3, 0),
(5, 'shja', 'public', 'exam', '2022-06-29 18:32:36', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repository_item`
--

CREATE TABLE `tbl_repository_item` (
  `repository_item_id` int(11) NOT NULL,
  `commit` varchar(30) NOT NULL,
  `file` varchar(50) NOT NULL,
  `file_type` char(5) NOT NULL,
  `repository_item_category` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `repository` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_repository_item`
--

INSERT INTO `tbl_repository_item` (`repository_item_id`, `commit`, `file`, `file_type`, `repository_item_category`, `created_at`, `repository`) VALUES
(1, 'This is My Commit', 'lightness.docx', 'docx', 2, '2022-06-14 14:33:23', 2),
(2, 'This is My Commit', 'VICENT.docx', 'docx', 2, '2022-06-21 09:49:44', 2),
(3, 'Hellow', 'MultiAgentSystem.docx', 'docx', 2, '2022-06-21 11:26:48', 3),
(4, 'This is My Commit', 'MultiAgentSystem.docx', 'docx', 1, '2022-06-29 18:27:16', 1),
(5, 'Hellow', 'VICENT.docx', 'docx', 1, '2022-06-29 18:29:02', 4),
(6, 'This is My Commit', 'MultiAgentSystem.docx', 'docx', 1, '2022-06-29 18:32:47', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_university`
--

CREATE TABLE `tbl_university` (
  `university_id` int(11) NOT NULL,
  `university_name` varchar(50) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `sex` char(1) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `token` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(15) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `first_name`, `last_name`, `sex`, `phone`, `email`, `username`, `active`, `token`, `password`, `user_type`) VALUES
(1, 'Lugano', 'Mwakapuku', 'F', 788999888, 'luggiestar@gmail.com', 'luggie', 1, '3463667880', '$2y$10$IgJw4q8Bmq6oRuO/uGY/3.i3ohNXTf2UtJGy5Fy36mPkdDX6yMUcW', 'user'),
(2, 'Hilda', 'msonge', 'F', 688999234, 'hilda@gmail.com', 'conso', 1, '2767284615', '$2y$10$luJYr58ZxsAVReGivd2HaeA3EQlu4h4ZYWwQ1rQY5q2G.TqM8VLLi', 'user'),
(3, 'Gwakisa', 'Mwakapuku', 'F', 7543627181, 'gwakisa@gmail.com', 'gwakisa', 1, '4477561449', '$2y$10$ttGoWgPktP5yHNbyeTNs0ectr2r7sfUUK/LtsuGW3Iyqe0s.7Oq1.', 'user'),
(4, 'SHija', 'Mwalugwemw', 'M', 762506012, 'shija@gmail.com', 'shija', 1, '1943466706', '$2y$10$EemWL0FVbY12oeKtqj0qoOpgKk8ZwBlZg.TqppBMnYZh9Z1tIJvcO', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profile`
--

CREATE TABLE `tbl_user_profile` (
  `profile_id` int(11) NOT NULL,
  `education_level` int(11) NOT NULL,
  `university` int(11) NOT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `user` int(11) NOT NULL,
  `program` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passowrd` varchar(64) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `username`, `passowrd`, `role`) VALUES
(1, 'test', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_education_level`
--
ALTER TABLE `tbl_education_level`
  ADD PRIMARY KEY (`education_level_id`);

--
-- Indexes for table `tbl_repository`
--
ALTER TABLE `tbl_repository`
  ADD PRIMARY KEY (`repository_id`),
  ADD UNIQUE KEY `reposotory_name` (`reposotory_name`,`owner`),
  ADD KEY `user_repository_fk` (`owner`);

--
-- Indexes for table `tbl_repository_item`
--
ALTER TABLE `tbl_repository_item`
  ADD PRIMARY KEY (`repository_item_id`),
  ADD KEY `repository_item_fk` (`repository`),
  ADD KEY `category_repository_item` (`repository_item_category`);

--
-- Indexes for table `tbl_university`
--
ALTER TABLE `tbl_university`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_profile_fk` (`user`),
  ADD KEY `education_level_profile_fk` (`education_level`),
  ADD KEY `university_profile_fk` (`university`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_education_level`
--
ALTER TABLE `tbl_education_level`
  MODIFY `education_level_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_repository`
--
ALTER TABLE `tbl_repository`
  MODIFY `repository_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_repository_item`
--
ALTER TABLE `tbl_repository_item`
  MODIFY `repository_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_university`
--
ALTER TABLE `tbl_university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_repository`
--
ALTER TABLE `tbl_repository`
  ADD CONSTRAINT `user_repository_fk` FOREIGN KEY (`owner`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_repository_item`
--
ALTER TABLE `tbl_repository_item`
  ADD CONSTRAINT `category_repository_item` FOREIGN KEY (`repository_item_category`) REFERENCES `tbl_category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `repository_item_fk` FOREIGN KEY (`repository`) REFERENCES `tbl_repository` (`repository_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD CONSTRAINT `education_level_profile_fk` FOREIGN KEY (`education_level`) REFERENCES `tbl_education_level` (`education_level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `university_profile_fk` FOREIGN KEY (`university`) REFERENCES `tbl_university` (`university_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_profile_fk` FOREIGN KEY (`user`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `role_user` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
