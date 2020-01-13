<?php

$rank = order();
$i = 0;
while($user = $rank->fetch()) {
	echo '<tr'.($user['username'] == $_SESSION['username'] ? ' style="background:grey; color:black;"' : '').'>
        <td>'.(++$i).'</td>
        <td>'.$user['username'].'</td>
        <td>'.$user['score'].'</td>
    </tr>
    ';
}

?>