-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 03:03 AM
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
  `name` varchar(150) NOT NULL,
  `short_name` varchar(6) NOT NULL,
  `is_requisite` tinyint(1) NOT NULL,
  `has_requisite` tinyint(1) NOT NULL,
  `co_requisite` tinyint(1) NOT NULL,
  `is_alive` tinyint(1) NOT NULL,
  `program` varchar(3) NOT NULL,
  `RID` int(11) DEFAULT NULL,
  `num_credits` int(2) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `year` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CID`, `name`, `short_name`, `is_requisite`, `has_requisite`, `co_requisite`, `is_alive`, `program`, `RID`, `num_credits`, `semester`, `year`) VALUES
(20, 'Digital Logic Fundamentals', 'EGC220', 1, 0, 1, 1, 'EGC', NULL, 3, '', 0),
(21, 'Digital Logic Lab', 'EGC221', 1, 0, 1, 1, 'EGC', NULL, 1, '', 0),
(22, 'C/C++ Programming', 'EGC251', 1, 1, 0, 1, 'EGC', NULL, 3, '', 0),
(23, 'Digital Systems Design', 'EGC320', 1, 1, 0, 1, 'EGC', NULL, 3, '', 0),
(24, 'Microcontroller System Design', 'EGC331', 1, 1, 0, 1, 'EGC', NULL, 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `FID` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `max_credits` int(2) NOT NULL,
  `min_credits` int(2) NOT NULL,
  `program` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FID`, `email`, `fname`, `lname`, `max_credits`, `min_credits`, `program`) VALUES
(2, 'denizara@newpaltz.edu', 'Anthony', 'Denizaard', 15, 6, 'EGM');

-- --------------------------------------------------------

--
-- Table structure for table `requisites`
--

CREATE TABLE `requisites` (
  `RQID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `CID_pre` tinyint(1) NOT NULL,
  `CID_co` tinyint(1) NOT NULL,
  `CID_is_requisite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RID` int(11) NOT NULL,
  `room_num` varchar(5) NOT NULL,
  `short_name` varchar(25) NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `is_exclusive` tinyint(1) NOT NULL,
  `max_seats` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RID`, `room_num`, `short_name`, `is_required`, `is_exclusive`, `max_seats`) VALUES
(8, '219', 'WH219', 1, 0, 24),
(9, '221', 'WH221', 0, 0, 30),
(10, '225', 'WH225', 1, 0, 30),
(11, '223', 'WH223', 0, 0, 30),
(12, '218', 'EIH218', 0, 0, 30),
(13, '110', 'REH110', 0, 0, 30),
(14, '111', 'REH111', 0, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `roomlink`
--

CREATE TABLE `roomlink` (
  `FBRID` int(5) NOT NULL,
  `RID` int(5) NOT NULL,
  `BID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `SID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `DTID` int(11) NOT NULL,
  `FID` int(11) NOT NULL,
  `FBRID` int(11) NOT NULL,
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
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_time` int(3) NOT NULL,
  `min_time` int(3) NOT NULL
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
  `FID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`UID`, `FID`, `username`, `password`, `user_type`) VALUES
(7, 2, 'admin', '1234', 'administrator');

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
  ADD KEY `RID` (`RID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`FID`);

--
-- Indexes for table `requisites`
--
ALTER TABLE `requisites`
  ADD PRIMARY KEY (`RQID`),
  ADD KEY `CID` (`CID`),
  ADD KEY `CID_pre` (`CID_pre`),
  ADD KEY `CID_pre_2` (`CID_pre`),
  ADD KEY `CID_co` (`CID_co`),
  ADD KEY `CID_is_requisite` (`CID_is_requisite`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `roomlink`
--
ALTER TABLE `roomlink`
  ADD PRIMARY KEY (`FBRID`),
  ADD KEY `RID` (`RID`),
  ADD KEY `BID` (`BID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `CID` (`CID`),
  ADD KEY `DTID` (`DTID`),
  ADD KEY `FID` (`FID`),
  ADD KEY `RID` (`FBRID`);

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
  ADD KEY `FID` (`FID`);

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
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requisites`
--
ALTER TABLE `requisites`
  MODIFY `RQID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `roomlink`
--
ALTER TABLE `roomlink`
  ADD CONSTRAINT `roomlink_ibfk_1` FOREIGN KEY (`RID`) REFERENCES `room` (`RID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `roomlink_ibfk_2` FOREIGN KEY (`BID`) REFERENCES `buildings` (`BID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`FID`) REFERENCES `faculty` (`FID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`FBRID`) REFERENCES `roomlink` (`FBRID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`FID`) REFERENCES `faculty` (`FID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `week_day`
--
ALTER TABLE `week_day`
  ADD CONSTRAINT `week_day_ibfk_1` FOREIGN KEY (`SEID`) REFERENCES `semester` (`SEID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
