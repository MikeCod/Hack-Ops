<?php

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

$link = NULL;
try
{
	$flag = get_flag($type, $difficulty);
	if ($flag != $_GET["flag"])
		throw new Exception("Unavailable flag");
	$link = connect_start();
	if (isset($_SESSION["id"]))
		$response = $link->query("SELECT `status`, user, challenge FROM `programming-challenges-status` WHERE user = '".$_SESSION["id"]."' AND challenge = (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."')");
	else
		$response = $link->query("SELECT `status`, user, challenge FROM `programming-challenges-status` WHERE user = (SELECT id FROM users WHERE username = ".$link->quote($_GET["username"])." AND password = '".hash('sha3-512', $_GET['password'])."') AND challenge = (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."')");
	if ($response->rowCount() == 0) {
		switch($_GET["status"]) {
			case '0':
			case '1':
			case '2':
			case '3':
				break;
			default:
				throw new Exception("Unavailable status");
		}
		$link->query("INSERT INTO `programming-challenges-status`(`user`, `challenge`, `status`) VALUES((SELECT id FROM users WHERE username = ".$link->quote($_GET["username"])." AND password = '".hash('sha3-512', $_GET['password'])."'), (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."'), '".$_GET["status"]."')");
	}
	else {
		switch($_GET["status"]) {
			case '0':
			case '1':
			case '2':
			case '3':
				break;
			default:
				throw new Exception("Unavailable status");
		}
		if(isset($_SESSION["id"]))
			$link->query("UPDATE `programming-challenges-status` SET `status` = '".$_GET["status"]."' WHERE user = '".$_SESSION["id"]."' AND challenge = (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."')");
		else
			$link->query("UPDATE `programming-challenges-status` SET `status` = '".$_GET["status"]."' WHERE user = (SELECT id FROM users WHERE username = ".$link->quote($_GET["username"])." AND password = '".hash('sha3-512', $_GET['password'])."') AND challenge = (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."')");
	}
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}

?>