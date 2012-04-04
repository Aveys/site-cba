<?php
	require_once($a_fcUserView);
	require_once($a_fcArticle);
	require_once($a_fAdminFonct);
	require_once($a_fmSql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<h1>
	<?php
		if(isset($_GET['id']) && idUser_exist($_GET['id']))
			echo sql_user_of_id($_GET['id']);
		else
			echo '<script language="Javascript">document.location.replace(".");</script>';
	?>
</h1>
<?php
	if(isset($_GET['editer']) && $_GET['editer'] == 1)
		editer_info_user($_GET['id']);
	else
		afficher_info_user($_GET['id']);
	function autorise_edition($id)
	{
		if(isset($_SESSION['id']) && (isadmin($_SESSION['id']) || $id == $_SESSION['id']))
			return true;
		else
			return false;
	}
?>