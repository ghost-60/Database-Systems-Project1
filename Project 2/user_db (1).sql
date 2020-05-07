-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 07, 2020 at 08:31 AM
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
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `Passwrd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `marital_status` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `Email`, `Passwrd`, `first_name`, `last_name`, `street`, `state`, `zip`, `gender`, `marital_status`) VALUES
(6, 'ayush@gmail.com', 'e6c2dc3dee4a51dcec3a876aa2339a78', 'Ayush', 'Kumar', 'Church', 'NY', 11218, 'M', 'S'),
(5, 'mh420@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Man', 'Mha', 'CA', 'CA', 11234, 'F', 'S'),
(4, 'ng69@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Nikhil', 'Gupta', 'CA', 'NY', 11231, 'M', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `d_id` float NOT NULL AUTO_INCREMENT,
  `license_number` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `license_number` (`license_number`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`d_id`, `license_number`, `first_name`, `last_name`, `birthdate`, `c_id`) VALUES
(5, 'IKJH4568', 'Naruto', 'Uzumaki', '1991-02-06', 4),
(2, 'HASJ8909', 'Sasuke', 'Uchiha', '2001-09-08', 6),
(3, 'GAHJ6789', 'Sakura', 'Uchiha', '2002-01-09', 6),
(4, 'GHJA6789', 'Hatake', 'Kakashi', '1995-12-04', 6),
(6, 'VBNC9879', 'Sasuke', 'Uchiha', '1986-03-01', 4),
(7, 'POIU0987', 'Kushina', 'Minato', '1967-09-08', 4),
(8, 'SKJL6785', 'Monkey', 'Luffy', '1997-04-23', 4),
(9, 'POIK2918', 'Brett', 'Yang', '1975-12-13', 4),
(10, 'YUHS3556', 'Eddy', 'Lee', '1978-06-07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE IF NOT EXISTS `homes` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `purchase_value` bigint(20) NOT NULL,
  `home_area` float NOT NULL,
  `type` char(1) NOT NULL,
  `auto_fire_notification` varbinary(1) NOT NULL,
  `home_security_system` varbinary(1) DEFAULT NULL,
  `swimming_pool` char(1) NOT NULL,
  `basement` varbinary(1) NOT NULL,
  `i_id` int(11) DEFAULT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`h_id`),
  KEY `homes_home_insurance_fk` (`i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`h_id`, `purchase_date`, `purchase_value`, `home_area`, `type`, `auto_fire_notification`, `home_security_system`, `swimming_pool`, `basement`, `i_id`, `c_id`) VALUES
(1, '2001-01-01', 20000, 500, 'S', 0x31, 0x31, 'U', 0x31, 11, 6),
(2, '1997-08-01', 1212, 1212, 'S', 0x30, 0x30, 'O', 0x30, 10, 6),
(3, '1997-04-23', 45600, 2045, 'M', 0x31, 0x31, '', 0x30, 10, 6),
(13, '2013-05-04', 928290, 3456, 'S', 0x31, 0x31, 'M', 0x31, 18, 4),
(6, '2002-06-13', 456789, 6708, 'T', 0x31, 0x31, 'I', 0x31, 10, 6),
(8, '1996-04-02', 23409, 1120, 'S', 0x30, 0x30, '', 0x31, 11, 6),
(9, '1998-11-08', 23455, 4567, 'C', 0x30, 0x30, 'O', 0x30, 22, 6),
(10, '1998-09-21', 22334, 2134, 'S', 0x30, 0x30, 'I', 0x31, 22, 6),
(12, '2002-09-14', 65788, 9872, 'C', 0x31, 0x31, 'I', 0x30, 18, 4),
(14, '1997-11-08', 56789, 7890, 'T', 0x31, 0x31, '', 0x31, 19, 4),
(15, '1991-08-03', 23455, 5678, 'S', 0x30, 0x30, '', 0x31, NULL, 4),
(16, '1995-08-23', 53687, 8976, 'T', 0x31, 0x30, '', 0x30, NULL, 4),
(18, '1995-01-31', 45678, 5678, 'S', 0x30, 0x30, 'O', 0x31, NULL, 4);

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
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) DEFAULT NULL,
  `insurance_type` char(1) NOT NULL,
  `insurance_plan` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `premium_amount` bigint(20) NOT NULL,
  `i_status` char(1) NOT NULL,
  `last_invoice` date NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `insurance_customer_fk` (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`i_id`, `c_id`, `insurance_type`, `insurance_plan`, `start_date`, `end_date`, `premium_amount`, `i_status`, `last_invoice`) VALUES
(20, 4, 'A', 2, '2020-05-04', '2022-05-04', 111111, 'C', '2020-06-07'),
(11, 6, 'H', 10, '2020-05-03', '2030-05-03', 5341, 'C', '2020-06-07'),
(10, 6, 'H', 2, '2020-05-03', '2022-05-03', 252801, 'C', '2020-06-07'),
(21, 4, 'A', 5, '2020-05-04', '2025-05-04', 14286, 'C', '2020-06-07'),
(14, 6, 'A', 1, '2020-05-03', '2021-05-03', 103571, 'C', '2020-06-07'),
(19, 4, 'H', 10, '2020-05-04', '2030-05-04', 6679, 'C', '2020-06-07'),
(16, 6, 'A', 5, '2020-05-03', '2025-05-03', 103030, 'C', '2020-06-07'),
(18, 4, 'H', 5, '2020-05-04', '2025-05-04', 199816, 'C', '2020-06-07'),
(22, 6, 'H', 10, '2020-05-07', '2030-05-07', 5579, 'C', '2020-06-07'),
(23, 6, 'A', 2, '2020-05-07', '2022-05-07', 105455, 'C', '2020-06-07'),
(24, 6, 'A', 5, '2020-05-07', '2025-05-07', 104762, 'C', '2020-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_due` date NOT NULL,
  `amount` bigint(20) NOT NULL,
  `i_id` int(11) DEFAULT NULL,
  `status` bit(1) NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`inv_id`),
  KEY `invoice_insurance_fk` (`i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145530 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `payment_due`, `amount`, `i_id`, `status`, `c_id`) VALUES
(145517, '2020-05-01', 252801, 10, b'0', 6),
(145516, '2020-05-01', 3000, 11, b'0', 6),
(145515, '2020-05-01', 50935, 12, b'0', 6),
(145518, '2020-05-01', 5691, 13, b'0', 6),
(145519, '2020-05-01', 103571, 14, b'0', 6),
(145520, '2020-05-01', 3571, 15, b'0', 6),
(145521, '2020-05-01', 103030, 16, b'0', 6),
(145522, '2020-05-01', 104762, 17, b'0', 6),
(145523, '2020-05-01', 6679, 19, b'0', 4),
(145524, '2020-05-01', 199816, 18, b'0', 4),
(145525, '2020-05-01', 111111, 20, b'0', 4),
(145526, '2020-05-01', 14286, 21, b'0', 4),
(145527, '2020-05-01', 5579, 22, b'0', 6),
(145528, '2020-05-01', 105455, 23, b'0', 6),
(145529, '2020-05-01', 104762, 24, b'0', 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `v_in` int(11) NOT NULL AUTO_INCREMENT,
  `License` varchar(30) NOT NULL,
  `make_model_year` date NOT NULL,
  `v_status` char(1) NOT NULL,
  `i_id` int(11) DEFAULT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`v_in`),
  UNIQUE KEY `License` (`License`),
  KEY `vehicles_auto_insurance_fk` (`i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`v_in`, `License`, `make_model_year`, `v_status`, `i_id`, `c_id`) VALUES
(1, 'LMAO6969', '1992-01-01', 'O', 14, 6),
(2, 'ASBC8876', '1997-04-23', 'F', NULL, 6),
(3, 'HJKL9890', '1965-02-09', 'L', 23, 6),
(4, 'JKLD0988', '1986-09-19', 'O', 16, 6),
(5, 'TYUI9872', '1992-03-21', 'F', 23, 6),
(6, 'UYTU7899', '1998-07-12', 'O', 24, 6),
(9, 'OIYP5672', '1992-06-09', 'L', NULL, 6),
(10, 'KJHG689', '2015-11-07', 'O', 21, 4),
(11, 'RTYH8765', '2010-10-04', 'F', 20, 4),
(12, 'CVBN4567', '2017-09-01', 'L', NULL, 4),
(13, 'QWER9678', '2012-05-07', 'O', 21, 4),
(14, 'MNHJ4567', '2002-04-04', 'O', NULL, 4),
(15, 'KHGJ6788', '1995-09-09', 'O', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_drivers`
--

DROP TABLE IF EXISTS `vehicle_drivers`;
CREATE TABLE IF NOT EXISTS `vehicle_drivers` (
  `v_in` varchar(30) NOT NULL,
  `d_id` varchar(30) NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`v_in`,`d_id`,`c_id`),
  KEY `vehicle_drivers_drivers_fk` (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle_drivers`
--

INSERT INTO `vehicle_drivers` (`v_in`, `d_id`, `c_id`) VALUES
('1', '4', 6),
('10', '5', 4),
('11', '7', 4),
('12', '8', 4),
('13', '10', 4),
('14', '8', 4),
('15', '7', 4),
('3', '3', 6),
('4', '3', 6),
('5', '2', 6),
('6', '2', 6),
('9', '3', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
