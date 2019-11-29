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

	file_put_contents("flag", "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
		Swal.fire(
			\"Congrats !\",
			\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
			\"success\"
		);</script>"
	);

	$result = "<p style=\"font-size:12pt;\">".shell_exec("ping -w 250 -n 4 ".$_POST['host'])."</p>";

	unlink("flag");
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>