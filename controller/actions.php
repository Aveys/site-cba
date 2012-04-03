<?php
	session_start();
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	require_once("../stul_config.php");
	require_once($a_fmSql);
	require_once($a_fmConnect);
	if(isset($_POST["action"])){
		switch($_POST['action'])
		 {
			case "ajouter":		//ajouter un post
				if(isset($_SESSION["id"]))
					addArticle($_POST["texte"], $_SESSION["id"]);
			break;
			case "Supprimer com":	//supprimer un com
				sql_delete_com($_POST["id_com"]);		
			break;
			case "Supprimer post": 	//supprimer un post
				sql_delete_post($_POST["id_post"]);		
			break;
			/*case "Jaime":
				$query = "update stul_post set nbJaime = nbJaime+1 where id='".$_POST["id"]."'";
				mysql_query($query) or die(mysql_error());
				$query = "update synchro_jaime_log set jaime = 1 where id_article='".$_POST["id"]."' and id_log='".$_SESSION["pseudo"]."'";
				$result = mysql_query($query) or die(mysql_error());
			break;
			case "J\'aime plus":
				$query = "update articles set nbJaime = nbJaime-1 where id='".$_POST["id"]."'";
				mysql_query($query) or die(mysql_error());
				$query = "update synchro_jaime_log set jaime = 0 where id_article='".$_POST["id"]."' and id_log='".$_SESSION["pseudo"]."'";
				mysql_query($query) or die(mysql_error());
			break;*/
			case "Commenter":	//ajoute un commentaire
				sql_commenter($_POST);
			break;
			case "Connexion":	//se log
				sql_connexion_user($_POST);
			break;
			case "Deconnexion":	//se delog
				unset($_SESSION["pseudo"]);
				unset($_SESSION["id"]);
			break;
			case "Inscription":	//redirige vers la page d'inscription
				echo '<script language="Javascript">document.location.replace("../?page=inscription");</script>';
			break;
			case "inscrire":	//inscription du nouvel utilisateur dans la bdd
				sql_inscrire_user($_POST);
			break;
			case "Editer":		//editer le profil de l'utilisateur
				sql_edit_user($_POST);
			break;
			default:
		}

	}
	echo '<script language="Javascript">document.location.replace("../.");</script>';	//redirection vers l'index.php
?>
