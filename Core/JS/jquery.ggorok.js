/*
	GGoRok Framework 4.3
	Developed by Tim Choi,
*/

$(document).ready(function(){
	var GGoRokTooltip = new function(){
		this.init = function(){
			$(document).on("mouseenter","[data-tooltip]",function(){
				if($("#tooltip").length == 0)
					$("body").append('<div id="tooltip"><span></span><div id="tooltip-triangle"></div></div>');
				
				$("#tooltip-triangle").removeAttr("style");
				$("#tooltip-triangle").removeAttr("class");
				$("#tooltip span").html($(this).data("tooltip"));
				
				// Object Left Position + (Object Width / 2) - (ToolTip Width / 2)
				var LeftP = ($(this).offset().left + ($(this).outerWidth() / 2) - ($("#tooltip").outerWidth() / 2) );
				var TopP = ($(this).offset().top + ($(this).outerHeight() / 2) - ($("#tooltip").outerHeight() / 2) );
				var TT_Location = {};
				TT_Location.Left = LeftP + $("#tooltip").outerWidth();
				TT_Location.Top = TopP + $("#tooltip").outerHeight();
				
				
				if(TT_Location.Left > $(window).width())
				{
					LeftP = LeftP - (TT_Location.Left - $(window).width()) - 20;
					$("#tooltip-triangle").removeClass("tooltip-triangle-center");
					$("#tooltip-triangle").css("left", ($(this).offset().left + ($(this).width() / 2) - LeftP) - 10 + "px");
				}
				
				
				if($(this).offset().top < $("#tooltip").outerHeight())
				{
					
					$("#tooltip-triangle").addClass('tooltip-triangle-top');
					$("#tooltip").css("top",($(this).offset().top + $(this).outerHeight() + 10)+"px");
				}
				else
				{
					
					$("#tooltip-triangle").addClass('tooltip-triangle-bottom');
					$("#tooltip").css("top",($(this).offset().top - 32)+"px");
				}
				
				$("#tooltip").css("left",LeftP+"px");
				
				$("#tooltip").show(0);
				
				
			});
			
			$(document).on(touchOrClick,"[data-tooltip]",function(){
				$("#tooltip").hide(0);
			});
			
			$(document).on("mouseleave","[data-tooltip]",function(){
				$("#tooltip").hide(0);
			});
		};
		
		this.init();
	};
});

var _Get = new function(){
   
	var parts = window.location.search.substr(1).split("&");
   var Get = {};
   for (var i = 0; i < parts.length; i++)
   {
      var temp = parts[i].split("=");
      Get[temp[0]] = temp[1];
   }
   return Get;
};
/*   
   var _Get;
	this.init = function(){
   	_Get = this.get_Get();
	};
	this.get_Get = function(Param){
		var parts = window.location.search.substr(1).split("&");
		var $_GET = {};
		for (var i = 0; i < parts.length; i++)
		{
			var temp = parts[i].split("=");
			if(temp[0] == Param)
			{
				return $temp[1];
         	break;
			}
		}

  };
};
*/
var hashController = new function(){
	oldHash = location.hash;
	toggleSubmit = true;
	
	this.init = function(){
		
		$(window).bind( 'hashchange', function(e) {
			if(oldHash != location.hash)
			{
				oldHash = location.hash;
				if(toggleSubmit == true)
					refreshPage.Submit();
			}
		});
	}
};

var Pull = new function(){
	this.Actions = new Array();
	this.registerAction = function(FunctionName)
	{
		this.Actions.push(FunctionName);
	};
	
	this.init = function()
	{
		var self = this;
		setTimeout(function(){
			self.start();
		},1000);
	};
	
	this.start = function(){
		var self = this;
		$.ajax({
			type: "POST",
			url: "/global/www/pull?ajaxProcess",
			data: "menu=pull",
			success: function(d){
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					if(typeof res.ntf != "undefined")
					{
						self.process(res.ntf);
					}
					
					setTimeout(function(){
						self.start();
					},3000);
				}
				else if(typeof res.error_msg != "undefined" && res.error_msg != "")
					showSideMSGBox(res.error_msg,'msgBox_One_2');
			}
		});
	};
	
	this.process = function(Data){
		var self = this;
		//playSound(1);
		for (var i = 0; i < Data.length; ++i)
		{
			for (var i2 = 0; i2 < self.Actions.length; ++i2)
			{
				self.Actions[i2](Data[i]['nT']);
			}
			
		}
	};
};

$.fn.GGoRokSelect = function(CallBack){
	var Obj = $(this);
	var Speed = 500;
	this.Value = $(this).data('value');
	this.NewValue = $(this).data('value');
	
	this.Init = function(){
		var self = this;
		
		
		if(typeof CallBack !== "undefined")
		{
			if('initValue' in CallBack)
			{
				self.setValue(CallBack.initValue);
			}
		}
		
		
		Obj.find(".SLT_Selected").on(touchOrClick,function(){
			self.toggleBox();
		});
	
		Obj.find(".SLT_Lists .SLT_List_One").on(touchOrClick,function(){
			self.toggleBox();
			self.setValue($(this).data('value'),true);
		});
		
	};
	
	this.setValue = function(Value,runCallback){
		var self = this;
		var gotNewValue = false;
		var selectedHTML = Obj.find(".SLT_List_One[data-value='"+Value+"']").html();
		Obj.find('.SLT_Selected_Text').html(selectedHTML);
		Obj.data("value",Value);
		self.NewValue = Value;
		
		if(self.NewValue != self.Value)
			gotNewValue = true;
			
		self.Value = Value;
		
		if(typeof CallBack !== "undefined" && runCallback)
		{
			if('onSelect' in CallBack && gotNewValue)
			{
				CallBack.onSelect(self);
			}
			
		}
	};
	this.getValue = function(){
		return this.Value;
	};
	this.toggleBox = function(){
		Obj.find(".SLT_Lists").slideToggle(Speed);
	};
	
	this.Init();
	
	if(typeof CallBack !== "undefined")
	{
		if('onLoad' in CallBack)
		{
			CallBack.onLoad();
		}
		
	}
		
	
	
 };
$.fn.GGoRokForm = function(Custom){
	var ObjForm = this;
	var ObjSubmitBTN = ObjForm.find('[data-type=Submit]');
	var ObjEnterSubmits = ObjForm.find('[data-submitenter]');
	

	var MSG_Error = "필수 입력항목(*)을 확인 후 다시 시도해 주세요.";
	ObjForm.addClass("GGoRokForm");
	
	this.Init = function(){
		var Self = this;
		
		ObjEnterSubmits.on('keyup',function(e){
			if(e.which == 13)
				Self.triggerEvent();
		});
		
		ObjSubmitBTN.on(touchOrClick,function(e){
			e.preventDefault();
			Self.triggerEvent();
		});
	};
	
	this.triggerEvent = function(){
		var Self = this;
		
		if(ObjSubmitBTN.hasClass("Disabled"))
		{
			
		}
		else
		{
			if(typeof Custom != "undefined" && Custom.hasOwnProperty("AfterClickSubmit"))
			{
				Custom.AfterClickSubmit();
			}
			
		
			if(typeof Custom == "undefined" || (typeof Custom != "undefined" && Custom.hasOwnProperty("Validate") && Custom.Validate()) || (typeof Custom != "undefined" && !Custom.hasOwnProperty("Validate")))
			{
				
				if(Self.Validate())
				{
					if(typeof ObjForm.data("confirmtitle") != "undefined" || typeof ObjForm.data("confirm") != "undefined")
					{
						var Confirm_Title = (typeof ObjForm.data("confirmtitle") != "undefined" ? ObjForm.data("confirmtitle") : "");
						var Confirm_Desc = (typeof ObjForm.data("confirm") != "undefined" ? ObjForm.data("confirm") : "");
						timconfirm(Confirm_Title,Confirm_Desc,function(){
							
							Self.Submit();
							
						});
					}
					else
						Self.Submit();
				}
				else
				{
					showSideMSGBox("<i class='fa fa-info-circle'></i> "+MSG_Error,"msgBox_One_2");
					if(typeof Custom != "undefined" && Custom.hasOwnProperty("OnError"))
					{
						Custom.OnError();
					}
				}
			}
		}
	}
	
	this.Validate = function(){
		var Validation_Result = true;
		$("input",ObjForm).removeClass("Warning");
		$("input",ObjForm).each(function(){
			if(typeof $(this).data('must') != "undefined")
			{
				if(($(this).prop('type') == 'text' || $(this).prop('type') == 'password' ) && $(this).val() == "")
				{
					$(this).addClass("Warning");
					Validation_Result = false;
					console.log($(this).prop('id'));
				}
				else if($(this).prop('type') == 'checkbox' && !$(this).prop("checked"))
				{
					$(this).addClass("Warning");
					Validation_Result = false;
					console.log($(this).prop('id')+$(this).prop("checked")+"chk");
				}
				
			}
		});
		return Validation_Result;
	};
	
	this.Submit = function(){
		
		var Action = ObjForm.prop('action');
		var Menu = 	ObjForm.data("menu");
		var Args = "";
		
		ObjForm.find('input,textarea,select').each(function(){
			Args += "&"+$(this).prop('id')+"="+$(this).val();
		});
		
		ObjSubmitBTN.addClass('Disabled');
		
		$.ajax({
			type: "POST",
			url: (typeof Action != undefined && Action != "" ? Action : __AjaxURL__+"?ajaxProcess"),
			data: "menu="+Menu+Args,
			success: function(d){
				ObjSubmitBTN.removeClass('Disabled');
				
				var res = $.parseJSON(d);
				
				if(typeof Custom != "undefined" && Custom.hasOwnProperty("Completed"))
					Custom.Completed(res);
				
			}
		});
	};
	this.Init();
	

	
 };