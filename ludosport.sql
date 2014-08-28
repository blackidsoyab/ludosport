-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2014 at 06:35 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `clan_date`, `student_id`, `attendance`, `user_id`, `timestamp`) VALUES
(1, '2014-08-28', 6, 1, 3, '2014-08-28 02:54:06');

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
  `user_id` int(11) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(1, 1, 1, '5', 1, '2,3', 1406345400, 1406356200, 'Poppey Ep 1', 'Poppey Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:45:00'),
(2, 2, 2, '7', 2, '3,4', 1406349000, 1406356200, 'Dexter Ep 1', 'Dexter Ep 1', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-26 09:46:59'),
(3, 1, 3, '3', 1, '2,4,5', 1409218500, 1409222100, 'Sailor Ep 2', 'Sailor Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38'),
(4, 2, 4, '8', 1, '2', 1406363400, 1406370600, 'Lab Ep 2', 'Lab Ep 2', 1, 'Baroda', '390016', 5, 4, 2, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:48:27'),
(5, 1, 1, '7', 1, '5,6', 1407292200, 1407306600, 'Poppey Ep 2', 'Poppey Ep 2', 1, 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-08-06 05:25:51'),
(6, 1, 3, '3', 1, '2,4,5', 1406352600, 1406359800, 'Sailor Ep 3', 'Sailor Ep 3', 1, 'Baroda', '390016', 2, 1, 1, '91987654321', '91987654321', 'soyab@yopmail.com', 2, '2014-07-26 09:47:38');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, 'recovery_student', 'Recover an Absent Class', '<div><span style="line-height: 1.42857143;">#firstname #lastname is a student of #student_clan will recover his absence class at #recover_clan on #date</span></div><div><span style="line-height: 1.42857143;"><br></span></div><div>Thanks.</div><div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#student_clan\r\n#recover_clan\r\n#date', 2, '2014-08-25 10:05:22');

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
  `image` varchar(255) NOT NULL DEFAULT 'no-cover.jpg',
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventcategory_id`, `event_for`, `school_id`, `en_name`, `it_name`, `city_id`, `date_from`, `date_to`, `manager`, `image`, `description`, `user_id`, `timestamp`) VALUES
(1, 3, 'ALL', '0', 'Seminar', 'Seminar', 4, '2014-08-21', '2014-08-27', '3', 'd48964571913989890a1905b09fceedf.jpg', '<p>ddsD</p>', 3, '2014-08-20 12:10:15'),
(2, 5, 'ALL', '0', 'Gathering', 'Gathering', 5, '2014-08-21', '2014-08-28', '2', '27be330570b56767a42ad869b5ed705a.jpeg', '<p style="color: rgb(51, 51, 51); font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 32.040000915527344px;">The field events (separated by a space) which are fired when the live validating mode is enabled.</p><p style="color: rgb(51, 51, 51); font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 32.040000915527344px;">For example, <code style="font-family: Monaco, Consolas, ''Courier New'', monospace; font-size: 14px; padding: 0px; line-height: 1.6; background: transparent;">trigger="focus blur"</code> means that the field will be validated when user focus on or leave the focus off the field.</p><h4 id="field-trigger-example" style="font-family: Merriweather, serif; color: rgb(51, 51, 51); padding: 20px 0px 10px;">Example</h4><p style="color: rgb(51, 51, 51); font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 32.040000915527344px;">In the following form, the <i>Title</i> field will be validated while user type any character (<code style="font-family: Monaco, Consolas, ''Courier New'', monospace; font-size: 14px; padding: 0px; line-height: 1.6; background: transparent;">trigger="keyup"</code>). The<i>Summary</i> field will be validated when user lose the focus (<code style="font-family: Monaco, Consolas, ''Courier New'', monospace; font-size: 14px; padding: 0px; line-height: 1.6; background: transparent;">trigger="blur"</code>).</p>', 2, '2014-08-21 05:58:06');

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
  `notify_type` varchar(225) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `data` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(1, 'I', 'user_register', 0, 2, 6, 'a:9:{s:9:"firstname";s:6:"Killer";s:8:"lastname";s:5:"Jeans";s:8:"username";s:6:"killer";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"30-08-1989";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 1, '2014-08-28 06:14:47'),
(2, 'I', 'user_register', 0, 3, 6, 'a:9:{s:9:"firstname";s:6:"Killer";s:8:"lastname";s:5:"Jeans";s:8:"username";s:6:"killer";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"30-08-1989";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 06:14:52'),
(3, 'I', 'user_register', 0, 4, 6, 'a:9:{s:9:"firstname";s:6:"Killer";s:8:"lastname";s:5:"Jeans";s:8:"username";s:6:"killer";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"30-08-1989";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 06:14:57'),
(4, 'I', 'user_register', 0, 5, 6, 'a:9:{s:9:"firstname";s:6:"Killer";s:8:"lastname";s:5:"Jeans";s:8:"username";s:6:"killer";s:7:"city_id";s:1:"1";s:13:"date_of_birth";s:10:"30-08-1989";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 06:15:01'),
(6, 'N', 'apply_trial_lesson', 6, 2, 6, 'a:3:{s:10:"student_id";s:1:"6";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-09-03";}', 1, '2014-08-28 06:20:13'),
(7, 'N', 'apply_trial_lesson', 6, 3, 6, 'a:3:{s:10:"student_id";s:1:"6";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-09-03";}', 1, '2014-08-28 06:20:18'),
(8, 'N', 'apply_trial_lesson', 6, 5, 6, 'a:3:{s:10:"student_id";s:1:"6";s:7:"clan_id";s:1:"1";s:4:"date";s:10:"2014-09-03";}', 0, '2014-08-28 06:20:23'),
(9, 'N', 'apply_trial_lesson', 6, 2, 6, 'a:3:{s:10:"student_id";s:1:"6";s:7:"clan_id";s:1:"2";s:4:"date";s:10:"2014-09-04";}', 0, '2014-09-03 06:37:46'),
(10, 'N', 'apply_trial_lesson', 6, 3, 6, 'a:3:{s:10:"student_id";s:1:"6";s:7:"clan_id";s:1:"2";s:4:"date";s:10:"2014-09-04";}', 1, '2014-09-03 06:37:51'),
(11, 'N', 'trial_lesson_approved', 3, 6, 6, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"2";s:4:"date";s:10:"2014-09-04";s:10:"student_id";s:1:"6";}', 1, '2014-09-04 02:54:06'),
(12, 'N', 'trial_lesson_approved', 3, 2, 0, 'a:4:{s:6:"status";s:1:"A";s:7:"clan_id";s:1:"2";s:4:"date";s:10:"2014-09-04";s:10:"student_id";s:1:"6";}', 0, '2014-09-04 02:54:06'),
(15, 'I', 'user_register', 0, 2, 7, 'a:4:{s:14:"palce_of_birth";s:1:"2";s:8:"zip_code";s:6:"390016";s:8:"tax_code";s:6:"963852";s:11:"blood_group";s:4:"B-ve";}', 0, '2014-08-28 10:48:03'),
(16, 'I', 'user_register', 0, 3, 7, 'a:4:{s:14:"palce_of_birth";s:1:"2";s:8:"zip_code";s:6:"390016";s:8:"tax_code";s:6:"963852";s:11:"blood_group";s:4:"B-ve";}', 0, '2014-08-28 10:48:09'),
(17, 'I', 'user_register', 0, 4, 7, 'a:4:{s:14:"palce_of_birth";s:1:"2";s:8:"zip_code";s:6:"390016";s:8:"tax_code";s:6:"963852";s:11:"blood_group";s:4:"B-ve";}', 0, '2014-08-28 10:48:15'),
(18, 'I', 'user_register', 0, 5, 7, 'a:4:{s:14:"palce_of_birth";s:1:"2";s:8:"zip_code";s:6:"390016";s:8:"tax_code";s:6:"963852";s:11:"blood_group";s:4:"B-ve";}', 0, '2014-08-28 10:48:20'),
(19, 'I', 'user_register', 0, 7, 7, 'a:4:{s:14:"palce_of_birth";s:1:"2";s:8:"zip_code";s:6:"390016";s:8:"tax_code";s:6:"963852";s:11:"blood_group";s:4:"B-ve";}', 0, '2014-08-28 10:48:26'),
(20, 'I', 'user_register', 0, 2, 8, 'a:9:{s:9:"firstname";s:5:"Denim";s:8:"lastname";s:5:"Jeans";s:8:"username";s:5:"denim";s:7:"city_id";s:1:"2";s:13:"date_of_birth";s:10:"17-02-1972";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 11:34:26'),
(21, 'I', 'user_register', 0, 3, 8, 'a:9:{s:9:"firstname";s:5:"Denim";s:8:"lastname";s:5:"Jeans";s:8:"username";s:5:"denim";s:7:"city_id";s:1:"2";s:13:"date_of_birth";s:10:"17-02-1972";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 11:34:30'),
(22, 'I', 'user_register', 0, 4, 8, 'a:9:{s:9:"firstname";s:5:"Denim";s:8:"lastname";s:5:"Jeans";s:8:"username";s:5:"denim";s:7:"city_id";s:1:"2";s:13:"date_of_birth";s:10:"17-02-1972";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 11:34:35'),
(23, 'I', 'user_register', 0, 5, 8, 'a:9:{s:9:"firstname";s:5:"Denim";s:8:"lastname";s:5:"Jeans";s:8:"username";s:5:"denim";s:7:"city_id";s:1:"2";s:13:"date_of_birth";s:10:"17-02-1972";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 11:34:42'),
(24, 'I', 'user_register', 0, 8, 8, 'a:9:{s:9:"firstname";s:5:"Denim";s:8:"lastname";s:5:"Jeans";s:8:"username";s:5:"denim";s:7:"city_id";s:1:"2";s:13:"date_of_birth";s:10:"17-02-1972";s:5:"email";s:21:"ranasoyab@yopmail.com";s:8:"password";s:3:"123";s:9:"cpassword";s:3:"123";s:16:"terms_conditions";s:2:"on";}', 0, '2014-08-28 11:34:47');

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
(2, 'Admin', 'Admin', 1, 'a:16:{s:5:"roles";a:4:{i:0;s:8:"viewRole";i:1;s:7:"addRole";i:2;s:8:"editRole";i:3;s:10:"deleteRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:4:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";}s:7:"batches";a:4:{i:0;s:9:"viewBatch";i:1;s:8:"addBatch";i:2;s:9:"editBatch";i:3;s:11:"deleteBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:14:"systemsettings";a:1:{i:0;s:17:"viewSystemSetting";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"0";i:3;s:1:"1";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:4:{i:2;s:1:"0";i:3;s:1:"1";i:4;s:1:"1";s:5:"clans";s:1:"0";}}}', '0', 2, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 1, 'a:9:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:1:{i:0;s:9:"viewLevel";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";}s:6:"events";a:4:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";}s:7:"batches";a:1:{i:0;s:9:"viewBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"0";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 2, '2014-07-17 10:13:22'),
(4, 'Dean', 'Decano', 1, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:3:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"1";}s:13:"group_message";a:6:{i:2;s:1:"1";i:3;s:1:"1";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 0, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanStudentList";i:2;s:22:"listTrialLessonRequest";i:3;s:24:"changeStatusTrialStudent";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"1";i:6;s:1:"1";}s:13:"group_message";a:6:{i:2;s:1:"1";i:3;s:1:"1";i:4;s:1:"1";i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 2, '2014-07-17 10:16:50'),
(6, 'Pupil', 'Pupil', 0, 'a:3:{s:6:"events";a:1:{i:0;s:9:"viewEvent";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"2";i:5;s:1:"2";i:6;s:1:"2";}s:13:"group_message";a:3:{i:5;s:1:"2";i:6;s:1:"2";s:5:"clans";s:1:"2";}}}', '0', 1, '2014-07-17 10:17:08');

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
(8, 'mail', 'smtp_host', 'ssl://smtp.gmail.com', 1, '2014-08-07 05:31:10'),
(10, 'mail', 'smtp_user', 'soyab@blackidsolutions.com', 1, '2014-08-07 05:31:10'),
(11, 'mail', 'smtp_pass', 'soyabsoyab', 1, '2014-08-07 05:31:10'),
(12, 'general', 'data_table_length', '10,15,20,25,50,75,100', 1, '2014-08-07 05:31:10'),
(13, 'mail', 'smtp_port', '465', 1, '2014-08-07 05:31:10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `clan_id`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(1, 6, '3', '2014-08-28', 3, 'Suspendisse ipsum risus, facilisis et nisi nec', 390016, 963852, 'B-ve', 'A', 6, '2014-08-28 01:42:35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `permission`, `avtar`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, '94048c9c2c04baf3b871be491ef8ded2.jpg', 'A', 1, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Society LudoSport', 'Masters', 'ranasoyab@yopmail.com', 316895400, 1, 1, 1, NULL, '666f7848493437bd4c99320ce487a5e2.jpg', 'A', 2, '2014-07-17 07:28:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'James', 'Rector', 'ranasoyab@yopmail.com', 327004200, 1, 1, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 05:59:32'),
(4, '5', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Daniel', 'Teacher', 'ranasoyab@yopmail.com', 51906600, 3, 2, 1, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 06:00:28'),
(5, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Jhon', 'Dean', 'ranasoyab@yopmail.com', 571257000, 5, 4, 2, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 06:01:16'),
(6, '6', 'killer', '202cb962ac59075b964b07152d234b70', 'Killer', 'Jeans', 'ranasoyab@yopmail.com', 620418600, 1, 1, 1, NULL, 'c05b3802dd788813231e79ce67a5513d.jpg', 'A', 6, '2014-08-28 06:14:42'),
(8, '6', 'denim', '202cb962ac59075b964b07152d234b70', 'Denim', 'Jeans', 'ranasoyab@yopmail.com', 67113000, 2, 1, 1, NULL, 'no_avatar.jpg', 'P', 0, '2014-08-28 11:34:20');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
