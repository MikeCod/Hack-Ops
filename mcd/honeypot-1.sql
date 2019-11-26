CREATE TABLE `users`(id int PRIMARY KEY, `username` VARCHAR(16), `name` VARCHAR(16), `password` VARCHAR(128));

-- ADD ADMIN ACCOUNT --
-- Password: H@ck0p5P1MDC -- 
INSERT INTO users(id, username, name, password) VALUES('1', 'admin', 'Mike', '1nj3ct10n');
INSERT INTO users(id, username, name, password) VALUES('2', 'mike', 'Mike', 'password');