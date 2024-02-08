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
-- Table structure for table `agent_reporting_to`
--

CREATE TABLE `agent_reporting_to` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `reporting_to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `work_status_master`
--

CREATE TABLE `work_status_master` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `link_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
