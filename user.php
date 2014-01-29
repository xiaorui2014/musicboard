<!doctype html>
<html>
<head>
	<title>QPT</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="kube/css/kube.css">
    <link rel="stylesheet" href="css/default.css">
		
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

	
	

	
</head>
<body>

<img src="images/logo.png" alt="logo" class="logo-profil">
<div class="content">

<?php
	include "functions.php";
	
	if (isset($_SESSION['id'])) {
	
		$id = $_SESSION['id'];
		$userquery = $dbh->prepare( "SELECT * FROM users WHERE sichtbar = 1");
		$userquery->execute();
		$user = $userquery->fetchALL(PDO::FETCH_OBJ);
	
?>
<div class="content" style="margin-bottom: 20%;">
	
	<?php 
		foreach($user as $u){
		$bild = $u->profilbild;?>
		<div class="user nav-v">
			<ul>
				
				<li><img src="<?php echo $u->profilbild;?>" class="userbild"></li>
				<li><h3><?php echo $u->username ?> </h3></li>
				<li><a href="userprofil.php?id=<?php echo $u->id?>"> zum Profil</a></li>
			</ul>
		</div>
	<?php
	}
	?>

	
<?php
	}
	else{
		header('location:index.html');
	}

	include "navigation.php";
?>
</div>
</body>
</html>