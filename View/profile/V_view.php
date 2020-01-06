<!--===========================================================================================
// Gestion de : V_view.php
// Auteurs : Charles Régniez
// Version du : 19/12/2019
=============================================================================================-->
<?php
	// user profile
	require_once "../model/leaderboard.php";
	echo "<span style=\"float:left; width:200px;\">ID</span>". $_SESSION['id']."<br/>";
	echo "<span style=\"float:left; width:200px;\">Rank</span>".get_rank()."<br/>";
	echo "<span style=\"float:left; width:200px;\">Account status</span>".($_SESSION['administrator'] == '1' ? "Administrator" : "User")."<br>";
	echo "<span style=\"float:left; width:200px;\">Score</span>". $_SESSION['score']."<br/>";
	echo "<span style=\"float:left; width:200px;\">Email</span>". $_SESSION['email']."";
?>
<div style="padding-top:40px"></div>

<!-- buttons -->

<form method="GET" action="dashboard.php">
	<input type="submit" name="rubrique" value="edit" /><br/>
	<input type="submit" name="rubrique" value="delete" /><br/>
</form>
