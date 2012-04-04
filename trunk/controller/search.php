<?php
	function form_search()
	{
		/*<form method="get" id="searchform" action="http://elegantthemes.com/preview/Evolution/">

							<input type="text" value="Search this site..." name="s" id="searchinput" />

														<input type="image" src="http://elegantthemes.com/preview/Evolution/wp-content/themes/Evolution/images/search_btn.png" id="searchsubmit" />

						</form>*/

		echo "<form name='search' id='searchform' action='.?recherche=1' method='GET' >";
			// Recherche
			echo "<div id='search_div'>";
			echo "<input type='text' name='recherche' id='searchinput' value ='Rechercher' onBlur='verifRecherche(this)'/>";
			echo "<input type='submit' value='' id='searchsubmit'><img src='themes/cba/images/icons/search.png'></img></input>";
			echo "</div>";
			echo '<div id="searchradio"><input type="radio" checked="checked" name="type_search" value="quick_search"> Recherche Rapide';
			echo '<input type="radio" name="type_search" value="all_words"> Rechercher tous les mots</div>';
		echo "</form>";
	}
	function search($text)
	{
		$mot_recherche = explode(" ", $text);
		if($_GET['type_search'] == "all_words" && count($mot_recherche) > 1)
			$post_trouve = all_possibility($mot_recherche);
		else
			$post_trouve = quick_search($mot_recherche);
		if(isset($post_trouve))
		{
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
		else
		{
			echo "Aucun résultat trouvé";
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
					$result = sql_recherche(trim($chaine_finale));
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
				$tableau_index_possibles[] = $chaine_finale;
			}
		}
		if(isset($post_trouve))
			return $post_trouve;
	}
	function quick_search($mots)
	{
		foreach ($mots as $key => $value) {
			$result = sql_recherche(trim($value));
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
		if(isset($post_trouve))
			return $post_trouve;
	}

?>