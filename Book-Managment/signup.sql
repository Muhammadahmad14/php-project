-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 01:35 PM
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
-- Database: `signup`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `Reference_num` varchar(100) NOT NULL,
  `shelf_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `book_name`, `author_name`, `Reference_num`, `shelf_id`) VALUES
(2, 'Effective C++', 'Scott Meyers', 'B102', 3),
(3, 'Java: The Complete Reference', 'Herbert Schildt', 'B103', 2),
(4, 'Head First Java', 'Kathy Sierra & Bert Bates', 'B104', 2),
(5, 'Eloquent JavaScript', 'Marijn Haverbeke', 'B105', 3),
(6, 'You Don’t Know JS', 'Kyle Simpson', 'B106', 3),
(11, 'Java OOP', 'Muhammad Ahmad', 'E2132', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `shelf_id` int(11) NOT NULL,
  `shelf_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`shelf_id`, `shelf_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `first_name`, `last_name`, `email`, `user_name`, `Password`) VALUES
(5, 'Muhammad', 'Ahmad', 'ahmadbuzdar76@gmail.com', 'ahmad', '25d55ad283aa400af464c76d713c07ad'),
(6, 'Muhammad', 'fahad', 'fahad@gmail.com', 'fahad', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'Muhammad', 'Ahmad', 'ahmad@gmail.com', 'ahmadkhan', '25d55ad283aa400af464c76d713c07ad'),
(8, 'Muhammad', 'AQIB', 'aqib@gmail.com', 'aqib', '25d55ad283aa400af464c76d713c07ad'),
(9, 'Muhammad', 'Ahmad', 'ahmadbuzdar7612@gmail.com', 'khan', '25d55ad283aa400af464c76d713c07ad'),
(10, 'Muhammad ', 'Azam', 'azam@gmail.com', 'azam', '25d55ad283aa400af464c76d713c07ad'),
(11, 'Aurabgzaib', 'sokar', 'sikare@gmail.com', 'sokrekhan', 'sokre123'),
(12, 'muhammad ', 'Ahmad', 'ahmad12@gmail.com', 'ahmadkhanwe', '25d55ad283aa400af464c76d713c07ad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Reference_num` (`Reference_num`),
  ADD KEY `shelf_id` (`shelf_id`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelf_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `shelf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`shelf_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
