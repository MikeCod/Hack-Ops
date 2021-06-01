CREATE TABLE `users`(id int PRIMARY KEY, `username` VARCHAR(16), `name` VARCHAR(16), `password` VARCHAR(128), `score` int, `admin` TINYINT(1) DEFAULT 0);

-- ADD ADMIN ACCOUNT --
-- Password: H@ck0p5P1MDC -- 
INSERT INTO users(id, username, name, password, score, admin) VALUES('1', 'admin', 'Mike', '1nj3ct10n', '1000', '1');
INSERT INTO users(id, username, name, password, score) VALUES('2', 'mars', 'Mars', 'My$tr0ngP@$$w0rd', '250');
INSERT INTO users(id, username, name, password, score) VALUES('3', 'bob', 'Bob', 'ShortPass', '100');
INSERT INTO users(id, username, name, password, score) VALUES('4', 'alice', 'Alice', 'ShortPass', '100');