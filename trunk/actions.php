<?php
	session_start();
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	include_once "connect.php";
	include_once "articles.php";
	if(isset($_POST["action"])){
		switch($_POST['action'])
		 {
			case "ajouter":
				if(isset($_SESSION["id"]))
					addPost($_POST["texte"], $_SESSION["id"], $_POST["categorie"]);
			break;
			case "supprimer":
				deleteBlague($_POST["categorie"]);		
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
				if(isset($_POST['id_parent']))
					$query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date,com_parent) values('".$_SESSION['id']."','".$_POST['id']."','".htmlspecialchars($_POST['commentaire'])."',now(),'".$_POST['id_parent']."')";
				else
					$query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date) values('".$_SESSION['id']."','".$_POST['id']."','".htmlspecialchars($_POST['commentaire'])."',now())";
				mysql_query($query) or die(mysql_error());
			break;
			case "Connexion":
				if ( checkLogin($_POST["pseudo"], $_POST["mdp"])){
					unset($_SESSION['erreur_connect']);
					$_SESSION["pseudo"] = $_POST["pseudo"];
					$query = "select user_id from STUL_USERS where user_login='".$_POST["pseudo"]."' and user_pass='".$_POST["mdp"]."'";
					$result = mysql_query($query) or die(mysql_error());
					$row = mysql_fetch_assoc($result);
					$_SESSION["id"] = $row["user_id"];
				}
			break;
			case "Deconnexion":
				unset($_SESSION["pseudo"]);
				unset($_SESSION["id"]);
			break;
			case "Inscription":
				echo '<script language="Javascript">document.location.replace("inscription.php");</script>';
			break;
			case "inscrire":
				$query = "select * from STUL_USERS where user_login='".$_POST["pseudo"]."'";
				$result=mysql_query($query);
				if(mysql_num_rows($result) == 0)
				{
					addPseudo($_POST["pseudo"], $_POST["mdp"], $_POST["mail"]);
				}
				else
				{
					$_SESSION["erreur_inscrip"] = "Ce pseudo existe deja";
					echo '<script language="Javascript">document.location.replace("inscription.php");</script>';
				}
			break;
			case "Editer":
				$query = "update STUL_USERS set mail = '".$_POST["mail"]."' where user_id='".$_POST["id"]."'";
				mysql_query($query) or die(mysql_error());
				/*$query = "update log set date_naissance = '".$_POST["naissance"]."' where login='".$_POST["id"]."'";
				mysql_query($query) or die(mysql_error());*/
				echo "<script language='Javascript'>document.location.replace('profil.php?id=".$_POST["id"]."');</script>";
			break;
			default:
		}

	}
	echo '<script language="Javascript">document.location.replace(".");</script>';
?>
