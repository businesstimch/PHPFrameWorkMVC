<script type="text/javascript">
	
	var LoginRefresh = false;
	$(document).ready(function(){
		TopMenu.init();
		Chat.init();
		
		$(document).on(touchOrClick,"#Helper_Link",function(){
			$("#Slide_4").click();
		});
		
		
		$("#Login_Frm").GGoRokForm({
			'AfterClickSubmit' : function(){
				$("#Login_Btn").html("<?php echo $this->_Lang_www_inc_lefttab['login_inprocess'];?>");
			},
			'OnError' : function(){
				$("#Login_Btn").html("<?php echo $this->_Lang_www_inc_lefttab['login'];?>");
			},
			'Completed' : function(res){

				$("#Login_Btn").html("<?php echo $this->_Lang_www_inc_lefttab['login'];?>");
				if(res.ack == 'success')
				{
					$(".customerName").text(res.customerName);
					$("#Dialog_LogIn").slideUp(500);
					$("#Dialog_AfterLogin").slideDown(500);
					showSideMSGBox("<i class='fa fa-user'></i> <?php echo $this->_Lang_www_inc_lefttab['login_completed'];?>","msgBox_One_1");
					location.reload();
				}
				else if (res.ack == 'error' && typeof res.error_msg != "undefined" && res.error_msg != "")
				{
					showSideMSGBox("<i class='fa fa-user'></i> "+res.error_msg,"msgBox_One_2");
				}
			}
			
		});
		
		$("#Register_Frm").GGoRokForm({	
			'Validate' : function(){
				
				var Validation_Result = true;
				if($("#Reg_Pass_INP").val() != $("#Reg_PassCofm_INP").val())
				{
					showSideMSGBox("<i class='fa fa-user'></i> <?php echo $this->_Lang_www_inc_lefttab['wrong_password'];?>","msgBox_One_1");
					$("#Reg_Pass_INP,#Reg_PassCofm_INP").addClass("Warning");
					Validation_Result = false;
				}
				else if ($("#Reg_Pass_INP").val().length < 4) {
					showSideMSGBox("<i class='fa fa-user'></i> <?php echo $this->_Lang_www_inc_lefttab['minimum_password'];?>","msgBox_One_1");
					$("#Reg_Pass_INP,#Reg_PassCofm_INP").addClass("Warning");
					Validation_Result = false;
				}
				
				return Validation_Result;
			},
			'Completed' : function(res){
				if(res.ack == 'success')
				{
					showSideMSGBox("<i class='fa fa-user'></i> <?php echo $this->_Lang_www_inc_lefttab['register_completed'];?>","msgBox_One_1");
					$(".LD_One").slideUp(500);
					$("#Dialog_LogIn").slideDown(500);
				}
				else if (res.ack == 'error' && typeof res.error_msg != "undefined" && res.error_msg != "")
				{
					showSideMSGBox("<i class='fa fa-user'></i> "+res.error_msg,"msgBox_One_2");
				}
			}
		});
		$(document).on(touchOrClick,".logoutBTN",function(){
			$.ajax({
				type: "POST",
				url: "/global/www/Login?ajaxProcess",
				data: "menu=Logout",
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
						location.href = '/';
				}
			});
		});
		
	});
	
	var Common = new function(){
		this.loginRequired = function(){
			TopMenu.OpenDialog($("#Login_Dialog"));
			showSideMSGBox('<i class="fa fa-info"> 로그인이 필요한 서비스 입니다.','msgBox_One_2');
		};
	};
	var Chat = new function(){
		
		
		
		this.init = function(){
			var self = this;
			
			/* Register Pulling Action*/
			Pull.registerAction(function(nT){
				if(nT == 1)
				{
					playSound(1);
					showSideMSGBox("<i class='fa fa-commenting'></i> <?php echo $this->_Lang_www_inc_lefttab['new_message'];?>","msgBox_One_1");
					self.renewData({
						"doRenewData" : false /* Tim : To prevent duplicated calls */
					});
				}
			});
			
			$(document).on(touchOrClick,".COMM_Chat",function(){
				var obj = $(this);
				
				self.createNewChat({
					"cid" : obj.parents('.CardOnMap').data('cid')
				});
				
				
			});
			
			$(document).on(touchOrClick,".CBTM_Close_Btn",function(){
				self.closeChat($(this).parents('.ChattingBox'));
			});
			
			
			$(document).on('keyup',".CBB_ChatInp_Box textarea",function(e){
				
				var chathash = $(this).parents('.ChattingBox').data('chathash');
				if(e.which == 13)
				{
					if(e.shiftKey)
					{
						
					}
					else
					{
						self.SendMessage({
							'chathash' : chathash
						});
						
					}
				}
				
			});
		};
		
		this.openChat = function(){
			
			
			$('.ChattingBox').each(function(){
				if($(this).css('display') == 'none')
				{
					var Obj = $(this);
					var Height = $(this).height();
					$(this).css('height','0px').show(0);
					$(this).animate({
						'height' : Height+'px'
					},{
						duration : 1500,
						specialEasing: {
						  width: "linear",
						  height: "easeOutBounce"
						},
						complete: function(){
							Obj.scrollTop(Obj.find('.CB_Stage').prop('scrollHeight'));
							
						}
					});
				}
			});
		};
		this.closeChat = function(Obj){
			Obj.animate({
				'height' : '0px'
			},1000, function(){
				$(this).remove();
			});
		};
		
		this.renewData = function(Data){
			var self = this;
			$.ajax({
				type: "POST",
				url: "/global/www/Chat?ajaxProcess",
				data: "menu=RenewData&args="+JSON.stringify(self.getCurrentStatus()),
				success: function(d){
					var res = $.parseJSON(d);
					
					if(res.ack == 'success')
					{
						
						for (var chathash in res.chat)
						{
							if (res.chat.hasOwnProperty(chathash))
							{
								var ChatBoxObj = $('.ChattingBox[data-chathash="'+chathash+'"]');
								
								if(ChatBoxObj.length == 0)
								{
									self.createNewChat({
										"to" : "test",
										"to-img" : 'test',
										"chathash" : chathash,
										"doRenewData" : ("Data" in window && "doRenewData" in Data ? Data['doRenewData'] : true),
									});
									ChatBoxObj = $('.ChattingBox[data-cid="'+chathash+'"]');
								}
								
								for (var chatone in res.chat[chathash])
								{
									if (res.chat[chathash].hasOwnProperty(chatone))
									{
										/* Me */
										if(res.chat[chathash][chatone]['T'] == 0)
										{
											
											ChatBoxObj.find('.CB_Stage_Contents').append(self.MeHTML({
												'chid' : res.chat[chathash][chatone]['chid'],
												'Message' : res.chat[chathash][chatone]['M'],
												'T' : res.chat[chathash][chatone]['TS']
											}));
										}
										else
										{
											ChatBoxObj.find('.CB_Stage_Contents').append(self.OpponentHTML({
												'chid' : res.chat[chathash][chatone]['chid'],
												'Message' : res.chat[chathash][chatone]['M'],
												'T' : res.chat[chathash][chatone]['TS']
											}));
											
										}
										
										if(ChatBoxObj.data('lastid') < res.chat[chathash][chatone]['chid'])
										{
											ChatBoxObj.data('lastid',res.chat[chathash][chatone]['chid']);
										}
									}
									
								}
								
								
								self.ScrollBottom(ChatBoxObj.find('.CB_Stage'));
								
							}
							
						}
						
						if("setting" in res)
						{
							$(".ChattingBox").each(function(){
								var chathash = $(this).data('chathash');
								
								
								if(typeof res.setting[chathash] != "undefined")
								{
									$(this).find('.CBT_Img').html((res.setting[chathash]['Box']['I'] == null ? '<i class="fa fa-user"></i>' : '<img src="/Template/Img/CData/'+res.setting[chathash]['Box']['I']+'" />'));
									$(this).find('.CBT_Name').html(res.setting[chathash]['Box']['N']);
									
								}
								
							});
						}
						
						
						
					}
					
					self.openChat();
				}
			});
		};
		
		this.reSortChatStage = function(){
			
		};
		
		this.getCurrentStatus = function(){
			var output = {};
			
			$(".ChattingBox").each(function(){
				output[encodeURIComponent($(this).data('chathash'))] = $(this).data('lastid');
			});
			return output;
			
		};
		this.ScrollBottom = function(StageWrapObj){
			StageWrapObj.scrollTop(StageWrapObj.prop("scrollHeight"));
		};
		this.SendMessage = function(Data){
			var self = this;
			var ChatboxObj = $('.ChattingBox[data-chathash="'+Data['chathash']+'"]');
			var StageWrapObj = ChatboxObj.find('.CB_Stage');
			var StageObj = ChatboxObj.find('.CB_Stage_Contents');
			var Message = ChatboxObj.find('.CBB_ChatInp_Box textarea').val().trim();
			
			ChatboxObj.find('.CBB_ChatInp_Box textarea').val("");
			if(Message != "")
			{
				var args = {
					'M' : Message,
					'chathash' : encodeURIComponent(Data['chathash'])
				};
				
				$.ajax({
					type: "POST",
					url: "/global/www/Chat?ajaxProcess",
					data: "menu=Send&args="+JSON.stringify(args),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							ChatboxObj.find('.CB_Stage_Contents').append(self.MeHTML({
								'chid' : res.chid,
								'Message' : Message,
								'T' : res.T
							}));
							
							if(ChatboxObj.data('lastid') < res.chid)
							{
								ChatboxObj.data('lastid',res.chid);
							}
							
							self.ScrollBottom(StageWrapObj);
						}
					}
				});
				
			}
			
			
			
		};
		
		this.MeHTML = function(Data){
			var HTML = '';
			
			HTML =
				'<div class="CD_Me CD_Msg_One" data-chid='+Data['chid']+'>'+
					'<div class="CDF_Msg">'+Data['Message']+'<div class="CDF_TS">'+Data['T']+'</div></div>'+
				'</div>'
			;
			
			
			return HTML;
		};
		
		this.OpponentHTML = function(Data){
			var HTML = '';
			
			HTML =
				'<div class="CD_Opponent CD_Msg_One" data-chid='+Data['chid']+'>'+
					'<div class="CDF_Img"><i class="fa fa-user"></i></div>'+
					'<div class="CDF_Msg">'+Data['Message']+'<div class="CDF_TS">'+Data['T']+'</div></div>'+
				'</div>'
			;
			
			
			return HTML;
		};
		
		this.createNewChat = function(Data){
			var self = this;
			
			if(typeof Data['doRenewData'] == 'undefined')
				Data['doRenewData'] = true;
			
			if("chathash" in Data)
			{
				var NewChatBoxObj = $('.ChattingBox[data-chathash="'+Data.chathash+'"]');
				if(NewChatBoxObj.length == 0)
				{
					$('body').append(self.ChatHTML(Data));
				}
				
				if(Data['doRenewData'])
					self.renewData();
			}
			else
			{
				$.ajax({
					type: "POST",
					url: "/global/www/Chat?ajaxProcess",
					data: "menu=generateChatHash&cID="+Data['cid']+'&ChatInfo=1',
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							
							var NewChatBoxObj = $('.ChattingBox[data-chathash="'+res.chathash+'"]');
							if(NewChatBoxObj.length == 0)
							{
								Data['chathash'] = res.chathash;
								$('body').append(self.ChatHTML(Data));
							}
							
							if("setting" in res)
							{
								$(".ChattingBox").each(function(){
									var chathash = $(this).data('chathash');
									
									
									if(typeof res.setting[chathash] != "undefined")
									{
										$(this).find('.CBT_Img').html((res.setting[chathash]['Box']['I'] == null ? '' : '<img src="/Template/Img/CData/'+res.setting[chathash]['Box']['I']+'" />'));
										$(this).find('.CBT_Name').html(res.setting[chathash]['Box']['N']);
										
									}
									
								});
							}
							
							if(Data['doRenewData'])
								self.renewData();
						}
						else if('err_code' in res)
						{
							if(res.err_code == 1)
								Common.loginRequired();
						}
					}
				});
			}
			
			
			
				
			
		};
		
		
		this.ChatHTML = function(Data){
			var self = this;
			var Total_ChattingBox = $('.ChattingBox').length;
			var Style = {};
			var MarginR = 50;
			var StartPosition = ($(".ChattingBox").length > 0 ? 20 : 0 );
			var ChattingBox_Size = ($(".ChattingBox").length > 0 ? $(".ChattingBox").outerWidth() : 0 );
			


			
			Style = {
				'right' : (StartPosition * (Total_ChattingBox )) + ( ChattingBox_Size * Total_ChattingBox ) + MarginR
			};
			/*console.log( ( Style['right'] + ChattingBox_Size ),$(window).outerWidth());*/

			var HTML =
				'<div class="ChattingBox" style="right:'+Style['right']+'px" data-lastid="-1" data-chathash="'+Data['chathash']+'">'+
					'<div class="CB_Title">'+
			 			'<div class="CBT_Img"><img src="'+Data['to-img']+'" /></div>'+
			 			'<div class="CBT_Name">'+Data['to']+'</div>'+
						'<div class="CBT_Menu">'+
							'<div class="CBTM_One CBTM_Close_Btn"><i class="fa fa-close"></div>'+
						'</div>'+
			 		'</div>'+
			 		'<div class="CB_Stage">'+
						'<div class="CB_Stage_Contents">'+
						'</div>'+
					'</div>'+
			 		'<div class="CB_Bottom">'+
			 			'<div class="CBB_ChatInp_Box"><textarea placeholder="<?php echo $this->_Lang_www_inc_lefttab['insert_message'];?>"></textarea></div>'+
			 		'</div>'+
			 '</div>'
			;
			
			return HTML;
		};
		
	};
	var TopMenu = new function(){
		
		this.init = function(){
			var self = this;
			
			$(document).on(touchOrClick,".Top_Menu_One",function(){
				if($(this).hasClass('Top_Menu_Selected'))
					$(".Top_Menu_One").removeClass('Top_Menu_Selected');
				else
				{
					$(".Top_Menu_One").removeClass('Top_Menu_Selected');
					$(this).addClass('Top_Menu_Selected');
				}
			});
			$(document).on(touchOrClick,".Top_Menu_One",function(){
				if(typeof $(this).data('dialogid') != "undefined")
				{
					var Obj = $("#"+$(this).data('dialogid'));
					if(Obj.css('display') == 'block')
						self.CloseDialog(Obj);
					else
					{
						$(".Top_Dialog").fadeOut(500);
						self.OpenDialog(Obj);
					}
				}
			});
			
			$(document).on(touchOrClick,"#GoRegister_BTN",function(){
				$(".LD_One").slideUp(500);
				$("#Dialog_Register").slideDown(500);
			});
			
			$(document).on(touchOrClick,"#GoBackToLogin_BTN",function(){
				$(".LD_One").slideUp(500);
				$("#Dialog_LogIn").slideDown(500);
			});
			
			$(document).on(touchOrClick,".Close_Dialog",function(){
				self.CloseDialog($(this).parents('.Top_Dialog'));
			});
		};
		
		this.OpenDialog = function(Obj){
			Obj.fadeIn(500);
		};
		
		this.CloseDialog = function(Obj){
			Obj.fadeOut(500);
			$('.Top_Menu_One[data-dialogid="'+Obj.prop('id')+'"]').removeClass('Top_Menu_Selected');
		};
	};
	
</script>
<style type="text/css">
	#Left_Tab_Logo{width:100%;height:85px;background:#303030 url('/Template/Img/Burugo-LeftTab-Logo.png');background-position:50% 50%;display:block;float:left;}
	#Left_Tab_Logo:hover{background:#212121 url('/Template/Img/Burugo-LeftTab-Logo.png');background-position:50% 50%;}
	#Left_Tab{position:fixed;left:0;top:0;bottom:0;background-color:black;width:85px;z-index:1000;}
	#Left_Tab .LTab_One{width:85px;height:70px;cursor:pointer;margin-bottom:1px;text-align:center;color:#575757;border-bottom:1px solid #232323;}
	#Left_Tab .LTab_One i{line-height:70px;margin:0;font-size:23px;}
	#Left_Tab .LTab_One:hover i{line-height:normal;margin-top:12px;margin-bottom:2px;font-size:30px;}
	#Left_Tab .LTab_One:hover span{display:inline;}
	#Left_Tab .LTab_One span{display:none;font-size:12px;}
	#Left_Tab .LTab_Bottom{position:absolute;bottom:0;left:0;}
	#Left_Tab .Activated span{display:inline;}
	#Left_Tab .Activated{background-color:white;color:#000;}
	#Left_Tab .Activated:hover{color:#000;}
	#Left_Tab .Activated i{line-height:normal;margin-top:12px;margin-bottom:2px;font-size:30px;}
	
	
	#Left_Tab .LTab_Bottom_One{width:85px;height:70px;cursor:pointer;margin-bottom:1px;text-align:center;color:#575757;border-bottom:1px solid #232323;display:block;float:left;}
	#Left_Tab .LTab_Bottom_One i{line-height:45px;margin:0;font-size:23px;}
	
	#CEO_Link:hover{color:#00b3ff;}
	#News_Link:hover{color:#fac31d;}
	#Helper_Link:hover{color:#45e7a8;}
	#Friend_Link:hover{color:#3086f0;}
	
	
	#Left_Tab a.LTab_One{display:block;float:left;}
	#Left_Tab #LoginDialog_BTN{border-left:0;width:100%;}
	#Left_Tab .Activated{opacity:1.0!important;}
	.LD_One{min-width:130px;}
	
	
	.Top_Dialog{display:none;background-color:#2f2f2f;padding:40px 0 40px 0;position:absolute;top:60px;left:105px;z-index:100;border-radius:10px;}
	.Top_Dialog .Close_Dialog{position:absolute;right:0;top:0;color:#575757;font-size:20px;padding:10px;cursor:pointer;}
	.Top_Dialog .Close_Dialog:hover{color:#ff6c00;}
	.Top_Dialog .LD_Arrow{width:0;height:0;border-right: 10px solid transparent;border-left: 10px solid transparent;border-bottom:18px solid #2f2f2f;position:absolute;top:-17px;}
	
	#Chat_Dialog{left:105px;width:400px;}
	#Chat_Dialog .LD_Arrow{left:117px;}
	#Chat_Dialog .ChatHistory_Block{width:100%;min-height:200px;max-height:400px;overflow:auto;}
	#Chat_Dialog .CHistory_One{width:100%;line-height:70px;height:70px;border-bottom:1px dotted gray;color:#f2f2f2;cursor:pointer;position:relative;}
	#Chat_Dialog .CHistory_One:hover{background-color:#1a1a1a;}
	#Chat_Dialog .CHO_Pic{border-radius:50%;height:50px;width:50px;margin-top:10px;margin-left:10px;background-color:#575757;margin-right:10px;}
	#Chat_Dialog .CHO_LastMsg{width:240px;height:100%;}
	#Chat_Dialog .CHO_LastMsg .CHO_Name{width:100%;height:20px;line-height:20px;font-weight:bold;margin-top:5px;font-size:15px;margin-top:10px;}
	#Chat_Dialog .CHO_LastMsg .CHO_Msg{width:100%;height:20px;line-height:20px;margin-bottom:5px;}
	#Chat_Dialog .CHO_Date{font-size:12px;clear:both;line-height:20px;height:20px;width:100%;text-align:right;margin-top:10px;}
	#Chat_Dialog .CHO_Count{line-height:20px;height:20px;background-color:#ff6c00;text-align:center;width:30px;line-height:20px;border-radius:10px;float:right;margin-top:11px;}
	#Chat_Dialog .CHO_Right{width:60px;height:100%;position:absolute;right:5px;top:0;}
	#Login_Dialog{left:105px;width:250px;}
	#Login_Dialog .LD_Arrow{left:77px;}
	#Login_Dialog .LD_One{width:100%;text-align:center;}
	#Login_Dialog p,#Login_Dialog span{color:white;}
	#Login_Dialog .LD_One .DL_Header{color:white;margin-bottom:24px;font-size:25px;}
	#Login_Dialog .LD_One input{border-radius:4px;padding:5px;box-sizing:border-box;font-size:15px;}
	#Login_Dialog .LD_One button{border:1px solid #d5d5d5;border-radius:5px;padding:9px 0 9px 0;background-color:transparent;color:white;font-size:20px;width:100%;margin-bottom:15px;cursor:pointer;}
	#Login_Dialog .LD_One button:hover{border:1px solid #ff6c00;color:#ff6c00;}
	#Login_Dialog .INP{width:190px;height:30px;border:0;border:1px solid transparent;}
	#Login_Dialog .INP:focus{background-color:#ffe9b3;border:1px solid white;}
	#Login_Dialog #LogInPASS_INP{margin-bottom:27px;!important}
	#Login_Dialog #Dialog_Register{display:none;}
	#Login_Dialog .DL_chkBx{margin-bottom:27px;width:100%;text-align:left;}
	#Login_Dialog .INP{margin-bottom:15px;}
	#Login_Dialog #profilePic_BG{width:100px;height:100px;border-radius:50px;background-color:#575757;color:#2b2b2b;display:inline-block;margin-bottom:20px;text-align:center;font-size:50px;line-height:100px;float:none;}
	
	#Login_Dialog .LD_One{padding-left:20px;padding-right:20px;box-sizing:border-box;}
	#Login_Dialog <?php echo ($this->login->isLogIn() ? '#Dialog_LogIn' : '#Dialog_AfterLogin' )?>{display:none;}
	#Login_Dialog #Dialog_AfterLogin{color:white;}
	#Login_Dialog #Dialog_AfterLogin .customerName{font-size:28px;}
	#Login_Dialog #Dialog_AfterLogin p{line-height:25px;margin-bottom:21px;}
	#Login_Dialog #Dialog_AfterLogin .afterCustomerName{font-size:19px;}
	#Login_Dialog #Dialog_AfterLogin .bottomIcn{margin-right:10px;font-size:15px;cursor:pointer;}
	#Login_Dialog #Dialog_AfterLogin .bottomIcn:hover{color:#ff6c00;}
	#Login_Dialog #Dialog_AfterLogin a{color:white;}
	
	#Top_Menu{left:85px;right:0;top:0;position:absolute;height:40px;background-color:#303030;z-index:50;line-height:40px;}
	#Top_Menu .Top_Menu_One{width:40px;height:40px;color:white;text-align:center;margin-right:1px;background-color:#464646;display:block;float:left;font-size:18px;cursor:pointer;}
	#Top_Menu .Top_Menu_One:hover{margin-right:5px;background-color:#626262;}
	#Top_Menu .Top_Menu_Selected{background-color:#626262;}
	
	
	.CenterMsg{width:100%;text-align:center;color:white;width:100%;}
	
	<?php
	if(_SubDomain_ == 'www')
	{
		?>
		#Left_Tab .Activated{background-color:#ff6c00;color:black!important;}
		#Left_Tab .LTab_One:hover{color:white;}
		<?
	}
	else if(_SubDomain_ == 'news')
	{
		?>
		#Left_Tab .Activated{background-color:#e7bb45;color:black!important;}
		#Left_Tab .LTab_One:hover{color:#e7bb45;}
		<?
	}
	else if(_SubDomain_ == 'ceo')
	{
		?>
		#Left_Tab .Activated{background-color:#00b3ff;color:black!important;}
		#Left_Tab .LTab_One:hover{color:#00b3ff;}
		<?
	}
	else if(_SubDomain_ == 'friend')
	{
		?>
		#Left_Tab .Activated{background-color:#2792ff;color:black!important;}
		#Left_Tab .LTab_One:hover{color:#2792ff;}
		<?
	}
	else if(_SubDomain_ == 'helper')
	{
		?>
		#Left_Tab .Activated{background-color:#ffc937;color:black!important;}
		#Left_Tab .LTab_One:hover{color:#ffc937;}
		<?
	}
	
	?>
	
</style>
<div id="Top_Menu">
	<a href="<?echo __DocumentRoot__;?>" data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['home'];?>" class="Top_Menu_One Glow <?php echo ($PG == 'Home'? "Activated":"");?>" style="margin-left:45px;"><i class="fa fa-home"></i></a>
	<div id="LoginDialog_BTN" data-dialogid="Login_Dialog" data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['login_info'];?>" class="Top_Menu_One Glow"><i class="fa fa-user"></i></div>
	<div class="Top_Menu_One Glow" data-dialogid="Chat_Dialog" data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['message'];?>"><i class="fa fa-commenting"></i></div>
	<a href="<?echo __DocumentRoot__;?>Setting" data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['setting'];?>" class="Top_Menu_One Glow"><i class="fa fa-gear"></i></a>
	
</div>
<div id="Left_Tab">
	<a href="<?php echo __SSL__.'www.'.__domain__;?>" class="Glow" id="Left_Tab_Logo"></a>
	
	<?php
	if(_SubDomain_ == 'www')
	{
	?>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-search"></i><span><br /><?php echo $this->_Lang_general['search'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>AroundMe" class="noSelect LTab_One Glow <?php echo ($PG == 'AroundMe'? "Activated":"");?>"><i class="fa fa-male"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['around_me'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>Favorite" class="noSelect LTab_One Glow <?php echo ($PG == 'Favorite'? "Activated":"");?>"><i class="fa fa-newspaper-o"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['burume_book'];?></span></a>
	<?php
	}else if(_SubDomain_ == 'friend'){
	?>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-home"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['friend_home'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>card" class="noSelect LTab_One Glow <?php echo ($PG == 'card'? "Activated":"");?>"><i class="fa fa-newspaper-o"></i><span><br />프렌드 카드</span></a>
	<?php
	}
	
	else if(_SubDomain_ == 'helper'){
	?>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-home"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['helper_home'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'Chat'? "Activated":"");?>"><i class="fa fa-commenting-o"></i></a>
		
	
	<?php
	}else if(_SubDomain_ == 'ceo'){
	?>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-home"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['ceo_home'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>dashboard" class="noSelect LTab_One Glow <?php echo ($PG == 'Dashboard'? "Activated":"");?>"><i class="fa fa-pie-chart"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['dashboard'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'dd'? "Activated":"");?>"><i class="fa fa-commenting-o"></i></a>
	<!--
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'dd'? "Activated":"");?>"><i class="fa fa-shopping-cart"></i></a>
	<a href="<?echo __DocumentRoot__;?>" class="noSelect LTab_One Glow <?php echo ($PG == 'dd'? "Activated":"");?>"><i class="fa fa-question-circle"></i></a>
	-->
	<?php
	}
	
	else if(_SubDomain_ == 'news'){
	?>
	<a href="<?echo __DocumentRoot__;?>" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Home'? "Activated":"");?>"><i class="fa fa-search"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['new_search'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>Domestic" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Domestic'? "Activated":"");?>"><i class="fa fa-microphone"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['domestic_news'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>Global" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'Global'? "Activated":"");?>"><i class="fa fa-globe"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['global_news'];?></span></a>
	<a href="<?echo __DocumentRoot__;?>MemberNews" class="LTab_One LTab_Scroll Glow <?php echo ($PG == 'MemberNews'? "Activated":"");?>"><i class="fa fa-group"></i><span><br /><?php echo $this->_Lang_www_inc_lefttab['members_news'];?></span></a>
		
	<?php
	}
	?>
	<div class="LTab_Bottom">
		
		<?php if(_SubDomain_ != 'ceo'){?>
			<a href="<?echo __HTTPceo__;?>" id="CEO_Link" alt="Burugo CEO" class="noSelect LTab_Bottom_One Glow"><i class="fa fa-building"></i><span><br /><?php echo $this->_Lang_general['business'];?></span></a>
		<?php } ?>
		
		<?php if(_SubDomain_ != 'friend'){?>
			<a href="<?echo __HTTPfriend__;?>" id="Friend_Link" alt="Burugo CEO" class="noSelect LTab_Bottom_One Glow"><i class="fa fa-users"></i><span><br /><?php echo $this->_Lang_general['friend'];?></span></a>
		<?php } ?>
		
		<?php if(_SubDomain_ != 'helper'){?>
			<a href="<?echo __HTTPhelper__;?>" id="Helper_Link" alt="Burugo CEO" class="noSelect LTab_Bottom_One Glow"><i class="fa fa-phone"></i><span><br /><?php echo $this->_Lang_general['helper'];?></span></a>
		<?php } ?>
		
		<?php if(_SubDomain_ != 'news'){?>
			<a href="<?echo __HTTPnews__;?>" id="News_Link" alt="Burugo CEO" class="noSelect LTab_Bottom_One Glow"><i class="fa fa-microphone"></i><span><br /><?php echo $this->_Lang_general['news'];?></span></a>
		<?php } ?>
		
	</div>
	
	<div id="Login_Dialog" class="Top_Dialog">
		<div class="LD_Arrow"></div>
		<div class="Close_Dialog"><i class="fa fa-close"></i></div>
		<div id="Dialog_LogIn" class="LD_One">
			<p class="DL_Header"><?php echo $this->_Lang_www_inc_lefttab['login'];?></p>
			<form id="Login_Frm" action="/global/www/Login?ajaxProcess" data-menu="loginRequest" data-callback="AJAX_Register">
				<div id="profilePic_BG"><i class="fa fa-user"></i></div>
				<input data-must type="text" id="LogInID_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['email'];?>" />
				<input data-must data-submitenter type="password" id="LogInPASS_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['password'];?>" />
				<input data-must type="hidden" id="loginTK" value="<?php echo $this->login->tok['loginTK']?>" />
				<input data-must type="hidden" id="loginST" value="<?php echo $this->login->tok['loginST']?>" />
				
				
				<button id="Login_Btn" data-type="Submit" type="button" class="Glow"><?php echo $this->_Lang_www_inc_lefttab['login'];?></button>
			</form>	
			
			<button id="GoRegister_BTN" type="button" class="Glow"><?php echo $this->_Lang_www_inc_lefttab['register'];?></button>
			
		</div>
		<div id="Dialog_AfterLogin" class="LD_One">
			<div id="profilePic_BG"><i class="fa fa-user"></i></div>
			<p><span class="customerName"><?php echo ($this->login->customer['customers_fullname'] != null && $this->login->customer['customers_fullname'] != "" ? $this->login->customer['customers_fullname'] : $this->login->customer['customers_firstname'].$this->login->customer['customers_lastname']);?></span> <span class="afterCustomerName"><?php echo $this->_Lang_www_inc_lefttab['welcome'];?></span></p>
			<i data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['notification'];?>" class="Glow fa fa-bell bottomIcn"></i>
			<i data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['message'];?>" class="Glow fa fa-envelope bottomIcn"></i>
			<i data-tooltip="<?php echo $this->_Lang_www_inc_lefttab['logout'];?>" class="Glow logoutBTN fa fa-sign-out bottomIcn" style="margin-right:0;"></i>
		</div>
		<div id="Dialog_Register" class="LD_One">
			<p class="DL_Header"><?php echo $this->_Lang_www_inc_lefttab['register'];?></p>
			<form id="Register_Frm" action="/global/www/Register?ajaxProcess" data-menu="registerRequest" data-callback="AJAX_Register" data-confirmtitle="<?php echo $this->_Lang_general['confirm'];?>" data-confirm="<?php echo $this->_Lang_www_inc_lefttab['wanna_register'];?>">
				<div class="w100">
					<input data-must type="text" id="Reg_EmailAddr_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['email'];?>" />
					<input data-must type="text" id="Reg_FullName_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['name'];?>" />
					<input data-must type="password" id="Reg_Pass_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['password'];?>" />
					<input data-must type="password" id="Reg_PassCofm_INP" class="Glow INP" placeholder="<?php echo $this->_Lang_general['password_confirm'];?>" />
				</div>
				<div class="w100 DL_chkBx">
					<p><input data-must id="Reg_AgreeTermsCondition_INP" type="checkbox" /> <?php echo $this->_Lang_www_inc_lefttab['agree_terms'];?></p>
				</div>
				<div class="w100">
					<button data-type="Submit" type="button" id="RegisterSubmit_BTN" class="Glow"><?php echo $this->_Lang_www_inc_lefttab['lets_register'];?></button>
					<button type="button" id="GoBackToLogin_BTN" class="Glow"><?php echo $this->_Lang_www_inc_lefttab['goback'];?></button>
				</div>
			</form>
		</div>
	</div>
	
	<div id="Chat_Dialog" class="Top_Dialog">
		<div class="LD_Arrow"></div>
		<div class="Close_Dialog"><i class="fa fa-close"></i></div>
		<div class="ChatHistory_Block">
			<?php
			if($this->login->isLogIn())
			{
				$Model['Chat'] = $this->Load->Model("Chat");
				$Controller['Chat'] = $this->Load->Controller("www/Chat");
				
				$ChatRooms = $Model['Chat']->getChatMembersID(array('customers_id' => $this->login->customers_id));
				if(sizeof($ChatRooms) > 0)
				{
					foreach($ChatRooms AS $ChatRooms_F)
					{
						
						$ChatInfo = $Model['Chat']->getChatSummaryByMembersID(array('Chat_Members_ID' => $ChatRooms_F));
						if(sizeof($ChatInfo) > 0)
						{
							echo
								'<div class="CHistory_One Glow noSelect">
									<div class="CHO_Pic"></div>
									<div class="CHO_LastMsg">
										<div class="CHO_Name">'.$ChatInfo[0]['Message'].'</div>
										<div class="CHO_Msg">'.$ChatInfo[0]['Message'].'</div>
										
									</div>
									<div class="CHO_Right">
										
										<div class="CHO_Date">1:25 AM</div>
										<div class="CHO_Count">1</div>
									</div>
								</div>';
						}
					}
				}
				else
				{
					echo '<div class="CenterMsg">'.$this->_Lang_www_inc_lefttab['nochat_todisplay'].'</div>';
				}
				
			}
			else
			{
				echo '<div class="CenterMsg">로그인이 필요한 서비스 입니다.</div>';
			}
			?>
			
			
		</div>
		
	</div>
</div>