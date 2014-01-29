<!--/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/ -->
<?php


function encrypt_char($passwort) { 
		
		// sha 1 hash vom Passwort
		$hash = sha1($passwort);
		 
		return $hash; 

}


?>