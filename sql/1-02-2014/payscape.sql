-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2014 at 09:50 AM
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
  `tax` decimal(11,2) NOT NULL,
  `cvv` char(4) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `orderdescription` varchar(254) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=249 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `key_id`, `hash`, `time`, `ccnumber`, `ccexp`, `checkname`, `checkaba`, `checkaccount`, `account_holder_type`, `account_type`, `sec_code`, `processor_id`, `amount`, `tax`, `cvv`, `payment`, `orderdescription`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`, `orderid`, `transactionid`, `authcode`, `capture_transactionid`, `capture`) VALUES
(229, 'sale', '449510', '', '', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(230, 'sale', '449510', '', '20131230165343', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(231, 'sale', '449510', '', '20131230172310', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(232, 'sale', '449510', '', '20131230172818', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(233, 'sale', '449510', '', '20131230173940', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(234, '', '', '', '20131230174024', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '0.00', '', 'check', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(235, '', '', '', '20131230174117', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '0.00', '', 'check', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(236, 'sale', '449510', '8b184eb8ce432f667e11e100b4913252', '20131230181956', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230131956Test', 2110003877, NULL, NULL, NULL),
(237, 'sale', '449510', '93734c16ad085666260613aff64f9305', '20131230182043', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132043Test', 2110004576, NULL, NULL, NULL),
(238, 'sale', '449510', 'b54bd7f2f832ff825cfbc4b2dc28829a', '20131230182117', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132117Test', 2110005129, NULL, NULL, NULL),
(239, 'sale', '449510', '530d1332a89e5bd79af6282c4c17e4e2', '20131230182334', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132334Test', 2110007231, NULL, NULL, NULL),
(240, 'sale', '449510', '8068382fea645249e1e6eb39f7057e7f', '20131230182509', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132509Test', 2110008734, NULL, NULL, NULL),
(241, 'sale', '449510', 'fc1cae509c9898e36f480e99fc591597', '20131230182536', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132536Test', 2110009153, NULL, NULL, NULL),
(242, 'sale', '449510', '93734c16ad085666260613aff64f9305', '20131230182602', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230132602Test', 2110009558, NULL, NULL, NULL),
(243, 'sale', '449510', '1adf71de77d7741751c5f1891149ac78', '20131230183255', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230133255Test', 2110015837, NULL, NULL, NULL),
(244, 'sale', '449510', '1dd4576f36aa81fc7729e1b03e8715ab', '20131230193602', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230143602Test', 2110075690, NULL, NULL, NULL),
(245, 'sale', '449510', '93316041f969a3231119a8ce1b6abbbc', '20131230193848', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', 'credit card', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131230143848Test', 2110078105, NULL, NULL, NULL),
(246, 'sale', '449510', '3910fe793162b86e993c4bbd9a7cc9c8', '20131231172735', NULL, NULL, 'Test', '123123123', '123123123', 'business', 'checking', 'WEB', NULL, '2.00', '0.00', '', 'check', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '20131231122735TestCheck', 2111024378, NULL, NULL, NULL),
(247, 'sale', '449510', '', '20140102141357', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', '', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL),
(248, 'sale', '449510', '', '20140102141947', '4111111111111111', '1010', NULL, NULL, NULL, '', '', NULL, NULL, '2.00', '0.00', '123', '', '', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', '', 0, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
