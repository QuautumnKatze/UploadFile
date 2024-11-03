-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3066
-- Generation Time: Nov 03, 2024 at 05:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruitdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `recruiter_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `introduction` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `employee_count` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `expired_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`recruiter_id`, `email`, `password`, `full_name`, `phone`, `company_name`, `city_id`, `location`, `introduction`, `avatar`, `employee_count`, `website`, `status`, `expired_date`) VALUES
(1, 'manhphuc2003@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Manh Phuc', '0904786893', 'CTY ABC', 1, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', 'Chưa có thông tin giới thiệu', '/storage/photos/shares/avatar/default-avatar.jpg', NULL, 'https://webjob.2vn', 1, '2024-11-10 03:36:19'),
(2, 'manhphuc20@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Manh Phuc', '0904786899', 'CTY ABCr', 2, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 0, NULL),
(3, 'manhphuc20203@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Manh Phuc', '09047868932', 'CTY ABCw', 2, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 1, '2024-11-10 03:36:41'),
(4, 'manshphuc2003@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Manh Phuc', '09047862893', 'CTY ABCs', 1, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 3, '2024-12-03 03:38:29'),
(5, 'Ete@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Manh Phuc', '09047868934', 'CTY ABC2', 1, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 1, '2024-11-10 03:36:47'),
(6, 'manhphuc2ee003@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Manh Phuc', '090478689322', 'CTY ABC', 3, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 0, NULL),
(7, 'manhphucrrr2003@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Manh Phuczzz', '09043786893', 'CTY ABCzzzz', 1, 'Số 2, đường B, thành phố C, tỉnh Nghệ An', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 0, NULL),
(8, 'manhphuc20033@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Manh Phuczzz', '090478689344', 'CTY ABC2ss', 1, 'zzz', NULL, '/storage/photos/shares/avatar/default-avatar.jpg', NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`recruiter_id`),
  ADD UNIQUE KEY `email` (`email`,`phone`),
  ADD KEY `CityID` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `recruiter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD CONSTRAINT `recruiters_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
