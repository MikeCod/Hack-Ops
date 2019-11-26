<?php
/*
session_start();
require "../../../config.php";
require "../../../M_bdd.php";
require "../../M_init_honeypot.php";
redirect();
*/
$link = NULL;
$dbname = "";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	if(!($link = create_honeypot($type, $difficulty, $dbname)))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");

	$link->query("CREATE TABLE challenge(flag varchar(64))");
	$link->query("INSERT INTO challenge(flag) VALUES('".get_flag($type, $difficulty)."')");
	
	if(!($response = $link->query("SELECT username, id FROM users WHERE id = ".$_GET['name'])))
		throw new Exception("Request failed");

	if($response->rowCount() != 1)
		throw new Exception("No user found");

	$user = $response->fetch();
	$result = "Username: ".$user['username']." ID = ".$user['id']."<br>";
	/*
	$_SESSION['result'] = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">\nSwal.fire(
								\"Congrats !\",
								\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
								\"success\"
							);</script>";*/
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>