-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2019 at 08:19 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SEED`
--

-- --------------------------------------------------------

--
-- Table structure for table `DEPOSIT`
--

CREATE TABLE `DEPOSIT` (
  `depositID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Log` varchar(100) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `mapdata`
--

CREATE TABLE `mapdata` (
  `ID` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `lat` decimal(12,8) NOT NULL,
  `lng` decimal(12,8) NOT NULL,
  `bed` int(2) NOT NULL,
  `bath` int(2) NOT NULL,
  `car` int(2) NOT NULL,
  `sqmetres` varchar(20) NOT NULL,
  `deposit` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapdata`
--

INSERT INTO `mapdata` (`ID`, `address`, `lat`, `lng`, `bed`, `bath`, `car`, `sqmetres`, `deposit`, `image`) VALUES
(1, '9 DAVENPORT STREET, Chermside, Qld 4032', '-27.39255000', '153.02841000', 3, 1, 1, '405', 43000, '9DavenportStreet.jpg'),
(2, '137 CENTRAL AVENUE, St Lucia, Qld 4067', '-27.49855000', '153.00204000', 2, 1, 1, '468', 82500, '137CentralAvenue.jpg'),
(4, '9 HENLEY COURT, Carindale, Qld 4152', '-27.52126000', '153.11733000', 5, 3, 4, '879', 119000, '9HenleyCourt.jpg'),
(6, '23 NUMBAT STREET, North Lakes, Qld 4509', '-27.21181000', '153.01251000', 5, 2, 2, '576', 55490, '23NumbatStreet.jpg'),
(7, '62 JAMIESON PLACE, Brookfield, Qld 4069', '-27.50810000', '152.92140000', 4, 2, 3, '832', 90500, '62JamiesonPlace.jpg'),
(9, '3/57 FAIRBANK STREET, Sunnybank, Qld 4109', '-27.57601000', '153.05700000', 2, 1, 1, '55', 29100, '357FairbankStreet.jpg'),
(10, '26 MOFFATT STREET, Ipswich, Qld 4305', '-27.62455000', '152.75883000', 3, 1, 2, '911', 29500, '26MoffattStreet.jpg'),
(11, '37 ORLEIGH STREET, West End, Qld 4101', '-27.48943000', '153.00157000', 4, 3, 3, '316', 210000, '37OrleighStreet.jpg'),
(12, '30 LOFFS ROAD Loganholme, Qld 4129', '-27.69748000', '153.18099000', 4, 2, 1, '812', 43500, '30LoffsRoad.jpg'),
(13, '29 WILLOWIE CRESCENT, Capalaba, Qld 4157', '-27.53681000', '153.18272000', 4, 2, 2, '1844', 80900, '29WillowieCrescent.jpg'),
(14, '140 ERIC STREET, Goodna, Qld 4300', '-27.61850000', '152.89531000', 3, 1, 1, '607', 22900, '140EricStreet.jpg'),
(15, '35 ABBOTT STREET, Ascot, Qld 4007', '-27.43292000', '153.05858000', 3, 3, 4, '572', 130000, '35AbbottStreet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGES`
--

CREATE TABLE `MESSAGES` (
  `MessageId` int(11) NOT NULL,
  `Sender` varchar(100) NOT NULL,
  `Receiver` varchar(100) NOT NULL,
  `Type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Password_Salt` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Goal` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT '0',
  `Frequency` varchar(20) DEFAULT NULL,
  `Due` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `DEPOSIT`
--
ALTER TABLE `DEPOSIT`
  ADD PRIMARY KEY (`depositID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Email_2` (`Email`);

--
-- Indexes for table `mapdata`
--
ALTER TABLE `mapdata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  ADD PRIMARY KEY (`MessageId`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DEPOSIT`
--
ALTER TABLE `DEPOSIT`
  MODIFY `depositID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `mapdata`
--
ALTER TABLE `mapdata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  MODIFY `MessageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `DEPOSIT`
--
ALTER TABLE `DEPOSIT`
  ADD CONSTRAINT `DEPOSIT_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `USER` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
