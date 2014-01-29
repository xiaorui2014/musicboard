<!--/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/ -->
	
<?php
	include "functions.php";
	
		$id=mysql_escape_String($_POST['id']);
	
		//$ratingquery = $dbh->query( "SELECT * FROM musik WHERE id = $id");
		//$rating = $ratingquery->fetch(PDO::FETCH_OBJ);
		
		//$ratingup = $rating->rating;
		//$ratingupdate = $ratingup + 1;
		
		$update = $dbh->prepare("UPDATE musik SET rating = rating +1 WHERE id = ?");
		$update->execute(array( $id));
	
	
?>

	
