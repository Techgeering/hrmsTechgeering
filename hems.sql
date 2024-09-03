-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 03:33 PM
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
-- Database: `hems`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `assign_to` varchar(100) NOT NULL,
  `particulars` varchar(50) NOT NULL,
  `tex_type` enum('GST','NONGST') NOT NULL,
  `gst` varchar(20) NOT NULL,
  `deposite` varchar(20) NOT NULL,
  `withdraw` varchar(20) NOT NULL,
  `balance` varchar(20) NOT NULL,
  `balance_T` varchar(20) NOT NULL,
  `balance_WT` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `pro_id`, `assign_to`, `particulars`, `tex_type`, `gst`, `deposite`, `withdraw`, `balance`, `balance_T`, `balance_WT`, `date`, `date_time`) VALUES
(1, 0, '', 'extra expences', 'GST', '12', '100', '', '100', '100', '', '2024-08-16', '2024-08-16 19:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `addition`
--

CREATE TABLE `addition` (
  `addi_id` int(14) NOT NULL,
  `salary_id` int(14) NOT NULL,
  `basic` varchar(128) DEFAULT NULL,
  `medical` varchar(64) DEFAULT NULL,
  `house_rent` varchar(64) DEFAULT NULL,
  `conveyance` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `addition`
--

INSERT INTO `addition` (`addi_id`, `salary_id`, `basic`, `medical`, `house_rent`, `conveyance`) VALUES
(1, 1, '2750.00', '275.00', '2200.00', '275.00'),
(2, 2, '6750.00', '675.00', '5400.00', '675.00'),
(3, 3, '9050.00', '905.00', '7240.00', '905.00'),
(4, 4, '2782.50', '278.25', '2226.00', '278.25'),
(5, 5, '3450.00', '345.00', '2760.00', '345.00'),
(6, 6, '3975.00', '397.50', '3180.00', '397.50'),
(7, 7, '4300.00', '430.00', '3440.00', '430.00'),
(8, 8, '5500.00', '550.00', '4400.00', '550.00'),
(9, 9, '3500.00', '350.00', '2800.00', '350.00'),
(10, 10, '2800.00', '280.00', '2240.00', '280.00');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(128) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `type` enum('Present','Permanent') DEFAULT 'Present'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `emp_id`, `address1`, `address2`, `city`, `state`, `country`, `pincode`, `type`) VALUES
(1, '123456', 'aassaaadvdfsgfdgs', 'aafsdfgs', 'aaaMuscle Shoals', 'aafgdfg', 'aaUS', 'aa123456', 'Permanent'),
(2, '99', 'sdfgds', 'sdfgfd', 'Muscle Shoals', 'sfdgfdsg', 'US', '123456', 'Present'),
(5, '4445', 'dcdfvd', 'ddcv', NULL, '', NULL, NULL, 'Permanent'),
(6, '4445', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(7, '5845', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(8, '5845', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(9, '52122', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(10, '52122', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(11, '', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(12, '', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(13, '', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(14, '', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(15, '10', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(16, '10', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(17, '414', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(18, '414', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(19, '20', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(20, '20', NULL, NULL, NULL, '', NULL, NULL, 'Present'),
(21, '14', NULL, NULL, NULL, '', NULL, NULL, 'Permanent'),
(22, '14', NULL, NULL, NULL, '', NULL, NULL, 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `ass_id` int(14) NOT NULL,
  `catid` varchar(14) NOT NULL,
  `ass_name` varchar(256) DEFAULT NULL,
  `ass_brand` varchar(128) DEFAULT NULL,
  `ass_model` varchar(256) DEFAULT NULL,
  `ass_code` varchar(256) DEFAULT NULL,
  `configuration` varchar(512) DEFAULT NULL,
  `purchasing_date` varchar(128) DEFAULT NULL,
  `ass_price` varchar(128) DEFAULT NULL,
  `ass_qty` varchar(64) DEFAULT NULL,
  `in_stock` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`ass_id`, `catid`, `ass_name`, `ass_brand`, `ass_model`, `ass_code`, `configuration`, `purchasing_date`, `ass_price`, `ass_qty`, `in_stock`) VALUES
(1, '3', 'Laptop T10', 'Dell', 'Alienware', 'AW569', 'demo config demo config demo config', '12/23/2021', '1949', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `assets_category`
--

CREATE TABLE `assets_category` (
  `cat_id` int(14) NOT NULL,
  `cat_status` enum('ASSETS','LOGISTIC') NOT NULL DEFAULT 'ASSETS',
  `cat_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assets_category`
--

INSERT INTO `assets_category` (`cat_id`, `cat_status`, `cat_name`) VALUES
(1, 'ASSETS', 'TAB'),
(2, 'ASSETS', 'Computer'),
(3, 'ASSETS', 'Laptop'),
(4, 'LOGISTIC', 'tab');

-- --------------------------------------------------------

--
-- Table structure for table `assign_leave`
--

CREATE TABLE `assign_leave` (
  `id` int(14) NOT NULL,
  `app_id` varchar(11) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(14) NOT NULL,
  `day` varchar(256) DEFAULT NULL,
  `hour` varchar(255) NOT NULL,
  `total_day` varchar(64) DEFAULT NULL,
  `dateyear` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assign_leave`
--

INSERT INTO `assign_leave` (`id`, `app_id`, `emp_id`, `type_id`, `day`, `hour`, `total_day`, `dateyear`) VALUES
(1, '', 'Moo1402', 2, NULL, '8', NULL, '2021'),
(2, '', 'Tho1044', 2, NULL, '56', NULL, '2022'),
(3, '', 'Den1745', 1, NULL, '8', NULL, '2022');

-- --------------------------------------------------------

--
-- Table structure for table `assign_task`
--

CREATE TABLE `assign_task` (
  `id` int(14) NOT NULL,
  `task_id` int(14) NOT NULL,
  `project_id` int(14) NOT NULL,
  `assign_user` varchar(64) DEFAULT NULL,
  `user_type` enum('Team Head','Collaborators') NOT NULL DEFAULT 'Collaborators'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assign_task`
--

INSERT INTO `assign_task` (`id`, `task_id`, `project_id`, `assign_user`, `user_type`) VALUES
(1, 1, 2, 'Thom', 'Team Head'),
(2, 1, 2, 'Doe1753', 'Collaborators'),
(8, 10, 2, 'Monalisa Das', 'Team Head'),
(9, 10, 2, 'user3', 'Collaborators'),
(10, 11, 2, 'aaMichael', 'Team Head'),
(11, 11, 2, 'Thom', 'Collaborators'),
(12, 12, 2, 'Thom', 'Team Head'),
(13, 12, 2, 'user2', 'Collaborators'),
(14, 13, 2, 'Colin', 'Team Head'),
(15, 13, 2, 'user2', 'Collaborators'),
(16, 14, 2, 'Emily', 'Team Head'),
(17, 14, 2, 'ASUTOSH DAS', 'Collaborators'),
(18, 15, 6, 'Emily', 'Team Head'),
(19, 15, 6, 'Stephany', 'Collaborators'),
(20, 16, 1, 'Emily', 'Team Head'),
(21, 16, 1, 'Emily', 'Collaborators'),
(22, 17, 1, 'Chris', 'Team Head'),
(23, 17, 1, 'Monalisa Das', 'Collaborators'),
(24, 18, 2, 'Monalisa Das', 'Team Head'),
(25, 18, 2, 'Monalisa Das', 'Collaborators'),
(26, 19, 2, 'Emily', 'Team Head'),
(27, 19, 2, 'gghh', 'Collaborators'),
(28, 20, 2, 'John', 'Team Head'),
(29, 20, 2, 'Thom', 'Collaborators'),
(30, 21, 2, 'nnnnn', 'Team Head'),
(31, 21, 2, 'Thom,fffff,John', 'Collaborators'),
(32, 22, 0, 'aaMichael', 'Team Head'),
(33, 22, 0, 'Thom', 'Collaborators'),
(34, 23, 1, 'Stephany', 'Team Head'),
(35, 23, 1, 'Thom,fffff', 'Collaborators'),
(36, 24, 1, 'Monalisa Das', 'Team Head'),
(37, 24, 1, 'nnnnn', 'Collaborators'),
(38, 25, 1, 'nnnnn', 'Team Head'),
(39, 25, 1, 'Thom', 'Collaborators'),
(40, 26, 1, 'Colin', 'Team Head'),
(41, 26, 1, 'fffff', 'Collaborators'),
(42, 27, 1, 'Liam', 'Team Head'),
(43, 27, 1, 'Thom', 'Collaborators'),
(44, 28, 1, 'ASUTOSH DAS', 'Team Head'),
(45, 28, 1, 'fffff', 'Collaborators'),
(46, 29, 1, 'Colin', 'Team Head'),
(47, 29, 1, 'John', 'Collaborators'),
(48, 30, 1, 'Emily', 'Team Head'),
(49, 30, 1, 'gghh', 'Collaborators'),
(50, 31, 1, 'aaaaa', 'Team Head'),
(51, 31, 1, 'Thom', 'Collaborators'),
(52, 32, 1, 'Monalisa Das', 'Team Head'),
(53, 32, 1, 'Thom', 'Collaborators'),
(54, 33, 1, 'Emily', 'Team Head'),
(55, 33, 1, 'Thom', 'Collaborators'),
(56, 34, 3, 'Colin', 'Team Head'),
(57, 34, 3, 'Thom', 'Collaborators');

-- --------------------------------------------------------

--
-- Table structure for table `attadence_report`
--

CREATE TABLE `attadence_report` (
  `id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `working_hour` int(11) DEFAULT NULL,
  `present_hour` int(11) DEFAULT NULL,
  `holiday_hour` int(11) DEFAULT NULL,
  `leave_hour` int(11) DEFAULT NULL,
  `payable_hour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attadence_report`
--

INSERT INTO `attadence_report` (`id`, `month`, `emp_id`, `working_hour`, `present_hour`, `holiday_hour`, `leave_hour`, `payable_hour`) VALUES
(1, '', 123456, 205, 205, 66, 17, 288),
(2, '06-2024', 123456, 205, 205, 66, 17, 288),
(3, '01-2023', 123456, 218, 205, 0, 0, 205);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `atten_date` varchar(64) DEFAULT NULL,
  `signin_time` time DEFAULT NULL,
  `signout_time` time DEFAULT NULL,
  `working_hour` varchar(64) DEFAULT NULL,
  `place` varchar(255) NOT NULL,
  `absence` varchar(128) DEFAULT NULL,
  `overtime` varchar(128) DEFAULT NULL,
  `earnleave` varchar(128) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `atten_date`, `signin_time`, `signout_time`, `working_hour`, `place`, `absence`, `overtime`, `earnleave`, `status`) VALUES
(1, '123456', '01-06-2024', '08:30:00', '17:30:00', '5', '', NULL, NULL, NULL, NULL),
(2, '123456', '03-06-2024', '08:45:00', '17:45:00', '9', '', NULL, NULL, NULL, NULL),
(3, '123456', '04-06-2024', '09:15:00', '18:15:00', '9', '', NULL, NULL, NULL, NULL),
(4, '123456', '05-06-2024', '08:00:00', '17:00:00', '9', '', NULL, NULL, NULL, NULL),
(5, '123456', '06-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(6, '123456', '07-06-2024', '08:30:00', '17:30:00', '9', '', NULL, NULL, NULL, NULL),
(7, '123456', '08-06-2024', '09:00:00', '18:00:00', '5', '', NULL, NULL, NULL, NULL),
(8, '123456', '10-06-2024', '09:15:00', '18:15:00', '9', '', NULL, NULL, NULL, NULL),
(9, '123456', '11-06-2024', '08:00:00', '17:00:00', '9', '', NULL, NULL, NULL, NULL),
(10, '123456', '12-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(11, '123456', '13-06-2024', '08:30:00', '17:30:00', '9', '', NULL, NULL, NULL, NULL),
(12, '123456', '14-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(13, '123456', '15-06-2024', '08:45:00', '17:45:00', '5', '', NULL, NULL, NULL, NULL),
(14, '123456', '17-06-2024', '08:00:00', '17:00:00', '9', '', NULL, NULL, NULL, NULL),
(15, '123456', '18-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(16, '123456', '19-06-2024', '08:30:00', '17:30:00', '9', '', NULL, NULL, NULL, NULL),
(17, '123456', '20-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(18, '123456', '21-06-2024', '08:45:00', '17:45:00', '9', '', NULL, NULL, NULL, NULL),
(19, '123456', '22-06-2024', '09:15:00', '18:15:00', '5', '', NULL, NULL, NULL, NULL),
(20, '123456', '24-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(21, '123456', '25-06-2024', '08:30:00', '17:30:00', '9', '', NULL, NULL, NULL, NULL),
(22, '123456', '26-06-2024', '09:00:00', '18:00:00', '9', '', NULL, NULL, NULL, NULL),
(23, '123456', '27-06-2024', '08:45:00', '17:45:00', '9', '', NULL, NULL, NULL, NULL),
(24, '123456', '28-06-2024', '09:15:00', '18:15:00', '9', '', NULL, NULL, NULL, NULL),
(25, '123456', '29-06-2024', '08:00:00', '17:00:00', '5', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `holder_name` varchar(256) DEFAULT NULL,
  `bank_name` varchar(256) DEFAULT NULL,
  `branch_name` varchar(256) DEFAULT NULL,
  `account_number` varchar(256) DEFAULT NULL,
  `account_type` varchar(256) DEFAULT NULL,
  `ifsc_code` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `em_id`, `holder_name`, `bank_name`, `branch_name`, `account_number`, `account_type`, `ifsc_code`) VALUES
(1, '10', NULL, NULL, NULL, NULL, NULL, 0),
(2, '414', NULL, NULL, NULL, NULL, NULL, 0),
(3, '20', NULL, NULL, NULL, NULL, NULL, 0),
(4, '14', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `de_id` int(14) NOT NULL,
  `salary_id` int(14) NOT NULL,
  `provident_fund` varchar(64) DEFAULT NULL,
  `bima` varchar(64) DEFAULT NULL,
  `tax` varchar(64) DEFAULT NULL,
  `others` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`de_id`, `salary_id`, `provident_fund`, `bima`, `tax`, `others`) VALUES
(1, 1, '400', '0', '10', '0'),
(2, 2, '250', '360', '10', '0'),
(3, 3, '500', '0', '10', '0'),
(4, 4, '0', '0', '5', '0'),
(5, 5, '0', '0', '0', '0'),
(6, 6, '265', '0', '10', '0'),
(7, 7, '200', '300', '7', '0'),
(8, 8, '300', '560', '10', '0'),
(9, 9, '0', '0', '0', '0'),
(10, 10, '0', '100', '10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(64) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dep_name`, `status`) VALUES
(1, 'cgbgfb', '0'),
(2, 'ffcf', '0'),
(3, 'Administration', '0'),
(4, 'Finance, HR, & Admininstration', '0'),
(6, 'Research', '0'),
(7, 'Information Technology', '0'),
(8, 'Support', '0'),
(9, 'Network Engineering', '0'),
(10, 'Sales and Marketing', '0'),
(11, 'Helpdesk', '0'),
(12, 'Project Management', '0');

-- --------------------------------------------------------

--
-- Table structure for table `desciplinary`
--

CREATE TABLE `desciplinary` (
  `id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `action` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `desciplinary`
--

INSERT INTO `desciplinary` (`id`, `em_id`, `action`, `title`, `description`) VALUES
(1, '123456', 'Writing Warning', 'Test Test Test', 'Test Test Test Test');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `des_name` varchar(64) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `des_name`, `status`) VALUES
(1, 'Admin', '1'),
(2, 'Manager', '1'),
(3, 'Hr', '1'),
(4, 'Employee', '0');

-- --------------------------------------------------------

--
-- Table structure for table `earned_leave`
--

CREATE TABLE `earned_leave` (
  `id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `present_date` varchar(64) DEFAULT NULL,
  `hour` varchar(64) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `earned_leave`
--

INSERT INTO `earned_leave` (`id`, `em_id`, `present_date`, `hour`, `status`) VALUES
(26, 'Mir1685', '0', '0', '1'),
(27, 'Rah1682', '0', '0', '1'),
(28, 'edr1432', '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(128) DEFAULT NULL,
  `edu_type` varchar(256) DEFAULT NULL,
  `institute` varchar(256) DEFAULT NULL,
  `university` varchar(100) NOT NULL,
  `result` varchar(64) DEFAULT NULL,
  `year` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `emp_id`, `edu_type`, `institute`, `university`, `result`, `year`) VALUES
(1, '99', 'ckdcdcnj', 'Vvfcd', 'njdfnv', '54%', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `em_code` varchar(64) DEFAULT NULL,
  `des_id` int(11) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `em_email` varchar(64) DEFAULT NULL,
  `em_password` varchar(512) NOT NULL,
  `em_role` int(10) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `em_gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `em_phone` varchar(64) DEFAULT NULL,
  `em_wahtsapp` varchar(64) DEFAULT NULL,
  `em_birthday` varchar(128) DEFAULT NULL,
  `em_blood_group` enum('O+','O-','A+','A-','B+','B-','AB+','OB+') DEFAULT NULL,
  `em_joining_date` varchar(128) DEFAULT NULL,
  `em_contact_end` varchar(128) DEFAULT NULL,
  `em_image` varchar(128) DEFAULT NULL,
  `em_aadher` varchar(64) DEFAULT NULL,
  `em_pan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `em_code`, `des_id`, `dep_id`, `full_name`, `em_email`, `em_password`, `em_role`, `status`, `em_gender`, `em_phone`, `em_wahtsapp`, `em_birthday`, `em_blood_group`, `em_joining_date`, `em_contact_end`, `em_image`, `em_aadher`, `em_pan`) VALUES
(10, '99', 3, 1, 'Thom', 'thoma@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 3, 'ACTIVE', 'Female', '7856587870', '3121141214', '1998-02-22', 'A+', '2018-01-25', '2018-01-17', 'userav-min.png', '13215456655645242', 0),
(36, '123456', 10, 7, 'fffff', 'ssadmin@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 3, 'ACTIVE', 'Female', 'ss999999900', '42429999999999', '1950-12-13', 'A+', '2010-02-15', '2007-02-22', 'user.png', '55201253568955555', 1),
(37, '123444', 12, 2, 'John', 'employee@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', 'Male', '1111110010', '', '1995-10-30', 'O+', '2019-02-15', '2019-02-22', 'Doe1753.jpg', '01253568955555', 0),
(38, '6969', 13, 4, 'Liam', 'liam@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', 'Male', '7124589965', '', '1994-03-23', 'A-', '2021-05-04', '2023-05-17', 'Moo1402.png', '1234567890', 0),
(39, '1058', 9, 4, 'Stephany', 'stephany@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', 'Female', '7850001111', '8769534214', '1992-12-24', 'A+', '2021-04-14', '2024-07-10', 'Rob1472.png', '7000105000', 5415245),
(40, '8877', 13, 4, 'Chris', 'chris@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'INACTIVE', 'Male', '7852140000', '', '1993-01-02', 'AB+', '2021-10-01', '', 'Tho1044.png', '0102580010', 0),
(41, '3008', 3, 1, 'Colin', 'colin@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', 'Male', '7400001450', '2514823056', '1990-12-12', 'A-', '2021-10-10', '2024-07-24', 'Smi1266.png', '0147000000', 0),
(42, '6661', 26, 10, 'Christine', 'christine@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 1, 'INACTIVE', 'Male', '1010140000', '', '1991-04-05', 'AB+', '2021-10-10', '', 'Moo1634.png', '147850000144', 0),
(43, '8829', 22, 7, 'aaMichael', 'michael@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', 'Male', '7801450000', '', '1986-02-23', 'B-', '2021-02-02', '', 'Joh1474.png', '600254000014', 0),
(44, '6600', 20, 7, 'Emily', 'emily@mail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'INACTIVE', 'Female', '7410144470', '', '1996-03-03', 'AB+', '2021-10-10', '', 'Den1745.png', '880024520000', 0),
(45, 'aaaaa', 15, 2, 'aaaaa', 'aaa@aaa.ccc', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 1, 'INACTIVE', '', '9999999999', '9999999999', '2004-06-17', 'O-', '2024-06-16', '', '', '999999999999', 0),
(47, 'aaaaa', 15, 10, 'ASUTOSH DAS', 'asutoshdas49@gmail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 1, 'ACTIVE', '', '07978015671', '9999999999', '1997-06-06', 'B+', '2024-06-18', '', 'assets/uploads/employee/66719837db887.avif', '999999999999', 0),
(48, '4445', 1, 1, 'Monalisa Das', 'gjfvghfv@gmail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 4, 'ACTIVE', 'Female', '52472552745', '54752475744574547', '2024-07-11', 'O+', '2024-07-26', '2024-07-27', 'assets/uploads/employee/669e83e4af6f1.jpg', '45824264754', 2147483647),
(49, '5845', 4, 3, 'nnnnn', 'jkjk@gmail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 1, 'ACTIVE', 'Female', '5264546454', '5121244154', '2024-07-18', 'A-', '2024-07-26', '2024-07-25', 'assets/uploads/employee/669e8c36b6dbc.jpg', '5415454545', 2147483647),
(50, '52122', 4, 3, 'gghh', 'bnbn@gmail.com', '$2y$10$f6AiCtTnJ7yxa/Nxa6YAq.EBmXHYNogdppsrTQibk0sgRCC9/bUJa', 2, 'ACTIVE', '', '254854215', '21548754214', '2024-07-11', 'O+', '2024-07-25', '2024-07-30', '', '56895656565', 2147483647),
(52, '', 0, 0, '', '', '', 0, 'ACTIVE', '', '', '', '', '', '', '', '', '', 0),
(53, '10', 0, 3, 'Monalisa', 'mona@123gmail.com', '258475255625', 1, 'ACTIVE', '', '258475255625', '54455212521', '2024-09-13', 'A+', '2024-09-21', '2024-09-24', 'assets/uploads/employee/66d6fc07ec1e1.jpg', '524752452475', 2147483647),
(54, '414', 0, 8, 'fgfg', 'dfgg@123gmail.com', '74575757', 1, 'ACTIVE', '', '74575757', '574574577', '2024-09-12', 'B+', '2024-09-20', '2024-09-12', '', '5475745', 524757445),
(55, '', 2, 10, 'Mona', 'mona@123gmail.com', '9987456230', 0, 'ACTIVE', '', 'O-', '9987456230', '2024-09-18', '', '2024-09-05', '2024-09-19', '', '554865426662', 548544554),
(56, '', 1, 10, 'roja', 'vfd@12gmail.com', '9874563210', 0, 'ACTIVE', '', 'O+', '9874563210', '2024-09-12', '', '2024-09-20', '2024-09-27', '', '5424725454', 757474574);

-- --------------------------------------------------------

--
-- Table structure for table `employee_file`
--

CREATE TABLE `employee_file` (
  `id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `file_title` varchar(512) DEFAULT NULL,
  `file_url` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee_file`
--

INSERT INTO `employee_file` (`id`, `em_id`, `file_title`, `file_url`) VALUES
(1, '123456', 'gjgjh', 'hfjhf'),
(2, '3008', 'fgvbh', '669e3e25d769f.pdf'),
(3, '52122', 'dfvd', '669f3390f0d50.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `emp_assets`
--

CREATE TABLE `emp_assets` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `assets_id` int(11) NOT NULL,
  `given_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_experience`
--

CREATE TABLE `emp_experience` (
  `id` int(14) NOT NULL,
  `emp_id` varchar(256) DEFAULT NULL,
  `exp_company` varchar(128) DEFAULT NULL,
  `exp_com_position` varchar(128) DEFAULT NULL,
  `exp_com_address` varchar(128) DEFAULT NULL,
  `exp_workduration` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `emp_experience`
--

INSERT INTO `emp_experience` (`id`, `emp_id`, `exp_company`, `exp_com_position`, `exp_com_address`, `exp_workduration`) VALUES
(1, '123456', 'fvbfvb', 'cvvc', 'dvvd', 'fff'),
(3, '6661', 'gdgg', 'dfvdf', 'dfdfg', '1hr'),
(5, '99', 'dfgfd7457', 'Vfdgvg', 'dvgcf', '41');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `id` int(11) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `typeid` int(14) NOT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `end_date` varchar(64) DEFAULT NULL,
  `leave_duration` varchar(128) DEFAULT NULL,
  `duration_hour` int(11) NOT NULL,
  `apply_date` varchar(64) DEFAULT NULL,
  `reason` varchar(1024) DEFAULT NULL,
  `leave_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `em_id`, `typeid`, `start_date`, `end_date`, `leave_duration`, `duration_hour`, `apply_date`, `reason`, `leave_status`) VALUES
(1, '99', 1, '2024-09-22', '2024-09-26', '4', 27, '02-09-2024', 'hbbhjj', 0),
(2, '99', 2, '2024-09-13', '2024-09-21', '8', 59, '02-09-2024', 'gbhgfhbf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_penalty`
--

CREATE TABLE `emp_penalty` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `penalty_id` int(11) NOT NULL,
  `penalty_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE `emp_salary` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `total` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `emp_salary`
--

INSERT INTO `emp_salary` (`id`, `emp_id`, `type_id`, `total`) VALUES
(1, 'Doe1754', 2, '5500'),
(2, 'Doe1753', 2, '13500'),
(3, 'Soy1332', 2, '18100'),
(4, 'Rob1472', 2, '5565'),
(5, 'Moo1402', 2, '6900'),
(6, 'Smi1266', 2, '7950'),
(7, 'Moo1634', 2, '8600'),
(8, 'Joh1474', 2, '11000'),
(9, 'Tho1044', 2, '7000'),
(10, 'Den1745', 2, '5600');

-- --------------------------------------------------------

--
-- Table structure for table `emp_training`
--

CREATE TABLE `emp_training` (
  `id` int(11) NOT NULL,
  `trainig_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(11) NOT NULL,
  `expenditure_name` varchar(50) NOT NULL,
  `fixed_cost` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `expenditure_name`, `fixed_cost`, `duration`) VALUES
(1, 'Salary', '8000', ' 1month'),
(2, 'Roomrent', '10000', ' 1month'),
(3, 'Waterbill', '', ' '),
(4, 'Festivals', '', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_calculator`
--

CREATE TABLE `expenditure_calculator` (
  `id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenditure_calculator`
--

INSERT INTO `expenditure_calculator` (`id`, `year`, `month`, `name`) VALUES
(1, '2007', 'June', 'Salary=8000,Roomrent=10000,Waterbill=4445,Festivals=2424'),
(2, '2024', 'July', 'Salary=8000,Roomrent=10000,Waterbill=6222,Festivals=5216'),
(3, '', '', 'Salary=8000,Roomrent=10000,Waterbill=500,Festivals=5000'),
(4, '', '', '8000,10000,400,5500'),
(5, '', '', '19000'),
(6, '2000', 'April', '20000'),
(7, '', '', '=,=,=,=');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_list`
--

CREATE TABLE `expenditure_list` (
  `id` int(11) NOT NULL,
  `expencal_id` int(11) NOT NULL,
  `expenname_id` int(11) NOT NULL,
  `expen_price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenditure_list`
--

INSERT INTO `expenditure_list` (`id`, `expencal_id`, `expenname_id`, `expen_price`) VALUES
(1, 6, 1, '8000'),
(2, 6, 2, '10000'),
(3, 6, 3, '1000'),
(4, 6, 4, '1000');

-- --------------------------------------------------------

--
-- Table structure for table `field_visit`
--

CREATE TABLE `field_visit` (
  `id` int(14) NOT NULL,
  `project_id` varchar(256) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `field_location` varchar(512) NOT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `approx_end_date` varchar(28) NOT NULL,
  `total_days` varchar(64) DEFAULT NULL,
  `notes` varchar(500) NOT NULL,
  `actual_return_date` varchar(28) NOT NULL,
  `status` enum('Approved','Not Approve','Rejected') NOT NULL DEFAULT 'Not Approve',
  `attendance_updated` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(256) DEFAULT NULL,
  `from_date` varchar(64) DEFAULT NULL,
  `to_date` varchar(64) DEFAULT NULL,
  `number_of_days` varchar(64) DEFAULT NULL,
  `year` varchar(64) DEFAULT NULL,
  `number_of_holiday_hour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_name`, `from_date`, `to_date`, `number_of_days`, `year`, `number_of_holiday_hour`) VALUES
(1, 'New Year\'s Day', '2024-09-01', '2024-09-02', '1', '09-2024', 0),
(2, ' Christmas', '2024-09-23', '2024-09-25', '2', '09-2024', 18),
(3, 'Thanksgiving', '2024-09-12', '2024-09-21', '9', '09-2024', 68),
(4, 'Hallowee', '2024-09-11', ' ', '10', '09-2024', 77),
(5, ' Saint Patrick\'s Day', '2024-09-05', '2024-09-13', '8', '09-2024', 59);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `lead_name` varchar(150) DEFAULT NULL,
  `companyname` varchar(150) DEFAULT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `interested_in` varchar(50) DEFAULT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `lead_date` datetime DEFAULT NULL,
  `lastfollowupdate` datetime DEFAULT NULL,
  `nextfollowupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `lead_name`, `companyname`, `phone_no`, `email_id`, `city`, `state`, `country`, `source`, `status`, `interested_in`, `business_type`, `lead_date`, `lastfollowupdate`, `nextfollowupdate`) VALUES
(1, 'rsdfrdf', 'dfefvfe', '9944512368', 'monalisadas1964@gmail.com', 'fdgvfgbf', 'Nagalandd', 'gfbfhf', 'ghgfh', 1, 'gfbh', 'ghbgfh', '2024-09-02 12:19:52', '2024-09-02 12:39:02', '2024-09-05 16:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `lead_follow`
--

CREATE TABLE `lead_follow` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `next_date` datetime DEFAULT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lead_follow`
--

INSERT INTO `lead_follow` (`id`, `lead_id`, `start_date`, `next_date`, `message`) VALUES
(1, 1, '2024-09-02 12:23:01', '2024-09-02 15:55:00', 'bvfhnbm'),
(2, 1, '2024-09-02 12:25:43', '2024-09-02 15:57:00', 'dad'),
(3, 1, '2024-09-02 12:29:10', '2024-09-06 15:01:00', 'dsad'),
(4, 1, '2024-09-02 12:31:11', '2024-09-02 16:04:00', 'asds'),
(5, 1, '2024-09-02 12:32:43', '2024-09-02 16:06:00', 'dszf'),
(6, 1, '2024-09-02 12:37:32', '2024-09-02 16:06:00', 'sad'),
(7, 1, '2024-09-02 12:39:02', '2024-09-05 16:08:00', 'hvnjh');

-- --------------------------------------------------------

--
-- Table structure for table `leave_apply_approve`
--

CREATE TABLE `leave_apply_approve` (
  `id` int(11) NOT NULL,
  `leaveapp_id` int(20) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_apply_approve`
--

INSERT INTO `leave_apply_approve` (`id`, `leaveapp_id`, `approved_by`, `datetime`) VALUES
(1, 1, 1, '0000-00-00 00:00:00'),
(2, 3, 1, '0000-00-00 00:00:00'),
(3, 1, 2, '0000-00-00 00:00:00'),
(4, 3, 1, '2024-09-01 20:33:21'),
(5, 3, 1, '2024-09-01 20:33:27'),
(6, 3, 1, '2024-09-01 20:33:43'),
(7, 2, 1, '2024-09-01 20:49:54'),
(8, 1, 1, '2024-09-01 20:57:39'),
(9, 1, 1, '2024-09-02 08:37:05'),
(10, 1, 1, '2024-09-02 08:37:14'),
(11, 2, 1, '2024-09-02 11:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `type_id` int(14) NOT NULL,
  `name` varchar(64) NOT NULL,
  `leave_day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`type_id`, `name`, `leave_day`) VALUES
(1, 'Casual Leave', '21'),
(2, 'Sick Leave', '15'),
(3, 'Maternity Leave', '90'),
(4, 'Paternal Leave', '7'),
(5, 'Earned leave', '3'),
(7, 'Public Holiday', '5'),
(8, 'Optional Leave', '8'),
(9, 'Leave without Pay', '2'),
(10, 'dsadfds', '4'),
(11, 'xdc', '11'),
(12, 'cvvcvss', '10');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(14) NOT NULL,
  `emp_id` varchar(256) DEFAULT NULL,
  `amount` varchar(256) DEFAULT NULL,
  `interest_percentage` varchar(256) DEFAULT NULL,
  `total_amount` varchar(64) DEFAULT NULL,
  `total_pay` varchar(64) DEFAULT NULL,
  `total_due` varchar(64) DEFAULT NULL,
  `installment` varchar(256) DEFAULT NULL,
  `loan_number` varchar(256) DEFAULT NULL,
  `loan_details` varchar(256) DEFAULT NULL,
  `approve_date` varchar(256) DEFAULT NULL,
  `install_period` varchar(256) DEFAULT NULL,
  `status` enum('Granted','Deny','Pause','Done') NOT NULL DEFAULT 'Pause'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `emp_id`, `amount`, `interest_percentage`, `total_amount`, `total_pay`, `total_due`, `installment`, `loan_number`, `loan_details`, `approve_date`, `install_period`, `status`) VALUES
(1, 'Doe1753', '65000', NULL, NULL, '10833', '54167', '10833', '19073382', 'this is a demo loan test for demo purpose', '2021-04-20', '5', 'Granted');

-- --------------------------------------------------------

--
-- Table structure for table `loan_installment`
--

CREATE TABLE `loan_installment` (
  `id` int(14) NOT NULL,
  `loan_id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `loan_number` varchar(256) DEFAULT NULL,
  `install_amount` varchar(256) DEFAULT NULL,
  `pay_amount` varchar(64) DEFAULT NULL,
  `app_date` varchar(256) DEFAULT NULL,
  `receiver` varchar(256) DEFAULT NULL,
  `install_no` varchar(256) DEFAULT NULL,
  `notes` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loan_installment`
--

INSERT INTO `loan_installment` (`id`, `loan_id`, `emp_id`, `loan_number`, `install_amount`, `pay_amount`, `app_date`, `receiver`, `install_no`, `notes`) VALUES
(32, 1, 'Doe1753', '19073382', '10833', NULL, '2021-11-30', NULL, '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logistic_asset`
--

CREATE TABLE `logistic_asset` (
  `log_id` int(14) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `qty` varchar(64) DEFAULT NULL,
  `entry_date` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logistic_asset`
--

INSERT INTO `logistic_asset` (`log_id`, `name`, `qty`, `entry_date`) VALUES
(1, 'Lubricant', '30', '12/25/17');

-- --------------------------------------------------------

--
-- Table structure for table `logistic_assign`
--

CREATE TABLE `logistic_assign` (
  `ass_id` int(14) NOT NULL,
  `asset_id` int(14) NOT NULL,
  `assign_id` varchar(64) DEFAULT NULL,
  `project_id` int(14) NOT NULL,
  `task_id` int(14) NOT NULL,
  `log_qty` varchar(64) DEFAULT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `end_date` varchar(64) DEFAULT NULL,
  `back_date` varchar(64) DEFAULT NULL,
  `back_qty` varchar(64) DEFAULT NULL,
  `remarks` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_url` varchar(256) DEFAULT NULL,
  `date` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `file_url`, `date`) VALUES
(1, 'This is a demo notice for all!', 'sample_image.jpg', '2022-01-01'),
(2, 'Office Decorum Notice to Staff Members', 'offnot1.png', '2021-12-21'),
(3, 'Warning for Violation of Office Decorum', 'offnot2.png', '2021-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(64) NOT NULL,
  `owner_position` varchar(64) DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_salary`
--

CREATE TABLE `pay_salary` (
  `pay_id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(14) NOT NULL,
  `month` varchar(64) DEFAULT NULL,
  `year` varchar(64) DEFAULT NULL,
  `paid_date` varchar(64) DEFAULT NULL,
  `total_days` varchar(64) DEFAULT NULL,
  `basic` varchar(64) DEFAULT NULL,
  `medical` varchar(64) DEFAULT NULL,
  `house_rent` varchar(64) DEFAULT NULL,
  `bonus` varchar(64) DEFAULT NULL,
  `bima` varchar(64) DEFAULT NULL,
  `tax` varchar(64) DEFAULT NULL,
  `provident_fund` varchar(64) DEFAULT NULL,
  `loan` varchar(64) DEFAULT NULL,
  `total_pay` varchar(128) DEFAULT NULL,
  `addition` int(128) NOT NULL,
  `diduction` int(128) NOT NULL,
  `status` enum('Paid','Process') DEFAULT 'Process',
  `paid_type` enum('Hand Cash','Bank') NOT NULL DEFAULT 'Bank'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pay_salary`
--

INSERT INTO `pay_salary` (`pay_id`, `emp_id`, `type_id`, `month`, `year`, `paid_date`, `total_days`, `basic`, `medical`, `house_rent`, `bonus`, `bima`, `tax`, `provident_fund`, `loan`, `total_pay`, `addition`, `diduction`, `status`, `paid_type`) VALUES
(1, 'Doe1754', 0, 'November', '2021', '2021-11-30', '208', '5500', NULL, NULL, NULL, NULL, NULL, NULL, '0', '5499.52', 0, 0, 'Paid', 'Bank'),
(2, 'Doe1753', 0, 'November', '2021', '2021-11-30', '184', '13500', NULL, NULL, NULL, NULL, NULL, NULL, '10833', '2667.08', 0, 10833, 'Paid', 'Bank'),
(3, 'Smi1266', 0, 'November', '2021', '2021-11-30', '184', '7950', NULL, NULL, NULL, NULL, NULL, NULL, '0', '7950.64', 0, 0, 'Paid', 'Bank'),
(4, 'Moo1634', 0, 'November', '2021', '2021-12-01', '184', '8600', NULL, NULL, NULL, NULL, NULL, NULL, '0', '8600.16', 0, 0, 'Paid', 'Hand Cash'),
(5, 'Tho1044', 0, 'November', '2021', '2021-12-01', '184', '7000', NULL, NULL, NULL, NULL, NULL, NULL, '0', '6999.36', 0, 0, 'Paid', 'Bank'),
(6, 'Den1745', 0, 'December', '2022', '2021-12-31', '208', '5600', NULL, NULL, NULL, NULL, NULL, NULL, '0', '5599.36', 0, 0, 'Paid', 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `id` int(11) NOT NULL,
  `penalty_name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(14) NOT NULL,
  `pro_name` varchar(128) DEFAULT NULL,
  `pro_start_date` varchar(128) DEFAULT NULL,
  `pro_end_date` varchar(128) DEFAULT NULL,
  `pro_description` varchar(1024) DEFAULT NULL,
  `pro_summary` varchar(512) DEFAULT NULL,
  `pro_status` enum('upcoming','complete','running') NOT NULL DEFAULT 'running',
  `progress` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_name`, `pro_start_date`, `pro_end_date`, `pro_description`, `pro_summary`, `pro_status`, `progress`) VALUES
(1, 'Project X23', 'Jan 4, 2022', 'Feb 2, 2022', ' This is just a demo project! This is just a demo project! This is just a demo project! This is just a demo project!', 'This is just a demo project!', 'upcoming', NULL),
(2, 'Multi User Chat System', 'Jan 1, 2022', 'April 14, 2022', ' You are required to develop a system that supports multi-user chatting with the help of top level technologies.', 'Development of Multi-User Chatting System', 'running', NULL),
(3, 'Image Enhancement Software', 'Dec 10, 2021', 'Mar 20, 2022', 'You are required to develop of computer based software where end users can receive quality results on image enhancement. This particular project requires large number of technologies with proper use and its features.', 'Development of Image Enhancement Software', 'running', NULL),
(4, 'aaaaaCustomer support service operation', '2024-07-18', '2024-07-26', 'sfcvfgdvgYou are required to develop a customer support service based operation using DotNet (.Net)', 'fvggvfgfrDevelop a customer support service operation', 'complete', NULL),
(5, 'Real Estate Site', 'Dec 29, 2021', 'Mar 21, 2022', ' You are required to develop a real estate website using React, Nodejs.', 'Develop a real-estate website', 'running', NULL),
(6, 'Graphics Illustration', 'Jan 2, 2022', 'Jan 10, 2022', 'You are required to make a graphic illustration for XYZ company. ', 'Make a graphic illustration for ....', 'running', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE `project_file` (
  `id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `file_details` varchar(1028) DEFAULT NULL,
  `file_url` varchar(256) DEFAULT NULL,
  `assigned_to` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_file`
--

INSERT INTO `project_file` (`id`, `pro_id`, `file_details`, `file_url`, `assigned_to`) VALUES
(1, 66, 'dfasd', 'fffff', '2'),
(2, 66, 'asaassa', 'fffff', '1'),
(3, 1, 'fvfdgvf', '66a24b99db7a7.pdf', 'Thom'),
(4, 0, 'ertfdtrdgt', '66a0d178e5bf5.pdf', 'John'),
(5, 0, 'rdgf', '66a0d1b792a71.pdf', 'Chris'),
(6, 2, 'sdfg', '66a0d29db0bb3.pdf', 'Thom'),
(7, 2, 'sadasd', '66a0d38d43e19.pdf', 'fffff'),
(8, 2, 'sadsf', '66a0d49fea6af.pdf', 'John'),
(9, 2, 'sfdasdf', '66a0d4c305680.pdf', 'Thom'),
(10, 2, 'cdsadfd', '66a0d4f4e061a.pdf', 'John'),
(11, 2, 'mnbvc', '', 'Thom'),
(12, 2, 'lkjhgf', '66a0e944d9e62.pdf', 'fffff'),
(13, 2, 'xdvfcb', '66a0ecd69b8d0.pdf', 'Thom'),
(14, 4, 'sdfsfcdsf', '66a0f1a243cd2.pdf', 'aaMichael'),
(15, 4, 'redfhgfrh', '66a1016f362fa.pdf', 'Monalisa Das'),
(16, 4, 'sssss', '66a10188d231e.pdf', 'Emily'),
(17, 2, 'aaaa', '66a12b29030f3.pdf', 'fffff'),
(18, 6, 'regtgt', '66a1cf39a7ac7.pdf', 'aaMichael'),
(19, 3, 'dddddddddfdgfghff', '66a216e6e6bb7.pdf', 'aaMichael');

-- --------------------------------------------------------

--
-- Table structure for table `pro_expenses`
--

CREATE TABLE `pro_expenses` (
  `id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `assign_to` varchar(64) DEFAULT NULL,
  `details` varchar(512) DEFAULT NULL,
  `gst` varchar(20) NOT NULL,
  `amount` varchar(256) DEFAULT NULL,
  `balance` varchar(20) NOT NULL,
  `date` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pro_expenses`
--

INSERT INTO `pro_expenses` (`id`, `pro_id`, `assign_to`, `details`, `gst`, `amount`, `balance`, `date`) VALUES
(1, 1, '', 'fdgbhgh', '18%', '1180.00', '1180.00', '2024-07-26'),
(2, 1, 'aaMichael', 'sfrgfrgf', '18%', '1180.00', '2360', '2024-07-28'),
(3, 1, '', 'NON GST', '18%', '847.46', '3207.46', '2024-07-30'),
(4, 1, 'Colin', 'szxcsczsz', '', '-500', '2707.46', '2024-07-28'),
(5, 2, '', '<br /><b>Warning</b>:  Undefined array key \"details\" in <b>C:xampphtdocshrmsTechgeeringsingleProject.php</b> on line <b>671</b><br />', '12', '1358.56', '4066.02', '2024-08-04'),
(6, 2, 'aaaaa', 'sdfvdg', '', '-1420', '2646.02', '2024-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `pro_notes`
--

CREATE TABLE `pro_notes` (
  `id` int(14) NOT NULL,
  `assign_to` varchar(64) DEFAULT NULL,
  `pro_id` int(14) NOT NULL,
  `details` varchar(1024) DEFAULT NULL,
  `pro_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pro_notes`
--

INSERT INTO `pro_notes` (`id`, `assign_to`, `pro_id`, `details`, `pro_status`) VALUES
(1, 'aaMichael', 2, 'sfdsg', 1),
(2, 'fffff', 2, 'jkkjjj', 1),
(3, 'fffff', 2, 'aaa', 1),
(4, 'Chris', 3, 'vvvvvsdcsfvdfvdddd', 1),
(5, 'Stephany', 3, 'dvvdvd', 1),
(6, 'Emily', 1, 'cfbvcfbfcb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_task`
--

CREATE TABLE `pro_task` (
  `id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `task_title` varchar(256) DEFAULT NULL,
  `start_date` varchar(128) DEFAULT NULL,
  `end_date` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `task_type` enum('Office','Field') NOT NULL DEFAULT 'Office',
  `status` enum('running','complete','cancel') DEFAULT 'running',
  `location` varchar(512) DEFAULT NULL,
  `return_date` varchar(128) DEFAULT NULL,
  `total_days` varchar(128) DEFAULT NULL,
  `create_date` varchar(128) DEFAULT NULL,
  `approve_status` enum('Approved','Not Approve','Rejected') NOT NULL DEFAULT 'Not Approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pro_task`
--

INSERT INTO `pro_task` (`id`, `pro_id`, `task_title`, `start_date`, `end_date`, `image`, `description`, `task_type`, `status`, `location`, `return_date`, `total_days`, `create_date`, `approve_status`) VALUES
(1, 2, 'aaaaDemo Task Title for Testing', '2022-01-05', '2022-01-27', NULL, 'This is demo details for testing. This is demo details for testing', 'Office', 'running', NULL, NULL, NULL, '2022-01-03', ''),
(10, 2, 'qqq', '2024-07-24', '2024-07-24', NULL, 'sdfhd', 'Office', 'complete', NULL, NULL, NULL, NULL, 'Not Approve'),
(11, 2, 'hnvhgvniiiii', '2024-07-27', '2024-07-27', NULL, 'jkhgfx', 'Field', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(12, 2, 'hhhhh', '2024-07-24', '2024-07-24', NULL, 'zxcv', 'Field', 'complete', NULL, NULL, NULL, NULL, 'Not Approve'),
(13, 2, 'fff', '2024-07-24', '2024-07-24', NULL, 'ASdf', 'Office', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(14, 2, 'cccccc', '2024-07-24', '2024-07-24', NULL, 'AXSzdcv', 'Field', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(15, 6, 'dvgdfgfdgf', '2024-07-21', '2024-07-27', NULL, 'gfhn', 'Field', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(16, 1, 'dfvfdfd', '2024-07-28', '2024-07-30', NULL, 'dfgfgfhfd', 'Field', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(17, 1, 'dfvdgbfd', '2024-07-27', '2024-07-28', NULL, 'fhfthghfgh', 'Office', '', NULL, NULL, NULL, NULL, 'Not Approve'),
(18, 2, 'tttt', '2024-07-25', '2024-07-25', NULL, 'etwetw', 'Field', 'complete', NULL, NULL, NULL, NULL, 'Not Approve'),
(19, 2, 'aaaaa', '2024-07-25', '2024-07-25', NULL, 'mhngbfc', 'Field', 'complete', NULL, NULL, NULL, NULL, 'Not Approve'),
(20, 2, 'ssssss', '2024-07-25', '2024-07-25', NULL, 'sfdgh', 'Office', 'running', NULL, NULL, NULL, NULL, 'Not Approve'),
(21, 2, 'aaaaa', '2024-07-25', '2024-07-25', NULL, 'jkhg', 'Office', 'complete', NULL, NULL, NULL, NULL, 'Not Approve'),
(23, 1, '', '', '', NULL, 'rgrdrdgrthhtr', 'Office', 'running', NULL, NULL, NULL, '2024-08-04', 'Not Approve'),
(24, 1, '', '', '', NULL, 'fgbfb', 'Field', 'complete', NULL, NULL, NULL, '2024-08-01', 'Not Approve'),
(25, 1, ' sdssssss', '', '', NULL, 'gfnhgfhg', 'Field', 'complete', NULL, NULL, NULL, '2024-08-24', 'Not Approve'),
(26, 1, ' hhhhh', '2024-08-02', '2024-08-02', NULL, 'gvftbtftr', 'Office', 'complete', NULL, NULL, NULL, '2024-08-02', 'Not Approve'),
(27, 1, ' dddd', '2024-08-09', '2024-08-09', NULL, 'gfhbgfhft', 'Field', 'complete', NULL, NULL, NULL, '2024-08-09', 'Not Approve'),
(28, 1, ' rrrrrrr', '2024-08-03', '2024-08-03', NULL, 'fffffffff', 'Field', 'running', NULL, NULL, NULL, '2024-08-03', 'Not Approve'),
(29, 1, ' wwww', '2024-08-04', '2024-08-04', NULL, 'fdvfb', 'Office', 'running', NULL, NULL, NULL, '2024-08-04', 'Not Approve'),
(30, 1, ' yyyy', '2024-08-07', '2024-08-09', NULL, 'rfgrvgrgtgtr', 'Field', 'running', NULL, NULL, NULL, '2024-08-07', 'Not Approve'),
(31, 1, ' asasas', '2024-08-16', '2024-08-03', NULL, 'fvfvfvfv', 'Office', 'complete', NULL, NULL, NULL, '2024-08-31', 'Not Approve'),
(32, 1, ' swswsw', '2024-08-15', '2024-08-24', NULL, 'fcdrfcdc', 'Field', 'complete', NULL, NULL, NULL, '2024-08-16', 'Not Approve'),
(33, 1, ' lllll', '2024-08-17', '2024-08-11', NULL, 'hghgbhj', 'Office', 'running', NULL, NULL, NULL, '2024-08-11', 'Not Approve'),
(34, 3, ' dfdfd', '2024-08-05', '2024-08-08', NULL, 'fgbgfhbgf', 'Office', 'complete', NULL, NULL, NULL, '2024-08-04', 'Not Approve');

-- --------------------------------------------------------

--
-- Table structure for table `pro_task_assets`
--

CREATE TABLE `pro_task_assets` (
  `id` int(11) NOT NULL,
  `pro_task_id` int(11) NOT NULL,
  `assign_id` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative`
--

CREATE TABLE `representative` (
  `id` int(11) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_designation` varchar(20) NOT NULL,
  `user_mobile_number` varchar(20) NOT NULL,
  `user_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `representative`
--

INSERT INTO `representative` (`id`, `pro_id`, `user_name`, `user_designation`, `user_mobile_number`, `user_email`) VALUES
(2, 3, 'cffff', 'dddddfdgvhbn', '52424524754547', 'dfghjmk@gmail.com'),
(3, 1, 'ascsdfdf', 'dgbdfgbd', '5328242546486', 'fdgfd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE `salary_type` (
  `id` int(14) NOT NULL,
  `salary_type` varchar(256) DEFAULT NULL,
  `create_date` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `salary_type`
--

INSERT INTO `salary_type` (`id`, `salary_type`, `create_date`) VALUES
(1, 'Hourly', '2017-11-22'),
(2, 'Monthly', '2017-12-30'),
(3, 'Weekly', '2017-12-29'),
(4, 'Daily', '2018-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `sitelogo` varchar(128) DEFAULT NULL,
  `sitetitle` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `copyright` varchar(128) DEFAULT NULL,
  `contact` varchar(128) DEFAULT NULL,
  `currency` varchar(128) DEFAULT NULL,
  `symbol` varchar(64) DEFAULT NULL,
  `system_email` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `address2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitelogo`, `sitetitle`, `description`, `copyright`, `contact`, `currency`, `symbol`, `system_email`, `address`, `address2`) VALUES
(1, 'hrtag.png', 'H R System (CI)', 'Just a demo description and nothing else!', 'GenIT', '0001110000', 'USD', '$', 'contact@hrms.abc', '102 Blue St', '1102 Blecker St');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `facebook` varchar(256) DEFAULT NULL,
  `twitter` varchar(256) DEFAULT NULL,
  `google_plus` varchar(512) DEFAULT NULL,
  `skype_id` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `to-do_list`
--

CREATE TABLE `to-do_list` (
  `id` int(14) NOT NULL,
  `user_id` varchar(64) DEFAULT NULL,
  `to_dodata` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `value` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `to-do_list`
--

INSERT INTO `to-do_list` (`id`, `user_id`, `to_dodata`, `date`, `value`) VALUES
(1, 'Doe1753', 'Demo Task', '2021-04-19 09:19:29pm', '1'),
(2, 'Soy1332', 'Research on X1, Y2, A3', '2022-01-02 08:27:25pm', '0'),
(3, 'Soy1332', 'Recruit Members', '2022-01-02 08:27:50pm', '1'),
(4, 'Soy1332', 'Assign Task to Dev.', '2022-01-02 08:28:04pm', '0'),
(5, 'Soy1332', 'Attend Zoom Meetings', '2022-01-03 03:10:07pm', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `designation` int(10) NOT NULL,
  `status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `designation`, `status`) VALUES
(1, 'admin', 'admin', 1, 1),
(2, 'manager', 'manager', 2, 1),
(3, 'hr', 'hr', 3, 1),
(4, 'employee', 'employee', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addition`
--
ALTER TABLE `addition`
  ADD PRIMARY KEY (`addi_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `assets_category`
--
ALTER TABLE `assets_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `assign_leave`
--
ALTER TABLE `assign_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_task`
--
ALTER TABLE `assign_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attadence_report`
--
ALTER TABLE `attadence_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`de_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desciplinary`
--
ALTER TABLE `desciplinary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earned_leave`
--
ALTER TABLE `earned_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_file`
--
ALTER TABLE `employee_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_assets`
--
ALTER TABLE `emp_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_experience`
--
ALTER TABLE `emp_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_penalty`
--
ALTER TABLE `emp_penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure_calculator`
--
ALTER TABLE `expenditure_calculator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure_list`
--
ALTER TABLE `expenditure_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_visit`
--
ALTER TABLE `field_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_follow`
--
ALTER TABLE `lead_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_apply_approve`
--
ALTER TABLE `leave_apply_approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_installment`
--
ALTER TABLE `loan_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logistic_asset`
--
ALTER TABLE `logistic_asset`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logistic_assign`
--
ALTER TABLE `logistic_assign`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_salary`
--
ALTER TABLE `pay_salary`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_expenses`
--
ALTER TABLE `pro_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_notes`
--
ALTER TABLE `pro_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_task`
--
ALTER TABLE `pro_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_task_assets`
--
ALTER TABLE `pro_task_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `representative`
--
ALTER TABLE `representative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_type`
--
ALTER TABLE `salary_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `to-do_list`
--
ALTER TABLE `to-do_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `addition`
--
ALTER TABLE `addition`
  MODIFY `addi_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `ass_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets_category`
--
ALTER TABLE `assets_category`
  MODIFY `cat_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assign_leave`
--
ALTER TABLE `assign_leave`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assign_task`
--
ALTER TABLE `assign_task`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `attadence_report`
--
ALTER TABLE `attadence_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `de_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `desciplinary`
--
ALTER TABLE `desciplinary`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `earned_leave`
--
ALTER TABLE `earned_leave`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `employee_file`
--
ALTER TABLE `employee_file`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_assets`
--
ALTER TABLE `emp_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_experience`
--
ALTER TABLE `emp_experience`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_penalty`
--
ALTER TABLE `emp_penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenditure_calculator`
--
ALTER TABLE `expenditure_calculator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenditure_list`
--
ALTER TABLE `expenditure_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `field_visit`
--
ALTER TABLE `field_visit`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_follow`
--
ALTER TABLE `lead_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_apply_approve`
--
ALTER TABLE `leave_apply_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `type_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_installment`
--
ALTER TABLE `loan_installment`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `logistic_asset`
--
ALTER TABLE `logistic_asset`
  MODIFY `log_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logistic_assign`
--
ALTER TABLE `logistic_assign`
  MODIFY `ass_id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pay_salary`
--
ALTER TABLE `pay_salary`
  MODIFY `pay_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pro_expenses`
--
ALTER TABLE `pro_expenses`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pro_notes`
--
ALTER TABLE `pro_notes`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pro_task`
--
ALTER TABLE `pro_task`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pro_task_assets`
--
ALTER TABLE `pro_task_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative`
--
ALTER TABLE `representative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_type`
--
ALTER TABLE `salary_type`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `to-do_list`
--
ALTER TABLE `to-do_list`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
