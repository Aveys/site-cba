<?php
//Ce fichier contient tout les variables globales que nous avons besoin
if(!defined('ABSROOT'))
        define('ABSROOT', dirname(__FILE__).'/');
//Une variable qui commence par $f sera un fichier
$vTheme                 = 'themes/cba';



$Site = '/site-cba/';
//Chemin des fichiers
$fcActionPhp    = $_SERVER['DOCUMENT_ROOT'].$Site.'actions.php';
$fcUserView             = $_SERVER['DOCUMENT_ROOT'].$Site.'user_view.php';

$fmConnect              = $_SERVER["DOCUMENT_ROOT"].$Site.'model/connect.php';
$fmEscape               = $_SERVER['DOCUMENT_ROOT'].$Site.'model/escape.php';
$fmSql                  = $_SERVER['DOCUMENT_ROOT'].$Site.'model/sql.php';

$fvLayout               = $_SERVER['DOCUMENT_ROOT'].$Site.'view/layout.php';
$fvInscription  = $_SERVER['DOCUMENT_ROOT'].$Site.'view/inscription.php';
$fvInstall              = $_SERVER['DOCUMENT_ROOT'].$Site.'install.php';

$fAdmin                 = $_SERVER["DOCUMENT_ROOT"].$Site.'stul_admin.php';
$fViewerAdmin   = $_SERVER['DOCUMENT_ROOT'].$Site.'includes/admin/viewer/index.php';
$fLanguage              = $_SERVER['DOCUMENT_ROOT'].$Site.'includes/stul_language.php';
$fAdminFonct    = $_SERVER['DOCUMENT_ROOT'].$Site.'includes/admin/stul_fonctions.php';
$fAdminAction   = $_SERVER['DOCUMENT_ROOT'].$Site.'includes/admin/stul_actions.php';

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