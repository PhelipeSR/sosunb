-- MySQL Script generated by MySQL Workbench
-- Ter 23 Out 2018 17:04:56 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sosunb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sosunb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sosunb` DEFAULT CHARACTER SET utf8 ;
USE `sosunb` ;

-- -----------------------------------------------------
-- Table `sosunb`.`profile_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`profile_type` (
  `id` INT NOT NULL,
  `type` VARCHAR(50) NULL,
  `excluded` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `registry` VARCHAR(20) NULL,
  `identity` VARCHAR(20) NULL,
  `date_birth` DATE NULL,
  `image_profile` VARCHAR(50) NULL,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(255) NULL,
  `register_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `excluded` INT NULL DEFAULT 0,
  `profile_type_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_profile_type1_idx` (`profile_type_id` ASC),
  CONSTRAINT `fk_users_profile_type1`
    FOREIGN KEY (`profile_type_id`)
    REFERENCES `sosunb`.`profile_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL,
  `excluded` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`type_demand`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`type_demand` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `demands` VARCHAR(100) NULL,
  `excluded` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`type_problems`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`type_problems` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NULL,
  `excluded` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`local`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`local` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `local` VARCHAR(100) NULL,
  `campus` INT NULL,
  `area` INT NULL,
  `excluded` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`demands`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`demands` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(20) NULL,
  `title` VARCHAR(50) NULL,
  `description` TEXT NULL,
  `created_date` DATETIME NULL,
  `excluded` INT NULL DEFAULT 0,
  `status_id` INT NOT NULL DEFAULT 0,
  `type_demand_id` INT NOT NULL,
  `type_problems_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `local_id` INT NOT NULL,
  `counter` INT NULL DEFAULT 0,
  `resolved` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_demands_status1_idx` (`status_id` ASC),
  INDEX `fk_demands_type_demand1_idx` (`type_demand_id` ASC),
  INDEX `fk_demands_type_problems1_idx` (`type_problems_id` ASC),
  INDEX `fk_demands_users1_idx` (`users_id` ASC),
  INDEX `fk_demands_local1_idx` (`local_id` ASC),
  CONSTRAINT `fk_demands_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `sosunb`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_demands_type_demand1`
    FOREIGN KEY (`type_demand_id`)
    REFERENCES `sosunb`.`type_demand` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_demands_type_problems1`
    FOREIGN KEY (`type_problems_id`)
    REFERENCES `sosunb`.`type_problems` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_demands_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sosunb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_demands_local1`
    FOREIGN KEY (`local_id`)
    REFERENCES `sosunb`.`local` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`coments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`coments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` TEXT NULL,
  `data` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `excluded` INT NULL DEFAULT 0,
  `users_id` INT NOT NULL,
  `demands_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_coments_users1_idx` (`users_id` ASC),
  INDEX `fk_coments_demands1_idx` (`demands_id` ASC),
  CONSTRAINT `fk_coments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sosunb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coments_demands1`
    FOREIGN KEY (`demands_id`)
    REFERENCES `sosunb`.`demands` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` INT NOT NULL,
  `demands_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_likes_users1_idx` (`users_id` ASC),
  INDEX `fk_likes_demands1_idx` (`demands_id` ASC),
  CONSTRAINT `fk_likes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sosunb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_demands1`
    FOREIGN KEY (`demands_id`)
    REFERENCES `sosunb`.`demands` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sosunb`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosunb`.`answers` (
  `id` INT NOT NULL,
  `data` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `coment` VARCHAR(45) NULL,
  `previous_status` INT NULL,
  `current_status` INT NULL,
  `demands_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_respostas_demandas_demands1_idx` (`demands_id` ASC),
  INDEX `fk_respostas_demandas_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_respostas_demandas_demands1`
    FOREIGN KEY (`demands_id`)
    REFERENCES `sosunb`.`demands` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_respostas_demandas_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sosunb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `sosunb`.`profile_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `sosunb`;
INSERT INTO `sosunb`.`profile_type` (`id`, `type`, `excluded`) VALUES (1, 'user', NULL);
INSERT INTO `sosunb`.`profile_type` (`id`, `type`, `excluded`) VALUES (2, 'admin', NULL);
INSERT INTO `sosunb`.`profile_type` (`id`, `type`, `excluded`) VALUES (3, 'manager', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sosunb`.`status`
-- -----------------------------------------------------
START TRANSACTION;
USE `sosunb`;
INSERT INTO `sosunb`.`status` (`id`, `name`, `excluded`) VALUES (1, 'Enviada', 0);
INSERT INTO `sosunb`.`status` (`id`, `name`, `excluded`) VALUES (2, 'Em Análise', 0);
INSERT INTO `sosunb`.`status` (`id`, `name`, `excluded`) VALUES (3, 'Resolvida', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sosunb`.`type_demand`
-- -----------------------------------------------------
START TRANSACTION;
USE `sosunb`;
INSERT INTO `sosunb`.`type_demand` (`id`, `demands`, `excluded`) VALUES (1, 'Reclamação', 0);
INSERT INTO `sosunb`.`type_demand` (`id`, `demands`, `excluded`) VALUES (2, 'Sugestão', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sosunb`.`type_problems`
-- -----------------------------------------------------
START TRANSACTION;
USE `sosunb`;
INSERT INTO `sosunb`.`type_problems` (`id`, `type`, `excluded`) VALUES (1, 'Elétrico', 0);
INSERT INTO `sosunb`.`type_problems` (`id`, `type`, `excluded`) VALUES (2, 'Hidráulico', 0);
INSERT INTO `sosunb`.`type_problems` (`id`, `type`, `excluded`) VALUES (3, 'Estrutural', 0);

COMMIT;

