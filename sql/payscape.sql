-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2013 at 04:57 PM
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
  `key_id` varchar(150) NOT NULL,
  `hash` varchar(254) NOT NULL,
  `time` varchar(40) NOT NULL,
  `ccnumber` varchar(20) NOT NULL,
  `ccexp` char(4) NOT NULL,
  `checkname` varchar(254) NOT NULL,
  `checkaba` varchar(50) NOT NULL,
  `chackaccount` varchar(60) NOT NULL,
  `account_holder_type` varchar(10) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `cvv` char(4) NOT NULL,
  `payment` varchar(10) NOT NULL,
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
  `fax` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `key_id`, `hash`, `time`, `ccnumber`, `ccexp`, `checkname`, `checkaba`, `chackaccount`, `account_holder_type`, `account_type`, `amount`, `cvv`, `payment`, `ipaddress`, `firstname`, `lastname`, `company`, `address1`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `email`) VALUES
(1, 'sale', 'Payscape2013', '4a;lkjfd1j;dsmfm;;', '20131205182911', '111111111111111', '123', 'checkname', 'checkaba', 'checkaccount', 'business', 'checking', '1566.70', '444', 'creditcard', '127.0.0.1', 'Bill', 'Beaver', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '4048200331', 'stephen@sophiasolutions.net'),
(2, 'sale', 'Payscape2013', '4a;lkjfd1j;dsmfm;;', '20131205182911', '111111111111111', '123', 'checkname', 'checkaba', 'checkaccount', 'business', 'checking', '766.44', '444', 'creditcard', '127.0.0.1', 'Bill', 'Beaver', 'Sophia Solutions', '1647 Frazier Road', 'Decatur', 'Georgia', '30033', 'United States', '4048200331', '4048200331', 'stephen@sophiasolutions.net'),
(3, 'aa', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', '1.00', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'AA', 'info@iprmarketing.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
