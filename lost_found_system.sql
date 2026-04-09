-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2026 at 02:57 PM
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
-- Database: `lost_found_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `found_items`
--

CREATE TABLE `found_items` (
  `found_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location_found` varchar(100) DEFAULT NULL,
  `date_found` date DEFAULT NULL,
  `status` enum('open','matched','closed') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `found_items`
--

INSERT INTO `found_items` (`found_id`, `user_id`, `item_name`, `category`, `description`, `location_found`, `date_found`, `status`) VALUES
(2, 7, 'id', 'Documents', 'I found someones id ', 'library', '2026-03-21', 'open'),
(3, 7, 'phone', 'Electronics', 'I found iphone', 'mdx', '2026-03-18', 'open'),
(4, 5, 'id', 'Documents', 'I found someones id card', 'library', '2026-03-21', 'open'),
(5, 7, 'id card', 'Documents', 'I found someones id card', 'mdx house', '2026-03-21', 'open'),
(6, 7, 'id card', 'Documents', 'I found id card', 'mdx play', '2026-03-21', 'open'),
(7, 7, 'i watch', 'Electronics', 'i found i watch', 'mdx home', '2026-03-26', 'open'),
(8, 7, 'id card ', 'Documents', 'i found someones id card..', 'library', '2026-03-26', 'open'),
(9, 5, 'paper', 'Documents', 'I found paper', 'uni', '2026-04-02', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `lost_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location_lost` varchar(100) DEFAULT NULL,
  `date_lost` date DEFAULT NULL,
  `status` enum('open','matched','closed') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`lost_id`, `user_id`, `item_name`, `category`, `description`, `location_lost`, `date_lost`, `status`) VALUES
(3, 5, 'id', 'Documents', 'I lost my id.', 'library', '2026-03-20', 'open'),
(4, 5, 'phone', 'Electronics', 'I lost my iPhone', 'mdx', '2026-03-18', 'open'),
(5, 7, 'id', 'Documents', 'I lost my id ', 'library', '2026-03-21', 'open'),
(6, 5, 'id card', 'Documents', 'I lost my id card', 'mdx house', '2026-03-21', 'open'),
(7, 5, 'id card', 'Documents', 'I lost my id card', 'mdx play', '2026-03-20', 'open'),
(8, 5, 'i watch', 'Electronics', 'i lost my i watch.', 'mdx home', '2026-03-25', 'open'),
(9, 12, 'id card', 'Documents', 'i lost my id card', 'library', '2026-03-24', 'open'),
(10, 13, 'paper', 'Documents', 'I lost my papers', 'uni', '2026-04-01', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `lost_id` int(11) DEFAULT NULL,
  `found_id` int(11) DEFAULT NULL,
  `match_score` float DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `lost_id`, `found_id`, `match_score`, `status`) VALUES
(1, 3, 2, 11, 'pending'),
(2, 5, 2, 11, 'pending'),
(3, 6, 2, 6, 'pending'),
(4, 7, 2, 6, 'pending'),
(5, 4, 3, 11, 'pending'),
(6, 3, 4, 11, 'pending'),
(7, 5, 4, 11, 'pending'),
(8, 6, 4, 6, 'pending'),
(9, 7, 4, 6, 'pending'),
(10, 3, 5, 6, 'pending'),
(11, 5, 5, 6, 'pending'),
(12, 6, 5, 11, 'pending'),
(13, 7, 5, 10, 'pending'),
(14, 3, 6, 6, 'pending'),
(15, 5, 6, 6, 'pending'),
(16, 6, 6, 10, 'pending'),
(17, 7, 6, 11, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `is_read`) VALUES
(8, 5, 'Match found for your lost item: id', 0),
(9, 7, 'Match found for your lost item: id', 0),
(10, 5, 'Match found for your lost item: id card', 0),
(11, 5, 'Match found for your lost item: phone', 0),
(12, 5, 'Your lost item matched: id', 0),
(13, 7, 'Item you found matches: id', 0),
(14, 7, 'Your lost item matched: id', 0),
(15, 7, 'Item you found matches: id', 0),
(16, 5, 'Your lost item matched: id card', 0),
(17, 7, 'Item you found matches: id', 0),
(18, 5, 'Your lost item matched: id card', 0),
(19, 7, 'Item you found matches: id', 0),
(20, 5, 'Your lost item matched: phone', 0),
(21, 7, 'Item you found matches: phone', 0),
(22, 5, 'Your lost item matched: id', 0),
(23, 5, 'Item you found matches: id', 0),
(24, 7, 'Your lost item matched: id', 0),
(25, 5, 'Item you found matches: id', 0),
(26, 5, 'Your lost item matched: id card', 0),
(27, 5, 'Item you found matches: id', 0),
(28, 5, 'Your lost item matched: id card', 0),
(29, 5, 'Item you found matches: id', 0),
(30, 5, 'Your lost item matched: id', 0),
(31, 7, 'Item you found matches: id card', 0),
(32, 7, 'Your lost item matched: id', 0),
(33, 7, 'Item you found matches: id card', 0),
(34, 5, 'Your lost item matched: id card', 0),
(35, 7, 'Item you found matches: id card', 0),
(36, 5, 'Your lost item matched: id card', 0),
(37, 7, 'Item you found matches: id card', 0),
(38, 5, 'Your lost item matched: id', 0),
(39, 7, 'Item you found matches: id card', 0),
(40, 7, 'Your lost item matched: id', 0),
(41, 7, 'Item you found matches: id card', 0),
(42, 5, 'Your lost item matched: id card', 0),
(43, 7, 'Item you found matches: id card', 0),
(44, 5, 'Your lost item matched: id card', 0),
(45, 7, 'Item you found matches: id card', 0),
(46, 5, 'Your lost item matched: id', 0),
(47, 7, 'Item you found matches: id', 0),
(48, 7, 'Your lost item matched: id', 0),
(49, 7, 'Item you found matches: id', 0),
(50, 5, 'Your lost item matched: id card', 0),
(51, 7, 'Item you found matches: id', 0),
(52, 5, 'Your lost item matched: id card', 0),
(53, 7, 'Item you found matches: id', 0),
(54, 5, 'Your lost item matched: phone', 0),
(55, 7, 'Item you found matches: phone', 0),
(56, 5, 'Your lost item matched: id', 0),
(57, 5, 'Item you found matches: id', 0),
(58, 7, 'Your lost item matched: id', 0),
(59, 5, 'Item you found matches: id', 0),
(60, 5, 'Your lost item matched: id card', 0),
(61, 5, 'Item you found matches: id', 0),
(62, 5, 'Your lost item matched: id card', 0),
(63, 5, 'Item you found matches: id', 0),
(64, 5, 'Your lost item matched: id', 0),
(65, 7, 'Item you found matches: id card', 0),
(66, 7, 'Your lost item matched: id', 0),
(67, 7, 'Item you found matches: id card', 0),
(68, 5, 'Your lost item matched: id card', 0),
(69, 7, 'Item you found matches: id card', 0),
(70, 5, 'Your lost item matched: id card', 0),
(71, 7, 'Item you found matches: id card', 0),
(72, 5, 'Your lost item matched: id', 0),
(73, 7, 'Item you found matches: id card', 0),
(74, 7, 'Your lost item matched: id', 0),
(75, 7, 'Item you found matches: id card', 0),
(76, 5, 'Your lost item matched: id card', 0),
(77, 7, 'Item you found matches: id card', 0),
(78, 5, 'Your lost item matched: id card', 0),
(79, 7, 'Item you found matches: id card', 0),
(80, 5, 'Your lost item matched: id', 0),
(81, 7, 'Item you found matches: id', 0),
(82, 7, 'Your lost item matched: id', 0),
(83, 7, 'Item you found matches: id', 0),
(84, 5, 'Your lost item matched: id card', 0),
(85, 7, 'Item you found matches: id', 0),
(86, 5, 'Your lost item matched: id card', 0),
(87, 7, 'Item you found matches: id', 0),
(88, 5, 'Your lost item matched: phone', 0),
(89, 7, 'Item you found matches: phone', 0),
(90, 5, 'Your lost item matched: id', 0),
(91, 5, 'Item you found matches: id', 0),
(92, 7, 'Your lost item matched: id', 0),
(93, 5, 'Item you found matches: id', 0),
(94, 5, 'Your lost item matched: id card', 0),
(95, 5, 'Item you found matches: id', 0),
(96, 5, 'Your lost item matched: id card', 0),
(97, 5, 'Item you found matches: id', 0),
(98, 5, 'Your lost item matched: id', 0),
(99, 7, 'Item you found matches: id card', 0),
(100, 7, 'Your lost item matched: id', 0),
(101, 7, 'Item you found matches: id card', 0),
(102, 5, 'Your lost item matched: id card', 0),
(103, 7, 'Item you found matches: id card', 0),
(104, 5, 'Your lost item matched: id card', 0),
(105, 7, 'Item you found matches: id card', 0),
(106, 5, 'Your lost item matched: id', 0),
(107, 7, 'Item you found matches: id card', 0),
(108, 7, 'Your lost item matched: id', 0),
(109, 7, 'Item you found matches: id card', 0),
(110, 5, 'Your lost item matched: id card', 0),
(111, 7, 'Item you found matches: id card', 0),
(112, 5, 'Your lost item matched: id card', 0),
(113, 7, 'Item you found matches: id card', 0),
(114, 5, 'Your lost item matched: id', 0),
(115, 7, 'Item you found matches: id', 0),
(116, 7, 'Your lost item matched: id', 0),
(117, 7, 'Item you found matches: id', 0),
(118, 5, 'Your lost item matched: id card', 0),
(119, 7, 'Item you found matches: id', 0),
(120, 5, 'Your lost item matched: id card', 0),
(121, 7, 'Item you found matches: id', 0),
(122, 5, 'Your lost item matched: phone', 0),
(123, 7, 'Item you found matches: phone', 0),
(124, 5, 'Your lost item matched: id', 0),
(125, 5, 'Item you found matches: id', 0),
(126, 7, 'Your lost item matched: id', 0),
(127, 5, 'Item you found matches: id', 0),
(128, 5, 'Your lost item matched: id card', 0),
(129, 5, 'Item you found matches: id', 0),
(130, 5, 'Your lost item matched: id card', 0),
(131, 5, 'Item you found matches: id', 0),
(132, 5, 'Your lost item matched: id', 0),
(133, 7, 'Item you found matches: id card', 0),
(134, 7, 'Your lost item matched: id', 0),
(135, 7, 'Item you found matches: id card', 0),
(136, 5, 'Your lost item matched: id card', 0),
(137, 7, 'Item you found matches: id card', 0),
(138, 5, 'Your lost item matched: id card', 0),
(139, 7, 'Item you found matches: id card', 0),
(140, 5, 'Your lost item matched: id', 0),
(141, 7, 'Item you found matches: id card', 0),
(142, 7, 'Your lost item matched: id', 0),
(143, 7, 'Item you found matches: id card', 0),
(144, 5, 'Your lost item matched: id card', 0),
(145, 7, 'Item you found matches: id card', 0),
(146, 5, 'Your lost item matched: id card', 0),
(147, 7, 'Item you found matches: id card', 0),
(148, 5, 'Your lost item matched: id', 0),
(149, 7, 'Item you found matches: id', 0),
(150, 7, 'Your lost item matched: id', 0),
(151, 7, 'Item you found matches: id', 0),
(152, 5, 'Your lost item matched: id card', 0),
(153, 7, 'Item you found matches: id', 0),
(154, 5, 'Your lost item matched: id card', 0),
(155, 7, 'Item you found matches: id', 0),
(156, 5, 'Your lost item matched: phone', 0),
(157, 7, 'Item you found matches: phone', 0),
(158, 5, 'Your lost item matched: id', 0),
(159, 5, 'Item you found matches: id', 0),
(160, 7, 'Your lost item matched: id', 0),
(161, 5, 'Item you found matches: id', 0),
(162, 5, 'Your lost item matched: id card', 0),
(163, 5, 'Item you found matches: id', 0),
(164, 5, 'Your lost item matched: id card', 0),
(165, 5, 'Item you found matches: id', 0),
(166, 5, 'Your lost item matched: id', 0),
(167, 7, 'Item you found matches: id card', 0),
(168, 7, 'Your lost item matched: id', 0),
(169, 7, 'Item you found matches: id card', 0),
(170, 5, 'Your lost item matched: id card', 0),
(171, 7, 'Item you found matches: id card', 0),
(172, 5, 'Your lost item matched: id card', 0),
(173, 7, 'Item you found matches: id card', 0),
(174, 5, 'Your lost item matched: id', 0),
(175, 7, 'Item you found matches: id card', 0),
(176, 7, 'Your lost item matched: id', 0),
(177, 7, 'Item you found matches: id card', 0),
(178, 5, 'Your lost item matched: id card', 0),
(179, 7, 'Item you found matches: id card', 0),
(180, 5, 'Your lost item matched: id card', 0),
(181, 7, 'Item you found matches: id card', 0),
(182, 5, 'Your lost item matched: id', 0),
(183, 7, 'Item you found matches: id', 0),
(184, 7, 'Your lost item matched: id', 0),
(185, 7, 'Item you found matches: id', 0),
(186, 5, 'Your lost item matched: id card', 0),
(187, 7, 'Item you found matches: id', 0),
(188, 5, 'Your lost item matched: id card', 0),
(189, 7, 'Item you found matches: id', 0),
(190, 5, 'Your lost item matched: phone', 0),
(191, 7, 'Item you found matches: phone', 0),
(192, 5, 'Your lost item matched: id', 0),
(193, 5, 'Item you found matches: id', 0),
(194, 7, 'Your lost item matched: id', 0),
(195, 5, 'Item you found matches: id', 0),
(196, 5, 'Your lost item matched: id card', 0),
(197, 5, 'Item you found matches: id', 0),
(198, 5, 'Your lost item matched: id card', 0),
(199, 5, 'Item you found matches: id', 0),
(200, 5, 'Your lost item matched: id', 0),
(201, 7, 'Item you found matches: id card', 0),
(202, 7, 'Your lost item matched: id', 0),
(203, 7, 'Item you found matches: id card', 0),
(204, 5, 'Your lost item matched: id card', 0),
(205, 7, 'Item you found matches: id card', 0),
(206, 5, 'Your lost item matched: id card', 0),
(207, 7, 'Item you found matches: id card', 0),
(208, 5, 'Your lost item matched: id', 0),
(209, 7, 'Item you found matches: id card', 0),
(210, 7, 'Your lost item matched: id', 0),
(211, 7, 'Item you found matches: id card', 0),
(212, 5, 'Your lost item matched: id card', 0),
(213, 7, 'Item you found matches: id card', 0),
(214, 5, 'Your lost item matched: id card', 0),
(215, 7, 'Item you found matches: id card', 0),
(216, 5, 'Your lost item matched: id', 0),
(217, 7, 'Item you found matches: id', 0),
(218, 7, 'Your lost item matched: id', 0),
(219, 7, 'Item you found matches: id', 0),
(220, 5, 'Your lost item matched: id card', 0),
(221, 7, 'Item you found matches: id', 0),
(222, 5, 'Your lost item matched: id card', 0),
(223, 7, 'Item you found matches: id', 0),
(224, 5, 'Your lost item matched: phone', 0),
(225, 7, 'Item you found matches: phone', 0),
(226, 5, 'Your lost item matched: id', 0),
(227, 5, 'Item you found matches: id', 0),
(228, 7, 'Your lost item matched: id', 0),
(229, 5, 'Item you found matches: id', 0),
(230, 5, 'Your lost item matched: id card', 0),
(231, 5, 'Item you found matches: id', 0),
(232, 5, 'Your lost item matched: id card', 0),
(233, 5, 'Item you found matches: id', 0),
(234, 5, 'Your lost item matched: id', 0),
(235, 7, 'Item you found matches: id card', 0),
(236, 7, 'Your lost item matched: id', 0),
(237, 7, 'Item you found matches: id card', 0),
(238, 5, 'Your lost item matched: id card', 0),
(239, 7, 'Item you found matches: id card', 0),
(240, 5, 'Your lost item matched: id card', 0),
(241, 7, 'Item you found matches: id card', 0),
(242, 5, 'Your lost item matched: id', 0),
(243, 7, 'Item you found matches: id card', 0),
(244, 7, 'Your lost item matched: id', 0),
(245, 7, 'Item you found matches: id card', 0),
(246, 5, 'Your lost item matched: id card', 0),
(247, 7, 'Item you found matches: id card', 0),
(248, 5, 'Your lost item matched: id card', 0),
(249, 7, 'Item you found matches: id card', 0),
(250, 5, 'Your lost item matched: id', 0),
(251, 7, 'Item you found matches: id', 0),
(252, 7, 'Your lost item matched: id', 0),
(253, 7, 'Item you found matches: id', 0),
(254, 5, 'Your lost item matched: id card', 0),
(255, 7, 'Item you found matches: id', 0),
(256, 5, 'Your lost item matched: id card', 0),
(257, 7, 'Item you found matches: id', 0),
(258, 5, 'Your lost item matched: phone', 0),
(259, 7, 'Item you found matches: phone', 0),
(260, 5, 'Your lost item matched: id', 0),
(261, 5, 'Item you found matches: id', 0),
(262, 7, 'Your lost item matched: id', 0),
(263, 5, 'Item you found matches: id', 0),
(264, 5, 'Your lost item matched: id card', 0),
(265, 5, 'Item you found matches: id', 0),
(266, 5, 'Your lost item matched: id card', 0),
(267, 5, 'Item you found matches: id', 0),
(268, 5, 'Your lost item matched: id', 0),
(269, 7, 'Item you found matches: id card', 0),
(270, 7, 'Your lost item matched: id', 0),
(271, 7, 'Item you found matches: id card', 0),
(272, 5, 'Your lost item matched: id card', 0),
(273, 7, 'Item you found matches: id card', 0),
(274, 5, 'Your lost item matched: id card', 0),
(275, 7, 'Item you found matches: id card', 0),
(276, 5, 'Your lost item matched: id', 0),
(277, 7, 'Item you found matches: id card', 0),
(278, 7, 'Your lost item matched: id', 0),
(279, 7, 'Item you found matches: id card', 0),
(280, 5, 'Your lost item matched: id card', 0),
(281, 7, 'Item you found matches: id card', 0),
(282, 5, 'Your lost item matched: id card', 0),
(283, 7, 'Item you found matches: id card', 0),
(284, 5, 'Your lost item matched: id', 0),
(285, 7, 'Item you found matches: id', 0),
(286, 7, 'Your lost item matched: id', 0),
(287, 7, 'Item you found matches: id', 0),
(288, 5, 'Your lost item matched: id card', 0),
(289, 7, 'Item you found matches: id', 0),
(290, 5, 'Your lost item matched: id card', 0),
(291, 7, 'Item you found matches: id', 0),
(292, 5, 'Your lost item matched: phone', 0),
(293, 7, 'Item you found matches: phone', 0),
(294, 5, 'Your lost item matched: id', 0),
(295, 5, 'Item you found matches: id', 0),
(296, 7, 'Your lost item matched: id', 0),
(297, 5, 'Item you found matches: id', 0),
(298, 5, 'Your lost item matched: id card', 0),
(299, 5, 'Item you found matches: id', 0),
(300, 5, 'Your lost item matched: id card', 0),
(301, 5, 'Item you found matches: id', 0),
(302, 5, 'Your lost item matched: id', 0),
(303, 7, 'Item you found matches: id card', 0),
(304, 7, 'Your lost item matched: id', 0),
(305, 7, 'Item you found matches: id card', 0),
(306, 5, 'Your lost item matched: id card', 0),
(307, 7, 'Item you found matches: id card', 0),
(308, 5, 'Your lost item matched: id card', 0),
(309, 7, 'Item you found matches: id card', 0),
(310, 5, 'Your lost item matched: id', 0),
(311, 7, 'Item you found matches: id card', 0),
(312, 7, 'Your lost item matched: id', 0),
(313, 7, 'Item you found matches: id card', 0),
(314, 5, 'Your lost item matched: id card', 0),
(315, 7, 'Item you found matches: id card', 0),
(316, 5, 'Your lost item matched: id card', 0),
(317, 7, 'Item you found matches: id card', 0),
(318, 5, 'Your lost item matched: id', 0),
(319, 7, 'Item you found matches: id', 0),
(320, 7, 'Your lost item matched: id', 0),
(321, 7, 'Item you found matches: id', 0),
(322, 5, 'Your lost item matched: id card', 0),
(323, 7, 'Item you found matches: id', 0),
(324, 5, 'Your lost item matched: id card', 0),
(325, 7, 'Item you found matches: id', 0),
(326, 5, 'Your lost item matched: phone', 0),
(327, 7, 'Item you found matches: phone', 0),
(328, 5, 'Your lost item matched: id', 0),
(329, 5, 'Item you found matches: id', 0),
(330, 7, 'Your lost item matched: id', 0),
(331, 5, 'Item you found matches: id', 0),
(332, 5, 'Your lost item matched: id card', 0),
(333, 5, 'Item you found matches: id', 0),
(334, 5, 'Your lost item matched: id card', 0),
(335, 5, 'Item you found matches: id', 0),
(336, 5, 'Your lost item matched: id', 0),
(337, 7, 'Item you found matches: id card', 0),
(338, 7, 'Your lost item matched: id', 0),
(339, 7, 'Item you found matches: id card', 0),
(340, 5, 'Your lost item matched: id card', 0),
(341, 7, 'Item you found matches: id card', 0),
(342, 5, 'Your lost item matched: id card', 0),
(343, 7, 'Item you found matches: id card', 0),
(344, 5, 'Your lost item matched: id', 0),
(345, 7, 'Item you found matches: id card', 0),
(346, 7, 'Your lost item matched: id', 0),
(347, 7, 'Item you found matches: id card', 0),
(348, 5, 'Your lost item matched: id card', 0),
(349, 7, 'Item you found matches: id card', 0),
(350, 5, 'Your lost item matched: id card', 0),
(351, 7, 'Item you found matches: id card', 0),
(352, 5, 'Your lost item matched: id', 0),
(353, 7, 'Item you found matches: id', 0),
(354, 7, 'Your lost item matched: id', 0),
(355, 7, 'Item you found matches: id', 0),
(356, 5, 'Your lost item matched: id card', 0),
(357, 7, 'Item you found matches: id', 0),
(358, 5, 'Your lost item matched: id card', 0),
(359, 7, 'Item you found matches: id', 0),
(360, 5, 'Your lost item matched: phone', 0),
(361, 7, 'Item you found matches: phone', 0),
(362, 5, 'Your lost item matched: id', 0),
(363, 5, 'Item you found matches: id', 0),
(364, 7, 'Your lost item matched: id', 0),
(365, 5, 'Item you found matches: id', 0),
(366, 5, 'Your lost item matched: id card', 0),
(367, 5, 'Item you found matches: id', 0),
(368, 5, 'Your lost item matched: id card', 0),
(369, 5, 'Item you found matches: id', 0),
(370, 5, 'Your lost item matched: id', 0),
(371, 7, 'Item you found matches: id card', 0),
(372, 7, 'Your lost item matched: id', 0),
(373, 7, 'Item you found matches: id card', 0),
(374, 5, 'Your lost item matched: id card', 0),
(375, 7, 'Item you found matches: id card', 0),
(376, 5, 'Your lost item matched: id card', 0),
(377, 7, 'Item you found matches: id card', 0),
(378, 5, 'Your lost item matched: id', 0),
(379, 7, 'Item you found matches: id card', 0),
(380, 7, 'Your lost item matched: id', 0),
(381, 7, 'Item you found matches: id card', 0),
(382, 5, 'Your lost item matched: id card', 0),
(383, 7, 'Item you found matches: id card', 0),
(384, 5, 'Your lost item matched: id card', 0),
(385, 7, 'Item you found matches: id card', 0),
(386, 5, 'Your lost item matched: id', 0),
(387, 7, 'Item you found matches: id', 0),
(388, 7, 'Your lost item matched: id', 0),
(389, 7, 'Item you found matches: id', 0),
(390, 5, 'Your lost item matched: id card', 0),
(391, 7, 'Item you found matches: id', 0),
(392, 5, 'Your lost item matched: id card', 0),
(393, 7, 'Item you found matches: id', 0),
(394, 5, 'Your lost item matched: phone', 0),
(395, 7, 'Item you found matches: phone', 0),
(396, 5, 'Your lost item matched: id', 0),
(397, 5, 'Item you found matches: id', 0),
(398, 7, 'Your lost item matched: id', 0),
(399, 5, 'Item you found matches: id', 0),
(400, 5, 'Your lost item matched: id card', 0),
(401, 5, 'Item you found matches: id', 0),
(402, 5, 'Your lost item matched: id card', 0),
(403, 5, 'Item you found matches: id', 0),
(404, 5, 'Your lost item matched: id', 0),
(405, 7, 'Item you found matches: id card', 0),
(406, 7, 'Your lost item matched: id', 0),
(407, 7, 'Item you found matches: id card', 0),
(408, 5, 'Your lost item matched: id card', 0),
(409, 7, 'Item you found matches: id card', 0),
(410, 5, 'Your lost item matched: id card', 0),
(411, 7, 'Item you found matches: id card', 0),
(412, 5, 'Your lost item matched: id', 0),
(413, 7, 'Item you found matches: id card', 0),
(414, 7, 'Your lost item matched: id', 0),
(415, 7, 'Item you found matches: id card', 0),
(416, 5, 'Your lost item matched: id card', 0),
(417, 7, 'Item you found matches: id card', 0),
(418, 5, 'Your lost item matched: id card', 0),
(419, 7, 'Item you found matches: id card', 0),
(420, 5, 'Your lost item matched: id', 0),
(421, 7, 'Item you found matches: id', 0),
(422, 7, 'Your lost item matched: id', 0),
(423, 7, 'Item you found matches: id', 0),
(424, 5, 'Your lost item matched: id card', 0),
(425, 7, 'Item you found matches: id', 0),
(426, 5, 'Your lost item matched: id card', 0),
(427, 7, 'Item you found matches: id', 0),
(428, 5, 'Your lost item matched: phone', 0),
(429, 7, 'Item you found matches: phone', 0),
(430, 5, 'Your lost item matched: id', 0),
(431, 5, 'Item you found matches: id', 0),
(432, 7, 'Your lost item matched: id', 0),
(433, 5, 'Item you found matches: id', 0),
(434, 5, 'Your lost item matched: id card', 0),
(435, 5, 'Item you found matches: id', 0),
(436, 5, 'Your lost item matched: id card', 0),
(437, 5, 'Item you found matches: id', 0),
(438, 5, 'Your lost item matched: id', 0),
(439, 7, 'Item you found matches: id card', 0),
(440, 7, 'Your lost item matched: id', 0),
(441, 7, 'Item you found matches: id card', 0),
(442, 5, 'Your lost item matched: id card', 0),
(443, 7, 'Item you found matches: id card', 0),
(444, 5, 'Your lost item matched: id card', 0),
(445, 7, 'Item you found matches: id card', 0),
(446, 5, 'Your lost item matched: id', 0),
(447, 7, 'Item you found matches: id card', 0),
(448, 7, 'Your lost item matched: id', 0),
(449, 7, 'Item you found matches: id card', 0),
(450, 5, 'Your lost item matched: id card', 0),
(451, 7, 'Item you found matches: id card', 0),
(452, 5, 'Your lost item matched: id card', 0),
(453, 7, 'Item you found matches: id card', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(5, 'y1', 'y1@gmail.com', '$2y$10$w0F3scIFyn9lcovUQGiS6eZ3MLwHSDZo57PShv1VmCVGcrsp.hX/y', 'user', '2026-03-25 14:34:19'),
(7, 'y2', 'y2@gmail.com', '$2y$10$LUYoTn01GvoGJLUxwx.Kj.MleIx6p46ioHWeBmEP5KOb9vMEQdSSy', 'user', '2026-03-25 14:35:51'),
(9, 'y3', 'y3@gmail.com', '$2y$10$mDWE.mf.vVO8rE4R2ma99Oj39ScDMZ9eFM2QcjjeZQ9L6S/jGhQNC', 'user', '2026-03-27 20:00:35'),
(11, 'y4', 'y4@gmail.com', '$2y$10$KyH3ITMUgdZzpPFbJhLBoeqCQpc1wGNjEeh/aIvzoRUGOlYMj0RMm', 'user', '2026-03-30 13:40:37'),
(12, 'y5', 'y5@gmail.com', '$2y$10$vtdSIOu9rri0kD3QneJyNOiMtzHCWRfIOFWTPsjXDKM4we.qVU/Gm', 'user', '2026-03-30 14:34:00'),
(13, 'y7', 'y7@gmail.coom', '$2y$10$JicGM/mMWJJtH0T0/6FtJ.L7ce.qc/.5Be7wqv5.6XHfEoA/LR1Eq', 'user', '2026-04-09 12:16:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `found_items`
--
ALTER TABLE `found_items`
  ADD PRIMARY KEY (`found_id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`lost_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `found_items`
--
ALTER TABLE `found_items`
  MODIFY `found_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `lost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
