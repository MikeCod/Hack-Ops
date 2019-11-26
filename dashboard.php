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
		<div id="vertical-menu" style="margin-top:-10px; min-width:250px;background: linear-gradient(180deg, Black 600px, White); /*animation: animation-breathe 2.5s infinite;*/">
			<?php
				echo "<div style=\"padding-bottom:100px;\">";
				button("Profile", "show_page('myprofile');", false, 200, "#2a77d7"); 
				echo "</div>";

				button("SQL Injection", "show_page('sql-injection', true);");
				button("CSRF", "show_page('csrf', true);");
				button("Code Injection", "show_page('code-injection', true);");

				echo "<div style=\"padding-top:100px;\">";
				button("Sign out", "C_sign-out.php", true, 200, "#2a77d7");
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
			<div id="challenges" style="padding-top:00px; display:none;">
				<h1 id="title-challenge"></h1>
				<p id="description" style="padding-top:100px; min-height:40px;"></p>
				<select id="difficulty" name="difficulty" style="width:200px; font-size:12pt; padding-left:10px;"></select>
				<a style="cursor:pointer; padding:5px 20px 5px 20px; width:200px; font-size:14pt; background:#2a2a2a;" onclick="start_challenge()">Start</a>
				<input type="text" id="flag" style="margin-top:20px;" placeholder="Flag" onkeypress="if(window.event.keyCode == 13) submit_flag();">
				<p id="flag-error" style="color:white; padding-top:50px;"></p>
			</div>
		</div>
		<script src="include/js/sweetalert2.all.js"></script>
		<script type="text/javascript">
			const descriptions = [
				[
					"sql-injection", 
					<?php 
						$first = true;
						foreach ($sql_injection as $result)
							echo (!$first ? ", " : $first = false)."[".$result['difficulty'].", \"".$result['description']."\"]";
					?>
				],
				[
					"csrf",
					<?php 
						$first = true;
						foreach ($csrf as $result)
							echo (!$first ? ", " : $first = false)."[".$result['difficulty'].", \"".$result['description']."\"]";
					?>
				],
				[
					"code-injection",
					<?php 
						$first = true;
						foreach ($code_injection as $result)
							echo (!$first ? ", " : $first = false)."[".$result['difficulty'].", \"".$result['description']."\"]";
					?>
				]
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
					document.getElementById("myprofile").style.display = "none";
					document.getElementById("challenges").style.display = "block";
					document.getElementById("difficulty").innerHTML = "<option value=\"0\" style=\"color:grey;\" onclick=\"document.getElementById('description').innerHTML = ''\">Chose a difficulty</option>";
					<?php

					function difficulty($link, $array)
					{
						$length = count($array);
						echo '"';
						for ($i = 0; $i < $length ; ++$i)
							echo "<option value=\\\"".$array[$i]['difficulty']."\\\" onclick=\\\"set_description();\\\">".$array[$i]['difficulty']."</option>";
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
							document.getElementById("title-challenge").innerHTML = "Code injection";
							document.getElementById("difficulty").innerHTML += <?php difficulty($link, $code_injection) ?>;
							break;
					}
					type = page_name;
					page_name = "challenges";
				}
				current_page_name = page_name;
			}

			function set_description()
			{
				num = 0;
				switch(type)
				{
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
				document.getElementById("description").innerHTML = descriptions[num][document.getElementById("difficulty").value][1];
			}

			function set_error(text)
			{
				document.getElementById("flag-error").innerHTML = text;
			}

			function submit_flag()
			{
				var req = new XMLHttpRequest();
				req.onreadystatechange = function() {
					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
						if(this.responseText == "*")
							Swal.fire(
								"Challenge completed",
								"Challenge added to achievements",
								"success"
							);
						else set_error(this.responseText);
					}
				};
				req.open("POST", "challenges/C_validate.php", true);
				req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				req.send("type="+type+"&difficulty="+document.getElementById("difficulty").value+"&flag="+document.getElementById("flag").value);
			}

			function start_challenge()
			{
				set_error("");
				link = "challenges/";
				switch(type)
				{
					case "sql-injection":
					case "csrf":
					case "code-injection":
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
		connect_end($link);
		include 'footer.php';
		?>
	</body>
</html>