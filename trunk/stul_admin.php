<?php
//Auteur : Mathieu MARTIN
//Date : 02/04/2012
session_start();

//Inclusion des fichiers
require 'stul_config.php';
require_once $fmConnect;
require_once $fAdminFonct;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href='<?php echo $vTheme; ?>/admin.css' />
<title>Stul Admin</title>
</head>
<body>

<div id="all">
	<div id="content">
			<?php
			//Connexion de l'administrateur verification avec SESSION
			if((isset($_SESSION["keyAdmin"]) == (isset($_SESSION["pass"])*isset($_SESSION["login"])) && isset($_SESSION["adminAuth"]) == 1))
				header('Location:'.$fViewerAdmin.'?mode=board');
				//Debug
				//echo "Ok page admin";
			else
				addFormAdmin();	
			?>
	</div><!--content-->
</div><!--all-->

</body>
</html>