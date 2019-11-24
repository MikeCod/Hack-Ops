<?php 
    require "../config.php";

    switch ($_GET['t']) {
        case 'extra':
            echo $_GET['t'];
            require "../dashboard.php";
            break;
        case 'score':
            echo $_GET['t'];
            break;
        case 'chall':
            echo $_GET['t'];
            break;
        default:
            # code...
            break;
    }
?>