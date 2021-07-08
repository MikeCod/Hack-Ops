<?php

session_start();
require "../../../Model/DB.php";
redirect();

$result = "";
include "action.php";

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
		<div style="float:left; margin-left:50px;">
			<form class="form-style" method="GET">
				<h1 style="text-align:center;">RFI</h1>
				<select id="page" name="page" onchange="document.location = './?page='+document.getElementById('page').value">
					<option value="home"<?= ($_GET['page'] == "home" ? " selected" : "") ?>>Home</option>
					<option value="profile"<?= ($_GET['page'] == "profile" ? " selected" : "") ?>>Profile</option>
					<option value="leaderboard"<?= ($_GET['page'] == "leaderboard" ? " selected" : "") ?>>Leaderboard</option>
				</select>
			</form>
		</div>
		<div class="form-style" style="float:right; margin-right:10%; width:60%">
			<?= $result ?>
		</div>
	</body>
</html>