jQuery(document).ready(function($){
	if($('.jps-wrap-content').length>0){
	
	$('body.page .jps-wrap-content .jps-next, body.single .jps-wrap-content .jps-next').click(function(){
		var rep = 'post-part-';
		var current_div = $('.jps-parent-div:visible');
		var current_page = current_div.attr('id').replace(rep, '');
		var next_page = parseInt(current_page)+1;
		var expected_object = $('#'+rep+''+next_page);
		if(expected_object.length>0){
			$('.jps-wrap-content').hide();
			$(expected_object).fadeIn();
		}else{
			$('.jps-wrap-content').eq(0).fadeIn();
		}

		jps.move_to_post();
	});
	$('body.page .jps-wrap-content .jps-prev, body.single .jps-wrap-content .jps-prev').click(function(){
		var rep = 'post-part-';
		var current_div = $('.jps-parent-div:visible');
		var current_page = current_div.attr('id').replace(rep, '');
		var prev_page = parseInt(current_page)-1;
		var expected_object = $('#'+rep+''+prev_page);
		if(expected_object.length>0){
			$('.jps-wrap-content').hide();
			$(expected_object).fadeIn();
		}else{
			$('.jps-wrap-content').eq(($('.jps-wrap-content').length-1)).fadeIn();
		}
		jps.move_to_post();
	});	
	
	$('body.page .jps-wrap-content, body.single .jps-wrap-content').eq(0).fadeIn();
	
	$('body.page .jps-wrap-content .jps-slider-nav a, body.single .jps-wrap-content .jps-slider-nav a').removeAttr('href');
	
	}
});

var jps = {
	'move_to_post': function(){
		jQuery('html, body').animate({
						scrollTop: jQuery('.jps-wrap-content:visible').offset().top-160
					}, 2000);
	}
};