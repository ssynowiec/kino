-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 08:10 PM
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
  `plakat` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`idFilmu`, `Gatunki_idGatunku`, `tytul`, `producent`, `premiera`, `rezyser`, `czas_trwania`, `plakat`) VALUES
(1, 1, 'Diuna (Dune)', 'Warner Bros & Legendary', NULL, 'Denis Villeneuve', '02:35:00', './img/plakaty.diuna.jpg'),
(2, 3, 'Eternals', 'Marvel Studios', NULL, 'Chloé Zhao', '02:37:00', './img/plakaty/eternals.jpg'),
(3, 4, 'Spencer', 'Komplizen Film', NULL, 'Pablo Larraíen', '01:51:00', './img/plakaty/spencer.jpg');

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
  `pass` varchar(45) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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
(2, 80);

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
  MODIFY `idFilmu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gatunki`
--
ALTER TABLE `gatunki`
  MODIFY `idGatunku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `idKlienta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `idPracownika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `idRezerwacje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `nr_sali` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seanse`
--
ALTER TABLE `seanse`
  MODIFY `idSeansu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
