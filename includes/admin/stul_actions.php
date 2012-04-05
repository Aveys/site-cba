<?php

	session_start();
	//Inclusion des fichiers
	require_once $_SERVER['DOCUMENT_ROOT'].'/site-cba/stul_config.php';
	require_once $a_fmConnect;
	require_once $a_fAdminFonct;
	require_once $a_fmSql;
	require_once $a_fmEscape;
	

	//Reception des GET et traitement
	if(isset($_GET["mode"]))
	{
		switch ($_GET["mode"]) {
			case 'delArticle':
				sql_delete_post($_GET["id"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
			break;
			case 'delCompte':
				sql_delete_user($_GET["id"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComptes");</script>';
			break;
			case 'delCom':
				sql_delete_com($_GET["id"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComs");</script>';
			break;
			
			default:break;
		}
	}

	//Reception des POST et traitement
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
					unset($_SESSION["idUser"]);
					echo '<script language="Javascript">document.location.replace(".");</script>';
				break;

			case 'Mettre à jour':
				sql_edit_post($_POST);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
			break;

			case 'Mettre à jour le commentaire':
				sql_edit_com($_POST);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComs");</script>';
			break;

			case 'Mettre à jour le compte':
				sql_allEdit_user($_POST["id_user"], $_POST["login"], $_POST["password"], $_POST["pseudo"], $_POST["email"], $_POST["status"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComptes");</script>';
			break;

			case 'Ajouter ce compte':
				sql_inscrire_user_by_admin($_POST["login"], $_POST["password"], $_POST["pseudo"], $_POST["email"], $_POST["dateReg"], $_POST["status"]);
				//La redirection ce fera dans action, si oui ou non le login et valide
				//echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComptes");</script>';
			break;
			case "Ajouter article":
				//print_r($_POST);
				//addArticle($_POST['content'], $_SESSION["idUser"],$_POST['title'], $_POST['tags'], $_POST['category']) or die(mysql_error());	
				//MatHack: Il faudra rajouter le champs de la categorie plus tard
				//$_POST['category']
				addArticle($_POST['content'], $_SESSION["idUser"], $_POST['title'], $_POST['tags'], $_POST['category']);				
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
				//header('Location:./viewer/index.php?mode=editArticles');
			break;

			default:break;
		}
	}

?>