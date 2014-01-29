<?php include "functions.php"; 
	if (isset($_SESSION['id'])) {
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8" />
	<title>QPT</title>
	
	<link rel="stylesheet" href="kube/css/kube.css">
    <link rel="stylesheet" href="css/default.css">
	
	<!-- Libraries -->
	<script src="js/jquery/jquery.min.js"></script>
	<script src="js/upload/jquery.knob.js"></script>

	<!-- jQuery -->
	<script src="js/upload/jquery.ui.widget.js"></script>
	<script src="js/upload/jquery.iframe-transport.js"></script>
	<script src="js/upload/jquery.fileupload.js"></script>

	<!-- meine upload js -->
	<script>
		$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
       // öffnet orderverzeichnis wenn click
        $(this).parent().find('input').click();
    });

    
    $('#upload').fileupload({

        // Element bekommt hochzuladene Dateien
        dropZone: $('#drop'),
			

       // Dateien kommen in die Upload-Schlange
        add: function (e, data) {
			
		if (data.files[0].size < 8388608){

            var ladebalken = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#66CC66" data-angleOffset=-125 data-linecap=round data-displayPrevious=true data-readOnly="1"/><p></p><span></span></li>');

            // fügt Namen und Größe hinzu
            ladebalken.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
			
            // Datei zu <ul> 
            data.context = ladebalken.appendTo(ul);

            // knob plugin
            ladebalken.find('input').knob();

            // cancel
            ladebalken.find('span').click(function(){

                if(ladebalken.hasClass('working')){
                    jqXHR.abort();
                }

                ladebalken.fadeOut(function(){
                    ladebalken.remove();
                });

            });

            
            var jqXHR = data.submit();
		}
		else { alert ("Datei ist zu groß"); };
        },

        progress: function(e, data){

            // zeigt die Prozent des uploads
            var progress = parseInt(data.loaded / data.total * 100, 10);

            
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // wenn fehler
            data.context.addClass('error');
        }

    });


    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // rechnet Größe um
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

       
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});

</script>
		
</head>

<body>

<?php
	
	


		if(!is_dir('upload')) {
			if(mkdir('upload')) {
				exit;
			}
		}		
		
		if (isset($_FILES['userfile'])) {
			if($_FILES['userfile']['size'] > 0){
				if($_FILES['userfile']['size'] < 8388608){
					
					$uploadDir = realpath('upload') . "/";
					$file = $_FILES['userfile'];
					$extensiones = array('jpg', 'jpeg', 'png', 'mp3', 'xml');
					
					
					//Endung der Datei
					$file_ext = explode('.', $file['name']);
					$file_ext = end($file_ext);
					//Endung von Grossbuchstaben zu Kleinbuchstaben
					$file_ext = strtolower($file_ext);
					
					$filename = $file['name'];
					
					
					//$filesize = $_FILES['userfile']['size'];
					//echo filesize("$filename");
				
				
					if(in_array($file_ext, $extensiones)) {

						$uploadDirAudio = realpath('musik') . "/";
						$uploadDirXml = realpath('musikxml') . "/";
						
						
						if( $file_ext == "mp3" ) {
							move_uploaded_file($file['tmp_name'], $uploadDirAudio . $file['name']);
							
							$musik = $dbh->prepare("INSERT INTO musik (titel, musiklink, rating) VALUES (?, ?, ?)");
							$musik->execute(array($file['name'], "musik/". $file['name'], 0));
							$id = $dbh->lastInsertId();
							
							$musikquery = $dbh->prepare("SELECT * FROM musik WHERE id=$id");
							$musikquery->execute();
							$musikFK = $musikquery->fetch(PDO::FETCH_OBJ);
							$musikID = $musikFK->id;
							
							$musikFK = $dbh->prepare ("INSERT INTO user_musik (musik_id, user_id) VALUES (?, ?)");
							$musikFK->execute(array($musikID, $_SESSION['id']));
							
							$notenFK = $dbh->prepare ("INSERT INTO noten (musik_id) VALUES (?)");
							$notenFK->execute(array($musikID));

						}
						else{
							
							move_uploaded_file($file['tmp_name'], $uploadDir . $file['name']);
							$bild = $dbh->prepare("UPDATE users SET profilbild=? WHERE id= ?");
							$bild->execute(array("upload/". $file['name'], $_SESSION['id']));
						}
					
						}
				}
				else { echo(" <h2>Die Maximalgröße für Uploads liegt bei 8MB </h2>"); }
			}
		}
			
		
		//$musikquery = $dbh->query ( "SELECT * FROM noten ORDER BY id" );
		//$musikergebnis = $musikquery->fetch(PDO::FETCH_OBJ);
		
		//$musikFK = $dbh->prepare("INSERT INTO user_musik (musik_id) VALUES (?)");
		//$musikFK->execute(array($notenergebnis->id));
			 
		
		
	?>
	<img src="images/logo.png" alt="logo" class="logo-profil">
	<div class="content">
	
		
		
		
		<h3> Lade hier deine Musik hoch oder ändere dein Profilbild *</h3>
		<p style=" margin-bottom: 1%;">Format: .jpg | .png | .mp3 </p>
		<p style=" margin-bottom: 1%;"> maximale Größe: 8 MB </p>
		<form id="upload" method="post" action="uploadfile.php" enctype="multipart/form-data">

			<div id="drop">
				Drag & Drop

				<a>Browse</a>
				<input type="file" name="userfile" multiple />
				
			</div>
			<input type="submit" id="uploadbutton" value="upload">
			<ul>
				<!-- hier werden die Uploads angezeigt -->
			</ul>
			
		
			
		</form>
		
		<p> * Die Noten kannst du bei der Musikauswahl hochladen. </p>
		
		
		
		
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





