-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 06:54 AM
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
(1, 0, '', 'extra expences', 'GST', '12', '100', '', '100', '100', '', '2024-08-16', '2024-08-16 19:12:29'),
(2, 9, '', 'gnnjhgnjg', 'GST', '12%', '1000', '', '1100', '1100', '', '2024-09-15', '0000-00-00 00:00:00'),
(3, 1, ' Monalisa Das', 'fghbjn', 'GST', '10', '2000', '', '2100', '2100', '', '2024-09-05', '2024-09-05 11:38:30');

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
  `post` varchar(10) NOT NULL,
  `polic_station` varchar(20) NOT NULL,
  `dist` varchar(20) NOT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(128) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `type` enum('Present','Permanent') DEFAULT 'Present'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `emp_id`, `address1`, `address2`, `city`, `post`, `polic_station`, `dist`, `state`, `country`, `pincode`, `type`) VALUES
(1, 'TS0923006', 'dvdfsgfdgs', 'aafsdfgs', 'aaaMuscle Shoals', 'NA', '', '', 'aafgdfg', 'aaUS', 'aa123456', 'Permanent'),
(2, '99', 'sdfgds', 'sdfgfd', 'Muscle Shoals', '', '', '', 'sfdgfdsg', 'US', '123456', 'Present'),
(5, '4445', 'dcdfvd', 'ddcv', NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(6, '4445', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(7, '5845', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(8, '5845', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(9, '52122', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(10, '52122', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(11, '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(12, '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(13, '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(14, '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(15, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(16, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(17, '414', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(18, '414', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(19, '20', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(20, '20', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(21, '14', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(22, '14', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(23, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(24, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(25, '40', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(26, '40', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(27, '20', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(28, '20', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(29, '40', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(30, '40', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(31, '78', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(32, '78', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(33, '78', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(34, '78', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(35, '41', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(36, '41', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(37, '41', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(38, '41', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(39, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(40, '10', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(41, '11', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(42, '11', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(43, '12', 'rdgrd', 'fghg', 'ghbgvhb', '', '', '', 'gvhbgv', 'gvbgvb', 'vgngvng', 'Permanent'),
(44, '12', 'vgngvn', 'vgnvgn', 'hnh', '', '', '', 'hnhn', 'bhn', 'bnbn', 'Present'),
(45, '12', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(46, '12', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(47, '13', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(48, '13', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(49, '15', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(50, '15', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(51, '17', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(52, '17', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(53, 'TS0923006', 'scdsdf', 'dgvg', 'dgdg', '', '', '', 'fdgf', '4242452', 'cfvfcv', 'Permanent'),
(54, 'TS0923006', 'scdsdf', 'dgvg', 'dgdg', 'NA', 'NA', 'NA', 'fdgf', '4242452', 'cfvfcv', 'Present'),
(55, 'TS0923008', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(56, 'TS0923008', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(57, 'TS0923010', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(58, 'TS0923010', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(59, '	TS0923009', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(60, '	TS0923009', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(61, 'TESS0012', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(62, 'TESS0012', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present'),
(63, 'TSS0098', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Permanent'),
(64, 'TSS0098', NULL, NULL, NULL, '', '', '', '', NULL, NULL, 'Present');

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
(1, 1, 1, 'TSS0098', 'Team Head'),
(2, 1, 1, ',TS0923006', 'Collaborators'),
(3, 2, 1, 'TS0923010', 'Team Head'),
(4, 2, 1, 'TS0923006', 'Collaborators'),
(5, 3, 6, 'TS0923010', 'Team Head'),
(6, 3, 6, 'TESS0012', 'Collaborators');

-- --------------------------------------------------------

--
-- Table structure for table `attadence_report`
--

CREATE TABLE `attadence_report` (
  `id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `emp_id` varchar(11) DEFAULT NULL,
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
(1, '08-2024', '0', 223, 155, 0, 0, 155),
(2, '08-2024', 'TS0823003', 223, 188, 0, 0, 188),
(3, '08-2024', 'TS0923005', 223, 177, 0, 0, 177),
(4, '08-2024', 'TS0923006', 223, 171, 0, 0, 171),
(5, '08-2024', 'TS0923008', 223, 155, 0, 0, 155);

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
  `working_hour` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `atten_date`, `signin_time`, `signout_time`, `working_hour`) VALUES
(1, '123456', '01-06-2024', '08:30:00', '17:30:00', '5'),
(2, '123456', '03-06-2024', '08:45:00', '17:45:00', '9'),
(3, '123456', '04-06-2024', '09:15:00', '18:15:00', '9'),
(4, '123456', '05-06-2024', '08:00:00', '17:00:00', '9'),
(5, '123456', '06-06-2024', '09:00:00', '18:00:00', '9'),
(6, '123456', '07-06-2024', '08:30:00', '17:30:00', '9'),
(7, '123456', '08-06-2024', '09:00:00', '18:00:00', '5'),
(8, '123456', '10-06-2024', '09:15:00', '18:15:00', '9'),
(9, '123456', '11-06-2024', '08:00:00', '17:00:00', '9'),
(10, '123456', '12-06-2024', '09:00:00', '18:00:00', '9'),
(11, '123456', '13-06-2024', '08:30:00', '17:30:00', '9'),
(12, '123456', '14-06-2024', '09:00:00', '18:00:00', '9'),
(13, '123456', '15-06-2024', '08:45:00', '17:45:00', '5'),
(14, '123456', '17-06-2024', '08:00:00', '17:00:00', '9'),
(15, '123456', '18-06-2024', '09:00:00', '18:00:00', '9'),
(16, '123456', '19-06-2024', '08:30:00', '17:30:00', '9'),
(17, '123456', '20-06-2024', '09:00:00', '18:00:00', '9'),
(18, '123456', '21-06-2024', '08:45:00', '17:45:00', '9'),
(19, '123456', '22-06-2024', '09:15:00', '18:15:00', '5'),
(20, '123456', '24-06-2024', '09:00:00', '18:00:00', '9'),
(21, '123456', '25-06-2024', '08:30:00', '17:30:00', '9'),
(22, '123456', '26-06-2024', '09:00:00', '18:00:00', '9'),
(23, '123456', '27-06-2024', '08:45:00', '17:45:00', '9'),
(24, '123456', '28-06-2024', '09:15:00', '18:15:00', '9'),
(25, '123456', '29-06-2024', '08:00:00', '17:00:00', '5'),
(26, 'TS0823003', '2024-08-01', '09:26:20', '19:19:06', '9'),
(27, 'TS0823003', '2024-08-02', '09:22:15', '18:33:49', '9'),
(28, 'TS0823003', '2024-08-03', '09:11:06', '14:20:12', '5'),
(29, 'TS0823003', '2024-08-05', '09:02:47', '18:23:27', '9'),
(30, 'TS0823003', '2024-08-06', '09:26:01', '18:32:43', '9'),
(31, 'TS0823003', '2024-08-07', '09:19:00', '18:46:07', '9'),
(32, 'TS0823003', '2024-08-08', '09:04:27', '18:38:18', '9'),
(33, 'TS0823003', '2024-08-09', '09:06:36', '18:39:16', '9'),
(34, 'TS0823003', '2024-08-10', '09:09:57', '14:12:52', '5'),
(35, 'TS0823003', '2024-08-12', '09:21:03', '18:32:28', '9'),
(36, 'TS0823003', '2024-08-13', '09:17:43', '18:10:02', '8.52'),
(37, 'TS0823003', '2024-08-14', '09:05:51', '18:57:26', '9'),
(38, 'TS0823003', '2024-08-16', '09:25:42', '18:34:47', '9'),
(39, 'TS0823003', '2024-08-17', '10:13:55', '14:06:46', '3.52'),
(40, 'TS0823003', '2024-08-20', '08:58:36', '18:39:12', '9'),
(41, 'TS0823003', '2024-08-21', '10:10:34', '18:16:35', '8.6'),
(42, 'TS0823003', '2024-08-22', '09:41:14', '18:21:15', '8.40'),
(43, 'TS0823003', '2024-08-23', '09:19:50', '18:26:08', '9'),
(44, 'TS0823003', '2024-08-24', '09:50:06', '18:42:33', '5'),
(45, 'TS0823003', '2024-08-27', '09:15:05', '19:00:47', '9'),
(46, 'TS0823003', '2024-08-28', '09:22:43', '18:36:31', '9'),
(47, 'TS0823003', '2024-08-29', '09:19:51', '18:50:05', '9'),
(48, 'TS0823003', '2024-08-30', '09:14:32', '18:32:59', '9'),
(49, 'TS0923005', '2024-08-01', '09:07:46', '19:11:12', '9'),
(50, 'TS0923005', '2024-08-02', '09:05:06', '18:32:01', '9'),
(51, 'TS0923005', '2024-08-03', '09:02:41', '14:20:17', '5'),
(52, 'TS0923005', '2024-08-05', '09:12:29', '18:39:28', '9'),
(53, 'TS0923005', '2024-08-06', '09:09:15', '18:54:58', '9'),
(54, 'TS0923005', '2024-08-07', '09:17:27', '19:30:37', '9'),
(55, 'TS0923005', '2024-08-08', '09:13:49', '18:54:25', '9'),
(56, 'TS0923005', '2024-08-09', '09:17:10', '18:38:20', '9'),
(57, 'TS0923005', '2024-08-10', '09:14:33', '14:12:43', '4.58'),
(58, 'TS0923005', '2024-08-12', '09:11:49', '18:56:31', '9'),
(59, 'TS0923005', '2024-08-13', '09:23:38', '18:12:59', '8.49'),
(60, 'TS0923005', '2024-08-14', '09:14:51', '09:14:51', '0.0'),
(61, 'TS0923005', '2024-08-16', '09:16:00', '18:39:01', '9'),
(62, 'TS0923005', '2024-08-17', '09:18:16', '14:23:49', '5'),
(63, 'TS0923005', '2024-08-20', '09:30:42', '18:46:53', '9'),
(64, 'TS0923005', '2024-08-21', '10:10:21', '16:08:22', '5.58'),
(65, 'TS0923005', '2024-08-22', '09:35:34', '18:20:58', '8.45'),
(66, 'TS0923005', '2024-08-23', '09:10:32', '18:39:51', '9'),
(67, 'TS0923005', '2024-08-24', '09:17:38', '18:41:55', '5'),
(68, 'TS0923005', '2024-08-27', '09:16:56', '18:59:48', '9'),
(69, 'TS0923005', '2024-08-28', '09:13:36', '18:49:34', '9'),
(70, 'TS0923005', '2024-08-29', '09:25:31', '19:45:32', '9'),
(71, 'TS0923005', '2024-08-30', '09:14:54', '18:41:59', '9'),
(72, 'TS0923006', '2024-08-01', '09:01:10', '19:11:17', '9'),
(73, 'TS0923006', '2024-08-02', '09:05:03', '18:33:46', '9'),
(74, 'TS0923006', '2024-08-03', '09:02:29', '14:20:14', '5'),
(75, 'TS0923006', '2024-08-05', '08:57:54', '18:39:05', '9'),
(76, 'TS0923006', '2024-08-06', '09:00:23', '18:55:07', '9'),
(77, 'TS0923006', '2024-08-07', '09:00:24', '20:00:35', '9'),
(78, 'TS0923006', '2024-08-08', '09:04:23', '18:54:08', '9'),
(79, 'TS0923006', '2024-08-09', '09:00:41', '18:38:25', '9'),
(80, 'TS0923006', '2024-08-10', '09:03:50', '14:12:56', '5'),
(81, 'TS0923006', '2024-08-12', '09:00:58', '18:56:41', '9'),
(82, 'TS0923006', '2024-08-13', '09:17:28', '18:13:54', '8.56'),
(83, 'TS0923006', '2024-08-14', '09:05:48', '19:40:32', '9'),
(84, 'TS0923006', '2024-08-16', '09:06:24', '18:40:10', '9'),
(85, 'TS0923006', '2024-08-17', '09:09:40', '14:06:23', '4.56'),
(86, 'TS0923006', '2024-08-20', '08:58:10', '18:49:34', '9'),
(87, 'TS0923006', '2024-08-22', '09:56:35', '18:20:52', '8.24'),
(88, 'TS0923006', '2024-08-23', '09:05:24', '18:40:52', '9'),
(89, 'TS0923006', '2024-08-24', '09:12:08', '18:41:59', '5'),
(90, 'TS0923006', '2024-08-27', '09:14:45', '18:59:50', '9'),
(91, 'TS0923006', '2024-08-28', '09:12:21', '18:36:23', '9'),
(92, 'TS0923006', '2024-08-29', '09:10:33', '19:45:29', '9'),
(93, 'TS0923006', '2024-08-30', '09:14:29', '09:14:29', '0.0'),
(94, 'TS0923008', '2024-08-01', '09:07:37', '19:11:46', '9'),
(95, 'TS0923008', '2024-08-02', '09:05:30', '13:12:27', '4.6'),
(96, 'TS0923008', '2024-08-05', '09:12:35', '18:39:24', '9'),
(97, 'TS0923008', '2024-08-06', '09:09:23', '18:55:05', '9'),
(98, 'TS0923008', '2024-08-07', '09:17:33', '19:30:28', '9'),
(99, 'TS0923008', '2024-08-08', '09:13:55', '18:54:17', '9'),
(100, 'TS0923008', '2024-08-09', '09:17:16', '18:39:29', '9'),
(101, 'TS0923008', '2024-08-10', '09:14:38', '14:13:00', '4.58'),
(102, 'TS0923008', '2024-08-12', '09:11:55', '18:56:33', '9'),
(103, 'TS0923008', '2024-08-13', '09:23:41', '18:43:07', '9'),
(104, 'TS0923008', '2024-08-14', '09:14:48', '18:47:13', '9'),
(105, 'TS0923008', '2024-08-16', '09:16:03', '18:36:21', '9'),
(106, 'TS0923008', '2024-08-17', '09:18:21', '14:24:03', '5'),
(107, 'TS0923008', '2024-08-20', '09:30:46', '10:21:21', '0.50'),
(108, 'TS0923008', '2024-08-23', '09:10:44', '18:39:58', '9'),
(109, 'TS0923008', '2024-08-24', '09:17:41', '18:42:13', '5'),
(110, 'TS0923008', '2024-08-27', '09:17:00', '19:00:02', '9'),
(111, 'TS0923008', '2024-08-28', '09:13:34', '18:49:45', '9'),
(112, 'TS0923008', '2024-08-29', '09:25:36', '19:45:44', '9'),
(113, 'TS0923008', '2024-08-30', '09:15:04', '18:42:14', '9');

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
  `ifsc_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `em_id`, `holder_name`, `bank_name`, `branch_name`, `account_number`, `account_type`, `ifsc_code`) VALUES
(1, 'TS0923006', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA'),
(2, 'TS0923008', NULL, NULL, NULL, NULL, NULL, ''),
(3, 'TS0923010', NULL, NULL, NULL, NULL, NULL, ''),
(4, '	TS0923009', NULL, NULL, NULL, NULL, NULL, ''),
(5, 'TESS0012', NULL, NULL, NULL, NULL, NULL, ''),
(6, 'TSS0098', NULL, NULL, NULL, NULL, NULL, '');

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
(1, 'Senior Developer', '1'),
(2, 'Jr. Developer', '1'),
(3, 'Manager', '1'),
(4, 'hr management', '0'),
(5, 'Designer', '1'),
(6, 'graphic designer', '1'),
(7, 'tester', '1');

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
(1, 'TS0923006', 'BTECH', 'fthfddd', 'fgthtdf', '87', '2012');

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
  `father_name` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `em_email` varchar(64) DEFAULT NULL,
  `prof_email` varchar(70) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `em_password` varchar(512) NOT NULL,
  `em_role` int(10) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `em_gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `em_phone` varchar(64) DEFAULT NULL,
  `em_wahtsapp` varchar(64) DEFAULT NULL,
  `em_birthday` varchar(128) DEFAULT NULL,
  `em_blood_group` enum('O+','O-','A+','A-','B+','B-','AB+','OB+') DEFAULT NULL,
  `em_joining_date` varchar(128) DEFAULT NULL,
  `last_company_date` date DEFAULT NULL,
  `em_contact_end` varchar(128) DEFAULT NULL,
  `em_image` varchar(128) DEFAULT NULL,
  `em_aadher` varchar(64) DEFAULT NULL,
  `em_pan` varchar(20) NOT NULL,
  `emergency_contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `em_code`, `des_id`, `dep_id`, `full_name`, `father_name`, `mother_name`, `em_email`, `prof_email`, `marital_status`, `em_password`, `em_role`, `status`, `em_gender`, `em_phone`, `em_wahtsapp`, `em_birthday`, `em_blood_group`, `em_joining_date`, `last_company_date`, `em_contact_end`, `em_image`, `em_aadher`, `em_pan`, `emergency_contact`) VALUES
(1, 'TS0923006', 2, 9, 'Monalisa Das', 'Mohan Charan Das', 'NA', 'monalisa@123gmail.com', 'monalisa@1234gmail.com', 'Single', '$2y$10$Zu4eSe2kVWLi7fCdYC/0RuyX.lEJqV.csOiu8zXT6ZmoqnIgrE3Ya', 4, 'ACTIVE', 'Female', '9985622020', '9985622020', '2024-09-12', 'O+', '2024-09-26', '0000-00-00', NULL, 'assets/uploads/employee/66e4143c70c7a.png', '8845952622', 'RE515112515T', 0),
(2, 'TS0923008', 1, 6, 'Roni Mohapatra', 'Rabidra Mohapatra', 'Rutu Mohapatra', 'roni12@gmail.com', 'roni12@gmail.com', 'Single', '$2y$10$3a2BnvViljChdi8rLBOfdea51tlKzvnDeEBNxT5auHvqGTfu83Fpa', 1, 'ACTIVE', 'Female', '9987451510', '9987451510', '2024-09-27', 'A+', '2024-09-12', '0000-00-00', NULL, 'assets/uploads/employee/66dec2286475c.jpeg', '4785102020', '51564sxnsxhj', 2147483647),
(3, 'TS0923010', 3, 9, 'Sagarika Das', 'Scfdsc Fgf', 'Grrfg Fgfg', 'sddb@gmail.com', 'sddb@gmail.com', 'Single', '$2y$10$Cv5mae6UPVj1/Aw9JPyY3.Q5cC3hdyN3VYOx5xjJ0UiqubNMCgNeu', 2, 'ACTIVE', 'Female', '9987451620', '9987451620', '2024-09-16', 'B+', '2024-09-17', '2024-09-25', NULL, 'assets/uploads/employee/66e405f815181.jpeg', 'dd564646556df', 'fbfb545645565', 2147483647),
(4, '	TS0923009', 4, 9, 'Rutu Mohanty', 'Dfd Dgdg', 'Fgf Fgfggf', 'fdvgdj@gmail.com', 'fdvgdj@gmail.com', 'Single', '$2y$10$kFlz0awyDT889Pb/.sxkW.DcM/E/pC1xFEfO9kYo.pV6gmzC3HNxa', 3, 'ACTIVE', 'Female', '8895746213', '8895746213', '2024-09-28', 'B-', '2024-09-25', '2024-09-28', NULL, '', 'fgfg548545156', 'ghgh4587965', 2147483647),
(5, 'TESS0012', 3, 9, 'Dibyanshu Das', 'Gvf Ggrdg', 'Fgbft Fgtbftb', 'fgtf@gmail.com', 'fgtf@gmail.com', 'Single', '$2y$10$eSrbGjq3/4Xi33XMNTrRz.g6hGvzPMPVadkbDhZWDC4J57hXh1IrK', 4, 'ACTIVE', 'Male', '8957462103', '8957462103', '2024-09-21', 'A+', '2024-09-05', '2024-09-26', NULL, 'assets/uploads/employee/66e4269d23f69.jpg', 'gfbg85645251', 'fg5845454', 2147483647),
(6, 'TSS0098', 6, 9, 'Rohan Sahoo', 'Hj Hbjuh', 'Ghbj Bjbnjn', 'ftg@gmail.com', 'ftg@gmail.com', 'Married', '$2y$10$fKgsniPY9sSuSMdGuSGEZ.k73eOHwZ7swXe5N4145HSZ7VV/uXQ7.', 2, 'ACTIVE', 'Male', '7895462103', '7895462103', '2024-09-22', 'O-', '2024-09-12', '2024-09-14', NULL, 'assets/uploads/employee/66e427030c165.jpg', 'bgfb54848542', 'fhh45154458', 2147483647);

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
(1, 'TS0923008', 'sddfaaa', '66decd9a4edce.pdf');

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
  `exp_joining` varchar(20) NOT NULL,
  `exp_leaving` varchar(20) NOT NULL,
  `salary_received` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `emp_experience`
--

INSERT INTO `emp_experience` (`id`, `emp_id`, `exp_company`, `exp_com_position`, `exp_com_address`, `exp_joining`, `exp_leaving`, `salary_received`) VALUES
(1, 'TS0923006', 'dfgdfg', 'Fgbf', 'fhfgf', '2024-09-18', '2024-09-22', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `emp_form`
--

CREATE TABLE `emp_form` (
  `emp_form_id` int(5) NOT NULL,
  `emp_form_name` varchar(100) NOT NULL,
  `emp_form_fathername` varchar(50) NOT NULL,
  `emp_form_mothername` varchar(50) NOT NULL,
  `emp_form_dob` varchar(25) NOT NULL,
  `emp_form_email` varchar(100) NOT NULL,
  `emp_form_phone` varchar(15) NOT NULL,
  `emp_form_bg` varchar(5) NOT NULL,
  `emp_form_gender` varchar(50) NOT NULL,
  `emp_form_marital` varchar(20) NOT NULL,
  `emp_form_wpnum` varchar(15) NOT NULL,
  `emp_form_adharnum` varchar(12) NOT NULL,
  `emp_form_pan` varchar(12) NOT NULL,
  `emp_form_emernum` varchar(15) NOT NULL,
  `emp_form_emerrel` varchar(50) NOT NULL,
  `emp_form_image` varchar(100) NOT NULL,
  `emp_form_adrs` varchar(250) NOT NULL,
  `emp_form_city` varchar(100) NOT NULL,
  `emp_form_dist` varchar(100) NOT NULL,
  `emp_form_state` varchar(100) NOT NULL,
  `emp_form_post` varchar(100) NOT NULL,
  `emp_form_police` varchar(100) NOT NULL,
  `emp_form_country` varchar(100) NOT NULL,
  `emp_form_pin` varchar(6) NOT NULL,
  `emp_form_preadrs` varchar(30) NOT NULL,
  `emp_form_precity` varchar(30) NOT NULL,
  `emp_form_predist` varchar(50) NOT NULL,
  `emp_form_prestate` varchar(50) NOT NULL,
  `emp_form_precountry` varchar(50) NOT NULL,
  `emp_form_prepin` varchar(10) NOT NULL,
  `emp_form_prepost` varchar(20) NOT NULL,
  `emp_form_prepolice` varchar(20) NOT NULL,
  `emp_form_c10school` varchar(250) NOT NULL,
  `emp_form_c10location` varchar(50) NOT NULL,
  `emp_form_c10board` varchar(100) NOT NULL,
  `emp_form_c10result` varchar(5) NOT NULL,
  `emp_form_c10yearpass` varchar(5) NOT NULL,
  `emp_form_c12school` varchar(250) NOT NULL,
  `emp_form_c12location` varchar(70) NOT NULL,
  `emp_form_c12type` varchar(70) NOT NULL,
  `emp_form_c12board` varchar(100) NOT NULL,
  `emp_form_c12result` varchar(5) NOT NULL,
  `emp_form_c12yearpass` varchar(5) NOT NULL,
  `emp_form_grad_type` varchar(100) NOT NULL,
  `emp_form_grad_insti` varchar(250) NOT NULL,
  `emp_form_grad_univ` varchar(100) NOT NULL,
  `emp_form_grad_res` varchar(5) NOT NULL,
  `emp_form_grad_yearpass` varchar(5) NOT NULL,
  `emp_form_grad_location` varchar(100) NOT NULL,
  `emp_form_pgrad_type` varchar(100) NOT NULL,
  `emp_form_pgrad_insti` varchar(250) NOT NULL,
  `emp_form_pgrad_univ` varchar(100) NOT NULL,
  `emp_form_pgrad_result` varchar(5) NOT NULL,
  `emp_form_pgrad_yearpass` varchar(5) NOT NULL,
  `emp_form_pgrad_location` varchar(100) NOT NULL,
  `emp_form_c10_doc` varchar(100) NOT NULL,
  `emp_form_c12_doc` varchar(100) NOT NULL,
  `emp_form_grad_doc` varchar(100) NOT NULL,
  `emp_form_pgrad_doc` varchar(100) NOT NULL,
  `emp_form_adhar_doc` varchar(100) NOT NULL,
  `emp_form_pan_doc` varchar(100) NOT NULL,
  `emp_form_bg_doc` varchar(100) NOT NULL,
  `emp_form_other_doc` varchar(100) NOT NULL,
  `emp_form_sign` varchar(40) NOT NULL,
  `emp_form_c12_stream` varchar(100) NOT NULL,
  `emp_form_grad_stream` varchar(100) NOT NULL,
  `emp_form_pgrad_stream` varchar(100) NOT NULL,
  `emp_form_dateofformsub` date NOT NULL,
  `emp_form_stat` int(5) NOT NULL,
  `emp_form_ip` varchar(100) NOT NULL,
  `emp_form_curloc` varchar(100) NOT NULL,
  `emp_form_livepic` varchar(100) NOT NULL,
  `emp_form_passpic` varchar(100) NOT NULL,
  `emp_form_cmpname1` varchar(70) NOT NULL,
  `emp_form_position1` varchar(50) NOT NULL,
  `emp_form_address1` longtext NOT NULL,
  `emp_form_from1` varchar(20) NOT NULL,
  `emp_form_to1` varchar(20) NOT NULL,
  `emp_form_salary1` varchar(50) NOT NULL,
  `emp_form_cmpname2` varchar(50) NOT NULL,
  `emp_form_position2` varchar(50) NOT NULL,
  `emp_form_address2` longtext NOT NULL,
  `emp_form_from2` varchar(20) NOT NULL,
  `emp_form_to2` varchar(20) NOT NULL,
  `emp_form_salary2` varchar(30) NOT NULL,
  `emp_form_cmpname3` varchar(50) NOT NULL,
  `emp_form_position3` varchar(50) NOT NULL,
  `emp_form_address3` longtext NOT NULL,
  `emp_form_from3` varchar(10) NOT NULL,
  `emp_form_to3` varchar(10) NOT NULL,
  `emp_form_salary3` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_form`
--

INSERT INTO `emp_form` (`emp_form_id`, `emp_form_name`, `emp_form_fathername`, `emp_form_mothername`, `emp_form_dob`, `emp_form_email`, `emp_form_phone`, `emp_form_bg`, `emp_form_gender`, `emp_form_marital`, `emp_form_wpnum`, `emp_form_adharnum`, `emp_form_pan`, `emp_form_emernum`, `emp_form_emerrel`, `emp_form_image`, `emp_form_adrs`, `emp_form_city`, `emp_form_dist`, `emp_form_state`, `emp_form_post`, `emp_form_police`, `emp_form_country`, `emp_form_pin`, `emp_form_preadrs`, `emp_form_precity`, `emp_form_predist`, `emp_form_prestate`, `emp_form_precountry`, `emp_form_prepin`, `emp_form_prepost`, `emp_form_prepolice`, `emp_form_c10school`, `emp_form_c10location`, `emp_form_c10board`, `emp_form_c10result`, `emp_form_c10yearpass`, `emp_form_c12school`, `emp_form_c12location`, `emp_form_c12type`, `emp_form_c12board`, `emp_form_c12result`, `emp_form_c12yearpass`, `emp_form_grad_type`, `emp_form_grad_insti`, `emp_form_grad_univ`, `emp_form_grad_res`, `emp_form_grad_yearpass`, `emp_form_grad_location`, `emp_form_pgrad_type`, `emp_form_pgrad_insti`, `emp_form_pgrad_univ`, `emp_form_pgrad_result`, `emp_form_pgrad_yearpass`, `emp_form_pgrad_location`, `emp_form_c10_doc`, `emp_form_c12_doc`, `emp_form_grad_doc`, `emp_form_pgrad_doc`, `emp_form_adhar_doc`, `emp_form_pan_doc`, `emp_form_bg_doc`, `emp_form_other_doc`, `emp_form_sign`, `emp_form_c12_stream`, `emp_form_grad_stream`, `emp_form_pgrad_stream`, `emp_form_dateofformsub`, `emp_form_stat`, `emp_form_ip`, `emp_form_curloc`, `emp_form_livepic`, `emp_form_passpic`, `emp_form_cmpname1`, `emp_form_position1`, `emp_form_address1`, `emp_form_from1`, `emp_form_to1`, `emp_form_salary1`, `emp_form_cmpname2`, `emp_form_position2`, `emp_form_address2`, `emp_form_from2`, `emp_form_to2`, `emp_form_salary2`, `emp_form_cmpname3`, `emp_form_position3`, `emp_form_address3`, `emp_form_from3`, `emp_form_to3`, `emp_form_salary3`) VALUES
(1, 'hbhjgh', 'ghghn', 'vnhvn', '23.03.2000', 'monalisa@techgeering.com', '9938627540', 'A-', 'Female', 'Single', '5459645964', '529659659656', 'FHG8586858', '5222828868', 'hjnhjnh', '66f14370f0ce9.jpeg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
  `supportingdocument` varchar(100) NOT NULL,
  `leave_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `em_id`, `typeid`, `start_date`, `end_date`, `leave_duration`, `duration_hour`, `apply_date`, `reason`, `supportingdocument`, `leave_status`) VALUES
(1, 'TE 0030', 1, '2024-09-14', '2024-09-22', '8', 55, '13-09-2024', 'cbcfbg', 'assets/uploads/employee/Ph.D Open Defence Viva Voce of Ms Rasmita Kumari Nayak,  18DS001164, Electro', 3),
(3, 'TS0923006', 1, '2024-09-21', '2024-09-22', '1', 5, '13-09-2024', 'rgtyh', 'assets/uploads/employee/gallery8.png', 0),
(4, 'TS0923008', 1, '2024-09-06', '2024-09-21', '15', 109, '23-09-2024', 'my brother&#039;s', '', 0),
(5, 'TESS0012', 1, '2024-09-11', '2024-09-19', '8', 59, '23-09-2024', 'dgvdvg', '', 0),
(6, 'TESS0012', 1, '2024-09-25', '2024-09-28', '3', 27, '24-09-2024', 'fdvfdv', '', 3),
(7, 'TESS0012', 3, '2024-09-25', '2024-09-27', '2', 18, '24-09-2024', 'fgbfgb', '', 0);

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
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `id` int(11) NOT NULL,
  `intern_name` varchar(20) NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `mother_name` varchar(20) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `intern_email` varchar(30) NOT NULL,
  `intern_add` varchar(30) NOT NULL,
  `valid_govt_no` varchar(20) NOT NULL,
  `id_type` varchar(20) NOT NULL,
  `college_id` varchar(20) NOT NULL,
  `edu_qualification` varchar(70) NOT NULL,
  `clg_name` varchar(50) NOT NULL,
  `internship_on` varchar(40) NOT NULL,
  `intern_image` varchar(70) NOT NULL,
  `intern_doc` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`id`, `intern_name`, `father_name`, `mother_name`, `dob`, `gender`, `phone`, `intern_email`, `intern_add`, `valid_govt_no`, `id_type`, `college_id`, `edu_qualification`, `clg_name`, `internship_on`, `intern_image`, `intern_doc`) VALUES
(1, 'Fdvdfv', 'Dfb', 'Fdbdb', '2024-09-28', 'Female', 'fdvfdv', 'fbf@gmail.com', 'fhfhh', '547545775', 'adhaar', '74274275775', 'fdgbdg', 'fvfdvgfdf', 'fbhfg', '66f2b0bf6e9a3.jpeg', ''),
(2, 'Bfcbfb', 'Gfbhffg', 'Hffghf', '2024-09-29', 'Female', '4112472472542', 'gfhng@gmail.com', 'fgbftgbft', 'gnh4524524', 'adhaar', '424247257452', 'gfbbgfb', 'gnbgfng', 'gnngfn', '66f38bb75bcce.png', '66f38bb75c666.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `intern_request`
--

CREATE TABLE `intern_request` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mob_num` varchar(10) NOT NULL,
  `wp_num` varchar(20) NOT NULL,
  `clg_name` varchar(40) NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern_request`
--

INSERT INTO `intern_request` (`id`, `name`, `email`, `mob_num`, `wp_num`, `clg_name`, `address`) VALUES
(1, 'gfbgf', 'gfhfg', 'fg', '', 'bfgn', 'fnfvg'),
(2, 'fbfb', 'fbfbf', 'bfbf', '', 'bfbg', 'fbfb'),
(3, '', 'bf', 'fbg', '', 'bgfbg', 'fbbg'),
(4, 'Fvfv', 'gnggf', '8524254247', '', 'ngfngf', 'nngf'),
(5, 'Gbgbg', 'bfgb@gmail.com', '5456456464', '454854584485', 'dcfdcj', 'vdivjd');

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
(1, 'rsdfrdf', 'dfefvfe', '9944512368', 'monalisadas1964@gmail.com', 'fdgvfgbf', 'Nagalandd', 'gfbfhf', 'ghgfh', 1, 'gfbh', 'ghbgfh', '2024-09-02 12:19:52', '2024-09-02 12:39:02', '2024-09-05 16:08:00'),
(2, 'fgbbf', 'bgfb', '5245225412', 'monalisa@123gmail.com', 'ghf', 'gnhgn', 'gjnh', 'fghjf', 1, 'fhn', 'fghf', '2024-09-23 14:41:35', NULL, NULL);

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
(11, 2, 1, '2024-09-02 11:32:16'),
(12, 2, 1, '2024-09-04 12:04:56'),
(13, 1, 4, '2024-09-13 07:26:06'),
(14, 2, 2, '2024-09-13 13:34:44'),
(15, 6, 4, '2024-09-24 06:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `type_id` int(14) NOT NULL,
  `name` varchar(64) NOT NULL,
  `leave_day` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`type_id`, `name`, `leave_day`, `status`) VALUES
(1, 'Casual Leave', '21', 1),
(3, 'Maternity Leave', '90', 1),
(4, 'Paternal Leave', '7', 0),
(5, 'Earned leave', '3', 0),
(7, 'Public Holiday', '5', 0),
(8, 'Optional Leave', '8', 0),
(9, 'Leave without Pay', '2', 0),
(10, 'dsadfds', '4', 0),
(11, 'xdc', '11', 0),
(12, 'cvvcvss', '10', 0);

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
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `emp_tbl_id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `ip_v6_address` varchar(250) NOT NULL,
  `ip_v4_address` varchar(250) NOT NULL,
  `loggedin_device` varchar(50) NOT NULL,
  `location_details` longtext NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `session_duration` time DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `emp_tbl_id`, `emp_id`, `ip_v6_address`, `ip_v4_address`, `loggedin_device`, `location_details`, `login_time`, `logout_time`, `session_duration`, `created_at`, `updated_at`) VALUES
(1, 1, 'TS0923006', '::1', '117.217.55.52', 'Laptop', 'Location details not available', '2024-09-19 05:14:32', '2024-09-19 05:39:07', '00:24:35', '2024-09-19 10:44:32', '2024-09-19 11:09:07'),
(2, 1, 'TS0923006', '::1', '117.217.55.52', 'Laptop', 'Location details not available', '2024-09-19 05:39:33', '2024-09-19 05:39:38', '00:00:05', '2024-09-19 11:09:33', '2024-09-19 11:09:38'),
(3, 2, 'TS0923008', '::1', '117.217.55.52', 'Laptop', 'Location details not available', '2024-09-19 05:39:59', '2024-09-19 10:17:04', '04:37:05', '2024-09-19 11:09:59', '2024-09-19 15:47:04'),
(4, 1, 'TS0923006', '::1', '117.217.55.52', 'Laptop', 'Location details not available', '2024-09-19 10:17:26', '2024-09-19 10:18:12', '00:00:46', '2024-09-19 15:47:26', '2024-09-19 15:48:12'),
(5, 2, 'TS0923008', '::1', '117.217.55.52', 'Laptop', 'Location details not available', '2024-09-19 10:18:32', NULL, NULL, '2024-09-19 15:48:32', '2024-09-19 15:48:32'),
(6, 2, 'TS0923008', '::1', '223.231.194.67', 'Laptop', 'City: Bhubaneswar, Region: Odisha, Country: India, Lat: 20.2706, Lon: 85.8334', '2024-09-20 16:42:37', '2024-09-20 17:35:19', '00:52:42', '2024-09-20 22:12:37', '2024-09-20 23:05:19'),
(7, 1, 'TS0923006', '::1', '223.231.194.67', 'Laptop', 'City: Bhubaneswar, Region: Odisha, Country: India, Lat: 20.2706, Lon: 85.8334', '2024-09-20 17:35:48', NULL, NULL, '2024-09-20 23:05:48', '2024-09-20 23:05:48'),
(8, 2, 'TS0923008', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 11:07:22', '2024-09-23 12:01:57', '00:54:35', '2024-09-23 16:37:22', '2024-09-23 17:31:57'),
(9, 5, 'TESS0012', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 12:03:40', '2024-09-23 12:12:35', '00:08:55', '2024-09-23 17:33:40', '2024-09-23 17:42:35'),
(10, 2, 'TS0923008', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 12:09:03', '2024-09-23 12:12:16', '00:03:13', '2024-09-23 17:39:03', '2024-09-23 17:42:16'),
(11, 5, 'TESS0012', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 12:13:17', '2024-09-23 12:13:25', '00:00:08', '2024-09-23 17:43:17', '2024-09-23 17:43:25'),
(12, 2, 'TS0923008', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 12:13:50', NULL, NULL, '2024-09-23 17:43:50', '2024-09-23 17:43:50'),
(13, 5, 'TESS0012', '::1', '117.198.23.11', 'Laptop', 'Location details not available', '2024-09-23 12:14:12', NULL, NULL, '2024-09-23 17:44:12', '2024-09-23 17:44:12'),
(14, 2, 'TS0923008', '::1', '117.198.18.118', 'Laptop', 'Location details not available', '2024-09-24 04:05:32', NULL, NULL, '2024-09-24 09:35:32', '2024-09-24 09:35:32'),
(15, 5, 'TESS0012', '::1', '117.198.18.118', 'Laptop', 'Location details not available', '2024-09-24 04:27:02', NULL, NULL, '2024-09-24 09:57:02', '2024-09-24 09:57:02'),
(16, 2, 'TS0923008', '::1', '117.217.54.240', 'Laptop', 'Location details not available', '2024-09-25 03:51:34', NULL, NULL, '2024-09-25 09:21:34', '2024-09-25 09:21:34');

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
  `transporting` int(11) DEFAULT NULL,
  `bonus` varchar(64) DEFAULT NULL,
  `bima` varchar(64) DEFAULT NULL,
  `tax` varchar(64) DEFAULT NULL,
  `provident_fund` varchar(64) DEFAULT NULL,
  `loan` varchar(64) DEFAULT NULL,
  `total_pay` varchar(128) DEFAULT NULL,
  `performance_bonus` int(11) NOT NULL,
  `other_diduction` int(11) NOT NULL,
  `status` enum('Paid','Process') DEFAULT 'Process',
  `paid_type` enum('Hand Cash','Bank') NOT NULL DEFAULT 'Bank'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pay_salary`
--

INSERT INTO `pay_salary` (`pay_id`, `emp_id`, `type_id`, `month`, `year`, `paid_date`, `total_days`, `basic`, `medical`, `house_rent`, `transporting`, `bonus`, `bima`, `tax`, `provident_fund`, `loan`, `total_pay`, `performance_bonus`, `other_diduction`, `status`, `paid_type`) VALUES
(3, '	TS0923009', 0, 'February', '2005', NULL, NULL, '44', '4754', '47554', 45, '45', '45', '4554', '45454', '45', ' ', 0, 858, 'Process', 'Bank'),
(4, 'TS0923006', 0, 'February', '2002', NULL, NULL, '47', '74', '4774', 775, '47', '4', '74', '47', '47', ' ', 0, 4, 'Process', 'Bank'),
(5, '	TS0923009', 0, 'August', '2024', NULL, NULL, '4433', '4754', '47554', 45, '45', '45', '4554', '45454', '45', ' ', 0, 858, 'Process', 'Bank'),
(6, 'TS0923006', 0, 'August', '2024', NULL, NULL, '4722', '742', '4772', 7752, '472', '42', '742', '472', '472', ' ', 0, 42, 'Process', 'Bank'),
(7, '	TS0923009', 0, 'August', '2024', NULL, NULL, '4431', '4754', '47554', 45, '45', '45', '4554', '45454', '45', ' ', 0, 858, 'Process', 'Bank');

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
  `pro_status` enum('upcoming','complete','running','hold') NOT NULL DEFAULT 'running',
  `progress` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_name`, `pro_start_date`, `pro_end_date`, `pro_description`, `pro_summary`, `pro_status`, `progress`) VALUES
(1, 'Project X23', '2024-09-13', '2024-09-14', 'In addition to prompts and writing advice, Vol. 8 includes an added accountability angle. It can be hard to commit to a regular writing practice, but we’re here to help! Using Google Classroom, participants will turn in one page of writing per week and will receive an email from us acknowledging that they have completed their writing for that week. At the program’s end, participants will receive an email letting them know how many weeks they submitted work. Writing will not be read and no feedback will be provided, but we will help you stay on track and celebrate your success!A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long dfdgdgdgdgdggdgfdgdggdgg fgvgvfgfgf  vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'This is just a demo project rtff!', 'hold', NULL),
(2, 'Multi User Chat System', 'NA', 'April 14, 2022', ' You are required to develop a system that supports multi-user chatting with the help of top level technologies.', 'Development of Multi-User Chatting System', 'running', NULL),
(3, 'Image Enhancement Software', 'Dec 10, 2021', 'Mar 20, 2022', 'You are required to develop of computer based software where end users can receive quality results on image enhancement. This particular project requires large number of technologies with proper use and its features.', 'Development of Image Enhancement Software', 'running', NULL),
(4, 'aaaaaCustomer support service operation', '2024-07-18', '2024-07-26', 'sfcvfgdvgYou are required to develop a customer support service based operation using DotNet (.Net)', 'fvggvfgfrDevelop a customer support service operation', 'complete', NULL),
(5, 'Real Estate Site', 'Dec 29, 2021', 'Mar 21, 2022', ' You are required to develop a real estate website using React, Nodejs.', 'Develop a real-estate website', 'running', NULL),
(6, 'Graphics Illustration', 'Jan 2, 2022', 'Jan 10, 2022', 'You are required to make a graphic illustration for XYZ company. ', 'Make a graphic illustration for ....', 'running', NULL),
(7, 'gfhfgfh', '2024-09-20', '2024-09-13', 'fghbftghfth', 'fhgfhf', 'complete', NULL);

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
(19, 3, 'dddddddddfdgfghff', '66a216e6e6bb7.pdf', 'aaMichael'),
(20, 9, 'fgfgf', '66d7f5a80fd8a.pdf', 'Monalisa Das'),
(21, 9, 'hgfhf', '66d7fdce227da.pdf', 'Monalisa Das'),
(22, 1, 'rthytrfh', '66e2b823c501e.pdf', 'Monalisa Das'),
(23, 7, 'dsfcdv', '', 'Monalisa Das');

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
  `pro_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pro_notes`
--

INSERT INTO `pro_notes` (`id`, `assign_to`, `pro_id`, `details`, `pro_status`) VALUES
(1, 'aaMichael', 2, 'sfdsg', '1'),
(2, 'fffff', 2, 'jkkjjj', '1'),
(3, 'fffff', 2, 'aaa', '1'),
(4, 'Chris', 3, 'vvvvvsdcsfvdfvdddd', '1'),
(5, 'Stephany', 3, 'dvvdvd', '1'),
(6, 'Monalisa Das', 1, 'sscfbvcfbfcb', 'Complete'),
(7, 'Monalisa Das', 9, 'cv dc vdv', '1'),
(8, 'Monalisa Das', 1, 'sdzsfgfhf', 'Started'),
(9, 'Dibyanshu Das', 1, 'dsfdssdsds', 'Complete');

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
  `status` varchar(30) DEFAULT NULL,
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
(1, 1, 'jhjhnjass', '2024-09-05', '2024-09-28', NULL, 'fgfgc', 'Office', 'Testing', NULL, NULL, NULL, NULL, 'Not Approve'),
(2, 1, 'fgfthf', '2024-09-21', '2024-09-21', NULL, 'ghfh', 'Field', 'Done', NULL, NULL, NULL, NULL, 'Not Approve'),
(3, 6, 'ghfgh', '2024-09-13', '2024-09-19', NULL, 'fhghgf', 'Field', 'not started', NULL, NULL, NULL, NULL, 'Not Approve');

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
(3, 1, 'ascsdfdf', 'dgbdfgbd', '5328242546486', 'fdgfd@gmail.com'),
(4, 9, 'Monalisa Das', 'developer', '985562302', 'mona@12gmail.com'),
(5, 9, 'Ghgthgth', 'hfhfh', '414242425', 'dshch@gmail.com');

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
-- Indexes for table `emp_form`
--
ALTER TABLE `emp_form`
  ADD PRIMARY KEY (`emp_form_id`);

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
-- Indexes for table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intern_request`
--
ALTER TABLE `intern_request`
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
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addition`
--
ALTER TABLE `addition`
  MODIFY `addi_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attadence_report`
--
ALTER TABLE `attadence_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_file`
--
ALTER TABLE `employee_file`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_assets`
--
ALTER TABLE `emp_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_experience`
--
ALTER TABLE `emp_experience`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_form`
--
ALTER TABLE `emp_form`
  MODIFY `emp_form_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `internship`
--
ALTER TABLE `internship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intern_request`
--
ALTER TABLE `intern_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lead_follow`
--
ALTER TABLE `lead_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_apply_approve`
--
ALTER TABLE `leave_apply_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `pay_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pro_expenses`
--
ALTER TABLE `pro_expenses`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pro_notes`
--
ALTER TABLE `pro_notes`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pro_task`
--
ALTER TABLE `pro_task`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pro_task_assets`
--
ALTER TABLE `pro_task_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `representative`
--
ALTER TABLE `representative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
