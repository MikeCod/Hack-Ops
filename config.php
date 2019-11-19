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
	$link = new PDO("mysql:host=".HOST.";dbname=".DB_NAME, USER, PASS);
	if($link)
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $link;
}

function connect_end(&$link)
{
	$link = NULL;
}

function is_connected()
{
	return isset($_SESSION['connected']);
}

function connected()
{
	$_SESSION['connected'] = true;
}

function redirect()
{
	if(!is_connected()) {
		header("Location: sign-in.php");
		exit();
	}
}

?>