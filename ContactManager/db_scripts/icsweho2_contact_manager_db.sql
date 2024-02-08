-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2023 at 04:10 PM
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
  `agent_type` int(11) NOT NULL DEFAULT '0',
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_login`
--

INSERT INTO `agent_login` (`id`, `agent_id`, `contact_id`, `user_id`, `password`, `agent_type`, `is_admin`) VALUES
(1, NULL, 1, 'admin', 'admin', 0, 2),
(2, NULL, 2, 'erp.admin@kalegroup.co.in', '123', 0, 3),
(3, NULL, 3, 'adik', '123', 0, 3),
(4, 1, NULL, 'Aamer', '123', 1, 0),
(5, 2, NULL, 'Bilal', '123', 1, 1),
(6, 3, NULL, 'Rahil', '123', 1, 1),
(7, 4, NULL, 'Hidayat', '123', 1, 1),
(8, 5, NULL, 'Majid', '123', 2, 1),
(9, NULL, 4, 'deshmukh@swajit.com', '123', 0, 2),
(10, 6, NULL, 'Mukarram', '123', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `agent_master`
--

CREATE TABLE `agent_master` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `difficulty_contact` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci,
  `aadhar_no` text COLLATE utf8_unicode_ci,
  `pan_no` int(11) DEFAULT NULL,
  `photo` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_master`
--

INSERT INTO `agent_master` (`id`, `name`, `address`, `difficulty_contact`, `city`, `aadhar_no`, `pan_no`, `photo`) VALUES
(1, 'Aamer Syed', '', '', 'Aurangabad', '', 0, NULL),
(2, 'Bilal Ahmed', '', '', '', '', 0, NULL),
(3, 'Rahil', '', '', '', '', 0, NULL),
(4, 'Shaikh Hidayat', '', '', '', '123', 0, NULL),
(5, 'Mirza Majid', '', '', '', '', 0, NULL),
(6, 'Mukarram Mashadi', '', '', '', '', 0, NULL);

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
  `email_pasword` text COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agent_notification`
--

INSERT INTO `agent_notification` (`agent_id`, `email`, `whatsapp_no`, `mobile_no`, `smtp`, `email_pasword`, `port`) VALUES
(1, 'rakesh@icsweb.in', '8007775052', '9011047639', 'smtp.gmail.com', 'icsweb.@#123', 465),
(2, 'bilal@icsweb.in', '8007775057', '8007775057', '', '', NULL),
(3, 'rahil@icsweb.in', '8007775054', '8007775054', '', '', NULL),
(4, '123@453', '8007778462', '8007778462', '', '', NULL),
(5, 'majid@icsweb.in', '8007775055', '8007775055', '', '', NULL),
(6, 'mukarram@icsweb.in', '8007775230', '8007775230', '', '', NULL);

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
(1, 3, 1),
(2, 3, 2),
(13, 2, 1),
(15, 5, 1),
(19, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `GST` text,
  `Address` text,
  `city` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `name`, `GST`, `Address`, `city`) VALUES
(1, 'Kale Group', '', '', ''),
(2, 'Vaidya Group', '', '', 'Aurangabad'),
(3, 'International Conveyor Limited', '27153', '', 'Chatrapti Sambhajinagar'),
(4, 'Admin', '', '', ''),
(5, 'Swajit Engineering', '', '', '');

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
  `alt_mobile` text,
  `designation` text,
  `department` text,
  `address` text,
  `city` text,
  `dob` text,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `company_id`, `name`, `email_id`, `mobile_no`, `display_name`, `display_image`, `alt_mobile`, `designation`, `department`, `address`, `city`, `dob`, `status`) VALUES
(1, 4, 'Admin', 'aamer@icsweb.in', '8007775052', 'Admin', '', '', '', '', '', 'Aurangabad', '2000-01-01', 1),
(2, 1, 'Sunil Landge', 'erp.admin@kalegroup.co.in', '9011047639', 'Sunil', '', '8983013332', 'EDP', 'IT', 'Waluj, MIDC Area\r\nAurangabad\r\nMaharashtra \r\nIndia', 'Chatrapti Sambhajinagar', '2000-02-01', 1),
(3, 1, 'Adik Pramod', 'p.adik@kalegroup.co.in', '9011045670', 'Adik', '', '', '', '', '', '', '', 1),
(4, 5, 'Deshmukh', 'deshmukh@swajit.com', '9922941690', 'Deshmukh', '', '', '', '', '', 'Aurangabad', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `msg` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `ticket_id`, `login_id`, `msg`, `view`) VALUES
(1, 1, 6, 'Ticket Assign By: Aamer Syed', 1),
(2, 1, 5, 'Ticket Assign By: Aamer Syed', 0),
(3, 2, 6, 'Ticket Assign By: Aamer Syed', 1),
(4, 5, 6, 'Ticket Assign By: Aamer Syed', 1),
(6, 8, 4, 'New Ticket is created', 1),
(7, 9, 4, 'New Ticket is created', 1),
(8, 10, 4, 'New Ticket is created', 1),
(9, 11, 4, 'New Ticket is created', 1),
(10, 13, 4, 'New Ticket Created From Admin-Admin', 1),
(11, 14, 4, 'New Ticket:Admin-Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `receipt_amount` double DEFAULT NULL,
  `pending_amount` double DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `finacial_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `company_id`, `amount`, `receipt_amount`, `pending_amount`, `type`, `finacial_status`, `status`) VALUES
(3, 'MRP Report ', 1, 0, 0, 0, 0, 3, 0),
(4, 'contact Project', 4, 10, 5, 5, 1, 1, 4);

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
  `card_color` text COLLATE utf8_unicode_ci,
  `default_work_status` int(11) DEFAULT NULL,
  `default_start_ticket_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo_path`, `name`, `aside_color`, `nav_color`, `card_color`, `default_work_status`, `default_start_ticket_no`) VALUES
(1, 'ICS Logo HDesk.jpg', NULL, 'sidebar-light-primary', 'bg-white', 'info', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contact_ids` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `attachement` text COLLATE utf8_unicode_ci NOT NULL,
  `reported_on` datetime NOT NULL,
  `reported_by` int(11) NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `work_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `company_id`, `project_id`, `contact_ids`, `title`, `details`, `attachement`, `reported_on`, `reported_by`, `assigned_to`, `assigned_by`, `work_status`, `status`) VALUES
(1, 4, 4, '1', 'First Ticket', 'Ticket Details', '', '2023-10-28 15:42:19', 1, 2, 1, 5, 0),
(2, 4, 4, '1', 'Test-2', 'Test-2', '', '2023-10-28 16:58:34', 1, 3, 1, 4, 0),
(3, 4, 4, '1', 'test-3', 'test-3 with detail discription', '3.jpeg', '2023-10-28 18:03:16', 1, 3, 2, 5, 0),
(4, 4, 4, '1', 'test-3xcv', 'test-3 with detail discription', '', '2023-10-29 12:37:32', 1, NULL, NULL, 5, 0),
(5, 1, 3, '2', 'subjec-6', 'subject detial -6 adlskfj as asdj', '', '2023-10-29 00:00:00', 4, 3, 1, 4, 0),
(6, 4, 4, '1', 'test -6 ticket', 'details ticket -6', '6.jpeg', '2023-10-29 15:21:38', 1, 3, 1, 4, 0),
(7, 4, 4, '1', 'Notifcation Testing', 'Creating new ticket', '', '2023-11-22 11:15:10', 1, NULL, NULL, 5, 0),
(8, 4, 4, '1', 'new ticket of notification', 'testing agent admin', '', '2023-11-22 12:24:08', 1, NULL, NULL, 5, 0),
(9, 4, 4, '1', '321', '123', '', '2023-11-22 15:49:15', 1, NULL, NULL, 5, 0),
(10, 4, 4, '1', 'notifcation testing', 'notifcation testing', '', '2023-11-22 15:57:57', 1, NULL, NULL, 5, 0),
(11, 4, 4, '1', 'test ticket notification', 'same as subject', '', '2023-11-22 16:59:16', 1, NULL, NULL, 5, 0),
(12, 4, 4, '1', 'New ticket notfication', 'Test', '', '2023-11-23 11:16:51', 1, NULL, NULL, 5, 0),
(13, 4, 4, '1', 'New ticket notfication', 'Test', '', '2023-11-23 11:18:48', 1, NULL, NULL, 5, 0),
(14, 4, 4, '1', 'New Ticket notification', 'New Ticket notification', '', '2023-11-23 11:22:37', 1, NULL, NULL, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_activity`
--

CREATE TABLE `ticket_activity` (
  `activity_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `perfomed_user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket_activity`
--

INSERT INTO `ticket_activity` (`activity_id`, `ticket_id`, `perfomed_user_id`, `comment`, `visibility`, `datetime`, `type`) VALUES
(1, 1, 1, 'New Ticket Created By: admin', 0, '2023-10-28 15:42:19', 1),
(2, 2, 1, 'New Ticket Created By: admin', 0, '2023-10-28 16:58:34', 1),
(3, 2, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-10-28 17:00:36', 1),
(4, 3, 1, 'New Ticket Created By: admin', 0, '2023-10-28 18:03:16', 1),
(5, 3, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Bilal Ahmed<br> Work Status: Un Assigned', 0, '2023-10-28 18:05:01', 1),
(6, 1, 4, 'Ticket Assign To: <br> Ticket Assign By: Aamer Syed<br> Work Status: Un Assigned', 0, '2023-10-29 11:56:22', 1),
(7, 1, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Un Assigned', 0, '2023-10-29 11:57:05', 1),
(8, 4, 1, 'New Ticket Created By: admin', 0, '2023-10-29 12:37:32', 1),
(9, 3, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Bilal Ahmed<br> Work Status: Un Assigned', 0, '2023-10-29 12:38:45', 1),
(10, 5, 4, 'New Ticket Created By: Aamer', 0, '2023-10-29 15:19:54', 1),
(11, 6, 1, 'New Ticket Created By: admin', 0, '2023-10-29 15:21:38', 1),
(12, 6, 1, ' asdf', 0, '2023-10-29 15:22:06', 3),
(13, 6, 1, ' asdfasdf', 0, '2023-10-29 15:22:34', 3),
(14, 0, 4, ' asdfasdf', 0, '2023-10-29 15:24:23', 1),
(15, 5, 4, ' asdfasd', 0, '2023-10-29 15:24:30', 1),
(16, 6, 4, ' Testing', 0, '2023-10-29 15:32:16', 1),
(17, 6, 4, 'Testing 2', 0, '2023-10-29 15:33:02', 1),
(18, 6, 4, 'Testing 3', 0, '2023-10-29 15:33:08', 1),
(19, 6, 4, ' Working on thigs', 0, '2023-10-29 15:35:13', 3),
(20, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Un Assigned', 0, '2023-10-29 15:38:57', 1),
(21, 6, 4, ' internal comment', 0, '2023-10-29 16:05:23', 2),
(22, 5, 4, ' ', 0, '2023-10-29 16:57:38', 1),
(23, 5, 4, ' abc', 0, '2023-10-29 16:57:46', 1),
(24, 6, 4, ' abc', 0, '2023-10-29 16:58:02', 1),
(25, 6, 1, ' when i will complete', 0, '2023-10-29 17:01:30', 3),
(26, 4, 4, ' asdf', 0, '2023-10-29 17:02:35', 1),
(27, 6, 1, ' is completed', 0, '2023-10-29 17:04:57', 3),
(28, 6, 4, ' Having issue with this ticket', 0, '2023-10-29 17:06:42', 2),
(29, 6, 4, ' aasdf', 0, '2023-10-29 17:07:16', 1),
(30, 6, 4, ' asdfast test', 0, '2023-10-29 17:07:24', 2),
(31, 6, 4, 'tds', 0, '2023-10-29 17:08:58', 2),
(32, 6, 4, ' dfd', 0, '2023-10-29 17:09:02', 3),
(33, 6, 4, 'dfdf', 1, '2023-10-29 17:09:16', 3),
(34, 6, 1, ' asdf', 0, '2023-10-29 17:10:47', 3),
(35, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-05 14:34:22', 1),
(36, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-05 14:34:33', 1),
(37, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-05 14:35:43', 1),
(38, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-05 14:39:10', 1),
(39, 6, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-05 14:40:14', 1),
(40, 1, 4, 'Ticket Assign To: Bilal Ahmed<br> Ticket Assign By: Aamer Syed<br> Work Status: Un Assigned', 0, '2023-11-07 15:00:55', 1),
(41, 2, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-07 15:01:13', 1),
(42, 5, 4, 'Ticket Assign To: Rahil<br> Ticket Assign By: Aamer Syed<br> Work Status: Testing', 0, '2023-11-07 15:46:28', 1),
(43, 7, 1, 'New Ticket Created By: admin', 0, '2023-11-22 11:15:10', 1),
(44, 8, 1, 'New Ticket Created By: admin', 0, '2023-11-22 12:24:08', 1),
(45, 9, 1, 'New Ticket Created By: admin', 0, '2023-11-22 15:49:15', 1),
(46, 10, 1, 'New Ticket Created By: admin', 0, '2023-11-22 15:57:57', 1),
(47, 11, 1, 'New Ticket Created By: admin', 0, '2023-11-22 16:59:16', 1),
(48, 13, 1, 'New Ticket Created By: Admin-Admin', 0, '2023-11-23 11:18:48', 1),
(49, 14, 1, 'New Ticket Created By: Admin-Admin', 0, '2023-11-23 11:22:37', 1);

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
(6, 'Requirement Gathering', 3),
(7, 'Waiting for Customer ', 2);

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_activity`
--
ALTER TABLE `ticket_activity`
  ADD PRIMARY KEY (`activity_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `agent_master`
--
ALTER TABLE `agent_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agent_reporting_to`
--
ALTER TABLE `agent_reporting_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ticket_activity`
--
ALTER TABLE `ticket_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `work_status_master`
--
ALTER TABLE `work_status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
