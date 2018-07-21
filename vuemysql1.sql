-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2018 at 10:04 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuemysql1`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `brand` char(255) COLLATE utf8mb4_bin NOT NULL,
  `model` char(255) COLLATE utf8mb4_bin NOT NULL,
  `engine` char(255) COLLATE utf8mb4_bin NOT NULL,
  `gearbox` char(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `brand`, `model`, `engine`, `gearbox`) VALUES
(1, 'Toyota', 'Camry', 'Petrol', 'Automatic'),
(2, 'Honda', 'Civic Type-R', 'Petrol', 'Manual'),
(3, 'Lexus', 'LX570', 'Petrol', 'Automatic'),
(4, 'Nissan', 'Leaf', 'Electric', 'Automatic'),
(16, 'BMW', 'X5', 'Petrol', 'Manual'),
(11, 'Renault', 'Renault', 'Petrol', 'Manual'),
(15, 'Mercedez', 'GLC', 'Petrol', 'Automatic'),
(19, 'Mazda', 'CX-5', 'Diesel', 'Manual'),
(17, 'Peugeot', '306', 'Petrol', 'Manual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
