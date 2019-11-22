<!--===========================================================================================
// Gestion de : affichage du profile de l'utilisateur
// Auteurs : Charles Régniez
// Version du : 22/11/2019
=============================================================================================-->
<?php
session_start();
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo NAME ?></title>
	<link rel="icon" type="image/jpg" href="">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" media="all" type="text/css" href="include/css/button.css">
	<style type="text/css">
		h1 {
			padding-left:100px;
		}

		@keyframes animation-breathe {
			0%	{ background: black; }
			50%	{ background: #171717; }
			100%{ background: black; }
		}
	</style>
</head>

<body>
	<h1>Bienvenue <?php echo $_SESSION['username'] ?> !</h1>
	
	<p>je m'appel mes couilles en slipe</p>
</body>



