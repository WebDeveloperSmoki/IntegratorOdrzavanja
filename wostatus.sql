-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2012 at 10:48 PM
-- Server version: 5.5.23
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zodiak_maintdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `wostatus`
--

CREATE TABLE IF NOT EXISTS `wostatus` (
  `wostatusid` int(11) NOT NULL AUTO_INCREMENT,
  `wostatusname` text NOT NULL,
  `wostatusdescription` text NOT NULL,
  PRIMARY KEY (`wostatusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wostatus`
--

INSERT INTO `wostatus` (`wostatusid`, `wostatusname`, `wostatusdescription`) VALUES
(1, 'PAUSED', ''),
(2, 'ASSIGNED', 'WO not yet in progress but assigned to a user'),
(3, 'INPROGRESS', 'WO set as in progress by assigned user'),
(4, 'WAITMAT', 'WO paused, waiting for material'),
(5, 'COMPLETE', 'WO set as complete by assigned user'),
(6, 'CLOSED', 'WO has been closed after a complete order has been accepted by supervisor.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
