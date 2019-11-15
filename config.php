<?php

define('NAME', 'Hack Ops');

# Database management system to use
define('DBMS', 'MySQL');

define('HOST', 'localhost');
define('DB_NAME', "HackOps");
define('USER', 'root');
define('PASS', '');

# Tables
define('USERS', 'users'); # Users

function connect_start()
{
	return new PDO("mysql:host=".HOST.";dbname=".DB_NAME, USER, PASS);
}

function connect_end(&$link)
{
	$link = NULL;
}

?>