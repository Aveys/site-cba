<?php
    //Auteur : Mathieu MARTIN
    //Date : 02/04/2012    
    require_once '../../../stul_config.php';
    require_once $a_fmConnect;
    require_once $a_fAdminAction;
    require_once $a_fmSql;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href='../../../<?php echo $vTheme; ?>/adminViewer.css' />
<script type="text/javascript" src="js/validation.js"></script>

<link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.old-school.css" />
        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        
        <!-- jQuery Cookie - https://github.com/carhartl/jquery-cookie -->
        <script type="text/javascript" src="js/cookie/jquery.cookie.js"></script>
        
        <!-- jWysiwyg - https://github.com/akzhan/jwysiwyg/ -->
        <link rel="stylesheet" href="js/jwysiwyg/jquery.wysiwyg.old-school.css" />
        <script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
        
        
        <!-- Tooltipsy - http://tooltipsy.com/ -->
        <script type="text/javascript" src="js/tooltipsy.min.js"></script>
        
        <!-- iPhone checkboxes - http://awardwinningfjords.com/2009/06/16/iphone-style-checkboxes.html -->
        <script type="text/javascript" src="js/iphone-style-checkboxes.js"></script>
        <script type="text/javascript" src="js/excanvas.js"></script>
        
        <!-- Load zoombox (lightbox effect) - http://www.grafikart.fr/zoombox -->
        <script type="text/javascript" src="js/zoombox/zoombox.js"></script>
        
        <!-- Charts - http://www.filamentgroup.com/lab/update_to_jquery_visualize_accessible_charts_with_html5_from_designing_with/ -->
        <script type="text/javascript" src="js/visualize.jQuery.js"></script>
        
        <!-- Uniform - http://uniformjs.com/ -->
        <script type="text/javascript" src="js/jquery.uniform.js"></script>
        
        
        <!-- Main Javascript that do the magic part (EDIT THIS ONE) -->
        <script type="text/javascript" src="js/main.js"></script>
<title>Stul Admin</title>

</head>
    <body class="white">
        <?php 
            if(!(isset($_SESSION["keyAdmin"]) == (isset($_SESSION["pass"])*isset($_SESSION["login"])) && isset($_SESSION["adminAuth"]) == 1))
                header('Location:../../../stul_admin.php');

            if(isset($_GET["action"]) == "logout")
            {
                    unset($_SESSION["login"]);
                    unset($_SESSION["pass"]);
                    unset($_SESSION["keyAdmin"]);
                    unset($_SESSION["adminAuth"]);
                    
                    header('Location:../../../stul_admin.php');
            }
            ?>



        <!--Inclusion du header de la bar-->
        <?php include_once("header.php"); ?>
        
        <!--Inclusion de la sidebar-->      
        <?php include_once("sidebar.php"); ?>
        
        <?php 
        if(isset($_GET["mode"]))       
        {
            $valuemode = $_GET["mode"];

            switch ($valuemode) {
                case 'editArticles':
                    include_once("edit_articles.php");
                break; 

                case 'board':
                    include_once("board.php");
                break;

                case 'editArticle':
                    include_once("edit_article.php");
                break;

                case 'delArticle':
                    include_once("del_article.php");
                break;

                case 'addArticle':
                    include_once("add_article.php");
                break;

                case 'editComptes':
                    include_once("edit_comptes.php");
                break;

                case 'editCompte':
                    include_once("edit_compte.php");
                break;
                case 'addCompte':
                    include_once("add_compte.php");
                break;
                
                default:
                   
                    break;
            }
        }
        else
        {
            include_once("board.php");
        }
        ?>
                
                
                
        <!--            
              CONTENT 
                        --> 
        
       
    </body>
</html>