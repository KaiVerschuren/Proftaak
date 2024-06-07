-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2024 at 07:45 AM
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

--
-- Table structure for table `credithistory`
--

CREATE TABLE `credithistory` (
  `hisortyId` int NOT NULL,
  `historyCredits` int NOT NULL,
  `historyTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `credithistory`
--

INSERT INTO `credithistory` (`hisortyId`, `historyCredits`, `historyTime`, `userId`) VALUES
(13, 1250, '2024-06-04 08:51:19', 2),
(14, 1249, '2024-06-04 08:54:30', 2),
(15, 1250, '2024-06-04 08:57:09', 2),
(16, 1250, '2024-06-04 08:57:16', 2),
(17, 1250, '2024-06-04 08:57:48', 2),
(18, 10124, '2024-06-04 08:58:06', 2),
(19, 10125, '2024-06-04 08:59:18', 2),
(20, 10123, '2024-06-04 09:00:16', 2),
(21, 10123, '2024-06-04 09:01:00', 2),
(22, 10122, '2024-06-04 09:01:13', 2),
(23, 2, '2024-06-04 09:02:01', 2),
(24, 2, '2024-06-04 09:05:09', 2),
(25, 2, '2024-06-04 09:05:27', 2),
(26, 2, '2024-06-04 09:06:01', 2),
(27, 2, '2024-06-04 09:06:07', 2),
(28, 3, '2024-06-04 09:13:19', 2),
(29, 4, '2024-06-04 09:13:30', 2),
(30, 5, '2024-06-04 09:13:37', 2),
(31, 6, '2024-06-04 09:13:41', 2),
(32, 7, '2024-06-04 09:13:42', 2),
(33, 8, '2024-06-04 09:13:42', 2),
(34, 9, '2024-06-04 09:13:43', 2),
(35, 10, '2024-06-04 09:13:44', 2),
(36, 11, '2024-06-04 09:13:45', 2),
(37, 12, '2024-06-04 09:13:45', 2),
(38, 13, '2024-06-04 09:13:46', 2),
(39, 14, '2024-06-04 09:13:47', 2),
(40, 15, '2024-06-04 09:13:47', 2),
(41, 16, '2024-06-04 09:13:48', 2),
(42, 17, '2024-06-04 09:13:48', 2),
(43, 18, '2024-06-04 09:13:49', 2),
(44, 19, '2024-06-04 09:13:49', 2),
(45, 20, '2024-06-04 09:13:50', 2),
(46, 21, '2024-06-04 09:13:50', 2),
(47, 22, '2024-06-04 09:13:51', 2),
(48, 23, '2024-06-04 09:13:52', 2),
(49, 24, '2024-06-04 09:13:52', 2),
(50, 25, '2024-06-04 09:13:53', 2),
(51, 10158, '2024-06-04 09:14:58', 2),
(52, 20290, '2024-06-04 09:22:26', 2),
(53, 30420, '2024-06-04 09:24:05', 2),
(54, 40550, '2024-06-04 09:24:25', 2),
(55, 50679, '2024-06-04 09:25:25', 2),
(56, 60814, '2024-06-04 09:27:47', 2),
(57, 62064, '2024-06-04 09:27:59', 2),
(58, 61965, '2024-06-05 09:50:16', 2),
(59, 63255, '2024-06-05 09:51:06', 2),
(60, 63356, '2024-06-05 09:51:19', 2),
(61, 63483, '2024-06-05 13:18:59', 2),
(62, 63500, '2024-06-05 13:18:59', 2),
(63, 63521, '2024-06-05 13:18:59', 2),
(64, 63544, '2024-06-05 13:18:59', 2),
(65, 63567, '2024-06-05 13:18:59', 2),
(66, 63590, '2024-06-05 13:18:59', 2),
(67, 63613, '2024-06-05 13:18:59', 2),
(68, 63636, '2024-06-05 13:18:59', 2),
(69, 63659, '2024-06-05 13:18:59', 2),
(70, 63682, '2024-06-05 13:18:59', 2),
(71, 63705, '2024-06-05 13:18:59', 2),
(72, 63833, '2024-06-05 13:18:59', 2),
(73, 63856, '2024-06-05 13:18:59', 2),
(74, 63879, '2024-06-05 13:18:59', 2),
(75, 63902, '2024-06-05 13:18:59', 2),
(76, 63925, '2024-06-05 13:18:59', 2),
(77, 63947, '2024-06-05 13:18:59', 2),
(78, 63970, '2024-06-05 13:18:59', 2),
(79, 63993, '2024-06-05 13:18:59', 2),
(80, 64016, '2024-06-05 13:18:59', 2),
(81, 64039, '2024-06-05 13:18:59', 2),
(82, 64062, '2024-06-05 13:18:59', 2),
(83, 64085, '2024-06-05 13:18:59', 2),
(84, 64108, '2024-06-05 13:18:59', 2),
(85, 64131, '2024-06-05 13:18:59', 2),
(86, 64154, '2024-06-05 13:18:59', 2),
(87, 64177, '2024-06-05 13:18:59', 2),
(88, 64200, '2024-06-05 13:18:59', 2),
(89, 64223, '2024-06-05 13:18:59', 2),
(90, 64246, '2024-06-05 13:18:59', 2),
(91, 64269, '2024-06-05 13:18:59', 2),
(92, 64292, '2024-06-05 13:18:59', 2),
(93, 64315, '2024-06-05 13:18:59', 2),
(94, 64338, '2024-06-05 13:18:59', 2),
(95, 64357, '2024-06-05 13:18:59', 2),
(96, 64379, '2024-06-05 13:18:59', 2),
(97, 64402, '2024-06-05 13:18:59', 2),
(98, 64425, '2024-06-05 13:18:59', 2),
(99, 64448, '2024-06-05 13:18:59', 2),
(100, 64471, '2024-06-05 13:18:59', 2),
(101, 64494, '2024-06-05 13:18:59', 2),
(102, 64517, '2024-06-05 13:18:59', 2),
(103, 64540, '2024-06-05 13:18:59', 2),
(104, 64563, '2024-06-05 13:18:59', 2),
(105, 64586, '2024-06-05 13:18:59', 2),
(106, 64609, '2024-06-05 13:18:59', 2),
(107, 64632, '2024-06-05 13:18:59', 2),
(108, 64655, '2024-06-05 13:18:59', 2),
(109, 64678, '2024-06-05 13:18:59', 2),
(110, 64701, '2024-06-05 13:18:59', 2),
(111, 64724, '2024-06-05 13:18:59', 2),
(112, 64747, '2024-06-05 13:18:59', 2),
(113, 64770, '2024-06-05 13:18:59', 2),
(114, 64793, '2024-06-05 13:18:59', 2),
(115, 64816, '2024-06-05 13:18:59', 2),
(116, 64839, '2024-06-05 13:18:59', 2),
(117, 64862, '2024-06-05 13:18:59', 2),
(118, 64885, '2024-06-05 13:18:59', 2),
(119, 64908, '2024-06-05 13:18:59', 2),
(120, 64931, '2024-06-05 13:18:59', 2),
(121, 64954, '2024-06-05 13:18:59', 2),
(122, 64977, '2024-06-05 13:18:59', 2),
(123, 65000, '2024-06-05 13:18:59', 2),
(124, 65023, '2024-06-05 13:18:59', 2),
(125, 65046, '2024-06-05 13:18:59', 2),
(126, 65068, '2024-06-05 13:18:59', 2),
(127, 65091, '2024-06-05 13:18:59', 2),
(128, 65114, '2024-06-05 13:18:59', 2),
(129, 65137, '2024-06-05 13:18:59', 2),
(130, 65160, '2024-06-05 13:18:59', 2),
(131, 65183, '2024-06-05 13:18:59', 2),
(132, 65206, '2024-06-05 13:18:59', 2),
(133, 65229, '2024-06-05 13:18:59', 2),
(134, 65252, '2024-06-05 13:18:59', 2),
(135, 65275, '2024-06-05 13:18:59', 2),
(136, 65298, '2024-06-05 13:18:59', 2),
(137, 65321, '2024-06-05 13:18:59', 2),
(138, 65344, '2024-06-05 13:18:59', 2),
(139, 65367, '2024-06-05 13:18:59', 2),
(140, 65390, '2024-06-05 13:18:59', 2),
(141, 65413, '2024-06-05 13:18:59', 2),
(142, 65436, '2024-06-05 13:18:59', 2),
(143, 65459, '2024-06-05 13:18:59', 2),
(144, 65482, '2024-06-05 13:18:59', 2),
(145, 65505, '2024-06-05 13:18:59', 2),
(146, 65528, '2024-06-05 13:18:59', 2),
(147, 65551, '2024-06-05 13:18:59', 2),
(148, 65574, '2024-06-05 13:18:59', 2),
(149, 65597, '2024-06-05 13:18:59', 2),
(150, 65620, '2024-06-05 13:18:59', 2),
(151, 65643, '2024-06-05 13:18:59', 2),
(152, 65666, '2024-06-05 13:18:59', 2),
(153, 65689, '2024-06-05 13:18:59', 2),
(154, 65712, '2024-06-05 13:18:59', 2),
(155, 65735, '2024-06-05 13:18:59', 2),
(156, 65758, '2024-06-05 13:18:59', 2),
(157, 65781, '2024-06-05 13:18:59', 2),
(158, 65804, '2024-06-05 13:18:59', 2),
(159, 65827, '2024-06-05 13:18:59', 2),
(160, 65850, '2024-06-05 13:18:59', 2),
(161, 65978, '2024-06-05 13:19:39', 2),
(162, 66106, '2024-06-05 13:21:16', 2),
(163, 66234, '2024-06-05 13:21:37', 2),
(164, 66362, '2024-06-05 13:22:27', 2),
(165, 66490, '2024-06-05 13:23:55', 2),
(166, 66618, '2024-06-05 13:23:58', 2),
(167, 66747, '2024-06-05 13:26:07', 2),
(168, 66875, '2024-06-05 13:26:33', 2),
(169, 67003, '2024-06-05 13:27:18', 2),
(170, 67130, '2024-06-05 13:28:37', 2),
(171, 138603, '2024-06-06 17:41:15', 2),
(172, 210076, '2024-06-06 17:41:23', 2),
(173, 281580, '2024-06-06 17:42:59', 2),
(174, 353094, '2024-06-06 17:44:40', 2),
(175, 424573, '2024-06-06 17:46:57', 2),
(176, 424474, '2024-06-06 20:27:06', 2),
(177, 152, '2024-06-06 20:28:31', 2),
(178, 204, '2024-06-06 20:37:20', 2),
(179, 256, '2024-06-06 20:37:23', 2),
(180, 308, '2024-06-06 20:37:58', 2),
(181, 361, '2024-06-06 20:38:01', 2),
(182, 414, '2024-06-06 20:38:07', 2),
(183, 518, '2024-06-06 20:38:32', 2),
(184, 518, '2024-06-06 20:38:34', 2),
(185, 622, '2024-06-06 20:38:37', 2),
(186, 642, '2024-06-06 20:42:59', 2),
(187, -1, '2024-06-06 20:44:49', 2),
(188, 71071, '2024-06-06 20:45:06', 2),
(189, 142170, '2024-06-06 20:47:48', 2),
(190, 213268, '2024-06-06 20:48:00', 2),
(191, 284366, '2024-06-06 20:48:16', 2),
(192, 355472, '2024-06-06 20:48:25', 2),
(193, 426593, '2024-06-06 20:52:11', 2),
(194, 50, '2024-06-06 20:52:35', 2),
(195, 50, '2024-06-06 20:52:46', 2),
(196, 0, '2024-06-06 20:55:15', 2),
(197, 71272, '2024-06-07 09:31:08', 2),
(198, 74, '2024-06-07 09:39:18', 2),
(199, 746, '2024-06-07 09:42:51', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userDisplayName`, `userEmail`, `userPassword`, `userStatus`, `userCredits`) VALUES
(2, 'Admin 1', 'admin@gmail.com', '$2y$10$QZI28.RTj/Oy.H4Tm.9Fquxk4qXQxSkDOFo99NIHkBIcGggLKFvha', 'admin', 747);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userwallet`
--

INSERT INTO `userwallet` (`id`, `currency`, `currencyFull`, `amountCredits`, `amountCrypto`, `initialPayed`, `timeOfPayment`, `userId`) VALUES
(90, 'BTC', 'bitcoin', 71198, 1.0000004791359216, 71197.965886497, '2024-06-07 07:39:18', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credithistory`
--
ALTER TABLE `credithistory`
  ADD PRIMARY KEY (`hisortyId`),
  ADD KEY `credithistory_ibfk_1` (`userId`);

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
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credithistory`
--
ALTER TABLE `credithistory`
  MODIFY `hisortyId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

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
