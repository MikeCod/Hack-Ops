<?php
    require('M_badge.php');

    function option_badge($type) {
        if ($type == "display") { req_display_badge(); }
        else if ($type == "add") { 
            if ($_SESSION['administrator'] == '1') {
                req_add_badge();
            }
        } 
        if(!isset($_GET['del'])) {
            $_GET['del'] = '';
        } 
        else if ($_GET['del'] == true && $type == "delete") {
            echo "test";
        }
        else {
            #code ...
        }
    }

?>