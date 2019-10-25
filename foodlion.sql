-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 08:21 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodlion`
--

-- --------------------------------------------------------

--
-- Table structure for table `prev_order`
--

CREATE TABLE `prev_order` (
  `id` int(11) NOT NULL,
  `items` text NOT NULL,
  `comments` text NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prev_order`
--

INSERT INTO `prev_order` (`id`, `items`, `comments`, `userid`) VALUES
(7, 'Sugar\r\nTea', 'Sugar', 1),
(8, 'Milk1', 'Milk1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `phonenumber` int(23) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phonenumber`, `zip`, `password`, `creationdate`) VALUES
(1, 'Waqas', 'Hameed', 'waqas@hotmail.com', 1234567, '324', '57a2e1f5c2ee57e7ab421e03944cb727', '2018-11-18'),
(2, 'khalid', 'Hameed', 'khalid@hotmail.com', 1234567, '12345', '794761a765ceca759536a1bf39100142', '2018-11-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prev_order`
--
ALTER TABLE `prev_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prev_order`
--
ALTER TABLE `prev_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prev_order`
--
ALTER TABLE `prev_order`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
