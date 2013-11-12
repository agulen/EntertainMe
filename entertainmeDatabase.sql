-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2013 at 11:03 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `entertainme`
--
CREATE DATABASE IF NOT EXISTS `entertainme` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `entertainme`;

-- --------------------------------------------------------

--
-- Table structure for table `done`
--

CREATE TABLE IF NOT EXISTS `done` (
  `username` varchar(255) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`entertainment_id`),
  KEY `username` (`username`),
  KEY `entertainment_id` (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `done`
--

INSERT INTO `done` (`username`, `entertainment_id`) VALUES
('holly', 6),
('altan ', 9);

-- --------------------------------------------------------

--
-- Table structure for table `entertainment`
--

CREATE TABLE IF NOT EXISTS `entertainment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `entertainment`
--

INSERT INTO `entertainment` (`id`, `title`, `description`, `type`) VALUES
(5, 'Inception', 'Dude breaks into minds.', 'movie'),
(6, 'Harry Potter and the Sorcerer''s Stone', 'Wizard likes rocks', 'book'),
(7, 'Let It Be', 'Don''t do anything', 'music'),
(8, 'How I Met Your Mother', 'Father meets your mother', 'tv'),
(9, 'Portal', 'Shoot walls.', 'videogame');

-- --------------------------------------------------------

--
-- Table structure for table `later`
--

CREATE TABLE IF NOT EXISTS `later` (
  `username` varchar(255) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`entertainment_id`),
  KEY `username` (`username`),
  KEY `entertainment_id` (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entertainment to consume later';

--
-- Dumping data for table `later`
--

INSERT INTO `later` (`username`, `entertainment_id`) VALUES
('jed', 8),
('wow', 9);

-- --------------------------------------------------------

--
-- Table structure for table `now`
--

CREATE TABLE IF NOT EXISTS `now` (
  `username` varchar(255) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`entertainment_id`),
  KEY `username` (`username`),
  KEY `entertainment_id` (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of entertainment to consume now';

--
-- Dumping data for table `now`
--

INSERT INTO `now` (`username`, `entertainment_id`) VALUES
('altan ', 5),
('drew', 6);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `username` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mapping users to user types (user types = admin, normal, and banned)';

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`username`, `usertype`) VALUES
('altan', 'admin'),
('drew', 'banned'),
('holly', 'normal'),
('jed', 'normal'),
('wow', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Handles user logins. ';

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`username`, `password`, `salt`) VALUES
('altan ', 'password', ''),
('drew', 'password', ''),
('holly', 'password', ''),
('jed', 'password', ''),
('wow', 'password', '');

-- --------------------------------------------------------

--
-- Table structure for table `usersettings`
--

CREATE TABLE IF NOT EXISTS `usersettings` (
  `username` varchar(255) NOT NULL,
  `books` tinyint(1) NOT NULL,
  `movies` tinyint(1) NOT NULL,
  `music` tinyint(1) NOT NULL,
  `videogames` tinyint(1) NOT NULL,
  `tv` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maps users to the entertainment types they desire';

--
-- Dumping data for table `usersettings`
--

INSERT INTO `usersettings` (`username`, `books`, `movies`, `music`, `videogames`, `tv`) VALUES
('altan ', 1, 1, 1, 1, 1),
('drew', 1, 1, 1, 1, 0),
('holly', 1, 1, 1, 0, 1),
('jed ', 1, 1, 1, 0, 1),
('wow', 0, 0, 1, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `done`
--
ALTER TABLE `done`
  ADD CONSTRAINT `done_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`),
  ADD CONSTRAINT `done_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

--
-- Constraints for table `later`
--
ALTER TABLE `later`
  ADD CONSTRAINT `later_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`),
  ADD CONSTRAINT `later_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

--
-- Constraints for table `now`
--
ALTER TABLE `now`
  ADD CONSTRAINT `now_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`),
  ADD CONSTRAINT `now_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

--
-- Constraints for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD CONSTRAINT `usersettings_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
