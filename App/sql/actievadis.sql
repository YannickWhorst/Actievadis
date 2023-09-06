-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 01:31 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actievadis`
--

-- --------------------------------------------------------

--
-- Table structure for table `activiteit`
--

CREATE TABLE `activiteit` (
  `id` int(11) NOT NULL,
  `activiteit_naam` varchar(255) NOT NULL,
  `activiteit_locatie` varchar(255) NOT NULL,
  `activiteit_eten` tinyint(1) NOT NULL,
  `activiteit_max_deelnemers` int(11) NOT NULL,
  `activiteit_min_deelnemers` int(11) NOT NULL,
  `activiteit_kosten` text NOT NULL,
  `activiteit_benodigdheden` varchar(255) NOT NULL,
  `activiteit_omschrijving` text NOT NULL,
  `activiteit_begin_tijd` datetime NOT NULL,
  `activiteit_eindtijd` datetime NOT NULL,
  `activiteit_afbeelding` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `covadiaan`
--

CREATE TABLE `covadiaan` (
  `id` int(11) NOT NULL,
  `covadiaan_naam` varchar(255) NOT NULL,
  `covadiaan_email` varchar(255) NOT NULL,
  `covadiaan_wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activiteit`
--
ALTER TABLE `activiteit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `covadiaan`
--
ALTER TABLE `covadiaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activiteit`
--
ALTER TABLE `activiteit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `covadiaan`
--
ALTER TABLE `covadiaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
