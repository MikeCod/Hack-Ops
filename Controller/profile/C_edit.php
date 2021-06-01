<?php
// ===========================================================================================
// Gestion de : affichage de edit profile
// Auteurs : Charles Régniez, Dimtri Simon
// Version du : 20/12/2019
// ===========================================================================================
session_start();
require "../../Model/DB.php";
redirect();

$link = NULL;
try
{
	if (!isset($_POST['edit-username']) or 
		!isset($_POST['edit-email']) or 
		!isset($_POST['edit-password']))
		throw new Exception("A field is missing"); // permet de lancer l'erreur pas trop loin pour pouvoir la rattraper

	
	$link = connect_start();
	if (!($response = $link->query("SELECT password FROM users WHERE id = ".$_SESSION['id'])))
		throw new Exception("Internal error: Cannot retrieve current password");

	if ($response->rowCount() != 1)
		throw new Exception("Internal error: Current user not found");
		
	if (hash("sha3-512", $_POST['edit-password']) != $response->fetch()['password'])
		throw new Exception("Unavailable current password");

	if (!filter_var($_POST['edit-email'], FILTER_VALIDATE_EMAIL))
		throw new Exception("Unavailable email");

	if (!preg_match("#^[a-zA-Z0-9_ -].{3,16}$#", $_POST['edit-username']))
		throw new Exception("Unavailable username");

	$new_password = "";
	if (isset($_POST['edit-password-new']) and isset($_POST['edit-password-new-confirm']) and !empty($_POST['edit-password-new']))
	{
		if (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,64}$#", $_POST['edit-password-new']))
			throw new Exception("Unavailable new password");

		if ($_POST['edit-password-new'] != $_POST['edit-password-new-confirm'])
			throw new Exception("Confirmation of the new password doesn't match");	

		$new_password = ", password = '".hash("sha3-512", $_POST['edit-password-new'])."'";
	}

	$req = $link->prepare("UPDATE users SET username = :username, email = :email".$new_password." WHERE id = ".$_SESSION['id']);
	$req->bindParam(':username', $_POST['edit-username']);
	$req->bindParam(':email', $_POST['edit-email']);
	$req->execute();

	$_SESSION['username'] = $_POST['edit-username'];
	$_SESSION['email'] = $_POST['edit-email'];

	echo "*";

}
catch(Exception $e)
{
	echo "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
?>