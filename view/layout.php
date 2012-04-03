<?php
session_start(); 
require_once($fmConnect);
require_once($fmSql);
require_once($fcViewUser);
require_once($fAdminFonct);
require_once("articles.php");
date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="view/css/style.css" />
<script type="text/javascript" src="view/verification.js"></script>
<script type="text/javascript" src="view/calendrier.js"></script>
<script type="text/javascript" src="view/apercu_profil.js"></script>
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

</div><!-- content -->

</div><!-- all -->

</body>
</html>
