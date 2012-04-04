<?php
require_once($fmConnect);
require_once($fmSql);
require_once($fcUserView);
require_once($fAdminFonct);
require_once($fcArticle);
require_once($fcSearch);
date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
<script type="text/javascript" src="apercu_profil.js"></script>
<script type="text/javascript" src="view/apercu_equipe.js"></script>
</head>
<body>
	<div id="connexion">
	<?php
	displayAddFormLog($fcAction);
	?>
	</div>

<div id="all">

<div id="header">
</br>
<h1>CBA Website</h1>
</div>
<div id="content">
<div id="menuBar">
	<a class="itemMenuBar" id="blog" href=<?php echo $Site ?>>Blog</a>
	<a class="itemMenuBar" id="tutoriel" href=<?php echo $Site."tuto/" ?>>Tutoriel</a>
	<span class="itemMenuBar" id="equipe" onMouseOver='survole_equipe_apercu(this,event)' onMouseOut='quitte_equipe_apercu(this)'>Equipe
		<span id="equipeListe">
			<span class="teamName"><a href=<?php echo $Site."team.php?id=1" ?>>Arthur Veys</a></span></br>
			<span class="teamName"><a href=<?php echo $Site."team.php?id=2" ?>>Mathieu Martin</a></span></br>
			<span class="teamName"><a href=<?php echo $Site."team.php?id=3" ?>>Nathanaël Couret</a></span></br>
			<span class="teamName"><a href=<?php echo $Site."team.php?id=4" ?>>Natacha Laborde</a></span></br>
			<span class="teamName"><a href=<?php echo $Site."team.php?id=5" ?>>Thomas Rovayaz</a></span></br>
		</span>
	</span>
	<a class="itemMenuBar" id="contact" href=<?php echo $Site."contact/" ?>>Contact</a>
</div>
<?php
	form_search();
?>
<div id="articles">
<h2>Tous les articles</h2>
<?php 
print_r($_GET);
if(!isset($_GET['recherche']))
	displayArticles($fcAction);
else
	search($_GET["recherche"]);
?>
</div>

<?php
//echo "<div id='addArticle'><h2>Ajouter un article</h2>".displayAddForm($fcAction)."</div>"; 
?>

</div><!-- content -->

</div><!-- all -->

</body>
</html>
