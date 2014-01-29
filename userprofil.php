<!doctype html>
<html>
<head>
	<title>QPT</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="kube/css/kube.css">
    <link rel="stylesheet" href="css/default.css">
		
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="raphael.js"></script>

	<!-- Musik -->
	<script type="text/javascript" src="js/musikplayer.js"></script>
	<script type="text/javascript" src="js/soundmanager/soundmanager2.js"></script>

	<!-- soundmanager wird aufgerufen -->
	<script type="text/javascript">

	soundManager.setup({
	  //Pfad zu swf ordner
	  url: 'js/soundmanager/swf/'
	});

	</script>
	

	<!-- Noten -->
	<script type="text/javascript" src="./js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="./js/zip.js/arraybuffer.js"></script>    
	<script type="text/javascript" src="./js/zip.js/dataview.js"></script>
	<script type="text/javascript" src="./js/zip.js/deflate.js"></script>
	<script type="text/javascript" src="./js/zip.js/inflate.js"></script>
	<script type="text/javascript" src="./js/zip.js/zip.js"></script>
	<script type="text/javascript" src="./scorediv-pv0.0.3.js"></script>
	
	
	<script>
		$(document).ready(function(){
			$(".noten").hide();
			$(".shownoten").click(function(){
				$(this).next(".noten").slideToggle('slow');
			});
		});
	</script>
	
	
		
	<!-- show current song -->
	<script>
		$(document).ready(function(){
			$(".current").hide();
			$(".btnsplay").click(function(){
				//$(this).next(".current").css('background-color', 'red');
				$(this).next(".current").toggle('slow');
			});
				
		});
	</script>
	
	<!-- update rockon -->
<script type="text/javascript">
	$(document).ready(function() {

		$(".rockon").click(function() {

		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var data = 'id='+ id ;
		var parent = $(this);
		
		$.ajax({
		   type: "POST",
		   url: "rockonrating.php",
		   data: data,
		   cache: false,

		   success: function() {
			parent.html('dir und '+ name + ' andere gefällt das');
			alert ("Der Song rockt!");
		  
		  }  
		  });
		  
		return false;
		});

	});
</script>

</head>
<body>

<?php
	// include "functions.php";
	include "rockonrating.php";
	
	if(isset($_SESSION['id'])){
	
	$userid = $_GET['id'];
	$userquery = $dbh->prepare( "SELECT * FROM users WHERE id = $userid ");
	$userquery->execute();
	$user = $userquery->fetch(PDO::FETCH_OBJ);
	
	$musikquery = $dbh->prepare( "SELECT * FROM user_musik um JOIN musik m ON um.musik_id = m.id WHERE user_id = $userid");
	$musikquery->execute();
	$musik = $musikquery->fetchAll(PDO::FETCH_OBJ);
	

	$rowquery = $dbh->prepare("SELECT musik_id FROM user_musik WHERE user_id = $userid");
	$rowquery->execute();
	

	$num_rows = $rowquery->rowCount();
	if ( $num_rows < 1) { 
		echo ('<h4 style="color: #fff; padding: 3%; background-color: #881100;"> keine Songs hochgeladen </h4> ');

	}
	// if ($num_rows > 0) {

/*
	$vollstaendig = false;
	$mid = "";
	$rockon = "";

	if(array_key_exists("rockon", $_POST)){
		
		if(trim($_POST['rockon']) == "") $vollstaendig = false;
		else $rockon = htmlspecialchars(trim($_POST['rockon']));
		
		$rockupdate = $rockon + 1;
		
		if(trim($_POST['mid']) == "") $vollstaendig = false;
		else $mid = htmlspecialchars(trim($_POST['mid']));
		
		$deletemusik = $dbh->prepare("UPDATE musik SET rating = ? WHERE id = ?");
		$deletemusik->execute(array($rockupdate, $mid));
		
		header('location: userprofil.php?id=');
	} */
	?>
	<img src="images/logo.png" alt="logo" class="logo-profil">
	<div class="content">
	
		
		<div class="bg">
			<h2 style="padding: 3%; color: #fff;"> <?php echo $user->username; ?></h2>
	
			<div class="div">
				<img src=" <?php echo $user->profilbild; ?> ">
			</div>
			<div class="beschr">
				<p> <?php echo $user->beschreibung; ?> </p>
			</div>
		</div>
		
		<div id="player">
		<img src="images/player2.png" class="playerLP">
		<div id="holder"> 
			<img id="platte" src="images/lp.png" width="200" alt="pattern">
		</div>
		</div>
		
		<div class="bgmusikuser">
		<?php
		$index = 0;
		
		foreach($musik as $index => $value){?>
			<div class="allesmusikuser">
				<div class="listemusikuser">
					<li>
						
						<h4> <a href="#" class="play" onclick="soundManager.play('mySound<?php echo $musik[$index]->musik_id; ?>','<?php echo $musik[$index]->musiklink; ?>');" > <?php echo $musik[$index]->titel; ?> </a> </h4>
													
						
						
						<div class="btnsplay" style="margin-top: 5%;">
						<!-- Buttons to Play Pause and Stop -->
							<input type="image" value="" src="images/btnplay.png" class="btnplay play" onclick="soundManager.play('mySound<?php echo $musik[$index]->musik_id; ?>','<?php echo $musik[$index]->musiklink; ?>'); ">
							<input type="image" value="" src="images/btnpause.png" class="btnpause pause" onclick="soundManager.pause('mySound<?php echo $musik[$index]->musik_id; ?>');">
							<input type="image" value="" src="images/btnstop.png" class="btnpause pause" onclick="soundManager.unload('mySound<?php echo $musik[$index]->musik_id; ?>');">
						<!-- /end of Buttons -->
						</div>
						<div class="current"><p style="color: #fff;"> zur zeit läuft: <strong><?php echo $musik[$index]->titel; ?></strong></p></div>
						<?php 
						$ratingquery = $dbh->prepare( "SELECT rating FROM musik WHERE id = $value->musik_id");
						$ratingquery->execute();
						$rating = $ratingquery->fetch(PDO::FETCH_OBJ);
						$ratingup = $rating-> rating +1;
						?>
							
						<!-- rock on rating -->
						<div class="rockon"  id="<?php echo $musik[$index]->musik_id; ?>" name="<?php echo $ratingup; ?>" style="color: #fff;">
							<input type="image" value="" src="images/btnrock.png" style="width: 30px; margin-top: -50%;" class="btnrock"  name="<?php echo $ratingup; ?>">
							<p class="like_show" > rock on: <span class="showrockon"><?php echo $rating->rating; ?></span> </p>
						
							
							<!--<input type="text" name="mid" value="<?php //echo $musik[$index]->musik_id; ?>" hidden>-->

						</div>
						<button class="btn btn-round shownoten"> zu den Noten </button>
						<div class="noten">
							<form method="post" action="musik.php" enctype="multipart/form-data">
								<input type="text" name="musikid" value="<?php echo $musik[$index]->musik_id; ?>" hidden> 
								<input type="file" name="xmlupload" value="upload xml" class="btn btn-small" >
								<input type="submit" value="upload" class="btn btn-append">
							</form>
							
							
							<script type="text/javascript">zip.workerScriptsPath='../js/zip.js/';</script>
							<div class="score-div" style="position: relative; width: 700px; height: 500px; margin-bottom: 10px;" musicxml_ref="<?php echo $value->notenlink; ?>"></div>
						</div>
					</li>
				</div>
							
				
				
			</div>
		<?php
		}
		?>
		</div>
	</div>
	<?php
	
	}
	else{
		header('location:index.html');
	}
	
	include "navigation.php";
?>
</body>
</html>