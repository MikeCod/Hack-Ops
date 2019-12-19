<!--===========================================================================================
// Gestion de : C_index.php
// Auteurs : Charles Régniez
// Version du : 18/12/2019
=============================================================================================-->
<?php
	if (!(isset($_GET['rubrique'])))
	{
		$_GET['rubrique'] = 'view';
	}
	if (isset($_GET['rubrique']))
	{	
		switch ($_GET['rubrique']) 
		{
			case 'view':
				include ("profile/V_view.php");
				break;
			case 'edit':
				include ("profile/V_edit.php");
				break;
			case 'delete':
				include ("profile/V_delete.php");
				break;
			default: 
				include ("profile/V_view.php");
				break;
		}
	}
?>