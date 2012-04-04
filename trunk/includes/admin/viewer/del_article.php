<?php 

$idArticle = $_GET["id"];  

sql_delete_post($idArticle);
echo '<script language="Javascript">document.location.replace("./viewer/index.php?mode=editArticles");</script>';
?>

