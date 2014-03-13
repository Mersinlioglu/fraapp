-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Mrz 2014 um 21:11
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fraapp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aircraft_type`
--

DROP TABLE IF EXISTS `aircraft_type`;
CREATE TABLE `aircraft_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `estimated_operation_time_id` int(11) NOT NULL,
  `ground_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `aircraft_type`
--

REPLACE INTO `aircraft_type` (`id`, `name`, `estimated_operation_time_id`, `ground_time`) VALUES
(1, 'A319', 1, 50),
(2, 'A320', 1, 50),
(3, 'A321', 1, 50),
(4, 'B737', 1, 50),
(5, 'A340', 2, 70),
(6, 'A330', 2, 70);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `delay_code`
--

DROP TABLE IF EXISTS `delay_code`;
CREATE TABLE `delay_code` (
  `opid` int(11) NOT NULL,
  `cod1` varchar(5) DEFAULT NULL,
  `min1` int(11) DEFAULT NULL,
  `cod2` varchar(5) NOT NULL,
  `min2` int(11) NOT NULL,
  `cod3` varchar(5) NOT NULL,
  `min3` int(11) NOT NULL,
  `cod4` varchar(5) NOT NULL,
  `min4` int(11) NOT NULL,
  PRIMARY KEY (`opid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `delay_code`
--

REPLACE INTO `delay_code` (`opid`, `cod1`, `min1`, `cod2`, `min2`, `cod3`, `min3`, `cod4`, `min4`) VALUES
(0, 'km', 2, 'oo', 4, 'pp', 6, 'gg', 8),
(26, 'lkj', 2, 'lkj', 3, 'lkj', 3, 'lkj', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `estimated_operation_time`
--

DROP TABLE IF EXISTS `estimated_operation_time`;
CREATE TABLE `estimated_operation_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` int(11) NOT NULL,
  `gettingout_passangers` int(11) NOT NULL,
  `cleaning` int(11) NOT NULL,
  `security_check` int(11) NOT NULL,
  `boarding_business` int(11) NOT NULL,
  `boarding_economy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `estimated_operation_time`
--

REPLACE INTO `estimated_operation_time` (`id`, `duration`, `gettingout_passangers`, `cleaning`, `security_check`, `boarding_business`, `boarding_economy`) VALUES
(1, 50, 15, 10, 6, 3, 9),
(2, 70, 20, 10, 10, 5, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `flight`
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE `flight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `departure_time` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `flight`
--

REPLACE INTO `flight` (`id`, `code`, `departure_time`) VALUES
(1, 'TK1598', '07:40'),
(2, 'TK1620', '07:45'),
(3, 'TK1588', '11:45'),
(4, 'TK1592', '15:08'),
(5, 'TK1618', '15:25'),
(6, 'TK1594', '18:20');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `aircrafttype_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `before_flight_check_time` int(11) NOT NULL,
  `onblock` int(11) NOT NULL,
  `door_opened` int(11) NOT NULL,
  `gettingout_passangers` int(11) NOT NULL,
  `cleaning` int(11) NOT NULL,
  `security_check` int(11) NOT NULL,
  `boarding_business` int(11) NOT NULL,
  `boarding_economy` int(11) NOT NULL,
  `doors_closed` int(11) NOT NULL,
  `bagage_doors_closed` int(11) NOT NULL,
  `pushback` int(11) NOT NULL,
  `erp_entry_done` int(11) NOT NULL,
  `op_error_log` text NOT NULL,
  `cabin_config_ccl` int(11) DEFAULT NULL,
  `cabin_config_ycl` int(11) DEFAULT NULL,
  `cabin_config_tcl` int(11) DEFAULT NULL,
  `cabin_pax_ccl` int(11) DEFAULT NULL,
  `cabin_pax_ycl` int(11) DEFAULT NULL,
  `cabin_pax_tcl` int(11) DEFAULT NULL,
  `cabin_lf` int(11) DEFAULT NULL,
  `cabin_inf` int(11) DEFAULT NULL,
  `cabin_id_dz` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `flight_id` (`flight_id`),
  KEY `aircrafttype_id` (`aircrafttype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `operation`
--

REPLACE INTO `operation` (`id`, `user_id`, `flight_id`, `aircrafttype_id`, `registration_id`, `before_flight_check_time`, `onblock`, `door_opened`, `gettingout_passangers`, `cleaning`, `security_check`, `boarding_business`, `boarding_economy`, `doors_closed`, `bagage_doors_closed`, `pushback`, `erp_entry_done`, `op_error_log`, `cabin_config_ccl`, `cabin_config_ycl`, `cabin_config_tcl`, `cabin_pax_ccl`, `cabin_pax_ycl`, `cabin_pax_tcl`, `cabin_lf`, `cabin_inf`, `cabin_id_dz`) VALUES
(1, 4, 3, 1, 0, 1389469321, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 6, 4, 1, 0, 1389469463, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 7, 5, 1, 0, 1389469739, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 8, 5, 1, 0, 1389476072, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 7, 2, 4, 0, 1389636969, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 1, 1, 0, 1389642355, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 6, 1, 1, 0, 1389808598, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 6, 4, 1, 0, 1389809228, 1389819674, 1389819675, 1389819677, 1389819678, 1389819679, 1389819680, 1389819681, 1389819681, 0, 1389819684, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 5, 2, 1, 0, 1389820058, 1389820066, 1389820066, 1389820067, 1389820068, 1389820068, 1389820069, 1389820069, 1389820070, 0, 1389820073, 1389821749, 'kmkmkmkmkmkm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 5, 2, 1, 0, 1389965880, 1389965888, 1389965892, 1389965894, 1389965897, 1389965898, 1389965899, 1389965900, 1389965900, 0, 1389965902, 1389965918, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 4, 4, 0, 1390396618, 1390396759, 1390396770, 1390396774, 1390396776, 1390396776, 1390396777, 1390396777, 1390396778, 1390396778, 1390396779, 1390396784, 'blablablablablablablablablabla.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 1, 1, 0, 1390402781, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 1, 1, 0, 1390402805, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 1, 0, 1390402848, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 1, 1, 0, 1390402914, 1390403128, 1390403129, 1390403129, 1390403130, 1390403130, 1390403130, 1390403131, 1390403132, 1390403132, 1390403134, 1390404421, 'asdafsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 1, 1, 0, 1390404472, 1390404474, 1390404475, 1390404475, 1390404476, 1390404476, 1390404477, 1390404478, 1390404478, 1390404479, 1390404479, 1390404482, 'asdasdad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 1, 1, 0, 1390404502, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 8, 1, 1, 0, 1391365782, 1391365784, 1391365785, 1391365785, 1391365786, 1391365786, 1391365787, 1391365788, 1391365789, 1391365789, 1391365790, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 8, 1, 1, 1, 1391469845, 1391469855, 1391469856, 1391469856, 1391469857, 1391469857, 1391469858, 1391469858, 1391469859, 1391469859, 1391469860, 1391470009, 'dfsdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 8, 1, 1, 1, 1391470646, 1391470648, 1391470649, 1391470649, 1391470650, 1391470650, 1391470651, 1391470651, 1391470651, 1391470652, 1391470652, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 6, 1, 1, 1, 1392103644, 1392103646, 1392103647, 1392103647, 1392103648, 1392103648, 1392103649, 1392103649, 1392103651, 1392103651, 1392103653, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 8, 1, 1, 1, 1393693388, 1393693393, 1393693394, 1393693394, 1393693395, 1393693395, 1393693396, 1393693397, 1393693397, 1393693399, 1393693399, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 8, 1, 1, 1, 1393694082, 1393694084, 1393694085, 1393694086, 1393694087, 1393694088, 1393694088, 1393694089, 1393694090, 1393694091, 1393694091, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 8, 1, 1, 1, 1393696921, 1393696928, 1393696932, 1393696939, 1393696944, 1393696944, 1393696945, 1393696945, 1393696946, 1393696947, 1393696947, 1393697311, 'lkjölkajsdöflakjsdölfkj', 16, 164, 180, 9, 155, 164, NULL, 1, 3),
(25, 8, 1, 1, 1, 1393766352, 1393766356, 1393766357, 1393766358, 1393766358, 1393766358, 1393766359, 1393766359, 1393766360, 1393766361, 1393766361, 1393766444, 'adsfasdfasdf', 12, 178, 180, 32, 44, 55, NULL, 123, 456),
(26, 8, 1, 1, 1, 1394051416, 1394051420, 1394051421, 1394051421, 1394051422, 1394051423, 1394051423, 1394051424, 1394051427, 1394051427, 1394051428, 1394052575, 'lkjlkjljk', 12, 158, 180, 10, 160, 170, NULL, 4, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `outgoing_delay`
--

DROP TABLE IF EXISTS `outgoing_delay`;
CREATE TABLE `outgoing_delay` (
  `code1` varchar(3) DEFAULT NULL,
  `code2` varchar(3) DEFAULT NULL,
  `code3` varchar(3) DEFAULT NULL,
  `min1` int(11) DEFAULT NULL,
  `min2` int(11) DEFAULT NULL,
  `min3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `registration`
--

REPLACE INTO `registration` (`id`, `code`) VALUES
(1, 'jff'),
(2, 'jfi'),
(3, 'jfm'),
(4, 'jfv'),
(5, 'jfy'),
(6, 'jgh'),
(7, 'jgs'),
(8, 'jgu'),
(9, 'jgv'),
(10, 'jll'),
(11, 'jmh'),
(12, 'jmj'),
(13, 'jnj'),
(14, 'jno'),
(15, 'jra'),
(16, 'jrf'),
(17, 'jrh'),
(18, 'jrn'),
(19, 'jrv'),
(20, 'jrz'),
(21, 'jsc'),
(22, 'jsd'),
(23, 'jsf'),
(24, 'jsg'),
(25, 'jyb'),
(26, 'jyc'),
(27, 'jyh');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `done` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ticket`
--

REPLACE INTO `ticket` (`id`, `creator_id`, `title`, `description`, `start_date`, `end_date`, `done`, `editor_id`, `accepted`) VALUES
(3, 1, 'asdasd', 'asdasdasd', '2014-01-20', '2014-01-20', 0, NULL, NULL),
(4, 1, 'ghghgh', 'ghghghgh', '2014-08-20', '2014-08-27', 0, NULL, NULL),
(5, 1, 'aaaaaa', 'asasasa', '2014-01-15', '2014-01-21', 0, NULL, NULL),
(6, 1, 'hadi baaam', 'test description', '2014-01-28', '2014-01-28', 0, NULL, NULL),
(7, 1, 'lllllll', 'llmlmlm', '2014-01-22', '2014-01-30', 0, NULL, NULL),
(8, 1, 'cccc', 'ccccc', '2014-01-14', '2014-01-22', 0, NULL, NULL),
(9, 1, 'cccc', 'ccccc', '2014-01-14', '2014-01-22', 0, NULL, NULL),
(10, 1, 'cccc', 'ccccc', '2014-01-14', '2014-01-22', 0, NULL, NULL),
(11, 1, 'cccc', 'ccccc', '2014-01-14', '2014-01-22', 1391468182, 8, 1391467936),
(12, 1, 'mmmmmmm', 'mmmmmmmmmmmmm', '2014-01-16', '2014-01-22', 0, NULL, NULL),
(13, 1, 'mimo', 'lop', '2014-01-24', '2014-01-25', 0, NULL, NULL),
(14, 1, 'asd', 'asd', '2014-02-05', '2014-02-08', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_assignment`
--

DROP TABLE IF EXISTS `ticket_assignment`;
CREATE TABLE `ticket_assignment` (
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`ticket_id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ticket_assignment`
--

REPLACE INTO `ticket_assignment` (`user_id`, `ticket_id`) VALUES
(1, 6),
(5, 6),
(4, 7),
(5, 7),
(7, 7),
(4, 11),
(5, 11),
(6, 11),
(8, 11),
(1, 12),
(6, 12),
(7, 12),
(8, 12),
(1, 13),
(5, 14),
(7, 14);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `gender` int(1) NOT NULL,
  `birth` int(16) DEFAULT NULL,
  `type` int(1) NOT NULL,
  `street` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `zipcode` varchar(11) NOT NULL,
  `country` varchar(64) DEFAULT NULL,
  `phone` varchar(32) NOT NULL,
  `phone_internal` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

REPLACE INTO `user` (`id`, `email`, `password`, `username`, `name`, `lastname`, `gender`, `birth`, `type`, `street`, `city`, `state`, `zipcode`, `country`, `phone`, `phone_internal`, `active`, `deleted`) VALUES
(1, 'erdal.mersinlioglu@gmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'emersinlioglu', 'Erdal', 'Mersinlioglu', 1, 0, 4, '', '', '', '', '', '', '', 1, 0),
(4, 'test1@hotmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'test1', 'Test1', 'Lastname1', 1, NULL, 3, '', '', '', '', NULL, '', '', 1, 0),
(5, 'test2@hotmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'test2', 'T2', 'L2', 1, NULL, 3, '', '', '', '', NULL, '', '', 1, 0),
(6, 'test3@hotmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'test3', 't3', 'l3', 1, NULL, 3, '', '', '', '', NULL, '', '', 1, 0),
(7, 'test4@hotmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'test4', 't4', 'l4', 1, NULL, 3, '', '', '', '', NULL, '', '', 1, 0),
(8, 'test5@hotmail.com', 'b146a5414f1bc914aa09ab355c2ea2c3', 'test5', 't5', 'l5', 1, NULL, 3, '', '', '', '', NULL, '', '', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_type`
--

REPLACE INTO `user_type` (`id`, `name`) VALUES
(1, 'Director'),
(2, 'Chef'),
(3, 'Employee'),
(4, 'Admin');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `operation_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  ADD CONSTRAINT `operation_ibfk_3` FOREIGN KEY (`aircrafttype_id`) REFERENCES `aircraft_type` (`id`);

--
-- Constraints der Tabelle `ticket_assignment`
--
ALTER TABLE `ticket_assignment`
  ADD CONSTRAINT `ticket_assignment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ticket_assignment_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `ticket_assignment_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`);

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `user_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
