-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 28, 2024 at 04:48 AM
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
  `position` varchar(255) NOT NULL,
  `posted_on` date NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_indx` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL DEFAULT 'Absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_indx`, `event_id`, `account_number`, `remarks`) VALUES
(321, 11, '2211600036', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department`) VALUES
('CAS'),
('CCJ'),
('CE'),
('ITE');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `enrolled_indx` int(11) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`enrolled_indx`, `account_number`, `school_year`, `semester`) VALUES
(313, '2211600036', '2024-2025', 'First Semester'),
(314, '2211600042', '2024-2025', 'First Semester');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `date`, `school_year`, `semester`, `points`) VALUES
(11, 'Kalingawan 2024', '2024-06-25', '2024-2025', 'First Semester', 50);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_indx` int(11) NOT NULL,
  `payment_for_id` int(11) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `proof_pic` varchar(255) NOT NULL,
  `date_paid` date NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `cn_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_indx`, `payment_for_id`, `account_number`, `remarks`, `proof_pic`, `date_paid`, `received_by`, `cn_number`) VALUES
(2, 19, '2211600036', 'Unpaid', '2211600036_19.jpg', '0000-00-00', '', ''),
(313, 18, '2211600036', 'Paid', '2211600036_18.png', '2024-06-04', 'Orillo, Lowie Jay', 'TT'),
(314, 18, '2211600042', 'Paid', '2211600042_18.png', '2024-06-30', 'Orillo, Lowie Jay', 'TT');

-- --------------------------------------------------------

--
-- Table structure for table `payment_for`
--

CREATE TABLE `payment_for` (
  `payment_for_id` int(11) NOT NULL,
  `payment_description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_for`
--

INSERT INTO `payment_for` (`payment_for_id`, `payment_description`, `date`, `school_year`, `semester`, `amount`) VALUES
(18, 'College shirt', '2024-06-20', '2024-2025', 'First Semester', 500),
(19, 'Scam lang', '2024-07-19', '2024-2025', 'First Semester', 200);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `school_year` varchar(255) NOT NULL,
  `dfault` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`school_year`, `dfault`) VALUES
('2022-2023', 0),
('2023-2024', 0),
('2024-2025', 1),
('2025-2026', 0),
('2026-2027', 0),
('2027-2028', 0),
('2028-2029', 0),
('2029-2030', 0);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester` varchar(255) NOT NULL,
  `dfault` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester`, `dfault`) VALUES
('First Semester', 1),
('Second Semester', 0),
('Third Semester', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `account_number` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `is_verified` int(2) NOT NULL DEFAULT 0,
  `new_email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `enrolled_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`account_number`, `code`, `password`, `username`, `role`, `position`, `last_name`, `first_name`, `middle_name`, `gender`, `department`, `program`, `year_level`, `email`, `verification_code`, `is_verified`, `new_email`, `phone_number`, `profile_picture`, `enrolled_by`) VALUES
('1', '71824', '$2y$10$refJtR.Rcgd7.rdzaNY3PO03Q6ljfj4NIzBd5Lv9EnJHry7T2lQI.', 'bbognot', 'Officer', 'President', 'Bognot', 'Brian Angelo', '', 'Male', 'ITE', '', '', '', '', 1, '', '', '1.png', 'admin'),
('2211600036', 'SUBALDO , CARYL MAE C. - 2211600036 - BSIT.png', '$2y$10$15ZNp.C7TWvFad6iHogeIOEfb.HL45VdNCQxmT5bLsnqz5truMdkO', 'csubaldo', 'Student', '', 'Subaldo', 'Caryl Mae', 'C', 'Female', 'ITE', 'BSIT', '2', '', '', 1, '', '', 'default.jpg', 'bbognot'),
('2211600042', 'BOGNOT , BRIAN ANGELO D. - 2211600042 - BSIT.png', '$2y$10$2bzL8db9ZcxrXdvD0e3Qre/rQuWrowZaXBeFsn5XaTkXsT3T7Hb12', 'bbognot', 'Student', '', 'Bognot', 'Brian Angelo', 'Delfin', 'Male', 'ITE', 'BSIT', '2', '', '', 0, '', '', 'default.jpg', 'admin'),
('admin', '', '$2y$10$7aIljGndzC67uLlYQsCXXuLjmgvCzw2OatI7lLKy8nCovcox4c2xW', 'admin', 'Admin', 'Admin', 'Orillo', 'Lowie Jay', '', '', 'ITE', '', '', 'itestudentportal@gmail.com', '508516', 1, '', '', 'admin.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_indx`),
  ADD KEY `account_number` (`account_number`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`enrolled_indx`),
  ADD KEY `account_number` (`account_number`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_indx`),
  ADD KEY `account_number` (`account_number`),
  ADD KEY `payment_for_id` (`payment_for_id`);

--
-- Indexes for table `payment_for`
--
ALTER TABLE `payment_for`
  ADD PRIMARY KEY (`payment_for_id`),
  ADD KEY `school_year` (`school_year`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`school_year`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`account_number`),
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `department` (`department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `enrolled_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `payment_for`
--
ALTER TABLE `payment_for`
  MODIFY `payment_for_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`school_year`),
  ADD CONSTRAINT `announcement_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `user` (`account_number`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `user` (`account_number`),
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`school_year`),
  ADD CONSTRAINT `enrolled_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`school_year`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `user` (`account_number`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`payment_for_id`) REFERENCES `payment_for` (`payment_for_id`);

--
-- Constraints for table `payment_for`
--
ALTER TABLE `payment_for`
  ADD CONSTRAINT `payment_for_ibfk_1` FOREIGN KEY (`school_year`) REFERENCES `school_year` (`school_year`),
  ADD CONSTRAINT `payment_for_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `semester` (`semester`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`department`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
