-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2014 at 10:57 AM
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
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `time` varchar(40) NOT NULL,
  `account_holder_type` varchar(10) DEFAULT NULL,
  `account_type` varchar(10) DEFAULT NULL,
  `sec_code` varchar(10) DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL,
  `tax` decimal(11,2) DEFAULT '0.00',
  `payment` varchar(20) NOT NULL,
  `orderdescription` varchar(254) DEFAULT NULL,
  `ipaddress` varchar(25) DEFAULT NULL,
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
  `transactionid` int(15) DEFAULT NULL,
  `authcode` varchar(35) DEFAULT NULL,
  `capture_transactionid` int(11) DEFAULT NULL,
  `capture` tinyint(1) DEFAULT NULL,
  `refund_transactionid` int(11) DEFAULT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `shipping_carrier` varchar(10) DEFAULT NULL,
  `validated` tinyint(1) DEFAULT '0',
  `void_transaction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `transactionid` (`transactionid`),
  KEY `capture` (`capture`),
  KEY `authcode` (`authcode`),
  KEY `type` (`type`),
  KEY `tracking_id` (`tracking_number`),
  KEY `validated` (`validated`),
  KEY `void_transactionid` (`void_transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=502 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `time`, `account_holder_type`, `account_type`, `sec_code`, `amount`, `tax`, `payment`, `orderdescription`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`, `orderid`, `transactionid`, `authcode`, `capture_transactionid`, `capture`, `refund_transactionid`, `tracking_number`, `shipping_carrier`, `validated`, `void_transaction_id`) VALUES
(500, 'voided', '20140122225327', NULL, NULL, NULL, '400.00', '0.00', 'credit card', 'fly bizz', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'CC7040', 2136630034, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(501, 'void', '20140122225349', NULL, NULL, NULL, '400.00', '0.00', '', 'fly bizz', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'CC7040', 2136630034, '123456', NULL, NULL, NULL, NULL, NULL, 0, 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
