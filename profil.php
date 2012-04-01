<?php
	session_start();
	include_once "connect.php";
	include_once "blagues.php";
?>
<h1><?php
	echo $_GET['id'];
	?>
</h1>
<?php
	$query = "select mail,date_naissance from log where login='".$_GET['id']."'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	echo "Mail: ".$row['mail']."</br>";
	affiche_anni($row['date_naissance'],$_GET['id']);
?>