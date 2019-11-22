<?php

session_start();
require "M_bdd.php";
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

	$sql_injection = $link->query("SELECT difficulty, description FROM challenges WHERE type = 'sql-injection'")->fetchAll();
	$csrf = $link->query("SELECT description FROM challenges WHERE type = 'csrf'")->fetchAll();
	$code_injection = $link->query("SELECT description FROM challenges WHERE type = 'code-injection'")->fetchAll();
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

		@keyframes animation-breathe {
			0%	{ background: black; }
			50%	{ background: #171717; }
			100%{ background: black; }
		}
	</style>
</head>
	<body>
		<div id="banner" style="padding-left:200px; float:left;">
			<div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(#101010 90%, #2a2a2a 95%); font-size:24pt;">
				<?php echo NAME ?>
			</div>
		</div>
		<div id="vertical-menu" style="margin-top:-10px; /*background: linear-gradient(to right, Black 200px, White);*/ animation: animation-breathe 2.5s infinite">
			<?php
				echo "<div style=\"padding-bottom:100px;\">";
				button("Profile", "show_page('myprofile');", false, 200, "#2a77d7"); 
				echo "</div>";

				button("SQL Injection", "show_page('sql-injection');");
				button("CSRF", "show_page('csrf');");
				button("Code Injection", "show_page('code-injection');");

				echo "<div style=\"padding-top:100px;\">";
				button("Sign out", "C_sign-out.php", true, 200, "#2a77d7");
				echo "</div>";
			?>
		</div>
		<?php $link = connect_start(); ?>
		<div class="form-style" style="padding-left:300px; padding-right:50px;width:calc(100% - 350px);">
			<div id="myprofile" style="display:none;">
				<h1><?php echo $_SESSION['username'] ?></h1>
				<?php include("V_profile.php"); ?>
			</div>
			<div id="sql-injection" style="display:none;">
				<h1>SQL Injection</h1>
<<<<<<< HEAD
				<p id="description" style="display:none"></p>
=======
>>>>>>> f472ddf608081074670e175a150a41ec1737bfed
			</div>
			<div id="csrf" style="display:none;">
				<h1>CSRF</h1>

			</div>
			<div id="code-injection" style="display:none;">
				<h1>Code injection</h1>

			</div>
			<div id="submit-challenge" style="padding-top:100px; display:none;">
				<select id="difficulty" name="difficulty" style="width:200px; font-size:12pt; padding-left:10px;">

				</select>
				
				<br>
				<input type="hidden" id="type" value="">
				<a style="cursor:pointer; padding:10px 20px 10px 20px; width:200px; font-size:14pt; background:#2a2a2a;" onclick="start_challenge()">Start</a>
				<input type="text" style="margin-top:20px;" placeholder="Flag" onclick="if(window.event.keyCode == 13) submit_flag();">
				<p id="error" style="padding-top:50px;"></p>
			</div>
		</div>
		<script type="text/javascript">
			const descriptions = [
				["sql-injection",
					[<?php 
						$first = true;
						foreach ($sql_injection as $key => $description) {
							if(!$first)
								echo ", ";
							else
								$first = true;
							echo "[$key, $description]";
						}
					?>]
				],
			];
			var last_page_name = "myprofile";
			document.getElementById(last_page_name).style.display = "block";

			function show_page(page_name)
			{
				set_error("");
				if(page_name == "myprofile")
					document.getElementById("submit-challenge").style.display = "none";
				else {
					document.getElementById("submit-challenge").style.display = "block";
					document.getElementById("difficulty").innerHTML =  "<option value=\"0\" style=\"color:grey;\">Chose a difficulty</option>";
					switch(page_name)
					{
						case "sql-injection":
							document.getElementById("difficulty").innerHTML += 
							<?php
							echo '"';
							
							while($difficulty = $result->fetch()['difficulty'])
								echo "<option value=\\\"".$difficulty."\\\">".$difficulty."</option>";
							echo '"';
							?>;
						case "csrf":
							document.getElementById("difficulty").innerHTML += 
							<?php
							echo '"';
							$result = $link->query("SELECT difficulty FROM challenges WHERE type = 'csrf'");
							while($difficulty = $result->fetch()['difficulty'])
								echo "<option value=\\\"".$difficulty."\\\">".$difficulty."</option>";
							echo '"';
							?>;
						case "code-injection":
							document.getElementById("difficulty").innerHTML += 
							<?php
							echo '"';
							$result = $link->query("SELECT difficulty FROM challenges WHERE type = 'code-injection'");
							while($difficulty = $result->fetch()['difficulty'])
								echo "<option value=\\\"".$difficulty."\\\">".$difficulty."</option>";
							echo '"';
							?>;
					}
					document.getElementById("type").value = page_name;
				}
				document.getElementById(last_page_name).style.display = "none";
				document.getElementById(page_name).style.display = "block";
				last_page_name = page_name;
			}

			function set_description()
			{
				document.getElementById("description").innerHTML = 
			}

			function set_error(text)
			{
				document.getElementById("error").innerHTML = text;
			}

			function submit_flag()
			{
				set_error("");
				const req = new XMLHttpRequest();
				req.open("POST", "challenges/C_validate.php");
				req.readystatechange = function() {
					if (this.readyState === XMLHttpRequest.DONE && this.status === 200)
						set_error(this.res)
				}
				req.send("type="+document.getElementById("type").value+"&difficulty="+document.getElementById("difficulty").value);
			}

			function start_challenge()
			{
				set_error("");
				link = "challenges/";
				challenge = document.getElementById("type").value;
				switch(challenge)
				{
					case "sql-injection":
					case "csrf":
					case "code-injection":
						link += challenge+"/";
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

			function sleep(ms)
			{
				return new Promise(resolve => setTimeout(resolve, ms));
			}
		</script>
		<?php 

		}
		catch (Exception $e)
		{
			die("Internal error: ".$e->getMessage());

		}
		include 'footer.php';
		?>
	</body>
</html>