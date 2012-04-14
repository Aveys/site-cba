<?php
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	echo $_POST['receiver_id']."</br>".$_POST['message'];
	if(isset($_SESSION['id']))
		sql_add_message($_POST['receiver_id'],$_SESSION['id'],$_POST['message'])
?>