<?php

session_start();
require "../../../M_bdd.php";
redirect();

$result = "";
if(isset($_POST['message']) and !empty($_POST['message'])) {
	require "../../M_init_honeypot.php";
	include "C_test.php";
}
else $_POST['message'] = '<img src="" width="0" height="0" border="0">';

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
		<div style="padding-left:calc(50% - 200px); width:100%;">
			<form class="form-style" method="POST" style="width:400px;">
				<h1 style="text-align:center;">CSRF</h1>
				<h2 style="padding-bottom:40px; text-align:center;">Send a mail</h2>
				<a href="edit-profile.php" target="_blank" style="color:#a2a2a2;">Edit profile</a><br>
				<p style="padding-top:10px;">To: administrator</p>
				<p>Subject: You shouldn't trust all mails</p>
				<textarea style="width:100%;height:100px;" name="message" rows="16" cols="32" autofocus><?php echo $_POST['message'] ?></textarea>
				<input type="submit" style="margin-top:10px;">
				<?php echo $result ?>
			</form>
		</div>
	</body>
</html>