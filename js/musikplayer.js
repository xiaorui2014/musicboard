/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
$(function rotateImage() {
		
		$(".current").hide();
	    var src = $("#platte").attr("src");
	    $("#holder").html("");
		
		// baut ein canvas
	    var paper = Raphael($("#holder")[0], 200, 250);
		// baut ein Rechteck
	    var image = paper.image(src, 0, 0, 200, 200);
		// Winkel = 100.000° dreht sich solang bis erreicht
	    var angle = 100000;
	    
	    $(".play").click(function(){
	        image.animate({
	            rotation: angle
	        }, 2000000, ">");
	
			
			//$(".current").show();
			//$(this).next().find(".current").show();
			//$(".current").next().show();
			
	        
	    });
	    
	    $(".pause").click(function(){
	        image.stop();
	    });
	    
});


soundManager.onload = function() {
}