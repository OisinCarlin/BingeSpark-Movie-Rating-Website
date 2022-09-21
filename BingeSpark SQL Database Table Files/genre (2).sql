-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2022 at 03:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocarlin04`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(2, 'Action'),
(3, 'Adventure'),
(4, 'Comedy'),
(5, 'Crime'),
(6, 'Drama'),
(7, 'Family'),
(8, 'Fantasy'),
(9, 'Horror'),
(10, 'Mystery'),
(11, 'Romance'),
(12, 'Sci-Fi'),
(13, 'Thriller'),
(14, 'Western'),
(15, 'Biography'),
(16, 'Sport'),
(17, 'History'),
(18, 'War'),
(19, 'Animation'),
(20, 'Music'),
(21, 'Musical'),
(22, 'Children'),
(23, 'Classic'),
(24, 'Cult'),
(25, 'Classic Movies'),
(26, 'International'),
(27, 'Independent'),
(28, 'Romance Movies'),
(29, 'Dramas'),
(30, 'Thrillers'),
(31, 'Documentaries'),
(32, 'Faith & Spirituality'),
(33, 'Romantic'),
(34, ' Cult'),
(35, ' Sci-Fi'),
(36, ' Thriller'),
(37, ' Drama'),
(38, ' Adventure'),
(39, ' Romance');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
