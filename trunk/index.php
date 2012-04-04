<?php
session_start();
date_default_timezone_set('Europe/Paris');

if (file_exists('stul_config.php'))
{
	require_once("stul_config.php");
	require_once($fmConnect);
	
	if(!isset($_SESSION['visited']) || $_SESSION['visited'] == false)
	{
		$now = date("Y-m-d");
		$query = "INSERT INTO stul_visites(jour) VALUES('$now')";
		mysql_query($query) or die(mysql_query());
		$_SESSION['visited'] = true;
	}
	
	if(isset($_GET['page']))
	{
		switch($_GET['page'])
		{
			case "home":
			require_once($fvLayout);
			break;
			case "install":
			require_once($fvInstall);
			break;
			case "inscription":
			require_once($fvInscription);
			break;
			case "article":
			require_once($fvArticle);
			break;
			default:
			require_once($fvLayout);
			break;
		}
	}
	else
		require_once($fvLayout);
}
else
	echo '<script language="Javascript">document.location.replace("install.php");</script>';

