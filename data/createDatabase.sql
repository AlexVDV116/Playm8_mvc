-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 28 feb 2023 om 19:05
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
-- Database: `playm8`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(16) NOT NULL,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `isEnabled` tinyint(1) NOT NULL DEFAULT 1,
  `isBetaUser` tinyint(1) NOT NULL DEFAULT 0,
  `userProfileID` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`accountID`, `username`, `email`, `password`, `isEnabled`, `isBetaUser`, `userProfileID`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$P6zQFs2FIgopK1QImllqWeINrzHfxzulGeFR.DaTJzlFQi.JNbXki', 1, 1, 0),
(2, 'AlexVDV116', 'alexemail@hotmail.com', '$2y$10$/ishZ2nbQxODPAE.r8s5Y.sGErC2wn.02QRPExN2Gila4nN3ypCEu', 1, 1, 0),
(49, 'Piet', 'piet@email.com', '$2y$10$dsXB90MqB3rCYVPmGm8i9eklqvR2t.X.qOeGOuqj7CVgwFawHkcJq', 1, 0, 0),
(50, 'Christina', 'christina@email.com', '$2y$10$G4YDSl0e43ziR5NkKXlWVeOiOLJoaNXF.MEmoukDm1bbfMz0oqh/G', 1, 0, NULL),
(51, 'Frank', 'frankie@email.com', '$2y$10$shhj8UumMUsw6jdd5.G19.6KE5kmKVOT/WUvzKM4qOqqP84UNS8xi', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountsRoles`
--

CREATE TABLE `accountsRoles` (
  `accountID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `userProfileID` int(16) NOT NULL,
  `userProfileIDOfLikedUser` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permissions`
--

CREATE TABLE `permissions` (
  `permissionID` int(16) NOT NULL,
  `permissionName` tinytext NOT NULL,
  `permissionDescription` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `roleID` int(16) NOT NULL,
  `roleName` tinytext NOT NULL,
  `roleDescription` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rolesPermissions`
--

CREATE TABLE `rolesPermissions` (
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userProfiles`
--

CREATE TABLE `userProfiles` (
  `userProfileID` int(16) NOT NULL,
  `firstName` tinytext NOT NULL,
  `lastName` tinytext NOT NULL,
  `phoneNumber` tinytext NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `userProfileID` (`userProfileID`);

--
-- Indexen voor tabel `accountsRoles`
--
ALTER TABLE `accountsRoles`
  ADD PRIMARY KEY (`accountID`,`roleID`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD KEY `userProfileID` (`userProfileID`);

--
-- Indexen voor tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionID`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexen voor tabel `rolesPermissions`
--
ALTER TABLE `rolesPermissions`
  ADD PRIMARY KEY (`roleID`,`permissionID`),
  ADD KEY `rolespermissions_ibfk_2` (`permissionID`);

--
-- Indexen voor tabel `userProfiles`
--
ALTER TABLE `userProfiles`
  ADD PRIMARY KEY (`userProfileID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `accountsRoles`
--
ALTER TABLE `accountsRoles`
  ADD CONSTRAINT `accountsroles_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountsroles_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`userProfileID`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `rolesPermissions`
--
ALTER TABLE `rolesPermissions`
  ADD CONSTRAINT `rolespermissions_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rolespermissions_ibfk_2` FOREIGN KEY (`permissionID`) REFERENCES `permissions` (`permissionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `userProfiles`
--
ALTER TABLE `userProfiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`userProfileID`) REFERENCES `accounts` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
