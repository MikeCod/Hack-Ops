<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 20/12/2019
=============================================================================================-->

<h1 style="padding-bottom:20px;">Welcome <?php echo $_SESSION['username'] ?> !</h1>
<div style="position:absolute; top:40px; right:400px;">
	<?php button ("Badge", "badges/", true, 200, "green"); ?>
</div>

<div class="consulte_account" style="padding-left:100px;">
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
</div>
<?php
button ("Edit profile", "show_page('profile-edit')", false, 200, "deepskyblue");
echo '<div style="position:absolute; top:200px; right:400px;">';
	button ("Delete account", "show_page('profile-delete')", false, 200, "red");
echo '</div>';
?>