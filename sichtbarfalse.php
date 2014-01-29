<?php
/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
	include "functions.php";
	
	if (isset($_SESSION['id'])) {

$myname = $_SESSION['id'];
$sichtbar = "";
$vollstaendig = false;
if(array_key_exists("sichtbar", $_POST)){
	if(trim($_POST['sichtbar']) == "") $vollstaendig = false;
	else $sichtbar = htmlspecialchars(trim($_POST['sichtbar']));
	
	if ($vollstaendig=true ) {
							
		$update = $dbh->prepare("UPDATE users SET sichtbar=? WHERE id = ?");
		$update->execute(array($sichtbar, $myname));	
															
		
	}
}
}
				
?>