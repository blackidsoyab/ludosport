-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2014 at 01:44 PM
-- Server version: 5.5.37
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Vadodara', '', 1, '2014-07-17 07:14:07'),
(2, 1, 'Ahemedabad', '', 1, '2014-07-17 07:14:14'),
(3, 2, 'Andheri East ', '', 1, '2014-07-17 07:15:15'),
(4, 2, 'Church Gate', '', 1, '2014-07-17 07:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 'India', 'India', 1, '2014-07-17 07:11:46'),
(2, 'Italy', 'Italy', 1, '2014-07-17 07:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_perm_name` varchar(65) NOT NULL,
  `it_perm_name` varchar(65) DEFAULT NULL,
  `controller` varchar(65) NOT NULL,
  `method` varchar(65) NOT NULL,
  `is_menu` int(1) NOT NULL DEFAULT '0',
  `en_menu_title` varchar(30) DEFAULT NULL,
  `it_menu_title` varchar(30) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_role_name` varchar(65) NOT NULL,
  `it_role_name` varchar(65) DEFAULT NULL,
  `permission` longtext,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `en_role_name`, `it_role_name`, `permission`, `user_id`, `timestamp`) VALUES
(1, 'Super Admin', 'Super Amministratore', NULL, 0, '2014-07-17 07:04:55'),
(2, 'Administrator', 'Amministratore', 'a:3:{s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:10:"viewStates";i:1;s:9:"addStates";i:2;s:10:"editStates";i:3;s:12:"deleteStates";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}}', 1, '2014-07-17 07:27:03'),
(3, 'Dean', 'Dean', 'a:3:{s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:2:{i:0;s:10:"viewStates";i:1;s:9:"addStates";}s:6:"cities";a:2:{i:0;s:8:"viewCity";i:1;s:7:"addCity";}}', 1, '2014-07-17 10:13:22'),
(4, 'Principal', 'Principal', 'a:3:{s:9:"countries";a:1:{i:0;s:11:"viewCountry";}s:6:"states";a:1:{i:0;s:10:"viewStates";}s:6:"cities";a:1:{i:0;s:8:"viewCity";}}', 1, '2014-07-17 10:13:43'),
(5, 'Instructor', 'Instructor', NULL, 1, '2014-07-17 10:16:50'),
(6, 'Student', 'Student', NULL, 1, '2014-07-17 10:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `en_name` varchar(65) NOT NULL,
  `it_name` varchar(65) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Gujarat', 'Gujarat', 1, '2014-07-17 07:12:28'),
(2, 1, 'Mumbai', '', 1, '2014-07-17 07:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `date_of_birth` date NOT NULL,
  `city_id` int(11) NOT NULL,
  `permission` longtext,
  `status` enum('A','D','P') NOT NULL DEFAULT 'P',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `permission`, `status`, `timestamp`) VALUES
(1, 1, 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'soyab@blackidsolutions.com', '1990-09-19', 0, NULL, 'A', '2014-07-17 07:05:53'),
(2, 2, 'admin', '202cb962ac59075b964b07152d234b70', 'Administrator', '.', 'admin@ludosport.com', '1990-09-19', 1, NULL, 'A', '2014-07-17 07:28:01'),
(3, 3, 'dean', '202cb962ac59075b964b07152d234b70', 'Dean', '.', 'dean@ludosport.com', '1990-09-19', 1, NULL, 'A', '2014-07-17 07:28:01'),
(4, 4, 'principal', '202cb962ac59075b964b07152d234b70', 'Principal', '.', 'principal@ludosport.com', '1990-09-19', 1, NULL, 'A', '2014-07-17 07:28:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
