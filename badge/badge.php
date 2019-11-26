<?php 
    require "../config.php";
    require "C_badge.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo NAME ?></title>
    <link rel="stylesheet" href="../include/css/badge/scoreBadge.css">
    <style>
    
    </style>
</head>
<body>
    <div class="container">
        <div class="badge">
            <?php 
            if ($_GET['t'] == 'extra') { extra(); } 
            else if ($_GET['t'] == 'chall') { chall(); } 
            else if ($_GET['t'] == 'score') { score(); }
            ?>
        </div>
    </div>
</body>
</html>