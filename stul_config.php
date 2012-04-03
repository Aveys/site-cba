<?php
//Ce fichier contient tout les variables globales que nous avons besoin
if(!defined('ABSROOT'))
	define('ABSROOT', dirname(__FILE__).'/');
//Une variable qui commence par $f sera un fichier
$vTheme			= 'themes/cba';



$Site = '/site-cba/';
$rootSite = $_SERVER['DOCUMENT_ROOT'].$Site;
//Chemin des fichiers
$fcAction	 	= "controller/actions.php";
$fcUserView		= $rootSite."user_view.php";
$fcArticle		= $rootSite."articles.php";

$fmConnect 		= $rootSite."model/connect.php";
$fmEscape		= $rootSite."model/escape.php";
$fmSql			= $rootSite."model/sql.php";

$fvLayout		= $rootSite."view/layout.php";
$fvInscription	= $rootSite."view/inscription.php";
$fvInstall		= $rootSite."install.php";
$fvArticle		= $rootSite."article.php";

$fAdmin 		= $rootSite."stul_admin.php";
$fViewerAdmin	= $rootSite."includes/admin/viewer/index.php";
$fLanguage		= $rootSite."includes/stul_language.php";
$fAdminFonct 	= $rootSite."includes/admin/stul_fonctions.php";
$fAdminAction	= "includes/admin/stul_actions.php";



/** Nom de la base de données de Stul. */
if(!defined('DB_NAME'))
	define('DB_NAME', 'iut');


/** Utilisateur de la base de données MySQL. */
if(!defined('DB_USER'))
	define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
if(!defined('DB_PASSWORD'))
	define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
if(!defined('DB_HOST'))
	define('DB_HOST', 'localhost');


?>