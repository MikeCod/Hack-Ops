<?php

session_start();

require('config.php');
redirect();

function button($text, $a, $href = false, $width = 200, $color = "white")
{
	$text = str_replace(' ', '<span style="color:Black">_</span>', $text);
	if ($color != "white")
		$color .= ";text-shadow:unset";
	echo '
	<div class="svg-wrapper">
		<svg height="40" width="'.$width.'">
			<rect class="shape" height="40" width="'.$width.'" />
			<div class="text">
				<a style="color:'.$color.';'.(!$href ? 'cursor:pointer;" onclick' : '" href').'="'.$a.'"><span class="spot"></span>'.$text.'</a>
			</div>
		</svg>
	</div>';
}

$link = NULL;

try
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/button.css">
	<style type="text/css">
		h1 {
			padding-left:100px;
		}
	</style>
</head>
	<body>
		<div id="banner" style="padding-left:200px; float:left;">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%); font-size:24pt;">
				<?php echo NAME ?>
			</div>
		</div>
		<div id="vertical-menu" style="background: linear-gradient(to right, Black 200px, White);">
			<?php
				echo "<div style=\"padding-bottom:100px;\">";
				button("Profile", "show_page('myprofile');", false, 200, "#2a77d7");
				echo "</div>";

				button("SQL Injection", "show_page('sql-injection');");
				button("CSRF", "show_page('csrf');");
				button("Code Injection", "");

				echo "<div style=\"padding-top:100px;\">";
				button("Sign out", "sign-out.php", true, 200, "#2a77d7");
				echo "</div>";
			?>
		</div>
		<?php $link = connect_start(); ?>
		<div class="form-style" style="padding-left:300px; padding-right:50px;width:calc(100% - 350px);">
			<div id="myprofile" style="display:none;">
				<h1><?php echo $_SESSION['username'] ?></h1>
			</div>
			<div id="sql-injection" style="display:none;">
				<h1>SQL Injection</h1>
<<<<<<< HEAD
				<?php
					try
					{
						$link = new PDO(true);
					}
				?>
				<a href="challenges/SQL-injection/"></a>
=======
				
>>>>>>> 6541fe91d2f3bf75561912106b4b69014c8aa805
			</div>
			<div id="csrf" style="display:none;">
				<h1>CSRF</h1>

			</div>
			<a style="cursor:pointer;" onclick="start_challenge();"></a>
			<input type="text" id="flag" style="display:none;" placeholder="Flag" onclick="if(window.event.keyCode == 13) submit_flag();">
		</div>
		<script type="text/javascript">
			var last_page_name = "myprofile";
			document.getElementById(last_page_name).style.display = "block";

			var type = "";

			function show_page(page_name)
			{
				if(page_name == "myprofile")
					document.getElementById("flag").style.display = "none";
				else
				{
					document.getElementById("flag").style.display = "block";
					type = page_name;
				}
				document.getElementById(last_page_name).style.display = "none";
				document.getElementById(page_name).style.display = "block";
				last_page_name = page_name;
			}

			function submit_flag()
			{

			}

			function start_challenge()
			{

			}
		</script>
		<?php 

		}
		catch (Exception $e)
		{
			
		}
		include 'footer.php';
		?>
	</body>
</html>
