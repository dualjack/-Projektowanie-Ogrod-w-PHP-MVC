$(document).ready(function(){

	var div_w = $(".blog-notepad-entry .content").innerWidth();
	
	$(".content img").each(function(){
		
		var img_src = $(this).attr("src");
		
		$(this).addClass("old").after("<img class='resize' src='"+img_src+"'><img class='loader' src='/elements/images/ajax-loader.gif'>").next(".resize").load(function(){

			$(this).next(".loader").remove();
			$(this).prev(".old").remove();
			$(this).show();
			
			
			var img_w = $(this).width();
			var img_h = $(this).height();
			
			
			if(img_w > div_w){
				
				var scale =  img_w / div_w;
				
				$(this).width(img_w / scale +'px');
				$(this).height(img_h / scale +'px');
				
				$(this).wrap('<a href="'+ img_src +'" />');
				
				$(this).after("<font class='img_resized_info'>Wyświetlono "+
				Math.round(scale*10,1)
				+"% obrazka</font><p>");
				
			}
			
		});
		
	});

});

