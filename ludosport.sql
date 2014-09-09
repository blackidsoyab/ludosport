-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2014 at 12:30 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `academies`
--

INSERT INTO `academies` (`id`, `rector_id`, `en_academy_name`, `it_academy_name`, `type`, `contact_firstname`, `contact_lastname`, `association_fullname`, `role_referent`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `fee1`, `fee2`, `user_id`, `timestamp`) VALUES
(4, '23', 'LudoSport Russia', 'LudoSport Russia', 'ac', 'Maksim', 'Varezhkin', 'LudoSport Russia- Lightsaber Combat Academy', 'President', 'Ulitsa Varvarka 8', '90467', 9, 9, 5, '1234567890', '1234567890', 'russia@ludosport.net', 400.00, 20.00, 2, '2014-08-03 08:15:29'),
(5, '22', 'LudoSport UK', 'LudoSport UK', 'ac', 'Jordan', 'Court', 'LudoSport UK - Lightsaber Combat Academy', 'President', '119 Tennant Rd.', '54321', 10, 11, 6, '1234567890', '1234567890', 'england@ludosport.net', 400.00, 20.00, 2, '2014-08-03 08:22:00'),
(6, '46', 'Main LudoSport Academy', 'Main LudoSport Academy', 'ac', 'Simone', 'Spreafico', 'LudoSport Combat Academy ASD', 'Presidente', 'Via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '3929341589', '3482606944', 'info@ludosport.net', 400.00, 20.00, 2, '2014-08-04 07:44:24'),
(7, '21', 'LudoSport Irleand', 'LudoSport Irlanda', 'ac', 'Jim', 'Tuohy', 'LudoSport Ireland - Lightsaber Combat Academy', '', '1', '123456', 8, 8, 3, '12345689', '123', 'ireland@ludosport.net', 400.00, 20.00, 2, '2014-08-04 07:45:33'),
(8, '58', 'LudoSport Ravenna', 'LudoSport Ravenna', 'as', 'Davide', 'Monferini', 'Dojo Ravenna', 'director', ' Via P.  Coriandro 1', '48121', 18, 10, 2, '333 8123929', '123', 'dmonfer@tin.it', 200.00, 20.00, 2, '2014-08-27 17:08:18');

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
  `description` text,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `type`, `en_name`, `it_name`, `image`, `description`, `user_id`, `timestamp`) VALUES
(1, 'D', 'Youngling', 'Iniziato', '3f91ec69cb3035cab7b855464d2aa51c.png', '<p><br></p>', 2, '2014-08-06 08:29:35'),
(4, 'D', 'Founding Master', 'Maestro Fondatore', 'f4480b0d05c4b2f1010f166fc7ebfbac.png', '<p><br></p>', 2, '2014-08-06 08:58:29'),
(6, 'D', 'Jedi', 'Jedi', '375c268b5e786fe15bf5ca8f9bb5d5d3.png', '<p><br></p>', 2, '2014-08-06 08:59:16'),
(7, 'D', 'Sith Lord', 'Maestro Sith', '89e990cb1cff363dadf0cf17faae2205.png', '<p><br></p>', 2, '2014-08-06 08:59:35'),
(8, 'D', 'Jedi Knight', 'Cavaliere Jedi', 'd9564d57165b2e8d21b1b8c959409216.png', '<p><br></p>', 2, '2014-08-06 09:00:03'),
(9, 'D', 'Jedi Master', 'Maestro Jedi', '586eef00da8faf942266c6e0564e7e76.png', '<p><br></p>', 2, '2014-08-06 09:00:17'),
(10, 'D', 'Padawan', 'Padawan', '05be81d032899191a04476ce132aebfb.png', '<p><br></p>', 2, '2014-08-06 09:00:37'),
(11, 'D', 'Sith', 'Sith', 'd8c40faf9d4a4cc931a71406d830726c.png', '<p><br></p>', 2, '2014-08-06 09:09:49'),
(12, 'D', 'Sith Knight', 'Cavaliere Sith', 'f29c72aad0c31c87d6f0b4184eb7f8a9.png', '<p><br></p>', 2, '2014-08-06 09:10:01'),
(13, 'H', 'Style Keeper', 'Custode delle Tradizioni', '26343a7d74b1cd4e83c3832e11e9c15e.png', '<p><br></p>', 2, '2014-08-06 09:11:26'),
(14, 'H', 'Shadow Master', 'Maestro d''Ombra', 'c659b7d7d9eeeda61e8eac8572d6b6bd.png', '<p><br></p>', 2, '2014-08-06 09:11:41'),
(15, 'Q', 'Training Instructor', 'Allievo Istruttore', 'c3f47e4d7892badb6143c0ca8dfdb9ea.png', '<p><br></p>', 2, '2014-08-06 09:12:01'),
(16, 'Q', 'Dean', 'Preside', '8e1186446122de0125950eaa1876b6c7.png', '<p><br></p>', 2, '2014-08-06 09:12:24'),
(17, 'S', 'Guardian', 'Guardiano', 'd96588d37881627e7d15bb08aa5f5894.png', '<p><br></p>', 2, '2014-08-06 09:12:54'),
(18, 'S', 'Sentinel', 'Sentinella', 'f21947ce2c9749ef24d3163c281a3bb0.png', '<p><br></p>', 2, '2014-08-06 09:13:13'),
(19, 'H', 'Quartermaster', 'Quartiermastro', '791c2c9790d4b4cfb379225986fa15e9.png', '<p><br></p>', 2, '2014-09-04 14:09:26'),
(20, 'H', 'Prophet', 'Profeta', 'ad6b6aa3371010529116611c74cc4750.png', '<p><br></p>', 2, '2014-09-04 14:09:49'),
(21, 'H', 'Shadow', 'Ombra', '163a5839d263031de7f9d0ec7ebe474b.png', '<p><br></p>', 2, '2014-09-04 14:10:09'),
(22, 'H', 'Master Sabersmith', 'Mastro di Spada', 'd673d00cb663bf587f3d206d0e2972e1.png', '<p><br></p>', 2, '2014-09-04 14:10:38'),
(23, 'H', 'Researcher', 'Ricercatore', '10998295a9776fb243d542302339f63a.png', '<p><br></p>', 2, '2014-09-04 14:11:02'),
(24, 'Q', 'Instructor level 1', 'Istruttore livello 1', '802e292ed5e1e18b41eacb4c62c7f7e2.png', '<p><br></p>', 2, '2014-09-04 14:12:39'),
(25, 'Q', 'Instructor level 2', 'Istruttore livello 2', '74e0c7ae2ffa57b2f6edaf218515d5b1.png', '<p><br></p>', 2, '2014-09-04 14:12:59'),
(26, 'Q', 'Instructor level 3', 'Istruttore livello 3', '3b69f92034caa56c01b0dc557cfa18b0.png', '<p><br></p>', 2, '2014-09-04 14:13:21'),
(27, 'Q', 'Instructor level 4', 'Istruttore livello 4', 'e5794f064d8771b73cbc726d92cec792.png', '<p><br></p>', 2, '2014-09-04 14:13:38'),
(28, 'Q', 'Instructor level 5', 'Istruttore livello 5', 'ee9fca9261bfc36aa75520acab20a6c4.png', '<p><br></p>', 2, '2014-09-04 14:13:55'),
(29, 'Q', 'Instructor level 6', 'Istruttore livello 6', 'e5a69a7cdadbe9d3c7920778063a181d.png', '<p><br></p>', 2, '2014-09-04 14:14:12'),
(30, 'Q', 'Instructor level 7', 'Istruttore livello 7', '34decadb79339ec2331e068fb92ab08c.png', '<p><br></p>', 2, '2014-09-04 14:14:31'),
(31, 'Q', 'Rector', 'Rector', 'd8cd960df43cb57e12d52298430214c6.png', '<p><br></p>', 2, '2014-09-04 14:14:45'),
(32, 'S', 'Consul', 'Console', '816090c955dcd98b6350f24c68d29c38.png', '<p><br></p>', 2, '2014-09-04 14:16:20'),
(33, 'S', 'Style Keeper', 'Custode di Stile', '919209a9005701114a358b640fbaea6f.png', '<p><br></p>', 2, '2014-09-04 14:16:53'),
(34, 'S', 'Ambassador', 'Ambasciatore', '42d6aa2ab1605c76a017a0cf4028128d.png', '<p><br></p>', 2, '2014-09-04 14:17:09'),
(35, 'S', 'Master of Arms', 'Maestro d''Armi', '150cc6ac0be492e802de192db5baafb9.png', '<p><br></p>', 2, '2014-09-04 14:17:29'),
(36, 'S', 'Battle Master', 'Maestro di Battaglia', '1fc7d4aae6bc3e19390e348c09acf33a.png', '<p><br></p>', 2, '2014-09-04 14:18:18'),
(37, 'S', 'Academy Master', 'Maestro d''Accademia', '1a40f32897f546631e7a96a1f6c8d82c.png', '<p><br></p>', 2, '2014-09-04 14:18:40'),
(38, 'S', 'Style Master in Shii-Cho', 'Maestro di Shii-Cho', '2656d4016b1874c18d229c5ff9485850.png', '<p><br></p>', 2, '2014-09-04 14:19:14'),
(39, 'S', 'Style Master in Makashi', 'Maestro di Makashi', '03c0e2e2b6050bdeac592090aa063e8f.png', '<p><br></p>', 2, '2014-09-04 14:19:53'),
(40, 'S', 'Style Master in Soresu', 'Maestro di Soresu', '66055d8882da9f8f9e5a9f8ec8a591d5.png', '<p><br></p>', 2, '2014-09-04 14:20:11'),
(41, 'S', 'Style Master in Ataru', 'Maestro di Ataru', '49155d58d16f378639ee78ed4589d5be.png', '<p><br></p>', 2, '2014-09-04 14:20:29'),
(42, 'S', 'Style Master in Djem-So', 'Maestro di Djem-So', '6198824741d2cef9be0fff724cf4f777.png', '<p><br></p>', 2, '2014-09-04 14:20:51'),
(43, 'S', 'Style Master in Niman', 'Maestro di Niman', '31bf67508bc6ab370e6913dbb0f9dbe1.png', '<p><br></p>', 2, '2014-09-04 14:21:08'),
(44, 'S', 'Style Master in Vaapad', 'Maestro di Vaapad', '2e622daab8de916330cf3d1d06e27a59.png', '<p><br></p>', 2, '2014-09-04 14:21:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(6, 10, 'Milan', 'Milano', 2, '2014-08-02 13:16:57'),
(7, 10, 'Turin', 'Torino', 2, '2014-08-02 13:17:27'),
(8, 8, 'Dublin', 'Dublino', 2, '2014-08-02 13:28:17'),
(9, 9, 'Moscow', 'Mosca', 2, '2014-08-03 08:13:10'),
(10, 11, 'Cheltenham', 'Cheltenham', 2, '2014-08-03 08:19:42'),
(11, 10, 'Rome', 'Roma', 2, '2014-08-04 06:53:06'),
(12, 10, 'Bologna', 'Bologna', 2, '2014-08-04 07:36:32'),
(13, 10, 'Cuneo', 'Cuneo', 2, '2014-08-04 07:36:52'),
(14, 10, 'Pavia', 'Pavia', 2, '2014-08-04 07:37:03'),
(15, 10, 'Padova', 'Padova', 2, '2014-08-04 07:37:16'),
(16, 10, 'Varese', 'Varese', 2, '2014-08-04 07:37:29'),
(17, 10, 'Genoa', 'Genoa', 2, '2014-08-04 07:38:01'),
(18, 10, 'Ravenna', 'Ravenna', 2, '2014-08-27 17:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `clandates`
--

CREATE TABLE IF NOT EXISTS `clandates` (
  `id` int(11) NOT NULL,
  `clan_id` int(11) NOT NULL,
  `clan_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `clans`
--

INSERT INTO `clans` (`id`, `academy_id`, `school_id`, `teacher_id`, `level_id`, `lesson_day`, `lesson_from`, `lesson_to`, `en_class_name`, `it_class_name`, `same_address`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(5, 5, 6, '7', 7, '5', 1407092400, 1407099600, 'Clan of the King', 'Clan del Re', 1, '119 Tennant Rd.', '54321', 10, 11, 6, '1', '1', 'demo@yopmail.com', 2, '2014-08-03 08:29:36'),
(6, 6, 10, '46', 19, '4', 1409770800, 1409778000, 'Clan della Luce', 'Clan della Luce', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-21 09:21:40'),
(7, 6, 10, '46', 2, '2', 1409166000, 1409173200, 'Clan della Fenice', 'Clan della Fenice', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-26 09:43:28'),
(8, 6, 10, '37', 8, '2', 1410201000, 1410208200, 'Clan della Chimera', 'Clan della Chimera', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-26 09:46:53'),
(9, 6, 10, '45', 8, '6', 1409079600, 1409086800, 'Clan del Sole Nascente', 'Clan del Sole Nascente', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-26 09:48:07'),
(10, 6, 10, '38', 7, '2', 1409072400, 1409079600, 'Clan della Medusa', 'Clan della Medusa', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-26 09:50:47'),
(11, 6, 10, '47', 9, '5', 1409079600, 1409086800, 'Clan della Terza Torre', 'Clan della Terza Torre', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-26 09:54:49'),
(12, 6, 13, '36', 1, '5', 1409079600, 1409086800, 'Clan del Drago', 'Clan del Drago', 0, 'via Seprio, 2 (ingresso via Marsala)\n21013 Gallarate VA ', '21023', 16, 10, 2, '+39 348 2527132', '', 'varese@ludosport.net', 2, '2014-08-26 10:20:50'),
(13, 6, 13, '39', 1, '6', 1409079600, 1409086800, 'Clan delle Tenebre', 'Clan delle Tenebre', 0, 'via Seprio, 2 (ingresso via Marsala)\nGallarate VA ', '21013', 16, 10, 2, '+39 348 2527132', '393482527132', 'varese@ludosport.net', 2, '2014-08-26 10:22:53'),
(14, 6, 11, '48', 1, '2', 1409077800, 1409085000, 'Clan del Diamante Grezzo', 'Clan del Diamante Grezzo', 0, 'via Asinari di Bernezzo 84/c', '10146', 7, 10, 2, '+39 331 3133737', '', 'torino@ludosport.net', 2, '2014-08-26 14:52:54'),
(15, 6, 11, '49', 1, '2,3', 1409855400, 1409862600, 'Clan dei Due Soli', 'Clan dei Due Soli', 0, 'via Asinari di Bernezzo 84/c', '10146', 7, 10, 2, '+39 331 3133737', '', 'torino@ludosport.net', 2, '2014-08-26 14:57:34'),
(16, 6, 10, '43', 18, '1', 1409126400, 1409148000, 'Corso Istruttori Shi-Cho', 'Corso Istruttori Shi-Cho', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 09:48:40'),
(17, 6, 10, '45', 18, '1', 1409126400, 1409148000, 'Corso Istruttori Makashi', 'Corso Istruttori Makashi', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 09:51:48'),
(18, 6, 10, '46', 18, '7', 1410163200, 1410184800, 'Corso Istruttori Soresu', 'Corso Istruttori Soresu', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 09:53:49'),
(19, 6, 10, '47', 19, '1', 1409126400, 1409155200, 'Clan Master Shii Cho', 'Clan Master Shii Cho', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 13:03:53'),
(20, 6, 10, '46', 20, '7', 1410163200, 1410192000, 'Clan Master Makashi', 'Clan Master Makashi', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 13:04:37'),
(21, 6, 10, '47', 18, '1', 1409126400, 1409155200, 'International instructors course', 'Corso istruttori Internazionale', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-27 13:21:47'),
(22, 6, 12, '59', 8, '5', 1409166000, 1409173200, 'Clan della Croce del Sud', 'Clan della Croce del Sud', 0, 'Palagym Assarotti - Via San Bartolomeo degli Armeni 1 (Via Serra)', '16122', 17, 10, 2, '+39 320 0809640', '', 'genova@ludosport.net', 2, '2014-08-27 14:54:44'),
(23, 6, 12, '60', 9, '6', 1409166000, 1409173200, 'Clan della Stella Polare', 'Clan della Stella Polare', 0, 'Palagym Assarotti - Via San Bartolomeo degli Armeni 1 (Via Serra)', '16122', 17, 10, 2, '+39 320 0809640', '', 'genova@ludosport.net', 2, '2014-08-27 14:57:56'),
(24, 6, 10, '57', 4, '4', 1409846400, 1409851800, 'Clan Youngling', 'Clan Youngling', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-28 14:20:34'),
(25, 6, 14, '127', 8, '6', 1409679000, 1409686200, 'Clan della Prima Legione', 'Clan della Prima Legione', 1, 'piazzale Ss. Pietro e Paolo 15', '144', 11, 10, 2, '+39 347 1558492', '123', 'roma@ludosport.net', 2, '2014-09-02 14:51:46'),
(26, 8, 19, '58', 8, '5', 1409684400, 1409691600, 'Clan dello Spirito', 'Clan dello Spirito', 1, 'Via P.  Coriandro 1 - 48121', '48121', 18, 10, 2, '333 8123929', '', 'dmonfer@tin.it', 2, '2014-09-02 15:09:15'),
(27, 6, 13, '52', 7, '6', 1409686200, 1409693400, 'Clan del Leviatano', 'Clan del Leviatano', 1, 'via di Merdor 66', '54321', 16, 10, 2, '1234567890', '123456789', 'varese@ludosport.net', 2, '2014-09-02 16:48:10'),
(28, 6, 10, '157', 1, '1', 1410130800, 1410134400, 'try', 'try', 1, 'via Padre Massimiliano Kolbe 5', '20137', 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-09-08 10:26:59');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 'India', 'India', 1, '2014-07-17 07:11:46'),
(2, 'Italy', 'Italy', 1, '2014-07-17 07:11:56'),
(3, 'Ireland', 'Irlanda', 2, '2014-07-21 06:15:37'),
(5, 'Russia', 'Russia', 2, '2014-07-25 06:24:56'),
(6, 'United Kingdom', 'Regno Unito', 2, '2014-08-02 06:24:49'),
(7, 'Germany', 'Germania', 2, '2014-08-26 09:56:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `message`, `attachment`, `format_info`, `user_id`, `timestamp`) VALUES
(1, 'user_registration', 'User Registration | MyLudosport', 'Hello #firstname #lastname<br>Thankyou for Registration.<br><div><br><span style="font-weight: bold;">Basic Details:<br></span>Name : #firstname #lastname<br>Location :  #location<br>Date of Birth : #dob<br><br><span style="font-weight: bold;">Login Details:<br></span>Nickname : #nickname<br>Password :  #password<br></div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#location\r\n#dob\r\n#nickname\r\n#password', 2, '2014-07-26 05:15:22'),
(2, 'forgot_password', 'Forgot Password | MyLudosport', 'Hello #firstname #lastname <div><br></div><div>You have request for the reset the password.</div><div>Please click the below link to reset password.<br>\r\n#reset_link</div><div><br></div><div>Thanks,</div><div>MyLudosport Team</div>\r\n<div><hr>Please Click Here to <a href="http://#" target="_blank">unsubscribe</a></div>', NULL, '#firstname\r\n#lastname\r\n#reset_link', 1, '2014-07-26 05:15:22'),
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
(16, 'holiday_upapproved', 'Holiday Unapproved | MyLudosport', '<div>Dear #user_name,</div><div><br></div><div>Your request for holiday on #date is <span>unapproved</span>.</div><div>It is unapproved by #authorized_user_name.<br></div><div><br></div><div>Thanks </div><div><hr>Please Click Here to&nbsp;<a href="http:/#" target="_blank">unsubscribe</a></div>', NULL, '#user_name\r\n#date\r\n#authorized_user_name', 2, '2014-08-25 08:05:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=672 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notify_type`, `from_id`, `to_id`, `object_id`, `data`, `status`, `timestamp`) VALUES
(1, 'N', 'rector_assign_academy', 2, 3, 1, NULL, 1, '2014-07-25 08:45:52'),
(2, 'N', 'rector_assign_academy', 2, 5, 1, NULL, 0, '2014-07-25 08:45:52'),
(5, 'N', 'dean_assign_school', 2, 3, 1, NULL, 1, '2014-07-25 10:49:30'),
(6, 'N', 'rector_assign_academy', 2, 3, 2, NULL, 1, '2014-07-25 11:22:55'),
(7, 'N', 'dean_assign_school', 2, 3, 1, NULL, 1, '2014-07-26 05:43:28'),
(8, 'N', 'teacher_assign_class', 2, 3, 1, NULL, 1, '2014-07-26 05:45:01'),
(9, 'N', 'rector_assign_academy', 2, 3, 1, NULL, 1, '2014-07-26 05:45:22'),
(10, 'N', 'dean_assign_school', 2, 3, 2, NULL, 1, '2014-07-26 05:49:39'),
(12, 'N', 'teacher_assign_class', 2, 3, 1, NULL, 1, '2014-07-26 06:36:03'),
(13, 'N', 'dean_assign_school', 2, 4, 4, NULL, 0, '2014-07-26 09:43:41'),
(14, 'N', 'dean_assign_school', 2, 4, 3, NULL, 0, '2014-07-26 09:44:24'),
(15, 'N', 'teacher_assign_class', 2, 5, 1, NULL, 0, '2014-07-26 09:45:00'),
(16, 'N', 'teacher_assign_class', 2, 7, 2, NULL, 0, '2014-07-26 09:47:00'),
(17, 'N', 'teacher_assign_class', 2, 7, 3, NULL, 0, '2014-07-26 09:47:38'),
(18, 'N', 'teacher_assign_class', 2, 8, 4, NULL, 0, '2014-07-26 09:48:27'),
(19, 'I', 'user_register', 0, 2, 9, NULL, 1, '2014-07-26 11:10:31'),
(20, 'I', 'user_register', 0, 3, 9, NULL, 1, '2014-07-26 11:10:31'),
(21, 'I', 'user_register', 0, 4, 9, NULL, 0, '2014-07-26 11:10:31'),
(22, 'I', 'user_register', 0, 5, 9, NULL, 0, '2014-07-26 11:10:31'),
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
(36, 'I', 'user_register', 0, 5, 10, NULL, 0, '2014-07-30 11:31:59'),
(37, 'I', 'user_register', 0, 6, 10, NULL, 0, '2014-07-30 11:31:59'),
(38, 'I', 'user_register', 0, 7, 10, NULL, 0, '2014-07-30 11:31:59'),
(39, 'I', 'user_register', 0, 8, 10, NULL, 0, '2014-07-30 11:32:00'),
(40, 'I', 'user_register', 0, 2, 11, NULL, 1, '2014-07-30 11:35:32'),
(41, 'I', 'user_register', 0, 3, 11, NULL, 1, '2014-07-30 11:35:32'),
(42, 'I', 'user_register', 0, 4, 11, NULL, 0, '2014-07-30 11:35:33'),
(43, 'I', 'user_register', 0, 5, 11, NULL, 0, '2014-07-30 11:35:33'),
(44, 'I', 'user_register', 0, 6, 11, NULL, 0, '2014-07-30 11:35:33'),
(45, 'I', 'user_register', 0, 7, 11, NULL, 0, '2014-07-30 11:35:33'),
(46, 'I', 'user_register', 0, 8, 11, NULL, 0, '2014-07-30 11:35:33'),
(47, 'N', 'rector_assign_academy', 2, 5, 3, NULL, 0, '2014-07-31 04:29:27'),
(48, 'N', 'dean_assign_school', 2, 4, 5, NULL, 0, '2014-07-31 08:50:42'),
(49, 'I', 'user_register', 0, 2, 14, NULL, 1, '2014-07-31 10:14:59'),
(50, 'I', 'user_register', 0, 3, 14, NULL, 0, '2014-07-31 10:14:59'),
(51, 'I', 'user_register', 0, 4, 14, NULL, 0, '2014-07-31 10:14:59'),
(52, 'I', 'user_register', 0, 5, 14, NULL, 0, '2014-07-31 10:14:59'),
(53, 'I', 'user_register', 0, 6, 14, NULL, 0, '2014-07-31 10:14:59'),
(54, 'I', 'user_register', 0, 7, 14, NULL, 0, '2014-07-31 10:14:59'),
(55, 'I', 'user_register', 0, 8, 14, NULL, 0, '2014-07-31 10:14:59'),
(56, 'I', 'user_register', 0, 2, 15, NULL, 1, '2014-07-31 11:22:15'),
(57, 'I', 'user_register', 0, 3, 15, NULL, 0, '2014-07-31 11:22:15'),
(58, 'I', 'user_register', 0, 4, 15, NULL, 0, '2014-07-31 11:22:16'),
(59, 'I', 'user_register', 0, 5, 15, NULL, 0, '2014-07-31 11:22:16'),
(60, 'I', 'user_register', 0, 6, 15, NULL, 0, '2014-07-31 11:22:16'),
(61, 'I', 'user_register', 0, 7, 15, NULL, 0, '2014-07-31 11:22:16'),
(62, 'I', 'user_register', 0, 8, 15, NULL, 0, '2014-07-31 11:22:16'),
(63, 'I', 'user_register', 0, 2, 16, NULL, 1, '2014-07-31 11:29:52'),
(64, 'I', 'user_register', 0, 3, 16, NULL, 0, '2014-07-31 11:29:52'),
(65, 'I', 'user_register', 0, 4, 16, NULL, 0, '2014-07-31 11:29:52'),
(66, 'I', 'user_register', 0, 5, 16, NULL, 0, '2014-07-31 11:29:52'),
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
(671, 'N', 'teacher_assign_class', 2, 157, 28, NULL, 0, '2014-09-08 10:26:59');

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
(2, 'Admin', 'Admin', 0, 'a:15:{s:5:"roles";a:2:{i:0;s:8:"viewRole";i:1;s:8:"editRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:8:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";i:7;s:24:"changeStatusTrialStudent";}s:15:"eventcategories";a:4:{i:0;s:17:"viewEventcategory";i:1;s:16:"addEventcategory";i:2;s:17:"editEventcategory";i:3;s:19:"deleteEventcategory";}s:6:"events";a:4:{i:0;s:9:"viewEvent";i:1;s:8:"addEvent";i:2;s:9:"editEvent";i:3;s:11:"deleteEvent";}s:7:"batches";a:3:{i:0;s:9:"viewBatch";i:1;s:9:"editBatch";i:2;s:11:"deleteBatch";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:6:"emails";a:2:{i:0;s:9:"viewEmail";i:1;s:9:"editEmail";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:9:"viewState";i:1;s:8:"addState";i:2;s:9:"editState";i:3;s:11:"deleteState";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}s:8:"messages";a:2:{s:14:"single_message";a:5:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";}s:13:"group_message";a:6:{i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 0, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:5:"clans";a:7:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";i:5;s:15:"clanStudentList";i:6;s:22:"listTrialLessonRequest";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:22'),
(4, 'Dean', 'Preside', 0, 'a:7:{s:5:"roles";a:1:{i:0;s:8:"viewRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";i:2;s:15:"clanStudentList";i:3;s:22:"listTrialLessonRequest";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 0, 'a:6:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:4:{i:0;s:15:"clanTeacherList";i:1;s:15:"clanStudentList";i:2;s:22:"listTrialLessonRequest";i:3;s:24:"changeStatusTrialStudent";}s:8:"profiles";a:3:{i:0;s:11:"viewProfile";i:1;s:11:"editProfile";i:2;s:14:"changePassword";}s:8:"messages";a:1:{s:13:"group_message";a:1:{s:5:"clans";s:1:"0";}}}', '0', 1, '2014-07-17 10:16:50'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `academy_id`, `dean_id`, `en_school_name`, `it_school_name`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(6, 5, '4', 'Cheltenham School', 'Scuola di Cheltenham', '119 Tennant Rd.', 54321, 10, 11, 6, '1', '1', 'demo@yopmail.com', 2, '2014-08-03 08:26:06'),
(8, 4, '24', 'Moscow School', 'Scuola di Mosca', 'Ulitsa Varvarka 8', 54321, 9, 9, 5, '1', '1', 'demo@yopmail.com', 2, '2014-08-03 08:33:29'),
(9, 7, '24', 'Dublin School', 'Scuola di Dublino', '123 Cloverfield St.', 54321, 8, 8, 3, '1234567890', '1', 'demo@yopmail.com', 2, '2014-08-04 14:59:20'),
(10, 6, '45', 'Milan School', 'Scuola di Milano', 'via Padre Massimiliano Kolbe 5', 20137, 6, 10, 2, '1234567890', '1234567890', 'info@ludosport.net', 2, '2014-08-04 15:12:03'),
(11, 6, '48', 'Turin School', 'Scuola di Torino', 'via Vattelappesca 1', 54321, 7, 10, 2, '1234567890', '123456789', 'torino@ludosport.net', 2, '2014-08-04 15:13:02'),
(12, 6, '59', 'Genoa School', 'Scuola di Genova', 'via Lauzi 81', 54321, 17, 10, 2, '1234567890', '123456789', 'genova@ludosport.net', 2, '2014-08-04 15:14:11'),
(13, 6, '36,39', 'Varese School', 'Scuola di Varese', 'via di Merdor 66', 54321, 16, 10, 2, '1234567890', '123456789', 'varese@ludosport.net', 2, '2014-08-04 15:15:21'),
(14, 6, '127', 'Rome School', 'Scuola di Roma', 'piazzale Ss. Pietro e Paolo 15', 144, 11, 10, 2, '+39 347 1558492', '123', 'roma@ludosport.net', 2, '2014-08-04 15:16:19'),
(15, 6, '30', 'Padua School', 'Scuola di Padova', 'via Spritz 50', 54321, 15, 10, 2, '12345689', '1234567890', 'padova@ludosport.net', 2, '2014-08-04 15:17:33'),
(16, 6, '31', 'Pavia School', 'Scuola di Pavia', 'via Scotti 12', 54321, 14, 10, 2, '12345689', '1234567890', 'pavia@ludosport.net', 2, '2014-08-04 15:18:31'),
(17, 6, '32', 'Cuneo School', 'Scuola di Cuneo', 'piazza Galimberti 1', 54321, 13, 10, 2, '12345689', '1234567890', 'cuneo@ludosport.net', 2, '2014-08-04 15:19:44'),
(18, 6, '33', 'Bologna School', 'Scuola di Bologna', 'piazza Grande 6', 54321, 12, 10, 2, '12345689', '1234567890', 'bologna@ludosport.net', 2, '2014-08-04 15:20:56'),
(19, 8, '58', 'Ravenna School', 'Scuola di Ravenna', 'Via P.  Coriandro 1 - 48121', 48121, 18, 10, 2, '333 8123929', '', 'dmonfer@tin.it', 2, '2014-08-27 17:12:48');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Gujarat', 'Gujarat', 1, '2014-07-17 07:12:28'),
(2, 1, 'Mumbai', '', 1, '2014-07-17 07:12:55'),
(8, 3, 'Ireland', 'Irlanda', 2, '2014-08-02 06:26:56'),
(9, 5, 'Russia', 'Russia', 2, '2014-08-02 06:27:27'),
(10, 2, 'Italy', 'Italia', 2, '2014-08-02 13:00:12'),
(11, 6, 'England', 'Inghilterra', 2, '2014-08-02 13:04:21');

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
  `level_id` int(11) NOT NULL,
  `clan_id` varchar(11) NOT NULL,
  `first_lesson_date` date DEFAULT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `palce_of_birth` text,
  `zip_code` bigint(15) DEFAULT NULL,
  `tax_code` bigint(15) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `status` enum('A','U','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `student_master_id`, `level_id`, `clan_id`, `first_lesson_date`, `approved_by`, `palce_of_birth`, `zip_code`, `tax_code`, `blood_group`, `status`, `user_id`, `timestamp`) VALUES
(1, 34, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:29:41'),
(2, 35, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:38:27'),
(3, 36, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:41:34'),
(4, 37, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:42:41'),
(5, 38, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:43:42'),
(6, 39, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:44:22'),
(7, 40, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:44:59'),
(8, 41, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:45:36'),
(9, 42, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:46:02'),
(10, 43, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 09:59:04'),
(11, 44, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-21 10:00:01'),
(13, 48, 6, '18', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-26 14:47:23'),
(14, 49, 6, '18', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:06:09'),
(15, 50, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:10:44'),
(16, 51, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:12:45'),
(18, 22, 6, '21', '2014-09-08', 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:23:09'),
(19, 23, 6, '21', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:23:44'),
(20, 52, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:29:48'),
(21, 53, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:32:03'),
(22, 54, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:34:05'),
(23, 55, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:41:56'),
(24, 56, 6, '7', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:43:12'),
(25, 58, 6, '17', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:48:17'),
(26, 59, 6, '17', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:53:52'),
(27, 60, 6, '17', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:55:03'),
(28, 61, 6, '20', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 13:57:27'),
(29, 33, 6, '17', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 14:34:58'),
(30, 62, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 15:24:05'),
(31, 63, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:33:46'),
(32, 65, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:40:11'),
(33, 66, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:41:22'),
(34, 64, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:42:25'),
(35, 67, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:46:13'),
(36, 68, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:49:23'),
(37, 70, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:49:52'),
(38, 69, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:50:17'),
(39, 71, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:50:57'),
(40, 72, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:51:41'),
(41, 74, 6, '23', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:53:04'),
(42, 73, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:53:26'),
(43, 77, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:56:41'),
(44, 75, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:57:03'),
(45, 78, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:57:26'),
(46, 76, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:57:46'),
(47, 79, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:58:11'),
(48, 80, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:58:37'),
(49, 81, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:59:22'),
(50, 82, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 16:59:43'),
(51, 84, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 17:01:35'),
(52, 83, 6, '22', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-27 17:09:09'),
(53, 85, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 11:56:24'),
(54, 86, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 11:58:53'),
(55, 87, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 12:01:53'),
(56, 88, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 12:02:52'),
(57, 89, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 12:04:14'),
(58, 90, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 12:05:29'),
(59, 91, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'A', 2, '2014-08-28 12:06:42'),
(60, 92, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 12:11:25'),
(61, 93, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 12:14:01'),
(62, 94, 6, '9', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 12:15:32'),
(63, 95, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 12:57:23'),
(64, 96, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 12:58:47'),
(65, 97, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:07:20'),
(66, 98, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:08:27'),
(67, 99, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:09:52'),
(68, 100, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:13:42'),
(69, 101, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:15:13'),
(70, 102, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:19:26'),
(71, 103, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:25:29'),
(72, 104, 6, '11', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:26:45'),
(73, 105, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:57:37'),
(74, 106, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:58:42'),
(75, 107, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 13:59:48'),
(76, 108, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:01:20'),
(77, 109, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:02:55'),
(78, 110, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:04:02'),
(79, 111, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:05:28'),
(80, 112, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:15:36'),
(81, 113, 6, '24', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-08-28 14:22:55'),
(82, 114, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:36:13'),
(83, 115, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:37:50'),
(84, 116, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:41:43'),
(85, 117, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:42:54'),
(86, 118, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:44:06'),
(87, 119, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:45:09'),
(88, 120, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:46:22'),
(89, 121, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 08:58:10'),
(90, 122, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 09:05:09'),
(91, 123, 6, '8', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 09:06:18'),
(92, 124, 6, '16', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-01 09:10:51'),
(93, 125, 6, '24', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:38:16'),
(94, 126, 6, '24', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:41:50'),
(95, 127, 6, '16', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:47:06'),
(96, 128, 6, '16', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:53:11'),
(97, 129, 6, '25', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:54:34'),
(98, 130, 6, '25', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:55:49'),
(99, 131, 6, '25', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:56:58'),
(100, 132, 6, '25', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 14:58:42'),
(101, 133, 6, '24', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 15:00:19'),
(102, 134, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 15:20:54'),
(103, 135, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 15:23:44'),
(104, 136, 6, '13', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:19:25'),
(105, 137, 6, '13', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:20:45'),
(106, 138, 6, '13', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:22:04'),
(107, 139, 6, '13', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:23:30'),
(108, 140, 6, '12', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:25:18'),
(109, 141, 6, '12', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:27:35'),
(110, 142, 6, '12', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:29:22'),
(111, 143, 6, '12', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:30:30'),
(112, 144, 6, '12', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-02 16:31:45'),
(113, 145, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:18:37'),
(114, 146, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:20:58'),
(115, 147, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:22:08'),
(116, 148, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:23:28'),
(117, 149, 6, '14', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:24:53'),
(118, 150, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:26:07'),
(119, 151, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:27:12'),
(120, 152, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:28:18'),
(121, 153, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:29:32'),
(122, 154, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:31:16'),
(123, 155, 6, '15', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-03 08:32:22'),
(124, 156, 6, '26', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-04 10:06:40'),
(125, 45, 6, '6', NULL, 0, NULL, NULL, NULL, NULL, 'P', 2, '2014-09-08 10:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `role_id` varchar(25) NOT NULL,
  `username` varchar(65) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `date_of_birth` bigint(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_of_residence` varchar(225) DEFAULT NULL,
  `permission` longtext,
  `avtar` varchar(255) NOT NULL DEFAULT 'no_avatar.jpg',
  `status` enum('A','D','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `state_id`, `country_id`, `city_of_residence`, `permission`, `avtar`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'soyab1@yopmail.com', 316895400, 1, 1, 1, NULL, NULL, 'no_avatar.jpg', 'A', 0, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Society of', 'LudoSport Masters', 'simone@ludosport.net', 1409954400, 6, 10, 2, NULL, NULL, '816908fffdf9c03a66252a5cb57b986d.jpg', 'A', 2, '2014-07-17 07:28:01'),
(21, '3,4,5', 'Jim', '202cb962ac59075b964b07152d234b70', 'Jim ', 'Tuohy', '123@123.it', 1230764400, 8, 8, 3, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-04 07:46:19'),
(22, '3,6', 'Jordan', '202cb962ac59075b964b07152d234b70', 'Jordan ', 'Court', '1234@123.it', 1234306800, 10, 11, 6, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-04 07:47:21'),
(23, '3,6', 'Maksim', '202cb962ac59075b964b07152d234b70', 'Maksim ', 'Varezhkin', '1235@123.it', 1233615600, 9, 9, 5, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-04 07:47:58'),
(33, '4,5,6', 'Inox', '47eb752bac1c08c75e30d9624b3e58b7', 'Simone', 'Pedrazzi', 'simone.pedrazzi@student.unife.it', 1407276000, 12, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-04 15:08:09'),
(34, '6', 'eugenio', '1633ee3b531902b6aa51776f78b5abab', 'Eugenio', 'Di Fraia', 'eugenio.difraia@gmail.com', 335656800, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:29:41'),
(35, '6', 'lorenzoferrario', '5aa8d66f2030d7e61e221b3c450406fc', 'Lorenzo', 'Ferrario', 'demo@test.it', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:38:27'),
(36, '4,5,6', 'krauss', '202cb962ac59075b964b07152d234b70', 'Davide', 'Crespi', 'masterkrauss@gmail.com', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:41:34'),
(37, '5,6', 'Ryo', '969044ea4df948fb0392308cfff9cdce', 'Paolo', 'Scalzulli', 'stoimpazzendo@hotmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:42:41'),
(38, '5,6', 'antonio', '36bd8b49b1cafbf50f41f632d80b499d', 'Antonio', 'Rocchitelli', 'antonio.rocchitelli@fastwebnet.it', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:43:42'),
(39, '4,5,6', 'Paolobi', '969044ea4df948fb0392308cfff9cdce', 'Paolo', 'Lasalvia', 'paololas@gmail.com', 498265200, 6, 10, 2, NULL, NULL, '7d187b7060be735019321bec573130f1.png', 'A', 39, '2014-08-21 09:44:22'),
(40, '6', 'greylaw', 'ea46e7e94ccee171a97fe14853d5861e', 'Lorenzo', 'Todaro', 'demo5@test.it', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:44:59'),
(41, '5,6', 'gianandrea', '5f34242b362fd6a4d433b992ed1078a5', 'Gianandrea', 'Barinotti', 'g.barinotti@gmail.com', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:45:36'),
(42, '6', 'mauro', '202cb962ac59075b964b07152d234b70', 'Mauro', 'Visioni', 'demo7@test.it', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:46:02'),
(43, '5,6', 'valeria', 'd6c92c6b37c6f707bd859b0c6fb0e191', 'Valeria', 'Ricciardi', 'demo8@test.it', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 09:59:04'),
(44, '6', 'debora', 'b6da20debd2a649b4dfa7dece7662a93', 'Debora', 'Girelli', 'girelli.debora@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 10:00:01'),
(45, '4,5,6', 'Cornelius', 'cdaeb1282d614772beb1e74c192bebda', 'Ugo Cesare', 'Tonelli', 'ugocesare@abridge.it', 599094000, 6, 10, 2, 'Milan', NULL, 'no_avatar.jpg', 'A', 2, '2014-08-21 15:49:45'),
(46, '3,5', 'Nemo', '202cb962ac59075b964b07152d234b70', 'Simone', 'Spreafico', 'spreafico.s@gmail.com', 63673200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-26 10:29:35'),
(47, '3,5', 'Sabnak', '691271029b2e8a3cd3d202c9a7794ff9', 'Gianluca', 'Longo', 'gianlucalongo@gmail.com', -151462800, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-26 10:32:55'),
(48, '4,5,6', 'Vlisia', '4731d7ea0369be5d7c780ce09c74265b', 'Silvana', 'Guglielmo', 'vlisia2005@libero.it', -222742800, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-26 14:47:23'),
(49, '5,6', 'Fatum', 'a53bd0415947807bcb95ceec535820ee', 'Fabio', 'Bollino', 'fatum1981@gmail.com', 363477600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-26 14:55:27'),
(50, '6', 'Angela', '36388794be2cf5f298978498ff3c64a2', 'Angela', 'Lavorato', 'angela@ludosport.net', 199494000, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:10:44'),
(51, '6', 'Marco', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Bosoni', 'marcobosoni@gmail.com', 198284400, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:12:45'),
(52, '5,6', 'Noise', 'aaddc3454ccbefbb2d8d8461f8f7f481', 'Davide', 'Molteni', 'davidemolteniit@gmail.com', 315529200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:29:48'),
(53, '6', 'Maxblanche', '8cac5ac44b51f182143a43c4cdb6c4ac', 'Massimo', 'bianchi', 'bianchima70@hotmail.com', 22802400, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:32:03'),
(54, '6', 'Chiara', '243a3b6f7ddfea2599743ce3370d5229', 'Chiara', 'Magnelli', 'chiara.magnelli@libero.it', 335224800, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:34:04'),
(55, '6', 'Paolo', '969044ea4df948fb0392308cfff9cdce', 'Paolo', 'Cartago', 'paolocartago@gmail.com', 724374000, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:41:56'),
(56, '6', 'Jake', '1200cf8ad328a60559cf5e7c5f46ee6d', 'Jacopo', 'Sarno', 'sarnojac@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:43:12'),
(57, '3,5', 'Dago', 'f7e5b2a36620ce9382a72c998af755f5', 'Fabio', 'Monticelli', 'fabio@abridge.it', 1409090400, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:44:45'),
(58, '3,4,5,6', 'hiras', '446fca5553df49ad9c6348cf1ff71d51', 'Davide', 'Monferini', 'davide.monferini@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:48:17'),
(59, '4,5,6', 'Ander', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Ungaro', 'aungaro@gmail.com', 163033200, 17, 10, 2, NULL, NULL, 'f604f857506ac036984619cd05c76b64.jpg', 'A', 59, '2014-08-27 13:53:52'),
(60, '5,6', 'Pini', 'b5f8e9089a612ec2b57627dda6e95b40', 'Andrea', 'Pini', 'andrerin.pini@gmail.com', -3600, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:55:03'),
(61, '6', 'mialee', '8070b0b01d9042fdbc54f095bd2832ef', 'Elisa', 'Brondolo', 'elfamialee@live.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 13:57:27'),
(62, '6', 'Ardyken', 'a53bd0415947807bcb95ceec535820ee', 'Fabio', 'Ardizzoni', 'faardiz@gmail.com', 631148400, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 15:20:25'),
(63, '6', 'Deran_Nos', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Zoppi', 'harlock76@gmail.com', 194914800, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:28:02'),
(64, '6', 'Wanme_Netai', '4c1aa3bca264abbd9ea912d4b9d124b9', 'Yitao', 'Mora', 'yitao.mora@yahoo.it', 480207600, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:33:51'),
(65, '6', 'Justicar', '21b836f007435bd70b9cc5455054cf3c', 'Gilberto', 'Presello', 'psycho81@gmail.com', 350262000, 17, 10, 2, NULL, NULL, '12fe3d4190350e74d9b1e032f94b0d18.jpg', 'A', 2, '2014-08-27 16:38:10'),
(66, '6', 'Rip''ken', '9667aacee4c11ab5cb1aee39cb183599', 'Riccardo', 'Sartori', 'riccardorsartori@fastwebnet.it', 298504800, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:39:57'),
(67, '6', 'Elerwen', '84248f04a5567607e949ab74b6ecbdae', 'Viviana', 'Corsini', 'elerwen@hotmail.com', 465343200, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:41:43'),
(68, '6', 'Lotar', '81375516ddb5dcf39a95e5360816b0c9', 'Fabrizio', 'Macario', 'fabrizio.macario@email.it', 325116000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:46:32'),
(69, '6', 'Darth_Modificus', '8571e629c370ad40073826db1901ee47', 'Ruggero', 'Pini', 'ruggero.pini@gmail.com', 228438000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:48:41'),
(70, '6', 'Katsumoto', '150be5b860e60a7fc7c7d9b9815e93d1', 'Matteo', 'Corradi', 'maimatterione@gmail.com', 374886000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:49:19'),
(71, '6', 'Radagast', '47eb752bac1c08c75e30d9624b3e58b7', 'Simone', 'Frattini', 'ciuighifratto@libero.it', 903650400, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:50:27'),
(72, '6', 'Rixh', 'dbc3ede8cf726a5f892a7808f647aa3e', 'Mattia', 'Bottero', 'mattia.b90@hotmail.it', 662079600, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:51:09'),
(73, '6', 'Lenmana', 'e358bf645a205cf15efa983b5517d945', 'Rebecca', 'Traverso', 'rebecca.traverso@hotmail.it', 847753200, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:52:13'),
(74, '6', 'Harlock', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Martina', 'saezzt@live.it', 481327200, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:52:45'),
(75, '6', 'Dulcis', '3477402667742da39c8e93bf4f30b271', 'Francesca', 'Bellino', 'francesca.bellino83@gmail.com', 425772000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:53:55'),
(76, '6', 'Vader', 'd1f9cc6dcce0518273c68f03cbbb51f8', 'Michelangelo', 'Repetto', 'michelangelo.repetto@gmail.com', 402534000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:54:33'),
(77, '6', 'Nergal', '5b1b4dee9103f759fdb57197a78780a6', 'Enrico', 'Giovanetti', 'exelion71@hotmail.it', 588808800, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:55:28'),
(78, '6', 'Sal-Ias', 'ff377aff39a9345a9cca803fb5c5c081', 'Luca', 'De Longis', 'lucadelongis@live.it', 415062000, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:56:40'),
(79, '6', 'Manzoni', '8a94bdfc825df46f880854f41fee346b', 'Michele', 'Esposito', 'spsmhl86@gmail.com', 507164400, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:57:19'),
(80, '6', 'Frank_Revenge', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Mossa', 'frankieromox@gmail.com', 489535200, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:58:00'),
(81, '6', 'Shura', 'dbc3ede8cf726a5f892a7808f647aa3e', 'Mattia', 'Pacino', 'muetts@hotmail.com', 378687600, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:58:46'),
(82, '6', 'Faurin', '0581938f0767a65b373cea80e905c25f', 'Francesco', 'Scaravelli', 'scaravelli.francesco@gmail.com', 548546400, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 16:59:26'),
(83, '6', 'Slevin', '0581938f0767a65b373cea80e905c25f', 'Francesco', 'Rovati', 'fra.rovati@fastwebnet.it', 420328800, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 17:00:11'),
(84, '6', 'Duddius', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Secondi', 'second92@hotmail.it', 701305200, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-27 17:01:17'),
(85, '6', 'Darksider', '51af78a02435124ebc225e570e533ac9', 'Alessandro', 'Cuocci', 'askaflowne@libero.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 11:56:24'),
(86, '6', 'davide', '446fca5553df49ad9c6348cf1ff71d51', 'Davide', 'Pedrazzoli', 'xpedra@alice.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 11:58:53'),
(87, '6', 'meg', '35623e2fb12281ddb6d7d5f63c5a29e3', 'Eleonora', 'Nalli', 'meg-86@hotmail.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:01:53'),
(88, '6', 'gianluca', '77aaddd8de3aadc90393716e4e2b3464', 'Gianluca', 'De Santis', 'gianluca.desantis@tiscali.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:02:52'),
(89, '6', 'giuliano', '189df91e921b376444241687a8fcdc2a', 'Giuliano', 'Golfieri', 'giuliano.golfieri@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:04:14'),
(90, '6', 'giuseppe', '353f9bfab2d01dbb1db343fdaf9ab02e', 'Giuseppe', 'Milani', 'giuseppemilani@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:05:29'),
(91, '6', 'niccolo', '2943299556db3aafd672a679cae153aa', 'Niccolò', 'Guerrini', 'niccolo.guerrini@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:06:42'),
(92, '6', 'rossana', 'd70fc2235d4c24e1ff36823e7fa7a916', 'Rossana', 'Valsecchi', 'rossanavals@facebook.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:11:25'),
(93, '6', 'simone', '47eb752bac1c08c75e30d9624b3e58b7', 'Simone', 'Li Vigni', 'simonelivigni@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:14:01'),
(94, '6', 'nix', '393b7e38038f12c5fb4c92e81a1b5a01', 'Stefano', 'Sora', 'lordatreides@libero.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:15:32'),
(95, '6', 'Yoda4ever', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea ', 'Guerrato', 'andreg1990@hotmail.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:57:23'),
(96, '6', 'Giorgio', '16cdae1dc8f5ccc69c51eea2851bff68', 'Giorgio', 'Santi', 'giorgio.1983@hotmail.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 12:58:47'),
(97, '6', 'Diego', '078c007bd92ddec308ae2f5115c1775d', 'Diego', 'Malatesta', 'diego.malatesta@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:07:20'),
(98, '6', 'Aria', '649b7e6ef5b75a95d166b8b266619494', 'Margherita', 'Frezza', 'margherita.frezza@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:08:27'),
(99, '5,6', 'Don', '317a58affea472972b63bffdd3392ae0', 'Stefano', 'Madama', 'stefano.madama@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:09:52'),
(100, '6', 'Viviana', '84248f04a5567607e949ab74b6ecbdae', 'Viviana', 'Massicut', 'erethria@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:13:42'),
(101, '6', 'Andreacarrà', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Carrà', 'carrandry@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:15:13'),
(102, '6', 'Cortellessa', '446fca5553df49ad9c6348cf1ff71d51', 'Davide', 'Cortellessa', 'cordavide@hotmail.it', 640303200, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:16:39'),
(103, '6', 'Anna', 'a70f9e38ff015afaa9ab0aacabee2e13', 'Anna', 'Diaz', 'anna.dzd@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:25:29'),
(104, '6', 'Mattia', 'dbc3ede8cf726a5f892a7808f647aa3e', 'Mattia', 'Galli', 'gm.lord.m@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:26:45'),
(105, '6', 'Viani', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Viani', 'viani.marco@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:57:37'),
(106, '6', 'sarda', '446fca5553df49ad9c6348cf1ff71d51', 'Davide', 'Sarda', 'davide.sarda@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:58:42'),
(107, '6', 'Stefaniello', '0bcd78cbe73a2a1a3c2ee731718d9d71', 'Teodoro', 'Stefaniello', 'teodoro.stefanello@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 13:59:48'),
(108, '6', 'Torrero', '7d6543d7862a07edf7902086f39b4b9a', 'Carlo', 'Torrero', 'carlotorrero1995@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:01:20'),
(109, '6', 'darrigo', 'd2462e55381a20059ed811cefd42493e', 'Alessio', 'D''Arrigo', 'gpdarrigo@inwind.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:02:55'),
(110, '6', 'Cafaro', '4cf34194f97afa90c0626574e99bfec7', 'Raffaele', 'Cafaro', 'rafcafaro@hotmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:04:02'),
(111, '6', 'panizza', '679ab793796da4cbd0dda3d0daf74ec1', 'Daniele', 'Panizza', 'daniele.panizza@hotmail.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:05:28'),
(112, '6', 'Jarekwishmaster', '177dacb14b34103960ec27ba29bd686b', 'Alberto', 'Vezzosi', 'jarekwishmaster@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:15:36'),
(113, '6', 'sara', '5bd537fc3789b5482e4936968f0fde95', 'Sara', 'Magnifico', 'prova@prova.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-08-28 14:22:55'),
(114, '6', 'Cecilia', 'd432eb18017c004fd305969713a17aa8', 'Cecilia ', 'Allgaier', 'cecilia.allgaier@gmail.com', -3600, 17, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:36:13'),
(115, '6', 'Gabrielespreafico', '8bc674f8b3278ec1de6112accd643b4f', 'Gabriele ', 'Spreafico', 'julii.caesar@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:37:50'),
(116, '6', 'Comunian', '078c007bd92ddec308ae2f5115c1775d', 'Diego', 'Comunian', 'diego.comunian@studenti.unimi.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:41:43'),
(117, '6', 'Bassani', 'fadf17141f3f9c3389d10d09db99f757', 'Elena ', 'Bassani', 'penpen@virgilio.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:42:54'),
(118, '6', 'salvatori', 'f76405ac130dac085b2a6249073b213b', 'Flavio ', 'Salvatori', 'flavio.s@tiscali.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:44:06'),
(119, '6', 'Mistura', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Mistura', 'giovaneduca@yahoo.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:45:09'),
(120, '6', 'parlavecchio', '649b7e6ef5b75a95d166b8b266619494', 'Margherita ', 'Parlavecchio', 'chiamatemismaele@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:46:22'),
(121, '6', 'salvotelli', '317a58affea472972b63bffdd3392ae0', 'Stefano', 'Salvotelli', 'ste.salvotelli@tiscali.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 08:58:10'),
(122, '6', 'Negretti', 'ab3ab964804dc9ae20de3b02d379b1bd', 'Valentina', 'Negretti', 'vale.ombra@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 09:05:09'),
(123, '6', 'Barozzini', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Barozzini', 'andrea.barozzini@gmail.com', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 09:06:18'),
(124, '6', 'rainer', '177dacb14b34103960ec27ba29bd686b', 'Alberto', 'Rainer', 'rainertaste@hotmail.com', -3600, 15, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-01 09:10:51'),
(125, '6', 'Ferrarini', '078c007bd92ddec308ae2f5115c1775d', 'Diego', 'Ferrarini', 'prova2@prova.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:38:16'),
(126, '6', 'pasetti', '86e32b59e149100cfe0636143e8e48de', 'Samuele', 'Pasetti', 'prova3@prova.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:41:50'),
(127, '4,5,6', 'Catilina', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Bruno', 'catilina@mclink.it', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:47:06'),
(128, '5,6', 'Pagani', '8f91bdb4de0142710ac1718345b96308', 'Ernesto', 'Pagani', 'ernesto.pagani@tiscali.it', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:53:11'),
(129, '6', 'Viola', '627ff2d71412e17a4d8b03838b4f747d', 'Jacopo', 'Viola', 'jacopo-94@libero.it', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:54:33'),
(130, '6', 'caporelli', '51af78a02435124ebc225e570e533ac9', 'Alessandro', 'Caporelli', 'alessandro.capo@hotmail.it', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:55:49'),
(131, '6', 'sansoni', '51af78a02435124ebc225e570e533ac9', 'Alessandro', 'Sansoni', 'alesan77@gmail.com', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:56:58'),
(132, '6', 'daddosio', '6ab7ec99b6aa105aeab1acde2019b125', 'Kok ', 'D''Addosio', 'no@no.it', -3600, 11, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 14:58:42'),
(133, '6', 'nervo', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Nervo', 'no2@no.it', -3600, 6, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 15:00:19'),
(134, '6', 'zappulla', '4a181673429f0b6abbfd452f0f3b5950', 'Antonio', 'Zappulla', 'a.za@email.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 15:20:54'),
(135, '6', 'Ugrote', '150be5b860e60a7fc7c7d9b9815e93d1', 'Matteo', 'Ugrote', 'info@ugrote.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 15:23:44'),
(136, '6', 'Cesana', '314e1391e7d4bc6ca63e70f04d5c3d10', 'Eugenio', 'Cesana', 'eugenio.cesana@gmail.com', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:19:25'),
(137, '6', 'Mirko', '13592f2caf86af30572a825229a2a8dc', 'Mirko', 'Ferrari', 'mirko.ferrari@outlook.it', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:20:45'),
(138, '6', 'Longoni', 'd8ae5776067290c4712fa454006c8ec6', 'Samuel', 'Longoni', 'sammywindu98@gmail.com', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:22:04'),
(139, '6', 'Pedrocchi', '47eb752bac1c08c75e30d9624b3e58b7', 'Simone', 'Pedrocchi', 'simone.pedrocchi@libero.it', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:23:30'),
(140, '6', 'Colombo', '627ff2d71412e17a4d8b03838b4f747d', 'Jacopo', 'Colombo', 'colombo.jacopo.cj@gmail.com', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:25:18'),
(141, '6', 'Deleo', '4c61cb1773ec5d477f47835b345ad994', 'Gaetano', 'De Leo', 'mrway80@gmail.com', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:27:35'),
(142, '6', 'Poletti', '0581938f0767a65b373cea80e905c25f', 'Francesco', 'Poletti', 'peffe@inwind.it', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:29:22'),
(143, '6', 'Poletti2', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Poletti', 'marco.poletti.1981@gmail.com', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:30:30'),
(144, '6', 'Poletti3', '649b7e6ef5b75a95d166b8b266619494', 'Margherita', 'Poletti', 'marghe95_19@libero.it', -3600, 16, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-02 16:31:45'),
(145, '6', 'mad max', '8cac5ac44b51f182143a43c4cdb6c4ac', 'Massimo', 'Bruna', 'brunamassimo@yahoo.it', 128818800, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:18:37'),
(146, '6', 'Miglino', 'c3875d07f44c422f3b3bc019c23e16ae', 'Denis', 'Miglino', 'miglinodenis@gmail.com', 650498400, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:20:58'),
(147, '6', 'Battaglino', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Battaglino', 'write.marco.battaglino@gmail.com', 485042400, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:22:08'),
(148, '6', 'Colotti', '77aaddd8de3aadc90393716e4e2b3464', 'Gianluca', 'Colotti', 'colottig@gmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:23:28'),
(149, '6', 'Munteanu', '36388794be2cf5f298978498ff3c64a2', 'Angela', 'Munteanu', 'coca.munteanu@libero.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:24:53'),
(150, '6', 'Bocco', '1c42f9c1ca2f65441465b43cd9339d6c', 'Andrea', 'Bocco', 'ignis22@live.it', 708559200, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:26:07'),
(151, '6', 'Cucchi', 'dd1a3f84b837f51d1ea2ac1278edfe0b', 'Domenico', 'Cucchi', 'darkfire77777@hotmail.com', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:27:12'),
(152, '6', 'Pavese', '22a3d92dfcfc5b9d13b553d2d6ffc746', 'Carlotta', 'Pavese', 'carlotta95@fastwebnet.it', -3600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:28:18'),
(153, '6', 'dellacqua', '177dacb14b34103960ec27ba29bd686b', 'Alberto', 'Dell''Acqua', 'cacamo.antonella@tiscali.it', 915577200, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:29:32'),
(154, '6', 'Ercole', 'dcc4ed45e6d3fb1c13044163a464b44a', 'Giacomo', 'Ercole', 'giacomo.ercole@gmail.com', 668905200, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:31:16'),
(155, '6', 'Girolami', '8a94bdfc825df46f880854f41fee346b', 'Michele', 'Girolami', 'giancarlo.girolami@libero.it', 848271600, 7, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-03 08:32:22'),
(156, '6', 'Biondi', '317a58affea472972b63bffdd3392ae0', 'Stefano', 'Biondi', 'prova4@prova.it', 304034400, 18, 10, 2, NULL, NULL, 'no_avatar.jpg', 'A', 2, '2014-09-04 10:06:40'),
(157, '5', 'teacher', '202cb962ac59075b964b07152d234b70', 'Try', 'Try', 'try@g.it', 631148400, 6, 10, 2, 'Milano', NULL, 'no_avatar.jpg', 'A', 2, '2014-09-08 10:26:10');

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
 ADD PRIMARY KEY (`id`), ADD KEY `student_master_id` (`student_master_id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=672;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `systemsettings`
--
ALTER TABLE `systemsettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=158;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
ADD CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`student_master_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
