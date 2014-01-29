<?php
include "functions.php";
	
if(isset($_SESSION['id'])){
	$myname = $_SESSION['id'];

	$beschreibung = "";
	$vollstaendig = false;
	$value=mysql_escape_String($_POST['value']);
	
	
								
			$update = $dbh->prepare("UPDATE users SET beschreibung=? WHERE id = ?");
			$update->execute(array($value, $myname));	
}
?>