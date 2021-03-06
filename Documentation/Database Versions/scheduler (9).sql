-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 07:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `BID` int(11) NOT NULL,
  `building_name` varchar(50) NOT NULL,
  `building_abbreviation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`BID`, `building_name`, `building_abbreviation`) VALUES
(9, 'Wooster Hall', 'WH'),
(10, 'Lecture Center', 'LC'),
(11, 'Resnick Engineering Hall', 'REH'),
(12, 'Engineering Innovation Hub', 'EIH');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `short_name` varchar(6) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `PROGRAM` varchar(2) NOT NULL,
  `required_RID` int(11) DEFAULT NULL,
  `num_credits` int(2) NOT NULL,
  `contact_hours` varchar(4) NOT NULL,
  `semester_offered` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CID`, `title`, `short_name`, `is_active`, `PROGRAM`, `required_RID`, `num_credits`, `contact_hours`, `semester_offered`) VALUES
(25, 'Digital Logic Fundamentals', 'EGC220', 1, 'CE', NULL, 3, '45', ''),
(26, 'Digital Logic Lab', 'EGC221', 1, 'CE', NULL, 1, '45', NULL),
(27, 'C/C++ Programming', 'EGC251', 1, 'CE', NULL, 3, '45', NULL),
(28, 'Digital Systems Design', 'EGC320', 1, 'CE', NULL, 3, '45', NULL),
(29, 'Microcontroller System Design', 'EGC331', 1, 'CE', NULL, 3, '45', ''),
(31, 'Circuit Analysis', 'EGE200', 0, 'EE', 16, 3, '45', '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `PID` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `write` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`PID`, `user_type`, `read`, `write`, `edit`, `delete`) VALUES
(4, 'scheduler', 1, 1, 1, 1),
(5, 'viewer', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `PROGRAM` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`PROGRAM`) VALUES
('CE'),
('EE'),
('GE'),
('ME');

-- --------------------------------------------------------

--
-- Table structure for table `requisites`
--

CREATE TABLE `requisites` (
  `CID` int(11) NOT NULL,
  `req_CID` int(11) NOT NULL,
  `req_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  `room_num` varchar(5) NOT NULL,
  `short_name` varchar(25) NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `is_exclusive` tinyint(1) NOT NULL,
  `max_seats` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RID`, `BID`, `room_num`, `short_name`, `is_required`, `is_exclusive`, `max_seats`) VALUES
(16, 9, '219', 'WH219', 0, 0, 24),
(17, 9, '221', 'WH221', 0, 0, 30),
(18, 9, '225', 'WH225', 0, 0, 30),
(19, 9, '223', 'WH223', 0, 0, 30),
(20, 12, '218', 'EIH218', 0, 0, 30),
(21, 11, '111', 'REH111', 0, 0, 30),
(22, 11, '110', 'REH110', 0, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `SID` int(11) NOT NULL,
  `SEID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `section_num` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `SEID` int(11) NOT NULL,
  `season` varchar(8) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`SEID`, `season`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(1, 'Spring', '2020-01-06', '2020-05-15', '08:00:00', '20:00:00'),
(2, 'Summer', '2020-05-25', '2020-07-30', '08:00:00', '20:00:00'),
(3, 'Fall', '2020-08-17', '2020-12-04', '08:00:00', '20:00:00'),
(4, 'Winter', '2020-12-07', '2021-01-15', '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `time_keeper`
--

CREATE TABLE `time_keeper` (
  `TKID` int(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days_of_week` int(10) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `UID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `max_credits` int(2) NOT NULL,
  `min_credits` int(2) NOT NULL,
  `PROGRAM` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`UID`, `PID`, `email`, `password`, `first_name`, `last_name`, `max_credits`, `min_credits`, `PROGRAM`) VALUES
(17, 4, 'admin@email.com', '1234', 'Admin', 'Administrator', 0, 0, NULL),
(18, 5, 'anotheradmin@email.com', '1234', 'another', 'admin', 10, 3, 'CE'),
(19, 4, '', '', '', '', 0, 0, 'CE'),
(22, 4, 'test@email.com', '1234', 'test', 'testing', 10, 1, 'CE'),
(31, 5, 'instructor@email.com', '1234', 'In', 'Structor', 15, 1, 'CE'),
(32, 4, 'test2@email.com', '1234', 'Test', 'Testing', 15, 3, 'CE'),
(33, 5, 'test3@email.com', '1234', 'Austin', 'D', 10, 1, 'CE'),
(34, 5, 'instructor1@email.com', '1234', 'In', 'Structor', 9, 1, 'CE');

-- --------------------------------------------------------

--
-- Table structure for table `user_schedule`
--

CREATE TABLE `user_schedule` (
  `USID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `SEID` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_schedule`
--

INSERT INTO `user_schedule` (`USID`, `UID`, `SEID`, `day`, `start_time`, `end_time`) VALUES
(5, 22, 1, 'Sunday', '08:00:00', '20:00:00'),
(7, 22, 1, 'Friday', '01:12:00', '05:54:00'),
(8, 22, 1, 'Saturday', '01:34:00', '12:34:00'),
(9, 22, 1, 'Friday', '01:34:00', '12:34:00'),
(11, 32, 2, 'Sunday', '08:53:00', '19:55:00'),
(12, 32, 2, 'Monday', '08:53:00', '19:55:00'),
(13, 33, 4, 'Sunday', '07:58:00', '19:58:00'),
(14, 33, 4, 'Monday', '07:58:00', '19:58:00'),
(15, 34, 4, 'Monday', '08:13:00', '20:13:00'),
(16, 34, 4, 'Tuesday', '08:13:00', '20:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `week_day`
--

CREATE TABLE `week_day` (
  `WDID` int(11) NOT NULL,
  `SCID` int(11) NOT NULL,
  `SEID` int(11) NOT NULL,
  `day_of_week` varchar(12) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `RID` (`required_RID`),
  ADD KEY `program` (`PROGRAM`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`PROGRAM`);

--
-- Indexes for table `requisites`
--
ALTER TABLE `requisites`
  ADD PRIMARY KEY (`CID`,`req_CID`,`req_type`),
  ADD KEY `CID` (`CID`),
  ADD KEY `CID_pre` (`req_CID`),
  ADD KEY `CID_pre_2` (`req_CID`),
  ADD KEY `CID_co` (`req_type`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `BID` (`BID`),
  ADD KEY `BID_2` (`BID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `CID` (`CID`),
  ADD KEY `FID` (`UID`),
  ADD KEY `RID` (`RID`),
  ADD KEY `SEID` (`SEID`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`SEID`);

--
-- Indexes for table `time_keeper`
--
ALTER TABLE `time_keeper`
  ADD PRIMARY KEY (`TKID`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `PID` (`PID`),
  ADD KEY `program` (`PROGRAM`);

--
-- Indexes for table `user_schedule`
--
ALTER TABLE `user_schedule`
  ADD PRIMARY KEY (`USID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `SEID` (`SEID`);

--
-- Indexes for table `week_day`
--
ALTER TABLE `week_day`
  ADD PRIMARY KEY (`WDID`),
  ADD KEY `SCID` (`SCID`),
  ADD KEY `SEID` (`SEID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `SEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_keeper`
--
ALTER TABLE `time_keeper`
  MODIFY `TKID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_schedule`
--
ALTER TABLE `user_schedule`
  MODIFY `USID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `week_day`
--
ALTER TABLE `week_day`
  MODIFY `WDID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`PROGRAM`) REFERENCES `programs` (`PROGRAM`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`required_RID`) REFERENCES `rooms` (`RID`);

--
-- Constraints for table `requisites`
--
ALTER TABLE `requisites`
  ADD CONSTRAINT `requisites_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`BID`) REFERENCES `buildings` (`BID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`RID`) REFERENCES `rooms` (`RID`),
  ADD CONSTRAINT `schedule_ibfk_5` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`),
  ADD CONSTRAINT `schedule_ibfk_6` FOREIGN KEY (`UID`) REFERENCES `user_data` (`UID`);

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `permissions` (`PID`),
  ADD CONSTRAINT `user_data_ibfk_3` FOREIGN KEY (`program`) REFERENCES `programs` (`PROGRAM`),
  ADD CONSTRAINT `user_data_ibfk_4` FOREIGN KEY (`PROGRAM`) REFERENCES `programs` (`PROGRAM`);

--
-- Constraints for table `user_schedule`
--
ALTER TABLE `user_schedule`
  ADD CONSTRAINT `user_schedule_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user_data` (`UID`),
  ADD CONSTRAINT `user_schedule_ibfk_2` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`);

--
-- Constraints for table `week_day`
--
ALTER TABLE `week_day`
  ADD CONSTRAINT `week_day_ibfk_1` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
