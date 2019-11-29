<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 22/11/2019
=============================================================================================-->

	<h1 style="padding-bottom:80px;">Bienvenue <?php echo $_SESSION['username'] ?> !</h1>
	
	<div class="consulte_account" style="padding-left:100px;">
		<?php
			echo "<span style=\"float:left; width:200px;\">ID</span>". $_SESSION['id']."<br/>";
			echo "<span style=\"float:left; width:200px;\">Account status</span>".($_SESSION['administrator'] == '1' ? "Administrator" : "User")."<br>";
			echo "<span style=\"float:left; width:200px;\">Score</span>". $_SESSION['score']."<br/>";
			echo "<span style=\"float:left; width:200px;\">Email</span>". $_SESSION['email']."";
			echo "<div style=\"padding-top:40px\">";
			button ("edit profile", "show_page('profile-edit');", false);
			button ("delete profile", "show_page('profile-delete');", false, 200, "red");
			echo "</div>";
		?>
	</div>

	<?php button ("Badge", "badge/", true, 200, "green"); ?>


