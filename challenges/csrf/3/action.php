<?php

if(isset($_SESSION["csrf-2"]) and !$_SESSION["csrf-2"])
{
	if(isset($_POST["new-password"]))
		$_SESSION["csrf-2"] = true;
	else
		$_SESSION["csrf-2"] = false;
	exit();
}

$link = NULL;
$dbname = "";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	if(!($link = create_honeypot($type, $difficulty, $dbname)))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");

	if(!isset($_POST['message']))
		throw new Exception("No message");

	$_SESSION["csrf-2"] = false;
	$good = false;
	$dom = new DOMDocument();
	$dom->loadHTML($_POST['message']);
	$images = $dom->getElementsByTagName('img');

	foreach ($images as $image) {
		$src = $image->getAttribute('src');
		if($image->getAttribute('width') != "0" or $image->getAttribute('height') != "0" or $image->getAttribute('border') != "0")
			throw new Exception("You should let the width, height and border to 0. Otherwise the admin will can see something goes wrong...");
		if(($resource_length = filesize($src)) === false)
			throw new Exception("Cannot get resource length");
		
		if($resource_length > 1024)
			$resource_length = 1024;
		$resource = str_ireplace("C_edit-profile.php", "C_test.php", fread($src, $resource_length));
		
		$v8 = new V8Js();
		$v8->executeString($resource);
	}

	if($_SESSION["csrf-2"])
		$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
			Swal.fire(
				\"Congrats !\",
				\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
				\"success\"
			);</script>";
	else
		throw new Exception("Unavailable payload");
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
unset($_SESSION["csrf-2"]);
connect_end($link);
delete_honeypot($dbname);

?>