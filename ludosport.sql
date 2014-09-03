-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2014 at 06:16 PM
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
(2, '3', 'Dexter Laboratory', 'Dexter Laboratory', 'ac', 'Soyab', 'Rana', 'DL', 'Temparory', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 100.00, 30.00, 2, '2014-07-25 11:22:54'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `clan_date`, `student_id`, `attendance`, `user_id`, `timestamp`) VALUES
(1, '2014-09-02', 14, 0, 3, '2014-09-02 06:48:02'),
(2, '2014-09-02', 15, 0, 3, '2014-09-02 10:23:49'),
(3, '2014-09-02', 16, 1, 3, '2014-09-02 10:23:49'),
(4, '2014-09-03', 14, 1, 2, '2014-09-02 06:48:02'),
(5, '2014-09-03', 15, 1, 2, '2014-09-02 06:48:02'),
(6, '2014-09-03', 16, 1, 2, '2014-09-02 06:48:02');

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
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `type`, `en_name`, `it_name`, `image`, `description`, `user_id`, `timestamp`) VALUES
(1, 'D', 'Youngling', 'Youngling', 'b655ec2a7e5da5ec3de879a160e8a33a.png', '<p><br></p>', 1, '2014-08-06 08:29:35'),
(3, 'D', 'Apprentice', 'Apprentice', 'b0e372d346cdf990f9a7202d0253417e.png', '<p><br></p>', 1, '2014-08-06 08:58:13'),
(4, 'D', 'Councillor', 'Councillor', '6830124fdc3129c25f2fadc335fe0db4.png', '<p><br></p>', 1, '2014-08-06 08:58:29'),
(5, 'D', 'Grandmaster', 'Grandmaster', '106030b78b8efb74848eeb4ed7f105b3.png', '<p><br></p>', 1, '2014-08-06 08:58:52'),
(6, 'D', 'Jedi', 'Jedi', '79f348f8bf37b3f0d944cac1e3ac2318.png', '<p><br></p>', 1, '2014-08-06 08:59:16'),
(7, 'D', 'Jenari', 'Jenari', '2aa818dc9b59e542834308bf76bfd936.png', '<p><br></p>', 1, '2014-08-06 08:59:35'),
(8, 'D', 'knight', 'knight', '6a6203576258f94a24c594f31e4501c3.png', '<p><br></p>', 1, '2014-08-06 09:00:03'),
(9, 'D', 'master', 'master', '8fab455b7fe72570ee5b49ac3d6f79f2.png', '<p><br></p>', 1, '2014-08-06 09:00:17'),
(10, 'D', 'padawan', 'padawan', 'f1012e978c89f3b69cede815fbf3e270.png', '<p><br></p>', 1, '2014-08-06 09:00:37'),
(11, 'D', 'sith', 'sith', '59c49128aba73ef3e301308533737872.png', '<p><br></p>', 1, '2014-08-06 09:09:49'),
(12, 'D', 'sithari', 'sithari', '4b9a30b93644c3c1b1959fdd981391a5.png', '<p><br></p>', 1, '2014-08-06 09:10:01'),
(13, 'H', 'custode', 'custode', 'be3385c502f53bbc1aad93e326dcc9da.png', '<p><br></p>', 1, '2014-08-06 09:11:26'),
(14, 'H', 'maestrodombra', 'maestrodombra', 'adfc2f9f81100ef19564aa21084d3dc1.png', '<p><br></p>', 1, '2014-08-06 09:11:41'),
(15, 'Q', 'allievo', 'allievo', '91b0f20c656a20e1da5cac63ee3f1b81.png', '<p><br></p>', 1, '2014-08-06 09:12:01'),
(16, 'Q', 'preside', 'preside', 'edf75efb5754284ac3f96d5ca0cd7da4.png', '<p><br></p>', 1, '2014-08-06 09:12:24'),
(17, 'S', '1G_guardiano', '1G_guardiano', '428b657fae3d1147d769c4c77b8a2c0e.png', '<p><br></p>', 1, '2014-08-06 09:12:54'),
(18, 'S', '1S_sentinella', '1S_sentinella', '4569d92e03563e86570282cd090a54a3.png', '<p><br></p>', 1, '2014-08-06 09:13:13');

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
  `clan_id` int(11) NOT NULL,
  `clan_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `clandates`
--

INSERT INTO `clandates` (`id`, `clan_id`, `clan_date`) VALUES
(1, 1, '2014-07-01'),
(2, 3, '2014-07-01'),
(3, 4, '2014-07-01'),
(4, 1, '2014-07-02'),
(5, 2, '2014-07-02'),
(6, 6, '2014-07-02'),
(7, 2, '2014-07-03'),
(8, 3, '2014-07-03'),
(9, 5, '2014-07-04'),
(10, 3, '2014-07-04'),
(11, 5, '2014-07-05'),
(12, 6, '2014-07-06'),
(13, 6, '2014-07-07'),
(14, 1, '2014-07-08'),
(15, 3, '2014-07-08'),
(16, 4, '2014-07-08'),
(17, 1, '2014-07-09'),
(18, 2, '2014-07-09'),
(19, 6, '2014-07-09'),
(20, 2, '2014-07-10'),
(21, 3, '2014-07-10'),
(22, 5, '2014-07-11'),
(23, 3, '2014-07-11'),
(24, 5, '2014-07-12'),
(25, 6, '2014-07-13'),
(26, 6, '2014-07-14'),
(27, 1, '2014-07-15'),
(28, 3, '2014-07-15'),
(29, 4, '2014-07-15'),
(30, 1, '2014-07-16'),
(31, 2, '2014-07-16'),
(32, 6, '2014-07-16'),
(33, 2, '2014-07-17'),
(34, 3, '2014-07-17'),
(35, 5, '2014-07-18'),
(36, 3, '2014-07-18'),
(37, 5, '2014-07-19'),
(38, 6, '2014-07-20'),
(39, 6, '2014-07-21'),
(40, 1, '2014-07-22'),
(41, 3, '2014-07-22'),
(42, 4, '2014-07-22'),
(43, 1, '2014-07-23'),
(44, 2, '2014-07-23'),
(45, 6, '2014-07-23'),
(46, 2, '2014-07-24'),
(47, 3, '2014-07-24'),
(48, 5, '2014-07-25'),
(49, 3, '2014-07-25'),
(50, 5, '2014-07-26'),
(51, 6, '2014-07-27'),
(52, 6, '2014-07-28'),
(53, 1, '2014-07-29'),
(54, 3, '2014-07-29'),
(55, 4, '2014-07-29'),
(56, 1, '2014-07-30'),
(57, 2, '2014-07-30'),
(58, 6, '2014-07-30'),
(59, 2, '2014-07-31'),
(60, 3, '2014-07-31'),
(61, 5, '2014-08-01'),
(62, 3, '2014-08-01'),
(63, 5, '2014-08-02'),
(64, 6, '2014-08-03'),
(65, 6, '2014-08-04'),
(66, 1, '2014-08-05'),
(67, 3, '2014-08-05'),
(68, 4, '2014-08-05'),
(69, 1, '2014-08-06'),
(70, 2, '2014-08-06'),
(71, 6, '2014-08-06'),
(72, 2, '2014-08-07'),
(73, 3, '2014-08-07'),
(74, 5, '2014-08-08'),
(75, 3, '2014-08-08'),
(76, 5, '2014-08-09'),
(77, 6, '2014-08-10'),
(78, 6, '2014-08-11'),
(79, 1, '2014-08-12'),
(80, 3, '2014-08-12'),
(81, 4, '2014-08-12'),
(82, 1, '2014-08-13'),
(83, 2, '2014-08-13'),
(84, 6, '2014-08-13'),
(85, 2, '2014-08-14'),
(86, 3, '2014-08-14'),
(87, 5, '2014-08-15'),
(88, 3, '2014-08-15'),
(89, 5, '2014-08-16'),
(90, 6, '2014-08-17'),
(91, 6, '2014-08-18'),
(92, 1, '2014-08-19'),
(93, 3, '2014-08-19'),
(94, 4, '2014-08-19'),
(95, 1, '2014-08-20'),
(96, 2, '2014-08-20'),
(97, 6, '2014-08-20'),
(98, 2, '2014-08-21'),
(99, 3, '2014-08-21'),
(100, 5, '2014-08-22'),
(101, 3, '2014-08-22'),
(102, 5, '2014-08-23'),
(103, 6, '2014-08-24'),
(104, 6, '2014-08-25'),
(105, 1, '2014-08-26'),
(106, 3, '2014-08-26'),
(107, 4, '2014-08-26'),
(108, 1, '2014-08-27'),
(109, 2, '2014-08-27'),
(110, 6, '2014-08-27'),
(111, 2, '2014-08-28'),
(112, 3, '2014-08-28'),
(113, 5, '2014-08-29'),
(114, 3, '2014-08-29'),
(115, 5, '2014-08-30'),
(116, 6, '2014-08-31');

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

INSERT INTO `clans` (`id`, `academy_id`, `school_id`, `teacher_id`, `level_id`, `lesson_day`, `lesson_from`, `lesson_to`, `en_class_name`, `it_class_name`, `same_address`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, 1, 1, '4', 1, '2,3', 1406345400, 1406356200, 'Poppey Ep 1', 'Poppey Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:45:00'),
(2, 2, 2, '5', 2, '3,4', 1406349000, 1406356200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:46:59'),
(3, 1, 3, '3', 1, '2,4,5', 1409218500, 1409222100, 'Sailor Ep 2', 'Sailor Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38'),
(4, 2, 4, '5', 1, '2', 1406363400, 1406370600, 'Lab Ep 2', 'Lab Ep 2', 1, 'Baroda', '390016', 5, 4, 2, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:48:27'),
(5, 1, 1, '5', 1, '5,6', 1407292200, 1407306600, 'Poppey Ep 2', 'Poppey Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-08-06 05:25:51'),
(6, 1, 3, '3', 1, '1,3,7', 1406352600, 1406359800, 'Sailor Ep 3', 'Sailor Ep 3', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `message`, `attachment`, `format_info`, `user_id`, `timestamp`) VALUES
(1, 'user_registration', 'User Registration', 'Hello #firstname #lastname<br>Thankyou for Registration.<br><div><br><span style="font-weight: bold;">Basic Details:<br></span>Name : #firstname #lastname<br>Location :  #location<br>Date of Birth : #dob<br><br><span style="font-weight: bold;">Login Details:<br></span>Nickname : #nickname<br>Password :  #password<br></div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#location\r\n#dob\r\n#nickname\r\n#password', 2, '2014-07-26 07:15:22'),
(2, 'forgot_password', 'Forgot Password', 'Hello #firstname #lastname <div><br></div><div>You have request for the reset the password.</div><div>Please click the below link to reset password.<br>\r\n#reset_link</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#reset_link', 1, '2014-07-26 07:15:22'),
(3, 'user_registration_notification', 'New User Registration Notification', 'New User<div>#firstname #lastname is registerd on #date<div><br><span style="font-weight: bold;">Basic Details:<br></span>Name : #firstname #lastname<br>Location :  #location<br>Date of Birth : #dob<br><br><span style="font-weight: bold;">Login Details:<br></span>Nickname : #nickname<br><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#location\r\n#dob\r\n#nickname\r\n#date', 2, '2014-07-26 07:15:22'),
(4, 'trial_lesson_request', 'Request for Trail Lesson', '<div><span style="line-height: 1.42857143;">#firstname #lastname </span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Request for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><div><br></div><div><div>Thanks,</div></div></div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date', 2, '2014-08-25 10:05:22'),
(5, 'trial_lesson_accepted', 'Request for Trail Lesson has been accepted', '<div><span style="line-height: 1.42857143;">#firstname #lastname r</span><span style="line-height: 1.42857143;">equest for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">has been </span>accepted<span style="line-height: 1.42857143;"> by the #teacher_name on #accept_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date\r\n#teacher_name\r\n#accept_date\r\n', 2, '2014-08-25 10:05:22'),
(6, 'trial_lesson_rejected', 'Request for Trail Lesson has been Rejected', '<div><span style="line-height: 1.42857143;">#firstname #lastname r</span><span style="line-height: 1.42857143;">equest for the trial lesson.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">Clan Name : </span><span style="line-height: 1.42857143;">#clan_name</span></div><div><span style="line-height: 1.42857143;">Clan Date : #lesson_date</span></div><div><span style="line-height: 1.42857143;">Date of request : #apply_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div><span style="line-height: 1.42857143;">has been </span>rejected<span style="line-height: 1.42857143;"> by the #teacher_name on #reject_date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#lesson_date\r\n#apply_date\r\n#teacher_name\r\n#reject_date', 2, '2014-08-25 10:05:22'),
(7, 'accepted_as_student', 'Confirm as a student', '<div><span style="line-height: 1.42857143;">#firstname #lastname is now student of &nbsp;</span><span style="line-height: 1.42857143;">#clan_name clan.</span></div><div><span style="line-height: 1.42857143;">Accepted by the #teacher_name on #accept_date</span><br></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#teacher_name\r\n#accept_date', 2, '2014-08-25 10:05:22'),
(8, 'student_absent', 'Student Absent', '<div><span style="line-height: 1.42857143;">#firstname #lastname will remain absent for&nbsp;</span><span style="line-height: 1.42857143;">#clan_name on #date.</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#clan_name\r\n#date', 2, '2014-08-25 10:05:22'),
(9, 'recovery_student', 'Recover an Absent Class', '<div><span style="line-height: 1.42857143;">#firstname #lastname is a student of #student_clan will recover his absence class at #recover_clan on #date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#student_clan\r\n#recover_clan\r\n#date', 2, '2014-08-25 10:05:22'),
(10, 'teacher_recovery_student_for_student', 'Student (Teacher assign Recovery Class)', '<div><span style="line-height: 1.42857143;">Dear #student_name<br><br>The teacher #teacher_name has set the recovery class for you as you were absent.<br>The Clan is #recover_clan on #date<br></span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#student_name\r\n#teacher_name\r\n#recover_clan\r\n#date', 2, '2014-08-25 10:05:22'),
(11, 'teacher_recovery_student_for_teacher', 'Teacher (Teacher assign Recovery Class)', 'Dear #receiver_teacher<br><br>The #sender_teacher has send one studennt name #student_name for the recovery class.<br>The class is #recover_clan on #date<br><br><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#student_name\r\n#receiver_teacher\r\n#sender_teacher\r\n#recover_clan\r\n#date', 2, '2014-08-25 10:05:22'),
(12, 'event_invitation', 'Event Invitation', '<p>Dear #user</p><p>New Event is organised.</p><h4><span>Event Details :</span></h4><h4><hr></h4><p>#event_image</p><hr><p>Name : #event_name</p><p>Date : #from_date to #to_date</p><p>Location : #location</p><p>Event Created &nbsp;:&nbsp;#event_created_by</p><hr><p><br></p><p>The&nbsp;Invitation is send you by&nbsp;#invitation_send_by</p><p><br></p><p></p><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div><p></p>', NULL, '#user\r\n#event_name\r\n#from_date\r\n#to_date\r\n#location\r\n#event_image\r\n#event_created_by\r\n#invitation_send_by', 2, '2014-08-25 10:05:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `eventinvitations`
--

INSERT INTO `eventinvitations` (`id`, `event_id`, `from_id`, `to_id`, `timestamp`) VALUES
(1, 1, 3, 3, '2014-09-01 07:10:58'),
(2, 1, 3, 4, '2014-09-01 07:11:09'),
(3, 1, 3, 5, '2014-09-01 07:11:21'),
(4, 1, 3, 12, '2014-09-01 07:11:31'),
(5, 1, 3, 13, '2014-09-01 07:11:42'),
(6, 1, 3, 14, '2014-09-01 07:11:51'),
(7, 1, 3, 15, '2014-09-01 07:12:02'),
(8, 1, 3, 16, '2014-09-01 07:12:13'),
(9, 1, 3, 17, '2014-09-01 07:12:23'),
(10, 1, 3, 20, '2014-09-01 07:12:32'),
(11, 1, 3, 21, '2014-09-01 07:12:42'),
(12, 1, 2, 2, '2014-09-01 07:16:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `en_level_name`, `it_level_name`, `is_basic`, `under_sixteen`) VALUES
(1, '1st Yedi', '1st Yedi', '1', '0'),
(2, '2st Yedi', '2st Yedi', '1', '0'),
(3, '3rd Yedi', '3rd Yedi', '0', '0'),
(4, '4th Yedi', '4th Yedi', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mailboxes`
--

CREATE TABLE IF NOT EXISTS `mailboxes` (
`id` int(11) NOT NULL,
  `type` enum('L','N','H','U') NOT NULL DEFAULT 'N',
  `to_email` varchar(65) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messageattachments`
--

INSERT INTO `messageattachments` (`id`, `message_id`, `file_name`, `original_name`, `file_type`, `file_size`, `user_id`, `timestamp`) VALUES
(1, 5, 'a4980d04a51383ca387521eab8eeabfd.jpg', 'image.jpg', 'image/jpeg', 61, 2, '2014-09-02 04:19:52');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `initial_id`, `reply_of`, `group_id`, `from_id`, `to_id`, `subject`, `message`, `from_status`, `to_status`, `timestamp`) VALUES
(1, 'single', 1, 0, '0', 3, '8', 'Hello', '<p>[removed]alert&#40;''Hello''&#41;;[removed]</p>', 'S', 'R', '2014-08-30 06:47:26'),
(2, 'single', 1, 1, '0', 8, '3', 'Hello', '<p><a href="http://google.com" target="_blank">Hello</a></p><p>&lt;a href="fsdfsdf"&gt;Man Made&lt;/a&gt;</p>', 'S', 'R', '2014-08-30 06:54:02'),
(3, 'single', 1, 2, '0', 3, '8', 'Hello', '<p><img src="http://upload.wikimedia.org/wikipedia/en/b/bc/Wiki.png" ><br></p>', 'S', 'R', '2014-08-30 06:55:15'),
(4, 'single', 1, 3, '0', 8, '3', 'Hello', '<p>&lt;img src="http://upload.wikimedia.org/wikipedia/en/b/bc/Wiki.png" /&gt;</p>', 'S', 'R', '2014-08-30 07:03:52'),
(5, 'group', 5, 0, 'rector_3_1', 2, '3,5,6', 'Hello ..............', '<p>Hi.....</p>', 'E', 'R', '2014-09-02 04:19:52'),
(6, 'group', 5, 5, 'rector_3_1', 3, '5,6', 'Hello ..............', '<p>Hello ..........................</p>', 'S', 'R', '2014-09-02 04:20:22'),
(7, 'group', 5, 6, 'rector_3_1', 5, '3,6', 'Hello ..............', '<p ><span >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut facilisis \npretium pulvinar. Nam in velit in risus euismod gravida ac sit amet \nquam. Suspendisse placerat blandit diam gravida pretium. Sed tincidunt, \ntellus nec rhoncus varius, dui nisl ornare erat, sed vulputate est massa\n a ex. Donec euismod metus nisi, vitae aliquam sem consectetur \nsollicitudin. Mauris sed sodales ante. Sed porttitor ullamcorper urna. \nUt diam sem, dictum a cursus vitae, ullamcorper ut ipsum. Sed sit amet \nmauris at velit malesuada porttitor. Fusce nec auctor ligula, nec \nvulputate nisi.\n</span></p>', 'S', 'R', '2014-09-02 04:21:58'),
(8, 'group', 5, 7, 'rector_3_1', 3, '5,6', 'Hello ..............', '<p ><span >Suspendisse vitae congue risus.</span><br><span >Suspendisse potenti.</span><br><span >Praesent lacus \n ligula, vulputate vel nunc vitae, imperdiet lobortis purus.</span><br><span >Aenean \n faucibus tempor magna.</span><br><span >Etiam a lorem sed eros luctus mollis.</span><br><span >Mauris \n viverra ac nisi eget efficitur.</span><br><span >Curabitur libero enim, accumsan sed \n posuere pretium, mollis in libero.</span><br><span >Ut egestas eget tellus vitae \n ultricies.</span><br><span >Pellentesque pellentesque finibus arcu at vulputate.</span><br><span >Nunc ut \n velit eget mi mollis maximus.</span><br><span >Nunc et arcu a odio luctus semper vitae \n nec nisi.</span><br><span >Aenean non tempus enim.</span><br><span >Pellentesque facilisis aliquam justo.</span><br><span >Nam tellus velit, maximus vitae lobortis a, rutrum vulputate elit.</span><br><span >Vivamus hendrerit nibh a consectetur sodales.&nbsp;</span><br></p>', 'S', 'R', '2014-09-02 04:24:15'),
(9, 'group', 5, 8, 'rector_3_1', 2, '3,5,6', 'Hello ..............', '<p><span>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</span></p>', 'E', 'R', '2014-09-02 04:43:20'),
(10, 'group', 5, 9, 'rector_3_1', 5, '3,6', 'Hello ..............', '<p><span >هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي \nالقارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة \nالتي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ \nطبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا \nيوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من \nبرامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل \nإفتراضي كنموذج عن النص، وإذا قمت بإدخال "lorem ipsum" في أي محرك بحث \nستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين \nظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، \nوأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.  \n</span></p>', 'S', 'R', '2014-09-02 04:45:41'),
(11, 'group', 5, 10, 'rector_3_1', 2, '5,3,6', 'Hello ..............', '<p><span>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</span></p>', 'E', 'R', '2014-09-02 04:49:27'),
(12, 'single', 12, 0, '0', 2, '5', 'Testing', '<h  >"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>', 'T', 'R', '2014-09-02 04:51:13'),
(13, 'single', 12, 12, '0', 5, '2', 'Testing', '<p>Nice .......<br></p>', 'S', 'R', '2014-09-02 04:59:48'),
(14, 'single', 14, 0, '0', 3, '2', 'New', '<p>Hi ....</p>', 'S', 'R', '2014-09-02 05:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `messagestatus`
--

CREATE TABLE IF NOT EXISTS `messagestatus` (
`id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `status` enum('R','U') NOT NULL DEFAULT 'U',
  `to_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `messagestatus`
--

INSERT INTO `messagestatus` (`id`, `message_id`, `status`, `to_id`) VALUES
(1, 5, 'R', 3),
(2, 5, 'R', 5),
(3, 5, 'U', 6),
(4, 6, 'R', 2),
(5, 6, 'R', 5),
(6, 6, 'U', 6),
(7, 7, 'R', 3),
(8, 7, 'R', 2),
(9, 7, 'U', 6),
(10, 8, 'R', 5),
(11, 8, 'R', 2),
(12, 8, 'U', 6),
(13, 9, 'R', 3),
(14, 9, 'R', 5),
(15, 9, 'U', 6),
(16, 10, 'R', 2),
(17, 10, 'R', 3),
(18, 10, 'U', 6),
(19, 11, 'R', 5),
(20, 11, 'R', 3),
(21, 11, 'U', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `type` enum('A','I','W','N') NOT NULL DEFAULT 'N',
  `notify_type` varchar(225) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(1, 'N', 'event_invitation', 3, 3, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 1, '2014-09-01 07:10:58'),
(2, 'N', 'event_invitation', 3, 4, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:11:09'),
(3, 'N', 'event_invitation', 3, 5, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 1, '2014-09-01 07:11:21'),
(4, 'N', 'event_invitation', 3, 12, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 1, '2014-09-01 07:11:31'),
(5, 'N', 'event_invitation', 3, 13, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:11:42'),
(6, 'N', 'event_invitation', 3, 14, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:11:51'),
(7, 'N', 'event_invitation', 3, 15, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:12:02'),
(8, 'N', 'event_invitation', 3, 16, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:12:13'),
(9, 'N', 'event_invitation', 3, 17, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:12:23'),
(10, 'N', 'event_invitation', 3, 20, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:12:32'),
(11, 'N', 'event_invitation', 3, 21, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:12:"to_academies";a:2:{i:0;s:1:"1";i:1;s:1:"2";}}', 0, '2014-09-01 07:12:42'),
(12, 'N', 'event_invitation', 2, 2, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:14:"to_individuals";a:1:{i:0;s:1:"2";}}', 1, '2014-09-01 07:16:13'),
(13, 'N', 'event_invitation', 2, 2, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:14:"to_individuals";a:1:{i:0;s:1:"2";}}', 1, '2014-09-01 07:31:02'),
(14, 'N', 'event_invitation', 2, 2, 1, 'a:15:{s:2:"id";i:1;s:16:"eventcategory_id";s:1:"3";s:9:"event_for";s:3:"ALL";s:9:"school_id";s:1:"0";s:7:"en_name";s:7:"Seminar";s:7:"it_name";s:7:"Seminar";s:7:"city_id";s:1:"4";s:9:"date_from";s:10:"2014-08-21";s:7:"date_to";s:10:"2014-08-27";s:7:"manager";s:1:"3";s:5:"image";s:36:"d48964571913989890a1905b09fceedf.jpg";s:11:"description";s:11:"<p>ddsD</p>";s:7:"user_id";s:1:"3";s:9:"timestamp";s:19:"2014-08-20 17:40:15";s:14:"to_individuals";a:1:{i:0;s:1:"2";}}', 1, '2014-09-01 08:05:22'),
(15, 'I', 'user_register', 0, 2, 22, 'a:9:{s:9:"firstname";s:4:"Pepe";s:8:"lastname";s:5:"Jeans";s:8:"username";s:4:"pepe";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"31-12-1985";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-03 05:32:35'),
(16, 'I', 'user_register', 0, 3, 22, 'a:9:{s:9:"firstname";s:4:"Pepe";s:8:"lastname";s:5:"Jeans";s:8:"username";s:4:"pepe";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"31-12-1985";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-03 05:32:40'),
(17, 'I', 'user_register', 0, 4, 22, 'a:9:{s:9:"firstname";s:4:"Pepe";s:8:"lastname";s:5:"Jeans";s:8:"username";s:4:"pepe";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"31-12-1985";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-03 05:32:46'),
(18, 'I', 'user_register', 0, 5, 22, 'a:9:{s:9:"firstname";s:4:"Pepe";s:8:"lastname";s:5:"Jeans";s:8:"username";s:4:"pepe";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"31-12-1985";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-09-03 05:32:51');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(2, 'Admin', 'Admin', 1, 'a:16:{s:5:"roles";a:4:{i:0;s:8:"viewRole";i:1;s:7:"addRole";i:2;s:8:"editRole";i:3;s:10:"deleteRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:5:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";i:4;s:19:"sendEventInvitation";}s:7:"batches";a:4:{i:0;s:9:"viewBatch";i:1;s:8:"addBatch";i:2;s:9:"editBatch";i:3;s:11:"deleteBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:14:"systemsettings";a:1:{i:0;s:17:"viewSystemSetting";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"0";i:3;s:1:"1";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:6:{i:2;s:1:"1";i:3;s:1:"1";i:4;s:1:"1";i:5;s:1:"5";i:6;s:1:"6";s:5:"clans";s:1:"0";}}}', '0', 2, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 1, 'a:9:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:1:{i:0;s:9:"viewLevel";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";}s:6:"events";a:5:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";i:4;s:19:"sendEventInvitation";}s:7:"batches";a:1:{i:0;s:9:"viewBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"0";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:6:{i:2;s:1:"0";i:3;s:1:"0";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:13:22'),
(4, 'Dean', 'Decano', 1, 'a:8:{s:5:"roles";a:1:{i:0;s:8:"viewRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:3:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";}s:6:"events";a:2:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"0";i:3;s:1:"0";i:4;s:1:"0";i:5;s:1:"0";i:6;s:1:"0";}s:13:"group_message";a:6:{i:2;s:1:"0";i:3;s:1:"0";i:4;s:1:"0";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 0, 'a:7:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanStudentList";i:2;s:22:"listTrialLessonRequest";i:3;s:24:"changeStatusTrialStudent";}s:6:"events";a:2:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"1";i:6;s:1:"1";}s:13:"group_message";a:6:{i:2;s:1:"1";i:3;s:1:"1";i:4;s:1:"1";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 0, 'a:3:{s:6:"events";a:2:{i:0;s:9:"viewEvent";i:1;s:19:"sendEventInvitation";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:3:{i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:17:08');

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
(1, 'general', 1, 'app_name', 'My Ludosport', 1, '2014-08-07 05:30:31'),
(2, 'general', 2, 'login_logo', '0423827148634df9ea8f50f9942d9b9d.png', 1, '2014-08-07 05:30:31'),
(3, 'general', 3, 'main_logo', 'c9556fdcaba5327d7973f6f86974a69f.png', 1, '2014-08-07 05:31:10'),
(4, 'general', 4, 'timezone', 'UP55', 1, '2014-08-07 05:31:10'),
(5, 'general', 6, 'default_role', '6', 1, '2014-08-07 05:31:10'),
(6, 'general', 5, 'notification_timer', '10000', 1, '2014-08-07 05:31:10'),
(7, 'mail', 1, 'protocol', 'smtp', 1, '2014-08-07 05:31:10'),
(8, 'mail', 2, 'smtp_host', 'ssl://smtp.gmail.com', 1, '2014-08-07 05:31:10'),
(10, 'mail', 4, 'smtp_user', 'soyab@blackidsolutions.com', 1, '2014-08-07 05:31:10'),
(11, 'mail', 5, 'smtp_pass', 'soyabsoyab', 1, '2014-08-07 05:31:10'),
(12, 'general', 8, 'data_table_length', '10,15,20,25,50,75,100', 1, '2014-08-07 05:31:10'),
(13, 'mail', 3, 'smtp_port', '465', 1, '2014-08-07 05:31:10'),
(14, 'general', 9, 'terms_conditions', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque tincidunt porttitor. Aliquam mollis nulla felis, eget maximus ipsum posuere ut. Duis bibendum sagittis metus, sed mattis ex sagittis sed. Vivamus facilisis justo arcu, id bibendum nulla ultrices vitae. Donec vitae ex ultricies, aliquet magna vitae, elementum nunc. Vivamus nulla nisl, ultricies a rhoncus quis, lobortis quis neque. Integer nisi ex, rhoncus vitae vehicula et, scelerisque non dui. Morbi porta, est sit amet egestas scelerisque, leo sem molestie diam, eget sagittis metus risus eget nisi. Aliquam erat volutpat. Vestibulum ac libero tellus. Cras imperdiet nunc eu tincidunt venenatis.</span></p><p><span>Phasellus condimentum, lorem vitae gravida gravida, ipsum felis facilisis massa, eget elementum risus lorem vel est. Fusce augue justo, facilisis non ligula in, feugiat porta sem. Praesent nec augue turpis. Nulla consectetur porta est vel efficitur. Vestibulum condimentum, libero sed tincidunt lobortis, eros lorem efficitur sapien, et interdum dui purus id justo. Vivamus porttitor felis sed purus sodales finibus. Maecenas convallis in ligula a hendrerit. Vivamus dapibus dapibus dictum. Integer iaculis leo purus, at lobortis mi eleifend sed. Maecenas vitae gravida nulla, vel luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam efficitur mauris at tortor maximus, ut placerat elit tempus. Nunc pretium blandit efficitur.</span></p><p><span>Duis convallis lobortis leo quis faucibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum et tempor est, scelerisque consequat nunc. Nam sit amet tempus ipsum. Nunc porta convallis arcu. In vehicula ligula felis, non dapibus mauris congue eget. Donec elit lorem, molestie nec pharetra euismod, sagittis eget tellus. Sed justo dolor, rutrum ut magna posuere, egestas maximus dui. Praesent erat magna, ornare molestie ultrices ut, porta at erat. Sed tempor elit sit amet libero imperdiet cursus.</span></p>', 2, '2014-09-03 06:14:42'),
(15, 'general', 7, 'reset_app_date', '31-12-2014', 2, '2014-09-03 06:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
`id` int(11) NOT NULL,
  `student_master_id` int(11) NOT NULL,
  `clan_id` varchar(11) NOT NULL,
  `first_lesson_date` date NOT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `palce_of_birth` text,
  `zip_code` bigint(11) DEFAULT NULL,
  `tax_code` bigint(11) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `status` enum('A','U','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(5, 14, '1', '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:02'),
(6, 15, '1', '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(7, 16, '1', '2014-08-04', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-04 00:09:27'),
(8, 17, '5', '2014-08-11', 2, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-05 00:09:27'),
(9, 20, '5', '2014-08-28', 2, NULL, NULL, NULL, NULL, 'A', 20, '2014-08-21 01:37:12'),
(10, 13, '5', '2014-08-30', 3, NULL, NULL, NULL, NULL, 'A', 13, '2014-08-25 05:27:01'),
(11, 21, '6', '2014-08-28', 3, NULL, NULL, NULL, NULL, 'A', 21, '2014-08-25 05:52:04'),
(12, 12, '1', '2014-08-04', 2, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-04 00:09:02');

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
  `permission` longtext,
  `avtar` varchar(255) NOT NULL DEFAULT 'no_avatar.jpg',
  `status` enum('A','D','P','U') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `permission`, `avtar`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, '94048c9c2c04baf3b871be491ef8ded2.jpg', 'A', 1, '2014-07-17 01:35:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Admin', 'James', 'soyab@blackidsolutions.com', 316895400, 1, 1, 1, NULL, '666f7848493437bd4c99320ce487a5e2.jpg', 'A', 2, '2014-07-17 01:58:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rector', 'Tom', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, '063fd00a3c30c83404faf36e32b2dada.jpg', 'A', 3, '2014-07-17 01:58:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', 'Jerry', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 0, '2014-07-17 01:58:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', 'Pluto', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, '44999132c325dd575171618f58a0712a.jpg', 'A', 5, '2014-07-21 04:41:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', 'Goopy', 'ranasoyab@yopmail.com', 1277922600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-07-17 01:58:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 04:41:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 04:41:41'),
(12, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, 'c05b3802dd788813231e79ce67a5513d.jpg', 'P', 3, '2014-07-31 05:15:54'),
(13, '6', 'martin', '202cb962ac59075b964b07152d234b70', 'Martin', 'Lusi', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, '0b1b838debca3f07a19dfb93846a38a2.jpg', 'A', 13, '2014-07-31 23:50:27'),
(14, '6', 'student_1', '202cb962ac59075b964b07152d234b70', 'Melba', 'Stevens', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 00:07:32'),
(15, '6', 'student_2', '202cb962ac59075b964b07152d234b70', 'Tolunay', 'Ankone', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 00:07:19'),
(16, '6', 'student_3', '202cb962ac59075b964b07152d234b70', 'Ubaldo', 'Genovese', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 00:07:56'),
(17, '6', 'student_4', '202cb962ac59075b964b07152d234b70', 'Berto', 'Milani', 'ranasoyab@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 00:08:37'),
(19, '5', 'teacher_4', '202cb962ac59075b964b07152d234b70', 'Teacher', '4', 'ranasoyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 04:41:41'),
(20, '6', 'denim', '202cb962ac59075b964b07152d234b70', 'Denim', 'Jeans', 'ranasoyab@yopmail.com', 1218479400, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 0, '2014-08-21 01:18:58'),
(21, '6', 'levis', '202cb962ac59075b964b07152d234b70', 'levis', 'Jeans', 'ranasoyab@yopmail.com', 706127400, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 0, '2014-08-25 05:50:58'),
(22, '6', 'pepe', '202cb962ac59075b964b07152d234b70', 'Pepe', 'Jeans', 'ranasoyab@yopmail.com', 504815400, 1, 1, 1, NULL, 'no_avatar.jpg', 'P', 0, '2014-09-03 05:32:30');

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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sys_key` (`sys_key`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `attendance_recovers`
--
ALTER TABLE `attendance_recovers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clandates`
--
ALTER TABLE `clandates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `eventinvitations`
--
ALTER TABLE `eventinvitations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mailboxes`
--
ALTER TABLE `mailboxes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messageattachments`
--
ALTER TABLE `messageattachments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `messagestatus`
--
ALTER TABLE `messagestatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
