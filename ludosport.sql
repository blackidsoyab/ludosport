-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2014 at 06:46 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `type` enum('D','H','Q','S') NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) NOT NULL,
  `image` varchar(150) NOT NULL,
  `cover_image` varchar(150) DEFAULT 'no_cover.jpg',
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `type`, `en_name`, `it_name`, `image`, `cover_image`, `description`, `user_id`, `timestamp`) VALUES
(1, 'D', 'Youngling', 'Iniziato', '3f91ec69cb3035cab7b855464d2aa51c.png', 'b28b4523013da3504e2a414bb93cde86.jpg', '<p><br></p>', 1, '2014-08-06 08:29:35'),
(4, 'D', 'Founding Master', 'Maestro Fondatore', 'f4480b0d05c4b2f1010f166fc7ebfbac.png', '8bf991f77779663d25a310aaeb00cbe6.jpg', '<p><br></p>', 1, '2014-08-06 08:58:29'),
(6, 'D', 'Jedi', 'Jedi', '375c268b5e786fe15bf5ca8f9bb5d5d3.png', 'de42c05c98946b04084327ae329858d2.jpeg', '<p><br></p>', 1, '2014-08-06 08:59:16'),
(7, 'D', 'Sith Lord', 'Maestro Sith', '89e990cb1cff363dadf0cf17faae2205.png', NULL, '<p><br></p>', 2, '2014-08-06 08:59:35'),
(8, 'D', 'Jedi Knight', 'Cavaliere Jedi', 'd9564d57165b2e8d21b1b8c959409216.png', NULL, '<p><br></p>', 2, '2014-08-06 09:00:03'),
(9, 'D', 'Jedi Master', 'Maestro Jedi', '586eef00da8faf942266c6e0564e7e76.png', NULL, '<p><br></p>', 2, '2014-08-06 09:00:17'),
(10, 'D', 'Padawan', 'Padawan', '05be81d032899191a04476ce132aebfb.png', NULL, '<p><br></p>', 2, '2014-08-06 09:00:37'),
(11, 'D', 'Sith', 'Sith', 'd8c40faf9d4a4cc931a71406d830726c.png', NULL, '<p><br></p>', 2, '2014-08-06 09:09:49'),
(12, 'D', 'Sith Knight', 'Cavaliere Sith', 'f29c72aad0c31c87d6f0b4184eb7f8a9.png', NULL, '<p><br></p>', 2, '2014-08-06 09:10:01'),
(13, 'H', 'Style Keeper', 'Custode delle Tradizioni', '26343a7d74b1cd4e83c3832e11e9c15e.png', NULL, '<p><br></p>', 2, '2014-08-06 09:11:26'),
(14, 'H', 'Shadow Master', 'Maestro d''Ombra', 'c659b7d7d9eeeda61e8eac8572d6b6bd.png', NULL, '<p><br></p>', 2, '2014-08-06 09:11:41'),
(15, 'Q', 'Training Instructor', 'Allievo Istruttore', 'c3f47e4d7892badb6143c0ca8dfdb9ea.png', NULL, '<p><br></p>', 2, '2014-08-06 09:12:01'),
(16, 'Q', 'Dean', 'Preside', '8e1186446122de0125950eaa1876b6c7.png', NULL, '<p><br></p>', 2, '2014-08-06 09:12:24'),
(17, 'S', 'Guardian', 'Guardiano', 'd96588d37881627e7d15bb08aa5f5894.png', NULL, '<p><br></p>', 2, '2014-08-06 09:12:54'),
(18, 'S', 'Sentinel', 'Sentinella', 'f21947ce2c9749ef24d3163c281a3bb0.png', NULL, '<p><br></p>', 2, '2014-08-06 09:13:13'),
(19, 'H', 'Quartermaster', 'Quartiermastro', '791c2c9790d4b4cfb379225986fa15e9.png', NULL, '<p><br></p>', 2, '2014-09-04 14:09:26'),
(20, 'H', 'Prophet', 'Profeta', 'ad6b6aa3371010529116611c74cc4750.png', NULL, '<p><br></p>', 2, '2014-09-04 14:09:49'),
(21, 'H', 'Shadow', 'Ombra', '163a5839d263031de7f9d0ec7ebe474b.png', NULL, '<p><br></p>', 2, '2014-09-04 14:10:09'),
(22, 'H', 'Master Sabersmith', 'Mastro di Spada', 'd673d00cb663bf587f3d206d0e2972e1.png', NULL, '<p><br></p>', 2, '2014-09-04 14:10:38'),
(23, 'H', 'Researcher', 'Ricercatore', '10998295a9776fb243d542302339f63a.png', NULL, '<p><br></p>', 2, '2014-09-04 14:11:02'),
(24, 'Q', 'Instructor level 1', 'Istruttore livello 1', '802e292ed5e1e18b41eacb4c62c7f7e2.png', NULL, '<p><br></p>', 2, '2014-09-04 14:12:39'),
(25, 'Q', 'Instructor level 2', 'Istruttore livello 2', '74e0c7ae2ffa57b2f6edaf218515d5b1.png', NULL, '<p><br></p>', 2, '2014-09-04 14:12:59'),
(26, 'Q', 'Instructor level 3', 'Istruttore livello 3', '3b69f92034caa56c01b0dc557cfa18b0.png', NULL, '<p><br></p>', 2, '2014-09-04 14:13:21'),
(27, 'Q', 'Instructor level 4', 'Istruttore livello 4', 'e5794f064d8771b73cbc726d92cec792.png', NULL, '<p><br></p>', 2, '2014-09-04 14:13:38'),
(28, 'Q', 'Instructor level 5', 'Istruttore livello 5', 'ee9fca9261bfc36aa75520acab20a6c4.png', NULL, '<p><br></p>', 2, '2014-09-04 14:13:55'),
(29, 'Q', 'Instructor level 6', 'Istruttore livello 6', 'e5a69a7cdadbe9d3c7920778063a181d.png', NULL, '<p><br></p>', 2, '2014-09-04 14:14:12'),
(30, 'Q', 'Instructor level 7', 'Istruttore livello 7', '34decadb79339ec2331e068fb92ab08c.png', NULL, '<p><br></p>', 2, '2014-09-04 14:14:31'),
(31, 'Q', 'Rector', 'Rector', 'd8cd960df43cb57e12d52298430214c6.png', NULL, '<p><br></p>', 2, '2014-09-04 14:14:45'),
(32, 'S', 'Consul', 'Console', '816090c955dcd98b6350f24c68d29c38.png', NULL, '<p><br></p>', 2, '2014-09-04 14:16:20'),
(33, 'S', 'Style Keeper', 'Custode di Stile', '919209a9005701114a358b640fbaea6f.png', NULL, '<p><br></p>', 2, '2014-09-04 14:16:53'),
(34, 'S', 'Ambassador', 'Ambasciatore', '42d6aa2ab1605c76a017a0cf4028128d.png', NULL, '<p><br></p>', 2, '2014-09-04 14:17:09'),
(35, 'S', 'Master of Arms', 'Maestro d''Armi', '150cc6ac0be492e802de192db5baafb9.png', NULL, '<p><br></p>', 2, '2014-09-04 14:17:29'),
(36, 'S', 'Battle Master', 'Maestro di Battaglia', '1fc7d4aae6bc3e19390e348c09acf33a.png', NULL, '<p><br></p>', 2, '2014-09-04 14:18:18'),
(37, 'S', 'Academy Master', 'Maestro d''Accademia', '1a40f32897f546631e7a96a1f6c8d82c.png', 'bdecaae2cd195d70bce20a2967a0a4fe.jpg', '<p><br></p>', 1, '2014-09-04 14:18:40'),
(38, 'S', 'Style Master in Shii-Cho', 'Maestro di Shii-Cho', '2656d4016b1874c18d229c5ff9485850.png', NULL, '<p><br></p>', 2, '2014-09-04 14:19:14'),
(39, 'S', 'Style Master in Makashi', 'Maestro di Makashi', '03c0e2e2b6050bdeac592090aa063e8f.png', NULL, '<p><br></p>', 2, '2014-09-04 14:19:53'),
(40, 'S', 'Style Master in Soresu', 'Maestro di Soresu', '66055d8882da9f8f9e5a9f8ec8a591d5.png', NULL, '<p><br></p>', 2, '2014-09-04 14:20:11'),
(41, 'S', 'Style Master in Ataru', 'Maestro di Ataru', '49155d58d16f378639ee78ed4589d5be.png', NULL, '<p><br></p>', 2, '2014-09-04 14:20:29'),
(42, 'S', 'Style Master in Djem-So', 'Maestro di Djem-So', '6198824741d2cef9be0fff724cf4f777.png', NULL, '<p><br></p>', 2, '2014-09-04 14:20:51'),
(43, 'S', 'Style Master in Niman', 'Maestro di Niman', '31bf67508bc6ab370e6913dbb0f9dbe1.png', NULL, '<p><br></p>', 2, '2014-09-04 14:21:08'),
(44, 'S', 'Style Master in Vaapad', 'Maestro di Vaapad', '2e622daab8de916330cf3d1d06e27a59.png', NULL, '<p><br></p>', 2, '2014-09-04 14:21:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clandates`
--

INSERT INTO `clandates` (`id`, `type`, `clan_id`, `clan_date`, `clan_shift_from`, `description`, `history`, `user_id`, `timestamp`) VALUES
(5, 'S', 1, '2014-12-17', '2014-09-17', '', NULL, 3, '2014-09-10 09:46:41');

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
(2, 2, 2, '7', 2, '2014-07-01', '2015-06-30', '3,4', 1406349000, 1406356200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:46:59'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
(17, 'change_clan_date', 'Clan Reschedule | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>The #clan_name of #school_name at #academy_name has been&nbsp;reschedule from #from_date to #to_date.</div><div><br></div><div>It is done by #authorized_user_name.<br></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#clan_name\r\n#school_name\r\n#academy_name\r\n#from_date\r\n#to_date\r\n#authorized_user_name', 1, '2014-09-09 11:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `eventcategories`
--

CREATE TABLE IF NOT EXISTS `eventcategories` (
`id` int(11) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `it_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `eventcategories`
--

INSERT INTO `eventcategories` (`id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 'Tournament', 'Tournament', 1, '2014-08-05 12:27:51'),
(2, 'Workshop', 'Workshop', 1, '2014-08-05 12:27:57'),
(3, 'Seminar', 'Seminar', 1, '2014-08-05 12:28:01'),
(4, 'Promo', 'Promo', 1, '2014-08-05 12:28:47'),
(5, 'Gathering', 'Gathering', 1, '2014-08-05 12:28:54');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 3, 'ALL', '0', 'Seminar', 'Seminar', 4, '2014-08-21', '2014-08-27', '3', 'd2552d6693f9b2a2168255c13a1c6aa2.jpeg', '<p >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum feugiat nibh vel feugiat. Duis nec lobortis turpis. Phasellus vulputate odio magna, sed congue diam interdum eu. Proin euismod dictum leo, pharetra bibendum dui consectetur a. Integer congue lacus a libero placerat malesuada. Maecenas lorem nibh, pretium at porta eu, laoreet quis urna. Praesent ullamcorper, ipsum id tincidunt posuere, mi tortor pulvinar mi, at fermentum lorem lacus id lectus.</p><p >Curabitur faucibus tincidunt tortor nec porttitor. Vestibulum sit amet erat massa. Mauris ultrices quis enim vitae ullamcorper. Quisque laoreet pulvinar lectus nec dictum. Duis ut congue justo. Proin id tortor mi. Aenean vel justo mauris. Cras a velit nisi. Etiam vitae eleifend erat. Etiam in efficitur massa. Suspendisse at urna dignissim, hendrerit felis et, accumsan ante. Suspendisse nibh velit, tincidunt nec massa in, porta mollis sapien.</p>', 5, '2014-08-20 12:10:15'),
(2, 5, 'ALL', '0', 'Gathering', 'Gathering', 5, '2014-08-21', '2014-08-28', '2', '817a148f94e40097cbe69e9f2992b359.jpg', '<p ><span >Donec quis dui et ex luctus ornare a sed quam. Integer tempor, arcu vel dictum tempus, eros diam pretium neque, at dapibus dui lorem et leo. Morbi fermentum aliquet elit quis tempor. Nulla tempus tortor in congue facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed non sem nisi. Suspendisse in nibh at nunc vulputate ornare. Etiam sit amet ante eu metus tempor lobortis a sed tortor.</span></p><p ><span >Aenean sed risus eget lorem condimentum lacinia. Nunc sed ultricies ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum elit dui, a scelerisque urna varius quis. Nam tincidunt erat et leo hendrerit, quis sollicitudin nulla lobortis. Pellentesque ut vehicula dui. Duis commodo tincidunt orci, non dignissim orci consequat ac.</span></p><p ><span >Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed blandit ut turpis ut consectetur. Praesent at mauris id erat condimentum mollis. Aliquam molestie commodo augue luctus suscipit. Proin porta lacinia orci, a rutrum nisl vestibulum in. Morbi sodales sodales facilisis. Aenean facilisis congue semper. Vivamus molestie, nibh nec egestas varius, magna ante sagittis libero, et gravida arcu orci in erat.</span></p>', 5, '2014-08-21 05:58:06');

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
(1, '1st Jedi', 'Prima Jedi', '1', '0'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=805 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(1, 'N', 'rector_assign_academy', 2, 3, 1, NULL, 1, '2014-07-25 08:45:52'),
(2, 'N', 'rector_assign_academy', 2, 5, 1, NULL, 1, '2014-07-25 08:45:52'),
(5, 'N', 'dean_assign_school', 2, 3, 1, NULL, 1, '2014-07-25 10:49:30'),
(6, 'N', 'rector_assign_academy', 2, 3, 2, NULL, 1, '2014-07-25 11:22:55'),
(7, 'N', 'dean_assign_school', 2, 3, 1, NULL, 1, '2014-07-26 05:43:28'),
(8, 'N', 'teacher_assign_class', 2, 3, 1, NULL, 1, '2014-07-26 05:45:01'),
(9, 'N', 'rector_assign_academy', 2, 3, 1, NULL, 1, '2014-07-26 05:45:22'),
(10, 'N', 'dean_assign_school', 2, 3, 2, NULL, 1, '2014-07-26 05:49:39'),
(12, 'N', 'teacher_assign_class', 2, 3, 1, NULL, 1, '2014-07-26 06:36:03'),
(13, 'N', 'dean_assign_school', 2, 4, 4, NULL, 0, '2014-07-26 09:43:41'),
(14, 'N', 'dean_assign_school', 2, 4, 3, NULL, 0, '2014-07-26 09:44:24'),
(15, 'N', 'teacher_assign_class', 2, 5, 1, NULL, 1, '2014-07-26 09:45:00'),
(16, 'N', 'teacher_assign_class', 2, 7, 2, NULL, 0, '2014-07-26 09:47:00'),
(17, 'N', 'teacher_assign_class', 2, 7, 3, NULL, 0, '2014-07-26 09:47:38'),
(18, 'N', 'teacher_assign_class', 2, 8, 4, NULL, 0, '2014-07-26 09:48:27'),
(19, 'I', 'user_register', 0, 2, 9, NULL, 1, '2014-07-26 11:10:31'),
(20, 'I', 'user_register', 0, 3, 9, NULL, 1, '2014-07-26 11:10:31'),
(21, 'I', 'user_register', 0, 4, 9, NULL, 0, '2014-07-26 11:10:31'),
(22, 'I', 'user_register', 0, 5, 9, NULL, 1, '2014-07-26 11:10:31'),
(23, 'I', 'user_register', 0, 6, 9, NULL, 0, '2014-07-26 11:10:31'),
(24, 'I', 'user_register', 0, 7, 9, NULL, 0, '2014-07-26 11:10:31'),
(25, 'I', 'user_register', 0, 8, 9, NULL, 0, '2014-07-26 11:10:31'),
(27, 'N', 'rector_assign_academy', 0, 0, 0, NULL, 1, '2014-07-26 12:31:56'),
(28, 'N', 'rector_assign_academy', 0, 0, 0, NULL, 1, '2014-07-26 12:36:03'),
(29, 'N', 'rector_assign_academy', 0, 0, 0, NULL, 1, '2014-07-26 12:42:47'),
(30, 'N', 'rector_assign_academy', 0, 0, 0, NULL, 1, '2014-07-26 12:43:04'),
(32, 'N', 'teacher_assign_class', 2, 3, 1, NULL, 1, '2014-07-28 06:08:28'),
(33, 'I', 'user_register', 0, 2, 10, NULL, 1, '2014-07-30 11:31:59'),
(34, 'I', 'user_register', 0, 3, 10, NULL, 1, '2014-07-30 11:31:59'),
(35, 'I', 'user_register', 0, 4, 10, NULL, 0, '2014-07-30 11:31:59'),
(36, 'I', 'user_register', 0, 5, 10, NULL, 1, '2014-07-30 11:31:59'),
(37, 'I', 'user_register', 0, 6, 10, NULL, 0, '2014-07-30 11:31:59'),
(38, 'I', 'user_register', 0, 7, 10, NULL, 0, '2014-07-30 11:31:59'),
(39, 'I', 'user_register', 0, 8, 10, NULL, 0, '2014-07-30 11:32:00'),
(40, 'I', 'user_register', 0, 2, 11, NULL, 1, '2014-07-30 11:35:32'),
(41, 'I', 'user_register', 0, 3, 11, NULL, 1, '2014-07-30 11:35:32'),
(42, 'I', 'user_register', 0, 4, 11, NULL, 0, '2014-07-30 11:35:33'),
(43, 'I', 'user_register', 0, 5, 11, NULL, 1, '2014-07-30 11:35:33'),
(44, 'I', 'user_register', 0, 6, 11, NULL, 0, '2014-07-30 11:35:33'),
(45, 'I', 'user_register', 0, 7, 11, NULL, 0, '2014-07-30 11:35:33'),
(46, 'I', 'user_register', 0, 8, 11, NULL, 0, '2014-07-30 11:35:33'),
(47, 'N', 'rector_assign_academy', 2, 5, 3, NULL, 1, '2014-07-31 04:29:27'),
(48, 'N', 'dean_assign_school', 2, 4, 5, NULL, 0, '2014-07-31 08:50:42'),
(49, 'I', 'user_register', 0, 2, 14, NULL, 1, '2014-07-31 10:14:59'),
(50, 'I', 'user_register', 0, 3, 14, NULL, 0, '2014-07-31 10:14:59'),
(51, 'I', 'user_register', 0, 4, 14, NULL, 0, '2014-07-31 10:14:59'),
(52, 'I', 'user_register', 0, 5, 14, NULL, 1, '2014-07-31 10:14:59'),
(53, 'I', 'user_register', 0, 6, 14, NULL, 0, '2014-07-31 10:14:59'),
(54, 'I', 'user_register', 0, 7, 14, NULL, 0, '2014-07-31 10:14:59'),
(55, 'I', 'user_register', 0, 8, 14, NULL, 0, '2014-07-31 10:14:59'),
(56, 'I', 'user_register', 0, 2, 15, NULL, 1, '2014-07-31 11:22:15'),
(57, 'I', 'user_register', 0, 3, 15, NULL, 0, '2014-07-31 11:22:15'),
(58, 'I', 'user_register', 0, 4, 15, NULL, 0, '2014-07-31 11:22:16'),
(59, 'I', 'user_register', 0, 5, 15, NULL, 1, '2014-07-31 11:22:16'),
(60, 'I', 'user_register', 0, 6, 15, NULL, 0, '2014-07-31 11:22:16'),
(61, 'I', 'user_register', 0, 7, 15, NULL, 0, '2014-07-31 11:22:16'),
(62, 'I', 'user_register', 0, 8, 15, NULL, 0, '2014-07-31 11:22:16'),
(63, 'I', 'user_register', 0, 2, 16, NULL, 1, '2014-07-31 11:29:52'),
(64, 'I', 'user_register', 0, 3, 16, NULL, 0, '2014-07-31 11:29:52'),
(65, 'I', 'user_register', 0, 4, 16, NULL, 0, '2014-07-31 11:29:52'),
(66, 'I', 'user_register', 0, 5, 16, NULL, 1, '2014-07-31 11:29:52'),
(67, 'I', 'user_register', 0, 6, 16, NULL, 0, '2014-07-31 11:29:52'),
(68, 'I', 'user_register', 0, 7, 16, NULL, 0, '2014-07-31 11:29:52'),
(69, 'I', 'user_register', 0, 8, 16, NULL, 0, '2014-07-31 11:29:52'),
(70, 'N', 'rector_assign_academy', 2, 3, 4, NULL, 0, '2014-08-03 08:15:29'),
(71, 'N', 'rector_assign_academy', 2, 6, 4, NULL, 0, '2014-08-03 08:15:29'),
(72, 'N', 'rector_assign_academy', 2, 3, 5, NULL, 0, '2014-08-03 08:22:00'),
(73, 'N', 'rector_assign_academy', 2, 6, 5, NULL, 0, '2014-08-03 08:22:00'),
(74, 'N', 'dean_assign_school', 2, 4, 6, NULL, 0, '2014-08-03 08:26:06'),
(75, 'N', 'dean_assign_school', 2, 4, 7, NULL, 0, '2014-08-03 08:26:07'),
(76, 'N', 'teacher_assign_class', 2, 7, 5, NULL, 0, '2014-08-03 08:29:36'),
(77, 'N', 'dean_assign_school', 2, 4, 8, NULL, 0, '2014-08-03 08:33:29'),
(78, 'N', 'rector_assign_academy', 2, 20, 6, NULL, 0, '2014-08-04 07:44:24'),
(79, 'N', 'rector_assign_academy', 2, 20, 7, NULL, 0, '2014-08-04 07:45:33'),
(80, 'N', 'dean_assign_school', 2, 24, 9, NULL, 0, '2014-08-04 14:59:20'),
(81, 'N', 'dean_assign_school', 2, 25, 10, NULL, 0, '2014-08-04 15:12:03'),
(82, 'N', 'dean_assign_school', 2, 26, 11, NULL, 0, '2014-08-04 15:13:02'),
(83, 'N', 'dean_assign_school', 2, 27, 12, NULL, 0, '2014-08-04 15:14:11'),
(84, 'N', 'dean_assign_school', 2, 28, 13, NULL, 0, '2014-08-04 15:15:21'),
(85, 'N', 'dean_assign_school', 2, 29, 14, NULL, 0, '2014-08-04 15:16:19'),
(86, 'N', 'dean_assign_school', 2, 30, 15, NULL, 0, '2014-08-04 15:17:33'),
(87, 'N', 'dean_assign_school', 2, 31, 16, NULL, 0, '2014-08-04 15:18:31'),
(88, 'N', 'dean_assign_school', 2, 32, 17, NULL, 0, '2014-08-04 15:19:44'),
(89, 'N', 'dean_assign_school', 2, 33, 18, NULL, 0, '2014-08-04 15:20:56'),
(90, 'N', 'teacher_assign_class', 2, 24, 6, NULL, 0, '2014-08-21 09:21:40'),
(91, 'N', 'teacher_assign_class', 2, 43, 7, NULL, 0, '2014-08-26 09:43:28'),
(92, 'N', 'teacher_assign_class', 2, 37, 8, NULL, 0, '2014-08-26 09:46:53'),
(93, 'N', 'teacher_assign_class', 2, 45, 9, NULL, 0, '2014-08-26 09:48:07'),
(94, 'N', 'teacher_assign_class', 2, 38, 10, NULL, 0, '2014-08-26 09:50:47'),
(95, 'N', 'teacher_assign_class', 2, 43, 11, NULL, 0, '2014-08-26 09:54:49'),
(96, 'N', 'teacher_assign_class', 2, 36, 12, NULL, 0, '2014-08-26 10:20:50'),
(97, 'N', 'teacher_assign_class', 2, 39, 13, NULL, 0, '2014-08-26 10:22:53'),
(98, 'N', 'teacher_assign_class', 2, 48, 14, NULL, 0, '2014-08-26 14:52:54'),
(99, 'N', 'teacher_assign_class', 2, 49, 15, NULL, 0, '2014-08-26 14:57:34'),
(100, 'N', 'teacher_assign_class', 2, 43, 16, NULL, 0, '2014-08-27 09:48:40'),
(101, 'N', 'teacher_assign_class', 2, 45, 17, NULL, 0, '2014-08-27 09:51:48'),
(102, 'N', 'teacher_assign_class', 2, 46, 18, NULL, 1, '2014-08-27 09:53:49'),
(103, 'N', 'teacher_assign_class', 2, 47, 19, NULL, 0, '2014-08-27 13:03:53'),
(104, 'N', 'teacher_assign_class', 2, 46, 20, NULL, 1, '2014-08-27 13:04:37'),
(105, 'N', 'teacher_assign_class', 2, 47, 21, NULL, 0, '2014-08-27 13:21:47'),
(106, 'N', 'teacher_assign_class', 2, 59, 22, NULL, 1, '2014-08-27 14:54:44'),
(107, 'N', 'teacher_assign_class', 2, 60, 23, NULL, 0, '2014-08-27 14:57:56'),
(108, 'I', 'user_register', 0, 2, 62, NULL, 1, '2014-08-27 15:20:27'),
(109, 'I', 'user_register', 0, 20, 62, NULL, 0, '2014-08-27 15:20:29'),
(110, 'I', 'user_register', 0, 21, 62, NULL, 0, '2014-08-27 15:20:31'),
(111, 'I', 'user_register', 0, 22, 62, NULL, 0, '2014-08-27 15:20:33'),
(112, 'I', 'user_register', 0, 23, 62, NULL, 0, '2014-08-27 15:20:35'),
(113, 'I', 'user_register', 0, 24, 62, NULL, 0, '2014-08-27 15:20:37'),
(114, 'I', 'user_register', 0, 25, 62, NULL, 0, '2014-08-27 15:20:39'),
(115, 'I', 'user_register', 0, 26, 62, NULL, 0, '2014-08-27 15:20:41'),
(116, 'I', 'user_register', 0, 27, 62, NULL, 0, '2014-08-27 15:20:43'),
(117, 'I', 'user_register', 0, 28, 62, NULL, 0, '2014-08-27 15:20:45'),
(118, 'I', 'user_register', 0, 29, 62, NULL, 0, '2014-08-27 15:20:47'),
(119, 'I', 'user_register', 0, 30, 62, NULL, 0, '2014-08-27 15:20:49'),
(120, 'I', 'user_register', 0, 31, 62, NULL, 0, '2014-08-27 15:20:51'),
(121, 'I', 'user_register', 0, 32, 62, NULL, 0, '2014-08-27 15:20:53'),
(122, 'I', 'user_register', 0, 33, 62, NULL, 0, '2014-08-27 15:20:55'),
(123, 'I', 'user_register', 0, 36, 62, NULL, 0, '2014-08-27 15:20:57'),
(124, 'I', 'user_register', 0, 37, 62, NULL, 0, '2014-08-27 15:20:59'),
(125, 'I', 'user_register', 0, 38, 62, NULL, 0, '2014-08-27 15:21:01'),
(126, 'I', 'user_register', 0, 39, 62, NULL, 0, '2014-08-27 15:21:03'),
(127, 'I', 'user_register', 0, 43, 62, NULL, 0, '2014-08-27 15:21:05'),
(128, 'I', 'user_register', 0, 45, 62, NULL, 0, '2014-08-27 15:21:07'),
(129, 'I', 'user_register', 0, 46, 62, NULL, 0, '2014-08-27 15:21:09'),
(130, 'I', 'user_register', 0, 47, 62, NULL, 0, '2014-08-27 15:21:11'),
(131, 'I', 'user_register', 0, 48, 62, NULL, 0, '2014-08-27 15:21:13'),
(132, 'I', 'user_register', 0, 49, 62, NULL, 0, '2014-08-27 15:21:15'),
(133, 'I', 'user_register', 0, 59, 62, NULL, 1, '2014-08-27 15:21:17'),
(134, 'I', 'user_register', 0, 60, 62, NULL, 0, '2014-08-27 15:21:19'),
(135, 'I', 'user_register', 0, 2, 63, NULL, 1, '2014-08-27 16:28:04'),
(136, 'I', 'user_register', 0, 21, 63, NULL, 0, '2014-08-27 16:28:06'),
(137, 'I', 'user_register', 0, 22, 63, NULL, 0, '2014-08-27 16:28:08'),
(138, 'I', 'user_register', 0, 23, 63, NULL, 0, '2014-08-27 16:28:10'),
(139, 'I', 'user_register', 0, 24, 63, NULL, 0, '2014-08-27 16:28:12'),
(140, 'I', 'user_register', 0, 25, 63, NULL, 0, '2014-08-27 16:28:14'),
(141, 'I', 'user_register', 0, 29, 63, NULL, 0, '2014-08-27 16:28:16'),
(142, 'I', 'user_register', 0, 30, 63, NULL, 0, '2014-08-27 16:28:18'),
(143, 'I', 'user_register', 0, 31, 63, NULL, 0, '2014-08-27 16:28:20'),
(144, 'I', 'user_register', 0, 32, 63, NULL, 0, '2014-08-27 16:28:22'),
(145, 'I', 'user_register', 0, 33, 63, NULL, 0, '2014-08-27 16:28:24'),
(146, 'I', 'user_register', 0, 36, 63, NULL, 0, '2014-08-27 16:28:26'),
(147, 'I', 'user_register', 0, 37, 63, NULL, 0, '2014-08-27 16:28:28'),
(148, 'I', 'user_register', 0, 38, 63, NULL, 0, '2014-08-27 16:28:30'),
(149, 'I', 'user_register', 0, 39, 63, NULL, 0, '2014-08-27 16:28:32'),
(150, 'I', 'user_register', 0, 43, 63, NULL, 0, '2014-08-27 16:28:34'),
(151, 'I', 'user_register', 0, 45, 63, NULL, 0, '2014-08-27 16:28:36'),
(152, 'I', 'user_register', 0, 46, 63, NULL, 0, '2014-08-27 16:28:38'),
(153, 'I', 'user_register', 0, 47, 63, NULL, 0, '2014-08-27 16:28:40'),
(154, 'I', 'user_register', 0, 48, 63, NULL, 0, '2014-08-27 16:28:42'),
(155, 'I', 'user_register', 0, 49, 63, NULL, 0, '2014-08-27 16:28:44'),
(156, 'I', 'user_register', 0, 59, 63, NULL, 1, '2014-08-27 16:28:46'),
(157, 'I', 'user_register', 0, 60, 63, NULL, 0, '2014-08-27 16:28:48'),
(158, 'I', 'user_register', 0, 2, 64, NULL, 1, '2014-08-27 16:33:53'),
(159, 'I', 'user_register', 0, 21, 64, NULL, 0, '2014-08-27 16:33:55'),
(160, 'I', 'user_register', 0, 22, 64, NULL, 0, '2014-08-27 16:33:57'),
(161, 'I', 'user_register', 0, 23, 64, NULL, 0, '2014-08-27 16:33:59'),
(162, 'I', 'user_register', 0, 24, 64, NULL, 0, '2014-08-27 16:34:01'),
(163, 'I', 'user_register', 0, 25, 64, NULL, 0, '2014-08-27 16:34:03'),
(164, 'I', 'user_register', 0, 29, 64, NULL, 0, '2014-08-27 16:34:05'),
(165, 'I', 'user_register', 0, 30, 64, NULL, 0, '2014-08-27 16:34:07'),
(166, 'I', 'user_register', 0, 31, 64, NULL, 0, '2014-08-27 16:34:09'),
(167, 'I', 'user_register', 0, 32, 64, NULL, 0, '2014-08-27 16:34:11'),
(168, 'I', 'user_register', 0, 33, 64, NULL, 0, '2014-08-27 16:34:13'),
(169, 'I', 'user_register', 0, 36, 64, NULL, 0, '2014-08-27 16:34:15'),
(170, 'I', 'user_register', 0, 37, 64, NULL, 0, '2014-08-27 16:34:17'),
(171, 'I', 'user_register', 0, 38, 64, NULL, 0, '2014-08-27 16:34:19'),
(172, 'I', 'user_register', 0, 39, 64, NULL, 0, '2014-08-27 16:34:21'),
(173, 'I', 'user_register', 0, 43, 64, NULL, 0, '2014-08-27 16:34:23'),
(174, 'I', 'user_register', 0, 45, 64, NULL, 0, '2014-08-27 16:34:25'),
(175, 'I', 'user_register', 0, 46, 64, NULL, 0, '2014-08-27 16:34:27'),
(176, 'I', 'user_register', 0, 47, 64, NULL, 0, '2014-08-27 16:34:29'),
(177, 'I', 'user_register', 0, 48, 64, NULL, 0, '2014-08-27 16:34:31'),
(178, 'I', 'user_register', 0, 49, 64, NULL, 0, '2014-08-27 16:34:33'),
(179, 'I', 'user_register', 0, 59, 64, NULL, 1, '2014-08-27 16:34:35'),
(180, 'I', 'user_register', 0, 60, 64, NULL, 0, '2014-08-27 16:34:37'),
(181, 'I', 'user_register', 0, 2, 65, NULL, 1, '2014-08-27 16:38:12'),
(182, 'I', 'user_register', 0, 21, 65, NULL, 0, '2014-08-27 16:38:14'),
(183, 'I', 'user_register', 0, 22, 65, NULL, 0, '2014-08-27 16:38:16'),
(184, 'I', 'user_register', 0, 23, 65, NULL, 0, '2014-08-27 16:38:18'),
(185, 'I', 'user_register', 0, 24, 65, NULL, 0, '2014-08-27 16:38:20'),
(186, 'I', 'user_register', 0, 25, 65, NULL, 0, '2014-08-27 16:38:22'),
(187, 'I', 'user_register', 0, 29, 65, NULL, 0, '2014-08-27 16:38:24'),
(188, 'I', 'user_register', 0, 30, 65, NULL, 0, '2014-08-27 16:38:26'),
(189, 'I', 'user_register', 0, 31, 65, NULL, 0, '2014-08-27 16:38:28'),
(190, 'I', 'user_register', 0, 32, 65, NULL, 0, '2014-08-27 16:38:30'),
(191, 'I', 'user_register', 0, 33, 65, NULL, 0, '2014-08-27 16:38:32'),
(192, 'I', 'user_register', 0, 36, 65, NULL, 0, '2014-08-27 16:38:34'),
(193, 'I', 'user_register', 0, 37, 65, NULL, 0, '2014-08-27 16:38:36'),
(194, 'I', 'user_register', 0, 38, 65, NULL, 0, '2014-08-27 16:38:38'),
(195, 'I', 'user_register', 0, 39, 65, NULL, 0, '2014-08-27 16:38:40'),
(196, 'I', 'user_register', 0, 43, 65, NULL, 0, '2014-08-27 16:38:42'),
(197, 'I', 'user_register', 0, 45, 65, NULL, 0, '2014-08-27 16:38:44'),
(198, 'I', 'user_register', 0, 46, 65, NULL, 0, '2014-08-27 16:38:46'),
(199, 'I', 'user_register', 0, 47, 65, NULL, 0, '2014-08-27 16:38:48'),
(200, 'I', 'user_register', 0, 48, 65, NULL, 0, '2014-08-27 16:38:50'),
(201, 'I', 'user_register', 0, 49, 65, NULL, 0, '2014-08-27 16:38:52'),
(202, 'I', 'user_register', 0, 59, 65, NULL, 1, '2014-08-27 16:38:54'),
(203, 'I', 'user_register', 0, 60, 65, NULL, 0, '2014-08-27 16:38:56'),
(204, 'I', 'user_register', 0, 2, 66, NULL, 1, '2014-08-27 16:39:59'),
(205, 'I', 'user_register', 0, 21, 66, NULL, 0, '2014-08-27 16:40:01'),
(206, 'I', 'user_register', 0, 22, 66, NULL, 0, '2014-08-27 16:40:03'),
(207, 'I', 'user_register', 0, 23, 66, NULL, 0, '2014-08-27 16:40:05'),
(208, 'I', 'user_register', 0, 24, 66, NULL, 0, '2014-08-27 16:40:07'),
(209, 'I', 'user_register', 0, 25, 66, NULL, 0, '2014-08-27 16:40:09'),
(210, 'I', 'user_register', 0, 29, 66, NULL, 0, '2014-08-27 16:40:11'),
(211, 'I', 'user_register', 0, 30, 66, NULL, 0, '2014-08-27 16:40:13'),
(212, 'I', 'user_register', 0, 31, 66, NULL, 0, '2014-08-27 16:40:15'),
(213, 'I', 'user_register', 0, 32, 66, NULL, 0, '2014-08-27 16:40:17'),
(214, 'I', 'user_register', 0, 33, 66, NULL, 0, '2014-08-27 16:40:19'),
(215, 'I', 'user_register', 0, 36, 66, NULL, 0, '2014-08-27 16:40:21'),
(216, 'I', 'user_register', 0, 37, 66, NULL, 0, '2014-08-27 16:40:23'),
(217, 'I', 'user_register', 0, 38, 66, NULL, 0, '2014-08-27 16:40:25'),
(218, 'I', 'user_register', 0, 39, 66, NULL, 0, '2014-08-27 16:40:27'),
(219, 'I', 'user_register', 0, 43, 66, NULL, 0, '2014-08-27 16:40:29'),
(220, 'I', 'user_register', 0, 45, 66, NULL, 0, '2014-08-27 16:40:31'),
(221, 'I', 'user_register', 0, 46, 66, NULL, 0, '2014-08-27 16:40:33'),
(222, 'I', 'user_register', 0, 47, 66, NULL, 0, '2014-08-27 16:40:35'),
(223, 'I', 'user_register', 0, 48, 66, NULL, 0, '2014-08-27 16:40:37'),
(224, 'I', 'user_register', 0, 49, 66, NULL, 0, '2014-08-27 16:40:39'),
(225, 'I', 'user_register', 0, 59, 66, NULL, 1, '2014-08-27 16:40:41'),
(226, 'I', 'user_register', 0, 60, 66, NULL, 0, '2014-08-27 16:40:43'),
(227, 'I', 'user_register', 0, 2, 67, NULL, 1, '2014-08-27 16:41:45'),
(228, 'I', 'user_register', 0, 21, 67, NULL, 0, '2014-08-27 16:41:47'),
(229, 'I', 'user_register', 0, 22, 67, NULL, 0, '2014-08-27 16:41:49'),
(230, 'I', 'user_register', 0, 23, 67, NULL, 0, '2014-08-27 16:41:51'),
(231, 'I', 'user_register', 0, 24, 67, NULL, 0, '2014-08-27 16:41:53'),
(232, 'I', 'user_register', 0, 25, 67, NULL, 0, '2014-08-27 16:41:55'),
(233, 'I', 'user_register', 0, 29, 67, NULL, 0, '2014-08-27 16:41:57'),
(234, 'I', 'user_register', 0, 30, 67, NULL, 0, '2014-08-27 16:41:59'),
(235, 'I', 'user_register', 0, 31, 67, NULL, 0, '2014-08-27 16:42:01'),
(236, 'I', 'user_register', 0, 32, 67, NULL, 0, '2014-08-27 16:42:03'),
(237, 'I', 'user_register', 0, 33, 67, NULL, 0, '2014-08-27 16:42:05'),
(238, 'I', 'user_register', 0, 36, 67, NULL, 0, '2014-08-27 16:42:07'),
(239, 'I', 'user_register', 0, 37, 67, NULL, 0, '2014-08-27 16:42:09'),
(240, 'I', 'user_register', 0, 38, 67, NULL, 0, '2014-08-27 16:42:11'),
(241, 'I', 'user_register', 0, 39, 67, NULL, 0, '2014-08-27 16:42:13'),
(242, 'I', 'user_register', 0, 43, 67, NULL, 0, '2014-08-27 16:42:15'),
(243, 'I', 'user_register', 0, 45, 67, NULL, 0, '2014-08-27 16:42:17'),
(244, 'I', 'user_register', 0, 46, 67, NULL, 0, '2014-08-27 16:42:19'),
(245, 'I', 'user_register', 0, 47, 67, NULL, 0, '2014-08-27 16:42:21'),
(246, 'I', 'user_register', 0, 48, 67, NULL, 0, '2014-08-27 16:42:23'),
(247, 'I', 'user_register', 0, 49, 67, NULL, 0, '2014-08-27 16:42:25'),
(248, 'I', 'user_register', 0, 59, 67, NULL, 1, '2014-08-27 16:42:27'),
(249, 'I', 'user_register', 0, 60, 67, NULL, 0, '2014-08-27 16:42:29'),
(250, 'I', 'user_register', 0, 2, 68, NULL, 1, '2014-08-27 16:46:34'),
(251, 'I', 'user_register', 0, 21, 68, NULL, 0, '2014-08-27 16:46:36'),
(252, 'I', 'user_register', 0, 22, 68, NULL, 0, '2014-08-27 16:46:38'),
(253, 'I', 'user_register', 0, 23, 68, NULL, 0, '2014-08-27 16:46:40'),
(254, 'I', 'user_register', 0, 24, 68, NULL, 0, '2014-08-27 16:46:42'),
(255, 'I', 'user_register', 0, 25, 68, NULL, 0, '2014-08-27 16:46:44'),
(256, 'I', 'user_register', 0, 29, 68, NULL, 0, '2014-08-27 16:46:46'),
(257, 'I', 'user_register', 0, 30, 68, NULL, 0, '2014-08-27 16:46:48'),
(258, 'I', 'user_register', 0, 31, 68, NULL, 0, '2014-08-27 16:46:50'),
(259, 'I', 'user_register', 0, 32, 68, NULL, 0, '2014-08-27 16:46:52'),
(260, 'I', 'user_register', 0, 33, 68, NULL, 0, '2014-08-27 16:46:54'),
(261, 'I', 'user_register', 0, 36, 68, NULL, 0, '2014-08-27 16:46:56'),
(262, 'I', 'user_register', 0, 37, 68, NULL, 0, '2014-08-27 16:46:58'),
(263, 'I', 'user_register', 0, 38, 68, NULL, 0, '2014-08-27 16:47:00'),
(264, 'I', 'user_register', 0, 39, 68, NULL, 0, '2014-08-27 16:47:02'),
(265, 'I', 'user_register', 0, 43, 68, NULL, 0, '2014-08-27 16:47:04'),
(266, 'I', 'user_register', 0, 45, 68, NULL, 0, '2014-08-27 16:47:06'),
(267, 'I', 'user_register', 0, 46, 68, NULL, 0, '2014-08-27 16:47:08'),
(268, 'I', 'user_register', 0, 47, 68, NULL, 0, '2014-08-27 16:47:10'),
(269, 'I', 'user_register', 0, 48, 68, NULL, 0, '2014-08-27 16:47:12'),
(270, 'I', 'user_register', 0, 49, 68, NULL, 0, '2014-08-27 16:47:14'),
(271, 'I', 'user_register', 0, 59, 68, NULL, 1, '2014-08-27 16:47:16'),
(272, 'I', 'user_register', 0, 60, 68, NULL, 0, '2014-08-27 16:47:18'),
(273, 'I', 'user_register', 0, 2, 69, NULL, 1, '2014-08-27 16:48:43'),
(274, 'I', 'user_register', 0, 21, 69, NULL, 0, '2014-08-27 16:48:45'),
(275, 'I', 'user_register', 0, 22, 69, NULL, 0, '2014-08-27 16:48:47'),
(276, 'I', 'user_register', 0, 23, 69, NULL, 0, '2014-08-27 16:48:49'),
(277, 'I', 'user_register', 0, 24, 69, NULL, 0, '2014-08-27 16:48:51'),
(278, 'I', 'user_register', 0, 25, 69, NULL, 0, '2014-08-27 16:48:53'),
(279, 'I', 'user_register', 0, 29, 69, NULL, 0, '2014-08-27 16:48:55'),
(280, 'I', 'user_register', 0, 30, 69, NULL, 0, '2014-08-27 16:48:57'),
(281, 'I', 'user_register', 0, 31, 69, NULL, 0, '2014-08-27 16:48:59'),
(282, 'I', 'user_register', 0, 32, 69, NULL, 0, '2014-08-27 16:49:01'),
(283, 'I', 'user_register', 0, 33, 69, NULL, 0, '2014-08-27 16:49:03'),
(284, 'I', 'user_register', 0, 36, 69, NULL, 0, '2014-08-27 16:49:05'),
(285, 'I', 'user_register', 0, 37, 69, NULL, 0, '2014-08-27 16:49:07'),
(286, 'I', 'user_register', 0, 38, 69, NULL, 0, '2014-08-27 16:49:09'),
(287, 'I', 'user_register', 0, 39, 69, NULL, 0, '2014-08-27 16:49:11'),
(288, 'I', 'user_register', 0, 43, 69, NULL, 0, '2014-08-27 16:49:13'),
(289, 'I', 'user_register', 0, 45, 69, NULL, 0, '2014-08-27 16:49:15'),
(290, 'I', 'user_register', 0, 46, 69, NULL, 0, '2014-08-27 16:49:17'),
(291, 'I', 'user_register', 0, 47, 69, NULL, 0, '2014-08-27 16:49:19'),
(292, 'I', 'user_register', 0, 48, 69, NULL, 0, '2014-08-27 16:49:21'),
(293, 'I', 'user_register', 0, 2, 70, NULL, 1, '2014-08-27 16:49:22'),
(294, 'I', 'user_register', 0, 49, 69, NULL, 0, '2014-08-27 16:49:23'),
(295, 'I', 'user_register', 0, 21, 70, NULL, 0, '2014-08-27 16:49:24'),
(296, 'I', 'user_register', 0, 59, 69, NULL, 1, '2014-08-27 16:49:25'),
(297, 'I', 'user_register', 0, 22, 70, NULL, 0, '2014-08-27 16:49:26'),
(298, 'I', 'user_register', 0, 60, 69, NULL, 0, '2014-08-27 16:49:27'),
(299, 'I', 'user_register', 0, 23, 70, NULL, 0, '2014-08-27 16:49:28'),
(300, 'I', 'user_register', 0, 24, 70, NULL, 0, '2014-08-27 16:49:30'),
(301, 'I', 'user_register', 0, 25, 70, NULL, 0, '2014-08-27 16:49:32'),
(302, 'I', 'user_register', 0, 29, 70, NULL, 0, '2014-08-27 16:49:34'),
(303, 'I', 'user_register', 0, 30, 70, NULL, 0, '2014-08-27 16:49:36'),
(304, 'I', 'user_register', 0, 31, 70, NULL, 0, '2014-08-27 16:49:38'),
(305, 'I', 'user_register', 0, 32, 70, NULL, 0, '2014-08-27 16:49:40'),
(306, 'I', 'user_register', 0, 33, 70, NULL, 0, '2014-08-27 16:49:42'),
(307, 'I', 'user_register', 0, 36, 70, NULL, 0, '2014-08-27 16:49:44'),
(308, 'I', 'user_register', 0, 37, 70, NULL, 0, '2014-08-27 16:49:46'),
(309, 'I', 'user_register', 0, 38, 70, NULL, 0, '2014-08-27 16:49:48'),
(310, 'I', 'user_register', 0, 39, 70, NULL, 0, '2014-08-27 16:49:50'),
(311, 'I', 'user_register', 0, 43, 70, NULL, 0, '2014-08-27 16:49:52'),
(312, 'I', 'user_register', 0, 45, 70, NULL, 0, '2014-08-27 16:49:54'),
(313, 'I', 'user_register', 0, 46, 70, NULL, 0, '2014-08-27 16:49:56'),
(314, 'I', 'user_register', 0, 47, 70, NULL, 0, '2014-08-27 16:49:58'),
(315, 'I', 'user_register', 0, 48, 70, NULL, 0, '2014-08-27 16:50:00'),
(316, 'I', 'user_register', 0, 49, 70, NULL, 0, '2014-08-27 16:50:02'),
(317, 'I', 'user_register', 0, 59, 70, NULL, 1, '2014-08-27 16:50:04'),
(318, 'I', 'user_register', 0, 60, 70, NULL, 0, '2014-08-27 16:50:06'),
(319, 'I', 'user_register', 0, 2, 71, NULL, 1, '2014-08-27 16:50:29'),
(320, 'I', 'user_register', 0, 21, 71, NULL, 0, '2014-08-27 16:50:31'),
(321, 'I', 'user_register', 0, 22, 71, NULL, 0, '2014-08-27 16:50:33'),
(322, 'I', 'user_register', 0, 23, 71, NULL, 0, '2014-08-27 16:50:35'),
(323, 'I', 'user_register', 0, 24, 71, NULL, 0, '2014-08-27 16:50:37'),
(324, 'I', 'user_register', 0, 25, 71, NULL, 0, '2014-08-27 16:50:39'),
(325, 'I', 'user_register', 0, 29, 71, NULL, 0, '2014-08-27 16:50:41'),
(326, 'I', 'user_register', 0, 30, 71, NULL, 0, '2014-08-27 16:50:43'),
(327, 'I', 'user_register', 0, 31, 71, NULL, 0, '2014-08-27 16:50:45'),
(328, 'I', 'user_register', 0, 32, 71, NULL, 0, '2014-08-27 16:50:47'),
(329, 'I', 'user_register', 0, 33, 71, NULL, 0, '2014-08-27 16:50:49'),
(330, 'I', 'user_register', 0, 36, 71, NULL, 0, '2014-08-27 16:50:51'),
(331, 'I', 'user_register', 0, 37, 71, NULL, 0, '2014-08-27 16:50:53'),
(332, 'I', 'user_register', 0, 38, 71, NULL, 0, '2014-08-27 16:50:55'),
(333, 'I', 'user_register', 0, 39, 71, NULL, 0, '2014-08-27 16:50:57'),
(334, 'I', 'user_register', 0, 43, 71, NULL, 0, '2014-08-27 16:50:59'),
(335, 'I', 'user_register', 0, 45, 71, NULL, 0, '2014-08-27 16:51:01'),
(336, 'I', 'user_register', 0, 46, 71, NULL, 0, '2014-08-27 16:51:03'),
(337, 'I', 'user_register', 0, 47, 71, NULL, 0, '2014-08-27 16:51:05'),
(338, 'I', 'user_register', 0, 48, 71, NULL, 0, '2014-08-27 16:51:07'),
(339, 'I', 'user_register', 0, 49, 71, NULL, 0, '2014-08-27 16:51:09'),
(340, 'I', 'user_register', 0, 59, 71, NULL, 1, '2014-08-27 16:51:11'),
(341, 'I', 'user_register', 0, 2, 72, NULL, 1, '2014-08-27 16:51:12'),
(342, 'I', 'user_register', 0, 60, 71, NULL, 0, '2014-08-27 16:51:13'),
(343, 'I', 'user_register', 0, 21, 72, NULL, 0, '2014-08-27 16:51:14'),
(344, 'I', 'user_register', 0, 22, 72, NULL, 0, '2014-08-27 16:51:16'),
(345, 'I', 'user_register', 0, 23, 72, NULL, 0, '2014-08-27 16:51:18'),
(346, 'I', 'user_register', 0, 24, 72, NULL, 0, '2014-08-27 16:51:20'),
(347, 'I', 'user_register', 0, 25, 72, NULL, 0, '2014-08-27 16:51:22'),
(348, 'I', 'user_register', 0, 29, 72, NULL, 0, '2014-08-27 16:51:24'),
(349, 'I', 'user_register', 0, 30, 72, NULL, 0, '2014-08-27 16:51:26'),
(350, 'I', 'user_register', 0, 31, 72, NULL, 0, '2014-08-27 16:51:28'),
(351, 'I', 'user_register', 0, 32, 72, NULL, 0, '2014-08-27 16:51:30'),
(352, 'I', 'user_register', 0, 33, 72, NULL, 0, '2014-08-27 16:51:32'),
(353, 'I', 'user_register', 0, 36, 72, NULL, 0, '2014-08-27 16:51:34'),
(354, 'I', 'user_register', 0, 37, 72, NULL, 0, '2014-08-27 16:51:36'),
(355, 'I', 'user_register', 0, 38, 72, NULL, 0, '2014-08-27 16:51:38'),
(356, 'I', 'user_register', 0, 39, 72, NULL, 0, '2014-08-27 16:51:40'),
(357, 'I', 'user_register', 0, 43, 72, NULL, 0, '2014-08-27 16:51:42'),
(358, 'I', 'user_register', 0, 45, 72, NULL, 0, '2014-08-27 16:51:49'),
(359, 'I', 'user_register', 0, 46, 72, NULL, 0, '2014-08-27 16:51:51'),
(360, 'I', 'user_register', 0, 47, 72, NULL, 0, '2014-08-27 16:51:53'),
(361, 'I', 'user_register', 0, 48, 72, NULL, 0, '2014-08-27 16:51:55'),
(362, 'I', 'user_register', 0, 49, 72, NULL, 0, '2014-08-27 16:51:57'),
(363, 'I', 'user_register', 0, 59, 72, NULL, 1, '2014-08-27 16:51:59'),
(364, 'I', 'user_register', 0, 60, 72, NULL, 0, '2014-08-27 16:52:01'),
(365, 'I', 'user_register', 0, 2, 73, NULL, 1, '2014-08-27 16:52:15'),
(366, 'I', 'user_register', 0, 21, 73, NULL, 0, '2014-08-27 16:52:17'),
(367, 'I', 'user_register', 0, 22, 73, NULL, 0, '2014-08-27 16:52:19'),
(368, 'I', 'user_register', 0, 23, 73, NULL, 0, '2014-08-27 16:52:21'),
(369, 'I', 'user_register', 0, 24, 73, NULL, 0, '2014-08-27 16:52:23'),
(370, 'I', 'user_register', 0, 25, 73, NULL, 0, '2014-08-27 16:52:25'),
(371, 'I', 'user_register', 0, 29, 73, NULL, 0, '2014-08-27 16:52:27'),
(372, 'I', 'user_register', 0, 30, 73, NULL, 0, '2014-08-27 16:52:29'),
(373, 'I', 'user_register', 0, 31, 73, NULL, 0, '2014-08-27 16:52:31'),
(374, 'I', 'user_register', 0, 32, 73, NULL, 0, '2014-08-27 16:52:33'),
(375, 'I', 'user_register', 0, 33, 73, NULL, 0, '2014-08-27 16:52:35'),
(376, 'I', 'user_register', 0, 36, 73, NULL, 0, '2014-08-27 16:52:37'),
(377, 'I', 'user_register', 0, 37, 73, NULL, 0, '2014-08-27 16:52:39'),
(378, 'I', 'user_register', 0, 38, 73, NULL, 0, '2014-08-27 16:52:41'),
(379, 'I', 'user_register', 0, 39, 73, NULL, 0, '2014-08-27 16:52:43'),
(380, 'I', 'user_register', 0, 43, 73, NULL, 0, '2014-08-27 16:52:45'),
(381, 'I', 'user_register', 0, 45, 73, NULL, 0, '2014-08-27 16:52:47'),
(382, 'I', 'user_register', 0, 2, 74, NULL, 1, '2014-08-27 16:52:47'),
(383, 'I', 'user_register', 0, 21, 74, NULL, 0, '2014-08-27 16:52:49'),
(384, 'I', 'user_register', 0, 46, 73, NULL, 0, '2014-08-27 16:52:49'),
(385, 'I', 'user_register', 0, 47, 73, NULL, 0, '2014-08-27 16:52:51'),
(386, 'I', 'user_register', 0, 22, 74, NULL, 0, '2014-08-27 16:52:51'),
(387, 'I', 'user_register', 0, 23, 74, NULL, 0, '2014-08-27 16:52:53'),
(388, 'I', 'user_register', 0, 48, 73, NULL, 0, '2014-08-27 16:52:53'),
(389, 'I', 'user_register', 0, 49, 73, NULL, 0, '2014-08-27 16:52:55'),
(390, 'I', 'user_register', 0, 24, 74, NULL, 0, '2014-08-27 16:52:55'),
(391, 'I', 'user_register', 0, 25, 74, NULL, 0, '2014-08-27 16:52:57'),
(392, 'I', 'user_register', 0, 59, 73, NULL, 1, '2014-08-27 16:52:57'),
(393, 'I', 'user_register', 0, 29, 74, NULL, 0, '2014-08-27 16:52:59'),
(394, 'I', 'user_register', 0, 60, 73, NULL, 0, '2014-08-27 16:52:59'),
(395, 'I', 'user_register', 0, 30, 74, NULL, 0, '2014-08-27 16:53:01'),
(396, 'I', 'user_register', 0, 31, 74, NULL, 0, '2014-08-27 16:53:03'),
(397, 'I', 'user_register', 0, 32, 74, NULL, 0, '2014-08-27 16:53:05'),
(398, 'I', 'user_register', 0, 33, 74, NULL, 0, '2014-08-27 16:53:07'),
(399, 'I', 'user_register', 0, 36, 74, NULL, 0, '2014-08-27 16:53:09'),
(400, 'I', 'user_register', 0, 37, 74, NULL, 0, '2014-08-27 16:53:11'),
(401, 'I', 'user_register', 0, 38, 74, NULL, 0, '2014-08-27 16:53:13'),
(402, 'I', 'user_register', 0, 39, 74, NULL, 0, '2014-08-27 16:53:15'),
(403, 'I', 'user_register', 0, 43, 74, NULL, 0, '2014-08-27 16:53:17'),
(404, 'I', 'user_register', 0, 45, 74, NULL, 0, '2014-08-27 16:53:19'),
(405, 'I', 'user_register', 0, 46, 74, NULL, 0, '2014-08-27 16:53:21'),
(406, 'I', 'user_register', 0, 47, 74, NULL, 0, '2014-08-27 16:53:23'),
(407, 'I', 'user_register', 0, 48, 74, NULL, 0, '2014-08-27 16:53:25'),
(408, 'I', 'user_register', 0, 49, 74, NULL, 0, '2014-08-27 16:53:27'),
(409, 'I', 'user_register', 0, 59, 74, NULL, 1, '2014-08-27 16:53:29'),
(410, 'I', 'user_register', 0, 60, 74, NULL, 0, '2014-08-27 16:53:31'),
(411, 'I', 'user_register', 0, 2, 75, NULL, 1, '2014-08-27 16:53:57'),
(412, 'I', 'user_register', 0, 21, 75, NULL, 0, '2014-08-27 16:53:59'),
(413, 'I', 'user_register', 0, 22, 75, NULL, 0, '2014-08-27 16:54:01'),
(414, 'I', 'user_register', 0, 23, 75, NULL, 0, '2014-08-27 16:54:03'),
(415, 'I', 'user_register', 0, 24, 75, NULL, 0, '2014-08-27 16:54:05'),
(416, 'I', 'user_register', 0, 25, 75, NULL, 0, '2014-08-27 16:54:07'),
(417, 'I', 'user_register', 0, 29, 75, NULL, 0, '2014-08-27 16:54:09'),
(418, 'I', 'user_register', 0, 30, 75, NULL, 0, '2014-08-27 16:54:11'),
(419, 'I', 'user_register', 0, 31, 75, NULL, 0, '2014-08-27 16:54:13'),
(420, 'I', 'user_register', 0, 32, 75, NULL, 0, '2014-08-27 16:54:15'),
(421, 'I', 'user_register', 0, 33, 75, NULL, 0, '2014-08-27 16:54:17'),
(422, 'I', 'user_register', 0, 36, 75, NULL, 0, '2014-08-27 16:54:19'),
(423, 'I', 'user_register', 0, 37, 75, NULL, 0, '2014-08-27 16:54:21'),
(424, 'I', 'user_register', 0, 38, 75, NULL, 0, '2014-08-27 16:54:23'),
(425, 'I', 'user_register', 0, 39, 75, NULL, 0, '2014-08-27 16:54:25'),
(426, 'I', 'user_register', 0, 43, 75, NULL, 0, '2014-08-27 16:54:27'),
(427, 'I', 'user_register', 0, 45, 75, NULL, 0, '2014-08-27 16:54:29'),
(428, 'I', 'user_register', 0, 46, 75, NULL, 0, '2014-08-27 16:54:31'),
(429, 'I', 'user_register', 0, 47, 75, NULL, 0, '2014-08-27 16:54:33'),
(430, 'I', 'user_register', 0, 48, 75, NULL, 0, '2014-08-27 16:54:35'),
(431, 'I', 'user_register', 0, 2, 76, NULL, 1, '2014-08-27 16:54:35'),
(432, 'I', 'user_register', 0, 21, 76, NULL, 0, '2014-08-27 16:54:37'),
(433, 'I', 'user_register', 0, 49, 75, NULL, 0, '2014-08-27 16:54:37'),
(434, 'I', 'user_register', 0, 22, 76, NULL, 0, '2014-08-27 16:54:39'),
(435, 'I', 'user_register', 0, 59, 75, NULL, 1, '2014-08-27 16:54:39'),
(436, 'I', 'user_register', 0, 60, 75, NULL, 0, '2014-08-27 16:54:41'),
(437, 'I', 'user_register', 0, 23, 76, NULL, 0, '2014-08-27 16:54:41'),
(438, 'I', 'user_register', 0, 24, 76, NULL, 0, '2014-08-27 16:54:43'),
(439, 'I', 'user_register', 0, 25, 76, NULL, 0, '2014-08-27 16:54:45'),
(440, 'I', 'user_register', 0, 29, 76, NULL, 0, '2014-08-27 16:54:47'),
(441, 'I', 'user_register', 0, 30, 76, NULL, 0, '2014-08-27 16:54:49'),
(442, 'I', 'user_register', 0, 31, 76, NULL, 0, '2014-08-27 16:54:51'),
(443, 'I', 'user_register', 0, 32, 76, NULL, 0, '2014-08-27 16:54:53'),
(444, 'I', 'user_register', 0, 33, 76, NULL, 0, '2014-08-27 16:54:55'),
(445, 'I', 'user_register', 0, 36, 76, NULL, 0, '2014-08-27 16:54:57'),
(446, 'I', 'user_register', 0, 37, 76, NULL, 0, '2014-08-27 16:54:59'),
(447, 'I', 'user_register', 0, 38, 76, NULL, 0, '2014-08-27 16:55:01'),
(448, 'I', 'user_register', 0, 39, 76, NULL, 0, '2014-08-27 16:55:03'),
(449, 'I', 'user_register', 0, 43, 76, NULL, 0, '2014-08-27 16:55:05'),
(450, 'I', 'user_register', 0, 45, 76, NULL, 0, '2014-08-27 16:55:07'),
(451, 'I', 'user_register', 0, 46, 76, NULL, 0, '2014-08-27 16:55:09'),
(452, 'I', 'user_register', 0, 47, 76, NULL, 0, '2014-08-27 16:55:11'),
(453, 'I', 'user_register', 0, 48, 76, NULL, 0, '2014-08-27 16:55:13'),
(454, 'I', 'user_register', 0, 49, 76, NULL, 0, '2014-08-27 16:55:15'),
(455, 'I', 'user_register', 0, 59, 76, NULL, 1, '2014-08-27 16:55:17'),
(456, 'I', 'user_register', 0, 60, 76, NULL, 0, '2014-08-27 16:55:19'),
(457, 'I', 'user_register', 0, 2, 77, NULL, 1, '2014-08-27 16:55:30'),
(458, 'I', 'user_register', 0, 21, 77, NULL, 0, '2014-08-27 16:55:32'),
(459, 'I', 'user_register', 0, 22, 77, NULL, 0, '2014-08-27 16:55:34'),
(460, 'I', 'user_register', 0, 23, 77, NULL, 0, '2014-08-27 16:55:36'),
(461, 'I', 'user_register', 0, 24, 77, NULL, 0, '2014-08-27 16:55:38'),
(462, 'I', 'user_register', 0, 25, 77, NULL, 0, '2014-08-27 16:55:40'),
(463, 'I', 'user_register', 0, 29, 77, NULL, 0, '2014-08-27 16:55:42'),
(464, 'I', 'user_register', 0, 30, 77, NULL, 0, '2014-08-27 16:55:44'),
(465, 'I', 'user_register', 0, 31, 77, NULL, 0, '2014-08-27 16:55:46'),
(466, 'I', 'user_register', 0, 32, 77, NULL, 0, '2014-08-27 16:55:48'),
(467, 'I', 'user_register', 0, 33, 77, NULL, 0, '2014-08-27 16:55:50'),
(468, 'I', 'user_register', 0, 36, 77, NULL, 0, '2014-08-27 16:55:52'),
(469, 'I', 'user_register', 0, 37, 77, NULL, 0, '2014-08-27 16:55:54'),
(470, 'I', 'user_register', 0, 38, 77, NULL, 0, '2014-08-27 16:55:56'),
(471, 'I', 'user_register', 0, 39, 77, NULL, 0, '2014-08-27 16:55:58'),
(472, 'I', 'user_register', 0, 43, 77, NULL, 0, '2014-08-27 16:56:00'),
(473, 'I', 'user_register', 0, 45, 77, NULL, 0, '2014-08-27 16:56:02'),
(474, 'I', 'user_register', 0, 46, 77, NULL, 0, '2014-08-27 16:56:04'),
(475, 'I', 'user_register', 0, 47, 77, NULL, 0, '2014-08-27 16:56:06'),
(476, 'I', 'user_register', 0, 48, 77, NULL, 0, '2014-08-27 16:56:08'),
(477, 'I', 'user_register', 0, 49, 77, NULL, 0, '2014-08-27 16:56:10'),
(478, 'I', 'user_register', 0, 59, 77, NULL, 1, '2014-08-27 16:56:12'),
(479, 'I', 'user_register', 0, 60, 77, NULL, 0, '2014-08-27 16:56:14'),
(480, 'I', 'user_register', 0, 2, 78, NULL, 1, '2014-08-27 16:56:42'),
(481, 'I', 'user_register', 0, 21, 78, NULL, 0, '2014-08-27 16:56:44'),
(482, 'I', 'user_register', 0, 22, 78, NULL, 0, '2014-08-27 16:56:46'),
(483, 'I', 'user_register', 0, 23, 78, NULL, 0, '2014-08-27 16:56:48'),
(484, 'I', 'user_register', 0, 24, 78, NULL, 0, '2014-08-27 16:56:50'),
(485, 'I', 'user_register', 0, 25, 78, NULL, 0, '2014-08-27 16:56:52'),
(486, 'I', 'user_register', 0, 29, 78, NULL, 0, '2014-08-27 16:56:54'),
(487, 'I', 'user_register', 0, 30, 78, NULL, 0, '2014-08-27 16:56:56'),
(488, 'I', 'user_register', 0, 31, 78, NULL, 0, '2014-08-27 16:56:58'),
(489, 'I', 'user_register', 0, 32, 78, NULL, 0, '2014-08-27 16:57:00'),
(490, 'I', 'user_register', 0, 33, 78, NULL, 0, '2014-08-27 16:57:02'),
(491, 'I', 'user_register', 0, 36, 78, NULL, 0, '2014-08-27 16:57:04'),
(492, 'I', 'user_register', 0, 37, 78, NULL, 0, '2014-08-27 16:57:06'),
(493, 'I', 'user_register', 0, 38, 78, NULL, 0, '2014-08-27 16:57:08'),
(494, 'I', 'user_register', 0, 39, 78, NULL, 0, '2014-08-27 16:57:10'),
(495, 'I', 'user_register', 0, 43, 78, NULL, 0, '2014-08-27 16:57:12'),
(496, 'I', 'user_register', 0, 45, 78, NULL, 0, '2014-08-27 16:57:14'),
(497, 'I', 'user_register', 0, 46, 78, NULL, 0, '2014-08-27 16:57:16'),
(498, 'I', 'user_register', 0, 47, 78, NULL, 0, '2014-08-27 16:57:18'),
(499, 'I', 'user_register', 0, 48, 78, NULL, 0, '2014-08-27 16:57:20'),
(500, 'I', 'user_register', 0, 2, 79, NULL, 1, '2014-08-27 16:57:21'),
(501, 'I', 'user_register', 0, 49, 78, NULL, 0, '2014-08-27 16:57:22'),
(502, 'I', 'user_register', 0, 21, 79, NULL, 0, '2014-08-27 16:57:23'),
(503, 'I', 'user_register', 0, 59, 78, NULL, 1, '2014-08-27 16:57:24'),
(504, 'I', 'user_register', 0, 22, 79, NULL, 0, '2014-08-27 16:57:25'),
(505, 'I', 'user_register', 0, 60, 78, NULL, 0, '2014-08-27 16:57:26'),
(506, 'I', 'user_register', 0, 23, 79, NULL, 0, '2014-08-27 16:57:27'),
(507, 'I', 'user_register', 0, 24, 79, NULL, 0, '2014-08-27 16:57:29'),
(508, 'I', 'user_register', 0, 25, 79, NULL, 0, '2014-08-27 16:57:31'),
(509, 'I', 'user_register', 0, 29, 79, NULL, 0, '2014-08-27 16:57:33'),
(510, 'I', 'user_register', 0, 30, 79, NULL, 0, '2014-08-27 16:57:35'),
(511, 'I', 'user_register', 0, 31, 79, NULL, 0, '2014-08-27 16:57:37'),
(512, 'I', 'user_register', 0, 32, 79, NULL, 0, '2014-08-27 16:57:39'),
(513, 'I', 'user_register', 0, 33, 79, NULL, 0, '2014-08-27 16:57:41'),
(514, 'I', 'user_register', 0, 36, 79, NULL, 0, '2014-08-27 16:57:43'),
(515, 'I', 'user_register', 0, 37, 79, NULL, 0, '2014-08-27 16:57:45'),
(516, 'I', 'user_register', 0, 38, 79, NULL, 0, '2014-08-27 16:57:47'),
(517, 'I', 'user_register', 0, 39, 79, NULL, 0, '2014-08-27 16:57:49'),
(518, 'I', 'user_register', 0, 43, 79, NULL, 0, '2014-08-27 16:57:51'),
(519, 'I', 'user_register', 0, 45, 79, NULL, 0, '2014-08-27 16:57:53'),
(520, 'I', 'user_register', 0, 46, 79, NULL, 0, '2014-08-27 16:57:55'),
(521, 'I', 'user_register', 0, 47, 79, NULL, 0, '2014-08-27 16:57:57'),
(522, 'I', 'user_register', 0, 48, 79, NULL, 0, '2014-08-27 16:57:59'),
(523, 'I', 'user_register', 0, 49, 79, NULL, 0, '2014-08-27 16:58:01'),
(524, 'I', 'user_register', 0, 2, 80, NULL, 1, '2014-08-27 16:58:02'),
(525, 'I', 'user_register', 0, 59, 79, NULL, 1, '2014-08-27 16:58:03'),
(526, 'I', 'user_register', 0, 21, 80, NULL, 0, '2014-08-27 16:58:04'),
(527, 'I', 'user_register', 0, 60, 79, NULL, 0, '2014-08-27 16:58:05'),
(528, 'I', 'user_register', 0, 22, 80, NULL, 0, '2014-08-27 16:58:06'),
(529, 'I', 'user_register', 0, 23, 80, NULL, 0, '2014-08-27 16:58:08'),
(530, 'I', 'user_register', 0, 24, 80, NULL, 0, '2014-08-27 16:58:10'),
(531, 'I', 'user_register', 0, 25, 80, NULL, 0, '2014-08-27 16:58:12'),
(532, 'I', 'user_register', 0, 29, 80, NULL, 0, '2014-08-27 16:58:14'),
(533, 'I', 'user_register', 0, 30, 80, NULL, 0, '2014-08-27 16:58:16'),
(534, 'I', 'user_register', 0, 31, 80, NULL, 0, '2014-08-27 16:58:18'),
(535, 'I', 'user_register', 0, 32, 80, NULL, 0, '2014-08-27 16:58:20'),
(536, 'I', 'user_register', 0, 33, 80, NULL, 0, '2014-08-27 16:58:22'),
(537, 'I', 'user_register', 0, 36, 80, NULL, 0, '2014-08-27 16:58:24'),
(538, 'I', 'user_register', 0, 37, 80, NULL, 0, '2014-08-27 16:58:26'),
(539, 'I', 'user_register', 0, 38, 80, NULL, 0, '2014-08-27 16:58:28'),
(540, 'I', 'user_register', 0, 39, 80, NULL, 0, '2014-08-27 16:58:30'),
(541, 'I', 'user_register', 0, 43, 80, NULL, 0, '2014-08-27 16:58:32'),
(542, 'I', 'user_register', 0, 45, 80, NULL, 0, '2014-08-27 16:58:34'),
(543, 'I', 'user_register', 0, 46, 80, NULL, 0, '2014-08-27 16:58:36'),
(544, 'I', 'user_register', 0, 47, 80, NULL, 0, '2014-08-27 16:58:38'),
(545, 'I', 'user_register', 0, 48, 80, NULL, 0, '2014-08-27 16:58:40'),
(546, 'I', 'user_register', 0, 49, 80, NULL, 0, '2014-08-27 16:58:42'),
(547, 'I', 'user_register', 0, 59, 80, NULL, 1, '2014-08-27 16:58:44'),
(548, 'I', 'user_register', 0, 60, 80, NULL, 0, '2014-08-27 16:58:46'),
(549, 'I', 'user_register', 0, 2, 81, NULL, 1, '2014-08-27 16:58:48'),
(550, 'I', 'user_register', 0, 21, 81, NULL, 0, '2014-08-27 16:58:50'),
(551, 'I', 'user_register', 0, 22, 81, NULL, 0, '2014-08-27 16:58:52'),
(552, 'I', 'user_register', 0, 23, 81, NULL, 0, '2014-08-27 16:58:54'),
(553, 'I', 'user_register', 0, 24, 81, NULL, 0, '2014-08-27 16:58:56'),
(554, 'I', 'user_register', 0, 25, 81, NULL, 0, '2014-08-27 16:58:58'),
(555, 'I', 'user_register', 0, 29, 81, NULL, 0, '2014-08-27 16:59:00'),
(556, 'I', 'user_register', 0, 30, 81, NULL, 0, '2014-08-27 16:59:02'),
(557, 'I', 'user_register', 0, 31, 81, NULL, 0, '2014-08-27 16:59:04'),
(558, 'I', 'user_register', 0, 32, 81, NULL, 0, '2014-08-27 16:59:06'),
(559, 'I', 'user_register', 0, 33, 81, NULL, 0, '2014-08-27 16:59:08'),
(560, 'I', 'user_register', 0, 36, 81, NULL, 0, '2014-08-27 16:59:10'),
(561, 'I', 'user_register', 0, 37, 81, NULL, 0, '2014-08-27 16:59:12'),
(562, 'I', 'user_register', 0, 38, 81, NULL, 0, '2014-08-27 16:59:14'),
(563, 'I', 'user_register', 0, 39, 81, NULL, 0, '2014-08-27 16:59:16'),
(564, 'I', 'user_register', 0, 43, 81, NULL, 0, '2014-08-27 16:59:18'),
(565, 'I', 'user_register', 0, 45, 81, NULL, 0, '2014-08-27 16:59:20'),
(566, 'I', 'user_register', 0, 46, 81, NULL, 0, '2014-08-27 16:59:22'),
(567, 'I', 'user_register', 0, 47, 81, NULL, 0, '2014-08-27 16:59:24'),
(568, 'I', 'user_register', 0, 48, 81, NULL, 0, '2014-08-27 16:59:26'),
(569, 'I', 'user_register', 0, 49, 81, NULL, 0, '2014-08-27 16:59:28'),
(570, 'I', 'user_register', 0, 2, 82, NULL, 1, '2014-08-27 16:59:28'),
(571, 'I', 'user_register', 0, 21, 82, NULL, 0, '2014-08-27 16:59:30'),
(572, 'I', 'user_register', 0, 59, 81, NULL, 1, '2014-08-27 16:59:30'),
(573, 'I', 'user_register', 0, 60, 81, NULL, 0, '2014-08-27 16:59:32'),
(574, 'I', 'user_register', 0, 22, 82, NULL, 0, '2014-08-27 16:59:32'),
(575, 'I', 'user_register', 0, 23, 82, NULL, 0, '2014-08-27 16:59:34'),
(576, 'I', 'user_register', 0, 24, 82, NULL, 0, '2014-08-27 16:59:36'),
(577, 'I', 'user_register', 0, 25, 82, NULL, 0, '2014-08-27 16:59:38'),
(578, 'I', 'user_register', 0, 29, 82, NULL, 0, '2014-08-27 16:59:40'),
(579, 'I', 'user_register', 0, 30, 82, NULL, 0, '2014-08-27 16:59:42'),
(580, 'I', 'user_register', 0, 31, 82, NULL, 0, '2014-08-27 16:59:44'),
(581, 'I', 'user_register', 0, 32, 82, NULL, 0, '2014-08-27 16:59:46'),
(582, 'I', 'user_register', 0, 33, 82, NULL, 0, '2014-08-27 16:59:48'),
(583, 'I', 'user_register', 0, 36, 82, NULL, 0, '2014-08-27 16:59:50'),
(584, 'I', 'user_register', 0, 37, 82, NULL, 0, '2014-08-27 16:59:52'),
(585, 'I', 'user_register', 0, 38, 82, NULL, 0, '2014-08-27 16:59:54'),
(586, 'I', 'user_register', 0, 39, 82, NULL, 0, '2014-08-27 16:59:56'),
(587, 'I', 'user_register', 0, 43, 82, NULL, 0, '2014-08-27 16:59:58'),
(588, 'I', 'user_register', 0, 45, 82, NULL, 0, '2014-08-27 17:00:00'),
(589, 'I', 'user_register', 0, 46, 82, NULL, 0, '2014-08-27 17:00:02'),
(590, 'I', 'user_register', 0, 47, 82, NULL, 0, '2014-08-27 17:00:04'),
(591, 'I', 'user_register', 0, 48, 82, NULL, 0, '2014-08-27 17:00:06'),
(592, 'I', 'user_register', 0, 49, 82, NULL, 0, '2014-08-27 17:00:08'),
(593, 'I', 'user_register', 0, 59, 82, NULL, 1, '2014-08-27 17:00:10'),
(594, 'I', 'user_register', 0, 60, 82, NULL, 0, '2014-08-27 17:00:12'),
(595, 'I', 'user_register', 0, 2, 83, NULL, 1, '2014-08-27 17:00:13'),
(596, 'I', 'user_register', 0, 21, 83, NULL, 0, '2014-08-27 17:00:15'),
(597, 'I', 'user_register', 0, 22, 83, NULL, 0, '2014-08-27 17:00:17'),
(598, 'I', 'user_register', 0, 23, 83, NULL, 0, '2014-08-27 17:00:19'),
(599, 'I', 'user_register', 0, 24, 83, NULL, 0, '2014-08-27 17:00:21'),
(600, 'I', 'user_register', 0, 25, 83, NULL, 0, '2014-08-27 17:00:23'),
(601, 'I', 'user_register', 0, 29, 83, NULL, 0, '2014-08-27 17:00:25'),
(602, 'I', 'user_register', 0, 30, 83, NULL, 0, '2014-08-27 17:00:27'),
(603, 'I', 'user_register', 0, 31, 83, NULL, 0, '2014-08-27 17:00:29'),
(604, 'I', 'user_register', 0, 32, 83, NULL, 0, '2014-08-27 17:00:31'),
(605, 'I', 'user_register', 0, 33, 83, NULL, 0, '2014-08-27 17:00:33'),
(606, 'I', 'user_register', 0, 36, 83, NULL, 0, '2014-08-27 17:00:35'),
(607, 'I', 'user_register', 0, 37, 83, NULL, 0, '2014-08-27 17:00:37'),
(608, 'I', 'user_register', 0, 38, 83, NULL, 0, '2014-08-27 17:00:39'),
(609, 'I', 'user_register', 0, 39, 83, NULL, 0, '2014-08-27 17:00:41'),
(610, 'I', 'user_register', 0, 43, 83, NULL, 0, '2014-08-27 17:00:43'),
(611, 'I', 'user_register', 0, 45, 83, NULL, 0, '2014-08-27 17:00:45'),
(612, 'I', 'user_register', 0, 46, 83, NULL, 0, '2014-08-27 17:00:47'),
(613, 'I', 'user_register', 0, 47, 83, NULL, 0, '2014-08-27 17:00:49'),
(614, 'I', 'user_register', 0, 48, 83, NULL, 0, '2014-08-27 17:00:51'),
(615, 'I', 'user_register', 0, 49, 83, NULL, 0, '2014-08-27 17:00:53'),
(616, 'I', 'user_register', 0, 59, 83, NULL, 1, '2014-08-27 17:00:55'),
(617, 'I', 'user_register', 0, 60, 83, NULL, 0, '2014-08-27 17:00:57'),
(618, 'I', 'user_register', 0, 2, 84, NULL, 1, '2014-08-27 17:01:19'),
(619, 'I', 'user_register', 0, 21, 84, NULL, 0, '2014-08-27 17:01:21'),
(620, 'I', 'user_register', 0, 22, 84, NULL, 0, '2014-08-27 17:01:23'),
(621, 'I', 'user_register', 0, 23, 84, NULL, 0, '2014-08-27 17:01:25'),
(622, 'I', 'user_register', 0, 24, 84, NULL, 0, '2014-08-27 17:01:27'),
(623, 'I', 'user_register', 0, 25, 84, NULL, 0, '2014-08-27 17:01:29'),
(624, 'I', 'user_register', 0, 29, 84, NULL, 0, '2014-08-27 17:01:31'),
(625, 'I', 'user_register', 0, 30, 84, NULL, 0, '2014-08-27 17:01:33'),
(626, 'I', 'user_register', 0, 31, 84, NULL, 0, '2014-08-27 17:01:35'),
(627, 'I', 'user_register', 0, 32, 84, NULL, 0, '2014-08-27 17:01:37'),
(628, 'I', 'user_register', 0, 33, 84, NULL, 0, '2014-08-27 17:01:39'),
(629, 'I', 'user_register', 0, 36, 84, NULL, 0, '2014-08-27 17:01:41'),
(630, 'I', 'user_register', 0, 37, 84, NULL, 0, '2014-08-27 17:01:43'),
(631, 'I', 'user_register', 0, 38, 84, NULL, 0, '2014-08-27 17:01:45'),
(632, 'I', 'user_register', 0, 39, 84, NULL, 0, '2014-08-27 17:01:47'),
(633, 'I', 'user_register', 0, 43, 84, NULL, 0, '2014-08-27 17:01:49'),
(634, 'I', 'user_register', 0, 45, 84, NULL, 0, '2014-08-27 17:01:51'),
(635, 'I', 'user_register', 0, 46, 84, NULL, 1, '2014-08-27 17:01:53'),
(636, 'I', 'user_register', 0, 47, 84, NULL, 0, '2014-08-27 17:01:55'),
(637, 'I', 'user_register', 0, 48, 84, NULL, 0, '2014-08-27 17:01:57'),
(638, 'I', 'user_register', 0, 49, 84, NULL, 0, '2014-08-27 17:01:59'),
(639, 'I', 'user_register', 0, 59, 84, NULL, 1, '2014-08-27 17:02:01'),
(640, 'I', 'user_register', 0, 60, 84, NULL, 0, '2014-08-27 17:02:03'),
(641, 'N', 'rector_assign_academy', 2, 58, 8, NULL, 0, '2014-08-27 17:08:18'),
(642, 'N', 'dean_assign_school', 2, 58, 19, NULL, 0, '2014-08-27 17:12:48'),
(643, 'I', 'user_register', 0, 2, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 1, '2014-08-28 13:16:43'),
(644, 'I', 'user_register', 0, 21, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:45'),
(645, 'I', 'user_register', 0, 22, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:47'),
(646, 'I', 'user_register', 0, 23, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:49'),
(647, 'I', 'user_register', 0, 24, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:51'),
(648, 'I', 'user_register', 0, 25, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:54'),
(649, 'I', 'user_register', 0, 29, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:56'),
(650, 'I', 'user_register', 0, 30, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:16:58'),
(651, 'I', 'user_register', 0, 31, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:01'),
(652, 'I', 'user_register', 0, 32, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:03'),
(653, 'I', 'user_register', 0, 33, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:05'),
(654, 'I', 'user_register', 0, 36, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:09'),
(655, 'I', 'user_register', 0, 37, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:12'),
(656, 'I', 'user_register', 0, 38, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:14');
INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(657, 'I', 'user_register', 0, 39, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 1, '2014-08-28 13:17:16'),
(658, 'I', 'user_register', 0, 43, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:19'),
(659, 'I', 'user_register', 0, 45, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:22'),
(660, 'I', 'user_register', 0, 46, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 1, '2014-08-28 13:17:25'),
(661, 'I', 'user_register', 0, 47, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:27'),
(662, 'I', 'user_register', 0, 48, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:29'),
(663, 'I', 'user_register', 0, 49, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:32'),
(664, 'I', 'user_register', 0, 58, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:34'),
(665, 'I', 'user_register', 0, 59, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 1, '2014-08-28 13:17:37'),
(666, 'I', 'user_register', 0, 60, 102, 'a:9:{s:9:"firstname";s:6:"Davide";s:8:"lastname";s:11:"Cortellessa";s:8:"username";s:11:"Cortellessa";s:7:"city_id";s:1:"6";s:13:"date_of_birth";s:10:"17-04-1990";s:5:"email";s:20:"cordavide@hotmail.it";s:8:"password";s:6:"davide";s:9:"cpassword";s:6:"davide";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 13:17:39'),
(667, 'N', 'teacher_assign_class', 2, 47, 24, NULL, 0, '2014-08-28 14:20:34'),
(668, 'N', 'teacher_assign_class', 2, 127, 25, NULL, 0, '2014-09-02 14:51:46'),
(669, 'N', 'teacher_assign_class', 2, 58, 26, NULL, 0, '2014-09-02 15:09:15'),
(670, 'N', 'teacher_assign_class', 2, 52, 27, NULL, 0, '2014-09-02 16:48:10'),
(671, 'N', 'teacher_assign_class', 2, 157, 28, NULL, 0, '2014-09-08 10:26:59'),
(672, 'I', 'user_register', 0, 2, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:06:34'),
(673, 'I', 'user_register', 0, 21, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:06:42'),
(674, 'I', 'user_register', 0, 22, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:06:49'),
(675, 'I', 'user_register', 0, 23, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:06:56'),
(676, 'I', 'user_register', 0, 33, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:02'),
(677, 'I', 'user_register', 0, 36, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:08'),
(678, 'I', 'user_register', 0, 37, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:14'),
(679, 'I', 'user_register', 0, 38, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:21'),
(680, 'I', 'user_register', 0, 39, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:27'),
(681, 'I', 'user_register', 0, 43, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:35'),
(682, 'I', 'user_register', 0, 45, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:42'),
(683, 'I', 'user_register', 0, 46, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:49'),
(684, 'I', 'user_register', 0, 47, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:07:55'),
(685, 'I', 'user_register', 0, 48, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:01'),
(686, 'I', 'user_register', 0, 49, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:08'),
(687, 'I', 'user_register', 0, 52, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:14'),
(688, 'I', 'user_register', 0, 57, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:22'),
(689, 'I', 'user_register', 0, 58, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:28'),
(690, 'I', 'user_register', 0, 59, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:41'),
(691, 'I', 'user_register', 0, 60, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:47'),
(692, 'I', 'user_register', 0, 127, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:53'),
(693, 'I', 'user_register', 0, 157, 158, 'a:10:{s:9:"firstname";s:6:"Ireneo";s:8:"lastname";s:8:"Genovese";s:8:"username";s:6:"ireneo";s:7:"city_id";s:1:"6";s:17:"city_of_residence";s:4:"Temp";s:13:"date_of_birth";s:10:"16-04-1990";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-09 10:08:59'),
(789, 'N', 'change_clan_date', 1, 3, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:46:41'),
(790, 'N', 'change_clan_date', 1, 5, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:46:54'),
(791, 'N', 'change_clan_date', 1, 12, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 1, '2014-09-10 09:47:01'),
(792, 'N', 'change_clan_date', 1, 13, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:07'),
(793, 'N', 'change_clan_date', 1, 14, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:18'),
(794, 'N', 'change_clan_date', 1, 15, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:24'),
(795, 'N', 'change_clan_date', 1, 16, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:29'),
(796, 'N', 'change_clan_date', 1, 17, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:36'),
(797, 'N', 'change_clan_date', 1, 20, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:41'),
(798, 'N', 'change_clan_date', 1, 21, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:47'),
(799, 'N', 'change_clan_date', 1, 23, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:53'),
(800, 'N', 'change_clan_date', 1, 25, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:47:59'),
(801, 'N', 'change_clan_date', 1, 27, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:48:05'),
(802, 'N', 'change_clan_date', 1, 31, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:48:12'),
(803, 'N', 'change_clan_date', 1, 33, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:48:18'),
(804, 'N', 'change_clan_date', 1, 34, 5, 'a:5:{s:7:"clan_id";s:1:"1";s:15:"clan_shift_from";s:10:"2014-09-17";s:9:"clan_date";s:10:"21-09-2014";s:11:"description";s:13:"Holiday .....";s:6:"notify";s:1:"1";}', 0, '2014-09-10 09:48:24');

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
(2, 'Admin', 'Admin', 0, 'a:15:{s:5:"roles";a:2:{i:0;s:8:"viewRole";i:1;s:8:"editRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:9:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";i:8;s:14:"changeClanDate";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:4:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";}s:7:"batches";a:3:{i:0;s:9:"viewBatch";i:1;s:9:"editBatch";i:2;s:11:"deleteBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";}s:13:"group_message";a:6:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 0, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:14:"changeClanDate";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:22'),
(4, 'Dean', 'Preside', 0, 'a:7:{s:5:"roles";a:1:{i:0;s:8:"viewRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 0, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:5:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";i:4;s:24:"changeStatusTrialStudent";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 0, 'a:4:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}}', '0', 2, '2014-07-17 10:17:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
(13, 'general', 9, 'terms_conditions', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque tincidunt porttitor. Aliquam mollis nulla felis, eget maximus ipsum posuere ut. Duis bibendum sagittis metus, sed mattis ex sagittis sed. Vivamus facilisis justo arcu, id bibendum nulla ultrices vitae. Donec vitae ex ultricies, aliquet magna vitae, elementum nunc. Vivamus nulla nisl, ultricies a rhoncus quis, lobortis quis neque. Integer nisi ex, rhoncus vitae vehicula et, scelerisque non dui. Morbi porta, est sit amet egestas scelerisque, leo sem molestie diam, eget sagittis metus risus eget nisi. Aliquam erat volutpat. Vestibulum ac libero tellus. Cras imperdiet nunc eu tincidunt venenatis.</span></p><p><span>Phasellus condimentum, lorem vitae gravida gravida, ipsum felis facilisis massa, eget elementum risus lorem vel est. Fusce augue justo, facilisis non ligula in, feugiat porta sem. Praesent nec augue turpis. Nulla consectetur porta est vel efficitur. Vestibulum condimentum, libero sed tincidunt lobortis, eros lorem efficitur sapien, et interdum dui purus id justo. Vivamus porttitor felis sed purus sodales finibus. Maecenas convallis in ligula a hendrerit. Vivamus dapibus dapibus dictum. Integer iaculis leo purus, at lobortis mi eleifend sed. Maecenas vitae gravida nulla, vel luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam efficitur mauris at tortor maximus, ut placerat elit tempus. Nunc pretium blandit efficitur.</span></p><p><span>Duis convallis lobortis leo quis faucibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum et tempor est, scelerisque consequat nunc. Nam sit amet tempus ipsum. Nunc porta convallis arcu. In vehicula ligula felis, non dapibus mauris congue eget. Donec elit lorem, molestie nec pharetra euismod, sagittis eget tellus. Sed justo dolor, rutrum ut magna posuere, egestas maximus dui. Praesent erat magna, ornare molestie ultrices ut, porta at erat. Sed tempor elit sit amet libero imperdiet cursus.</span></p>', 2, '2014-09-03 04:14:42'),
(14, 'general', 7, 'reset_app_day_month', '31-12', 2, '2014-09-03 04:14:42'),
(15, 'general', 8, 'pupil_basic_level', '6', 2, '2014-09-08 12:09:30');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
`id` int(11) NOT NULL,
  `student_master_id` int(11) NOT NULL,
  `clan_id` varchar(11) NOT NULL DEFAULT '0',
  `batch_id` int(11) NOT NULL,
  `color_of_blade` int(11) NOT NULL DEFAULT '1',
  `first_lesson_date` date DEFAULT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `palce_of_birth` text,
  `zip_code` bigint(11) DEFAULT NULL,
  `tax_code` bigint(11) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `status` enum('A','P','U','P2') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `batch_id`, `color_of_blade`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(5, 14, '1', 4, 2, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:02'),
(6, 15, '2', 1, 1, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(7, 16, '2', 6, 1, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(8, 17, '5', 6, 1, '2014-08-11', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-05 00:09:27'),
(9, 20, '5', 6, 1, '2014-08-28', 2, NULL, NULL, NULL, NULL, 'A', 20, '2014-08-21 01:37:12'),
(10, 13, '5', 6, 1, '2014-08-30', 3, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-25 05:27:01'),
(11, 21, '6', 6, 1, '2014-08-28', 3, NULL, NULL, NULL, NULL, 'A', 21, '2014-08-25 05:52:04'),
(13, 25, '6', 6, 1, '2014-08-28', 3, NULL, NULL, NULL, NULL, 'A', 21, '2014-08-25 05:52:04'),
(15, 27, '4', 6, 1, '2014-09-09', 8, 'roma', 0, 0, 'ah+', 'A', 27, '2014-09-04 15:25:53'),
(16, 28, '4', 6, 1, '2014-09-16', 0, NULL, NULL, NULL, NULL, 'P', 28, '2014-09-05 08:45:20'),
(18, 31, '4', 6, 1, '2014-09-16', 8, NULL, NULL, NULL, NULL, 'A', 31, '2014-09-05 11:33:36'),
(19, 33, '4', 6, 1, '2014-09-30', 8, NULL, NULL, NULL, NULL, 'A', 33, '2014-09-05 13:05:45'),
(20, 34, '4', 6, 1, '2014-09-23', 8, NULL, NULL, NULL, NULL, 'A', 34, '2014-09-05 13:18:57'),
(21, 23, '2', 6, 1, '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:02'),
(25, 12, '0', 0, 1, NULL, 0, 'Vadodara', 390016, 610093, 'B -ve', 'P2', 12, '2014-09-11 05:49:27');

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
  `status` enum('A','D','P','U') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `city_of_residence`, `permission`, `avtar`, `address`, `phone_no_1`, `phone_no_2`, `quote`, `about_me`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'ranasoyab@yopmail.com', 316895400, 5, 4, 2, 'Temp', NULL, '94048c9c2c04baf3b871be491ef8ded2.jpg', 'Gorwa,Baroda', '9876543210', '1234567890', 'Only one thing is impossible for God: To find any sense in any copyright law on the planet', '<p ><span >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel sapien sapien. Duis dictum leo dui, nec blandit nisl imperdiet ut. Donec quis condimentum libero. In volutpat urna id feugiat porta. Suspendisse a sem augue. Curabitur sodales, odio ut tempor scelerisque, eros tellus lacinia elit, id euismod felis nulla id erat. Quisque porttitor velit in sollicitudin eleifend.</span></p><p ><span >Etiam consequat nulla nec sapien blandit ullamcorper id at nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce pellentesque elit quis lorem vulputate ornare. Proin turpis metus, convallis eget lectus at, volutpat molestie augue. Curabitur at ligula viverra ante rutrum euismod. Duis pulvinar rhoncus facilisis. Curabitur lobortis, ante at semper finibus, leo turpis sollicitudin libero, a congue magna neque vitae enim. Nunc vestibulum aliquam lacus, a tempus lorem vehicula et. Vivamus at arcu suscipit, cursus turpis et, egestas elit. Maecenas tincidunt, risus ac scelerisque consequat, ex sapien euismod turpis, egestas hendrerit eros augue at justo. Praesent scelerisque mi quis nulla feugiat scelerisque vel sit amet leo. Nulla efficitur mattis nisi, vitae dictum tortor placerat in. Quisque tempor, ex nec volutpat scelerisque, lorem urna luctus lectus, at posuere velit felis sit amet arcu.</span></p>', 'A', 1, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Carmelo', 'Samperi', 'ranasoyab@yopmail.com', 316809000, 5, 4, 2, 'Temp', NULL, '1adfa22db058e6383b4365cb7906590f.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rector', '1', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, NULL, '063fd00a3c30c83404faf36e32b2dada.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-07-17 07:28:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', '1', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-07-17 07:28:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', '1', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, '44999132c325dd575171618f58a0712a.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 5, '2014-07-21 10:11:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', '2', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 2, '2014-07-17 07:28:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(12, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'c05b3802dd788813231e79ce67a5513d.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 3, '2014-07-31 10:45:54'),
(13, '6', 'martin', '202cb962ac59075b964b07152d234b70', 'Martin', 'Lusi', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, '0b1b838debca3f07a19dfb93846a38a2.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-01 05:20:27'),
(14, '6', 'student_1', '202cb962ac59075b964b07152d234b70', 'A Student', 'First', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, 'Vadodara', NULL, 'no_avatar.jpg', 'Baroda', '91987654321', '91987654321', '', '<p><br></p>', 'A', 14, '2014-08-04 05:37:32'),
(15, '6', 'student_2', '202cb962ac59075b964b07152d234b70', 'C Student', 'Second', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:19'),
(16, '6', 'student_3', '202cb962ac59075b964b07152d234b70', 'D Student', 'Third', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:37:56'),
(17, '6', 'student_4', '202cb962ac59075b964b07152d234b70', 'B Student', 'Fourth', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 3, '2014-08-04 05:38:37'),
(19, '5', 'teacher_4', '202cb962ac59075b964b07152d234b70', 'Teacher', '4', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 1, '2014-07-21 10:11:41'),
(20, '6', 'denim', '202cb962ac59075b964b07152d234b70', 'Denim', 'Jeans', 'ranasoyab@yopmail.com', 1218479400, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-21 06:48:58'),
(21, '6', 'levis', '202cb962ac59075b964b07152d234b70', 'levis', 'Jeans', 'ranasoyab@yopmail.com', 706127400, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-25 11:20:58'),
(23, '6', 'iqbal', '202cb962ac59075b964b07152d234b70', 'Iqbal', 'Hussain', 'iqbal@blackid.com', 318060000, 2, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-27 10:20:39'),
(25, '6', 'karl', '202cb962ac59075b964b07152d234b70', 'Karl', 'Marks', 'ranasoyab@yopmail.com', 421909200, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-08-28 11:48:19'),
(27, '6', 'Fede', '202cb962ac59075b964b07152d234b70', 'Federico', 'De Medici', 'ranasoyab@yopmail.com', 752565600, 5, 4, 2, NULL, NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'A', 0, '2014-09-04 15:20:52'),
(28, '6', '123', '202cb962ac59075b964b07152d234b70', 'Carmelo2', 'Samperi1', 'ranasoyab@yopmail.com', 635061600, 5, 4, 2, NULL, NULL, 'e920884e47d4e84f51c262df3cd36583.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 28, '2014-09-05 07:18:30'),
(30, '6', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Pietro', 'Rossi', 'ranasoyab@yopmail.com', 1239685200, 5, 4, 2, 'Pietro', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 11:04:54'),
(31, '6', 'eu', '202cb962ac59075b964b07152d234b70', 'Eugenio', 'Di Fraia', 'ranasoyab@yopmail.com', 317973600, 5, 4, 2, 'Cassina de Pecchi', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 11:32:37'),
(33, '6', 'bart', '202cb962ac59075b964b07152d234b70', 'Bart', 'Simpson', 'ranasoyab@yopmail.com', 633938400, 5, 4, 2, 'e', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 33, '2014-09-05 13:00:47'),
(34, '6', 'merge', '202cb962ac59075b964b07152d234b70', 'Merge', 'Simpson', 'ranasoyab@yopmail.com', 633852000, 5, 4, 2, 's', NULL, 'no_avatar.jpg', NULL, NULL, NULL, NULL, NULL, 'P', 0, '2014-09-05 13:17:44');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_recovers`
--
ALTER TABLE `attendance_recovers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clandates`
--
ALTER TABLE `clandates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `eventinvitations`
--
ALTER TABLE `eventinvitations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=805;
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
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `systemsettings`
--
ALTER TABLE `systemsettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
