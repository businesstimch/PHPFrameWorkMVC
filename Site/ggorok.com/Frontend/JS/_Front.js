$(document).ready(function(){
	
	TopMenu.init();
	
	/* Product Page */
	if($("#Product_Block").length > 0)
	{
		Option.init();
		Price.check();
	}
	
	$(document).on(touchOrClick,"#Logout_BTN",function(){
		$.ajax({
			type: "POST",
			url: "/login?ajaxProcess",
			data: "menu=Logout",
			success: function(d){
				
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					location.reload();
				}
				else if(typeof res.error_msg != "undefined")
				{
					showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			}
		});
	});
	
	
	$(document).on(touchOrClick,".PTab_One",function(){
		console.log($(this).data('scrollto')+":Scroll");
		$.scrollTo("#"+$(this).data('scrollto'),800);
	});
	
	$(document).on(touchOrClick,"#P_CartAdd_Btn",function(){
		
		/* Is there any options must to check? */
		Price.check();
		var Go = true;
		var error_msg;
		
		$(".Opt_Selected").removeClass("Opt_Selected_Must");
		
		$(".P_Opt").each(function(){
			if($(this).data("ismandatory") == 1)
			{
				if($(this).find(".Opt_Selected").data("selectedoptid") == "")
				{
					Go = false;
					$(this).find(".Opt_Selected").addClass("Opt_Selected_Must");
					error_msg = "Please select the option.";
					
				}
			}
		});
		
		if(Go)
		{
			if(pID != "")
			{
				var pID = $("#Product_Block").data("pid");
				var Qty = $("#P_CartQty_Inp").val();
				var Opt = [];
				$(".Opt_Selected").each(function(){
					if($(this).data("selectedoptid") != "")
					{
						/*console.log(Opt_Tmp[0]);*/
						Opt.push($(this).data("selectedoptid"));
					}
					
				});
				
				var Data = [pID,Qty,Opt];
				Cart.addItem(Data);
			}
		}
		else
			showSideMSGBox(error_msg,"msgBox_One_2");
	});
	
	$(document).on('change',"#P_CartQty_Inp",function(){
		Price.check();
	});
	$(document).on('keyup',"#P_CartQty_Inp",function(){
		Price.check();
	});
	$(document).on(touchOrClick,".PIW_Pic",function(){
		var Img = $(this).prop("src").replace(/\/Thumb\//,"/Showcase/");
		
		$(".PIW_One").removeClass("PIW_One_Selected");
		$(this).parents(".PIW_One").addClass("PIW_One_Selected");
		
		$("#PIS_Pic").prop("src",Img);
	});
	
	
	$(document).on(touchOrClick,".TDI_AddCart",function(){
      
		var Obj = $(this).parents(".TDI_One");
		if($(this).hasClass("hasMandatoryOptions"))
		{
			showSideMSGBox("This item has option to select. Please check the item detail page.",'msgBox_One_2');
		}
		else
		{
			if(Obj.data("pid") != "")
			{
				var pID = parseInt(Obj.data("pid"));
				var Qty = 1;
				var Opt = [];
				var Data = [pID,Qty,Opt];
				Cart.addItem(Data);
			}
		}
	});
	
	Cart.init(); //Assign Token;
	CustomTim.init();
	
});

function submitSearch(Keyword) {
	location.href = "/s/?Search="+Keyword;
}

var TopMenu = new function()
{
	this.init = function(){
		$('.TC_Head_One').append('<div class="mouseOverIndicator"></div>');
		$('.TC_Head_One').on({
			mouseenter: function(){
				$(this).find('.mouseOverIndicator').animate({
					'width':"100%"
				},300);
			},
			mouseleave: function(){
				
				$(this).find('.mouseOverIndicator').stop().animate({
					'width':"0"
				},100);
			},
		});
		
		
		
		this.timer($('.TC_Head_One'),function(){
			console.log(1);
		});
	};
	
	this.timer = function(e,callback){
		var timeout = null;
		e.mouseover(function(){
			timeout = setTimeout(callback,300);
		});
		
		e.mouseout(function(){
			clearTimeout(timeout);
		});
	};
};

var Billboard = new function()
{
	this.show = function(Data){
		var Speed = (Data.Speed != 'undefined' ? Data.Speed : 500);
		$('#Billboard').html(Data.Msg);
		this.setSize();
		$('#Billboard').fadeIn(Speed);
		
	};
	
	this.hide = function(){
		$('#Billboard').html("").fadeIn(Speed);
	};
	
	this.setSize = function(){
		$('#Billboard').css('margin-left','-'+$('#Billboard').outerWidth / 2);
	};
};

var CustomTim = new function()
{
	this.init = function(){
		$(document).on(touchOrClick,".Tim_Selection_1 div",function(){
			$(this).parents('.Tim_Selection_1').find('div').each(function(){
				$(this).removeClass('selectedChkMethod');
				$('i', this).removeClass('fa-dot-circle-o');
				$('i', this).addClass('fa-circle-o');
			});
			$(this).addClass('selectedChkMethod');
			$('i', this).addClass('fa-dot-circle-o');
			$('i', this).removeClass('fa-circle-o');
		});
	};
};

/*
var Search = new function()
{
	var self = this;
	this.currentKeyword;
	this.init = function(){
		self.currentKeyword = $('#Search_Field_Inp').val();
		self.autoComplete();
	};
	
	this.autoComplete = function(){
		$(document).on('keyup','#Search_Field_Inp',function(e){
			if(self.currentKeyword != $(this).val() && $(this).val() !== "" && !(e.which > 37 && e.which < 41))
			{
				self.currentKeyword = $(this).val();
				sendAutoComplete_Call(self.currentKeyword);
			}
			else if($(this).val() === "")
			{
				$('#Search_Recommend').html("");
				self.currentKeyword = "";
			}
			else
			{
				
				if(e.which == 38)
				{
					selectRecomKeyword('Up');
				}
				else if(e.which == 40)
				{
					selectRecomKeyword('Down');
				}
			
			}
			
		});
		
		
	};
	
	var selectRecomKeyword = function(Direction){
		if($('.SRKeyA_One').length > 0)
		{
			if($('.SRKeyA_Selected').length === 0)
			{
				$('.SRKeyA_Selected').removeClass('SRKeyA_Selected');
				if(Direction == 'Up')
				{
					$('.SRKeyA_One[data-indx='+$('.SRKeyA_One').length+']').addClass('SRKeyA_Selected');
				}
				else
				{
					$('.SRKeyA_One[data-indx=1]').addClass('SRKeyA_Selected');
				}
			}
			else
			{
				var selectedIndx = $('.SRKeyA_Selected').data('indx');
				$('.SRKeyA_Selected').removeClass('SRKeyA_Selected');
				if(Direction == 'Up' && $('.SRKeyA_One[data-indx='+(selectedIndx - 1)+']').length > 0)
				{
					$('.SRKeyA_One[data-indx='+(selectedIndx - 1)+']').addClass('SRKeyA_Selected');
				}
				else if(Direction == 'Down' && $('.SRKeyA_One[data-indx='+(selectedIndx + 1)+']').length > 0)
				{
					$('.SRKeyA_One[data-indx='+(selectedIndx + 1)+']').addClass('SRKeyA_Selected');
				}
					
				
			}
			if($('.SRKeyA_Selected').length === 0 && self.currentKeyword != $('#Search_Field_Inp').val())
			{
				$('#Search_Field_Inp').val(self.currentKeyword);
			}
			else if($('.SRKeyA_Selected').length > 0)
			{
				$('#Search_Field_Inp').val($('.SRKeyA_Selected').text());
				
			}
			
			
			
		}
	};
	
	var sendAutoComplete_Call = function(Keyword){
		$.ajax({
			type: "POST",
			url: "/s/?ajaxProcess&menu=AC",
			data: "K="+encodeURIComponent(Keyword),
			success: function(d){
				
				var res = $.parseJSON(d);
				var HTML = "";
				if(res.ack == 'success')
				{
					var indx = 1;
					jQuery.each(res.R, function() {
						HTML += '<a href="/s/?Search='+encodeURIComponent(this.AC_Keyword)+'" data-indx="'+indx+'" class="SRKeyA_One">' + this.AC_Keyword + '</a>';
						indx++;
					});
					
					
               $("#Search_Recommend").html(HTML);
				}
				else if(typeof res.error_msg != "undefined")
				{
					showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			}
		});
	};
	
};
*/

var Cart = new function(Data)
{
	
	this.addItem = function(Data){
		
		$.ajax({
			type: "POST",
			url: "/checkout/cart/?ajaxProcess",
			data: "menu=Cart_addItem&Prd_ID="+Data[0]+"&Cart_Qty="+Data[1]+"&Cart_Options="+JSON.stringify(Data[2]),
			success: function(d){
				
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
               
					$("#Cart_ItemQty_Num").html("("+res.Cart_Qty+" ITEM : $"+res.Cart_Sub_Total+")");
					timPopup(res.html);
					
				}
				else if(typeof res.error_msg != "undefined")
				{
					showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			}
		});
		
		
	};
	
	this.init = function(){
		//Get Items in Cart and Display
		var Parent = this;
		$(document).on("change",".PQty_Inp",function(){
			if(isNaN(parseInt($(this).val())) || $(this).val() < 1)
				$(this).val(1);
				
			$(this).parents(".CI_One").find(".CI_Update_Btn").addClass("CI_Update_Changed");
		});
		
		$(document).on("keyup",".PQty_Inp",function(){
			if (!isNaN(parseInt($(this).val()))) {
				$(this).val(parseInt($(this).val()));
			}
			
		});
		
		
		$(document).on(touchOrClick,".CI_Update_Btn",function(){
			if($(this).hasClass('CI_Update_Changed'))
			{
				Parent.modItem($(this));
			}
			else
				showSideMSGBox("Please change the item's qty before updating.",'msgBox_One_2');
			
			
		});
		
		$(document).on(touchOrClick,".CI_Delete_Btn",function(){
			var ParentThis = Parent;
			var Obj = $(this);
			
			if (Obj.data('type') == "onpage")
			{
				timconfirm("Cart","Do you want to delete this item from your cart?",function(){
					ParentThis.delItem(Obj);
				});
			}
			else
				ParentThis.delItem(Obj);
		});
		
		
	};
	
	this.delItem = function(Obj){
		
		var cuID = Obj.parents('.CI_One').data('cartuid');
		var cartID = Obj.parents('.CI_One').data('cartid');
		console.log(cuID+"."+cartID);
		if(cuID != "" && cartID != "" && cuID != undefined && cartID != undefined)
		{
			
			$.ajax({
				type: "POST",
				url: "/checkout/cart/?ajaxProcess",
				data: "menu=Cart_delItem&cuID="+cuID+"&cartID="+cartID,
				success: function(d){
					
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						showSideMSGBox("Deleted Successfully.",'msgBox_One_1');
						if(Obj.data('type') == 'onpage')
							refreshPage.Submit();
						else
							Obj.parents(".CI_One").slideUp(500,function(){
								var ParentContainer = $(this).parents(".Cart_Items");
								$(this).remove();
								
								if(ParentContainer.find(".CI_One").length == 0)
								{
									ParentContainer.html("Your cart is empty.");
								}
							});
					}
					else
					{
						showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				}
			});
		}
	};
	
	this.modItem = function(Obj){
		var cuID = Obj.parents('.CI_One').data('cartuid');
		var cartID = Obj.parents('.CI_One').data('cartid');
		var Qty = Obj.parents('.CI_One').find(".PQty_Inp").val();
		Obj.removeClass("CI_Update_Changed");
		
		if(cuID != "" && cartID != "" && cuID != undefined && cartID != undefined && parseInt(Qty) > 0)
		{
			
			$.ajax({
				type: "POST",
				url: "/checkout/cart/?ajaxProcess",
				data: "menu=Cart_modItem&cuID="+cuID+"&cartID="+cartID+"&Qty="+Qty,
				success: function(d){
					
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						showSideMSGBox("Updated Successfully.",'msgBox_One_1');
						refreshPage.Submit();
					}
					else
					{
						showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				}
			});
		}
	};
	
	/*
	this.getTK = function(){
		
		
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++)
		{
			var c = ca[i];
			
			while (c.charAt(0) == " ")
				c = c.substring(1);
			
			if(c.indexOf(this.tkName) == 0)
			{
				
				return c.substring(this.tkName.length + 1, c.length);
			}
		}
		return false;
	
	};
	*/
	
};

var Price = new function()
{
	var each_txt = "<span class='SmallPrice_TXT'> / ea</span>";
	var total_txt = "<span class='SmallPrice_TXT'> / total</span>";
	this.check = function(){
		var Qty = parseInt($("#P_CartQty_Inp").val());
		var Price = parseFloat($("#P_Price").data("baseprice"));
		if(isNaN(Qty) || Qty == 0)
		{
			Qty = 1;
			$("#P_CartQty_Inp").val(1);
		}
		$("#P_CartQty_Inp").val(Qty);
		
		$(".Opt_Selected").each(function(){
			if($(this).data("selectedoptid") != "")
			{
				var Obj_O = $(".Opt_Select_One[data-optid="+$(this).data("selectedoptid")+"]");
				
				if(Obj_O.data("operand") == "+")
				{
					Price = parseFloat(Price) + parseFloat(Obj_O.data("price"));
				}
				else
					Price = Price - Obj_O.data("price");
			}
		});
		
		
		Price = (Price * Qty);
		if(Price > 0)
		{
			Price = parseFloat(Price);
			Price = Price.number_format(2,'.',',');
			$("#P_Price").html('$'+Price+(Qty > 1 ? total_txt:each_txt));
			console.log(1);
		}
		/*console.log(Price);*/
	};
};

var Option = new function()
{
	this.init = function(){
		$(document).on(touchOrClick,".Opt_Selected",function(){
			
			var Obj = $(this).parents(".OptField_One").find(".Opt_Lists");
			var Obj_Self = $(this);
			
			if(Obj.css("display") == "block")
			{
				Obj.slideUp(100,function(){
					Obj_Self.parents('.OptField_One').removeClass('Opt_Activated');
				});
				
				
			}
			else
			{
				Obj_Self.parents('.OptField_One').addClass('Opt_Activated');	
				Obj.slideDown(100);
				
			}
			
		});
		
		$(document).on(touchOrClick,".Opt_Select_One",function(){
			var Obj = $(this).parents(".Opt_Lists").find(".Opt_Select_One");
			var ObjList = $(this).parents(".OptField_One").find(".Opt_Lists");
			var ObjSelected = $(this).parents(".OptField_One").find(".Opt_Selected");
			
			Obj.removeClass("Opt_Select_Selected");
			$(this).addClass("Opt_Select_Selected");
			ObjList.slideUp();
			ObjSelected.find(".Opt_Selected_Name span").html($(this).html());
			ObjSelected.data("selectedoptid",$(this).data("optid"));
			
			Price.check();
		});
		
		
	};
};
	