<?php
//Auteur : Mathieu MARTIN
//Date : 02/04/2012

include_once "stul_config.php";
include_once $fConnect;
include_once $fAdminFonct;
//include_once $fActionPhp;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Stul Admin</title>

</head>
<body>

<div id="all">
	<div id="content">
		<div id="login">
			<?php
			//Connexion de l'admin
			addFormAdmin();


			?>
		</div><!--login-->
	</div><!--content-->
</div><!--all-->

</body>
</html>