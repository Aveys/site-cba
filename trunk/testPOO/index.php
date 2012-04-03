<?php
	session_start();
	
	mysql_connect("localhost", "root", "");
	mysql_select_db("iut");
	mysql_query("set names 'UTF8'");
	require_once("../controller/chargerClass.php");
	function logMembre(array $data)
	{
		$req = mysql_query("SELECT * FROM stul_users");
		while(($r = mysql_fetch_assoc($req)) != false)
		{
			if($data['pseudo'] == $r['USER_LOGIN'])
			{
				if($r['USER_STATUS'] == 2)
					$_SESSION['user'] = new Admin($r['USER_DISPLAYNAME'], $r['USER_ID']);
				else if($r['USER_STATUS'] == 1)
					$_SESSION['user'] = new Membre($r['USER_DISPLAYNAME'], $r['USER_ID']);
				if($_SESSION['user'] != NULL)
					return true;
			}
		}
		return false;
	}
	
	if(isset($_POST['action']) && !empty($_POST['pseudo']))
	{
		if($_POST['action'] == "connexion")
		{
			if(logMembre($_POST))
				$_SESSION['msg'] = "inscription r&eacute;ussie";
			else
				$_SESSION['user'] = new User();
		}
		else if($_POST['action'] == "deconnexion")
			$_SESSION['user'] = new User();
	}
	else
		$_SESSION['user'] = new User();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<body>
	<?php
	if(!isset($_SESSION['user']) || $_SESSION['user']->getStatut() == "visiteur")
	{
	?>
	<form method="post" action=".">
    	<input type="text" name="pseudo" />
        <input type="hidden" name="action" value="connexion" />
        <input type="submit" value="envoyer" />
    </form>
    <?php
	}
	else
	{
	?>
    <form method="post" action=".">
    	<input type="hidden" name="action" value="deconnexion" />
        <input type="submit" value="d&eacute;connexion" />
    </form>
    <?php
	}
	?>
    <p><?php
		if(isset($_SESSION['msg']))
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
			echo '<br /><pre>';
			var_dump($_SESSION);
			echo '</pre>';
			?></p>
    <p><?php
			if(isset($_SESSION['user']) && $_SESSION['user']->getStatut() != "visiteur")
			{
				$user = $_SESSION['user'];
				echo $user->getPseudo();
			} ?></p>
            
    <p><?php echo Membre::getNbMembre(); ?></p>

</body>
</html>

<?php
	unset($_SESSION['msg']);
?>