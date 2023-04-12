<style tyle="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;}
	
	.CT_Line_One{width:100%;margin-top:5px;margin-bottom:10px;}
	.CT_Line_One .CT_T{width:20%;text-align:right;line-height:30px;}
	.CT_Line_One .CT_T span{margin-right:15px;}
	.CT_Line_One .CT_T i{color:red;margin-right:3px;}
	.CT_Line_One .CT_I{width:80%;}
	.CT_Line_One .CT_I input,
	.CT_Line_One .CT_I textarea{box-sizing:border-box;width:100%;border:1px solid gray;padding:0;margin:0;border-radius:5px;padding:5px;}
	.CT_Line_One .CT_I input{height:30px;line-height:30px;}
	.CT_Line_One .CT_I textarea{height:150px;}
	
	.CatList_One{width:100%;background-color:#f7f7f7;line-height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;}
	.CatList_One:hover{background-color:#e6e6e6;}
	
	
	.CatList_One .changeOrder{width:35px;height:100%;position:absolute;left:0;top:0;text-align:center;color:#d0cece;cursor:all-scroll;}
	.CatList_One .changeOrder:before{content:"\f047";}
	.CatList_One .changeOrder:hover{color:#656565;}
	.List_Selected{background-color:#b0d6f3!important;}
	.List_Selected .changeOrder{color:white;}
	
	#CT_Tab{width:100%;height:100%;}
	#CT_Tab #CT_Tab_Menu{width:100%;height:30px;line-height:30px;border-bottom:1px solid #e7e7e7;margin-bottom:20px;}
	#CT_Tab .CT_Tab_One{padding-left:10px;padding-right:10px;margin-right:8px;border-radius:7px 7px 0 0;cursor:pointer;}
	#CT_Tab .CT_Tab_One:hover{background-color:#f2f2f2;}
	#CT_Tab .CT_Tab_Selected{border-left:1px solid #e7e7e7;border-top:1px solid #e7e7e7;border-right:1px solid #e7e7e7;background-color:white!important;}
	#CT_Tab .CT_Tab_Content_One{width:100%;display:none;}
	#GenerateSEOUrl_Btn{color:#309df1;text-decoration:normal;font-size:0.8em;text-decoration:underline;cursor:pointer;}
	.CatList_Block{width:100%;min-height:5px;}
	.error{background-color:#ffdbdb;}
	.CatList_Placeholder{margin-left:20px;width:100%;background-color:#f7f7f7;line-height:30px;height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;background-color:#ffeda6;}
	.CatList_Group{width:100%;padding-left:20px;box-sizing:border-box;border-left:1px dotted #c5c5c5;}
	.CatList_Group .fa-folder-open-o{margin-right:5px;}
	
	.foldMenu{width:35px;height:100%;line-height:30px;position:absolute;right:0;top:0;text-align:center;color:gray;cursor:pointer;}
</style>
<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on(touchOrClick,".CT_Tab_One",function(){
			var tabID = $(this).data("tabid");
			if($(".CT_Tab_Content_One[data-tabID="+tabID+"]").css("display") != "block")
			{
				$(".CT_Tab_One").removeClass("CT_Tab_Selected");
				$(this).addClass("CT_Tab_Selected");
				$(".CT_Tab_Content_One").hide();
				$(".CT_Tab_Content_One[data-tabID="+tabID+"]").show();
			}
		});
		
		$(document).on(touchOrClick,"#Refresh_Cache",function(){
			if($(".List_Selected").length > 0)
			{
				
				var hashToAdd = {};
				hashToAdd["PG"] = "editCategory";
				hashToAdd["cID"] = $(".List_Selected").data("catid");
				addMultipleHash(hashToAdd,true);
			}
			else
				showSideMSGBox("Please select a category first.",'msgBox_One_1');
		});
		$(document).on(touchOrClick,".CatList_One",function(){
			if($(this).hasClass("List_Selected"))
			{
				$("#Add_Category").data("tooltip","Add Category");
				$(".CatList_One").removeClass("List_Selected");
				$(".CatSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(".CatList_One").removeClass("List_Selected");
				$(this).addClass("List_Selected");
				$("#Add_Category").data("tooltip","Add Category : Under '<span style='color:#f3c922;'>"+$(this).text()+"</span>' Category");
				$(".CatSelectedMenu").fadeIn(300);
			}
		});
		$(document).on(touchOrClick,"#Refresh_All_Cache",function(){
			timconfirm("Refresh","Do you want to refresh all caches?",function(){
				
				$.ajax({
					type: "POST",
					url: "<?echo __AjaxURL__?>?ajaxProcess",
					data: "menu=refreshCache&Cache=All",
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							
							showSideMSGBox('<i class="fa fa-save"></i> Refreshed Successfully.','msgBox_One_1');
						}
						else if(res.error_msg != undefined && res.error_msg != "")
							showSideMSGBox(res.error_msg,'msgBox_One_2');
					}
				});
			});
		});
		
	});
</script>
<h2 id="PG_Title"><i class="fa fa-flask"></i> Cache Control</h2>
<div id="PG_Menu">
	<div class="CatSelectedMenu square_button square_button_white" data-tooltip="Refresh Cache" id="Refresh_Cache" style="display:none;"><i class="fa fa-edit"></i></div>
	
	<div id="Refresh_All_Cache" data-tooltip="Refresh All Cache" class="square_button square_button_blue"><i class="fa fa-rotate-left"></i></div>
</div>
<div id="PG_Contents">
	
</div>