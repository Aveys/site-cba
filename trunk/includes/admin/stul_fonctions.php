<?php
//Inclusion des fichier
	    

//Fonction qui ajoute le formulaire de connexion de l'admin
function addFormAdmin()
{
	require 'stul_config.php';
	require_once $fLanguage;

	?>
	<!--Contenue du formulaire de connexion admin-->
	<div id="login">
		<h1><img src='<?php echo $vTheme;?>./images/icons/lock-closed.png' alt=""/>STUL Admin</h1>
		<!--Message d'erreur lors de la connexion-->
		<?php
		if(isset($_SESSION["error_loginAdmin_message"]))
		{			
			?>
			<div class="notif">
				 <?php echo $smeLoginAdmin; ?>
			</div>
			<?php
			unset($_SESSION["error_loginAdmin_message"]);
		}
		?>

		<!--Formulaire de l'admin-->
		<form id="loginAdmin" method="POST" action='<?php echo $fAdminAction;?>' name="loginAdmin">
			<p>
				<label for="pseudo">
					<?php echo $vmLoginAdmin;?><br/>
					<input id="user_login" size="35" name="login"/>
				</label>
			</p>
			<p>
				<label for="password">
					<?php echo $vmPassAdmin;?><br/>
					<input id="user_password" type="password" size="35" name="password"/>
				</label>
			</p>
			<p>
				<input class="bouton" type="submit" value='<?php echo $vmSubmitAdmin;?>' name="action"/>
			</p>
		</form>
	</div><!--login-->

	<?php
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
			$result= sql_all_post();
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

/*	fonction qui demande a la bdd si l'utilisateur est admin
*/
function isadmin($id) //verif les appels de cette fonction pour bien mettre l'id
{
	if(sql_user_status($id) == 2)
		return true;
	else
		return false;
}


//Function permet de vérifier si c'est bien un admin qui se connect + verification avec une clé md5 de pass*login
function checkLoginAdmin( $login, $pass){
	//Inclusion des fichiers
	require '../../stul_config.php';
	require_once $a_fmConnect;

	//Variable proteger d'une faille SQL
	$loginF = htmlspecialchars($login);
	$passwordF = htmlspecialchars($pass);

	//Execution des requete pour savoir si il y le bon login, passowrd et qu'il appartient au statut admin = 2
	$query = "SELECT * FROM stul_users WHERE USER_LOGIN='".$loginF."' AND USER_PASS='".sha1($passwordF)."' AND USER_STATUS='2' ";
	$row = mysql_fetch_assoc(mysql_query($query));
	$ligne = mysql_num_rows(mysql_query($query));
    //Vérification 
	if($ligne == 1)
	{
		$_SESSION["idUser"] = $row['USER_ID'];
		$_SESSION["login"] = $loginF;
		$_SESSION["pass"] = $passwordF;
		$_SESSION["keyAdmin"] = md5($passwordF*$loginF);
		$_SESSION["adminAuth"] = 1;
        sql_log_connexion();
		echo '<script language="Javascript">document.location.replace("'.$fmAdmin.'");</script>';	//redirection vers l'index.php
	}
	else
	{
		$_SESSION["error_loginAdmin_message"] = "Ce login ou mots de passe n'existe pas";
		echo '<script language="Javascript">document.location.replace("'.$fmAdmin.'");</script>';	//redirection vers l'index.php
	}
}

?>