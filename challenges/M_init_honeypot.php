<?php

require_once "../M_bdd.php";

function create_honeypot($type, $difficulty, &$dbname)
{
	$dbname = $type.'-'.$difficulty.'-'.$_SESSION['id'];
	$link = new PDO("mysql:host=".HOST, USER, PASS);
	if(!($handle = fopen("../../../mcd/honeypot-1.sql", "r")))
		return NULL;
	if(!$link->query("CREATE DATABASE `".$dbname."`"))
		return NULL;
	$link = NULL;

	if(!($link = new PDO("mysql:host=".HOST.";dbname=".$dbname, USER, PASS)))
		return NULL;

	while($request = fgets($handle)) {
		$link->query($request);
	}
	fclose($handle);
	return $link;
}

function delete_honeypot($dbname)
{
	return connect_end(connect_start()->query("DROP DATABASE `".$dbname."`"));
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