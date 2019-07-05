-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 07:02 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bernoulli`
--

-- --------------------------------------------------------

--
-- Table structure for table `word_annotation`
--

CREATE TABLE `word_annotation` (
  `id` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `word_annotation`
--

INSERT INTO `word_annotation` (`id`, `word`, `description`) VALUES
(66, 'johny maia monteiro', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. '),
(67, 'cachaça açai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. '),
(68, 'açai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. '),
(69, 'couve-flor', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. '),
(70, 'açafrão', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ');

-- --------------------------------------------------------

--
-- Table structure for table `word_tag`
--

CREATE TABLE `word_tag` (
  `id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `word_tag`
--

INSERT INTO `word_tag` (`id`, `word_id`, `name`) VALUES
(429, 66, 'johny'),
(430, 66, 'maia'),
(431, 66, 'monteiro'),
(432, 67, 'cachaça'),
(433, 67, 'açai'),
(434, 68, 'açai'),
(435, 69, 'couve-flor'),
(436, 70, 'açafrão');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `word_annotation`
--
ALTER TABLE `word_annotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `word_tag`
--
ALTER TABLE `word_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `word_id` (`word_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `word_annotation`
--
ALTER TABLE `word_annotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `word_tag`
--
ALTER TABLE `word_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `word_tag`
--
ALTER TABLE `word_tag`
  ADD CONSTRAINT `word_tag_ibfk_1` FOREIGN KEY (`word_id`) REFERENCES `word_annotation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
