<?php
		
			$beschreibung = $_POST['description'];
			$vollstaendig = false;
			if(array_key_exists("beschreibung", $_POST)){
				if(trim($_POST['beschreibung']) == "") $vollstaendig = false;
				else $beschreibung = htmlspecialchars(trim($_POST['beschreibung']));
				
				if ($vollstaendig=true ) {
										
					$update = $dbh->prepare("UPDATE users SET beschreibung=? WHERE id = ?");
					$update->execute(array($beschreibung, $myname));	
																		
					
				}
				
				// echo ('<p class="aktualisiert"> Dein Profil wurde aktualisiert </p>');
			}
?>