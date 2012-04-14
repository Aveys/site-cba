<?php 
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	sql_log_connexion();
	$user_connect = who_is_log();
	foreach ($user_connect as $key => $value) {
		echo "$value</br>";
	}
?>