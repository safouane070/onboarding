-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jan 2026 om 11:37
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onboarding`
--
CREATE DATABASE IF NOT EXISTS `onboarding` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `onboarding`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `checklists`
--

CREATE TABLE `checklists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `checklists`
--

INSERT INTO `checklists` (`id`, `title`, `description`) VALUES
(1, 'Account aanmaken', 'Voltooi alle stappen om je account correct in te stellen'),
(2, 'Profiel instellen', 'Zorg dat je profiel compleet is'),
(3, 'Welkomsttour voltooien', 'Leer de belangrijkste functies van het platform'),
(4, 'Team uitnodigen', 'Nodig je teamleden uit en deel taken'),
(5, 'Eerste project aanmaken', 'Begin je eerste project in het platform');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `checklist_assignments`
--

CREATE TABLE `checklist_assignments` (
  `user_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `checklist_assignments`
--

INSERT INTO `checklist_assignments` (`user_id`, `checklist_id`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `checklist_items`
--

CREATE TABLE `checklist_items` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `checklist_items`
--

INSERT INTO `checklist_items` (`id`, `checklist_id`, `title`, `sort_order`) VALUES
(1, 1, 'Gebruikersnaam kiezen', 1),
(2, 1, 'Wachtwoord instellen', 2),
(3, 1, 'E-mailadres verifiëren', 3),
(4, 1, 'Tweestapsverificatie instellen', 4),
(5, 2, 'Profielfoto uploaden', 1),
(6, 2, 'Contactgegevens invullen', 2),
(7, 2, 'Functie / afdeling toevoegen', 3),
(8, 2, 'Voorkeuren instellen', 4),
(9, 3, 'Introductie dashboard', 1),
(10, 3, 'Leren navigeren tussen pagina’s', 2),
(11, 3, 'Basisrapportage bekijken', 3),
(12, 3, 'Veelgestelde vragen doorlopen', 4),
(13, 4, 'Teamleden toevoegen via e-mail', 1),
(14, 4, 'Rollen toewijzen', 2),
(15, 4, 'Controleer uitnodigingen', 3),
(16, 4, 'Eerste teambericht sturen', 4),
(17, 5, 'Projectnaam invullen', 1),
(18, 5, 'Projectomschrijving toevoegen', 2),
(19, 5, 'Deadline instellen', 3),
(20, 5, 'Taken toevoegen', 4),
(21, 5, 'Project starten', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `checklist_progress`
--

CREATE TABLE `checklist_progress` (
  `user_id` int(11) NOT NULL,
  `checklist_item_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Amr', '123', 'user'),
(4, 'admin', '1234', 'admin'),
(5, 'amro', '$2y$10$qxDL2TZIBKD.Hm34cchHkeum1/NaoghEXk15aq7aCJwG1Kwd1e.sq', 'user');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `checklist_assignments`
--
ALTER TABLE `checklist_assignments`
  ADD PRIMARY KEY (`user_id`,`checklist_id`);

--
-- Indexen voor tabel `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexen voor tabel `checklist_progress`
--
ALTER TABLE `checklist_progress`
  ADD PRIMARY KEY (`user_id`,`checklist_item_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `checklist_items`
--
ALTER TABLE `checklist_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD CONSTRAINT `checklist_items_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
