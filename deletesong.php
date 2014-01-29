<?php
include "functions.php";
	
if(isset($_SESSION['id'])){
	$myname = $_SESSION['id'];

	$deleteid = "";
	$vollstaendig = false;
	$id=mysql_escape_String($_POST['id']);
	
	
								
			$deletemusik = $dbh->prepare("DELETE FROM musik WHERE id = ?");
			$deletemusik->execute(array($id));
}

?>