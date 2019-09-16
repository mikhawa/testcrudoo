-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema testcrudoo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema testcrudoo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `testcrudoo` DEFAULT CHARACTER SET utf8 ;
USE `testcrudoo` ;

-- -----------------------------------------------------
-- Table `testcrudoo`.`theroles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`theroles` (
  `idtheroles` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `therolesname` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idtheroles`),
  UNIQUE INDEX `therolesname_UNIQUE` (`therolesname` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`theuser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`theuser` (
  `idtheuser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theuserlogin` VARCHAR(45) NOT NULL,
  `theuserpwd` VARCHAR(45) NOT NULL,
  `theroles_idtheroles` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idtheuser`),
  UNIQUE INDEX `theuserlogin_UNIQUE` (`theuserlogin` ASC),
  INDEX `fk_theuser_theroles_idx` (`theroles_idtheroles` ASC),
  CONSTRAINT `fk_theuser_theroles`
    FOREIGN KEY (`theroles_idtheroles`)
    REFERENCES `testcrudoo`.`theroles` (`idtheroles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`andrecateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`andrecateg` (
  `idandrecateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categname` VARCHAR(60) NOT NULL,
  `categdesc` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`idandrecateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`andrearticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`andrearticle` (
  `idandrearticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thetitle` VARCHAR(130) NOT NULL,
  `thetext` TEXT NOT NULL,
  `thedate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idandrearticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`andrecateg_has_andrearticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`andrecateg_has_andrearticle` (
  `andrecateg_idandrecateg` INT UNSIGNED NOT NULL,
  `andrearticle_idandrearticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`andrecateg_idandrecateg`, `andrearticle_idandrearticle`),
  INDEX `fk_andrecateg_has_andrearticle_andrearticle1_idx` (`andrearticle_idandrearticle` ASC),
  INDEX `fk_andrecateg_has_andrearticle_andrecateg1_idx` (`andrecateg_idandrecateg` ASC),
  CONSTRAINT `fk_andrecateg_has_andrearticle_andrecateg1`
    FOREIGN KEY (`andrecateg_idandrecateg`)
    REFERENCES `testcrudoo`.`andrecateg` (`idandrecateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_andrecateg_has_andrearticle_andrearticle1`
    FOREIGN KEY (`andrearticle_idandrearticle`)
    REFERENCES `testcrudoo`.`andrearticle` (`idandrearticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`bogdancateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`bogdancateg` (
  `idbogdancateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bogdancategnom` VARCHAR(50) NOT NULL,
  `bogdancategtexte` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`idbogdancateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`bogdanarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`bogdanarticle` (
  `idbogdanarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(100) NOT NULL,
  `texte` TEXT NOT NULL,
  `ladate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idbogdanarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`bogdancateg_has_bogdanarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`bogdancateg_has_bogdanarticle` (
  `bogdancateg_idbogdancateg` INT UNSIGNED NOT NULL,
  `bogdanarticle_idbogdanarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`bogdancateg_idbogdancateg`, `bogdanarticle_idbogdanarticle`),
  INDEX `fk_bogdancateg_has_bogdanarticle_bogdanarticle1_idx` (`bogdanarticle_idbogdanarticle` ASC),
  INDEX `fk_bogdancateg_has_bogdanarticle_bogdancateg1_idx` (`bogdancateg_idbogdancateg` ASC),
  CONSTRAINT `fk_bogdancateg_has_bogdanarticle_bogdancateg1`
    FOREIGN KEY (`bogdancateg_idbogdancateg`)
    REFERENCES `testcrudoo`.`bogdancateg` (`idbogdancateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bogdancateg_has_bogdanarticle_bogdanarticle1`
    FOREIGN KEY (`bogdanarticle_idbogdanarticle`)
    REFERENCES `testcrudoo`.`bogdanarticle` (`idbogdanarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`dimitricateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`dimitricateg` (
  `iddimitricateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dimitricategthetitle` VARCHAR(80) NOT NULL,
  `dimitricategthedesc` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`iddimitricateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`dimitriarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`dimitriarticle` (
  `iddimitriarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dimitriarticletitle` VARCHAR(110) NOT NULL,
  `dimitriarticletext` TEXT NOT NULL,
  `dimitriarticledate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddimitriarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`dimitricateg_has_dimitriarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`dimitricateg_has_dimitriarticle` (
  `dimitricateg_iddimitricateg` INT UNSIGNED NOT NULL,
  `dimitriarticle_iddimitriarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`dimitricateg_iddimitricateg`, `dimitriarticle_iddimitriarticle`),
  INDEX `fk_dimitricateg_has_dimitriarticle_dimitriarticle1_idx` (`dimitriarticle_iddimitriarticle` ASC),
  INDEX `fk_dimitricateg_has_dimitriarticle_dimitricateg1_idx` (`dimitricateg_iddimitricateg` ASC),
  CONSTRAINT `fk_dimitricateg_has_dimitriarticle_dimitricateg1`
    FOREIGN KEY (`dimitricateg_iddimitricateg`)
    REFERENCES `testcrudoo`.`dimitricateg` (`iddimitricateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dimitricateg_has_dimitriarticle_dimitriarticle1`
    FOREIGN KEY (`dimitriarticle_iddimitriarticle`)
    REFERENCES `testcrudoo`.`dimitriarticle` (`iddimitriarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`geoffreycateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`geoffreycateg` (
  `idgeoffreycateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categnom` VARCHAR(55) NOT NULL,
  `categtext` TEXT NOT NULL,
  PRIMARY KEY (`idgeoffreycateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`geoffreyarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`geoffreyarticle` (
  `idgeoffreyarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `geoffreytitle` VARCHAR(105) NOT NULL,
  `geoffreytext` TEXT NOT NULL,
  `geoffreydate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idgeoffreyarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`geoffreycateg_has_geoffreyarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`geoffreycateg_has_geoffreyarticle` (
  `geoffreycateg_idgeoffreycateg` INT UNSIGNED NOT NULL,
  `geoffreyarticle_idgeoffreyarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`geoffreycateg_idgeoffreycateg`, `geoffreyarticle_idgeoffreyarticle`),
  INDEX `fk_geoffreycateg_has_geoffreyarticle_geoffreyarticle1_idx` (`geoffreyarticle_idgeoffreyarticle` ASC),
  INDEX `fk_geoffreycateg_has_geoffreyarticle_geoffreycateg1_idx` (`geoffreycateg_idgeoffreycateg` ASC),
  CONSTRAINT `fk_geoffreycateg_has_geoffreyarticle_geoffreycateg1`
    FOREIGN KEY (`geoffreycateg_idgeoffreycateg`)
    REFERENCES `testcrudoo`.`geoffreycateg` (`idgeoffreycateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_geoffreycateg_has_geoffreyarticle_geoffreyarticle1`
    FOREIGN KEY (`geoffreyarticle_idgeoffreyarticle`)
    REFERENCES `testcrudoo`.`geoffreyarticle` (`idgeoffreyarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jbcateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jbcateg` (
  `idjbcateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jbcategname` VARCHAR(65) NOT NULL,
  `jbcategdescription` TEXT NOT NULL,
  PRIMARY KEY (`idjbcateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jbarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jbarticle` (
  `idjbarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jbarticletitle` VARCHAR(115) NOT NULL,
  `jbarticletxt` TEXT NOT NULL,
  `jbdate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idjbarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jbcateg_has_jbarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jbcateg_has_jbarticle` (
  `jbcateg_idjbcateg` INT UNSIGNED NOT NULL,
  `jbarticle_idjbarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`jbcateg_idjbcateg`, `jbarticle_idjbarticle`),
  INDEX `fk_jbcateg_has_jbarticle_jbarticle1_idx` (`jbarticle_idjbarticle` ASC),
  INDEX `fk_jbcateg_has_jbarticle_jbcateg1_idx` (`jbcateg_idjbcateg` ASC),
  CONSTRAINT `fk_jbcateg_has_jbarticle_jbcateg1`
    FOREIGN KEY (`jbcateg_idjbcateg`)
    REFERENCES `testcrudoo`.`jbcateg` (`idjbcateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jbcateg_has_jbarticle_jbarticle1`
    FOREIGN KEY (`jbarticle_idjbarticle`)
    REFERENCES `testcrudoo`.`jbarticle` (`idjbarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jilliancateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jilliancateg` (
  `idjilliancateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jilliancategnom` VARCHAR(60) NOT NULL,
  `jilliancategtexte` TEXT NOT NULL,
  PRIMARY KEY (`idjilliancateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jillianarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jillianarticle` (
  `idjillianarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jillianarticletitre` VARCHAR(135) NOT NULL,
  `jillianarticletxt` TEXT NOT NULL,
  `jillianarticletemps` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idjillianarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`jilliancateg_has_jillianarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`jilliancateg_has_jillianarticle` (
  `jilliancateg_idjilliancateg` INT UNSIGNED NOT NULL,
  `jillianarticle_idjillianarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`jilliancateg_idjilliancateg`, `jillianarticle_idjillianarticle`),
  INDEX `fk_jilliancateg_has_jillianarticle_jillianarticle1_idx` (`jillianarticle_idjillianarticle` ASC),
  INDEX `fk_jilliancateg_has_jillianarticle_jilliancateg1_idx` (`jilliancateg_idjilliancateg` ASC),
  CONSTRAINT `fk_jilliancateg_has_jillianarticle_jilliancateg1`
    FOREIGN KEY (`jilliancateg_idjilliancateg`)
    REFERENCES `testcrudoo`.`jilliancateg` (`idjilliancateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jilliancateg_has_jillianarticle_jillianarticle1`
    FOREIGN KEY (`jillianarticle_idjillianarticle`)
    REFERENCES `testcrudoo`.`jillianarticle` (`idjillianarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`oumarcateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`oumarcateg` (
  `idoumarcateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `oumarcategthename` VARCHAR(65) NOT NULL,
  `oumarcategthdesc` VARCHAR(495) NOT NULL,
  PRIMARY KEY (`idoumarcateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`oumararticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`oumararticle` (
  `idoumararticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `oumararticletitle` VARCHAR(125) NOT NULL,
  `oumararticletexte` TEXT NOT NULL,
  `oumararticletemps` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idoumararticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`oumarcateg_has_oumararticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`oumarcateg_has_oumararticle` (
  `oumarcateg_idoumarcateg` INT UNSIGNED NOT NULL,
  `oumararticle_idoumararticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`oumarcateg_idoumarcateg`, `oumararticle_idoumararticle`),
  INDEX `fk_oumarcateg_has_oumararticle_oumararticle1_idx` (`oumararticle_idoumararticle` ASC),
  INDEX `fk_oumarcateg_has_oumararticle_oumarcateg1_idx` (`oumarcateg_idoumarcateg` ASC),
  CONSTRAINT `fk_oumarcateg_has_oumararticle_oumarcateg1`
    FOREIGN KEY (`oumarcateg_idoumarcateg`)
    REFERENCES `testcrudoo`.`oumarcateg` (`idoumarcateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_oumarcateg_has_oumararticle_oumararticle1`
    FOREIGN KEY (`oumararticle_idoumararticle`)
    REFERENCES `testcrudoo`.`oumararticle` (`idoumararticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`stephanecateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`stephanecateg` (
  `idstephanecateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `stephanecategintitule` VARCHAR(70) NOT NULL,
  `stephanecategdesc` VARCHAR(450) NOT NULL,
  PRIMARY KEY (`idstephanecateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`stephanearticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`stephanearticle` (
  `idstephanearticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `stephanearticletitre` VARCHAR(120) NOT NULL,
  `stephanearticletext` TEXT NOT NULL,
  `stephanearticledatetime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idstephanearticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`stephanecateg_has_stephanearticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`stephanecateg_has_stephanearticle` (
  `stephanecateg_idstephanecateg` INT UNSIGNED NOT NULL,
  `stephanearticle_idstephanearticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`stephanecateg_idstephanecateg`, `stephanearticle_idstephanearticle`),
  INDEX `fk_stephanecateg_has_stephanearticle_stephanearticle1_idx` (`stephanearticle_idstephanearticle` ASC),
  INDEX `fk_stephanecateg_has_stephanearticle_stephanecateg1_idx` (`stephanecateg_idstephanecateg` ASC),
  CONSTRAINT `fk_stephanecateg_has_stephanearticle_stephanecateg1`
    FOREIGN KEY (`stephanecateg_idstephanecateg`)
    REFERENCES `testcrudoo`.`stephanecateg` (`idstephanecateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stephanecateg_has_stephanearticle_stephanearticle1`
    FOREIGN KEY (`stephanearticle_idstephanearticle`)
    REFERENCES `testcrudoo`.`stephanearticle` (`idstephanearticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`tarekcateg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`tarekcateg` (
  `idtarekcateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tarekcategtitle` VARCHAR(55) NOT NULL,
  `tarekcategtext` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`idtarekcateg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`tarekarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`tarekarticle` (
  `idtarekarticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tarekarticletitle` VARCHAR(130) NOT NULL,
  `tarekarticletexte` TEXT NOT NULL,
  `tarekarticletemps` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idtarekarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `testcrudoo`.`tarekcateg_has_tarekarticle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testcrudoo`.`tarekcateg_has_tarekarticle` (
  `tarekcateg_idtarekcateg` INT UNSIGNED NOT NULL,
  `tarekarticle_idtarekarticle` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`tarekcateg_idtarekcateg`, `tarekarticle_idtarekarticle`),
  INDEX `fk_tarekcateg_has_tarekarticle_tarekarticle1_idx` (`tarekarticle_idtarekarticle` ASC),
  INDEX `fk_tarekcateg_has_tarekarticle_tarekcateg1_idx` (`tarekcateg_idtarekcateg` ASC),
  CONSTRAINT `fk_tarekcateg_has_tarekarticle_tarekcateg1`
    FOREIGN KEY (`tarekcateg_idtarekcateg`)
    REFERENCES `testcrudoo`.`tarekcateg` (`idtarekcateg`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarekcateg_has_tarekarticle_tarekarticle1`
    FOREIGN KEY (`tarekarticle_idtarekarticle`)
    REFERENCES `testcrudoo`.`tarekarticle` (`idtarekarticle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
