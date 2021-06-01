<?php 
require "DB.php";
session_start();


function req_add_badge() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if(!($result = $link->query("INSERT INTO badges(name, value, description, type, goal) 
        VALUES(
        ".$link->quote($_POST['name']).",
        ".$link->quote($_POST['level']).",
        ".$link->quote($_POST['desc']).",
        ".$link->quote($_POST['type']).",
        ".$link->quote($_POST['goal']).")"))) 
        {
            throw new Exception("No access to the table");
        }
        return $result;
        header("Location: ./");
        exit();

    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}   

function req_delete_badge() { 
    $link = NULL;
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

function req_displayN_badge() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT * FROM badges WHERE type=".$link->quote($_GET['t']).""))) {
                throw new Exception("No access to the table");
        }
        return $result;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

function req_displayC_badge() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query('SELECT badges.* FROM `completed-badges` 
        LEFT JOIN badges ON `completed-badges`.badge = badges.id
        WHERE type = '.$link->quote($_GET['t']).' AND `completed-badges`.user = '.$link->quote($_SESSION['id'])))) {
            throw new Exception("No access to the table");
        }
        return $result;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}
/*
function req_update_badge() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if(!($result = $link->query("UPDATE badges 
        SET name = ".$link->quote($_POST['name']).",
            value = ".$link->quote($_POST['level']).",
            description = ".$link->quote($_POST['desc']).",
            type = ".$link->quote($_POST['type']).",
            goal = ".$link->quote($_POST['goal']." 
        WHERE id=".$link->quote($_POST['number'])."")))) 
        {
            throw new Exception("No access to the table");
        }
        return $result;
        header("Location: ./");
        exit();

    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}
*/
function percent($type) {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if(!($complete = $link->query('SELECT badges.name,badges.type, users.username FROM `completed-badges` 
        LEFT JOIN badges ON `completed-badges`.badge = badges.id
        LEFT JOIN users ON `completed-badges`.user = users.id
        WHERE type = '.$link->quote($type).' AND `completed-badges`.user = '.$link->quote($_SESSION['id'])))) 
        {
            throw new Exception("No access to the table");
        }
        if(!($all = $link->query('SELECT * FROM badges WHERE type = '.$link->quote($type).''))) 
        {
            throw new Exception("No access to the table");
        }
        if ($complete->rowcount() == 0) {
            $div = 0;
        } else {
            $div = round(($complete->rowcount() / ($all->rowCount()) * 100));
        }
        return $div;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}
?>