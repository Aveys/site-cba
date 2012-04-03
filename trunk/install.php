<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//function install(){
define( 'ABSPATH', dirname(__FILE__) . '/' );
$configFile = file(ABSPATH . 'stul_config.php');

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 1;


switch($step){
	case 1 : 
	displayHeader();?>
	<body>	
		<div id="all">
			<div id="content">
				<div id="header" class="box">
					<div id="logo"><img alt="Stul" src="images/install/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Etape 1 : Bienvenue</div>
				</div>
				<div id="text" class="box">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis vehicula nunc, bibendum posuere sapien volutpat in. Fusce vehicula ornare odio sed feugiat. Ut consequat risus id massa mattis mollis. In malesuada lacinia rhoncus. Quisque porta imperdiet mi, id ullamcorper erat vulputate et. Suspendisse vel velit tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris sit amet sem et nulla luctus porttitor et ut nisl. Maecenas congue orci massa, ac gravida massa. Nullam eget odio eu purus tempor tincidunt nec vitae tellus. Pellentesque leo ligula, suscipit quis mattis non, pretium eu urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras nisl enim, suscipit eu ultrices faucibus, egestas ut odio.</p>
					<p>Aenean vel justo ut neque venenatis consectetur nec eu leo. Nulla scelerisque, libero feugiat sollicitudin laoreet, turpis magna malesuada nisi, id venenatis lorem ipsum sit amet sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lacinia mi vel tellus auctor convallis. Maecenas pellentesque arcu non augue vestibulum nec tempor ligula sagittis. Sed non enim eu tortor convallis aliquet ut eget tortor. In mollis fermentum tincidunt. Curabitur in purus et diam molestie convallis.</p>
					<p>Sed cursus, nulla nec dignissim auctor, nisi urna accumsan erat, quis bibendum ipsum mauris facilisis mi. Ut hendrerit dolor vel odio consequat at ultricies felis tincidunt. Quisque et dolor urna. Vestibulum adipiscing elit leo. Morbi a hendrerit ligula. Integer sed lorem a urna facilisis tempor non non ligula. In at augue sem.</p>

				</div>
				<div id="footer">
					<div id="continuer" class="button"><a href="install.php?step=2">Continuer</div>
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
					<div id="logo"><img alt="Stul" src="images/install/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Etape 2 : Base de donnée</div>
				</div>
				<div id="text" class="box">
					<p> Veuillez rentrer les identifiants permettant de se connecter à la base de donnée MySQL</p>
					<div id="formulaire">
						<form action="install.php?step=3" method="POST" name="addBDD" onsubmit="return valid_sql(this)">
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
		print_r($_POST);
		require_once("sql.php");
		$dbname  = trim($_POST['BDD']);
		$uname   = trim($_POST['user']);
		$passwrd = trim($_POST['mdp']);
		$dbhost  = trim($_POST['host']);
		$link=mysql_connect($dbhost,$uname,$passwrd) or die(mysql_error()); //or die(erreur_SQL());
		mysql_select_db($dbname) or die(mysql_error()); //or die(erreur_SQL());
		mysql_query("set names 'UTF8'");
		foreach($createtable as $c)
			mysql_query($c);
		$fp = fopen("stul_config.php","a");
		$txt="define('DB_NAME','".$dbname."');";
		fputs($fp,$txt);
		$txt="define('DB_USER','".$uname."');";
		fputs($fp,$txt);
		$txt="define('DB_PASSWORD','".$passwrd."');";
		fputs($fp,$txt);
		$txt="define('DB_HOST','".$dbhost."');";
		fputs($fp,$txt);
		fclose($fp);


	}
	else
		header("location:install.php?step=2");
	displayHeader();?>
	<body>
		<div id="all">
			<div id="content">
				<div id="header" class="box">
					<div id="logo"><img alt="Stul" src="images/install/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Etape 3 : Creation du compte administrateur</div>
				</div>
				<div id="text" class="box">
					<p> La connexion à la base de donnée s'est bien déroulée, nous allons maintenant configurer votre compte administrateur</p>
					<p class="box">Informations du compte</p>
					<div id="formulaire">
						<form action="install.php?step=4" method="POST" name="addAdmin" onSubmit="return valid_compte(this)">
							<input type='text' name='login' value='admin' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="login">Login du compte</label>
							<input type='password' name='mdp' value='' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="mdp">Mot de passe du compte.</label><br/>
							<input type='password' name='mdp_verf' value=''  onBlur='verif(this)'/>
							<label for="mdp_verf">Verifcation du mot de passe.</label><br/>
							<input type='text' name='mail' value='' onFocus='init(this)' onBlur='notEmpty(this)'/>
							<label for="mail">Entrez une adresse mail valide.</label><br/>


						</div>
					</div>
					<div id="footer">
						<input type="reset" class="button" value="reset"/><input class="button" type="submit" value="Continuer" />
						<input type="hidden" name="action" value="envoyer"/>
					</form><br/>



				</div>
				<div id="footer">
					<div id="tryagain" class="button"><a href="install.php?step=2">Continuer</div>

			</div>

		</div>
	</div>


</body>
</html>
<?php
break;
case 4:
if (isset($_POST)){
		print_r($_POST);
		mysql_query("INSERT INTO STUL_USERS('USERL_LOGIN','USER_PASS',USER_DISPLAYNAME,USER_MAIL,USER_REGISTERED,USER_STATUS) VALUES ('".$_POST["login"]."'")
	}
	else
		header("location:install.php?step=4");
	displayHeader();break;


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
		<link rel="stylesheet" type="text/css" href="css/install.css" />
		<script type="text/javascript" src="script.js"></script>

	</head>
	<?php
}
function erreur_SQL(){
	displayHeader();?>
	<body>
		<div id="all">
			<div id="content">
				<div id="header" class="box">
					<div id="logo"><img alt="Stul" src="images/install/logo.png" /></div>
					<div id="titre">INSTALLATION</div>
					<div id="sous-titre"> Erreur lors de l’établissement de la connexion à la base de données</div>
				</div>
				<div id="text" class="box">
					<p>Cela signifie soit que l&rsquo;identifiant et/ou le mot de passe indiqué(s) sont incorrects, ou que le serveur de base de données à l&rsquo;adresse <code><?php echo $_POST["host"] ?></code> est inaccessible - cela peut indiquer que le serveur de base de données de votre hébergeur est défaillant.</p>
					<ul>
						<li>Êtes-vous certain(e) d&rsquo;avoir correctement indiqué votre identifiant et votre mot de passe&nbsp;?</li>
						<li>Êtes-vous certain(e) d&rsquo;avoir entré le bon serveur de base de données&nbsp;?</li>
						<li>Êtes-vous certain(e) que le serveur de base de données fonctionne correctement&nbsp;?</li>
					</ul>
					<p>Si vous n&rsquo;êtes pas sûr(e) de bien comprendre les mots de cette liste, vous devriez sans doute prendre contact avec votre hébergeur.</p>
				</div>
				<div id="footer">
					<div id="tryagain" class="button"><a href="install.php?step=2">Réessayez</div>

			</div>

		</div>
	</div>


</body>
</html>
<?php

}
?>
