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
			0%	{ margin-left:70%; }
			100%{ margin-left:0; }
		}
		@keyframes animation-text {
			0%	{ opacity:0;/*color:rgba(255,255,255,0);*/ }
			25%	{ opacity:0;/*color:rgba(255,255,255,0);*/ }
			100%{ opacity:1;/*color:rgba(255,255,255,1);*/ }
		}
		h2 {
			font-size:18pt;
		}
		.tab {
			float:left;
			width:40px;
			height:1px;
		}
		p {
			padding-left:20%;
			padding-right:20%;
		}
		#home, #about-us, #how-does-it-work, #donate {
			font-size:14pt;
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
				<h1><?= NAME ?> <img src="../logo.jpg" width="100" height="100"></h1>
				<h2>Know limit</h2>
			</div>
			<div id="about-us" style="display:none; width:100%;">
				<h1>About us <img src="../logo.jpg" width="100" height="100"></h1>
				<p>We are a team made up of three S2 students. We chose this subject for our IT Project because we think security is a big part of the future of technology. Nowedays, people doesn't realize how important of this aspect of IT is. To help people to understand how hackers can exploit their site, our project provides a platform where you can improve your skills in offensive security.</p>
			</div>
			<div id="how-does-it-work" style="display:none; width:100%;">
				<h1>How does it work <img src="../logo.jpg" width="100" height="100"></h1>
				<h2>Create an account and train yourself to offensive security</h2>
				<div style="text-align:left; padding-left:24%; padding-top:50px;">
					<p>5 challenges:</p>
					<ul style="padding-left:24%;">
						<li><span class="tab"></span>File inclusion</li>
						<li><span class="tab"></span>Code injection</li>
						<li><span class="tab"></span>CSRF</li>
						<li><span class="tab"></span>SQL injection</li>
						<li><span class="tab"></span>Free</li>
					</ul>
				</div>
				<p>One challenge is a real project (<span style="color:deepskyblue;">Free</span>), a partnership with the project Plat-In.</p>
			</div>
			<div id="donate" style="display:none; width:100%;">
				<h1>Donate <img src="../logo.jpg" width="100" height="100"></h1>
				<h2>You can donate with Ethereum</h2>
				<div style="margin-top:50px; padding:10px 20px 10px 20px; background-color:grey;">
					<p>0xB7721BF01cD365f1e1D48ea2471a167b627f0531</p>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var last_page_name = "home";
			document.getElementById(last_page_name).style.display = "block";
			document.getElementById(last_page_name).style.animation = "800ms ease-in-out 0s animation-home";
			document.getElementById(last_page_name).getElementsByTagName("h2")[0].style.animation = "animation-text 3s";

			function show_page(page_name)
			{
				document.getElementById(last_page_name).style.display = "none";
				const snap = document.getElementById(page_name);
				snap.style.display = "block";
				snap.style.animation = "750ms ease-in-out 0s animation-home";
				var add = 0;
				Array.from(snap.getElementsByTagName("p")).concat(Array.from(snap.getElementsByTagName("h2"))).concat(Array.from(snap.getElementsByTagName("ul"))).concat(Array.from(snap.getElementsByTagName("li"))).concat(Array.from(snap.getElementsByTagName("span"))).forEach(function(element) {
					element.style.animation = (2500 + 125) + "ms ease-in-out 0s animation-text";
					add += 250;
				});

				last_page_name = page_name;
			}
		</script>
		<?php require_once 'footer.php' ?>
	</body>
</html>