<?php
	function chargerClasse($class)
	{
		require_once($class.'.class.php');
	}
	
	spl_autoload_register("chargerClasse");