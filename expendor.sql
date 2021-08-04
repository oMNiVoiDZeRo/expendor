-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2021 at 06:01 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expendor`
--

-- --------------------------------------------------------

--
-- Table structure for table `asdf`
--

DROP TABLE IF EXISTS `asdf`;
CREATE TABLE IF NOT EXISTS `asdf` (
  `UID` datetime NOT NULL,
  `Category` text NOT NULL,
  `Who` text NOT NULL,
  `Amount` text NOT NULL,
  `Bill` text NOT NULL,
  `Type` tinyint(1) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `UID` datetime NOT NULL,
  `Category` text NOT NULL,
  `Who` text NOT NULL,
  `Amount` text NOT NULL,
  `Bill` text NOT NULL,
  `Type` tinyint(1) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`UID`, `Category`, `Who`, `Amount`, `Bill`, `Type`) VALUES
('2021-06-27 16:39:21', 'Home', 'Allanza', '1195', 'Rent', 0),
('2021-06-27 18:48:42', 'Utility', 'Nevada Energy', '40.63', 'Electric', 0),
('2021-06-27 18:49:05', 'Utility', 'Nevada Energy', '47.14', 'Electric', 0),
('2021-06-27 18:50:06', 'Utility', 'Boost Mobile', '107', 'Phone', 0),
('2021-06-27 18:50:39', 'Utility', 'Cox', '79.66', 'Internet', 0),
('2021-06-27 18:51:03', 'Utility', 'Cox', '72.99', 'Internet', 0),
('2021-06-27 18:54:34', 'Health', 'Apothocarium', '1212', 'This is not a bill.', 0),
('2021-06-27 18:55:09', 'Auto', 'Various Merchants', '228', 'This is not a bill.', 0),
('2021-06-27 18:57:09', 'Work', 'Amazon', '360.61', 'This is not a bill.', 0),
('2021-06-27 18:57:26', 'Work', 'Ebay', '68.08', 'This is not a bill.', 0),
('2021-06-27 18:57:48', 'Work', 'Derek', '372', 'This is not a bill.', 0),
('2021-06-27 18:58:46', 'Entertainment', 'Game Companies', '415.19', 'This is not a bill.', 0),
('2021-06-27 18:59:21', 'Entertainment', 'Merchandise or Gifts', '49', 'This is not a bill.', 0),
('2021-06-27 19:00:12', 'Food', 'Various Merchants', '311', 'This is not a bill.', 0),
('2021-06-27 19:01:15', 'Food', 'Walgreens', '59.29', 'This is not a bill.', 0),
('2021-06-27 19:02:25', 'Debt', 'Medical Companies', '159.69', 'Medical', 0),
('2021-06-27 19:02:54', 'Food', 'CVS', '42', 'This is not a bill.', 0),
('2021-06-27 19:03:18', 'Work', 'Office Max', '52', 'This is not a bill.', 0),
('2021-06-27 19:04:00', 'Entertainment', 'Various Merchants', '122.93', 'This is not a bill.', 0),
('2021-06-27 19:04:18', 'Food', 'Various Merchants', '129', 'This is not a bill.', 0),
('2021-06-27 19:04:32', 'Work', 'ATM Withdrawal Fees', '36', 'This is not a bill.', 0),
('2021-06-27 19:05:14', 'Utility', 'USPS', '7.95', 'This is not a bill.', 0),
('2021-06-27 19:06:03', 'Utility', 'Ionos', '53', 'Web Hosting', 0),
('2021-06-27 19:10:19', 'Income', 'BrowserStack Refund', '348.00', 'This is not a bill.', 0),
('2021-06-27 19:11:10', 'Income', 'SSA', '1468', 'This is not a bill.', 0),
('2021-06-27 19:11:23', 'Income', 'MiWAM UIA', '1324', 'This is not a bill.', 0),
('2021-06-27 19:12:02', 'Income', 'Dad', '100', 'This is not a bill.', 0),
('2021-06-27 19:12:20', 'Income', 'Reimbursements', '11', 'This is not a bill.', 0),
('2021-08-04 09:43:16', 'Income', 'Nobody', '1000', 'This is not a bill.', 0),
('2021-08-04 09:40:39', 'Income', 'Nobody', '1969.16', 'This is not a bill.', 0),
('2021-08-04 09:42:05', 'Debt', 'Nobody', '2000', 'Loan', 1),
('2021-08-04 09:43:42', 'Debt', 'Nobody', '1000', 'Loan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categories` text NOT NULL,
  `bills` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `categories`, `bills`) VALUES
(14, 'asdf', '$2y$10$MWLqDBHjjktndyayviazyOdinA5TA24nqep8wyQ4wh.qOAa36brqG', '2021-08-04 08:06:01', 'Income,Food,Health,Home,Auto,Insurance,Utility,Debt,Work,Entertainment', 'Rent,Electric,Utility,Home Insurance,Health Insurance,Car Insurance,Phone,Loan,Internet,Web Hosting,Medical,This is not a bill.'),
(10, 'test', '$2y$10$6o6TvcMnnmfs9uRJVA0hxugpJw5uM.DFz2dr6E2gAFF6xgwxvjIPm', '2021-08-03 14:04:20', 'Income,Food,Health,Home,Auto,Insurance,Utility,Debt,Work,Entertainment', 'Rent,Electric,Utility,Home Insurance,Health Insurance,Car Insurance,Phone,Loan,Internet,Web Hosting,Medical,Payroll,This is not a bill.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
