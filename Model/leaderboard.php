<?php 

function order() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT username, score FROM users ORDER BY score DESC")))
            throw new Exception("Could not access to the table");
    }
    catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
    return $result;
}

function get_rank()
{
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT count(*) FROM users WHERE score >= ".$_SESSION['score'])))
            throw new Exception("Could not access to the table");
    }
    catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
    return $result->fetch()['count(*)'];
}

?>