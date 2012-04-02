<?php
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("semaine_spe") or die(mysql_error());
	mysql_query("set names 'UTF8'");
?>