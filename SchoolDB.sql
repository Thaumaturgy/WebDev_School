-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema school
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema school
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `school` DEFAULT CHARACTER SET utf8 ;
USE `school` ;

-- -----------------------------------------------------
-- Table `school`.`account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`account` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `uname` VARCHAR(20) NULL DEFAULT NULL,
  `pword` VARCHAR(256) NULL DEFAULT NULL,
  `description` VARCHAR(120) NULL DEFAULT NULL,
  `active` CHAR(1) NULL DEFAULT NULL,
  `permitstudent` CHAR(4) NULL DEFAULT NULL,
  `permitprogram` CHAR(6) NULL DEFAULT NULL,
  `permitsubject` CHAR(3) NULL DEFAULT NULL,
  `permitnationality` CHAR(3) NULL DEFAULT NULL,
  `permitreligion` CHAR(3) NULL DEFAULT NULL,
  `permitaccounts` CHAR(3) NULL DEFAULT NULL,
  `permitgrades` CHAR(3) NULL DEFAULT NULL,
  `addedon` TIMESTAMP NULL DEFAULT NULL,
  `addedby_id` INT(11) NULL DEFAULT NULL,
  `modifiedon` DATETIME NULL DEFAULT NULL,
  `modifiedby_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `school`.`program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`program` (
  `code` VARCHAR(60) NULL DEFAULT NULL,
  `title` VARCHAR(120) NULL DEFAULT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `year` TINYINT(4) NULL DEFAULT '4',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`subject` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(20) NULL DEFAULT NULL,
  `title` VARCHAR(120) NULL DEFAULT NULL,
  `unit` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 201
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`curriculum`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`curriculum` (
  `yeartaken` TINYINT(4) NULL DEFAULT NULL,
  `semester` TINYINT(4) NULL DEFAULT NULL,
  `ismajor` TINYINT(4) NULL DEFAULT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `program_id` INT(11) NULL DEFAULT NULL,
  `subject_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `program_id` (`program_id` ASC),
  INDEX `subject_id` (`subject_id` ASC),
  CONSTRAINT `curriculum_ibfk_1`
    FOREIGN KEY (`program_id`)
    REFERENCES `school`.`program` (`id`),
  CONSTRAINT `curriculum_ibfk_2`
    FOREIGN KEY (`subject_id`)
    REFERENCES `school`.`subject` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 200
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`grade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`grade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `student_id` INT(11) NOT NULL,
  `subject_id` INT(11) NOT NULL,
  `schoolyear` INT(11) NOT NULL,
  `semester` TINYINT(4) NOT NULL,
  `grade` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 20200
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`nationality`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`nationality` (
  `name` VARCHAR(60) NULL DEFAULT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`religion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`religion` (
  `name` VARCHAR(60) NULL DEFAULT NULL,
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `school`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`student` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lastname` VARCHAR(60) NULL DEFAULT NULL,
  `firstname` VARCHAR(60) NULL DEFAULT NULL,
  `middlename` VARCHAR(60) NULL DEFAULT NULL,
  `gender` TINYINT(4) NULL DEFAULT NULL,
  `birthdate` DATETIME NULL DEFAULT NULL,
  `program_id` INT(11) NULL DEFAULT NULL,
  `religion_id` INT(11) NULL DEFAULT NULL,
  `nationality_id` INT(11) NULL DEFAULT NULL,
  `regular` TINYINT(4) NULL DEFAULT NULL,
  `yearstatus` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `program_id` (`program_id` ASC),
  INDEX `religion_id` (`religion_id` ASC),
  INDEX `nationality_id` (`nationality_id` ASC),
  CONSTRAINT `student_ibfk_1`
    FOREIGN KEY (`program_id`)
    REFERENCES `school`.`program` (`id`),
  CONSTRAINT `student_ibfk_2`
    FOREIGN KEY (`religion_id`)
    REFERENCES `school`.`religion` (`id`),
  CONSTRAINT `student_ibfk_3`
    FOREIGN KEY (`nationality_id`)
    REFERENCES `school`.`nationality` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2728
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
