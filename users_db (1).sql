-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Okt 2024 um 14:56
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `users_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE `artikel` (
  `Artikel_ID` int(11) NOT NULL,
  `Artikelname` varchar(255) NOT NULL,
  `Benutzeranzahl` int(11) NOT NULL,
  `Grosse` decimal(10,2) NOT NULL,
  `Zusatzanzahl` int(11) NOT NULL,
  `Zusatzpreis` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`Artikel_ID`, `Artikelname`, `Benutzeranzahl`, `Grosse`, `Zusatzanzahl`, `Zusatzpreis`) VALUES
(4, 'Cloud-Speicher 10GB', 2, 10.00, 0, 0.00),
(5, 'Cloud-Speicher 10GB', 7, 9.00, 1, 20.00),
(9, 'Cloud-Speicher 10GB', 5, 12.00, -7, 0.00),
(10, 'Cloud-Speicher 10GB', 3, 10.00, 0, 0.00),
(11, 'Cloud-Speicher 10GB', 10, 10.00, 7, 375.00),
(12, 'Cloud-Speicher 10GB', 1, 10.00, -2, -70.00),
(13, 'Cloud-Speicher 10GB', 1, 10.00, -2, -70.00),
(14, 'Cloud-Speicher 10GB', 1, 10.00, -2, -70.00),
(15, 'Cloud-Speicher 10GB', 3, 10.00, -6, 0.00),
(16, 'Cloud-Speicher 1GB', 7, 1.00, -2, 0.00),
(17, 'Cloud-Speicher 10GB', 1, 10.00, -2, 0.00),
(18, 'Cloud-Speicher 200GB', 6, 200.00, -3, 0.00),
(19, 'Cloud-Speicher 200GB', 3, 200.00, 0, 0.00),
(20, 'Cloud-Speicher 200GB', 5, 200.00, 2, 40.00),
(21, 'Cloud-Speicher 200GB', 3, 200.00, 0, 0.00),
(22, 'Cloud-Speicher 200GB', 5, 200.00, -7, 0.00),
(23, 'Cloud-Speicher 200GB', 4, 200.00, -5, 0.00),
(24, 'Cloud-Speicher 200GB', 5, 200.00, -4, 0.00),
(25, 'Cloud-Speicher 200GB', 3, 200.00, 0, 0.00),
(26, 'Cloud-Speicher 200GB', 4, 200.00, -2, 0.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE `rechnung` (
  `Rechnung_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rechnung`
--

INSERT INTO `rechnung` (`Rechnung_ID`, `user_ID`, `Datum`) VALUES
(10, 6, '2024-10-11 10:32:31'),
(11, 7, '2024-10-11 11:27:24'),
(12, 8, '2024-10-11 11:35:52'),
(15, 11, '2024-10-11 13:58:30'),
(16, 14, '2024-10-11 14:22:12'),
(17, 14, '2024-10-11 14:25:05'),
(18, 14, '2024-10-11 14:31:47'),
(19, 14, '2024-10-11 15:02:10'),
(20, 14, '2024-10-11 15:02:56'),
(21, 14, '2024-10-11 15:03:51'),
(22, 14, '2024-10-11 15:06:49'),
(23, 14, '2024-10-11 15:25:53'),
(24, 14, '2024-10-14 10:47:27'),
(25, 14, '2024-10-14 10:48:19'),
(26, 14, '2024-10-14 11:21:04'),
(27, 14, '2024-10-14 11:26:37'),
(28, 14, '2024-10-14 11:31:18'),
(29, 14, '2024-10-14 11:46:24'),
(30, 14, '2024-10-14 11:47:18'),
(31, 14, '2024-10-14 11:47:52'),
(32, 14, '2024-10-14 11:57:22'),
(33, 14, '2024-10-14 15:12:21'),
(34, 14, '2024-10-14 15:13:38'),
(37, 14, '2024-10-14 15:25:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung_details`
--

CREATE TABLE `rechnung_details` (
  `Rechnung_ID` int(11) NOT NULL,
  `Artikel_ID` int(11) NOT NULL,
  `menge` int(30) NOT NULL,
  `Preis` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rechnung_details`
--

INSERT INTO `rechnung_details` (`Rechnung_ID`, `Artikel_ID`, `menge`, `Preis`) VALUES
(10, 4, 0, NULL),
(11, 5, 0, NULL),
(15, 9, 0, NULL),
(16, 10, 0, NULL),
(17, 11, 0, NULL),
(18, 12, 0, NULL),
(22, 13, 1, NULL),
(23, 14, 1, NULL),
(24, 15, 3, NULL),
(25, 16, 3, NULL),
(26, 17, 1, NULL),
(27, 18, 3, NULL),
(28, 19, 1, NULL),
(29, 20, 1, NULL),
(30, 21, 1, NULL),
(31, 22, 4, NULL),
(32, 23, 3, NULL),
(33, 24, 3, 225.00),
(34, 25, 1, 75.00),
(37, 26, 2, 150.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `hausnummer` varchar(50) NOT NULL,
  `PLZ_id` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefonnummer` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `geschlecht` enum('male','female') NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `firma` varchar(100) NOT NULL,
  `payment_method` enum('iban','paypal') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_ID`, `vorname`, `nachname`, `strasse`, `hausnummer`, `PLZ_id`, `email`, `telefonnummer`, `password`, `geschlecht`, `benutzername`, `role`, `firma`, `payment_method`) VALUES
(6, 'Sadir', 'Alahmed', 'hintermhalm', '23', '28717', 'baba_sanfor@gmail.com', '12434', '$2y$10$r/KvrIj2T8NhQ5M0/ySJqeme8xsM4yLhVIvJ7KwAvdrK3JlKfMova', 'male', 'sadiraa', 'Admin', '', NULL),
(7, 'marc', 'hedel', 'estrewt', '43', '57657', 'marc@gmail.com', '34654747', '$2y$10$w1DM.hD4jdL4cMMiZeNHfelskHEW3CWXbUmlnu9M069UR7Mw/eZNu', '', 'marcc', 'User', '', 'paypal'),
(8, 'SadirA', 'AlahmedD', 'hintermhalm', '23', '28717', 'baba_sanfor@gmail.con', '46758698693', '$2y$10$/Cr4MI.trUeZ76aeU.7/auTI0Q6ObXPwtDdnNHJYjmvYr3imgNsji', '', 'sadiraaa', 'User', '', 'iban'),
(11, 'niklas', 'aa', 'safa', '44', '28717', 'niklas@ss.com', '5768769689780ß89', '$2y$10$dosB4sjynoIMIJnZQHuTpe1LM2I4rp2OlRniazmLwNPllCUCfpJkW', '', 'niklass', 'User', '', 'paypal'),
(14, 'gfg', 'hgj', '22', '33', '55656', 'mog@gmail.com', '3erwet', '$2y$10$JlXJKTLkPFZNs6Kaptt8Ne9XJESZjNquW/f0zaqCENbcSkIhKq22O', '', 'hgh', 'User', 'ddd', 'iban');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`Artikel_ID`);

--
-- Indizes für die Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD PRIMARY KEY (`Rechnung_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indizes für die Tabelle `rechnung_details`
--
ALTER TABLE `rechnung_details`
  ADD PRIMARY KEY (`Rechnung_ID`,`Artikel_ID`),
  ADD KEY `Artikel_ID` (`Artikel_ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `artikel`
--
ALTER TABLE `artikel`
  MODIFY `Artikel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  MODIFY `Rechnung_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD CONSTRAINT `rechnung_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints der Tabelle `rechnung_details`
--
ALTER TABLE `rechnung_details`
  ADD CONSTRAINT `rechnung_details_ibfk_1` FOREIGN KEY (`Rechnung_ID`) REFERENCES `rechnung` (`Rechnung_ID`),
  ADD CONSTRAINT `rechnung_details_ibfk_2` FOREIGN KEY (`Artikel_ID`) REFERENCES `artikel` (`Artikel_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
