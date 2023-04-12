<style type="text/css">
	#POS_Login_Block{width:50%;height:100%;margin-left:auto;margin-right:auto;float:none;}
		
		#POS_LoginInp_Block{width:100%;margin-top:10%;margin-bottom:10%;height:5%;}
		#LoginDial_Block{width:80%;height:75%;margin-left:auto;margin-right:auto;float:none;}
		#Dial_LoginBox_Display{width:100%;height:100%;font-size:10em;text-align:center;color:#747474;display:none;position:relative;}
		.Dial_Wrap{width:21%;margin-left:3%;margin-bottom:3%;display:inline-block;position:relative;}
		.Dial_Wrap:before{display: block;margin-top: 100%;content: "";}
		.Dial_Wrap .Dial
		{
			position:absolute;
			left:0;
			right:0;
			top:0;
			bottom:0;
			border-radius:50%;
			cursor:grab;
			text-align:center;
			border-top:1px solid gray;
			border-right:1px solid gray;
			color:gray;
			/*
			behavior: url(PIE.htc);
			http://css3pie.com/
			*/
		}
		
		#LoginDial_Block .Dial:active{background-color:#e4e4e4;}
		#Dial_LoginBox{display:none;}
		.Circle_Wrap{width:6%;margin-left:2%;display:inline-block;position:relative;}
		.Circle_Wrap:first-child{margin-left:30%}
		.Circle_Wrap:before{display: block;margin-top: 100%;content: "";}
		.Circle_Fill, .Circle_Border{border:3px solid #747474;border-radius:50%;position:absolute;top:0;left:0;right:0;bottom:0;border-top:1px solid gray;border-right:1px solid gray;}
		.Circle_Fill{background-color:#747474;}
		/*
		@media screen and (max-width:600px)
		{
			#LoginDial_Block,#POS_LoginInp_Block{width:100%}
		
		}
		
		@media screen and (min-width:601px)
		{
			#POS_LoginInp_Block{width:50%;margin-right:5%}
			#Dial_LoginBox{max-width:300px;min-height:50px;line-height:50px;}
			#LoginDial_Block{width:40%}
			#Dial_LoginBox{position:absolute;left:50%;top:50%;}
			
			
			
			
			
		}
		*/
</style>
<script type="text/javascript">
	$(document).ready(function(){
		
		
		$("#Dial_LoginBox_Display").fadeIn(1000);
		$( window ).resize(function(){
			resizePG();
		});
		resizePG();
		
		//e.preventDefault();

		
		$(document).on('touchstart click','.Dial',function(){
			
			var maxPass = 6;
			
			if($(this).prop("id") == "Dial_Reload")
			{
				$("#Dial_LoginBox").val("");
			}
			else if($(this).prop("id") == "Dial_Enter")
			{
				$.ajax({
					type: "POST",
					url: "/login-pos/?ajaxProcess",
					data: "menu=loginRequest&P="+encodeURIComponent($("#Dial_LoginBox").val())+"&loginPS="+encodeURIComponent($("#Dial_LoginBox").val())+"&loginTK="+encodeURIComponent($("#loginTK").val())+"&loginST="+encodeURIComponent($("#loginST").val()),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							location.href = res.redirect;
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_1');
					}
				});
				
				
				
			}
			else
			{
			
				
				if(maxPass > $("#Dial_LoginBox").val().length)
				{
					$("#Dial_LoginBox").val($("#Dial_LoginBox").val()+$(this).text());
				
				}
			}
			
			
			$("#Dial_LoginBox_Display").html("");
			for(var i = 0;i < $("#Dial_LoginBox").val().length;i++)
			{
				$("#Dial_LoginBox_Display").append('<div class="Circle_Wrap"><div class="Circle_Fill"></div></div>');
			}
			
			for(var i = $("#Dial_LoginBox").val().length;i < maxPass;i++)
			{
				$("#Dial_LoginBox_Display").append('<div class="Circle_Wrap"><div class="Circle_Border"></div></div>');
			}
		});
	});
	
	
	
	function resizePG()
	{
		
		/*
		 *
		 **/
		var W_h = $(window).height();
		
		//$("#POS_LoginInp_Block").css("height",W_h+"px");
		
		
		
		$(".Dial").each(function(){
			
			$(this).css("line-height",$(this).height()+"px");
			
		
			
		
			
			
		});
		
		$(".Dial").flowtype({
			fontRatio : 2
		});
		
	}

	function refreshPage(ForceRefresh, KeepPlay, RefreshOnly)
	{
		var argv = '';
		argv += "&Page=";
		
		/*
		if(getHash()['Inbound'] != undefined)
		{
			argv += "&Menu=Inbound";
			
		}
		
		*/
		$.ajax({
			type: "POST",
			url: "/?ajaxProcess",
			data: "menu=refreshPage"+argv,
			success: function(d){
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					$("#OrderList_Row").html(res.OrderList);
				}
				else if(res.error_msg != undefined && res.error_msg != "")
					showSideMSGBox(res.error_msg,'msgBox_One_1');
			}
		});

	}
</script>
<div id="POS_Login_Block">
	<div id="POS_LoginInp_Block">
		<div id="Dial_LoginBox_Display">
			
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
			<div class="Circle_Wrap">
				<div class="Circle_Border"></div>
			</div>
		</div>
		<input type="password" maxlength="6" id="Dial_LoginBox" />
		<input type="hidden" name="loginTK" id="loginTK" value="<?echo $this->tok['loginTK'];?>" />
		<input type="hidden" name="loginST" id="loginST" value="<?echo $this->tok['loginST'];?>" />
	</div>
	<div id="LoginDial_Block">
		
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_1">1</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_2">2</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_3">3</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_4">4</div>
		</div>
		<div class="Dial_Wrap clearL">	
			<div class="noSelect Dial" id="Dial_5">5</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_6">6</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_7">7</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_8">8</div>
		</div>
		<div class="Dial_Wrap clearL">
			<div class="noSelect Dial" id="Dial_9">9</div>
		</div>
		<div class="Dial_Wrap">
			<div class="noSelect Dial" id="Dial_0">0</div>
		</div>
		<div class="Dial_Wrap">	
			<div class="noSelect Dial" id="Dial_Reload">&#x21bb;</div>
		</div>
		
		<div class="Dial_Wrap">	
			<div class="noSelect Dial" id="Dial_Enter">&ldsh;</div>
		</div>
		
	</div>
</div>