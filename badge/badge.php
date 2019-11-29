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
        <?php option_badge("display"); ?>
    </div>
</body>
</html>