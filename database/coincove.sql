-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 08:27 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coincove`
--

-- --------------------------------------------------------

-- Table structure for table `credithistory`
--

CREATE TABLE `credithistory` (
  `hisortyId` int NOT NULL,
  `historyCredits` int NOT NULL,
  `historyTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userId` int NOT NULL,
  `userDisplayName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userStatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userCredits` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userDisplayName`, `userEmail`, `userPassword`, `userStatus`, `userCredits`) VALUES
(2, 'Admin 1', 'admin@gmail.com', '$2y$10$QZI28.RTj/Oy.H4Tm.9Fquxk4qXQxSkDOFo99NIHkBIcGggLKFvha', 'admin', 2216);

-- --------------------------------------------------------

--
-- Table structure for table `usersettings`
--

CREATE TABLE `usersettings` (
  `id` int NOT NULL,
  `profilePublic` int NOT NULL DEFAULT '1',
  `profileCredits` int NOT NULL DEFAULT '1',
  `profileLeaderboard` int NOT NULL DEFAULT '1',
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersettings`
--

INSERT INTO `usersettings` (`id`, `profilePublic`, `profileCredits`, `profileLeaderboard`, `userId`) VALUES
(2, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userwallet`
--

CREATE TABLE `userwallet` (
  `id` int NOT NULL,
  `currency` varchar(255) NOT NULL,
  `currencyFull` varchar(255) NOT NULL,
  `amountCredits` double NOT NULL,
  `amountCrypto` double NOT NULL,
  `initialPayed` double NOT NULL,
  `timeOfPayment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userwallet`
--

INSERT INTO `userwallet` (`id`, `currency`, `currencyFull`, `amountCredits`, `amountCrypto`, `initialPayed`, `timeOfPayment`, `userId`) VALUES
(75, 'SOL', 'solana', 123, 0.7390909980696226, 166.42064417136, '2024-05-31 08:02:22', 2),
(76, 'BTC', 'bitcoin', 5000, 0.07336866213473532, 68148.986972366, '2024-05-31 08:03:43', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credithistory`
--
ALTER TABLE `credithistory`
  ADD PRIMARY KEY (`hisortyId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `userwallet`
--
ALTER TABLE `userwallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userwallet_ibfk_1` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credithistory`
--
ALTER TABLE `credithistory`
  MODIFY `hisortyId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usersettings`
--
ALTER TABLE `usersettings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userwallet`
--
ALTER TABLE `userwallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credithistory`
--
ALTER TABLE `credithistory`
  ADD CONSTRAINT `credithistory_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userwallet` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersettings`
--
ALTER TABLE `usersettings`
  ADD CONSTRAINT `usersettings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userinfo` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userwallet`
--
ALTER TABLE `userwallet`
  ADD CONSTRAINT `userwallet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userinfo` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
