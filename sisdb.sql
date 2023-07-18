-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2023 at 11:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$wKAwBD5ZqcBgJGkm.tWjKOLZjyZhx7tSgO7xLGLUXH8h2F1UI5Dk6');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `student_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`student_id`, `date`, `time`) VALUES
('20051013032', '18/07/2023', '22:26'),
('20051013032', '18/07/2023', '22:27'),
('20051013030', '18/07/2023', '23:10'),
('20051013030', '18/07/2023', '23:27'),
('20051013030', '18/07/2023', '23:36');

-- --------------------------------------------------------

--
-- Table structure for table `guards`
--

CREATE TABLE `guards` (
  `guard_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `otp` tinyint(1) NOT NULL DEFAULT 1,
  `time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`guard_id`, `name`, `password`, `phone`, `profile_picture`, `otp`, `time`) VALUES
('2009', 'English', '$2y$10$WByKGe3BKVY5hdMdyyNKzOEzcBB7Cc6TRG4HkADSxIKpBw38oN8ja', '+255743298320', '64453870842f28.81380026.ronaldo-de-oliveira-_3FfMzwLpN0-unsplash.jpg', 0, '2023-04-23 14:06:55'),
('2010', 'Swahili', '$2y$10$Ys18m4d7yXE8YU4sslTH9.Te31qs8xKS62MC4lcmNo0lhOhM3W.Lm', '+255714775515', '64453ab50f3b60.87676008.Screenshot-1.png', 0, '2023-04-23 14:04:08'),
('2011', 'Mouse', '$2y$10$4i08nz7EppuBKYU6Njz01.uDLkEQ0otDmPwnXyQAyNuxFndOFJ5/e', 'Holaa', '64454126e407d0.89650572.510fbedf-670b-4a53-b3e7-0d90d530ecfd.jpg', 0, '2023-04-23 19:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `checkin` varchar(50) NOT NULL,
  `checkout` varchar(50) NOT NULL,
  `guard_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `date`, `checkin`, `checkout`, `guard_id`) VALUES
(12, '23/04/2023', '22:19', '22:20', '2011'),
(13, '18/07/2023', '19:10', 'on duty', '2011'),
(14, '19/07/2023', '00:42', '00:47', '2011');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `admission_number` varchar(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`admission_number`, `course`, `first_name`, `last_name`, `profile_picture`) VALUES
('20051013029', 'BCS', 'Hamisa', 'Mobeto', '644534500d54e7.40712058.des.png'),
('20051013030', 'BCS', 'Baraka', 'Nduluman', ''),
('20051013031', 'BIT', 'Azim', 'Kajubu', ''),
('20051013032', 'BIT', 'Faraji', 'Kajubu', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `guards`
--
ALTER TABLE `guards`
  ADD UNIQUE KEY `guard_id` (`guard_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `guard_id` (`guard_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `admissin_number` (`admission_number`),
  ADD KEY `admissin_number_2` (`admission_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`admission_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`guard_id`) REFERENCES `guards` (`guard_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
