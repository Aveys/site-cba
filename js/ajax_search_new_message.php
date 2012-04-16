<?php
	header("Content-Type: text/xml");
	echo "<?xml version='1.0'?>";
	include_once "../stul_config.php";
	require_once($a_fmSql);
	require_once($a_fcUserView);
	echo "<list>";
	if(isset($_GET['id']))
	{
		if(($result = sql_all_new_messages_of_user($_GET['id'])))
		{
			while ($messages = mysql_fetch_assoc($result)) {
				if($messages["SENDER_USER_ID"] != $_GET['id'])
				{
					$tmp = 0;
					$correspondant = $messages["SENDER_USER_ID"];
				}
				else
				{
					$tmp = 1;
					$correspondant = $messages["RECEIVER_USER_ID"];
				}
				echo "<item id='".$correspondant."' id_message='".$messages['MESSAGE_ID']."' login='".sql_user_of_id($correspondant)."' is_sender='".$tmp."' />";
			} 
		}
	}
	echo "</list>";
?>