-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2011 at 09:32 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flywebair`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `ID` varchar(3) COLLATE latin1_general_ci NOT NULL COMMENT 'IATA Code',
  `Name` varchar(64) COLLATE latin1_general_ci NOT NULL COMMENT 'Name of the Airport',
  `City` varchar(64) COLLATE latin1_general_ci NOT NULL COMMENT 'City the Airport is located in',
  `Charge` varchar(8) COLLATE latin1_general_ci NOT NULL DEFAULT '0.00' COMMENT 'Fee the airport operator charges',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of Airports WebAir operates at';

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` VALUES('BRS', 'Bristol Airport', 'Bristol', '15.00');
INSERT INTO `airports` VALUES('MAN', 'Manchester Airport', 'Manchester', '17.50');
INSERT INTO `airports` VALUES('DUB', 'Dublin Airport', 'Dublin', '12.50');
INSERT INTO `airports` VALUES('NCL', 'Newcastle International Airport', 'Newcastle', '15.00');
INSERT INTO `airports` VALUES('GLA', 'Glasgow International Airport', 'Glasgow', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `ID` bigint(8) unsigned zerofill NOT NULL COMMENT 'Booking ID',
  `security` varchar(8) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `customer` bigint(8) unsigned zerofill NOT NULL,
  `outRoute` varchar(7) COLLATE latin1_general_ci NOT NULL,
  `retRoute` varchar(7) COLLATE latin1_general_ci NOT NULL,
  `outDate` date NOT NULL,
  `retDate` date NOT NULL,
  `passengers` tinyint(1) NOT NULL DEFAULT '1',
  `insurance` tinyint(1) NOT NULL DEFAULT '0',
  `carbon` tinyint(1) NOT NULL DEFAULT '0',
  `luggage` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Security` (`security`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of bookings';

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` VALUES(00000001, 'b8696960', 00000001, 'NCLMAN', '', '2011-03-02', '2011-03-31', 0, 0, 0, 0, 0, 0);
INSERT INTO `bookings` VALUES(00000002, 'ae031f06', 00000006, 'BRSNCL', 'NCLBRS', '2011-03-02', '2011-03-31', 0, 0, 0, 0, 0, 0);
INSERT INTO `bookings` VALUES(00000003, '8cab1c39', 00000007, 'BRSGLA', '', '2011-03-16', '0000-00-00', 0, 0, 0, 0, 0, 0);
INSERT INTO `bookings` VALUES(00000004, '56568233', 00000008, 'BRSNCL', 'NCLBRS', '2011-03-16', '2011-03-31', 0, 0, 0, 0, 0, 0);
INSERT INTO `bookings` VALUES(00000005, 'a840037b', 00000008, 'BRSNCL', 'NCLBRS', '2011-03-16', '2011-03-31', 0, 0, 0, 0, 0, 0);
INSERT INTO `bookings` VALUES(00000006, '931881e5', 00000008, 'BRSNCL', 'NCLBRS', '2011-03-16', '2011-03-31', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` bigint(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `surname` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `forename` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `address1` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `address2` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `address3` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `county` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `postcode` varchar(7) COLLATE latin1_general_ci DEFAULT NULL,
  `telephone` bigint(11) unsigned zerofill DEFAULT NULL,
  `mobile` bigint(11) unsigned zerofill DEFAULT NULL,
  `email` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `marketing` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of customers' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` VALUES(00000001, 'Argo', 'Ben', 'b', 'b', 'b', 'bristol', 'avon', 'GL71TY', 01173294453, 07534234243, 'b', NULL, 1);
INSERT INTO `customers` VALUES(00000002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `customers` VALUES(00000003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `customers` VALUES(00000004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `customers` VALUES(00000005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `customers` VALUES(00000006, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `optionals`
--

CREATE TABLE `optionals` (
  `ID` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `optionals`
--

INSERT INTO `optionals` VALUES('luggage', 15);
INSERT INTO `optionals` VALUES('insurance', 5);
INSERT INTO `optionals` VALUES('priority', 7);
INSERT INTO `optionals` VALUES('carbon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `ID` varchar(7) COLLATE latin1_general_ci NOT NULL COMMENT 'Route ID',
  `Origin` varchar(3) COLLATE latin1_general_ci NOT NULL COMMENT 'IATA Code of the origin',
  `Destination` varchar(3) COLLATE latin1_general_ci NOT NULL COMMENT 'IATA Code of the destination',
  `Leaves` time NOT NULL COMMENT 'Time it departs from the origin',
  `Arrives` time NOT NULL COMMENT 'Time it arrives at the destination',
  `Price` float NOT NULL COMMENT 'Price of the route',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Routes which WebAir operates';

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` VALUES('BRSNCL', 'BRS', 'NCL', '07:00:00', '08:15:00', 55);
INSERT INTO `routes` VALUES('NCLBRS', 'NCL', 'BRS', '08:45:00', '10:00:00', 55);
INSERT INTO `routes` VALUES('BRSMAN', 'BRS', 'MAN', '10:40:00', '11:45:00', 40);
INSERT INTO `routes` VALUES('MANBRS', 'MAN', 'BRS', '12:20:00', '13:00:00', 40);
INSERT INTO `routes` VALUES('BRSDUB', 'BRS', 'DUB', '13:25:00', '14:00:00', 45);
INSERT INTO `routes` VALUES('DUBGLA', 'DUB', 'GLA', '14:25:00', '15:10:00', 35);
INSERT INTO `routes` VALUES('GLABRS', 'GLA', 'BRS', '15:40:00', '17:00:00', 65);
INSERT INTO `routes` VALUES('BRSGLA', 'BRS', 'GLA', '17:40:00', '19:00:00', 65);
INSERT INTO `routes` VALUES('GLANCL', 'GLA', 'NCL', '19:30:00', '20:05:00', 35);
INSERT INTO `routes` VALUES('NCLMAN', 'NCL', 'MAN', '20:30:00', '21:05:00', 35);
INSERT INTO `routes` VALUES('MANBRS2', 'MAN', 'BRS', '21:40:00', '22:40:00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `ID` bigint(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Created` bigint(64) NOT NULL,
  `Expires` bigint(64) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `outRoute` varchar(7) COLLATE latin1_general_ci DEFAULT NULL,
  `retRoute` varchar(7) COLLATE latin1_general_ci DEFAULT NULL,
  `outDate` date DEFAULT NULL,
  `retDate` date DEFAULT NULL,
  `passengers` tinyint(1) NOT NULL DEFAULT '1',
  `insurance` tinyint(1) NOT NULL DEFAULT '0',
  `carbon` tinyint(1) NOT NULL DEFAULT '0',
  `luggage` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  `customer` bigint(8) unsigned zerofill DEFAULT NULL,
  `flight` bigint(8) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Session Handler - Goes along with sessions.class' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` VALUES(00000001, 1301408320, 1301411148, 0, 'NCLMAN', '', '2011-03-02', '2011-03-31', 0, 0, 0, 0, 0, 00000001, NULL);
INSERT INTO `sessions` VALUES(00000002, 1301408348, 1301410148, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `sessions` VALUES(00000003, 1301408355, 1301410155, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `sessions` VALUES(00000004, 1301408356, 1301410156, 1, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `sessions` VALUES(00000005, 1301416137, 1301417967, 0, 'BRSNCL', NULL, '2011-03-16', NULL, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `sessions` VALUES(00000006, 1301418451, 1301423270, 0, 'BRSNCL', 'NCLBRS', '2011-03-02', '2011-03-31', 0, 0, 0, 0, 0, 00000006, NULL);
INSERT INTO `sessions` VALUES(00000007, 1301421470, 1301423856, 0, 'BRSGLA', NULL, '2011-03-16', NULL, 0, 0, 0, 0, 0, 00000007, 00000000);
INSERT INTO `sessions` VALUES(00000008, 1301422056, 1301424437, 0, 'BRSNCL', 'NCLBRS', '2011-03-16', '2011-03-31', 0, 0, 0, 0, 0, 00000008, 00000006);
INSERT INTO `sessions` VALUES(00000009, 1301422637, 1301427518, 0, 'BRSMAN', 'NCLBRS', '2011-03-30', '2011-03-04', 2, 0, 0, 0, 0, 00000009, 00000000);
INSERT INTO `sessions` VALUES(00000010, 1301429171, 1301432449, 1, 'BRSNCL', 'MANBRS', '2011-03-18', '2011-03-26', 0, 0, 0, 0, 0, 00000006, NULL);
