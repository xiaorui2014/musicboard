<?php
/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
include "functions.php";
include "passwort_hash_salt.php";
include "salz.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$passwort = $_POST['password'];
	

	$abfrage = $dbh->prepare("SELECT id, email, passwort, salz, sichtbar FROM users WHERE email LIKE '$email' LIMIT 1");
	$abfrage->execute();
	$ergebnis = $abfrage->fetch(PDO::FETCH_OBJ);

	
	$id =$ergebnis->id;
	$pwsalz = $ergebnis->salz;

	$pwcheck = encrypt_char($passwort).$pwsalz;

	$sichtbar = $ergebnis->sichtbar;
	
		if($ergebnis->email == $email and $ergebnis->passwort == $pwcheck and $sichtbar == 1)
			{
			$_SESSION['id'] = $id;
			echo "Login erfolgreich. <a href=\"profil.php\"> weiter zum profil</a> ";

			} 
		else 
			{ 
			
			header("Location: index.html");
			exit;
			} 
		header('location: profil.php');
		
	
	
}

?>