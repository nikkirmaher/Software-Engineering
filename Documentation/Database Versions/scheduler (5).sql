-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 11:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

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
(5, 'Wooster Hall', 'WH'),
(6, 'Lecture Center', 'LC'),
(7, 'Resnick Engineering Hall', 'REH'),
(8, 'Engineering Innovation Hub', 'EIH');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `course` varchar(6) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `program` varchar(3) NOT NULL,
  `required_RID` int(11) DEFAULT NULL,
  `num_credits` int(2) NOT NULL,
  `contact_hours` int(3) NOT NULL,
  `semester_offered` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CID`, `title`, `course`, `is_active`, `program`, `required_RID`, `num_credits`, `contact_hours`, `semester_offered`) VALUES
(20, 'Digital Logic Fundamentals', 'EGC220', 1, 'EGC', NULL, 3, 0, ''),
(21, 'Digital Logic Lab', 'EGC221', 1, 'EGC', NULL, 1, 0, ''),
(22, 'C/C++ Programming', 'EGC251', 1, 'EGC', NULL, 3, 0, ''),
(23, 'Digital Systems Design', 'EGC320', 1, 'EGC', NULL, 3, 0, ''),
(24, 'Microcontroller System Design', 'EGC331', 1, 'EGC', NULL, 3, 0, '');

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

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `PROGRAM` varchar(100) NOT NULL,
  `ee` varchar(2) NOT NULL,
  `ce` varchar(2) NOT NULL,
  `me` varchar(2) NOT NULL,
  `ge` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  `room_num` varchar(5) NOT NULL,
  `short_name` varchar(25) NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `is_exclusive` tinyint(1) NOT NULL,
  `max_seats` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RID`, `BID`, `room_num`, `short_name`, `is_required`, `is_exclusive`, `max_seats`) VALUES
(8, 5, '219', 'WH219', 1, 0, 24),
(9, 5, '221', 'WH221', 0, 0, 30),
(10, 5, '225', 'WH225', 1, 0, 30),
(11, 5, '223', 'WH223', 0, 0, 30),
(12, 5, '218', 'EIH218', 0, 0, 30),
(13, 7, '110', 'REH110', 0, 0, 30),
(14, 7, '111', 'REH111', 0, 0, 30);

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
  `name` varchar(8) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `season` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `UPID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `max_credits` int(2) NOT NULL,
  `min_credits` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `program` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_schedule`
--

CREATE TABLE `user_schedule` (
  `USID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `day` varchar(11) NOT NULL,
  `available_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `RID` (`required_RID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `requisites`
--
ALTER TABLE `requisites`
  ADD PRIMARY KEY (`CID`,`req_CID`,`req_type`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `BID` (`BID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `SEID` (`SEID`),
  ADD KEY `CID` (`CID`),
  ADD KEY `FID` (`UID`),
  ADD KEY `RID` (`RID`);

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
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `FID` (`UPID`),
  ADD KEY `PID` (`PID`);

--
-- Indexes for table `user_schedule`
--
ALTER TABLE `user_schedule`
  ADD PRIMARY KEY (`USID`),
  ADD UNIQUE KEY `UID` (`UID`),
  ADD KEY `UID_3` (`UID`);

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
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `SEID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_keeper`
--
ALTER TABLE `time_keeper`
  MODIFY `TKID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `week_day`
--
ALTER TABLE `week_day`
  MODIFY `WDID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requisites`
--
ALTER TABLE `requisites`
  ADD CONSTRAINT `requisites_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`BID`) REFERENCES `buildings` (`BID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`RID`) REFERENCES `room` (`RID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_5` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_6` FOREIGN KEY (`UID`) REFERENCES `user_data` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_3` FOREIGN KEY (`PID`) REFERENCES `permissions` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_schedule`
--
ALTER TABLE `user_schedule`
  ADD CONSTRAINT `user_schedule_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user_data` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `week_day`
--
ALTER TABLE `week_day`
  ADD CONSTRAINT `week_day_ibfk_1` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
