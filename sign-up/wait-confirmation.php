<?php

session_start(); 
/*
if(!isset($_SESSION['wait-confirmation']))
	header('location: register.php');
*/
include('../config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php echo $NAME ?></title>
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/themes/classic.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/buttons.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/answer.css">
	<link rel="stylesheet" href="../include/css/sweetalert.css">
	<script src="../include/js/sweetalert.js"></script>
</head>
	<body>
		<div id="banner">
			<br>
			<font id="name"><?php echo $NAME ?></font>
		</div>
		<div style="padding-top:10%">
			<div class="form-style">
				<h1 style="text-align:center;">Email confirmation</h1>
				<p>You should receive an email, thanks to check by clicking on the link!</p>
				<p>You can <a href="action.php">resend an email</a> if you didn't receive anything.</p>
			</div>
		</div>
	</body>
</html>