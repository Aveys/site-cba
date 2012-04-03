<?php
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	
	mysql_connect('localhost','root','root') or die(mysql_error());
	mysql_select_db('iut') or die(mysql_error());
	mysql_query("set names 'UTF8'");
?>