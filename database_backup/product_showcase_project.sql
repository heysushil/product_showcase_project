-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 11:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_showcase_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_desccription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_desccription`) VALUES
(1, 'Demo product', 123, 'qqqqq'),
(2, 'Demo product', 123, 'aaaaaaaaaaaaa'),
(3, 'Demo product', 123, 'aaaaaa'),
(4, 'Demo product', 123, 'aaaaaaaaa'),
(5, 'New demo woooo', 1, 'hello mr new modal'),
(6, 'Demo product', 0, 'aaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `product_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`) VALUES
(14, 4, 'product_image_20220520110215231696-Rhonda-Byrne-Quote-The-life-of-your-dreams-everything-you-would.jpg'),
(15, 4, 'product_image_20220520110216Quotefancy-64376-3840x2160.jpg'),
(16, 4, 'product_image_20220520110216Quotefancy-80275-3840x2160.jpg'),
(21, 5, 'product_image_20220520111126Quotefancy-231830-3840x2160.jpg'),
(22, 5, 'product_image_20220520111126Quotefancy-231842-3840x2160.jpg'),
(23, 5, 'product_image_20220520111219Quotefancy-232020-3840x2160.jpg'),
(25, 6, 'product_image_20220520111323Quotefancy-231939-3840x2160.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
