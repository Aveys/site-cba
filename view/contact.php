<?php
require_once($fmConnect);
require_once($fmSql);
require_once($fcUserView);
require_once($fAdminFonct);
require_once($fcArticle);
require_once($fcSearch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CBA Website</title>
	<link rel="stylesheet" type="text/css" href="themes/cba/commun.css" />
	<link rel="stylesheet" type="text/css" href="themes/cba/contact.css" />
	<script type="text/javascript" src="js/verification.js"></script>
	<script type="text/javascript" src="js/calendrier.js"></script>
	<script type="text/javascript" src="js/apercu_profil.js"></script>
	<script type="text/javascript" src="js/apercu_equipe.js"></script>
</head>
<body>		
	<div id="all">
		<div id="wrapper">
			<!--On include le header general-->
			<?php include_once("header.php");?>

			<div id="central">
				<div id="content">
					<!--Message erreur ou d'envoie de SESSSION-->
					<?php 
					if(isset($_SESSION["mail_message_ok"]))
					{			
						echo "<div class='notif success'>";
					   		echo $_SESSION["mail_message_ok"];
						echo "</div>";
						unset($_SESSION["mail_message_ok"]);
					}
					if(isset($_SESSION["mail_message_error"]))
					{			
						echo "<div class='notif error'>";
					    	echo $_SESSION["mail_message_error"];
						echo "</div>";
						unset($_SESSION["mail_message_error"]);
					}
					?>

				<div id="formulaire">					
					<h2>Nous contacter</h2>
						<form action="model/envoi.php" method="post" name="formulaire">
						
						<p>
							<label for='nom'>Votre nom </label><br/>
							<input type='text' name='nom' size='30' maxlength='100'/>
						</p>
						<p>
							<label for='mail'>Votre mail </label><br/>
							<input type='text' name='mail' size='30' maxlength='100'/>
						</p>
						<p>
							<label for='sujet'>Sujet du message </label><br/>
							<input type='text' name='sujet' size='30' maxlength='100'/>
						</p>
						<p>
							<label for='message'>Votre message </label>
							<textarea name="message" cols="50" rows="10"></textarea>
						</p>	
						<p>
							<input name="envoyer" value="Envoyer le message" type="submit"/>
						</p>
						</form>
					
				</div>
				</div><!-- content -->
			</div><!-- central -->

			<!--On include le footer general-->
			<?php include_once("footer.php");?>
			

		</div><!-- Wrapper -->
	</div> <!-- header-bg -->

</div><!-- all -->

</body>
</html>
