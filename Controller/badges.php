<?php
require "../../Model/badges.php";


function option_badge($type) {
    if ($type == "display") { display_badge(); }
    else if ($type == "add") { 
        if ($_SESSION['administrator'] == '1') {
            add_badge();
        }
    } 
    else if($type == "delete") {
        if ($_SESSION['administrator'] == '1') {
            req_delete_badge();
        }
    } else if ($type == "modify") {
        if ($_SESSION['administrator'] == '1') {
            req_update_badge();
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
                    <a>N° = '.$badge['id'].'</a>
                    <a href="#">COMPLETE </a>
                    <a href="badges.php?t='.$_GET['t'].'&id='.$badge['id'].'&del=1"><i class="fas fa-times" style="color: #FF0000"></i></a>
                </div>
            </div>
        </div>
        ';
    }
}

function add_badge() {
    $error = '';
    if(!isset($_POST['name']))
        $_POST['name'] = '';
    if(!isset($_POST['level']))
        $_POST['level'] = '';
    if(!isset($_POST['desc']))
        $_POST['desc'] = '';
    if(!isset($_POST['type']))
        $_POST['type'] = '';
    if(!isset($_POST['goal']))
    $_POST['goal'] = '';

    if(isset($_POST['createB'])) {
        if(!isset($_POST['name']) or empty($_POST['name']) or
        !isset($_POST['level']) or empty($_POST['level']) or
        !isset($_POST['desc']) or empty($_POST['desc']) or 
        !isset($_POST['goal']) or empty($_POST['goal']) or !is_numeric($_POST['goal']) or
        !isset($_POST['type']) or empty($_POST['type']))
        {
            echo $error;
        } 
        else {
            req_add_badge();
        }
    }
}
?>