-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 08:10 AM
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
-- Database: `ajhb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Cakes', 'Food_Category_569.jpg', 'Yes', 'Yes'),
(2, 'Cupcakes', 'Food_Category_253.jpg', 'Yes', 'Yes'),
(3, 'Cookies', 'Food_Category_319.jpg', 'Yes', 'Yes'),
(4, 'Pastries', 'Food_Category_421.jpg', 'Yes', 'Yes'),
(5, 'Breads', 'Food_Category_480.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `contact_no`, `address`, `email`, `username`, `password`) VALUES
(4, 'Abdul Alim', '0102032674', 'Jalan 5, Taman University, Parit Raja', 'bi220016@student.uthm.edu.my', 'alim', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(4, 'Carrot Cake', 'Diameter: 8 inch<br>Height: 5 inch<br>Toppings: Cream cheese & crushed nuts<br>Serves: 8-12 people', 80.00, 'Food-Name-311.jpg', 1, 'No', 'Yes'),
(5, 'Cheesecake', 'Diameter: 8 inch\r\n<br>\r\nHeight: 5 inch\r\n<br>\r\nToppings: Cream cheese & strawberries\r\n<br>\r\nServes: 8-12 people', 80.00, 'Food-Name-8847.jpg', 1, 'Yes', 'Yes'),
(9, 'Chocolate Moist Cake', 'Diameter: 6 inch\r\n<br>\r\nHeight: 5 inch\r\n<br>\r\nToppings: Chocolate buttercream & chocolate pieces\r\n<br>\r\nServes: 8-12 people', 60.00, 'Food-Name-5741.jpg', 1, 'Yes', 'Yes'),
(10, 'Chocolate Cupcakes - 15 pcs', 'Diameter: 4.4 cm (Base) 5.5 cm (Top)\r\n<br>\r\nHeight: 3.4 cm\r\n<br>\r\nToppings: Chocolate buttercream\r\n<br>\r\nServes: 15 people', 60.00, 'Food-Name-256.jpg', 2, 'Yes', 'Yes'),
(11, 'Red Velvet Cupcakes - 15 pcs', 'Diameter: 4.4 cm (Base) 5.5 cm (Top)\r\n<br>\r\nHeight: 3.4 cm\r\n<br>\r\nToppings: Cream cheese & red velvet crumbs\r\n<br>\r\nServes: 15 people', 67.00, 'Food-Name-2831.jpg', 2, 'No', 'Yes'),
(12, 'Strawberry Cupcakes - 15 pcs', 'Diameter: 4.4 cm (Base) 5.5 cm (Top)\r\n<br>\r\nHeight: 3.4 cm\r\n<br>\r\nToppings: Strawberry buttercream & half a strawberry\r\n<br>\r\nServes: 15 people\r\n\r\n', 60.00, 'Food-Name-6475.jpg', 2, 'No', 'Yes'),
(13, 'Classic Chocolate Chip Cookies', 'Net weight: 500 g\r\n<br>\r\nTotal servings: 24 pieces\r\n<br>\r\nFillings: Chocolate chips\r\n<br>\r\nServes: 8-24 people', 33.00, 'Food-Name-9432.jpg', 3, 'No', 'Yes'),
(14, 'Nutella Chocolate Chip Cookies', 'Net weight: 500 g\r\n<br>\r\nTotal servings: 24 pieces\r\n<br>\r\nFillings: Chocolate chips & Nutella\r\n<br>\r\nServes: 8-24 people', 40.00, 'Food-Name-7443.jpg', 3, 'Yes', 'Yes'),
(15, 'Raisin Oatmeal Cookies', 'Net weight: 500 g\r\n<br>\r\nTotal servings: 24 pieces\r\n<br>\r\nFillings: Raisins\r\n<br>\r\nServes: 8-24 people', 33.00, 'Food-Name-660.jpg', 3, 'No', 'Yes'),
(16, 'Cheese Tart - 6 pcs', 'Diameter: 3 cm (Base) 5.5 cm (Top)\r\n<br>\r\nHeight: 1.5 cm\r\n<br>\r\nFillings: Cream cheese\r\n<br>\r\nServes: 6 people', 30.00, 'Food-Name-7073.jpg', 4, 'Yes', 'Yes'),
(17, 'Pavlova', 'Diameter: 6 inch\r\n<br>\r\nHeight: 3 inch\r\n<br>\r\nFillings: Fresh fruits and whipped cream\r\n<br>\r\nServes: 3-8 people', 45.00, 'Food-Name-8323.jpg', 4, 'No', 'Yes'),
(18, 'Pineapple Tart - 45 pcs', 'Net weight: 500 g\r\n<br>\r\nTotal servings: 45 pieces\r\n<br>\r\nFillings: Pineapple jam\r\n<br>\r\nServes: 8-24 people', 30.00, 'Food-Name-839.jpg', 4, 'No', 'Yes'),
(19, 'Cream Cheese Garlic Bun', 'Net weight: 144g\r\n<br>\r\nTotal servings: 1 piece\r\n<br>\r\nFillings: Cream cheese & garlic\r\n<br>\r\nServes: 1-2 people', 6.00, 'Food-Name-5826.jpg', 5, 'Yes', 'Yes'),
(20, 'Garlic Bread', 'Net weight: 324 g\r\n<br>\r\nTotal servings: 1 loaf (6 slices)\r\n<br>\r\nFillings: Garlic butter\r\n<br>\r\nServes: 3-6 people', 7.00, 'Food-Name-6720.jpg', 5, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `delivery` tinyint(1) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food`, `total`, `remark`, `delivery`, `payment`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(48, '<br>Cheese Tart - 6 pcs (RM30.00 x 1 = RM30.00)<br><br>Subtotal: RM30.00<br>Delivery fee: RM10.00<br>Total: RM40.00', 40.00, '', 0, 'Cash', '2025-01-01 04:19:18', 'Delivered', 'Abdul Alim', '0102032674', 'bi220016@student.uthm.edu.my', 'Jalan 5, Taman University, Parit Raja'),
(49, '<br>Carrot Cake (RM80.00 x 1 = RM80.00)<br>Pavlova (RM45.00 x 1 = RM45.00)<br><br>Subtotal: RM125.00<br>Delivery fee: RM10.00<br>Total: RM135.00', 135.00, '', 0, 'Cash', '2025-01-07 02:57:50', 'Ordered', 'Abdul Alim', '0102032674', 'bi220016@student.uthm.edu.my', 'Jalan 5, Taman University, Parit Raja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
