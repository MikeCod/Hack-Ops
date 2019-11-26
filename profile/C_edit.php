<?php

session_start();
require "../M_bdd.php";
redirect("../");

$link = NULL;
try
{
	$link = connect_start();
	if (!($response = $link->query("SELECT password FROM users WHERE id = ".$_SESSION['id'])))
		throw new Exception("Internal error: Cannot retrieve current password");

	if ($response->rowCount() != 1)
		throw new Exception("Internal error: Current user not found");
		
	if (hash("sha3-512", $_POST['password']) != $response->fetch()['password'])
		throw new Exception("Unavailable current password");
	


	echo "*";
}
catch(Exception $e)
{
	echo "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);

?>