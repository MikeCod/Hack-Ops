<?php

session_start();
include('../config.php');

$link = NULL;

try
{
	if (!isset($_POST['username']) or empty($_POST['username']) or 
		!isset($_POST['email']) or empty($_POST['email']) or 
		!isset($_POST['password']) or empty($_POST['password']) or 
		!isset($_POST['cpassword']) or empty($_POST['cpassword']))
		throw new Exception("fields");
		
	$link = connect_start();

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		throw new Exception("email");

	if (!preg_match("/[^A-Za-z0-9_ -]/.{3,16}$#", $_POST['username']))
		throw new Exception("username");

	if (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,64}$#", $_POST['password']))
		throw new Exception("password");

	if ($_POST['password'] != $_POST['cpassword'])
		throw new Exception("match");

	$link->query("INSERT INTO users(username, email, password) VALUES('".$link->quote($_POST['username'])."', '".$link->quote($_POST['email'])."', '".hash('sha3-512', $_POST['password'])."')");

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['email'] = $_POST['email'];
	connected();

	header("Location: /dashboard.php");
	exit();
}
catch (Exception $e)
{
	connect_end($link);
	$_SESSION['error'] = $e->getMessage();
	header("Location: /sign-up/");
	exit();
}

?>