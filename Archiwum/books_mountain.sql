-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Sie 2023, 16:04
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `books_mountain`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$7UFBtZ584ktRWqmSWvFt7eLUH8HRj.Ef1T/WeVNAyicBlLk4gUVUO');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `reciver_id`, `send_time`) VALUES
(1, '1', 20, 4, '2023-04-05 15:46:11'),
(2, '1', 3, 20, '2023-04-05 15:46:19'),
(3, '1', 4, 20, '2023-04-05 15:46:15'),
(4, '1', 3, 20, '2023-04-05 15:46:18'),
(5, '1', 20, 5, '2023-04-05 15:46:17'),
(6, '2', 4, 1, '2023-04-13 16:11:12'),
(7, '2', 4, 20, '2023-04-06 16:11:28'),
(8, '12', 4, 20, '2023-04-06 17:00:15'),
(9, 'h', 20, 0, '2023-04-07 14:54:04'),
(10, 'SIEMA BORDO', 8, 20, '2023-04-07 20:06:28'),
(11, 'SIEMA BORDO', 10, 20, '2023-04-07 20:06:37'),
(12, 'SIEMA BORDO', 17, 20, '2023-04-07 20:06:57'),
(13, 'siema', 20, 0, '2023-04-08 13:48:53'),
(14, 'siema', 20, 17, '2023-04-08 13:51:37'),
(15, 'GIMME', 20, 17, '2023-04-08 13:54:41'),
(16, 'uwu', 17, 20, '2023-04-08 13:55:10'),
(17, 'elo', 20, 10, '2023-04-08 13:57:36'),
(18, 'uweu', 17, 20, '2023-04-08 13:58:54'),
(19, 'test', 17, 20, '2023-04-08 14:05:46'),
(20, 'a', 20, 0, '2023-04-08 14:24:01'),
(21, 'asd', 20, 17, '2023-04-08 14:25:27'),
(22, 'lk', 20, 17, '2023-04-08 14:25:31'),
(23, 'ee', 20, 17, '2023-04-08 14:50:58'),
(24, 'jak tam chłopie', 20, 17, '2023-04-08 14:51:03'),
(25, 'wstałeś już', 20, 17, '2023-04-08 14:51:05'),
(26, '         ', 20, 17, '2023-04-08 14:51:06'),
(27, '                s', 20, 17, '2023-04-08 14:51:15'),
(28, 'Zgłoszono chęć kupna', 17, 20, '2023-04-08 21:23:21'),
(29, 'Zgłoszono chęć kupna', 17, 20, '2023-04-08 21:24:17'),
(30, 'Zgłoszono chęć kupnaMatematyka na czasie 3', 17, 20, '2023-04-08 21:29:43'),
(31, 'Zgłoszono chęć kupna Matematyka na czasie 3', 17, 20, '2023-04-08 21:31:56'),
(32, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:33:38'),
(33, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:38:50'),
(34, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:39:59'),
(35, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:40:16'),
(36, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:40:48'),
(37, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:41:15'),
(38, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 17, 20, '2023-04-08 21:51:36'),
(39, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:52:57'),
(40, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 17, 20, '2023-04-08 21:53:15'),
(41, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-08 21:53:55'),
(42, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-08 21:55:40'),
(43, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:57:07'),
(44, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 21:59:48'),
(45, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-08 22:00:51'),
(46, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-08 22:01:14'),
(47, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 22:04:41'),
(48, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-08 22:04:43'),
(49, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-08 22:10:28'),
(50, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 17, '2023-04-08 22:12:15'),
(51, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 11:57:09'),
(52, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 11:57:24'),
(53, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 11:58:33'),
(54, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 11:58:36'),
(55, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:00:31'),
(56, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:00:33'),
(57, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:01:22'),
(58, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:01:24'),
(59, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:02:58'),
(60, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:02:59'),
(61, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:04:18'),
(62, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:04:20'),
(63, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:05:45'),
(64, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:05:47'),
(65, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:08:37'),
(66, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:09:50'),
(67, 'Zgłoszono chęć kupna <b>Matematyka na czasie 3</b>', 17, 20, '2023-04-09 12:09:51'),
(68, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 17, '2023-04-09 12:11:13'),
(69, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 17, '2023-04-09 12:11:48'),
(70, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 17, '2023-04-09 12:15:08'),
(71, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 17, '2023-04-09 12:16:28'),
(72, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 17, 20, '2023-04-09 12:20:29'),
(73, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 15:52:42'),
(74, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 15:52:46'),
(75, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 15:52:48'),
(76, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 4, '2023-04-09 15:52:51'),
(77, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 15:52:55'),
(78, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 4, '2023-04-09 15:52:58'),
(79, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 15:54:44'),
(80, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 15:58:22'),
(81, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 16:01:32'),
(82, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 16:03:05'),
(83, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 16:03:33'),
(84, 'Zgłoszono chęć kupna <b>Poznać przeszłość Wodza Hitlera</b>', 20, 4, '2023-04-09 16:03:50'),
(85, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 4, '2023-04-09 16:03:54'),
(86, 'Wycofano ', 0, 0, '2023-04-09 17:14:38'),
(87, 'Wycofano ', 0, 0, '2023-04-09 17:15:08'),
(88, 'Wycofano Matematyka na czasie 2', 20, 4, '2023-04-09 17:16:05'),
(89, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:18:53'),
(90, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:20:22'),
(91, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:20:50'),
(92, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:20:52'),
(93, 'Wycofano Matematyka na czasieaa', 20, 4, '2023-04-09 17:20:52'),
(94, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 17:22:47'),
(95, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 17:22:48'),
(96, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 17:22:50'),
(97, 'Zgłoszono chęć kupna <b>Matematyka na czasie 2</b>', 20, 4, '2023-04-09 17:22:52'),
(98, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 17:22:53'),
(99, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:23:18'),
(100, 'cos', 20, 4, '2023-04-09 17:23:28'),
(101, 'elo', 4, 20, '2023-04-09 17:23:43'),
(102, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 4, '2023-04-09 17:25:14'),
(103, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:30:20'),
(104, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:30:26'),
(105, 'Wycofano Matematyka na czasie 2', 20, 4, '2023-04-09 17:30:49'),
(106, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:30:49'),
(107, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 17, '2023-04-09 17:33:56'),
(108, 'Sprzedano Matematyka na czasie', 17, 20, '2023-04-09 17:34:48'),
(109, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 17, '2023-04-09 17:36:58'),
(110, 'Wycofano Matematyka na czasie', 17, 20, '2023-04-09 17:37:12'),
(111, 'Zgłoszono chęć kupna <b>Matematyka na czasie</b>', 20, 17, '2023-04-09 17:37:20'),
(112, 'Sprzedano Matematyka na czasie', 17, 20, '2023-04-09 17:38:04'),
(113, 'Siema', 20, 17, '2023-04-09 17:38:54'),
(114, 'siema', 17, 20, '2023-04-09 17:39:03'),
(115, 'a', 17, 20, '2023-04-09 17:39:07'),
(116, 'a', 20, 17, '2023-04-09 17:39:10'),
(117, 'Wycofano Matematyka na czasie', 20, 4, '2023-04-09 17:39:45'),
(118, 'Wycofano Matematyka na czasie', 20, 17, '2023-04-10 10:56:03'),
(119, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-04-12 16:10:52'),
(120, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 17, 20, '2023-04-12 16:11:29'),
(121, '<b>Wycofano:Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 17, 20, '2023-04-12 16:11:38'),
(122, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 4, '2023-04-12 16:11:55'),
(123, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 17, 20, '2023-04-12 16:12:13'),
(124, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 17, '2023-04-12 16:12:46'),
(125, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 17, '2023-04-12 16:13:22'),
(126, 'Sprzedano: Matematyka na czasie', 17, 20, '2023-04-12 16:13:28'),
(127, 'a', 20, 4, '2023-04-17 17:00:15'),
(128, 'gfd', 20, 4, '2023-04-17 17:00:18'),
(129, 'fd', 20, 4, '2023-04-17 17:00:20'),
(130, 'sa', 20, 4, '2023-04-17 17:00:31'),
(131, 'gf', 20, 4, '2023-04-17 17:00:31'),
(132, 'l', 20, 5, '2023-04-17 17:02:27'),
(133, 'hj', 20, 5, '2023-04-17 17:02:45'),
(134, 'km;', 20, 5, '2023-04-17 17:02:47'),
(135, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 4, '2023-05-09 15:00:00'),
(136, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 3, '2023-05-09 15:00:20'),
(137, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 5, '2023-05-09 15:00:30'),
(138, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 20, 4, '2023-05-09 15:07:37'),
(139, 'siema', 20, 4, '2023-05-09 18:10:51'),
(140, '&lt;b&gt;elo&lt;/b&gt;', 20, 5, '2023-05-09 18:26:48'),
(141, 'SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSFds fddddddddddddddd sdfsdf', 20, 4, '2023-05-09 18:31:56'),
(142, 'SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSFds fddddddddddddddd sdfsdf', 4, 20, '2023-05-09 18:31:56'),
(143, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-05-09 18:47:22'),
(144, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-05-09 18:52:44'),
(145, ';l', 20, 4, '2023-05-09 18:57:58'),
(146, ';/', 20, 4, '2023-05-09 18:58:00'),
(147, '\'', 20, 4, '2023-05-09 18:58:05'),
(148, '\'\'', 20, 4, '2023-05-09 18:58:08'),
(149, ':/', 20, 4, '2023-05-09 18:58:14'),
(150, '<b>Sprzedano: Matematyka na czasie</b>', 20, 4, '2023-05-09 19:01:35'),
(151, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-05-09 19:12:32'),
(152, '<b>Sprzedano: Matematyka na czasie</b>', 20, 4, '2023-05-09 19:12:34'),
(153, 's', 20, 4, '2023-05-09 19:24:56'),
(154, 'fg', 20, 4, '2023-05-09 19:25:07'),
(155, 'fd', 20, 4, '2023-05-09 19:25:08'),
(156, 'ss', 20, 4, '2023-05-09 19:25:34'),
(157, 'fd', 4, 20, '2023-05-09 19:25:08'),
(158, 'ase', 4, 20, '2023-05-09 19:26:19'),
(159, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-13 12:38:05'),
(160, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-13 12:38:11'),
(161, 'sdsa', 20, 4, '2023-08-13 18:49:52'),
(162, 'siemson', 20, 4, '2023-08-13 18:49:56'),
(163, 'sssssssssssssssssssssssssssssssa sa sd sasa     adsaaaaaaa', 20, 4, '2023-08-14 14:35:41'),
(164, 'dsaaaaaaaaaaad', 20, 4, '2023-08-14 14:35:42'),
(165, 'dddddddddd', 20, 4, '2023-08-14 14:35:44'),
(166, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-08-14 23:34:50'),
(167, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 20, 3, '2023-08-14 23:38:24'),
(168, 'Siema', 20, 17, '2023-08-14 23:50:15'),
(169, 'fdsrewdsr', 20, 17, '2023-08-14 23:50:43'),
(170, '<b>Sprzedano: Matematyka na czasie</b>', 20, 4, '2023-08-15 10:52:01'),
(171, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-08-16 15:12:41'),
(172, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 21, 14, '2023-08-16 15:33:59'),
(173, 'siema', 21, 14, '2023-08-16 15:34:04'),
(174, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 21, 3, '2023-08-16 15:34:32'),
(175, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 21, 20, '2023-08-16 15:34:34'),
(176, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 21, 20, '2023-08-16 15:34:48'),
(177, 'Siema', 20, 21, '2023-08-16 15:54:53'),
(178, 'no elo', 21, 20, '2023-08-16 15:55:00'),
(179, 'Dajesz', 20, 21, '2023-08-16 15:55:14'),
(180, 'Te książki ', 20, 21, '2023-08-16 15:55:21'),
(181, 'Czy nie', 20, 21, '2023-08-16 15:55:26'),
(182, 'Sk', 20, 21, '2023-08-16 15:55:33'),
(183, 'S', 20, 21, '2023-08-16 15:55:35'),
(184, 'D', 20, 21, '2023-08-16 15:55:37'),
(185, 'Woow', 20, 21, '2023-08-16 15:55:51'),
(186, 'Wow', 20, 21, '2023-08-16 15:55:59'),
(187, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:12:25'),
(188, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:13:51'),
(189, '<b>Zgłoszono chęć kupna: Poznać przeszłość </b>', 27, 4, '2023-08-17 14:14:32'),
(190, '<b>Wycofano: Poznać przeszłość  - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:25:16'),
(191, '<b>Zgłoszono chęć kupna: Poznać przeszłość </b>', 27, 4, '2023-08-17 14:31:25'),
(192, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:31:54'),
(193, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:31:58'),
(194, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:33:03'),
(195, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:33:06'),
(196, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:52:08'),
(197, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:52:10'),
(198, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:52:37'),
(199, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:52:46'),
(200, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 27, 4, '2023-08-17 14:53:05'),
(201, '<b>Zgłoszono chęć kupna: Matematyka na czasie</b>', 27, 4, '2023-08-17 14:53:10'),
(202, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-18 11:30:33'),
(203, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-18 11:30:33'),
(204, '<b>Wycofano: Matematyka na czasie - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-18 11:30:34'),
(205, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-08-18 11:30:36'),
(206, '<b>Wycofano: Matematyka na czasie 2 - oferta jest ponownie w sprzedaży</b>', 20, 4, '2023-08-18 11:30:53'),
(207, '<b>Zgłoszono chęć kupna: Matematyka na czasie 2</b>', 20, 4, '2023-08-18 11:30:58'),
(208, 'f', 20, 4, '2023-08-18 11:31:14'),
(209, ';', 20, 4, '2023-08-18 11:31:16'),
(210, 'l', 20, 4, '2023-08-18 11:31:18'),
(211, 'l', 20, 4, '2023-08-18 11:31:18'),
(212, 'l', 20, 4, '2023-08-18 11:31:20'),
(213, 'aa', 20, 4, '2023-08-18 11:31:24'),
(214, 'a', 20, 4, '2023-08-18 11:31:24'),
(215, 'a', 20, 4, '2023-08-18 11:31:25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reset_password`
--

CREATE TABLE `reset_password` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `authorization_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `reset_password`
--

INSERT INTO `reset_password` (`request_id`, `user_id`, `authorization_code`, `date`) VALUES
(1, 27, 'COVrky4cy9', '2023-08-18 00:00:00'),
(2, 27, 'AW8f6VjYyk', '2023-08-18 00:48:56'),
(3, 27, '81Yr6qTYDI', '2023-08-18 00:51:06'),
(4, 27, 'YUWcYQFZZa', '2023-08-18 00:51:11'),
(5, 27, 'LMhScYeFu3', '2023-08-18 00:51:48'),
(6, 27, 'iJ4yNY680m', '2023-08-18 00:53:17'),
(7, 27, '5m68fhbbhS', '2023-08-18 00:53:26'),
(8, 27, 'fv1gD6LLpH', '2023-08-18 00:54:14'),
(9, 27, 'CkKKL8uNe7', '2023-08-18 00:54:29'),
(10, 27, 'LjwGiXxrsj', '2023-08-18 00:54:42'),
(11, 27, 'sLsVCdEic5', '2023-08-18 00:54:53'),
(12, 27, 'ePtEEaTYVA', '2023-08-18 00:55:40'),
(13, 27, 'rUxKPmuYy4', '2023-08-18 13:28:03'),
(14, 27, 'izzloaPrA7', '2023-08-18 13:28:05'),
(15, 27, '9ughbCeaZG', '2023-08-18 13:29:03'),
(16, 27, 'wP4mCIWNOi', '2023-08-18 13:29:32'),
(17, 27, 'QC70MzwQB5', '2023-08-18 13:34:19'),
(18, 27, 'ociWZ5YNzN', '2023-08-18 13:34:21'),
(19, 27, 'sbrDWi4URq', '2023-08-18 13:34:22'),
(20, 27, 'QfuXqNK0ze', '2023-08-18 13:34:24'),
(21, 27, '94OKUselnH', '2023-08-18 13:34:36'),
(22, 27, '39uavSzBma', '2023-08-18 13:34:37'),
(23, 27, 'EXQfSE1fHP', '2023-08-18 13:34:39'),
(24, 27, 'Qw1eF8EbTf', '2023-08-11 12:34:40'),
(25, 27, 'ORXuyD5yyH', '2023-08-18 12:59:42'),
(26, 27, 'Dy5LNMhNrp', '2023-08-18 13:34:59'),
(27, 27, 'KmtKLJZH2U', '2023-08-18 13:56:46'),
(28, 27, 'EvHuDMMF3x', '2023-08-18 13:57:26'),
(29, 27, 'Hjw2psLBia', '2023-08-18 14:56:59'),
(30, 27, 'ONhBVRop8F', '2023-08-18 15:36:17'),
(31, 27, 'zMtaZX6vBm', '2023-08-18 15:40:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sample_books`
--

CREATE TABLE `sample_books` (
  `book_ID` int(11) NOT NULL,
  `book_name` text COLLATE utf8mb4_polish_ci NOT NULL,
  `MEN` text COLLATE utf8mb4_polish_ci NOT NULL,
  `picture` text COLLATE utf8mb4_polish_ci NOT NULL,
  `picturexl` text COLLATE utf8mb4_polish_ci NOT NULL,
  `publishing_house` text COLLATE utf8mb4_polish_ci NOT NULL,
  `authors` text COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'Opracowanie zbiorowe',
  `category` text COLLATE utf8mb4_polish_ci NOT NULL,
  `part` int(11) NOT NULL,
  `scope` text COLLATE utf8mb4_polish_ci NOT NULL,
  `release_date` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `sample_books`
--

INSERT INTO `sample_books` (`book_ID`, `book_name`, `MEN`, `picture`, `picturexl`, `publishing_house`, `authors`, `category`, `part`, `scope`, `release_date`) VALUES
(1, 'Matematyka na czasie', '9346-4356-36-34', 'images/matm3podr.png', 'images/matm3podrxl.png', 'WSiP', 'Opracowanie zbiorowe', 'matematyka', 1, 'podstawowy', 2020),
(2, 'Matematyka na czasie 2', '9346-4356-36-341', 'images/matm3podr.png', 'images/matm3podrxl.png', 'WSiP', 'Opracowanie zbiorowe', 'matematyka', 2, 'rozszerzony', 2020),
(3, 'Poznać przeszłość ', '325-3424-32421', 'images/historia3pp.png', '', 'Wsip', 'Opracowanie zbiorowe', 'historia', 1, 'podstawowy', 0),
(4, 'KSIONRZKA', '325-3424-32421', 'images/historia3pp.png', '', 'Wsip', 'Opracowanie zbiorowe', 'historia', 2, 'rozszerzony', 0),
(5, 'Matematyka na czasie 3', '9346-4356-36-341', 'images/matm3podr.png', 'images/matm3podrxl.png', 'WSiP', 'Opracowanie zbiorowe', 'matematyka', 3, 'rozszerzony', 2020),
(9, 'a', 'a', 'users_offers/IMG-64da425a45bf9.png', '', 'a', 'a', 'matematyka', 1, 'podstawowy', 2004),
(10, 'Poznać przeszłość', '931/412/2029', 'users_offers/IMG-64da42d3ced51.png', '', 'WSiP', 'Kurczab, Kurnik', 'historia', 2, 'rozszerzony', 2019),
(11, 'Poznać przeszłość', '931/412/2029', 'users_offers/IMG-64da45c1e722c.png', '', 'WSiP', 'Kurczab, Kurnik', 'historia', 2, 'rozszerzony', 2019),
(12, 'a', 'a', 'users_offers/IMG-64da46de3e01a.png', '', 'a', 'a', 'chemia', 1, 'rozszerzony', 2),
(13, 's', 's', 'users_offers/IMG-64da46f7c89bb.png', '', 's', 's', 'matematyka', 1, 'rozszerzony', 1),
(14, 'a', 'a', 'users_offers/IMG-64da4729008b8.png', '', 's', '4', 'geografia', 1, 'podstawowy', 2004),
(15, 's', 's', 'users_offers/IMG-64da47a03c4d3.png', '', 's', 'a', 'wos', 2, 'rozszerzony', 2004),
(16, 'a', 's', 'users_offers/IMG-64da47ad2dc1e.png', '', 'e', 'a', 'hit', 4, 'rozszerzony', 2004),
(17, 'Historia', '912/21/2020', 'users_offers/IMG-64da484a5e92d.jpg', '', 'Nowa Era', 'Zbiorowa', 'historia', 3, 'rozszerzony', 2020),
(18, 'a', 'a', 'users_offers/IMG-64da4866656ad.png', '', 'a', 'a', 'fizyka', 1, 'podstawowy', 2004),
(19, 'Poznać przeszłość 3', '92/14/2202', 'users_offers/IMG-64da4c45e7c06.jpg', '', 'Wsip', 'S', 'geografia', 1, 'podstawowy', 2),
(20, 'W centrum uwagi', '912/12/233', 'users_offers/IMG-64dcb61b8f07d.jpg', '', 'Nowa Era', 'Janicki, Kięczkowska, Menz', 'wos', 1, 'podstawowy', 2019);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `surname`) VALUES
(2, 'jasiek1tojo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Robert', 'Lenart'),
(3, 'adam.malysz@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Adam', 'Malysz'),
(4, 'jasiektojo@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Siemas', 'Si'),
(5, '132@df.pl', '25f9e794323b453885f5181f1b624d0b', 'Siema', 'Si'),
(6, '123@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(7, '124@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(8, '1312@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(9, '12@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(10, '1a2@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(11, '112@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(12, '11a2@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(13, '12aaa@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(14, '12@df.pl12', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(15, '1332@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(16, '13332@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(17, 'halo@gmail.com', '$2y$10$6T1JO7UmtubPkt4ICglyDevoiAeDiHHjBCvpSVdsTfAzyvPQXdfrW', 'jjk', 'saass'),
(18, 'a@a.pl', '$2y$10$Ra4jTJQxiJQuLQzZsdBrLeQ3WJVzI3InQclPiLXXhPduagW7TLzDG', 'Siema', 'Si'),
(19, 'b@a.pl', '$2y$10$1ntzdl6uy2.BS5ZOr2RQOOgesrGXAgszSQsn2L7c9tYdT8RjxP4Qa', 'Siema', 'Si'),
(20, 'uwu@gmail.com', '$2y$10$1EieGOEMFK47BnvGr0FC9OY6FDYoxLsqXON1VZWWnUAY7DHEMo9AC', 'Siemas', 'Shaa'),
(21, 'malpa@gmail.com', '$2y$10$IJBNaLVksDCXQ5REomnuWuSN7JDdhFTmbl/rOBzRKb5raxoIgJXxy', 'Siema', 'Uwu'),
(26, 'jasiektojo@gmail.com', '$2y$10$.CNLSgLeuB1xeXo8F4AdveWldNYQhspkhg9.siiYxAbpJKSc2L2QG', 'Asa', 'Sda'),
(27, 'jan.lenart.jl@gmail.com', '$2y$10$xtq1FrVmVIsx6BxGKpq86.o9LyTlBVJi.IAVI8GCmgJeytDwCsbo2', 'Asas', 'Asas');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_offers`
--

CREATE TABLE `users_offers` (
  `offer_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `photo1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `photo2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `status` text NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users_offers`
--

INSERT INTO `users_offers` (`offer_id`, `seller`, `customer`, `price`, `photo1`, `photo2`, `status`, `book_id`) VALUES
(7, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'reserved', 2),
(8, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(9, 1, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(10, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'reserved', 2),
(11, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(12, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(13, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(14, 14, 21, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'reserved', 2),
(15, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(16, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(17, 1, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(18, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(19, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(20, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(21, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(22, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(23, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(24, 10, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'reserved', 2),
(25, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(26, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(27, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(49, 20, 3, 2, 'users_offers/IMG-63e691f9eb03b.png', 'users_offers/IMG-63e691f9eb041.png', 'sold', 3),
(60, 4, 20, 10, 'users_offers/IMG-64137445f065d.png', 'users_offers/IMG-64137445f0661.png', 'reserved', 1),
(61, 4, 20, 1, 'users_offers/IMG-6413745db1f73.png', 'users_offers/IMG-6413745db1f77.png', 'reserved', 1),
(62, 3, 21, 12, 'users_offers/IMG-641374fb38b0b.png', 'users_offers/IMG-641374fb38b0f.png', 'reserved', 1),
(63, 4, 27, 123, 'users_offers/IMG-641375c183121.png', 'users_offers/IMG-641375c183126.png', 'reserved', 1),
(64, 4, 20, 12, 'users_offers/IMG-641375ed4ad2b.png', 'users_offers/IMG-641375ed4ad2f.png', 'reserved', 2),
(65, 4, 0, 12, 'users_offers/IMG-6414e5e936332.jpg', 'users_offers/IMG-6414e5e936339.jpg', 'available', 1),
(66, 4, 0, 2, 'users_offers/IMG-64170e3f44867.jpg', 'users_offers/IMG-64170e3f4486a.png', 'available', 2),
(68, 20, 4, 12, 'users_offers/IMG-64170e912837a.jpg', 'users_offers/IMG-64170e912837e.png', 'sold', 1),
(71, 20, 17, 13, 'users_offers/IMG-6408f70a10012.png', 'users_offers/IMG-64170d6c73191.jpg', 'sold', 1),
(72, 20, 17, 4, 'users_offers/IMG-6417116c3d8c0.jpg', 'users_offers/IMG-6417116c3d8c9.jpg', 'sold', 5),
(73, 20, 2, 14, 'users_offers/IMG-641712a995bdb.jpg', 'users_offers/IMG-641712a995be0.jpg', 'sold', 1),
(77, 5, 20, 12, 'users_offers/IMG-642d9a551a1f1.jpg', 'users_offers/IMG-642d9a551a1fc.jpg', 'reserved', 1),
(78, 4, 27, 13, 'users_offers/IMG-642d9a8529cec.jpg', 'users_offers/IMG-642d9a8529cf3.jpg', 'reserved', 3),
(79, 17, 20, 1247, 'users_offers/IMG-641712a995be0.jpg', 'users_offers/IMG-641712a995be0.jpg', 'sold', 1),
(80, 17, 20, 9, 'users_offers/IMG-641712a995bdb.jpg', 'users_offers/IMG-6408f70a1000e.png', 'sold', 2),
(87, 17, 20, 1, 'users_offers/IMG-6432f6c278b86.png', 'users_offers/IMG-6432f6c278b8b.jpg', 'sold', 1),
(88, 17, 20, 432, 'users_offers/IMG-6432f6e69f399.jpg', 'users_offers/IMG-6432f6e69f3a0.jpg', 'sold', 1),
(89, 20, 0, 7, 'users_offers/IMG-6433eb4f32f3e.png', 'users_offers/IMG-6433eb4f32f43.jpg', 'reserved', 2),
(90, 20, 4, 2, 'users_offers/IMG-645a980ccb280.png', 'users_offers/IMG-645a980ccb284.png', 'sold', 1),
(91, 20, 4, 2, 'users_offers/IMG-645a980ccb280.png', 'users_offers/IMG-645a980ccb284.png', 'reserved', 1),
(95, 20, 21, 1, 'users_offers/IMG-64dcd3c9b995b.jpg', 'users_offers/IMG-64dcd3c9b995f.jpg', 'available', 2),
(96, 20, 21, 34, 'users_offers/IMG-64dcd48bc1072.jpg', 'users_offers/IMG-64dcd48bc1077.jpg', 'reserved', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`request_id`);

--
-- Indeksy dla tabeli `sample_books`
--
ALTER TABLE `sample_books`
  ADD PRIMARY KEY (`book_ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeksy dla tabeli `users_offers`
--
ALTER TABLE `users_offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT dla tabeli `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `sample_books`
--
ALTER TABLE `sample_books`
  MODIFY `book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `users_offers`
--
ALTER TABLE `users_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
