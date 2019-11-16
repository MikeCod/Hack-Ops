<?php

include('../config.php');

abstract class Error
{
	const NO_ERROR = 0;
    const MISSING = 1;
    const NOT_FOUND = 2;
    const UNAVAILABLE_PASSWORD = 3;
    const INTERNAL_ERROR = 4;
}

$error = Error::NO_ERROR;

if(!isset($_GET['email']) and !isset($_GET['code']))
{
	$error = Error::MISSING;
	goto end;
}
$response = mysqli_query($base, "SELECT * FROM confirmation WHERE email='".$_GET['email']."'");
if(mysqli_num_rows($response) != 1)
{
	$error = Error::NOT_FOUND;
	goto end;
}
$data = mysqli_fetch_array($response, MYSQLI_ASSOC);
if($data['code'] != $_GET['code'])
{
	$error = Error::UNAVAILABLE_PASSWORD;
	goto end;
}

$response = mysqli_query($base, "SELECT id FROM users ORDER BY id DESC LIMIT 1");
if($response == FALSE)
{
	$error = Error::INTERNAL_ERROR;
	goto end;
}

$data_l = mysqli_fetch_assoc($response);
$id = $data_l['id'];
$id = intval($id) + 1;

if(!mysqli_query($base, "INSERT INTO users(id, email, password, name, last_name, age, sex, country, language, friends) VALUES('".$id."', '".$_GET['email']."', ".$data['data'].", '/')"))
{
	$error = Error::INTERNAL_ERROR;
	goto end;
}

if(!mysqli_query($base, "INSERT INTO questionnaire(id, _character, hobbies, music, sexuality, religion, psychiatry) VALUES('$id', '".str_pad("", 100, "0")."', '".str_pad("", 10, "0")."', '".str_pad("", 10, "0")."', '".str_pad("", 10, "0")."', '".str_pad("", 10, "0")."', '".str_pad("", 10, "0")."')"))
{
	$error = Error::INTERNAL_ERROR;
	goto end;
}

$_SESSION=array();
$_SESSION['id']=$id;

end:
if($error == Error::INTERNAL_ERROR)
{
	include('../bug-report.php');
	add_bug(Criticality::VERY_HIGH, $FROM_SERVER, "INTERNAL_ERROR (".$_SERVER['PHP_SELF'].")");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php echo $NAME ?></title>
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/main.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/buttons.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/answer.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/fontawesome/css/all.min.css">
	
	<style type="text/css">
	.form-style { max-width:60%; }
	h1 { font-family:Curvy; font-size:32pt; }
	p { font-size: 12pt; }
	</style>
</head>
	<body>
		<div id="banner">
			<br>
			<font id="name"><?php echo $NAME ?></font>
		</div>
		<div class="form-style" style="text-align:center;">
			<script type="text/javascript">
				swal(
				{
					<?php
					$title = '';
					$text = '';
					$type = 'error';
					$confirm_text = 'OK';
					switch($error)
					{
						case Error::NO_ERROR:
							$type = 'success';
							$title = 'Account created';
							$text = 'Account created successfully!';
							$confirm_text = 'Continue';
							break;
						case Error::MISSING:
							$title = 'Missing';
							$text = 'Email or code is missing. Thanks to click on the link we sent to validate your email and create your account.';
							break;
						case Error::NOT_FOUND:
							$title = 'Not found';
							$text = 'It seems this email isn\'t waiting for an account.';
							break;
						case Error::UNAVAILABLE_PASSWORD:
							$title = 'Wrong code';
							$text = 'Wrong code. Thanks to click on the link we sent to validate your email and create your account.';
							break;
						default:
							$title = 'Internal error';
							$text = 'An internal error happened! The error has been reported and we\'ll investigate about this issue as soon as possible!\nSorry for the inconvenience.';
					}
					echo 'title: "'.$title.'",\ntype: "'.$type.'",\ntext: "'.$text.'",\nconfirmButtonText: "'.$confirm_text.'",\n';
					?>
					confirmButtonColor: "#DD6B55",
					showCancelButton: false,
					closeOnConfirm: false,
				},
					function(isConfirm){
						<?php
						if ($error == Error::NO_ERROR) {
							echo 'document.location.href="../user.php";';
						}
						?>
					}
				);
			</script>
		</div>
	</body>
</html>
				