-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 09:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracknbook`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancel_reservation` (IN `res_tkt_id` VARCHAR(20))   BEGIN
    UPDATE tbl_reservation
    SET reservation_status = 'Cancelled'
    WHERE reservation_ticket_id = res_tkt_id;

    -- Move the canceled reservation to tbl_reservation_cancelled
    INSERT INTO tbl_reservation_cancelled (
        reservation_id,
        reservation_ticket_id, 
        reservation_passenger_id, 
        reservation_start_station, 
        reservation_end_station, 
        reservation_train_id, 
        reservation_compartment_id, 
        reservation_date, 
        reservation_seat, 
        reservation_passenger_title, 
        reservation_passenger_first_name, 
        reservation_passenger_last_name, 
        reservation_passenger_nic, 
        reservation_passenger_phone_number, 
        reservation_passenger_email, 
        reservation_passenger_gender, 
        reservation_created_time, 
        reservation_status,
        reservation_type,
        reservation_refund_status,
        reservation_refund_amount
    )
    SELECT 
        reservation_id,
        reservation_ticket_id, 
        reservation_passenger_id, 
        reservation_start_station, 
        reservation_end_station, 
        reservation_train_id, 
        reservation_compartment_id, 
        reservation_date, 
        reservation_seat, 
        reservation_passenger_title, 
        reservation_passenger_first_name, 
        reservation_passenger_last_name, 
        reservation_passenger_nic, 
        reservation_passenger_phone_number, 
        reservation_passenger_email, 
        reservation_passenger_gender, 
        reservation_created_time, 
        'Cancelled',
        reservation_type,
        'No Refund',
        0
    FROM tbl_reservation
    WHERE reservation_ticket_id = res_tkt_id;
    
    DELETE FROM tbl_reservation WHERE reservation_ticket_id = res_tkt_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `expire_reservation` (IN `res_id` INT)   BEGIN
    UPDATE tbl_reservation
    SET reservation_status = 'Expired'
    WHERE reservation_id = res_id;

    -- Move the canceled reservation to tbl_reservation_cancelled
    INSERT INTO tbl_reservation_expired (
        reservation_id,
        reservation_ticket_id, 
        reservation_passenger_id, 
        reservation_start_station, 
        reservation_end_station, 
        reservation_train_id, 
        reservation_compartment_id, 
        reservation_date, 
        reservation_seat, 
        reservation_passenger_title, 
        reservation_passenger_first_name, 
        reservation_passenger_last_name, 
        reservation_passenger_nic, 
        reservation_passenger_phone_number, 
        reservation_passenger_email, 
        reservation_passenger_gender, 
        reservation_created_time, 
        reservation_status
    )
    SELECT 
        reservation_id,
        reservation_ticket_id, 
        reservation_passenger_id, 
        reservation_start_station, 
        reservation_end_station, 
        reservation_train_id, 
        reservation_compartment_id, 
        reservation_date, 
        reservation_seat, 
        reservation_passenger_title, 
        reservation_passenger_first_name, 
        reservation_passenger_last_name, 
        reservation_passenger_nic, 
        reservation_passenger_phone_number, 
        reservation_passenger_email, 
        reservation_passenger_gender, 
        reservation_created_time, 
        'Expired'
    FROM tbl_reservation
    WHERE reservation_id = res_id;
    
    DELETE FROM tbl_reservation WHERE reservation_id = res_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reject_warrant_reservation` (IN `res_tkt_id` VARCHAR(30))   BEGIN
    UPDATE tbl_reservation
    SET reservation_status = 'Rejected'
    WHERE reservation_ticket_id = res_tkt_id;

    -- Move the rejected reservation to tbl_warrant_reservation_rejected
    INSERT INTO tbl_warrant_reservation_rejected(
        reservation_id,
        reservation_ticket_id, 
        reservation_passenger_id, 
        warrant_image_id,
        reservation_start_station, 
        reservation_end_station, 
        reservation_train_id, 
        reservation_compartment_id, 
        reservation_date, 
        reservation_seat, 
        reservation_passenger_title, 
        reservation_passenger_first_name, 
        reservation_passenger_last_name, 
        reservation_passenger_nic, 
        reservation_passenger_phone_number, 
        reservation_passenger_email, 
        reservation_passenger_gender, 
        reservation_created_time, 
        reservation_status
    )
    SELECT 
        r.reservation_id,
        r.reservation_ticket_id, 
        r.reservation_passenger_id, 
        wr.warrant_image_id,
        r.reservation_start_station, 
        r.reservation_end_station, 
        r.reservation_train_id, 
        r.reservation_compartment_id, 
        r.reservation_date, 
        r.reservation_seat, 
        r.reservation_passenger_title, 
        r.reservation_passenger_first_name, 
        r.reservation_passenger_last_name, 
        r.reservation_passenger_nic, 
        r.reservation_passenger_phone_number, 
        r.reservation_passenger_email, 
        r.reservation_passenger_gender, 
        r.reservation_created_time, 
        'Rejected'
    FROM tbl_reservation r
    JOIN tbl_warrant_reservation wr ON r.reservation_id = wr.warrant_reservation_id
    WHERE reservation_ticket_id = res_tkt_id;
    
    DELETE FROM tbl_reservation WHERE reservation_ticket_id = res_tkt_id;
    DELETE FROM tbl_warrant_reservation WHERE warrant_image_id = (
    	SELECT wr.warrant_image_id
        FROM tbl_warrant_reservation wr 
        JOIN tbl_reservation r ON r.reservation_id = wr.warrant_reservation_id
        WHERE r.reservation_ticket_id = res_tkt_id        
    );

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compartment`
--

CREATE TABLE `tbl_compartment` (
  `compartment_id` int(11) NOT NULL,
  `compartment_train_id` int(11) NOT NULL,
  `compartment_class` varchar(11) NOT NULL DEFAULT '3',
  `compartment_class_type` int(11) NOT NULL,
  `compartment_seat_layout` varchar(15) NOT NULL,
  `compartment_total_seats` int(100) NOT NULL,
  `compartment_total_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_compartment`
--

INSERT INTO `tbl_compartment` (`compartment_id`, `compartment_train_id`, `compartment_class`, `compartment_class_type`, `compartment_seat_layout`, `compartment_total_seats`, `compartment_total_number`) VALUES
(1, 1, '1', 1, '2x2', 3, 1),
(2, 1, '2', 4, '2x2', 48, 1),
(3, 1, '3', 3, '2x3', 50, 1),
(22, 2, '1', 1, '2x2', 48, 1),
(23, 2, '2', 4, '2x2', 48, 1),
(24, 2, '3', 3, '2x3', 48, 1),
(112, 7, '1', 1, '2x2', 48, 1),
(113, 7, '2', 3, '2x2', 48, 1),
(114, 7, '3', 4, '2x2', 48, 1),
(163, 4, '1', 5, '2x2', 48, 1),
(164, 4, '2', 4, '2x2', 48, 1),
(165, 4, '3', 3, '2x2', 48, 1),
(166, 3, '1', 1, '2x2', 48, 1),
(167, 3, '2', 5, '2x2', 48, 1),
(168, 3, '3', 3, '2x2', 48, 1),
(172, 6, 'AFC', 1, '2x2', 48, 2),
(173, 6, '2nd class', 3, '2x2', 48, 1),
(174, 6, '3rd class', 4, '2x2', 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compartment_class_type`
--

CREATE TABLE `tbl_compartment_class_type` (
  `compartment_class_type_id` int(11) NOT NULL,
  `compartment_class_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_compartment_class_type`
--

INSERT INTO `tbl_compartment_class_type` (`compartment_class_type_id`, `compartment_class_type`) VALUES
(1, 'AFC'),
(2, '1st class Reservation'),
(3, '2nd class Reservation'),
(4, '3rd class Reservation'),
(5, '1st class with OFV & AFC'),
(6, 'Sleeplets');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disable_period`
--

CREATE TABLE `tbl_disable_period` (
  `disable_period_id` int(11) NOT NULL,
  `disable_period_start_date` date NOT NULL,
  `disable_period_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fare`
--

CREATE TABLE `tbl_fare` (
  `fare_id` int(11) NOT NULL,
  `fare_train_type_id` int(11) NOT NULL,
  `fare_compartment_id` int(11) NOT NULL,
  `fare_route_id` int(11) NOT NULL,
  `fare_start_station` int(11) NOT NULL,
  `fare_end_station` int(11) NOT NULL,
  `fare_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_fare`
--

INSERT INTO `tbl_fare` (`fare_id`, `fare_train_type_id`, `fare_compartment_id`, `fare_route_id`, `fare_start_station`, `fare_end_station`, `fare_price`) VALUES
(1, 1, 1, 1, 1, 2, 2000),
(2, 1, 1, 1, 1, 12, 2800),
(3, 1, 1, 1, 1, 14, 3000),
(4, 1, 1, 1, 2, 1, 2000),
(5, 1, 1, 1, 2, 12, 2500),
(6, 1, 1, 1, 2, 14, 3000),
(7, 1, 1, 1, 12, 1, 2800),
(8, 1, 1, 1, 12, 2, 2500),
(9, 1, 1, 1, 12, 14, 2000),
(10, 1, 1, 1, 14, 1, 3000),
(11, 1, 1, 1, 14, 2, 3000),
(12, 1, 1, 1, 14, 12, 2000),
(13, 1, 3, 1, 1, 2, 900),
(14, 1, 3, 1, 1, 12, 1800),
(15, 1, 3, 1, 1, 14, 1500),
(16, 1, 3, 1, 2, 1, 900),
(17, 1, 3, 1, 2, 12, 1700),
(18, 1, 3, 1, 2, 14, 1800),
(19, 1, 3, 1, 12, 1, 1800),
(20, 1, 3, 1, 12, 2, 1700),
(21, 1, 3, 1, 12, 14, 1200),
(22, 1, 3, 1, 14, 1, 1500),
(23, 1, 3, 1, 14, 2, 1800),
(24, 1, 3, 1, 14, 12, 1200),
(25, 1, 4, 1, 1, 2, 1200),
(26, 1, 4, 1, 1, 12, 1800),
(27, 1, 4, 1, 1, 14, 2000),
(28, 1, 4, 1, 2, 1, 1200),
(29, 1, 4, 1, 2, 12, 1700),
(30, 1, 4, 1, 2, 14, 1800),
(31, 1, 4, 1, 12, 1, 1800),
(32, 1, 4, 1, 12, 2, 1700),
(33, 1, 4, 1, 12, 14, 1200),
(34, 1, 4, 1, 14, 1, 2000),
(35, 1, 4, 1, 14, 2, 1800),
(36, 1, 4, 1, 14, 12, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE `tbl_image` (
  `user_id` int(11) NOT NULL,
  `image_name` varchar(500) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `image_type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`user_id`, `image_name`, `image_path`, `image_type`) VALUES
(2, '6623f411f377a9.81664244.jpg', 'userImg/6623f411f377a9.81664244.jpg', 'image/jpeg'),
(18, '662268f458dde6.00188545.jpg', 'userImg/662268f458dde6.00188545.jpg', 'image/jpeg'),
(19, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(20, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(21, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(22, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(23, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(24, '661a5d81000ff2.32160264.jpg', 'userImg/661a5d81000ff2.32160264.jpg', 'image/jpeg'),
(25, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(26, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(27, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(2, '6623f411f377a9.81664244.jpg', 'userImg/6623f411f377a9.81664244.jpg', 'image/jpeg'),
(18, '662268f458dde6.00188545.jpg', 'userImg/662268f458dde6.00188545.jpg', 'image/jpeg'),
(19, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(20, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(21, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(22, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(23, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(24, '661a5d81000ff2.32160264.jpg', 'userImg/661a5d81000ff2.32160264.jpg', 'image/jpeg'),
(25, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(26, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(27, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(30, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(33, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(34, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(35, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(36, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(37, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(45, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(47, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(49, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(50, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(51, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(52, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(53, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(55, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(56, 'default.jpg', 'userImg/default.jpg', 'image/jpg'),
(57, 'default.jpg', 'userImg/default.jpg', 'image/jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(60) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `login_username`, `login_password`, `user_id`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(18, 'rav', 'c555a8cdf623ff526c8cebe9fdf8cd9d', 18),
(19, 'staff_ticketing', '792aee01c1f023fa484da5e7680ff539', 19),
(20, 'train_driver', '66be9d74dd52fa2806d6871bdeba50df', 20),
(21, 'staff_general', 'e5e07577c1c9967935069521c5a61db3', 21),
(22, 'station_master', '73d3fa8e4a923b2a6e2ef9e4f8ccc85b', 22),
(23, 'ticket_checker', '7536f681b3a4e610d70ff179e4da5890', 23),
(24, 'passenger', 'd41d8cd98f00b204e9800998ecf8427e', 24),
(25, 'akon', 'ac6b00dec130960b92aadf44de37df21', 25),
(26, 'bkon', '38d06b02e7b7a93dfd3a855f51b7baef', 26),
(27, 'ckon', '52f3d0c03dc7b0bb91015ace148b7924', 27),
(30, 'fkon', 'b8561e9954bd299bd7fe278fe4a8a84a', 30),
(32, 'negomboSM', '6f6e2f2dbf087e7ebd311591deec6883', 32),
(33, 'kandysm', '21eaacd2216c853c5d8a7c368be2190c', 33),
(34, 'staff_general2', 'c81e728d9d4c2f636f067f89cc14862c', 34),
(35, 'cmbsm', '09d124203077d477650d3b500d6ff341', 35),
(36, 'smt', 'd8cc653b02f7897915cdd2ee65540ac0', 36),
(37, 'stb', 'e2c105408da55d8017215f192b782fd3', 37),
(44, 'td', 'c4ca4238a0b923820dcc509a6f75849b', 44),
(45, 'tdsds', 'c4ca4238a0b923820dcc509a6f75849b', 45),
(47, 'tf', 'c4ca4238a0b923820dcc509a6f75849b', 47),
(49, 'rd', 'eeec033a2c4d56d7ba16b69358779091', 49),
(50, 'tcc', 'dcbacadf485c141a2b9b0028f2c0b2e1', 50),
(51, 'ti', 'e00fba6fedfb8a49e13346f7099a23fc', 51),
(52, 'tddd', '98484a3066acc49746cca0311b9654e4', 52),
(53, 'ticket_checker_1', 'f6480750bd3612b2ec76e1f7b5d3268c', 53),
(55, 'station_master_1', '5664bae78fc1bd444206fb1e1eb31c0d', 55),
(56, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 56),
(57, 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', 57);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_passengers`
--

CREATE TABLE `tbl_passengers` (
  `passenger_i` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `passenger_email` varchar(50) NOT NULL,
  `passenger_nic` varchar(13) NOT NULL,
  `passenger_email_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_passengers`
--

INSERT INTO `tbl_passengers` (`passenger_i`, `passenger_id`, `passenger_email`, `passenger_nic`, `passenger_email_verified`) VALUES
(4, 18, 'dalpaduravien@gmail.com', '200123602078', 1),
(5, 24, 'dalpaduravien@gmail.com', '200123602078', 1),
(6, 25, 'dalpaduravien@gmail.com', '123123602078', 1),
(7, 26, 'dalpaduravien@gmail.com', '123123602078', 1),
(8, 27, 'dalpaduravien@gmail.com', '200123602071', 1),
(11, 30, 'dalpataduravien@gmail.com', '200123602078', 1),
(13, 56, 'dalpataduravien@gmail.com', '200123602078', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_ticket_id` varchar(20) NOT NULL,
  `reservation_passenger_id` int(11) NOT NULL,
  `reservation_start_station` int(11) NOT NULL,
  `reservation_end_station` int(11) NOT NULL,
  `reservation_train_id` int(11) NOT NULL,
  `reservation_compartment_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_seat` int(20) NOT NULL,
  `reservation_passenger_title` varchar(5) NOT NULL,
  `reservation_passenger_first_name` varchar(50) NOT NULL,
  `reservation_passenger_last_name` varchar(50) NOT NULL,
  `reservation_passenger_nic` bigint(12) NOT NULL,
  `reservation_passenger_phone_number` varchar(13) NOT NULL,
  `reservation_passenger_email` varchar(50) NOT NULL,
  `reservation_passenger_gender` varchar(10) NOT NULL,
  `reservation_created_time` datetime DEFAULT current_timestamp(),
  `reservation_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `reservation_type` varchar(10) NOT NULL DEFAULT 'Normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`reservation_id`, `reservation_ticket_id`, `reservation_passenger_id`, `reservation_start_station`, `reservation_end_station`, `reservation_train_id`, `reservation_compartment_id`, `reservation_date`, `reservation_seat`, `reservation_passenger_title`, `reservation_passenger_first_name`, `reservation_passenger_last_name`, `reservation_passenger_nic`, `reservation_passenger_phone_number`, `reservation_passenger_email`, `reservation_passenger_gender`, `reservation_created_time`, `reservation_status`, `reservation_type`) VALUES
(7, '20240408171205-2352', 18, 1, 2, 1, 1, '2024-04-30', 4, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'verified', 'Warrant'),
(8, '20240408185528-9248', 18, 1, 2, 1, 3, '2024-04-30', 3, 'Mr.', 'Prabhath', 'sangeewa', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Reserved', 'Warrant'),
(58, '20240419175146-8034', 18, 1, 14, 1, 3, '2024-04-30', 50, 'Mr.', 'jkkk', 'vvg', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Reserved', 'Warrant'),
(65, 'TMP20240410070810-42', 18, 1, 2, 1, 2, '2024-04-30', 36, 'Mr.', 'Shikaaaaaaaaa', 'sangeewa', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(68, 'TMP20240411102448-90', 18, 1, 2, 1, 1, '2024-04-30', 48, 'Mr.', 'Prabhath', 'sangeewa', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(78, '20240411195757-7828', 18, 1, 2, 1, 3, '2024-04-30', 46, 'Mr.', 'Prabhath', 'liyanage', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '0000-00-00 00:00:00', 'Reserved', 'Normal'),
(80, '20240412051334-1426', 18, 1, 2, 1, 3, '2024-05-07', 8, 'Mr.', 'Prabhath', 'liyanage', 200223405078, '0718118969', 'ravienkavisha@gmail.com', 'male', '0000-00-00 00:00:00', 'Reserved', 'Normal'),
(81, '20240412051334-1426', 18, 1, 2, 1, 3, '2024-05-07', 9, 'Mr.', 'Kavisha', 'dalpe', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'female', '0000-00-00 00:00:00', 'Reserved', 'Normal'),
(88, 'TMP20240414053015-73', 18, 1, 12, 1, 3, '2024-04-23', 1, 'Mr.', 'Ravien', 'Dalpatadu', 200123602078, '0701949400', 'dalpataduravien@gmail.com', 'male', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(90, 'TMP20240414053434-91', 18, 1, 2, 1, 3, '2024-04-16', 1, 'Mr.', 'Prabhath', 'sangeewa', 530673880, '0718118969', 'dalpataduravien@gmail.com', 'male', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(147, 'TMP20240414174551-32', 18, 1, 2, 1, 1, '2024-04-15', 1, 'Mr.', 'Prabhath', 'liyanage', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(148, 'TMP20240414174551-32', 18, 1, 2, 1, 1, '2024-04-15', 2, 'Mr.', 'Prabhath', 'henn', 200123569878, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(149, '20240414175025-9746', 18, 1, 2, 1, 1, '2024-04-15', 3, 'Mr.', 'moushika', 'dalpe', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '0000-00-00 00:00:00', 'Reserved', 'Normal'),
(150, 'TMP20240415183002-12', 25, 1, 2, 1, 1, '2024-04-16', 1, 'Mr.', 'Prabhath', 'sangeewa', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(151, 'TMP20240415183002-12', 25, 1, 2, 1, 1, '2024-04-16', 2, 'Mr.', 'Prabhath', 'sangeewa', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(152, 'TMP20240415183002-12', 25, 1, 2, 1, 1, '2024-04-16', 3, 'Mr.', 'Prabhath', 'dalpe', 256523651547, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Approval Pending', 'Warrant'),
(155, '20240417091412-4501', 18, 1, 2, 1, 1, '2024-04-18', 1, 'Mr.', 'sda', 'ddadas', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'female', '2024-04-17 12:34:39', 'Reserved', 'Normal'),
(156, '20240417091412-4501', 18, 1, 2, 1, 1, '2024-04-18', 2, 'Mr.', 'Prabhath', 'sangeewa', 200012659800, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-17 12:34:39', 'Reserved', 'Normal'),
(157, '20240417091412-4501', 18, 1, 2, 1, 1, '2024-04-18', 3, 'Mr.', 'Prabhath', 'henn', 530673880, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-17 12:34:39', 'Reserved', 'Normal'),
(161, '', 18, 1, 12, 1, 1, '2024-04-30', 3, '', '', '', 0, '', '', '', '2024-04-19 07:27:57', 'Pending', 'Normal');

--
-- Triggers `tbl_reservation`
--
DELIMITER $$
CREATE TRIGGER `warrent_insert` AFTER UPDATE ON `tbl_reservation` FOR EACH ROW BEGIN
    IF NEW.reservation_type = 'Warrant' AND OLD.reservation_type != 'Warrant' THEN
        INSERT INTO tbl_warrant_reservation (
            warrant_reservation_id
        )
        VALUES (
            NEW.reservation_id
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation_cancelled`
--

CREATE TABLE `tbl_reservation_cancelled` (
  `reservation_id` int(11) NOT NULL,
  `reservation_ticket_id` varchar(20) NOT NULL,
  `reservation_passenger_id` int(11) NOT NULL,
  `reservation_start_station` int(11) NOT NULL,
  `reservation_end_station` int(11) NOT NULL,
  `reservation_train_id` int(11) NOT NULL,
  `reservation_compartment_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_seat` int(20) NOT NULL,
  `reservation_passenger_title` varchar(5) NOT NULL,
  `reservation_passenger_first_name` varchar(50) NOT NULL,
  `reservation_passenger_last_name` varchar(50) NOT NULL,
  `reservation_passenger_nic` bigint(12) NOT NULL,
  `reservation_passenger_phone_number` varchar(13) NOT NULL,
  `reservation_passenger_email` varchar(50) NOT NULL,
  `reservation_passenger_gender` varchar(10) NOT NULL,
  `reservation_created_time` datetime DEFAULT NULL,
  `reservation_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `reservation_type` text DEFAULT NULL,
  `reservation_refund_status` varchar(20) NOT NULL DEFAULT 'No Refund',
  `reservation_refund_amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_reservation_cancelled`
--

INSERT INTO `tbl_reservation_cancelled` (`reservation_id`, `reservation_ticket_id`, `reservation_passenger_id`, `reservation_start_station`, `reservation_end_station`, `reservation_train_id`, `reservation_compartment_id`, `reservation_date`, `reservation_seat`, `reservation_passenger_title`, `reservation_passenger_first_name`, `reservation_passenger_last_name`, `reservation_passenger_nic`, `reservation_passenger_phone_number`, `reservation_passenger_email`, `reservation_passenger_gender`, `reservation_created_time`, `reservation_status`, `reservation_type`, `reservation_refund_status`, `reservation_refund_amount`) VALUES
(47, '20240130082224-8415', 40, 1, 2, 4, 12, '2024-01-30', 1, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(49, '20240131182147-9317', 40, 1, 2, 1, 1, '2024-01-31', 1, 'Mr.', 'Prabhath', 'wije', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(117, '20240219131504-8020', 40, 1, 12, 1, 2, '2024-03-05', 1, 'Mr.', 'Prabhath', 'liyanage', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(71, '20240201203059-9626', 40, 1, 2, 1, 2, '2024-03-04', 13, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(72, '20240201203059-9626', 40, 1, 2, 1, 2, '2024-03-04', 14, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(75, '20240201205250-4613', 40, 1, 2, 1, 2, '2024-03-04', 1, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(81, '20240212055622-6326', 40, 1, 2, 1, 1, '2024-02-27', 1, 'Mr.', 'Prabhath', 'sadsad', 200123602067, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(149, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 1, 'Mr.', 'ravein', 'ewrw', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(150, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 2, 'Mr.', 'thanuja', 'hennaaa', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(151, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 3, 'Mr.', 'Prabhath', 'sangeewa', 200012659800, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(158, '20240310042432-1216', 40, 1, 2, 1, 1, '2024-03-04', 1, 'Mrs.', 'Namalie', 'Liyanage', 530673880, '0718045940', 'namalie_69@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(1, '20240130075000-7183', 40, 1, 2, 4, 12, '2024-01-30', 2, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(74, '20240201204354-2578', 40, 1, 12, 1, 2, '2024-03-04', 2, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(177, '20240311054726-6123', 40, 1, 12, 1, 1, '2024-03-24', 1, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(178, '20240311054726-6123', 40, 1, 12, 1, 1, '2024-03-24', 5, 'Mr.', 'sada', 'dsa', 200012659800, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(4, '20240408115213-4158', 18, 1, 2, 1, 1, '2024-04-30', 1, 'Mr.', 'Prabhath', 'sangeewa', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(9, '20240409084928-5152', 18, 1, 2, 1, 2, '2024-04-30', 1, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', 'Warrant', '0', 0),
(28, '20240409141416-6238', 18, 2, 1, 2, 4, '2024-05-01', 1, 'Mr.', 'fdasd', 'sda', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', 'Normal', '0', 0),
(47, '20240130082224-8415', 40, 1, 2, 4, 12, '2024-01-30', 1, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(49, '20240131182147-9317', 40, 1, 2, 1, 1, '2024-01-31', 1, 'Mr.', 'Prabhath', 'wije', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(117, '20240219131504-8020', 40, 1, 12, 1, 2, '2024-03-05', 1, 'Mr.', 'Prabhath', 'liyanage', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(71, '20240201203059-9626', 40, 1, 2, 1, 2, '2024-03-04', 13, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(72, '20240201203059-9626', 40, 1, 2, 1, 2, '2024-03-04', 14, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(75, '20240201205250-4613', 40, 1, 2, 1, 2, '2024-03-04', 1, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(81, '20240212055622-6326', 40, 1, 2, 1, 1, '2024-02-27', 1, 'Mr.', 'Prabhath', 'sadsad', 200123602067, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(149, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 1, 'Mr.', 'ravein', 'ewrw', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(150, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 2, 'Mr.', 'thanuja', 'hennaaa', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(151, '20240220174801-5568', 40, 1, 12, 1, 1, '2024-02-29', 3, 'Mr.', 'Prabhath', 'sangeewa', 200012659800, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(158, '20240310042432-1216', 40, 1, 2, 1, 1, '2024-03-04', 1, 'Mrs.', 'Namalie', 'Liyanage', 530673880, '0718045940', 'namalie_69@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(1, '20240130075000-7183', 40, 1, 2, 4, 12, '2024-01-30', 2, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(74, '20240201204354-2578', 40, 1, 12, 1, 2, '2024-03-04', 2, 'Mr.', 'Prabhath', 'dalpe', 200123602078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '2024-02-19 19:46:20', 'Cancelled', NULL, '0', 0),
(177, '20240311054726-6123', 40, 1, 12, 1, 1, '2024-03-24', 1, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(178, '20240311054726-6123', 40, 1, 12, 1, 1, '2024-03-24', 5, 'Mr.', 'sada', 'dsa', 200012659800, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(4, '20240408115213-4158', 18, 1, 2, 1, 1, '2024-04-30', 1, 'Mr.', 'Prabhath', 'sangeewa', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', NULL, '0', 0),
(9, '20240409084928-5152', 18, 1, 2, 1, 2, '2024-04-30', 1, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', 'Warrant', '0', 0),
(28, '20240409141416-6238', 18, 2, 1, 2, 4, '2024-05-01', 1, 'Mr.', 'fdasd', 'sda', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Cancelled', 'Normal', '0', 0),
(66, 'TMP20240410190458-19', 18, 1, 2, 1, 1, '2024-04-30', 31, 'Mr.', 'Namalie', 'liyanage', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Cancelled', 'Warrant', '0', 0),
(162, 'TMP20240419160026-78', 18, 1, 12, 1, 1, '2024-04-23', 1, 'Mr.', 'Prabhath', 'sangeewa', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-19 07:29:10', 'Cancelled', 'Warrant', '0', 0),
(163, 'TMP20240419160026-78', 18, 1, 12, 1, 1, '2024-04-23', 2, 'Mr.', 'Prabhath 2', 'dalpe', 200223405090, '0718118969', 'dalpataduravien@gmail.com', 'female', '2024-04-19 07:29:10', 'Cancelled', 'Warrant', '0', 0),
(164, 'TMP20240419160026-78', 18, 1, 12, 1, 1, '2024-04-23', 3, 'Mr.', 'Prabhath 3', 'henn', 299123569878, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-19 07:29:10', 'Cancelled', 'Warrant', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation_expired`
--

CREATE TABLE `tbl_reservation_expired` (
  `reservation_id` int(11) NOT NULL,
  `reservation_ticket_id` varchar(20) NOT NULL,
  `reservation_passenger_id` int(11) NOT NULL,
  `reservation_start_station` int(11) NOT NULL,
  `reservation_end_station` int(11) NOT NULL,
  `reservation_train_id` int(11) NOT NULL,
  `reservation_compartment_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_seat` int(20) NOT NULL,
  `reservation_passenger_title` varchar(5) NOT NULL,
  `reservation_passenger_first_name` varchar(50) NOT NULL,
  `reservation_passenger_last_name` varchar(50) NOT NULL,
  `reservation_passenger_nic` bigint(12) NOT NULL,
  `reservation_passenger_phone_number` varchar(13) NOT NULL,
  `reservation_passenger_email` varchar(50) NOT NULL,
  `reservation_passenger_gender` varchar(10) NOT NULL,
  `reservation_created_time` datetime DEFAULT current_timestamp(),
  `reservation_status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_reservation_expired`
--

INSERT INTO `tbl_reservation_expired` (`reservation_id`, `reservation_ticket_id`, `reservation_passenger_id`, `reservation_start_station`, `reservation_end_station`, `reservation_train_id`, `reservation_compartment_id`, `reservation_date`, `reservation_seat`, `reservation_passenger_title`, `reservation_passenger_first_name`, `reservation_passenger_last_name`, `reservation_passenger_nic`, `reservation_passenger_phone_number`, `reservation_passenger_email`, `reservation_passenger_gender`, `reservation_created_time`, `reservation_status`) VALUES
(5, '', 18, 1, 2, 1, 1, '2024-04-30', 3, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(6, '', 18, 1, 2, 1, 1, '2024-04-30', 3, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(10, '', 18, 1, 2, 1, 2, '2024-04-30', 3, 'Mr.', 'Prabhath', 'sangeewa', 200012345678, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(11, '', 18, 1, 2, 4, 10, '2024-04-30', 1, 'Mr.', 'sfs', 'fdsf', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(12, '', 18, 1, 2, 4, 10, '2024-04-30', 1, 'Mr.', 'Prabhath', 'liyanage', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(13, '', 18, 1, 2, 4, 10, '2024-04-30', 1, 'Mr.', 'dff', 'dfs', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(15, '', 18, 1, 2, 4, 12, '2024-04-30', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(26, '', 18, 1, 2, 1, 3, '2024-04-30', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(27, '', 18, 2, 1, 2, 4, '2024-05-07', 48, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(29, '', 18, 1, 2, 4, 11, '2024-04-30', 4, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(30, '', 18, 2, 1, 2, 4, '2024-05-07', 3, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(32, '', 18, 1, 2, 1, 1, '2024-04-22', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(33, '', 18, 2, 1, 2, 5, '2024-05-06', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(34, '', 18, 1, 2, 1, 1, '2024-04-29', 4, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(35, '', 18, 2, 1, 2, 5, '2024-04-30', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(36, '', 18, 1, 2, 1, 1, '2024-05-07', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(37, '', 18, 2, 1, 2, 6, '2024-05-08', 5, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(38, '', 18, 1, 2, 1, 1, '2024-05-07', 2, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(39, '', 18, 2, 1, 3, 7, '2024-07-05', 4, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(46, '', 18, 2, 14, 1, 1, '2024-04-30', 1, 'Mr.', 'nor1', 'pay', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(47, '', 18, 2, 14, 1, 1, '2024-04-30', 2, 'Mr.', 'nor2', 'pay', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(48, '', 18, 14, 2, 3, 9, '2024-05-07', 3, 'Mr.', 'nor1', 'pay', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(49, '', 18, 14, 2, 3, 9, '2024-05-07', 4, 'Mr.', 'nor2', 'pay', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(60, '', 18, 1, 2, 4, 11, '2024-04-22', 40, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(61, '', 18, 1, 2, 4, 12, '2024-04-30', 2, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(62, '', 18, 1, 2, 4, 11, '2024-04-30', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(63, '', 18, 1, 2, 4, 12, '2024-04-30', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(67, '', 18, 1, 2, 1, 1, '2024-04-30', 48, 'Mr.', 'Prabhath', 'sangeewa', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(71, '', 18, 1, 2, 4, 11, '2024-04-30', 36, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(76, '', 18, 1, 2, 4, 12, '2024-04-30', 13, 'Mr.', 'Prabhath', 'dalpe', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(91, '', 18, 1, 2, 1, 1, '2024-04-15', 1, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(92, '', 18, 1, 2, 1, 1, '2024-04-15', 2, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(93, '', 18, 1, 2, 1, 1, '2024-04-15', 3, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(94, '', 18, 1, 2, 1, 1, '2024-04-15', 4, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(95, '', 18, 1, 2, 1, 1, '2024-04-15', 5, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(96, '', 18, 1, 2, 1, 1, '2024-04-15', 6, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(97, '', 18, 1, 2, 1, 1, '2024-04-15', 7, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(98, '', 18, 1, 2, 1, 1, '2024-04-15', 8, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(99, '', 18, 1, 2, 1, 1, '2024-04-15', 9, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(100, '', 18, 1, 2, 1, 1, '2024-04-15', 10, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(101, '', 18, 1, 2, 1, 1, '2024-04-15', 11, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(102, '', 18, 1, 2, 1, 1, '2024-04-15', 12, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(103, '', 18, 1, 2, 1, 1, '2024-04-15', 13, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(104, '', 18, 1, 2, 1, 1, '2024-04-15', 14, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(105, '', 18, 1, 2, 1, 1, '2024-04-15', 15, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(106, '', 18, 1, 2, 1, 1, '2024-04-15', 16, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(107, '', 18, 1, 2, 1, 1, '2024-04-15', 17, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(108, '', 18, 1, 2, 1, 1, '2024-04-15', 18, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(109, '', 18, 1, 2, 1, 1, '2024-04-15', 19, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(110, '', 18, 1, 2, 1, 1, '2024-04-15', 20, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(111, '', 18, 1, 2, 1, 1, '2024-04-15', 21, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(112, '', 18, 1, 2, 1, 1, '2024-04-15', 22, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(113, '', 18, 1, 2, 1, 1, '2024-04-15', 23, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(114, '', 18, 1, 2, 1, 1, '2024-04-15', 24, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(115, '', 18, 1, 2, 1, 1, '2024-04-15', 25, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(116, '', 18, 1, 2, 1, 1, '2024-04-15', 26, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(117, '', 18, 1, 2, 1, 1, '2024-04-15', 27, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(118, '', 18, 1, 2, 1, 1, '2024-04-15', 28, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(119, '', 18, 1, 2, 1, 1, '2024-04-15', 29, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(120, '', 18, 1, 2, 1, 1, '2024-04-15', 30, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(121, '', 18, 1, 2, 1, 1, '2024-04-15', 31, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(122, '', 18, 1, 2, 1, 1, '2024-04-15', 32, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(123, '', 18, 1, 2, 1, 1, '2024-04-15', 33, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(124, '', 18, 1, 2, 1, 1, '2024-04-15', 34, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(125, '', 18, 1, 2, 1, 1, '2024-04-15', 35, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(126, '', 18, 1, 2, 1, 1, '2024-04-15', 36, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(127, '', 18, 1, 2, 1, 1, '2024-04-15', 37, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(128, '', 18, 1, 2, 1, 1, '2024-04-15', 38, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(129, '', 18, 1, 2, 1, 1, '2024-04-15', 39, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(130, '', 18, 1, 2, 1, 1, '2024-04-15', 40, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(131, '', 18, 1, 2, 1, 1, '2024-04-15', 41, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(132, '', 18, 1, 2, 1, 1, '2024-04-15', 42, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(133, '', 18, 1, 2, 1, 1, '2024-04-15', 43, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(134, '', 18, 1, 2, 1, 1, '2024-04-15', 44, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(135, '', 18, 1, 2, 1, 1, '2024-04-15', 45, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(136, '', 18, 1, 2, 1, 1, '2024-04-15', 46, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(137, '', 18, 1, 2, 1, 1, '2024-04-15', 47, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(138, '', 18, 1, 2, 1, 1, '2024-04-15', 48, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(153, '', 18, 1, 2, 1, 1, '2024-05-03', 2, 'Mr.', 'Prabhath', 'liyanage', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-17 12:05:46', 'Expired'),
(154, '', 18, 2, 1, 2, 6, '2024-05-04', 32, 'Mr.', 'Prabhath', 'liyanage', 200223405078, '0718118969', 'dalpataduravien@gmail.com', 'male', '2024-04-17 12:05:46', 'Expired'),
(159, '', 40, 1, 2, 1, 1, '2024-03-04', 3, 'Mrs.', 'jeewanthi', 'jayasekara', 865987852, '0746598536', 'jee@gmail.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(160, '', 40, 1, 2, 1, 1, '2024-03-04', 2, 'Mr.', 'tharanga', 'kasun', 200012659845, '0715489652', 'kasun@gmail.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(161, '', 40, 1, 2, 1, 1, '2024-03-31', 1, 'Mr.', 'Prabhath', 'liyanage', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired'),
(162, '', 40, 1, 12, 1, 3, '2024-04-01', 1, 'Mr.', 'hu', 'jk', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(163, '', 40, 1, 2, 1, 1, '2024-03-31', 1, 'Mr.', 'Prabhath', 'fsd', 200223405078, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(173, '', 40, 2, 1, 3, 7, '2024-03-24', 47, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(174, '', 40, 2, 1, 3, 7, '2024-03-24', 48, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(175, '', 40, 1, 2, 1, 2, '2024-03-04', 2, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(176, '', 40, 2, 1, 3, 7, '2024-03-24', 48, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(179, '', 40, 1, 14, 1, 1, '2024-03-12', 13, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(180, '', 40, 14, 1, 3, 7, '2024-03-17', 16, '', '', '', 0, '', '', '', '0000-00-00 00:00:00', 'Expired'),
(181, '', 40, 1, 12, 1, 1, '2024-03-12', 1, 'Mr.', 'thanu', 'hena', 200012659845, '0718118969', 'sanath_dalpatadu@yahoo.com', 'male', '0000-00-00 00:00:00', 'Expired'),
(197, '', 40, 1, 12, 1, 1, '2024-03-31', 2, 'Mr.', 'Prabhath', 'dalpe', 200023568978, '0718118969', 'sanath_dalpatadu@yahoo.com', 'female', '0000-00-00 00:00:00', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `route_no` int(11) NOT NULL,
  `route_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`route_no`, `route_name`) VALUES
(1, 'Main line'),
(2, 'colombo-jaffna'),
(4, 'colombo-kandy'),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route_station`
--

CREATE TABLE `tbl_route_station` (
  `route_no` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `route_station_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_route_station`
--

INSERT INTO `tbl_route_station` (`route_no`, `station_id`, `route_station_order`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 12, 3),
(1, 14, 4),
(2, 1, 1),
(2, 6, 3),
(2, 18, 2),
(2, 19, 4),
(4, 1, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seat`
--

CREATE TABLE `tbl_seat` (
  `seat_no` int(11) NOT NULL,
  `seat_compartment_id` int(11) NOT NULL,
  `seat_availablity` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_ticketing`
--

CREATE TABLE `tbl_staff_ticketing` (
  `staff_ticketing_id` int(11) NOT NULL,
  `staff_ticketing_station` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff_ticketing`
--

INSERT INTO `tbl_staff_ticketing` (`staff_ticketing_id`, `staff_ticketing_station`) VALUES
(37, 12),
(45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station`
--

CREATE TABLE `tbl_station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_station`
--

INSERT INTO `tbl_station` (`station_id`, `station_name`) VALUES
(1, 'Colombo Fort'),
(2, 'Kandy'),
(3, 'Galle'),
(4, 'Negombo'),
(5, 'Trincomalee'),
(6, 'Anuradhapura'),
(7, 'Polonnaruwa'),
(8, 'Sigiriya'),
(9, 'Dambulla'),
(10, 'Koggala'),
(11, 'Mirissa'),
(12, 'Bandarawela'),
(13, 'Ella'),
(14, 'Badulla'),
(15, 'Nanuoya'),
(16, 'Haputhale'),
(17, 'ragama'),
(18, 'polgahawela'),
(19, 'Jaffna'),
(20, 'Kilinochchi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station_master`
--

CREATE TABLE `tbl_station_master` (
  `station_master_id` int(11) NOT NULL,
  `station_master_station` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_station_master`
--

INSERT INTO `tbl_station_master` (`station_master_id`, `station_master_station`) VALUES
(33, 2),
(35, 1),
(36, 7),
(55, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_checker`
--

CREATE TABLE `tbl_ticket_checker` (
  `ticket_checker_id` int(11) NOT NULL,
  `ticket_checker_pin_code` varchar(100) NOT NULL,
  `pin_changed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ticket_checker`
--

INSERT INTO `tbl_ticket_checker` (`ticket_checker_id`, `ticket_checker_pin_code`, `pin_changed`) VALUES
(49, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(50, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(51, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(53, '4a7d1ed414474e4033ac29ccb8653d9b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train`
--

CREATE TABLE `tbl_train` (
  `train_id` int(11) NOT NULL,
  `train_name` varchar(200) NOT NULL,
  `train_type` int(5) NOT NULL,
  `train_start_time` time NOT NULL,
  `train_end_time` time NOT NULL,
  `train_start_station` int(11) NOT NULL,
  `train_end_station` int(11) NOT NULL,
  `train_route` int(11) NOT NULL,
  `train_status` varchar(10) NOT NULL DEFAULT 'Enabled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_train`
--

INSERT INTO `tbl_train` (`train_id`, `train_name`, `train_type`, `train_start_time`, `train_end_time`, `train_start_station`, `train_end_station`, `train_route`, `train_status`) VALUES
(1, 'Udarata Menike', 1, '05:00:00', '19:00:00', 1, 14, 1, 'Enabled'),
(2, 'Udarata Menike', 1, '05:00:00', '19:00:00', 14, 1, 1, 'Enabled'),
(3, 'podi menike', 2, '01:59:00', '08:00:00', 1, 12, 1, 'Enabled'),
(4, 'podi menike', 1, '07:00:00', '21:00:00', 1, 14, 1, 'Enabled'),
(5, 'Odesy', 1, '12:00:00', '17:00:00', 1, 2, 1, 'Enabled'),
(6, 'Yaldevi', 1, '05:00:00', '17:00:00', 1, 19, 2, 'Enabled'),
(7, 'test', 1, '01:00:00', '13:00:00', 12, 1, 1, 'Not Arrive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train_disable_period`
--

CREATE TABLE `tbl_train_disable_period` (
  `disable_period_id` int(11) NOT NULL,
  `disable_period_train_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train_driver`
--

CREATE TABLE `tbl_train_driver` (
  `train_driver_id` int(11) NOT NULL,
  `train_driver_pin_code` varchar(100) NOT NULL,
  `pin_changed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_train_driver`
--

INSERT INTO `tbl_train_driver` (`train_driver_id`, `train_driver_pin_code`, `pin_changed`) VALUES
(47, '4a7d1ed414474e4033ac29ccb8653d9b', 0),
(52, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(57, '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train_location`
--

CREATE TABLE `tbl_train_location` (
  `train_location_id` int(11) NOT NULL,
  `train_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `train_location` int(11) NOT NULL,
  `train_location_updated_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train_stop_station`
--

CREATE TABLE `tbl_train_stop_station` (
  `train_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `stop_no` int(11) NOT NULL,
  `train_stop_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_train_stop_station`
--

INSERT INTO `tbl_train_stop_station` (`train_id`, `station_id`, `stop_no`, `train_stop_time`) VALUES
(1, 1, 1, '05:00:00'),
(1, 2, 2, '09:00:00'),
(1, 12, 3, '11:06:31'),
(1, 14, 4, '19:00:00'),
(2, 1, 4, '05:00:00'),
(2, 2, 3, '11:00:00'),
(2, 12, 2, '11:06:31'),
(2, 14, 1, '19:00:00'),
(4, 1, 1, '07:00:00'),
(4, 2, 2, '11:06:31'),
(4, 12, 3, '16:00:00'),
(4, 14, 4, '21:00:00'),
(5, 1, 1, '12:00:00'),
(5, 2, 2, '15:00:00'),
(5, 14, 3, '17:00:00'),
(6, 1, 1, '05:00:00'),
(6, 19, 2, '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_train_type`
--

CREATE TABLE `tbl_train_type` (
  `train_type_id` int(11) NOT NULL,
  `train_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_train_type`
--

INSERT INTO `tbl_train_type` (`train_type_id`, `train_type`) VALUES
(1, 'Express'),
(2, 'Intercity'),
(3, 'Night Mail'),
(4, 'Normal'),
(5, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_title` varchar(10) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_phone_number` varchar(13) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_nic` bigint(20) NOT NULL,
  `user_is_email_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_title`, `user_first_name`, `user_last_name`, `user_phone_number`, `user_type`, `user_gender`, `user_email`, `user_nic`, `user_is_email_verified`) VALUES
(2, 'Mr.', 'Admin', 'Admin   ', '0718118969', 'admin', 'male', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(18, 'Mr.', 'Ravien', 'hj  ', '0718118969', 'passenger', 'male', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(19, 'Mr.', 'sdad', 'sdasda', '0718118969', 'staff_ticketing', 'female', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(20, 'Mr.', 'sdad', 'sad', '0718118969', 'train_driver', 'female', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(21, 'Mr.', 'dfa', 'jkkj', '0718118969', 'staff_general', 'male', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(22, 'Mr.', 'adsa', 'casc', '0718118969', 'station_master', 'male', 'sanath_dalpatadu@yahoo.com', 123123602078, 1),
(23, 'Mr.', 'ticket_checker', 'ticket_checker', '0718118969', 'ticket_checker', 'male', 'sanath_dalpatadu@yahoo.com', 200123602078, 1),
(24, 'Mr.', 'passenger', 'passenger  ', '0718118969', 'passenger', 'male', 'dalpaduravien@gmail.com', 200123602078, 1),
(25, 'Mr.', 'akon', 'sdjk', '0718118969', 'passenger', 'male', 'sanath_dalpatadu@yahoo.com', 123123602078, 1),
(26, 'Mr.', 'bkon', 'sbkad', '0718118969', 'passenger', 'female', 'sanath_dalpatadu@yahoo.com', 123123602078, 1),
(27, 'Mr.', 'ckon', 'ckon', '0718118969', 'passenger', 'female', 'sanath_dalpatadu@yahoo.com', 200123602071, 1),
(30, 'Mr.', 'fkon', 'da', '0718118969', 'passenger', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(32, 'Mr.', 'negambo sm', 'sda`', '0718118969', 'station_master', 'female', 'dalpataduravien@gmail.com', 200123602078, 1),
(33, 'Mr.', 'kandy', 'sm', '0718118969', 'station_master', 'male', 'dalpataduravien@gmail.com', 123123602078, 1),
(34, 'Mr.', 'Prabhath', 'dalpatadu', '0718118969', 'staff_general', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(35, '', 'testsm', 'sad', '0718118969', 'station_master', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(36, '', 'sm', 'sad', '0718118969', 'station_master', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(37, '', 'st', 'saf', '0718118969', 'staff_ticketing', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(44, '', 'tdd', 'dsf', '0718118969', 'train_driver', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(45, '', 'tdd', 'dsf', '0718118969', 'staff_ticketing', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(47, '', 'faf', 'fdfdsad', '0718118969', 'train_driver', 'male', 'dalpataduravien@gmail.com', 20012360207, 1),
(49, '', 'rd', 'dd', '0718118969', 'ticket_checker', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(50, '', 'tcc', 'tcc', 'jkjkk', 'ticket_checker', 'female', 'dalpataduravien@gmail.com', 0, 1),
(51, '', 'ti', 'gjgh', '0718118969', 'ticket_checker', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(52, '', 'Prabhath', 'dalpatadu', '0718118969', 'train_driver', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(53, '', 'Prabhath', 'dalpatadu', '0718118969', 'ticket_checker', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(55, '', 'ravien', 'kavisha', '0718118969', 'station_master', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(56, 'Mr.', 'af', 'f', '0718118969', 'passenger', 'male', 'dalpataduravien@gmail.com', 200123602078, 1),
(57, '', 'fsf', 'fsdf', '0718118969', 'train_driver', 'male', 'dalpataduravien@gmail.com', 200123602078, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_waiting_list`
--

CREATE TABLE `tbl_waiting_list` (
  `waiting_list_id` int(11) NOT NULL,
  `waiting_list_passenger_id` int(11) NOT NULL,
  `waiting_list_train_id` int(11) NOT NULL,
  `waiting_list_compartment_id` int(11) NOT NULL,
  `waiting_list_reservation_start_station` int(11) NOT NULL,
  `waiting_list_reservation_end_station` int(11) NOT NULL,
  `waiting_list_reservation_date` date NOT NULL,
  `waiting_list_status` varchar(35) NOT NULL DEFAULT 'Waiting',
  `waiting_list_time_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_waiting_list`
--

INSERT INTO `tbl_waiting_list` (`waiting_list_id`, `waiting_list_passenger_id`, `waiting_list_train_id`, `waiting_list_compartment_id`, `waiting_list_reservation_start_station`, `waiting_list_reservation_end_station`, `waiting_list_reservation_date`, `waiting_list_status`, `waiting_list_time_created`) VALUES
(30, 18, 1, 1, 1, 2, '2024-04-15', 'Waiting', '2024-04-15 20:40:01'),
(32, 25, 1, 1, 1, 2, '2024-04-15', 'Waiting', '2024-04-15 21:15:06'),
(38, 26, 1, 1, 1, 14, '2024-04-15', 'Waiting', '2024-04-15 21:22:30'),
(40, 25, 1, 1, 1, 2, '2024-04-16', 'Waiting', '2024-04-15 22:00:51'),
(42, 18, 1, 1, 1, 12, '2024-04-30', 'Waiting', '2024-04-19 18:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warrant_image`
--

CREATE TABLE `tbl_warrant_image` (
  `warrant_image_id` int(11) NOT NULL,
  `warrant_image_name` varchar(100) NOT NULL,
  `warrant_image_path` varchar(200) NOT NULL,
  `warrant_image_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_warrant_image`
--

INSERT INTO `tbl_warrant_image` (`warrant_image_id`, `warrant_image_name`, `warrant_image_path`, `warrant_image_type`) VALUES
(1, 'default.png', 'warrantImgs/default.png', 'png'),
(2, '66141ff1259347.49306109.jpg', 'warrants/66141ff1259347.49306109.jpg', 'image/jpeg'),
(3, '6614205f55c239.04830149.jpg', 'warrants/6614205f55c239.04830149.jpg', 'image/jpeg'),
(4, '6614207d760592.83794987.jpg', 'warrants/6614207d760592.83794987.jpg', 'image/jpeg'),
(5, '66142135b07409.13329217.jpg', 'warrants/66142135b07409.13329217.jpg', 'image/jpeg'),
(6, '6614e375b73402.55155551.jpg', 'warrants/6614e375b73402.55155551.jpg', 'image/jpeg'),
(7, '6614e4c849a5b9.80433825.jpg', 'warrants/6614e4c849a5b9.80433825.jpg', 'image/jpeg'),
(8, '6614f48b20c0e1.94519291.jpg', 'warrants/6614f48b20c0e1.94519291.jpg', 'image/jpeg'),
(9, '6614f4b2078362.76985671.jpg', 'warrants/6614f4b2078362.76985671.jpg', 'image/jpeg'),
(10, '6614f4df605bb1.60595782.jpg', 'warrants/6614f4df605bb1.60595782.jpg', 'image/jpeg'),
(11, '6614f537610961.95362647.jpg', 'warrants/6614f537610961.95362647.jpg', 'image/jpeg'),
(12, '6614f55e5deba7.23373303.jpg', 'warrants/6614f55e5deba7.23373303.jpg', 'image/jpeg'),
(13, '6614f578ad9ca8.93153118.jpg', 'warrants/6614f578ad9ca8.93153118.jpg', 'image/jpeg'),
(14, '6614f5c5452c60.18627396.jpg', 'warrants/6614f5c5452c60.18627396.jpg', 'image/jpeg'),
(15, '6614f6a50676d2.66135563.jpg', 'warrants/6614f6a50676d2.66135563.jpg', 'image/jpeg'),
(16, '6614f6ab694846.21764122.jpg', 'warrants/6614f6ab694846.21764122.jpg', 'image/jpeg'),
(17, '6614f6be4738e1.44826257.jpg', 'warrants/6614f6be4738e1.44826257.jpg', 'image/jpeg'),
(18, '6614f6c1524d65.37144473.jpg', 'warrants/6614f6c1524d65.37144473.jpg', 'image/jpeg'),
(19, '6614f6c2538363.42652334.jpg', 'warrants/6614f6c2538363.42652334.jpg', 'image/jpeg'),
(20, '6614f6f9c7dd07.58401259.jpg', 'warrants/6614f6f9c7dd07.58401259.jpg', 'image/jpeg'),
(21, '6614f706d3db61.56147144.jpg', 'warrants/6614f706d3db61.56147144.jpg', 'image/jpeg'),
(22, '6614f710de3912.58439252.jpg', 'warrants/6614f710de3912.58439252.jpg', 'image/jpeg'),
(23, '6614f91af35f38.16019064.jpg', 'warrants/6614f91af35f38.16019064.jpg', 'image/jpeg'),
(24, '6614f95c7fdda7.00842947.jpg', 'warrants/6614f95c7fdda7.00842947.jpg', 'image/jpeg'),
(25, '6614f9c39b8634.38452871.jpg', 'warrants/6614f9c39b8634.38452871.jpg', 'image/jpeg'),
(26, '6614f9e92cfd13.22928956.jpg', 'warrants/6614f9e92cfd13.22928956.jpg', 'image/jpeg'),
(27, '6614fa8cd8d699.34355693.jpg', 'warrants/6614fa8cd8d699.34355693.jpg', 'image/jpeg'),
(28, '6614faa4499966.28733002.jpg', 'warrants/6614faa4499966.28733002.jpg', 'image/jpeg'),
(29, '6614fdd5b2ff95.83338126.gif', 'warrants/6614fdd5b2ff95.83338126.gif', 'image/gif'),
(30, '6614ff2e68e222.60927195.jpg', 'warrants/6614ff2e68e222.60927195.jpg', 'image/jpeg'),
(31, '661500675724c2.91906688.png', 'warrants/661500675724c2.91906688.png', 'image/png'),
(32, '66152a8d65ad61.17245629.jpg', 'warrants/66152a8d65ad61.17245629.jpg', 'image/jpeg'),
(33, '66152e5d266a95.06547187.jpg', 'warrants/66152e5d266a95.06547187.jpg', 'image/jpeg'),
(34, '661531e967a142.59724466.gif', 'warrants/661531e967a142.59724466.gif', 'image/gif'),
(35, '66156f21ee5208.99507610.jpg', 'warrants/66156f21ee5208.99507610.jpg', 'image/jpeg'),
(36, '66156ff8e42985.44951679.png', 'warrants/66156ff8e42985.44951679.png', 'image/png'),
(37, '66158900b1d3c1.18986023.gif', 'warrants/66158900b1d3c1.18986023.gif', 'image/gif'),
(38, '66158913d82fc2.43933320.gif', 'warrants/66158913d82fc2.43933320.gif', 'image/gif'),
(39, '66158a1e1e3679.28663102.png', 'warrants/66158a1e1e3679.28663102.png', 'image/png'),
(40, '66159252521da8.41475630.gif', 'warrants/66159252521da8.41475630.gif', 'image/gif'),
(41, '661594095e67a1.69007715.gif', 'warrants/661594095e67a1.69007715.gif', 'image/gif'),
(42, '6615c4b5de7e85.85367800.png', 'warrants/6615c4b5de7e85.85367800.png', 'image/png'),
(43, '66161eba318ca9.70122941.jpeg', 'warrants/66161eba318ca9.70122941.jpeg', 'image/jpeg'),
(44, '6616c6ba45a2a8.03046441.jpg', 'warrants/6616c6ba45a2a8.03046441.jpg', 'image/jpeg'),
(45, '66179e50b25ed7.51497395.jpg', 'warrants/66179e50b25ed7.51497395.jpg', 'image/jpeg'),
(46, '6618d81e947bd2.81607543.jpg', 'warrants/6618d81e947bd2.81607543.jpg', 'image/jpeg'),
(47, '6618d833a57e56.84828910.jpg', 'warrants/6618d833a57e56.84828910.jpg', 'image/jpeg'),
(48, '6618d84bc2ec15.95320025.png', 'warrants/6618d84bc2ec15.95320025.png', 'image/png'),
(49, '6618d8641a4b02.81762337.png', 'warrants/6618d8641a4b02.81762337.png', 'image/png'),
(50, '6618fce0134979.74182877.jpg', 'warrants/6618fce0134979.74182877.jpg', 'image/jpeg'),
(52, '661b4dc72bb4c1.06632333.png', 'warrants/661b4dc72bb4c1.06632333.png', 'image/png'),
(53, '661b4ecaaf5df6.06088218.png', 'warrants/661b4ecaaf5df6.06088218.png', 'image/png'),
(54, '661bfa2f421746.21231691.png', 'warrants/661bfa2f421746.21231691.png', 'image/png'),
(55, '661d560a1ac5c5.69594880.png', 'warrants/661d560a1ac5c5.69594880.png', 'image/png'),
(56, '662278fa772848.89363280.jpg', 'warrants/662278fa772848.89363280.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warrant_reservation`
--

CREATE TABLE `tbl_warrant_reservation` (
  `warrant_id` int(11) NOT NULL,
  `warrant_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `warrant_reservation_id` int(11) DEFAULT NULL,
  `warrant_image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_warrant_reservation`
--

INSERT INTO `tbl_warrant_reservation` (`warrant_id`, `warrant_status`, `warrant_reservation_id`, `warrant_image_id`) VALUES
(1, 'verified', 7, 1),
(6, 'Pending', 8, 5),
(31, 'verified', 58, 40),
(34, 'Approval Pending', 65, 43),
(36, 'Approval Pending', 68, 45),
(39, 'Approval Pending', 88, 52),
(41, 'Approval Pending', 90, 53),
(42, 'Approval Pending', 147, 54),
(43, 'Approval Pending', 148, 54),
(44, 'Approval Pending', 150, 55),
(45, 'Approval Pending', 151, 55),
(46, 'Approval Pending', 152, 55);

--
-- Triggers `tbl_warrant_reservation`
--
DELIMITER $$
CREATE TRIGGER `update_reservation_status` AFTER UPDATE ON `tbl_warrant_reservation` FOR EACH ROW BEGIN
    UPDATE tbl_reservation
    SET reservation_status = NEW.warrant_status
    WHERE reservation_id = NEW.warrant_reservation_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_compartment`
--
ALTER TABLE `tbl_compartment`
  ADD PRIMARY KEY (`compartment_id`),
  ADD KEY `compfk` (`compartment_train_id`),
  ADD KEY `comtypefk` (`compartment_class_type`);

--
-- Indexes for table `tbl_compartment_class_type`
--
ALTER TABLE `tbl_compartment_class_type`
  ADD PRIMARY KEY (`compartment_class_type_id`);

--
-- Indexes for table `tbl_disable_period`
--
ALTER TABLE `tbl_disable_period`
  ADD PRIMARY KEY (`disable_period_id`);

--
-- Indexes for table `tbl_fare`
--
ALTER TABLE `tbl_fare`
  ADD PRIMARY KEY (`fare_id`),
  ADD KEY `compartment_fk1` (`fare_compartment_id`),
  ADD KEY `end_station1` (`fare_end_station`),
  ADD KEY `start_station1` (`fare_start_station`),
  ADD KEY `route_fk1` (`fare_route_id`),
  ADD KEY `train_type_fkk` (`fare_train_type_id`);

--
-- Indexes for table `tbl_image`
--
ALTER TABLE `tbl_image`
  ADD KEY `userIdFk` (`user_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `userifdk` (`user_id`);

--
-- Indexes for table `tbl_passengers`
--
ALTER TABLE `tbl_passengers`
  ADD PRIMARY KEY (`passenger_i`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`,`reservation_ticket_id`),
  ADD UNIQUE KEY `reservation_date` (`reservation_date`,`reservation_compartment_id`,`reservation_seat`,`reservation_train_id`,`reservation_start_station`,`reservation_end_station`) USING BTREE,
  ADD KEY `passenger_fk` (`reservation_passenger_id`),
  ADD KEY `start_station_fk` (`reservation_start_station`),
  ADD KEY `end_station_fk` (`reservation_end_station`),
  ADD KEY `train_fk` (`reservation_train_id`),
  ADD KEY `reservation_compartment_id` (`reservation_compartment_id`);

--
-- Indexes for table `tbl_reservation_expired`
--
ALTER TABLE `tbl_reservation_expired`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`,`reservation_ticket_id`),
  ADD KEY `passenger_fk` (`reservation_passenger_id`),
  ADD KEY `start_station_fk` (`reservation_start_station`),
  ADD KEY `end_station_fk` (`reservation_end_station`),
  ADD KEY `train_fk` (`reservation_train_id`),
  ADD KEY `reservation_compartment_id` (`reservation_compartment_id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`route_no`);

--
-- Indexes for table `tbl_route_station`
--
ALTER TABLE `tbl_route_station`
  ADD PRIMARY KEY (`route_no`,`station_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indexes for table `tbl_seat`
--
ALTER TABLE `tbl_seat`
  ADD PRIMARY KEY (`seat_no`,`seat_compartment_id`),
  ADD KEY `comp_fk` (`seat_compartment_id`);

--
-- Indexes for table `tbl_staff_ticketing`
--
ALTER TABLE `tbl_staff_ticketing`
  ADD KEY `staff_tikecting_userid` (`staff_ticketing_id`),
  ADD KEY `staff_tikcetin_station_id` (`staff_ticketing_station`);

--
-- Indexes for table `tbl_station`
--
ALTER TABLE `tbl_station`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `tbl_station_master`
--
ALTER TABLE `tbl_station_master`
  ADD KEY `station_master_fk` (`station_master_id`),
  ADD KEY `station_fk_sm` (`station_master_station`);

--
-- Indexes for table `tbl_ticket_checker`
--
ALTER TABLE `tbl_ticket_checker`
  ADD KEY `ticket_checker_fk` (`ticket_checker_id`);

--
-- Indexes for table `tbl_train`
--
ALTER TABLE `tbl_train`
  ADD PRIMARY KEY (`train_id`),
  ADD KEY `starstation_fk` (`train_start_station`),
  ADD KEY `endstation_fk` (`train_end_station`),
  ADD KEY `route_fk` (`train_route`),
  ADD KEY `train_type_fk1` (`train_type`);

--
-- Indexes for table `tbl_train_disable_period`
--
ALTER TABLE `tbl_train_disable_period`
  ADD KEY `disable_period_id` (`disable_period_id`),
  ADD KEY `diasble_train_id` (`disable_period_train_id`);

--
-- Indexes for table `tbl_train_driver`
--
ALTER TABLE `tbl_train_driver`
  ADD PRIMARY KEY (`train_driver_id`);

--
-- Indexes for table `tbl_train_location`
--
ALTER TABLE `tbl_train_location`
  ADD PRIMARY KEY (`train_location_id`),
  ADD KEY `train_id_fk` (`train_id`),
  ADD KEY `train_location_fk` (`train_location`);

--
-- Indexes for table `tbl_train_stop_station`
--
ALTER TABLE `tbl_train_stop_station`
  ADD PRIMARY KEY (`train_id`,`station_id`,`stop_no`),
  ADD KEY `station_fk` (`station_id`);

--
-- Indexes for table `tbl_train_type`
--
ALTER TABLE `tbl_train_type`
  ADD PRIMARY KEY (`train_type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_waiting_list`
--
ALTER TABLE `tbl_waiting_list`
  ADD PRIMARY KEY (`waiting_list_id`),
  ADD UNIQUE KEY `waiting_list_passenger_id` (`waiting_list_passenger_id`,`waiting_list_train_id`,`waiting_list_compartment_id`,`waiting_list_reservation_date`),
  ADD KEY `compartment_fk` (`waiting_list_compartment_id`),
  ADD KEY `train_fk_waiting` (`waiting_list_train_id`);

--
-- Indexes for table `tbl_warrant_image`
--
ALTER TABLE `tbl_warrant_image`
  ADD PRIMARY KEY (`warrant_image_id`);

--
-- Indexes for table `tbl_warrant_reservation`
--
ALTER TABLE `tbl_warrant_reservation`
  ADD PRIMARY KEY (`warrant_id`),
  ADD KEY `reservation_fk` (`warrant_reservation_id`),
  ADD KEY `image_fk` (`warrant_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_compartment`
--
ALTER TABLE `tbl_compartment`
  MODIFY `compartment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `tbl_compartment_class_type`
--
ALTER TABLE `tbl_compartment_class_type`
  MODIFY `compartment_class_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_disable_period`
--
ALTER TABLE `tbl_disable_period`
  MODIFY `disable_period_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_fare`
--
ALTER TABLE `tbl_fare`
  MODIFY `fare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_passengers`
--
ALTER TABLE `tbl_passengers`
  MODIFY `passenger_i` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `tbl_reservation_expired`
--
ALTER TABLE `tbl_reservation_expired`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_station`
--
ALTER TABLE `tbl_station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_train`
--
ALTER TABLE `tbl_train`
  MODIFY `train_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_train_location`
--
ALTER TABLE `tbl_train_location`
  MODIFY `train_location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_train_type`
--
ALTER TABLE `tbl_train_type`
  MODIFY `train_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_waiting_list`
--
ALTER TABLE `tbl_waiting_list`
  MODIFY `waiting_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_warrant_image`
--
ALTER TABLE `tbl_warrant_image`
  MODIFY `warrant_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_warrant_reservation`
--
ALTER TABLE `tbl_warrant_reservation`
  MODIFY `warrant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_compartment`
--
ALTER TABLE `tbl_compartment`
  ADD CONSTRAINT `compfk` FOREIGN KEY (`compartment_train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comtypefk` FOREIGN KEY (`compartment_class_type`) REFERENCES `tbl_compartment_class_type` (`compartment_class_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_fare`
--
ALTER TABLE `tbl_fare`
  ADD CONSTRAINT `compartment_fk1` FOREIGN KEY (`fare_compartment_id`) REFERENCES `tbl_compartment_class_type` (`compartment_class_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `end_station1` FOREIGN KEY (`fare_end_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_fk1` FOREIGN KEY (`fare_route_id`) REFERENCES `tbl_route` (`route_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `start_station1` FOREIGN KEY (`fare_start_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_type_fkk` FOREIGN KEY (`fare_train_type_id`) REFERENCES `tbl_train_type` (`train_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_image`
--
ALTER TABLE `tbl_image`
  ADD CONSTRAINT `userIdFk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `userifdk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_passengers`
--
ALTER TABLE `tbl_passengers`
  ADD CONSTRAINT `tbl_passengers_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD CONSTRAINT `commpartment_fk` FOREIGN KEY (`reservation_compartment_id`) REFERENCES `tbl_compartment` (`compartment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `end_station_fk` FOREIGN KEY (`reservation_end_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `start_station_fk` FOREIGN KEY (`reservation_start_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_reservation_ibfk_1` FOREIGN KEY (`reservation_passenger_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_fk` FOREIGN KEY (`reservation_train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_route_station`
--
ALTER TABLE `tbl_route_station`
  ADD CONSTRAINT `tbl_route_station_ibfk_1` FOREIGN KEY (`route_no`) REFERENCES `tbl_route` (`route_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_route_station_ibfk_2` FOREIGN KEY (`station_id`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_seat`
--
ALTER TABLE `tbl_seat`
  ADD CONSTRAINT `comp_fk` FOREIGN KEY (`seat_compartment_id`) REFERENCES `tbl_compartment` (`compartment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_staff_ticketing`
--
ALTER TABLE `tbl_staff_ticketing`
  ADD CONSTRAINT `staff_tikcetin_station_id` FOREIGN KEY (`staff_ticketing_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_tikecting_userid` FOREIGN KEY (`staff_ticketing_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_station_master`
--
ALTER TABLE `tbl_station_master`
  ADD CONSTRAINT `station_fk_sm` FOREIGN KEY (`station_master_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `station_master_fk` FOREIGN KEY (`station_master_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ticket_checker`
--
ALTER TABLE `tbl_ticket_checker`
  ADD CONSTRAINT `ticket_checker_fk` FOREIGN KEY (`ticket_checker_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_train`
--
ALTER TABLE `tbl_train`
  ADD CONSTRAINT `endstation_fk` FOREIGN KEY (`train_end_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_fk` FOREIGN KEY (`train_route`) REFERENCES `tbl_route` (`route_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `starstation_fk` FOREIGN KEY (`train_start_station`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_type_fk1` FOREIGN KEY (`train_type`) REFERENCES `tbl_train_type` (`train_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_train_disable_period`
--
ALTER TABLE `tbl_train_disable_period`
  ADD CONSTRAINT `diasble_train_id` FOREIGN KEY (`disable_period_train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disable_period_id` FOREIGN KEY (`disable_period_id`) REFERENCES `tbl_disable_period` (`disable_period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_train_driver`
--
ALTER TABLE `tbl_train_driver`
  ADD CONSTRAINT `train_driver_id_oo` FOREIGN KEY (`train_driver_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_train_location`
--
ALTER TABLE `tbl_train_location`
  ADD CONSTRAINT `train_id_fk` FOREIGN KEY (`train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `train_location_fk` FOREIGN KEY (`train_location`) REFERENCES `tbl_station` (`station_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_train_stop_station`
--
ALTER TABLE `tbl_train_stop_station`
  ADD CONSTRAINT `station_fk` FOREIGN KEY (`station_id`) REFERENCES `tbl_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_stop_fk` FOREIGN KEY (`train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_waiting_list`
--
ALTER TABLE `tbl_waiting_list`
  ADD CONSTRAINT `compartment_fk` FOREIGN KEY (`waiting_list_compartment_id`) REFERENCES `tbl_compartment` (`compartment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passenger_fk` FOREIGN KEY (`waiting_list_passenger_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_fk_waiting` FOREIGN KEY (`waiting_list_train_id`) REFERENCES `tbl_train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_warrant_reservation`
--
ALTER TABLE `tbl_warrant_reservation`
  ADD CONSTRAINT `image_fk` FOREIGN KEY (`warrant_image_id`) REFERENCES `tbl_warrant_image` (`warrant_image_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_fk` FOREIGN KEY (`warrant_reservation_id`) REFERENCES `tbl_reservation` (`reservation_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;