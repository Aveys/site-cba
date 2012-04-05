<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//function install(){
define( 'ABSPATH', dirname(__FILE__) . '/' );

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 1;
$configFile= file('stul_config_init.php');
//print_r($configFile);
	
function execute_file_sql($file)
{
  $content = file_get_contents($file);
  $requetes = explode(";", $content);
  foreach ($requetes as $key => $value) {
     if($value != "")
        mysql_query($value);
  }
}

switch($step){
	case 1 : 
	displayHeader();?>
	<body>	
		<div id="all">
			<div id="content">
				<div id="header" class="box">
					<div id="logo"><img alt="Stul" src="install/images/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Etape 1 : Bienvenue</div>
				</div>
				<div id="text" class="box">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis vehicula nunc, bibendum posuere sapien volutpat in. Fusce vehicula ornare odio sed feugiat. Ut consequat risus id massa mattis mollis. In malesuada lacinia rhoncus. Quisque porta imperdiet mi, id ullamcorper erat vulputate et. Suspendisse vel velit tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris sit amet sem et nulla luctus porttitor et ut nisl. Maecenas congue orci massa, ac gravida massa. Nullam eget odio eu purus tempor tincidunt nec vitae tellus. Pellentesque leo ligula, suscipit quis mattis non, pretium eu urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras nisl enim, suscipit eu ultrices faucibus, egestas ut odio.</p>
					<p>Aenean vel justo ut neque venenatis consectetur nec eu leo. Nulla scelerisque, libero feugiat sollicitudin laoreet, turpis magna malesuada nisi, id venenatis lorem ipsum sit amet sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia mi vel tellus auctor convallis. Maecenas pellentesque arcu non augue vestibulum nec tempor ligula sagittis. Sed non enim eu tortor convallis aliquet ut eget tortor. In mollis fermentum tincidunt. Curabitur in purus et diam molestie convallis.</p>
					<p>Sed cursus, nulla nec dignissim auctor, nisi urna accumsan erat, quis bibendum ipsum mauris facilisis mi. Ut hendrerit dolor vel odio consequat at ultricies felis tincidunt. Quisque et dolor urna. Vestibulum adipiscing elit leo. Morbi a hendrerit ligula. Integer sed lorem a urna facilisis tempor non non ligula. In at augue sem.</p>

				</div>
				<div id="footer">
					<div id="continuer" class="button"><a href="install.php?step=2">Continuer</a></div>
					<div id="w3c"><p>
						<a href="http://validator.w3.org/check?uri=referer"><img alt="Stul" src="http://www.w3.org/Icons/valid-xhtml10" height="31" width="88" /></a>
					</p>
				</div>
			</div>
		</div>
	</div>


	</body>
	</html>

	<?php break;
	case 2:
	displayHeader();
	?>
	
	<body>
		<div id="all">
			<div id="content">
				<div id="header" class="box">
					<div id="logo"><img alt="Stul" src="install/images/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Etape 2 : Base de donnée</div>
				</div>
				<div id="text" class="box">
					<p> Veuillez rentrer les identifiants permettant de se connecter à la base de donnée MySQL</p>
					<div id="formulaire">

						<form action="install.php?step=3" method="post" name="addBDD" onSubmit="return valid_sql(this)">
							<input type='text' name='host' value='localhost' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="host">Si localhost ne marche pas, vous devrez demander cette information à votre hébergeur.</label>
							<input type='text' name='user' value='root' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="user">Votre identifiant MySQL.</label><br/>
							<input type='password' name='mdp' value='password'  onFocus='init(this)'/>
							<label for="mdp">Votre mot de passe MySQL.</label><br/>
							<input type='text' name='BDD' value='Base de donnée' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="BDD">Le nom de votre Base de donnée.</label><br/>


						</div>
					</div>
					<div id="footer">
						<input type="reset" class="button" value="reset"/><input class="button" type="submit" value="Continuer" />
						<input type="hidden" name="action" value="envoyer"/>
					</form><br/>
				</div>

			</div>
		</div>


	</body>
	</html>

	<?php
	break;

	case 3:
	if (isset($_POST)){
		//print_r($_POST);
		$dbname  = trim($_POST['BDD']);
		$uname   = trim($_POST['user']);
		$passwrd = trim($_POST['mdp']);
		$dbhost  = trim($_POST['host']);
		$link=mysql_connect($dbhost,$uname,$passwrd,true);
		if(!$link){
			erreur_SQL();
		}else{
			$db=mysql_select_db($dbname);
			if(!$db)
				erreur_SQL();
			else{
				mysql_query("set names 'UTF8'");

				execute_file_sql("bdd/stul_EMPTY.sql");
				foreach ($configFile as $line_num => $line) {
					//echo(substr($line,1,16))."/n";
					switch (substr($line,1,16)) {
						case "define('DB_NAME'":
							//echo "1";
							$configFile[$line_num] = str_replace("votre_nom_de_bdd", $dbname, $line);
						break;
						case "define('DB_USER'":
							//echo "2";
							$configFile[$line_num] = str_replace("'votre_utilisateur_de_bdd'", "'".$uname."'", $line);
					 	break;
						case "define('DB_PASSW":
							//echo "3";
							$configFile[$line_num] = str_replace("'votre_mdp_de_bdd'", "'".$passwrd."'", $line);
						break;
						case "define('DB_HOST'":
							//echo "4";
							$configFile[$line_num] = str_replace("localhost", $dbhost, $line);
						break;

					}
				}

								if(is_writable(ABSPATH)){
									//echo "ok";
								$handle = fopen('stul_config.php', 'w');
								foreach( $configFile as $line ) {
									fwrite($handle, $line);
								}
								fclose($handle);
								}else 
									erreur_ecriture();
							}
						}
	}//else
		//echo '<script language="Javascript">document.location.replace("install.php?step=2");</script>';
	displayHeader();unset($_POST);unset($configFile)?>
		<body>
			<div id="all">
				<div id="content">
								<div id="header" class="box">
									<div id="logo"><img alt="Stul" src="install/images/logo.png" /></div>
									<div id="titre">INSTALLATION</div>
									<div id="sous-titre"> Etape 3 : Creation du compte administrateur</div>
								</div>
								<div id="text" class="box">
									<p> La connexion à la base de donnée s'est bien déroulée, nous allons maintenant configurer votre compte administrateur</p>
									<p class="box">Informations du compte</p>
									<div id="formulaire">
										<form action="install.php?step=4" method="post" name="addAdmin" onSubmit="return verify()">
											<input type='text' name='login' value='admin' onFocus='init(this)' onBlur='notEmpty(this)'/>
											<label for="login">Login du compte</label><br/>
											<input type='password' name='mdp' value='' onFocus='init(this)' onBlur="verify()"/>
											<label for="mdp">Mot de passe du compte.</label><br/>
											<input type='password' name='mdp_verf' value='' onBlur="verify()"/>
											<label for="mdp_verf">Verifcation du mot de passe.</label><br/>
											<DIV ID="password_result">&nbsp;<br/></DIV>
											<input type='text' name='mail' value='' onFocus='init(this)' onBlur='notEmpty(this)'/>
											<label for="mail">Entrez une adresse mail valide.</label><br/>
										</div>
									</div>
									<div id="footer">
										<input type="reset" class="button" value="reset"/><input class="button" type="submit" value="Continuer" />
										<input type="hidden" name="action" value="envoyer"/>
									</form><br/>
								</div>
							</div>
						</div>


		</body>
		
					<?php
					break;

					case 4:

					if (isset($_POST["login"]) && check_admin()){
						require_once("stul_config.php");
						require_once("model/connect.php");
						$query=mysql_query("INSERT INTO STUL_USERS (USER_LOGIN,USER_PASS,USER_DISPLAYNAME,USER_MAIL,USER_REGISTERED,USER_STATUS) VALUES ('".$_POST["login"]."','".sha1($_POST["mdp"])."','".$_POST["login"]."','".$_POST["mail"]."',now(),2);");
						$_SESSION['login'] = $_POST["login"];
						$_SESSION["id"] = mysql_insert_id(); 
						$query=mysql_query("INSERT INTO STUL_POST(USER_ID,POST_DATE,CATEGORY_ID,POST_STATUS,POST_TYPE,POST_TITLE,POST_CONTENT,POST_TAG) VALUES (1,now(),1,1,1,'Bienvenue sur Stul','Ceci est votre premier article sur stul. N\'hesitez pas à le modifier ou l\'editer pour prendre en main Stul','article');");
						$query=mysql_query("INSERT INTO STUL_POST(USER_ID,POST_DATE,CATEGORY_ID,POST_STATUS,POST_TYPE,POST_TITLE,POST_CONTENT,POST_TAG) VALUES (1,now(),2,1,1,'News','Ceci est votre premiere news eur stul. N\'hesitez pas à la modifier ou l\'editer pour prendre en main Stul','news');");
						}

					//else
						//echo '<script language="Javascript">document.location.replace("install.php?step=4");</script>';
					displayHeader();?>
					<body>
						<div id="all">
							<div id="content">
								<div id="header" class="box">
									<div id="logo"><img alt="Stul" src="install/images/logo.png" /></div>
									<div id="titre">INSTALLATION</div>
									<div id="sous-titre"> Etape 4 : Creation du site</div>
								</div>
								<div id="text" class="box">
									<p> Le Compte administrateur a bien été crée.<br/>Nous touchons à la fin de l'installation : Il ne reste qu'a configurer les informations générales du site</p>
									
									<div id="formulaire">
										<form action="install.php?step=5" method="post" name="site">
											<input type='text' name='nom' value='' onFocus='init(this)' onBlur='notEmpty(this)'/>
											<label for="nom">Nom du répertoire parent du site</label><br/>
											<input type='text' name='site' value='' onFocus='init(this)' onBlur='notEmpty(this)'/>
											<label for="nom">Nom du site</label><br/>
										</div>
									</div>
									<div id="footer">
										<input type="reset" class="button" value="reset"/><input class="button" type="submit" value="Continuer" />
										<input type="hidden" name="action" value="envoyer"/>
									</form><br/>
								</div>
							</div>
						</div>


					</body>
					</html>
					<?php
					break;
					case 5:

					$configFile= file('stul_config.php');
					if (isset($_POST["nom"])){
						$nom=$_POST["nom"];
						$site=$_POST["site"];
						//print_r($configFile);
						foreach ($configFile as $line_num => $line) {
							//echo $nom;
							//echo substr($line,1,6)."<br/>";
							switch (substr($line,1,6)) {
								case 'Site =':
									$configFile[$line_num] = str_replace("nom-site", $nom, $line);
								break;
								case 'Title ':
									$configFile[$line_num] = str_replace("titre", $site, $line);
								break;

						
							}
						}
						if(is_writable(ABSPATH)){
							$handle = fopen(ABSPATH . 'stul_config.php', 'w');
							foreach( $configFile as $line ) {
								fwrite($handle, $line);
							}
							fclose($handle);
						}
						else 
							erreur_ecriture();
					}
					else
						echo '<script language="Javascript">document.location.replace("install.php?step=5");</script>';
					displayHeader();delete_file();
					?>
					<body>
						<div id="all">
							<div id="content">
								<div id="header" class="box">
									<div id="logo"><img alt="Stul" src="install/images/logo.png" /></div>
									<div id="titre">INSTALLATION</div>
									<div id="sous-titre"> Etape 5 : Finalisation</div>
								</div>
								<div id="text" class="box">
									<p> Félicitation, la création de votre site est maintenant terminée. Vous pouvez désormais y acceder et publier du contenu.</p>
									<p> Merci d'avoir choisi Stul pour gerer votre site web.  </p>
								</div>
									<div id="footer">
										<div id="continuer" class="button"><a href="index.php">Terminer</div>
									</form><br/>
								</div>
							</div>
						</div>


					</body>
					</html>
					<?php
					break;


						}

					


				



//}
//}
				function displayHeader(){
					?>
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Stul - Installation</title>
						<link rel="stylesheet" type="text/css" href="install/install.css" />
						<script type="text/javascript" src="install/script.js"></script>

					</head>
					<?php
				}
				function erreur_SQL(){
					echo '<script language="Javascript">document.location.replace("'."install/error.php?id=1&host=".$_POST["host"].'");</script>';
				}
				function erreur_ecriture(){
					echo '<script language="Javascript">document.location.replace("install/error.php?id=2");</script>';

				}
				function check_admin(){
					if (isset($_POST)){
					$submit=true;
					
					if (!preg_match("/^(.+)@(.+)\.(.+)$/",$_POST["mail"])){

						$submit=false;}
					if (strlen($_POST["mdp"]>16)){

						$subit=false;}
					if ($_POST["mdp"]!=$_POST["mdp_verf"] || $_POST["mdp"]=='') {

						$submit=false;
					};
					return $submit;}

				}
				function delete_file(){

					
					unlink('install/images/bg.jpg');
					unlink('install/images/button.png');
					unlink('install/images/carbon.gif');
					unlink('install/images/logo.png');
					rmdir('install/images');

					unlink('install/polices/Roboto-Bold.ttf');
					unlink('install/polices/Roboto-Regular.ttf');
					unlink('install/polices/Roboto-Thin.ttf');
					rmdir('install/polices');

					unlink('install/error.php');
					unlink('install/install.css');
					unlink('install/script.js');
					rmdir('install');
					
					unlink('install.php');
					unlink('stul_config_init.php');
				}//unlink pour supprimer un fichier
				?>

