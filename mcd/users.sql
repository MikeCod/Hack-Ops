
-- -----------------------------------------------------
-- Schema HackOps
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `HackOps` DEFAULT CHARACTER SET utf8 ;
USE `HackOps` ;

-- -----------------------------------------------------
-- Table `HackOps`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(320) NOT NULL,
  `username` VARCHAR(16) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `score` INT UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`challenges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`challenges` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(16) NOT NULL,
  `difficulty` INT UNSIGNED NOT NULL,
  `description` VARCHAR(256) NOT NULL,
  `flag` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `challengescol_UNIQUE` (`flag` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`completed-challenges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`completed-challenges` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` INT UNSIGNED NOT NULL,
  `challenge` INT UNSIGNED NOT NULL,
  INDEX `fk_completed_challenges1_idx` (`challenge` ASC),
  UNIQUE INDEX `challenge_UNIQUE` (`challenge` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_game_users`
    FOREIGN KEY (`user`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_completed_challenges1`
    FOREIGN KEY (`challenge`)
    REFERENCES `HackOps`.`challenges` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`badges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`badges` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
  `value` ENUM('Beginner', 'Experimented', 'Master') NOT NULL,
  `description` VARCHAR(256) NOT NULL,
  `type` ENUM('Friends', 'Score', 'Beginner', 'Experimented', 'Master') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`completed-badges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`completed-badges` (
  `id` INT UNSIGNED NOT NULL,
  `user` INT UNSIGNED NOT NULL,
  `achievement` INT UNSIGNED NOT NULL,
  UNIQUE INDEX `achievement_UNIQUE` (`achievement` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_game_users0`
    FOREIGN KEY (`user`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_completed-achievements_achievements1`
    FOREIGN KEY (`achievement`)
    REFERENCES `HackOps`.`badges` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;