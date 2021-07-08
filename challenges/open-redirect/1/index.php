<?php

session_start();
require "../../../Model/DB.php";
redirect();

$result = "";
if(isset($_GET['redirect'])){
	require "Challenges/ModelChallenge.php";
	restore_include_path();
	include "action.php";
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
			<a href="?redirect=https://harmony-project.xyz">Redirect</a>
			<?= $result ?>
		</div>
	</body>
</html>