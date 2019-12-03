<?php
    require('M_badge.php');

    function option_badge($type) {
        if ($type == "display") { req_display_badge(); }
        else if ($type == "add") { 
            if ($_SESSION['administrator'] == '1') {
                req_add_badge();
            }
        } 
        else if($type == "delete") {
            if ($_SESSION['administrator'] == '1') {
                req_delete_badge();
            }
        } 
        else {
            #...
        }
    }

?>