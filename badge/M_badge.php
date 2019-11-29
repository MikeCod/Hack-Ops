<?php 
require "../M_bdd.php";
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
        while($scoreB = $result->fetch()) {
            switch ($scoreB['name']) {
                case 'WELCOME':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }
            
            echo '
            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <img src="../include/img/complete-badge/masterSQL.png">
                        <h3>'.$scoreB['name'].'</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>'.$scoreB['description'].'</p>
                        <a href="#">COMPLETE ✔️</a>
                        <a href="badge.php?t='.$_GET['t'].'&del=true">DELETE ❌</a>
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