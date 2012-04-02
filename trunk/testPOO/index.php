<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_select_db("iut");
	mysql_query("set names 'UTF8'");
	include_once("membre.class.php");
	if(isset($_POST['pseudo']))
	{
		if(Membre::login($_POST))
		{
				$message = "inscription réussie";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<body>
	<form method="post" action=".">
    	<input type="text" name="pseudo" />
        <input type="submit" value="envoyer" />
    </form>
    <p><?php
		if(isset($message))
			echo $message; ?></p>
    <p><?php if(isset($_SESSION['membre']))
				echo $_SESSION['membre']->getPseudo(); ?></p>
    <?php
		$r = mysql_query("SELECT pseudo FROM users");
		foreach(mysql_fetch_assoc($r) as $res)
		{
			echo '<p>'.$res.'</p>';
		}
	?>
</body>
</html>