-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2023 at 11:32 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icsweho2_contact_manager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_login`
--

CREATE TABLE `agent_login` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `user_id` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_login`
--

INSERT INTO `agent_login` (`id`, `agent_id`, `contact_id`, `user_id`, `password`, `is_admin`) VALUES
(3, 0, 0, '123', '123', 0),
(4, 0, 0, '123', '123', 0),
(5, 0, 0, '1234', '123', 0),
(6, 0, 0, '12345', '12345', 0),
(7, 0, 0, '999', '999', 1),
(8, 0, 0, '12333', '123', 1),
(9, 0, 0, '12333', '123', 1),
(10, 0, 0, 'farooque@icsweb.in', 'qafssip2q', 1),
(11, NULL, 12, '123', '123', 2),
(12, NULL, NULL, '555', '555', 0),
(13, 17, NULL, '889', '888', 0),
(17, NULL, 16, '999', '999', 2),
(18, NULL, 17, '333', '333', 2),
(19, NULL, 18, '111', '111', 2),
(20, NULL, 19, '22', '222', 2);

-- --------------------------------------------------------

--
-- Table structure for table `agent_master`
--

CREATE TABLE `agent_master` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `difficulty_contact` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_master`
--

INSERT INTO `agent_master` (`id`, `name`, `address`, `difficulty_contact`) VALUES
(8, 'test1', '123', '123'),
(9, '123', '123', '123'),
(10, '1234', '123', '123'),
(11, '12345', '12345', '12345'),
(12, '999', '999', '999'),
(13, '12333', '123', '123'),
(14, 'test1', '123', '123'),
(15, 'Farooque', '', 'Aamer'),
(16, '555', '555', '555'),
(17, '777', '777', '777');

-- --------------------------------------------------------

--
-- Table structure for table `agent_notification`
--

CREATE TABLE `agent_notification` (
  `agent_id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `whatsapp_no` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` text COLLATE utf8_unicode_ci NOT NULL,
  `smtp` text COLLATE utf8_unicode_ci NOT NULL,
  `email_pasword` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_notification`
--

INSERT INTO `agent_notification` (`agent_id`, `email`, `whatsapp_no`, `mobile_no`, `smtp`, `email_pasword`) VALUES
(8, '123', '123', '123', '123', '123'),
(9, '123', '123', '123', '123', '123'),
(10, '1234', '123', '1234', '123', '123'),
(11, '12345', '12345', '12345', '12345', '12345'),
(12, '999', '999', '999', '999', '999'),
(13, '1233', '123', '1233', '123', '123'),
(14, '123', '123', '123', '123', '123'),
(15, 'farooque@icsweb.in', '8007775051', '8007775051', '', ''),
(16, 'contactus@icsweb.in', '555', '456', '555', '555'),
(17, '777', '777', '777', '777', '777');

-- --------------------------------------------------------

--
-- Table structure for table `agent_reporting_to`
--

CREATE TABLE `agent_reporting_to` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `reporting_to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_reporting_to`
--

INSERT INTO `agent_reporting_to` (`id`, `agent_id`, `reporting_to_id`) VALUES
(6, 8, 2),
(7, 8, 7),
(8, 9, 2),
(9, 9, 7),
(10, 10, 2),
(11, 10, 7),
(12, 11, 2),
(13, 12, 2),
(14, 13, 2),
(15, 13, 7),
(16, 14, 2),
(17, 14, 7),
(18, 8, 2),
(19, 8, 7),
(20, 16, 2),
(21, 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `GST` text,
  `Address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `name`, `GST`, `Address`) VALUES
(2, 'Company 1', NULL, NULL),
(3, 'Company 2', NULL, NULL),
(7, 'cmp5', 'cmp5', 'cmp5');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email_id` text NOT NULL,
  `mobile_no` text NOT NULL,
  `display_name` text NOT NULL,
  `display_image` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `company_id`, `name`, `email_id`, `mobile_no`, `display_name`, `display_image`, `status`) VALUES
(7, 4, '456', '456', '456', '456', '456', 1),
(9, 2, '666', '666', '666', '666', '.jpg', 1),
(10, 3, 'Rakesh', 'rakesh@icsweb.in', '9083426747', 'Rakesh', 'ede', 1),
(12, 2, '321', '134', '453', 'test', '123', 1),
(13, 2, '888', '888', '888', '888', '888', 1),
(16, 2, '999', '999', '999', '999', 'product-1.jpg', 1),
(17, 2, '333', '333', '333', '333', '17.jpg', 1),
(18, 2, '111', '111', '111', '111', '.jpg', 1),
(19, 2, '222', '222', '222', '222', '19.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `receipt_amount` double DEFAULT NULL,
  `pending_amount` double DEFAULT NULL,
  `type` int(11) NOT NULL,
  `finacial_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `company_id`, `amount`, `receipt_amount`, `pending_amount`, `type`, `finacial_status`, `status`) VALUES
(1, '1233', 2, 123, NULL, NULL, 1, 1, 1),
(3, '222', 2, 22, 20, 2, 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo_path` text COLLATE utf8_unicode_ci,
  `name` int(11) DEFAULT NULL,
  `aside_color` text COLLATE utf8_unicode_ci,
  `nav_color` text COLLATE utf8_unicode_ci,
  `card_color` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo_path`, `name`, `aside_color`, `nav_color`, `card_color`) VALUES
(1, 'ICS Logo HDesk.jpg', NULL, 'sidebar-light-primary', 'bg-white', 'info');

-- --------------------------------------------------------

--
-- Table structure for table `work_status_master`
--

CREATE TABLE `work_status_master` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `link_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work_status_master`
--

INSERT INTO `work_status_master` (`id`, `name`, `link_status`) VALUES
(4, 'Testing', 1),
(5, 'Un Assigned', 4),
(6, 'Requirement Gathering', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_login`
--
ALTER TABLE `agent_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_master`
--
ALTER TABLE `agent_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_reporting_to`
--
ALTER TABLE `agent_reporting_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_status_master`
--
ALTER TABLE `work_status_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_login`
--
ALTER TABLE `agent_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `agent_master`
--
ALTER TABLE `agent_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `agent_reporting_to`
--
ALTER TABLE `agent_reporting_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_status_master`
--
ALTER TABLE `work_status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
