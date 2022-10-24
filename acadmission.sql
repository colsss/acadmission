-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 10:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acadmission`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course`, `status`, `date_added`) VALUES
(1, 1, 'Bachelor of Elementary Education', 1, '2022-10-24 11:48:06'),
(2, 1, 'Bachelor of Secondary Education', 1, '2022-10-24 11:48:23'),
(3, 1, 'Bachelor of Arts in Communication', 1, '2022-10-24 11:48:33'),
(4, 1, 'Bachelor of Science in Social Work', 1, '2022-10-24 11:48:45'),
(5, 2, 'Bachelor of Science in Accountancy', 1, '2022-10-24 11:49:04'),
(6, 2, 'Bachelor of Science in Business Administration', 1, '2022-10-24 11:49:23'),
(7, 2, 'Bachelor of Science in Customs Administration', 1, '2022-10-24 11:49:31'),
(8, 2, 'Bachelor of Science in Real Estate Management', 1, '2022-10-24 11:49:44'),
(9, 3, 'Bachelor of Science in Tourism', 1, '2022-10-24 11:50:15'),
(10, 3, 'Bachelor of Science in Hospitality Management', 1, '2022-10-24 11:50:27'),
(11, 4, 'Bachelor of Science in Computer Science', 1, '2022-10-24 11:50:47'),
(12, 4, 'Bachelor of Science in Information Technology', 1, '2022-10-24 11:50:57'),
(13, 4, 'Bachelor of Science in Information Systems', 1, '2022-10-24 11:51:06'),
(14, 4, 'Bachelor of Science in Entertainment and Multimedia Computing', 1, '2022-10-24 11:51:16'),
(15, 5, 'Bachelor of Science in Criminology', 1, '2022-10-24 11:51:35'),
(16, 6, 'Bachelor of Science in Computer Engineering', 1, '2022-10-24 11:51:57'),
(17, 6, 'Bachelor of Science in Electronics and Communications Engineering', 1, '2022-10-24 11:52:08'),
(18, 7, 'Bachelor of Science in Nursing', 1, '2022-10-24 11:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `status`, `date_added`) VALUES
(1, 'College of Arts and Social Sciences and Education', 1, '2022-10-24 11:45:11'),
(2, 'College of Business', 1, '2022-10-24 11:45:17'),
(3, 'College of Hospitality Management', 1, '2022-10-24 11:45:23'),
(4, 'College of Computing and Information Sciences', 1, '2022-10-24 11:45:29'),
(5, 'College of Criminology', 1, '2022-10-24 11:45:34'),
(6, 'College of Engineering', 1, '2022-10-24 11:45:40'),
(7, 'College of Nursing', 1, '2022-10-24 11:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `first_choice` varchar(255) NOT NULL,
  `second_choice` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`id`, `last_name`, `first_name`, `middle_name`, `address`, `gender`, `email_address`, `password`, `phone_number`, `first_choice`, `second_choice`, `status`, `date_created`) VALUES
(1, 'Quiambao', 'Aljon ', 'Santos', '0199 Kundol Street', 'male', 'aljonq@gmail.com', 'a8a8181a', 2147483647, '1', '11', 1, '2022-10-24 16:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `file_name` varchar(1000) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `item_id`, `file_name`, `date_added`) VALUES
(1, 1, 'profile_1666332900_7.jpg', '2022-10-21 14:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `type`, `date_created`) VALUES
(1, 'Abstract', '2022-10-21 14:12:20'),
(2, 'Multiple Choice', '2022-10-21 14:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `first_name`, `last_name`, `email_address`, `username`, `password`, `date_created`) VALUES
(1, 'profile_1666332900_7.jpg', 'Aljon', 'Quiambao', 'aljonq@gmail.com', 'aljonq', '$2y$10$4vOjUz.AGcoa1Q48LUAPtO4.xHqjvY6l8dofKOuoiFAEYzmG1RjnS', '2022-10-21 14:15:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
