<?php 
    require "../config.php";
    session_start();
    $score = 10;
    $chall = 90;
    $extra = 80;

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
    <link href="badge-style.css" rel="stylesheet">
    <style>
        svg circle:nth-child(2) 
        {
            stroke-dasharray: 440;
            stroke-dashoffset: 440;
        }
        .card:nth-child(1) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * <?php echo $extra ?>) / 100);
            stroke: #00ff43;
        }
        .card:nth-child(2) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * <?php echo $chall ?>) / 100);
            stroke: #00a1ff;
        }
        .card:nth-child(3) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * <?php echo $score ?>) / 100);
            stroke: #ff04f7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card" onclick="document.location='badge.php?t=extra'">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2><?php echo $extra ?><span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_EXTRA ?></h2> 
            </div>
        </div>
        <div class="card" onclick="document.location='badge.php?t=chall'">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2><?php echo $chall ?><span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_CHALL ?></h2> 
            </div>
        </div>
        <div class="card" onclick="document.location='badge.php?t=score'">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2><?php echo $score ?><span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_SCORE ?></h2> 
            </div>
        </div>
    </div>
    <?php if ($_SESSION['administrator'] == '1') 
        echo '<input type="button" value="Hide" onclick="hideForm("hide");" />' 
    ?>
    <script>
        function hideForm(id) {
            if (document.getElementById(id).style.display == 'none') {
                document.getElementById(id).style.display = 'block';
            } 
            else {
                document.getElementById(id).style.display = 'none';
            }
        };
    </script>
    <div class="add" id="hide" style="display:none">
        <?php button("TEST", "badge.php", true, 100, "#FFFFFF"); ?>
        <form method="POST">
            Name:
            <input type="text" name="name" placeholder="Name"><br>
            Birthday:
            <input type="number" name="bYear" placeholder="Year" required>
            <input type="number" name="bMonth" placeholder="Month" required>
            <input type="number" name="bDay" placeholder="Day" required><br>
            Owner:
            <input type="text" name="owner" placeholder="Owner" required><br>
            Veterinary:
            <input type="number" name="vYear" placeholder="Year" required>
            <input type="number" name="vMonth" placeholder="Month" required>
            <input type="number" name="vDay" placeholder="Day" required><br>
            Dentist:
            <input type="number" name="dYear" placeholder="Year" required>
            <input type="number" name="dMonth" placeholder="Month" required>
            <input type="number" name="dDay" placeholder="Day" required><br>
            <input type="submit" name="go" value="Create Folder"><br>
        </form>
    </div>
</body>
</html>