-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 22, 2021 alle 21:22
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezcut`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `administrators`
--

CREATE TABLE `administrators` (
  `AdministratorID` int(11) NOT NULL,
  `AdministratorName` varchar(255) DEFAULT NULL,
  `AdministrationSurname` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `administrators`
--

INSERT INTO `administrators` (`AdministratorID`, `AdministratorName`, `AdministrationSurname`, `Username`, `Password`) VALUES
(1, 'Daniel', 'Plop', 'Daniel', 'Daniel');

-- --------------------------------------------------------

--
-- Struttura della tabella `bookingratings`
--

CREATE TABLE `bookingratings` (
  `BookingRatingID` int(11) NOT NULL,
  `BookingRatingNumber` mediumint(9) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `bookingratings`
--

INSERT INTO `bookingratings` (`BookingRatingID`, `BookingRatingNumber`, `UserID`) VALUES
(1, 10, 2),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `SalonID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CategoryOptionID` int(11) DEFAULT NULL,
  `BeginDateTime` datetime DEFAULT NULL,
  `EndDateTime` datetime DEFAULT NULL,
  `BookingStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `bookings`
--

INSERT INTO `bookings` (`BookingID`, `SalonID`, `UserID`, `CategoryOptionID`, `BeginDateTime`, `EndDateTime`, `BookingStatus`) VALUES
(1, 1, 1, 2, '2021-02-02 09:14:19', '2021-02-22 10:14:19', 'Confermato');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoryoptions`
--

CREATE TABLE `categoryoptions` (
  `CategoryOptionID` int(11) NOT NULL,
  `CategoryOptionsName` varchar(255) DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `SurveyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoryoptions`
--

INSERT INTO `categoryoptions` (`CategoryOptionID`, `CategoryOptionsName`, `ServiceID`, `SurveyID`) VALUES
(1, 'Solo sui lati', 1, 1),
(2, 'Allungamento Unghie', 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `hairdressingsalons`
--

CREATE TABLE `hairdressingsalons` (
  `SalonID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `ShortDescription` varchar(1500) DEFAULT NULL,
  `Gmail` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `AdministratorID` int(11) DEFAULT NULL,
  `OpeningTimeID` int(11) DEFAULT NULL,
  `SalonRatingID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `hairdressingsalons`
--

INSERT INTO `hairdressingsalons` (`SalonID`, `Name`, `Country`, `City`, `Address`, `PostalCode`, `ShortDescription`, `Gmail`, `PhoneNumber`, `AdministratorID`, `OpeningTimeID`, `SalonRatingID`) VALUES
(1, 'Vadora', 'Italia', 'Mestre', 'Via rossi 4', '30165', 'Siamo un nuovo salone e offriamo tante promizioni.', 'Vandora@gmail.com', '3782917334', 1, 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `openingtime`
--

CREATE TABLE `openingtime` (
  `OpeningTimeID` int(11) NOT NULL,
  `Monday` varchar(11) DEFAULT NULL,
  `Tuesday` varchar(11) DEFAULT NULL,
  `Wednesday` varchar(11) DEFAULT NULL,
  `Thursday` varchar(11) DEFAULT NULL,
  `Friday` varchar(11) DEFAULT NULL,
  `Saturday` varchar(11) DEFAULT NULL,
  `Sunday` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `openingtime`
--

INSERT INTO `openingtime` (`OpeningTimeID`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`) VALUES
(1, '8:00-21:00', '8:00-21:00', '8:00-21:00', '8:00-21:00', '8:00-21:00', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Struttura della tabella `productcategories`
--

CREATE TABLE `productcategories` (
  `ProductCategoryID` int(11) NOT NULL,
  `ProductCategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `productcategories`
--

INSERT INTO `productcategories` (`ProductCategoryID`, `ProductCategoryName`) VALUES
(1, 'Capelli'),
(2, 'Barba'),
(3, 'Unghie');

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ShortDescription` varchar(500) DEFAULT NULL,
  `PicesDisponible` int(11) DEFAULT NULL,
  `PricePerUnit` int(11) DEFAULT NULL,
  `QuantityOfProduct` int(11) DEFAULT NULL,
  `SalonID` int(11) DEFAULT NULL,
  `ProductCategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `ShortDescription`, `PicesDisponible`, `PricePerUnit`, `QuantityOfProduct`, `SalonID`, `ProductCategoryID`) VALUES
(1, 'AVON', 'Prodotto per capelli.', 20, 14, 12, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `salonratings`
--

CREATE TABLE `salonratings` (
  `SalonRatingID` int(11) NOT NULL,
  `SalonRatingNumber` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `salonratings`
--

INSERT INTO `salonratings` (`SalonRatingID`, `SalonRatingNumber`, `UserId`) VALUES
(1, 1, 1),
(2, 10, 2),
(3, 10, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `servicecategories`
--

CREATE TABLE `servicecategories` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `servicecategories`
--

INSERT INTO `servicecategories` (`ServiceID`, `ServiceName`) VALUES
(1, 'Capelli'),
(2, 'Unghie'),
(3, 'Barba');

-- --------------------------------------------------------

--
-- Struttura della tabella `servicecategorieshairdressingsalons`
--

CREATE TABLE `servicecategorieshairdressingsalons` (
  `ServiceID` int(11) NOT NULL,
  `SalonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `servicecategorieshairdressingsalons`
--

INSERT INTO `servicecategorieshairdressingsalons` (`ServiceID`, `SalonID`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `surveys`
--

CREATE TABLE `surveys` (
  `SurveyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `surveys`
--

INSERT INTO `surveys` (`SurveyID`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `Gmail` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Surname`, `Username`, `Password`, `Country`, `City`, `Address`, `PostalCode`, `Gmail`, `PhoneNumber`) VALUES
(1, 'Cristian', 'Plop', 'Cristian', 'Cristian', 'Italia', 'Mestre', 'Via Verdi 18', '30175', 'cristian@gmail.com', '38948372661'),
(2, 'Cristian', 'Plop', 'Cristian', 'Cristian', 'Italia', 'Mestre', 'Via Verdi 18', '30175', 'cristian@gmail.com', '38948372661');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`AdministratorID`);

--
-- Indici per le tabelle `bookingratings`
--
ALTER TABLE `bookingratings`
  ADD PRIMARY KEY (`BookingRatingID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indici per le tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `SalonID` (`SalonID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CategoryOptionID` (`CategoryOptionID`);

--
-- Indici per le tabelle `categoryoptions`
--
ALTER TABLE `categoryoptions`
  ADD PRIMARY KEY (`CategoryOptionID`),
  ADD KEY `ServiceID` (`ServiceID`),
  ADD KEY `SurveyID` (`SurveyID`);

--
-- Indici per le tabelle `hairdressingsalons`
--
ALTER TABLE `hairdressingsalons`
  ADD PRIMARY KEY (`SalonID`),
  ADD KEY `AdministratorID` (`AdministratorID`),
  ADD KEY `OpeningTimeID` (`OpeningTimeID`),
  ADD KEY `SalonRatingID` (`SalonRatingID`);

--
-- Indici per le tabelle `openingtime`
--
ALTER TABLE `openingtime`
  ADD PRIMARY KEY (`OpeningTimeID`);

--
-- Indici per le tabelle `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`ProductCategoryID`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SalonID` (`SalonID`),
  ADD KEY `ProductCategoryID` (`ProductCategoryID`);

--
-- Indici per le tabelle `salonratings`
--
ALTER TABLE `salonratings`
  ADD PRIMARY KEY (`SalonRatingID`),
  ADD KEY `UserId` (`UserId`);

--
-- Indici per le tabelle `servicecategories`
--
ALTER TABLE `servicecategories`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indici per le tabelle `servicecategorieshairdressingsalons`
--
ALTER TABLE `servicecategorieshairdressingsalons`
  ADD PRIMARY KEY (`ServiceID`,`SalonID`),
  ADD KEY `SalonID` (`SalonID`);

--
-- Indici per le tabelle `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`SurveyID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `administrators`
--
ALTER TABLE `administrators`
  MODIFY `AdministratorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `bookingratings`
--
ALTER TABLE `bookingratings`
  MODIFY `BookingRatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `categoryoptions`
--
ALTER TABLE `categoryoptions`
  MODIFY `CategoryOptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `hairdressingsalons`
--
ALTER TABLE `hairdressingsalons`
  MODIFY `SalonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `openingtime`
--
ALTER TABLE `openingtime`
  MODIFY `OpeningTimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `ProductCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `salonratings`
--
ALTER TABLE `salonratings`
  MODIFY `SalonRatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `servicecategories`
--
ALTER TABLE `servicecategories`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `surveys`
--
ALTER TABLE `surveys`
  MODIFY `SurveyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bookingratings`
--
ALTER TABLE `bookingratings`
  ADD CONSTRAINT `bookingratings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Limiti per la tabella `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`SalonID`) REFERENCES `hairdressingsalons` (`SalonID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`CategoryOptionID`) REFERENCES `categoryoptions` (`CategoryOptionID`);

--
-- Limiti per la tabella `categoryoptions`
--
ALTER TABLE `categoryoptions`
  ADD CONSTRAINT `categoryoptions_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `servicecategories` (`ServiceID`),
  ADD CONSTRAINT `categoryoptions_ibfk_2` FOREIGN KEY (`SurveyID`) REFERENCES `surveys` (`SurveyID`);

--
-- Limiti per la tabella `hairdressingsalons`
--
ALTER TABLE `hairdressingsalons`
  ADD CONSTRAINT `hairdressingsalons_ibfk_1` FOREIGN KEY (`AdministratorID`) REFERENCES `administrators` (`AdministratorID`),
  ADD CONSTRAINT `hairdressingsalons_ibfk_2` FOREIGN KEY (`OpeningTimeID`) REFERENCES `openingtime` (`OpeningTimeID`),
  ADD CONSTRAINT `hairdressingsalons_ibfk_3` FOREIGN KEY (`SalonRatingID`) REFERENCES `salonratings` (`SalonRatingID`);

--
-- Limiti per la tabella `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`SalonID`) REFERENCES `hairdressingsalons` (`SalonID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`ProductCategoryID`) REFERENCES `productcategories` (`ProductCategoryID`);

--
-- Limiti per la tabella `salonratings`
--
ALTER TABLE `salonratings`
  ADD CONSTRAINT `salonratings_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Limiti per la tabella `servicecategorieshairdressingsalons`
--
ALTER TABLE `servicecategorieshairdressingsalons`
  ADD CONSTRAINT `servicecategorieshairdressingsalons_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `servicecategories` (`ServiceID`),
  ADD CONSTRAINT `servicecategorieshairdressingsalons_ibfk_2` FOREIGN KEY (`SalonID`) REFERENCES `hairdressingsalons` (`SalonID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
