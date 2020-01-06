<?php 

function order() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT username, score FROM users ORDER BY score DESC")))
            throw new Exception("Could not access to the table");
        return $result;
    }
    catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

?>