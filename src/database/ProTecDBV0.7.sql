-- MySQL Script generated by MySQL Workbench
-- Tue Jan 12 15:30:18 2021
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
  `eMail` VARCHAR(150) NULL,
  PRIMARY KEY (`customerID`),
  UNIQUE INDEX `CustID_UNIQUE` (`customerID` ASC));


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
  `payDetailsID` INT NOT NULL AUTO_INCREMENT,
  `billingAddressID` INT NOT NULL,
  `customerID` INT NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` ENUM('IBAN', 'PayPal', 'Invoice') NOT NULL,
  `paymentNumber` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`payDetailsID`, `billingAddressID`, `customerID`),
  UNIQUE INDEX `Paymentid_UNIQUE` (`payDetailsID` ASC),
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
  `custID` INT NOT NULL,
  `shippingAddressID` INT NOT NULL,
  PRIMARY KEY (`purchaseID`, `custID`, `shippingAddressID`),
  INDEX `fk_Purchases_Customers1_idx` (`custID` ASC),
  INDEX `fk_Purchases_Address1_idx` (`shippingAddressID` ASC),
  CONSTRAINT `fk_Purchases_Customers1`
    FOREIGN KEY (`custID`)
    REFERENCES `protecdb`.`Customer` (`customerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Purchases_Address1`
    FOREIGN KEY (`shippingAddressID`)
    REFERENCES `protecdb`.`Address` (`addressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `protecdb`.`ProductBasket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `protecdb`.`ProductBasket` (
  `productBasketID` INT NOT NULL,
  `quantityWanted` INT NOT NULL,
  `productID` INT NOT NULL,
  PRIMARY KEY (`productBasketID`, `productID`),
  INDEX `fk_ProductBasket_Purchases1_idx` (`productBasketID` ASC),
  INDEX `fk_ProductBasket_Products1_idx` (`productID` ASC),
  UNIQUE INDEX `ProductID_UNIQUE` (`productID` ASC),
  CONSTRAINT `fk_ProductBasket_Purchases1`
    FOREIGN KEY (`productBasketID`)
    REFERENCES `protecdb`.`Purchase` (`purchaseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductBasket_Products1`
    FOREIGN KEY (`productID`)
    REFERENCES `protecdb`.`Product` (`productID`)
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
