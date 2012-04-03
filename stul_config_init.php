<?php
//Ce fichier contient tout les variables globales que nous avons besoin
if(!defined('ABSROOT'))
	define('ABSROOT', dirname(__FILE__).'/');
//Une variable qui commence par $f sera un fichier
$vTheme			= 'themes/cba';



$Site = 'nom-site';
//Chemin des fichiers
$fActionPhp 	= 'actions.php';
$fAdminFonct 	= 'includes/admin/stul_fonctions.php';
$fAdminAction	= 'includes/admin/stul_actions.php';
$fAdmin 		= $_SERVER["DOCUMENT_ROOT"].''.$Site.'stul_admin.php';
$fLanguage		= 'includes/stul_language.php';
$fConnect 		= $_SERVER["DOCUMENT_ROOT"].''.$Site.'model/connect.php';
$fViewerAdmin	= 'includes/admin/viewer/index.php';

/** Nom de la base de données de Stul. */
if(!defined('DB_NAME'))
	define('DB_NAME', 'votre_nom_de_bdd');


/** Utilisateur de la base de données MySQL. */
if(!defined('DB_USER'))
	define('DB_USER', 'votre_utilisateur_de_bdd');

/** Mot de passe de la base de données MySQL. */
if(!defined('DB_USER'))
	define('DB_PASSWORD', 'votre_mdp_de_bdd');

/** Adresse de l'hébergement MySQL. */
if(!defined('DB_HOST'))
	define('DB_HOST', 'localhost');


?>