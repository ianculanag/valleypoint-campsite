-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema valleypoint
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema valleypoint
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `valleypoint` DEFAULT CHARACTER SET utf8 ;
USE `valleypoint` ;

-- -----------------------------------------------------
-- Table `valleypoint`.`units`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`units` (
  `unitID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unitNumber` VARCHAR(10) NOT NULL,
  `unitType` VARCHAR(20) NOT NULL DEFAULT 'room',
  `capacity` INT NOT NULL,
  `status` VARCHAR(15) NOT NULL DEFAULT 'unoccupied',
  PRIMARY KEY (`unitID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`accommodation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`accommodation` (
  `accommodationID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `accommodationType` VARCHAR(20) NOT NULL,
  `price` DOUBLE NOT NULL DEFAULT 00.00,
  `paymentStatus` VARCHAR(20) NULL DEFAULT 'pending',
  `staffID` INT UNSIGNED NOT NULL,
  `unitID` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`accommodationID`),
  CONSTRAINT `staffID`
    FOREIGN KEY (`staffID`)
    REFERENCES `valleypoint`.`staff` (`staffID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `unitID`
    FOREIGN KEY (`unitID`)
    REFERENCES `valleypoint`.`units` (`unitID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`guests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`guests` (
  `guestID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lastName` VARCHAR(30) NOT NULL,
  `firstName` VARCHAR(30) NOT NULL,
  `contactNumber` VARCHAR(11) NOT NULL,
  `numberOfPax` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`guestID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`staff` (
  `staffID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(40) NOT NULL,
  `password` VARCHAR(30) NOT NULL DEFAULT 'password',
  `lastName` VARCHAR(30) NOT NULL,
  `firstName` VARCHAR(30) NOT NULL,
  `role` VARCHAR(20) NOT NULL,
  `contactNumber` VARCHAR(11) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`staffID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`sales` (
  `salesID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `paymentDatetime` DATETIME NOT NULL,
  `amount` DOUBLE NOT NULL,
  `paymentCategory` VARCHAR(30) NOT NULL,
  `orderID` INT UNSIGNED NOT NULL,
  `accommodationID` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`salesID`),
  CONSTRAINT `orderID`
    FOREIGN KEY (`orderID`)
    REFERENCES `valleypoint`.`orders` (`orderID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `accommodationID`
    FOREIGN KEY (`accommodationID`)
    REFERENCES `valleypoint`.`accommodation` (`accommodationID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`shifts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`shifts` (
  `shiftID` INT UNSIGNED NOT NULL auto_increment,
  `shiftStart` DATETIME NOT NULL,
  `shiftEnd` DATETIME NOT NULL,
  `cashStart` DOUBLE NOT NULL DEFAULT 00.00,
  `staffID` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`shiftID`),
  CONSTRAINT `shifts`.`staffID`
    FOREIGN KEY (`staffID`)
    REFERENCES `valleypoint`.`staff` (`staffID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`orders` (
  `orderID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderNumber` INT NOT NULL,
  `paymentStatus` VARCHAR(20) NULL DEFAULT 'pending',
  `orderDatetime` DATETIME NOT NULL,
  `productID` INT UNSIGNED NOT NULL,
  `shiftID` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`orderID`),
  CONSTRAINT `productID`
    FOREIGN KEY (`productID`)
    REFERENCES `valleypoint`.`products` (`productID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `shiftID`
    FOREIGN KEY (`shiftID`)
    REFERENCES `valleypoint`.`shifts` (`shiftID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`products` (
  `productID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(45) NOT NULL,
  `productType` VARCHAR(10) NOT NULL,
  `price` DOUBLE NOT NULL DEFAULT 00.00,
  PRIMARY KEY (`productID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`recipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`recipe` (
  `productID` INT UNSIGNED NOT NULL,
  `ingredientID` INT UNSIGNED NOT NULL,
  `quantity` DOUBLE NOT NULL DEFAULT 00.00,
  PRIMARY KEY (`productID`,`ingredientID`),
  CONSTRAINT `recipe`.`productID`
    FOREIGN KEY (`productID`)
    REFERENCES `valleypoint`.`products` (`productID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `recipe`.`ingredientID`
    FOREIGN KEY (`ingredientID`)
    REFERENCES `valleypoint`.`ingredients` (`ingredientID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`ingredients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`ingredients` (
  `ingredientID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredientName` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`ingredientID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`gueststay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`gueststay` (
  `guestID` INT UNSIGNED NOT NULL,
  `accommodationID` INT UNSIGNED NOT NULL,
  `checkinDatetime` DATETIME NOT NULL,
  `checkoutDatetime` DATETIME NOT NULL,
  PRIMARY KEY (`guestID`, `accommodationID`),
  CONSTRAINT `gueststay`.`accommodationID`
    FOREIGN KEY (`accommodationID`)
    REFERENCES `valleypoint`.`accommodation` (`accommodationID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `gueststay`.`guestID`
    FOREIGN KEY (`guestID`)
    REFERENCES `valleypoint`.`guests` (`guestID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`items` (
  `orderID` INT UNSIGNED NOT NULL,
  `productID` INT UNSIGNED NOT NULL,
  `quantity` INT NOT NULL,
  `unitPrice` DOUBLE NOT NULL,
  PRIMARY KEY (`orderID`, `productID`),
  CONSTRAINT `items`.`orderID`
    FOREIGN KEY (`orderID`)
    REFERENCES `valleypoint`.`orders` (`orderID`)
    ON DELETE restrict
    ON UPDATE cascade,
  CONSTRAINT `items`.`productID`
    FOREIGN KEY (`productID`)
    REFERENCES `valleypoint`.`products` (`productID`)
	ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`food`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`food` (
  `productID` INT UNSIGNED NOT NULL,
  `foodCategory` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`productID`),
  CONSTRAINT `food`.`productID`
    FOREIGN KEY (`productID`)
    REFERENCES `valleypoint`.`products` (`productID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `valleypoint`.`beverages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `valleypoint`.`beverages` (
  `productID` INT UNSIGNED NOT NULL,
  `drinkSize` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`productID`),
  CONSTRAINT `beverages`.`productID`
    FOREIGN KEY (`productID`)
    REFERENCES `valleypoint`.`products` (`productID`)
    ON DELETE restrict
    ON UPDATE cascade)
ENGINE = InnoDB;

USE `valleypoint`;

DELIMITER $$
USE `valleypoint`$$
CREATE DEFINER = CURRENT_USER TRIGGER `valleypoint`.`units_BEFORE_INSERT` BEFORE INSERT ON `units` FOR EACH ROW
BEGIN

END
$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
