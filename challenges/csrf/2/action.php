<?php

$link = NULL;
$dbname = "";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

require_once "../../../model/DB.php";

$payload = 'http://localhost'.ROOT.'/challenges/csrf/2/edit-profile-action.php';
$payload_length = strlen($payload);

try
{
	if(!($link = create_honeypot($type, $difficulty, $dbname)))
		throw new Exception("REAL Internal error. Thanks to contact the developper of this application");

	if(!isset($_POST['message']))
		throw new Exception("No message");

	$good = false;
	$good_link = false;
	$dom = new DOMDocument();
	$dom->loadHTML($_POST['message']);
	$images = $dom->getElementsByTagName('img');
	foreach ($images as $image) {
		$src = $image->getAttribute('src');
		if(strlen($src) >= 8 and substr($src, 0, 8) == "https://")
			throw new Exception("Secured connection not supported");
			
		if(strlen($src) >= $payload_length and substr($src, 0, $payload_length) == $payload)
		{
			if(strpos($src, "?") === false)
				throw new Exception("No parameter");
				
			if($image->getAttribute('width') != "0" or $image->getAttribute('height') != "0" or $image->getAttribute('border') != "0")
				throw new Exception("You should let the width, height and border to 0. Otherwise the admin will can see something goes wrong...");
			
			if(substr($src, 0, $payload_length) == $payload)
			{
				$params = explode("&", substr($src, $payload_length + 1));
				foreach ($params as $key) {
					$param = explode("=", $key);
					if(isset($param[0]) and $param[0] == "new-password"){
						$good = true;
						break;
					}
				}
				$good_link = true;
			}
		}
		if($good)
			break;
	}

	if($good)
		$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
			Swal.fire(
				\"Congrats !\",
				\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
				\"success\"
			);</script>";
	else
	{
		if($good_link)
			throw new Exception("The link is good, but the params are not, take a look at the edit profile page to understand what you need to send.");
		throw new Exception("Unavailable payload");
	}
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}
connect_end($link);
delete_honeypot($dbname);

?>