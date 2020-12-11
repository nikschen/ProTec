-- MySQL Script generated by MySQL Workbench
-- Fri Dec 11 10:18:01 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Customers` (
  `custID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `birthDate` DATE NOT NULL,
  `eMail` VARCHAR(150) NULL,
  PRIMARY KEY (`custID`),
  UNIQUE INDEX `CustID_UNIQUE` (`custID` ASC));


-- -----------------------------------------------------
-- Table `mydb`.`Address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Address` (
  `addressID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `street` VARCHAR(255) NOT NULL,
  `streetNumber` VARCHAR(10) NOT NULL,
  `zipCode` VARCHAR(12) NOT NULL,
  `city` VARCHAR(60) NOT NULL,
  `country` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`addressID`),
  UNIQUE INDEX `AddressID_UNIQUE` (`addressID` ASC));


-- -----------------------------------------------------
-- Table `mydb`.`Products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Products` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `quantityStored` VARCHAR(45) NULL,
  `prodName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE INDEX `ProdName_UNIQUE` (`prodName` ASC));


-- -----------------------------------------------------
-- Table `mydb`.`Pricing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pricing` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `amount` DECIMAL(7,2) UNSIGNED NOT NULL,
  `Currency` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productID`),
  INDEX `fk_Pricing_Products1_idx` (`productID` ASC),
  CONSTRAINT `fk_Pricing_Products1`
    FOREIGN KEY (`productID`)
    REFERENCES `mydb`.`Products` (`productID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`PayDetails`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`PayDetails` (
  `paymentID` INT NOT NULL AUTO_INCREMENT,
  `billingAddressID` INT NOT NULL,
  `customer_ID` INT NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` VARCHAR(45) NOT NULL,
  `paymentNumber` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`paymentID`, `billingAddressID`, `customer_ID`),
  UNIQUE INDEX `Paymentid_UNIQUE` (`paymentID` ASC),
  INDEX `fk_PayDetails_Customer_idx` (`customer_ID` ASC),
  INDEX `fk_PayDetails_Address1_idx` (`billingAddressID` ASC),
  UNIQUE INDEX `PaymentMethod_UNIQUE` (`paymentMethod` ASC),
  UNIQUE INDEX `PaymentNumber_UNIQUE` (`paymentNumber` ASC),
  CONSTRAINT `fk_PayDetails_Customer`
    FOREIGN KEY (`customer_ID`)
    REFERENCES `mydb`.`Customers` (`custID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PayDetails_Address1`
    FOREIGN KEY (`billingAddressID`)
    REFERENCES `mydb`.`Address` (`addressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`Purchases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Purchases` (
  `purchaseID` INT NOT NULL AUTO_INCREMENT,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `custID` INT NOT NULL,
  `shippingAddressID` INT NOT NULL,
  `productBaskedID` INT NOT NULL,
  PRIMARY KEY (`purchaseID`, `custID`, `shippingAddressID`),
  INDEX `fk_Purchases_Customers1_idx` (`custID` ASC),
  INDEX `fk_Purchases_Address1_idx` (`shippingAddressID` ASC),
  UNIQUE INDEX `ProductBaskedID_UNIQUE` (`productBaskedID` ASC),
  CONSTRAINT `fk_Purchases_Customers1`
    FOREIGN KEY (`custID`)
    REFERENCES `mydb`.`Customers` (`custID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Purchases_Address1`
    FOREIGN KEY (`shippingAddressID`)
    REFERENCES `mydb`.`Address` (`addressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`ProductBaskets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ProductBaskets` (
  `purchaseID` INT NOT NULL,
  `quantityWanted` INT NOT NULL,
  `productID` INT NOT NULL,
  PRIMARY KEY (`purchaseID`, `productID`),
  INDEX `fk_ProductBasket_Purchases1_idx` (`purchaseID` ASC),
  INDEX `fk_ProductBasket_Products1_idx` (`productID` ASC),
  UNIQUE INDEX `ProductID_UNIQUE` (`productID` ASC),
  CONSTRAINT `fk_ProductBasket_Purchases1`
    FOREIGN KEY (`purchaseID`)
    REFERENCES `mydb`.`Purchases` (`purchaseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductBasket_Products1`
    FOREIGN KEY (`productID`)
    REFERENCES `mydb`.`Products` (`productID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
