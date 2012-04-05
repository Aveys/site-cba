<?php
	if(isset($_SESSION["erreur_inscrip"]))
		echo $_SESSION["erreur_inscrip"]."</br>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dp">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/verification.js"></script>
<script type="text/javascript" src="js/calendrier.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.mailcheck.min.js"></script>

</head>
<body>
<form id="inscription_form" action="<?php echo $fcAction; ?>" method="post" onSubmit="return validLogin(this)">
	<!-- pseudo -->
       <p> <label for="pseudo">Pseudo :</label></p>
        <p><input name="pseudo" onBlur="verifPseudo(this)" id="pseudo" /></p>
	<!-- login -->
		<p><label for="mdp">Mot de passe :</label></p>
		<p><input type="password" name="mdp" onBlur="verifMdp(this)" id="mdp" /></p>
	<!-- mail -->
    	<p><label for="email">E-mail </label></p>
    	<p><input type="text" name="mail" class="email mailcheck" value='' id="email" /></p>
	<p><span class="help-inline"></span></p>
	<!-- date de naissance -->
	<!--
	<label for="naissance">Date de naissance :</label>
	<input type="text" name="naissance" id="" class="calendrier" size="8" /><br/><br/>
	-->
	<!-- submit -->
	<p><input type="submit" name="action" value="inscrire"/></p>
</form>
</body>
</html>