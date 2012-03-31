<?php
	session_start();
	if(isset($_SESSION["erreur_inscrip"]))
		echo $_SESSION["erreur_inscrip"]."</br>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Blagues carambar</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="verification.js"></script>
<script type="text/javascript" src="calendrier.js"></script>
</head>
<form name="inscription_form" action="../controller/actions.php" method="post" onSubmit="return validLogin(this)">

	<!-- pseudo -->
	<label for="pseudo">Pseudo :</label>
	<input name="pseudo" onBlur="verifPseudo(this)"/><br/><br/>

	<!-- login -->
	<label for="mdp">Mot de passe :</label>
	<input type="password" name="mdp" onBlur="verifMdp(this)"/><br/><br/>

	<!-- mail -->
	<label for="mail">Mail :</label>
	<input name="mail"/><br/><br/>

	<!-- date de naissance -->
	<label for="naissance">Date de naissance :</label>
	<input type="text" name="naissance" id="" class="calendrier" size="8" /><br/><br/>

	<!-- submit -->
	<input type="submit" name="action" value="Sinscrire"/>

</form>