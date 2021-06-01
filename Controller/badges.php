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
    }
    else {
        #...
    }
}

function display_badge() {
    $none = req_displayN_badge();
    if($none->rowCount() > 0)
        echo '<h1 style="float:left; position:absolute; top:0; left:40px; margin-top:-100px; color:#ddd; font-size:32pt;">'.$_GET['t'].' badges</h1>';
    else {
        echo '<h1 style="float:left; position:absolute; top:0; left:40px; margin-top:-100px; color:white; font-size:32pt;">Unavailable category</h1>';
        return ;
    }
    $complete = req_displayC_badge();
    $badgeC = array();
    while($badge = $complete->fetch())
        $badgeC[] = $badge['id'];
    $i = 0;
    //var_dump($badgeC);
    $completed = false;
    while ($badgeN = $none->fetch()) {
        $completed = in_array($badgeN['id'], $badgeC);
        //var_dump($completed);
        if ($badgeN['value'] == "Master") {
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
        else if ($badgeN['value'] == "Experimented") {
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
                <div class="content"'.($completed ? ' style="opacity:0.8;"' : '').'>
                    <img src="../../include/img/complete-badge/'.$icon.'.png">
                    <h3>'.$badgeN['name'].'</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <p>'.$badgeN['description'].'</p>
                    '.($completed ? '<a>COMPLETED</a>' : '').'
                    <a href="badges.php?t='.$_GET['t'].'&id='.$badgeN['id'].'&del=1"><i class="fas fa-times" style="color: #FF0000"></i></a>
                </div>
            </div>
        </div>
        ';
        $i++;
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