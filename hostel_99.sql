-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 05:11 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_99`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenity_no` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `amenity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenity_no`, `hostel_no`, `amenity`) VALUES
(1, 1, 'Wifi'),
(2, 1, 'Hot Shower'),
(3, 1505066674, 'Wifi'),
(4, 1505066674, 'Pool Table'),
(5, 1719975542, 'Wifi'),
(6, 1719975542, 'Play Room'),
(7, 1349612707, 'Free Parking'),
(8, 1349612707, 'Free Wifi'),
(9, 1349612707, 'Breakfast and Dinner'),
(10, 1349612707, 'Lunch on Weekends'),
(11, 1229930077, 'Wifi'),
(12, 1229930077, 'Hot shower'),
(13, 1781712626, 'test'),
(14, 1763611811, 'test'),
(15, 781554491, 'Wifi');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `no_sharing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `hostel_no` int(255) NOT NULL,
  `hostel_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `road` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `total_available` int(11) DEFAULT NULL,
  `total_occupied` int(11) DEFAULT NULL,
  `vacancies` int(11) DEFAULT NULL,
  `avg_rating` float DEFAULT NULL,
  `total_rating` int(11) DEFAULT NULL,
  `blacklist` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostel_no`, `hostel_name`, `description`, `location`, `road`, `county`, `type`, `image`, `total_available`, `total_occupied`, `vacancies`, `avg_rating`, `total_rating`, `blacklist`) VALUES
(1, 'Mock Hostel', 'Test Hostel', 'Madaraka', 'Ole Sangale Rd', 'Nairobi', 'Mixed', 'mock-hostel-two.jpg', 36, 0, 36, 4, 4, 0),
(781554491, 'Test2', 'test', 'Nairobi west', 'Test', 'Nairobi', 'Mixed', 'rc-two.jpg', 9, 0, 9, NULL, NULL, 0),
(1229930077, 'Yale Kids', 'A quiet serene environment for college going students', 'Nairobi West', 'Lang\'ata Road', 'Nairobi', 'Mixed', 'rc-one.jpg', 34, 0, 34, NULL, NULL, 0),
(1349612707, 'Travelers Oasis', 'Located in Nairobi, within 8 km of Kenyatta International Conference Centre and 10 km of Nairobi National Museum, Travelers oasis offers accommodation with a shared lounge. Located around 1.8 km from Century Cinemax Junction, the hostel is also 1.8 km awa', 'Westlands ', 'Westlands Rd.', 'Nairobi', 'Mixed', 'travelers-oasis.jpg', 30, 0, 30, NULL, NULL, 0),
(1505066674, 'John\'s Hostel', 'A quiet riverside hostel dedicated to giving premium accommodation to students.', 'Eastleigh', 'First Avenue', 'Nairobi', 'Mixed', 'john\'s-hostel-two.jpg', 50, 0, 50, NULL, NULL, 0),
(1719975542, 'Rich Kids and Co', 'Comfortable living made cheaper.\r\n', 'Westlands', 'Waiyaki Way', 'Nairobi', 'Mixed', 'rc-three.jpg', 65, 0, 65, NULL, NULL, 0),
(1763611811, 'test', 'test', 'test', 'test', 't', 'Female', 'rc-two.jpg', 1, 0, 1, NULL, NULL, 0),
(1781712626, 'Test Hostel', 'Test', 'Test', 'test', 'Test', 'Mixed', 'rc-two.jpg', 6, 0, 6, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `payment_via` varchar(255) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `payment_for` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `refunded` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_no` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` text NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_no`, `rating`, `review`, `hostel_no`, `user_id`) VALUES
(1, 4, 'Quite good', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `hostel_no` int(255) NOT NULL,
  `no_sharing` int(255) NOT NULL,
  `monthly_rent` int(255) NOT NULL,
  `male_count` int(11) DEFAULT NULL,
  `female_count` int(11) DEFAULT NULL,
  `blocked_male` int(11) DEFAULT NULL,
  `blocked_female` int(11) DEFAULT NULL,
  `room_limit` int(11) NOT NULL,
  `current_capacity` int(11) NOT NULL,
  `total_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`hostel_no`, `no_sharing`, `monthly_rent`, `male_count`, `female_count`, `blocked_male`, `blocked_female`, `room_limit`, `current_capacity`, `total_capacity`) VALUES
(1, 1, 10000, NULL, 0, NULL, 0, 2, 0, 2),
(1, 2, 8000, 0, 0, 0, 0, 2, 0, 4),
(1, 4, 7000, NULL, 0, NULL, 0, 4, 0, 16),
(1, 8, 2000, 0, 0, 0, 0, 2, 0, 16),
(781554491, 1, 4000, NULL, NULL, NULL, NULL, 3, 0, 3),
(781554491, 2, 2000, NULL, NULL, NULL, NULL, 3, 0, 6),
(1229930077, 3, 11500, NULL, NULL, NULL, NULL, 3, 0, 9),
(1229930077, 5, 10000, NULL, NULL, NULL, NULL, 5, 0, 25),
(1349612707, 1, 15000, NULL, NULL, NULL, NULL, 10, 0, 10),
(1349612707, 2, 12500, NULL, NULL, NULL, NULL, 10, 0, 20),
(1505066674, 2, 10000, NULL, NULL, NULL, NULL, 5, 0, 10),
(1505066674, 4, 6000, NULL, NULL, NULL, NULL, 10, 0, 40),
(1719975542, 1, 6000, NULL, NULL, NULL, NULL, 5, 0, 5),
(1719975542, 4, 4000, NULL, NULL, NULL, NULL, 5, 0, 20),
(1719975542, 8, 2000, NULL, NULL, NULL, NULL, 5, 0, 40),
(1763611811, 1, 2000, NULL, NULL, NULL, NULL, 1, 0, 1),
(1781712626, 1, 2500, NULL, NULL, NULL, NULL, 2, 0, 2),
(1781712626, 2, 3500, NULL, NULL, NULL, NULL, 2, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `room_allocation`
--

CREATE TABLE `room_allocation` (
  `hostel_no` int(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `no_sharing` int(11) NOT NULL,
  `no_occupied` int(11) NOT NULL,
  `spaces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_allocation`
--

INSERT INTO `room_allocation` (`hostel_no`, `room_no`, `wing`, `no_sharing`, `no_occupied`, `spaces`) VALUES
(1, 'F1', 'female', 1, 0, 1),
(1, 'F2', 'female', 2, 0, 2),
(1, 'F3', 'female', 4, 0, 4),
(1, 'F4', 'female', 4, 0, 4),
(1, 'F5', 'female', 8, 0, 8),
(1, 'M1', 'male', 1, 0, 1),
(1, 'M2', 'male', 2, 0, 2),
(1, 'M3', 'male', 4, 0, 4),
(1, 'M4', 'male', 4, 0, 4),
(1, 'M5', 'male', 8, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `rule_no` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `rule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`rule_no`, `hostel_no`, `rule`) VALUES
(1, 1, 'No drugs'),
(2, 1, 'No alcohol'),
(3, 1505066674, 'No drugs'),
(4, 1505066674, 'No visitors after 6 pm'),
(5, 1719975542, 'No drugs'),
(7, 1719975542, 'No alcohol'),
(8, 1349612707, 'No drugs'),
(9, 1349612707, 'No guests past 7pm'),
(10, 1229930077, 'No drugs'),
(11, 1229930077, 'No alcohol'),
(12, 1781712626, 'Test'),
(13, 1763611811, 'tset'),
(14, 781554491, 'No drugs');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_history`
--

CREATE TABLE `tenant_history` (
  `record_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `date_checked_in` datetime NOT NULL,
  `date_checked_out` datetime DEFAULT NULL,
  `blacklist` int(1) NOT NULL,
  `reason` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant_history`
--

INSERT INTO `tenant_history` (`record_id`, `hostel_no`, `date_checked_in`, `date_checked_out`, `blacklist`, `reason`) VALUES
(44332413, 1, '2018-10-11 13:20:47', '2018-10-11 13:23:53', 0, NULL),
(47052368, 1, '2018-10-13 20:50:59', '2018-10-13 21:33:58', 0, NULL),
(147251179, 1, '2018-10-13 23:00:09', '2018-10-13 23:08:25', 0, NULL),
(150006956, 1, '2018-10-13 23:01:07', '2018-10-13 23:08:38', 0, NULL),
(158525448, 1, '2018-10-13 23:00:25', '2018-10-13 23:08:33', 0, NULL),
(178189244, 1, '2018-10-13 23:30:28', '2018-10-14 00:21:15', 0, NULL),
(211394068, 1, '2018-10-12 22:17:45', '2018-10-12 22:56:05', 0, NULL),
(219328924, 1, '2018-10-13 23:30:06', '2018-10-14 14:40:13', 0, NULL),
(318013527, 1, '2018-10-13 23:30:14', '2018-10-14 09:56:49', 0, NULL),
(609559336, 1, '2018-10-13 20:50:17', '2018-10-13 20:50:42', 0, NULL),
(678878701, 1, '2018-10-14 23:16:59', '2018-10-14 23:52:09', 0, NULL),
(723322422, 1, '2018-10-11 11:09:17', '2018-10-11 13:12:17', 0, NULL),
(725555398, 1, '2018-10-15 17:44:05', '2018-10-15 17:48:06', 0, NULL),
(750720448, 1, '2018-10-13 23:10:40', '2018-10-13 23:13:57', 0, NULL),
(766283096, 1, '2018-10-14 22:54:02', '2018-10-14 22:57:06', 0, NULL),
(793691730, 1, '2018-10-13 21:37:38', '2018-10-13 21:37:50', 0, NULL),
(892347864, 1, '2018-10-13 21:43:12', '2018-10-13 21:43:21', 0, NULL),
(932343495, 1, '2018-10-15 00:19:41', '2018-10-15 00:21:06', 0, NULL),
(1040944589, 1, '2018-10-14 23:43:40', '2018-10-15 10:25:32', 0, NULL),
(1149700519, 1, '2018-10-14 22:57:14', '2018-10-14 22:58:25', 0, NULL),
(1187670445, 1, '2018-10-14 19:08:09', '2018-10-14 19:11:38', 0, NULL),
(1209968805, 1, '2018-10-14 23:44:17', '2018-10-14 23:47:02', 0, NULL),
(1237210053, 1, '2018-10-13 23:10:10', '2018-10-13 23:13:53', 0, NULL),
(1240462250, 1, '2018-10-13 21:49:09', '2018-10-13 21:49:15', 0, NULL),
(1260059765, 1, '2018-10-15 00:38:50', '2018-10-15 10:25:35', 0, NULL),
(1352967846, 1, '2018-10-13 23:00:37', '2018-10-13 23:08:30', 0, NULL),
(1356602921, 1, '2018-10-13 23:10:29', '2018-10-13 23:14:03', 0, NULL),
(1424621101, 1, '2018-10-14 23:00:49', '2018-10-14 23:38:42', 0, NULL),
(1502881556, 1, '2018-10-15 17:40:56', '2018-10-15 17:41:30', 0, NULL),
(1526045623, 1, '2018-10-14 00:22:06', '2018-10-14 14:40:08', 0, NULL),
(1642221689, 1, '2018-10-15 00:23:42', '2018-10-15 00:23:50', 0, NULL),
(1758422956, 1, '2018-10-15 00:25:31', '2018-10-15 00:37:19', 0, NULL),
(1763928837, 1, '2018-10-14 22:45:34', '2018-10-14 22:46:40', 0, NULL),
(1803241506, 1, '2018-10-14 09:57:01', '2018-10-14 13:20:48', 0, NULL),
(1805754031, 1, '2018-10-14 23:51:58', '2018-10-15 10:25:28', 0, NULL),
(1810260288, 1, '2018-10-13 21:38:04', '2018-10-13 21:38:48', 0, NULL),
(1820631937, 1, '2018-10-14 22:59:13', '2018-10-14 23:00:45', 0, NULL),
(1852852613, 1, '2018-10-14 11:34:05', '2018-10-14 11:34:29', 0, NULL),
(1867900093, 1, '2018-10-15 11:26:16', '2018-10-15 11:30:44', 0, NULL),
(1931033239, 1, '2018-10-15 17:48:53', '2018-10-15 17:50:35', 0, NULL),
(1967836630, 1, '2018-10-13 23:10:23', '2018-10-13 23:14:00', 0, NULL),
(2063244107, 1, '2018-10-14 23:58:38', '2018-10-15 00:08:28', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_history_bridge`
--

CREATE TABLE `tenant_history_bridge` (
  `user_id` int(255) NOT NULL,
  `record_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant_history_bridge`
--

INSERT INTO `tenant_history_bridge` (`user_id`, `record_id`) VALUES
(2, 147251179),
(2, 178189244),
(2, 725555398),
(2, 1237210053),
(2, 1260059765),
(2, 1642221689),
(2, 1758422956),
(2, 1803241506),
(7, 44332413),
(7, 1209968805),
(7, 1352967846),
(7, 1356602921),
(7, 1526045623),
(7, 1805754031),
(9, 158525448),
(9, 318013527),
(9, 1040944589),
(9, 1187670445),
(9, 1424621101),
(9, 1502881556),
(9, 1820631937),
(9, 1852852613),
(9, 1867900093),
(9, 1967836630),
(10, 47052368),
(10, 150006956),
(10, 211394068),
(10, 219328924),
(10, 609559336),
(10, 678878701),
(10, 723322422),
(10, 750720448),
(10, 766283096),
(10, 793691730),
(10, 892347864),
(10, 932343495),
(10, 1149700519),
(10, 1240462250),
(10, 1763928837),
(10, 1810260288),
(10, 1931033239),
(10, 2063244107);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `country_code` varchar(11) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_status` varchar(255) DEFAULT NULL,
  `room_assigned` varchar(255) DEFAULT NULL,
  `no_sharing` varchar(255) DEFAULT NULL,
  `total_paid` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pwd`, `country_code`, `phone_no`, `gender`, `user_type`, `user_status`, `room_assigned`, `no_sharing`, `total_paid`) VALUES
(2, 'Jerry', 'Auvagha', 'jerrybenjamin007@gmail.com', '$2y$10$xkyZ0K2sjoHeljV3qVu9hOCA9FBXO5v9hDNTNhHRqXdUrkW3OLeme', '254', '722309497', 'male', 'Student', NULL, NULL, NULL, NULL),
(3, 'Jerry', 'Auvagha', 'jerry.auvagha@strathmore.edu', '$2y$10$uSjIcP2.1ueDeWLu3OJmN.GCxgRAS6xOsDI7FftI9CPxXTxuqXP92', '254', '722309497', 'male', 'Hostel Owner', 'NULL', '', NULL, NULL),
(4, 'John ', 'Doe', 'john.doe@strathmore.edu', '$2y$10$o1x0Fh561Cckc/lu5sSGFeCrhillF9RqFi.V4uMnjCAb8GnGq4R2C', '254', '722319498', 'male', 'Hostel Owner', NULL, '', NULL, NULL),
(5, 'Jane', 'Doe', 'jane.doe@strathmore.edu', '$2y$10$jSF8k.4raXnCOZeagqD/rOlhLUrk1ZSR8pXZR9QX55308WcFWpySu', '254', '722319498', 'female', 'Hostel Owner', 'NULL', 'NULL', NULL, NULL),
(6, 'Jane', 'Does', 'jane.does@strathmore.edu', '$2y$10$3Cf4lM4z66fDDwsSD5IiY.1wo9Uahs0pnBgBTWfgpUfy9PrtfHNJq', '254', '722319498', 'female', 'Hostel Owner', NULL, '', NULL, NULL),
(7, 'Jane', 'Does', 'jane.does2@strathmore.edu', '$2y$10$ejmRYOyNqg1lGnhubYdSAuOhDsTcUOjBkQx.ZlXiUvQF27exjtSpG', '254', '722319898', 'female', 'Student', NULL, NULL, NULL, NULL),
(9, 'Rose', 'Njeri', 'rnjeri@kenindia.com', '$2y$10$iNJ5dyYb4dGFKYsWStxFQ.AsySRo/9d.3R6LoYLa0cwXAcMVSXuD2', '254', '721266332', 'female', 'Student', NULL, NULL, NULL, NULL),
(10, 'Mizzy', 'Bee', 'mizzy.bee@gmail.com', '$2y$10$j9CGxquS266NcA/oG/vKe.8/16WkBCaOug.8cXWosbCUhpYWMlmga', '254', '722319490', 'female', 'Student', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_hostel_bridge`
--

CREATE TABLE `user_hostel_bridge` (
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `record_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_hostel_bridge`
--

INSERT INTO `user_hostel_bridge` (`user_id`, `hostel_no`, `record_id`) VALUES
(3, 1, NULL),
(3, 781554491, NULL),
(3, 1229930077, NULL),
(3, 1719975542, NULL),
(3, 1763611811, NULL),
(3, 1781712626, NULL),
(4, 1349612707, NULL),
(4, 1505066674, NULL),
(5, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_bridge`
--

CREATE TABLE `user_payment_bridge` (
  `user_id` int(255) NOT NULL,
  `payment_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenity_no`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`hostel_no`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_no`),
  ADD KEY `hostel_no` (`hostel_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD UNIQUE KEY `hostel_no_2` (`hostel_no`,`no_sharing`),
  ADD KEY `hostel_no` (`hostel_no`) USING BTREE;

--
-- Indexes for table `room_allocation`
--
ALTER TABLE `room_allocation`
  ADD UNIQUE KEY `hostel_no_2` (`hostel_no`,`room_no`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`rule_no`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `tenant_history`
--
ALTER TABLE `tenant_history`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `tenant_history_bridge`
--
ALTER TABLE `tenant_history_bridge`
  ADD UNIQUE KEY `user_id_2` (`user_id`,`record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_hostel_bridge`
--
ALTER TABLE `user_hostel_bridge`
  ADD UNIQUE KEY `user_id_2` (`user_id`,`hostel_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `user_payment_bridge`
--
ALTER TABLE `user_payment_bridge`
  ADD UNIQUE KEY `user_id_2` (`user_id`,`payment_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_no` (`payment_no`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenity_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `hostel_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1781712627;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `rule_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tenant_history`
--
ALTER TABLE `tenant_history`
  MODIFY `record_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2063244108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amenities`
--
ALTER TABLE `amenities`
  ADD CONSTRAINT `amenities_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `room_allocation`
--
ALTER TABLE `room_allocation`
  ADD CONSTRAINT `room_allocation_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `tenant_history`
--
ALTER TABLE `tenant_history`
  ADD CONSTRAINT `tenant_history_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `tenant_history_bridge`
--
ALTER TABLE `tenant_history_bridge`
  ADD CONSTRAINT `tenant_history_bridge_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `tenant_history` (`record_id`),
  ADD CONSTRAINT `tenant_history_bridge_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_hostel_bridge`
--
ALTER TABLE `user_hostel_bridge`
  ADD CONSTRAINT `user_hostel_bridge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_hostel_bridge_ibfk_2` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `user_payment_bridge`
--
ALTER TABLE `user_payment_bridge`
  ADD CONSTRAINT `user_payment_bridge_ibfk_1` FOREIGN KEY (`payment_no`) REFERENCES `payments` (`payment_no`),
  ADD CONSTRAINT `user_payment_bridge_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
