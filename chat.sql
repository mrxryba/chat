-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Wrz 2021, 10:36
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `chat`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(1000) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `timestamp`) VALUES
(89, 389832638, 279687376, 'Siema', '2021-09-06 22:01:41'),
(90, 389832638, 667918673, 'Hej', '2021-09-06 22:04:24'),
(91, 736769562, 177748564, 'Witaj', '2021-09-07 08:03:23'),
(92, 177748564, 736769562, 'Siemano', '2021-09-07 08:03:33'),
(93, 1398547547, 177748564, 'Hej, co sÅ‚ychaÄ‡? ', '2021-09-07 08:07:25'),
(94, 177748564, 1398547547, 'CzeÅ›Ä‡ ', '2021-09-07 08:07:57'),
(95, 177748564, 1398547547, 'W sumie to dobrze ', '2021-09-07 08:08:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` text COLLATE utf8_unicode_ci NOT NULL,
  `lname` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `username`, `email`, `password`, `img`, `status`) VALUES
(22, 736769562, 'Marek', 'Nowak', '', 'marek@wp.pl', '$2y$10$YPtyulxvbIDILOwOfQFbdu7/YDaQC6RMQCaTQbjmsMoSU942NzLMK', '1630966275face.jpg', 'Offline now'),
(23, 177748564, 'Marcin', 'Mlonek', '', 'marcin@wp.pl', '$2y$10$vuzOqw8ileaye0sg8C2bPuzZvcKa8JNihKbq3QTom3cGfBuTPNoqK', '1630997269adam.jpg', 'Offline now'),
(24, 1398547547, 'Julia', 'KamiÅ„ska', '', 'julia@wp.pl', '$2y$10$O9lqewhZtJNc8aEpQHSohewWLzkL5YiEeh/zT7a5Frn.vQ1xHUTo6', '16310019981629999634user2.jpg', 'Offline now');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
