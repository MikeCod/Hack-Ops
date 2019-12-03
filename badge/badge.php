<?php 

require "../config.php";
require "C_badge.php";

if(isset($_POST['modifyB'])) {
    option_badge("modify");
}


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
    <meta charset="UTF-8">
    <title><?php echo NAME ?></title>
    <link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
    <link rel="stylesheet" href="../include/css/badge/card-badge.css">
    <link rel="stylesheet" href="../include/font-awesome/css/all.min.css">
    <style>
    
    </style>
</head>
<body>
    <script>
        function hideForm(class) {

            if (document.getElementsById(class).style.display == 'none') {
                document.getElementsById(class).style.display = 'block';
            } 
            else {
                document.getElementsById(class).style.display = 'none';
            }
        };
    </script>
    <div class="container">
        <?php 
            option_badge("display");
            if (!isset($_GET['del'])) { 
                $_GET['del'] = ''; 
            } 
            else if ($_SESSION['administrator'] == '0' && $_GET['del'] == true) {
                option_badge("delete");
            }
        ?>
    </div>
    <div class="modify" id="hide" style="display:none">
        <form method="POST" class="form-style">
            <h2 style="color: #DC1D1D">Modify Badge</h2>
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
                <option value="Extra">Extra</option>
            </select><br>
            <input type="submit" name="createB" value="Create Badge"><br>
        </form>
    </div>
    <div class="param" style="left: 0px; top: 50px; position: absolute;">
        <?php button("Delete", "hideForm('optAdmin')", false, 200, "#FF0000"); ?>
        <?php button("Modify", "", true, 200, "#0000FF"); ?>
    </div>
    <div class="button" style="bottom: 5%; position: absolute;">
        <?php button("Back", "index.php", true, 200, "#ffffff"); ?>
    </div>
</body>
</html>