$(document).ready(function(){
	
	// ---- stwórz obiekt podglądu
	
	$("body").append("<div class='img_viewer'><center class='img_cont'></center></div>");
	$(".img_viewer").hide(); // schowaj go
	
	// ----
	
	
	$(".content a[title='img']").each(function(){
		
		var text = $(this).html();
		
		var href = $(this).attr("href");
		
		$(this).replaceWith("<span href='"+ href +"' class='img_link'>"+ text +"</a>");
		
	});
	
	
	$(".img_link").click(function(){
		
		var href = $(this).attr("href");
		$(".img_cont").html("<img id='loader' src='/elements/images/ajax-loader2.gif'><img id='img_preview' src='"+ href +"'><h2>Kliknij tutaj lub wciśnij Esc, aby zamknąć</h2>");
		
		$(".img_viewer").show(); // Pokaż podgląd
		
		// Schowaj obrazek i zaczekaj na załadowanie
		$("#img_preview").hide().load(function(){
			
			$(this).show(); // pokaż obrazek
			$("#loader").remove(); // usuń loader
		
			var margin = 50; // Ustawiam marginesy
			
			var wWidth = $(window).width() - (2 * margin);
			var wHeight = $(window).height() - (2 * margin);
			
			var imgWidth = $(this).width();
			var imgHeight = $(this).height();
			
			
			if(imgWidth > wWidth || imgHeight > wHeight){
								
				if((imgWidth / wWidth) > (imgHeight / wHeight)){
					var scale = imgWidth / wWidth;
				} else {
					var scale = imgHeight / wHeight;
				}
				
				var newWidth = (imgWidth / scale).toFixed();
				var newHeight = (imgHeight / scale).toFixed();
				
				$(this).width(newWidth);
				$(this).height(newHeight);
				
			}			
		});
	});
	$(".img_viewer").click(function(){
		$(this).hide();
	});
	$(document).keydown(function(event){ 
		if ( event.which == 27 ) $(".img_viewer").hide();
	});
	
});
