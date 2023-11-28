-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 08:06 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wildcat lounge`
--

-- --------------------------------------------------------

--
-- Table structure for table `item menu`
--

CREATE TABLE `item menu` (
  `Item_ID` int(20) NOT NULL,
  `Item Name` varchar(255) NOT NULL,
  `Price` int(20) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item menu`
--

INSERT INTO `item menu` (`Item_ID`, `Item Name`, `Price`, `Tags`, `Category`) VALUES
(1, 'Americano', 85, 'Coffee,Hot,Iced', 'Coffee'),
(2, 'Strawberry Milk', 89, 'Strawberry,Beverage,Milk', 'Beverage'),
(9, 'Cappuccino', 95, 'Coffee', 'Coffee'),
(10, 'Matcha', 95, 'Coffee,Hot,Iced', 'Coffee'),
(11, 'Latte', 95, 'Caramel', 'Coffee'),
(12, 'Spanish Late', 109, 'Coffee,Hot,Iced', 'Coffee'),
(13, 'Rocky Road Brownies', 48, 'Brownie, Rocky Road, Snack', 'Snack'),
(14, 'Expresso Shot', 50, 'Shot, Expresso, Coffee, Add-on', 'Add-on'),
(15, 'Caramel', 99, 'Caramel, Sweet, Coffee', 'Coffee'),
(16, 'Mocha', 119, 'Mocha, Flavored Lattes, Iced, Coffee', 'Coffee'),
(17, 'Oreo F.Latte', 119, 'Flavored Latte, Iced, Oreo, Coffee', 'Coffee'),
(18, 'Vanilla F.Latte', 119, 'Flavored Latte, Coffee, Vanilla', 'Coffee'),
(19, 'Hazelnut F.Latte', 119, 'Flavored Latte, Coffee, Iced', 'Coffee'),
(20, 'Dirty Matcha', 115, 'Matcha, Beverage', 'Beverage'),
(21, 'Strawberry Matcha', 115, 'Matcha, Strawberry, Beverage', 'Beverage'),
(22, 'Strawberry Ade', 89, 'Strawberry, Ade, Beverage', 'Beverage'),
(23, 'Blueberry Ade', 89, 'Blueberry, Ade, Beverage', 'Beverage'),
(24, 'Lychee Ade', 89, 'Lychee, Ade, Beverage', 'Beverage'),
(25, 'Hot Chocolate', 95, 'Hot, Chocolate, Beverage', 'Beverage'),
(26, 'Iced Chocolate', 95, 'Iced, Chocolate, Beverage', 'Beverage'),
(27, 'Strawberry Milk', 89, 'Milk, Strawberry, Beverage', 'Beverage'),
(28, 'Blueberry Milk', 89, 'Blueberry, Milk, Beverage', 'Beverage'),
(29, 'Cookie', 17, 'Cookie, Chocolate, Snack', 'Snack'),
(30, 'Small Munchkin', 14, 'Munchkin, Snack', 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `order-history-unique`
--

CREATE TABLE `order-history-unique` (
  `Order_ID` int(255) NOT NULL,
  `Total` int(255) NOT NULL,
  `Amount_Given` int(255) NOT NULL,
  `Change_Given` int(255) NOT NULL,
  `Date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order-history-unique`
--

INSERT INTO `order-history-unique` (`Order_ID`, `Total`, `Amount_Given`, `Change_Given`, `Date`) VALUES
(5, 190, 200, 10, '2023-11-28 09:07:20.482733'),
(6, 85, 100, 15, '2023-11-28 09:10:24.524264'),
(7, 95, 100, 5, '2023-11-28 09:13:28.162859'),
(8, 190, 500, 310, '2023-11-28 09:21:51.314629'),
(9, 152, 502, 350, '2023-11-28 09:24:52.028073'),
(10, 167, 170, 3, '2023-11-28 09:27:37.627957'),
(11, 34, 50, 16, '2023-11-28 09:29:28.335547'),
(12, 17, 50, 33, '2023-11-28 09:55:50.594328'),
(13, 234, 1000, 766, '2023-11-28 10:21:24.368631'),
(14, 109, 150, 41, '2023-11-28 10:55:05.576555'),
(15, 95, 100, 5, '2023-11-28 11:12:26.896956'),
(16, 89, 100, 11, '2023-11-28 11:14:31.933688'),
(17, 17, 33, 16, '2023-11-28 11:21:07.838593'),
(18, 95, 100, 5, '2023-11-28 11:52:45.827432');

-- --------------------------------------------------------

--
-- Table structure for table `order_history_single`
--

CREATE TABLE `order_history_single` (
  `Order_ID` int(255) NOT NULL,
  `Item_ID` int(255) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Total Price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_history_single`
--

INSERT INTO `order_history_single` (`Order_ID`, `Item_ID`, `Amount`, `Total Price`) VALUES
(5, 10, 2, 190),
(6, 1, 1, 85),
(7, 10, 1, 95),
(8, 9, 1, 95),
(8, 11, 1, 95),
(9, 1, 1, 85),
(9, 14, 1, 50),
(9, 29, 1, 17),
(10, 13, 1, 48),
(10, 19, 1, 119),
(11, 29, 2, 34),
(12, 29, 1, 17),
(13, 16, 1, 119),
(13, 20, 1, 115),
(14, 12, 1, 109),
(15, 11, 1, 95),
(16, 27, 1, 89),
(17, 29, 1, 17),
(18, 25, 1, 95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item menu`
--
ALTER TABLE `item menu`
  ADD UNIQUE KEY `Item_ID` (`Item_ID`);

--
-- Indexes for table `order-history-unique`
--
ALTER TABLE `order-history-unique`
  ADD PRIMARY KEY (`Order_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item menu`
--
ALTER TABLE `item menu`
  MODIFY `Item_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order-history-unique`
--
ALTER TABLE `order-history-unique`
  MODIFY `Order_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
