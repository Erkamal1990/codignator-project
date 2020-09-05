-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 11:14 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userid` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `uname`, `email`, `mobile`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '9974177408', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `timestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `status`, `timestamp`) VALUES
(3, 'MEN', 1, 1599159180),
(4, 'WOMEN', 1, 1599159189),
(5, 'HANDBAGS', 1, 1599159196),
(6, 'COSMETICS', 1, 1599159206);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `img_id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `image_url` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '0= inactive, 1= active',
  `timestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`img_id`, `name`, `image_url`, `status`, `timestamp`) VALUES
(13, 'levi\'s', '1599163011_4.png', 1, 1599163011),
(14, 'allen solly', '1599163043_5.png', 1, 1599163043),
(15, 'Londan', '1599163059_6.png', 1, 1599163059),
(16, 'wankanar', '1599163078_7.png', 1, 1599163078);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cst_id` int(110) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `price` varchar(110) DEFAULT NULL,
  `additional_price` varchar(110) DEFAULT NULL,
  `is_paid` varchar(110) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `comments` text,
  `order_date` int(110) DEFAULT NULL,
  `payment_mode` varchar(225) DEFAULT NULL,
  `created_at` int(110) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cst_id`, `address_id`, `price`, `additional_price`, `is_paid`, `order_status`, `comments`, `order_date`, `payment_mode`, `created_at`, `update_at`) VALUES
(5, 3, 2, '10,850', '10,850', 'Pending Payment', 'Processing', 'test', 1580924992, 'COD', 1580924992, '2020-02-05 17:49:52'),
(6, 3, 2, '4,350', '4,350', 'Pending Payment', 'Processing', '', 1581003943, 'COD', 1581003943, '2020-02-06 15:45:43'),
(7, 3, 2, '4,350', '4,350', 'Pending Payment', 'Processing', 'test', 1581012739, 'COD', 1581012739, '2020-02-06 18:12:19'),
(8, 3, 3, '8,700', '8,700', 'Pending Payment', 'Processing', 'test', 1581440382, 'COD', 1581440382, '2020-02-11 16:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` bigint(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `name`, `price`, `image`, `status`, `created_at`, `update_at`) VALUES
(7, 3, 'Formal shoes', 220, '1599159293_tp1.jpg', 1, 1599159293, '2020-09-03 18:54:53'),
(8, 3, 'Formal shirt', 190, '1599159341_tp2.jpg', 1, 1599159341, '2020-09-03 18:55:41'),
(9, 4, 'Casual wear', 200, '1599159404_tp5.jpg', 1, 1599159404, '2020-09-03 18:56:44'),
(10, 4, 'Casual wear new', 200, '1599159615_tp6.jpg', 1, 1599159615, '2020-09-03 19:00:15'),
(11, 4, 'Party wear ', 2000, '1599159654_tp7.jpg', 1, 1599159654, '2020-09-03 19:00:54'),
(12, 4, 'Party wear top', 1500, '1599159685_tp8.jpg', 1, 1599159685, '2020-09-03 19:01:25'),
(13, 5, 'Handbag', 200, '1599159714_tp9.jpg', 1, 1599159714, '2020-09-03 19:01:54'),
(14, 5, 'Handbag Latest Range', 199, '1599159746_tp10.jpg', 1, 1599159746, '2020-09-03 19:02:26'),
(15, 5, 'Handbag New', 100, '1599159771_tp11.jpg', 1, 1599159771, '2020-09-03 19:02:51'),
(16, 5, 'Handbag Top', 125, '1599159798_tp12.jpg', 1, 1599159799, '2020-09-03 19:03:19'),
(17, 6, 'Eye makeup', 200, '1599167405_tp13.jpg', 1, 1599167405, '2020-09-03 21:10:05'),
(18, 6, 'Gold makeup', 300, '1599167432_tp14.jpg', 1, 1599167432, '2020-09-03 21:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `value` text,
  `image` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '0= inactive, 1= active',
  `timestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `image`, `status`, `timestamp`) VALUES
(3, 'header_phone', '9974177408', NULL, 1, 1599162866),
(4, 'header_logo', 'logos', '1599165332_4.png', 1, 1599162888);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `description` text,
  `url` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '0= inactive, 1= active',
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `description`, `url`, `image`, `status`, `timestamp`) VALUES
(1, '<h2>WELCOME TO this</h2><h3>FASHION <span>CLUB</span></h3><p>Suspendisse sed tellus id libero pretium interdum. Suspendisse potenti. Quisque consectetur elit sit amet vehicula tristique. </p>', 'abour', '1599167522_tp2.jpg', 1, '2020-09-03 23:51:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
