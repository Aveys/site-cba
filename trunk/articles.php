<?php
	function displayAddFormLog(){
	
		if (isset($_SESSION["pseudo"])){	?>
			<form name="delogin" action="actions.php" method="POST">
				
				<!-- Unsubmit -->
				<input type="submit" name="action" value="Deconnexion"/>
				<!-- submit -->

			</form>	
<?php 	}
		else{
			if(isset($_SESSION['erreur_connect']))
				echo $_SESSION['erreur_connect']."</br>";	?>
			<form name="login" action="actions.php" method="POST" >

				<!-- pseudo -->
				<label for="pseudo">Pseudo :</label>
				<input name="pseudo" onBlur="verifPseudo(this)"/><br/><br/>

				<!-- login -->
				<label for="mdp">Mot de passe :</label>
				<input type=password name="mdp" onBlur="verifMdp(this)"/><br/><br/>
				<!-- submit -->
				<input type="submit" name="action" value="Connexion"/>

			</form>
<?php	}	?>
		<form name="inscription" action="?page=inscription" method="POST">
			<!-- Unsubmit -->
			<input type="submit" name="action" value="Inscription"/>
			<!-- submit -->
		</form>
<?php }

function button_delete_post($idPost)
{
	if(isadmin($_SESSION['id']))
	{
		echo "<form name='delete_com' style='float:left;' action='actions.php' method='post'>";
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
		date_default_timezone_set('Europe/Paris');
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