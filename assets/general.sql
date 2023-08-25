-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 04:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `general`
--

-- --------------------------------------------------------

--
-- Table structure for table `school_master`
--

CREATE TABLE `school_master` (
  `id` int(11) NOT NULL,
  `school_name` text NOT NULL,
  `school_village` text NOT NULL,
  `school_taluka` text NOT NULL,
  `school_district` text NOT NULL,
  `school_state` text NOT NULL,
  `school_managing_auth` text NOT NULL,
  `school_contactno` text NOT NULL,
  `school_email` text NOT NULL,
  `school_accreditationno` text DEFAULT NULL,
  `school_affiliationno` text DEFAULT NULL,
  `school_udise` text NOT NULL,
  `school_board` text DEFAULT NULL,
  `school_medium` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_master`
--

INSERT INTO `school_master` (`id`, `school_name`, `school_village`, `school_taluka`, `school_district`, `school_state`, `school_managing_auth`, `school_contactno`, `school_email`, `school_accreditationno`, `school_affiliationno`, `school_udise`, `school_board`, `school_medium`) VALUES
(1, 'जिल्हा परिषद प्राथमिक शाळा, शिर्डी', 'शिर्डी', 'राहाता', 'अहमदनगर', 'महाराष्ट्र', 'जिल्हा परिषद', '9422703749', 'sanjayrgholap@gmail.com', '', '', '27261003301', '', 'मराठी');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_number` int(11) NOT NULL,
  `start_point` int(11) NOT NULL,
  `book_current` int(11) NOT NULL,
  `book_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`book_id`, `book_name`, `book_number`, `start_point`, `book_current`, `book_active`) VALUES
(1, 'tbl_book_1', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_1`
--

CREATE TABLE `tbl_book_1` (
  `student_id` int(11) NOT NULL,
  `student_grn` int(11) NOT NULL,
  `student_bid` int(11) NOT NULL,
  `student_sid` text NOT NULL,
  `student_currnstd` int(11) NOT NULL,
  `student_fname` text DEFAULT NULL,
  `student_mname` text DEFAULT NULL,
  `student_lname` text DEFAULT NULL,
  `student_mothername` text DEFAULT NULL,
  `student_gender` text DEFAULT NULL,
  `student_dob` text DEFAULT NULL,
  `student_mothertongue` text DEFAULT NULL,
  `student_contact` text DEFAULT NULL,
  `student_category` text DEFAULT NULL,
  `student_caste` text DEFAULT NULL,
  `student_religion` text DEFAULT NULL,
  `student_bpl` text DEFAULT NULL,
  `student_semieng` text DEFAULT NULL,
  `student_dateofadmi` text DEFAULT NULL,
  `student_admistd` text DEFAULT NULL,
  `student_admitype` text DEFAULT NULL,
  `student_prev_schoolname` text NOT NULL,
  `student_prev_schoolstd` text NOT NULL,
  `student_uid` text DEFAULT NULL,
  `student_photo` text DEFAULT NULL,
  `student_disability` text DEFAULT NULL,
  `student_disabilitytype` text DEFAULT NULL,
  `student_dispercentage` text DEFAULT NULL,
  `student_nation` text DEFAULT NULL,
  `student_dob_place` text DEFAULT NULL,
  `student_dob_taluka` text NOT NULL,
  `student_dob_dist` text DEFAULT NULL,
  `student_dob_state` text DEFAULT NULL,
  `student_addr_hno` text DEFAULT NULL,
  `student_addr_strtname` text DEFAULT NULL,
  `student_addr_pin` text DEFAULT NULL,
  `student_addr_state` text DEFAULT NULL,
  `student_addr_dist` text DEFAULT NULL,
  `student_addr_tal` text NOT NULL,
  `student_addr_village` text NOT NULL,
  `student_addr_post` text DEFAULT NULL,
  `student_addr_country` text NOT NULL,
  `student_status` int(11) DEFAULT NULL,
  `student_left_date` text DEFAULT NULL,
  `student_prg` text NOT NULL,
  `student_beha` text NOT NULL,
  `student_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `prev_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `prev_id`, `username`, `user_name`, `passwd`) VALUES
(1, 1, 'admin', 'Admin', '$2y$10$8Na5xTi7v/.lPdUy.vtAKe6mK54Gyc9S6eupTwxNWk8VRD04Pu9AG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userprev`
--

CREATE TABLE `tbl_userprev` (
  `prev_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userprev`
--

INSERT INTO `tbl_userprev` (`prev_id`, `user_type`) VALUES
(1, 'Admin'),
(2, 'Teacher and Other'),
(3, 'Clerk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_master`
--
ALTER TABLE `school_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_id` (`book_id`);

--
-- Indexes for table `tbl_book_1`
--
ALTER TABLE `tbl_book_1`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_grn` (`student_grn`),
  ADD KEY `student_bid` (`student_bid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `prev_id` (`prev_id`);

--
-- Indexes for table `tbl_userprev`
--
ALTER TABLE `tbl_userprev`
  ADD UNIQUE KEY `prev_id` (`prev_id`),
  ADD UNIQUE KEY `prev_id_2` (`prev_id`),
  ADD KEY `prev_id_3` (`prev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_master`
--
ALTER TABLE `school_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_book_1`
--
ALTER TABLE `tbl_book_1`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_book_1`
--
ALTER TABLE `tbl_book_1`
  ADD CONSTRAINT `tbl_book_1_ibfk_1` FOREIGN KEY (`student_bid`) REFERENCES `tbl_books` (`book_id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`prev_id`) REFERENCES `tbl_userprev` (`prev_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
