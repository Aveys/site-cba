<?php
	session_start();
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	if(isset($_POST["action"])){
		switch($_POST['action'])
		 {
			case "ajouter":
				if(isset($_SESSION["id"]))
					addArticle($_POST["texte"], $_SESSION["id"], $_POST["categorie"]);
			break;
			case "supprimer":
				deleteArticle($_POST["categorie"]);		
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
			case "Commenter":
				sql_commenter($_POST);
			break;
			case "Connexion":
				sql_connexion_user($_POST);
			break;
			case "Deconnexion":
				unset($_SESSION["pseudo"]);
				unset($_SESSION["id"]);
			break;
			case "Inscription":
				echo '<script language="Javascript">document.location.replace("?page=inscription");</script>';
			break;
			case "inscrire":
				sql_inscrire_user($_POST);
			break;
			case "Editer":
				sql_edit_user($_POST);
			break;
			default:
		}

	}
	echo '<script language="Javascript">document.location.replace(".");</script>';
?>
