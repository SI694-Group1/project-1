-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2013 at 07:16 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facebookapi_project1`
--
CREATE DATABASE IF NOT EXISTS `facebookapi_project1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `facebookapi_project1`;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `OID` int(11) NOT NULL AUTO_INCREMENT,
  `QID` int(11) NOT NULL,
  `OpText` varchar(1000) NOT NULL,
  PRIMARY KEY (`OID`),
  KEY `fk_QID` (`QID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1626 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `QID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` bigint(20) NOT NULL,
  `QuesText` varchar(1000) NOT NULL,
  PRIMARY KEY (`QID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `UID` bigint(20) NOT NULL,
  `QID` int(11) DEFAULT NULL,
  `OID` int(11) DEFAULT NULL,
  `OptSelected` varchar(1000) DEFAULT NULL,
  KEY `QID` (`QID`),
  KEY `OID` (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `fk_QID` FOREIGN KEY (`QID`) REFERENCES `question` (`QID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
