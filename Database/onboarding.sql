-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 10:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `title`, `description`) VALUES
(1, 'Account aanmaken', 'Voltooi alle stappen om je account correct in te stellen'),
(2, 'Profiel instellen', 'Zorg dat je profiel compleet dgdsgdg\r\n\r\n\r\n\r\ndfs\r\nfdfsggs\r\ngdsgdddddddddddddddddddddddddd'),
(3, 'Welkomsttour voltooien', 'Leer de belangrijkste functies van het platform'),
(4, 'Team uitnodigen', 'Nodig je teamleden uit en deel taken'),
(5, 'Eerste project aanmaken', 'Begin je eerste project in het platform');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_assignments`
--

CREATE TABLE `checklist_assignments` (
  `user_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_assignments`
--

INSERT INTO `checklist_assignments` (`user_id`, `checklist_id`) VALUES
(1, 1),
(5, 1),
(6, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items`
--

CREATE TABLE `checklist_items` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_items`
--

INSERT INTO `checklist_items` (`id`, `checklist_id`, `title`, `sort_order`) VALUES
(1, 1, 'Gebruikersnaam kiezen', 1),
(2, 1, 'Wachtwoord instellen', 2),
(3, 1, 'E-mailadres verifiëren', 3),
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
(21, 5, 'Project starten', 5),
(22, 1, '', 999);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_progress`
--

CREATE TABLE `checklist_progress` (
  `user_id` int(11) NOT NULL,
  `checklist_item_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Amr', NULL, '123', 'user', '2026-01-09 10:24:02'),
(4, 'admin', NULL, '$2y$10$f0dvBXEPsaogBlPq1vGRi.WjW0/Q5h6DOYlVhsgHsMehS9kQVb2du', 'admin', '2026-01-09 10:24:02'),
(5, 'amro', NULL, '$2y$10$qxDL2TZIBKD.Hm34cchHkeum1/NaoghEXk15aq7aCJwG1Kwd1e.sq', 'user', '2026-01-09 10:24:02'),
(6, 'Chahid', 'chahid20juni@gmail.com', '$2y$10$8ZTJf6u2.ushiCBvG1qQvOC57VpYdaV7QacGKyosTACAM3ukHW91O', 'user', '2026-01-09 10:25:14'),
(7, 'sdwqd', '595908@edu.rocmn.nl', '$2y$10$f1KJRT8rUxIDRWUQJOWOgu9eykppAfbB/ejQQKiUL2oWx1HCCP4ea', 'user', '2026-01-09 10:29:38'),
(8, 'Chahid B', 'chahid30juni@gmail.com', '$2y$10$EmFiO8sLMwbBTeuxq/QTz.pOu1KcuxYSeBrPTo2BDl7qgfY20WN6C', 'user', '2026-01-12 13:36:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist_assignments`
--
ALTER TABLE `checklist_assignments`
  ADD PRIMARY KEY (`user_id`,`checklist_id`);

--
-- Indexes for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexes for table `checklist_progress`
--
ALTER TABLE `checklist_progress`
  ADD PRIMARY KEY (`user_id`,`checklist_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `checklist_items`
--
ALTER TABLE `checklist_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD CONSTRAINT `checklist_items_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
