<!--/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/ -->
<!doctype html>
<html>
<head>
	<meta char="utf-8">
	<title>QPT</title>
	<link rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="kube/css/kube.css">
</head>
<?php
	include "functions.php";
	
	$title = $_POST["username"];
 
 
	$result= $dbh->prepare("SELECT * FROM users where username like '%$title%' ");
	
	$result->execute();
	
	$fetchresult = $result->fetchALL(PDO::FETCH_OBJ);
	
	foreach($fetchresult as $ergebnis){	?>
		
		<li> <a href="userprofil.php?id= <?php echo $ergebnis->id;?>"> <?php echo $ergebnis->username; ?>  </a> </li>
	
	<?php
	}  
	
	 
?>