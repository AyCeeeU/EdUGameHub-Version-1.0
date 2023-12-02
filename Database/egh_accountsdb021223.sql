-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<<< HEAD:Database/egh_accountsdb
-- Generation Time: Nov 30, 2023 at 05:39 AM
========
-- Generation Time: Dec 02, 2023 at 01:15 PM
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql
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
  `profile_pic` varchar(255) DEFAULT NULL,
  `mother_maiden_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_accdb`
--

INSERT INTO `tbl_accdb` (`id`, `firstname`, `lastname`, `email`, `username`, `section`, `grade_level`, `account_type`, `password`, `created_date`, `profile_pic`, `mother_maiden_name`, `birthdate`) VALUES
<<<<<<<< HEAD:Database/egh_accountsdb
(150, 'teacher', 'teacher', 'teachersample@gmail.com', 'teacher', 'Saphire', 'Grade 5', 'Teacher', '$2y$10$vvzprdEjDHg9Tbtf7sS9e.YjsQFPuV3iJy50e67MSC6ZMfJrq0v0O', '2023-11-06 12:47:35', NULL, 'Lopez', '1999-12-12'),
(151, 'admin', 'admin', 'adminsample@gmail.com', 'admin', '', '', 'Admin', '$2y$10$3VJaZKJA22Z1Uszcqaawiun51W4PRzbCGnd9KRgOI34yuFjWf.zre', '2023-11-06 12:47:36', NULL, 'Perez', '1999-12-12'),
(152, 'student', 'student', 'studentsample@gmail.com', 'student', '', '', 'Student', '$2y$10$o.9m97TDIfDNhH7fGgKnJe5tkSd6AOYyza8w39iGxV2Plupgr/e7m', '2023-11-06 12:47:36', NULL, 'perez', '1999-12-12');
========
(156, 'admin', 'admin', 'adminsample@gmail.com', 'admin', '', '', 'Admin', '$2y$10$VnPNnsPQ2/w99oOZPV.7g.J7vE0ipRrYzb14PWyg4MZUpOOayPrh6', '2023-12-02 15:54:14', NULL, NULL, NULL),
(157, 'teacher', 'teacher', 'teachersample@gmail.com', 'teacher', '', '', 'Teacher', '$2y$10$6KgoqiOhMZbRkWH5UQ0mmeBn68YHA0gRNG7xlS2d3TQEKICQnZHMG', '2023-12-02 15:54:33', NULL, 'Lopez', '1999-12-12'),
(158, 'student', 'student', 'studentsample@gmail.com', 'student', 'Saphire', 'Grade 3', 'Student', '$2y$10$5qA4hNtDgL.FZNCLBZNOv.gisJdHLBPXWFHH4mf/forPnSovLAhEu', '2023-12-02 15:55:41', NULL, 'Sample', '1999-12-12');
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

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
(1, '3');

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
(50, 121, 'Login', '2023-10-21 18:11:34'),
(51, 116, 'Login', '2023-10-21 13:24:27'),
(73, 122, 'Login', '2023-10-20 22:03:10'),
(84, 130, 'Login', '2023-10-24 13:43:07'),
(85, 133, 'Login', '2023-10-24 13:52:35'),
(86, 135, 'Login', '2023-10-24 13:52:45'),
(87, 137, 'Login', '2023-10-24 14:10:52'),
(88, 138, 'Login', '2023-10-24 15:01:55'),
(94, 139, 'Login', '2023-11-04 19:21:16'),
(95, 140, 'Login', '2023-11-04 19:20:56'),
(97, 145, 'Login', '2023-11-06 03:50:27'),
(99, 148, 'Login', '2023-11-06 04:45:45'),
(100, 150, 'Login', '2023-11-30 00:08:59'),
(104, 152, 'Login', '2023-11-29 23:10:06'),
<<<<<<<< HEAD:Database/egh_accountsdb
(106, 151, 'Login', '2023-11-29 16:57:30');
========
(106, 151, 'Login', '2023-12-02 03:35:40'),
(256, 155, 'Login', '2023-12-02 07:24:48'),
(257, 157, 'Login', '2023-12-02 10:22:11'),
(258, 158, 'Login', '2023-12-02 12:13:25');
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

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

--
-- Dumping data for table `tbl_archive`
--

INSERT INTO `tbl_archive` (`id`, `firstname`, `lastname`, `email`, `username`, `section`, `grade_level`, `account_type`, `password`, `created_date`) VALUES
(151, 'admin', 'admin', 'adminsample@gmail.com', 'admin', '', '', 'Admin', '$2y$10$3VJaZKJA22Z1Uszcqaawiun51W4PRzbCGnd9KRgOI34yuFjWf.zre', '2023-11-06 12:47:36'),
(155, '', '', 'adminsample@gmail.com', 'admin', '', '', 'Admin', '$2y$10$aZ.LmH5KaytK.ddqdYhshuxr/7rSeWH6hJZSFwlpLOBUQRrUaB.pC', '2023-12-02 08:23:28'),
(160, 'Mark', 'Johnson', 'markj@outlook.com', 'Section C', 'Grade 11', 'Teacher', 'ghi789', '$2y$10$VZW60Vz998alIlGaGFZs7OM0pkDmgT0KsfIcBl8waRM924uZMvacG', '2023-12-02 15:55:55'),
(159, 'Jane', 'Smith', 'janesmith@yahoo.com', 'Section B', 'Grade 8', 'Student', 'def456', '$2y$10$.c0/ZzxBdFkUZqSo6900leAs/h8Bg03qHdRRFU8wzdLPuzWNO9GdC', '2023-12-02 15:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_badge`
--

CREATE TABLE `tbl_badge` (
  `id` int(11) NOT NULL,
  `username_badge` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `quarter_1` varchar(255) NOT NULL,
  `quarter_2` varchar(255) NOT NULL,
  `quarter_3` varchar(255) NOT NULL,
  `quarter_4` varchar(255) NOT NULL,
  `message_badge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_badge`
--

INSERT INTO `tbl_badge` (`id`, `username_badge`, `first_name`, `last_name`, `quarter_1`, `quarter_2`, `quarter_3`, `quarter_4`, `message_badge`) VALUES
(29, '201912129', 'Cebastian', 'Cabanillas', '', '', '', '', '');

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
<<<<<<<< HEAD:Database/egh_accountsdb
(188, 'English 101', 'This is sample 1 no random', 'This is sample 1 no random', 'This is sample 1 no random', 'This is sample 1 no random', 'This is sample 1 no random', 3, 0, 1),
(189, 'English 101', 'This is sample 2 no random', 'This is sample 2 no random', 'This is sample 2 no random', 'This is sample 2 no random', 'This is sample 2 no random', 4, 0, NULL),
(190, 'English 102', 'This is sample 3 no random', 'This is sample 3 no random', 'This is sample 3 no random', 'This is sample 3 no random', 'This is sample 3 no random', 1, 0, 1),
(191, 'English 102', 'This is sample 4 no random', 'This is sample 4 no random', 'This is sample 4 no random', 'This is sample 4 no random', 'This is sample 4 no random', 4, 0, NULL),
(192, 'English 103', 'No ramdom 1', 'No ramdom 1', 'No ramdom 1', 'No ramdom 1', 'No ramdom 1', 3, 0, 1),
(193, 'English 103', 'No ramdom 2', 'No ramdom 2', 'No ramdom 2', 'No ramdom 2', 'No ramdom 2', 1, 0, NULL),
(196, 'SAMPLE 1', 'sampol1 with random', 'sampol1', 'sampol1', 'sampol1', 'sampol1', 4, 1, 1),
(197, 'SAMPLE 1', 'sampol2 with random', 'sampol2', 'sampol2', 'sampol2', 'sampol2', 4, 1, NULL),
(198, 'SAMPLE 1', 'sampol1 with random', 'sampol1', 'sampol1', 'sampol1', 'sampol1', 4, 1, NULL),
(199, 'SAMPLE 1', 'sampol2 with random', 'sampol2', 'sampol2', 'sampol2', 'sampol2', 4, 1, NULL);
========
(204, 'Sample 1', 'Sample 1', 'Sample 1', 'Sample 1', 'Sample 1', 'Sample 1', 1, 0, 1),
(205, 'Sample 1', 'Sample 2', 'Sample 2', 'Sample 2', 'Sample 2', 'Sample 2', 2, 0, 1),
(206, 'Sample 1', 'Sample 3', 'Sample 3', 'Sample 3', 'Sample 3', 'Sample 3', 3, 0, 1);
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

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
(3, 'Quiz 3', '2023-05-03', 'Complete', 'English');

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
<<<<<<<< HEAD:Database/egh_accountsdb
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
========
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
<<<<<<<< HEAD:Database/egh_accountsdb
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
========
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

--
-- AUTO_INCREMENT for table `tbl_badge`
--
ALTER TABLE `tbl_badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_createact`
--
ALTER TABLE `tbl_createact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_multiple_teacher`
--
ALTER TABLE `tbl_multiple_teacher`
<<<<<<<< HEAD:Database/egh_accountsdb
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
========
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
>>>>>>>> 28dfe37143218395144c783bd19d34ea7859c32b:Database/egh_accountsdb021223.sql

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
