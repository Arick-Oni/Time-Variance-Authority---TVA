-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 10:56 PM
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
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `analyses`
--

CREATE TABLE `analyses` (
  `Clerk_ID` int(11) NOT NULL,
  `Variant_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `analyst`
--

CREATE TABLE `analyst` (
  `ID` int(11) NOT NULL,
  `Current_Tracking_Varient` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analyst`
--

INSERT INTO `analyst` (`ID`, `Current_Tracking_Varient`) VALUES
(81, NULL),
(88, NULL),
(89, NULL),
(90, NULL),
(97, NULL),
(101, NULL),
(104, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `armory`
--

CREATE TABLE `armory` (
  `armory_id` int(11) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `armory`
--

INSERT INTO `armory` (`armory_id`, `capacity`, `location`) VALUES
(1, 1000, 'Wing A'),
(2, 1000, 'Wing C'),
(4, 500, 'WING F');

-- --------------------------------------------------------

--
-- Table structure for table `brings`
--

CREATE TABLE `brings` (
  `Analyst_ID` int(11) NOT NULL,
  `Case_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `Number` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `Status` text NOT NULL,
  `Analyst_ID` int(11) NOT NULL,
  `Num_of_Trials` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`Number`, `variant_id`, `Status`, `Analyst_ID`, `Num_of_Trials`) VALUES
(19, 25, 'Pending', 81, 0),
(20, 28, 'Closed', 81, 2),
(21, 29, 'Closed', 81, 1),
(22, 24, 'Pending', 81, 0),
(23, 26, 'Pending', 81, 0),
(24, 32, 'Pending', 81, 0),
(25, 28, 'Pending', 81, 1);

-- --------------------------------------------------------

--
-- Table structure for table `case_violationcodeno`
--

CREATE TABLE `case_violationcodeno` (
  `Case_Number` int(11) NOT NULL,
  `Violation_Code_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clerk`
--

CREATE TABLE `clerk` (
  `ID` int(11) NOT NULL,
  `Skill` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `CourtNumber` int(11) NOT NULL,
  `RoomNo` int(11) NOT NULL,
  `BuildingNo` int(11) NOT NULL,
  `In-Use` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`CourtNumber`, `RoomNo`, `BuildingNo`, `In-Use`) VALUES
(1, 5, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detained`
--

CREATE TABLE `detained` (
  `Variant_ID` int(11) NOT NULL,
  `TimeCell_ID` int(11) NOT NULL,
  `Detained_By` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detained`
--

INSERT INTO `detained` (`Variant_ID`, `TimeCell_ID`, `Detained_By`) VALUES
(8, 3, 81),
(28, 3, 81),
(29, 3, 81),
(34, 4, 81),
(35, 5, 81),
(36, 6, 81),
(37, 7, 81),
(38, 8, 97);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `branch_no` int(11) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `name`, `branch_no`, `Status`) VALUES
(1, 'Tempad', 1, NULL),
(2, 'Tempad', 1, NULL),
(3, 'Tempad', 1, NULL),
(4, 'Tempad', 1, NULL),
(6, 'Tempad', 1, NULL),
(7, 'Tempad', 1, NULL),
(8, 'Tempad', 1, NULL),
(9, 'Tempad', 1, NULL),
(10, 'Tempad', 1, NULL),
(11, 'Tempad', 1, NULL),
(12, 'Tempad', 1, NULL),
(13, 'Tempad', 1, NULL),
(14, 'Tempad', 1, NULL),
(15, 'Tempad', 1, NULL),
(16, 'Tempad', 1, NULL),
(17, 'Tempad', 1, NULL),
(18, 'Tempad', 1, NULL),
(19, 'Tempad', 1, NULL),
(20, 'Tempad', 1, NULL),
(21, 'Tempad', 1, NULL),
(22, 'Tempad', 1, NULL),
(23, 'Tempad', 1, NULL),
(24, 'Tempad', 1, NULL),
(25, 'Tempad', 1, NULL),
(26, 'xcvzc', 1, NULL),
(27, 'sda', 1, NULL),
(28, 'habi', 4, NULL),
(29, 'Temporal Loom', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Clearance` int(11) NOT NULL,
  `Origin` varchar(11) NOT NULL,
  `Date of Birth` date NOT NULL,
  `Registration Date` date NOT NULL DEFAULT current_timestamp(),
  `Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Name`, `Password`, `Clearance`, `Origin`, `Date of Birth`, `Registration Date`, `Type`) VALUES
(1, 'Arick', 'happihappi', 1, 'Clone', '2023-11-29', '2023-11-29', 'Judge'),
(4, 'Nova', 'panda', 2, 'clone', '2023-12-13', '2023-12-01', 'judge'),
(5, 'Noman', 'panda2', 3, 'Clone', '2023-12-13', '2023-12-01', 'Scientist'),
(6, 'Rahat', 'panda3', 2, 'Variant', '2023-11-14', '2023-12-01', 'Analyst'),
(7, 'Fuad', 'panda4', 2, 'Clone', '2023-12-06', '2023-12-01', 'Analyst'),
(10, 'Ibraheem@gmail.com', 'panda', 2, 'Clone', '2023-12-06', '2023-12-01', 'Analyst'),
(11, 'arick@gmail.com', 'avc', 2, 'Clone', '2023-12-06', '2023-12-01', 'Analyst'),
(12, 'arick@gmail.com', 'as', 2, 'Clone', '2023-12-06', '2023-12-01', 'Analyst'),
(13, 'Rohan', 'panda', 2, 'Clone', '2023-12-05', '2023-12-02', 'Clerk'),
(14, 'Arick Sarkar', 'panda', 2, 'Clone', '2023-12-06', '2023-12-03', 'Analyst'),
(15, 'Arick Sarkar', 'panda', 2, 'Clone', '2023-12-06', '2023-12-03', 'Analyst'),
(16, 'Fuad Fardin', 'panda', 2, 'Clone', '2023-12-21', '2023-12-03', 'MinuteMan'),
(17, 'Fuad Fardin', 'panda2', 2, 'Clone', '2023-12-21', '2023-12-03', 'Judge'),
(18, 'Abrar Mahir', 'panda', 2, 'Clone', '2023-12-21', '2023-12-03', 'Judge'),
(19, 'Abrar Mahir', 'panda', 2, 'Clone', '2023-12-21', '2023-12-03', 'Judge'),
(20, 'Abrar Mahir', 'panda2', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(21, 'Abrar Mahir', 'panda2', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(22, 'Abrar Mahir', 'panda2', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(23, 'Abrar Mahir', 'panda3', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(24, 'Abrar Mahir', 'panda3', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(25, 'Abrar Mahir', 'panda3', 2, 'Clone', '2023-12-21', '2023-12-03', 'Analyst'),
(26, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(27, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(28, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(29, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(30, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(31, 'Nova Ahmed', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(32, 'Nova Ahmed', 'panda', 2, 'Clone', '2023-12-31', '2023-12-03', 'Analyst'),
(33, 'Nova RAhman', 'panda', 2, 'Clone', '2023-12-05', '2023-12-03', 'Clerk'),
(34, 'Nova RAhman', 'panda', 2, 'Clone', '2023-12-05', '2023-12-03', 'Clerk'),
(35, 'Ibraheem Ibn Anwar', 'panda', 2, 'Clone', '2023-11-28', '2023-12-03', 'Clerk'),
(36, 'Ibraheem Ibn Anwar', 'panda', 2, 'Clone', '2023-11-28', '2023-12-03', 'Clerk'),
(37, 'Ibraheem', 'panda', 2, 'Clone', '2023-12-11', '2023-12-03', 'Clerk'),
(38, 'Ibraheem', 'panda', 2, 'Clone', '2023-12-11', '2023-12-03', 'Clerk'),
(39, 'Ibraheem', 'panda', 2, 'Clone', '2023-12-06', '2023-12-03', 'Clerk'),
(40, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(41, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(42, 'Talukdar', 'panda', 2, 'Clone', '2023-12-13', '2023-12-04', 'MinuteMan'),
(43, 'Talukdar', 'panda', 2, 'Clone', '2023-12-13', '2023-12-04', 'MinuteMan'),
(44, 'Nova Ahmen', 'asf', 2, 'Clone', '2023-12-20', '2023-12-04', 'Analyst'),
(45, 'Nova Ahmen', 'asf', 2, 'Clone', '2023-12-20', '2023-12-04', 'Analyst'),
(46, 'Abrar Mahir', 'awsd', 2, 'Clone', '2023-12-21', '2023-12-04', 'Analyst'),
(47, 'Nova Ahmed', 'sad', 2, 'Clone', '2023-12-29', '2023-12-04', 'Analyst'),
(48, 'Fuad Fardin', 'jkb', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(49, 'Nova Ahmen', 'sad', 2, 'Clone', '2023-12-04', '2023-12-04', 'Analyst'),
(50, 'hjv', 'hjv', 2, 'Clone', '2023-12-30', '2023-12-04', 'Analyst'),
(51, 'Nova Ahmen', 'as', 2, 'Clone', '2023-12-04', '2023-12-04', 'Scientist'),
(52, 'Nova Ahmen', 'sad', 2, 'Clone', '2023-12-04', '2023-12-04', 'Analyst'),
(53, 'asd', 'panda', 2, 'Clone', '2023-12-30', '2023-12-04', 'Analyst'),
(54, 'asd', 'panda', 2, 'Clone', '2023-12-30', '2023-12-04', 'Analyst'),
(55, 'asd', 'panda', 2, 'Clone', '2023-12-28', '2023-12-04', 'Analyst'),
(56, 'swghsd', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(57, 'swghsd', 'sda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(58, 'asd', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(59, 'asd', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(60, 'efq', 'panda', 2, 'Clone', '2023-12-28', '2023-12-04', 'Analyst'),
(61, 'asd', 'panda', 2, 'Clone', '2023-12-19', '2023-12-04', 'Analyst'),
(62, 'dsf', 'panda', 2, 'Clone', '2023-12-15', '2023-12-04', 'Analyst'),
(63, 'dsf', 'asf', 2, 'Clone', '2023-12-15', '2023-12-04', 'Analyst'),
(64, 'asd', 'panda', 2, 'Clone', '2023-12-28', '2023-12-04', 'Analyst'),
(65, 'asd', 'asd', 2, 'Clone', '2023-12-28', '2023-12-04', 'Analyst'),
(66, 'asd', 'asdasd', 2, 'Clone', '2023-12-28', '2023-12-04', 'Analyst'),
(67, 'wfa', 'panda', 2, 'Clone', '2023-12-20', '2023-12-04', 'Analyst'),
(68, 'hhbjgv', 'panda', 2, 'Clone', '2023-12-30', '2023-12-04', 'Analyst'),
(69, 'das', 'panda', 2, 'Clone', '2023-12-22', '2023-12-04', 'Analyst'),
(70, 'dasd', 'panda', 2, 'Clone', '2023-12-23', '2023-12-04', 'Analyst'),
(71, 'Noman', 'panda', 2, 'Clone', '2023-12-13', '2023-12-07', 'Clerk'),
(72, 'skjda', 'asjd', 1, 'clone', '2023-12-06', '2023-12-07', 'Analyst'),
(73, 'Noman', 'panda', 2, 'Clone', '2023-12-13', '2023-12-07', 'Clerk'),
(74, 'skjda', 'asjd', 1, 'clone', '2023-12-06', '2023-12-07', 'Analyst'),
(75, 'Noman', 'panda', 2, 'Clone', '2023-12-13', '2023-12-07', 'Clerk'),
(76, 'skjda', 'asjd', 1, 'clone', '2023-12-06', '2023-12-07', 'Analyst'),
(77, 'Noman', 'panda', 2, 'Clone', '2023-12-13', '2023-12-07', 'Clerk'),
(78, 'skjda', 'asjd', 1, 'clone', '2023-12-06', '2023-12-07', 'Analyst'),
(79, 'Noman', 'panda', 2, 'Clone', '2023-12-13', '2023-12-07', 'Clerk'),
(80, 'skjda', 'asjd', 1, 'clone', '2023-12-06', '2023-12-07', 'Analyst'),
(81, 'Fuad', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(82, 'Ibraheem', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'MinuteMan'),
(83, 'AL HAbib', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(84, 'AL HAbib', 'panda2', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(85, 'AL HAbib', 'asd', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(86, 'AL HAbib', 'g', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(87, 'AL HAbib', 'hvk', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(88, 'AL HAbib', 'b ', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(89, 'AL HAbib', 'wad', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(90, 'asdasda', 'asd', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(91, 'as', 'asd', 2, 'Clone', '2023-12-10', '2023-12-10', 'Judge'),
(92, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Judge'),
(93, 'TimeKeeper', 'panda', 3, 'Clone', '2023-12-13', '2023-12-10', 'Timekeeper'),
(94, 'AL HAbib', 'asd', 2, 'Clone', '2023-12-10', '2023-12-10', 'Minutemen'),
(95, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Minutemen'),
(96, 'AL HAbib', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Judge'),
(97, 'Fuad Fardin', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Analyst'),
(98, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Judge'),
(99, 'Abrar Mahir', 'panda', 2, 'Clone', '2023-12-30', '2023-12-10', 'Minutemen'),
(100, 'Nova Ahmen', 'panda', 2, 'Clone', '2023-12-10', '2023-12-10', 'Minutemen'),
(101, 'abcde', 'abcde', 2, 'Clone', '2025-08-11', '2025-08-11', 'Analyst'),
(102, 'abcde', 'abcde', 2, 'Clone', '2025-08-11', '2025-08-11', 'Minutemen'),
(103, 'abcdeffg', 'abcde', 2, 'Clone', '2025-08-11', '2025-08-11', 'Scientist'),
(104, 'abcde', 'abcde', 2, 'Clone', '2025-09-19', '2025-09-19', 'Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `evidence_locker`
--

CREATE TABLE `evidence_locker` (
  `Locker_Num` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL DEFAULT 0,
  `Count_Items` int(11) NOT NULL,
  `Location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidence_locker`
--

INSERT INTO `evidence_locker` (`Locker_Num`, `Capacity`, `Count_Items`, `Location`) VALUES
(1, 50, -1, 'Wing A'),
(2, 100, -1, 'Wing B'),
(4, 100, 0, 'Wing-D'),
(6, 500, 1, 'Wing E');

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `ID` int(11) NOT NULL,
  `Total_Cases` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`ID`, `Total_Cases`) VALUES
(91, NULL),
(92, NULL),
(96, NULL),
(98, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `minutemen`
--

CREATE TABLE `minutemen` (
  `ID` int(11) NOT NULL,
  `License_no` int(11) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minutemen`
--

INSERT INTO `minutemen` (`ID`, `License_no`, `Rank`) VALUES
(1, 12345, 5),
(95, NULL, NULL),
(99, NULL, NULL),
(100, NULL, NULL),
(102, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monitors`
--

CREATE TABLE `monitors` (
  `Analyst_ID` int(11) NOT NULL,
  `Timeline_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_no` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `branch_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_advancement`
--

CREATE TABLE `repair_advancement` (
  `branch_no` int(11) NOT NULL,
  `head_engineer` varchar(200) DEFAULT NULL,
  `active` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_advancement`
--

INSERT INTO `repair_advancement` (`branch_no`, `head_engineer`, `active`) VALUES
(1, 'MR. OB', 'Active'),
(4, 'rohan', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Description` varchar(255) NOT NULL,
  `Receiver_Type` text NOT NULL,
  `Status` text NOT NULL,
  `Requestee_ID` int(11) NOT NULL,
  `Action_ID` int(11) DEFAULT NULL,
  `Weapon_ID` int(11) DEFAULT NULL,
  `Device_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`ID`, `Date`, `Description`, `Receiver_Type`, `Status`, `Requestee_ID`, `Action_ID`, `Weapon_ID`, `Device_ID`) VALUES
(1, '2023-12-08', 'ADD_LOCKER', 'Timekeeper', 'Declined', 1, 5, NULL, NULL),
(3, '2023-12-08', 'Repair', 'Scientist', 'Declined', 7, 5, NULL, NULL),
(4, '2023-12-08', 'Hello', 'Scientist', 'Completed', 1, 5, 1, 3),
(5, '2023-12-08', 'Hello', 'Scientist', 'Completed', 1, 5, NULL, 3),
(6, '2023-12-08', 'Hello', 'Scientist', 'Declined', 1, 13, NULL, NULL),
(7, '2023-12-08', 'Hello', 'Scientist', 'Declined', 1, 13, NULL, NULL),
(8, '2023-12-08', 'Hello', 'Scientist', 'Completed', 1, 5, NULL, 18),
(9, '2023-12-08', 'Hello', 'Scientist', 'Declined', 1, 5, NULL, NULL),
(10, '2023-12-08', 'Hello', 'Scientist', 'Completed', 1, 5, 3, NULL),
(11, '2023-12-08', 'Hello', 'Scientist', 'Accepted', 1, 5, NULL, NULL),
(12, '2023-12-08', 'fvda', 'Scientist', 'Completed', 1, 5, 1, 13),
(13, '2023-12-08', 'fvda', 'Scientist', 'Completed', 1, 5, 2, NULL),
(14, '2023-12-08', 'adf', 'Scientist', 'Completed', 25, 5, 3, NULL),
(15, '2023-12-09', 'DeviceRepair', 'Scientist', 'Accepted', 13, 5, NULL, 11),
(16, '2023-12-09', 'DeviceRepair', 'Scientist', 'Completed', 13, 5, NULL, 18),
(17, '2023-12-09', 'DeviceRepair', 'Scientist', 'Pending', 13, NULL, NULL, 1),
(18, '2023-12-09', 'DeviceRepair', 'Scientist', 'Pending', 13, NULL, NULL, 3),
(19, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Declined', 0, 5, NULL, NULL),
(20, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Completed', 13, 5, NULL, NULL),
(21, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(22, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(23, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(24, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(25, '2023-12-09', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(26, '2023-12-09', 'Weapon', 'Scientist', 'Completed', 13, 5, 8, NULL),
(29, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 0, NULL),
(30, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 0, NULL),
(31, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 0, NULL),
(32, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 0, NULL),
(33, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 3, NULL),
(34, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 3, NULL),
(35, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(36, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(37, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(38, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(39, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(40, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(41, '2023-12-10', 'WeaponRepair', 'Scientist', 'Completed', 82, 5, 8, NULL),
(42, '2023-12-10', 'DeviceRepair', 'Scientist', 'Completed', 13, 5, NULL, 1),
(43, '2023-12-10', 'ExtraSPC', 'Timekeeper', 'Pending', 13, NULL, NULL, NULL),
(44, '2023-12-10', 'DeviceRepair', 'Scientist', 'Pending', 13, NULL, NULL, 6),
(45, '2023-12-10', 'DeviceRepair', 'Scientist', 'Pending', 13, NULL, NULL, 29);

-- --------------------------------------------------------

--
-- Table structure for table `runs`
--

CREATE TABLE `runs` (
  `Judge_ID` int(11) NOT NULL,
  `Trial_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scientists`
--

CREATE TABLE `scientists` (
  `ID` int(11) NOT NULL,
  `Total_Innovation` int(11) DEFAULT NULL,
  `Dept_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scientists`
--

INSERT INTO `scientists` (`ID`, `Total_Innovation`, `Dept_ID`) VALUES
(5, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specimen`
--

CREATE TABLE `specimen` (
  `Record_ID` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Timeline_ID` int(11) DEFAULT NULL,
  `Locker_Num` int(11) DEFAULT NULL,
  `Emplyee_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specimen`
--

INSERT INTO `specimen` (`Record_ID`, `Description`, `Timeline_ID`, `Locker_Num`, `Emplyee_ID`) VALUES
(12, 'White Object', 3, 2, 20),
(13, 'abc', 2, 1, 18),
(22, 'abcde', 6, 6, 13);

-- --------------------------------------------------------

--
-- Table structure for table `temporal_reset_charge`
--

CREATE TABLE `temporal_reset_charge` (
  `times_used` int(11) DEFAULT NULL,
  `serial_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temporal_reset_charge`
--

INSERT INTO `temporal_reset_charge` (`times_used`, `serial_no`) VALUES
(0, 13),
(0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `timecell`
--

CREATE TABLE `timecell` (
  `ID` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `detained_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timecell`
--

INSERT INTO `timecell` (`ID`, `variant_id`, `detained_by`) VALUES
(3, 33, 81),
(4, 34, 81),
(5, 35, 81),
(6, 36, 81),
(7, 37, 81),
(8, 38, 97);

-- --------------------------------------------------------

--
-- Table structure for table `timekeeper`
--

CREATE TABLE `timekeeper` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `Timeline_ID` int(11) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Pruned_Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`Timeline_ID`, `Type`, `Pruned_Status`) VALUES
(1, 'Active', 'No'),
(2, 'Active', 'No'),
(3, 'Inactive', 'Yes'),
(4, 'Active', 'No'),
(5, 'Active', 'No'),
(6, 'Active', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `time_stick`
--

CREATE TABLE `time_stick` (
  `total_pruned` int(11) DEFAULT NULL,
  `serial_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_stick`
--

INSERT INTO `time_stick` (`total_pruned`, `serial_no`) VALUES
(0, 11),
(0, 12),
(0, 14),
(0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `Analyst_ID` int(11) NOT NULL,
  `Variant_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `Trial_ID` int(11) NOT NULL,
  `Case_Number` int(11) NOT NULL,
  `Court_Number` int(11) NOT NULL,
  `Verdict` text NOT NULL,
  `Judge_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`Trial_ID`, `Case_Number`, `Court_Number`, `Verdict`, `Judge_Name`) VALUES
(3, 21, 5, 'Prune', ''),
(4, 20, 0, 'Prune', '');

-- --------------------------------------------------------

--
-- Table structure for table `uses`
--

CREATE TABLE `uses` (
  `employee_id` int(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uses`
--

INSERT INTO `uses` (`employee_id`, `device_id`) VALUES
(19, 10),
(13, 4),
(37, 4),
(13, 8),
(13, 15);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Earth_No` int(11) NOT NULL,
  `Temporal_Aura` varchar(30) DEFAULT NULL,
  `Nexus_Event_Cause` text DEFAULT NULL,
  `Soul_Status` text DEFAULT NULL,
  `TicketNo` int(11) DEFAULT NULL,
  `Statements` text DEFAULT NULL,
  `PruneOrReset` text DEFAULT NULL,
  `Timeline_ID` int(11) NOT NULL,
  `Hunter_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`ID`, `Name`, `Earth_No`, `Temporal_Aura`, `Nexus_Event_Cause`, `Soul_Status`, `TicketNo`, `Statements`, `PruneOrReset`, `Timeline_ID`, `Hunter_ID`) VALUES
(3, 'rohan', 24, 'ABC', 'abcd', 'Yes', 5, 'He never lies', 'No', 2, 1),
(5, 'mbasf', 11, 'ABC', 'asdadasdasdasdasdas', 'Yes', 55, 'He never lies', NULL, 1, 1),
(6, 'wjnadf', 1, 'ABC', NULL, 'Yes', 10, 'He never lies', NULL, 2, 1),
(8, 'Loki', 1, 'asd', 'Took the Tesseract which he wasnt supposed to do ', 'Yes', 5, 'He never lies', NULL, 2, 1),
(10, 'Sylvie', 1, '', 'Sylvie Laufeydottir, born Loki Laufeydottir, is a Princess of Asgard who caused a Nexus event as a child and escaped the Time Variance Authority', NULL, NULL, '', NULL, 2, 1),
(12, 'Kid Loki', 1, '', 'Killed his own brother , which he wasnt supposed to do ', NULL, NULL, '', NULL, 2, 1),
(14, 'wjnadf', 1, '', 'Random Reason', NULL, NULL, '', NULL, 2, 1),
(16, 'wjnadf', 1, '', 'Random Reason', NULL, NULL, '', NULL, 2, 1),
(18, 'wjnadf', 1, '', NULL, NULL, NULL, '', NULL, 2, 1),
(20, 'wjnadf', 1, '', NULL, NULL, NULL, '', NULL, 2, 1),
(22, 'wjnadf', 1, '', NULL, NULL, NULL, '', NULL, 2, 1),
(24, 'wjnadf', 1, 'sad', 'xzcvzxv', 'asd', 3, 'sdasfcas', 'Prune', 2, 1),
(26, 'wjnadf', 1, '', NULL, NULL, NULL, '', NULL, 2, 1),
(28, 'Loki', 24, NULL, 'Took the Tesseract which he wasnt supposed to. ', NULL, NULL, '', NULL, 2, 1),
(29, 'Sylvie', 27, NULL, 'Sylvie Laufeydottir, born Loki Laufeydottir, is a Princess of Asgard who caused a Nexus event as a child and escaped the Time Variance Authority', NULL, NULL, '', NULL, 4, 1),
(30, 'Rohan', 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1),
(31, 'Rohan', 0, 'asd', NULL, 'asd', 5, 'He never lies', NULL, 4, 1),
(32, 'Rohan', 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1),
(33, 'Rohan', 0, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1),
(34, 'habi', 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1),
(35, 'Active', 0, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(36, 'Active', 0, 'sasdas', NULL, 'asdasd', 3, 'sadczxc', NULL, 3, 1),
(37, 'random', 0, 'sda', 'das.,db,amd asnd .la', 'asdasd', 2, 'asdasda', NULL, 3, 1),
(38, 'Rohan', 0, NULL, 'theu ', NULL, NULL, NULL, NULL, 3, 95);

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE `weapons` (
  `serial_no` int(11) NOT NULL,
  `creation_date` date DEFAULT current_timestamp(),
  `weapon_health` int(11) DEFAULT NULL,
  `armory_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`serial_no`, `creation_date`, `weapon_health`, `armory_id`, `dept_id`, `employee_id`) VALUES
(11, '2023-12-10', 100, 4, NULL, NULL),
(12, '2023-12-10', 100, 4, NULL, NULL),
(13, '2023-12-10', 100, 2, NULL, NULL),
(14, '2023-12-10', 100, 2, NULL, NULL),
(15, '2023-12-10', 100, 4, NULL, NULL),
(16, '2023-12-10', 100, 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analyses`
--
ALTER TABLE `analyses`
  ADD KEY `Clerk_ID` (`Clerk_ID`),
  ADD KEY `Variant_ID` (`Variant_ID`);

--
-- Indexes for table `analyst`
--
ALTER TABLE `analyst`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `armory`
--
ALTER TABLE `armory`
  ADD PRIMARY KEY (`armory_id`);

--
-- Indexes for table `brings`
--
ALTER TABLE `brings`
  ADD PRIMARY KEY (`Analyst_ID`,`Case_Number`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`Number`),
  ADD KEY `Analyst_ID` (`Analyst_ID`);

--
-- Indexes for table `case_violationcodeno`
--
ALTER TABLE `case_violationcodeno`
  ADD PRIMARY KEY (`Violation_Code_No`,`Case_Number`),
  ADD KEY `cst1` (`Case_Number`);

--
-- Indexes for table `clerk`
--
ALTER TABLE `clerk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`CourtNumber`);

--
-- Indexes for table `detained`
--
ALTER TABLE `detained`
  ADD PRIMARY KEY (`Variant_ID`,`TimeCell_ID`),
  ADD KEY `TimeCell_ID` (`TimeCell_ID`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `branch_no` (`branch_no`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evidence_locker`
--
ALTER TABLE `evidence_locker`
  ADD PRIMARY KEY (`Locker_Num`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `minutemen`
--
ALTER TABLE `minutemen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `monitors`
--
ALTER TABLE `monitors`
  ADD KEY `Analyst_ID` (`Analyst_ID`),
  ADD KEY `Timeline_ID` (`Timeline_ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_no`),
  ADD KEY `projects_ibfk_1` (`branch_no`);

--
-- Indexes for table `repair_advancement`
--
ALTER TABLE `repair_advancement`
  ADD PRIMARY KEY (`branch_no`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `runs`
--
ALTER TABLE `runs`
  ADD PRIMARY KEY (`Judge_ID`,`Trial_ID`),
  ADD KEY `Trial_ID` (`Trial_ID`);

--
-- Indexes for table `scientists`
--
ALTER TABLE `scientists`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Dept_ID` (`Dept_ID`);

--
-- Indexes for table `specimen`
--
ALTER TABLE `specimen`
  ADD PRIMARY KEY (`Record_ID`),
  ADD KEY `Locker_Num` (`Locker_Num`),
  ADD KEY `Timeline_ID` (`Timeline_ID`),
  ADD KEY `Emplyee_ID` (`Emplyee_ID`);

--
-- Indexes for table `temporal_reset_charge`
--
ALTER TABLE `temporal_reset_charge`
  ADD KEY `temporal_reset_charge_ibfk_1` (`serial_no`);

--
-- Indexes for table `timecell`
--
ALTER TABLE `timecell`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `timecell_ibfk_1` (`detained_by`);

--
-- Indexes for table `timekeeper`
--
ALTER TABLE `timekeeper`
  ADD KEY `timekeeper_ibfk_1` (`ID`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`Timeline_ID`);

--
-- Indexes for table `time_stick`
--
ALTER TABLE `time_stick`
  ADD KEY `time_stick_ibfk_1` (`serial_no`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD KEY `Analyst_ID` (`Analyst_ID`),
  ADD KEY `Variant_ID` (`Variant_ID`);

--
-- Indexes for table `trial`
--
ALTER TABLE `trial`
  ADD PRIMARY KEY (`Trial_ID`),
  ADD KEY `Case_Number` (`Case_Number`);

--
-- Indexes for table `uses`
--
ALTER TABLE `uses`
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `variants_ibfk_1` (`Timeline_ID`),
  ADD KEY `Hunter_ID` (`Hunter_ID`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`serial_no`),
  ADD KEY `weapons_ibfk_1` (`armory_id`),
  ADD KEY `weapons_ibfk_2` (`dept_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armory`
--
ALTER TABLE `armory`
  MODIFY `armory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `case_violationcodeno`
--
ALTER TABLE `case_violationcodeno`
  MODIFY `Violation_Code_No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `CourtNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `evidence_locker`
--
ALTER TABLE `evidence_locker`
  MODIFY `Locker_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `repair_advancement`
--
ALTER TABLE `repair_advancement`
  MODIFY `branch_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `specimen`
--
ALTER TABLE `specimen`
  MODIFY `Record_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `timecell`
--
ALTER TABLE `timecell`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `Timeline_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `Trial_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analyses`
--
ALTER TABLE `analyses`
  ADD CONSTRAINT `analyses_ibfk_1` FOREIGN KEY (`Clerk_ID`) REFERENCES `clerk` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `analyses_ibfk_2` FOREIGN KEY (`Variant_ID`) REFERENCES `variants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `analyst`
--
ALTER TABLE `analyst`
  ADD CONSTRAINT `analyst_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_ibfk_1` FOREIGN KEY (`Analyst_ID`) REFERENCES `analyst` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case_violationcodeno`
--
ALTER TABLE `case_violationcodeno`
  ADD CONSTRAINT `cst1` FOREIGN KEY (`Case_Number`) REFERENCES `cases` (`Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clerk`
--
ALTER TABLE `clerk`
  ADD CONSTRAINT `clerk_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detained`
--
ALTER TABLE `detained`
  ADD CONSTRAINT `detained_ibfk_1` FOREIGN KEY (`TimeCell_ID`) REFERENCES `timecell` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detained_ibfk_2` FOREIGN KEY (`Variant_ID`) REFERENCES `variants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`branch_no`) REFERENCES `repair_advancement` (`branch_no`);

--
-- Constraints for table `judge`
--
ALTER TABLE `judge`
  ADD CONSTRAINT `judge_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `minutemen`
--
ALTER TABLE `minutemen`
  ADD CONSTRAINT `minutemen_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitors`
--
ALTER TABLE `monitors`
  ADD CONSTRAINT `monitors_ibfk_1` FOREIGN KEY (`Analyst_ID`) REFERENCES `analyst` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitors_ibfk_2` FOREIGN KEY (`Timeline_ID`) REFERENCES `timeline` (`Timeline_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`branch_no`) REFERENCES `repair_advancement` (`branch_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `runs`
--
ALTER TABLE `runs`
  ADD CONSTRAINT `runs_ibfk_1` FOREIGN KEY (`Trial_ID`) REFERENCES `trial` (`Trial_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `runs_ibfk_2` FOREIGN KEY (`Judge_ID`) REFERENCES `judge` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scientists`
--
ALTER TABLE `scientists`
  ADD CONSTRAINT `scientists_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `scientists_ibfk_2` FOREIGN KEY (`Dept_ID`) REFERENCES `repair_advancement` (`branch_no`);

--
-- Constraints for table `specimen`
--
ALTER TABLE `specimen`
  ADD CONSTRAINT `specimen_ibfk_1` FOREIGN KEY (`Locker_Num`) REFERENCES `evidence_locker` (`Locker_Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specimen_ibfk_2` FOREIGN KEY (`Timeline_ID`) REFERENCES `timeline` (`Timeline_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specimen_ibfk_3` FOREIGN KEY (`Emplyee_ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temporal_reset_charge`
--
ALTER TABLE `temporal_reset_charge`
  ADD CONSTRAINT `temporal_reset_charge_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `weapons` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timecell`
--
ALTER TABLE `timecell`
  ADD CONSTRAINT `timecell_ibfk_1` FOREIGN KEY (`detained_by`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timecell_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timekeeper`
--
ALTER TABLE `timekeeper`
  ADD CONSTRAINT `timekeeper_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_stick`
--
ALTER TABLE `time_stick`
  ADD CONSTRAINT `time_stick_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `weapons` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`Analyst_ID`) REFERENCES `analyst` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tracks_ibfk_2` FOREIGN KEY (`Variant_ID`) REFERENCES `variants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trial`
--
ALTER TABLE `trial`
  ADD CONSTRAINT `trial_ibfk_1` FOREIGN KEY (`Case_Number`) REFERENCES `cases` (`Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uses`
--
ALTER TABLE `uses`
  ADD CONSTRAINT `uses_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uses_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uses_ibfk_3` FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`);

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`Timeline_ID`) REFERENCES `timeline` (`Timeline_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `variants_ibfk_2` FOREIGN KEY (`Hunter_ID`) REFERENCES `minutemen` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `weapons`
--
ALTER TABLE `weapons`
  ADD CONSTRAINT `weapons_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `repair_advancement` (`branch_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weapons_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weapons_ibfk_4` FOREIGN KEY (`armory_id`) REFERENCES `armory` (`armory_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
