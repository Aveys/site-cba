<?php 

$idArticle = $_GET["id"];  

sql_delete_post($idArticle);

header('Location:./viewer/index.php?mode=editArticles'); 
?>

