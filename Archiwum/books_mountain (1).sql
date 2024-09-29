-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Mar 2023, 22:33
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
(3, 'Poznać przeszłość Wodza Hitlera', '325-3424-32421', 'images/historia3pp.png', '', 'Wsip', 'Opracowanie zbiorowe', 'historia', 1, 'podstawowy', 0),
(4, 'Koniec niewolnictwa upadek białej rasy', '325-3424-32421', 'images/historia3pp.png', '', 'Wsip', 'Opracowanie zbiorowe', 'historia', 2, 'rozszerzony', 0),
(5, 'Matematyka na czasie 3', '9346-4356-36-341', 'images/matm3podr.png', 'images/matm3podrxl.png', 'WSiP', 'Opracowanie zbiorowe', 'matematyka', 3, 'rozszerzony', 2020);

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
(1, 'jasiektojo@gmail.com', '202cb962ac59075b964b07152d234b70', 'Jan', 'Lenart'),
(2, 'jasiek1tojo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Jan', 'Lenart'),
(3, 'adam.malysz@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Adam', 'Malysz'),
(4, '12@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Siemas', 'Si'),
(5, '132@df.pl', '25f9e794323b453885f5181f1b624d0b', 'Siema', 'Si'),
(6, '123@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(7, '124@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(8, '1312@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(9, '12@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(10, '1a2@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(11, '112@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(12, '11a2@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(13, '12aaa@df.pl', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si'),
(14, '12@df.pl12', 'f304c45d3778bc3c71bf330e881cd3fb', 'Siema', 'Si');

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
(1, 1, 4, 16, 'images/matm3podr.png', 'images/matm3podr.png', 'reserved', 1),
(2, 1, 4, 16, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(3, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'reserved', 2),
(4, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'reserved', 2),
(5, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(6, 1, 0, 16, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 1),
(7, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(8, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(9, 1, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(10, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(11, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(12, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(13, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(14, 14, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(15, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(16, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(17, 1, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(18, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(19, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(20, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(21, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(22, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(23, 1, 4, 14, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(24, 1, 4, 15, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(25, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(26, 1, 4, 13, 'images/matm3podr.png', 'images/historia3pp.png', 'available', 2),
(27, 1, 4, 13, 'images/matm3podr.png', 'images/matm3podr.png', 'available', 2),
(30, 4, 4, 4, 'users_offers/IMG-63d91b075b80a.jpg', 'users_offers/IMG-63d91b075b80f.jpg', 'reserved', 1),
(35, 4, 4, 1, 'users_offers/IMG-63dab5f51cf30.jpg', 'users_offers/IMG-63dab5f51cf34.jpg', 'reserved', 1),
(37, 4, 4, 12, 'users_offers/IMG-63dbd51c458f1.jpg', 'users_offers/IMG-63dbd51c458f5.png', 'reserved', 1),
(41, 4, 4, 12, 'users_offers/IMG-63dbf5ca614ec.jpg', 'users_offers/IMG-63dbf5ca614f0.jpg', 'reserved', 1),
(47, 4, 4, 12, 'users_offers/IMG-63e26c954328f.jpg', 'users_offers/IMG-63e26c9543295.png', 'reserved', 1),
(48, 4, 4, 12, 'users_offers/IMG-63e6916a50976.png', 'users_offers/IMG-63e6916a5097c.png', 'reserved', 3),
(49, 4, 3, 12, 'users_offers/IMG-63e691f9eb03b.png', 'users_offers/IMG-63e691f9eb041.png', 'reserved', 3),
(50, 3, 4, 1, 'users_offers/IMG-63e696510024e.png', 'users_offers/IMG-63e6965100252.png', 'reserved', 3),
(51, 4, 3, 123, 'users_offers/IMG-63e6a7646bf61.png', 'users_offers/IMG-63e6a7646bf66.png', 'reserved', 3);

--
-- Indeksy dla zrzutów tabel
--

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
-- AUTO_INCREMENT dla tabeli `sample_books`
--
ALTER TABLE `sample_books`
  MODIFY `book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `users_offers`
--
ALTER TABLE `users_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
