<?php 
require "./DB.php";
session_start();


function req_add_badge() {
    $error = "";
    if(!isset($_POST['name']))
        $_POST['name'] = '';
    if(!isset($_POST['level']))
        $_POST['level'] = '';
    if(!isset($_POST['desc']))
        $_POST['desc'] = '';
    if(!isset($_POST['type']))
        $_POST['type'] = '';
    
    if(isset($_POST['createB']))
    {
        $link = NULL;
        try
        {
            if(!($link = connect_start()))
                throw new Exception("Could not connect to database");
                
            if(!isset($_POST['name']) or empty($_POST['name']) or
                !isset($_POST['level']) or empty($_POST['level']) or
                !isset($_POST['desc']) or empty($_POST['desc']) or 
                !isset($_POST['type']) or empty($_POST['type']))
                {
                    throw new Exception("A field is unavailable");
                } 
            if(!($result = $link->query("INSERT INTO badges(name, value, description, type) 
            VALUES(".$link->quote($_POST['name']).",
            ".$link->quote($_POST['level']).",
            ".$link->quote($_POST['desc']).",
            ".$link->quote($_POST['type']).")"))) 
            {
                throw new Exception("No access to the table");
            }
            header("Location: ./");
            exit();
    
        } catch (Exception $th) {
            echo "Internal error: ".$th->getMessage();
        }
        connect_end($link);
    }   
}
function req_delete_badge() { 
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if(!($result = $link->query("DELETE FROM badges WHERE id=".$link->quote($_GET['id']).""))) 
        {
            throw new Exception("No access to the table");
        }
        header("Location: ./");
        exit();

    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

function req_display_badge() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT * FROM badges WHERE type=".$link->quote($_GET['t']).""))) {
                throw new Exception("No access to the table");
        }
        if (!($req = $link->query("SELECT * FROM `completed-badges`"))) {
            throw new Exception("No access to the table");
        }

        while ($badge = $result->fetch()) {

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
            while ($complete = $req->fetch()) {
                if ($complete['achievement'] == $badge['id']) {
                    echo "prout";
                    $check = '<i class="fas fa-check" style="color: #00FF00"></i>'; 
                } 
                else {
                    $check = '<i class="fas fa-times" style="color: #FF0000"></i>';
                }
            }
            

            /*echo $icon;*/

            echo '
            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <img src="../include/img/complete-badge/'.$icon.'.png">
                        <h3>'.$badge['name'].'</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>'.$badge['description'].'</p>
                        <a href="#">COMPLETE '.$check.'</a>
                        <div class="optAdmin">
                            <a href="badge.php?t='.$_GET['t'].'&id='.$badge['id'].'&del=true"><i class="fas fa-times" style="color: #FF0000"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            ';

        }
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}
?>