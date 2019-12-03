<?php
// ===========================================================================================
// Gestion de : profile/C_delete.php
// Auteurs : Charles Régniez
// Version du : 03/12/2019
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
}



?>