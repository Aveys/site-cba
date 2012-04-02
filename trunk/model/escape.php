<?php
	function escape($data)
	{
		return mysql_real_escape_string(htmlspecialchars($data));
	}