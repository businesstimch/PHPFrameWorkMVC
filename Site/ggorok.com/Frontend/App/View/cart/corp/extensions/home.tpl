<style type="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;}
	#Extension_List{width:100%;margin-top:10px;}
	#Extension_List .Extension_One{width:100%;border-radius:5px;background-color:#f1f1f1;overflow:hidden;position:relative;}
	#Extension_List .Ext_Name{width:100%;box-sizing:border-box;padding-left:10px;cursor:pointer;line-height:40px;}
	#Extension_List .Ext_InstallStatus{line-height:40px;}
	#Extension_List .Ext_Name:hover{background-color:#e5e5e5;}
	#Extension_List .Ext_InstallStatus{background-color:#b2b2b2;height:40px;width:40px;float:right;color:white;font-size:1.3em;text-align:center;cursor:pointer;position:absolute;right:0;}
	#Extension_List .Ext_Installed{background-color:#309df1!important;}
	#Extension_List .Ext_Detail{width:100%;display:none;padding:10px;box-sizing:border-box;}
	#Extension_List .Extension_List_Opened{background-color:#d0eefb!important;}
	#Extension_List .Ext_Setting_One{width:100%;}
	#Extension_List .Ext_Setting_T{width:100%;}
	#Extension_List .Ext_Setting_D{width:100%;margin-top:10px;margin-bottom:10px;background-color:#e7e7e7;padding:20px;border-radius:10px;box-sizing:border-box;}
	#Extension_List .Ext_Setting_Check{text-align:center;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:10px;line-height:30px;border:1px solid white;border-radius:10px;background-color:#f6f6f6;margin-right:10px;}
	#Extension_List .Ext_Setting_Check_Activated{background-color:#e9615f!important;color:white;border:1px solid #c13330!important;}
	#Extension_List .Ext_Setting_Check button{
		border:1px solid #6e6e6e;
		background-color:#989898;
		color:white;
		padding:5px;border-radius:5px;box-shadow: 0px 1px 1px #d9d9d9;cursor:pointer;-webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
	}
	#Extension_List .Ext_Setting_Btns{width:100%;}
	#Extension_List .Ext_Setting_Btns .Ext_Setting_Save_Btn{border:1px solid white;background-color:#00a9ea;padding:5px;border-radius:10px;box-shadow: 0px 1px 1px #d9d9d9;cursor:pointer;color:white;padding-left:30px;padding-right:30px;padding-top:8px;padding-bottom:8px;float:right;}
	
</style>
<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on(touchOrClick,".Ext_Setting_Save_Btn",function(){
			var Obj = $(this).parents(".Extension_One");
			var Group = Obj.data('group');
			var Code = Obj.data('code');
			var Data;
			if(Group != "" && Code != "")
			{
				Obj.find(".Ext_Inp").each(function(){
					if(Data == undefined)
						Data = {};
						
					Data[$(this).data('name')] = ($(this).html() == $(this).data('off') ? encodeURIComponent($(this).data('value')) : '');
					
				});
				$.ajax({
					type: "POST",
					url: "/corp/extensions/?ajaxProcess",
					data: "menu=Ext_Command&method=_setting_save&Group="+encodeURIComponent(Group)+"&Code="+encodeURIComponent(Code)+"&Data="+JSON.stringify(Data),
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							showSideMSGBox("Saved Successfully.",'msgBox_One_1');
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
			}
		});
		$(document).on(touchOrClick,".Ext_Setting_Check button",function(){
			if($(this).data("on") == $(this).html())
			{
				$(this).addClass('Ext_Setting_Check_Activated');
				$(this).html($(this).data("off"));
			}
			else
			{
				$(this).removeClass('Ext_Setting_Check_Activated');
				
				$(this).html($(this).data("on"));
			}
		});
		
		
		$(document).on(touchOrClick,".Ext_Name",function(){
			var Obj = $(this).parents(".Extension_One").find(".Ext_Detail");
			if($(this).hasClass("Extension_List_Opened"))
			{
				
				$(this).removeClass("Extension_List_Opened");
				Obj.slideUp(500);
			}
			else
			{
				$(this).addClass("Extension_List_Opened");
				Obj.slideDown(500);
			}
		
		});
		$(document).on(touchOrClick,".Ext_InstallStatus",function(){
			var Msg_T,Msg_C,Menu,Argv;
			var Obj = $(this).parents(".Extension_One");
			Argv = "&Group="+Obj.data('group')+"&Code="+Obj.data('code');
			if($(this).data('installed') == 0)
			{
				Msg_T = "Confirm";
				Msg_C = "Do you want to <b>INSTALL</b> this extension?";
				Menu = "_install";
				
			}
			else
			{
				Msg_T = "Confirm";
				Msg_C = "Do you want to <b>UNINSTALL</b> this extension?";
				Menu = "_uninstall";
			}
			
			timconfirm(Msg_T,Msg_C,function(){
				$.ajax({
					type: "POST",
					url: "?ajaxProcess",
					data: "menu=Ext_Command&method="+Menu+Argv,
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							location.reload();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
			});
		
		});
		
	});
</script>

<h2 id="PG_Title"><i class="fa fa-folder-o"></i> Shipping Extensions</h2>
<div id="PG_Menu"></div>
<div id="PG_Contents">
	<div id="Extension_List">
		<?php echo $Extension_List;?>
	</div>
</div>