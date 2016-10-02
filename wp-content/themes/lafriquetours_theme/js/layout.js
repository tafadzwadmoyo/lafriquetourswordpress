
function layout(){
var fp=jQuery(".fp").toArray();
for (i = 0; i < fp.length; i++) { 
	var child =jQuery(".fp:eq("+i+")").find(".fp_content");
	var img=jQuery(".fp:eq("+i+")").find(".fp_img");
	var bg=jQuery(".fp:eq("+i+")").find(".fp_bg");
	bg.css('top', img.position().top );
	child.animate({top: img.position().top +(img.height()-child.find("fp_visible").height())/2
	, left: img.position().left});
	}
};

jQuery(document).ready(function(){
	layout();
	
});
jQuery( window ).resize(function(){
	layout();
});
jQuery(".freewallfp").hover(
	function (){
		jQuery(this).find(".fp_content").find(".fp_hidden").fadeIn(100);
		var child =jQuery(this).find(".fp_content");
		var img=jQuery(this).find(".fp_img");
		child.delay(200).animate({top: img.position().top +(img.height()-child.height())/2, }, 300);	
		img.animate({opacity: 0.5});
	},
	function (){
		
		var child =jQuery(this).find(".fp_content");
		var img=jQuery(this).find(".fp_img");
		child.animate({top: img.position().top +(img.height()-child.find("fp_visible").height())/2}, 300);	
		jQuery(this).find(".fp_content").find(".fp_hidden").delay(400).fadeOut(100);
		img.animate({opacity: 1});

	});
	
