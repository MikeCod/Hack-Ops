<?php
// ===========================================================================================
// Gestion de : affichage de edit profile
// Auteurs : Charles Régniez, Dimtri Simon
// Version du : 27/11/2019
// ===========================================================================================

session_start();
require "../M_bdd.php";
redirect();

$link = NULL;
try
{
	if (!isset($_POST['username']) or 
		!isset($_POST['email']) or 
		!isset($_POST['password']))
		throw new Exception("A field is missing"); // permet de lancer l'erreur pas trop loin pour pouvoir la rattraper

	$link = connect_start();
	if (!($response = $link->query("SELECT password FROM users WHERE id = ".$_SESSION['id'])))
		throw new Exception("Internal error: Cannot retrieve current password");

	if ($response->rowCount() != 1)
		throw new Exception("Internal error: Current user not found");
		
	if (hash("sha3-512", $_POST['password']) != $response->fetch()['password'])
		throw new Exception("Unavailable current password");

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		throw new Exception("Unavailable email");

	if (!preg_match("#^[a-zA-Z0-9_ -].{3,16}$#", $_POST['username']))
		throw new Exception("Unavailable username");

	$new_password = "";
	if (isset($_POST['password-new']) and isset($_POST['password-new-confirm']) and !empty($_POST['password-new']))
	{
		if (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,64}$#", $_POST['password-new']))
			throw new Exception("Unavailable new password");

		if ($_POST['password-new'] != $_POST['password-new-confirm'])
			throw new Exception("Confirmation of the new password doesn't match");	

		$new_password = ", password = '".hash("sha3-512", $_POST['password-new'])."'";
	}

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