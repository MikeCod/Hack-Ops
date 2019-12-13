<?php

define('ROOT', '/other/PI');

set_include_path(my_get_include_path());
require_once "Controller/config.php";

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
		header("Location: ".ROOT."/View/sign-in.php");
		exit();
	}
}

function my_get_include_path()
{
	return strstr(str_replace("\\", "/", __DIR__), ROOT, true).ROOT."/";
}

?>