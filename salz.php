<!--/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/ -->
<?php
	
function salz($passwort) { 

        $salz = rand(5, 255);
        $randomsalz = uniqid($salz);

   

    return $randomsalz; 


}

?>