-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2013 at 09:06 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payscape`
--

-- --------------------------------------------------------

--
-- Table structure for table `curly`
--

CREATE TABLE IF NOT EXISTS `curly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curly` text NOT NULL,
  `postdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `key_id` varchar(150) NOT NULL,
  `hash` varchar(254) NOT NULL,
  `time` varchar(40) NOT NULL,
  `ccnumber` varchar(20) DEFAULT NULL,
  `ccexp` char(4) DEFAULT NULL,
  `checkname` varchar(254) DEFAULT NULL,
  `checkaba` varchar(50) DEFAULT NULL,
  `checkaccount` varchar(60) DEFAULT NULL,
  `account_holder_type` varchar(10) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `sec_code` varchar(10) DEFAULT NULL,
  `processor_id` varchar(10) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `cvv` char(4) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `company` varchar(60) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `orderid` varchar(25) NOT NULL,
  `transactionid` int(13) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `transactionid` (`transactionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `key_id`, `hash`, `time`, `ccnumber`, `ccexp`, `checkname`, `checkaba`, `checkaccount`, `account_holder_type`, `account_type`, `sec_code`, `processor_id`, `amount`, `cvv`, `payment`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`, `orderid`, `transactionid`) VALUES
(207, 'sale', '449510', '4e1ff2352620203bd0870ae4fe1bd31a', '20131219215117', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'Mareches', 'SoSo', '41 North Sandusky Street', 'Tiffin', 'OH', '44883', 'United States', '4048200331', '', 'sophia22@bellsouth.net', '20131219165117Test', 2099409780),
(208, 'sale', '449510', 'cc325df9abd29cc1c9c4399786e479a8', '20131219224549', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219174549TestCheck', 2099445893),
(209, 'sale', '449510', '1bd9b07a62653173f674a5bdb19b4c82', '20131219225108', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175108TestCheck', 2099449033),
(210, 'sale', '449510', '43aaf642e7a5b5024d25153dd99fb6f3', '20131219225356', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175356TestCheck', 2099450713),
(211, 'sale', '449510', '12885670416904b136e851c91fd6b117', '20131219225639', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175639TestCheck', 2099452390),
(212, 'sale', '449510', 'bf7c5c096ce2155e1e06532e5d33af94', '20131219225701', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'M', '', '', '', '', '', '', '', '', '', '20131219175701Test', 2099452601);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
