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


?>