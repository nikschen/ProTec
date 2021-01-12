-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2021 um 15:38
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
-- Daten für Tabelle `address`
--

INSERT INTO `address` (`addressID`, `createdAt`, `updatedAt`, `street`, `streetNumber`, `zipCode`, `city`, `country`, `additionalInformation`, `phone`) VALUES
(1, '2021-01-12 14:37:42', NULL, 'Bamberger Straße', '5', '99089', 'Erfurt', 'Deutschland', 'HinterHof', '0176600700'),
(2, '2021-01-12 14:37:42', NULL, 'Probantenteststraße', '115a', '07749', 'Jena', 'Deutschland', NULL, NULL),
(3, '2021-01-12 14:37:42', NULL, 'Muldenweg', '1', '00145', 'Buxbaum', 'Österreich', 'Über Oma Hilde', '03451666111'),
(4, '2021-01-12 14:37:42', NULL, 'An der Klinge', '3', '99680', 'Klosterstedt', 'Deutschland', NULL, NULL),
(5, '2021-01-12 14:37:42', NULL, 'Lange Straße ', '39', '99610', 'Elstern', 'Deutschland', NULL, NULL),
(6, '2021-01-12 14:37:42', NULL, 'Wiemuth Weg', '17', '12345', 'Deuna', 'Deutschland', 'Eichsfeld links', '0190 76 76 76'),
(7, '2021-01-12 14:37:42', NULL, 'Lagergasse', '41', '07799', 'Göschwitz', 'Deutschland', NULL, NULL),
(8, '2021-01-12 14:37:42', NULL, 'Bergweg', '7', '14055', 'Trondheim', 'Norwegen', 'Das Haus am See', NULL);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
