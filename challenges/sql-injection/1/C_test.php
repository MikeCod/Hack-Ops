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
	
	if(!($response = $link->query("SELECT id FROM users WHERE username = '".$_POST['username']."' AND password = '".hash('sha3-512', $_POST['password'])."'")))
		throw new Exception("Request failed");

	if($response->rowCount() != 1)
		throw new Exception("Unavailable username or password");

	$id = $response->fetch()['id'];
	if($id != 1)
		throw new Exception("You accessed to the session of ID ".$id);
	
	$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">\nSwal.fire(
								\"Congrats !\",
								\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
								\"success\"
							);</script>";
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>