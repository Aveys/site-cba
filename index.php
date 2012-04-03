<?php
	require_once("stul_config.php");
	var_dump($fConnect);
	require_once($fConnect);
	
	if(isset($_GET['page']))
	{
		switch($_GET['page'])
		{
			case "home":
				require_once("layout.php");
			break;
			case "install":
				require_once("install.php");
			break;
			case "inscription":
				require_once("inscription.php");
			break;
			default:
				require_once("layout.php");
			break;
		}
	}
	else
		require_once("layout.php");
	