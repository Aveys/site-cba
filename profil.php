<?php
	session_start();
	include_once "connect.php";
	include_once "blagues.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Blagues carambar</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
</head>
<h1>
	<?php
		if(isset($_GET['id']))
			echo $_GET['id'];
		else
			echo '<script language="Javascript">document.location.replace(".");</script>';
	?>
</h1>
<?php
	if(isset($_GET['editer']) && $_GET['editer'] == 1)
		editer_info_user($_GET['id']);
	else
		afficher_info_user($_GET['id']);

	function afficher_info_user($login)
	{
		if(autorise_edition($login))
			echo "<a href="."profil.php?id=".$login."&editer=1>editer</a></br>";
		$query = "select mail,date_naissance from log where login='".$login."'";
		$result = mysql_query($query) or die(mysql_error());
		if($result && mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			echo "Mail: ".$row['mail']."</br>";
			affiche_anni($row['date_naissance'],$login);
		}
		else
			echo '<script language="Javascript">document.location.replace(".");</script>';
	}

	function editer_info_user($login)
	{
		if(autorise_edition($login))
		{
			$query = "select mail,date_naissance from log where login='".$login."'";
			$result = mysql_query($query) or die(mysql_error());
			if($result && mysql_num_rows($result) > 0)
			{
				echo "</br></br><form method='post' name='editer_user' action='actions.php'>";
					$row = mysql_fetch_assoc($result);
					echo "<label for='mail'>Mail :</label>";
					echo "<input name='mail' value='".$row['mail']."'/></br></br>";
					echo "<label for='naissance'>Date de naissance :</label>";
					echo "<input type='text' name='naissance' class='calendrier' size='8' value='".$row['date_naissance']."'/></br></br>";
					echo "<input type='submit' name='action' value='Editer'/>";
					echo "<input type='hidden' name='id' value='".$login."'/>";
				echo"</form>";
			}
			else
				echo '<script language="Javascript">document.location.replace(".");</script>';
		}
	}
	function autorise_edition($login)
	{
		if(isset($_SESSION['pseudo']) && (isadmin($_SESSION['pseudo']) || $login == $_SESSION['pseudo']))
			return true;
		else
			return false;
	}
?>