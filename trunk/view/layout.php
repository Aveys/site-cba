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
			<div id="header">
				<div id="header-bg">
				<div id="header-txt">
					<div id="logo"></div>
					<div id="title">
						<h1>
							<?php echo $Title ?>
						</h1>
					</div>
					<div id="menuBar">
						<img src="themes/cba/images/sep_menu_top.png" />
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
						<a class="itemMenuBar" id="port" href=<?php echo $Site."port/" ?>>Portfolio</a>
						<a class="itemMenuBar" id="contact" href=<?php echo $Site."contact/" ?>>Contact</a>
						<img src="themes/cba/images/sep_menu_bottom.png" />
					</div>

				</div>
				</div>
			</div>

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
			<div id="footer">
				<div id="powered">Designed by <span class="nom">CBA Studio</span> | Powered By <span class="nom">Stul</span></div>
			</div>

		</div><!-- Wrapper -->
	</div> <!-- header-bg -->

</div><!-- all -->

</body>
</html>
