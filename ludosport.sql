-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2014 at 05:29 PM
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
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `academies`
--

INSERT INTO `academies` (`id`, `rector_id`, `en_academy_name`, `it_academy_name`, `type`, `contact_firstname`, `contact_lastname`, `association_fullname`, `role_referent`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(1, '3,5', 'Poppey Sailor Man', 'Poppey Sailor Man', 'ac', 'Soyab', 'Rana', 'PSM', 'Poppeyyyyyyyyyy Sailorrrrrrrrrrr Mannnnnnnnnnnnnnnnn', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 08:45:52'),
(2, '3', 'Dexter Laboratory', 'Dexter Laboratory', 'ac', 'Soyab', 'Rana', 'PSM', 'Temparory', 'Baroda', '390016', 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 11:22:54');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
`id` int(11) NOT NULL,
  `en_level_name` varchar(65) NOT NULL,
  `it_level_name` varchar(65) NOT NULL,
  `is_basic` enum('0','1') NOT NULL DEFAULT '0',
  `under_sixteen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `en_level_name`, `it_level_name`, `is_basic`, `under_sixteen`) VALUES
(1, '1st Yedi', '1st Yedi', '1', '1'),
(2, '2st Yedi', '2st Yedi', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `notify_type` enum('rector_assign_academy','dean_assign_school','teacher_assign_class') NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notify_type`, `from_id`, `to_id`, `object_id`, `status`, `timestamp`) VALUES
(1, 'rector_assign_academy', 2, 3, 1, 0, '2014-07-25 08:45:52'),
(2, 'rector_assign_academy', 2, 5, 1, 0, '2014-07-25 08:45:52'),
(5, 'dean_assign_school', 2, 3, 0, 0, '2014-07-25 10:49:30'),
(6, 'rector_assign_academy', 2, 3, 2, 0, '2014-07-25 11:22:55');

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
(2, 'Admin', 'Admin', 'a:9:{s:5:"roles";a:4:{i:0;s:8:"viewRole";i:1;s:7:"addRole";i:2;s:8:"editRole";i:3;s:10:"deleteRole";}s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:4:{i:0;s:11:"viewAcademy";i:1;s:10:"addAcademy";i:2;s:11:"editAcademy";i:3;s:13:"deleteAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:6:"levels";a:4:{i:0;s:9:"viewLevel";i:1;s:8:"addLevel";i:2;s:9:"editLevel";i:3;s:11:"deleteLevel";}s:5:"clans";a:5:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";}s:9:"countries";a:4:{i:0;s:11:"viewCountry";i:1;s:10:"addCountry";i:2;s:11:"editCountry";i:3;s:13:"deleteCountry";}s:6:"states";a:4:{i:0;s:10:"viewStates";i:1;s:9:"addStates";i:2;s:10:"editStates";i:3;s:12:"deleteStates";}s:6:"cities";a:4:{i:0;s:8:"viewCity";i:1;s:7:"addCity";i:2;s:8:"editCity";i:3;s:10:"deleteCity";}}', '0', 1, '2014-07-17 07:27:03'),
(3, 'Rector', 'Rettore', 'a:4:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:4:{i:0;s:10:"viewSchool";i:1;s:9:"addSchool";i:2;s:10:"editSchool";i:3;s:12:"deleteSchool";}s:5:"clans";a:5:{i:0;s:8:"viewClan";i:1;s:7:"addClan";i:2;s:8:"editClan";i:3;s:10:"deleteClan";i:4;s:15:"clanTeacherList";}}', '0', 2, '2014-07-17 10:13:22'),
(4, 'Dean', 'Decano', 'a:4:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}s:5:"clans";a:2:{i:0;s:8:"viewClan";i:1;s:15:"clanTeacherList";}}', '0', 2, '2014-07-17 10:13:43'),
(5, 'Teacher', 'Insegnante', 'a:3:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}}', '0', 2, '2014-07-17 10:16:50'),
(6, 'Student', 'Studente', 'a:3:{s:5:"users";a:4:{i:0;s:8:"viewUser";i:1;s:7:"addUser";i:2;s:8:"editUser";i:3;s:10:"deleteUser";}s:9:"academies";a:1:{i:0;s:11:"viewAcademy";}s:7:"schools";a:1:{i:0;s:10:"viewSchool";}}', '0', 1, '2014-07-17 10:17:08');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `academy_id`, `dean_id`, `en_school_name`, `it_school_name`, `address`, `postal_code`, `city_id`, `state_id`, `country_id`, `phone_1`, `phone_2`, `email`, `user_id`, `timestamp`) VALUES
(0, 1, '3', 'Poppey', 'Poppey', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 10:49:30'),
(0, 2, '3', 'Dexter', 'Dexter', 'Baroda', 390016, 1, 1, 1, '91987654321', '91987654321', 'demo@yopmail.com', 2, '2014-07-25 11:23:56');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `en_name`, `it_name`, `user_id`, `timestamp`) VALUES
(1, 1, 'Gujarat', 'Gujarat', 1, '2014-07-17 07:12:28'),
(2, 1, 'Mumbai', '', 1, '2014-07-17 07:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
`id` int(11) NOT NULL,
  `student_master_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `clan_id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `permission` longtext,
  `status` enum('A','D','P') NOT NULL DEFAULT 'P',
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `city_id`, `permission`, `status`, `user_id`, `timestamp`) VALUES
(1, '1', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Soyab', 'Rana', 'soyab@blackidsolutions.com', 1990, 0, NULL, 'A', 0, '2014-07-17 07:05:53'),
(2, '2', 'admin', '202cb962ac59075b964b07152d234b70', 'Admin', 'James', 'admin@admin.com', 1990, 1, NULL, 'A', 0, '2014-07-17 07:28:01'),
(3, '3,4,5', 'rector_1', '202cb962ac59075b964b07152d234b70', 'Rector', '1', 'rector1@rector.com', -19800, 1, NULL, 'A', 2, '2014-07-17 07:28:01'),
(4, '4', 'dean_1', '202cb962ac59075b964b07152d234b70', 'Dean', '1', 'dean@dean.com', 1990, 1, NULL, 'A', 0, '2014-07-17 07:28:01'),
(5, '5,3', 'teacher_1', '202cb962ac59075b964b07152d234b70', 'Teacher', '1', 'teacher1@teacher.com', 653682600, 2, NULL, 'A', 1, '2014-07-21 10:11:41'),
(6, '3', 'rector_2', '202cb962ac59075b964b07152d234b70', 'Rector', '2', 'rector2@rector.com', -19800, 1, NULL, 'A', 2, '2014-07-17 07:28:01'),
(7, '5', 'teacher_2', '202cb962ac59075b964b07152d234b70', 'Teacher', '2', 'teacher2@teacher.com', 653682600, 2, NULL, 'A', 1, '2014-07-21 10:11:41'),
(8, '5', 'teacher_3', '202cb962ac59075b964b07152d234b70', 'Teacher', '3', 'teacher3@teacher.com', 653682600, 2, NULL, 'A', 1, '2014-07-21 10:11:41'),
(9, '6', 'u1', '202cb962ac59075b964b07152d234b70', 'User', '1', 'user@user.com', 653682600, 2, NULL, 'P', 1, '2014-07-21 10:11:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
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
-- Indexes for table `levels`
--
ALTER TABLE `levels`
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
-- Indexes for table `states`
--
ALTER TABLE `states`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
