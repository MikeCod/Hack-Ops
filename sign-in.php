<?php

session_start(); 

require('config.php');

if(isset($_SESSION['id'])){
	header("Location: user.php");
	exit();
}

$error = "";

if(isset($_POST['submit']))
{
	if(!isset($_POST['login']) or !isset($_POST['password']) or empty($_POST['login'])){
		$error = "All the fields must be fill";
		goto end;
	}
	
	if(!($link = connect_start())) {
		$error = "Internal error: Could not connect to database. Sorry for the inconvenience.";
		goto end;
	}

	if(!($result = $link->query("SELECT id, login FROM ".USERS." WHERE login = ".$link->quote($_POST['login'])." AND password = '".hash('sha3-512', $_POST['password'])."'"))){
		$error = "Internal error: Could not connect to the table. Please try again later. Sorry for the inconvenience.";
		goto end;
	}
	connect_end($link);
	
	if($result->rowCount() != 1){
		$error = "Unavailable login or password";
		goto end;
	}

	$_SESSION=array();
	$_SESSION=$result->fetch();

	header("Location: user.php");
	exit();
}

end:
if(!isset($_POST['login']))
	$_POST['login'] = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/style.css">
	<style type="text/css">

	.error { color: #b7a0d0; font-size:10pt; }

	</style>
</head>
	<body>
		<div id="banner">
			<br>
			<span id="name" style="padding-left:250px;"><?php echo NAME ?></span>
		</div>
		<div style="padding-top:10%;padding-left:calc(50% - 200px);">
		<div class="form-style" style="width:400px;">
			<form action="sign-in.php" method="post">
				<fieldset>
					<br><br>
					<input name="login" placeholder="Login" type="text" value="<?php echo $_POST['login']; ?>" autofocus>
					<input name="password" placeholder="Password" type="password">
				</fieldset>
				<input type="submit" name="submit" style="width:400px;text-transform:uppercase;font-size:12pt;" value="Sign in">
			</form>
			<p class="error"><?php echo $error ?></p>
		</div>
		</div>
	</body>
</html>