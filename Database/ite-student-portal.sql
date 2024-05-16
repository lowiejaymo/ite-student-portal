-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 15, 2024 at 07:10 AM
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
-- Database: `ite-student-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posted_by` varchar(50) NOT NULL,
  `created_on` varchar(50) NOT NULL,
  `account_indx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `heading`, `content`, `posted_by`, `created_on`, `account_indx`) VALUES
(63, 'Sample', 'This is sample announcement', 'Admin', '2024-05-15 08:26:28', 20),
(64, 'sadfasdf', 'asdfasdfasdf', 'Admin', '2024-05-15 13:07:47', 20);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_indx` int(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `remarks` varchar(10) DEFAULT NULL,
  `points` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_indx` int(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_indx`, `event_name`, `date`, `school_year`, `semester`) VALUES
(4, 'Kalingawan First Day IN', '2024-05-01', '2023-2024', 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `account_indx` int(10) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `position` varchar(15) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `program` varchar(5) NOT NULL,
  `year_level` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `profile_picture` varchar(25) NOT NULL DEFAULT 'default.jpg',
  `enrolled_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`account_indx`, `account_number`, `code`, `password`, `username`, `role`, `position`, `last_name`, `first_name`, `middle_name`, `gender`, `program`, `year_level`, `email`, `phone_number`, `profile_picture`, `enrolled_by`) VALUES
(20, '123123', '', '$2y$10$7aIljGndzC67uLlYQsCXXuLjmgvCzw2OatI7lLKy8nCovcox4c2xW', 'admin', 'Admin', '', '', '', '', '', '', '', '', '', 'default.jpg', ''),
(24, '2211600101', 'ZAPANTA , MARIBEL N. - 2211600101 - BSIT', '$2y$10$.P.Po.59/GktVOvXLqJGPOn50IOtVgMWwECJvl4IeYm/bnfuSDFvK', 'mzapanta', 'Student', '', 'Zapanta', 'Maribel', 'Naranjo', 'Female', 'BSIT', '2', '', '', 'default.jpg', 'admin'),
(25, '2211600102', 'ORILLO , LOWIE JAY M. - 2211600102 - BSIT', '$2y$10$yAY5W2HhlspvPbQ1nM93m.jvV4l7c6kwcK8MwOiGSiwCiRybsbptK', 'lorillo', 'Student', '', 'Orillo', 'Lowie Jay', 'Mier', 'Male', 'BSIT', '2', '', '', 'default.jpg', 'admin'),
(27, '123123123', 'DELA CRUZ , SAMPLE A. - 123123123 - BSCS', '$2y$10$4Rmeth9doyuNNdlg2HW0gOyTppq3tRaldN.4Ny7RbwQzsY5YuWwC6', 'sdelacruz', 'Student', '', 'Dela Cruz', 'Sample', 'asd', 'Male', 'BSCS', '2', '', '', 'default.jpg', 'admin'),
(28, '2211600042', 'BOGNOT , BRIAN ANGELO D. - 2211600042 - BSIT', '$2y$10$tORvN6zBvSqUqTpLwMP.q.N9r8c9g59dIPGITBbUbgPslolcQPkHm', 'bbognot', 'Student', '', 'Bognot', 'Brian Angelo', 'Delfin', 'Male', 'BSIT', '2', '', '', 'default.jpg', 'admin'),
(29, '2211600058', 'MANGARON , ARCH LIBEE L. - 2211600058 - BSIT', '$2y$10$E.PYw8UBZeUuUULP5qkyBuP4lQ2KgoLQp.czywTo5U4P44SMRndUO', 'amangaron', 'Student', '', 'Mangaron', 'Arch Libee', 'Lupina', 'Male', 'BSIT', '2', '', '', 'default.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `fk_account_indx` (`account_indx`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_indx`),
  ADD KEY `event_name` (`event_name`),
  ADD KEY `account_number` (`account_number`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_indx`),
  ADD UNIQUE KEY `event_name` (`event_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`account_indx`),
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_indx` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_indx` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `account_indx` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `fk_account_indx` FOREIGN KEY (`account_indx`) REFERENCES `user` (`account_indx`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`event_name`) REFERENCES `events` (`event_name`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`account_number`) REFERENCES `user` (`account_number`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`code`) REFERENCES `user` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
