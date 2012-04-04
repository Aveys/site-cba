<?php 
	/*	fonction qui affiche un formulaire permettant de se loger ou de se deloger
	*/
	function displayAddFormLog($fcAction){
		if (isset($_SESSION["pseudo"])){
			echo "<h2>".$_SESSION["pseudo"]."</h2>";	
			echo '<form name="delogin" action="'.$fcAction.'" method="POST" >'; ?>
				<!-- Unsubmit -->
			<div id="deconnexion">
				<input type="submit" name="action" value="Deconnexion"/>
				<!-- submit -->
			</div>
			</form>	
<?php 	}
		else{
			if(isset($_SESSION['erreur_connect']))
				echo $_SESSION['erreur_connect']."</br>";	?>
			<form name="login" action=<?php echo "'".$fcAction."'" ?> method="POST" >

				<!-- pseudo -->
				<label for="pseudo">Pseudo :</label>
				<input name="pseudo" onBlur="verifPseudo(this)"/></br>

				<!-- login -->
				<label for="mdp">Mot de passe :</label>
				<input type=password name="mdp" onBlur="verifMdp(this)"/></br>
				<!-- submit -->
				<input type="submit" name="action" value="Connexion"/>

			</form>
<?php	}	?>
		<form name="inscription" action="?page=inscription" method="POST">
			<!-- Unsubmit -->
			<input type="submit" name="action" value="Inscription"/>
			<!-- submit -->
		</form>
<?php 
		unset($_SESSION['erreur_connect']);
		}

function get_is_exist()
{
	if(isset($_GET['POST_ID']) && sql_post_exist($_GET['POST_ID']))
		return true;
	else
		return false;
}
/*	formulaire d'ajout de post seulement si utilisateur connecte
*/
function displayAddForm(){
	if (isset($_SESSION["pseudo"])){
	?>
		<form name="articles" action="controller/actions.php" method="POST" onSubmit="return valid()">

		<!-- titre -->
		<label for="titre">Titre :</label>
		<input name="titre" cols="50" row="30" onBlur="verifTexte(this)"></textarea> 
		<br/><br/>
		<!-- texte -->
		<label for="texte">Article :</label>
		<textarea name="texte" cols="50" row="30" onBlur="verifTexte(this)"></textarea> 
		<br/>
		<!-- texte -->
		<label for="tag">Tag (séparé d'un espace) :</label>
		<textarea name="tag" cols="50" row="30" onBlur="verifTexte(this)"></textarea> 
		<br/>
		
		<!-- submit -->
		<input type="submit" name="action" value="ajouter"/>

		</form>
	
	<?php
	}
	else
		echo "Veuillez vous loger.</br>";
}

/*affiche tous les articles de la bdd avec ses infos
	- nom du posteur, date de création
*/
function displayArticles(){
	
		$result = sql_all_post();
		if(mysql_num_rows($result) == 0)
			echo "Aucun article disponible";
		while($row=mysql_fetch_assoc($result)){
			echo "<div class='article'>";
				affichage_article($row,1);
			echo "</div>";
			echo "<div class='info_article'>Fait par ";
			link_profil(sql_user_who_post($row['POST_ID']));
			echo " le ";
			dateTimeToTime($row['POST_DATE']);
			echo "</div>";
		}
}
function affichage_article($row,$masque)
{
	$text = explode("<more>", $row['POST_CONTENT']);
	if($masque)
	{
		if(!isset($text[1]) && strlen($text[0]) > 100)
			$text[0] = substr($text[0],0,100);
		echo $text[0];
		echo "<form method='post' class='form_lire_la_suite' name='lireLaSuite' id='lireLaSuite' action='?page=article&POST_ID=".$row["POST_ID"]."'>";
			echo "<input type='submit' name='action' value='Lire la suite'/>";
		echo"</form>";
		//button_delete_post($row['POST_ID']);			//bouton delete pour supprimer le post
		echo "</br>";
	}
	else
	{
		if(isset($_GET['edit']) && $_GET['edit'] == 1)
			affiche_form_edition_post($text,$row['POST_ID']);
		else
		{
			foreach ($text as $key => $value) {
				echo $value;
			}
		}
	}
}
function button_facebook($url)
{
	?>
	<iframe id='facebook' src="http://www.facebook.com/plugins/like.php?href="<?php echo $url ?>"&amp;layout=box_count&amp;show_faces=true&amp;width=65&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:65px; height:65px; margin-top:3px;" allowTransparency="true"></iframe>
	<?php
}
function button_twitter()
{
	?>
	<a href="http://twitter.com/share" id='twitter' class="twitter-share-button"
		data-count="horizontal" data-via="_toto74">Tweet</a>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<?php
}
function button_googleplus()
{
	echo "<g:plusone id='google_plus' size='middle'></g:plusone>";
}
function affiche_button_reseausociaux($url)
{
	button_facebook($url);
	button_twitter();
	button_googleplus();
}
/*	affiche un formulaire d'edition de post seulement si l'utilisateur est admin
*/
function affiche_form_edition_post($content,$idPost)
{
	if(isset($_SESSION['id']))
	{
		if(isadmin($_SESSION['id']))
		{
			echo "<form name='edit_post' action='controller/actions.php' method='post'>";
				echo "<textarea name='article' cols='50' row='30'>";
				foreach ($content as $key => $value) {
					echo $value;
				}
				echo "</textarea></br>";
				echo "<input name='id_post' type='hidden' value='".$idPost."'/>";
				echo "<input name='action' value='Editer post' type='submit'/>";
				echo "<input type='hidden' name='url' value='?page=article&POST_ID=".$idPost."'/>";
			echo "</form>";
		}
	}
}
/*	affiche un formulaire d'edition de post seulement si l'utilisateur est admin
*/
function button_edit_post($idPost)
{
	if(isset($_SESSION['id']))
	{
		if(isadmin($_SESSION['id']))
		{
			echo "<form name='delete_com' style='float:left; margin-left:0px;' action='?page=article&POST_ID=".$idPost."&edit=1' method='post'>";
				echo "<input name='action' value='Editer post' type='submit'/>";
				echo "<input type='hidden' name='url' value='?page=article&POST_ID=".$idPost."'/>";
			echo "</form>";
		}
	}
}
/*	fonction qui affiche un bouton permettant de supprimer le post
*/
function button_delete_post($idPost)
{
	if(isset($_SESSION['id']) && isadmin($_SESSION['id']))
	{
		echo "<form name='delete_com' style='float:left;' action='controller/actions.php' method='post'>";
			echo "<input name='id_post' type='hidden' value='".$idPost."'/>";
			echo "<input name='action' value='Supprimer post' type='submit'/>";
		echo "</form>";
	}
}
	/*
	function boutonJaime($row)
	{
		if(isset($_SESSION['pseudo']))
		{
			$result_a_deja_like=mysql_query("select s.jaime from articles b join synchro_jaime_log s on b.id=s.id_article join log l on l.login=s.id_log where l.login='".$_SESSION['pseudo']."' and b.id='".$row['id']."'");
			$row_a_deja_like=mysql_fetch_assoc($result_a_deja_like);
			echo "<form method='post' name='Like' action='actions.php'>";
				if($row_a_deja_like['jaime'] == 0)
				{
					echo "<input type='submit' name='action' value='Jaime'/>";
					echo "<input type='hidden' name='id' value='".$row["id"]."'/>";
				}
				else
				{
					echo "<input type='submit' name='action' value='J&apos;aime plus'/>";
					echo "<input type='hidden' name='id' value='".$row["id"]."'/>";
				}
			echo"</form>";
		}
	}
	function login_qui_aiment($row)
	{
		$vous = 0;
		$i=1;
		$result_log_aime=mysql_query("select l.login from articles b join synchro_jaime_log s on b.id=s.id_article join log l on l.login=s.id_log where s.jaime=1 and b.id='".$row['id']."'");		
		while ($row_log_aime=mysql_fetch_assoc($result_log_aime)) {
			$i++;
			if(!isset($_SESSION['pseudo']) || $row_log_aime['login'] != $_SESSION['pseudo'])
				$tab_log_aime[$i]['login'] = $row_log_aime['login'];
			else
			{
				$tab_log_aime[0]['login'] = $row_log_aime['login'];
				$vous=1;
			}
		}
		affiche_login_qui_aime($tab_log_aime,$vous,$i);
	}
	function affiche_login_qui_aime($tab_log_aime,$vous,$i)
	{
		$nb_max_like = 3;
		$nb_jaime = 0;
		for($key=0;$key<=$i;$key++) {
			if(isset($tab_log_aime[$key]['login']))
			{
				link_profil($tab_log_aime[$key]['login']);
				if($nb_jaime != (count($tab_log_aime)-1) && $nb_jaime >= $nb_max_like)
				{
					echo " et <span id='personnes_caches' onMouseOver='survole_personne_cache()' onMouseOut='quitte_personne_cache()'>".(count($tab_log_aime) - 1 - $nb_jaime);
					if((count($tab_log_aime) - 1 - $nb_jaime) > 1)
						echo " autres personnes";
					else
						echo " autre personne";
					if($vous == 1)
						echo " aimez ";
					else
						echo " aiment";
					echo "cette article.";
					personneCache($tab_log_aime,$key,$i);
					echo "</span>";
					$key = $i+1;
				}
				else if($nb_jaime < count($tab_log_aime)-2)
					echo ", ";
				else if($nb_jaime == count($tab_log_aime)-2)
					echo " et ";
				else if($vous == 1)
					echo " aimez cette article.";
				else if(count($tab_log_aime) > 1)
					echo " aiment cette article.";
				else
					echo " aime cette article.";
				$nb_jaime++;
			}
		}
	}
	function personneCache($tab_log_aime,$key,$i)
	{
		echo "<div id='liste_personnes_caches'>";
		for($key=$key+1;$key<=$i;$key++)
		{
			if(isset($tab_log_aime[$key]['login']))
			{
				echo "<li>";
				link_profil($tab_log_aime[$key]['login']);
				echo "</li>";
			}
		}
		echo "</div>";
	}

	function affiche_anni($date_naissance,$login)
	{
		list($date_anni['annee'],$date_anni['jour'],$date_anni['mois']) = explode("-", $date_naissance);
		if(isset($_SESSION['pseudo']) && $login == $_SESSION['pseudo'])
			echo "Vous avez ";
		else
			echo $login." a ";
		if($date_anni['mois'] < date('m'))
			echo (date('Y')-$date_anni['annee']);
		else if($date_anni['mois'] == date('m') && $date_anni['jour'] <= date('d'))
			echo (date('Y')-$date_anni['annee']);
		else
			echo (date('Y')-$date_anni['annee']-1);
		echo " ans.";
	}*/
 ?>