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
	
	if(!($response = $link->query("SELECT username, id FROM users WHERE id = ".$_GET['name'])))
		throw new Exception("SELECT username, id FROM users WHERE id = ".$_GET['name']);

	if($response->rowCount() == 0)
		throw new Exception("No user found");
	//print_r($response->fetchAll());

	while($user = $response->fetch())
		$result .= "Username: ".$user['username']." ID = ".$user['id']."<br>";
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