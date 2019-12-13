<?php

session_start();
require "../../../Model/DB.php";
redirect();

$result = "";

if(isset($_GET['id'])){
	require "Challenges/ModelChallenge.php";
	restore_include_path();
	include "action.php";
}
else $_GET['id'] = '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../../../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../../../include/css/button.css">
</head>
	<body>
		<div id="banner" style="float:left;">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%); font-size:24pt;">
				<?php echo NAME ?>
			</div>
		</div>
		<div style="padding-left:calc(50% - 200px);">
			<form class="form-style" method="GET">
				<h1 style="text-align:center;">SQL injection</h1>
				<h2 style="padding-bottom:40px; text-align:center;">Search a user by ID</h2>
				<input type="text" name="id" placeholder="ID" value="<?php echo $_GET['id'] ?>" autofocus>
				<input type="submit" style="margin-top:20px;">
				<?php echo $result ?>
			</form>
		</div>
	</body>
</html>