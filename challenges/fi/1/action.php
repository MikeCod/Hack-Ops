<?php

const TARGET = "https://my.dark.site/";
$target_length = strlen(TARGET);

$extension = ".php";

try
{
	if(isset($_GET['page'])) {
		if((strpos($_GET['page'], "/") !== false or strpos($_GET['page'], "\\") !== false) and substr($_GET['page'], 0, 8) != "https://")
			throw new Exception("Nice try little hacker, but you have to show the remote resource");
		if(strpos($_GET['page'], "\0") !== false) {
			$_GET['page'] = substr($_GET['page'], 0, strpos($_GET['page'], "\0"));
			$extension = "";
		}
		if($_GET['page'] == TARGET) {
			if(!empty($extension))
				throw new Exception("Aren't you missing something ?");
			require "Challenges/ModelChallenge.php";
			$type = "";
			$difficulty = "";
			get_challenge($type, $difficulty);
			$result = "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
				Swal.fire(
				\"Congrats !\",
				\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
				\"success\"
				);</script>";
		}
	}
	else $_GET['page'] = "home";
	if(empty($result))
		$result = file_get_contents($_GET['page'].$extension);
}
catch(Exception $e)
{
	$result = $e->getMessage();
}

?>