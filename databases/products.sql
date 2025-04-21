-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 11:39 PM
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
-- Database: `signature cuisine`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(2, 'Beef Fried Rice', 'Fried Rice', 1200, 'Beef-Fried-Rice.jpg'),
(3, 'Beef Hamburger', 'Burgers', 1200, 'Beef-Hamburgers.jpg'),
(4, 'Biscuit Pudding', 'Desserts', 990, 'biscuit-pudding.jpg'),
(5, 'Blueberry Bubble Tea', 'Drinks', 1190, 'blueberry_green_tea_bubble_tea.jpg'),
(6, 'Buffalo Chicken Pizza', 'Pizza', 3290, 'Buffalo-Chicken-Pizza.jpg'),
(7, 'Cheesecake', 'Desserts', 990, 'cheesecake.jpg'),
(8, 'Chicken Burger', 'Burgers', 1200, 'Chicken cheesy burger.jpg'),
(9, 'Chicken Fried Rice', 'Fried Rice', 1200, 'chicken fried rice.jpg'),
(10, 'Chicken Alfredo Pasta', 'Pasta', 1190, 'Chicken-Alfredo pasta.jpg'),
(11, 'Faluda', 'Drinks', 990, 'faluda.jpg'),
(12, 'Ice cream', 'Desserts', 890, 'icecream.jpg'),
(13, 'Margherita Pizza', 'Pizza', 1890, 'Margherita-Pizza.jpg'),
(14, 'Mixed Fried Rice', 'Fried Rice', 1200, 'mixed-fried-rice.jpg'),
(15, 'Penne Alfredo Pasta', 'Pasta', 1190, 'One-Pot-Creamy-Penne-Alfredo- pasta.jpg'),
(16, 'Pepperoni Pizza', 'Pizza', 3290, 'pepperoni pizza.jpg'),
(17, 'Pesto Pasta', 'Pasta', 1190, 'pesto-pasta.jpg'),
(18, 'Prawn Burger', 'Burgers', 1190, 'prawn burger.jpg'),
(19, 'Salami Pizza', 'Pizza', 1290, 'salami pizza.jpg'),
(20, 'Seafood Fried Rice', 'Fried Rice', 1200, 'seafood fried rice.jpg'),
(21, 'Strawberry Bubble Tea', 'Drinks', 990, 'strawberry bubbele tea.jpg'),
(22, 'Tiramisu', 'Desserts', 990, 'tiramisu.jpg'),
(23, 'Virgin Mojito', 'Drinks', 1190, 'virgin mojito.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
