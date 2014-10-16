-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2014 at 06:29 PM
-- Server version: 5.5.38-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3

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
(2, '6', 'Dexter Laboratory', 'Dexter Laboratory', 'ac', 'Soyab', 'Rana', 'DL', 'Temparory', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 10000.00, 3000.00, 1, '2014-07-25 11:22:54'),
(3, '5', 'Power Puff Girls', 'Power Puff Girls', 'ac', 'John', 'Candy', 'Power Puff Girls', 'Maecenas nec leo nec lacus posuere ultricies. Mauris fermentum porta nulla. Vestibulum dictum, nulla vitae gravida sollicitudin, mauris justo bibendum velit, in varius tortor ipsum et nulla. Phasellus a convallis magna. Suspendisse potenti. In hac habitas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nEtiam finibus purus vel augue consectetur, vitae viverra mauris egestas.\r\nInteger blandit elit vitae risus fringilla scelerisque.\r\nCurabitur sollicitudin sem non nibh mattis, eu blandit risus ultricies.', '123456', 4, 2, 1, '1234567890', '91987654321', 'ppg@yopmail.com', 100.00, 50.00, 2, '2014-07-31 04:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
`id` int(11) NOT NULL,
  `type` enum('single','group') NOT NULL DEFAULT 'single',
  `group_id` varchar(25) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL,
  `to_id` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `announcement` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `type`, `group_id`, `from_id`, `to_id`, `subject`, `announcement`, `timestamp`) VALUES
(1, 'single', '0', 1, '37', 'Testing', '<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at facilisis ipsum, vel tempus turpis. Nam sit amet magna non lectus commodo pulvinar. Vestibulum faucibus arcu in sodales finibus. Suspendisse cursus sapien ut fringilla mattis. Maecenas ut justo metus. Vivamus tincidunt id ligula sed elementum. Aliquam lorem tellus, placerat quis elementum eu, efficitur id erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur maximus eros ut est eleifend, nec porttitor lacus lacinia. Nam eu vestibulum libero, quis rutrum tortor. Proin nisi urna, lobortis non purus et, elementum congue quam. Ut iaculis dui at est finibus varius non maximus nisl. Quisque sit amet condimentum nunc, sit amet condimentum lectus. Nam euismod neque a gravida sagittis.</p><p >Integer vestibulum quis magna finibus pellentesque. Nam eget feugiat lacus. Quisque quis facilisis sapien. Aliquam at diam leo. Curabitur varius eleifend erat, vitae malesuada ante tempor vitae. Etiam eu mauris in ipsum faucibus molestie id quis nibh. Vestibulum varius a neque ut gravida. Donec quis dui ac libero semper imperdiet. Etiam molestie mauris sollicitudin, vulputate nisi scelerisque, fringilla mauris. Mauris diam neque, mattis vitae commodo ac, rhoncus aliquet mauris.</p>', '2014-10-01 10:13:43'),
(4, 'single', '0', 1, '37', 'Testing', '<p>Hello.</p>', '2014-10-01 10:31:15'),
(5, 'single', '0', 1, '37', 'Testing', '<p><span >dsadas</span></p>', '2014-10-08 08:38:55'),
(6, 'single', '0', 1, '37', 'Testing', '<ul><li><span style="font-weight: bold; background-color: yellow; text-decoration: line-through;">ADSADAS </span></li><li><span style="text-decoration: underline; font-style: italic;">DASasdasdsa</span></li></ul>', '2014-10-08 09:12:10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `clan_date`, `student_id`, `attendance`, `user_id`, `timestamp`) VALUES
(1, '2014-09-23', 31, 1, 0, '2014-09-22 07:04:57'),
(2, '2014-09-23', 34, 1, 0, '2014-09-22 07:04:57'),
(3, '2014-09-23', 14, 1, 0, '2014-09-22 07:04:57'),
(4, '2014-09-23', 27, 1, 0, '2014-09-22 07:04:57'),
(6, '2014-09-24', 31, 1, 0, '2014-09-22 07:04:57'),
(7, '2014-09-24', 34, 1, 0, '2014-09-22 07:04:57'),
(8, '2014-09-24', 15, 1, 0, '2014-09-22 07:04:57'),
(9, '2014-09-24', 16, 1, 0, '2014-09-22 07:04:57'),
(10, '2014-09-24', 20, 1, 0, '2014-09-22 07:04:57'),
(11, '2014-09-24', 21, 1, 0, '2014-09-22 07:04:57'),
(12, '2014-09-24', 25, 1, 0, '2014-09-22 07:04:57'),
(13, '2014-09-24', 23, 1, 0, '2014-09-22 07:04:57'),
(14, '2014-09-25', 15, 0, 1, '2014-09-22 07:04:57'),
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
(36, '2014-10-01', 31, 1, 0, '2014-09-30 09:52:48'),
(37, '2014-10-01', 34, 1, 0, '2014-09-30 09:52:48'),
(38, '2014-10-01', 15, 0, 0, '2014-09-30 09:52:48'),
(39, '2014-10-01', 16, 1, 0, '2014-09-30 09:52:49'),
(40, '2014-10-01', 37, 1, 0, '2014-09-30 09:52:49'),
(41, '2014-10-01', 20, 1, 0, '2014-09-30 09:52:49'),
(42, '2014-10-01', 21, 1, 0, '2014-09-30 09:52:49'),
(43, '2014-10-01', 25, 1, 0, '2014-09-30 09:52:49'),
(44, '2014-10-01', 23, 1, 0, '2014-09-30 09:52:49'),
(45, '2014-10-02', 15, 1, 0, '2014-09-30 09:52:49'),
(46, '2014-10-02', 16, 1, 0, '2014-09-30 09:52:49'),
(47, '2014-10-02', 37, 1, 0, '2014-09-30 09:52:49'),
(48, '2014-10-02', 14, 1, 0, '2014-09-30 09:52:49'),
(49, '2014-10-03', 14, 1, 0, '2014-09-30 09:52:49'),
(50, '2014-10-03', 17, 1, 0, '2014-09-30 09:52:49'),
(51, '2014-10-03', 13, 1, 0, '2014-09-30 09:52:49'),
(52, '2014-10-04', 17, 1, 0, '2014-09-30 09:52:49'),
(53, '2014-10-04', 13, 1, 0, '2014-09-30 09:52:49'),
(54, '2014-10-05', 20, 1, 0, '2014-09-30 09:52:49'),
(55, '2014-10-05', 21, 1, 0, '2014-09-30 09:52:49'),
(56, '2014-10-05', 25, 1, 0, '2014-09-30 09:52:49'),
(57, '2014-10-05', 23, 1, 0, '2014-09-30 09:52:49'),
(58, '2014-10-06', 20, 1, 0, '2014-09-30 09:52:49'),
(59, '2014-10-06', 21, 1, 0, '2014-09-30 09:52:49'),
(60, '2014-10-06', 25, 1, 0, '2014-09-30 09:52:49'),
(61, '2014-10-06', 23, 1, 0, '2014-09-30 09:52:49'),
(62, '2014-10-07', 31, 1, 0, '2014-09-30 09:52:49'),
(63, '2014-10-07', 34, 1, 0, '2014-09-30 09:52:49'),
(64, '2014-10-07', 14, 1, 0, '2014-09-30 09:52:49'),
(65, '2014-10-07', 27, 1, 0, '2014-09-30 09:52:50'),
(66, '2014-10-07', 33, 1, 0, '2014-09-30 09:52:50');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attendance_recovers`
--

INSERT INTO `attendance_recovers` (`id`, `attendance_id`, `clan_date`, `clan_id`, `student_id`, `attendance`, `history`, `user_id`, `timestamp`) VALUES
(1, 14, '2014-09-30', 1, 15, 1, NULL, 15, '2014-09-30 09:49:00');

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
  `result_declare_by` int(11) NOT NULL DEFAULT '0',
  `result` int(11) NOT NULL DEFAULT '0',
  `result_status` enum('MP','MNP','SP','CW','CO') NOT NULL DEFAULT 'MNP',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `type`, `from_id`, `from_status`, `to_id`, `to_status`, `made_on`, `status_changed_on`, `played_on`, `place`, `result_declare_by`, `result`, `result_status`, `user_id`, `timestamp`) VALUES
(1, 'R', 37, 'A', 25, 'A', '2014-10-16 12:11:24', '2014-10-16 14:22:33', '2014-10-19 01:05:00', 'Baroda', 25, 37, 'MP', 37, '2014-10-16 06:41:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

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
(16, 'R', 4, '2014-09-30', NULL, NULL, NULL, 0, '2014-09-23 05:33:38'),
(17, 'R', 1, '2014-10-01', NULL, NULL, NULL, 0, '2014-09-30 09:52:47'),
(18, 'R', 2, '2014-10-01', NULL, NULL, NULL, 0, '2014-09-30 09:52:47'),
(19, 'R', 6, '2014-10-01', NULL, NULL, NULL, 0, '2014-09-30 09:52:47'),
(20, 'R', 2, '2014-10-02', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(21, 'R', 3, '2014-10-02', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(22, 'R', 3, '2014-10-03', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(23, 'R', 5, '2014-10-03', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(24, 'R', 5, '2014-10-04', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(25, 'R', 6, '2014-10-05', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(26, 'R', 6, '2014-10-06', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(27, 'R', 1, '2014-10-07', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(28, 'R', 3, '2014-10-07', NULL, NULL, NULL, 0, '2014-09-30 09:52:48'),
(29, 'R', 4, '2014-10-07', NULL, NULL, NULL, 0, '2014-09-30 09:52:48');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clans`
--

INSERT INTO `clans` (`id`, `academy_id`, `school_id`, `teacher_id`, `level_id`, `clan_from`, `clan_to`, `lesson_day`, `lesson_from`, `lesson_to`, `en_class_name`, `it_class_name`, `same_address`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, 1, 1, '5', 1, '2014-06-01', '2014-12-31', '2,3', 1410406200, 1410417000, 'Poppey Ep 1', 'Poppey Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:45:00'),
(2, 2, 2, '7', 2, '2014-07-01', '2015-06-30', '3,4', 1411619400, 1411630200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 1, '2014-07-26 09:46:59'),
(3, 1, 3, '3', 1, '2014-07-01', '2015-06-30', '2,4,5', 1406352600, 1406359800, 'Sailor Ep 2', 'Sailor Ep 2', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38'),
(4, 2, 4, '8', 1, '2014-07-01', '2015-06-30', '2', 1406363400, 1406370600, 'Lab Ep 2', 'Lab Ep 2', 1, 'Baroda', '390016', 5, 4, 2, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:48:27'),
(5, 1, 1, '7', 1, '2014-07-01', '2015-06-30', '5,6', 1407292200, 1407306600, 'Poppey Ep 2', 'Poppey Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-08-06 05:25:51'),
(6, 1, 3, '25', 1, '2014-07-01', '2015-06-30', '1,3,7', 1410345000, 1410348600, 'Sailor Ep 3', 'Sailor Ep 3', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 1, '2014-07-26 09:47:38'),
(7, 3, 5, '3', 1, '2014-01-01', '2014-12-31', '1,2,3,4,5,6', 1412908200, 1412915400, 'PPG 1', 'PPG 1', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 1, '2014-10-10 08:29:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

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
(24, 'batch_request_unapproved', 'Badge Request unapproved | MyLudosport', '<div >Dear #user_name,</div><div ><br></div><div >Your request for Badge &nbsp;#batch_name for #student_name is unapproved</div><div >It is unapproved by #authorized_username.<br></div><div ><br></div><div >Thanks </div><div ><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#batch_name\r\n#student_name\r\n#request_username\r\n#authorized_username', 1, '2014-08-25 08:05:22'),
(25, 'new_announcement', 'New Announcement | MyLudosport', '<div>Dear #user_name,</div><div><br>Their is new announcement for you from #announcer_name.</div><div><br></div><div>#announcement</div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#announcer_name\r\n#subject\r\n#announcement', 1, '2014-08-25 08:05:22'),
(26, 'event_manager', 'Event Manager | MyLudosport', '<p>Dear #user</p><p>A New Event is organised and you are selected as manager.</p><p><br></p><h4><span>Event Details :</span></h4><h4></h4><p><span >Name : #event_name</span><br></p><p>Date : #from_date to #to_date</p><p>Location : #location</p><p>Event Created &nbsp;:&nbsp;#event_created_by</p><p><br></p><p></p><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div><p></p>', NULL, '#user\r\n#event_name\r\n#from_date\r\n#to_date\r\n#location\r\n#event_created_by', 1, '2014-08-25 08:05:22'),
(27, 'challenge_winner_confirmation', 'Confirmation of Winner in Challenge | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>The result is almost declare of the match played between you and #opponent_name&nbsp;on date : #on_date #on_time and t<span style="line-height: 1.42857143;">he winner is #winner . Please confirmation it.</span></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#opponent_name\r\n#on_date\r\n#to_time\r\n#winner', 1, '2014-09-09 11:56:53'),
(28, 'contrast_opinions_challenge_winner', 'Contrast of opinion on Winner in Challenge | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>The result is declare of the match played between you and #opponent_name&nbsp;on date : #on_date #on_time and t<span style="line-height: 1.42857143;">he winner is #winner . But opinion of both&nbsp;</span>students<span style="line-height: 1.42857143;">&nbsp;does not matched.</span></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#opponent_name\r\n#on_date\r\n#to_time\r\n#winner', 1, '2014-09-09 11:56:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

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
(26, 1, 3, 37, '2014-09-29 09:38:19'),
(27, 18, 1, 37, '2014-10-09 07:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) NOT NULL,
  `eventcategory_id` int(11) NOT NULL,
  `event_for` enum('AC','SC','ALL') NOT NULL DEFAULT 'ALL',
  `school_id` varchar(25) NOT NULL DEFAULT '0',
  `en_name` varchar(255) NOT NULL,
  `it_name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `manager` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no-cover.jpg',
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventcategory_id`, `event_for`, `school_id`, `en_name`, `it_name`, `city_id`, `date_from`, `date_to`, `manager`, `image`, `description`, `user_id`, `timestamp`) VALUES
(1, 4, 'AC', '1,3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Presentazione agli istruttori anno accademico 2014/2015', 6, '2014-09-21', '2014-09-21', '45', '94d18f13b2105af7ca34fe397ddb6a0f.png', '<p><br></p>', 46, '2014-09-18 14:47:59'),
(2, 4, 'AC', '1,3', 'Integer ornare du', 'Presentazione agli istruttori Anno accademico 2014/2015', 6, '2014-09-21', '2014-09-21', '46,47,57', '00e2769c056ed36cb1a471ebbdd930e5.png', '<p>Cerimonia di apertura dei corsi e presentazione dell''Anno Accademico 2014/2015</p><p><span >Mattina</span>:</p><p><ul><li><span >Proiezione Moviementary,</span><br></li><li><span >Relazione su Bootcamp, Scuola internazionale e prime &nbsp;accademie internazionali</span><br></li><li><span >Presentazione guanti tecnici</span><br></li><li><span >Presentazione Spada ufficiale LSCA ver. 1.0</span><br></li></ul></p><p><span >Pomeriggio</span>:</p><p><ul><li><span >rinnovamento e implementazione divise LSCA</span></li><li><span >Presentazione Riforma Didattica e ruolo degli istruttori</span><br></li><li><span >Presentazione piattaforma Myludosport</span></li><li><span >momento di confronto e workshop sulle prospettive e nuove inisziativa LSCA<br></span><br></li></ul></p><p><br></p>', 46, '2014-09-19 15:50:06'),
(3, 4, 'AC', '1,3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra tempus volutpat.', 'Presentazione agli istruttori Anno accademico 2014/2015', 6, '2014-09-21', '2014-09-21', '', '87b5758d441a4462d734c320fc012723.png', '<p>Cerimonia di apertura dei corsi e presentazione dell''Anno Accademico 2014/2015</p><p><span >Mattina</span>:</p><p></p><ul><li><span >Proiezione Moviementary,</span><br></li><li><span >Relazione su Bootcamp, Scuola internazionale e prime &nbsp;accademie internazionali</span><br></li><li><span >Presentazione guanti tecnici</span><br></li><li><span >Presentazione Spada ufficiale LSCA ver. 1.0</span><br></li></ul><p></p><p><span >Pomeriggio</span>:</p><p></p><ul><li><span >rinnovamento e implementazione divise LSCA</span></li><li><span >Presentazione Riforma Didattica e ruolo degli istruttori</span><br></li><li><span >Presentazione piattaforma Myludosport</span></li><li><span >momento di confronto e workshop sulle prospettive e nuove inisziativa LSCA<br></span><br></li></ul><p></p><p><br></p>', 46, '2014-09-19 15:51:30'),
(4, 4, 'AC', '1,3', 'Etiam quis nulla', 'Presentazione agli istruttori Anno accademico 2014/2015', 6, '2014-09-21', '2014-09-21', '45', '1ba43ca064fa39fb9a549f64fe786639.png', '<p>Cerimonia di apertura dei corsi e presentazione dell''Anno Accademico 2014/2015</p><p><span >Mattina</span>:</p><p></p><ul><li><span >Proiezione Moviementary,</span><br></li><li><span >Relazione su Bootcamp, Scuola internazionale e prime &nbsp;accademie internazionali</span><br></li><li><span >Presentazione guanti tecnici</span><br></li><li><span >Presentazione Spada ufficiale LSCA ver. 1.0</span><br></li></ul><p></p><p><span >Pomeriggio</span>:</p><p></p><ul><li><span >rinnovamento e implementazione divise LSCA</span></li><li><span >Presentazione Riforma Didattica e ruolo degli istruttori</span><br></li><li><span >Presentazione piattaforma Myludosport</span></li><li><span >momento di confronto e workshop sulle prospettive e nuove inisziativa LSCA<br></span><br></li></ul><p></p><p><br></p>', 46, '2014-09-19 15:52:00'),
(5, 2, 'AC', '1,3', 'Ut tristique massa ut consequat tempor. Maecenas sed ornare metus, eget malesuada libero. Integer sit amet sodales leo. Proin eu luctus enim, aliquam luctus eros. Duis bibendum metus eu mi tempor, ut pharetra lectus fermentum.', 'Workshop Savate', 6, '2014-10-04', '2014-10-05', '47', 'aced35065bb6cb11c4d9ea2b199dba15.png', '<p>Workshop di Savate</p><p>sabato mattina dalle 10.00 alle 13.00</p><p>Costo partecipazione Euro 20.00</p><p>Prenotazione obbligatoria</p><p>Numero chiuso.</p>', 46, '2014-09-23 15:02:52'),
(6, 2, 'AC', '1,3', 'Workshop Savate', 'Workshop Savate', 6, '2014-10-04', '2014-10-05', '47', '126f57bb5a0b31a9667c300dcf8d7b08.png', '<p>Workshop Savate</p>', 46, '2014-09-24 08:04:46'),
(7, 2, 'AC', '1,3', 'Vivamus ut massa quam. Vestibulum finibus nibh mauris, vel faucibus risus rutrum nec. Sed id quam nulla. Aliquam eget vestibulum orci. Donec eleifend mi at viverra iaculis. ', 'Workshop Savate', 6, '2014-10-04', '2014-10-05', '47', '2f497b35119a6d9ca0cc71b0124b611b.png', '<p>workshop di savate</p>', 46, '2014-09-24 14:38:10'),
(8, 2, 'AC', '1,3', 'Workshop Savate', 'Workshop Savate', 6, '2014-10-04', '2014-10-05', '47', '8204a4b6b09066662413c4032d341444.png', '<p>Workshop di savate</p>', 46, '2014-09-24 17:30:34'),
(9, 4, 'AC', '1,3', 'Prova evento academy', 'test test evento academy', 6, '2014-09-27', '2014-09-27', '59,21,60', '87e2c95fef9aa8a6457e903ed659333f.jpg', '<p>Prova prova</p>', 59, '2014-09-24 17:33:05'),
(10, 1, 'AC', '1,3', 'Test test test 5', 'Prova prova prova 5', 6, '2015-12-31', '2015-12-31', '59,45', '971a2297d0dd6d9d9fe74e38315e7561.jpg', '<p>Testing testing testing</p>', 59, '2014-09-24 19:19:03'),
(11, 2, 'SC', '1,3', 'Workshop Savate', 'Workshop Savate ', 6, '2014-10-04', '2014-10-05', '46,47,59', '19320d5a541aeb358be35e2c86e4790e.png', '<p>Numero Posti Limitati: 15</p><p>Luogo: Cripta</p><p>Orario: 14:00 - 19:00</p><p>Al Workshop, tenuto dal Maestro Gianluca Longo – ex atleta ed allenatore (istruttore) in questa disciplina – verranno mostrati i movimenti base della Savate sportiva e le regole dell’assalto che molto attingono dalla scherma. Si lavorerà sull’equilibrio e sulla ricerca della massima efficacia all’impatto; si sperimenteranno gli effetti dei diversi modi per colpire al fine di ottenere l’effetto shock nell’avversario; si lavorerà sul concetto di “casa” (simile al “cuneo” utilizzato nel Makashi); si affronteranno deviazioni, prese articolari, difesa a terra, accenni a tecniche di disarmo contro arma da fuoco e coltello ed il concetto dei due punti di impatto per ogni passo; verranno fatti accenni a tecniche di bastone e difesa con oggetti di uso comune.<br></p>', 46, '2014-09-25 12:57:05'),
(12, 3, 'AC', '1,3', 'yt', 'yt', 6, '2014-09-26', '2014-09-26', '127', 'b52235c3638b2c15299530305e73756f.png', '<p><br></p>', 46, '2014-09-25 16:39:05'),
(13, 5, 'AC', '1,3', 'a', 'a', 6, '2014-09-26', '2014-09-26', '21', '2ed538b8a3497bf9261c4ef2d189e2a8.png', '<p><br></p>', 46, '2014-09-25 16:41:20'),
(14, 4, 'AC', '1,3', 'Trial Event 1', 'Evento Prova 1', 7, '2014-09-27', '2014-09-27', '49,59', '393163425fc8a08cb18ab6daeb7b5017.jpg', '<p>Evento di prova, mi potete dire se ricevete qualche notifica?</p><p><br></p><p>Fabio / Fatum<br></p>', 49, '2014-09-26 19:05:17'),
(18, 4, 'ALL', '0', 'Seminar', 'Seminar', 2, '2014-10-10', '2014-10-10', '37,3', '579f4c645204d29c9c76143930d559b6.jpg', '<p>asdasd</p>', 2, '2014-10-08 07:32:52');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(4, 'N', 'student_absent', 20, 3, 1, 'a:1:{s:12:"absence_date";s:10:"2014-09-17";}', 1, '2011-09-16 06:39:24'),
(42, 'N', 'teacher_absent', 3, 4, 3, 'a:4:{s:6:"action";s:15:"confirm_absence";s:7:"clan_id";s:1:"6";s:12:"from_message";s:0:"";s:4:"date";s:10:"2014-09-17";}', 1, '2014-09-16 11:04:42'),
(43, 'N', 'holiday_approved', 4, 3, 3, 'a:11:{s:2:"id";i:3;s:9:"clan_date";s:10:"2014-09-17";s:7:"clan_id";s:1:"6";s:10:"teacher_id";s:1:"3";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";N;s:10:"to_message";N;s:6:"status";s:1:"A";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-09-16 16:34:42";}', 1, '2014-09-16 11:05:54'),
(44, 'N', 'change_clan_date', 3, 4, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:09:36'),
(45, 'N', 'change_clan_date', 3, 5, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:10:18'),
(46, 'N', 'change_clan_date', 3, 13, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:10:39'),
(47, 'N', 'change_clan_date', 3, 14, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:11:09'),
(48, 'N', 'change_clan_date', 3, 15, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:11:49'),
(49, 'N', 'change_clan_date', 3, 16, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:11:57'),
(50, 'N', 'change_clan_date', 3, 17, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:12:27'),
(51, 'N', 'change_clan_date', 3, 20, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:12:59'),
(52, 'N', 'change_clan_date', 3, 21, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:13:11'),
(53, 'N', 'change_clan_date', 3, 23, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:13:31'),
(54, 'N', 'change_clan_date', 3, 25, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:14:01'),
(55, 'N', 'change_clan_date', 3, 27, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:14:13'),
(56, 'N', 'change_clan_date', 3, 31, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:14:19'),
(57, 'N', 'change_clan_date', 3, 33, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:14:39'),
(58, 'N', 'change_clan_date', 3, 34, 5, 'a:5:{s:7:"clan_id";s:1:"6";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"20-09-2014";s:11:"description";s:0:"";s:6:"notify";s:1:"1";}', 1, '2014-09-16 11:15:00'),
(64, 'N', 'challenge_made', 25, 20, 1, 'a:13:{s:2:"id";i:1;s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"20";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-18 17:09:15";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-18 11:39:16'),
(65, 'N', 'challenge_accepted', 20, 25, 1, 'a:13:{s:2:"id";i:1;s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"20";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-18 17:09:15";s:17:"status_changed_on";s:19:"2014-09-18 17:09:33";s:9:"played_on";s:19:"2014-09-18 17:09:33";s:5:"place";s:1:"0";s:6:"result";s:2:"25";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-18 17:09:15";}', 1, '2014-09-18 11:39:33'),
(66, 'N', 'teacher_absent', 7, 3, 7, 'a:4:{s:6:"action";s:15:"confirm_absence";s:7:"clan_id";s:1:"2";s:12:"from_message";s:8:"Personal";s:4:"date";s:10:"2014-09-25";}', 1, '2014-09-22 07:09:14'),
(67, 'N', 'holiday_upapproved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"U";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 1, '2014-09-22 07:10:38'),
(68, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 1, '2014-09-22 07:15:52'),
(69, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 1, '2014-09-22 07:20:27'),
(70, 'N', 'holiday_approved', 3, 7, 7, 'a:11:{s:2:"id";i:7;s:9:"clan_date";s:10:"2014-09-25";s:7:"clan_id";s:1:"2";s:10:"teacher_id";s:1:"7";s:10:"attendance";s:1:"0";s:16:"recovery_teacher";s:1:"0";s:12:"from_message";s:8:"Personal";s:10:"to_message";s:5:"Sorry";s:6:"status";s:1:"A";s:7:"user_id";s:1:"7";s:9:"timestamp";s:19:"2014-09-22 12:34:57";}', 1, '2014-09-22 07:29:50'),
(71, 'N', 'challenge_made', 25, 13, 4, 'a:14:{s:2:"id";i:4;s:4:"type";b:0;s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"13";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 11:28:41";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-25 05:58:41'),
(72, 'N', 'challenge_made', 25, 13, 5, 'a:14:{s:2:"id";i:5;s:4:"type";s:1:"B";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"13";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 11:29:54";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-25 05:59:54'),
(73, 'N', 'challenge_made', 25, 14, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-09-25 06:52:53'),
(74, 'N', 'challenge_accepted', 14, 25, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";s:19:"2014-09-25 12:23:18";s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";s:1:"0";s:6:"result";s:2:"25";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-25 12:22:53";}', 1, '2014-09-25 06:53:18'),
(75, 'N', 'challenge_winner', 14, 25, 6, 'a:14:{s:2:"id";i:6;s:4:"type";s:1:"B";s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"14";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-09-25 12:22:53";s:17:"status_changed_on";s:19:"2014-09-25 12:23:18";s:9:"played_on";s:19:"2014-09-30 01:00:00";s:5:"place";s:1:"0";s:6:"result";s:2:"14";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-09-25 12:22:53";}', 1, '2014-09-25 06:55:08'),
(82, 'N', 'batch_request', 3, 4, 1, 'a:3:{s:10:"student_id";s:2:"14";s:8:"batch_id";s:2:"10";s:11:"description";s:6:"sdsada";}', 1, '2014-09-27 12:28:31'),
(90, 'N', 'batch_request_approved', 4, 3, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"3";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"14";s:8:"approved";s:1:"A";}', 1, '2014-09-27 12:59:17'),
(91, 'N', 'batch_request_unapproved', 4, 3, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"3";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"14";s:10:"unapproved";s:1:"U";}', 1, '2014-09-27 13:00:09'),
(92, 'N', 'batch_request_approved', 3, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"10";s:10:"student_id";s:2:"37";s:8:"approved";s:1:"A";}', 1, '2014-09-29 04:54:27'),
(93, 'N', 'batch_request_unapproved', 1, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"11";s:10:"student_id";s:2:"37";s:10:"unapproved";s:1:"U";}', 1, '2014-09-29 05:37:50'),
(94, 'N', 'batch_request_unapproved', 1, 7, 1, 'a:5:{s:9:"from_role";s:1:"5";s:7:"from_id";s:1:"7";s:8:"batch_id";s:2:"11";s:10:"student_id";s:2:"37";s:10:"unapproved";s:1:"U";}', 1, '2014-09-29 05:40:15'),
(95, 'N', 'event_invitation', 1, 3, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:08'),
(96, 'N', 'event_invitation', 1, 4, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:20'),
(97, 'N', 'event_invitation', 1, 5, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:26'),
(98, 'N', 'event_invitation', 1, 6, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:32'),
(99, 'N', 'event_invitation', 1, 7, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:38'),
(100, 'N', 'event_invitation', 1, 8, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:44'),
(101, 'N', 'event_invitation', 1, 13, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:42:55'),
(102, 'N', 'event_invitation', 1, 14, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:01'),
(103, 'N', 'event_invitation', 1, 15, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:11'),
(104, 'N', 'event_invitation', 1, 16, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:22'),
(105, 'N', 'event_invitation', 1, 17, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:28'),
(106, 'N', 'event_invitation', 1, 20, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:44'),
(107, 'N', 'event_invitation', 1, 21, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:43:54'),
(108, 'N', 'event_invitation', 1, 23, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:00'),
(109, 'N', 'event_invitation', 1, 25, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:06'),
(110, 'N', 'event_invitation', 1, 27, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:16'),
(111, 'N', 'event_invitation', 1, 28, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:27'),
(112, 'N', 'event_invitation', 1, 31, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:33'),
(113, 'N', 'event_invitation', 1, 33, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:39'),
(114, 'N', 'event_invitation', 1, 34, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:44:44'),
(116, 'N', 'event_invitation', 1, 37, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"3,4";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}}', 1, '2014-09-29 06:45:01'),
(117, 'N', 'event_invitation', 3, 12, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 1, '2014-09-29 09:37:46'),
(118, 'N', 'event_invitation', 3, 13, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 1, '2014-09-29 09:37:52'),
(120, 'N', 'event_invitation', 3, 37, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-09-28";s:7:"date_to";s:10:"2014-09-30";s:7:"manager";s:1:"3";s:5:"image";s:37:"d2552d6693f9b2a2168255c13a1c6aa2.jpeg";s:11:"description";s:931:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>";s:7:"user_id";s:1:"5";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:11:"to_students";a:4:{i:0;s:2:"12";i:1;s:2:"13";i:2;s:2:"36";i:3;s:2:"37";}}', 1, '2014-09-29 09:38:19'),
(121, 'N', 'new_announcement', 1, 37, 1, 'a:12:{s:2:"id";s:1:"1";s:4:"type";s:6:"single";s:8:"group_id";s:1:"0";s:7:"from_id";s:1:"1";s:5:"to_id";s:2:"37";s:7:"subject";s:7:"Testing";s:12:"announcement";s:671:"<p ><span ><span ><span >It is a long established fact that a reader will be distracted by the \nreadable content of a page when looking at its layout. The point of \nusing Lorem Ipsum is that it has a more-or-less normal distribution of \nletters, as opposed to using ''Content here, content here'', making it \nlook like readable English. Many desktop publishing packages and web \npage editors now use Lorem Ipsum as their default model text, and a \nsearch for ''lorem ipsum'' will uncover many web sites still in their \ninfancy. Various versions have evolved over the years, sometimes by \naccident, sometimes on purpose (injected humour and the like).</span></span></span></p>";s:11:"from_person";s:16:"Super Admin User";s:9:"to_person";s:10:"Soyab Rana";s:9:"timestamp";s:19:"2014-10-01 14:39:39";s:10:"from_avtar";s:36:"dcf8544d6647c2095e8b2cc9796455be.jpg";s:8:"to_avtar";s:36:"5865aa782c8c4ee571acac7af45b9d94.jpg";}', 1, '2014-10-01 09:09:39'),
(122, 'N', 'new_announcement', 3, 15, 3, 'a:12:{s:2:"id";s:1:"3";s:4:"type";s:5:"group";s:8:"group_id";s:9:"clans_2_2";s:7:"from_id";s:1:"3";s:5:"to_id";s:8:"15,16,37";s:7:"subject";s:5:"Hello";s:12:"announcement";s:64:"<p><span >&nbsp;Lorem ipsum dolor sit amet.&nbsp;</span><br></p>";s:11:"from_person";s:8:"Rector 1";s:9:"to_person";s:16:"C Student Second";s:9:"timestamp";s:19:"2014-10-01 15:06:14";s:10:"from_avtar";s:36:"063fd00a3c30c83404faf36e32b2dada.jpg";s:8:"to_avtar";s:13:"no_avatar.jpg";}', 1, '2014-10-01 09:36:14'),
(123, 'N', 'new_announcement', 3, 16, 3, 'a:12:{s:2:"id";s:1:"3";s:4:"type";s:5:"group";s:8:"group_id";s:9:"clans_2_2";s:7:"from_id";s:1:"3";s:5:"to_id";s:8:"15,16,37";s:7:"subject";s:5:"Hello";s:12:"announcement";s:64:"<p><span >&nbsp;Lorem ipsum dolor sit amet.&nbsp;</span><br></p>";s:11:"from_person";s:8:"Rector 1";s:9:"to_person";s:16:"C Student Second";s:9:"timestamp";s:19:"2014-10-01 15:06:14";s:10:"from_avtar";s:36:"063fd00a3c30c83404faf36e32b2dada.jpg";s:8:"to_avtar";s:13:"no_avatar.jpg";}', 1, '2014-10-01 09:36:19'),
(124, 'N', 'new_announcement', 3, 37, 3, 'a:12:{s:2:"id";s:1:"3";s:4:"type";s:5:"group";s:8:"group_id";s:9:"clans_2_2";s:7:"from_id";s:1:"3";s:5:"to_id";s:8:"15,16,37";s:7:"subject";s:5:"Hello";s:12:"announcement";s:64:"<p><span >&nbsp;Lorem ipsum dolor sit amet.&nbsp;</span><br></p>";s:11:"from_person";s:8:"Rector 1";s:9:"to_person";s:16:"C Student Second";s:9:"timestamp";s:19:"2014-10-01 15:06:14";s:10:"from_avtar";s:36:"063fd00a3c30c83404faf36e32b2dada.jpg";s:8:"to_avtar";s:13:"no_avatar.jpg";}', 1, '2014-10-01 09:36:26');
INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(125, 'N', 'new_announcement', 1, 37, 1, 'a:12:{s:2:"id";s:1:"1";s:4:"type";s:6:"single";s:8:"group_id";s:1:"0";s:7:"from_id";s:1:"1";s:5:"to_id";s:2:"37";s:7:"subject";s:7:"Testing";s:12:"announcement";s:1304:"<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at facilisis ipsum, vel tempus turpis. Nam sit amet magna non lectus commodo pulvinar. Vestibulum faucibus arcu in sodales finibus. Suspendisse cursus sapien ut fringilla mattis. Maecenas ut justo metus. Vivamus tincidunt id ligula sed elementum. Aliquam lorem tellus, placerat quis elementum eu, efficitur id erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur maximus eros ut est eleifend, nec porttitor lacus lacinia. Nam eu vestibulum libero, quis rutrum tortor. Proin nisi urna, lobortis non purus et, elementum congue quam. Ut iaculis dui at est finibus varius non maximus nisl. Quisque sit amet condimentum nunc, sit amet condimentum lectus. Nam euismod neque a gravida sagittis.</p><p >Integer vestibulum quis magna finibus pellentesque. Nam eget feugiat lacus. Quisque quis facilisis sapien. Aliquam at diam leo. Curabitur varius eleifend erat, vitae malesuada ante tempor vitae. Etiam eu mauris in ipsum faucibus molestie id quis nibh. Vestibulum varius a neque ut gravida. Donec quis dui ac libero semper imperdiet. Etiam molestie mauris sollicitudin, vulputate nisi scelerisque, fringilla mauris. Mauris diam neque, mattis vitae commodo ac, rhoncus aliquet mauris.</p>";s:11:"from_person";s:16:"Super Admin User";s:9:"to_person";s:10:"Soyab Rana";s:9:"timestamp";s:19:"2014-10-01 15:43:43";s:10:"from_avtar";s:36:"dcf8544d6647c2095e8b2cc9796455be.jpg";s:8:"to_avtar";s:36:"5865aa782c8c4ee571acac7af45b9d94.jpg";}', 1, '2014-10-01 10:13:43'),
(126, 'N', 'new_announcement', 1, 37, 2, 'a:12:{s:2:"id";s:1:"2";s:4:"type";s:6:"single";s:8:"group_id";s:1:"0";s:7:"from_id";s:1:"1";s:5:"to_id";s:2:"37";s:7:"subject";s:9:"Attention";s:12:"announcement";s:86:"<p><img  data-filename="rana_1.jpg" ></p><p>Hello .....................</p><p><br></p>";s:11:"from_person";s:16:"Super Admin User";s:9:"to_person";s:10:"Soyab Rana";s:9:"timestamp";s:19:"2014-10-01 15:49:44";s:10:"from_avtar";s:36:"dcf8544d6647c2095e8b2cc9796455be.jpg";s:8:"to_avtar";s:36:"5865aa782c8c4ee571acac7af45b9d94.jpg";}', 1, '2014-10-01 10:19:44');
INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(127, 'N', 'new_announcement', 1, 37, 3, 'a:12:{s:2:"id";s:1:"3";s:4:"type";s:6:"single";s:8:"group_id";s:1:"0";s:7:"from_id";s:1:"1";s:5:"to_id";s:2:"37";s:7:"subject";s:7:"Testing";s:12:"announcement";s:82920:"<p><br></p><img src="data:image/jpeg;base64,/9j/4T/+RXhpZgAATU0AKgAAAAgABgESAAMAAAABAAEAAAEaAAUAAAABAAAAVgEbAAUAAAABAAAAXgEoAAMAAAABAAIAAAITAAMAAAABAAEAAIdpAAQAAAABAAAAZgAAAMAAAABIAAAAAQAAAEgAAAABAAeQAAAHAAAABDAyMjGRAQAHAAAABAECAwCgAAAHAAAABDAxMDCgAQADAAAAAQABAACgAgAEAAAAAQAAAoCgAwAEAAAAAQAAAoCkBgADAAAAAQAAAAAAAAAAAAYBAwADAAAAAQAGAAABGgAFAAAAAQAAAQ4BGwAFAAAAAQAAARYBKAADAAAAAQACAAACAQAEAAAAAQAAAR4CAgAEAAAAAQAANKAAAAAAAAAASAAAAAEAAABIAAAAAf/Y/9sAQwACAQECAQECAgECAgICAgMFAwMDAwMGBAQDBQcGBwcHBgYGBwgLCQcICggGBgkNCQoLCwwMDAcJDQ4NDA4LDAwL/9sAQwECAgIDAgMFAwMFCwgGCAsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsL/8AAEQgAoACgAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/R2NRE56nPU0j7cnYB70rDIBxyw/LpT/ALPwMnk1/kWoq12f0ynbVsRB5mQwBHXpRkJ05/GlaPc3JyAM0bNw+8DjvRZCunrcRiCvSoztB5yKc8WcjPvRNGs6fvehGCM00orfYJJpaHM+Jvid4d8KeI9L0nxLrWmWWr63L9n0+zmuUSe7fBbEcZOW4B6CunhjETHJNfkP/wAFb/gq37If7XXgz4k/CaGWzttTePUU3zySiK/tJVZ/mdiQGUxHBPJ319ufGz/gosvw2+EFl4x+FvgDxJ8QNIfToNSv7uwkWC00yKWJJVEspDEuEkVmCowUEFiuRn9azbwul9UyvF5FUdanioN3m4QtNO3Lq7J62Su22nY+SwnE1p4mnjFyum7WV3p32Pp/YCTg8Y61Cp2tjGCK8P8A2J/28fCX7b/g+7v/AAGlzpuq6WypqOlXTAz2Zb7rhl4kjbBwwxyCCAa8p/4KpftafE/9nK68DWHwE0Ke+t9fun+33UNq88kuxk22qFATE0gZvmHzcfLgg18rlnA2YY7O3kNdRo143cudpJJK+j63W1t+9tT1aud0KWEWMpvng7Wtrv8A1qfZKhUI8wj5u1I+zgBflr80P+Cif7S/xA/Yj+P3w71r4Y+JvEq6V4j0xL/U/D2rXzajbK6yhZIwZdzJlW2kqRgjIxmv0k0vUV1XSba5twQk8SSrnrhgCKOKuDKvDGFwOOdRVKWKi5QsrNWaTTWuuqtZtMnK85jmNStS5bSpuz+e1j5m/wCCg3/BQC4/YN1nwnPf6JZ+JtJ8TCeNrVLk2t5bNDsLSByGV1IlUbSqkEdTnj3n4KfEcfF/4UeH/FUen3Gkp4gsYr9LS4IaWBJVDKGI4ztYH8a/Lb/gpRqc37YX/BULw18NdCmaWx0iaz0FmTlY2kYTXUn1VX2n/rl7V+l13+0P8P8A4YeLLPwX4k13TfDeppbotlZ35NlHcxABV+zvIAkoGNuEYkEYPNfacc8GUMrynJ8PgsI5Y2dL2tZwTuovbmivXV26a7ni5LnE6+LxVSvVtRU+WCfdb6/1ueig7n3OBn1xUjxJsJHJPvUEF6moQrNbFXjcblZTkMD0Ip7LkKQNtfjfKruNtUfaKSnZoRdozkDaB+dKB6Ac9qeYOCSwIx0xTF+XHBI4p8sexd7rQR+OoGcZpyp5i/IFGR0pS3mH58880BNuMnNTKyV7ag2DMWC544pGAjbaDmh1yRn09aNuRkcZqoqyQIQ9OnNC8jJ5NCjYwK8etUvEPiOy8KaHc6h4ivILOxtImlnnmYIkCDkszHoBWtKlOvONOnFuTdklq2yKtWNCLnN2RdyCQB3oKkE88GvkS9/4LZ/A7SviG2h3t74mSKOXym1NtIcWaHOMkFhLj38v36V9U+EvGWlfELw5Z6z4L1C11XS7+JZra6tpRJFMhHBVhwf8c172d8J5xw5CFTM8LKnGfwtrR/NXV/Lc4MJnGEx8nChUUmt7dD5m/wCCxPwLPxq/Yt1u602ES6l4OlXXbchfm8uMETrnrjyWkbHcoK4X/gh58VrD4sfsdaj4M1uOC5m8J301rPA67hNZ3OZELg9QT5yY9EFfbfiHQ7bxFol5YavEk1neQvBPGwyJUdSrKR3BBIP1r8xv+CX/AMDPiP8AsuftrfESx0fwzq+q+CdPluND1C8jMcSSMjiS2ePzXQSts25CklRMc+/6Tw1jqeecCY3Kq1ZQrYSpCrRcpKO71im2tb81ldatHymZ0ZYDOqVeEW4VYuMrK+3X7jgv2QNBv/2K/wDgr/P4F0qSX+y9Q1C40YoST5tnPH59sT6kYgOfY19Xf8FP/wDgo3rX7KviTQPBHwjt9Pj8R+IoUuZdUv08yDToHlaJWWPIDvuVzluFCjg546X4efsO6j4x/b41X46/FSGHSlt4orbQtG81ZrgFLdYDcXTIWRWwG2orNjIJbIwfQP2tf+Cfnw9/bObTZvi/Z3yahpaGO2vtPufIuEjY5MZJVlZSecEHBJwRk59PPuN+G8bxZhcyzSn7WEMPGNRxSkvbWvzWdlNRvbs33sYYLJsxp5ZUoYeXK3NtX092+3lc/Pv/AILh/DZfh3rnwvN7q15rus3en3jahqd5MHnvWWSDDbRhY0yz7Y0CouTgZyT+m2hfEKz8Jfs7WPibxK4Sy03w9HqV02ekcdssjn8ga8s8Vf8ABKr4PeM/hvpfhvxNoup3a6RIXg1CXU5X1AkqFIadiSVwAAmNq4+UCtz41/sX/wDCf/s4TfDT4f8AjDxB4U0Se1+xzSMw1OS5iwihHe4JkC4QLtR1GCR0rys94wyDimhkuAxNeoo4acvaTnD4oNp392Umm0rWtZd7I6sLlOOyueKrU4RftEuVJ7NK3VLuflr+x18WPEPh/wCLfxP/AGjLjwzD4pbwkkl/NFLdm3FvdajOYlkBCNvCCSXKjb8pzkYr7/8A2Dj4b/4KC/C7Tviv8f8AR9L8R+LbK8u9LW2uYFlsNGCyBglvbtkAsjQsXfe5P8WAAOZ+Df8AwT31z9mn9jD4w/DzWIIPFlx4pt7iSxvNLGLm8LW4jijaCQqEaOQF+JGBDHHIweG/4IgX/iL4H618QPh38bNG1jwveyLFrllFqlo9qHCAxXDJvADADyDkZ4BNfoHHeb4LjDJ8xzHJZpV6VSEYOErTnh+WK5Ur83LzSbastVZni5Nh6uU4vD4fFq9OUW3daRndvV7baH6EX93pXw48LTXWoyWOkaTpNuZJHYrBb2kKLkkk4VFAHsBiuV+D/wC1J4C+PttI/wAI/FOk675MjRsIJCG3KAWAVsFsBlJIBHzD1r5n+Jv/AAUw+B/7Ty+IvhNd/wDCdatZa/BLp8t9o+jyXCOO8kPllpSAcEN5RBx0I6/Pf7S/jf4d/wDBPf8AZQk+G37Net67q/jTxRqsGuC+voJLS90Xy3Rkn2lEaJiIvLVcZO6QngYP59w74S1sfF4HMKNalj5zVvh9nGna7nN69b3V0+2p7ON4rjh5+2w84yoJa/zOV9kfq2rYJ6+3vQw+UE9a8/8A2UPGuu/Ez9nDwXr/AMTrY2ev6ro9vdX8RXZ+9ZAS+3+Hd97b23Y7VufE/wCNPhT4LaEmq/FvxBpHh7T2cRJPf3KwLI552ruPzHGTgZ4r8kWWYmpjJYGhF1Kqk42gnK9nZ2te68z7D63TVKNeb5YtX103OiIJQDPPenKmcE8ZqroHiay8WaTbah4Zure/sLyNZre4t5VlhmjYZVlcEhgRzkZq4EIwCc54rhqKVNyhNWave50RlzK/RiSDGAOKbnCgk8U48YJHpk18h/8ABWr9pH4q/s+eAfC//DMFhdi41e/eO+1K309b1rUKqmOEIysoMhZuSP8Alngda97hXIKvFOY0sto1IwlNP3pu0VZX379l3ODNMyWV4d4iUXK3Ravc+umHAOc/yr4p/wCCvH7Ums/sza58Hr7SbeS60J/ELalq0A+7fLbeUyQk9OfNdxn+KNT/AA16le/tx6N+zt8Mvhl/w2bfx+HPE/jPT0a7CW5MNtcLFGZTKq5MY3SAdCAxI4AJroP2jvgP4K/b7/Z7k0i41G0v9Ovwt5pOr2Eqzi1nAISaNlO1hyQy55BYcHkfUcJ4Z8IZvhsxz/Cylgp88OdJuLjJODnF+WrXW2qPHzXEf2vhJ0MJNKsrOzeqas7M89/aG/ZO+GH/AAU6+Btj4n8GSWUerXtp5ukeIbaMCeJunk3AHLoGBVo25U5xg5z8x/8ABInxr47/AGZf2uvEXwD+Lcc8drLDPdR2zMXjtLiIK/mwn/nnLGSc9D8h4Oa5v4DfCL9qn/gm38WrvTvhp4QvvHXhbUJ8zW1ofP07UFzgSqwO62kx3YD3DACvvf4L/Bm88XfF+L4wfGHw1aeGPGNxoUeiQ6ZFeC8ewh81pXaSZVVXlYuF+UEKqY3HccfoWf42jwnkmOyarj6eMwFWN8NaalUhO65fd1cUldvZaaK7seBgKU8yxtHFexlSrRdqmjUZLr5M9xVBJu3fSoo7aOMNsG0uc5xjNSK+BhckmhVAXB71/OySfxH6PbqJvCE+XjPQ0ob8CaY0ohPz7cHt1rL8VfEPQ/AtmJvG+saVo8DdJb26S3Q+vzOQK6MNh62Mn7PDU5Tl2jFv8jKriKVFXnJJebNfPPJOen0p8YDKc8jNef237VXwxvbwwWHxD8DTzA48uPXbVmJ9ABJzXbabq9vqlos+nTRTwzDcjxsGVh7EcGujG5TjsB72Jw84LvKLS/FGNLHYfEaU6ifo0yw6hgwbBrM8T+GbXxXoV5p+rRF7a+t5LeQA4Ox1Ktg9sgnmtNRuPykUOMvtYZ9ga4aM5Uasa1GVpxaaa3TWqN6lOFeLi9Uz86/hp+zv4h/4I6eHfij43h0fQvHXhue3gaw1Brt7bUbNRJsWGaLymBUvNGWKOB+7B9l8l/4Jyfsl69+39+0Dqnxm/af3aloNrfmcJOMJq90uNsKqeBbxYUEDjhUH8WP1f8Q6BY+KtFutN8SWltqNhexGG4triJZYp42GCrqwIZSOoIr5V/bC/aDsf+CUvwC0G3+B/hBtQ0zUNUktra1nu5fsWmBt0zKGO5huJcqmcZ3HoMH964f4/wA14ooYjLMvpRWbYxqMq11Hmpxjqrt+7Kye2jvdJM+EzDJMPl1Wnia0n9WpK6jvaTe/mj6O+LvxY8PfAP4aan4n+Il7Hpmi6PCZZ3OCeOiIv8TMSFVR1JAr8tfEXwC+Nv8AwV/+Na+LvENhc+Dvh5ETFpMupqywWlqSOYIeGnlcAMzgBSeNwAAH6AfCXSvD/wC2n4B8G/En4gadcXdje2ceo6boOoqHtNOn5VpWjxieTcGCyOCAuCqqSSfZta1nT/CXh+e/8QXVrYWFhAZp7ieQRxW8ajJZmPCgAdTXy3DvFk/D5VMFklDnzKo+SVSSu4O9nClHW7vvJ7tbNav0sdl6zlRrYudqC1UVpfzk/wBDm/2f/g1p37Pvwg8PeC/CstxPY+HrNbSOacgyTYyWdscAlmY47Zx2rs0OTnvX5j/tcf8ABdDUIvGP9g/sZadZ31vbT+U+sX9s8xv3B+7bQZUhCeNzZLZ4UdT+hHwD8W6347+DPhjWPifpZ0TX9T02C51Cx2kfZpmjDMu05K8noeR0PIrxuMuBM74Vw9LMc6cVPENvl5rzT3bkul7/AH6bnoZRneEzFzoYW9oW16eiOw3kldpx8o59aYybiNvJHQHsamiwFAX0GKZOMv8AKcEV8HH3opHuJKTs0fM37Y3/AATG8Jftma3PrPxD1rxHZ61DbLaabPbTKYNPjXJ2iArhwzs7sSQxzgMABXwh4j/Zh/aV/wCCWuvTa58F9SvNb8LI/mTz6WjXNlKo/wCfuybJTI6uAQOz5r9hyfMUjJ/nioZVVUJzkDnmv1HhfxXzvIqawGLUcVhHZOlUSattaL+z+K8j5bNeFcLjZOvTbp1FrzR3v59z41/4J8f8FatE/au1218H/FPT4vDXjeeMm3ETk2WqFQSwiLHdG+ATsYnIBwx6D7QhiVRlepr8xvDereAP2uv+CjSWXwm+H1z4Q8U+APEkd82tWL7YNVgtbgC5+2W4QLEzbSUcEsxO1ic4H6bRx7upOTjnHWo8V8iy/Jc0ovAYd0HUgpypcykqcnfaSb91rVLdFcLYuvisLJVp8/K2lK1rrzT6pkkiCMjOPbtXn37Rf7TnhP8AZe8FHW/ijemBJHENnaQL5t5qcxxiG3iHLuePYZySBzV749fGvRf2f/hVrXi74hz+RpWi25mfnMkz9EijB6u7kKB6mk/4JmfsD6r8SPFVt+0V+3FpwufHusoJvCvh+4XdbeCrB8NEERv+Xp1IZnIyu7HDZx7/AIPeE8/ECu8fj7xwVN200dSWnup9Eur+W5x8VcTrJ4+woa1Zfgu5wHws/ZS/aS/b7gj1b4i6zcfs7/Da9w9vptign8V6hEehmlPy2ZI5wBuHRlPWvffht/wQX/Zy8FsLvxp4T1Hx9rT8zan4q1e41Kac+rIzCLn/AHK+y4oUiTbEAAO1Kpw3Y5r+7Mk4by3h2gsNl1CNOC6RVvve7fm2fkGKxNbGz58RNyfmfOOp/wDBI/8AZs1mxa3vPgr8P0QgDdFpEUL/APfaAMPrmvFviD/wQN+HWjTy6h+xx4r8efBnXSd8b6Pq813pztxjz7O4ZhIv+yHWvvaUEnC9OtKrYfA59cV6WIwdHFU3SrRUovdNXT+TMY+47xdvQ/Jfxd8Xfi//AME//EttpX/BQrRrTW/BtxMLe0+I/hy3b7EjE4UajbAbrdjx8wG3PTdyR9DaF4gtPFmj21/oFzb3tldxrNBcQSCSOZGAKsrDhgQc5FfZfjbwDpHxD8NX+j+N7C11TStShe3u7S6iWWC5jYYZHQjDKQcEGvys+IPwnvv+CRv7R2m6FaT3V3+zx8RtQNvo0txKZT4I1OQswtGdjn7NLyUJ6EHPKsz/AMr+Lfgbhvq1TOOHqXJUgm5Ul8MktW4rpJLWy0fTU/QOGuLa1KpHC42V4vRSe69e/qfSTxCNg2DzyeazfF3grSPHmkSad410zT9Y0+Ygva3tuk8MhByCyOCDggHpWorecBk5PtSh9ytuxntx0r+PYuVNqpBtSXVbpn6rKEZx1Vz498c/8FO7D4S/t1aV8Eh4LuINNkntNL/tKKYR+VLcJGYfKtwmDEvmIpO4dyBxg+ifGX9jKb9quWOL9pHxTqkvhuCTzIvDehyGysHwcg3M3Mtyw45/dqOyg8n1fV/gt4S13x/Z+KtY8PaJd+JtOTyrbVJbKN7qBOcBZSNy9W6HjJ9TXS7dvevuMbxXh8O8PU4fofVaqpxjUknzSlJbyjJpuPN1s03+fiYXJ6lSM446ftIuV4rZJdmup5d8GP2Nfhj+z+8TfCTwRoWlXMQ4uxb+dd/9/wCXdJ/49XqAA44x3waUpnAOKQYKnZy1fIYzFV8dOVfFVHOb6ybb+93Z7dPD06EeWnFJdkrD4dxIwN3vQZzkjAx9aIiIlx3OKazbucDpXPHVK5pa71FZt5GOMUjQecjAcgYpFO5se3WpPP3dAQP5027aDfYyNH8F6R4d1S+vtB0vT7O91NhJd3MFskct2w6GR1GXPXlia1H2QD5mAB60roAG3c57+lc78OPhv4s/ae8eeOdL8E+K4fB9h4KFraI66al7NfXc8PnlpPMYBYkRogFUBmJf5wAK+04K4NzDxCzGWBwckpRjzSlJvSKaXm29dEeJm+bYfIqCqTjo3ZJLqfLX7TXxR0b4w/tq/DfwjriHX/Bfg++i1W60+GZUt/E+vNdR2thpIlb5C6zTLJKvO2LzSw+Wv0++GPx91+T4xJ4E+OvhbTfDOsXukSa1pk+m6s2pWN7bwyxRTp5jwQOksTXFvlShBEqlWOGA8c8F/D+x8Jf8E1PgtZ6vbwXNzp194I3yKuN12dX04STgnnc0jOxPU7mz1r0L4/fAbwv8df2x/h3B8UdKt9ZstF8La9dw2dyN9tLI11pCZljPyyAAkhWBAOGxlQR/o5wjw3heEspoZVhPgprfq3u5Pzb1PwvHY2pmOIniau8me6axr1loGiXeparcw29lZxNcTzSNhIo1GWZj2AAJP0rH+FPxf8M/HLwHp/if4R61p/iHQNVTzLW+sphLDMMlThh3BBBHUEEHmvJ/2OtBg8JeLfjN4K0zzT4b8LeLYrXSrKWRpIrC3uNI026eCMMTtiE1zOwT7qh8AAAAeN+IP+CXPjv9nT4har4j/wCCYPxPj+G1nr87XepeDtZsP7R8Oyzt96W3T71qT3CA54A2qAtfRo5D3z9rX9snS/2UtS+HNhqml3et6l8SfFdn4WsLS1dVljacndckN1jiABbH94dK5P8Abt/bW8RfsQan4S8Sav4JuvEPwquJZbfxbrWnl5r3w3nZ5M5tlH7yDJfe2cjAxyQG439nX/gnf471L9o7SvjB+398RLP4h+MvDEEtv4a0zS9P+w6L4e84bZZo4ycyysON7AEe+FK/X19p0WoWj295Ek0EilXjZdyuDwQQexyaAPEpf+CkXwMj+D8vjmL4qeCG8ORwGczrq0JkHy7tnk7vM8w9PL2788YzXzZ+zP8ACDxP/wAFNv2D/i9eftTS6qdE+MOv6hqPgyx1IYm8PaYNgsJI16oRJH5wHQjB5DnP0E3/AASn/Z0l8er4ml+DngQ6wr+d5n9lxiIvnO4wAeUWzznbnNe+QWMWnWawWEUcUartVEXaFHoBU1IqcXFiep+XX/BPL4tax8Tv2eINP+JokTxh4Hvrjwtr6yHLi8s38tix7syeWxPqxr3Pp9DXhHw60kfDX/gqN+1F4XtF2Wd9f6R4kijxhRJd2W+dvq0nJ9a93eYEjOR2wfwr/MjxLyalw/xRj8DQVoKfMl2U0pJfK5+/cN42WOy6hUlvbX5afpcRfb8eKfGdrcg0piGDkgimZPIPSvhtz3tJIWQlzwOvvSRqQCDwMdKQk9l/WnIenp160pPliJ7CSAsAD3AxxTmk42jvxQmemcDA4prN/dxkd6I6pBYdFIQDjoabKSy4AxSlgh+tMjcO+FOccdc01Z6k80b+YoAXjJ+biun/AOCdKgfFz43SEgAarpSH2xpsR/8AZq5qQHAOMcV0/wDwTiXzfit8cht4XX9MX/yk2p/rX9FfRmbfEeK/68v/ANLgfBeIM7YSkl1mvyZo31lPP+wD8LUtop2lj1bwY7osZLKF1rTS5I64ABJPYAmvUNfjkb9s7wo4jfy18G60pbadoY3uk4GfUhTx7GvS1tI1AiKgIpzt7etO8pGm81VG4DG7vX90H5IeJ/syBU/aG/aGLEYPjDT+vb/intJr2o3MbHajKT7GvlXTfg38T/Fv7SfxfsLWa48DfD7xF4hs9Um121nA1TWo10bTrZrayxn7MgktpA9wfn/hjAb94rP2f/hP4Xn/AGwJtR/Zr0pNI8LeA7K70nxBq8EsjnxPqsrx/wCjyysxN0bUI7SSuWYSzBA2VlALAfWKqT94+1HmjZwQBj1ryP8Abn/aqsf2Lv2XvFHxE162fUW0OBFs7JW2tfXcrrFBDnsGldATg4GTg4xXz58NP2Evjh8efCNr4q/aq/aI+J3hPxXq8Qu/7A8Ez2+l6XoW7DC22tFI1wU6F2bJweT1JYD7gBDEle4oYlATz0zzXxX4T8Y/tI/sTfFfw74f+N7XXx++GfiW/i06HxNpmlCDX/DckjbVN/bQfJPbg9Z1AK8lj0U/VPxs+Lej/A/4SeIPGPxBuhY6N4d0+bUbyVuDHHGhc4z1Y4wB1JIFJ6Bex+cWj6iPF/8AwVy/ac1aycyWmmReH9G3joZEsdzr+B4Ne3sFUD0r54/4Jw+H9W1n4P678SfiJA8HiP4xeILvxheRvndBFcSf6PGM87REFI9nr6LMowCvH9a/zM8U81o51xXmGLoO8eflTXXkShf5tOx++cM4SWDy2hTktbX+/X9SJcjPB9x6UoBPXg5z1pd5Lnpx1pWcMK+B3PfGyjaTg9eKRScY6H604jkU7ZtfnGSeaUnZMH2Gyr0weO4pm3AXkYPqKeBl8DgAcV83ftXftwa9+zN8QLHwtoXw61/xxrXiqIzeHE0zAiuCgAmjnY7mUxsVclVIKSLnGCa9fIMixnEtf6pguXnSu+aSirLd3lZaLV67XPPx2YU8vpqrUvbbRN6vZadz3Tx34Xm8XaJ9isdZ1PQw7DzJ7ExrMV5G0NIjbc5+8uGHYivG/wBmPxN4O+GXxh8RfDDwR45fxVO0b69HBear/aF9YuXCXEUspJYje0ciqxLAySZ4AryZv2X/ANoT9stkk/ay8bQ/DfwjcHcfC/hV8XMqHqk9zk9uuWkXr8orpdc+BXw8/Yd8KaXa/sueC59X8fJfWk0ENlGbzVbuAzKk7XEx/wBVC0BnBZise7GBkCv0LC5Tl1LBVcijj3iK01dKmkqNKS15p1JW5v5bx0Sk9T5qpjsRKtHFqkoR/vaykuyitvmfWTuflAJI79q6X/gnLex2vxk+N9tIzedJq+lXeD/zzfTYo1b6FreQZ9VPpXNW7FoIy4I3AEA8EfUVzwbxJ8KfixD48+Cy2txqbWi6drGk3Upht9dtFdnjUygN5U0TSStHJtYfvZEYYYMm3gdxdgeDuIZVcylyU6sHDm3UXdNN+Wlr+ZpxfllfNMFH2CvKLTt33/zPvwEbs56g8etKFC9O36V83+G/+CkngyWIR+PdH8eeFr5RiS3vPDV3eKD/ALNxZRzwt+En4VneOf8Ago1ZanZSW3wG8J+KvE+quhEU1/ps+h6dCxHDTTXiJIVz18qKVvav7mrcdZBhqDxNXHUlBK9+eP8Anc/JaeVYypLkjRlzejOq/aJ8ea18TfiNZfCT4M6jcaVqWo2n9o+J9atjibQNLZiiiFui3VwySJET9xY5pMEoob1j4ZfDbRPhD4J03w38OtPg0vSNIhFva28QwqKOuSeWJOSWJJJJJJJJr81v2W/+Cm//AAxh4l1/S/8AgpF4N1fwrrfivWZNRu/iBp8cmpaFq7OQkKO6L5lqsUSxQpEVOFjycEsT+hXwf/aj+HXx+0lL74L+NvC/iiBwDnTNThuSvsyoxKn2IBr3cszbCZzh44nBVY1IPVOLTRxVKc6E3TqxcZLdM3fiV8KfDvxh8PLpPxP0PTfEGmLcw3f2W+t0nhEsTiSN9jgjcrKrA9iK3VUJGMEnYMfSorrU47UF55Y0QdSTgCvBf2jP+CoPwN/Zcsbhvip8RPDi38PA0ywulv8AUZW4wgtoN0mST1IA9SK65V4QV5O1jO+yXU99uLhI4jJLjanrX5f/ALfX7RL/APBS346/8KM+CFzLN8KfB19Fd/ELXrdv3Gp3ET7o9Kt5Bw/zqGkYZAK9fkIat8Zf2p/jb/wUvabQvhPput/A74OXnyXur34EfibxDAR8yW8QOLSNgcFiSSDkMQSh9J+CvwR8N/s+fD2w8L/CvTItM0ewXCRrktIx+9JI55d2PJY8mv5r8XfG7B5Vh6uUZFVVTEyTjKcXeNNPfXrPsle27PueF+Fa+NnHFYuPLTWye7f+R1GnWUWlWUVtYRRwwW8axxxoMKiqAAAB0AAFSINxHY5pSMDINHmeZg8Z61/EvLppufsMYciUVsZ3ibxbpfgjSXvvGOo2WlWiusZuLudYYgzEBQXYgAliAPUmrsdws8aPCwkV1BBHII+tfPH7bepT+NPFngn4ceJvhRffEDwb41vfK1nUI5ZI49FCsgWUtGMoy7mfcWTIUgE5OMP4Ofs5XHwP8Tano/7IPxXe+s9ClRdQ8H+I511S1sCyqyxpJGVntMowIPzg5yVavtaXCuGnltPE1MQ4VpLn2U6fLflXNKDlKnK6fxxs+54TzSosTKnyXinbs7+SfxL0Z9UDKrkHg98YxRnpuwQBzXn3iD492/wr+G2q+Ivj/bHwrYaDCst7c+aLq2cMwUGFkHmPlioAaNGJYcV0/wAOfiDpHxT8GaX4h8CXkeo6RrFut1azoCFljYZU4IBH0OCDwa+axeU4rCUPrFWD9k5cqmrOLkkm0pK6ejT3PTo4ylWl7NP3rXt1S8zZzkDeM4rJ1zwrZaxrul6peRZvNJeRrd84Kh02up9VIwceqqe1awOABx8opHO9CDwfX+dcFKpUopSg2naztvZ6NfNXNqtNTjqrnhemf8FA/APiD4s6z4Q8PDxPqU3h6drTUtUs9EuLjS7GZSVZJbhFITBBBZgEGD82BmuKi1jVP2QtG13x38YPivP4xtPE/iGD+ybKXZ5TWk8yotvaoCdzoshcGPCkRnIwSRD8bda179gHRr1f2efDC+Mbj4n+KpZtN0oo0TWepXUZeRpJVyHhJhLBTsIyRv2j5fNLD9njw9+zBDJ8eP8AgpV4isda8YpN9p0/R7SNVsNNuD8yx2kC4E0+QPm4UEFiTjzK/e8qybKlQf1FP2OJsqdFONSrXcU1714p0YqV+d3tponoz4Ovi8Spfvvjh8UneMYJ9tfebWx9hftA/HDSv2d/hHrHjDxrJEljo0PmsjSiNrg5H7uPPWRuir3bAyAcjb+GXxB0r4r+ANJ8R+C7k3mk61bLdW021kMiMMglWAIPsa+MvAvwa8RftweJrb4s/t3xt4d+G+jt9q8OeDJWbyhGT8t1f8fNkYJ3AcZJ2pw31d8e/jHp37N3wS1jxXfRW66Z4csxOYd4gEqqVAijOMB2HyouMFio4HI+DzjhjC4OWFyfL06+NlNqU1pT5na1KLa95x6yva7t6e7g8zqS9piq1oUklZPe38z7X7HeSQbVwCeDkcU4WqJ2Ubq5b4PfFzTPjV8MND8V+FI7+LTtctUu7Zby3ME2xum5D0+vIIwQSCDXTg7tuOWA4FfB1sPOhVlQrK04tprs1o/xPbozp10pxe/6lfVdGtNbsJbbUreGe3mUpJDKodJFPVWDcEH3rw3x1/wTF+BvxA1Q3uoeAdKsLtju87SpJdObPri3dFz+Fe+NHgZznPOKTAx8v4135Zm+OyZ82AxE6b/uylH8mhVsFh8Wv3sFL1Sf5nzMf+CTHwenyusWvi3U7duttdeJb14f++RIK9J+D37FXwr+Atyt18KvA+gaRfoPluxb+ddr9JpCzj8Gr1KY4lGOnemEfL8wxXbmHFWdZtD2eMx1WcX0dSTX3XsZUMpwWH1pUYp+SQiQiIhlbJPt1pxPzD1PbFIshwCuD9KUDaPmyfevn401FWPQSS0GuuThvu96XfhPkzlfajOBnmuc+Jfxn8L/AAj0yK8+JviDRfD8E7mOF9QvI7dZn/uqXIyfYZrqwuFr46tHD4aDnN7KKbf4fmc+IxVPDRcqjsjnv2hf2jdH/Z98OQ3viHTvEWu3lyX+zaZoWntfX9wqAGR1iXGEQEFnYhRkDOSAfkzwj+zz8Kv20/P+I/7Dfj3X/A/xQt5Xlv703Un2yS4c5YahaO3Rmz/q8R4yAGA2jcl/b18QfBv9qGO7/a68Gnwn4C8RxSWnhzxLC63VukDvG8S3LxF1Vm2lmwcjKZGF3V137Sf7DGk/EzUo/ix+yP4gj8EfEWGL7bb6xpbB7HXFIDBblEysgcAfOA2QfmDjFftWV4L/AFPdLBSqyoTrKLjiIy9pQqTtrTqws48qvyvdp3bTW3wuJxDzRyqJKcYvWD0mlp70XvfqujMLwF8b/inr3jK2+B/7bPwv0zxJea/EzR67aFX0bU7OJlM006MuEKAqdqgHe8Y2JkNX1z4U8N2Hg/w9aaX4XsrbT9N0+JYLa2t4hHFDGoAVUUcAAV53+yxbeN/EPw00bxL+01baRB40vLQbraxtjCunROEJiJZmYyMVVn5wCAoA25PqsRyDz/hX5txjmdHGYl0MNThCEL8ypuXs5VNpTim7JPRKyS67M+oyfCSo0vaTbbe3N8SXRN9RX+RRg9RxTTyck8fzqWP7nyE8DvTYj8jbuuK+Vi7I9lPsZfjDwjY+LtGe01uGOeEsGXcgYxOOVddwOGU8g9QQDXx34l/ZJu9I+Jnj74r/ALbmuyfEDTvh/YSXnhW2uoEjsIrZIWkZ5IEAQzhk2n5cEgNzlQn2wDsXLAY964n9oL4G6B+0d8LNX8JfEWCSXTdWhMbPG5SWBv4ZI27MCfcHkEEEg/Y8HcW1uHcXGjVqNYepKKm4pcyjzRclF6NcyVpJNXW99Dws4yiOOg5xjeaTtfa/S/p0Pnr/AIJ7fAOz+IH7CPheb45T65rM3iO0uJ7mK51q8ELWsksgji8tZgojEOwbcYwa8xg0GL9vr4vReF/Bbapd/s8fBucvPm4edvFF9Hlkt45XbdJEg+Vcsfl7/OpXuv2t/DnxN8HfA/wJ8GPhFYRaf4e1pLLwxf8AjOG4wtlbCNI3EkGA0LSkMu7cykHbuDOMH7Vus2/7Gf7N3hL4G/sk2+3xl46I0PSI1OJ40fAub6VgOG+Y/OcYLEjhOP1zKMXXr4h14YnnrYydSUWpN08NQTftKl9ozcbxS0cV5tHy2JoRjDlnTtCkkrW1nPovNX18zt/Dun2nxw+NHhb4u/BH4vY+GnhjS5rO+8P2TlbKRgkhJmUsBEVWRCVkTcvlLjGeG6L/AMFLPDGpeC08a6zp82jfD2+1tdC0nV7yc/aNam3FTJBaLGT5QKudzOpwjcZGK8b/AGu/hZa/s1/sf/D39n/4HGR/F/xAv00iK5glaGWYOV+33UuxgSj7lQq2Rsb/AGK+sPhR+zfovw8+D+heCvEdnpOv6N4XWAaaLvTYy0TxAbZGBypl3Fm3qqnLdzkn5jO3kmEwOGxmNTrKo3CjGVoTjh4OUYyvFWcpTafNPXlT8jvwixcq86VG0OWzm1dpzdm16JdF1PTIn84Ejgemf1pzxlT3NfIvjf8Aaz8RXf8AwUb8LeBdOu9R8O+E9F0CfVfE1tLbQzCd3JSAvLH5nloD5Tbgyj58Gvp/Ufih4e0mytLjWtc0i0gvkD2sk15HGtwCOChYjcPpXwGc8J5hksqEZQc3VpqpaKcrKV7JtK17Wbs7WaPfwWc0cYptOyjJx10vbdr5m1I+SSOuaTduxjsPzqG2vY763WW3ZHRwGV1OQwPQg+mK53xB8bPCXhjxJDpGveJNEs9Vug5is5b+JLiQJG0jkRlt2AisxOOAM14OGwWKxtR0sPRlKS3STbXrY9Cri6VJJykrPbU6lEXJLZ55NBwcnJwK8D8Q/wDBRDwDZ6lrWj6LdXk/inSbux0+PSZ7d7WW5nvHRLcAyLwpLhmJGUXJK5wDwv7UPxr+JPw38e+HvCfjmZLTwp8RZ/7KtvEPhG3ddV0O8YZUSRzeaskeDkyIEYBWI2kYP1+C8P8ANMRiI0MXajdOVpX5nCKTlKKW9k7rVc3S55NfiChCDnRvNbad3smfRvxQ+Ik3gXwdf6noGjar4lvLJGI0/TBG08rBd23Mjqq8DPJ7jGSQD88+CpNX+NkfxQm/bO+HGiweCLmyiudM1Qzrdve2UkZYQxn7ylF2kMoQ+YxIG45rkvhF8evE3/BPjVLL4d/towi78I3ty8eh+P7aNjBctI5YpqOcmOUlj+8Y565LAF69R+I/w71348fsLyeHfglqtpaa9bJFBpl55oME8mn3i7QXGQUk+y43cj5s8ivqsFlVPhZQi+T2FWrBRxSctYX5ouMk7Ra5Wpq11fVXSZ4tevLMZSmrucYu9Oy32d1b7u58/fBvUrn9kDxDbfAH9ui3s9c+GPjK33+FtU1LD21mzYL2E7twux2AV8ja21hhWGz139jb9kS++CnxS1Gf4UeOPENx8GLm3iv9E0aaYPGbmTdv2Sn5zAq7GGCocuN27Zluu+HXwd8VftB2VpqH7dvhDwUr6ZB5NnosONRh85mjZ7mRnUqpPkoERSdoZ8s27A98s7eOztkhtkSOKNQiIigKgHAAA6CuLirjVyhWweGa9rWivbuDUqMp6Nzpq2k2tJSWj1tvc6sqyXmlGrVT5Y/AmrSt2l5LomSmPZsHXjr07ClWQMRvGAO1N4ZeOR9etIgCNyMY5FflPKoxaPrraWH7vKGSMkill55pNjNtzk4FSOxcEHg46VMZRilqLRMhOPYL60SP5mDtFBgfIHAUnnmpPLKEdz0NXJoba3K80STRsLhQwB4rwuz/AGLNK8G/tRL8WvD11qusaomkzacNP1O7e7W2DYZWs5JWJhPDIUJK4kYjb0PvYtju65zwRik8g5wAB2zXoZbnOKypVKeGqWp1Fyzj0lF7p/5qz8zixOCo4pxlNap3T7PufGHwa8P678Wf+CnHiHxl8fvD+peFx4Z0VNO8F6dqOw/aFfd9ouI5I2aKRwPMyEZiomGfu5r7OnjXYdynjpTDZh2UuAxU5B/wp10rMnBBHt/OuziPiBcR4ylWq0+SMYwgoxd4xjBJWinql1s23dvXUwwOB+o0ZU0+Ztt3e7b7nxx/wT6kHxf/AGq/2gPio482C41yPwvpcuP+WFmgDY9mCwH60n/BLGdv2g7b4ifF/wCIqLqOu+KfENzptpJcDzP7P06AL5VtFn7ifOdwH3ioJya9F/Zu/ZP8Qfs4aZf+F/CWvab/AMIdc69NrazrauuqFZXVzbOS3lkZUKZepTICqcMMz9mH4M+I/wBifQvF/hPSPDl74q8M3esXGs+H59OuLdJoUnAzazpPLHtKsow4LAhiTtIxX6hn2dYHNaOZUsuxMVUrTocl3yWoU1ycvNLlSatGUo389WmfMYXCVsPUoSrU3yxjK+l/fbTvZb9Ujnf2DPGU/h39rz4/fDDS3b/hF/DOq22o6Ta5/d6b9pRnmhiH8KFyCEGAMNgc1z3/AAVm8C6Z4W8YfBX4lTWcEI0Pxja6fqtxFGEeWznILrI45ZcQuuD2kYdzXrP7DP7MGtfB6/8AHnjX4vPaHxn8TdXOq39vauZIdNiBfybZZDjeUEjZbAB4HOMm/wDt+fs6ax+1X+zxe+BPBf8AZ1rdarc28q6heTMiaeYZkkLhURmdiAygcfeJJ9eSjxDl1Hjd4qhWSw0o8lSd7KX7nknLTe8rtdW9ep0yy+tPKFCUG6ifMl1XvcyXlpoedf8ABT79mb/hK/2e9b8XfBPRrG28d6Jf2fiR7yztFF5qP2MMMM6jc5RHZwDnOwCu/wD2S/jv8O/jB8FrXx/4Wv8AT47prMNrE99eiS802UAGWK4llYuiqwJGSFIwQMGvSvg34c8V+HfBVnYfF3UNI1jUra3jge4sLOS2SUqgBZg8rklsZ42jk8VyY/YW+EY8et4n/wCFd+Fhrjy+c8ws12tJnO8xf6vdnndtznnOa+f/ANZcHVyxZPms51FRm5U505fFF2vTkp8r5br3X9nXRnTHK60K7xOGSjzrVS6Purde/c6LTtO0r9o74QlPiJodvd6L4ijkJsruPetxbF28l2RgCpeMRyYwCpb1Gab+zn+z9o37M/wxt/CXgKS9bRLC4uJrOK6l817dJZWl8sNjJVS7AZycdSetd1BB5K428YAxml2MBluuMV8XVzKtVp1MNCXLQlLn9nf3U9bWT6pNq/U92jg6dOSqtXna1+vmEK5yAPzpAe1OER2knBI+pprwlgCMH1rhVr6M7NL3FjxHkKBk4zTmxKw4796NhVeDg9wKRBuO5ONuM0ptWYnbc//ZAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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" data-filename="image.jpg" style="width: 125px; height: 125px;"><p><br></p>";s:11:"from_person";s:16:"Super Admin User";s:9:"to_person";s:10:"Soyab Rana";s:9:"timestamp";s:19:"2014-10-01 15:52:49";s:10:"from_avtar";s:36:"dcf8544d6647c2095e8b2cc9796455be.jpg";s:8:"to_avtar";s:36:"5865aa782c8c4ee571acac7af45b9d94.jpg";}', 1, '2014-10-01 10:22:50');
INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(128, 'N', 'new_announcement', 1, 37, 4, 'a:12:{s:2:"id";s:1:"4";s:4:"type";s:6:"single";s:8:"group_id";s:1:"0";s:7:"from_id";s:1:"1";s:5:"to_id";s:2:"37";s:7:"subject";s:7:"Testing";s:12:"announcement";s:13:"<p>Hello.</p>";s:11:"from_person";s:16:"Super Admin User";s:9:"to_person";s:10:"Soyab Rana";s:9:"timestamp";s:19:"2014-10-01 16:01:15";s:10:"from_avtar";s:36:"dcf8544d6647c2095e8b2cc9796455be.jpg";s:8:"to_avtar";s:36:"5865aa782c8c4ee571acac7af45b9d94.jpg";}', 1, '2014-10-01 10:31:15'),
(129, 'N', 'event_invitation', 3, 37, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"4";s:9:"event_for";s:2:"AC";s:9:"school_id";s:3:"1,3";s:7:"en_name";s:56:"Lorem ipsum dolor sit amet, consectetur adipiscing elit.";s:7:"it_name";s:55:"Presentazione agli istruttori anno accademico 2014/2015";s:7:"city_id";s:1:"6";s:9:"date_from";s:10:"2014-09-21";s:7:"date_to";s:10:"2014-09-21";s:7:"manager";s:2:"45";s:5:"image";s:36:"94d18f13b2105af7ca34fe397ddb6a0f.png";s:11:"description";s:11:"<p><br></p>";s:7:"user_id";s:2:"46";s:9:"timestamp";s:19:"2014-09-18 20:17:59";s:14:"to_individuals";a:1:{i:0;s:2:"37";}}', 1, '2014-10-08 04:09:42'),
(130, 'N', 'event_manager', 1, 37, 18, 'a:11:{s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:0:"";s:9:"event_for";s:3:"All";s:10:"academy_id";s:1:"1";s:16:"eventcategory_id";s:1:"5";s:7:"city_id";s:1:"2";s:4:"role";s:1:"6";s:7:"manager";a:1:{i:0;s:2:"37";}s:9:"date_from";s:10:"10-10-2014";s:7:"date_to";s:10:"10-10-2014";s:11:"description";s:14:"<p>adasdas</p>";}', 1, '2014-10-08 07:29:57'),
(131, 'N', 'event_manager', 1, 37, 18, 'a:11:{s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:0:"";s:9:"event_for";s:3:"All";s:10:"academy_id";s:1:"1";s:16:"eventcategory_id";s:1:"4";s:7:"city_id";s:1:"2";s:4:"role";s:1:"6";s:7:"manager";a:1:{i:0;s:2:"37";}s:9:"date_from";s:10:"10-10-2014";s:7:"date_to";s:10:"10-10-2014";s:11:"description";s:13:"<p>asdasd</p>";}', 1, '2014-10-08 07:32:52'),
(132, 'N', 'event_invitation', 1, 37, 18, 'a:15:{s:2:"id";i:18;s:16:"eventcategory_id";s:1:"4";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"2";s:9:"date_from";s:10:"2014-10-10";s:7:"date_to";s:10:"2014-10-10";s:7:"manager";s:4:"37,3";s:5:"image";s:36:"579f4c645204d29c9c76143930d559b6.jpg";s:11:"description";s:13:"<p>asdasd</p>";s:7:"user_id";s:1:"2";s:9:"timestamp";s:19:"2014-10-08 13:02:52";s:14:"to_individuals";a:1:{i:0;s:2:"37";}}', 1, '2014-10-09 07:00:39'),
(133, 'N', 'teacher_assign_class', 1, 3, 7, NULL, 1, '2014-10-10 08:29:18'),
(134, 'N', 'challenge_made', 36, 0, 8, 'a:14:{s:2:"id";i:8;s:4:"type";s:1:"R";s:7:"from_id";i:36;s:11:"from_status";s:1:"A";s:5:"to_id";s:1:"0";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-10-14 13:41:59";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-10-20 02:10:00";s:5:"place";b:0;s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:36;s:9:"timestamp";N;}', 1, '2014-10-14 08:11:59'),
(135, 'N', 'challenge_made', 36, 0, 9, 'a:6:{s:14:"challenge_type";s:1:"R";s:7:"from_id";s:2:"36";s:5:"to_id";s:2:"25";s:4:"date";s:10:"12-11-2014";s:4:"time";s:4:"1:05";s:5:"place";s:6:"Baroda";}', 1, '2014-10-14 09:49:33'),
(136, 'N', 'challenge_made', 25, 0, 10, 'a:6:{s:14:"challenge_type";s:1:"R";s:7:"from_id";s:2:"25";s:5:"to_id";s:2:"37";s:4:"date";s:10:"17-10-2014";s:4:"time";s:4:"1:05";s:5:"place";s:8:"sdfsdfsd";}', 1, '2014-10-14 10:11:32'),
(137, 'N', 'challenge_made', 25, 37, 12, 'a:52:{s:5:"error";a:2:{s:3:"all";a:0:{}s:6:"string";s:0:"";}s:6:"stored";a:14:{s:2:"id";i:12;s:4:"type";s:1:"R";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"37";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-10-14 15:43:59";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-11-18 01:05:00";s:5:"place";s:3:"asd";s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}s:5:"table";s:10:"challenges";s:5:"model";s:9:"challenge";s:11:"primary_key";s:2:"id";s:5:"valid";b:1;s:14:"cascade_delete";b:1;s:6:"fields";a:14:{i:0;s:2:"id";i:1;s:4:"type";i:2;s:7:"from_id";i:3;s:11:"from_status";i:4;s:5:"to_id";i:5;s:9:"to_status";i:6;s:7:"made_on";i:7;s:17:"status_changed_on";i:8;s:9:"played_on";i:9;s:5:"place";i:10;s:6:"result";i:11;s:13:"result_status";i:12;s:7:"user_id";i:13;s:9:"timestamp";}s:3:"all";a:0:{}s:6:"parent";a:0:{}s:10:"validation";a:14:{s:2:"id";a:3:{s:5:"field";s:2:"id";s:5:"rules";a:1:{i:0;s:7:"integer";}s:5:"label";s:0:"";}s:4:"type";a:3:{s:5:"field";s:4:"type";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:7:"from_id";a:3:{s:5:"field";s:7:"from_id";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:11:"from_status";a:3:{s:5:"field";s:11:"from_status";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:5:"to_id";a:3:{s:5:"field";s:5:"to_id";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:9:"to_status";a:3:{s:5:"field";s:9:"to_status";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:7:"made_on";a:3:{s:5:"field";s:7:"made_on";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:17:"status_changed_on";a:3:{s:5:"field";s:17:"status_changed_on";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:9:"played_on";a:3:{s:5:"field";s:9:"played_on";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:5:"place";a:3:{s:5:"field";s:5:"place";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:6:"result";a:3:{s:5:"field";s:6:"result";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:13:"result_status";a:3:{s:5:"field";s:13:"result_status";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:7:"user_id";a:3:{s:5:"field";s:7:"user_id";s:5:"rules";a:0:{}s:5:"label";s:0:"";}s:9:"timestamp";a:3:{s:5:"field";s:9:"timestamp";s:5:"rules";a:0:{}s:5:"label";s:0:"";}}s:8:"has_many";a:0:{}s:7:"has_one";a:0:{}s:16:"production_cache";b:0;s:21:"free_result_threshold";i:100;s:16:"default_order_by";N;s:4:"load";a:0:{}s:6:"config";a:3:{s:6:"config";a:61:{s:8:"base_url";s:27:"http://localhost/ludosport/";s:16:"custom_languages";a:2:{s:2:"en";s:7:"english";s:2:"it";s:7:"italian";}s:11:"custom_days";a:7:{i:1;a:2:{s:2:"en";s:6:"Monday";s:2:"it";s:6:"Lunedi";}i:2;a:2:{s:2:"en";s:7:"Tuesday";s:2:"it";s:8:"Martedì";}i:3;a:2:{s:2:"en";s:9:"Wednesday";s:2:"it";s:10:"Mercoledì";}i:4;a:2:{s:2:"en";s:8:"Thursday";s:2:"it";s:7:"Giovedi";}i:5;a:2:{s:2:"en";s:6:"Friday";s:2:"it";s:8:"Venerdì";}i:6;a:2:{s:2:"en";s:8:"Saturday";s:2:"it";s:6:"Sabato";}i:7;a:2:{s:2:"en";s:6:"Sunday";s:2:"it";s:8:"Domenica";}}s:13:"custom_months";a:12:{i:0;a:2:{s:2:"en";s:7:"January";s:2:"it";s:7:"Gennaio";}i:1;a:2:{s:2:"en";s:8:"February";s:2:"it";s:8:"Febbraio";}i:2;a:2:{s:2:"en";s:5:"March";s:2:"it";s:5:"marzo";}i:3;a:2:{s:2:"en";s:5:"April";s:2:"it";s:6:"Aprile";}i:4;a:2:{s:2:"en";s:3:"May";s:2:"it";s:6:"maggio";}i:5;a:2:{s:2:"en";s:4:"June";s:2:"it";s:6:"Giugno";}i:6;a:2:{s:2:"en";s:4:"July";s:2:"it";s:6:"Luglio";}i:7;a:2:{s:2:"en";s:6:"August";s:2:"it";s:6:"Agosto";}i:8;a:2:{s:2:"en";s:9:"September";s:2:"it";s:9:"Settembre";}i:9;a:2:{s:2:"en";s:7:"October";s:2:"it";s:7:"Ottobre";}i:10;a:2:{s:2:"en";s:8:"November";s:2:"it";s:8:"Novembre";}i:11;a:2:{s:2:"en";s:8:"December";s:2:"it";s:8:"Dicembre";}}s:10:"index_page";s:0:"";s:12:"uri_protocol";s:4:"AUTO";s:10:"url_suffix";s:0:"";s:8:"language";s:7:"english";s:7:"charset";s:5:"UTF-8";s:12:"enable_hooks";b:1;s:15:"subclass_prefix";s:3:"MY_";s:19:"permitted_uri_chars";s:22:"a-z A-Z0-9~%.:_\\-=&~|?";s:15:"allow_get_array";b:1;s:20:"enable_query_strings";b:0;s:18:"controller_trigger";s:1:"c";s:16:"function_trigger";s:1:"m";s:17:"directory_trigger";s:1:"d";s:13:"log_threshold";i:0;s:8:"log_path";s:0:"";s:15:"log_date_format";s:11:"Y-m-d H:i:s";s:10:"cache_path";s:0:"";s:14:"encryption_key";s:22:"**_B|@CK!DS0|UT!0NS_**";s:16:"sess_cookie_name";s:10:"ci_session";s:15:"sess_expiration";i:7200;s:20:"sess_expire_on_close";b:0;s:19:"sess_encrypt_cookie";b:0;s:17:"sess_use_database";b:0;s:15:"sess_table_name";s:11:"ci_sessions";s:13:"sess_match_ip";b:0;s:20:"sess_match_useragent";b:1;s:19:"sess_time_to_update";i:300;s:13:"cookie_prefix";s:0:"";s:13:"cookie_domain";s:0:"";s:11:"cookie_path";s:1:"/";s:13:"cookie_secure";b:0;s:20:"global_xss_filtering";b:0;s:15:"csrf_protection";b:0;s:15:"csrf_token_name";s:14:"csrf_test_name";s:16:"csrf_cookie_name";s:16:"csrf_cookie_name";s:11:"csrf_expire";i:7200;s:15:"compress_output";b:0;s:14:"time_reference";s:5:"local";s:18:"rewrite_short_tags";b:0;s:9:"proxy_ips";s:0:"";s:10:"datamapper";a:18:{s:6:"prefix";s:0:"";s:11:"join_prefix";s:0:"";s:12:"error_prefix";s:3:"<p>";s:12:"error_suffix";s:4:"</p>";s:13:"created_field";s:7:"created";s:13:"updated_field";s:7:"updated";s:10:"local_time";b:0;s:14:"unix_timestamp";b:0;s:16:"timestamp_format";s:0:"";s:16:"lang_file_format";s:14:"model_${model}";s:23:"field_label_lang_format";s:17:"${model}_${field}";s:16:"auto_transaction";b:0;s:22:"auto_populate_has_many";b:1;s:21:"auto_populate_has_one";b:1;s:18:"all_array_uses_ids";b:0;s:9:"db_params";s:0:"";s:15:"extensions_path";s:10:"datamapper";s:10:"extensions";a:0:{}}s:8:"app_name";s:12:"My Ludosport";s:10:"login_logo";s:36:"0423827148634df9ea8f50f9942d9b9d.png";s:9:"main_logo";s:36:"c9556fdcaba5327d7973f6f86974a69f.png";s:8:"timezone";s:4:"UP55";s:12:"default_role";s:1:"6";s:18:"notification_timer";s:5:"10000";s:8:"protocol";s:4:"smtp";s:9:"smtp_host";s:20:"ssl://smtp.gmail.com";s:9:"smtp_user";s:26:"soyab@blackidsolutions.com";s:9:"smtp_pass";s:10:"soyabsoyab";s:17:"data_table_length";s:21:"10,15,20,25,50,75,100";s:9:"smtp_port";s:3:"465";s:19:"reset_app_day_month";s:5:"31-12";s:20:"basic_level_under_16";s:1:"3";s:20:"basic_level_above_16";s:1:"6";s:15:"user_premission";a:5:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}}}s:9:"is_loaded";a:1:{i:0;s:26:"body/config/datamapper.php";}s:13:"_config_paths";a:1:{i:0;s:5:"body/";}}s:4:"lang";a:2:{s:8:"language";a:457:{s:14:"alpha_dash_dot";s:92:"The %s field may only contain alpha-numeric characters, underscores, dashes, and full stops.";s:15:"alpha_slash_dot";s:101:"The %s field may only contain alpha-numeric characters, underscores, dashes, slashes, and full stops.";s:8:"min_date";s:33:"The %s field must be at least %s.";s:8:"max_date";s:31:"The %s field can not exceed %s.";s:8:"min_size";s:33:"The %s field must be at least %s.";s:8:"max_size";s:31:"The %s field can not exceed %s.";s:11:"transaction";s:20:"The %s failed to %s.";s:6:"unique";s:37:"The %s you supplied is already taken.";s:11:"unique_pair";s:59:"The combination of %s and %s you supplied is already taken.";s:10:"valid_date";s:39:"The %s field must contain a valid date.";s:16:"valid_date_group";s:42:"The %2$s fields must contain a valid date.";s:11:"valid_match";s:28:"The %s field may only be %s.";s:16:"related_required";s:32:"The %s relationship is required.";s:16:"related_min_size";s:40:"The %s relationship must be at least %s.";s:16:"related_max_size";s:38:"The %s relationship can not exceed %s.";s:18:"dm_save_rel_failed";s:44:"The %s relationship is not properly defined.";s:18:"dm_save_rel_nothis";s:61:"Unable to save the %s relationship: This object is not saved.";s:17:"dm_save_rel_noobj";s:69:"Unable to save the %s relationship: The related object was not saved.";s:5:"hello";s:5:"Hello";s:7:"welcome";s:7:"Welcome";s:6:"logout";s:7:"Log out";s:6:"manage";s:6:"Manage";s:4:"list";s:4:"List";s:4:"view";s:4:"View";s:3:"add";s:3:"Add";s:2:"ok";s:2:"Ok";s:4:"save";s:4:"Save";s:4:"edit";s:4:"Edit";s:6:"update";s:6:"Update";s:6:"delete";s:6:"Delete";s:6:"cancel";s:6:"Cancel";s:4:"back";s:4:"Back";s:7:"actions";s:7:"Actions";s:6:"select";s:6:"Select";s:8:"selected";s:8:"Selected";s:4:"name";s:4:"Name";s:5:"total";s:5:"Total";s:11:"information";s:12:"Informations";s:8:"activity";s:8:"Activity";s:5:"users";s:5:"Users";s:3:"new";s:3:"New";s:8:"read_all";s:16:"Mark all as read";s:7:"see_all";s:7:"See all";s:8:"view_all";s:8:"View all";s:15:"compulsory_note";s:68:"Fields marked with <span class="text-danger">*</span> are mandatory.";s:7:"details";s:7:"details";s:7:"loading";s:7:"Loading";s:11:"browse_file";s:11:"Browse File";s:2:"no";s:2:"No";s:3:"yes";s:3:"Yes";s:8:"download";s:8:"Download";s:20:"change_email_privacy";s:20:"Change Email Privacy";s:13:"you_logged_in";s:28:"You are already logged in :)";s:17:"not_active_member";s:51:"You are not an active member. <br /> Contact Admin.";s:12:"invalid_user";s:28:"Invalid Username or Password";s:16:"register_success";s:26:"Registration is successful";s:22:"register_step2_success";s:79:"Congratulations, you have joined Myludosport!! We are considering your request.";s:18:"try_after_sometime";s:25:"Please try after Sometime";s:18:"check_mail_address";s:24:"Check your Mail Address.";s:11:"mail_failed";s:37:"Unable to send mail. please try again";s:22:"email_addres_not_extis";s:27:"Email Address does not exit";s:23:"login_with_new_password";s:23:"Login with new password";s:20:"error_reset_password";s:24:"unable to reset password";s:12:"status_error";s:65:"Your Status is Neighter ACTIVE nor PENDING. Please Contact Admin.";s:15:"permisson_error";s:59:"You dont have permission to see it :-/ Please contact Admin";s:16:"add_data_success";s:23:"Data added successfully";s:14:"add_data_error";s:20:"Not able to add data";s:17:"edit_data_success";s:25:"Data updated successfully";s:15:"edit_data_error";s:21:"Not able to edit data";s:19:"delete_data_success";s:24:"Data delete successfully";s:17:"delete_data_error";s:23:"Not able to delete data";s:23:"password_change_success";s:29:"Password Updated successfully";s:20:"message_sent_success";s:25:"Message Sent Successfully";s:18:"message_read_error";s:21:"Error in reading Mail";s:19:"message_reply_error";s:22:"Error in replying Mail";s:18:"unauthorize_access";s:18:"Unauthorize Access";s:12:"no_data_exit";s:13:"No Data Exits";s:15:"no_student_exit";s:16:"No Student Exits";s:28:"invitation_send_successfully";s:28:"Invitation Sent Successfully";s:25:"attendance_next_week_done";s:29:"Attendance for next week done";s:28:"attendance_save_successfully";s:29:"Attendance Saved Successfully";s:18:"attachment_removed";s:31:"Attachment removed successfully";s:27:"communitate_absence_success";s:32:"Communicate Absence Successfully";s:21:"email_privacy_success";s:34:"Email privacy changed successfully";s:18:"no_student_in_clan";s:32:"No Student is there in your Clan";s:12:"back_to_home";s:12:"Back to Home";s:16:"approved_success";s:21:"Approved Successfully";s:18:"unapproved_success";s:23:"Unapproved Successfully";s:25:"announcement_sent_success";s:30:"Announcement Sent Successfully";s:23:"announcement_read_error";s:29:"Error in reading Announcement";s:24:"announcement_reply_error";s:30:"Error in replying Announcement";s:17:"event_add_success";s:26:"Event created successfully";s:15:"event_add_error";s:23:"Error in creating Event";s:15:"payment_success";s:23:"Your paymenent is done.";s:17:"payment_cancelled";s:26:"Your payment is cancelled.";s:14:"payment_failed";s:23:"Your payment is failed.";s:15:"payment_expired";s:24:"Your payment is expired.";s:9:"dashboard";s:9:"Dashboard";s:9:"managment";s:9:"Managment";s:6:"access";s:6:"Access";s:10:"permission";s:10:"Permission";s:4:"role";s:4:"Role";s:8:"location";s:8:"Location";s:7:"country";s:7:"Country";s:5:"state";s:5:"State";s:4:"city";s:4:"City";s:4:"user";s:4:"User";s:7:"academy";s:7:"Academy";s:6:"school";s:6:"School";s:7:"student";s:7:"Student";s:4:"clan";s:4:"Clan";s:5:"level";s:5:"Level";s:14:"email_template";s:14:"Email Template";s:7:"setting";s:7:"Setting";s:6:"events";s:6:"Events";s:5:"pupil";s:5:"Pupil";s:7:"history";s:7:"History";s:6:"rating";s:6:"Rating";s:6:"top_10";s:6:"Top 10";s:7:"journal";s:7:"Journal";s:5:"duels";s:5:"Duels";s:9:"evolution";s:9:"Evolution";s:4:"news";s:4:"News";s:4:"shop";s:4:"Shop";s:15:"administrations";s:15:"Administrations";s:8:"received";s:8:"Received";s:8:"renewals";s:8:"Renewals";s:12:"certificates";s:12:"Certificates";s:13:"merchandising";s:13:"Merchandising";s:7:"payment";s:7:"Payment";s:6:"amount";s:6:"Amount";s:7:"invoice";s:7:"Invoice";s:13:"control_panel";s:13:"Control Panel";s:7:"numbers";s:7:"Numbers";s:9:"academies";s:9:"Academies";s:7:"schools";s:7:"Schools";s:8:"teachers";s:8:"Teachers";s:8:"students";s:8:"Students";s:9:"languages";s:9:"Languages";s:13:"notifications";s:13:"Notifications";s:5:"today";s:5:"Today";s:9:"clan_past";s:9:"Past Clan";s:17:"clan_past_shif_on";s:20:"Past Shifted Clan on";s:17:"clan_past_shif_of";s:20:"Past Shifted Clan of";s:12:"clan_present";s:12:"Present Clan";s:20:"clan_present_shif_on";s:23:"Present Shifted Clan on";s:20:"clan_present_shif_of";s:23:"Present Shifted Clan of";s:11:"clan_future";s:11:"Future Clan";s:19:"clan_future_shif_on";s:22:"Future Shifted Clan on";s:19:"clan_future_shif_of";s:22:"Future Shifted Clan of";s:24:"request_for_trail_lesson";s:24:"Request for Trail Lesson";s:29:"continue_registration_process";s:29:"Continue Registration Process";s:11:"select_clan";s:11:"Select Clan";s:13:"your_location";s:13:"Your location";s:16:"current_location";s:16:"Current location";s:15:"change_location";s:15:"Change location";s:11:"select_date";s:11:"Select Date";s:7:"confirm";s:7:"Confirm";s:19:"communicate_absence";s:19:"Communicate Absence";s:19:"going_to_miss_class";s:32:"Going To Miss A Class? Nofity IT";s:22:"select_date_of_absence";s:22:"Select date of Absence";s:15:"recover_absence";s:15:"Recover Absence";s:15:"confirm_absence";s:15:"Confirm Absence";s:23:"select_date_for_recover";s:23:"Select Date for Recover";s:6:"degree";s:4:"Rank";s:6:"honour";s:6:"Honour";s:13:"qualification";s:14:"Qualifications";s:8:"security";s:6:"Titles";s:15:"replace_teacher";s:15:"Replace Teacher";s:16:"welcome_to_login";s:57:"Welcome to MyLudosport, enter your credentials to access.";s:8:"username";s:8:"Username";s:8:"password";s:8:"Password";s:11:"remember_me";s:11:"Remember me";s:5:"login";s:5:"Login";s:15:"forgot_password";s:18:"you lost password?";s:2:"or";s:2:"or";s:18:"create_new_account";s:18:"Create New account";s:23:"forgot_password_message";s:50:"Enter your email address to recover your password.";s:9:"send_mail";s:9:"Send Mail";s:14:"reset_password";s:14:"Reset Password";s:13:"back_to_login";s:13:"Back to Login";s:25:"welcome_to_reset_password";s:14:"Reset Password";s:14:"system_setting";s:14:"System Setting";s:5:"value";s:5:"Value";s:7:"general";s:7:"General";s:4:"mail";s:4:"Mail";s:7:"profile";s:7:"Profile";s:10:"my_profile";s:10:"My Profile";s:15:"change_password";s:15:"Change Password";s:4:"wins";s:4:"Wins";s:6:"defeat";s:6:"Defeat";s:10:"attendance";s:10:"Attendance";s:7:"absence";s:7:"Absence";s:15:"challenges_made";s:15:"Challenges Made";s:19:"challenges_recevied";s:18:"Challenges recived";s:11:"tournaments";s:11:"TOURNAMENTS";s:11:"year_course";s:11:"Year Course";s:7:"current";s:7:"Current";s:8:"re_enter";s:8:"Re-enter";s:9:"full_name";s:9:"Full Name";s:5:"avtar";s:6:"Avatar";s:8:"hometown";s:8:"Hometown";s:11:"pupil_since";s:11:"Pupil Since";s:5:"quote";s:5:"Quote";s:8:"about_me";s:8:"About me";s:10:"phone_no_1";s:8:"Phone #1";s:10:"phone_no_2";s:8:"Phone #2";s:14:"color_of_blade";s:15:"Colour of Blade";s:9:"firstname";s:9:"Firstname";s:8:"lastname";s:8:"Lastname";s:8:"nickname";s:8:"Nickname";s:3:"dob";s:13:"Date of birth";s:5:"email";s:5:"Email";s:17:"re_enter_password";s:17:"Re-enter password";s:5:"enter";s:5:"Enter";s:8:"i_accept";s:8:"I accept";s:16:"terms_conditions";s:20:"Terms and conditions";s:21:"text_terms_conditions";s:803:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in ligula aliquam, ullamcorper tortor mattis, hendrerit neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam posuere venenatis nisl eu aliquam. Vestibulum tristique justo sit amet sapien pulvinar scelerisque. Integer id nunc tincidunt, dignissim turpis eu, dapibus erat. Sed aliquam tortor nec nisi ultrices dignissim. Sed non ligula velit. Aenean quis laoreet arcu, a scelerisque ipsum. In gravida, nisi in mattis consectetur, erat augue vestibulum mauris, quis porttitor tellus ligula in turpis. Vestibulum eleifend, nisi at vulputate sagittis, est est semper turpis, ut pretium nibh arcu sit amet mi. Proin eu commodo diam. Donec fermentum eget lacus sit amet mollis. Morbi tempus lorem sit amet urna luctus semper.";s:8:"register";s:8:"Register";s:4:"step";s:4:"Step";s:14:"palce_of_birth";s:14:"Place of Birth";s:17:"city_of_residence";s:17:"City of Residence";s:2:"by";s:2:"by";s:8:"zip_code";s:8:"Zip Code";s:8:"tax_code";s:8:"Tax Code";s:11:"blood_group";s:11:"Blood Group";s:29:"text_second_step_registration";s:803:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in ligula aliquam, ullamcorper tortor mattis, hendrerit neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam posuere venenatis nisl eu aliquam. Vestibulum tristique justo sit amet sapien pulvinar scelerisque. Integer id nunc tincidunt, dignissim turpis eu, dapibus erat. Sed aliquam tortor nec nisi ultrices dignissim. Sed non ligula velit. Aenean quis laoreet arcu, a scelerisque ipsum. In gravida, nisi in mattis consectetur, erat augue vestibulum mauris, quis porttitor tellus ligula in turpis. Vestibulum eleifend, nisi at vulputate sagittis, est est semper turpis, ut pretium nibh arcu sit amet mi. Proin eu commodo diam. Donec fermentum eget lacus sit amet mollis. Morbi tempus lorem sit amet urna luctus semper.";s:9:"subscribe";s:9:"Subscribe";s:10:"controller";s:10:"Controller";s:6:"method";s:6:"Method";s:6:"parent";s:6:"Parent";s:2:"is";s:2:"is";s:4:"menu";s:4:"Menu";s:5:"allow";s:5:"Allow";s:4:"deny";s:4:"Deny";s:10:"is_manager";s:10:"Is Manager";s:9:"check_all";s:9:"Check All";s:11:"uncheck_all";s:11:"Uncheck All";s:10:"role_exits";s:18:"Role already exits";s:6:"active";s:6:"Active";s:8:"deactive";s:8:"Deactive";s:7:"pending";s:7:"Pending";s:6:"status";s:6:"Status";s:5:"basic";s:5:"Basic";s:14:"access_control";s:15:"Access Controls";s:13:"change_status";s:13:"Change Status";s:16:"extra_permission";s:16:"Extra Permission";s:13:"batch_history";s:13:"Batch History";s:11:"assign_date";s:9:"Assign on";s:9:"assign_by";s:9:"Assign by";s:18:"list_score_history";s:18:"List score history";s:18:"list_badge_history";s:18:"List badge history";s:12:"affect_score";s:13:"Reflect Score";s:11:"batch_title";s:11:"Badge title";s:4:"main";s:4:"Main";s:4:"type";s:4:"Type";s:7:"contact";s:7:"Contact";s:21:"association_full_name";s:21:"Association Full Name";s:13:"role_referent";s:39:"Role of the referent in the association";s:7:"address";s:7:"Address";s:11:"postal_code";s:11:"Postal Code";s:12:"phone_number";s:12:"Phone Number";s:4:"dean";s:4:"Dean";s:6:"rector";s:6:"Rector";s:4:"paid";s:4:"Paid";s:3:"fee";s:3:"Fee";s:17:"affiliated_school";s:17:"Affiliated School";s:10:"no_academy";s:10:"No Academy";s:9:"principal";s:9:"Principal";s:13:"mobile_number";s:13:"Mobile Number";s:5:"range";s:5:"Range";s:9:"no_school";s:9:"No School";s:7:"teacher";s:7:"Teacher";s:14:"same_as_school";s:14:"Same as School";s:3:"day";s:3:"Day";s:6:"lesson";s:6:"Lesson";s:9:"time_from";s:9:"time from";s:7:"time_to";s:7:"time to";s:10:"start_from";s:10:"start from";s:6:"end_in";s:6:"end in";s:12:"trial_lesson";s:12:"Trial Lesson";s:4:"date";s:4:"date";s:8:"approval";s:20:"Accept trial request";s:8:"approved";s:22:"Accepted trial request";s:10:"unapproved";s:20:"Reject trial request";s:5:"reset";s:5:"Reset";s:6:"filter";s:6:"Filter";s:17:"accept_as_student";s:17:"Accept as Student";s:7:"no_clan";s:7:"No Clan";s:10:"no_student";s:10:"No Student";s:23:"holiday_aproval_pending";s:24:"Holiday approval Pending";s:7:"present";s:7:"Present";s:23:"absence_recover_teacher";s:33:"Absence + Recovery Teacher Assign";s:18:"holiday_unapproved";s:18:"Holiday Unapproved";s:36:"note_mouseover_recovery_teacher_name";s:49:"Mouser hover on date to see Recovery teacher name";s:32:"note_mouseover_unapproval_reason";s:45:"Mouser hover on date to see Unapproval reason";s:15:"recover_teacher";s:16:"Recovery Teacher";s:6:"reason";s:6:"Reason";s:6:"absent";s:6:"Absent";s:16:"attendance_sheet";s:16:"Attendance Sheet";s:10:"next_class";s:9:"Next Clan";s:8:"recovery";s:8:"Recovery";s:25:"absenece_recovery_student";s:24:"Absense Recovery Student";s:20:"assign_recovery_clan";s:20:"Assign Recovery Clan";s:8:"is_basic";s:8:"is basic";s:13:"under_sixteen";s:8:"under 16";s:7:"subject";s:7:"Subject";s:7:"message";s:7:"Message";s:8:"messages";s:8:"Messages";s:10:"attachment";s:10:"Attachment";s:4:"show";s:4:"Show";s:6:"remove";s:6:"Remove";s:10:"pre_format";s:10:"Pre Format";s:13:"eventcategory";s:14:"Event Category";s:5:"event";s:5:"Event";s:9:"date_from";s:9:"Date from";s:7:"date_to";s:7:"Date to";s:7:"manager";s:7:"Manager";s:11:"description";s:11:"Description";s:3:"all";s:3:"All";s:4:"from";s:4:"from";s:4:"send";s:4:"Send";s:10:"invitation";s:10:"Invitation";s:10:"individual";s:10:"Individual";s:23:"select_inidvidual_users";s:25:"Select Individuals User''s";s:15:"select_any_user";s:15:"Select any User";s:16:"select_academies";s:16:"Select Academies";s:18:"select_any_academy";s:18:"Select any Academy";s:14:"select_schools";s:14:"Select Schools";s:17:"select_any_school";s:17:"Select any School";s:12:"select_clans";s:12:"Select Clans";s:15:"select_any_clan";s:15:"Select any Clan";s:15:"select_studetns";s:15:"Select Students";s:18:"select_any_student";s:18:"Select any Student";s:27:"no_manager_attendance_error";s:52:"You are not the authorized person to take attendance";s:21:"event_take_attendance";s:15:"Take Attendance";s:24:"event_attendance_success";s:29:"Attendance taken Successfully";s:22:"event_attendance_error";s:26:"Error in taking Attendance";s:5:"batch";s:5:"Badge";s:5:"image";s:5:"Image";s:14:"who_can_assign";s:13:"Who can ssign";s:10:"has_rating";s:11:"Has ratting";s:15:"dashboard_cover";s:15:"Dashboard Cover";s:13:"profile_cover";s:13:"Profile Cover";s:21:"badge_120_width_image";s:61:"If image width is greater than 120px, the result will be good";s:21:"badge_750_width_image";s:61:"If image width is greater than 750px, the result will be good";s:33:"badge_change_sequence_information";s:104:"To change the sequence of BADGE, first select any type and then drag & drop the badge to change sequence";s:13:"batch_request";s:13:"Badge request";s:20:"request_student_name";s:10:"Pupil name";s:17:"request_user_name";s:12:"Request User";s:12:"request_user";s:12:"Request User";s:32:"top_most_autority_cannot_request";s:59:"You are top most authorities, you cannot request to anyone.";s:26:"make_batch_request_to_dean";s:26:"Make badge request to Dean";s:28:"make_batch_request_to_rector";s:28:"Make badge request to Rector";s:27:"make_batch_request_to_admin";s:27:"Make badge request to Admin";s:26:"edit_batch_request_to_dean";s:26:"Edit badge request to Dean";s:28:"edit_batch_request_to_rector";s:28:"Edit badge request to Rector";s:27:"edit_batch_request_to_admin";s:27:"Edit badge request to Admin";s:21:"approve_batch_request";s:7:"Approve";s:23:"unapprove_batch_request";s:9:"unapprove";s:22:"approved_batch_request";s:8:"Approved";s:24:"unapproved_batch_request";s:8:"Rejected";s:7:"done_by";s:7:"Done by";s:7:"compose";s:7:"Compose";s:5:"inbox";s:5:"Inbox";s:4:"sent";s:4:"Sent";s:5:"draft";s:5:"Draft";s:5:"trash";s:5:"Trash";s:6:"search";s:6:"Search";s:2:"to";s:2:"To";s:7:"discard";s:7:"Discard";s:11:"leave_group";s:11:"Leave Group";s:12:"attachmments";s:14:"Attachmment(s)";s:16:"my_personal_data";s:16:"MY PERSONAL DATA";s:8:"my_duels";s:8:"MY DUELS";s:9:"clan_logs";s:8:"CALN LOG";s:8:"attended";s:8:"Attended";s:6:"missed";s:6:"Missed";s:8:"catch_up";s:9:"Catch-ups";s:16:"year_of_practice";s:17:"Years of practice";s:15:"my_combat_style";s:16:"MY COMBAT STYLES";s:8:"timeline";s:8:"TIMELINE";s:13:"top_10_rating";s:13:"Top 10 Rating";s:11:"rating_list";s:11:"Rating List";s:3:"xpr";s:3:"XPR";s:3:"war";s:3:"WAR";s:3:"sty";s:3:"STY";s:10:"my_academy";s:10:"My Academy";s:9:"my_school";s:9:"My School";s:7:"my_clan";s:7:"My Clan";s:9:"operation";s:9:"Operation";s:4:"none";s:4:"None";s:5:"merit";s:5:"Merit";s:7:"demerit";s:7:"Demerit";s:9:"challenge";s:9:"Challenge";s:4:"duel";s:4:"Duel";s:10:"duels_list";s:10:"Duels List";s:14:"duel_suggested";s:14:"Duel Suggested";s:16:"duel_recommended";s:20:"Choose your opponent";s:16:"choose_by_rating";s:16:"Choose by rating";s:5:"score";s:5:"Score";s:8:"the_best";s:8:"The Best";s:11:"duel_accept";s:15:"Yes, I am ready";s:11:"duel_reject";s:25:"Right now, Not interested";s:11:"duel_result";s:21:"Finally, Result comes";s:14:"challenged_you";s:14:"Challenged you";s:27:"challenge_encourage_message";s:42:"Pick the gauntlet up and prepare to fight.";s:17:"challenge_to_duel";s:19:"CHALLENGE TO A DUEL";s:13:"write_message";s:13:"WRITE MESSAGE";s:17:"challenge_history";s:17:"Challenge History";s:4:"made";s:4:"Made";s:9:"submitted";s:9:"Submitted";s:8:"rejected";s:8:"Rejected";s:8:"accepted";s:8:"Accepted";s:7:"faliure";s:7:"Faliure";s:18:"challenge_accepted";s:18:"Challenge accepted";s:21:"no_challenge_accepted";s:21:"No challenge accepted";s:14:"challenge_made";s:14:"Challenge made";s:17:"no_challenge_made";s:17:"No challenge made";s:18:"challenge_received";s:18:"Challenge received";s:21:"no_challenge_received";s:21:"No challenge received";s:18:"challenge_rejected";s:18:"Challenge rejected";s:21:"no_challenge_rejected";s:21:"No challenge rejected";s:19:"challenge_submitted";s:19:"Challenge submitted";s:22:"no_challenge_submitted";s:22:"No challenge submitted";s:13:"challenge_you";s:3:"You";s:18:"challenge_opponent";s:8:"Opponent";s:6:"winner";s:6:"Winner";s:15:"result_of_fight";s:15:"Result of fight";s:5:"blind";s:5:"Blind";s:9:"duel_logs";s:9:"Duel Logs";s:9:"victories";s:9:"Victories";s:17:"my_last_victoreis";s:17:"MY LAST VICTORIES";s:12:"no_victories";s:12:"No Victories";s:7:"defeats";s:7:"Defeats";s:15:"my_last_defeats";s:15:"MY LAST DEFEATS";s:10:"no_defeats";s:10:"No Defeats";s:15:"my_last_failure";s:16:"MY LAST FAILURES";s:10:"no_failure";s:11:"No Failures";s:9:"before_me";s:9:"before me";s:8:"after_me";s:8:"after me";s:10:"statistics";s:10:"STATISTICS";s:3:"top";s:3:"Top";s:16:"prepare_to_fight";s:17:"Prepare to fight!";s:13:"date_required";s:20:" * Date is required.";s:13:"time_required";s:20:" * Time is required.";s:25:"challenge_success_message";s:55:"Prepare for the fight the Challenge made Sucessfully !!";s:12:"just_kidding";s:12:"Just kidding";s:5:"do_it";s:6:"Do it!";s:4:"time";s:4:"Time";s:5:"place";s:5:"Place";s:16:"cannot_challenge";s:31:"You cannot challenge any one !!";s:22:"cannot_challenge_error";s:77:"You have more than 7 duel pending. Please accept any of them to make new duel";s:15:"view_attendance";s:8:"Register";s:8:"presence";s:8:"Presence";s:12:"announcement";s:12:"Announcement";s:36:"student_dashboard_announcement_title";s:23:"PERSONAL COMMUNICATIONS";}s:9:"is_loaded";a:2:{i:0;s:19:"datamapper_lang.php";i:1;s:13:"main_lang.php";}}s:6:"prefix";s:0:"";s:11:"join_prefix";s:0:"";s:12:"error_prefix";s:3:"<p>";s:12:"error_suffix";s:4:"</p>";s:13:"created_field";s:7:"created";s:13:"updated_field";s:7:"updated";s:10:"local_time";b:0;s:14:"unix_timestamp";b:0;s:16:"timestamp_format";s:0:"";s:16:"lang_file_format";s:14:"model_${model}";s:23:"field_label_lang_format";s:17:"${model}_${field}";s:16:"auto_transaction";b:0;s:22:"auto_populate_has_many";b:1;s:21:"auto_populate_has_one";b:1;s:18:"all_array_uses_ids";b:0;s:9:"db_params";s:0:"";s:15:"extensions_path";s:10:"datamapper";s:2:"db";a:74:{s:8:"dbdriver";s:5:"mysql";s:12:"_escape_char";s:1:"`";s:16:"_like_escape_str";s:0:"";s:16:"_like_escape_chr";s:0:"";s:11:"delete_hack";b:1;s:13:"_count_string";s:19:"SELECT COUNT(*) AS ";s:15:"_random_keyword";s:7:" RAND()";s:13:"use_set_names";b:0;s:9:"ar_select";a:0:{}s:11:"ar_distinct";b:0;s:7:"ar_from";a:0:{}s:7:"ar_join";a:0:{}s:8:"ar_where";a:0:{}s:7:"ar_like";a:0:{}s:10:"ar_groupby";a:0:{}s:9:"ar_having";a:0:{}s:7:"ar_keys";a:0:{}s:8:"ar_limit";b:0;s:9:"ar_offset";b:0;s:8:"ar_order";b:0;s:10:"ar_orderby";a:0:{}s:6:"ar_set";a:0:{}s:10:"ar_wherein";a:0:{}s:17:"ar_aliased_tables";a:0:{}s:14:"ar_store_array";a:0:{}s:10:"ar_caching";b:0;s:15:"ar_cache_exists";a:0:{}s:15:"ar_cache_select";a:0:{}s:13:"ar_cache_from";a:0:{}s:13:"ar_cache_join";a:0:{}s:14:"ar_cache_where";a:0:{}s:13:"ar_cache_like";a:0:{}s:16:"ar_cache_groupby";a:0:{}s:15:"ar_cache_having";a:0:{}s:16:"ar_cache_orderby";a:0:{}s:12:"ar_cache_set";a:0:{}s:12:"ar_no_escape";a:0:{}s:18:"ar_cache_no_escape";a:0:{}s:8:"username";s:4:"root";s:8:"password";s:9:"blackid10";s:8:"hostname";s:9:"localhost";s:8:"database";s:9:"ludosport";s:8:"dbprefix";s:0:"";s:8:"char_set";s:4:"utf8";s:8:"dbcollat";s:15:"utf8_general_ci";s:8:"autoinit";b:1;s:8:"swap_pre";s:0:"";s:4:"port";s:0:"";s:8:"pconnect";b:1;s:7:"conn_id";i:0;s:9:"result_id";b:1;s:8:"db_debug";b:1;s:9:"benchmark";d:0.059683322906494141;s:11:"query_count";i:3;s:11:"bind_marker";s:1:"?";s:12:"save_queries";b:1;s:7:"queries";a:4:{i:0;s:21:"DESCRIBE `challenges`";i:1;s:96:"SELECT *\nFROM (`challenges`)\nWHERE `challenges`.`from_id` =  25\nAND `challenges`.`to_id` =  ''37''";i:2;s:215:"INSERT INTO `challenges` (`type`, `from_id`, `from_status`, `to_id`, `to_status`, `made_on`, `played_on`, `place`, `user_id`) VALUES (''R'', 25, ''A'', ''37'', ''P'', ''2014-10-14 15:43:59'', ''2014-11-18 01:05:00'', ''asd'', 25)";i:3;s:24:"DESCRIBE `notifications`";}s:11:"query_times";a:4:{i:0;d:0.00081920623779296875;i:1;d:0.00026202201843261719;i:2;d:0.058602094650268555;i:3;d:0.0010099411010742188;}s:10:"data_cache";a:0:{}s:13:"trans_enabled";b:1;s:12:"trans_strict";b:1;s:12:"_trans_depth";i:0;s:13:"_trans_status";b:1;s:8:"cache_on";b:0;s:8:"cachedir";s:0:"";s:13:"cache_autodel";b:0;s:5:"CACHE";N;s:20:"_protect_identifiers";b:1;s:21:"_reserved_identifiers";a:1:{i:0;s:1:"*";}s:7:"stmt_id";N;s:7:"curs_id";N;s:10:"limit_used";N;s:8:"stricton";b:0;s:18:"_has_shutdown_hook";b:1;}s:10:"extensions";a:1:{s:8:"_methods";a:0:{}}s:2:"id";i:12;s:4:"type";s:1:"R";s:7:"from_id";i:25;s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"37";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-10-14 15:43:59";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-11-18 01:05:00";s:5:"place";s:3:"asd";s:6:"result";N;s:13:"result_status";N;s:7:"user_id";i:25;s:9:"timestamp";N;}', 1, '2014-10-14 10:13:59'),
(138, 'N', 'challenge_made', 25, 37, 13, 'a:6:{s:14:"challenge_type";s:1:"R";s:7:"from_id";s:2:"25";s:5:"to_id";s:2:"37";s:4:"date";s:10:"23-10-2014";s:4:"time";s:4:"1:05";s:5:"place";s:6:"Baroda";}', 1, '2014-10-14 10:16:26'),
(139, 'N', 'challenge_made', 25, 17, 14, 'a:6:{s:14:"challenge_type";s:1:"R";s:7:"from_id";s:2:"25";s:5:"to_id";s:2:"17";s:4:"date";s:0:"";s:4:"time";s:0:"";s:5:"place";s:0:"";}', 1, '2014-10-14 10:19:20'),
(140, 'N', 'challenge_made', 25, 37, 15, 'a:6:{s:14:"challenge_type";s:1:"R";s:7:"from_id";s:2:"25";s:5:"to_id";s:2:"37";s:4:"date";s:0:"";s:4:"time";s:0:"";s:5:"place";s:0:"";}', 1, '2014-10-14 10:21:03'),
(141, 'N', 'challenge_made', 25, 37, 17, 'a:14:{s:2:"id";i:17;s:4:"type";s:1:"R";s:7:"from_id";s:2:"25";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"37";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-10-14 15:55:28";s:17:"status_changed_on";N;s:9:"played_on";N;s:5:"place";s:0:"";s:6:"result";s:1:"0";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"25";s:9:"timestamp";s:19:"2014-10-14 15:55:28";}', 1, '2014-10-14 10:25:28'),
(142, 'N', 'challenge_made', 37, 25, 1, 'a:14:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"P";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";N;s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:6:"result";s:1:"0";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 06:41:24'),
(143, 'N', 'challenge_accepted', 25, 37, 1, 'a:14:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:6:"result";s:1:"0";s:13:"result_status";s:3:"MNP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 06:42:52'),
(145, 'N', 'challenge_rejected', 37, 25, 1, 'a:14:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"R";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:6:"result";s:2:"25";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 06:50:15'),
(146, 'N', 'challenge_rejected', 25, 37, 1, 'a:14:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"R";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:6:"result";s:2:"37";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 06:51:43'),
(147, 'N', 'challenge_winner_confirmation', 25, 37, 1, 'a:14:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:6:"result";s:2:"37";s:13:"result_status";s:2:"CW";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 06:53:03'),
(149, 'N', 'contrast_opinions_challenge_winner', 25, 37, 1, 'a:15:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:17:"result_declare_by";s:2:"37";s:6:"result";s:2:"37";s:13:"result_status";s:2:"CW";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 08:12:22'),
(150, 'N', 'contrast_opinions_challenge_winner', 25, 37, 1, 'a:15:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:17:"result_declare_by";s:2:"37";s:6:"result";s:2:"37";s:13:"result_status";s:2:"CO";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 08:26:09'),
(151, 'N', 'challenge_winner', 25, 37, 1, 'a:15:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 12:12:52";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:17:"result_declare_by";s:2:"37";s:6:"result";s:2:"37";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 08:30:13'),
(152, 'N', 'challenge_winner_confirmation', 25, 37, 1, 'a:15:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 14:22:33";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:17:"result_declare_by";i:25;s:6:"result";s:2:"37";s:13:"result_status";s:2:"CW";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 1, '2014-10-16 08:52:33'),
(153, 'N', 'challenge_winner', 37, 25, 1, 'a:15:{s:2:"id";i:1;s:4:"type";s:1:"R";s:7:"from_id";s:2:"37";s:11:"from_status";s:1:"A";s:5:"to_id";s:2:"25";s:9:"to_status";s:1:"A";s:7:"made_on";s:19:"2014-10-16 12:11:24";s:17:"status_changed_on";s:19:"2014-10-16 14:22:33";s:9:"played_on";s:19:"2014-10-19 01:05:00";s:5:"place";s:6:"Baroda";s:17:"result_declare_by";s:2:"25";s:6:"result";s:2:"37";s:13:"result_status";s:2:"MP";s:7:"user_id";s:2:"37";s:9:"timestamp";s:19:"2014-10-16 12:11:24";}', 0, '2014-10-16 09:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
`id` int(11) NOT NULL,
  `invoice_id` varchar(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payer_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `user_id`, `payment_id`, `payer_id`, `type`, `amount`, `description`, `state`, `timestamp`) VALUES
(1, '20141013-111-36-0000000001', 36, 'PAY-3S892728B5922923WKQ5VY4A', 'EF8P2C4P7285Y', 'PayPal', 20.00, '1', 'approved', '2014-10-13 05:00:29');

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
(2, 'Admin', 'Admin', 0, 'a:18:{s:5:"roles";a:2:{i:0;s:8:"viewRole";i:1;s:8:"editRole";}s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:10:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:18:"clanViewAttendance";i:7;s:22:"listTrialLessonRequest";i:8;s:24:"changeStatusTrialStudent";i:9;s:14:"changeClanDate";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:6:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";i:4;s:19:"sendEventInvitation";i:5;s:19:"takeEventAttendance";}s:7:"batches";a:3:{i:0;s:9:"viewBatch";i:1;s:9:"editBatch";i:2;s:11:"deleteBatch";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";}s:13:"group_message";a:6:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";s:5:"clans";s:1:"0";}}s:13:"announcements";a:2:{s:19:"single_announcement";a:5:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"5";i:6;s:1:"2";}s:18:"group_announcement";a:6:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 1, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 1, 'a:10:{s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:5:"clans";a:9:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:18:"clanViewAttendance";i:7;s:22:"listTrialLessonRequest";i:8;s:14:"changeClanDate";}s:6:"events";a:1:{i:0;s:9:"viewEvent";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:2:{i:6;s:1:"0";s:5:"clans";s:1:"0";}}s:13:"announcements";a:2:{s:19:"single_announcement";a:5:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:18:"group_announcement";a:6:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:13:22'),
(4, 'Dean', 'Preside', 0, 'a:10:{s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:5:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:18:"clanViewAttendance";i:4;s:22:"listTrialLessonRequest";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:2:{i:6;s:1:"0";s:5:"clans";s:1:"0";}}s:13:"announcements";a:2:{s:19:"single_announcement";a:5:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:18:"group_announcement";a:6:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 1, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 1, 'a:10:{s:5:"users";a:9:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";i:4;s:18:"listStudentBatches";i:5;s:18:"editStudentBatches";i:6;s:20:"deleteStudentBatches";i:7;s:16:"listStudentScore";i:8;s:18:"deleteStudentScore";}s:14:"studentratings";a:2:{i:0;s:17:"viewStudentrating";i:1;s:17:"editStudentrating";}s:13:"batchrequests";a:5:{i:0;s:16:"viewBatchrequest";i:1;s:24:"changeStatusBatchrequest";i:2;s:15:"addBatchrequest";i:3;s:16:"editBatchrequest";i:4;s:18:"deleteBatchrequest";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:6:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:18:"clanViewAttendance";i:4;s:22:"listTrialLessonRequest";i:5;s:24:"changeStatusTrialStudent";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}s:8:"messages";a:1:{s:13:"group_message";a:2:{i:6;s:1:"0";s:5:"clans";s:1:"0";}}s:13:"announcements";a:2:{s:19:"single_announcement";a:5:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:18:"group_announcement";a:6:{i:2;s:1:"2";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 1, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 1, 'a:5:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:6:"events";a:3:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";i:2;s:19:"takeEventAttendance";}s:8:"profiles";a:4:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";i:3;s:18:"changeEmailPrivacy";}}', '0', 1, '2014-07-17 10:17:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `score_histories`
--

INSERT INTO `score_histories` (`id`, `student_id`, `oper`, `score_type`, `score`, `score_date`, `description`, `user_id`, `timestamp`) VALUES
(1, 14, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(2, 15, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(3, 16, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:11'),
(4, 17, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(5, 20, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(6, 13, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(7, 21, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(8, 25, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:12'),
(9, 27, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(10, 31, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(11, 33, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(12, 34, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:13'),
(13, 23, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(14, 25, 'M', 'xpr', 1000, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:14'),
(15, 37, 'M', 'xpr', 300, '2014-09-26', 'Assign Badge', 1, '2014-09-26 04:52:15'),
(16, 37, 'M', 'xpr', 150, '2014-09-26', 'Testing XPR', 1, '2014-09-26 09:48:30'),
(17, 37, 'M', 'war', 250, '2014-09-26', 'Testing WAR', 1, '2014-09-26 09:48:30'),
(18, 37, 'D', 'sty', 50, '2014-09-26', 'Testing STY', 1, '2014-09-26 09:48:30'),
(19, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(20, 15, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(21, 16, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(22, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(23, 20, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(24, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:01'),
(25, 23, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(26, 25, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(27, 27, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:40:02'),
(28, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(29, 14, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(30, 15, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(31, 16, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(32, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(33, 20, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:41:59'),
(34, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(35, 23, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(36, 25, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(37, 27, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:42:00'),
(38, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(39, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(40, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(41, 37, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:43'),
(42, 13, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(43, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(44, 21, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:55:54'),
(45, 17, 'M', 'war', 8, '2014-09-29', 'Attending Event', 3, '2014-09-29 10:56:19'),
(46, 37, 'M', 'sty', 100, '2014-09-26', 'Testing STY', 1, '2014-09-26 09:48:30'),
(47, 36, 'M', 'xpr', 1000, '2014-10-13', 'Badge Assign', 36, '2014-10-13 05:01:33'),
(48, 37, 'M', 'sty', 3, '2014-10-16', 'Challenge winner', 25, '2014-10-16 08:30:13'),
(49, 25, 'M', 'xpr', 1, '2014-10-16', 'Challenge defeat', 25, '2014-10-16 08:30:13'),
(101, 37, 'M', 'sty', 3, '2014-10-16', 'Challenge winner', 0, '2014-10-16 09:14:17'),
(102, 25, 'M', 'xpr', 1, '2014-10-16', 'Challenge defeat', 37, '2014-10-16 09:14:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

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
(16, '2014-09-30', 4, 8, 1, 0, NULL, NULL, 'P', 0, '2014-09-23 05:33:38'),
(17, '2014-10-01', 1, 5, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(18, '2014-10-01', 2, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(19, '2014-10-01', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(20, '2014-10-02', 2, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(21, '2014-10-02', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(22, '2014-10-03', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(23, '2014-10-03', 5, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(24, '2014-10-04', 5, 7, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(25, '2014-10-05', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(26, '2014-10-06', 6, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(27, '2014-10-07', 1, 5, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(28, '2014-10-07', 3, 3, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48'),
(29, '2014-10-07', 4, 8, 1, 0, NULL, NULL, 'P', 0, '2014-09-30 09:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
`id` int(11) NOT NULL,
  `student_master_id` int(11) NOT NULL,
  `clan_id` int(11) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `degree_id`, `honour_id`, `master_id`, `qualification_id`, `security_id`, `color_of_blade`, `xpr`, `war`, `sty`, `total_score`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(1, 14, 3, 3, 0, 0, 0, 0, 6, 300, 8, 0, 308, '2014-09-25', 2, NULL, NULL, NULL, NULL, 'A', 1, '2014-08-04 00:09:02'),
(2, 15, 2, 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(3, 16, 2, 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(4, 17, 5, 3, 0, 0, 0, 0, 6, 300, 40, 0, 340, '2014-08-11', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-05 00:09:27'),
(5, 20, 6, 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-28', 2, '', 390016, 963852, 'B-ve ', 'A', 20, '2009-08-21 01:37:12'),
(6, 13, 5, 3, 0, 0, 0, 0, 6, 300, 32, 0, 332, '2014-08-30', 3, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-25 05:27:01'),
(7, 21, 6, 3, 0, 0, 0, 0, 6, 300, 32, 0, 332, '2014-08-28', 3, NULL, NULL, NULL, NULL, 'A', 21, '2014-08-25 05:52:04'),
(8, 25, 6, 3, 0, 0, 0, 0, 6, 1302, 16, 0, 1318, '2014-10-01', 3, NULL, NULL, NULL, NULL, 'A', 25, '2010-08-25 05:52:04'),
(9, 27, 6, 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-09-09', 8, 'roma', 0, 0, 'ah+', 'A', 27, '2014-09-04 15:25:53'),
(10, 28, 6, 3, 0, 0, 0, 0, 6, 0, 0, 0, 0, '2014-09-16', 0, NULL, NULL, NULL, NULL, 'A', 28, '2014-09-05 08:45:20'),
(11, 31, 1, 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-16', 8, NULL, NULL, NULL, NULL, 'A', 31, '2014-09-05 11:33:36'),
(12, 33, 6, 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-30', 8, NULL, NULL, NULL, NULL, 'A', 33, '2014-09-05 13:05:45'),
(13, 34, 1, 3, 0, 0, 0, 0, 6, 300, 0, 0, 300, '2014-09-23', 8, NULL, NULL, NULL, NULL, 'A', 34, '2014-09-05 13:18:57'),
(14, 23, 6, 3, 0, 0, 0, 0, 6, 300, 16, 0, 316, '2014-08-04', 2, 'Milan', 20162, 610093, 'O +ve', 'A', 2, '2014-08-04 00:09:02'),
(16, 37, 7, 6, 10, 0, 0, 0, 1, 450, 258, 56, 764, '2014-10-10', 0, 'Vadodara', 390016, 610093, 'B -ve', 'A', 1, '2013-09-25 09:46:53'),
(20, 36, 1, 6, 0, 0, 0, 0, 1, 1000, 0, 0, 1000, '2014-10-13', 0, 'Vadodara', 390016, 963852, 'B -ve', 'A', 36, '2014-10-13 05:00:29');

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
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Super Admin', 'User', 'superadmin@yopmail.com', 653682600, 1, 1, 1, 'Temp', NULL, 'dcf8544d6647c2095e8b2cc9796455be.jpg', 'Gorwa,Baroda', '9876543210', '1234567890', 'Only one thing is impossible for God: To find any sense in any copyright law on the planet', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel sapien sapien. Duis dictum leo dui, nec blandit nisl imperdiet ut. Donec quis condimentum libero. In volutpat urna id feugiat porta. Suspendisse a sem augue. Curabitur sodales, odio ut tempor scelerisque, eros tellus lacinia elit, id euismod felis nulla id erat. Quisque porttitor velit in sollicitudin eleifend.</span></p><p><span>Etiam consequat nulla nec sapien blandit ullamcorper id at nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce pellentesque elit quis lorem vulputate ornare. Proin turpis metus, convallis eget lectus at, volutpat molestie augue. Curabitur at ligula viverra ante rutrum euismod. Duis pulvinar rhoncus facilisis. Curabitur lobortis, ante at semper finibus, leo turpis sollicitudin libero, a congue magna neque vitae enim. Nunc vestibulum aliquam lacus, a tempus lorem vehicula et. Vivamus at arcu suscipit, cursus turpis et, egestas elit. Maecenas tincidunt, risus ac scelerisque consequat, ex sapien euismod turpis, egestas hendrerit eros augue at justo. Praesent scelerisque mi quis nulla feugiat scelerisque vel sit amet leo. Nulla efficitur mattis nisi, vitae dictum tortor placerat in. Quisque tempor, ex nec volutpat scelerisque, lorem urna luctus lectus, at posuere velit felis sit amet arcu.</span></p>', NULL, 'A', 1, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Carmelo', 'Samperi', 'ranasoyab@yopmail.com', 316809000, 5, 4, 2, 'Temp', NULL, '1adfa22db058e6383b4365cb7906590f.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rana', '1', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, 'Vadodara', NULL, '063fd00a3c30c83404faf36e32b2dada.jpg', NULL, NULL, NULL, NULL, NULL, 'a:14:{s:30:"user_registration_notification";s:1:"1";s:20:"trial_lesson_request";s:1:"0";s:21:"trial_lesson_accepted";s:1:"1";s:21:"trial_lesson_rejected";s:1:"0";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"0";s:14:"teacher_absent";s:1:"1";s:14:"student_absent";s:1:"0";s:16:"recovery_student";s:1:"1";s:36:"teacher_recovery_student_for_student";s:1:"0";s:36:"teacher_recovery_student_for_teacher";s:1:"1";s:16:"recovery_teacher";s:1:"0";s:16:"holiday_approved";s:1:"1";s:18:"holiday_upapproved";s:1:"0";}', 'A', 3, '2014-07-17 07:28:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', '1', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-07-17 07:28:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', '1', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, '44999132c325dd575171618f58a0712a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 5, '2014-07-21 10:11:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', '2', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(12, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'c05b3802dd788813231e79ce67a5513d.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-07-31 10:45:54'),
(13, '6', 'martin', '202cb962ac59075b964b07152d234b70', 'Martin', 'Lusi', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, '0b1b838debca3f07a19dfb93846a38a2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-01 05:20:27'),
(14, '6', 'student_1', '202cb962ac59075b964b07152d234b70', 'A Student', 'First', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, 'Vadodara', NULL, '6c922946889fe1aa9ad85ba33d1f43eb.jpg', 'Baroda', '91987654321', '91987654321', 'Victorious warriors win first and then go to war, while defeated warriors go to war first and then seek to win.', '<p><br></p>', 'a:6:{s:16:"event_invitation";s:1:"0";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"1";s:18:"challenge_rejected";s:1:"1";s:16:"challenge_winner";s:1:"0";}', 'A', 1, '2014-08-04 05:37:32'),
(15, '6', 'student_2', '202cb962ac59075b964b07152d234b70', 'C Student', 'Second', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:19'),
(16, '6', 'student_3', '202cb962ac59075b964b07152d234b70', 'D Student', 'Third', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:56'),
(17, '6', 'student_4', '202cb962ac59075b964b07152d234b70', 'B Student', 'Fourth', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:38:37'),
(19, '5', 'teacher_4', '202cb962ac59075b964b07152d234b70', 'Teacher', '4', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(20, '6', 'denim', '202cb962ac59075b964b07152d234b70', 'Denim', 'Jeans', 'ranasoyab@yopmail.com', 1218479400, 1, 1, 1, 'Milan', NULL, 'fe86fb703363a623405d48b65408763a.jpg', 'Baroda', '91987654321', '91987654321', 'Life is to be lived, not controlled; and humanity is won by continuing to play in face of certain defeat.', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at mattis tortor. Maecenas finibus justo quis augue posuere suscipit. Phasellus ultrices congue libero id pulvinar. Morbi ornare orci ligula, a scelerisque nibh ullamcorper ac. Vestibulum suscipit metus et interdum pharetra. Sed mollis, dui fringilla varius vestibulum, enim ligula consectetur neque, quis fringilla leo purus non ipsum. Curabitur non lectus et lorem lacinia accumsan a in augue. In fringilla, nisi at dapibus convallis, nulla magna varius lacus, sed vestibulum nisi leo vel nulla. Sed pulvinar aliquam sem sed aliquam. Donec sed pulvinar urna. Donec ut fringilla orci. Ut ut pretium massa, eget hendrerit felis. Etiam efficitur, velit eget ultricies pulvinar, sem velit dignissim neque, sit amet suscipit felis massa cursus orci. Integer semper fringilla tincidunt. Praesent quis bibendum augue.</span><br></p>', 'a:7:{s:36:"teacher_recovery_student_for_student";s:1:"1";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"0";s:18:"challenge_rejected";s:1:"0";s:16:"challenge_winner";s:1:"1";}', 'A', 20, '2014-08-21 06:48:58'),
(21, '6', 'levis', '202cb962ac59075b964b07152d234b70', 'levis', 'Jeans', 'ranasoyab@yopmail.com', 706127400, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-25 11:20:58'),
(23, '6', 'iqbal', '202cb962ac59075b964b07152d234b70', 'Iqbal', 'Hussain', 'iqbal@blackid.com', 318018600, 1, 1, 1, 'Milan', NULL, 'no_avatar.jpg', 'temp temp temp', '91987654321', '91987654321', 'All my life, my heart has yearned for a thing I cannot name.', '<p><br></p>', NULL, 'A', 23, '2014-08-27 10:20:39'),
(25, '5,6', 'karl', '202cb962ac59075b964b07152d234b70', 'Karl', 'Marks', 'ranasoyab@yopmail.com', 421871400, 1, 1, 1, 'Vadodara', NULL, 'a605553a927ca37136936eaf13836cae.jpg', 'Baroda', '91987654321', '91987654321', 'Let us always meet each other with smile, as the smile is the beginning of love.', '<p><br></p>', 'a:7:{s:36:"teacher_recovery_student_for_student";s:1:"1";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"0";s:18:"challenge_accepted";s:1:"0";s:18:"challenge_rejected";s:1:"0";s:16:"challenge_winner";s:1:"1";}', 'A', 25, '2014-08-28 11:48:19'),
(27, '6', 'Fede', '202cb962ac59075b964b07152d234b70', 'Federico', 'De Medici', 'ranasoyab@yopmail.com', 752565600, 5, 4, 2, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 0, '2014-09-04 15:20:52'),
(28, '6', '123', '202cb962ac59075b964b07152d234b70', 'Carmelo2', 'Samperi1', 'ranasoyab@yopmail.com', 635061600, 5, 4, 2, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 28, '2014-09-05 07:18:30'),
(30, '6', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Pietro', 'Rossi', 'ranasoyab@yopmail.com', 1239685200, 5, 4, 2, 'Pietro', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 0, '2014-09-05 11:04:54'),
(31, '6', 'eu', '202cb962ac59075b964b07152d234b70', 'Eugenio', 'Di Fraia', 'ranasoyab@yopmail.com', 317973600, 1, 1, 1, 'Cassina de Pecchi', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 0, '2014-09-05 11:32:37'),
(33, '6', 'bart', '202cb962ac59075b964b07152d234b70', 'Bart', 'Simpson', 'ranasoyab@yopmail.com', 633938400, 5, 4, 2, 'e', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 33, '2014-09-05 13:00:47'),
(34, '6', 'merge', '202cb962ac59075b964b07152d234b70', 'Merge', 'Simpson', 'ranasoyab@yopmail.com', 633852000, 1, 1, 1, 's', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'D', 0, '2014-09-05 13:17:44'),
(36, '6', 'spyker', '202cb962ac59075b964b07152d234b70', 'Spyker', 'Jeans', 'soyab@yopmail.com', 525724200, 1, 1, 1, 'Vadodara', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-09-22 06:02:11'),
(37, '6', 'ranasoyab', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'soyab@blackidsolutions.com', 653596200, 1, 1, 1, 'Vadodara', NULL, '5865aa782c8c4ee571acac7af45b9d94.jpg', 'Baroda', '9876543210', '91987654321', 'It is better to be hated for what you are than to be loved for what you are not.', '<p ><span >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus accumsan non lorem et bibendum. Ut imperdiet sed lectus vitae euismod. Nulla lobortis hendrerit pharetra. Vivamus vitae egestas velit. Vivamus vitae sodales turpis. In hac habitasse platea dictumst. Cras volutpat mi porta, sollicitudin mauris in, volutpat diam. Ut vel velit molestie, auctor mi sed, posuere purus. Donec malesuada mi urna, at iaculis nisi venenatis ac. Sed et rhoncus neque. Morbi nisi velit, mattis in metus nec, efficitur dignissim ex. Vestibulum bibendum ligula scelerisque orci fermentum egestas. Morbi non enim purus.</span></p><p ><span >Duis urna turpis, porttitor sodales felis in, interdum porttitor nunc. Vivamus dictum accumsan mauris, ac gravida ligula venenatis sit amet. Quisque quam leo, auctor et tortor at, auctor aliquam lorem. In et lorem sit amet lectus hendrerit mattis ut eu arcu. Integer interdum luctus elit at elementum. Suspendisse consequat leo nec diam lobortis, sed mollis lectus bibendum. Integer et finibus ex. Vivamus maximus consectetur eros ut ultricies. Ut convallis nibh a erat vulputate, sed rutrum libero ullamcorper. Suspendisse et metus in odio tincidunt maximus non quis lacus. Morbi bibendum feugiat quam, et posuere orci malesuada eu.</span></p>', 'a:8:{s:36:"teacher_recovery_student_for_student";s:1:"1";s:16:"event_invitation";s:1:"1";s:16:"change_clan_date";s:1:"1";s:14:"challenge_made";s:1:"1";s:18:"challenge_accepted";s:1:"1";s:18:"challenge_rejected";s:1:"1";s:16:"challenge_winner";s:1:"1";s:16:"new_announcement";s:1:"0";}', 'A', 1, '2013-09-25 09:46:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
(16, 25, 'D', 6, '2010-05-01', 0, '2014-09-19 12:10:21'),
(19, 37, 'H', 10, '2014-09-25', 2, '2014-09-25 09:46:53'),
(23, 37, 'D', 3, '2014-01-31', 1, '2014-09-25 12:45:57'),
(26, 36, 'D', 6, '2014-10-13', 36, '2014-10-13 05:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `attendance_recovers`
--
ALTER TABLE `attendance_recovers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clandates`
--
ALTER TABLE `clandates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `user_batches_histories`
--
ALTER TABLE `user_batches_histories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
