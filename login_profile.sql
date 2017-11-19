-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 19. 11 2017 kl. 20:21:04
-- Serverversion: 10.1.26-MariaDB
-- PHP-version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_profile`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `permissions`
--

CREATE TABLE `permissions` (
  `permissions_id` int(11) NOT NULL,
  `permissions_name` varchar(50) NOT NULL,
  `permissions_cname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `permissions`
--

INSERT INTO `permissions` (`permissions_id`, `permissions_name`, `permissions_cname`) VALUES
(1, 'Administration: Opret brugere', 'admin_opret_brugere'),
(2, 'Administration: Rediger brugere', 'admin_rediger_brugere'),
(3, 'Administration: Slet brugere', 'admin_slet_brugere'),
(4, 'Administration: Deaktiver brugere', 'admin_deaktiver_brugere'),
(5, 'Administration: Skift medlemmers brugernavn', 'admin_skift_medlemmers_username'),
(6, 'Administration: Skift moderatorers brugernavn', 'admin_skift_moderators_username'),
(7, 'Administration: Rediger spil', 'admin_rediger_spil'),
(8, 'Administration: Slet spil', 'admin_slet_spil'),
(9, 'Administration: Deaktiver spil', 'admin_deaktiver_spil'),
(10, 'Administration: Deaktiver specifikke downloads', 'admin_deaktiver_specifikke_downloads'),
(11, 'Administration: Rediger medlemmers kommentarer', 'admin_rediger_medlemmers_kommentarer'),
(12, 'Administration: Slet medlemmers kommentarer', 'admin_slet_medlemmers_kommentarer'),
(13, 'Administration: Rediger moderatorers kommentarer', 'admin_rediger_moderatorers_kommentarer'),
(14, 'Administration: Slet moderatorers kommentarer', 'admin_slet_moderatorers_kommentarer'),
(15, 'Registrer profil', 'registrer_profil'),
(16, 'Upload spil', 'upload_spil'),
(17, 'Rediger egne spil', 'rediger_egne_spil'),
(18, 'Slet egne spil', 'slet_egne_spil'),
(19, 'Rate spil', 'rate_spil'),
(20, 'Download spil', 'download_spil'),
(21, 'Læs kommentarer', 'laes_kommentarer'),
(22, 'Skriv kommentarer', 'skriv_kommentarer'),
(23, 'Tilmeld og frameld nyhedsbrev', 'tilmeld_og_frameld_nyhedsbrev'),
(24, 'Spil online', 'spil_online');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'member'),
(4, 'guest');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `roles_and_permissions`
--

CREATE TABLE `roles_and_permissions` (
  `fk_role_id` int(11) NOT NULL,
  `fk_permissions_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `roles_and_permissions`
--

INSERT INTO `roles_and_permissions` (`fk_role_id`, `fk_permissions_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 14),
(1, 13),
(1, 12),
(1, 11),
(1, 10),
(1, 9),
(1, 8),
(1, 7),
(1, 6),
(1, 5),
(1, 4),
(1, 20),
(1, 21),
(1, 22),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 7),
(2, 9),
(2, 10),
(2, 11),
(2, 20),
(2, 21),
(2, 22),
(3, 16),
(3, 17),
(3, 20),
(3, 21),
(3, 22),
(4, 15),
(4, 19),
(1, 24),
(4, 23),
(3, 23),
(2, 24),
(3, 24),
(2, 12),
(2, 8),
(3, 18),
(3, 19),
(4, 24);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `uemail` varchar(70) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(60) NOT NULL,
  `phone` int(8) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` int(4) NOT NULL,
  `fk_role_id` int(11) NOT NULL,
  `fk_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`, `uemail`, `fname`, `lname`, `phone`, `address`, `city`, `zipcode`, `fk_role_id`, `fk_users_id`) VALUES
(33, 'sam', 'f16bed56189e249fe4ca8ed10a1ecae60e8ceac0', 'sam@live.dk', 'sam', 'sam', 44, '', '', 0, 3, 0),
(36, 'spar', 'f412a2010eb6625c85ebe505e051e18008501c5e', 'spar@live.dk', 'spar', 'spar', 0, '', '', 0, 1, 0),
(37, 'hej', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'hej@live.dk', 'hej', 'hej', 0, '', '', 0, 3, 0),
(38, NULL, NULL, 'hej@live.dk', 'hej', 'hej', 45, 'dfgdfg', 'fgfdg', 400, 0, 37);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissions_id`);

--
-- Indeks for tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Tilføj AUTO_INCREMENT i tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
