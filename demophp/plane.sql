-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 02:17 PM
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
PROCEDURE `GetFlightStatistics` (IN `j_date` DATE)  BEGIN
 select flight_no,departure_date,IFNULL(no_of_passengers, 0) as no_of_passengers,total_capacity from (
select f.flight_no,f.departure_date,sum(t.no_of_passengers) as no_of_passengers,j.total_capacity 
from flight_details f left join ticket_details t 
on t.booking_status='CONFIRMED' 
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
('admin', 'nghia', 'admin', 'Harry Roshan', 'harryroshan1997@gmail.com');

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
('A01', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '21:00:00', '01:00:00', 195, 96, 5000, 7500, 'NGHIA'),
('A02', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '12:00:00', 200, 73, 2500, 3000, 'NGHIA1'),
('A03', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '17:00:00', '17:45:00', 150, 75, 1200, 1500, 'A04'),
('A04', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '09:00:00', '09:17:00', 37, 4, 500, 750, 'NGHIA2'),
('A05', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '13:00:00', '14:00:00', 150, 75, 3000, 3750, 'A04'),
('A06', 'Japan', 'Korea', '2021-05-21', '2021-05-21', '10:00:00', '18:00:00', 232, 128, 7500, 12000, 'AMEOW'),
('AGOD', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '00:00:00', '18:00:00', 75, 65, 6969, 7856, 'AIRBUS70'),
('AMEOW', 'Vietnam', 'Japan', '2021-05-21', '2021-05-21', '10:00:00', '13:00:00', 69, 89, 6500, 7800, 'AGOD'),
('AMEOW', 'Vietnam', 'Japan', '2021-05-22', '2021-05-21', '10:00:00', '15:00:00', 523, 76, 4523, 8652, 'AIR07'),
('B01', 'Vietnam', 'Japan', '2021-05-22', '2021-05-21', '10:01:00', '18:00:00', 498, 65, 5788, 6966, 'AIR07'),
('B02', 'Japan', 'Korea', '2021-05-21', '2021-05-21', '10:00:00', '13:00:00', 400, 21, 4500, 7000, 'BOING707');

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
('AMEOW', 'AIRBUS 707 MX', 400, 'No'),
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
(1, '1669050', 'nghias', 20, 'male', 'yes', '20002000'),
(1, '2033264', 'nghiane', 25, 'female', 'yes', NULL),
(1, '2179656', 'nghiameow', 11, 'male', 'yes', NULL),
(1, '2369143', 'nghiasds', 20, 'male', 'yes', NULL),
(1, '3027167', 'nghiaxx', 10, 'male', 'yes', NULL),
(1, '3773951', 'nghiaaa', 51, 'male', 'yes', NULL),
(1, '3817993', 'nghiazz', 23, 'male', 'yes', NULL),
(1, '4797983', 'nghiazs', 34, 'male', 'yes', NULL),
(1, '4807312', 'nghiasd', 22, 'male', 'yes', NULL),
(1, '5272308', 'nghiaaas', 1, 'female', 'yes', NULL),
(1, '5421865', 'nghiaas', 10, 'male', 'yes', NULL),
(1, '6980157', 'Nghiax', 20, 'male', 'yes', NULL),
(1, '8503285', 'MEo', 10, 'male', 'yes', '10001000'),
(1, '9288360', 'MEOWWW', 23, 'male', 'yes', NULL),
(2, '1669050', 'NghiMoew', 45, 'female', 'yes', NULL),
(2, '2369143', 'NghiaMeow', 51, 'male', 'yes', NULL),
(2, '3027167', 'nghiamaw', 20, 'male', 'yes', NULL),
(2, '3773951', 'nghiasd', 42, 'female', 'yes', NULL),
(2, '3817993', 'nghiashd', 26, 'male', 'yes', NULL),
(2, '4797983', 'nhisha', 20, 'male', 'yes', '20002000'),
(2, '4807312', 'nghias', 66, 'male', 'yes', NULL),
(2, '5421865', 'nghiasda', 20, 'female', 'yes', NULL),
(2, '6980157', 'nghiasda', 9, 'male', 'yes', NULL),
(2, '8503285', 'nghiashd', 20, 'male', 'yes', NULL),
(2, '9288360', 'nghiassd', 24, 'male', 'yes', NULL),
(3, '1669050', 'aadith_name', 10, 'male', 'yes', NULL),
(3, '2369143', 'blah', 10, 'male', 'yes', NULL),
(3, '3773951', 'aadith', 11, 'male', 'yes', '10001000'),
(3, '4797983', 'aadith_name', 10, 'male', 'yes', '10001000'),
(3, '4807312', 'SURESH', 22, 'male', 'yes', NULL),
(3, '5421865', 'pass3', 30, 'male', 'yes', NULL),
(4, '2369143', 'blah', 42, 'female', 'yes', NULL),
(4, '4807312', 'RAMESH', 65, 'male', 'yes', NULL),
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
('165125569', '8503285', '2017-11-25', 7500, 'net banking'),
('423519897', '2033264', '2019-08-17', 6638, 'credit card'),
('460571289', '9572357', '2019-08-19', 25700, 'debit card'),
('467972527', '2369143', '2017-11-26', 33400, 'debit card'),
('557778944', '6980157', '2017-11-26', 11700, 'credit card'),
('620041544', '1669050', '2017-11-25', 4800, 'debit card'),
('665360715', '5421865', '2017-11-28', 15750, 'net banking'),
('679391479', '4807312', '2019-08-17', 26865, 'credit card'),
('723941040', '3817993', '2019-08-17', 19004, 'net banking'),
('757064819', '2538635', '2019-08-17', 4773, 'debit card'),
('862686553', '3027167', '2017-11-25', 10700, 'debit card'),
('880633544', '9288360', '2019-08-19', 25700, 'debit card'),
('936389160', '2179656', '2019-08-17', 6638, 'credit card'),
('952539062', '5272308', '2019-08-18', 7850, 'credit card');

--
-- Triggers `payment_details`
--
DELIMITER $$
CREATE TRIGGER `update_ticket_after_payment` AFTER INSERT ON `payment_details` FOR EACH ROW UPDATE ticket_details
     SET booking_status='CONFIRMED', payment_id= NEW.payment_id
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
('1669050', '2021-05-20', 'A04', '2021-05-21', 'business', 'CONFIRMED', 3, 'yes', 'yes', 'yes', '620041544', 'nghias'),
('2033264', '2021-05-21', 'B01', '2021-05-22', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '423519897', 'nghiae'),
('2179656', '2021-05-21', 'B01', '2021-05-22', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '936389160', 'nghia1'),
('2369143', '2021-05-20', 'A01', '2021-05-21', 'business', 'CONFIRMED', 4, 'yes', 'yes', 'yes', '467972527', 'nghiab'),
('2538635', '2021-05-21', 'AMEOW', '2021-05-22', 'economy', 'CANCELED', 1, 'no', 'no', 'no', '757064819', 'nghiae'),
('2709472', '2021-05-20', NULL, NULL, NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL),
('3027167', '2021-05-20', 'A01', '2021-05-21', 'economy', 'CONFIRMED', 2, 'no', 'no', 'yes', '862686553', 'nghiaa'),
('3773951', '2021-05-20', 'A04', '2021-05-21', 'economy', 'CONFIRMED', 3, 'yes', 'yes', 'yes', '142539461', 'nghiaa'),
('3817993', '2021-05-10', 'AMEOW', '2021-05-22', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '723941040', 'nghiae'),
('4797983', '2021-05-18', 'A04', '2021-05-21', 'business', 'CONFIRMED', 3, 'yes', 'no', 'yes', '120000248', 'nghias'),
('4807312', '2019-08-17', 'AMEOW', '2021-05-22', 'economy', 'CANCELED', 5, 'yes', 'yes', 'yes', '679391479', 'nghiae'),
('5272308', '2021-05-19', 'B02', '2021-05-21', 'business', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '952539062', 'nghiae'),
('5421865', '2021-05-18', 'A01', '2021-05-21', 'economy', 'CONFIRMED', 3, 'no', 'no', 'no', '665360715', 'nghias'),
('6980157', '2021-05-17', 'A01', '2021-05-21', 'economy', 'CANCELED', 2, 'yes', 'yes', 'yes', '557778944', 'nghiaa'),
('8503285', '2021-05-18', 'A02', '2021-05-21', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'no', '165125569', 'nghiaa'),
('9288360', '2021-05-14', 'A06', '2021-05-21', 'business', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '880633544', 'nghiae'),
('9572357', '2021-05-11', 'A06', '2021-05-21', 'business', 'CANCELED', 2, 'yes', 'yes', 'yes', '460571289', 'nghiae');

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
  ADD PRIMARY KEY (`flight_no`,`departure_date`),
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
