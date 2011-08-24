SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`URLs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`URLs` (
  `idURLs` INT NOT NULL AUTO_INCREMENT ,
  `url` TEXT NOT NULL ,
  PRIMARY KEY (`idURLs`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Tags` (
  `idTags` INT NOT NULL AUTO_INCREMENT ,
  `name` TINYTEXT NOT NULL ,
  PRIMARY KEY (`idTags`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`URLs_has_Tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`URLs_has_Tags` (
  `URLs_idURLs` INT NOT NULL ,
  `Tags_idTags` INT NOT NULL ,
  PRIMARY KEY (`URLs_idURLs`, `Tags_idTags`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ContentTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ContentTypes` (
  `idContentTypes` INT NOT NULL AUTO_INCREMENT ,
  `type` TINYTEXT NOT NULL ,
  `subtype` TINYTEXT NOT NULL ,
  PRIMARY KEY (`idContentTypes`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Captures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Captures` (
  `dateID` INT NOT NULL ,
  `URLs_idURLs` INT NOT NULL ,
  `date` INT NOT NULL ,
  `hash` BINARY(20) NOT NULL ,
  `statusCode` INT NOT NULL DEFAULT 200 ,
  `isModified` TINYINT(1)  NOT NULL ,
  `size` INT NOT NULL ,
  `ContentTypes_idContentTypes` INT NOT NULL ,
  PRIMARY KEY (`dateID`, `URLs_idURLs`, `ContentTypes_idContentTypes`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
