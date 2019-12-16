<?php 

require "../Model/leaderboard.php";

function leaderboard() {
    $rank = order();
    while ($leader = $rank->fetch()) {
        echo '<tr>';
        echo '<td align="center">'.$leader['username'].'</td>';
        echo '<td>&nbsp;&nbsp;'.$leader['score'].' '.ucfirst($data["prenom"]).'</td>';
        echo '</tr>';
    }
}

?>