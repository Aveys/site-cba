<?php
	include_once "stul_config.php";
	function form_search()
	{
		echo "<form name='search' action='.?recherche=1' method='GET' >";
			// Recherche
			echo "<label for='Recherche'>Recherche :</label>";
			echo "<input name='recherche' onBlur='verifRecherche(this)'/>";
			// submit
			echo "<input type='submit' name='action' value='Rechercher'/>";
		echo "</form>";
	}
	function search($text)
	{
		$mot_recherche = explode(" ", $text);
		foreach ($mot_recherche as $key => $value) {
			$result = sql_recherche($value);
			while($row = mysql_fetch_assoc($result))
			{
				$tmp = 0;
				if(isset($post_trouve[$row['POST_ID']]['nb']))
					$tmp = $post_trouve[$row['POST_ID']]['nb'];
				else
					$post_trouve[$row['POST_ID']]['nb'] = 0;
				$post_trouve[$row['POST_ID']] = $row;
				$post_trouve[$row['POST_ID']]['nb'] = $tmp+1;
			}
		}
		usort($post_trouve, "cmp");
		foreach ($post_trouve as $key => $value) {
			echo "<div class='article'>";
				affichage_article($value,1);
			echo "</div>";
			echo "<div class='info_article'>Fait par ";
			link_profil(sql_user_who_post($value['POST_ID']));
			echo " le ";
			dateTimeToTime($value['POST_DATE']);
			echo $value['nb'];
			echo "</div>";
		}
	}
	function cmp($a,$b)
	{
		return $b['nb']-$a['nb'];
	}

?>