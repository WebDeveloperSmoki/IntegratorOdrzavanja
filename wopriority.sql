-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2012 at 10:47 PM
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
-- Table structure for table `wopriority`
--

CREATE TABLE IF NOT EXISTS `wopriority` (
  `wopriorityid` int(11) NOT NULL AUTO_INCREMENT,
  `wopriorityname` int(11) NOT NULL,
  `woprioritydescription` text NOT NULL,
  PRIMARY KEY (`wopriorityid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wopriority`
--

INSERT INTO `wopriority` (`wopriorityid`, `wopriorityname`, `woprioritydescription`) VALUES
(1, 1, 'Priority 1 - Urgent; immediate execution.'),
(2, 2, 'Priority 2 - 2 to 3 days deferrement'),
(3, 3, 'Priority 3 - One Week'),
(4, 4, 'Priority 4 - Two Weeks');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
