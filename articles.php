
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
		$result=mysql_query("select * from STUL_USERS");
		while($row=mysql_fetch_assoc($result)){
			if($pseudo == $row["USER_LOGIN"]){
				if($mdp == $row["USER_PASS"])
					return true;
				else
					$_SESSION['erreur_connect'] = "Mauvais mot de passe";
			}
			else
				$_SESSION['erreur_connect'] = "Ce login n'existe pas, veuillez vous inscrire en cliquant sur le bouton inscription";
		}
		return false;
	}
 
	function displayArticles(){
		$result=mysql_query("select p.POST_ID,p.POST_CONTENT,p.POST_CATEGORY,p.POST_DATE from STUL_POST p");
		while($row=mysql_fetch_assoc($result)){
			echo "<div class='article'>".$row['POST_CONTENT']."</div>";
			echo "<div class='info_article'>Fait par ";
			$resultLog=mysql_query("select u.USER_LOGIN,u.USER_ID from STUL_POST p join STUL_USERS u on u.USER_ID=p.USER_ID where p.POST_ID='".$row['POST_ID']."'");
			$rowLog=mysql_fetch_assoc($resultLog);
			link_profil($rowLog['USER_ID']);
			echo " le ".$row['POST_DATE'].".</div>";
			/*echo "<div class='nbJaime'>";
				login_qui_aiment($row);
			echo "</div>";
			boutonJaime($row);*/
			echo "<div id='com'>";
				afficheCom($row);
			echo "</div>";
			add_commentaire($row,'commenter article');
		}
	}

	function displayAddForm(){
		if (isset($_SESSION["pseudo"])){
		?>
			<form name="articles" action="actions.php" method="POST" onSubmit="return valid()">
	
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
	
	function addPost($texte, $pseudo, $categorie){
		include_once "connect.php";
		$query="insert into STUL_POST(post_content, user_id, post_category, post_date) values ('".$texte."','".$pseudo."','".$categorie."',now())";
		mysql_query($query) or die(mysql_error());
		//$query="insert into synchro_jaime_log(id_log, id_article, jaime) values ('".$pseudo."','".mysql_insert_id()."',0)";
		//mysql_query($query) or die(mysql_error());
	}
	
	function addPseudo($pseudo, $mdp,$mail){
		include_once "connect.php";
			$query="insert into STUL_USERS(USER_LOGIN, user_pass,user_mail) 
										values ('".$pseudo."',
												'".$mdp."',
												'".$mail."')";
			mysql_query($query) or die(mysql_error());
	}
	
	function displayDeleteForm(){		
		if (isset($_SESSION["pseudo"])){
			if(isadmin($_SESSION["pseudo"]) == 1)
			{
		?>
				<form name="deleteArticles" action="actions.php" method="POST">
				
				<!-- choix Article -->
				<label for="categorie">Quelle article ?</label>
				<select name="categorie">
				<?php
				$result=mysql_query("select post_id from STUL_POST");
				while($row=mysql_fetch_assoc($result)){
					echo "<option value='".$row["post_id"]."'>".$row["post_id"]."</option>";
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
	
	function deleteArticle($id){
		include_once"connect.php";
			$query="delete from STUL_POST where post_id='".$id."'";
			mysql_query($query) or die(mysql_error());
	}

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
		$query_com = "select c.com_id,u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent,c.post_id from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.post_id=".$row['POST_ID']." order by c.com_date";
		$result_com = mysql_query($query_com) or die(mysql_error());
		while ($row_com = mysql_fetch_assoc($result_com)) {
			if($row_com['com_parent'] == "")
			{
				echo nl2br($row_com['com_content'])." de ";
				link_profil($row_com['user_id']);
				dateTimeToTime($row_com['com_date']);
				echo "</br>";
				echo "<div id='comOfCom'>";
				afficheComOfCom($row_com['com_id']);
				add_commentaire($row_com,'▼');
				echo "</div>";
				echo "</br>";
			}
		}
	}
	function afficheComOfCom($id_com_parent)
	{
		$query_com = "select u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.com_parent=".$id_com_parent." order by c.com_date";
		$result_com = mysql_query($query_com) or die(mysql_error());
		while ($row_com = mysql_fetch_assoc($result_com)) {
			echo nl2br($row_com['com_content'])." de ";
			link_profil($row_com['user_id']);
			dateTimeToTime($row_com['com_date']);
			echo "</br>";
		}
	}
	function afficheTempsEcoulee($date)
	{
		if(date('Y',$date)-1970 != 0)
			echo " il y a ".(date('Y',$date)-1970)." an(s).";
		else if(date('m',$date)-1 != 0)
			echo " il y a ".(date('m',$date))." mois.";
		else if(date('d',$date)-1 != 0)
			echo " il y a ".(date('d',$date))." jour(s).";
		else if(date('H',$date)-1 != 0)
			echo " il y a ".(date('H',$date))." heure(s).";
		else if(date('i',$date) != 0)
			echo " il y a ".(date('i',$date))." minute(s).";
		else
			echo " il y a ".(date('s',$date))." seconde(s).";
	}
	function dateTimeToTime($date_heure)
	{
		$d1 = new DateTime($date_heure); 
		$d2 = new DateTime("now"); 
		$subtracted_value = $d2->format('U') - $d1->format('U');
		echo afficheTempsEcoulee($subtracted_value);
		
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
	function link_profil($id)
	{
		if(isset($_SESSION['id']) && $id==$_SESSION['id'])
			$log='Vous';
		else
		{
			$query="select user_login from STUL_USERS where user_id=".$id;
			$result= mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			$log=$row["user_login"];
	 	}
		echo "<span id='profil".$log."' onMouseOver='survole_profil_apercu(this,event)' onMouseOut='quitte_profil_apercu(this)'><a href='profil.php?id=".$id."'>".$log."</a>";
		profil($id);
		echo "</span>";
	}
	function profil($user_id) //verif les appels de cette fonction pour bien mettre l'id
	{
		echo "<div id='profil_apercu' style='float: left;'>";
			$query = "select user_mail, user_login from STUL_USERS where user_id=".$user_id;
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			echo "<h3>".$row['user_login']."</h3>";
			echo "Mail: ".$row['user_mail']."</br>";
			//affiche_anni($row['date_naissance'],$log);
		echo "</div>";
	}
	function isadmin($id) //verif les appels de cette fonction pour bien mettre l'id
	{
		$query = "select user_status from stul_users where user_id='".$id."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		if($row['user_status'] == 2)
			return true;
		else
			return false;
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