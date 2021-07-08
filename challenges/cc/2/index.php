<?php

session_start();
require "../../../Model/DB.php";
require "Challenges/ModelChallenge.php";

$result = "";
$status = "0";
$flag = "";
$type = "";
$difficulty = "";
if(isset($_GET['status']) && isset($_GET["flag"]) && isset($_GET["username"]) && isset($_GET["password"])) {
	restore_include_path();
	include "action.php";
}
get_challenge($type, $difficulty);
if(isset($_SESSION["id"])) {
	$link = connect_start();
	$response = $link->query("SELECT p.`status`, c.flag FROM `programming-challenges-status` p JOIN `challenges` c ON c.id = p.challenge WHERE user = '".$_SESSION["id"]."' AND challenge = (SELECT id FROM challenges WHERE type = '".$type."' AND difficulty = '".$difficulty."')");
	if($response->rowCount() == 1) {
		$line = $response->fetch();
		$status = $line["status"];
		$flag = $line["flag"];
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?= NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../../../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../../../include/css/button.css">
</head>
	<body>
		<div id="banner" style="float:left;">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(black 90%, #2a2a2a 90%); font-size:24pt;">
				<?= NAME ?>
			</div>
		</div>
		<div style="padding-left:calc(50% - 200px); width:100%;">
			<form class="form-style" method="POST" style="width:400px;">
				<h1 style="text-align:center;">Captcha Cracking</h1>
				<p>Submit your code to ch-cc-2@<?= CHALLENGE_SSH ?>:/home/ch-cc-2/captcha-cracking.git<br>
				Make sure that your code doesn't exceed 20 lines (without blank lines) and don't forget to add your login informations :<br>
				USERNAME="&#60;your username&#62;"
				PASSWORD="&#60;your password&#62;"
				</p>
				<p>Current status: <?php
				switch($status) {
					case '0':
						echo '<span style="color:#a33">Nothing sent</span>';
						break;
					case '1':
						echo '<span style="color:#33a">In progress</span>';
						break;
					case '2':
						echo '<span style="color:#a33">Failed</span>';
						break;
					case '3':
						echo '<span style="color:#3a3">Success</span>';
						echo "<script src=\"../../../include/js/sweetalert2.all.js\"></script>\n<script type=\"text/javascript\">
							Swal.fire(
							\"Congrats !\",
							\"You can now validate this challenge with the flag ".get_flag($type, $difficulty)."\",
							\"success\"
							);
						</script>";
						echo "<br><a href=\"?status=0&flag=".$flag."&username&password\">Reset</a>";
						break;
				}
				?></p>
				<a href="?">Refresh this page</a>
				<?= $result != "" ? $result : "" ?>
			</form>
		</div>
	</body>
</html>