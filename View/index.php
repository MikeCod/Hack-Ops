<?php

require "../Controller/config.php";

function button($text, $a, $href = false, $width = 150, $color = "white")
{
	$text = str_replace(' ', '<span style="color:transparent">_</span>', $text);
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
	<style type="text/css">
		@keyframes animation-home {
			0%	{ margin-left:100%; }
			100%{ margin-left:0; }
		}
	</style>
</head>
	<body>
		<div id="banner">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%);">
				<?php
					button("Home", "show_page('home');");
					button("About us", "show_page('about-us');");
					button("How does it work", "show_page('how-does-it-work');", false, 200);
					button("Donate", "show_page('donate');");
					echo "<div style=\"float:right;\">"; button("Sign in", "sign-in.php", true, 150, "#2a77d7"); button("Sign up", "sign-up/", true, 150, "#2a77d7"); echo '</div>';
				?>
			</div>
		</div>
		<div style="font-size:32pt; text-align:center; overflow:hidden;">
			<div id="home" style="padding-top:10%; display:none; width:100%;">
				<?php echo '<span style="font-size:32pt;font-size:Open Sans">'.NAME.'</span>' ?>
			</div>
			<div id="about-us" style="display:none; width:100%;">
				About us
			</div>
			<div id="how-does-it-work" style="display:none; width:100%;">
				How does it work
			</div>
			<div id="donate" style="display:none; width:100%;">
				Donate
			</div>
		</div>
		<script type="text/javascript">
			var last_page_name = "home";
			document.getElementById(last_page_name).style.display = "block";

			function show_page(page_name)
			{
				document.getElementById(last_page_name).style.display = "none";
				document.getElementById(page_name).style.display = "block";
				document.getElementById(page_name).style.animation = "animation-home 1s";
				last_page_name = page_name;
			}
		</script>
		<?php require_once 'footer.php' ?>
	</body>
</html>