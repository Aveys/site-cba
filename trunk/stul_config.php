<?php
//Ce fichier contient tout les variables globales que nous avons besoin
if(!defined('ABSROOT'))
	define('ABSROOT', dirname(__FILE__).'/');
//Une variable qui commence par $f sera un fichier




$Site = '/site-cba/';
$rootSite = $_SERVER['DOCUMENT_ROOT'].$Site;
//Chemin des fichiers relatifs
$vTheme			= 'themes/cba';
$fcAction	 	= "controller/actions.php";
$fcUserView		= "user_view.php";
$fcArticle		= "articles.php";

$fmConnect 		= "model/connect.php";
$fmEscape		= "model/escape.php";
$fmSql			= "model/sql.php";
$fmAdmin		= $Site.'stul_admin.php';

$fvLayout		= "view/layout.php";
$fvInscription	= "view/inscription.php";
$fvInstall		= "install.php";
$fvArticle		= "view/article.php";

$fAdmin 		= "stul_admin.php";
$fViewerAdmin	= "includes/admin/viewer/index.php";
$fLanguage		= "includes/stul_language.php";
$fAdminFonct 	= "includes/admin/stul_fonctions.php";
$fAdminAction	= "includes/admin/stul_actions.php";


//chemin des fichiers absolus
$a_vTheme			= $rootSite.'themes/cba';
$a_fcAction	 		= $rootSite."controller/actions.php";
$a_fcUserView		= $rootSite."user_view.php";
$a_fcArticle		= $rootSite."articles.php";

$a_fmConnect 		= $rootSite."model/connect.php";
$a_fmEscape			= $rootSite."model/escape.php";
$a_fmSql			= $rootSite."model/sql.php";

$a_fvLayout			= $rootSite."view/layout.php";
$a_fvInscription	= $rootSite."view/inscription.php";
$a_fvInstall		= $rootSite."install.php";
$a_fvArticle		= $rootSite."view/article.php";

$a_fAdmin 			= $rootSite."stul_admin.php";
$a_fViewerAdmin		= $rootSite."includes/admin/viewer/index.php";
$a_fLanguage		= $rootSite."includes/stul_language.php";
$a_fAdminFonct 		= $rootSite."includes/admin/stul_fonctions.php";
$a_fAdminAction		= $rootSite."includes/admin/stul_actions.php";



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