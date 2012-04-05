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
	<link rel="stylesheet" type="text/css" href="themes/cba/equipe.css" />
	<script type="text/javascript" src="js/verification.js"></script>
	<script type="text/javascript" src="js/apercu_profil.js"></script>
	<script type="text/javascript" src="js/apercu_equipe.js"></script>
	<script src="js/mootools.js" type="text/javascript"></script>
	<script src="js/moocheck.js" type="text/javascript"></script>
</head>
<body>		
	<div id="all">
		<div id="wrapper">
			<!--On include le header general-->
			<?php include_once("header.php");?>

			<div id="central">
				<div id="content">
					<?php
						echo "<h1>";
						switch ($_GET['id']) {
							case 1:
								echo "Arthur Veys";
								break;
							case 2:
								echo "Mathieu Martin";
								break;
							case 3:
								echo "Nathanaël Couret";
								break;
							case 4:
								echo "Natacha Laborde";
								break;
							case 5:
								echo "Thomas Rovayaz";
								break;
							default:
								echo "Membre inconnu";
								break;
						}
						echo "</h1></br>";
					?>
				</div>
					<div id="articles">
						<?php 
							echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
						?>
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
