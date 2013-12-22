-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2013 at 12:25 PM
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
  `transactionid` int(11) NOT NULL,
  `authcode` varchar(35) DEFAULT NULL,
  `capture_transactionid` int(11) DEFAULT NULL,
  `capture` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `transactionid` (`transactionid`),
  KEY `authorizationcode` (`authcode`,`capture_transactionid`),
  KEY `capture` (`capture`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=216 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `key_id`, `hash`, `time`, `ccnumber`, `ccexp`, `checkname`, `checkaba`, `checkaccount`, `account_holder_type`, `account_type`, `sec_code`, `processor_id`, `amount`, `cvv`, `payment`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`, `orderid`, `transactionid`, `authcode`, `capture_transactionid`, `capture`) VALUES
(207, 'sale', '449510', '4e1ff2352620203bd0870ae4fe1bd31a', '20131219215117', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'Mareches', 'SoSo', '41 North Sandusky Street', 'Tiffin', 'OH', '44883', 'United States', '4048200331', '', 'sophia22@bellsouth.net', '20131219165117Test', 2099409780, NULL, NULL, NULL),
(208, 'sale', '449510', 'cc325df9abd29cc1c9c4399786e479a8', '20131219224549', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219174549TestCheck', 2099445893, NULL, NULL, NULL),
(209, 'sale', '449510', '1bd9b07a62653173f674a5bdb19b4c82', '20131219225108', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175108TestCheck', 2099449033, NULL, NULL, NULL),
(210, 'sale', '449510', '43aaf642e7a5b5024d25153dd99fb6f3', '20131219225356', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175356TestCheck', 2099450713, NULL, NULL, NULL),
(211, 'sale', '449510', '12885670416904b136e851c91fd6b117', '20131219225639', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '', 'check', '::1', 'Stephen', 'Mareches', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131219175639TestCheck', 2099452390, NULL, NULL, NULL),
(213, 'sale', '449510', 'aa29db07148ee841b68b8cb33535c9ae', '20131220162336', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'Mareches', 'SoSo', '41 North Sandusky Street', 'Tiffin', 'OH', '44883', 'United States', '4048200331', '', 'sophia22@bellsouth.net', '20131220112336TestAuthCC', 2100262891, NULL, NULL, NULL),
(214, 'sale', '449510', '1af8fb6a6a82075ff4ff72e9c1b5f876', '20131220162436', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'Mareches', 'SoSo', '41 North Sandusky Street', 'Tiffin', 'OH', '44883', 'United States', '4048200331', '', 'sophia22@bellsouth.net', '20131220112436TestAuthCC', 2100264263, NULL, NULL, NULL),
(215, 'auth', '449510', '216e7f5fb3e511cefc6a087a9d7fe075', '20131220162547', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '123', 'credit card', '::1', 'Stephen', 'Mareches', 'SoSo', '41 North Sandusky Street', 'Tiffin', 'OH', '44883', 'United States', '4048200331', '', 'sophia22@bellsouth.net', '20131220112547TestAuthCC', 2100265621, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
