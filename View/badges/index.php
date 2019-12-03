<?php 
    require "../../Controller/badges.php";
    #session_start();

    if(isset($_POST['createB'])) {
        option_badge("add");
    }

    $score = 0;
    $chall = 0;
    $extra = 0;

    function button($text, $a, $href = false, $width = 200, $color = "white") {
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" media="all" type="text/css" href="../../include/css/badge/badge-style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../../include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="../../include/css/button.css">
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
        <div class="card" onclick="document.location='badges.php?t=Extra'" style="cursor: pointer">
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
                <h2 class="textB"><?php echo B_EXTRA ?></h2> 
            </div>
        </div>
        <div class="card" onclick="document.location='badges.php?t=Challenge'" style="cursor: pointer">
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
                <h2 class="textB"><?php echo B_CHALL ?></h2> 
            </div>
        </div>
        <div class="card" onclick="document.location='badges.php?t=Score'" style="cursor: pointer">
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
                <h2 class="textB"><?php echo B_SCORE ?></h2> 
            </div>
        </div>
    </div>
    <?php if ($_SESSION['administrator'] == '1') 
        echo '
        <div class="slideThree" style="bottom: 15%; position: absolute; ">  
            <input type="checkbox" value="None" id="slideThree" name="check" onclick="hideForm(\'hide\');" checked />
            <label for="slideThree"></label>
        </div>';
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
        <form method="POST" class="form-style">
            <h2 style="color: #DC1D1D">Add Badge</h2>
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
    <div class="button" style="bottom: 5%; position: absolute;">
        <a href="../dashboard.php">Back</a> 
    </div>
</body>
</html>