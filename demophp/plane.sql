-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 09:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plane`
--
CREATE DATABASE IF NOT EXISTS `plane` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci;
USE `plane`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFlightStatistics` (IN `j_date` DATE)  BEGIN
 select flight_no,departure_date,IFNULL(no_of_passengers, 0) as no_of_passengers,total_capacity from (
select f.flight_no,f.departure_date,sum(t.no_of_passengers) as no_of_passengers,j.total_capacity 
from flight_details f left join ticket_details t 
on t.booking_status='PENDING' 
and t.flight_no=f.flight_no 
and f.departure_date=t.journey_date 
inner join jet_details j on j.jet_id=f.jet_id
group by flight_no,journey_date) k where departure_date=j_date;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `pwd` varchar(30) DEFAULT NULL,
  `staff_id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `pwd`, `staff_id`, `name`, `email`) VALUES
('admin', 'nghia', 'admin', 'Harry Roshan', 'harryroshan1997@gmail.com'),
('nghiameow', 'nghiameow', 'admin', 'Huu Nghia', 'nghia6063@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(20) NOT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `pwd`, `name`, `email`, `phone_no`, `address`) VALUES
('', '', 'nghia', 'ngaid@gmail.com', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('asdasda', '1234', 'ngaid@gmail.com', 'nghia', '0339941057', '25 duong so 7 phuong 10 quan tannSA'),
('conkhi', 'nghiameow', 'ngaid@gmail.com', 'nghia', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('conkhi2', 'nghiameow', 'ngaid@gmail.com', 'nghia', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('conkhi3', '213321313', 'ngaid@gmail.com', 'nghia', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('dasdadsada', 'dadada', 'ngaid@gmail.com', 'nghia', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('nghia', 'nghiameow', 'nguyen huu nghia', 'nghia6063@gmail.com', '0339941057', '23 duong a p10 '),
('nghia1', '123456789', 'nghia nguyen', 'KUMAR@GMAIL.COM', '1234567890', 'INDIANINDIA'),
('Nghia6063', 'nghia', 'ngaid@gmail.com', 'nghia', '09302392', '25 duong so 7 phuong 10 quan tannSA'),
('nghiaa', 'nghiaa', 'nghaaaa aa', 'nghia@gmail.com', '12345', 'aadith_address'),
('nghiaaa', 'nghiaaa', 'nghia', 'gmail@gmail.com', '+9185564764', 'hgsjhgdjfdjdgf'),
('nghiab', 'nghiab', 'meow meow', 'blah@gmail.com', '993498570', 'blah'),
('nghiac', 'nghiac', 'meow meow', 'charles@gmail.com', '9090909090', 'Bangalore'),
('nghiad', 'nghiad', 'meow meow', 'chirag@gmail.com', '8080808080', 'Kuldlu Gate'),
('nghiae', 'nghiae', 'nhanmgow', 'sanchit.muz@gmail.com', '1234569870', 'India'),
('nghias', 'nghias', 'nguyen huu nghia', 'harryroshan1997@gmai', '9845713736', '#381, 1st E Main,');

-- --------------------------------------------------------

--
-- Table structure for table `flight_details`
--

CREATE TABLE `flight_details` (
  `flight_no` varchar(10) NOT NULL,
  `from_city` varchar(20) DEFAULT NULL,
  `to_city` varchar(20) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `seats_economy` int(5) DEFAULT NULL,
  `seats_business` int(5) DEFAULT NULL,
  `price_economy` int(10) DEFAULT NULL,
  `price_business` int(10) DEFAULT NULL,
  `jet_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_details`
--

INSERT INTO `flight_details` (`flight_no`, `from_city`, `to_city`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `seats_economy`, `seats_business`, `price_economy`, `price_business`, `jet_id`) VALUES
('A01', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '22:00:00', 194, 96, 5000, 7500, 'NGHIA'),
('A02', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '12:00:00', 194, 73, 2500, 3000, 'NGHIA1'),
('A03', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '17:00:00', '17:45:00', 148, 75, 1200, 1500, 'A04'),
('A05', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '13:00:00', '14:00:00', 150, 75, 3000, 3750, 'A04'),
('A06', 'Japan', 'Korea', '2021-05-21', '2021-05-21', '10:00:00', '18:00:00', 232, 128, 7500, 12000, 'AMEOW'),
('AGOD', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '00:00:00', '18:00:00', 62, 63, 6969, 7856, 'AIRBUS70'),
('AMEOW', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '13:00:00', 69, 89, 6500, 7800, 'AGOD'),
('B01', 'Vietnam', 'Japan', '2021-05-22', '2021-05-21', '10:01:00', '18:00:00', 498, 65, 5788, 6966, 'AIR07'),
('BS92', 'Korea', 'Japan', '2021-05-21', '2021-05-21', '15:20:00', '17:30:00', 130, 40, 400, 1000, 'NGHIA2'),
('CB01', 'Vietnam', 'Japan', '2021-05-19', '2021-05-20', '21:30:00', '00:30:00', 118, 40, 300, 5400, 'NGHIA'),
('CB01', 'Cambodia', 'Vietnam', '2021-05-21', '2021-05-21', '12:00:00', '15:30:00', 130, 40, 200, 3000, 'AIRBUS70'),
('CB01', 'Thailand', 'Cambodia', '2021-05-30', '2021-05-31', '21:48:00', '00:50:00', 140, 30, 410, 4000, 'NGHIA2'),
('CS01', 'Vietnam', 'Singapore', '2021-05-21', '2021-05-21', '14:30:00', '18:00:00', 140, 60, 800, 3000, 'A04'),
('CS82', 'Myanmar', 'Singapore', '2021-05-22', '2021-05-22', '05:00:00', '12:00:00', 90, 20, 700, 1200, 'BOING707'),
('DIO09', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '14:30:00', 140, 40, 900, 2000, 'AGOD'),
('DV01', 'Vietnam', 'Japan', '2021-05-21', '2021-05-22', '21:00:00', '00:00:00', 60, 10, 200, 5000, 'NGHIA2'),
('JD19', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '07:00:00', '10:30:00', 130, 47, 300, 8000, 'AIR07'),
('KS09', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '14:40:00', '18:30:00', 100, 20, 410, 4000, 'BOING707'),
('M39', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '15:20:00', '19:20:00', 120, 30, 100, 900, 'AGOD'),
('ME92', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '11:00:00', '16:00:00', 80, 30, 300, 1200, 'AIRBUS707M'),
('QA', 'Myanmar', 'Japan', '2021-05-22', '2021-05-22', '10:50:00', '23:30:00', 500, 5000, 130, 20, 'AIR07'),
('TE01', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '07:00:00', '10:30:00', 98, 0, 300, 1300, 'AGOD'),
('WW92', 'Cambodia', 'Japan', '2021-05-22', '2021-05-23', '14:59:00', '10:00:00', 120, 40, 800, 9000, 'NGHIA2'),
('X02', 'Hong Kong', 'Japan', '2021-05-21', '2021-05-21', '03:00:00', '05:00:00', 100, 50, 400, 1000, 'BOING707'),
('XC09', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '14:30:00', '19:00:00', 90, 20, 120, 3200, 'AIR07');

-- --------------------------------------------------------

--
-- Table structure for table `frequent_flier_details`
--

CREATE TABLE `frequent_flier_details` (
  `frequent_flier_no` varchar(20) NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL,
  `mileage` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frequent_flier_details`
--

INSERT INTO `frequent_flier_details` (`frequent_flier_no`, `customer_id`, `mileage`) VALUES
('10001000', 'nghiaa', 375),
('20002000', 'nghias', 150);

-- --------------------------------------------------------

--
-- Table structure for table `jet_details`
--

CREATE TABLE `jet_details` (
  `jet_id` varchar(10) NOT NULL,
  `jet_type` varchar(20) DEFAULT NULL,
  `total_capacity` int(5) DEFAULT NULL,
  `active` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jet_details`
--

INSERT INTO `jet_details` (`jet_id`, `jet_type`, `total_capacity`, `active`) VALUES
('A04', 'Boeing 737', 225, 'Yes'),
('A05', 'Test_Model', 250, 'Yes'),
('AGOD', 'AIRBUS69-5526', 780, 'Yes'),
('AIR07', 'AIRBUS69-5527', 654, 'Yes'),
('AIRBUS70', 'AIRBUS69-5527', 655, 'Yes'),
('AIRBUS707M', '707 MAX', 596, 'Yes'),
('AMEOW', 'AIRBUS 707 MX', 400, 'Yes'),
('BOING707', 'BOING707-5569', 485, 'Yes'),
('NGHIA', 'Dreamliner', 300, 'Yes'),
('NGHIA1', 'Airbus A380', 275, 'Yes'),
('NGHIA2', 'ATR', 50, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(10) NOT NULL,
  `pnr` varchar(15) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `meal_choice` varchar(5) DEFAULT NULL,
  `frequent_flier_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `pnr`, `name`, `age`, `gender`, `meal_choice`, `frequent_flier_no`) VALUES
(1, '1483482', 'dsdasdad', 23, 'male', NULL, NULL),
(1, '1495129', 'Nguyen Huu Nghia', 20, 'male', NULL, NULL),
(1, '1669050', 'nghias', 20, 'male', 'yes', '20002000'),
(1, '2033264', 'nghiane', 25, 'female', 'yes', NULL),
(1, '2034424', 'grataeaa', 23, 'male', NULL, NULL),
(1, '2179656', 'nghiameow', 11, 'male', 'yes', NULL),
(1, '2369143', 'nghiasds', 20, 'male', 'yes', NULL),
(1, '2765843', 'nghiaaaaa', 23, 'male', NULL, NULL),
(1, '2776106', 'nghiaaaaa', 43, 'male', NULL, NULL),
(1, '2895029', 'Het BUG', 23, 'male', NULL, NULL),
(1, '2920481', 'Nguyen Huu Nghia', 20, 'male', NULL, NULL),
(1, '3027167', 'nghiaxx', 10, 'male', 'yes', NULL),
(1, '3163415', 'Duy Thanh', 34, 'male', NULL, NULL),
(1, '3216581', 'chingchong', 23, 'male', NULL, NULL),
(1, '3450636', 'dong trac', 34, 'male', NULL, NULL),
(1, '3472764', 'nam dan', 20, 'male', NULL, NULL),
(1, '3473275', 'Duy Thanh', 20, 'male', NULL, NULL),
(1, '3675176', 'Hoa', 23, 'male', NULL, NULL),
(1, '3695551', 'nghiaaaaa', 12, 'male', 'yes', NULL),
(1, '3773951', 'nghiaaa', 51, 'male', 'yes', NULL),
(1, '3817993', 'nghiazz', 23, 'male', 'yes', NULL),
(1, '3992275', 'nguyen huu nghia', 20, 'male', NULL, NULL),
(1, '4139487', 'Do not thing', 23, 'male', NULL, NULL),
(1, '4207708', 'OLOO', 23, 'male', 'yes', NULL),
(1, '4580857', 'Duy Thanh', 12, 'male', NULL, NULL),
(1, '4630669', 'Dave ', 23, 'male', NULL, NULL),
(1, '4797983', 'nghiazs', 34, 'male', 'yes', NULL),
(1, '4802675', 'nghiaaaaa', 12, 'male', NULL, NULL),
(1, '4807312', 'nghiasd', 22, 'male', 'yes', NULL),
(1, '4811085', 'nghiaaaaa', 23, 'male', NULL, NULL),
(1, '4896945', 'cat eat fish', 23, 'male', NULL, NULL),
(1, '5070445', 'nghiaaaaa', 21, 'male', NULL, NULL),
(1, '5160875', 'con meow', 23, 'male', NULL, NULL),
(1, '5272308', 'nghiaaas', 1, 'female', 'yes', NULL),
(1, '5317533', 'Minh Phong', 20, 'male', NULL, NULL),
(1, '5384076', 'gara ', 23, 'male', NULL, NULL),
(1, '5421865', 'nghiaas', 10, 'male', 'yes', NULL),
(1, '5584792', 'john wick', 22, 'male', NULL, NULL),
(1, '6070411', 'bao bo 45', 34, 'male', NULL, NULL),
(1, '6185328', 'dsdasdad', 12, 'male', 'yes', NULL),
(1, '6331818', 'Duy Thanh', 23, 'male', NULL, NULL),
(1, '6401154', 'john care', 23, 'male', NULL, NULL),
(1, '6585794', 'HEcl', 23, 'male', NULL, NULL),
(1, '6778624', 'dsdasdad', 34, 'male', NULL, NULL),
(1, '6881408', 'nghia meow', 22, 'male', 'yes', NULL),
(1, '6980157', 'Nghiax', 20, 'male', 'yes', NULL),
(1, '7093030', 'King', 23, 'male', NULL, NULL),
(1, '7217086', 'canand', 23, 'male', NULL, NULL),
(1, '7455490', 'ChingChong', 23, 'male', 'yes', NULL),
(1, '7681317', 'Cane', 21, 'male', NULL, NULL),
(1, '8257546', 'Rich', 23, 'male', NULL, NULL),
(1, '8362593', 'nghiaaaaa', 12, 'male', NULL, NULL),
(1, '8503285', 'MEo', 10, 'male', 'yes', '10001000'),
(1, '8607530', 'nam Dan', 20, 'male', 'yes', NULL),
(1, '8786339', 'nghiaaaaa', 12, 'male', 'yes', NULL),
(1, '8853446', 'Rebel', 23, 'female', NULL, NULL),
(1, '8943276', 'nghiaaaaa', 12, 'male', NULL, NULL),
(1, '9017393', 'nor', 12, 'male', NULL, NULL),
(1, '9288360', 'MEOWWW', 23, 'male', 'yes', NULL),
(1, '9378206', 'ahaha', 23, 'male', NULL, NULL),
(1, '9461372', 'nghiaaaaa', 51, 'female', NULL, NULL),
(1, '9712523', 'dau xanh', 23, 'male', NULL, NULL),
(1, '9748555', 'nghiaaaaa', 12, 'male', 'yes', NULL),
(2, '1483482', 'nor', 12, 'male', NULL, NULL),
(2, '1495129', 'Duy Thanh', 20, 'female', NULL, NULL),
(2, '1669050', 'NghiMoew', 45, 'female', 'yes', NULL),
(2, '2369143', 'NghiaMeow', 51, 'male', 'yes', NULL),
(2, '2765843', 'nghiaaaaa', 23, 'male', NULL, NULL),
(2, '2776106', 'nghiaaaaa1', 23, 'male', NULL, NULL),
(2, '3027167', 'nghiamaw', 20, 'male', 'yes', NULL),
(2, '3163415', 'bong', 23, 'male', NULL, NULL),
(2, '3216581', 'ChinChan', 32, 'male', NULL, NULL),
(2, '3450636', 'tao thao', 23, 'male', NULL, NULL),
(2, '3472764', 'nghia meow', 23, 'male', NULL, NULL),
(2, '3473275', 'Mew Dou', 21, 'male', NULL, NULL),
(2, '3675176', 'carose', 18, 'female', NULL, NULL),
(2, '3695551', '23qweq', 23, 'male', 'yes', NULL),
(2, '3773951', 'nghiasd', 42, 'female', 'yes', NULL),
(2, '3817993', 'nghiashd', 26, 'male', 'yes', NULL),
(2, '3992275', 'nghia meow ', 21, 'male', NULL, NULL),
(2, '4580857', 'BangBid', 23, 'male', NULL, NULL),
(2, '4630669', 'sanmanthan', 23, 'female', NULL, NULL),
(2, '4797983', 'nhisha', 20, 'male', 'yes', '20002000'),
(2, '4807312', 'nghias', 66, 'male', 'yes', NULL),
(2, '4811085', 'nghiaaaaa', 23, 'male', NULL, NULL),
(2, '5070445', 'nghiaaaaa', 12, 'male', NULL, NULL),
(2, '5160875', 'con ga con', 23, 'male', NULL, NULL),
(2, '5317533', 'john wick', 32, 'male', NULL, NULL),
(2, '5384076', 'naruto', 32, 'male', NULL, NULL),
(2, '5421865', 'nghiasda', 20, 'female', 'yes', NULL),
(2, '5584792', 'wanDa', 32, 'male', NULL, NULL),
(2, '6185328', 'aaaaa', 32, 'male', 'yes', NULL),
(2, '6331818', 'Minh Tam', 23, 'male', NULL, NULL),
(2, '6401154', 'meow Wick', 23, 'male', NULL, NULL),
(2, '6778624', 'nghiaaaaa', 23, 'male', NULL, NULL),
(2, '6881408', 'nghia Cop ', 22, 'male', 'yes', NULL),
(2, '6980157', 'nghiasda', 9, 'male', 'yes', NULL),
(2, '7093030', 'Kong', 23, 'male', NULL, NULL),
(2, '7681317', 'nor', 32, 'male', NULL, NULL),
(2, '8362593', 'nghiaaaaa', 23, 'male', NULL, NULL),
(2, '8503285', 'nghiashd', 20, 'male', 'yes', NULL),
(2, '8607530', 'nghia mew', 20, 'male', 'yes', NULL),
(2, '8786339', 'nghiaaaaa1', 23, 'male', 'yes', NULL),
(2, '8943276', 'dsdasdad', 23, 'male', NULL, NULL),
(2, '9017393', 'bar', 32, 'male', NULL, NULL),
(2, '9288360', 'nghiassd', 24, 'male', 'yes', NULL),
(2, '9461372', 'Duy Thanh', 49, 'male', NULL, NULL),
(2, '9712523', 'rau ma', 34, 'male', NULL, NULL),
(2, '9748555', 'nghiaaaaa', 23, 'male', 'yes', NULL),
(3, '1495129', 'MInTom', 90, 'male', NULL, NULL),
(3, '1669050', 'aadith_name', 10, 'male', 'yes', NULL),
(3, '2369143', 'blah', 10, 'male', 'yes', NULL),
(3, '3675176', 'Hieu', 20, 'female', NULL, NULL),
(3, '3773951', 'aadith', 11, 'male', 'yes', '10001000'),
(3, '4797983', 'aadith_name', 10, 'male', 'yes', '10001000'),
(3, '4807312', 'SURESH', 22, 'male', 'yes', NULL),
(3, '5421865', 'pass3', 30, 'male', 'yes', NULL),
(3, '7093030', 'Gozila', 34, 'male', NULL, NULL),
(4, '2369143', 'blah', 42, 'female', 'yes', NULL),
(4, '3675176', 'cana', 23, 'female', NULL, NULL),
(4, '4807312', 'RAMESH', 65, 'male', 'yes', NULL),
(5, '3675176', 'BigBang', 6, 'female', NULL, NULL),
(5, '4807312', 'SHYAMA', 22, 'female', 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` varchar(20) NOT NULL,
  `pnr` varchar(15) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` int(6) DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `pnr`, `payment_date`, `payment_amount`, `payment_mode`) VALUES
('120000248', '4797983', '2017-11-25', 4200, 'credit card'),
('142539461', '3773951', '2017-11-25', 4050, 'credit card'),
('164366850', '4630669', '2021-05-17', 3600, 'debit card'),
('165125569', '8503285', '2017-11-25', 7500, 'net banking'),
('175019387', '3992275', '2021-05-12', 6200, 'debit card'),
('224313914', '8257546', '2021-05-19', 7569, 'credit card'),
('252671280', '1483482', '2021-05-12', 6200, 'net banking'),
('305356978', '3992275', '2021-05-12', 6200, 'debit card'),
('317429169', '4207708', '2021-05-20', 7819, 'credit card'),
('343296918', '7217086', '2021-05-20', 7569, 'net banking'),
('357058874', '2895029', '2021-05-20', 7569, 'credit card'),
('381825165', '2920481', '2021-05-19', 7569, 'net banking'),
('423519897', '2033264', '2019-08-17', 6638, 'credit card'),
('443099962', '3675176', '2021-05-19', 6750, 'net banking'),
('445551202', '9378206', '2021-05-20', 7569, 'credit card'),
('460571289', '9572357', '2019-08-19', 25700, 'debit card'),
('467972527', '2369143', '2017-11-26', 33400, 'debit card'),
('530850428', '3695551', '2021-05-12', 2700, 'debit card'),
('534797734', '9461372', '2021-05-20', 16912, 'credit card'),
('552068876', '4139487', '2021-05-20', 7569, 'credit card'),
('557778944', '6980157', '2017-11-26', 11700, 'credit card'),
('600714462', '4896945', '2021-05-17', 5600, 'credit card'),
('613207644', '3163415', '2021-05-19', 15138, 'credit card'),
('620041544', '1669050', '2017-11-25', 4800, 'debit card'),
('665360715', '5421865', '2017-11-28', 15750, 'net banking'),
('679391479', '4807312', '2019-08-17', 26865, 'credit card'),
('706421140', '5317533', '2021-05-19', 1800, 'debit card'),
('713512870', '5160875', '2021-05-19', 1800, 'debit card'),
('723941040', '3817993', '2019-08-17', 19004, 'net banking'),
('729228045', '6881408', '2021-05-12', 2400, 'debit card'),
('757064819', '2538635', '2019-08-17', 4773, 'debit card'),
('780242457', '6585794', '2021-05-20', 7569, 'credit card'),
('822438763', '7093030', '2021-05-19', 5700, 'credit card'),
('827536483', '8853446', '2021-05-20', 7569, 'credit card'),
('853102860', '6070411', '2021-05-20', 7569, 'debit card'),
('862686553', '3027167', '2017-11-25', 10700, 'debit card'),
('880633544', '9288360', '2019-08-19', 25700, 'debit card'),
('936389160', '2179656', '2019-08-17', 6638, 'credit card'),
('952539062', '5272308', '2019-08-18', 7850, 'credit card'),
('964923880', '2034424', '2021-05-20', 7569, 'credit card'),
('988580479', '1495129', '2021-05-20', 25800, 'credit card');

--
-- Triggers `payment_details`
--
DELIMITER $$
CREATE TRIGGER `update_ticket_after_payment` AFTER INSERT ON `payment_details` FOR EACH ROW UPDATE ticket_details
     SET booking_status='PENDING', payment_id= NEW.payment_id
   WHERE pnr = NEW.pnr
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `pnr` varchar(15) NOT NULL,
  `date_of_reservation` date DEFAULT NULL,
  `flight_no` varchar(10) DEFAULT NULL,
  `journey_date` date DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `no_of_passengers` int(5) DEFAULT NULL,
  `lounge_access` varchar(5) DEFAULT NULL,
  `priority_checkin` varchar(5) DEFAULT NULL,
  `insurance` varchar(5) DEFAULT NULL,
  `payment_id` varchar(20) DEFAULT NULL,
  `customer_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`pnr`, `date_of_reservation`, `flight_no`, `journey_date`, `class`, `booking_status`, `no_of_passengers`, `lounge_access`, `priority_checkin`, `insurance`, `payment_id`, `customer_id`) VALUES
('1483482', '2021-05-12', 'A02', '2021-05-21', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '252671280', 'nghia'),
('2033264', '2021-05-21', 'B01', '2021-05-22', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '423519897', 'nghiae'),
('2179656', '2021-05-21', 'B01', '2021-05-22', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '936389160', 'nghia1'),
('2369143', '2021-05-20', 'A01', '2021-05-21', 'business', 'CONFIRMED', 4, 'yes', 'yes', 'yes', '467972527', 'nghiab'),
('2920481', '2021-05-19', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '381825165', 'nghia'),
('3027167', '2021-05-20', 'A01', '2021-05-21', 'economy', 'CONFIRMED', 2, 'no', 'no', 'yes', '862686553', 'nghiaa'),
('3163415', '2021-05-19', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '613207644', NULL),
('3992275', '2021-05-12', 'A02', '2021-05-21', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '175019387', 'nghia'),
('4207708', '2021-05-20', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '317429169', 'nghia'),
('4630669', '2021-05-17', 'A03', '2021-05-21', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '164366850', NULL),
('4896945', '2021-05-17', 'A01', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '600714462', NULL),
('5160875', '2021-05-19', 'TE01', '2021-05-21', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '713512870', NULL),
('5317533', '2021-05-19', 'CB01', '2021-05-19', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '706421140', 'nghia'),
('5421865', '2021-05-18', 'A01', '2021-05-21', 'economy', 'CONFIRMED', 3, 'no', 'no', 'no', '665360715', 'nghias'),
('6070411', '2021-05-20', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '853102860', 'nghia'),
('7093030', '2021-05-19', 'TE01', '2021-05-21', 'business', 'CONFIRMED', 3, 'yes', 'yes', 'yes', '822438763', 'nghia'),
('7217086', '2021-05-20', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '343296918', 'nghia'),
('8503285', '2021-05-18', 'A02', '2021-05-21', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'no', '165125569', 'nghiaa'),
('8853446', '2021-05-20', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '827536483', 'nghia'),
('9017393', '2021-05-12', 'AMEOW', '2021-05-21', 'Economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', NULL, NULL),
('9288360', '2021-05-14', 'A06', '2021-05-21', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '880633544', 'nghiae'),
('9378206', '2021-05-20', 'AGOD', '2021-05-21', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '445551202', 'nghia'),
('9461372', '2021-05-20', 'AGOD', '2021-05-21', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '534797734', 'nghia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD PRIMARY KEY (`flight_no`,`departure_date`) USING HASH,
  ADD KEY `jet_id` (`jet_id`);

--
-- Indexes for table `frequent_flier_details`
--
ALTER TABLE `frequent_flier_details`
  ADD PRIMARY KEY (`frequent_flier_no`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `jet_details`
--
ALTER TABLE `jet_details`
  ADD PRIMARY KEY (`jet_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`,`pnr`),
  ADD KEY `pnr` (`pnr`),
  ADD KEY `frequent_flier_no` (`frequent_flier_no`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `pnr` (`pnr`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`pnr`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `journey_date` (`journey_date`),
  ADD KEY `flight_no` (`flight_no`),
  ADD KEY `flight_no_2` (`flight_no`,`journey_date`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD CONSTRAINT `flight_details_ibfk_1` FOREIGN KEY (`jet_id`) REFERENCES `jet_details` (`jet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `frequent_flier_details`
--
ALTER TABLE `frequent_flier_details`
  ADD CONSTRAINT `frequent_flier_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`pnr`) REFERENCES `ticket_details` (`pnr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passengers_ibfk_2` FOREIGN KEY (`frequent_flier_no`) REFERENCES `frequent_flier_details` (`frequent_flier_no`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`pnr`) REFERENCES `ticket_details` (`pnr`) ON UPDATE CASCADE;

--
-- Constraints for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `ticket_details_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_details_ibfk_3` FOREIGN KEY (`flight_no`,`journey_date`) REFERENCES `flight_details` (`flight_no`, `departure_date`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
