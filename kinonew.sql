-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 07:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kino`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_seans` (IN `seans` INT(10))  BEGIN
	DELETE FROM seanse WHERE idSeansu = seans;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bilety`
--

CREATE TABLE `bilety` (
  `idBiletu` int(10) UNSIGNED NOT NULL,
  `typ` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `bilety`
--

INSERT INTO `bilety` (`idBiletu`, `typ`, `cena`) VALUES
(1, 'normalny', 25),
(2, 'ulgowy', 11);

-- --------------------------------------------------------

--
-- Table structure for table `filmy`
--

CREATE TABLE `filmy` (
  `idFilmu` int(10) UNSIGNED NOT NULL,
  `Gatunki_idGatunku` int(10) UNSIGNED NOT NULL,
  `tytul` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `producent` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `premiera` date DEFAULT NULL,
  `rezyser` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `czas_trwania` time DEFAULT NULL,
  `plakat` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `opis` longtext COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`idFilmu`, `Gatunki_idGatunku`, `tytul`, `producent`, `premiera`, `rezyser`, `czas_trwania`, `plakat`, `opis`) VALUES
(1, 1, 'Diuna (Dune)', 'Warner Bros & Legendary', '2021-11-11', 'Denis Villeneuve', '02:35:00', '', 'test'),
(2, 3, 'Eternals', 'Marvel Studios', '2021-11-09', 'Chloé Zhao', '02:37:00', './img/plakaty/eternals.jpg', 'Bardzo fajny film'),
(3, 4, 'Spencer', 'Komplizen Film', NULL, 'Pablo Larraíen', '01:51:00', './img/plakaty/spencer.jpg', NULL),
(4, 2, 'test', 'Ja', '2021-11-10', 'Stefan', '23:53:00', '', 'test'),
(5, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(6, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(7, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(8, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(9, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(10, 2, 'test', 'te', '0000-00-00', 'Stefan', '20:56:00', '', 'test'),
(11, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(12, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(13, 2, 'test', 'te', '2021-11-03', 'Stefan', '20:56:00', '', 'test'),
(14, 2, 'test', 'Ja', '2021-11-11', 'Stefan', '23:58:00', '', 'test'),
(15, 2, 'test', 'Ja', '2021-11-11', 'Stefan', '23:58:00', '', 'test'),
(16, 2, 'test', 'Ja', '2021-11-11', 'Stefan', '23:58:00', '', 'test'),
(17, 2, 'test', 'Ja', '2021-11-11', 'Stefan', '23:58:00', '', 'test'),
(18, 2, 'test', 'Ja', '2021-11-11', 'Stefan', '23:58:00', '', 'test'),
(19, 2, 'ela', 'ktoś fajny', '2021-11-26', 'aaaaaaaaaaaaa', '13:02:00', '', 'fajnie jak działa\r\n'),
(20, 2, 'ela', 'ktoś fajny', '2021-11-26', 'aaaaaaaaaaaaa', '13:02:00', '', 'fajnie jak działa\r\n'),
(21, 2, 'ela', 'ktoś fajny', '2021-11-26', 'aaaaaaaaaaaaa', '13:02:00', '', 'fajnie jak działa\r\n'),
(22, 2, 'sadas', 'fdsfs', '2021-11-11', 'fsdfs', '20:07:00', '../img/plakaty/matrix.png', 'fsdfs'),
(23, 1, 'MATRIX ZMARTWYCHWSTANIA', 'NPV Entertainment', '2021-12-16', 'Lana Wachowski / Aleksandar Hemon', '14:22:00', '../img/plakaty/matrix.png', 'Nowy matrix'),
(24, 1, 'MATRIX ZMARTWYCHWSTANIA', 'NPV Entertainment', '2021-12-16', 'Lana Wachowski / Aleksandar Hemon', '14:22:00', './img/plakaty/matrix.png', 'Nowy matrix');

-- --------------------------------------------------------

--
-- Table structure for table `gatunki`
--

CREATE TABLE `gatunki` (
  `idGatunku` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `kat_wiek` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `gatunki`
--

INSERT INTO `gatunki` (`idGatunku`, `nazwa`, `kat_wiek`) VALUES
(1, 'Sci-Fi', 7),
(2, 'Horror', 18),
(3, 'Akcja', 13),
(4, 'Dramat', 12);

-- --------------------------------------------------------

--
-- Table structure for table `klienci`
--

CREATE TABLE `klienci` (
  `idKlienta` int(10) UNSIGNED NOT NULL,
  `login` varchar(25) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `imie` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `mail` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `adres` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `kod_pocztowy` varchar(6) COLLATE utf8mb4_polish_ci NOT NULL,
  `miejscowosc` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `nr_telefonu` varchar(12) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(250) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`idKlienta`, `login`, `imie`, `nazwisko`, `mail`, `adres`, `kod_pocztowy`, `miejscowosc`, `nr_telefonu`, `pass`) VALUES
(1, 'stasyn', 'Stanisław', 'Synowiec', 'stasyn1410@gmail.com', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '723473902', '$2y$10$LqUlAvkiAfgEEHd/hGk9ueHlXpCo/FeDYuClyu'),
(2, 'test', 'Jan', 'Kowalski', 'jan@kowalski.pl', 'Warszawska 85', '98-400', 'Wieruszów', '123456789', '$2y$10$9HZRH1.RVs6k6wxI4WdgVOP/SNo3lVLMDRjzDp'),
(3, 'janek', 'Jan', 'Kowalski', 'Jan@gmail.com', 'Szkolna 1-3', '98-400', 'Wieruszów', '123456789', '$2y$10$WO7ibxKHBUJBO78UishEQub8Y6.cssW3zGILYN'),
(4, 'jko', 'Jan', 'Kowalski', 'jan@o2.pl', 'Podzamcze 25', '98-400', 'Wieruszów', '123456789', '$2y$10$cAYje4cTYJpU2gwIsU48OuJ50MMTm1rLTljDTC'),
(5, 'testaplek', 'Jan', 'Kowalski', 'testaplikacji1111@o2.pl', 'Kepno', '98-400', 'Wieruszów', '123456789', '$2y$10$KB./bCVfXZYvuyUCu4WIKuDQNQmH0P95sRPsFW'),
(6, 'testaplikacji', 'Jan', 'Kowalski', 'testaplikacji1111@gmail.com', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456789', '$2y$10$AdH0zVZbEV8IgumTzJMveuELeCc6iiwY.buJoL'),
(7, 'jas', 'Jan', 'Kowalski', 'testaplikacji111@gmail.com', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456879', '$2y$10$3mp4IqIT1aL8grdw0pQxIeKZ.MfOhcUGQbhx64'),
(8, 'stasyn1410@gmail.com', 'Stanisław', 'Synowiec', 'stasyn1410@yahoo.com', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456789', '$2y$10$pDvOxHplxBFLSPF6jrQd2OO2f5YLN.ozuCSJ/Z'),
(9, 'aaaa', 'Stanisław', 'Synowiec', 'stasyn1410@o2.pl', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456789', '$2y$10$bWxGlpMclrWb70NZpg09Cu7UVC9w6jQ2vx7kxR'),
(10, 'lalal', 'Stanisław', 'Synowiec', 'stasyn1410@wpl.pl', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456789', '$2y$10$Siio/v5q0aXJhulfdElLZOBNasWTcK9yCzsLcj'),
(11, 'kasia', 'Kasia', 'Nowak', 'kasia@mail.pl', 'Biadaszki 74/2', '63-645', 'Łęka Opatowska', '123456789', '$2y$10$LcIIekZiVMRhPkTEyU/.vuYou5Rr5QnfnPRO2SAi6jUgn.zYK1oGy'),
(12, 'admin', 'Administrator', 'Systemu', 'admin@naszekino.pl', 'ul. Warszawska 58', '60-001', 'Poznań', '123456789', '$2y$10$4/4mzirnA3eAo8Z4gxNSjehdYpgRiF6F8yATXm5/Uu3YLOOpPM/J2');

-- --------------------------------------------------------

--
-- Table structure for table `pracownicy`
--

CREATE TABLE `pracownicy` (
  `idPracownika` int(10) UNSIGNED NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `imie` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(45) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`idPracownika`, `login`, `imie`, `nazwisko`, `pass`) VALUES
(1, 'admin', 'Administrator', 'Systemu', '$2y$10$4/4mzirnA3eAo8Z4gxNSjehdYpgRiF6F8yATXm5/Uu3YLOOpPM/J2');

-- --------------------------------------------------------

--
-- Table structure for table `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `idRezerwacje` int(10) UNSIGNED NOT NULL,
  `Klienci_idKlienta` int(10) UNSIGNED NOT NULL,
  `Seanse_idSeansu` int(10) UNSIGNED NOT NULL,
  `Bilety_idBiletu` int(10) UNSIGNED NOT NULL,
  `miejsce` int(10) UNSIGNED NOT NULL,
  `rzad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `nr_sali` int(10) UNSIGNED NOT NULL,
  `pojemnosc` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`nr_sali`, `pojemnosc`) VALUES
(1, 25),
(2, 75),
(3, 50);

-- --------------------------------------------------------

--
-- Table structure for table `seanse`
--

CREATE TABLE `seanse` (
  `idSeansu` int(10) UNSIGNED NOT NULL,
  `Filmy_idFilmu` int(10) UNSIGNED NOT NULL,
  `Sale_nr_sali` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `seanse`
--

INSERT INTO `seanse` (`idSeansu`, `Filmy_idFilmu`, `Sale_nr_sali`, `date`, `time`) VALUES
(3, 1, 1, '2021-11-08', '12:46:55'),
(4, 3, 1, '2021-11-11', '18:16:00'),
(5, 7, 2, '2021-11-02', '11:30:00'),
(6, 9, 3, '2021-11-24', '12:23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bilety`
--
ALTER TABLE `bilety`
  ADD PRIMARY KEY (`idBiletu`);

--
-- Indexes for table `filmy`
--
ALTER TABLE `filmy`
  ADD PRIMARY KEY (`idFilmu`),
  ADD KEY `Filmy_FKIndex1` (`Gatunki_idGatunku`);

--
-- Indexes for table `gatunki`
--
ALTER TABLE `gatunki`
  ADD PRIMARY KEY (`idGatunku`);

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`idKlienta`);

--
-- Indexes for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`idPracownika`);

--
-- Indexes for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`idRezerwacje`),
  ADD KEY `Rezerwacje_FKIndex1` (`Bilety_idBiletu`),
  ADD KEY `Rezerwacje_FKIndex2` (`Seanse_idSeansu`),
  ADD KEY `Rezerwacje_FKIndex3` (`Klienci_idKlienta`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`nr_sali`);

--
-- Indexes for table `seanse`
--
ALTER TABLE `seanse`
  ADD PRIMARY KEY (`idSeansu`),
  ADD KEY `Seanse_FKIndex1` (`Sale_nr_sali`),
  ADD KEY `Seanse_FKIndex2` (`Filmy_idFilmu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bilety`
--
ALTER TABLE `bilety`
  MODIFY `idBiletu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filmy`
--
ALTER TABLE `filmy`
  MODIFY `idFilmu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gatunki`
--
ALTER TABLE `gatunki`
  MODIFY `idGatunku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `idKlienta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `idPracownika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `idRezerwacje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `nr_sali` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seanse`
--
ALTER TABLE `seanse`
  MODIFY `idSeansu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filmy`
--
ALTER TABLE `filmy`
  ADD CONSTRAINT `filmy_ibfk_1` FOREIGN KEY (`Gatunki_idGatunku`) REFERENCES `gatunki` (`idGatunku`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`Bilety_idBiletu`) REFERENCES `bilety` (`idBiletu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rezerwacje_ibfk_2` FOREIGN KEY (`Seanse_idSeansu`) REFERENCES `seanse` (`idSeansu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rezerwacje_ibfk_3` FOREIGN KEY (`Klienci_idKlienta`) REFERENCES `klienci` (`idKlienta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seanse`
--
ALTER TABLE `seanse`
  ADD CONSTRAINT `seanse_ibfk_1` FOREIGN KEY (`Sale_nr_sali`) REFERENCES `sale` (`nr_sali`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seanse_ibfk_2` FOREIGN KEY (`Filmy_idFilmu`) REFERENCES `filmy` (`idFilmu`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
