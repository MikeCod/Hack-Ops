<?php

session_start();
require "../../Controller/config.php";

if(!isset($_SESSION['form']['username'])) $_SESSION['form']['username'] = '';
if(!isset($_SESSION['form']['email'])) $_SESSION['form']['email'] = '';

$_POST = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?= NAME ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../../include/css/buttons.css">
</head>
	<body>
		<div id="banner">
			<span id="name" style="padding-left:10%; padding-right:10%;"><?= NAME ?></span>
		</div>
		<div style="padding-top:3%;padding-left:calc(50% - 200px);">
			<div class="form-style">
				<form action="../../Controller/sign-up/" method="post">
					<fieldset style="padding-top:50px;">
						<input type="text" name="username" placeholder="Username" value="<?= $_SESSION['form']['username']; ?>" autofocus>
						<input type="email" name="email" placeholder="email" value="<?= $_SESSION['form']['email']; ?>">
						<br><br>
						<input type="password" name="password" placeholder="Password">
						<input type="password" name="cpassword" placeholder="Confirm password">
					</fieldset>
					<input type="submit" name="submit" style="width:400px; background:#2a2a2a; color:white;" value="Create account">
				</form>
				<?php
					if (isset($_SESSION['error']))
					{
						echo '<p class="error">';
						switch ($_SESSION['error'])
						{
							case 'fields':
								echo 'One or several fields aren’t specified.';
								break;
							case 'email':
								echo 'Malformed email.';
								break;
							case 'username':
								echo 'A username can only contain latin letters, digits and spaces. Minimum length is 3 characters. Maximum length is 16 characters.';
								break;
							case 'smtp':
								echo 'This email doesn’t exist.';
								break;
							case 'password':
								echo 'The password must contain at least 8 characters, one tiny letter, one capital letter, one digit and one special character.';
								break;
							case 'match':
								echo 'Passwords doesn\'t match.';
								break;
							case 'used-email':
								echo 'Email already used.';
								break;
							case 'used-username':
								echo 'Username already used.';
								break;
							default:
								echo 'Internal error. Sorry for the inconvenience.';
						}
						echo '</p>';
						unset($_SESSION['error']); 
					}
				?>
			</div>
		</div>
	</body>
</html>