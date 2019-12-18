<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 23/11/2019
=============================================================================================-->

	<h1 style="padding-bottom:80px;">Welcome <?php echo $_SESSION['username'] ?> !</h1>
	
	<div class="consulte_account" style="padding-left:100px;">
		<?php
			include ("Controller/profile/C_index.php");

			// place this button in vue_categories without the one of the categorie
			
			echo '	<div class = "menu_profile">
					<form method="GET" action="dashboard.php">
					<input type="submit" name="rubrique" value="view" /><br/>
					<input type="submit" name="rubrique" value="edit" /><br/>
					<input type="submit" name="rubrique" value="delete" />
					</form>
					</div>';
		?>
	</div>

	<?php button ("Badge", "badges/", true, 200, "green"); ?>


