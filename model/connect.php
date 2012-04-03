<?php
	error_reporting(E_ALL | E_STRICT );
	ini_set('display_errors', true);
	
	
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());
	mysql_query("set names 'UTF8'");
?>