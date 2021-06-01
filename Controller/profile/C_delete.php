<?php
// ===========================================================================================
// Gestion de : Controller/profile/C_delete.php
// Auteurs : Charles Régniez
// Version du : 22/01/2019
// ===========================================================================================
session_start();
require "../../Model/DB.php";
redirect();

$link = NULL;
try
{
	if (!isset($_POST['delete-password']))
		throw new Exception("A field is missing");

	$link = connect_start();

	if (!($response = $link->query("SELECT password FROM users WHERE id = ".$_SESSION['id'])))
		throw new Exception("Internal error: Cannot retrieve current password");

	if ($response->rowCount() != 1)
		throw new Exception("Internal error: Current user not found");

	// test if the password is good or not
	if (hash("sha3-512", $_POST['delete-password']) == $response->fetch()['password']) {
		// delete a line from user 
		//$link->query("DELETE FROM `completed-badges` WHERE user = ". $_SESSION['id']);
		//$link->query("DELETE FROM `completed-challenges` WHERE user = ". $_SESSION['id']);
		$link->query("DELETE FROM users WHERE id = ". $_SESSION['id']);
		echo "*";
	}
	else throw new Exception("Error Password is wrong");	
}
catch(Exception $e)
{
	echo "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
?>