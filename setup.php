<?php

require 'config.php';

$link = new PDO("mysql:host=".HOST, USER, PASS);
if(!$link->query("CREATE DATABASE ".DB_NAME))
	die("Request failed: CREATE DATABASE");

connect_end($link);

if(!($link = connect_start()))
	die("Could not connect to database");

// For users
if(!$link->query("CREATE TABLE ".USERS."(id int PRIMARY KEY NOT NULL, login varchar(16), password varchar(128))"))
	die("Request failed: CREATE TABLE");

// id=1 | login=admin | password=password
if(!$link->query("INSERT INTO ".USERS."(id, login, password) VALUES('1', 'admin', 'e9a75486736a550af4fea861e2378305c4a555a05094dee1dca2f68afea49cc3a50e8de6ea131ea521311f4d6fb054a146e8282f8e35ff2e6368c1a62e909716')"))
	die("Request failed: insert into");

connect_end($link);

?>