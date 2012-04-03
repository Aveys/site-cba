<?php
include_once "view_comment.php";

/*affiche tous les articles de la bdd avec ses infos
	- nom du posteur, date de création
*/
function displayArticles(){
	$result = sql_all_post();
	while($row=mysql_fetch_assoc($result)){
		echo "<div class='article'>".$row['POST_CONTENT']."</div>";
		echo "<div class='info_article'>Fait par ";
		link_profil(sql_user_who_post($row['POST_ID']));
		echo " le ".$row['POST_DATE'].".</div>";
		button_delete_post($row['POST_ID']);			//bouton delete pour supprimer le post
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

/*	formulaire d'ajout de post seulement si utilisateur connecte
*/
function displayAddForm(){
	if (isset($_SESSION["pseudo"])){
	?>
		<form name="articles" action="actions.php" method="POST" onSubmit="return valid()">

		<!-- texte -->
		<label for="texte">Texte :</label>
		<textarea name="texte" cols="50" row="30" onBlur="verifTexte(this)"></textarea> 
		<br/><br/>
		
		<!-- submit -->
		<input type="submit" name="action" value="ajouter"/>

		</form>
	
	<?php
	}
	else
		echo "Veuillez vous loger.</br>";
}

/*	affichage du temps écoulé sous le format facebook
		- il y a quelques secondes
		- il y a 3 heures
*/
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
		echo " il y a quelques secondes.";
}

/*	fonction qui calcule la différence de 2 temps 
*/
function dateTimeToTime($date_heure)
{
	$d1 = new DateTime($date_heure); 
	$d2 = new DateTime("now"); 
	$subtracted_value = $d2->format('U') - $d1->format('U');	//différence
	echo afficheTempsEcoulee($subtracted_value);				//affichage format facebook
	
}

/*	affichage du pseudo avec un lien vers la page de profil ainsi qu'un apercu du profil en passant le curseur dessus
*/
function link_profil($id)
{
	if(isset($_SESSION['id']) && $id==$_SESSION['id'])	//si le profil a affiche et celui de l'utilisateur alors on le nomme "vous"
		$log='Vous';
	else
	{
		$log = sql_user_of_id($id);
 	}
	echo "<span id='profil".$log."' onMouseOver='survole_profil_apercu(this,event)' onMouseOut='quitte_profil_apercu(this)'><a href='profil.php?id=".$id."'>".$log."</a>";
	profil($id);
	echo "</span>";
}

/*	apercu du profil avec gestion maque/non masque si curseur dessus en javascript
*/
function profil($user_id) 
{
	echo "<div id='profil_apercu' style='float: left;'>";
		$row = sql_info_user($user_id);
		echo "<h3>".$row['user_login']."</h3>";
		echo "Mail: ".$row['user_mail']."</br>";
		//affiche_anni($row['date_naissance'],$log);
	echo "</div>";
}

/*	affiche le profil et si l'utilisateur est admin ou sur son profil alors il peut l'editer
*/
function afficher_info_user($id)
{
	if(autorise_edition($id))
		echo "<a href="."profil.php?id=".$id."&editer=1>editer</a></br>";
	$row = sql_info_user($id);
	echo "Mail: ".$row['user_mail']."</br>";
	//affiche_anni($row['date_naissance'],$login);
}

/*	formulaire d'edition du profil seulement si l'utilisateur est admin ou sur son profil
*/
function editer_info_user($id)
{
	if(autorise_edition($id))
	{
		$row = sql_info_user($id);
		echo "</br></br><form method='post' name='editer_user' action='actions.php'>";
			echo "<label for='mail'>Mail :</label>";
			echo "<input name='mail' value='".$row['user_mail']."'/></br></br>";
			//echo "<label for='naissance'>Date de naissance :</label>";
			//echo "<input type='text' name='naissance' class='calendrier' size='8' value='".$row['date_naissance']."'/></br></br>";
			echo "<input type='submit' name='action' value='Editer'/>";
			echo "<input type='hidden' name='id' value='".$id."'/>";
		echo"</form>";
	}
}
?>