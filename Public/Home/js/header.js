$(function(){
	$('.nav').each(function(){
		$(this).hover(function(){
			$(this).find('ul').slideToggle();
		},function(){
			$(this).find('ul').slideToggle();
		})
	});
});