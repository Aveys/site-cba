<?php
	session_start();
	include_once "connect.php";
	include_once "articles.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
</head>
<h1>
	<?php
		if(isset($_GET['id']) && idUser_exist($_GET['id']))
			echo sql_user_of_id($_GET['id']);
		else
			echo '<script language="Javascript">document.location.replace(".");</script>';
	?>
</h1>
<?php
	if(isset($_GET['editer']) && $_GET['editer'] == 1)
		editer_info_user($_GET['id']);
	else
		afficher_info_user($_GET['id']);

	function afficher_info_user($id)
	{
		if(autorise_edition($id))
			echo "<a href="."profil.php?id=".$id."&editer=1>editer</a></br>";
		$row = sql_info_user($id);
		echo "Mail: ".$row['user_mail']."</br>";
		//affiche_anni($row['date_naissance'],$login);
	}

	function editer_info_user($id)
	{
		if(autorise_edition($id))
		{
			$row = sql_info_user($id);
			echo "</br></br><form method='post' name='editer_user' action='actions.php'>";
				echo "<label for='mail'>Mail :</label>";
				echo "<input name='mail' value='".$row['user_mail']."'/></br></br>";
				//echo "<label for='naissance'>Date de naissance :</label>";
				//echo "<input type='text' name='naissance' class='calendrier' size='8' value='".$row['date_naissance']."'/></br></br>";
				echo "<input type='submit' name='action' value='Editer'/>";
				echo "<input type='hidden' name='id' value='".$id."'/>";
			echo"</form>";
		}
	}
	function autorise_edition($id)
	{
		if(isset($_SESSION['id']) && (isadmin($_SESSION['id']) || $id == $_SESSION['id']))
			return true;
		else
			return false;
	}
?>