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
			$(".editbox").hide();			
		});
		
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".edit_tr").click(function() {
				var ID=$(this).attr('id');
				$("#label_"+ID).hide();
				$("#pen_"+ID).hide();
				$("#input_"+ID).show();
			}).change(function() {
			var ID = $(this).attr('id');
				var IID = document.getElementById("iid").value;
				var data=$("#input_"+ID).val();
				var dataString = 'id='  + IID /*+ '&field=' + ID */+ '&value=' + data;
			 
				$.ajax({
					type: "POST",
					url: "updatedescription.php",
					data: dataString,
					cache: false,
					success: function(html) {
						$("#label_text").html(data);
						document.getElementById("pen_"+ID).src="images/edit.png";
						document.getElementById("pen_"+ID).width="23";
					},
					error: function(data) {
						alert("Es ist ein Fehler aufgetreten!");
					}
				});
			});
		 
			// Klick innerhalb des Labels
			$(".editbox").mouseup(function() {
				return false
			});
			// Klick auserhalb des Inputfeldes
			$(document).mouseup(function() {
				$(".editbox").hide();
				$(".text").show();
				$(".pen").show();
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
		$query = $dbh->prepare( "SELECT * FROM users WHERE id = $myname" );
		$query->execute();
		$mn = $query->fetch(PDO::FETCH_OBJ);
		
?>

		<div class="profilbg">
			<h2 style="padding: 3%; color: #fff;"> Hallo <?php echo $mn->username; ?></h2>
			
			<div class="profildiv">
				<img src=" <?php echo $mn->profilbild; ?> ">
			</div>
				
			<div class="edit_tab beschreibung" id="edit_tab">

				<input type="hidden" value="<?php echo $myname ?>" id="iid" name="id"/>
				 
				<!--Zeile für Text-->
				<div class="edit_tr odd" id="text">
				<div>
					<p><span id="label_text" class="text"><?php echo $mn->beschreibung; ?></span></p>
				   
					<p><input type="text" value="<?php echo $mn->beschreibung; ?>" class="editbox" id="input_text" name="description"/></p>
					   
					
				</div>
				<div class="edit_pen">
				   <img src="images/edit.png" class="pen" id="pen_text" />
				</div>
				</div>
				

			</div>

			
			
			
			
			
			
			
		</div>

		
		
		
			
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