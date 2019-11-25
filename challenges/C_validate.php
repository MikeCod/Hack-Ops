<?php

session_start();
require "../M_bdd.php";
redirect();

require "M_init_honeypot.php";

function get_id($link, $type, $difficulty)
{
	return $link->query("SELECT flag FROM challenges WHERE type = '".$type."' AND difficulty = ".$difficulty)->fetch()['flag'];
}

if (!isset($_POST['flag']) or !isset($_POST['type']) or !isset($_POST['difficulty']))
	die("A field isn't specified");

if ($_POST['flag'] != get_flag($_POST['type'], $_POST['difficulty']))
	die("Unavailable flag");

$link = NULL;
try
{
	$link = connect_start();
	$id = get_id($_POST['type'], $_POST['difficulty']);
	if(!$link->query("SELECT id FROM `completed-challenges` WHERE user = ".$_SESSION['id']." AND challenge = ".$id))
		throw new Exception("Challenge already completed");
		
	echo "*";

	$link->query("INSERT INTO `completed-challenges`(user, challenge) VALUES('".$_SESSION['id']."', '".$id."')");
}
catch(Exception $e)
{
	echo $e->getMessage();
}
connect_end($link);

?>