CREATE TABLE `users`(id int PRIMARY KEY, `username` VARCHAR(16), `password` VARCHAR(128));

-- ADD ADMIN ACCOUNT --
-- Password: H@ck0p5P1MDC -- 
INSERT INTO users(id, username, password) VALUES('1', 'admin', '1j3ct10n');
INSERT INTO users(id, username, password) VALUES('2', 'mike', 'password');