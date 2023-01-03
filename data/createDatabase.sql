-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 03 jan 2023 om 16:53
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ooplogin`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(16) NOT NULL,
  `account_username` tinytext NOT NULL,
  `account_email` tinytext NOT NULL,
  `account_password` longtext NOT NULL,
  `account_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `account_beta_user` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_username`, `account_email`, `account_password`, `account_enabled`, `account_beta_user`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$P6zQFs2FIgopK1QImllqWeINrzHfxzulGeFR.DaTJzlFQi.JNbXki', 1, 1),
(2, 'AlexVDV116', 'alexemail@hotmail.com', '$2y$10$/ishZ2nbQxODPAE.r8s5Y.sGErC2wn.02QRPExN2Gila4nN3ypCEu', 1, 1),
(3, 'Testaccount', 'testaccount@email.com', '$2y$10$PjCy2gps5XRyyDChlphyv.zcd1iIem0co/JDNPOEHSJjsMuEDjHzi', 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
