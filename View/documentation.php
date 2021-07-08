<?php

session_start();
require "../Model/DB.php";

function button($text, $a, $href = false, $width = 300, $color = "white")
{
	$text = str_replace(' ', '<span style="color:transparent">_</span>', $text);
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?= NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
	<link href="../include/css/prism.css" rel="stylesheet" />
	<script src="../include/js/sweetalert2.all.js"></script>
	<style type="text/css">
		@keyframes animation-breathe {
			0%	{ background: black; }
			50%	{ background: #171717; }
			100%{ background: black; }
		}
		td {
			padding:10px 20px 10px 20px;
		}
	</style>
</head>
	<body>
		<div id="vertical-menu" style="margin-top:-10px; min-width:250px; background:linear-gradient(180deg, Black 700px, White); /*animation: animation-breathe 2.5s infinite;*/">
			<?php
				echo "<div style=\"padding-bottom:100px;\">";
				if(isset($_SESSION["id"]))
					button("Dashboard", "dashboard.php", true, 200, "#2a77d7");
				else
					button("Home", "index.php", true, 200, "#2a77d7"); 
				echo "</div>";
			?>
			<ul>
				<li class="nav-section">
					<a class="button">Web</a>
					<ul>
						<li><?php button("Command Injection", "show_page('ci');"); ?></li>
						<li><?php button("CSRF", "show_page('csrf');"); ?></li>
						<li><?php button("File Inclusion", "show_page('fi');"); ?></li>
						<li><?php button("Open Redirect", "show_page('or');"); ?></li>
						<li><?php button("SQL Injection", "show_page('sqli');"); ?></li>
						<li><?php button("XXE", "show_page('xxe');"); ?></li>
					</ul>
				</li>
				<li class="nav-section">
					<a class="button">System</a>
					<ul>
						<li><?php button("Buffer Overflow", "show_page('bof');"); ?></li>
						<!--<li><?php button("Double Free", "show_page('df');"); ?></li>-->
						<li><?php button("Format String", "show_page('fsb');"); ?></li>
						<li><?php button("Integer Overflow", "show_page('iof');"); ?></li>
						<li><?php button("NULL Pointer Dereference", "show_page('npd');"); ?></li>
						<li><?php button("Race Condition", "show_page('rc');"); ?></li>
						<li><?php button("Use After Free", "show_page('uaf');"); ?></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="form-style" style="position:absolute; left:250px; top:100px; padding-right:50px;width:calc(100% - 350px);">
			<div id="ci" style="display:none">
				<?= file_get_contents("../documentation/ci.html") ?>
			</div>
			<div id="csrf" style="display:none">
				<?= file_get_contents("../documentation/csrf.html") ?>
			</div>
			<div id="fi" style="display:none">
				<?= file_get_contents("../documentation/fi.html") ?>
			</div>
			<div id="or" style="display:none">
				<?= file_get_contents("../documentation/or.html") ?>
			</div>
			<div id="sqli" style="display:none">
				<?= file_get_contents("../documentation/sqli.html") ?>
			</div>
			<div id="xxe" style="display:none">
				<?= file_get_contents("../documentation/xxe.html") ?>
			</div>
			<div id="bof" style="display:block">
				<?= file_get_contents("../documentation/bof.html") ?>
			</div>
			<div id="df" style="display:none">
				<?= file_get_contents("../documentation/df.html") ?>
			</div>
			<div id="fsb" style="display:none">
				<?= file_get_contents("../documentation/fsb.html") ?>
			</div>
			<div id="iof" style="display:none">
				<?= file_get_contents("../documentation/iof.html") ?>
			</div>
			<div id="npd" style="display:none">
				<?= file_get_contents("../documentation/npd.html") ?>
			</div>
			<div id="rc" style="display:none">
				<?= file_get_contents("../documentation/rc.html") ?>
			</div>
			<div id="uaf" style="display:none">
				<?= file_get_contents("../documentation/uaf.html") ?>
			</div>
		</div>
		<script type="text/javascript">
			var current_page_name = "bof";

			function show_page(page_name)
			{
				document.getElementById(current_page_name).style.display = "none";
				document.getElementById(page_name).style.display = "block";
				current_page_name = page_name;
			}
			function spoiler(challenge) {
				if(document.getElementById(challenge).style.display == "none")
					document.getElementById(challenge).style.display = "block";
				else
					document.getElementById(challenge).style.display = "none";
			}
		</script>
		<?php
		include 'footer.php';
		?>
		<script src="../include/js/prism.js"></script>
	</body>
</html>