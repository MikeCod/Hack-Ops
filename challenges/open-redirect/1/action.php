<?php

$link = NULL;
$dbname = "";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	if(parse_url($_GET["redirect"], PHP_URL_SCHEME) == "https" and parse_url($_GET["redirect"], PHP_URL_HOST) == "my.dark.site")
		$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
			Swal.fire(
			\"Congrats !\",
			\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
			\"success\"
			);</script>";
	else
		header("Location: ".$_GET["redirect"]);
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);

?>