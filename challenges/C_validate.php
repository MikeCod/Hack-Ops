<?php

require_once "M_init_honeypot.php";

function get_id($type, $difficulty)
{
	$link = connect_start();

	$result = $link->query("SELECT flag FROM challenges WHERE type = '".$type."' AND difficulty = ".$difficulty);
	$flag = $result->fetch()['flag'];
	connect_end($link);

	return $flag;
}

if (!isset($_POST['flag']) or !isset($_POST['type']) or !isset($_POST['difficulty']))
	die "A field isn't specified";


if ($_POST['flag'] != get_flag($_POST['type'], $_POST['difficulty']))
	die "Unavailable flag";
echo "*";

$link = connect_start();
$link->query("INSERT INTO `completed-challenges`(user, challenge) VALUES('".$_SESSION['id']."', '".get_id($_POST['type'], $_POST['difficulty'])."')");
connect_end($link);

?>