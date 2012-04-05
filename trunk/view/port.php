<?php
	session_start();
	require_once("../stul_config.php");
	require_once($a_fcArticle);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="../themes/cba/commun.css" />
<link rel="stylesheet" type="text/css" href="../themes/cba/layout.css" />
<script type="text/javascript" src="../js/verification.js"></script>
	<script type="text/javascript" src="../js/calendrier.js"></script>
	<script type="text/javascript" src="../js/apercu_profil.js"></script>
	<script type="text/javascript" src="../js/apercu_equipe.js"></script>
	<script src="../js/mootools.js" type="text/javascript"></script>
	<script src="../js/moocheck.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	  {lang: 'fr'}
	</script>
    <style>
	.para {
		margin : 5px;
		text-align : center;
	}
</style>
</head>

<body>
	<?php require_once($a_fvHeader); ?>
	<p class="para">Cette page n'existe pas!</p>
    <p class="para">Redirection vers la page d'accueil dans 5 secondes!</p>
    <script type="text/javascript">
		setTimeout('document.location.href="../."', 5000);
	</script>
    <?php require_once($a_fvFooter); ?>
</body>
</html>