CREATE DATABASE IF NOT EXISTS `SmilePro` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `SmilePro`;

CREATE TABLE `Praktijkmanagment` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Beschikbaarheid` VARCHAR(100) NOT NULL,
    `IsActief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Medewerker` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `PraktijkmanagmentId` INT UNSIGNED NOT NULL,
    `Naam` VARCHAR(100) NOT NULL,
    `Functie` VARCHAR(100) NOT NULL,
    `Email` VARCHAR(254) NOT NULL,
    `Wachtwoord` VARCHAR(255) NOT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Medewerker_PraktijkmanagmentId` FOREIGN KEY (`PraktijkmanagmentId`) REFERENCES `Praktijkmanagment` (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Beschikbaar` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `PraktijkmanagmentId` INT UNSIGNED NOT NULL,
    `MedewerkerId` INT UNSIGNED NOT NULL,
    `Datum` DATE NOT NULL,
    `Starttijd` TIME NOT NULL,
    `Eindtijd` TIME NOT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Beschikbaar_PraktijkmanagmentId` FOREIGN KEY (`PraktijkmanagmentId`) REFERENCES `Praktijkmanagment` (`Id`),
    CONSTRAINT `fk_Beschikbaar_MedewerkerId` FOREIGN KEY (`MedewerkerId`) REFERENCES `Medewerker` (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Patient` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `FeedbackId` INT UNSIGNED NULL DEFAULT NULL,
    `Voornaam` VARCHAR(100) NOT NULL,
    `Achternaam` VARCHAR(100) NOT NULL,
    `Geboortedatum` DATE NOT NULL,
    `Email` VARCHAR(254) NOT NULL,
    `Wachtwoord` VARCHAR(255) NOT NULL,
    `Telefoonnummer` VARCHAR(25) NULL DEFAULT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `behandeling` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `MedewerkerId` INT UNSIGNED NOT NULL,
    `PatientId` INT UNSIGNED NOT NULL,
    `Naam` VARCHAR(100) NOT NULL,
    `Beschrijving` TEXT NULL,
    `DuurInminuten` SMALLINT UNSIGNED NOT NULL,
    `Tarief` DECIMAL(8,2) NOT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `DatumAangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_behandeling_MedewerkerId` FOREIGN KEY (`MedewerkerId`) REFERENCES `Medewerker` (`Id`),
    CONSTRAINT `fk_behandeling_PatientId` FOREIGN KEY (`PatientId`) REFERENCES `Patient` (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Afspraak` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `PatientId` INT UNSIGNED NOT NULL,
    `MedewerkerId` INT UNSIGNED NOT NULL,
    `BehandelingId` INT UNSIGNED NOT NULL,
    `StartDatumTijd` DATETIME NOT NULL,
    `EindDatumTijd` DATETIME NOT NULL,
    `Status` VARCHAR(30) NOT NULL,
    `isActief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Afspraak_PatientId` FOREIGN KEY (`PatientId`) REFERENCES `Patient` (`Id`),
    CONSTRAINT `fk_Afspraak_MedewerkerId` FOREIGN KEY (`MedewerkerId`) REFERENCES `Medewerker` (`Id`),
    CONSTRAINT `fk_Afspraak_BehandelingId` FOREIGN KEY (`BehandelingId`) REFERENCES `behandeling` (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Factuur` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `PatientId` INT UNSIGNED NOT NULL,
    `AfspraakId` INT UNSIGNED NOT NULL,
    `Factuurnummer` VARCHAR(50) NOT NULL,
    `Factuurdatum` DATE NOT NULL,
    `Vervaldatum` DATE NOT NULL,
    `totaalbedrag` DECIMAL(10,2) NOT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `DatumGewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Factuur_PatientId` FOREIGN KEY (`PatientId`) REFERENCES `Patient` (`Id`),
    CONSTRAINT `fk_Factuur_AfspraakId` FOREIGN KEY (`AfspraakId`) REFERENCES `Afspraak` (`Id`),
    UNIQUE (`Factuurnummer`)
) ENGINE=InnoDB;

CREATE TABLE `PatientMedewerker` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Medewerker` INT UNSIGNED NOT NULL,
    `Patient` INT UNSIGNED NOT NULL,
    `Isactief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `Datumaangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_PatientMedewerker_Medewerker` FOREIGN KEY (`Medewerker`) REFERENCES `Medewerker` (`Id`),
    CONSTRAINT `fk_PatientMedewerker_Patient` FOREIGN KEY (`Patient`) REFERENCES `Patient` (`Id`)
) ENGINE=InnoDB;

CREATE TABLE `Feedback` (
    `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `PatientId` INT UNSIGNED NOT NULL,
    `AfspraakId` INT UNSIGNED NOT NULL,
    `Rating` TINYINT UNSIGNED NOT NULL,
    `Bericht` TEXT NULL,
    `IsActief` BOOLEAN NOT NULL DEFAULT 1,
    `Opmerkingen` TEXT NULL,
    `DatumAangemaakt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Datumgewijzigd` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Feedback_PatientId` FOREIGN KEY (`PatientId`) REFERENCES `Patient` (`Id`),
    CONSTRAINT `fk_Feedback_AfspraakId` FOREIGN KEY (`AfspraakId`) REFERENCES `Afspraak` (`Id`)
) ENGINE=InnoDB;

-- Voeg deze relatie toe nadat beide tabellen bestaan.
ALTER TABLE `Patient`
    ADD CONSTRAINT `fk_Patient_FeedbackId` FOREIGN KEY (`FeedbackId`) REFERENCES `Feedback` (`Id`);
