<?php
require_once($fcArticle);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CBA Website</title>
<link rel="stylesheet" type="text/css" href="themes/cba/commun.css" />
<link rel="stylesheet" type="text/css" href="themes/cba/contact.css" />
	<script type="text/javascript" src="js/verification.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

	<script type="text/javascript" src="js/apercu_profil.js"></script>
	<script type="text/javascript" src="js/apercu_equipe.js"></script>
	<script src="js/mootools.js" type="text/javascript"></script>
	<script src="js/moocheck.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	 <!-- Mailchek : permet de vérifier si le nom de domaine de l'email est valide -->
	<script type="text/javascript" src="js/jquery.mailcheck.min.js"></script>
	 <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	  {lang: 'fr'}
	</script>
</head>
<body>		
	<div id="all">
		<div id="wrapper">
			<!--On include le header general-->
			<?php require_once("view/header.php");?>

</head>
<body>
			<div id="central">
            	<div id="formulaire">
				 <form id="inscription_form" action="<?php echo $fcAction; ?>" method="post" onSubmit="return validCompte(this)">
                        <!-- pseudo -->
                           <p> <label for="pseudo">Pseudo :</label></p>
                            <p><input name="pseudo" onBlur="verifPseudo(this)"/></p>
                        <!-- login -->
                            <p><label for="mdp">Mot de passe :</label></p>
                            <p><input type="password" name="mdp" onBlur="verifMdp(this)"/></p>
                        <!-- mail -->
                            <p><label for="email">E-mail </label></p>
                            <p><input type="text" name="mail" class="email mailcheck" value='' onBlur="verifMail(this)"/></p>
                        <p><span class="help-inline"></span></p>
                        <!-- date de naissance -->
                        <!--
                        <label for="naissance">Date de naissance :</label>
                        <input type="text" name="naissance" id="" class="calendrier" size="8" /><br/><br/>
                        -->
                        <!-- submit -->
                        <p><input type="submit" name="action" value="inscrire"/></p>
                    </form>
                   </div>
				</div><!-- central -->
			</div><!-- wrapper -->

			<!--On include le footer general-->
			<?php include_once("view/footer.php");?>
			

		</div><!-- All -->


</body>
</html>