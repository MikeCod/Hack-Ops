<?php

require('config.php');

function button($text, $a, $href = false, $width = 200, $color = "white")
{
	$text = str_replace(' ', '<span style="color:Black">_</span>', $text);
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
	<link rel="stylesheet" media="all" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/button.css">
</head>
	<body>
		<div id="banner" style="padding-left:200px; float:left;">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%); font-size:24pt;">
				<?php echo NAME ?>
			</div>
		</div>
		<div id="vertical-menu" style="background: linear-gradient(to right, Black 200px, White);">
			<?php
				button("Profile", "show_page('myprofile');");
				button("SQL Injection", "show_page('sql-injection');");
				button("CSRF", "show_page('csrf');");
				button("SSRF", "");
				button("XSS", "");
				button("Code Injection", "");
				button("RFI", "");
				button("Include", "");

				echo "<div style=\"padding-top:100px;\">";
				button("Sign out", "", true, 200, "#2a77d7");
				echo "</div>";
			?>
		</div>
		<div style="padding-left:250px; width:calc(100% - 250px);">
			<div id="myprofile" style="display:none;">
				my profile
			<div id="sql-injection" style="display:none;">
				SQL
			</div>
			<div id="csrf" style="display:none;">
				CSRF
			</div>
		</div>
		<script type="text/javascript">
			var last_page_name = "myprofile";
			document.getElementById(last_page_name).style.display = "block";

			function show_page(page_name)
			{
				document.getElementById(last_page_name).style.display = "none";
				document.getElementById(page_name).style.display = "block";
				last_page_name = page_name;
			}
		</script>
		<?php require_once 'footer.php' ?>
	</body>
</html>