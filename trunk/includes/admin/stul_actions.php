<?php
	session_start();
	//Inclusion des fichiers
	include $_SERVER["DOCUMENT_ROOT"].'/site-cba/stul_config.php';
	include_once $fConnect;
	include_once "../../".$fAdminFonct;
	

	if(isset($_POST["action"]))
	{
		switch ($_POST["action"]) {
			case 'Se connecter':
					checkLoginAdmin( $_POST['login'], $_POST['password']);
				break;
			case 'logout':
					unset($_SESSION["login"]);
					unset($_SESSION["pass"]);
					unset($_SESSION["keyAdmin"]);
					unset($_SESSION["adminAuth"]);
					
					header('Location:../../stul_admin.php'); 
				break;
			default:
				
				break;
		}

	}


	



?>