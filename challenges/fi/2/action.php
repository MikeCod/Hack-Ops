<?php

const TARGET = "flag";
$target_length = strlen(TARGET);

try
{
	if(isset($_GET['page'])) {
		if(strpos($_GET['page'], "/") !== false or strpos($_GET['page'], "\\") !== false)
			throw new Exception("No need to search so far");
		if(strlen($_GET['page']) >= $target_length and strtolower(substr($_GET['page'], 0, $target_length)) == TARGET) {
			if($_GET['page'] == TARGET or strlen($_GET['page']) >= $target_length+1 and substr($_GET['page'], 0, $target_length+1) != TARGET."\0")
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
		$result = file_get_contents($_GET['page'].".php");
}
catch(Exception $e)
{
	$result = $e->getMessage();
}

?>