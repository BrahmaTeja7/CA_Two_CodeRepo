-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 02:09 PM
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
-- Database: `itd`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_code` int(3) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_code`, `branch`) VALUES
(1, 'Head Office'),
(2, 'Ampara'),
(3, 'Anuradhapura'),
(4, 'Card Centre'),
(5, 'City Office');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_code` int(3) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_code`, `category`) VALUES
(1, 'General Staff'),
(2, 'Executive Staff'),
(3, 'Junior Management'),
(4, 'Middle Management'),
(5, 'Senior Management'),
(6, 'Outsourced Staff'),
(7, 'External Party'),
(8, 'Fixed Term Contract Staff'),
(9, 'Intern');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_code` int(3) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_code`, `department`) VALUES
(1, 'Marketing'),
(2, 'Recovery'),
(3, 'Information Technology'),
(4, 'Accounts'),
(5, 'Human Resources'),
(6, 'Administration'),
(7, 'Deposits'),
(8, 'Factoring');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_code` int(3) NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_code`, `designation`) VALUES
(0, 'Administration Officer'),
(1, 'Assistant Manager - IT'),
(2, 'Marketing Officer'),
(3, 'Cashier'),
(4, 'Recovery Officer'),
(6, 'Admin Officer');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_code` int(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `epf_no` varchar(4) DEFAULT NULL,
  `branch_code` int(3) DEFAULT NULL,
  `category_code` int(3) DEFAULT NULL,
  `department_code` int(3) DEFAULT NULL,
  `designation_code` int(3) DEFAULT NULL,
  `system_login` varchar(30) DEFAULT NULL,
  `pc_login` varchar(30) DEFAULT NULL,
  `internet` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `form_no` int(4) NOT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_by` int(3) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_by` int(3) DEFAULT NULL,
  `last_updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_code`, `name`, `epf_no`, `branch_code`, `category_code`, `department_code`, `designation_code`, `system_login`, `pc_login`, `internet`, `email`, `mobile`, `form_no`, `status`, `created_by`, `created_date`, `updated_by`, `last_updated_date`) VALUES
(49, 'Chathura Kithmal', '3926', 1, 3, 3, 1, 'chathurakith', 'chathurak', 'No Access', 'chathurak@singersl.com', '0770500120', 0, 'Active', 1, '2020-03-24', NULL, NULL),
(85, 'Teja', '2222', 1, 1, 1, 1, 'assdds', '258258', 'yes', '123@gmail.com', '01234567', 1122, 'Active', 1, '2023-04-14', NULL, NULL),
(86, 'Gupta Prasad', '1110', 1, 1, 1, 1, 'asdasd', 'asdasd', 'yes', 'asdda@hi', '12555', 1112, 'Active', 1, '2023-04-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_code` int(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cpassword` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_code`, `username`, `password`, `cpassword`, `email`) VALUES
(1, 'root', 'root', '', 'root@gmail.com'),
(35, 'mark', '123123', '', 'mark@gmail.com'),
(37, 'chathura', '123123', '', 'chathura@gmail.com'),
(39, 'teja', '456456', '', 'teja@gmail.com'),
(40, 'kithmal', '123123', '', 'kithmal@gmail.com'),
(41, 'ankur', '123123', '', 'ankur@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_code`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_code`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_code`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `branch_code` (`branch_code`),
  ADD KEY `category_code` (`category_code`),
  ADD KEY `designation_code` (`designation_code`),
  ADD KEY `department_code` (`department_code`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_code` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_code` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_code`) REFERENCES `branch` (`branch_code`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`category_code`) REFERENCES `category` (`category_code`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`designation_code`) REFERENCES `designation` (`designation_code`),
  ADD CONSTRAINT `employee_ibfk_5` FOREIGN KEY (`department_code`) REFERENCES `department` (`department_code`),
  ADD CONSTRAINT `employee_ibfk_6` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_code`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
