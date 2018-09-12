-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 10:09 AM
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
  `hostel_no` int(255) NOT NULL,
  `amenity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`hostel_no`, `amenity`) VALUES
(1, 'Wifi'),
(1, 'Hot Shower'),
(1, 'Wifi'),
(1, 'Pool Table'),
(1, 'Wifi'),
(1, 'Play Room');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `time_booked` datetime NOT NULL
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
  `total_rooms` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostel_no`, `hostel_name`, `description`, `location`, `road`, `county`, `type`, `image`, `total_rooms`) VALUES
(1, 'Mock Hostel', 'Test Hostel', 'Madaraka', 'Ole Sangale Road', 'Nairobi', 'Mixed', 'westlands-backpackers.jpg', 0),
(1719975542, 'Rich Kids and Co', 'Comfortable living made cheaper.\r\n', 'Westlands', 'Waiyaki Way', 'Nairobi', 'Mixed', 'KG-ladies-hostel.jpg', 18);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_no` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `image_dir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `hostel_no` int(255) NOT NULL,
  `no_sharing` int(255) NOT NULL,
  `monthly_rent` int(255) NOT NULL,
  `total_occupants` int(11) NOT NULL,
  `no_rooms_occupied` int(11) NOT NULL,
  `room_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`hostel_no`, `no_sharing`, `monthly_rent`, `total_occupants`, `no_rooms_occupied`, `room_limit`) VALUES
(1, 4000, 7000, 700, 7000, 7000),
(1, 7000, 7000, 9900, 9987, 7889),
(1, 566, 8987, 879, 89798, 8889),
(1, 2, 2, 5000, 2, 3),
(1, 3, 4, 7000, 2, 3),
(1, 2, 2, 5, 99, 9),
(1, 2, 1000, 200, 700, 0),
(1, 3, 90000, 80, 900, 2),
(1719975542, 8, 2000, 0, 0, 10),
(1719975542, 4, 4000, 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `hostel_no` int(255) NOT NULL,
  `rule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`hostel_no`, `rule`) VALUES
(1, 'No drugs'),
(1, 'No alcohol'),
(1, 'No drugs'),
(1, 'No visitors after 6 pm'),
(1, 'No drugs');

-- --------------------------------------------------------

--
-- Table structure for table `test_image_upload`
--

CREATE TABLE `test_image_upload` (
  `id` int(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_image_upload`
--

INSERT INTO `test_image_upload` (`id`, `image`, `text`) VALUES
(1, '2017-12-03 (6).png', 'Test 1'),
(2, '2017-12-03 (6).png', 'Test 1\r\n');

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
  `phone_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_status` varchar(255) DEFAULT NULL,
  `total_paid` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pwd`, `phone_no`, `gender`, `user_type`, `user_status`, `total_paid`) VALUES
(2, 'Jerry', 'Auvagha', 'jerrybenjamin007@gmail.com', '$2y$10$xkyZ0K2sjoHeljV3qVu9hOCA9FBXO5v9hDNTNhHRqXdUrkW3OLeme', '254722309497', 'Male', 'Student', NULL, NULL),
(3, 'Jerry', 'Auvagha', 'jerry.auvagha@strathmore.edu', '$2y$10$uSjIcP2.1ueDeWLu3OJmN.GCxgRAS6xOsDI7FftI9CPxXTxuqXP92', '+254722309497', 'Male', 'Hostel Owner', NULL, NULL),
(4, 'John ', 'Doe', 'john.doe@strathmore.edu', '$2y$10$o1x0Fh561Cckc/lu5sSGFeCrhillF9RqFi.V4uMnjCAb8GnGq4R2C', '+254722319498', 'Male', 'Hostel Owner', NULL, NULL),
(5, 'Jane', 'Doe', 'jane.doe@strathmore.edu', '$2y$10$jSF8k.4raXnCOZeagqD/rOlhLUrk1ZSR8pXZR9QX55308WcFWpySu', '+254722319498', 'Female', 'Hostel Owner', NULL, NULL),
(6, 'Jane', 'Does', 'jane.does@strathmore.edu', '$2y$10$3Cf4lM4z66fDDwsSD5IiY.1wo9Uahs0pnBgBTWfgpUfy9PrtfHNJq', '+254722319498', 'Female', 'Hostel Owner', NULL, NULL),
(7, 'Jane', 'Does', 'jane.does2@strathmore.edu', '$2y$10$ejmRYOyNqg1lGnhubYdSAuOhDsTcUOjBkQx.ZlXiUvQF27exjtSpG', '+254722319898', 'Female', 'Hostel Owner', NULL, NULL),
(9, 'Rose', 'Njeri', 'rnjeri@kenindia.com', '$2y$10$iNJ5dyYb4dGFKYsWStxFQ.AsySRo/9d.3R6LoYLa0cwXAcMVSXuD2', '+254721266332', 'Female', 'Student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_hostel_bridge`
--

CREATE TABLE `user_hostel_bridge` (
  `user_id` int(255) NOT NULL,
  `hostel_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_hostel_bridge`
--

INSERT INTO `user_hostel_bridge` (`user_id`, `hostel_no`) VALUES
(3, 1719975542);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_bridge`
--

CREATE TABLE `user_payment_bridge` (
  `user_id` int(255) NOT NULL,
  `payment_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
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
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_no`),
  ADD KEY `FOREIGN KEY` (`hostel_no`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD KEY `hostel_no` (`hostel_no`) USING BTREE;

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD KEY `hostel_no` (`hostel_no`);

--
-- Indexes for table `test_image_upload`
--
ALTER TABLE `test_image_upload`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `hostel_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1719975543;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_no` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_image_upload`
--
ALTER TABLE `test_image_upload`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`hostel_no`) REFERENCES `hostels` (`hostel_no`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
