<?php 
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	sql_log_connexion();
	$user_connect = who_is_log();
	foreach ($user_connect as $key => $value) {
		echo "<div class='log_connect' id=".$value['id']." onclick=message_box_open(".$value['id'].",'".$value['login']."') >".$value['login']."</div>";
	}
?>