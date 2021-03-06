<?php

session_start();
require "../../../Model/DB.php";
require "Challenges/ModelChallenge.php";

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

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
				<p>Connect to the server using SSH :</p>
				<p>ssh ch-<?= $type.'-'.$difficulty ?>@<?= CHALLENGE_SSH ?></p>
			</form>
		</div>
	</body>
</html>