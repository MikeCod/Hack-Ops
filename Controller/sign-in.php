<?php

session_start();
require "../Model/DB.php";
if(is_connected()) {
	header("Location: ../View/dashboard.php");
	exit();
}

try
{
	if (!isset($_POST['username']) or !isset($_POST['password']) or empty($_POST['username']))
		throw new Exception("All the fields must be fill");
	$_SESSION['username'] = $_POST['username'];
	
	if (!($link = connect_start()))
		throw new Exception("Could not connect to database. Sorry for the inconvenience.");

	$result = $link->query("SELECT id, username, email, score, administrator FROM ".USERS." WHERE username = ".$link->quote($_POST['username'])." AND password = '".hash('sha3-512', $_POST['password'])."'");
	connect_end($link);
	
	if ($result->rowCount() != 1)
		throw new Exception("Unavailable username or password");

	$_SESSION = array();
	$_SESSION = $result->fetch();
	mconnect();

	header("Location: ../View/dashboard.php");
	exit();
}
catch (Exception $e)
{
	connect_end($link);
	$_SESSION['error'] = $e->getMessage();
}
header("Location: ../View/sign-in.php");
exit();

?>