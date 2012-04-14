<?php
	session_start();
	include_once "../stul_config.php";
	require_once($a_fmSql);
	require_once($a_fcUserView);
	if(isset($_SESSION['id']))
	{
		$messages = sql_all_messages_between_users($_POST['user_id'],$_SESSION['id']);
		$tmp = "";
		foreach ($messages as $key => $value) {
			if($tmp != $value['sender_id'])
			{
				echo "<div class='messages_dialogue_profil_date'>";
					echo link_profil($value['sender_id'])." ".dateTimeToTime($value['date']);
					echo "<div class='messages_dialogue'>";
						echo $value['message'];
					echo "</div>";
				echo "</div>";
			}
			else
			{
				echo "<div class='messages_dialogue_concatene'>".$value['message']."</div>";
			}
			$tmp = $value['sender_id'];
		}
	}
?>