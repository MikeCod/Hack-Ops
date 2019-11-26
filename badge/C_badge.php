<?php

    require('M_badge.php');
    session_start();
    if ($_SESSION['administrator'] == '1') {
        req_add_badge();
    }


    function score() {
        req_display_score();
    }
?>