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

	if(!isset($_GET["order-by"]))
		$_GET["order-by"] = "score";
	if(!($response = $link->query("SELECT id, username, name, score, admin FROM users ORDER BY ".$_GET["order-by"]." DESC LIMIT 10")))
		throw new Exception("Request failed");

	$result = '
		<table width="800px">
		<tr style="font-weight:bold;">
			<td>User</td>
			<td>Score</td>
		</tr>
		';
	//$i = 1;
	while($user = $response->fetch()) {
		$result .= '<tr><td>'.$user["name"].' ('.$user["username"].')</td><td>'.$user["score"].'</td></tr>';
	}
	$result .= '</table>';
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>