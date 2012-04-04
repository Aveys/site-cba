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
	<link rel="stylesheet" type="text/css" href="themes/cba/layout.css" />
	<script type="text/javascript" src="js/verification.js"></script>
	<script type="text/javascript" src="js/calendrier.js"></script>
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
					//displayAddFormLog($fcAction);
					form_search();
					?>
				</div>
					<div id="articles">
						<?php 
						if(!isset($_GET['recherche']))
							displayArticles($fcAction);
						else
							search($_GET["recherche"]);
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
