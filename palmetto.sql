-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 11:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palmetto`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `itemID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`itemID`, `name`, `price`, `picture`, `type`) VALUES
(1, 'English Breakfast', '4.1', 'images/products/pic1639908014184079182561bf02ae8cc98.png', 'breakfast'),
(2, 'Egg On Avo', '1', 'images/products/pic1639908466148979848561bf04724ffde.jpg', 'breakfast'),
(3, 'Truffled Eggs', '3.990', 'images/products/pic1639162485207352598161b3a275a3dbc.jpg', 'breakfast'),
(4, 'Brisket Benedict', '4.300', 'images/products/pic163916250735543477661b3a28b0609c.jpg', 'breakfast'),
(5, 'Classic Pancakes', '3.570', 'images/products/pic163916252793555701261b3a29f46a30.jpg', 'breakfast'),
(6, 'Truffled croissant', '4.1', 'images/products/pic1639162553160989618761b3a2b9c55d4.jpg', 'breakfast'),
(7, 'Nutella French Toast', '3.680', 'images/products/pic163916257436342477361b3a2ce9f5da.jpg', 'breakfast'),
(8, 'Truffle Penne', '4.935', 'images/products/pic163916261862853170161b3a2fa714eb.jpg', 'mains'),
(9, 'Truffle Burger', '5.145', 'images/products/pic163916266995655533561b3a32d86d40.jpg', 'burgers'),
(10, 'Strawberry Arugula Salad', '3.780', 'images/products/pic163916270655884217161b3a3525d8f6.jpg', 'salads'),
(11, 'Shakshuka Hollandaise', '4.1', 'images/products/pic1639908536107295013761bf04b89acfa.png', 'breakfast'),
(12, 'Green Frittata Skillet', '3.68', 'images/products/pic163990857241051695561bf04dc56f3c.png', 'breakfast'),
(13, 'Hash Brown Egg Benedict', '3.675', 'images/products/pic1639909433185799906461bf08397d1f9.png', 'breakfast'),
(14, 'Berry Pancake', '4.095', 'images/products/pic1639908666153084479161bf053a5ec6f.png', 'breakfast'),
(15, 'Omelette', '3.465', 'images/products/pic163990873676645729961bf05805e49b.png', 'breakfast'),
(16, 'Skillet Chicken', '3.675', 'images/products/pic163990893822642916961bf064aafc5a.jpg', 'mains'),
(17, 'Balsamic Chicken', '4.31', 'images/products/pic1639908977198911570061bf06718c6d1.png', 'mains'),
(18, 'Penne Rosa', '3.26', 'images/products/pic1639909020110933240361bf069c38fae.png', 'mains'),
(19, 'Palmetto Burger', '4.515', 'images/products/pic163990905423302868361bf06be405f7.jpg', 'burgers'),
(20, 'Classic Burger', '4.35', 'images/products/pic163990910934479235361bf06f56fa6f.jpg', 'burgers'),
(21, 'Americano', '1.47', 'images/products/pic163990926950575990761bf0795b25e6.jpg', 'coffee'),
(22, 'Latte', '1.575', 'images/products/pic163990929825966456661bf07b23cc1f.jpg', 'coffee'),
(23, 'Cappuccino', '1.575', 'images/products/pic1639909328183134549861bf07d0852f3.jpg', 'coffee'),
(24, 'Brownies', '1.05', 'images/products/pic163990935777270546661bf07edd9039.jpg', 'desserts'),
(25, 'Sticky Date Pudding', '2.625', 'images/products/pic1639909392673870561bf0810423a1.jpg', 'desserts'),
(26, 'Mediterranean Salad', '4.1', 'images/products/pic1639909526206233632761bf08962a341.jpg', 'salads');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderid`, `itemid`, `quantity`) VALUES
(1, 1, 2),
(2, 1, 3),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `orderTime` datetime NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `cid`, `orderTime`, `total`, `status`) VALUES
(1, 8, '2021-12-08 19:01:21', '8.00', 'Unconfirmed'),
(2, 8, '2021-12-09 18:41:23', '5.500', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `Fname`, `Lname`, `username`, `password`, `phone`, `type`) VALUES
(1, 'Abrar', 'Ali', 'A2019', '$2y$10$K3.sCjoNsYj40RFyDmNloeO63QOkocVEs6YbrIJ9HMMiw3cB6HQH6', '39654871', 'Admin'),
(2, 'Zahraa', 'Sayed', 'ZS2017', '$2y$10$BRIj0th3Xq.QCZMgJ5KwzeSdKmsafF9AaDq6dgOb85h.ZYFGAytwq', '36541287', 'Admin'),
(3, 'Zahraa', 'Zuahir', 'ZZ2019', '$2y$10$rYQSc0fVLj5I4PhKLBSUee.BX8C.USGYgsEU2wjHvxWokNofNjiX.', '36706601', 'Admin'),
(4, 'Ali', 'Jafar', 'AJ2011', '$2y$10$cXq.S2FDlBRaucIaTWstKe.QZzFB5ZWeyDZE9rOU52mygOthfIlXu', '39871254', 'staff'),
(5, 'Mohammed', 'Ali', 'MA2012', '$2y$10$sRVJ3k8djilYy3PNThBz8urJ9VJievxAnQR0lRXAbgzwhHuwJdMOu', '36630014', 'staff'),
(6, 'Jameel', 'Saleem', 'JS2016', '$2y$10$AdbSBziP/vfNouCAbQbzzucyTrxs83Wq.H5o5kTG8PpA54GehlF8a', '36631198', 'staff'),
(7, 'Nasser', 'Yusuf', 'NY2015', '$2y$10$rfe4vss07NbIFbwt8DFXCOAHhwElnQ701/v3SUYvFa2G.jTm2ZOFy', '39936678', 'staff'),
(8, 'Ahmed', 'Ebrahim', 'AE2013', '$2y$10$bmQ9ZQfL7VAoWtWhL7hOGONXFd5KRFzie92A0EBwQ.3XxSfGIE2kS', '36637745', 'customer'),
(9, 'Badar', 'Hadi', 'BH2013', '$2y$10$QhZzjDlLlCg/zv78otwiU.4Yi1ElJRualXZ89pcEkTrCo8y1vdNou', '36635525', 'customer'),
(10, 'Ahmed', 'Salem', 'AS2013', '$2y$10$sGnoO6YC/LYZpcHTb5o8fOnqzPDajIadsvDTYkT24gKZqWSlr8RcO', '36925814', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderid`,`itemid`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`oid`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `menu` (`itemID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
