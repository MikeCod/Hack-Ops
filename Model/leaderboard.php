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
    $leaderboard = order();
    $last_score = -1;
    $same = 0;
    $rank = 0;

    while($user = $leaderboard->fetch()) {
        $same = ($last_score == $user['score'] ? $same+1 : 0);
        ++$rank;
        if($user['username'] == $_SESSION['username'])
            break;
        $last_score = $user['score'];
    }
    return $rank - $same;
}

?>