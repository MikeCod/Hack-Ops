<!--===========================================================================================
// Gestion de : V_view.php
// Auteurs : Charles Régniez
// Version du : 18/12/2019
=============================================================================================-->
<?php
echo "<span style=\"float:left; width:200px;\">ID</span>". $_SESSION['id']."<br/>";
						echo "<span style=\"float:left; width:200px;\">Account status</span>".($_SESSION['administrator'] == '1' ? "Administrator" : "User")."<br>";
						echo "<span style=\"float:left; width:200px;\">Score</span>". $_SESSION['score']."<br/>";
						echo "<span style=\"float:left; width:200px;\">Email</span>". $_SESSION['email']."";
						echo "<div style=\"padding-top:40px\">";	
						echo "</div>";
?>