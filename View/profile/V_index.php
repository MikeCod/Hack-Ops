<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 20/12/2019
=============================================================================================-->

<h1 style="padding-bottom:20px;">Welcome <?php echo $_SESSION['username'] ?> !</h1>
	
<div class="consulte_account" style="padding-left:100px;">
	<?php
		include ("Controller/profile/C_index.php");
	?>
</div>

<?php button ("Badge", "badges/", true, 200, "green"); ?>


