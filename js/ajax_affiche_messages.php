<?php
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	require_once($a_fcUserView);
	if(isset($_SESSION['id']))
	{
		$messages = sql_all_messages_between_users($_POST['user_id'],$_SESSION['id']);
		foreach ($messages as $key => $value) {
			echo "<div class='messages_dialogue'>".link_profil($value['sender_id'])." ".dateTimeToTime($value['date']).$value['message']."</div>";
		}
	}
?>