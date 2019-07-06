-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2019 at 10:33 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getme_funding`
--

-- --------------------------------------------------------

--
-- Table structure for table `entrepreneur`
--

CREATE TABLE `entrepreneur` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `contactNo` varchar(25) DEFAULT NULL,
  `loginType` tinyint(4) NOT NULL COMMENT '1=> Normal, 2=> Google',
  `startupName` varchar(250) DEFAULT NULL,
  `websiteUrl` varchar(200) DEFAULT NULL,
  `noOfTeamMember` int(11) DEFAULT NULL,
  `noOfCofounder` int(11) DEFAULT NULL,
  `locationName` varchar(250) DEFAULT NULL,
  `inceptionDate` date DEFAULT NULL,
  `registered` tinyint(4) DEFAULT NULL COMMENT '1=>Yes, 2=>No',
  `sectorId` tinyint(4) DEFAULT NULL,
  `startupType` tinyint(4) DEFAULT NULL COMMENT '1=>online,2=>offline,3=>Both',
  `stageId` tinyint(4) DEFAULT NULL,
  `revenueNextFiveYears` int(11) DEFAULT NULL,
  `avgMonthlyRevenue` int(11) DEFAULT NULL,
  `totalRevenueTillNow` int(11) DEFAULT NULL,
  `lookingToRaise` int(11) DEFAULT NULL,
  `equityDilutedForAboveAmount` int(11) DEFAULT NULL,
  `fundingRaisedAlready` tinyint(4) DEFAULT NULL COMMENT '1=>Yes, 2=> No',
  `nearestCompetitorName` varchar(100) DEFAULT NULL,
  `amountInvestedAlready` tinyint(4) DEFAULT NULL,
  `aboutUs` varchar(1000) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `formNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `contactNo` varchar(50) DEFAULT NULL,
  `loginType` tinyint(4) DEFAULT NULL COMMENT '1=>Normal, 2=>Google',
  `locationID` int(11) DEFAULT NULL,
  `sectorId` tinyint(4) DEFAULT NULL,
  `firmName` varchar(100) DEFAULT NULL,
  `formNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mastercountry`
--

CREATE TABLE `mastercountry` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mastersector`
--

CREATE TABLE `mastersector` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masterstage`
--

CREATE TABLE `masterstage` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entrepreneur`
--
ALTER TABLE `entrepreneur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mastercountry`
--
ALTER TABLE `mastercountry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastersector`
--
ALTER TABLE `mastersector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masterstage`
--
ALTER TABLE `masterstage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entrepreneur`
--
ALTER TABLE `entrepreneur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastercountry`
--
ALTER TABLE `mastercountry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastersector`
--
ALTER TABLE `mastersector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masterstage`
--
ALTER TABLE `masterstage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
