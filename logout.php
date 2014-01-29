<?php
/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/	
    include "functions.php";
		// Löschen aller Session-Variablen.
		$_SESSION = array();

		// Löscht das Session-Cookie.
		if (isset($_COOKIE[session_name()])) {
			setcookie(
				session_name(),  
				'',             
				time()-42000,  
				'/'           
			   );
		}
		header('location:index.html');
		session_destroy();
		
?>
