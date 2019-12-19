<?php
// ===========================================================================================
// Gestion de : profile/C_delete.php
// Auteurs : Charles Régniez
// Version du : 17/12/2019
// ===========================================================================================
/*
I didn't understand anithing so im trying by my own way

session_start();
require "../../Model/DB.php";
redirect();

$link = NULL;
//echo $_GET['delete-email'];
//echo $_GET['delete-password'];
try
{
	
	if (!isset($_GET['delete-email']) or 
		!isset($_GET['delete-password']))
	{
		throw new Exception("A field is missing");
	}

	$link = connect_start();

	if (!($response = $link->query("SELECT password FROM users WHERE id = ".$_SESSION['id'])))
		throw new Exception("Internal error: Cannot retrieve current password");

	if ($response->rowCount() != 1)
		throw new Exception("Internal error: Current user not found");

	echo $response;
	// test if the password is good or not

	// if (!())



	// TODO : delete a ligne in user 

	$req = $link->prepare("UPDATE users SET username = :username, email = :email".$new_password." WHERE id = ".$_SESSION['id']);
	$req->bindParam(':username', $_POST['username']);
	$req->bindParam(':email', $_POST['email']);
	$req->execute();

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['email'] = $_POST['email'];

	echo "*";
	

}
catch(Exception $e)
{
	echo "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);

?>
}
*/
	echo "coucou c'est c_delete";

?>
