var curr_page = 1;

$(document).ready(function(){
	$(document).on(touchOrClick,'#topSettings_ICN',function(){
		if($("#topSettings_Container").css("display") == "block")
			$("#topSettings_Container").hide();
		else
			$("#topSettings_Container").show();
	});
	
	$(document).on('change','#Language_SLT',function(){
		if($(this).val() != "")
		{
			$.ajax({
				type: "POST",
				url: "/?langSetting&ajaxProcess",
				data: "langID="+$(this).val(),
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						location.reload(true);
					}
				}
			});
		}
	});
	
	$(document).on('mouseenter','#topCategory_Block',function(){
		$("#topCategory_Left,#topCategory_Cont,#topCategory_Block").clearQueue();
		$("#topCategory_Left,#topCategory_Cont,#topCategory_Block").delay( 500 ).animate({
			height:"450px"
		},500);
	});
	
	$(document).on('mouseleave','#topCategory_Block',function(){
		$("#topCategory_Left,#topCategory_Cont,#topCategory_Block").clearQueue();
		$("#topCategory_Left,#topCategory_Cont,#topCategory_Block").animate({
			height:"140px"
		},500);
	});
	
	
	var cur_M_PG = 1; // Searach Mile Range
	$(document).on("click","#loadListMore_Block",function(){
		var Argv = '';
		if(typeof searchPage !== undefined)
		{
			Argv = '&K='+encodeURIComponent(SearchKeywords.Keyword)+'&A='+encodeURIComponent(SearchKeywords.Address);
		}
			
		if(catURL != "")
			Argv += "&catURL="+catURL;
		
		var MileIncr = 25;
		$.ajax({
			type: "POST",
			url: "/?ajaxProcess"+Argv,
			data: "menu=Load_List&pg="+curr_page+"&cur_M_PG="+cur_M_PG,
			success: function(d){
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					$("#BusinessList_Cont").append(res.html);
					curr_page++;
					
					if(res.more == 'f')
					{
						cur_M_PG++;
						curr_page = 1;
						$("#loadListMore_Block").html("Load More in "+(cur_M_PG * MileIncr)+" miles (+)");
					}
					
				}
			}
		});
		
		
	});
});