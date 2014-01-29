<!--/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/ -->
<?php
	include "functions.php";
	include "passwort_hash_salt.php";
	include "salz.php";

	$bandname = "";
	$email = "";
	$passwort = "";
	$passwortcheck = "";

	$vollsaendig = false;
	$profilbild = "images/default.png";
	$beschreibung = "Schreib etwas über dich";	
	
	if(array_key_exists("email", $_POST)){
	
		if(trim($_POST['bandname']) == "") $vollstaendig = false;
		else $bandname = htmlspecialchars(trim($_POST['bandname']));
	
		if(trim($_POST['email']) == "") $vollstaendig = false;
		else $email = htmlspecialchars(trim($_POST['email']));
		
		if(trim($_POST['password']) == "") $vollstaendig = false;
		else $passwort = htmlspecialchars(trim($_POST['password']));
		
		if(trim($_POST['sichtbar']) == "") $vollstaendig = false;
		else $sichtbar = htmlspecialchars(trim($_POST['sichtbar']));
		
	}
		
	else{
		$vollstaendig = false;
	}
	
	$salz = salz($passwort);
	
	//Passwort hashen und salzen
	$encrypt_data = encrypt_char($passwort).$salz;
     	
	
	// in die DB schreiben
	if($vollstaendig = true){
		
		$regis = $dbh->prepare("INSERT INTO users (username, beschreibung,  email, passwort, sichtbar, salz, profilbild) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$regis->execute(array($bandname, $beschreibung, $email, $encrypt_data, $sichtbar, $salz, $profilbild));
		
		header('location:index.html');
	}
		
		
	
	
	
?>