-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 12:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iwp_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `club_heir`
--

CREATE TABLE `club_heir` (
  `position` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'club heirarchy',
  `zval` int(6) NOT NULL COMMENT '1-100k'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_heir`
--

INSERT INTO `club_heir` (`position`, `zval`) VALUES
('core', 5),
('head', 4),
('junior core', 6),
('member', 100000),
('president', 1),
('secratary', 3),
('vice president', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(10) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_description` text NOT NULL,
  `project_status` int(10) NOT NULL DEFAULT 1,
  `authZval` int(6) NOT NULL DEFAULT 99999 COMMENT 'Zval of authorization for task assigners',
  `CreationTime` datetime NOT NULL DEFAULT current_timestamp(),
  `LastUpdationTIme` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FinishID` int(10) DEFAULT NULL,
  `visibility` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_description`, `project_status`, `authZval`, `CreationTime`, `LastUpdationTIme`, `FinishID`, `visibility`) VALUES
(1, 'iwp', 'kuch bhi', 1, 99999, '2022-11-11 01:49:03', '2022-11-26 09:33:51', NULL, 1),
(2, 'ads', 'das', 1, 21, '2022-11-11 11:56:20', '2022-11-11 11:56:20', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(10) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `task_issuedate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dead_line` datetime NOT NULL,
  `task_complete` datetime NOT NULL DEFAULT '9999-12-31 23:59:59' ON UPDATE current_timestamp(),
  `task_details` text NOT NULL,
  `task_project` int(10) NOT NULL,
  `task_receiver` int(10) NOT NULL,
  `task_sender` int(10) NOT NULL,
  `task_sender_name` varchar(50) NOT NULL,
  `task_sender_image` text NOT NULL,
  `task_display` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_issuedate`, `dead_line`, `task_complete`, `task_details`, `task_project`, `task_receiver`, `task_sender`, `task_sender_name`, `task_sender_image`, `task_display`) VALUES
(1, 'bhadwe', '2022-11-08 16:37:08', '2022-11-12 19:37:12', '2022-11-08 16:37:08', 'efwa', 1, 69, 1, 'vishesh', 'dsaf', 0),
(2, 'test123', '2000-01-01 00:00:00', '2022-11-16 15:28:04', '9999-12-31 23:59:59', 'qwerttqet', 2, 69, 2, 'shabrez', 'qafa', 1),
(4, 'marja', '2022-11-08 16:29:58', '2022-11-26 01:19:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 0),
(5, 'marja', '2022-11-11 16:50:59', '2022-11-26 01:19:00', '2022-11-11 16:50:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 0),
(7, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(8, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(9, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(10, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(11, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(12, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(13, '', '2000-01-01 00:00:00', '0000-00-00 00:00:00', '9999-12-31 23:59:59', '', 1, 11, 69, '', 'afdsf', 1),
(14, 'marja', '2000-01-01 00:00:00', '2022-11-01 02:30:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(15, 'marja', '2000-01-01 00:00:00', '2022-11-01 02:30:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(17, 'marja', '2000-01-01 00:00:00', '2022-11-01 02:31:00', '9999-12-31 23:59:59', 'harami', 1, 2, 69, '', 'afdsf', 1),
(18, 'an', '2000-01-01 00:00:00', '2022-11-09 12:10:00', '9999-12-31 23:59:59', 'man', 1, 2, 69, '', 'afdsf', 1),
(19, 'teri maa ka', '2022-11-11 16:16:32', '2022-12-03 12:12:00', '2022-11-11 16:16:32', 'hdca', 1, 69, 69, '', 'afdsf', 0),
(20, 'we are well', '2000-01-01 00:00:00', '2022-12-23 00:00:00', '9999-12-31 23:59:59', 'do this', 1, 1, 69, '', 'afdsf', 1),
(21, 'marja', '2000-01-01 00:00:00', '2022-11-26 18:36:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(22, 'marja', '2000-01-01 00:00:00', '2022-11-25 18:39:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(23, 'marja', '2000-01-01 00:00:00', '2022-11-18 16:40:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(24, 'marja', '2022-11-08 16:41:24', '2022-11-17 13:43:00', '2022-11-08 16:41:24', 'harami', 1, 1, 69, '', 'afdsf', 0),
(25, 'marja', '2000-01-01 00:00:00', '2022-12-03 13:53:00', '9999-12-31 23:59:59', 'harami', 1, 2, 69, '', 'afdsf', 1),
(26, 'marja', '2000-01-01 00:00:00', '2022-11-23 16:40:00', '9999-12-31 23:59:59', 'harami', 1, 1, 69, '', 'afdsf', 1),
(27, 'marja', '2000-01-01 00:00:00', '2022-11-16 09:35:00', '9999-12-31 23:59:59', 'harami', 1, 2, 69, '', 'afdsf', 1),
(28, 'iwpProject DO', '2022-11-11 09:39:23', '2022-11-11 09:40:00', '9999-12-31 23:59:59', 'tere baad hai dunoya', 1, 2, 69, '', 'afdsf', 1),
(29, 'marja', '2022-11-11 14:02:51', '2022-11-17 14:02:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 1),
(30, 'marja', '2022-11-11 14:04:29', '2022-11-17 14:02:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 1),
(31, 'marja', '2022-11-11 14:04:50', '2022-11-17 14:02:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 1),
(32, 'marja', '2022-11-11 14:07:49', '2022-11-17 14:02:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 1),
(33, 'marja', '2022-11-11 14:09:46', '2022-11-17 14:02:00', '9999-12-31 23:59:59', 'shabrez harami', 1, 69, 69, '', 'afdsf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_status` int(10) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_image` text NOT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_password`, `user_status`, `user_gender`, `user_image`, `position`) VALUES
(1, 'Anas', 'Khan               ', 'vishesh.singhal2020@vitstudent.ac.in', '123', 1, 'male', '../employee image/pic.jpeg', 'member'),
(2, 'Shubham   ', 'Jha   ', 'shubham@gmail.com', '1234', 1, 'male', '/new-traning/Shivam_Yadav/Shivam/PHP/DataBase/Uploads/liarnado.jpeg1566909481', 'member'),
(3, 'Ram', 'Verma', 'ram@gmail.com', '123', 1, 'male', '/new-traning/Shivam_Yadav/Shivam/PHP/DataBase/Uploads/daniel.jpeg1562053931', 'member'),
(5, 'Riya', 'Wadhwa', 'riya@gmail.com', '123', 1, 'female', '/new-traning/Shivam_Yadav/Shivam/PHP/DataBase/Uploads/daniel.jpeg1562053931', 'member'),
(10, 'Pooja  ', 'Laddha  ', 'pooja@gmail.com', 'pooja123', 1, 'female', '/new-traning/Shivam_Yadav/Shivam/PHP/DataBase/Uploads/deepika.jpeg1566304541', 'member'),
(11, 'Priyanka', 'Sharma', 'priyanka@gmail.com', '123', 1, 'female', '../images/Profile_Images/eva.jpeg1567171554', 'member'),
(69, 'vishesh', 'singhal', 'visheshsinghal2001@gmail.com', '123', 1, 'male', 'afdsf', 'president');

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

CREATE TABLE `user_project` (
  `user_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `project_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`user_id`, `project_id`, `project_name`) VALUES
(1, 1, 'kuch bhi'),
(69, 1, 'bhadwe');

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

CREATE TABLE `user_skill` (
  `user_id` int(10) NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `rating` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_skill`
--

INSERT INTO `user_skill` (`user_id`, `skill_name`, `rating`) VALUES
(69, 'maa chodne ki', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club_heir`
--
ALTER TABLE `club_heir`
  ADD PRIMARY KEY (`position`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `position` (`position`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position`) REFERENCES `club_heir` (`position`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
