-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2019 at 05:25 AM
-- Server version: 5.7.23
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Car Rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`) VALUES
(17),
(24);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `pick_up` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `amt` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `user_id`, `loc_id`, `car_id`, `pick_up`, `return_date`, `status`, `amt`) VALUES
(18, 17, 1, 30, '2019-04-24', '2019-04-26', 'Paid', 80),
(19, 23, 2, 5, '2019-04-25', '2019-04-26', 'Paid', 40),
(20, 24, 1, 2, '2019-04-25', '2019-05-04', 'Paid', 360),
(21, 17, 2, 34, '2019-04-30', '2019-05-02', 'Paid', 60);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `Image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `name`, `type_id`, `status`, `Image`) VALUES
(1, 'Mirage', 1, 'A', 'Mirage1.png'),
(2, 'Elantra', 2, 'A', 'Elantra1.png'),
(3, 'Compass', 3, 'A', 'Compass1.png'),
(4, 'Mustang', 4, 'A', 'Mustang1.png'),
(5, 'Altima', 2, 'NA', 'Altima1.png'),
(6, 'Civic', 2, 'A', 'Civic1.png'),
(7, 'Corvette', 4, 'A', 'Corvette1.png'),
(8, 'Expedition', 3, 'NA', 'Expedition1.png'),
(9, 'Jetta', 2, 'A', 'Jetta1.png'),
(10, 'Spark', 1, 'A', 'Spark1.png'),
(30, 'Fusion', 2, 'A', 'Fusion1.jpg'),
(31, 'Cruze', 2, 'A', 'Cruze1.jpg'),
(32, 'Accent', 2, 'A', 'Challenger.jpg'),
(33, 'Accord', 2, 'A', 'Accord.jpg'),
(34, 'Kia Rio', 1, 'A', 'Kia Rio.jpg'),
(35, 'Mini Cooper', 1, 'A', 'Mini Cooper.jpg'),
(36, 'Rogue', 3, 'A', 'Rogue.jpg'),
(37, 'RAV', 3, 'A', 'rav4.jpg'),
(38, 'Cherokee', 3, 'A', 'Cherokee.jpg'),
(39, 'Challenger', 4, 'A', 'Challenger.jpg'),
(40, 'X1', 3, 'A', 'BMW X1.jpg'),
(41, 'BRZ', 4, 'A', 'BRZ.png'),
(42, 'M4', 4, 'A', 'M4.jpg'),
(43, 'Cruze', 2, 'A', 'Cruze1.jpg'),
(44, 'Mirage', 1, 'A', 'Mirage2.png');

-- --------------------------------------------------------

--
-- Table structure for table `car_loc`
--

CREATE TABLE `car_loc` (
  `loc_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_loc`
--

INSERT INTO `car_loc` (`loc_id`, `car_id`) VALUES
(3, 1),
(1, 2),
(3, 3),
(1, 4),
(4, 7),
(4, 9),
(2, 5),
(4, 6),
(1, 8),
(3, 10),
(1, 30),
(2, 31),
(3, 32),
(3, 33),
(2, 34),
(1, 35),
(1, 36),
(2, 37),
(4, 38),
(4, 39),
(3, 40),
(3, 41),
(2, 42),
(4, 43),
(4, 44);

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `type_id` int(11) NOT NULL,
  `cost` float NOT NULL,
  `seating_cap` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`type_id`, `cost`, `seating_cap`, `type`) VALUES
(1, 30, 4, 'Economy'),
(2, 40, 5, 'Sedan'),
(3, 50, 6, 'SUV'),
(4, 60, 2, 'Premium');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `zipcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `city`, `phone`, `zipcode`) VALUES
(1, 'Plano', '1298765329', '75252'),
(2, 'Richardson', '1937652897', '75080'),
(3, 'Dallas', '9787785865', '75002'),
(4, 'Frisco', '9998887771', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `lic_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `phone`, `dob`, `lic_no`) VALUES
(17, 'admin', 'admin@gmail.com', 'cd99021cbff663ee362145f12fa507c0130f793f5e271ce8ca08fe12ce0a46c0', '9876543210', '1994-03-01', '98765432'),
(18, 'user1', 'user1@gmail.com', 'cd99021cbff663ee362145f12fa507c0130f793f5e271ce8ca08fe12ce0a46c0', '1234567890', '1984-04-03', '12323421'),
(23, 'user2', 'user2@gmail.com', '9e62065d5d3c1f2cb2e23d71440e37153b0f0772e5fa7b3132b226a104b3360e', '1234567890', '2000-04-07', '12345678'),
(24, 'admin2', 'admin2@gmail.com', 'cd99021cbff663ee362145f12fa507c0130f793f5e271ce8ca08fe12ce0a46c0', '1234567890', '1990-02-02', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `car_loc`
--
ALTER TABLE `car_loc`
  ADD KEY `car_id` (`car_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`lic_no`,`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `car_type` (`type_id`);

--
-- Constraints for table `car_loc`
--
ALTER TABLE `car_loc`
  ADD CONSTRAINT `car_loc_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `car_loc_ibfk_2` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;