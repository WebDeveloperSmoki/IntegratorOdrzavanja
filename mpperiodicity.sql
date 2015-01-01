-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2012 at 10:43 PM
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
-- Table structure for table `mpperiodicity`
--

CREATE TABLE IF NOT EXISTS `mpperiodicity` (
  `mpperiodicityid` int(11) NOT NULL AUTO_INCREMENT,
  `mpperiodicityname` text NOT NULL,
  `mpperiodicityunixtimegap` int(11) NOT NULL,
  PRIMARY KEY (`mpperiodicityid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mpperiodicity`
--

INSERT INTO `mpperiodicity` (`mpperiodicityid`, `mpperiodicityname`, `mpperiodicityunixtimegap`) VALUES
(2, 'daily', 86400),
(3, 'weekly', 604800),
(4, 'monthly (28 days)', 2419200),
(5, '2-monthly', 4838400),
(7, '3-monthly', 7257600),
(8, '6-Monthly', 14515200),
(9, 'Yearly', 29030400);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
