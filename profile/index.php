<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 22/11/2019
=============================================================================================-->

	<h1>Bienvenue <?php echo $_SESSION['username'] ?> !<br/></h1>
	
	<div class="consulte_account">
		<?php
			echo "<span style=\"float:left; width:300px;\">Your account is the number</span>". $_SESSION['id']."<br/>";
			echo "<span style=\"float:left; width:300px;\">Account status</span>".($_SESSION['administrator'] == '1' ? "Administrator" : "User")."<br>";
			echo "<span style=\"float:left; width:300px;\">The score account is</span>". $_SESSION['score']."<br/>";
			echo "<span style=\"float:left; width:300px;\">Your email on this account is</span>". $_SESSION['email']."<br/>";
			button ("edit profile", "show_page('profile-edit');");
			button ("delete profile", "show_page('profile-delete');", false, 200, "red");
		?>
	</div>

	<div id="edit" style="display:none">
		<h1>Edit</h1>
	</div>

	<div id="delete" style="display:none">
		<p>Delete</p>
	</div>

	<a href="./badge"><h3 style="color: #00FF00">ACCES BADGE</h3></a>
=======
	
	<a href="./badge">salut</a>
>>>>>>> 0c8001f67ab8db61e70afecea5cd30a7d3009a07



