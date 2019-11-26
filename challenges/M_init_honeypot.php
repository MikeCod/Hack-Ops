<?php

//require_once "../M_bdd.php";

define('CHALLENGE_HOST', 'localhost');
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
	$link = new PDO("mysql:host=".CHALLENGE_HOST.";port=".CHALLENGE_PORT, CHALLENGE_USER, CHALLENGE_PASS);
	if(!($handle = fopen("../../../mcd/honeypot-1.sql", "r")))
		return NULL;
	if(!$link->query("CREATE DATABASE `".$dbname."`"))
		return NULL;
	$link = NULL;

	if(!($link = new PDO("mysql:host=".HOST.";dbname=".$dbname, USER, PASS)))
		return NULL;

	while($request = fgets($handle))
		$link->query($request);
	
	fclose($handle);
	return $link;
}

function delete_honeypot($dbname)
{
	/*connect_end(*/connect_start()->query("DROP DATABASE `".$dbname."`")/*)*/;
}

function get_flag($type, $difficulty)
{
	$link = connect_start();

	$result = $link->query("SELECT flag FROM challenges WHERE type = '".$type."' AND difficulty = ".$difficulty);
	$flag = $result->fetch()['flag'];
	connect_end($link);

	return $flag;
}

?>