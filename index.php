<?php
	require_once("stul_config.php");
	var_dump($fConnect);
	require_once($fConnect);
	
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
			default:
				require_once($fvLayout);
			break;
		}
	}
	else
		require_once($fvLayout);
	