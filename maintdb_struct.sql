-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2012 at 09:32 PM
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
-- Table structure for table `lv0`
--

CREATE TABLE IF NOT EXISTS `lv0` (
  `lv0id` int(11) NOT NULL AUTO_INCREMENT,
  `lv0name` text NOT NULL,
  `lv0description` text NOT NULL,
  PRIMARY KEY (`lv0id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv1`
--

CREATE TABLE IF NOT EXISTS `lv1` (
  `lv1id` int(11) NOT NULL AUTO_INCREMENT,
  `lv1name` text NOT NULL,
  `lv1description` text NOT NULL,
  PRIMARY KEY (`lv1id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv2`
--

CREATE TABLE IF NOT EXISTS `lv2` (
  `lv2id` int(11) NOT NULL AUTO_INCREMENT,
  `lv2name` text NOT NULL,
  `lv2description` text NOT NULL,
  PRIMARY KEY (`lv2id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv3`
--

CREATE TABLE IF NOT EXISTS `lv3` (
  `lv3id` int(11) NOT NULL AUTO_INCREMENT,
  `lv3name` text NOT NULL,
  `lv3description` text NOT NULL,
  PRIMARY KEY (`lv3id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv4`
--

CREATE TABLE IF NOT EXISTS `lv4` (
  `lv4id` int(11) NOT NULL AUTO_INCREMENT,
  `lv4name` text NOT NULL,
  `lv4description` text NOT NULL,
  PRIMARY KEY (`lv4id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv5`
--

CREATE TABLE IF NOT EXISTS `lv5` (
  `lv5id` int(11) NOT NULL AUTO_INCREMENT,
  `lv5name` text NOT NULL,
  `lv5description` text NOT NULL,
  PRIMARY KEY (`lv5id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv6`
--

CREATE TABLE IF NOT EXISTS `lv6` (
  `lv6id` int(11) NOT NULL AUTO_INCREMENT,
  `lv6name` text NOT NULL,
  `lv6description` text NOT NULL,
  PRIMARY KEY (`lv6id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `lv7`
--

CREATE TABLE IF NOT EXISTS `lv7` (
  `lv7id` int(11) NOT NULL AUTO_INCREMENT,
  `lv7name` text NOT NULL,
  `lv7description` text NOT NULL,
  `relatedlv6` int(11) NOT NULL,
  PRIMARY KEY (`lv7id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `maintenanceplans`
--

CREATE TABLE IF NOT EXISTS `maintenanceplans` (
  `woid` int(11) NOT NULL AUTO_INCREMENT,
  `wocreatedate` int(11) NOT NULL,
  `wocreatedby` text NOT NULL,
  `wotype` text NOT NULL,
  `wopriority` text NOT NULL,
  `wolv0` text NOT NULL,
  `wolv1` text NOT NULL,
  `wolv2` text NOT NULL,
  `wolv3` text NOT NULL,
  `wolv4` text NOT NULL,
  `wolv5` text NOT NULL,
  `wolv6` text NOT NULL,
  `wolv7` text NOT NULL,
  `wosummary` text NOT NULL,
  `wodescription` text NOT NULL,
  `wostatus` text NOT NULL,
  `woassignedto` text NOT NULL,
  `womodifieddate` int(11) NOT NULL,
  `periodicity` text NOT NULL,
  `lastordertime` int(11) NOT NULL,
  `nextordertime` int(11) NOT NULL,
  `wodocument` text NOT NULL,
  `wosafetydocument` text NOT NULL,
  PRIMARY KEY (`woid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `showreports`
--

CREATE TABLE IF NOT EXISTS `showreports` (
  `entryid` int(11) NOT NULL AUTO_INCREMENT,
  `entrydate` int(11) NOT NULL,
  `entrydpt` text COLLATE utf8_unicode_ci NOT NULL,
  `show1number` int(11) NOT NULL,
  `show1report` text COLLATE utf8_unicode_ci NOT NULL,
  `show1user` text COLLATE utf8_unicode_ci NOT NULL,
  `show1aerial` text COLLATE utf8_unicode_ci NOT NULL,
  `show1l4loading` text COLLATE utf8_unicode_ci NOT NULL,
  `show1l4scenic` text COLLATE utf8_unicode_ci NOT NULL,
  `show1l6loading` text COLLATE utf8_unicode_ci NOT NULL,
  `show1liftop` text COLLATE utf8_unicode_ci NOT NULL,
  `show1rover` text COLLATE utf8_unicode_ci NOT NULL,
  `show1clean` text COLLATE utf8_unicode_ci NOT NULL,
  `show1equipclean` text COLLATE utf8_unicode_ci NOT NULL,
  `show_1_problem_equip_1` text COLLATE utf8_unicode_ci NOT NULL,
  `show_1_problem_equip_2` text COLLATE utf8_unicode_ci NOT NULL,
  `show2number` int(11) NOT NULL,
  `show2report` text COLLATE utf8_unicode_ci NOT NULL,
  `show2user` text COLLATE utf8_unicode_ci NOT NULL,
  `show2aerial` text COLLATE utf8_unicode_ci NOT NULL,
  `show2l4loading` text COLLATE utf8_unicode_ci NOT NULL,
  `show2l4scenic` text COLLATE utf8_unicode_ci NOT NULL,
  `show2l6loading` text COLLATE utf8_unicode_ci NOT NULL,
  `show2liftop` text COLLATE utf8_unicode_ci NOT NULL,
  `show2rover` text COLLATE utf8_unicode_ci NOT NULL,
  `show2clean` text COLLATE utf8_unicode_ci NOT NULL,
  `show2equipclean` text COLLATE utf8_unicode_ci NOT NULL,
  `rehearsalreport` text COLLATE utf8_unicode_ci NOT NULL,
  `show_2_problem_equip_1` text COLLATE utf8_unicode_ci NOT NULL,
  `show_2_problem_equip_2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`entryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=326 ;

-- --------------------------------------------------------

--
-- Table structure for table `spares`
--

CREATE TABLE IF NOT EXISTS `spares` (
  `sparesid` int(11) NOT NULL AUTO_INCREMENT,
  `sparesbrand` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesmodel` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesordernumber` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesbarcode` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesisconsumable` text COLLATE utf8_unicode_ci NOT NULL,
  `sparesquantity` int(11) NOT NULL,
  `sparesminquantity` int(11) NOT NULL,
  `sparesmaxquantity` int(11) NOT NULL,
  `sparespiclocation` text COLLATE utf8_unicode_ci NOT NULL,
  `system` text COLLATE utf8_unicode_ci NOT NULL,
  `subsystem` text COLLATE utf8_unicode_ci NOT NULL,
  `component` text COLLATE utf8_unicode_ci NOT NULL,
  `sparestorelocation` text COLLATE utf8_unicode_ci NOT NULL,
  `unitcost` text COLLATE utf8_unicode_ci NOT NULL,
  `supplierphone` text COLLATE utf8_unicode_ci NOT NULL,
  `supplieremail` text COLLATE utf8_unicode_ci NOT NULL,
  `currency` text COLLATE utf8_unicode_ci NOT NULL,
  `suppliername` text COLLATE utf8_unicode_ci NOT NULL,
  `active` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sparesid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=222 ;

-- --------------------------------------------------------

--
-- Table structure for table `spareslog`
--

CREATE TABLE IF NOT EXISTS `spareslog` (
  `entryid` int(11) NOT NULL AUTO_INCREMENT,
  `entrydate` int(11) NOT NULL,
  `sparesid` int(11) NOT NULL,
  `woid` int(11) NOT NULL,
  `needsrevision` text COLLATE utf8_unicode_ci NOT NULL,
  `movement` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `datechanged` text COLLATE utf8_unicode_ci NOT NULL,
  `actions` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`entryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tags` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` text COLLATE utf8_unicode_ci NOT NULL,
  `tagdescription` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userdpt`
--

CREATE TABLE IF NOT EXISTS `userdpt` (
  `dptid` int(11) NOT NULL AUTO_INCREMENT,
  `dptname` text COLLATE utf8_unicode_ci NOT NULL,
  `dptdescription` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dptid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
  `usergroups_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroups_name` text NOT NULL,
  `usergroups_description` text NOT NULL,
  PRIMARY KEY (`usergroups_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `dptid` int(11) NOT NULL,
  `userpass` text NOT NULL,
  `useremail` text NOT NULL,
  `usergroup` text NOT NULL,
  `receiveemails` text NOT NULL,
  `mainadmin` text NOT NULL,
  `does_orders` text NOT NULL,
  `receivessreports` text NOT NULL,
  `timezone` text NOT NULL,
  `is_site_admin` text NOT NULL,
  `is_plant_admin` text NOT NULL,
  `is_dpt_admin` text NOT NULL,
  `is_system_admin` text NOT NULL,
  `plantid` int(11) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `wolog`
--

CREATE TABLE IF NOT EXISTS `wolog` (
  `wologid` int(11) NOT NULL AUTO_INCREMENT,
  `woid` int(11) NOT NULL,
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `wologdate` int(11) NOT NULL,
  `wologdescription` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `wologid` (`wologid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13549 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `workorders`
--

CREATE TABLE IF NOT EXISTS `workorders` (
  `woid` int(11) NOT NULL AUTO_INCREMENT,
  `wocreatedate` int(11) NOT NULL,
  `wocreatedby` int(11) NOT NULL,
  `wotype` int(11) NOT NULL,
  `wopriority` int(11) NOT NULL,
  `wolv0` int(11) NOT NULL,
  `wolv1` int(11) NOT NULL,
  `wolv2` int(11) NOT NULL,
  `wolv3` int(11) NOT NULL,
  `wolv4` int(11) NOT NULL,
  `wolv5` int(11) NOT NULL,
  `wolv6` int(11) NOT NULL,
  `wolv7` int(11) NOT NULL,
  `wosummary` text NOT NULL,
  `wodescription` text NOT NULL,
  `wostatus` int(11) NOT NULL,
  `woassignedto` int(11) NOT NULL,
  `womodifieddate` int(11) NOT NULL,
  `woreport` text NOT NULL,
  `wocompletedby` text NOT NULL,
  `wocompleteddate` int(11) NOT NULL,
  `wocloseddate` int(11) NOT NULL,
  `wodocument` text NOT NULL,
  `woreportdocument` text NOT NULL,
  `wosafetydocument` text NOT NULL,
  `deadlinedate` int(11) NOT NULL,
  PRIMARY KEY (`woid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6185 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `wotype`
--

CREATE TABLE IF NOT EXISTS `wotype` (
  `wotypeid` int(11) NOT NULL AUTO_INCREMENT,
  `wotypename` text NOT NULL,
  `wotypedescription` text NOT NULL,
  PRIMARY KEY (`wotypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
