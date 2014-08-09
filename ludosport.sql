-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2014 at 06:13 PM
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
(2, '3,6', 'Dexter Laboratory', 'Dexter Laboratory', 'ac', 'Soyab', 'Rana', 'PSM', 'Temparory', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 100.00, 10.00, 2, '2014-07-25 11:22:54'),
(3, '5', 'ZZZ', 'ZZZ', 'ac', 'ZZ', 'AA', 'AA', 'QQ', 'QQ', '123456', 4, 2, 1, '1234567890', '91987654321', 'soyab@yopmail.com', 0.00, 0.00, 2, '2014-07-31 04:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
`id` int(11) NOT NULL,
  `clan_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `clan_date`, `student_id`, `user_id`, `timestamp`) VALUES
(2, '2014-08-10', 14, 2, '2014-08-04 05:42:22'),
(3, '2014-08-10', 15, 2, '2014-08-04 05:42:22'),
(4, '2014-08-11', 16, 2, '2014-08-04 05:42:22'),
(5, '2014-08-11', 17, 2, '2014-08-04 05:42:22'),
(6, '2014-08-11', 18, 2, '2014-08-04 05:42:22'),
(9, '2014-08-11', 13, 2, '2014-08-05 07:28:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clans`
--

INSERT INTO `clans` (`id`, `academy_id`, `school_id`, `teacher_id`, `level_id`, `lesson_day`, `lesson_from`, `lesson_to`, `en_class_name`, `it_class_name`, `same_address`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, 1, 1, '5', 1, '1,2', 1406345400, 1406356200, 'Poppey Ep 1', 'Poppey Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:45:00'),
(2, 2, 2, '7', 2, '2,3', 1406349000, 1406356200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:46:59'),
(3, 1, 3, '3', 1, '1,3,4', 1406352600, 1406359800, 'Sailor Ep 2', 'Sailor Ep 2', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38'),
(4, 2, 4, '8', 1, '1', 1406363400, 1406370600, 'Lab Ep 2', 'Lab Ep 2', 1, 'Baroda', '390016', 5, 4, 2, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:48:27'),
(5, 1, 1, '7', 1, '4,5', 1407292200, 1407306600, 'Poppey Ep 2', 'Poppey Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-08-06 05:25:51');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `message`, `attachment`, `format_info`, `user_id`, `timestamp`) VALUES
(1, 'user_registration', 'User Registration', 'Hello #firstname #lastname<div><br></div><div>Thanks for Registration.</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, '#firstname\r\n#lastname', 1, '2014-07-26 07:15:22'),
(2, 'forgot_password', 'Forgot Password', 'Hello #firstname #lastname <div><br></div><div>You have request for the reset the password.</div><div>Please click the below link to reset password.<br>\n#reset_link</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>', NULL, '#firstname\r\n#lastname\r\n#reset_link', 1, '2014-07-26 07:15:22'),
(3, 'user_registration_notification', 'New User Registration Notification', 'New User<div><br></div><div>#firstname #lastname is registerd on #date<div><br></div><div><div>Thanks,</div><div>MyLudosport Team</div></div></div>', NULL, '#firstname\r\n#lastname\r\n#date', 1, '2014-07-26 07:15:22');

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
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventcategory_id`, `event_for`, `school_id`, `en_name`, `it_name`, `city_id`, `date_from`, `date_to`, `manager`, `description`, `user_id`, `timestamp`) VALUES
(1, 5, 'AC', '1,3', 'Temp', 'Temp', 2, '2014-08-13', '2014-08-20', '4', '<p>dasdas</p>', 1, '2014-08-05 12:50:19'),
(2, 3, 'SC', '2', 'adadas', 'adadas', 4, '2014-08-18', '2014-08-21', '8,12', '<p><br></p>', 1, '2014-08-05 12:51:06'),
(3, 4, 'ALL', '0', 'Addas', 'Addas', 2, '2014-08-16', '2014-08-19', '6', '<p>asa</p>', 1, '2014-08-05 12:51:42');

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
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `type` enum('single','group') NOT NULL DEFAULT 'single',
  `reply_of` int(11) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('R','U','D','S','T') NOT NULL DEFAULT 'D',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `reply_of`, `from_id`, `to_id`, `subject`, `message`, `status`, `timestamp`) VALUES
(1, 'single', 0, 1, 4, 'Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing ', '<p>Hello .......</p>', 'U', '2014-08-09 06:19:09'),
(2, 'single', 0, 1, 7, 'Setting', '<p>setting dear .......</p>', 'U', '2014-08-09 06:19:09'),
(3, 'single', 0, 1, 8, 'Hello', '<p>Hello dear are you .......</p>', 'U', '2014-08-09 06:19:09'),
(4, 'single', 0, 1, 3, 'User Registration', '<p>fadfadfasdfadfasdf</p>', 'D', '2014-08-09 09:15:40'),
(5, 'single', 0, 1, 2, 'Hi', '<p><span></span>How are you .......</p>', 'U', '2014-08-09 09:23:27'),
(7, 'single', 5, 2, 1, 'Reply of : Hi', '<p>I am Fine .....</p>', 'R', '2014-08-09 10:41:14'),
(8, 'single', 7, 1, 2, 'Reply of : Reply of : Hi', '<p>Shu bhai dehka to nathi .....</p>', 'U', '2014-08-09 11:33:22'),
(10, 'single', 5, 2, 1, 'Reply of : Hi', '<p>Hello</p>', 'R', '2014-08-09 12:14:57'),
(11, 'group', 0, 2, 3, 'Attention', '<p>You all have to pay 10,000 $ fine .</p><p>No arguments.</p>', 'U', '2014-08-09 12:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `type` enum('A','I','W','N') NOT NULL DEFAULT 'N',
  `notify_type` enum('rector_assign_academy','dean_assign_school','teacher_assign_class','user_register','apply_trial_lesson','trial_lesson_unapproved','trial_lesson_approved','accept_as_student') NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(1, 'N', 'apply_trial_lesson', 12, 2, 12, 'a:3:{s:10:"student_id";s:2:"12";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 1, '2014-08-05 06:44:27'),
(2, 'N', 'apply_trial_lesson', 12, 3, 12, 'a:3:{s:10:"student_id";s:2:"12";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 1, '2014-08-05 06:44:27'),
(3, 'N', 'apply_trial_lesson', 12, 5, 12, 'a:3:{s:10:"student_id";s:2:"12";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 0, '2014-08-05 06:44:27'),
(4, 'N', 'trial_lesson_approved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 06:54:44'),
(5, 'N', 'trial_lesson_approved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 06:54:44'),
(6, 'N', 'trial_lesson_approved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 06:54:44'),
(14, 'N', 'apply_trial_lesson', 13, 2, 13, 'a:3:{s:10:"student_id";s:2:"13";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 1, '2014-08-05 07:19:17'),
(15, 'N', 'apply_trial_lesson', 13, 3, 13, 'a:3:{s:10:"student_id";s:2:"13";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 1, '2014-08-05 07:19:17'),
(16, 'N', 'apply_trial_lesson', 13, 5, 13, 'a:3:{s:10:"student_id";s:2:"13";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";}', 0, '2014-08-05 07:19:17'),
(17, 'N', 'trial_lesson_approved', 2, 13, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-05 07:28:08'),
(18, 'N', 'trial_lesson_approved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 1, '2014-08-05 07:28:08'),
(19, 'N', 'trial_lesson_approved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-05 07:28:08'),
(20, 'N', 'trial_lesson_unapproved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:28:16'),
(21, 'N', 'trial_lesson_unapproved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:28:17'),
(22, 'N', 'trial_lesson_unapproved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:28:17'),
(23, 'N', 'trial_lesson_approved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:29:34'),
(24, 'N', 'trial_lesson_approved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:29:34'),
(25, 'N', 'trial_lesson_approved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:29:34'),
(26, 'N', 'trial_lesson_unapproved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:29:47'),
(27, 'N', 'trial_lesson_unapproved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:29:48'),
(28, 'N', 'trial_lesson_unapproved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:29:48'),
(29, 'N', 'trial_lesson_approved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:30:26'),
(30, 'N', 'trial_lesson_approved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:30:26'),
(31, 'N', 'trial_lesson_approved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:30:26'),
(32, 'N', 'trial_lesson_unapproved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:30:34'),
(33, 'N', 'trial_lesson_unapproved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:30:34'),
(34, 'N', 'trial_lesson_unapproved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:30:34'),
(35, 'N', 'trial_lesson_approved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:31:07'),
(36, 'N', 'trial_lesson_approved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:31:07'),
(37, 'N', 'trial_lesson_approved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:31:07'),
(38, 'N', 'trial_lesson_unapproved', 2, 12, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:31:18'),
(39, 'N', 'trial_lesson_unapproved', 2, 3, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 1, '2014-08-05 08:31:18'),
(40, 'N', 'trial_lesson_unapproved', 2, 5, 0, 'a:4:{s:6:"status";s:1:"U";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"12";}', 0, '2014-08-05 08:31:18'),
(41, 'N', 'teacher_assign_class', 2, 7, 5, NULL, 0, '2014-08-06 05:25:51'),
(42, 'N', 'accept_as_student', 2, 13, 13, 'a:4:{s:6:"status";s:2:"AS";s:7:"clan_id";s:1:"3";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-07 05:02:31'),
(43, 'N', 'accept_as_student', 2, 3, 0, 'a:4:{s:6:"status";s:2:"AS";s:7:"clan_id";s:1:"3";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-07 05:02:32'),
(44, 'N', 'accept_as_student', 2, 4, 0, 'a:4:{s:6:"status";s:2:"AS";s:7:"clan_id";s:1:"3";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-07 05:02:32'),
(45, 'N', 'accept_as_student', 2, 5, 0, 'a:4:{s:6:"status";s:2:"AS";s:7:"clan_id";s:1:"3";s:4:"date";s:10:"2014-08-11";s:10:"student_id";s:2:"13";}', 0, '2014-08-07 05:02:32');

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
  `permission` longtext,
  `is_delete` enum('1','0') NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `en_role_name`, `it_role_name`, `permission`, `is_delete`, `user_id`, `timestamp`) VALUES
(1, 'Super Admin', 'Super Amministratore', NULL, '0', 0, '2014-07-17 07:04:55'),
(2, 'Admin', 'Admin', 'a:16:{s:5:"roles";a:4:{i:0;s:8:"viewRole";i:1;s:7:"addRole";i:2;s:8:"editRole";i:3;s:10:"deleteRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:4:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";}s:7:"batches";a:4:{i:0;s:9:"viewBatch";i:1;s:8:"addBatch";i:2;s:9:"editBatch";i:3;s:11:"deleteBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:14:"systemsettings";a:1:{i:0;s:17:"viewSystemSetting";}s:8:"messages";a:5:{i:0;s:14:"composeMessage";i:1;s:11:"viewMessage";i:2;s:11:"sentMessage";i:3;s:12:"draftMessage";i:4;s:12:"trashMessage";}}', '0', 2, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}}', '0', 2, '2014-07-17 10:13:22'),
(4, 'Dean', 'Decano', 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:3:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:5:{i:0;s:14:"composeMessage";i:1;s:11:"viewMessage";i:2;s:11:"sendMessage";i:3;s:12:"draftMessage";i:4;s:12:"trashMessage";}}', '0', 1, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 'a:4:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}}', '0', 2, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 'a:4:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}}', '0', 2, '2014-07-17 10:17:08');

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
(5, 3, '4', 'ZZZ 1', 'ZZZ 1', 'Baroda', 390016, 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-31 08:50:42');

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
  `sys_key` varchar(255) NOT NULL,
  `sys_value` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `systemsettings`
--

INSERT INTO `systemsettings` (`id`, `type`, `sys_key`, `sys_value`, `user_id`, `timestamp`) VALUES
(1, 'general', 'app_name', 'My Ludosport', 1, '2014-08-07 05:30:31'),
(2, 'general', 'login_logo', '0423827148634df9ea8f50f9942d9b9d.png', 1, '2014-08-07 05:30:31'),
(3, 'general', 'main_logo', 'c9556fdcaba5327d7973f6f86974a69f.png', 1, '2014-08-07 05:31:10'),
(4, 'general', 'timezone', 'UP55', 1, '2014-08-07 05:31:10'),
(5, 'general', 'default_role', '6', 1, '2014-08-07 05:31:10'),
(6, 'general', 'notification_timer', '10000', 1, '2014-08-07 05:31:10'),
(7, 'mail', 'protocol', 'smtp', 1, '2014-08-07 05:31:10'),
(8, 'mail', 'smtp_host', 'mail.myludosport.net', 1, '2014-08-07 05:31:10'),
(10, 'mail', 'smtp_user', 'no_reply@myludosport.net', 1, '2014-08-07 05:31:10'),
(11, 'mail', 'smtp_pass', 'ymy5433', 1, '2014-08-07 05:31:10'),
(12, 'general', 'data_table_length', '5,10,15,20,25,50,75,100', 1, '2014-08-07 05:31:10'),
(13, 'mail', 'smtp_port', '0', 1, '2014-08-07 05:31:10');

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
  `status` enum('A','U','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `first_lesson_date`, `approved_by`, `status`, `user_id`, `timestamp`) VALUES
(5, 14, '5', '0000-00-00', 0, 'A', 2, '2014-08-04 05:39:02'),
(6, 15, '4', '0000-00-00', 0, 'A', 2, '2014-08-04 05:39:27'),
(7, 16, '2', '0000-00-00', 0, 'A', 2, '2014-08-04 05:39:27'),
(8, 17, '1', '0000-00-00', 0, 'A', 2, '2014-08-04 05:39:27'),
(9, 18, '2', '0000-00-00', 0, 'A', 2, '2014-08-04 05:39:27'),
(12, 12, '1', '2014-08-11', 2, 'U', 12, '2014-08-05 06:44:27'),
(17, 13, '3', '2014-08-11', 2, 'A', 13, '2014-08-05 07:19:17');

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
  `status` enum('A','D','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `permission`, `avtar`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'soyab1@yopmail.com', 316895400, 1, 1, 1, NULL, '70b268a25d9aca86f92dc81257421490.jpg', 'A', 1, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Admin', 'James', 'soyab@yopmail.com', 316895400, 1, 1, 1, NULL, '7c34d6436df4c3aa27caf6bbe1e5488b.jpg', 'A', 2, '2014-07-17 07:28:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rector', '1', 'soyab@yopmail.com', 316895400, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-07-17 07:28:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', '1', 'soyab@yopmail.com', 1277922600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 0, '2014-07-17 07:28:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', '1', 'soyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 10:11:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', '2', 'soyab@yopmail.com', 1277922600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-07-17 07:28:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'soyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 10:11:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'soyab@yopmail.com', 653682600, 2, 1, 1, NULL, 'no_avatar.jpg', 'A', 1, '2014-07-21 10:11:41'),
(12, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'killer@yopmail.com', 653682600, 1, 1, 1, NULL, '85557d26f7611514c2e515f78f783e28.jpg', 'P', 3, '2014-07-31 10:45:54'),
(13, '6', 'martin', '202cb962ac59075b964b07152d234b70', 'Martin', 'Lusi', 'martin@yopmail.com', 653682600, 3, 2, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-01 05:20:27'),
(14, '6', 'student_1', '202cb962ac59075b964b07152d234b70', 'Student', 'First', 's1@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 05:37:32'),
(15, '6', 'student_2', '202cb962ac59075b964b07152d234b70', 'Student', 'Second', 's2@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 05:37:19'),
(16, '6', 'student_3', '202cb962ac59075b964b07152d234b70', 'Student', 'Third', 's3@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 05:37:56'),
(17, '6', 'student_4', '202cb962ac59075b964b07152d234b70', 'Student', 'Fourth', 's4@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 05:38:37'),
(18, '6', 'student_5', '202cb962ac59075b964b07152d234b70', 'Student', 'Fifth', 's5@yopmail.com', 653682600, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 3, '2014-08-04 05:38:37');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
