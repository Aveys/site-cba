<?php
	session_start();
	
	mysql_connect("localhost", "root", "");
	mysql_select_db("iut");
	mysql_query("set names 'UTF8'");
	function chargerClasse($class)
	{
		require_once $class.'.class.php';
	}
	function login(array $data)
	{
		$req = mysql_query("SELECT * FROM users");
		while(($r = mysql_fetch_assoc($req)) != false)
		{
			if($data['pseudo'] == $r['pseudo'])
			{
				if($r['admin'] == 1)
					$_SESSION['user'] = new Admin($data, $r['ID']);
				else
					$_SESSION['user'] = new Membre($data, $r['ID']);
				if($_SESSION['user'] != NULL)
					return true;
			}
		}
		return false;
	}
	spl_autoload_register('chargerClasse');
	if(isset($_POST['action']) && !empty($_POST['pseudo']))
	{
		if(login($_POST))
		{
				$_SESSION['msg'] = "inscription réussie";
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
        <input type="hidden" name="action" value="envoyer" />
        <input type="submit" value="envoyer" />
    </form>
    <p><?php
		if(isset($_SESSION['msg']))
		{
			echo $_SESSION['msg'].'<br /><pre>';
			var_dump($_SESSION);
			echo '</pre>';
			unset($_SESSION['msg']);
		}?></p>
    <p><?php
				$user = $_SESSION['user'];
				echo $user->getPseudo(); ?></p>

</body>
</html>

<?php
	session_destroy();
?>