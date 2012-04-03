<?php
	session_start();
	require_once("stul_config.php");
	require_once($fmConnect);
	
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
	