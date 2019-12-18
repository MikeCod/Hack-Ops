<!--===========================================================================================
// Gestion de : C_index.php
// Auteurs : Charles Régniez
// Version du : 18/12/2019
=============================================================================================-->
<?php
	echo "coucou cest le c_index";
	
	if (!(isset($_GET['rubrique'])))
	{
		$_GET['rubrique'] = 'view';
	}
	if (isset($_GET['rubrique']))
	{	
		switch ($_GET['rubrique']) 
		{
			case 'view':
				include ("../../View/profile/V_view.php");
				break;
			case 'edit':
				include ("V_edit.php");
				break;
			case 'delete':
				include ("V_delete.php");
				break;
			default: 
				include ("V_view.php");
				break;
		}
	}
?>