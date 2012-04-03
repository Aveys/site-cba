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
			foreach ($result as $key => $res) {
				while($row = mysql_fetch_assoc($res))
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
	function all_possibility($mots)
	{
		$long_tabl = count($mots);
		$nbre_combin = pow($long_tabl, $long_tabl);
	 
		$cpt = 0;
	 
		for($i=0; $i<$nbre_combin; $i++) {
			$chaine_convertie = base_convert($i, 10, $long_tabl);
			while (strlen($chaine_convertie) < $long_tabl) {
				$chaine_convertie = '0'.$chaine_convertie;
			}
			$tabl_indice_encours = str_split($chaine_convertie);
	 
			if ($tabl_indice_encours == array_unique($tabl_indice_encours)) {
				$chaine_finale = '';
				foreach ($tabl_indice_encours as $element) {
					$chaine_finale .= " ".$mots[$element];
				}
				$tableau_index_possibles[] = $chaine_finale;
			}
		}
		print_r($tableau_index_possibles);
		return array_unique($tableau_index_possibles);
	}

?>