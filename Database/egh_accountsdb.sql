-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 04:07 PM
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
-- Database: `egh_accountsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accdb`
--

CREATE TABLE `tbl_accdb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `section` varchar(50) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_accdb`
--

INSERT INTO `tbl_accdb` (`id`, `firstname`, `lastname`, `email`, `username`, `section`, `grade_level`, `account_type`, `password`, `created_date`, `profile_pic`) VALUES
(116, 'ADMIN', 'ADMIN', 'juandelacruz@gmail.com', 'admin', '', '', 'Admin', '$2y$10$th6Dpgt3JUg8DoT4XtJbJ.BF3STqJD.OodTMXulS0Iy41cEWgwW3q', '2023-10-10 07:19:06', NULL),
(117, 'teacher', 'teacher', 'paulcruz@gmail.com', 'teacher', '', '', 'Teacher', '$2y$10$k5.hSyAD03235HC1bY83deZsxTRzlSHyrXtKlA.49rPCvEcI2j6NS', '2023-10-10 07:19:06', NULL),
(121, 'Cebastian', 'Cabanillas', 'cebastian.cabanillas.edu.ph', '201912129', 'St.Paul', 'Grade 6', 'Student', '$2y$10$BO.jbJRN6IMF321iICVjRuddbPayAnnU4ywxrw3d5kFFIwiqFw0UC', '2023-10-11 11:18:04', 'ProfilePics65294ee499033_image.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `ID` int(11) NOT NULL,
  `completedAct` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`ID`, `completedAct`) VALUES
(1, '29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activity_log`
--

INSERT INTO `tbl_activity_log` (`id`, `user_id`, `action`, `timestamp`) VALUES
(13, 79, 'Login', '2023-09-26 17:09:38'),
(21, 87, 'Login', '2023-10-08 07:36:46'),
(23, 89, 'Login', '2023-09-27 11:32:46'),
(24, 88, 'Login', '2023-10-08 06:47:26'),
(29, 90, 'Login', '2023-10-09 22:08:28'),
(30, 91, 'Login', '2023-10-09 22:12:39'),
(31, 92, 'Login', '2023-10-09 22:18:03'),
(32, 93, 'Login', '2023-10-09 22:19:26'),
(33, 96, 'Login', '2023-10-09 22:27:23'),
(34, 110, 'Login', '2023-10-09 22:45:02'),
(35, 111, 'Login', '2023-10-09 22:48:53'),
(36, 112, 'Login', '2023-10-09 22:50:08'),
(37, 113, 'Login', '2023-10-09 22:50:28'),
(38, 115, 'Login', '2023-10-09 23:18:26'),
(39, 118, 'Login', '2023-10-11 02:11:18'),
(47, 119, 'Login', '2023-10-11 02:46:49'),
(48, 120, 'Login', '2023-10-11 03:16:14'),
(49, 117, 'Login', '2023-10-11 03:18:19'),
(50, 121, 'Login', '2023-10-13 12:23:11'),
(51, 116, 'Login', '2023-10-12 16:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_archive`
--

CREATE TABLE `tbl_archive` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `section` varchar(50) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_badge`
--

CREATE TABLE `tbl_badge` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cert`
--

CREATE TABLE `tbl_cert` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_createact`
--

CREATE TABLE `tbl_createact` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `correct_answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_createact`
--

INSERT INTO `tbl_createact` (`id`, `activity_name`, `question_text`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_answer`) VALUES
(7, 'Quiz 1', 'What color is black', 'dark', 'light', 'orange', 'red', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leaderboard`
--

CREATE TABLE `tbl_leaderboard` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_msg`
--

CREATE TABLE `tbl_msg` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_multiple_teacher`
--

CREATE TABLE `tbl_multiple_teacher` (
  `question_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `question_text` text NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL,
  `randomize_questions` tinyint(1) NOT NULL DEFAULT 0,
  `visible_students` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_multiple_teacher`
--

INSERT INTO `tbl_multiple_teacher` (`question_id`, `activity_name`, `question_text`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `randomize_questions`, `visible_students`) VALUES
(158, 'EXAMPLE ACT NAME 1', 'EXAMPLE QUESTION 1', 'ANSWER 1', 'ANSWER 2', 'ANSWER 3', 'ANSWER 4', 4, 1, 1),
(159, 'EXAMPLE ACT NAME 1', 'EXAMPLE QUESTION 2', 'ANSWER 5', 'ANSWER 6', 'ANSWER 7', 'ANSWER 8', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recentact`
--

CREATE TABLE `tbl_recentact` (
  `ID` int(11) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_recentact`
--

INSERT INTO `tbl_recentact` (`ID`, `itemname`, `date`, `status`, `subject`) VALUES
(1, 'Quiz 1', '2023-05-03', 'Complete', 'Mathematics'),
(2, 'Quiz 2', '2023-05-03', 'Complete', 'Science'),
(3, 'Quiz 3', '2023-05-03', 'Pending', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentpic`
--

CREATE TABLE `tbl_studentpic` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `image_data` longblob NOT NULL,
  `image_type` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `ID` int(11) NOT NULL,
  `Subjects` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`ID`, `Subjects`) VALUES
(1, 'Science'),
(2, 'English'),
(3, 'Mathematics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accdb`
--
ALTER TABLE `tbl_accdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_action` (`user_id`,`action`);

--
-- Indexes for table `tbl_badge`
--
ALTER TABLE `tbl_badge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cert`
--
ALTER TABLE `tbl_cert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_createact`
--
ALTER TABLE `tbl_createact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leaderboard`
--
ALTER TABLE `tbl_leaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_msg`
--
ALTER TABLE `tbl_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_multiple_teacher`
--
ALTER TABLE `tbl_multiple_teacher`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_recentact`
--
ALTER TABLE `tbl_recentact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_studentpic`
--
ALTER TABLE `tbl_studentpic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accdb`
--
ALTER TABLE `tbl_accdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_createact`
--
ALTER TABLE `tbl_createact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_multiple_teacher`
--
ALTER TABLE `tbl_multiple_teacher`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tbl_recentact`
--
ALTER TABLE `tbl_recentact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_studentpic`
--
ALTER TABLE `tbl_studentpic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_studentpic`
--
ALTER TABLE `tbl_studentpic`
  ADD CONSTRAINT `tbl_studentpic_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tbl_accdb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
