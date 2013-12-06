-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2013 at 01:36 AM
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
('Holly', 9),
('regular', 10),
('regular', 12),
('regular', 14),
('regular', 16),
('admin', 17),
('admin', 18),
('regular', 18),
('admin', 19),
('regular', 33),
('regular', 44);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `entertainment`
--

INSERT INTO `entertainment` (`id`, `title`, `description`, `type`) VALUES
(5, 'Inception', 'A skilled extractor is offered a chance to regain his old life as payment for a task considered to be impossible.', 'movie'),
(6, 'Harry Potter and the Sorcerer''s Stone', 'Rescued from the outrageous neglect of his aunt and uncle, a young boy with a great destiny proves his worth while attending Hogwarts School of Witchcraft and Wizardry.', 'book'),
(7, 'Let It Be', 'A song by the Beatles, released in March 1970 as a single.', 'music'),
(8, 'How I Met Your Mother', 'Ted searches for the woman of his dreams in New York City with the help of his four best friends.', 'tv'),
(9, 'Portal', 'A game that involves using a tool that creates 2-way portals to solve puzzles', 'game'),
(10, 'The Avengers', 'Nick Fury of S.H.I.E.L.D. assembles a team of superhumans to save the planet from Loki and his army.', 'movie'),
(11, 'Django Unchained', 'With the help of a German bounty hunter, a freed slave sets out to rescue his wife from a brutal Mississippi plantation owner.', 'movie'),
(12, 'The Facebook Effect', 'Veteran technology reporter David Kirkpatrick had the full cooperation of Facebook&#8217;s key executives in researching this fascinating history of the company and its impact on our lives.', 'book'),
(13, 'Ready Player One', 'Like most of humanity, Wade Watts escapes his grim surroundings by spending his waking hours jacked into the OASIS, a sprawling virtual utopia that lets you be anything you want to be, a place where you can live and play and fall in love.', 'book'),
(14, 'Lose Yourself', 'A song by the American hip-hop artist Eminem, released as the first single from the original soundtrack to his movie 8 Mile in August 2002.', 'music'),
(15, 'Wake Me Up', 'A song by Swedish DJ and music producer Avicii, which features uncredited vocals from American soul singer Aloe Blacc and acoustic guitar from Incubus'' Mike Einziger', 'music'),
(16, 'Mario Kart 64', 'A Mario racing game developed and published by Nintendo for the Nintendo 64 video game console. Mamma mia!', 'game'),
(17, 'The Legend of Zelda: Ocarina of Time', 'A 1998 action-adventure video game developed by Nintendo''s Entertainment Analysis and Development division for the Nintendo 64 video game console', 'game'),
(18, '24', 'A serial drama which stars Kiefer Sutherland as Jack Bauer, focusing on the efforts of the fictional Counter Terrorist Unit', 'tv'),
(19, 'Game of Thrones', 'An American fantasy drama television series created for HBO by David Benioff and D. B. Weiss. It is an adaptation of A Song of Ice and Fire, George R. R. Martin''s series of fantasy novels.', 'tv'),
(20, 'The Sandlot', 'Scotty Smalls moves to a new neighborhood with his mom and stepdad, and wants to learn to play baseball. ', 'movie'),
(21, 'The Hunger Games', 'A 2008 science fiction novel by the American writer Suzanne Collins. It is written in the voice of 16-year-old Katniss Everdeen, who lives in the dystopian, post-apocalyptic nation of Panem in North America.', 'book'),
(22, 'Dream On', 'Aerosmith''s first major hit released in 1973. ', 'music'),
(23, 'The Office', 'A popular mockumentary/cringe comedy sitcom that was first made in the United Kingdom and has now been remade in many other countries, with overall viewership in the hundreds of millions worldwide.', 'tv'),
(24, 'Captain Phillips', 'The true story of Captain Richard Phillips and the 2009 hijacking by Somali pirates of the US-flagged MV Maersk Alabama, the first American cargo ship to be hijacked in two hundred years.', 'movie'),
(25, 'Ender''s Game', 'Ender''s Game (1985) is a military science fiction novel by American author Orson Scott Card. Set in Earth''s future, the novel presents an imperiled mankind after two conflicts with the "Buggers", an insectoid alien species.', 'book'),
(26, 'And We Danced', 'Macklemore dance party song', 'music'),
(27, 'SportsCenter', 'SportsCenter is a daily sports news television program, and the flagship program of American cable and satellite television network ESPN', 'tv'),
(28, 'Jak and Daxter', 'A story-based platformer, which include many puzzles and platform elements, in conjunction with avoiding enemies created by Naughty Dog Inc.', 'game'),
(29, 'The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'movie'),
(30, 'The Godfather', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'movie'),
(31, 'Pulp Fiction', 'The lives of two mob hit men, a boxer, a gangster''s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'movie'),
(32, 'The Dark Knight', 'When Batman, Gordon and Harvey Dent launch an assault on the mob, they let the clown out of the box, the Joker, bent on turning Gotham on itself and bringing any heroes down to his level.', 'movie'),
(33, 'Schindler''s List', 'In Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', 'movie'),
(34, 'The Boy in the Striped Pajamas', 'Sad movie about the holocaust. ', 'movie'),
(43, 'The Titanic', 'Cruise ends badly. ', 'movie'),
(44, 'The Hunger Games: Catching Fire', 'Some girl caught on fire. ', 'movie');

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
('regular', 5),
('Holly', 6),
('regular', 6),
('regular', 7),
('regular', 8),
('regular', 9),
('admin', 12),
('admin', 13),
('admin', 14),
('admin', 15),
('regular', 24),
('regular', 31),
('regular', 32);

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
('admin', 5),
('Altan2', 5),
('Holly', 5),
('admin', 6),
('admin', 7),
('Holly', 7),
('admin', 8),
('Altan2', 8),
('admin', 9),
('admin', 10),
('admin', 11),
('regular', 13),
('regular', 19),
('regular', 21),
('regular', 22),
('regular', 23),
('regular', 28),
('regular', 29);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Handles user logins. ';

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`username`, `password`, `salt`, `is_admin`) VALUES
('admin', '30b821b232925780c9ba25b2a0fc30ec14ee73edb3d6e3c5d77f39dc94a3f09e', 'd64b00e41973112202093a389fe4a3028e8a8d0d916d6c3ba8d21a75cdd85cf9', 1),
('AdminTest', '3da48a6cd4445e43c8db470dfe4c1a67b09fe57e55c52716dcfa165880dd0fc1', 'a2aa2a09addec30a1dbb03d94d0b7ddd406b65b47500d9dca693afcd36cf3d95', 1),
('Altan', '33c46e04817f720759cdc086318a87209c9390e698c3126ca7592e82a853c0d2', 'e93250d3535d19564b7a96612ee2bc5e1719719b21b93d78d3838c1bf31d1448', 1),
('Altan2', '997a0dc02bed5e1770e041ea0206da81977148cd1693a2fc5327f31fa55b0004', 'ce1fb4e680d4ecf65d3b012f9c6ffe9d1bbcf07929883c5e17d01497cdc5bc6a', 0),
('Holly', 'f842c158fec362a64cbb9f93230de9c175b788b990ce463c3eda14f46b4bf7b0', 'c7558be8a23abba3c6bea0804f49e4e6eaac72653e961c8fe0bd843e58792ed9', 0),
('regular', 'e42779547cd55030db6b34c7ad54c7167ac77281cabddfef748ea8a37f1e57ec', '81614de455d36e42656e8759e7caf7523e20450252190544d520d9a5c87d6fcc', 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
