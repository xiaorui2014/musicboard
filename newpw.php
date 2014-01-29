<?php
include "functions.php";
include "passwort_hash_salt.php";
include "salz.php";


	$email = $_POST['email'];
	
	$email = mysql_escape_String($_POST['email']);
	
	function randomstring($length = 6) {
		$pass ="";
		// $chars - String aller erlaubten Zahlen
		$chars = "!#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		// Funktionsstart
		srand((double)microtime()*1000000);
		$i = 0; // Counter auf null
		while ($i < $length) { // Schleife solange $i kleiner $length
		// Holen eines zufälligen Zeichens
		$num = rand() % strlen($chars);
		// Ausf&uuml;hren von substr zum wählen eines Zeichens
		$tmp = substr($chars, $num, 1);
		// Anhängen des Zeichens
		$pass = $pass . $tmp;
		// $i++ um den Counter um eins zu erhöhen
		$i++;
	  }
	  // Schleife wird beendet und 
	  // $pass (Zufallsstring) zurück gegeben
	  return $pass;
	}
	
	$passwort = randomstring(6);
	
	$salz = salz($passwort);

	//Passwort hashen und salzen
	 $encrypt_data = encrypt_char($passwort).$salz;

	// Ausgabe des Generatos Gibt eine 6 wertige Zeichenkette zurück
	echo "Und das neue Passwort lautet:  $passwort";
	mail("$email","Dein neues Passwort für Musikboard lautet:","$passwort");
	
	
     
	// in DB

	$new= $dbh->prepare("UPDATE users SET passwort = ? , salz = ? WHERE email = ?");
	$new->execute(array($encrypt_data, $salz, $email));
	
	

?>