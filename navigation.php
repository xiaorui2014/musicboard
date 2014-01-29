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
	
	<script type="text/javascript" src="kube/js/kube.buttons.js"></script>
	<script type="text/javascript" src="kube/js/kube.tabs.js"></script>
	<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>-->
	<script type="text/javascript" src="js/search.js"></script>
	

	<script>
		$(document).ready(function(){
			$(".showsetting").hide();
			$(".setting").click(function(){
				$(".showsetting").toggle('slow');
			});
		});
		
	</script>
		
	
<head>
<body>
<?php

			
	
?>	



	
	<div class="nav-h" style="position: fixed; bottom: 0; left: 0;   background-color: #000;">
		<form method="post" action="navigation.php">
		<div class="showsetting"> <input type="text" name="sichtbar" value="2" hidden><input type="submit" value="delete account" class="btn btn-round"></div>
		</form>
		<ul>
			<li class="navborder"><a href="profil.php">Profil</a></li>
			<li class="navborder"><a href="musik.php">Musik</a></li>
			<li class="navborder"><a href="user.php">stöbern</a></li>
			<li class="navborder"><a href="uploadfile.php">Upload</a></li>
			
		  
			<li style="margin-top: -0.5%; margin-left: 0%; padding-left: 15%; width: 300px">
			<input type="text" name="searchBox" id="search" class="input-search" placeholder="Bands suchen (press enter)" style="height: 26px; width:200px;" />
			<!-- <input type="button" value="Go" id="button" class="btn btn-append" style="height:30px;"> -->
			</li>
		<div class="result"><li id="result"></li></div>
		
	
	<?php
			if (isset($_SESSION['id'])) {
			
				$myname = $_SESSION['id'];
				$sichtbar = "";
				$vollstaendig = false;
				if(array_key_exists("sichtbar", $_POST)){
					if(trim($_POST['sichtbar']) == "") $vollstaendig = false;
					else $sichtbar = htmlspecialchars(trim($_POST['beschreibung']));
					
					if ($vollstaendig=true ) {
											
						$update = $dbh->prepare("UPDATE users SET beschreibung=? WHERE id = ?");
						$update->execute(array($beschreibung, $myname));	
																			
						
					}
				}
			
				echo 
					'<li class="log">
						<form method="post" action="logout.php">
							<input type="submit" value="Logout"  class="button"></input>
						</form>
					</li>';
			} else{
				//header('location:index.html');
				echo 
					'<li class="log">
						<form method="post" action="index.html">
							<input type="submit" value="Login" class="btn btn-round"></input>
						</form>
					</li>';
			}
		  ?>
			
			<li> <a href="#"> <img src="images/btnsetting.png" class="setting"> </a> </li>
			

		  
		</ul>
	
	</div>
	
</body>
<html>