
 <?php

	function displayAddFormLog(){
	
		if (isset($_SESSION["pseudo"])){
	?>
			<form name="delogin" action="actions.php" method="POST">
				
				<!-- Unsubmit -->
				<input type="submit" name="action" value="Deconnexion"/>
				<!-- submit -->

			</form>	
	<?php
		}
		else{
			if(isset($_SESSION['erreur_connect']))
				echo $_SESSION['erreur_connect']."</br>";
	?>
			<form name="login" action="actions.php" method="POST" onSubmit="return validLogin()">

				<!-- pseudo -->
				<label for="pseudo">Pseudo :</label>
				<input name="pseudo" onBlur="verifPseudo(this)"/><br/><br/>

				<!-- login -->
				<label for="mdp">Mot de passe :</label>
				<input type=password name="mdp" onBlur="verifMdp(this)"/><br/><br/>
				<!-- submit -->
				<input type="submit" name="action" value="Connexion"/>

			</form>
	<?php
		}
	?>
		<form name="inscription" action="inscription.php" method="POST">
			<!-- Unsubmit -->
			<input type="submit" name="action" value="Inscription"/>
			<!-- submit -->
		</form>
	<?php
	}
	
	function checkLogin( $pseudo, $mdp){
		$result=mysql_query("select * from log");
		while($row=mysql_fetch_assoc($result)){
			if($pseudo == $row["login"]){
				if($mdp == $row["mdp"])
					return true;
				else
					$_SESSION['erreur_connect'] = "Mauvais mot de passe";
			}
			else
				$_SESSION['erreur_connect'] = "Ce login n'existe pas, veuillez vous inscrire en cliquant sur le bouton inscription";
		}
		return false;
	}
 
	function displayBlagues(){
		$result=mysql_query("select b.id,b.texte,b.cat,b.date,b.nbJaime from blagues b");
		while($row=mysql_fetch_assoc($result)){
			echo "<div class='blague'>".$row['texte']."</div>";
			echo "<div class='info_blague'>Fait par ";
			$resultLog=mysql_query("select l.login from blagues b join synchro_jaime_log s on b.id=s.id_blague join log l on l.login=s.id_log where b.id='".$row['id']."'");
			$rowLog=mysql_fetch_assoc($resultLog);
			link_profil($rowLog['login']);
			echo " le ".$row['date'].".</div>";
			echo "<div class='nbJaime'>";
				login_qui_aiment($row);
			echo "</div>";
			boutonJaime($row);
			echo "<div id='com'>";
				afficheCom($row);
				commentaire($row);
			echo "</div>";
		}
	}

	function displayAddForm(){
		if (isset($_SESSION["pseudo"])){
		?>
			<form name="blagues" action="actions.php" method="POST" onSubmit="return valid()">
	
			<!-- texte -->
			<label for="texte">Texte :</label>
			<textarea name="texte" cols="50" row="30" onBlur="verifTexte(this)"></textarea> 
			<br/><br/>

			<!-- categorie -->
			<label for="categorie">Catégorie :</label>
			<select name="categorie">
				<option value="Nonsens">Nom sens</option>
				<option value="Carambar">Carambar</option>
				<option value="HumourNoir">Humour Noir</option>
				<option value="JeuDeMot">Jeu de mot</option>
			</select>
			
			<!-- submit -->
			<input type="submit" name="action" value="ajouter"/>

			</form>
		
		<?php
		}
		else
			echo "Veuillez vous loger.</br>";
	}
	
	function addBlague($texte, $pseudo, $categorie){
		include_once"connect.php";
		$query="insert into blagues(texte, id_pseudo, cat, date) values ('".$texte."','".$pseudo."','".$categorie."',now())";
		mysql_query($query) or die(mysql_error());
		$query="insert into synchro_jaime_log(id_log, id_blague, jaime) values ('".$pseudo."','".mysql_insert_id()."',0)";
		mysql_query($query) or die(mysql_error());
	}
	
	function addPseudo($pseudo, $mdp,$mail,$naissance){
		include_once"connect.php";
			$query="insert into log(login, mdp,mail,date_naissance) 
										values ('".$pseudo."',
												'".$mdp."',
												'".$mail."',
												'".$naissance."')";
			mysql_query($query) or die(mysql_error());
	}
	
	function displayDeleteForm(){		
		if (isset($_SESSION["pseudo"])){
			if(isadmin($_SESSION["pseudo"]) == 1)
			{
		?>
				<form name="deleteBlagues" action="actions.php" method="POST">
				
				<!-- choix Blague -->
				<label for="categorie">Quelle Blague ?</label>
				<select name="categorie">
				<?php
				$result=mysql_query("select id from blagues");
				while($row=mysql_fetch_assoc($result)){
					echo "<option value='".$row["id"]."'>".$row["id"]."</option>";
					}
				?>
				</select>
				<input type="submit" name="action" value="supprimer"/>
				</form>
		<?php
			}
			else
				echo "Vous n'etes pas admin.</br>";
		}
		else
			echo "Veuillez vous loger en tant qu'admin.</br>";
	}
	
	function deleteBlague($id){
		include_once"connect.php";
			$query="delete from blagues where id='".$id."'";
			mysql_query($query) or die(mysql_error());
	}

	function boutonJaime($row)
	{
		if(isset($_SESSION['pseudo']))
		{
			$result_a_deja_like=mysql_query("select s.jaime from blagues b join synchro_jaime_log s on b.id=s.id_blague join log l on l.login=s.id_log where l.login='".$_SESSION['pseudo']."' and b.id='".$row['id']."'");
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
		$result_log_aime=mysql_query("select l.login from blagues b join synchro_jaime_log s on b.id=s.id_blague join log l on l.login=s.id_log where s.jaime=1 and b.id='".$row['id']."'");		
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
	function commentaire($row)
	{
		if(isset($_SESSION['pseudo']))
		{
			echo "<form method='post' name='com' action='actions.php'>";
				echo "<textarea name='commentaire' cols='50' row='30'></textarea></br>";
				echo "<input type='submit' name='action' value='Commenter'/>";
				echo "<input type='hidden' name='id' value='".$row["id"]."'/>";
			echo"</form>";
		}
	}
	function afficheCom($row)
	{
		$query_com = "select login,commentaire from com c join blagues b on c.id_blague=b.id join log l on c.id_log=l.login where b.id=".$row['id'];
		$result_com = mysql_query($query_com) or die(mysql_error());
		while ($row_com = mysql_fetch_assoc($result_com)) {
			echo $row_com['commentaire']." de ";
			link_profil($row_com['login']);
			echo "</br>";
		}
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
					echo "cette blague.";
					personneCache($tab_log_aime,$key,$i);
					echo "</span>";
					$key = $i+1;
				}
				else if($nb_jaime < count($tab_log_aime)-2)
					echo ", ";
				else if($nb_jaime == count($tab_log_aime)-2)
					echo " et ";
				else if($vous == 1)
					echo " aimez cette blague.";
				else if(count($tab_log_aime) > 1)
					echo " aiment cette blague.";
				else
					echo " aime cette blague.";
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
	function link_profil($login)
	{
		$log = $login;
		if(isset($_SESSION['pseudo']) && $login==$_SESSION['pseudo'])
			$login='Vous';
		echo "<span id='profil".$log."' onMouseOver='survole_profil_apercu(this,event)' onMouseOut='quitte_profil_apercu(this)'><a href='profil.php?id=".$log."'>".$login."</a>";
		profil($log);
		echo "</span>";
	}
	function profil($log)
	{
		echo "<div id='profil_apercu' style='float: left;'>";
			echo "<h3>".$log."</h3>";
			$query = "select mail,date_naissance from log where login='".$log."'";
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			echo "Mail: ".$row['mail']."</br>";
			affiche_anni($row['date_naissance'],$log);
		echo "</div>";
	}
	function isadmin($login)
	{
		$query = "select admin from log where login='".$login."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		return $row['admin'];
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
	}
 ?>