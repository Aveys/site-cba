<?php
session_start(); 
include_once "connect.php";
include_once "sql.php";
include_once($a_fcUserView);
include_once "includes/admin/stul_fonctions.php";
include_once "articles.php";
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
</head>
<body>
	<?php
	if(get_is_exist())
	{
		$result = sql_post_of_idPost($_GET['POST_ID']);
		while($row=mysql_fetch_assoc($result)){
			echo "<div class='article'>";
				affichage_article($row,0);
			echo "</div>";
			echo "<div class='info_article'>Fait par ";
			link_profil(sql_user_who_post($row['POST_ID']));
			echo " le ";
			dateTimeToTime($row['POST_DATE']);
			echo "</div>";
			//button_delete_post($row['POST_ID']);			//bouton delete pour supprimer le post
			add_commentaire($row,'commenter article');		//formulaire ajout de commentaire au post
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
</body>