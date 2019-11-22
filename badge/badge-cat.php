<?php 
    require "../config.php";
    $score = 10;
    $chall = 65;
    $extra = 80;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo NAME ?></title>
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
</body>
</html>