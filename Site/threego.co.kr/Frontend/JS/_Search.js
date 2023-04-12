$(document).ready(function(){
	 searchTOP();
});
var SearchKeywords = {Address:null,Keyword:null};
function searchTOP()
{
	
	$(document).on("click","#searchBTN",function(){
		document.getElementById("search_Form").submit();
	});
	
	$(document).on("click",".autoComplete_Search div",function(){
		
		if($(this).parent().attr("id") == "autoComplete_Keyword")
			var SearchBox_INP_OBJ = '#SearchBOXTop_Keyword_INP';
		else if($(this).parent().attr("id") == "autoComplete_Address")
			var SearchBox_INP_OBJ = '#SearchBOXTop_Address_INP';
		else
			var SearchBox_INP_OBJ = '#location_setting_INP';
			
		$(SearchBox_INP_OBJ).val($(this).text());
		//SearchURLFactory();
		$('.autoComplete_Search').html("");
		$('.autoComplete_Search').hide();
	});
	
	$(document).on('focusout',"#SearchBOXTop_Address_INP, #SearchBOXTop_Keyword_INP, #location_setting_INP",function(){
		
		if(!$('#autoComplete_Address').is(":hover") && !$('#autoComplete_Keyword').is(":hover") && !$('#autoComplete_AddressSetting').is(":hover"))
		{
		
			var autoComplete_OBJ;
			var prev_Global_Keyword;
			
			if($(this).attr("id") == "SearchBOXTop_Address_INP")
				autoComplete_OBJ = '#autoComplete_Address';
			else if($(this).attr("id") == "SearchBOXTop_Keyword_INP")
				autoComplete_OBJ = '#autoComplete_Keyword';
			else
				autoComplete_OBJ = '#autoComplete_AddressSetting';
				
			$(autoComplete_OBJ).hide();
			$(autoComplete_OBJ).html("");
		}
		
	});
	$(document).on("keyup","#SearchBOXTop_Address_INP, #SearchBOXTop_Keyword_INP, #location_setting_INP",function(e){
		
		var autoComplete_OBJ;
		var prev_Global_Keyword;
		var AjaxMenu;
		if($(this).attr("id") == "SearchBOXTop_Address_INP")
		{
			autoComplete_OBJ = '#autoComplete_Address';
			prev_Global_Keyword = SearchKeywords.Address;
			AjaxMenu = 'A';
		}
		else if($(this).attr("id") == "location_setting_INP")
		{
			autoComplete_OBJ = '#autoComplete_AddressSetting';
			prev_Global_Keyword = SearchKeywords.Address;
			AjaxMenu = 'A';
		}
		else
		{
			autoComplete_OBJ = '#autoComplete_Keyword';
			prev_Global_Keyword = SearchKeywords.Keyword;
			AjaxMenu = 'K';
		}
		
		
		
		if(e.which == 13)
		{
			if($(this).attr("id") == "location_setting_INP")
				submitNewLocation();
			else
				document.getElementById("search_Form").submit();
		}
		else if($(autoComplete_OBJ + " div").length > 0 && (e.which == 40 || e.which == 38))
		{
			if($(autoComplete_OBJ + " div.selected").length > 0)
			{
				if(e.which == 40)
				{
					if($(autoComplete_OBJ + " div.selected").next().length > 0)
					{
						$(autoComplete_OBJ + " div.selected").next().addClass("selected");
						$(autoComplete_OBJ + " div.selected").prev().removeClass("selected");
					}
					else
					{
						$(autoComplete_OBJ+" div").first().addClass("selected");
						$(autoComplete_OBJ+" div").last().removeClass("selected");
					}
				}
				else if(e.which == 38)
				{
					
					if($(autoComplete_OBJ + " div.selected").prev().length > 0)
					{
						$(autoComplete_OBJ + " div.selected").prev().addClass("selected");
						$(autoComplete_OBJ + " div.selected").next().removeClass("selected");
					}
					else
					{
						$(autoComplete_OBJ + " div").last().addClass("selected");
						$(autoComplete_OBJ + " div").first().removeClass("selected");
					}
				}
			}
			else
			{
				$(autoComplete_OBJ + " div").first().addClass("selected");
			}
			
			if($(autoComplete_OBJ + " div.selected").length > 0)
				$(this).val($(autoComplete_OBJ + " div.selected").text());
			
		}
		else
		{
			var GoSearch = false;
			var Keyword = $(this).val();
			
			
			if(Keyword == "")
			{
				$(autoComplete_OBJ).hide();
				$(autoComplete_OBJ).html("");
			}
			else
			{
				
				if(prev_Global_Keyword != Keyword)
					GoSearch = true;
				else
					GoSearch = false;
			}
			
			if(GoSearch)
			{
				$.ajax({
					type: "POST",
					url: "/global/www/home/?ajaxProcess",
					data: "menu=autoComplete_Search&st="+AjaxMenu+"&Keyword="+encodeURIComponent(Keyword),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							if(res.html != "")
							{
								$(autoComplete_OBJ).show();
								$(autoComplete_OBJ).html(res.html);
							}
							else
								$(autoComplete_OBJ).hide();
						}
					}
				});
				
				if($(this).attr("id") == "SearchBOXTop_Address_INP")
				{
					SearchKeywords.Address = Keyword;
				}
				else
				{
					SearchKeywords.Keyword = Keyword;
				}
			}
		
		}
		
		//SearchURLFactory(); //Deleted by Tim
		
	});
}