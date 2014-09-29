-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2014 at 04:50 PM
-- Server version: 5.5.38-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ludosport`
--

-- --------------------------------------------------------

--
-- Table structure for table `academies`
--

CREATE TABLE IF NOT EXISTS `academies` (
`id` int(11) NOT NULL,
  `rector_id` varchar(11) NOT NULL,
  `en_academy_name` varchar(100) NOT NULL,
  `it_academy_name` varchar(100) DEFAULT NULL,
  `type` varchar(65) NOT NULL,
  `contact_firstname` varchar(100) NOT NULL,
  `contact_lastname` varchar(100) NOT NULL,
  `association_fullname` varchar(100) NOT NULL,
  `role_referent` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_1` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `email` varchar(65) NOT NULL,
  `fee1` decimal(8,2) NOT NULL DEFAULT '0.00',
  `fee2` decimal(8,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `academies`
--

INSERT INTO `academies` (`id`, `rector_id`, `en_academy_name`, `it_academy_name`, `type`, `contact_firstname`, `contact_lastname`, `association_fullname`, `role_referent`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `fee1`, `fee2`, `user_id`, `timestamp`) VALUES
(1, '3,5', 'Poppey Sailor Man', 'Poppey Sailor Man', 'ac', 'Soyab', 'Rana', 'PSM', 'Poppeyyyyyyyyyy Sailorrrrrrrrrrr Mannnnnnnnnnnnnnnnn', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 500.00, 20.00, 2, '2014-07-25 08:45:52'),
(2, '6', 'Dexter Laboratory', 'Dexter Laboratory', 'ac', 'Soyab', 'Rana', 'DL', 'Temparory', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 100.00, 30.00, 2, '2014-07-25 11:22:54'),
(3, '5', 'Power Puff Girls', 'Power Puff Girls', 'ac', 'John', 'Candy', 'Power Puff Girls', 'Maecenas nec leo nec lacus posuere ultricies. Mauris fermentum porta nulla. Vestibulum dictum, nulla vitae gravida sollicitudin, mauris justo bibendum velit, in varius tortor ipsum et nulla. Phasellus a convallis magna. Suspendisse potenti. In hac habitas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nEtiam finibus purus vel augue consectetur, vitae viverra mauris egestas.\r\nInteger blandit elit vitae risus fringilla scelerisque.\r\nCurabitur sollicitudin sem non nibh mattis, eu blandit risus ultricies.', '123456', 4, 2, 1, '1234567890', '91987654321', 'ppg@yopmail.com', 100.00, 50.00, 2, '2014-07-31 04:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
`id` int(11) NOT NULL,
  `clan_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `clan_date`, `student_id`, `attendance`, `user_id`, `timestamp`) VALUES
(1, '2014-09-23', 31, 1, 0, '2014-09-22 07:04:57'),
(2, '2014-09-23', 34, 1, 0, '2014-09-22 07:04:57'),
(3, '2014-09-23', 14, 1, 0, '2014-09-22 07:04:57'),
(4, '2014-09-23', 27, 1, 0, '2014-09-22 07:04:57'),
(5, '2014-09-23', 36, 1, 0, '2014-09-22 07:04:57'),
(6, '2014-09-24', 31, 1, 0, '2014-09-22 07:04:57'),
(7, '2014-09-24', 34, 1, 0, '2014-09-22 07:04:57'),
(8, '2014-09-24', 15, 1, 0, '2014-09-22 07:04:57'),
(9, '2014-09-24', 16, 1, 0, '2014-09-22 07:04:57'),
(10, '2014-09-24', 20, 1, 0, '2014-09-22 07:04:57'),
(11, '2014-09-24', 21, 1, 0, '2014-09-22 07:04:57'),
(12, '2014-09-24', 25, 1, 0, '2014-09-22 07:04:57'),
(13, '2014-09-24', 23, 1, 0, '2014-09-22 07:04:57'),
(14, '2014-09-25', 15, 1, 1, '2014-09-22 07:04:57'),
(15, '2014-09-25', 16, 1, 1, '2014-09-22 07:04:57'),
(16, '2014-09-25', 14, 1, 0, '2014-09-22 07:04:57'),
(17, '2014-09-26', 14, 1, 0, '2014-09-22 07:04:57'),
(18, '2014-09-26', 17, 1, 0, '2014-09-22 07:04:58'),
(19, '2014-09-26', 13, 1, 0, '2014-09-22 07:04:58'),
(20, '2014-09-27', 17, 1, 0, '2014-09-22 07:04:58'),
(21, '2014-09-27', 13, 1, 0, '2014-09-22 07:04:58'),
(22, '2014-09-28', 20, 1, 0, '2014-09-22 07:04:58'),
(23, '2014-09-28', 21, 1, 0, '2014-09-22 07:04:58'),
(24, '2014-09-28', 25, 1, 0, '2014-09-22 07:04:58'),
(25, '2014-09-28', 23, 1, 0, '2014-09-22 07:04:58'),
(26, '2014-09-29', 20, 1, 0, '2014-09-22 07:04:58'),
(27, '2014-09-29', 21, 1, 0, '2014-09-22 07:04:58'),
(28, '2014-09-29', 25, 0, 0, '2014-09-22 07:04:58'),
(29, '2014-09-29', 23, 1, 0, '2014-09-22 07:04:58'),
(30, '2014-09-30', 31, 1, 0, '2014-09-23 05:33:39'),
(31, '2014-09-30', 34, 1, 0, '2014-09-23 05:33:39'),
(32, '2014-09-30', 14, 1, 0, '2014-09-23 05:33:39'),
(33, '2014-09-30', 27, 1, 0, '2014-09-23 05:33:39'),
(34, '2014-09-30', 33, 1, 0, '2014-09-23 05:33:39'),
(35, '2014-09-30', 36, 1, 0, '2014-09-23 05:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_recovers`
--

CREATE TABLE IF NOT EXISTS `attendance_recovers` (
`id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `clan_date` date NOT NULL,
  `clan_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '1',
  `history` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE IF NOT EXISTS `batches` (
`id` int(11) NOT NULL,
  `type` enum('D','H','M','Q','S') NOT NULL,
  `assign_role` varchar(20) NOT NULL DEFAULT '0',
  `sequence` int(11) NOT NULL DEFAULT '0',
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) NOT NULL,
  `has_point` tinyint(1) NOT NULL DEFAULT '0',
  `xpr` bigint(11) NOT NULL DEFAULT '0',
  `war` bigint(11) NOT NULL DEFAULT '0',
  `sty` bigint(11) NOT NULL DEFAULT '0',
  `image` varchar(150) NOT NULL,
  `dashboard_cover` varchar(255) DEFAULT NULL,
  `profile_cover` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `type`, `assign_role`, `sequence`, `en_name`, `it_name`, `has_point`, `xpr`, `war`, `sty`, `image`, `dashboard_cover`, `profile_cover`, `description`, `user_id`, `timestamp`) VALUES
(1, 'D', '2,5', 1, 'Youngling', 'Iniziato', 0, 0, 0, 0, '009e688e1c6e90c2720fed5b3fdb948b.png', NULL, NULL, '<p><br></p>', 1, '2014-08-06 02:59:35'),
(2, 'D', '2,5', 9, 'Founding Master', 'Maestro Fondatore', 0, 0, 0, 0, 'f4480b0d05c4b2f1010f166fc7ebfbac.png', NULL, NULL, '<p><br></p>', 1, '2014-08-06 08:58:29'),
(3, 'D', '2,5', 3, 'Jedi', 'Jedi', 1, 300, 0, 0, '375c268b5e786fe15bf5ca8f9bb5d5d3.png', 'd4e27a9f223078ba32fa03aca78fc0bc.jpg', NULL, '<p><br></p>', 1, '2014-08-06 08:59:16'),
(4, 'D', '2,5', 8, 'Sith Lord', 'Maestro Sith', 0, 0, 0, 0, '89e990cb1cff363dadf0cf17faae2205.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 08:59:35'),
(5, 'D', '2,5', 5, 'Jedi Knight', 'Cavaliere Jedi', 1, 500, 0, 0, 'd9564d57165b2e8d21b1b8c959409216.png', NULL, NULL, '<p><br></p>', 1, '2014-08-06 09:00:03'),
(6, 'D', '2,5', 7, 'Jedi Master', 'Maestro Jedi', 1, 1000, 0, 0, '586eef00da8faf942266c6e0564e7e76.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:00:17'),
(7, 'D', '2,5', 2, 'Padawan', 'Padawan', 1, 150, 0, 0, '05be81d032899191a04476ce132aebfb.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:00:37'),
(8, 'D', '2,5', 4, 'Sith', 'Sith', 0, 0, 0, 0, 'd8c40faf9d4a4cc931a71406d830726c.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:09:49'),
(9, 'D', '2,5', 6, 'Sith Knight', 'Cavaliere Sith', 0, 0, 0, 0, 'f29c72aad0c31c87d6f0b4184eb7f8a9.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:10:01'),
(10, 'H', '2,3', 1, 'Style Keeper', 'Custode delle Tradizioni', 0, 0, 0, 0, '26343a7d74b1cd4e83c3832e11e9c15e.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:11:26'),
(11, 'H', '2,3', 7, 'Shadow Master', 'Maestro d''Ombra', 0, 0, 0, 0, 'c659b7d7d9eeeda61e8eac8572d6b6bd.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:11:41'),
(12, 'Q', '3', 1, 'Training Instructor', 'Allievo Istruttore', 0, 0, 0, 0, 'c3f47e4d7892badb6143c0ca8dfdb9ea.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:12:01'),
(13, 'Q', '3', 9, 'Dean', 'Preside', 0, 0, 0, 0, '8e1186446122de0125950eaa1876b6c7.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:12:24'),
(14, 'S', '4', 1, 'Guardian', 'Guardiano', 1, 0, 0, 50, 'd96588d37881627e7d15bb08aa5f5894.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:12:54'),
(15, 'S', '4', 2, 'Sentinel', 'Sentinella', 1, 0, 50, 0, 'f21947ce2c9749ef24d3163c281a3bb0.png', NULL, NULL, '<p><br></p>', 2, '2014-08-06 09:13:13'),
(16, 'H', '2,3', 4, 'Quartermaster', 'Quartiermastro', 0, 0, 0, 0, '791c2c9790d4b4cfb379225986fa15e9.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:09:26'),
(17, 'H', '2,3', 2, 'Prophet', 'Profeta', 0, 0, 0, 0, 'ad6b6aa3371010529116611c74cc4750.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:09:49'),
(18, 'H', '2,3', 5, 'Shadow', 'Ombra', 0, 0, 0, 0, '163a5839d263031de7f9d0ec7ebe474b.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:10:09'),
(19, 'H', '2,3', 6, 'Master Sabersmith', 'Mastro di Spada', 0, 0, 0, 0, 'd673d00cb663bf587f3d206d0e2972e1.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:10:38'),
(20, 'H', '2,3', 3, 'Researcher', 'Ricercatore', 0, 0, 0, 0, '10998295a9776fb243d542302339f63a.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:11:02'),
(21, 'Q', '3', 2, 'Instructor level 1', 'Istruttore livello 1', 1, 0, 150, 0, '802e292ed5e1e18b41eacb4c62c7f7e2.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:12:39'),
(22, 'Q', '3', 3, 'Instructor level 2', 'Istruttore livello 2', 1, 0, 150, 0, '74e0c7ae2ffa57b2f6edaf218515d5b1.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:12:59'),
(23, 'Q', '3', 4, 'Instructor level 3', 'Istruttore livello 3', 1, 0, 200, 0, '3b69f92034caa56c01b0dc557cfa18b0.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:13:21'),
(24, 'Q', '3', 5, 'Instructor level 4', 'Istruttore livello 4', 1, 0, 200, 0, 'e5794f064d8771b73cbc726d92cec792.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:13:38'),
(25, 'Q', '3', 6, 'Instructor level 5', 'Istruttore livello 5', 1, 0, 250, 0, 'ee9fca9261bfc36aa75520acab20a6c4.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:13:55'),
(26, 'Q', '3', 7, 'Instructor level 6', 'Istruttore livello 6', 1, 0, 250, 0, 'e5a69a7cdadbe9d3c7920778063a181d.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:14:12'),
(27, 'Q', '3', 8, 'Instructor level 7', 'Istruttore livello 7', 1, 0, 300, 0, '34decadb79339ec2331e068fb92ab08c.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:14:31'),
(28, 'Q', '3', 10, 'Rector', 'Rector', 0, 0, 0, 0, 'd8cd960df43cb57e12d52298430214c6.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:14:45'),
(29, 'S', '4', 3, 'Consul', 'Console', 0, 0, 0, 0, '816090c955dcd98b6350f24c68d29c38.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:16:20'),
(30, 'S', '4', 5, 'Style Keeper', 'Custode di Stile', 1, 0, 100, 0, '919209a9005701114a358b640fbaea6f.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:16:53'),
(31, 'S', '4', 15, 'Ambassador', 'Ambasciatore', 0, 0, 0, 0, '42d6aa2ab1605c76a017a0cf4028128d.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:17:09'),
(32, 'S', '4', 4, 'Master of Arms', 'Maestro d''Armi', 1, 0, 0, 100, '150cc6ac0be492e802de192db5baafb9.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:17:29'),
(33, 'S', '4', 6, 'Battle Master', 'Maestro di Battaglia', 1, 0, 0, 200, '1fc7d4aae6bc3e19390e348c09acf33a.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:18:18'),
(34, 'S', '4', 14, 'Academy Master', 'Maestro d''Accademia', 1, 200, 0, 0, '1a40f32897f546631e7a96a1f6c8d82c.png', NULL, NULL, '<p><br></p>', 1, '2014-09-04 14:18:40'),
(35, 'S', '4', 7, 'Style Master in Shii-Cho', 'Maestro di Shii-Cho', 0, 0, 0, 0, '2656d4016b1874c18d229c5ff9485850.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:19:14'),
(36, 'S', '4', 8, 'Style Master in Makashi', 'Maestro di Makashi', 0, 0, 0, 0, '03c0e2e2b6050bdeac592090aa063e8f.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:19:53'),
(37, 'S', '4', 9, 'Style Master in Soresu', 'Maestro di Soresu', 0, 0, 0, 0, '66055d8882da9f8f9e5a9f8ec8a591d5.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:20:11'),
(38, 'S', '4', 10, 'Style Master in Ataru', 'Maestro di Ataru', 0, 0, 0, 0, '49155d58d16f378639ee78ed4589d5be.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:20:29'),
(39, 'S', '4', 11, 'Style Master in Djem-So', 'Maestro di Djem-So', 0, 0, 0, 0, '6198824741d2cef9be0fff724cf4f777.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:20:51'),
(40, 'S', '4', 12, 'Style Master in Niman', 'Maestro di Niman', 0, 0, 0, 0, '31bf67508bc6ab370e6913dbb0f9dbe1.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:21:08'),
(41, 'S', '4', 13, 'Style Master in Vaapad', 'Maestro di Vaapad', 0, 0, 0, 0, '2e622daab8de916330cf3d1d06e27a59.png', NULL, NULL, '<p><br></p>', 2, '2014-09-04 14:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `batchrequests`
--

CREATE TABLE IF NOT EXISTS `batchrequests` (
`id` int(11) NOT NULL,
  `from_role` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `description` text,
  `status` enum('P','A','U') NOT NULL DEFAULT 'P',
  `status_change_by` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE IF NOT EXISTS `challenges` (
`id` int(11) NOT NULL,
  `type` enum('R','B') NOT NULL DEFAULT 'R',
  `from_id` int(11) NOT NULL,
  `from_status` enum('A','R') NOT NULL DEFAULT 'A',
  `to_id` int(11) NOT NULL,
  `to_status` enum('P','A','R') NOT NULL DEFAULT 'P',
  `made_on` datetime NOT NULL,
  `status_changed_on` datetime DEFAULT NULL,
  `played_on` datetime DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `result` int(11) NOT NULL DEFAULT '0',
  `result_status` enum('MP','MNP','SP') NOT NULL DEFAULT 'MNP',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `type`, `from_id`, `from_status`, `to_id`, `to_status`, `made_on`, `status_changed_on`, `played_on`, `place`, `result`, `result_status`, `user_id`, `timestamp`) VALUES
(1, 'R', 25, 'A', 20, 'A', '2014-09-18 17:09:15', '2014-09-18 17:09:33', '2014-09-18 17:09:33', '0', 25, 'MP', 25, '2014-09-18 11:39:15'),
(2, 'R', 23, 'A', 25, 'P', '2014-09-18 17:09:15', '2014-09-18 17:09:33', '2014-09-18 17:09:33', '0', 0, 'MNP', 25, '2014-09-18 11:39:15'),
(3, 'R', 18, 'A', 25, 'A', '2014-09-18 17:09:15', '2014-09-18 17:09:33', '2014-09-18 17:09:33', '0', 18, 'MP', 18, '2014-09-18 11:39:15'),
(6, 'B', 25, 'A', 14, 'A', '2014-09-25 12:22:53', '2014-09-25 12:23:18', '2014-09-30 01:00:00', '0', 14, 'MP', 25, '2014-09-25 06:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
`id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Vadodara', '', 1, '2014-07-17 07:14:07'),
(2, 1, 'Ahemedabad', '', 1, '2014-07-17 07:14:14'),
(3, 2, 'Andheri East ', '', 1, '2014-07-17 07:15:15'),
(4, 2, 'Church Gate', '', 1, '2014-07-17 07:16:01'),
(5, 4, 'milan', NULL, 2, '2014-08-01 08:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `clandates`
--

CREATE TABLE IF NOT EXISTS `clandates` (
`id` int(11) NOT NULL,
  `type` enum('R','S','C') NOT NULL DEFAULT 'R',
  `clan_id` int(11) NOT NULL,
  `clan_date` date NOT NULL,
  `clan_shift_from` date DEFAULT NULL,
  `description` text,
  `history` text,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `clandates`
--

INSERT INTO `clandates` (`id`, `type`, `clan_id`, `clan_date`, `clan_shift_from`, `description`, `history`, `user_id`, `timestamp`) VALUES
(1, 'R', 1, '2014-09-23', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(2, 'R', 3, '2014-09-23', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(3, 'R', 4, '2014-09-23', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(4, 'R', 1, '2014-09-24', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(5, 'R', 2, '2014-09-24', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(6, 'R', 6, '2014-09-24', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(7, 'R', 2, '2014-09-25', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(8, 'R', 3, '2014-09-25', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(9, 'R', 3, '2014-09-26', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(10, 'R', 5, '2014-09-26', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(11, 'R', 5, '2014-09-27', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(12, 'R', 6, '2014-09-28', NULL, NULL, NULL, 0, '2014-09-22 07:04:56'),
(13, 'S', 6, '2014-09-30', '2014-09-29', NULL, NULL, 0, '2014-09-22 07:04:56'),
(14, 'R', 1, '2014-09-30', NULL, NULL, NULL, 0, '2014-09-23 05:33:38'),
(15, 'R', 3, '2014-09-30', NULL, NULL, NULL, 0, '2014-09-23 05:33:38'),
(16, 'R', 4, '2014-09-30', NULL, NULL, NULL, 0, '2014-09-23 05:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `clans`
--

CREATE TABLE IF NOT EXISTS `clans` (
`id` int(11) NOT NULL,
  `academy_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `teacher_id` varchar(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `clan_from` date NOT NULL,
  `clan_to` date NOT NULL,
  `lesson_day` varchar(25) NOT NULL,
  `lesson_from` bigint(100) NOT NULL DEFAULT '0',
  `lesson_to` bigint(100) NOT NULL DEFAULT '0',
  `en_class_name` varchar(65) NOT NULL,
  `it_class_name` varchar(65) NOT NULL,
  `same_address` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_1` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `email` varchar(65) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `clans`
--

INSERT INTO `clans` (`id`, `academy_id`, `school_id`, `teacher_id`, `level_id`, `clan_from`, `clan_to`, `lesson_day`, `lesson_from`, `lesson_to`, `en_class_name`, `it_class_name`, `same_address`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, 1, 1, '5', 1, '2014-06-01', '2014-12-31', '2,3', 1410406200, 1410417000, 'Poppey Ep 1', 'Poppey Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:45:00'),
(2, 2, 2, '7', 2, '2014-07-01', '2015-06-30', '3,4', 1411619400, 1411630200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 1, '2014-07-26 09:46:59'),
(3, 1, 3, '3', 1, '2014-07-01', '2015-06-30', '2,4,5', 1406352600, 1406359800, 'Sailor Ep 2', 'Sailor Ep 2', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38'),
(4, 2, 4, '8', 1, '2014-07-01', '2015-06-30', '2', 1406363400, 1406370600, 'Lab Ep 2', 'Lab Ep 2', 1, 'Baroda', '390016', 5, 4, 2, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:48:27'),
(5, 1, 1, '7', 1, '2014-07-01', '2015-06-30', '5,6', 1407292200, 1407306600, 'Poppey Ep 2', 'Poppey Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-08-06 05:25:51'),
(6, 1, 3, '3', 1, '2014-07-01', '2015-06-30', '1,3,7', 1410345000, 1410348600, 'Sailor Ep 3', 'Sailor Ep 3', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 1, '2014-07-26 09:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
`id` int(11) NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 'India', 'India', 1, '2014-07-17 07:11:46'),
(2, 'Italy', 'Italy', 1, '2014-07-17 07:11:56'),
(3, 'UAE', 'UAE', 1, '2014-07-21 06:15:37'),
(5, 'Temp', 'Temp', 2, '2014-07-25 06:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
`id` int(11) NOT NULL,
  `type` varchar(200) CHARACTER SET utf8 NOT NULL,
  `subject` text CHARACTER SET utf8,
  `message` text CHARACTER SET utf8,
  `attachment` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `format_info` text CHARACTER SET utf8,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `message`, `attachment`, `format_info`, `user_id`, `timestamp`) VALUES
(1, 'user_registration', 'User Registration | MyLudosport', 'Hello #firstname #lastname<br>Thankyou for Registration.<br><div><br><span style="font-weight: bold;">Basic Details:<br></span>Name : #firstname #lastname<br>Location :  #location<br>Date of Birth : #dob<br><br><span style="font-weight: bold;">Login Details:<br></span>Nickname : #nickname<br>Password :  #password<br></div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#location\r\n#dob\r\n#nickname\r\n#password', 2, '2014-07-26 05:15:22'),
(2, 'forgot_password', 'Forgot Password | MyLudosport', 'Hello #firstname #lastname&nbsp;<div><br></div><div>You have request for the reset the password.</div><div>Please click the below link to reset password.<br>\n#reset_link</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', 'b9511c6462626b7779166e8a924b83af.pdf', '#firstname\r\n#lastname\r\n#reset_link', 2, '2014-07-26 05:15:22'),
(3, 'user_registration_notification', 'New User Registration Notification | MyLudosport', 'New User<div>#firstname #lastname is registerd on #date<div><br><span style="font-weight: bold;">Basic Details:<br></span>Name : #firstname #lastname<br>Location :  #location<br>Date of Birth : #dob<br><br><span style="font-weight: bold;">Login Details:<br></span>Nickname : #nickname<br><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#location\r\n#dob\r\n#nickname\r\n#date', 2, '2014-07-26 05:15:22'),
(4, 'trial_lesson_request', 'Request for Trail Lesson | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname </span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Request for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><div><br></div><div><div>Thanks,</div></div></div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date', 2, '2014-08-25 08:05:22'),
(5, 'trial_lesson_accepted', 'Request for Trail Lesson has been accepted | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname r</span><span style="line-height: 1.42857143;">equest for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">has been </span>accepted<span style="line-height: 1.42857143;"> by the #teacher_name on #accept_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date\r\n#teacher_name\r\n#accept_date\r\n', 2, '2014-08-25 08:05:22'),
(6, 'trial_lesson_rejected', 'Request for Trail Lesson has been Rejected | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname r</span><span style="line-height: 1.42857143;">equest for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">has been </span>rejected<span style="line-height: 1.42857143;"> by the #teacher_name on #reject_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date\r\n#teacher_name\r\n#reject_date', 2, '2014-08-25 08:05:22'),
(7, 'accepted_as_student', 'Confirm as a student | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname is now student of &nbsp;</span><span style="line-height: 1.42857143;">#clan_name clan.</span></div><div><span style="line-height: 1.42857143;">Accepted by the #teacher_name on #accept_date</span><br></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#teacher_name\r\n#accept_date', 2, '2014-08-25 08:05:22'),
(8, 'student_absent', 'Student Absent | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname will remain absent for&nbsp;</span><span style="line-height: 1.42857143;">#clan_name on #date.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#date', 2, '2014-08-25 08:05:22'),
(9, 'recovery_student', 'Recover an Absent Class | MyLudosport', '<div><span style="line-height: 1.42857143;">#firstname #lastname is a student of #student_clan will recover his absence class at #recover_clan on #date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#student_clan\r\n#recover_clan\r\n#date', 2, '2014-08-25 08:05:22'),
(10, 'teacher_recovery_student_for_student', 'Student (Teacher assign Recovery Class) | MyLudosport', '<div><span style="line-height: 1.42857143;">Dear #student_name<br><br>The teacher #teacher_name has set the recovery class for you as you were absent.<br>The Clan is #recover_clan on #date<br></span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#student_name\r\n#teacher_name\r\n#recover_clan\r\n#date', 2, '2014-08-25 08:05:22'),
(11, 'teacher_recovery_student_for_teacher', 'Teacher (Teacher assign Recovery Class) | MyLudosport', 'Dear #receiver_teacher<br><br>The #sender_teacher has send one studennt name #student_name for the recovery class.<br>The class is #recover_clan on #date<br><br><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#student_name\r\n#receiver_teacher\r\n#sender_teacher\r\n#recover_clan\r\n#date', 2, '2014-08-25 08:05:22'),
(12, 'event_invitation', 'Event Invitation | MyLudosport', '<p>Dear #user</p><p>New Event is organised.</p><h4><span>Event Details :</span></h4><h4><hr></h4><p>#event_image</p><hr><p>Name : #event_name</p><p>Date : #from_date to #to_date</p><p>Location : #location</p><p>Event Created &nbsp;:&nbsp;#event_created_by</p><hr><p><br></p><p>The&nbsp;Invitation is send you by&nbsp;#invitation_send_by</p><p><br></p><p></p><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div><p></p>', NULL, '#user\r\n#event_name\r\n#from_date\r\n#to_date\r\n#location\r\n#event_image\r\n#event_created_by\r\n#invitation_send_by', 2, '2014-08-25 08:05:22'),
(13, 'teacher_absent', 'Teacher Absent | MyLudosport', '<div><span>Dear #user_name,</span></div><div><span><br></span></div><div><span>The #teacher_name will remain absent for&nbsp;</span><span>#clan_name on #date.</span></div><div><span><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#teacher_name\r\n#clan_name\r\n#date', 2, '2014-08-25 08:05:22'),
(14, 'recovery_teacher', 'Recovery Teacher | MyLudosport', '<div><span>Dear #user_name,</span></div><div><span><br></span></div><div><span><br></span></div><div>You will take lesson of #clan_name on #clan_date in place of #teacher_name.</div><div><span>It is approved by #approved_user_name.</span><br></div><div><br></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#clan_name\r\n#clan_date\r\n#teacher_name\r\n#approved_user_name', 2, '2014-08-25 08:05:22'),
(15, 'holiday_approved', 'Holiday Approved | MyLudosport', '<div><span>Dear #user_name,</span></div><div><br></div><div>Your request for holiday on #date is approved.</div><div><span>It is approved by #authorized_user_name</span><span>.</span><br></div><div><br></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#date\r\n#authorized_user_name', 2, '2014-08-25 08:05:22'),
(16, 'holiday_upapproved', 'Holiday Unapproved | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>Your request for holiday on #date is <span>unapproved</span>.</div><div>It is unapproved by #authorized_user_name.<br></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#date\r\n#authorized_user_name', 2, '2014-08-25 08:05:22'),
(17, 'change_clan_date', 'Clan Reschedule | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>The #clan_name of #school_name at #academy_name has been&nbsp;reschedule from #from_date to #to_date.</div><div><br></div><div>It is done by #authorized_user_name.<br></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#clan_name\r\n#school_name\r\n#academy_name\r\n#from_date\r\n#to_date\r\n#authorized_user_name', 1, '2014-09-09 11:56:53'),
(18, 'challenge_made', 'Open Challenge | MyLudosport', '<div>Dear #to_name,</div><div><br></div><div>You have received challenge from #from_name on date : #on_date #on_time.</div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#to_name\r\n#from_name\r\n#on_date\r\n#to_time', 1, '2014-09-09 11:56:53'),
(19, 'challenge_accepted', 'Challenge Accepted | MyLudosport', '<div>Dear #from_name,</div><div><br></div><div>#to_name has accepted your challenge on date : #on_date #on_time.</div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#to_name\r\n#from_name\r\n#on_date\r\n#to_time', 1, '2014-09-09 11:56:53'),
(20, 'challenge_rejected', 'Challenge Rejected | MyLudosport', '<div>Dear #from_name,</div><div><br></div><div>#to_name has rejected your challenge on date : #on_date #on_time.</div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#to_name\r\n#from_name\r\n#on_date\r\n#to_time', 1, '2014-09-09 11:56:53'),
(21, 'challenge_winner', 'Winner of Challenge | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>The result is declare of the match played between you and #opponent_name&nbsp;on date : #on_date #on_time.</div><div><br></div><div>The Winner is #winner .</div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name#opponent_name#on_date#to_time#winner', 1, '2014-09-09 11:56:53'),
(22, 'batch_request', 'Badge Request | MyLudosport', '<div >Dear #user_name,</div><div ><br></div><div >#request_username has requested for Badge &nbsp;#batch_name for #student_name</div><div ><br></div><div >Thanks </div><div ><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#batch_name\r\n#student_name\r\n#request_username', 1, '2014-08-25 08:05:22'),
(23, 'batch_request_approved', 'Badge Request Approved | MyLudosport', '<div><span>Dear #user_name,</span></div><div><br></div><div>Your request for Badge &nbsp;#batch_name for #student_name is approved</div><div><span>It is approved by #authorized_username</span><span>.</span><br></div><div><br></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#batch_name\r\n#student_name\r\n#request_username\r\n#authorized_username', 1, '2014-08-25 08:05:22'),
(24, 'batch_request_unapproved', 'Badge Request unapproved | MyLudosport', '<div >Dear #user_name,</div><div ><br></div><div >Your request for Badge &nbsp;#batch_name for #student_name is unapproved</div><div >It is unapproved by #authorized_username.<br></div><div ><br></div><div >Thanks </div><div ><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#batch_name\r\n#student_name\r\n#request_username\r\n#authorized_username', 1, '2014-08-25 08:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `eventattendances`
--

CREATE TABLE IF NOT EXISTS `eventattendances` (
`id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventcategories`
--

CREATE TABLE IF NOT EXISTS `eventcategories` (
`id` int(11) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `it_name` varchar(255) NOT NULL,
  `has_point` tinyint(1) NOT NULL DEFAULT '0',
  `xpr` int(11) NOT NULL DEFAULT '0',
  `war` int(11) NOT NULL DEFAULT '0',
  `sty` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `eventcategories`
--

INSERT INTO `eventcategories` (`id`, `en_name`, `it_name`, `has_point`, `xpr`, `war`, `sty`, `user_id`, `timestamp`) VALUES
(1, 'Tournament', 'Tournament', 0, 0, 0, 0, 1, '2014-08-05 12:27:51'),
(2, 'Workshop', 'Workshop', 1, 8, 0, 0, 1, '2014-08-05 12:27:57'),
(3, 'Seminar', 'Seminar', 1, 0, 8, 0, 1, '2014-08-05 12:28:01'),
(4, 'Promo', 'Promo', 0, 0, 0, 0, 1, '2014-08-05 12:28:47'),
(5, 'Meeting', 'Adunanza', 1, 0, 8, 0, 1, '2014-08-05 12:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `eventinvitations`
--

CREATE TABLE IF NOT EXISTS `eventinvitations` (
`id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `eventinvitations`
--

INSERT INTO `eventinvitations` (`id`, `event_id`, `from_id`, `to_id`, `timestamp`) VALUES
(1, 1, 1, 3, '2014-09-29 06:42:08'),
(2, 1, 1, 4, '2014-09-29 06:42:20'),
(3, 1, 1, 5, '2014-09-29 06:42:25'),
(4, 1, 1, 6, '2014-09-29 06:42:32'),
(5, 1, 1, 7, '2014-09-29 06:42:38'),
(6, 1, 1, 8, '2014-09-29 06:42:44'),
(7, 1, 1, 13, '2014-09-29 06:42:55'),
(8, 1, 1, 14, '2014-09-29 06:43:00'),
(9, 1, 1, 15, '2014-09-29 06:43:11'),
(10, 1, 1, 16, '2014-09-29 06:43:22'),
(11, 1, 1, 17, '2014-09-29 06:43:28'),
(12, 1, 1, 20, '2014-09-29 06:43:44'),
(13, 1, 1, 21, '2014-09-29 06:43:54'),
(14, 1, 1, 23, '2014-09-29 06:44:00'),
(15, 1, 1, 25, '2014-09-29 06:44:06'),
(16, 1, 1, 27, '2014-09-29 06:44:16'),
(17, 1, 1, 28, '2014-09-29 06:44:27'),
(18, 1, 1, 31, '2014-09-29 06:44:33'),
(19, 1, 1, 33, '2014-09-29 06:44:39'),
(20, 1, 1, 34, '2014-09-29 06:44:44'),
(21, 1, 1, 36, '2014-09-29 06:44:55'),
(22, 1, 1, 37, '2014-09-29 06:45:01'),
(23, 1, 3, 12, '2014-09-29 09:37:46'),
(24, 1, 3, 13, '2014-09-29 09:37:52'),
(25, 1, 3, 36, '2014-09-29 09:38:07'),
(26, 1, 3, 37, '2014-09-29 09:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) NOT NULL,
  `eventcategory_id` int(11) NOT NULL,
  `event_for` enum('AC','SC','ALL') NOT NULL DEFAULT 'ALL',
  `school_id` varchar(25) NOT NULL DEFAULT '0',
  `en_name` varchar(100) NOT NULL,
  `it_name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `manager` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no-cover.jpg',
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventcategory_id`, `event_for`, `school_id`, `en_name`, `it_name`, `city_id`, `date_from`, `date_to`, `manager`, `image`, `description`, `user_id`, `timestamp`) VALUES
(1, 3, 'AC', '1,3', 'Seminar', 'Seminar', 3, '2014-09-28', '2014-09-30', '3', 'd2552d6693f9b2a2168255c13a1c6aa2.jpeg', '<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>', 5, '2014-08-20 12:10:15'),
(2, 5, 'SC', '2', 'Gathering', 'Gathering', 5, '2014-09-30', '2014-09-30', '2', '817a148f94e40097cbe69e9f2992b359.jpg', '<p ><span >Donec quis dui et ex luctus ornare a sed quam. Integer tempor, arcu vel dictum tempus, eros diam pretium neque, at dapibus dui lorem et leo. Morbi fermentum aliquet elit quis tempor. Nulla tempus tortor in congue facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed non sem nisi. Suspendisse in nibh at nunc vulputate ornare. Etiam sit amet ante eu metus tempor lobortis a sed tortor.</span></p><p ><span >Aenean sed risus eget lorem condimentum lacinia. Nunc sed ultricies ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum elit dui, a scelerisque urna varius quis. Nam tincidunt erat et leo hendrerit, quis sollicitudin nulla lobortis. Pellentesque ut vehicula dui. Duis commodo tincidunt orci, non dignissim orci consequat ac.</span></p><p ><span >Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed blandit ut turpis ut consectetur. Praesent at mauris id erat condimentum mollis. Aliquam molestie commodo augue luctus suscipit. Proin porta lacinia orci, a rutrum nisl vestibulum in. Morbi sodales sodales facilisis. Aenean facilisis congue semper. Vivamus molestie, nibh nec egestas varius, magna ante sagittis libero, et gravida arcu orci in erat.</span></p>', 5, '2014-08-21 05:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
`id` int(11) NOT NULL,
  `en_level_name` varchar(65) NOT NULL,
  `it_level_name` varchar(65) NOT NULL,
  `is_basic` enum('0','1') NOT NULL DEFAULT '0',
  `under_sixteen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `en_level_name`, `it_level_name`, `is_basic`, `under_sixteen`) VALUES
(1, '1st Jedi', 'Prima Jedi', '0', '0'),
(2, '2st Jedi', 'Seconda Jedi', '1', '0'),
(3, '1st Youngling', 'Prima Youngling', '0', '1'),
(4, '2nd Youngling', 'Seconda Youngling', '0', '1'),
(5, '3rd Youngling', 'Terza Youngling', '0', '1'),
(6, '4th Youngling', 'Quarta Youngling', '0', '1'),
(7, '1st Padawan', 'Prima Padawan', '1', '0'),
(8, '2nd Padawan', 'Seconda Padawan', '1', '0'),
(9, '3rd Padawan', 'Terza Padawan', '1', '0'),
(10, '4th Padawan', 'Quarta Padawan', '1', '0'),
(11, '3rd Jedi', 'Terza Jedi', '1', '0'),
(12, '4th Jedi', 'Quarta Jedi', '1', '0'),
(13, '1st Knight', 'Prima Knight', '1', '0'),
(14, '2nd Knight', 'Seconda Knight', '1', '0'),
(15, '3rd Knight', 'Terza Knight', '1', '0'),
(16, '4th Knight', 'Quarta Knight', '1', '0'),
(17, '5th Knight', 'Quinta Knight', '1', '0'),
(18, 'Instructors Course', 'Corso Istruttori', '1', '0'),
(19, 'Master Class', 'Classe Master', '1', '0'),
(20, 'Makashi Master Course', 'Corso Master di Makashi', '1', '0'),
(21, 'Shii-Cho Master Course', 'Master di Shii-Cho', '1', '0'),
(22, 'Soresu Master Course', 'Master di Soresu', '1', '0'),
(23, 'Ataru Master Course', 'Master di Ataru', '1', '0'),
(24, 'Djem-So Master Course', 'Master di Djem-So', '1', '0'),
(25, 'Niman Master Course', 'Master di Niman', '1', '0'),
(26, 'Vaapad Master Course', 'Master di Vaapad', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mailboxes`
--

CREATE TABLE IF NOT EXISTS `mailboxes` (
`id` int(11) NOT NULL,
  `type` enum('L','N','H','U') NOT NULL DEFAULT 'N',
  `to_email` varchar(65) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `mailboxes`
--

INSERT INTO `mailboxes` (`id`, `type`, `to_email`, `subject`, `message`, `attachment`, `status`, `timestamp`) VALUES
(1, 'U', 'soyab@yopmail.com', 'User Registration', 'Hello David Leo<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 1, '2014-07-26 11:10:31'),
(2, 'U', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(3, 'N', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(4, 'H', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(5, 'H', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(6, 'N', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(7, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:31'),
(8, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>David Leo is registerd on 2014-07-26 16:40:31<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 1, '2014-07-26 11:10:32'),
(9, 'L', 'admin@1.com', 'User Registration', 'Hello Temp1 1<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 0, '2014-07-30 11:31:59'),
(10, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(11, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(12, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(13, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(14, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(15, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:31:59'),
(16, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Temp1 1 is registerd on 2014-07-30 17:01:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:32:00'),
(17, 'L', 'admin@1.com', 'User Registration', 'Hello Black Solutions<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 0, '2014-07-30 11:35:32'),
(18, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:32'),
(19, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:32'),
(20, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:33'),
(21, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:33'),
(22, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:33'),
(23, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:33'),
(24, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Black Solutions is registerd on 2014-07-30 17:05:32<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-30 11:35:33'),
(25, 'L', 'pepe@yopmail.com', 'User Registration', 'Hello pepe jenas<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 0, '2014-07-31 10:14:59'),
(26, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(27, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(28, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(29, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(30, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(31, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(32, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>pepe jenas is registerd on 2014-07-31 12:14:59<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 10:14:59'),
(33, 'L', 'all@yopmail.com', 'User Registration', 'Hello All Jean<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 0, '2014-07-31 11:22:15'),
(34, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:15'),
(35, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(36, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(37, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(38, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(39, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(40, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>All Jean is registerd on 2014-07-31 13:22:15<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:22:16'),
(41, 'L', 'bhaumiksubhadeep@gmail.com', 'User Registration', 'Hello Subhadeep Bhaumik<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, 0, '2014-07-31 11:29:52'),
(42, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(43, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(44, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(45, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(46, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(47, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52'),
(48, 'L', 'soyab@yopmail.com', 'New User Registration Notification', 'New User<div><br></div><div>Subhadeep Bhaumik is registerd on 2014-07-31 13:29:52<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, 0, '2014-07-31 11:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `messageattachments`
--

CREATE TABLE IF NOT EXISTS `messageattachments` (
`id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` bigint(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `type` enum('single','group') NOT NULL DEFAULT 'single',
  `initial_id` int(11) NOT NULL,
  `reply_of` int(11) NOT NULL DEFAULT '0',
  `group_id` varchar(25) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL,
  `to_id` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `from_status` enum('S','D','T','E') NOT NULL DEFAULT 'D',
  `to_status` enum('R','U','T','E') NOT NULL DEFAULT 'U',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messagestatus`
--

CREATE TABLE IF NOT EXISTS `messagestatus` (
`id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `status` enum('R','U') NOT NULL DEFAULT 'U',
  `to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `type` enum('A','I','W','N') NOT NULL DEFAULT 'N',
  `notify_type` varchar(255) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(4, 'N', 'student_absent', 20, 3, 1, 'a:1:{s:12:"absence_date";s:10:"2014-09-17";}', 1, '2011-09-16 06:39:24'),
(42, 'N', 'teacher_absent', 3, 4, 3, 'a:4:{s:6:"action";s:15:"confirm_absence";s:7:"clan_id";s:1:"6";s:12:"from_message";s:0:"";s:4:"date";s:10:"2014-09-17";}', 1, '2014-09-16 11:04:42'),
(43, 'N', 'holiday_approved', 4, 3, 3, 'a:11:{s:2:"id";i:3;s:9:"clan_date";s:10:"2014-09-17";s:7:"clan_id";s:1:"6";s:10:"teacher_id";s:1:"3";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";N;s:10:"to_message";N;s:6:"status";s:1:"A";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-09-16 16:34:42";}', 0, '2014-09-16 11:05:54'),
(44, 'N', 'change_clan_date', 3, 4, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:09:36'),
(45, 'N', 'change_clan_date', 3, 5, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:10:18'),
(46, 'N', 'change_clan_date', 3, 13, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:10:39'),
(47, 'N', 'change_clan_date', 3, 14, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:11:09'),
(48, 'N', 'change_clan_date', 3, 15, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:11:49'),
(49, 'N', 'change_clan_date', 3, 16, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:11:57'),
(50, 'N', 'change_clan_date', 3, 17, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:12:27'),
(51, 'N', 'change_clan_date', 3, 20, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:12:59'),
(52, 'N', 'change_clan_date', 3, 21, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:13:11'),
(53, 'N', 'change_clan_date', 3, 23, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:13:31'),
(54, 'N', 'change_clan_date', 3, 25, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:14:01'),
(55, 'N', 'change_clan_date', 3, 27, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:14:13'),
(56, 'N', 'change_clan_date', 3, 31, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:14:19'),
(57, 'N', 'change_clan_date', 3, 33, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:14:39'),
(58, 'N', 'change_clan_date', 3, 34, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 0, '2014-09-16 11:15:00'),
(64, 'N', 'challenge_made', 25, 20, 1, 'a:13:{s:2:"id";i:1;s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"20";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-18 17:09:15";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-18 11:39:16'),
(65, 'N', 'challenge_accepted', 20, 25, 1, 'a:13:{s:2:"id";i:1;s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"20";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-18 17:09:15";s:17:"status_changed_on";s:19:"2014-09-18 17:09:33";s:9:"played_on";s:19:"2014-09-18 17:09:33";s:5:"place";s:1:"0";s:6:"result";s:2:"25";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-18 17:09:15";}', 0, '2014-09-18 11:39:33'),
(66, 'N', 'teacher_absent', 7, 3, 7, 'a:4:{s:6:"action";s:15:"confirm_absence";s:7:"clan_id";s:1:"2";s:12:"from_message";s:8:"Personal";s:4:"date";s:10:"2014-09-25";}', 1, '2014-09-22 07:09:14'),
(67, 'N', 'holiday_upapproved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"U";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 1, '2014-09-22 07:10:38'),
(68, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 0, '2014-09-22 07:15:52'),
(69, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 0, '2014-09-22 07:20:27'),
(70, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 0, '2014-09-22 07:29:50'),
(71, 'N', 'challenge_made', 25, 13, 4, 'a:14:{s:2:"id";i:4;s:4:"type";b:0;s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"13";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 11:28:41";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 0, '2014-09-25 05:58:41'),
(72, 'N', 'challenge_made', 25, 13, 5, 'a:14:{s:2:"id";i:5;s:4:"type";s:1:"B";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"13";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 11:29:54";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 0, '2014-09-25 05:59:54'),
(73, 'N', 'challenge_made', 25, 14, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-25 06:52:53'),
(74, 'N', 'challenge_accepted', 14, 25, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";s:19:"2014-09-25 12:23:18";s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";s:1:"0";s:6:"result";s:2:"25";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-25 12:22:53";}', 0, '2014-09-25 06:53:18'),
(75, 'N', 'challenge_winner', 14, 25, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";s:19:"2014-09-25 12:23:18";s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";s:1:"0";s:6:"result";s:2:"14";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-25 12:22:53";}', 0, '2014-09-25 06:55:08'),
(82, 'N', 'batch_request', 3, 4, 1, 'a:3:{s:10:"student_id";s:2:"14";s:8:"batch_id";s:2:"10";s:11:"description";s:6:"sdsada";}', 1, '2014-09-27 12:28:31'),
(90, 'N', 'batch_request_approved', 4, 3, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"3";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"14";s:8:"approved";s:1:"A";}', 0, '2014-09-27 12:59:17'),
(91, 'N', 'batch_request_unapproved', 4, 3, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"3";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"14";s:10:"unapproved";s:1:"U";}', 0, '2014-09-27 13:00:09'),
(92, 'N', 'batch_request_approved', 3, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"37";s:8:"approved";s:1:"A";}', 1, '2014-09-29 04:54:27'),
(93, 'N', 'batch_request_unapproved', 1, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"11";s:10:"student_id";s:2:"37";s:10:"unapproved";s:1:"U";}', 0, '2014-09-29 05:37:50'),
(94, 'N', 'batch_request_unapproved', 1, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"11";s:10:"student_id";s:2:"37";s:10:"unapproved";s:1:"U";}', 0, '2014-09-29 05:40:15'),
(95, 'N', 'event_invitation', 1, 3, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:08'),
(96, 'N', 'event_invitation', 1, 4, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:20'),
(97, 'N', 'event_invitation', 1, 5, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:26'),
(98, 'N', 'event_invitation', 1, 6, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:32'),
(99, 'N', 'event_invitation', 1, 7, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:38'),
(100, 'N', 'event_invitation', 1, 8, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:44'),
(101, 'N', 'event_invitation', 1, 13, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:42:55'),
(102, 'N', 'event_invitation', 1, 14, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:01'),
(103, 'N', 'event_invitation', 1, 15, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:11'),
(104, 'N', 'event_invitation', 1, 16, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:22'),
(105, 'N', 'event_invitation', 1, 17, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:28'),
(106, 'N', 'event_invitation', 1, 20, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:44'),
(107, 'N', 'event_invitation', 1, 21, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:43:54'),
(108, 'N', 'event_invitation', 1, 23, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:00'),
(109, 'N', 'event_invitation', 1, 25, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:06'),
(110, 'N', 'event_invitation', 1, 27, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:16'),
(111, 'N', 'event_invitation', 1, 28, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:27'),
(112, 'N', 'event_invitation', 1, 31, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:33'),
(113, 'N', 'event_invitation', 1, 33, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:39'),
(114, 'N', 'event_invitation', 1, 34, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:44'),
(115, 'N', 'event_invitation', 1, 36, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:44:55'),
(116, 'N', 'event_invitation', 1, 37, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 0, '2014-09-29 06:45:01'),
(117, 'N', 'event_invitation', 3, 12, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 0, '2014-09-29 09:37:46'),
(118, 'N', 'event_invitation', 3, 13, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 0, '2014-09-29 09:37:52'),
(119, 'N', 'event_invitation', 3, 36, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 0, '2014-09-29 09:38:07'),
(120, 'N', 'event_invitation', 3, 37, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 0, '2014-09-29 09:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(11) NOT NULL,
  `en_perm_name` varchar(65) NOT NULL,
  `it_perm_name` varchar(65) DEFAULT NULL,
  `controller` varchar(65) NOT NULL,
  `method` varchar(65) NOT NULL,
  `is_menu` int(1) NOT NULL DEFAULT '0',
  `en_menu_title` varchar(30) DEFAULT NULL,
  `it_menu_title` varchar(30) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `en_perm_name`, `it_perm_name`, `controller`, `method`, `is_menu`, `en_menu_title`, `it_menu_title`, `parent_id`, `user_id`, `timestamp`) VALUES
(1, 'Country View', 'Aggiungi vista', 'countries', 'viewCountry', 1, 'Country', 'Country', 0, 1, '2014-07-17 07:08:31'),
(2, 'Country Add', 'Aggiungi paese', 'countries', 'addCountry', 1, 'Add', 'Add', 1, 1, '2014-07-17 07:08:42'),
(4, 'Country Edit', 'Aggiungi modifica', 'countries', 'editCountry', 1, 'Edit', 'Edit', 1, 1, '2014-07-17 07:09:36'),
(5, 'Country Delete', 'Aggiungi cancellare', 'countries', 'deleteCountry', 1, 'Delete', 'Delete', 1, 1, '2014-07-17 07:09:49'),
(6, 'State View', 'Stato Vista', 'states', 'viewStates', 1, 'State', 'State', 0, 1, '2014-07-17 07:22:00'),
(7, 'State Add', 'Stato paese', 'states', 'addStates', 1, 'Add', 'Add', 6, 1, '2014-07-17 07:22:32'),
(8, 'State Edit', 'Stato modifica', 'states', 'editStates', 1, 'Edit', 'Edit', 6, 1, '2014-07-17 07:22:50'),
(9, 'State Delete', 'Stato cancellare', 'states', 'deleteStates', 1, 'Delete', 'Delete', 6, 1, '2014-07-17 07:23:45'),
(10, 'City View', 'Città  vista', 'cities', 'viewCity', 1, 'City', 'City', 0, 1, '2014-07-17 12:37:29'),
(11, 'City Add', 'Città paese', 'cities', 'addCity', 0, NULL, NULL, 0, 1, '2014-07-17 12:38:20'),
(13, 'City Edit', 'City Edit', 'cities', 'editCity', 0, NULL, NULL, 0, 1, '2014-07-17 12:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `en_role_name` varchar(65) NOT NULL,
  `it_role_name` varchar(65) DEFAULT NULL,
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `permission` longtext,
  `is_delete` enum('1','0') NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `en_role_name`, `it_role_name`, `is_manager`, `permission`, `is_delete`, `user_id`, `timestamp`) VALUES
(1, 'Super Admin', 'Super Amministratore', 0, NULL, '0', 0, '2014-07-17 07:04:55'),
(2, 'Admin', 'Admin', 0, 'a:17:{s:5:"roles";a:2:{i:0;s:8:"viewRole";i:1;s:8:"editRole";}s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:9:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";i:8;s:14:"changeClanDate";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:6:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";i:4;s:19:"sendEventInvitation";i:5;s:19:"takeEventAttendance";}s:7:"batches";a:3:{i:0;s:9:"viewBatch";i:1;s:9:"editBatch";i:2;s:11:"deleteBatch";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";}s:13:"group_message";a:6:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 1, 'a:9:{s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:14:"changeClanDate";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:22'),
(4, 'Dean', 'Preside', 0, 'a:10:{s:5:"roles";a:1:{i:0;s:8:"viewRole";}s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 1, 'a:9:{s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:5:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";i:4;s:24:"changeStatusTrialStudent";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 0, 'a:5:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}}', '0', 1, '2014-07-17 10:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
`id` int(11) NOT NULL,
  `academy_id` int(11) NOT NULL,
  `dean_id` varchar(11) NOT NULL,
  `en_school_name` varchar(65) NOT NULL,
  `it_school_name` varchar(65) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` int(6) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_1` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `email` varchar(65) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `academy_id`, `dean_id`, `en_school_name`, `it_school_name`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, 1, '3', 'Poppey', 'Poppey', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 10:49:30'),
(2, 2, '3', 'Dexter', 'Dexter', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 11:23:56'),
(3, 1, '4', 'Salior', 'Salior', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:43:41'),
(4, 2, '4', 'Laboratory', 'Laboratory', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:44:24'),
(5, 3, '4', 'Power Girls', 'Power Girls', 'Baroda', 390016, 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-31 08:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `score_histories`
--

CREATE TABLE IF NOT EXISTS `score_histories` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `oper` enum('M','D') NOT NULL DEFAULT 'M',
  `score_type` enum('xpr','war','sty') NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `score_date` date NOT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `score_histories`
--

INSERT INTO `score_histories` (`id`, `student_id`, `oper`, `score_type`, `score`, `score_date`, `description`, `user_id`, `timestamp`) VALUES
(1, 14, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(4, 15, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(7, 16, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(10, 17, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(13, 20, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(16, 13, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(19, 21, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(22, 25, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(25, 27, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(28, 31, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(31, 33, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(34, 34, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(37, 23, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(40, 36, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(43, 36, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(46, 25, 'M', 'xpr', 1000, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(49, 37, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:15'),
(52, 37, 'M', 'xpr', 150, '2014-09-26', 'Testing XPR', 1, '2014-09-26 09:48:30'),
(53, 37, 'M', 'war', 250, '2014-09-26', 'Testing WAR', 1, '2014-09-26 09:48:30'),
(54, 37, 'D', 'sty', 50, '2014-09-26', 'Testing STY', 1, '2014-09-26 09:48:30'),
(55, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(56, 14, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(57, 15, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(58, 16, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(59, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(60, 20, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(61, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(62, 23, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(63, 25, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(64, 27, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(66, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(67, 14, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(68, 15, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(69, 16, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(70, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(71, 20, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(72, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(73, 23, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(74, 25, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(75, 27, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(77, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(78, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(79, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(80, 37, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(81, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(82, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(83, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(84, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:56:19'),
(85, 37, 'M', 'sty', 100, '2014-09-26', 'Testing STY', 1, '2014-09-26 09:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
`id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Gujarat', 'Gujarat', 1, '2014-07-17 07:12:28'),
(2, 1, 'Mumbai', '', 1, '2014-07-17 07:12:55'),
(3, 2, 'xyz', 'xyz', 2, '2014-07-31 04:21:33'),
(4, 2, 'Milan', NULL, 2, '2014-08-01 08:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `systemsettings`
--

CREATE TABLE IF NOT EXISTS `systemsettings` (
`id` int(11) NOT NULL,
  `type` enum('general','mail') NOT NULL DEFAULT 'general',
  `sequence` int(3) NOT NULL,
  `sys_key` varchar(255) NOT NULL,
  `sys_value` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `systemsettings`
--

INSERT INTO `systemsettings` (`id`, `type`, `sequence`, `sys_key`, `sys_value`, `user_id`, `timestamp`) VALUES
(1, 'general', 1, 'app_name', 'My Ludosport', 1, '2014-08-07 03:30:31'),
(2, 'general', 2, 'login_logo', '0423827148634df9ea8f50f9942d9b9d.png', 1, '2014-08-07 03:30:31'),
(3, 'general', 3, 'main_logo', 'c9556fdcaba5327d7973f6f86974a69f.png', 1, '2014-08-07 03:31:10'),
(4, 'general', 4, 'timezone', 'UP55', 1, '2014-08-07 03:31:10'),
(5, 'general', 6, 'default_role', '6', 1, '2014-08-07 03:31:10'),
(6, 'general', 5, 'notification_timer', '10000', 1, '2014-08-07 03:31:10'),
(7, 'mail', 1, 'protocol', 'smtp', 1, '2014-08-07 03:31:10'),
(8, 'mail', 2, 'smtp_host', 'ssl://smtp.gmail.com', 1, '2014-08-07 03:31:10'),
(9, 'mail', 4, 'smtp_user', 'soyab@blackidsolutions.com', 1, '2014-08-07 03:31:10'),
(10, 'mail', 5, 'smtp_pass', 'soyabsoyab', 1, '2014-08-07 03:31:10'),
(11, 'general', 8, 'data_table_length', '10,15,20,25,50,75,100', 1, '2014-08-07 03:31:10'),
(12, 'mail', 3, 'smtp_port', '465', 1, '2014-08-07 03:31:10'),
(14, 'general', 7, 'reset_app_day_month', '31-12', 2, '2014-09-03 04:14:42'),
(15, 'general', 8, 'basic_level_under_16', '3', 2, '2014-09-08 12:09:30'),
(16, 'general', 9, 'basic_level_above_16', '6', 2, '2014-09-08 12:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendances`
--

CREATE TABLE IF NOT EXISTS `teacher_attendances` (
`id` int(11) NOT NULL,
  `clan_date` date NOT NULL,
  `clan_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '1',
  `recovery_teacher` int(11) NOT NULL,
  `from_message` varchar(255) DEFAULT NULL,
  `to_message` varchar(255) DEFAULT NULL,
  `status` enum('A','P','U') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `teacher_attendances`
--

INSERT INTO `teacher_attendances` (`id`, `clan_date`, `clan_id`, `teacher_id`, `attendance`, `recovery_teacher`, `from_message`, `to_message`, `status`, `user_id`, `timestamp`) VALUES
(1, '2014-09-23', 1, 5, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:56'),
(2, '2014-09-23', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:56'),
(3, '2014-09-23', 4, 8, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:56'),
(4, '2014-09-24', 1, 5, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(5, '2014-09-24', 2, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(6, '2014-09-24', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(7, '2014-09-25', 2, 7, 0, 0, 'Personal', 'Sorry', 'A', 7, '2014-09-22 07:04:57'),
(8, '2014-09-25', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(9, '2014-09-26', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(10, '2014-09-26', 5, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(11, '2014-09-27', 5, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(12, '2014-09-28', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(13, '2014-09-29', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-22 07:04:57'),
(14, '2014-09-30', 1, 5, 1, 0, NULL, NULL, 'P', 0, '2014-09-23 05:33:38'),
(15, '2014-09-30', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-23 05:33:38'),
(16, '2014-09-30', 4, 8, 1, 0, NULL, NULL, 'P', 0, '2014-09-23 05:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
`id` int(11) NOT NULL,
  `student_master_id` int(11) NOT NULL,
  `clan_id` varchar(11) NOT NULL DEFAULT '0',
  `degree_id` int(11) NOT NULL DEFAULT '0',
  `honour_id` int(11) NOT NULL DEFAULT '0',
  `master_id` int(11) NOT NULL DEFAULT '0',
  `qualification_id` int(11) NOT NULL DEFAULT '0',
  `security_id` int(11) NOT NULL DEFAULT '0',
  `color_of_blade` int(11) NOT NULL DEFAULT '1',
  `xpr` int(11) NOT NULL DEFAULT '0',
  `war` int(11) NOT NULL DEFAULT '0',
  `sty` int(11) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL DEFAULT '0',
  `first_lesson_date` date DEFAULT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `palce_of_birth` text,
  `zip_code` bigint(11) DEFAULT NULL,
  `tax_code` bigint(11) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `status` enum('A','P','U','P2') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `degree_id`, `honour_id`, `master_id`, `qualification_id`, `security_id`, `color_of_blade`, `xpr`, `war`, `sty`, `total_score`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(1, 14, '3', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-09-25', 2, NULL, NULL, NULL, NULL, 'A', 1, '2014-08-04 00:09:02'),
(2, 15, '2', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(3, 16, '2', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(4, 17, '5', 3, 0, 0, 0, 0, 6, 300, 40, 0, 340, '2014-08-11', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-05 00:09:27'),
(5, 20, '6', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-28', 2, '', 390016, 963852, 'B-ve ', 'A', 20, '2009-08-21 01:37:12'),
(6, 13, '5', 3, 0, 0, 0, 0, 6, 300, 32, 0, 332, '2014-08-30', 3, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-25 05:27:01'),
(7, 21, '6', 3, 0, 0, 0, 0, 6, 300, 32, 0, 332, '2014-08-28', 3, NULL, NULL, NULL, NULL, 'A', 21, '2014-08-25 05:52:04'),
(8, 25, '6', 3, 0, 0, 0, 0, 6, 1300, 16, 0, 1316, '2014-09-25', 3, NULL, NULL, NULL, NULL, 'A', 1, '2010-08-25 05:52:04'),
(9, 27, '4', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-09-09', 8, 'roma', 0, 0, 'ah+', 'A', 27, '2014-09-04 15:25:53'),
(10, 28, '4', 3, 0, 0, 0, 0, 6, 0, 0, 0, 0, '2014-09-16', 0, NULL, NULL, NULL, NULL, 'P', 28, '2014-09-05 08:45:20'),
(11, 31, '1', 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-16', 8, NULL, NULL, NULL, NULL, 'A', 31, '2014-09-05 11:33:36'),
(12, 33, '4', 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-30', 8, NULL, NULL, NULL, NULL, 'A', 33, '2014-09-05 13:05:45'),
(13, 34, '1', 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-23', 8, NULL, NULL, NULL, NULL, 'A', 34, '2014-09-05 13:18:57'),
(14, 23, '6', 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, 'Milan', 20162, 610093, 'O +ve', 'A', 2, '2014-08-04 00:09:02'),
(15, 36, '5', 6, 0, 0, 0, 0, 1, 600, 0, 0, 600, '2014-09-25', 0, 'Vadodara', 390016, 963852, 'B -ve', 'P2', 36, '2014-09-25 05:04:29'),
(16, 37, '2', 3, 10, 0, 0, 0, 1, 450, 258, 50, 758, '2014-09-25', 0, 'Vadodara', 390016, 610093, 'B -ve', 'A', 1, '2014-09-25 09:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `role_id` varchar(25) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `date_of_birth` bigint(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_of_residence` varchar(255) DEFAULT NULL,
  `permission` longtext,
  `avtar` varchar(255) NOT NULL DEFAULT 'no_avatar.jpg',
  `address` varchar(255) DEFAULT NULL,
  `phone_no_1` varchar(20) DEFAULT NULL,
  `phone_no_2` varchar(20) DEFAULT NULL,
  `quote` text,
  `about_me` text,
  `email_privacy` text,
  `status` enum('A','D','P','U') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `city_of_residence`, `permission`, `avtar`, `address`, `phone_no_1`, `phone_no_2`, `quote`, `about_me`, `email_privacy`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Super Admin', 'User', 'superadmin@yopmail.com', 653682600, 1, 1, 1, 'Temp', NULL, '94048c9c2c04baf3b871be491ef8ded2.jpg', 'Gorwa,Baroda', '9876543210', '1234567890', 'Only one thing is impossible for God: To find any sense in any copyright law on the planet', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel sapien sapien. Duis dictum leo dui, nec blandit nisl imperdiet ut. Donec quis condimentum libero. In volutpat urna id feugiat porta. Suspendisse a sem augue. Curabitur sodales, odio ut tempor scelerisque, eros tellus lacinia elit, id euismod felis nulla id erat. Quisque porttitor velit in sollicitudin eleifend.</span></p><p><span>Etiam consequat nulla nec sapien blandit ullamcorper id at nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce pellentesque elit quis lorem vulputate ornare. Proin turpis metus, convallis eget lectus at, volutpat molestie augue. Curabitur at ligula viverra ante rutrum euismod. Duis pulvinar rhoncus facilisis. Curabitur lobortis, ante at semper finibus, leo turpis sollicitudin libero, a congue magna neque vitae enim. Nunc vestibulum aliquam lacus, a tempus lorem vehicula et. Vivamus at arcu suscipit, cursus turpis et, egestas elit. Maecenas tincidunt, risus ac scelerisque consequat, ex sapien euismod turpis, egestas hendrerit eros augue at justo. Praesent scelerisque mi quis nulla feugiat scelerisque vel sit amet leo. Nulla efficitur mattis nisi, vitae dictum tortor placerat in. Quisque tempor, ex nec volutpat scelerisque, lorem urna luctus lectus, at posuere velit felis sit amet arcu.</span></p>', NULL, 'A', 1, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Carmelo', 'Samperi', 'ranasoyab@yopmail.com', 316809000, 5, 4, 2, 'Temp', NULL, '1adfa22db058e6383b4365cb7906590f.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(3, '1,2,3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rector', '1', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, NULL, '063fd00a3c30c83404faf36e32b2dada.jpg', NULL, NULL, NULL, NULL, NULL, 'a:14:{s:30:"user_registration_notification";s:1:"1";s:20:"trial_lesson_request";s:1:"0";s:21:"trial_lesson_accepted";s:1:"1";s:21:"trial_lesson_rejected";s:1:"0";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"0";s:14:"teacher_absent";s:1:"1";s:14:"student_absent";s:1:"0";s:16:"recovery_student";s:1:"1";s:36:"teacher_recovery_student_for_student";s:1:"0";s:36:"teacher_recovery_student_for_teacher";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:16:"holiday_approved";s:1:"1";s:18:"holiday_upapproved";s:1:"0";}', 'A', 3, '2014-07-17 07:28:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', '1', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-07-17 07:28:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', '1', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, '44999132c325dd575171618f58a0712a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 5, '2014-07-21 10:11:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', '2', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(12, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'c05b3802dd788813231e79ce67a5513d.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 3, '2014-07-31 10:45:54'),
(13, '6', 'martin', '202cb962ac59075b964b07152d234b70', 'Martin', 'Lusi', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, '0b1b838debca3f07a19dfb93846a38a2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-01 05:20:27'),
(14, '6', 'student_1', '202cb962ac59075b964b07152d234b70', 'A Student', 'First', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, 'Vadodara', NULL, '6c922946889fe1aa9ad85ba33d1f43eb.jpg', 'Baroda', '91987654321', '91987654321', 'Victorious warriors win first and then go to war, while defeated warriors go to war first and then seek to win.', '<p><br></p>', 'a:6:{s:16:"event_invitation";s:1:"0";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"1";s:18:"challenge_rejected";s:1:"1";s:16:"challenge_winner";s:1:"0";}', 'A', 1, '2014-08-04 05:37:32'),
(15, '6', 'student_2', '202cb962ac59075b964b07152d234b70', 'C Student', 'Second', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:19'),
(16, '6', 'student_3', '202cb962ac59075b964b07152d234b70', 'D Student', 'Third', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:56'),
(17, '6', 'student_4', '202cb962ac59075b964b07152d234b70', 'B Student', 'Fourth', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:38:37'),
(19, '5', 'teacher_4', '202cb962ac59075b964b07152d234b70', 'Teacher', '4', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(20, '6', 'denim', '202cb962ac59075b964b07152d234b70', 'Denim', 'Jeans', 'ranasoyab@yopmail.com', 1218479400, 1, 1, 1, 'Milan', NULL, 'fe86fb703363a623405d48b65408763a.jpg', 'Baroda', '91987654321', '91987654321', 'Life is to be lived, not controlled; and humanity is won by continuing to play in face of certain defeat.', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at mattis tortor. Maecenas finibus justo quis augue posuere suscipit. Phasellus ultrices congue libero id pulvinar. Morbi ornare orci ligula, a scelerisque nibh ullamcorper ac. Vestibulum suscipit metus et interdum pharetra. Sed mollis, dui fringilla varius vestibulum, enim ligula consectetur neque, quis fringilla leo purus non ipsum. Curabitur non lectus et lorem lacinia accumsan a in augue. In fringilla, nisi at dapibus convallis, nulla magna varius lacus, sed vestibulum nisi leo vel nulla. Sed pulvinar aliquam sem sed aliquam. Donec sed pulvinar urna. Donec ut fringilla orci. Ut ut pretium massa, eget hendrerit felis. Etiam efficitur, velit eget ultricies pulvinar, sem velit dignissim neque, sit amet suscipit felis massa cursus orci. Integer semper fringilla tincidunt. Praesent quis bibendum augue.</span><br></p>', 'a:7:{s:36:"teacher_recovery_student_for_student";s:1:"1";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"0";s:18:"challenge_rejected";s:1:"0";s:16:"challenge_winner";s:1:"1";}', 'A', 20, '2014-08-21 06:48:58'),
(21, '6', 'levis', '202cb962ac59075b964b07152d234b70', 'levis', 'Jeans', 'ranasoyab@yopmail.com', 706127400, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-25 11:20:58'),
(23, '6', 'iqbal', '202cb962ac59075b964b07152d234b70', 'Iqbal', 'Hussain', 'iqbal@blackid.com', 318018600, 1, 1, 1, 'Milan', NULL, 'no_avatar.jpg', 'temp temp temp', '91987654321', '91987654321', 'All my life, my heart has yearned for a thing I cannot name.', '<p><br></p>', NULL, 'A', 23, '2014-08-27 10:20:39'),
(25, '5,6', 'karl', '202cb962ac59075b964b07152d234b70', 'Karl', 'Marks', 'ranasoyab@yopmail.com', 421871400, 1, 1, 1, 'Vadodara', NULL, 'a605553a927ca37136936eaf13836cae.jpg', 'Baroda', '91987654321', '91987654321', 'Let us always meet each other with smile, as the smile is the beginning of love.', '<p><br></p>', 'a:7:{s:36:"teacher_recovery_student_for_student";s:1:"1";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"0";s:18:"challenge_rejected";s:1:"0";s:16:"challenge_winner";s:1:"1";}', 'A', 1, '2014-08-28 11:48:19'),
(27, '6', 'Fede', '202cb962ac59075b964b07152d234b70', 'Federico', 'De Medici', 'ranasoyab@yopmail.com', 752565600, 5, 4, 2, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-09-04 15:20:52'),
(28, '6', '123', '202cb962ac59075b964b07152d234b70', 'Carmelo2', 'Samperi1', 'ranasoyab@yopmail.com', 635061600, 5, 4, 2, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 28, '2014-09-05 07:18:30'),
(30, '6', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Pietro', 'Rossi', 'ranasoyab@yopmail.com', 1239685200, 5, 4, 2, 'Pietro', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 11:04:54'),
(31, '6', 'eu', '202cb962ac59075b964b07152d234b70', 'Eugenio', 'Di Fraia', 'ranasoyab@yopmail.com', 317973600, 1, 1, 1, 'Cassina de Pecchi', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 11:32:37'),
(33, '6', 'bart', '202cb962ac59075b964b07152d234b70', 'Bart', 'Simpson', 'ranasoyab@yopmail.com', 633938400, 5, 4, 2, 'e', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 33, '2014-09-05 13:00:47'),
(34, '6', 'merge', '202cb962ac59075b964b07152d234b70', 'Merge', 'Simpson', 'ranasoyab@yopmail.com', 633852000, 1, 1, 1, 's', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 13:17:44'),
(36, '6', 'spyker', '202cb962ac59075b964b07152d234b70', 'Spyker', 'Jeans', 'soyab@yopmail.com', 525724200, 1, 1, 1, 'Vadodara', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-22 06:02:11'),
(37, '6', 'ranasoyab', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'ranasoyab@yopmail.com', 653596200, 1, 1, 1, 'Vadodara', NULL, '5865aa782c8c4ee571acac7af45b9d94.jpg', 'Baroda', '9876543210', '91987654321', 'It is better to be hated for what you are than to be loved for what you are not.', '<p ><span >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus accumsan non lorem et bibendum. Ut imperdiet sed lectus vitae euismod. Nulla lobortis hendrerit pharetra. Vivamus vitae egestas velit. Vivamus vitae sodales turpis. In hac habitasse platea dictumst. Cras volutpat mi porta, sollicitudin mauris in, volutpat diam. Ut vel velit molestie, auctor mi sed, posuere purus. Donec malesuada mi urna, at iaculis nisi venenatis ac. Sed et rhoncus neque. Morbi nisi velit, mattis in metus nec, efficitur dignissim ex. Vestibulum bibendum ligula scelerisque orci fermentum egestas. Morbi non enim purus.</span></p><p ><span >Duis urna turpis, porttitor sodales felis in, interdum porttitor nunc. Vivamus dictum accumsan mauris, ac gravida ligula venenatis sit amet. Quisque quam leo, auctor et tortor at, auctor aliquam lorem. In et lorem sit amet lectus hendrerit mattis ut eu arcu. Integer interdum luctus elit at elementum. Suspendisse consequat leo nec diam lobortis, sed mollis lectus bibendum. Integer et finibus ex. Vivamus maximus consectetur eros ut ultricies. Ut convallis nibh a erat vulputate, sed rutrum libero ullamcorper. Suspendisse et metus in odio tincidunt maximus non quis lacus. Morbi bibendum feugiat quam, et posuere orci malesuada eu.</span></p>', NULL, 'A', 1, '2014-09-25 09:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_batches_histories`
--

CREATE TABLE IF NOT EXISTS `user_batches_histories` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_type` enum('D','H','M','Q','S') NOT NULL,
  `batch_id` int(11) NOT NULL,
  `assign_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user_batches_histories`
--

INSERT INTO `user_batches_histories` (`id`, `student_id`, `batch_type`, `batch_id`, `assign_date`, `user_id`, `timestamp`) VALUES
(1, 14, 'D', 3, '2013-08-13', 1, '2014-09-19 12:10:21'),
(2, 15, 'D', 3, '2014-08-04', 0, '2014-09-19 12:10:21'),
(3, 16, 'D', 3, '2014-08-04', 0, '2014-09-19 12:10:21'),
(4, 17, 'D', 3, '2014-08-05', 0, '2014-09-19 12:10:21'),
(5, 20, 'D', 3, '2009-08-21', 0, '2014-09-19 12:10:21'),
(6, 13, 'D', 3, '2014-08-25', 0, '2014-09-19 12:10:21'),
(7, 21, 'D', 3, '2014-08-25', 0, '2014-09-19 12:10:21'),
(8, 25, 'D', 3, '2010-08-25', 0, '2014-09-19 12:10:21'),
(9, 27, 'D', 3, '2014-09-04', 0, '2014-09-19 12:10:21'),
(10, 31, 'D', 3, '2014-09-05', 0, '2014-09-19 12:10:21'),
(11, 33, 'D', 3, '2014-09-05', 0, '2014-09-19 12:10:21'),
(12, 34, 'D', 3, '2014-09-05', 0, '2014-09-19 12:10:21'),
(13, 23, 'D', 3, '2014-08-04', 0, '2014-09-19 12:10:21'),
(14, 36, 'D', 3, '2014-09-22', 2, '2014-09-22 06:02:11'),
(15, 36, 'D', 3, '2014-09-22', 2, '2014-09-22 06:03:45'),
(16, 25, 'D', 6, '2010-05-01', 0, '2014-09-19 12:10:21'),
(19, 37, 'H', 10, '2014-09-25', 2, '2014-09-25 09:46:53'),
(23, 37, 'D', 3, '2014-01-31', 1, '2014-09-25 12:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_recovers`
--
ALTER TABLE `attendance_recovers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batchrequests`
--
ALTER TABLE `batchrequests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clandates`
--
ALTER TABLE `clandates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clans`
--
ALTER TABLE `clans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventattendances`
--
ALTER TABLE `eventattendances`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventcategories`
--
ALTER TABLE `eventcategories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventinvitations`
--
ALTER TABLE `eventinvitations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`), ADD KEY `eventcategory_id` (`eventcategory_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailboxes`
--
ALTER TABLE `mailboxes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messageattachments`
--
ALTER TABLE `messageattachments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messagestatus`
--
ALTER TABLE `messagestatus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score_histories`
--
ALTER TABLE `score_histories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemsettings`
--
ALTER TABLE `systemsettings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_attendances`
--
ALTER TABLE `teacher_attendances`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_batches_histories`
--
ALTER TABLE `user_batches_histories`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academies`
--
ALTER TABLE `academies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `attendance_recovers`
--
ALTER TABLE `attendance_recovers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `batchrequests`
--
ALTER TABLE `batchrequests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clandates`
--
ALTER TABLE `clandates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `eventattendances`
--
ALTER TABLE `eventattendances`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `eventinvitations`
--
ALTER TABLE `eventinvitations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `mailboxes`
--
ALTER TABLE `mailboxes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `messageattachments`
--
ALTER TABLE `messageattachments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messagestatus`
--
ALTER TABLE `messagestatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `score_histories`
--
ALTER TABLE `score_histories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `systemsettings`
--
ALTER TABLE `systemsettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `teacher_attendances`
--
ALTER TABLE `teacher_attendances`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `user_batches_histories`
--
ALTER TABLE `user_batches_histories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
