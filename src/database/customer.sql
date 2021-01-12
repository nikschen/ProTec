-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2021 um 15:39
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `protecdb`
--

-- --------------------------------------------------------


--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`customerID`, `createdAt`, `updatedAt`, `firstName`, `lastName`, `birthDate`, `eMail`) VALUES
(28, '2021-01-12 14:35:52', NULL, 'Niklas', 'Wiefurcht', '1991-03-18', 'LordyMcViva@googlemail.com'),
(29, '2021-01-12 14:35:52', NULL, 'Thomas', 'Messer', '1986-11-04', 'Bigtommycool@web.de'),
(30, '2021-01-12 14:35:52', NULL, 'Klaus', 'Leber', '1980-01-01', 'FreeWilly@gmx.de'),
(31, '2021-01-12 14:35:52', NULL, 'Ludwig', 'Loberstutter', '1999-08-02', 'KleinerLu@yahoo.com'),
(32, '2021-01-12 14:35:52', NULL, 'Selen', 'Konquistator', '2000-04-14', 'Selen@giga.com'),
(33, '2021-01-12 14:35:52', NULL, 'Maximilian', 'Gruber', '1911-11-11', 'OldMax@aol.de'),
(34, '2021-01-12 14:35:52', NULL, 'Hans', 'Gruber', '1950-09-14', 'OldMaxJr@aol.de'),
(35, '2021-01-12 14:35:52', NULL, 'Jim', 'Dragon', '1985-08-07', 'DragonFly@gmx.de'),
(36, '2021-01-12 14:35:52', NULL, 'Betrand', 'Russel', '2000-12-04', 'RusselBer@arcor.de');

--
-- Indizes der exportierten Tabellen
--


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
