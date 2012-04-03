<?php
//Ce fichier contient tout les variables globales que nous avons besoin
if(!defined('ABSROOT'))
	define('ABSROOT', dirname(__FILE__).'/');
//Une variable qui commence par $f sera un fichier
$vTheme			= 'themes/cba';



$Site = 'site-cba';
//Chemin des fichiers
$fActionPhp 	= 'actions.php';
$fAdminFonct 	= 'includes/admin/stul_fonctions.php';
$fAdminAction	= 'includes/admin/stul_actions.php';
$fAdmin 		= ABSROOT.'/stul_admin.php';
$fLanguage		= 'includes/stul_language.php';
$fConnect 		= ABSROOT.'/connect.php';
$fViewerAdmin	= 'includes/admin/viewer/index.php';
/** Nom de la base de données de Stul. */
define('DB_NAME', 'votre_nom_de_bdd');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'votre_utilisateur_de_bdd');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'votre_mdp_de_bdd');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');


?>