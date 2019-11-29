
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
  `password` VARCHAR(128) NOT NULL,
  `score` INT UNSIGNED NULL DEFAULT 0,
  `activated` TINYINT(1) DEFAULT 0,
  `administrator` TINYINT(1) NULL DEFAULT 0,
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
  `name` VARCHAR(32) NOT NULL,
  `value` ENUM('Beginner', 'Experimented', 'Master') NOT NULL,
  `description` VARCHAR(256) NOT NULL,
  `type` ENUM('Challenge', 'Score', 'Extra') NOT NULL,
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

-- ADD ADMIN ACCOUNT --
-- Password: H@ck0p5P1MDC -- 
INSERT INTO users(username, email, password, activated, administrator) VALUES('admin', 'admin@localhost', 'f451eecb3a41963157e4d3b0063636cfc3e37b65ed46d74382ff2a09cffe7dd2e0435b60ce56670beedc472d55fa8c4c7bd98558c637ee1816264d13c3f549db', '1', '1');

-- BADGE Fixe--
-- Score --
INSERT INTO badges(name, value, description, type) VALUES('Master Score', 'Master', 'Have 250 score points', 'Score');
INSERT INTO badges(name, value, description, type) VALUES('Expert Score', 'Experimented', 'Have 100 score points', 'Score');
INSERT INTO badges(name, value, description, type) VALUES('Beginner Score', 'Beginner', 'Have 50 score points', 'Score');
-- Challenge -- 
INSERT INTO badges(name, value, description, type) VALUES('Master Challenge', 'Master', 'Complete 5 challenges', 'Challenge');
INSERT INTO badges(name, value, description, type) VALUES('Expert Challenge', 'Experimented', 'Complete 3 challenges', 'Challenge');
INSERT INTO badges(name, value, description, type) VALUES('Beginner Challenge', 'Beginner', 'Complete 1 challenge', 'Challenge');
-- Extra -- 
INSERT INTO badges(name, value, description, type) VALUES('Master Extra', 'Master', 'EXTRA BADGE MASTER', 'Extra');
INSERT INTO badges(name, value, description, type) VALUES('Expert Extra', 'Experimented', 'EXTRA BADGE EXPERT', 'Extra');
INSERT INTO badges(name, value, description, type) VALUES('Beginner Extra', 'Beginner', 'EXTRA BADGE BEGINNER', 'Extra');


INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '1', 'You wanna sign in.<br>Standard: Access the admin session (id = 1)', '2qiAw1RwviVaeWy8ZbkCZW6Xc2iQocxJzwtDGwXKaxQLUTx7FkY2KFSXm9e3TX69');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '2', 'You wanna search a user by ID<br>Union: Access to the challenge table, the flag is inside.<br>Note: A tool like sqlmap could be necessary', 'J6fUax0MKD5k5460m2SLIDWOezYEwzCkLJKFqbusR7bV9uYAcCnDtP4O3WMsmZsq');
-- INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '3', 'Out-of-band: Access the challenge table, the flag is inside.<br>A tool like sqlmap could be necesseray', 'u0qRiniQjYJepTcgRKYBY4o4ER82t3AajuKax3n3ZY2vkghDATn04Vmv0Y8aDfIt');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('code-injection', '1', 'You wanna ping a host<br>The flag is in the file \'flag\'', '3xnNqUYRehmEkOOLXz3LiyZwuU57zoyJYiWcvVOd0jm7fhuDGxiIKt3lT9BIjd27');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('csrf', '1', 'You send a mail to the administrator.<br>Note: The connection must be secured (https), and the host is local for admin (localhost).<br>Simple GET: Change admin\'s password. The payload will be the picture link (img)', '9XvVDIN61taDYO9yq9j6EZrMtrysQWhhmEBvQvQnLQgBd4CJStQPyAMxRPzZjWcg');

-- INSERT INTO challenges(type, difficulty, description, flag) VALUES('csrf', '2', 'You send a mail to the administrator.<br>
  -- Note: The connection must be secured (https), and the host is local for admin (localhost).<br>
  -- Note 2: The payload will must use JavaScript. The payload will not be in the mail, because JavaScript cannot be executed, so you'll have to use an external server (on your own computer ?) and call the resource from the mail.
  -- These links could help you: <a href=\\\"https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)\\\">OWASP</a> | <a href=\\\"https://stackoverflow.com/questions/3054315/is-javascript-supported-in-an-email-message\\\">Is JavaScript supported in an email message</a><br>
  -- Advanced POST: Change admin\'s password.', 'xk2oDXWn4FbBc9WnqRz9adipbVN5a2dNyCK9UdhMyDphlnhF9r0kKNJalDsvePds');
