-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 29, 2020 at 02:33 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_insurance`
--

DROP TABLE IF EXISTS `auto_insurance`;
CREATE TABLE IF NOT EXISTS `auto_insurance` (
  `i_id` int(11) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `marital_status` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `d_id` float NOT NULL,
  `license_number` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthdate` datetime NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE IF NOT EXISTS `homes` (
  `h_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `purchase_value` bigint(20) NOT NULL,
  `home_area` float NOT NULL,
  `type` char(1) NOT NULL,
  `auto_fire_notification` varbinary(1) NOT NULL,
  `home_security_system` varbinary(1) DEFAULT NULL,
  `swimming_pool` char(1) NOT NULL,
  `basement` varbinary(1) NOT NULL,
  `i_id` int(11) NOT NULL,
  PRIMARY KEY (`h_id`),
  KEY `homes_home_insurance_fk` (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_insurance`
--

DROP TABLE IF EXISTS `home_insurance`;
CREATE TABLE IF NOT EXISTS `home_insurance` (
  `i_id` int(11) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

DROP TABLE IF EXISTS `insurance`;
CREATE TABLE IF NOT EXISTS `insurance` (
  `i_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `insurance_type` char(1) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `premium_amount` bigint(20) NOT NULL,
  `i_status` char(1) NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `insurance_customer_fk` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `inv_id` int(11) NOT NULL,
  `payment_due` datetime NOT NULL,
  `amount` bigint(20) NOT NULL,
  `i_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`inv_id`),
  KEY `invoice_insurance_fk` (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `p_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `inv_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `payment_invoice_fk` (`inv_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `v_in` int(11) NOT NULL,
  `make_model_year` datetime NOT NULL,
  `v_status` char(1) NOT NULL,
  `i_id` int(11) NOT NULL,
  PRIMARY KEY (`v_in`),
  KEY `vehicles_auto_insurance_fk` (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_drivers`
--

DROP TABLE IF EXISTS `vehicle_drivers`;
CREATE TABLE IF NOT EXISTS `vehicle_drivers` (
  `v_in` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  PRIMARY KEY (`v_in`,`d_id`),
  KEY `vehicle_drivers_drivers_fk` (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
