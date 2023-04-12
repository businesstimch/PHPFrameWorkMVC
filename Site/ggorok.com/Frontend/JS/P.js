$(document).ready(function(){
	$(document).on(touchOrClick,".PTab_One",function(){
		$('.PTab_One').removeClass("PTabSelected");
		$(this).addClass("PTabSelected");
		$('.PDetail_Block').hide();
		$("#"+$(this).data('tabid')).show();
	});

});