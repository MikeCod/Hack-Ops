<?php
/*
session_start();
require "../../../config.php";
require "../../../M_bdd.php";
require "../../M_init_honeypot.php";
redirect();
*/
$link = NULL;
$dbname = "";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	if(!($link = create_honeypot($type, $difficulty, $dbname)))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");

	file_put_contents("flag", "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">\nSwal.fire(
		\"Congrats !\",
		\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
		\"success\"
		);</script>"
	);

	$result = shell_exec("ping ".$_POST['host']);

	if (!unlink("flag"))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>