<?php
	session_start();
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	include_once "connect.php";
	include_once "blagues.php";
	if(isset($_POST["action"])){
		if(($_POST["action"]=="ajouter")){
			if(isset($_SESSION["pseudo"]))
				addBlague($_POST["texte"], $_SESSION["pseudo"], $_POST["categorie"]);
		}
		else if(($_POST["action"]=="supprimer")){
			deleteBlague($_POST["categorie"]);		
		}
		else if(($_POST["action"]=="Jaime")){
			$query = "update blagues set nbJaime = nbJaime+1 where id='".$_POST["id"]."'";
			mysql_query($query) or die(mysql_error());
			$query = "update synchro_jaime_log set jaime = 1 where id_blague='".$_POST["id"]."' and id_log='".$_SESSION["pseudo"]."'";
			$result = mysql_query($query) or die(mysql_error());
			if(mysql_affected_rows() == 0)
			{
				$query = "insert into synchro_jaime_log(id_log,id_blague,jaime) values('".$_SESSION["pseudo"]."','".$_POST["id"]."',1)";
				$result = mysql_query($query) or die(mysql_error());
			}
		}
		else if(($_POST["action"]=="Annuler")){
			$query = "update blagues set nbJaime = nbJaime-1 where id='".$_POST["id"]."'";
			mysql_query($query) or die(mysql_error());
			$query = "update synchro_jaime_log set jaime = 0 where id_blague='".$_POST["id"]."' and id_log='".$_SESSION["pseudo"]."'";
			mysql_query($query) or die(mysql_error());
		}
		else if(($_POST["action"]=="Commenter")){
			$query = "insert into com(id_log,id_blague,commentaire) values('".$_SESSION['pseudo']."','".$_POST['id']."','".$_POST['commentaire']."')";
			mysql_query($query) or die(mysql_error());
		}
		else if(($_POST["action"]=="Connexion")){
			if ( checkLogin($_POST["pseudo"], $_POST["mdp"])){
				unset($_SESSION['erreur_connect']);
				$_SESSION["pseudo"] = $_POST["pseudo"];
				$query = "select admin from log where login='".$_SESSION["pseudo"]."'";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				$_SESSION["admin"] = $row['admin'];
			}
		}
		else if(($_POST["action"]=="Deconnexion")){
			unset($_SESSION["pseudo"]);
		}
		else if(($_POST["action"]=="Inscription")){
			echo '<script language="Javascript">document.location.replace("inscription.php");</script>';
		}
		else if(($_POST["action"]=="S\'inscrire")){
			$query = "select * from log where login='".$_POST["pseudo"]."'";
			$result=mysql_query($query);
			if(mysql_num_rows($result) == 0)
			{
				addPseudo($_POST["pseudo"], $_POST["mdp"], $_POST["mail"], $_POST["naissance"]);
			}
			else
			{
				$_SESSION["erreur_inscrip"] = "pseudo existe deja";
				echo '<script language="Javascript">document.location.replace("inscription.php");</script>';
			}
		}

	}
	echo '<script language="Javascript">document.location.replace(".");</script>';
?>
