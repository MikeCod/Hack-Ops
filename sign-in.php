<?php

session_start();
require('M_bdd.php');
if(is_connected()) {
	header("Location: dashboard.php");
	exit();
}

require('config.php');
if(!isset($_SESSION['username']))
	$_SESSION['username'] = '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/buttons.css">
</head>
	<body>
		<div id="banner">
			<span id="name" onclick=><?php echo NAME ?></span>
		</div>
		<div style="padding-top:8%; padding-left:calc(50% - 200px)">
		<div class="form-style" style="max-width:400px;">
			<form action="C_sign-in.php" method="post">
				<fieldset>
					<br><br>
					<input name="username" placeholder="Username" type="text" value="<?php echo $_SESSION['username'] ?>" autofocus>
					<!--<br><br>-->
					<input name="password" placeholder="Password" type="password">
				</fieldset>
				<input type="submit" value="Sign in">
			</form>
			<?php
				if(isset($_SESSION['error'])) {
					echo '<p class="error">'.$_SESSION['error'].'</p>';
					unset($_SESSION['error']);
				}
			?>
		</div>
		</div>
	</body>
</html>