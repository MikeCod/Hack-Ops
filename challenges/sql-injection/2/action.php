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

	$flag = get_flag($type, $difficulty);

	$link->query("CREATE TABLE challenge(flag varchar(64))");
	$link->query("INSERT INTO challenge(flag) VALUES('".$flag."')");

	if(!($response = $link->query("SELECT id, username, name, score, admin FROM users WHERE id = ".$_GET['id'])))
		throw new Exception("Request failed");

	if($response->rowCount() != 1)
		throw new Exception("No user found");

	$user = $response->fetch();
	$result = "";
	foreach ($user as $key => $value) {
		if(strpos($value, $flag) !== false)
			$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
				Swal.fire(
				\"Congrats !\",
				\"You can now validate this challenge with the flag ".$flag."\",
				\"success\"
				);</script>";
	}
	$result .= "ID: ".$user['id']."<h1>".$user['name'].($user['admin'] == '1' ? " [Admin account]" : "")."</h1><h2>".$user['username']."</h2><p>Score: ".$user['score']."<br>";
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>