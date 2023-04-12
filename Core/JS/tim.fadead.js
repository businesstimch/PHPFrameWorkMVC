var TimFadeAd = new function(){
	
	var fadeSpeed = 2000;
	var adGap_Time = 2000;
	var mouseHover = false;
	var debug = false;
	
	this.init = function(){
		var thisParent = this;
		
		if($(".FA_Ad_One").length == 0)
			return false;
		else($(".FA_Ad_One").length > 1)
		{
			var AdCount_Current = 1;
			$(".FA_Ad_One").each(function(){
				if(AdCount_Current == 1)
				{
					$(this).show();
					$(this).css("z-index","2");
					$(this).addClass("FA_Ad_Current");
				}
				else
				{
					$(this).hide();
					$(this).css("z-index","0");
					$(this).removeClass("FA_Ad_Current");
				}
				AdCount_Current++;
			});
			$(".FA_Menu").show();
			$(".FA_Menu").stop().animate({
				opacity:0.2
			},function(){
				
			});
			setTimeout(function(){thisParent.startAd(false,'Next');}, adGap_Time);
		}
		
		$(document).on("mouseover","#Mid_FadingAd",function(){
			mouseHover = true;
		});
		
		$(document).on("mouseleave","#Mid_FadingAd",function(){
			mouseHover = false;
		});
		
		$(document).on(touchOrClick,"#FA_Menu_L",function(){
			thisParent.startAd(false,'Prev',true);
		});
		
		$(document).on(touchOrClick,"#FA_Menu_R",function(){
			thisParent.startAd(false,'Next',true);
		});
		
		$(document).on("mouseover","#Mid_FadingAd",function(){
			$(".FA_Menu").stop().animate({
				opacity:1
			});
		});
		
		$(document).on("mouseleave","#Mid_FadingAd",function(){
			$(".FA_Menu").stop().animate({
				opacity:0.2
			});
			
		});
		
		
	};
	
	this.startAd = function(Clicked,Direction,Once){
		var thisParent = this;
		if(mouseHover && !Clicked && !Once)
		{
			if(debug)
				console.log("Start AD - Void Loop");
			
			setTimeout(function(){thisParent.startAd();}, adGap_Time);
		}
		else
		{
			
			var currentAD = $(".FA_Ad_Current");
			var nextAD;

			if(debug)
				console.log('Start AD - Loop');
			
			if(Direction == 'Next')
			{
				if(currentAD.next().length > 0)
				{
					nextAD = currentAD.next();
				}
				else
				{
					nextAD = $(".FA_Ad_One").first();
				}
			}
			else(Direction == 'Prev')
			{
				if(currentAD.prev().length > 0)
				{
					nextAD = currentAD.prev();
				}
				else
				{
					nextAD = $(".FA_Ad_One").last();
				}
			}
			currentAD.fadeOut(fadeSpeed,function(){
				nextAD.addClass("FA_Ad_Current");
				currentAD.removeClass("FA_Ad_Current");
				if(!Once)
					setTimeout(function(){thisParent.startAd(false,'Next',false);}, adGap_Time);
			});
			nextAD.fadeIn(fadeSpeed,function(){
				
				
			});
		}
		
		
	};
}