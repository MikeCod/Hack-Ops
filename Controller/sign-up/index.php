<?php

session_start();
require "../../Model/DB.php";
require "../../Model/sign-up.php";

$link = NULL;

try
{
	//die("OK");
	if (!isset($_POST['username']) or empty($_POST['username']) or 
		!isset($_POST['email']) or empty($_POST['email']) or 
		!isset($_POST['password']) or empty($_POST['password']) or 
		!isset($_POST['cpassword']) or empty($_POST['cpassword']))
		throw new Exception("fields");
	
	$link = connect_start();

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		throw new Exception("email");

	if(!available_email($link, $_POST['email']))
		throw new Exception("used-email");

	if (!preg_match("#^[a-zA-Z0-9_ -].{3,16}$#", $_POST['username']))
		throw new Exception("username");

	if(!available_username($link, $_POST['username']))
		throw new Exception("used-username");
	
	if (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,64}$#", $_POST['password']))
		throw new Exception("password");

	if ($_POST['password'] != $_POST['cpassword'])
		throw new Exception("match");
	
	$_SESSION['id'] = add_user($link, $_POST['username'], $_POST['email'], $_POST['password']);

	$_SESSION['administrator'] = '0';
	$_SESSION['score'] = '0';
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['email'] = $_POST['email'];
	mconnect();

	header("Location: ../../View/dashboard.php");
}
catch (Exception $e)
{
	$_SESSION['error'] = $e->getMessage();
	$_SESSION['form']['username'] = (isset($_POST['username']) ? $_POST['username'] : '');
	$_SESSION['form']['email'] = (isset($_POST['email']) ? $_POST['email'] : '');
	header("Location: ../../View/sign-up/");
}
connect_end($link);

?>