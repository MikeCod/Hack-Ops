<?php 

require "../config.php";
require "C_badge.php";

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
    <style>
    
    </style>
</head>
<body>
    <div class="container">
        <?php 
            option_badge("display"); 
            
            if ($_SESSION['administrator'] == '1') {
                option_badge("delete");
            }

            ?>
    </div>
    <div class="button" style="top: 800px; position: absolute;">
        <?php button("Back", "index.php", true, 200, "#ffffff"); ?>
    </div>
</body>
</html>