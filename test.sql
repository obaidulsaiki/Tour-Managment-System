-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2025 at 12:54 AM
-- Server version: 8.0.42
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tour_id` int NOT NULL,
  `booking_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `number_of_guests` int NOT NULL,
  `travel_date` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `tour_id`, `booking_date`, `number_of_guests`, `travel_date`, `status`) VALUES
(1, 3, 2, '2025-05-13 00:00:00', 1, '2025-05-20', 'Booked'),
(2, 3, 1, '2025-05-13 00:00:00', 1, '2025-05-20', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `PID` int NOT NULL,
  `package_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type_of_tour` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meals` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tour_details_1` text COLLATE utf8mb4_general_ci,
  `include` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`PID`, `package_name`, `type_of_tour`, `package_pic`, `duration`, `meals`, `tour_details_1`, `include`, `created_at`, `price`) VALUES
(1, 'Sundarbans Expedition', 'long', 'C:\\Program Files\\Ampps\\www\\TMS\\tour_packages\\assets/sundarbans.jpg', '3 Days 2 Nights', 'All meals included', 'Arrival at Khulna, journey to Sundarbans by boat. Explore wildlife, jungle walk, and canal cruising. Return via Mongla Port.', 'Boat ride, Guide, Forest Entry Fees, Meals, Accommodation', '2025-05-12 21:35:58', 6000.00),
(2, 'Cox’s Bazar Beach Escape', 'long', 'coxsbazar.jpg', '4 Days 3 Nights', 'Breakfast only', 'Arrival at Cox’s Bazar by AC bus. Enjoy the world’s longest sea beach, Himchori & Inani visit. Return via night coach.', 'Beach visit, Hotel stay, Breakfast, Transport', '2025-05-12 21:35:58', 7800.00),
(3, 'Saint Martin Coral Adventure', 'long', 'saintmartin.jpg', '3 Days 2 Nights', '3 meals per day', 'Arrival at Teknaf, sea cruise to Saint Martin Island. Coral beach walk, local seafood, sunrise views. Return by ship.', 'Ship ticket, Hotel, Meals, Tour guide, Sightseeing', '2025-05-12 21:35:58', 9000.00),
(4, 'Sylhet & Ratargul Swamp Forest', 'Day', 'sylhet_ratargul.jpg', '2 Days 1 Night', 'Lunch and dinner', 'Arrival at Sylhet by train. Explore Ratargul Swamp Forest by boat, visit tea gardens. Return via Sylhet station.', 'Transport, Entry fees, Boat ride, Meals, Accommodation', '2025-05-12 21:35:58', 3300.00),
(5, 'Bandarban Trekking Tour', 'Long', 'bandarban.jpg', '3 Days 2 Nights', 'Full board', 'Arrival at Bandarban. Trekking to Nilgiri and Nafakhum, experience tribal culture. Return by bus to Dhaka.', 'Guide, Trekking permit, Meals, Lodging, Local transport', '2025-05-12 21:35:58', 4500.00),
(6, 'Srimangal Tea Garden Retreat', 'Day', 'srimangal.jpg', '2 Days 1 Night', 'Breakfast and dinner', 'Arrival in Srimangal. Visit tea gardens, Lawachara rainforest, and tribal village. Return by train to Dhaka.', 'Resort stay, Entry fees, Breakfast, Transport', '2025-05-12 21:35:58', 9000.00),
(7, 'Kuakata Sea Sunrise & Sunset', 'Long', 'kuakata.jpg', '3 Days 2 Nights', 'All meals', 'Arrival at Kuakata. Watch sunrise and sunset at the sea beach, visit Buddhist temple. Return by night coach.', 'Transport, Hotel, Meals, Sightseeing', '2025-05-12 21:35:58', 4000.00),
(8, 'Chittagong Hill Tracts Adventure', 'Day', 'cht.jpg', '4 Days 3 Nights', 'Full meals', 'Arrival at Rangamati. Boat trip on Kaptai Lake, tribal culture exploration. Return via Bandarban.', 'Guide, Meals, Hotel, Boat tour, Transport', '2025-05-12 21:35:58', 3400.00),
(9, 'Mahasthangarh & Bogura History Tour', 'Day', 'mahasthangarh.jpg', '2 Days 1 Night', 'Lunch included', 'Arrival at Bogura. Visit Mahasthangarh, Gokul Medh, local museum. Return by train to Dhaka.', 'Museum entry, Hotel, Lunch, Guide', '2025-05-12 21:35:58', 3460.00),
(10, 'Sajek Valley Cloud Tour', 'Day', 'sajek.jpg', '2 Days 1 Night', '3 meals', 'Arrival at Khagrachari. Drive to Sajek Valley by jeep, enjoy cloud walk and hills. Return via Khagrachari.', 'Transport, Jeep rental, Food, Hill permit, Hotel', '2025-05-12 21:35:58', 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PrID` int NOT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `product_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color_available` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `size_available` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`, `address`, `password`, `created_at`) VALUES
(1, '', '', '', '', '$2y$10$9tJf3H5gjqq2DMVyfrjsY.xJRCJqRR5uZcIm5WtH5UZj2C4WVbk0W', '2025-05-12 20:36:12'),
(3, 'saki.obidul@gmail.com', 'sakoi', '01883440388', 'banmartek', '$2y$10$R8jE75foPzOA5vRGP72t3eO5YbyQOlcV0I33GKckbOXEtbZ/.pKPa', '2025-05-12 20:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PrID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `PID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PrID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
