-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2014 at 06:46 PM
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
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `transactionid` (`transactionid`),
  KEY `capture` (`capture`),
  KEY `authcode` (`authcode`),
  KEY `type` (`type`),
  KEY `tracking_id` (`tracking_number`),
  KEY `validated` (`validated`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=386 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `time`, `account_holder_type`, `account_type`, `sec_code`, `amount`, `tax`, `payment`, `orderdescription`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`, `orderid`, `transactionid`, `authcode`, `capture_transactionid`, `capture`, `refund_transactionid`, `tracking_number`, `shipping_carrier`, `validated`) VALUES
(375, 'refunded', '20140110222949', '', '', NULL, '500.00', '35.00', 'credit card', 'Brunzles', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha73', 2123273220, '123456', NULL, NULL, NULL, NULL, NULL, 0),
(376, 'refund', '20140110223015', '', '', NULL, '500.00', '0.00', '', 'Brunzles', '', 'Stephen', 'Mareches', '', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha73', 2123273780, '', NULL, NULL, 2123273220, NULL, NULL, 0),
(377, 'sale', '20140110223641', '', '', NULL, '600.00', '42.00', 'credit card', 'Goozers', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha74', 2123285547, '123456', NULL, NULL, NULL, NULL, NULL, 0),
(378, 'refunded', '20140110224220', NULL, NULL, NULL, '666.00', '36.66', 'credit card', 'Zuhra', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha75', 2123295768, '123456', NULL, NULL, NULL, NULL, NULL, 0),
(379, 'refund', '20140110224258', NULL, NULL, NULL, '666.00', '0.00', '', 'Zuhra', '::1', 'Stephen', 'Mareches', '', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha75', 2123296789, '', NULL, NULL, 2123295768, NULL, NULL, 0),
(380, 'refunded', '20140110224733', NULL, NULL, NULL, '750.00', '35.99', 'credit card', 'Voixles', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha76', 2123303864, '123456', NULL, NULL, NULL, NULL, NULL, 0),
(381, 'refund', '20140110224812', NULL, NULL, NULL, '750.00', '0.00', '', 'Voixles', '::1', 'Stephen', 'Mareches', '', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha76', 2123304860, '', NULL, NULL, 2123303864, NULL, NULL, 0),
(382, 'refunded', '20140110225021', NULL, NULL, NULL, '44.00', '2.88', 'credit card', 'Hadgels', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha77', 2123308416, '123456', NULL, NULL, NULL, NULL, NULL, 0),
(383, 'refund', '20140110225052', NULL, NULL, NULL, '22.00', '0.00', '', 'Hadgels', '::1', 'Stephen', 'Mareches', '', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha77', 2123308936, '', NULL, NULL, 2123308416, NULL, NULL, 0),
(384, 'sale', '20140110231033', NULL, NULL, NULL, '66.00', '3.99', 'credit card', 'Shcherzos.', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha78', 2123322356, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(385, 'sale', '20140110233304', NULL, NULL, NULL, '88.00', '5.60', 'credit card', 'Dozer boose', '::1', 'Stephen', 'Mareches', 'SoSo', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '', 'stephen@sophiasolutions.net', 'ChaCha78', 2123336559, '123456', NULL, NULL, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
