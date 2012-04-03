<?php
/*	fonction qui affiche un formulaire pour ajouter un commentaire soit à un post soit à un autre commentaire
*/
require_once("stul_config.php");
function add_commentaire($row,$text_button)
{
	if(isset($_SESSION['pseudo']))
	{
		if(isset($row['com_content']))
		{
			echo "<input type='button' onClick=debloque_comment('comOfCom".$row['com_id']."') value='".$text_button."'/>";
			echo "<form method='post' class='form_comment' name='comOfCom".$row["com_id"]."' id='comOfCom".$row['com_id']."' action='controller/actions.php'>";
				echo "<textarea name='commentaire' cols='50' row='30'></textarea></br>";
				echo "<input type='submit' name='action' value='Commenter'/>";
				echo "<input type='hidden' name='id' value='".$row["post_id"]."'/>";
				echo "<input type='hidden' name='id_parent' value='".$row["com_id"]."'/>";
				echo "<input type='hidden' name='url' value='?page=article&POST_ID=".$row["post_id"]."'/>";
			echo"</form>";
		}
		else
		{
			echo "<input type='button' onClick=debloque_comment('com".$row['POST_ID']."') value='".$text_button."'/>";
			echo "<form method='post' class='form_comment' name='com".$row["POST_ID"]."' id='com".$row['POST_ID']."' action='controller/actions.php'>";
				echo "<textarea name='commentaire' cols='50' row='30'></textarea></br>";
				echo "<input type='submit' name='action' value='Commenter'/>";
				echo "<input type='hidden' name='id' value='".$row["POST_ID"]."'/>";
				echo "<input type='hidden' name='url' value='?page=article&POST_ID=".$row["post_id"]."'/>";
			echo"</form>";
		}
	}
}
/*	affiche les commentaires du post proposé avec ajout des formulaires d'ajout et de suppression de ces coms
*/
function afficheCom($row)
{
	echo "</br>";
	$result_com = sql_com_of_post_with_log($row['POST_ID']);
	while ($row_com = mysql_fetch_assoc($result_com)) {
		if($row_com['com_parent'] == "")
		{
			echo nl2br($row_com['com_content'])." de ";
			link_profil($row_com['user_id']);		//apercu du profil de l'auteur du com
			dateTimeToTime($row_com['com_date']);	//affiche la date de publication au format facebook
			button_delete_com($row_com['com_id'],$row['POST_ID']);	//bouton pour supprimer le com
			add_commentaire($row_com,'▼');			//formulaire d'ajout de com à ce com
			echo "<div id='comOfCom'>";	
			afficheComOfCom($row_com['com_id']);	//affiche les commentaires de ce commentaire
			echo "</div>";
			echo "</br>";
		}
	}
}
/*	affiche les commentaires du commentaire proposé avec ajout des formulaires d'ajout et de suppression de ces coms
*/
function afficheComOfCom($id_com_parent)
{
	$result_com = sql_com_of_com_post_with_log($id_com_parent);
	while ($row_com = mysql_fetch_assoc($result_com)) {
		echo nl2br($row_com['com_content'])." de ";
		link_profil($row_com['user_id']);		//apercu du profil de l'auteur du com
		dateTimeToTime($row_com['com_date']);	//affiche la date de publication au format facebook
		button_delete_com($row_com['com_id'],$row_com['post_id']); //bouton de suppression de ce com
		echo "</br>";
	}
}
/*	affiche un formulaire de suppression de com seulement si l'utilisateur est admin
*/
function button_delete_com($idCom,$idPost)
{
	if(isset($_SESSION['id']))
	{
	if(isadmin($_SESSION['id']))
	{
		echo "<form name='delete_com' action='controller/actions.php' method='post'>";
			echo "<input name='id_com' type='hidden' value='".$idCom."'/>";
			echo "<input name='action' value='Supprimer com' type='submit'/>";
			echo "<input type='hidden' name='url' value='?page=article&POST_ID=".$idPost."'/>";
		echo "</form>";
	}
	}
}
?>