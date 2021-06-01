<?php

$rank = order();
$i = 0;
$last_score = -1;
$same = 0;
while($user = $rank->fetch()) {
	if($last_score == $user['score'])
		++$same;
	else
		$same = 0;
	echo '<tr'.($user['username'] == $_SESSION['username'] ? ' style="background:grey; color:black;"' : '').'>
        <td>'.(++$i - $same).'</td>
        <td>'.$user['username'].'</td>
        <td>'.$user['score'].'</td>
    </tr>
    ';
    $last_score = $user['score'];
}

?>