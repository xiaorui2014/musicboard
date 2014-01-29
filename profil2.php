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
	<title>QPT</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="kube/css/kube.css">
    <link rel="stylesheet" href="css/default.css">
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script> 
		$(document).ready(function(){
			$("#edit").hide();
			$("#showedit").click(function(){
				$("#edit").slideToggle('slow');
			});
		});
	</script>
	
	
	
	
</head>
<body>


<img src="images/logo.png" alt="logo" class="logo-profil">
<div class="content">
<?php
	include "functions.php";
	
	if(isset($_SESSION['id'])){
		$myname = $_SESSION['id'];
		$query = $dbh->query ( "SELECT * FROM users WHERE id = $myname" );
		$mn = $query->fetch(PDO::FETCH_OBJ);
		
			
		
		?>
		<div class="profilbg">
			<h2 style="padding: 3%; color: #fff;"> Hallo <?php echo $mn->username; ?></h2>
			
			
			<div id="edit">
				<form method="post" action="profil.php" enctype="multipart/form-data">
					<input type="text" placeholder="beschreibe dich oder die Band" name="beschreibung">
					<input type="submit" class="btn" value="fertig">
				</form>
			</div>
			<input type="button" value="bearbeiten" class="btn btn-round" id="showedit" style="margin-left: 80%; margin-top: -40%;">
			
			
			
			<div class="profildiv">
				<img src=" <?php echo $mn->profilbild; ?> ">
			</div>
			<div class="beschreibung">
				<p> <?php echo $mn->beschreibung; ?> </p>
			</div>
		</div>
		<?php
		
			$beschreibung = "";
			$vollstaendig = false;
			if(array_key_exists("beschreibung", $_POST)){
				if(trim($_POST['beschreibung']) == "") $vollstaendig = false;
				else $beschreibung = htmlspecialchars(trim($_POST['beschreibung']));
				
				if ($vollstaendig=true ) {
										
					$update = $dbh->prepare("UPDATE users SET beschreibung=? WHERE id = ?");
					$update->execute(array($beschreibung, $myname));	
																		
					
				}
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