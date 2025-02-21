-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 04:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_description` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `quantity`, `price`) VALUES
(1, 'BBM Leather Sandals', 'Summertime, Daily, Class', 99, 250),
(2, 'BBM To Go - White Rubber Shoes', 'To go in any season', 99, 450),
(3, 'BBM Go Stroll Slipper Sandals', 'Summertime, Daily, Class', 99, 250),
(4, 'BBM To Go - Gray Rubber Shoes', 'To go in any season', 99, 450),
(5, 'BBM Go Stroll Sneakers', 'To go in any season', 99, 400),
(6, 'BBM Feminism Slippers', 'Summertime, Daily, Class', 99, 200),
(7, 'BBM Go Slay Boots', 'Wear,Slay, Conquer', 99, 600),
(8, 'BBM Collection of Imelda - White Heels', 'Be on top, of everyone', 99, 400),
(9, 'BBM Collection of Imelda - Black Heels', 'Be on top, of everyone', 99, 400),
(10, 'BBM Run Women - Brown', 'Run with your collection, Hawaii Friendly', 99, 450),
(11, 'BBM Kiddie Sandals - Black and White', 'Go Round and Round with BBM', 99, 250),
(12, 'BBM Go Run - Colorful Gray Boots', 'Start Young, Go Run', 99, 350),
(13, 'BBM Collection of Imelda - Kiddie Sandals', 'Like Mother, Like Daughter', 99, 400),
(14, 'BBM Collection of Imelda - Pink High Cut', 'Like Mother, Like Daughter', 99, 450),
(15, 'BBM Collection of Imelda - Kiddie Black Shoes', 'Slay While Young, Slay Until the End of Time', 99, 400),
(16, 'BBM Raise them Right Sandals - Blue Shiny', 'Nurture them, Teach them, Unite Them', 99, 350),
(17, 'BBM Raise them Right Sandals - Blue Semi-Leather', 'Nurture them, Teach them, Unite Them', 99, 350),
(18, 'BBM Raise them Right Shoe - Pink', 'Nurture them, Teach them, Unite Them', 99, 400),
(19, 'BBM Raise them Right Shoe - Green Frog', 'Nurture them, Teach them, Unite Them', 99, 400),
(20, 'BBM Raise them Right Shoe - Brown Boots', 'Nurture them, Teach them, Unite Them', 99, 450),
(21, 'BBM Gets Comfy Socks - Neutral', 'Always Rest and Watch the Rest', 99, 100),
(22, 'BBM Wear Me - Night Anklet', 'Be Shiny, Be Seen, Go Party', 99, 200),
(23, 'BBM Wear Me - Sea Anklet', 'Be Shiny, Be Seen, Go Party', 99, 230),
(24, 'BBM Be BOLD - Barefoot Sandals', 'Be Shiny, Be Seen, Go Party', 99, 200),
(25, 'BBM Gets Comfy Socks - Neutral', 'Always Rest and Watch the Rest', 99, 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `pr_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `username` varchar(60) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `Size` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `username`, `product_id`, `quantity`, `transaction_date`, `Size`) VALUES
(9, 'alyabong', 7, 5, '2024-05-11', NULL),
(10, 'scoups', 2, 2, '2024-05-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `username`, `email`, `birthdate`, `password`) VALUES
('Nazaria', 'Pasang', 'alyabong', 'dn.nazariapasang@gmail.com', '2008-12-08', '123458'),
('Seungcheol', 'Choi', 'scoups', 'choiseungcheol@gmail.com', '0000-00-00', 'svt13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `username` (`username`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `username` (`username`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
