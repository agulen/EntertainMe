-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2013 at 03:17 AM
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
('Holly', 8),
('Holly', 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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
('Holly', 6);

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
('Holly', 5),
('Holly', 7);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Handles user logins. ';

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`username`, `password`, `salt`, `is_admin`, `is_banned`) VALUES
('AdminTest', '3da48a6cd4445e43c8db470dfe4c1a67b09fe57e55c52716dcfa165880dd0fc1', 'a2aa2a09addec30a1dbb03d94d0b7ddd406b65b47500d9dca693afcd36cf3d95', 1, 0),
('Holly', 'f842c158fec362a64cbb9f93230de9c175b788b990ce463c3eda14f46b4bf7b0', 'c7558be8a23abba3c6bea0804f49e4e6eaac72653e961c8fe0bd843e58792ed9', 0, 0);

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
('Holly', 1, 1, 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `done`
--
ALTER TABLE `done`
  ADD CONSTRAINT `done_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`),
  ADD CONSTRAINT `done_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`);

--
-- Constraints for table `later`
--
ALTER TABLE `later`
  ADD CONSTRAINT `later_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`),
  ADD CONSTRAINT `later_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`);

--
-- Constraints for table `now`
--
ALTER TABLE `now`
  ADD CONSTRAINT `now_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`),
  ADD CONSTRAINT `now_ibfk_2` FOREIGN KEY (`entertainment_id`) REFERENCES `entertainment` (`id`);

--
-- Constraints for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD CONSTRAINT `usersettings_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
