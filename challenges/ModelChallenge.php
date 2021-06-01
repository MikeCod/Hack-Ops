<?php

define('CHALLENGE_HOST', '192.168.43.186'/*'localhost'*/);
define('CHALLENGE_PORT', '3306');
define('CHALLENGE_USER', 'root');
define('CHALLENGE_PASS', '');

function get_challenge(&$type, &$difficulty)
{
	$array = explode("\\", getcwd());
	$type = $array[count($array)-2];
	$difficulty = $array[count($array)-1];
}

function create_honeypot($type, $difficulty, &$dbname)
{
	$dbname = $type.'-'.$difficulty.'-'.$_SESSION['id'];
	if(!($link = new PDO("mysql:host=".CHALLENGE_HOST.";port=".CHALLENGE_PORT, CHALLENGE_USER, CHALLENGE_PASS)))
		return NULL;
	if(!($handle = fopen("../../../mcd/honeypot-1.sql", "r")))
		return NULL;
	if(!$link->query("CREATE DATABASE `".$dbname."`"))
		return NULL;
	connect_end($link);

	if(!($link = new PDO("mysql:host=".CHALLENGE_HOST.";port=".CHALLENGE_PORT.";dbname=".$dbname, CHALLENGE_USER, CHALLENGE_PASS)))
		return NULL;

	while($request = fgets($handle))
		$link->query($request);
	
	fclose($handle);
	return $link;
}

function delete_honeypot($dbname)
{
	if(!($link = new PDO("mysql:host=".CHALLENGE_HOST.";port=".CHALLENGE_PORT, CHALLENGE_USER, CHALLENGE_PASS)))
		return NULL;
	$link->query("DROP DATABASE `".$dbname."`");
	connect_end($link);
}

function get_flag($type, $difficulty)
{
	$link = connect_start();

	$result = $link->query("SELECT flag FROM challenges WHERE type = '".$type."' AND difficulty = ".$difficulty);
	$flag = $result->fetch()['flag'];
	connect_end($link);

	return $flag;
}

function get_id($link, $type, $difficulty)
{
	return $link->query("SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = ".$difficulty)->fetch()['id'];
}

?>