<?php

session_start();
require "../Model/DB.php";
redirect();


function button($text, $a, $href = false, $width = 200, $color = "white")
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

$link = NULL;

try
{
	$link = connect_start();

	$sql_injection = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'sql-injection' ORDER BY difficulty ASC")->fetchAll();
	$csrf = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'csrf' ORDER BY difficulty ASC")->fetchAll();
	$code_injection = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'code-injection' ORDER BY difficulty ASC")->fetchAll();
	$file_inclusion = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'fi' ORDER BY difficulty ASC")->fetchAll();
	$open_redirect = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'open-redirect' ORDER BY difficulty ASC")->fetchAll();
	$buffer_overflow = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'bof' ORDER BY difficulty ASC")->fetchAll();
	$integer_overflow = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'iof' ORDER BY difficulty ASC")->fetchAll();
	$format_string = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'fsb' ORDER BY difficulty ASC")->fetchAll();
	$race_condition = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'rc' ORDER BY difficulty ASC")->fetchAll();
	$use_after_free = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'uaf' ORDER BY difficulty ASC")->fetchAll();
	$password_cracking = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'pc' ORDER BY difficulty ASC")->fetchAll();
	$captcha_cracking = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'cc' ORDER BY difficulty ASC")->fetchAll();
	$free = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'free' ORDER BY difficulty ASC")->fetchAll();
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
				button("Profile", "show_page('myprofile');", false, 200, "#2a77d7"); 
				button("LeaderBoard", "show_page('leaderboard');", false, 200, "#2a77d7");
				button("Forum", "../Forum", true, 200, "#2a77d7");
				button("Documentation", "documentation.php", true, 200, "#2a77d7");
				echo "</div>";
			?>
			<ul>
				<li class="nav-section">
					<a class="button">Web</a>
					<ul>
						<li><?php button("Command Injection", "show_page('code-injection', true);"); ?></li>
						<li><?php button("CSRF", "show_page('csrf', true);"); ?></li>
						<li><?php button("File Inclusion", "show_page('fi', true);"); ?></li>
						<li><?php button("Open Redirect", "show_page('open-redirect', true);"); ?></li>
					</ul>
				</li>
				<li class="nav-section">
					<a class="button">System</a>
					<ul>
						<li><?php button("Format String", "show_page('fsb', true);"); ?></li>
						<li><?php button("Integer Overflow", "show_page('iof', true);"); ?></li>
						<li><?php button("Race Condition", "show_page('rc', true);"); ?></li>
						<li><?php button("Stack Buffer Overflow", "show_page('bof', true);"); ?></li>
						<li><?php button("Use After Free", "show_page('uaf', true);"); ?></li>
					</ul>
				</li>
				<li class="nav-section">
					<a class="button">Programming</a>
					<ul>
						<li><?php button("Password cracking", "show_page('pc', true);"); ?></li>
						<li><?php button("Captcha cracking", "show_page('cc', true);"); ?></li>
					</ul>
				</li>
			</ul>
			<?php
				//button("Free", "show_page('free', true);", false, 200, "#7ad7d7"); 

				echo "<div style=\"padding-top:100px;\">";
				button("Sign out", "../Controller/sign-out.php", true, 200, "#2a77d7");
				echo "</div>";
			?>
			
		</div>
		<div class="form-style" style="position:absolute; left:250px; top:100px; padding-right:50px;width:calc(100% - 350px);">
			<div id="myprofile" style="display:none;">
				<?php include "profile/index.php"; ?>
			</div>
			<div id="profile-edit" style="display:none;">
				<?php include "profile/edit.php"; ?>
			</div>
			<div id="profile-delete" style="display:none;">
				<?php include "profile/delete.php"; ?>
			</div>
			<div id="leaderboard" style="display:none;">
				<?php include "leaderboard.php"; ?>
			</div>
			<div id="challenges" style="padding-top:00px; display:none;">
				<h1 id="title-challenge"></h1>
				<p id="description" style="padding-top:100px; padding-bottom:20px; min-height:80px;"></p>
				<select id="difficulty" name="difficulty" style="width:200px; font-size:12pt; padding-left:10px;"></select>
				<a style="cursor:pointer; padding:5px 20px 5px 20px; width:200px; font-size:14pt; background:#2a2a2a;" onclick="start_challenge()">Start</a>
				<input type="text" id="flag" style="margin-top:20px;" placeholder="Flag" onkeypress="if(window.event.keyCode == 13) submit_flag();">
			</div>
			<p id="error" style="color:white; padding-top:50px;"></p>
		</div>
		<script type="text/javascript">
			const descriptions = [
					<?php 
						$first = true;
						echo "{";
						foreach ($sql_injection as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($csrf as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($code_injection as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($file_inclusion as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($open_redirect as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($buffer_overflow as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($integer_overflow as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($format_string as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($race_condition as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($use_after_free as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($password_cracking as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($captcha_cracking as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}, {";
						$first = true;
						foreach ($free as $result)
							echo (!$first ? ", " : $first = false).$result['difficulty'].": \"".$result['description']."\"";
						echo "}";
					?>
			];

			var current_page_name = "myprofile";
			document.getElementById(current_page_name).style.display = "block";
			var type = "";

			function show_page(page_name, challenge = false)
			{
				document.getElementById("description").innerHTML = "";
				set_error("");
				if(!challenge) {
					if(page_name != current_page_name) {
						document.getElementById(current_page_name).style.display = "none";
						document.getElementById(page_name).style.display = "block";
						type = "";
					}
				}
				else {
					document.getElementById(current_page_name).style.display = "none";
					document.getElementById("challenges").style.display = "block";
					document.getElementById("difficulty").innerHTML = "<option value=\"0\" style=\"color:grey;\" onclick=\"document.getElementById('description').innerHTML = ''\">Chose a difficulty</option>";
					<?php

					function difficulty($link, $array)
					{
						$length = count($array);
						echo '"';
						for ($i = 0; $i < $length ; ++$i) {
							echo "<option value=\\\"".$array[$i]['difficulty']."\\\" onclick=\\\"set_description();\\\">";
							switch($array[$i]['difficulty'])
							{
								case '1':
									echo 'Easy';
									break;
								case '2':
									echo 'Medium';
									break;
								case '3':
									echo 'Hard';
									break;
							}
							echo "</option>";
						}
						echo '"';
					}

					?>
					switch (page_name)
					{
						case "sql-injection":
							document.getElementById("title-challenge").innerHTML = "SQL injection";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $sql_injection) ?>;
							break;
						case "csrf":
							document.getElementById("title-challenge").innerHTML = "CSRF";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $csrf) ?>;
							break;
						case "code-injection":
							document.getElementById("title-challenge").innerHTML = "Command injection";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $code_injection) ?>;
							break;
						case "fi":
							document.getElementById("title-challenge").innerHTML = "File inclusion";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $file_inclusion) ?>;
							break;
						case "open-redirect":
							document.getElementById("title-challenge").innerHTML = "Open Redirect";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $open_redirect) ?>;
							break;
						case "bof":
							document.getElementById("title-challenge").innerHTML = "Stack Buffer Overflow";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $buffer_overflow) ?>;
							break;
						case "iof":
							document.getElementById("title-challenge").innerHTML = "Integer Overflow";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $integer_overflow) ?>;
							break;
						case "fsb":
							document.getElementById("title-challenge").innerHTML = "Format String";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $format_string) ?>;
							break;
						case "rc":
							document.getElementById("title-challenge").innerHTML = "Race Condition";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $format_string) ?>;
							break;
						case "uaf":
							document.getElementById("title-challenge").innerHTML = "Use After Free";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $format_string) ?>;
							break;
						case "pc":
							document.getElementById("title-challenge").innerHTML = "Password cracking";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $format_string) ?>;
							break;
						case "cc":
							document.getElementById("title-challenge").innerHTML = "Captcha cracking";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $format_string) ?>;
							break;
						case "free":
							document.getElementById("title-challenge").innerHTML = "Free";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $free) ?>;
							break;
					}
					type = page_name;
					page_name = "challenges";
				}
				current_page_name = page_name;
			}

			function set_description()
			{
				var num = 0;
				switch(type)
				{
					case "free":
						++num;
					case "cc":
						++num;
					case "pc":
						++num;
					case "uaf":
						++num;
					case "rc":
						++num;
					case "fsb":
						++num;
					case "iof":
						++num;
					case "bof":
						++num;
					case "open-redirect":
						++num;
					case "fi":
						++num;
					case "code-injection":
						++num;
					case "csrf":
						++num;
					case "sql-injection":
						break;
					default:
						document.getElementById("description").innerHTML = "Cannot load description. Please contact the developper.";
						return ;
				}
				document.getElementById("description").innerHTML = descriptions[num][document.getElementById("difficulty").value];
			}

			function set_error(text)
			{
				document.getElementById("error").innerHTML = text;
			}

			function submit_flag()
			{
				var req = new XMLHttpRequest();
				req.onreadystatechange = function() {
					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
						if(this.responseText.length >= 1 && this.responseText[0] == "*") {
							Swal.fire(
								"Challenge completed",
								"Challenge added to achievements",
								"success"
							);
							if(this.responseText.length >= 2 && this.responseText[1] != "0")
								Swal.fire(
									"Badge(s) completed",
									this.responseText.substr(1)+" badge(s) added to achievements",
									"success"
								);
						}
						else set_error(this.responseText);
					}
				};
				req.open("POST", "../challenges/ControllerValidate.php", true);
				req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				req.send("type="+type+"&difficulty="+document.getElementById("difficulty").value+"&flag="+document.getElementById("flag").value);
				document.getElementById("flag").value = "";
			}

			function start_challenge()
			{
				set_error("");
				link = "../challenges/";
				switch(type)
				{
					case "sql-injection":
					case "csrf":
					case "code-injection":
					case "fi":
					case "open-redirect":
					case "bof":
					case "iof":
					case "fsb":
					case "rc":
					case "uaf":
					case "pc":
					case "cc":
					case "free":
						link += type+"/";
						break;
					default:
						set_error("Unavailable challenge");
						return ;
				}
				difficulty = document.getElementById("difficulty").value;
				if(difficulty == 0) {
					set_error("No difficulty specified");
					return ;
				}
				
				window.open(link+difficulty+"/", "_blank");
			}
		</script>
		<?php

		}
		catch (Exception $e)
		{
			echo "Internal error: ".$e->getMessage();
		}
		connect_end($link);
		include 'footer.php';
		?>
	</body>
</html>