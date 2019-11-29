<?php

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

	if(!($response = $link->query("SELECT username, id FROM users WHERE username = '".$_GET['username']."'")))
		throw new Exception("Request failed");

	if($response->rowCount() != 1)
		throw new Exception("No user found");

	$user = $response->fetch();
	$result = "<p>ID = ".$user['id']."<br>Username: ".$user['username']." </p>";
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>