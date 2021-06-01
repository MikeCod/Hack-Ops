<?php 

require "../../Controller/badges.php";


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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php echo NAME ?></title>
    <link rel="stylesheet" media="all" type="text/css" href="../../include/css/button.css">
    <link rel="stylesheet" media="all" type="text/css" href="../../include/css/badge/card-badge.css">
    <link rel="stylesheet" media="all" type="text/css" href="../../include/font-awesome/css/all.min.css">
    <script src="../../include/js/sweetalert2.all.js"></script>
</head>
<body>
    <?php /*
        if ($_SESSION['administrator'] == '1')
        echo '
        <div class="slideThree" style="bottom: 15%; position: absolute;">
            <input type="checkbox" value="None" id="slideThree" name="check" onclick="hideForm(\'hide\');" checked />
            <label for="slideThree"></label>
        </div>';
        */
    ?>
    <script>
        function hideForm(id) {
            if (document.getElementById(id).style.display == 'none')
                document.getElementById(id).style.display = 'block';
            else
                document.getElementById(id).style.display = 'none';
        };
    </script>
    <div class="container">
        <?php
            option_badge("display");
            if (!isset($_GET['del']))
                $_GET['del'] = '';
            else if ($_SESSION['administrator'] == '1' && $_GET['del'] == "1")
                option_badge("delete");
        ?>
    </div>
    <div class="modify" id="hide" style="display:none">
        <form method="POST" style="left: 5%; top: 45%; position: absolute;">
            <h2 style="color: #0000FF">Modify Badge</h2>
            <!-- Select type : <option> $ID = 1 -- $NameChall = Master Score </option> -->
            Badge Number: 
            <input type="number" name="number" placeholder="Badge Number" required><br>
            Name:
            <input type="text" name="name" placeholder="Name"><br>
            Level:
            <select name="level" required>
                <option value="">--Please choose an option--</option>
                <option value="Beginner">Beginner</option>
                <option value="Experimented">Experimented</option>
                <option value="Master">Master</option>
            </select><br>
            Description:
            <input type="text" name="desc" placeholder="Description" required><br>
            Type:
            <select name="type" required>
                <option value="">--Please choose an option--</option>
                <option value="Score">Score</option>
                <option value="Challenge">Challenge</option>
                <option value="Rank">Rank</option>
            </select><br>
            Goal:
            <input type="text" name="goal" placeholder="Goal" required><br>
            <input type="submit" name="modifyB" value="Update Badge"><br>
        </form>
    </div>
    <!--<div class="param" style="left: 0px; top: 50px; position: absolute;">
        <?php //button("Delete", "confirmDelete()", false, 200, "#FF0000"); ?>
        <?php //button("Modify", "", true, 200, "#0000FF"); ?>
    </div>-->
    <div class="button" style="bottom: 7.5%; position: absolute;">
        <?php button("Back", "index.php", true, 200, "#ffffff"); ?>
    </div>
</body>
</html>