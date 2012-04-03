<?php 
if (isset($_GET["id"])){
	switch ($_GET["id"]) {
		case 1:
			?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Stul - Installation</title>
						<link rel="stylesheet" type="text/css" href="install.css" />
						<script type="text/javascript" src="script.js"></script>

					</head>
					<body>
						<div id="all">
							<div id="content">
								<div id="header" class="box">
									<div id="logo"><img alt="Stul" src="images/logo.png" /></div>
									<div id="titre">INSTALLATION</div>
									<div id="sous-titre"> Erreur lors de l’établissement de la connexion à la base de données</div>
								</div>
								<div id="text" class="box">
									<p>Cela signifie soit que l&rsquo;identifiant et/ou le mot de passe indiqué(s) sont incorrects, ou que le serveur de base de données à l&rsquo;adresse <code><?php echo $_GET["host"] ?></code> est inaccessible - cela peut indiquer que le serveur de base de données de votre hébergeur est défaillant.</p>
									<ul>
										<li>Êtes-vous certain(e) d&rsquo;avoir correctement indiqué votre identifiant et votre mot de passe&nbsp;?</li>
										<li>Êtes-vous certain(e) d&rsquo;avoir entré le bon serveur de base de données&nbsp;?</li>
										<li>Êtes-vous certain(e) que le serveur de base de données fonctionne correctement&nbsp;?</li>
									</ul>
									<p>Si vous n&rsquo;êtes pas sûr(e) de bien comprendre les mots de cette liste, vous devriez sans doute prendre contact avec votre hébergeur.</p>
								</div>
								<div id="footer">
									<div id="tryagain" class="button"><a href="../install.php?step=2">Réessayez</div>

								</div>

							</div>
						</div>


					</body>
					</html>
					<?php
			break;
		case 1:
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Stul - Installation</title>
						<link rel="stylesheet" type="text/css" href="install.css" />
						<script type="text/javascript" src="script.js"></script>

					</head>
					<body>
						<div id="all">
							<div id="content">
								<div id="header" class="box">
									<div id="logo"><img alt="Stul" src="images/logo.png" /></div>
									<div id="titre">INSTALLATION</div>
									<div id="sous-titre"> Erreur lors de a tentative d'écriture de <code>stul_config.php</code></div>
								</div>
								<div id="text" class="box">
									<p>Cela signifie que Stul n'as pas pu ecrire dans le répertoire racine de l'hébergement. Soit les droits du répertoire (chmod) empeche Stul d'ecrire, soit le fichier est déja ouvert quelque part </p>
									<ul>
										<li>Êtes-vous certain(e) d&rsquo;avoir correctement réglé les droits chmod sur le répertoire (740)?</li>
										<li>Êtes-vous certain(e) que vous exécutez ce script pour la premiere fois ?</li>
										<li>Êtes-vous certain(e) que le serveur ftp fonctionne correctement&nbsp;?</li>
									</ul>
									<p>Si vous n&rsquo;êtes pas sûr(e) de bien comprendre les mots de cette liste, vous devriez sans doute prendre contact avec votre hébergeur.</p>
								</div>
								<div id="footer">
									<div id="tryagain" class="button"><a href="../install.php?step=3">Réessayez</a></div>

								</div>

							</div>
						</div>


					</body>
					</html>
					<?php
			break;
		
		default:
			header("location:install.php");
			break;
	}
}