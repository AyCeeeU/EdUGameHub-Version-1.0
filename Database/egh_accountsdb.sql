-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 10:49 AM
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
  `section` varchar(50) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_accdb`
--

INSERT INTO `tbl_accdb` (`id`, `firstname`, `lastname`, `email`, `section`, `grade_level`, `account_type`, `password`, `created_date`) VALUES
(12, 'Ian', 'Nicolas', 'bagonapoto@gmail.com', 'Section 3', 'Grade 5', 'Teacher', 'helloworld', '2023-04-27 20:30:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accdb`
--
ALTER TABLE `tbl_accdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accdb`
--
ALTER TABLE `tbl_accdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
