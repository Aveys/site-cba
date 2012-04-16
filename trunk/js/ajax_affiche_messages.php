<?php
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	require_once($a_fcUserView);
	if(isset($_POST['id_message']))
	{
		$message = sql_message_of_id_message($_POST['id_message']);
		echo "<div class=\"messages_dialogue_profil_date\">";
			echo link_profil($message['SENDER_USER_ID'])." ".dateTimeToTime($message['message_date']);
			echo "<div class=\"messages_dialogue\">";
				echo $message['message_text'];
			echo "</div>";
		echo "</div>";
		if(isset($_SESSION['id']))
		{
			if($_SESSION['id'] != $message['SENDER_USER_ID'])
			{
				sql_message_lu_by_receiver($_POST['id_message']);
			}
			else
			{
				sql_message_lu_by_sender($_POST['id_message']);
			}
		}
	}
?>