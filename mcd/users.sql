-- -----------------------------------------------------
-- Schema HackOps
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `HackOps` DEFAULT CHARACTER SET utf8 ;
USE `HackOps` ;

-- -----------------------------------------------------
-- Table `HackOps`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(320) NOT NULL,
  `username` VARCHAR(16) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `score` INT UNSIGNED NULL DEFAULT 0,
  `activated` TINYINT(1) NULL DEFAULT 0,
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
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` ENUM('sql-injection','csrf','code-injection','fi','free','bof','iof','rc','fsb') NOT NULL,
  `difficulty` INT UNSIGNED NOT NULL,
  `description` VARCHAR(256) NOT NULL,
  `flag` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `flag_UNIQUE` (`flag` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`completed-challenges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`completed-challenges` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` INT NOT NULL,
  `challenge` INT NOT NULL,
  INDEX `fk_completed_challenges1_idx` (`challenge` ASC),
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
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `value` ENUM('Beginner', 'Experimented', 'Master') NOT NULL,
  `description` VARCHAR(256) NOT NULL,
  `type` ENUM('Score', 'Rank', 'Challenge') NOT NULL,
  `goal` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`completed-badges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`completed-badges` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` INT NOT NULL,
  `badge` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_game_users0`
    FOREIGN KEY (`user`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_completed-badges_badge1`
    FOREIGN KEY (`badge`)
    REFERENCES `HackOps`.`badges` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_subcategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_subcategories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_f_subcategories_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_f_subcategories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `HackOps`.`f_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_topics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_topics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `content` TEXT NOT NULL,
  `date_create` DATETIME NOT NULL,
  `resolved` TINYINT NOT NULL,
  `notif_user` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_f_topics_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_f_topics_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_topic-categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_topic-categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topics_id` INT NOT NULL,
  `categories_id` INT NOT NULL,
  `subcategories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_f_topic-categories_topics1_idx` (`topics_id` ASC),
  INDEX `fk_f_topic-categories_categories1_idx` (`categories_id` ASC),
  INDEX `fk_f_topic-categories_subcategories1_idx` (`subcategories_id` ASC),
  CONSTRAINT `fk_f_topic-categories_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `HackOps`.`f_topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_f_topic-categories_f_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `HackOps`.`f_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_f_topic-categories_subcategories1`
    FOREIGN KEY (`subcategories_id`)
    REFERENCES `HackOps`.`f_subcategories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topics_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `date_post` DATETIME NOT NULL,
  `date_edit` DATETIME NOT NULL,
  `best_res` TINYINT NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_f_message_users1_idx` (`users_id` ASC),
  INDEX `fk_f_message_topics1_idx` (`topics_id` ASC),
  CONSTRAINT `fk_f_message_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_f_message_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `HackOps`.`f_topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`f_follow`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`f_follow` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `topics_id` INT NOT NULL,
  INDEX `fk_f_follow_users1_idx` (`users_id` ASC),
  INDEX `fk_f_follow_f_topics1_idx` (`topics_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_f_follow_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_f_follow_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `HackOps`.`f_topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HackOps`.`programming-challenges-status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HackOps`.`programming-challenges-status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` INT NOT NULL,
  `challenge` INT NOT NULL,
  `status` TINYINT NULL COMMENT '0 : Nothing sent\n1 : In progress\n2 : Failed\n3 : Success',
  PRIMARY KEY (`id`),
  INDEX `fk_programming-challenges-status_users1_idx` (`user` ASC),
  INDEX `fk_programming-challenges-status_challenges1_idx` (`challenge` ASC),
  CONSTRAINT `fk_programming-challenges-status_users1`
    FOREIGN KEY (`user`)
    REFERENCES `HackOps`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_programming-challenges-status_challenges1`
    FOREIGN KEY (`challenge`)
    REFERENCES `HackOps`.`challenges` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- ADD ADMIN ACCOUNT --
-- Password: H@ck0p5P1MDC -- 
INSERT INTO users(username, email, password, activated, administrator) VALUES('admin', 'admin@localhost', 'f451eecb3a41963157e4d3b0063636cfc3e37b65ed46d74382ff2a09cffe7dd2e0435b60ce56670beedc472d55fa8c4c7bd98558c637ee1816264d13c3f549db', '1', '1');
INSERT INTO users(username, email, password, activated, administrator, score) VALUES('alpha', 'alpha@localhost', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '1', '0', '230');
INSERT INTO users(username, email, password, activated, administrator, score) VALUES('bravo', 'bravo@localhost', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '1', '0', '160');
INSERT INTO users(username, email, password, activated, administrator, score) VALUES('charlie', 'charlie@localhost', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '1', '0','110');
INSERT INTO users(username, email, password, activated, administrator, score) VALUES('delta', 'delta@localhost', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '1', '0','35');

-- INIT BADGE--
-- Score --
INSERT INTO badges(name, value, description, type, goal) VALUES('Master Score', 'Master', 'Have 240 score points', 'Score', '240');
INSERT INTO badges(name, value, description, type, goal) VALUES('Expert Score', 'Experimented', 'Have 100 score points', 'Score', '100');
INSERT INTO badges(name, value, description, type, goal) VALUES('Beginner Score', 'Beginner', 'Have 50 score points', 'Score', '50');
-- Challenge -- 
INSERT INTO badges(name, value, description, type, goal) VALUES('Master Challenge', 'Master', 'Complete 5 challenges', 'Challenge', '5');
INSERT INTO badges(name, value, description, type, goal) VALUES('Expert Challenge', 'Experimented', 'Complete 3 challenges', 'Challenge', '3');
INSERT INTO badges(name, value, description, type, goal) VALUES('Beginner Challenge', 'Beginner', 'Complete 1 challenge', 'Challenge', '1');
-- Rank -- 
INSERT INTO badges(name, value, description, type, goal) VALUES('Master Rank', 'Master', 'Being in top 3', 'Rank', '3');
INSERT INTO badges(name, value, description, type, goal) VALUES('Expert Rank', 'Experimented', 'Being in top 25', 'Rank', '25');
INSERT INTO badges(name, value, description, type, goal) VALUES('Beginner Rank', 'Beginner', 'Being in top 60', 'Rank', '60');


INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '1', 'You wanna sign in<br>Standard: Access the admin session (id 1)', '2qiAw1RwviVaeWy8ZbkCZW6Xc2iQocxJzwtDGwXKaxQLUTx7FkY2KFSXm9e3TX69');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '2', 'View a user profile by his ID<br>Note: Access the challenge table, the flag is inside.<br>Method: Union based exploitation', 'J6fUax0MKD5k5460m2SLIDWOezYEwzCkLJKFqbusR7bV9uYAcCnDtP4O3WMsmZsq');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('sql-injection', '3', 'View a user profile by his ID<br>Note: Access the \'challenge\' table, the flag is in the \'flag\' column.<br>Method: Boolean based blind exploitation', 'u0qRiniQjYJepTcgRKYBY4o4ER82t3AajuKax3n3ZY2vkghDATn04Vmv0Y8aDfIt');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('code-injection', '1', 'You wanna ping a host<br>The flag is in the file \'flag\'', '3xnNqUYRehmEkOOLXz3LiyZwuU57zoyJYiWcvVOd0jm7fhuDGxiIKt3lT9BIjd27');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('csrf', '2', 'You send a mail to the administrator<br>Note: The host is local for admin (localhost).<br>Simple GET: Change admin\'s password. The payload will be the picture link (img)', '9XvVDIN61taDYO9yq9j6EZrMtrysQWhhmEBvQvQnLQgBd4CJStQPyAMxRPzZjWcg');

-- INSERT INTO challenges(type, difficulty, description, flag) VALUES('csrf', '3', 'You send a mail to the administrator.<br>
  -- Note: The connection must be secured (https), and the host is local for admin (localhost).<br>
  -- Note 2: The payload will must use JavaScript. The payload will not be in the mail, because JavaScript cannot be executed, so you'll have to use an external server (on your own computer ?) and call the resource from the mail.
  -- These links could help you: <a href=\\\"https://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)\\\">OWASP</a> | <a href=\\\"https://stackoverflow.com/questions/3054315/is-javascript-supported-in-an-email-message\\\">Is JavaScript supported in an email message</a><br>
  -- Advanced POST: Change admin\'s password.', 'xk2oDXWn4FbBc9WnqRz9adipbVN5a2dNyCK9UdhMyDphlnhF9r0kKNJalDsvePds');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('fi', '1', 'You\'re on the dashboard<br>RFI: The flag is the remote resource \'https://my.dark.site/\'', 'VKXikTrdxPxiYFOsQuxjKRqvZH0hpJZkBaHh45gU9l7hDraSqs0AL9AqGZeSwSdt');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('fi', '2', 'You\'re on the dashboard<br>LFI: The flag is in the file \'flag\'', 'LEbzw3AueO3OFewMlPEb6S9ynK80Wu8k8R8HuJPJi2DM1MLY5cFf0pZq5iLOgbY9');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('open-redirect', '1', 'You have to exploit an Open Redirect.<br>The flag is the ressource \'https://my.dark.site\'', 'KLsYxSjRLZj3PBTaS9V4WCcDrqudeCgiUy8OgSQTDredZ8DJ61xTqdKb9BP52CLg');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('bof', '1', 'You have to exploit a buffer overflow on the executable \'ch\', the source code is available in the file \'ch.c\'<br>Goal: Change the content of the variable \'check\' to \'0xdeadbeef\'<br>Note: The flag is in the file \'flag\'', 'wUjM7hug3cvLBqQ892nnwe1NAr8vpz3fk1LrEh7nj4nsuCVFc0Ag6uY67h7Y94cB');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('bof', '2', 'You have to exploit a buffer overflow on the executable \'ch\', the source code is available in the file \'ch.c\'<br>Goal: Access to the function \'secret_function\'<br>Note: The flag is in the file \'flag\'', 'mytqQCgQnbpsMd6SRXjnApb2QIJiNoveNCB8V3A1CELRt3SoaPxBQdozGIIdlKuf');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('bof', '3', 'You have to exploit a buffer overflow on the executable \'ch\', the source code is available in the file \'ch.c\'<br>Goal: Execute your own shellcode to run /bin/sh<br>Note: The flag is in the file \'flag\'', '6iaiVcEwFKluWGpm806143l2dVjEUyPFCbMz4oqhugmIw8u7o7GTnU9cW99ugRQK');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('iof', '1', 'You have to exploit an integer overflow on the executable \'ch\', the source code is available in the file \'ch.c\'', 'p4UsgvJNEdEHXKJ5m1H6n3Wy3d7j3XFBLFctxBI62Gt3ynkFX20FoQ9XeRNiprSK');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('fsb', '1', 'You have to exploit a format string bug on the executable \'ch\', the source code is available in the file \'ch.c\'', 'JeKSKwJ4Es1smUo4AEEN4RWnNt5d0fYoy71o8yyGgicbB9zmw77ArRVpWbXmgqcj');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('fsb', '2', 'You have to exploit a format string bug on the executable \'ch\', the source code is available in the file \'ch.c\'<br>Note: To make it easier, the flag is 4 characters length', 'Dpe2');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('pc', '1', 'You have to crack the password of the file /home/ch-pc-1/ch <password>, using the file /usr/share/wordlists/metasploit/unix_passwords.txt. The program will return \'NO\' if the password is wrong, or \'OK\' if it\'s good. The python3 script must be called \'script.py\' and must print the password found.', 'ToA2umMr2r8MX1KPGgux3l2vobO9X8vDqia7giO7XCpl2oEY3ULBI4pXpqYRiWfs');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('uaf', '2', 'You have to exploit a Use After Free on the executable \'ch\', the source code is available in the file \'ch.c\'', 'BnXT1CZ1VNLafXmIeX6S70bX0WdbnAEkKEB75GjFkMQVd1MBj0QMaRTRnjtq9phv');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('cc', '1', 'You have to crack the captcha in the file \'/home/ch-cc-1/captcha.txt\', you\'ll have to solve the calculation, it\'ll be like \'a + b\'. The python3 script must be called \'script.py\' and must print the result.', 'ahsYgCc8t3A4l8je9D6bzgzcB6bcZlOy6tmbqBpG9Tgu1P8umYMOzuSqUUCRIDWR');
INSERT INTO challenges(type, difficulty, description, flag) VALUES('cc', '2', 'You have to crack the captcha from the file \'/home/ch-cc-2/captcha.bmp\', you\'ll have to extract characters, and don\'t forget to strip the string. The python3 script must be called \'script.py\' and must print the captcha found.', 'Z5AyR6pcI7e1lgxtm2qLIH5OPWXmjlpzqHIXMyiaWFo6XNurvosJiRbH2yAsnctH');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('rc', '1', 'You have to exploit a race condition on the executable \'ch\', the source code is available in the file \'ch.c\'', 'g2izPj0AYzr2nUfOoZBsife3mojSSFQ3nTI0i7uCWeUgnP2NTtpcbbIDCxPzgKEC');

INSERT INTO challenges(type, difficulty, description, flag) VALUES('free', '3', 'You\'re a user of the project Plat-In<br>Find a vulnerability to retrieve raw admin\'s password.<br>The flag is in the users table, the username is in the user column and the password in u_password.', 'cXprJUB6QlVUbzg2OU8zXmJiV0dlaHF6WTRzSkdiZFQ=');

-- Insert cat and subcat forum --

INSERT INTO f_categories(name) VALUES('Badges');
INSERT INTO f_categories(name) VALUES('Challenges');
INSERT INTO f_categories(name) VALUES('Problem');
INSERT INTO f_categories(name) VALUES('Other');

INSERT INTO f_subcategories(name, categories_id) VALUES('Score', '1');
INSERT INTO f_subcategories(name, categories_id) VALUES('Extra', '1');
INSERT INTO f_subcategories(name, categories_id) VALUES('Challenge', '1');

INSERT INTO f_subcategories(name, categories_id) VALUES('SQL Injection', '2');
INSERT INTO f_subcategories(name, categories_id) VALUES('CSRF', '2');
INSERT INTO f_subcategories(name, categories_id) VALUES('Code Injection', '2');
INSERT INTO f_subcategories(name, categories_id) VALUES('File inclusion', '2');
INSERT INTO f_subcategories(name, categories_id) VALUES('Free', '2');

INSERT INTO f_subcategories(name, categories_id) VALUES('Report Bug', '3');
INSERT INTO f_subcategories(name, categories_id) VALUES('Other problem', '3');

INSERT INTO f_subcategories(name, categories_id) VALUES('Tutorial', '4');
INSERT INTO f_subcategories(name, categories_id) VALUES('Open Source', '4');