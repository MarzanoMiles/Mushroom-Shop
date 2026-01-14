-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `productname` varchar(55) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `progress` varchar(20) DEFAULT NULL,
  `refund` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `productname`, `quantity`, `price`, `total`, `fullname`, `address`, `phonenumber`, `progress`, `refund`, `status`) VALUES
(12, 'ShiitakeMush', 1, 500.00, 500.00, 'Miles Marzano', 'spc', '09955425054', 'CANCELED', 'PENDING', 'checkout'),
(16, 'MilkyMush', 1, 175.00, 175.00, 'Miles Marzano', 'spc', '09955425054', 'CANCELED', 'PENDING', 'checkout'),
(28, 'ButtonMush', 1, 190.00, 190.00, 'Miles Marzano', 'spc', '09955425054', NULL, '', 'checkout'),
(29, 'OysterMush', 1, 180.00, 180.00, 'Miles Marzano', 'spc', '09955425054', 'CANCELED', '', 'checkout'),
(30, 'OysterMush', 1, 180.00, 180.00, 'Miles Marzano', 'spc', '09955425054', NULL, '', 'pending'),
(31, 'KingTuberOysMush', 1, 300.00, 300.00, 'Miles Marzano', 'spc', '09955425054', 'CANCELED', 'PENDING', 'checkout'),
(32, 'MilkyMush', 1, 175.00, 175.00, 'Miles Marzano', 'spc', '09955425054', NULL, 'PENDING', 'checkout');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
