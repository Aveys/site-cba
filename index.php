<?php
session_start(); 
include_once "connect.php";
include_once "articles.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
</head>
<body>

<div id="all">

<div id="header">
<?php
displayAddFormLog();
?>
<h1>CBA Website</h1>
</div>
<div id="content">

<div id="articles">
<h2>Tous les articles</h2>
<?php 
displayArticles();
?>
</div>


<div id="addblague">
<h2>Ajouter un article</h2>
<?php 
displayAddForm();
?>
</div>

<div id="deleteblague">
<h2>Supprimer un article</h2>
<?php 
displayDeleteForm();
?>
</div>

</div><!-- content -->

</div><!-- all -->

</body>
</html>
