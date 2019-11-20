<?php 
    require "../config.php";
    $var = 90;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo NAME ?></title>
    <!--<link href="badge-style.css" rel="stylesheet">-->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500');

        *
        {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif
        }
        body 
        {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #101010;
        }
        .container
        {
            position: relative;
            width: 900px;
            display: flex;
            justify-content: space-around;
        }
        .container .card 
        {
            position: relative;
            min-width: 250px;
            background: linear-gradient(0deg,#1b1b1b,#222,#1b1b1b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
            border-radius: 4px;
            text-align: center;
            overflow: hidden;
            transition: 0.5s;
            margin-right: 20px;
            margin-left: 20px;
            padding: 50px 0px 50px 0px;
        }
        .container .card:hover
        {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgb(0, 0, 0,.5);
        }
        .container .card:before 
        {
        content: '';
        position: absolute;
        top: 0;
        left: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255,.03);
        pointer-events: none;
        z-index: 1; 
        }
        .percent 
        {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: inset 0 0 50px #000;
            background: #222;
            z-index: 1000;
        }
        .percent .number
        {
            position: absolute;
            top: 0;
            left: calc(50% - 35px);
            width: 100%;
            height: 100%;
            display: flex;
            justify-items: center;
            align-items: center;
            border-radius: 50%;
        }
        .percent .number h2 
        {
        color: #777;
        font-weight: 700;
        font-size: 40px;
        transition: 0.5s; 
        }
        .card:hover .percent .number h2 
        {
            color: #cccccc;
            font-size: 50px;
        }
        .percent .number h2 span
        {
            font-size: 24px;
            color: #777;
        }
        .card:hover .percent .number h2 span 
        {
            color: #ccc;
            transition: 0.5s; 

        }
        .text 
        {
            position: relative;
            color: #777;
            margin-top: 20px;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.5s;
        }
        .card:hover .text
        {
            color: #ccc;
        }
        svg
        {
            position: relative;
            width: 150px;
            height: 150px;
            z-index: 1000;
        }
        svg circle 
        {
            width: 100%;
            height: 100%;
            fill: none;
            stroke: #191919;
            stroke-width: 10;
            stroke-linecap: round;
            transform: translate(5px, 5px);
        }
        svg circle:nth-child(2) 
        {
            stroke-dasharray: 440;
            stroke-dashoffset: 440;
        }
        .card:nth-child(1) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 13) / 100);
            stroke: #00ff43;
        }
        .card:nth-child(2) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 50) / 100);
            stroke: #00a1ff;
        }
        .card:nth-child(3) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 35) / 100);
            stroke: #ff04f7;
        }
        .card:nth-child(4) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 55) / 100);
            stroke: #10e7dd;
        }
        .card:nth-child(5) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 10) / 100);
            stroke: #a9e409;
        }
        .card:nth-child(6) svg circle:nth-child(2)
        {
            stroke-dashoffset: calc(440 - (440 * 43) / 100);
            stroke: #a9e409;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>13<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_SCORE ?></h2> 
            </div>
        </div>
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>50<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_SQL ?></h2> 
            </div>
        </div>
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>65<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_CSRF ?></h2> 
            </div>
        </div>
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>55<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_CSRF ?></h2> 
            </div>
        </div>
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>10<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_CSRF ?></h2> 
            </div>
        </div>
        <div class="card">
            <div class="box">
                <div class="percent">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                    <div class="number">
                        <h2>43<span>%</span></h2>
                    </div>
                </div>
                <h2 class="text"><?php echo B_CSRF ?></h2> 
            </div>
        </div>
    </div>
</body>
</html>