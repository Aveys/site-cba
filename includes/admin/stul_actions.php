<?php

	session_start();
	//Inclusion des fichiers
	require_once $_SERVER['DOCUMENT_ROOT'].'/site-cba/stul_config.php';
	require_once $a_fmConnect;
	require_once $a_fAdminFonct;
	require_once $a_fmSql;
	

	//Reception des GET et traitement
	if(isset($_GET["mode"]))
	{
		switch ($_GET["mode"]) {
			case 'delArticle':
				sql_delete_post($_GET["id"]);
				header('Location:./viewer/index.php?mode=editArticles');
			break;
			case 'delCompte':
				sql_delete_user($_GET["id"]);
				header('Location:./viewer/index.php?mode=editComptes');
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
					
					header('Location:.'); 
				break;

			case 'Mettre à jour':
				sql_edit_post($_POST);
				header('Location:./viewer/index.php?mode=editArticles'); 
			break;

			case 'Mettre à jour le compte':
				sql_allEdit_user($_POST["id_user"], $_POST["login"], $_POST["password"], $_POST["pseudo"], $_POST["email"], $_POST["status"]);
				header('Location:./viewer/index.php?mode=editComptes'); 
			break;

			case 'Ajouter ce compte':
				sql_inscrire_user_by_admin($_POST["login"], $_POST["password"], $_POST["pseudo"], $_POST["email"], $_POST["dateReg"], $_POST["status"]);
				//header('Location:./viewer/index.php?mode=editComptes'); 
			break;


			case "Ajouter l'article":
				addArticle($_POST['title'], $_POST['content'], 0, 1);
				header('Location:./viewer/index.php?mode=editArticles'); 
			break;

			default:break;
		}
	}

?>