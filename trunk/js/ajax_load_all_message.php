<?php
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	require_once($a_fcUserView);
	if(isset($_GET['id']) && isset($_SESSION['id']))
	{
		if(($result = sql_all_messages_of_user($_GET['id'],$_SESSION['id'])))
		{
			while ($messages = mysql_fetch_assoc($result)) {
				echo "<div class=\"messages_dialogue_profil_date\">";
					echo link_profil($messages['SENDER_USER_ID'])." ".dateTimeToTime($messages['message_date']);
					echo "<div class=\"messages_dialogue\">";
						echo $messages['message_text'];
					echo "</div>";
				echo "</div>";
			} 
		}
	}
?>