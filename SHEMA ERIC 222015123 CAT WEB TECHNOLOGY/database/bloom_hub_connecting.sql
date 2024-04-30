-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 01:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloom_hub_connecting`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_id` int(11) NOT NULL,
  `Customer_Name` varchar(150) DEFAULT NULL,
  `Contact_Number` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_id`, `Customer_Name`, `Contact_Number`, `Email`, `Address`) VALUES
(1, 'FIFI', '072323232', 'fifi@gmail.com', 'uganda'),
(2, 'moise', '073226666', 'moise@gmail.com', 'rwanda'),
(3, 'didas', '0788903506', 'dfdddtd@gmail.com', 'ffggg'),
(4, 'ggggg', '098776', 'ttt@gmail.com', 'fddtdtd');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `Farmer_id` int(11) NOT NULL,
  `Farmer_Name` varchar(100) DEFAULT NULL,
  `Contact_Number` varchar(10) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`Farmer_id`, `Farmer_Name`, `Contact_Number`, `Location`) VALUES
(1, 'mugabo', '0789898988', 'kageyo'),
(2, 'murigo', '079877788', 'taba'),
(3, 'ndengeye', '072372334', 'kgl');

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `Flower_id` int(11) NOT NULL,
  `Name` varchar(150) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Price_Per_Unit` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`Flower_id`, `Name`, `Description`, `Price_Per_Unit`) VALUES
(1, 'sdfg', 'sdf', 3456),
(2, 'dfgh', 'xcvb', 3456),
(3, 'yellow flower', 'is the best', 1000),
(4, 'shema', 'perfect', 333333);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Flower_id` int(11) NOT NULL,
  `Farmer_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total_Price` float NOT NULL,
  `Order_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Customer_id`, `Flower_id`, `Farmer_id`, `Quantity`, `Total_Price`, `Order_Date`) VALUES
(1, 2, 1, 2, 54, 54, '2008-02-01'),
(2, 1, 2, 1, 65, 500, '2021-12-11'),
(3, 4, 1, 2, 80, 10000, '2024-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Customer_id` int(11) NOT NULL,
  `Order_id` int(11) DEFAULT NULL,
  `Payment_Amount` float DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  `Payment_Method` varchar(85) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Customer_id`, `Order_id`, `Payment_Amount`, `Payment_Date`, `Payment_Method`) VALUES
(1, 2, 1000, '2012-11-12', 'momo pay'),
(2, 1, 5000, '2023-04-02', 'MoMo'),
(3, 2, 100000, '2023-04-02', 'bank'),
(4, 1, 1234, '2000-09-12', 'momo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'shema', 'eric', 'shema5', 'shemeric@gmail.com', '0792223311', '$2y$10$o3ntRvF7DzMDMmpNXFrn6u8/IZDAlYsCIK5o19.7Z5JqIFoYA/dq2', '2024-04-26 11:48:07', '34567', 0),
(2, 'umutesi', 'naome', 'mutesin', 'naomeumutesi@gmail.com', '07328877654', '$2y$10$qfWmYsh9nnAThAUnKvUeqO6sFd0L4FI.y51jfXdFDFgPrpbXf8YG6', '2024-04-26 11:48:54', '23456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`Farmer_id`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`Flower_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `Flower_id` (`Flower_id`),
  ADD KEY `Farmer_id` (`Farmer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Customer_id`),
  ADD KEY `Order_id` (`Order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `Farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flowers`
--
ALTER TABLE `flowers`
  MODIFY `Flower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Flower_id`) REFERENCES `flowers` (`Flower_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Farmer_id`) REFERENCES `farmers` (`Farmer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
