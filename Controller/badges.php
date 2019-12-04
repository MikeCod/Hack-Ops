<?php
    require "../../Model/badges.php";

    #Function which update progress

    function option_badge($type) {
        if ($type == "display") { display_badge(); }
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


    function display_badge() {
        $badges = req_display_badge();
        while ($badge = $badges->fetch()) {

            if ($badge['value'] == "Master") {
                if ($_GET['t'] == "Score") {
                    $icon = "masterCode";
                }
                else if ($_GET['t'] == "Challenge") {
                    $icon = "masterSQL";
                } 
                else {
                    $icon = "Flag";
                }
            } 
            else if ($badge['value'] == "Experimented") {
                if ($_GET['t'] == "Score") {
                    $icon = "expertCode";
                }
                else if ($_GET['t'] == "Challenge") {
                    $icon = "expertSQL";
                } 
                else {
                    $icon = "expertCSRF";
                }
            } 
            else {
                if ($_GET['t'] == "Score") {
                    $icon = "beginnerCode";
                }
                else if ($_GET['t'] == "Challenge") {
                    $icon = "beginnerSQL";
                } 
                else {
                    $icon = "beginnerCSRF";
                }
            }
            echo '
            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <img src="../../include/img/complete-badge/'.$icon.'.png">
                        <h3>'.$badge['name'].'</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>'.$badge['description'].'</p>
                        <a href="#">COMPLETE </a>
                        <div class="optAdmin">
                            <a href="badge.php?t='.$_GET['t'].'&id='.$badge['id'].'&del=true"><i class="fas fa-times" style="color: #FF0000"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
?>