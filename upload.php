<!doctype html>
<html>
<head>

<link rel="stylesheet" href="kube/css/kube.css">
<link rel="stylesheet" href="css/default.css">
</head>
<body>
<?php
	include "functions.php";
	
	
	if($_SESSION['username'] == 1){
	
		if($_FILES['file']['size'] > 0){
			if($_FILES['file']['size'] < 8000000){
				$info = GetImageSize($_FILES['file']['tmp_name']);
				if($info[2] != 0) {
					if($info[0] < 2000 && $info[1] < 2000) {
						//if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.$_FILES['file']['name'])){
						$ext = $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
						$filename = "datei.".$ext;
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.$filename)){
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.$filename)){
							print("<p>Der Upload war erfolgreich!</p>");
							print("<img src='$dir$filename' alt='$filename'>");
						}
						else { print("Fehler. Möglicherweise keine Schreibrechte."); }
					}
					else { print("Bitte laden Sie nur Bilder, die kleiner als 2000 x 2000 Pixel sind hoch!"); }
				}
				else { print("Bitte laden Sie nur Bilder vom Typ .gif .jpg oder .png hoch!"); }
			}
			else { print("Die Maximalgröße für Uploads liegt bei 8mb"); }
		}
		else { print("Keine Datei...."); }
		
 



}
else{
	header('location:index.html');
}
	
	
	
	
	include "navigation.php";
?>

</body>
</html>