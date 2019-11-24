<?php

session_start();
require "../../../config.php";
require "../../../M_bdd.php";
require "../../M_init_honeypot.php";
redirect();

$link = NULL;
$dbname = "";

try
{
	if(!isset($_POST['type']) or !isset($_POST['difficulty']) or !isset($_POST['username']) or !isset($_POST['password']))
		throw new Exception("A field is missing");
	
	if(!($link = create_honeypot($_POST['type'], $_POST['difficulty'], $dbname)))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");
	
	if(!($result = $link->query("SELECT id FROM users WHERE username = '".$_POST['username']."' AND password = '".hash('sha3-512', $_POST['password'])."'")))
		throw new Exception("Request failed");
	
	if($result->rowCount() != 1)
		throw new Exception("Unavailable username or password");
	
	$id = $result->fetch()['id'];
	if($id != 1)
		throw new Exception("You accessed to the session of ID ".$id);
	
	$_SESSION['result'] = "Congrats ! You can now validate this challenge with the flag ".get_flag($_POST['type'], $_POST['difficulty']);
}
catch(Exception $e)
{
	$_SESSION['result'] = $e->getMessage();
}
connect_end($link);
delete_honeypot($dbname);

header("Location: ./");
exit();

?>