-- MySQL Script generated by MySQL Workbench
-- Tue Feb 23 19:36:57 2021
-- Model: Protec    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema protecdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema protecdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `protecdb` DEFAULT CHARACTER SET utf8 ;
USE `protecdb` ;

-- -----------------------------------------------------
-- Table `protecdb`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Customer` (
  `customerID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(100) NOT NULL,
  `birthDate` DATE NOT NULL,
  `eMail` VARCHAR(150) NOT NULL,
  `addressID` INT NOT NULL,
  PRIMARY KEY (`customerID`),
  UNIQUE INDEX `CustID_UNIQUE` (`customerID` ASC),
  UNIQUE INDEX `eMail_UNIQUE` (`eMail` ASC));


-- -----------------------------------------------------
-- Table `protecdb`.`Address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Address` (
  `addressID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `street` VARCHAR(255) NOT NULL,
  `streetNumber` VARCHAR(10) NOT NULL,
  `zipCode` VARCHAR(12) NOT NULL,
  `city` VARCHAR(60) NOT NULL,
  `country` VARCHAR(60) NOT NULL,
  `additionalInformation` VARCHAR(60) NULL,
  `phone` VARCHAR(60) NULL,
  UNIQUE INDEX `AddressID_UNIQUE` (`addressID` ASC),
  PRIMARY KEY (`addressID`));


-- -----------------------------------------------------
-- Table `protecdb`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Product` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `quantityStored` INT NULL,
  `prodName` VARCHAR(100) NOT NULL,
  `prodDescription` VARCHAR(10000) NULL,
  `category` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE INDEX `ProdName_UNIQUE` (`prodName` ASC));


-- -----------------------------------------------------
-- Table `protecdb`.`Pricing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Pricing` (
  `pricingID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `amount` DECIMAL(7,2) UNSIGNED NOT NULL,
  `currency` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`pricingID`),
  INDEX `fk_Pricing_Products1_idx` (`pricingID` ASC),
  CONSTRAINT `fk_Pricing_Products1`
    FOREIGN KEY (`pricingID`)
    REFERENCES `protecdb`.`Product` (`productID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `protecdb`.`PayDetail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`PayDetail` (
  `payDetailID` INT NOT NULL AUTO_INCREMENT,
  `billingAddressID` INT NOT NULL,
  `customerID` INT NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` ENUM('IBAN', 'PayPal', 'Invoice') NOT NULL,
  `paymentNumber` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`payDetailID`, `billingAddressID`, `customerID`),
  UNIQUE INDEX `Paymentid_UNIQUE` (`payDetailID` ASC),
  INDEX `fk_PayDetails_Customer_idx` (`customerID` ASC),
  INDEX `fk_PayDetails_Address1_idx` (`billingAddressID` ASC),
  UNIQUE INDEX `PaymentNumber_UNIQUE` (`paymentNumber` ASC),
  CONSTRAINT `fk_PayDetails_Customer`
    FOREIGN KEY (`customerID`)
    REFERENCES `protecdb`.`Customer` (`customerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PayDetails_Address1`
    FOREIGN KEY (`billingAddressID`)
    REFERENCES `protecdb`.`Address` (`addressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `protecdb`.`Purchase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Purchase` (
  `purchaseID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `customerID` INT NOT NULL,
  `shippingAddressID` INT NOT NULL,
  `payDetailID` INT NOT NULL,
  PRIMARY KEY (`purchaseID`),
  INDEX `fk_Purchases_Customers1_idx` (`customerID` ASC),
  INDEX `fk_Purchases_Address1_idx` (`shippingAddressID` ASC),
  INDEX `fk_Purchase_PayDetail1_idx` (`payDetailID` ASC),
  CONSTRAINT `fk_Purchases_Customers1`
    FOREIGN KEY (`customerID`)
    REFERENCES `protecdb`.`Customer` (`customerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Purchases_Address1`
    FOREIGN KEY (`shippingAddressID`)
    REFERENCES `protecdb`.`Address` (`addressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Purchase_PayDetail1`
    FOREIGN KEY (`payDetailID`)
    REFERENCES `protecdb`.`PayDetail` (`payDetailID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `protecdb`.`Account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`Account` (
  `accountID` INT NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `username` VARCHAR(150) NOT NULL,
  `passwordHash` VARCHAR(255) NOT NULL,
  `validated` TINYINT(1) NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_Accounts_Customers1_idx` (`accountID` ASC),
  CONSTRAINT `fk_Accounts_Customers1`
    FOREIGN KEY (`accountID`)
    REFERENCES `protecdb`.`Customer` (`customerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `protecdb`.`ProductBasketEntry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`ProductBasketEntry` (
  `productBasketEntryID` INT NOT NULL AUTO_INCREMENT,
  `productID` INT NOT NULL,
  `quantityWanted` VARCHAR(45) NOT NULL,
  `purchaseID` INT NOT NULL,
  PRIMARY KEY (`productBasketEntryID`),
  INDEX `fk_ProductBasketEntry_Product1_idx` (`productID` ASC),
  INDEX `fk_ProductBasketEntry_Purchase1_idx` (`purchaseID` ASC),
  UNIQUE INDEX `productID_UNIQUE` (`productID` ASC),
  UNIQUE INDEX `purchaseID_UNIQUE` (`purchaseID` ASC),
  CONSTRAINT `fk_ProductBasketEntry_Product1`
    FOREIGN KEY (`productID`)
    REFERENCES `protecdb`.`Product` (`productID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductBasketEntry_Purchase1`
    FOREIGN KEY (`purchaseID`)
    REFERENCES `protecdb`.`Purchase` (`purchaseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
