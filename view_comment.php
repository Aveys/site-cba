<?php
function add_commentaire($row,$text_button)
{
	if(isset($_SESSION['pseudo']))
	{
		if(isset($row['com_content']))
		{
			echo "<input type='button' onClick=debloque_comment('comOfCom".$row['com_id']."') value='".$text_button."'/>";
			echo "<form method='post' class='form_comment' name='comOfCom".$row["com_id"]."' id='comOfCom".$row['com_id']."' action='actions.php'>";
				echo "<textarea name='commentaire' cols='50' row='30'></textarea></br>";
				echo "<input type='submit' name='action' value='Commenter'/>";
				echo "<input type='hidden' name='id' value='".$row["post_id"]."'/>";
				echo "<input type='hidden' name='id_parent' value='".$row["com_id"]."'/>";
			echo"</form>";
		}
		else
		{
			echo "<input type='button' onClick=debloque_comment('com".$row['POST_ID']."') value='".$text_button."'/>";
			echo "<form method='post' class='form_comment' name='com".$row["POST_ID"]."' id='com".$row['POST_ID']."' action='actions.php'>";
				echo "<textarea name='commentaire' cols='50' row='30'></textarea></br>";
				echo "<input type='submit' name='action' value='Commenter'/>";
				echo "<input type='hidden' name='id' value='".$row["POST_ID"]."'/>";
			echo"</form>";
		}
	}
}
function afficheCom($row)
{
	echo "</br>";
	$result_com = sql_com_of_post_with_log($row['POST_ID']);
	while ($row_com = mysql_fetch_assoc($result_com)) {
		if($row_com['com_parent'] == "")
		{
			echo nl2br($row_com['com_content'])." de ";
			link_profil($row_com['user_id']);
			dateTimeToTime($row_com['com_date']);
			button_delete_com($row_com['com_id']);
			add_commentaire($row_com,'▼');
			echo "<div id='comOfCom'>";
			afficheComOfCom($row_com['com_id']);
			echo "</div>";
			echo "</br>";
		}
	}
}
function afficheComOfCom($id_com_parent)
{
	$result_com = sql_com_of_com_post_with_log($id_com_parent);
	while ($row_com = mysql_fetch_assoc($result_com)) {
		echo nl2br($row_com['com_content'])." de ";
		link_profil($row_com['user_id']);
		dateTimeToTime($row_com['com_date']);
		button_delete_com($row_com['com_id']);
	}
}
function button_delete_com($idCom)
{
	if(isadmin($_SESSION['id']))
	{
		echo "<form name='delete_com' action='actions.php' method='post'>";
			echo "<input name='id_com' type='hidden' value='".$idCom."'/>";
			echo "<input name='action' value='Supprimer com' type='submit'/>";
		echo "</form>";
	}
}
?>