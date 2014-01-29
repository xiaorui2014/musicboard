/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
$(document).ready(function(){
                 
	 function search(){
		// Inpute wird in Variable gespeichert
		  var suche = $("#search").val();

		  if(suche != ""){
			$("#result").html("<img src='images/loader.gif'/>");
			
			// Request wird gesenden
			 $.ajax({
				type:"post",
				url:"search.php",
				data:"username="+suche,
				success:function(data){
					$("#result").html(data);
					$("#search").val("");
				 }
			  });
		  }
		  

		 
	 }

	 /* $("#button").click(function(){
		   search();
	  });
	*/
	  $('#search').keyup(function(e) {
		 if(e.keyCode == 13) {
			search();
		  }
	  });
});