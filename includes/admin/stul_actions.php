<?php

	session_start();
	//Inclusion des fichiers
	require_once $_SERVER['DOCUMENT_ROOT'].'/site-cba/stul_config.php';
	require_once $a_fmConnect;
	require_once $a_fAdminFonct;
	require_once $a_fmSql;
	require_once $a_fmEscape;
	require_once $_SERVER['DOCUMENT_ROOT'].'/site-cba/controller/controle_upload_image.php';
	

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
			case 'delCat':
				sql_delete_cat($_GET["id"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editCats");</script>';
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
					unset($_SESSION["id"]);
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

			case 'Mettre à jour la categorie':
				sql_edit_cat_of_idCat($_POST["id_cat"], $_POST["content"], $_POST["title"]);
				echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editCats");</script>';
			break;

			case 'Ajouter ce compte':
				sql_inscrire_user_by_admin($_POST["login"], $_POST["password"], $_POST["pseudo"], $_POST["email"], $_POST["dateReg"], $_POST["status"]);
				//La redirection ce fera dans action, si oui ou non le login et valide
				//echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComptes");</script>';
			break;

			case 'Ajouter cette categorie':
				sql_add_cat($_POST["name"], $_POST["desc"]);
				//La redirection ce fera dans action, si oui ou non le login et valide
				//echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editComptes");</script>';
			break;
			case "Ajouter article":
				//print_r($_POST);
				//addArticle($_POST['content'], $_SESSION["idUser"],$_POST['title'], $_POST['tags'], $_POST['category']) or die(mysql_error());	
				//MatHack: Il faudra rajouter le champs de la categorie plus tard
				//$_POST['category']
				if($_POST['image'] == "image_up")
				{
					$upload1 = upload('fichier',$rootSite."avatars/",15360, array('png','gif','jpg','jpeg') );
					if($upload1 === true)
					{
						unset($_SESSION['erreur_upload']);
						addArticle($_POST['content'], $_SESSION["id"], $_POST['title'], $_POST['tags'], $_POST['category'],$_SESSION['dest'],false);
						unset($_SESSION['dest']);				
						echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
					}
					else
					{
						$_SESSION['erreur_upload'] = $upload1;
						echo '<script language="Javascript">history.go(-1);</script>';
					}
				}
  				else if($_POST['image'] == "image_default")
  				{
					unset($_SESSION['erreur_upload']);
					addArticle($_POST['content'], $_SESSION["id"], $_POST['title'], $_POST['tags'], $_POST['category'],'default',"default");
					unset($_SESSION['dest']);				
					//echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
				}
  				else if($_POST['image'] == "image_existante")
  				{
					unset($_SESSION['erreur_upload']);
					addArticle($_POST['content'], $_SESSION["id"], $_POST['title'], $_POST['tags'], $_POST['category'],"existe",$_POST['image_bdd']);
					unset($_SESSION['dest']);				
					echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
				}
				//header('Location:./viewer/index.php?mode=editArticles');
			break;

			default:break;
		}
	}

?>