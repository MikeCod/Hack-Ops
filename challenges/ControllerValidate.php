<?php

session_start();
require "../Model/DB.php";
redirect();

require "Challenges/ModelChallenge.php";
require "Challenges/ModelValidate.php";

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
			break;
		default:
			throw new Exception("Unknown difficulty");
	}

	$link = connect_start();
	add_challenge_completed($link, $_SESSION['id'], get_id($link, $_POST['type'], $_POST['difficulty']));

	$_SESSION['score'] = update_score($link, $_SESSION['id'], $_SESSION['score'], $add);

	echo "*".update_badges($link, $_SESSION['id'], $_SESSION['score']);
}
catch(Exception $e)
{
	echo $e->getMessage();
}
connect_end($link);

?>