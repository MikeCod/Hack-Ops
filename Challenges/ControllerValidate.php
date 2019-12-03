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
	$add = 0;
	switch ($_POST['difficulty']) {
		case 1:
			$add = 10;
			break;
		case 2:
			$add = 25;
			break;
		case 3:
			$add = 70;
		default:
			throw new Exception("Unknown difficulty");
	}

	$link = connect_start();
	$id = get_id($_POST['type'], $_POST['difficulty']);
	if(!$link->query("SELECT id FROM `completed-challenges` WHERE user = ".$_SESSION['id']." AND challenge = ".$id))
		throw new Exception("Challenge already completed");

	if(!$link->query("INSERT INTO `completed-challenges`(user, challenge) VALUES('".$_SESSION['id']."', '".$id."')"))
		throw new Exception("Cannot add challenge to completed challenges");

	if(!$link->query("UPDATE users SET score = '".($_SESSION['score'] + $add)."' WHERE id = ".$_SESSION['id']))
		throw new Exception("Cannot update the score");
	$_SESSION['score'] += $add;

	echo "*";
}
catch(Exception $e)
{
	echo $e->getMessage();
}
connect_end($link);

?>