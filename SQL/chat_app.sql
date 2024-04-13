-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 08:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_si_no` int(11) NOT NULL,
  `message_id` varchar(500) NOT NULL,
  `message` longtext DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `img_video_or_doc_name_s` longtext DEFAULT NULL,
  `document_name` longtext DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `mess_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_user`
--

CREATE TABLE `report_user` (
  `report_user_id` int(11) NOT NULL,
  `report_username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `message` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_c`
--

CREATE TABLE `user_c` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `last_login` bigint(20) NOT NULL DEFAULT 0,
  `user_email` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `profileImage` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `bio` longtext NOT NULL DEFAULT 'Now I Am using a most User-friendly Chatting site'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_c`
--

INSERT INTO `user_c` (`user_id`, `user_name`, `last_login`, `user_email`, `password`, `dob`, `gender`, `profileImage`, `status`, `bio`) VALUES
(1, 'Purba Ghosh', 1654626920, 'purbaghosh9388@gmail.com', '828fd9255753432d51df95eb62d61722', '2000-04-14', 'Male', 'purba.jpeg', '', 'Now I Am using a most User-friendly Chatting site'),
(2, 'Subha', 0, 'mandalbabu084@gmail.com', '828fd9255753432d51df95eb62d61722', '2000-07-13', 'Male', 'subha.jpeg', '', 'Now I Am using a most User-friendly Chatting site'),
(3, 'Subham Dey', 1654626937, 'deysubham.bwn@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2000-10-10', 'Male', '7198_1654234401_Subham Dey.jpeg', '', 'Now I Am using a most User-friendly Chatting site');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `message_si_no` (`message_si_no`);

--
-- Indexes for table `report_user`
--
ALTER TABLE `report_user`
  ADD PRIMARY KEY (`report_user_id`);

--
-- Indexes for table `user_c`
--
ALTER TABLE `user_c`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_si_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `report_user`
--
ALTER TABLE `report_user`
  MODIFY `report_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_c`
--
ALTER TABLE `user_c`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_c` (`user_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_c` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
