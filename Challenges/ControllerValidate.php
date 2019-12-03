<?php

session_start();
require "../Moddel/BD.php";
redirect();

require "M_challenge.php";
require "M_validate.php";

if (!isset($_POST['flag']) or !isset($_POST['type']) or !isset($_POST['difficulty']))
	die("A field isn't specified");

$link = NULL;
try
{
	if ($_POST['flag'] != get_flag($_POST['type'], $_POST['difficulty']))
		die("Unavailable flag");

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
	$id = get_id($link, $_POST['type'], $_POST['difficulty']);
	add_challenge_completed($_SESSION['id'], $id);

	$_SESSION['score'] = update_score($_SESSION['id'], $_SESSION['score']);

	echo "*".update_badges($_SESSION['id'], $_SESSION['score']);
}
catch(Exception $e)
{
	echo $e->getMessage();
}
connect_end($link);

?>