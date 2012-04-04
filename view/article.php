<?php
require_once($a_fmConnect);
require_once($a_fmSql);
require_once($a_fcUserView);
require_once($a_fAdminFonct);
require_once($a_fcArticle);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
<script type="text/javascript" src="apercu_profil.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'fr'}
</script>
</head>
<body>
	<div id='contentArticle'>
	<?php
	if(get_is_exist())
	{
		echo "<div id='headerArticle'><h1>";
		echo sql_title_of_post($_GET['POST_ID']);
		echo "</h1></div>";
		$result = sql_post_of_idPost($_GET['POST_ID']);
		while($row=mysql_fetch_assoc($result)){
			echo "<div class='article'><h3>";
				affichage_article($row,0, $fcAction);
			echo "</h3></div>";
			echo "<div class='info_article'>Fait par ";
			link_profil(sql_user_who_post($row['POST_ID']));
			dateTimeToTime($row['POST_DATE']);
			echo "</div>";
			echo "<table>";
				echo "<tr>";
					echo "<td colspan='3'>";
						affiche_button_reseausociaux("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "<table id='ligne_bouton_post'>";
			echo "<tr>";
					/*if(!(isset($_GET['edit']) && $_GET['edit'] == 1))
					{
						echo "<td>";
							button_edit_post($row['POST_ID']);
						echo "</td>";
					}
					echo "<td>";
						button_delete_post($row['POST_ID'],$fcAction);			//bouton delete pour supprimer le post
					echo "</td>*/
					echo "<td>";
						add_commentaire($row,'▼');		//formulaire ajout de commentaire au post
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "</br>";
			/*echo "<div class='nbJaime'>";
				login_qui_aiment($row);
			echo "</div>";
			boutonJaime($row);*/
			echo "<div id='com'>";
				afficheCom($row);							//affichage des commentaires du post
			echo "</div>";
		}
	}
?>
</div>
</body>