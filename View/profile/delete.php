<!--===========================================================================================
// Gestion de : affichage de delete le profile
// Auteurs : Charles Régniez, Dimitri Simon
// Version du : 03/12/2019
=============================================================================================-->

<h1>Delete Profile</h1>
<p>Are you sure you want to delete your profile ?</p>
<form methode="post" action="profile/C_delete.php">
<input type="text" id="delete-email" value="<?php echo $_SESSION['email'] ?>">
<input type="password" id="delete-password" placeholder="Actual Password">
<input type="hidden" name="action" value="delete">
<input type="submit">
</form>