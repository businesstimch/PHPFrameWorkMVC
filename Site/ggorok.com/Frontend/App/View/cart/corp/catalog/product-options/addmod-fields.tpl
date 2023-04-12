<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;padding-bottom:50px;}
	
	.OPT_Line_One{width:100%;margin-top:5px;margin-bottom:10px;}
	.OPT_Line_One .OPT_T{width:20%;text-align:right;line-height:32px;}
	.OPT_Line_One .OPT_T span{margin-right:15px;}
	.OPT_Line_One .OPT_T i{color:red;margin-right:3px;}
	.OPT_Line_One .OPT_I{width:80%;}
	.OPT_Line_One .OPT_I input[type=text],
	.OPT_Line_One .OPT_I textarea,
	.OPT_Line_One .OPT_I select{box-sizing:border-box;width:100%;border:1px solid gray;padding:0;margin:0;border-radius:5px;padding:5px;}
	.OPT_Line_One .OPT_I input{height:32px;line-height:32px;}
	.OPT_Line_One .OPT_I textarea{height:150px;}
	
	
	
	
	
	#Option_Block{width:100%;}
	#Search_Block{width:300px;margin-left:10px;}
	#Search_Block input[type=text]{width:100%;height:32px;line-height:32px;margin:0;padding:0;padding-left:10px;padding-right:10px;box-sizing:border-box;border-radius:5px;}
	
	.OPT_Image_One{width:100px;height:130px;border:1px solid #dcdce1;background-color:white;margin-left:20px;border-radius:5px;margin-bottom:10px;position:relative;}
	.OPT_Image_One .ItemImage_Selected{background-color:#ffa62e!important;}
	.OPT_Image_One .OPT_Img_Preview{width:90px;height:80px;line-height:80px;background-color:#dadae1;color:#616165;margin-left:5px;margin-top:5px;text-align:center;cursor:pointer;color:white;border-radius:5px;}
	.OPT_Image_One .OPT_Img_Preview img{width:100%;height:100%;}
	.OPT_Image_One .OPT_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	.OPT_Image_One .OPT_ImgDefault_Selected{background-color:#309df1;}
	.OPT_Image_One .OPT_Img_Inp{display:none;}
	.OPT_Image_One .deleteImg_BTN{display:none;}
	.OPT_Image_One .OPT_IMG{width:100%;height:100%;}
	.OPT_Img_Selected{background-color:#dfdfdf!important;border:1px dotted #bcbcbc;}
	
	.OPT_List_One{width:100%;height:40px;line-height:40px;margin-bottom:1px;background-color:#f8f8f8;}
	.OPT_List_One .OPT_List_Col{box-sizing:border-box;padding-left:10px;height:100%;border-right:1px solid white;}
	.OPT_List_One .OPT_List_Name{width:60%;}
	.OPT_List_One .OPT_List_Type{width:40%;}
	#Prd_Desc_Long_OptINP{height:500px;}
	
	.OPT_List_Header{background-color:#f2f2f2;margin-top:10px;border-radius:10px 10px 0 0;}
	.OPT_List_Header .OPT_List_Col{background:none!important;color:#545454;font-weight:bold;}
	.OPT_List_Contents_Selected{background-color:#b0d6f3!important}
	.OPT_List_Contents:hover{background-color:#8c8c8c;color:white;}
	
	
	#OPT_SubTab_Block{width:100%;}
	.OPT_SubTab_One{width:100%;}
	.Opt_Sub_One{width:100%;border-bottom:1px solid white;padding-bottom:10px;background-color:#f2f2f2;padding:10px;border-radius:10px;box-sizing:border-box;margin-bottom:5px;}
	.Opt_Sub_One input[type=text]{border-radius:5px;}
	.Opt_Sub_One .Opt_Drop_1{width:50%;}
	.Opt_Sub_One .Opt_Drop_2{width:10%;box-sizing:border-box;padding-left:10px;padding-right:10px;}
	.Opt_Sub_One .Opt_Drop_3{width:10%;box-sizing:border-box;padding-right:10px;}
	.Opt_Sub_One .Opt_Drop_4{width:20%;}
	.Opt_Sub_One .Opt_Drop_5{width:10%;}
	
	.Opt_Sub_INP{margin:0;padding:0;width:100%;box-sizing:border-box;}
	.BTN_PlusMinus{height:30px;line-height:30px;width:100%;text-align:center;border:1px solid gray;background-color:white;border-radius:5px;color:#5e5e5e;cursor:pointer;}
	.BTN_PlusMinus_Selected{background-color:#63b4f3!important;color:white;}
</style>
<link href="<?php echo __DocumentRoot__;?>Core/CSS/global_admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(){
		
		var OptionDelete_IDs = {};
		OptionDelete_IDs['Opt'] = Array();
		
		$(document).on(touchOrClick,".DelSubOption_BTN",function(){
			var Obj = $(this);
			
			timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure?',function(){
				Obj.parents(".Opt_Sub_One").slideUp(200,function(){
					if($(this).data("optid") != "")
						OptionDelete_IDs['Opt'].push($(this).data("optid"));
					
					$(this).remove();
				});
			});
		});
		
		$(document).on(touchOrClick,".AddSubOption_BTN",function(){
			var OptionHtmlTypeID = $(this).parents(".OPT_SubTab_One").data("optionhtmltypeid");
			var Obj = $(this);
			$.ajax({
				type: "POST",
				url: "<?php echo $AjaxURL;?>",
				data: "menu=optionSubAdd_HTML&OptionHtmlTypeID="+OptionHtmlTypeID,
				success: function(d){
					var res = $.parseJSON(d);
					if(res.ack == 'success')
					{
						Obj.parents(".Opt_Sub_One").after(res.html);
					}
					else if(res.error_msg != undefined && res.error_msg != "")
						showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
			});
		});
		
		
		$(document).on(touchOrClick,".BTN_PlusMinus",function(){
			
			var Obj = $(this).parents(".Opt_Sub_One").find(".BTN_PlusMinus");
			if(!$(this).hasClass("BTN_PlusMinus_Selected"))
			{
				Obj.removeClass("BTN_PlusMinus_Selected");
				$(this).addClass("BTN_PlusMinus_Selected");
			}
			
		});
		
		$(document).on(touchOrClick,"#Add_OptionTemplate",function(){
			var hashToAdd = {};
			hashToAdd["PG"] = "addOptionTemplate";
			addMultipleHash(hashToAdd,true);
		});
		
		
		$(document).on(touchOrClick,".OPT_List_Contents",function(){
			if($(this).hasClass("OPT_List_Contents_Selected"))
			{
				$(".OPT_List_Contents").removeClass("OPT_List_Contents_Selected");
				$(".PdSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(".OPT_List_Contents").removeClass("OPT_List_Contents_Selected");
				$(this).addClass("OPT_List_Contents_Selected");
				$(".PdSelectedMenu").fadeIn(300);
			}
		});
		
		$(document).on(touchOrClick,"#Refresh_BTN",function(){
			timconfirm("Refresh","Are you sure?",function(){
				location.reload();
			});
		});
		$(document).on(touchOrClick,"#Save_BTN",function(){
			
			var Argv = new FormData();
			var Go = true;
			var Err_Msg = "<i class='fa fa-warning'></i> <b>Error</b><br /><br />";
			
				
			$(".Ajax_INP").each(function(){
				if($(this).hasClass("must") && $(this).val() == "")
				{
					Go = false;
					Err_Msg += "- '"+$(this).data("name")+"' is required.<br />";
				}
				
				var FieldName = $(this).attr("id");
				
				if($(this).prop("type") == "checkbox")
					Argv.append(FieldName,($(this).is(":checked") ? 1:0));
				else
					Argv.append(FieldName,$(this).val());
					
			});
			var CountSubOption = 0;
			var SubOptions = {};
			$(".Opt_Sub_One").each(function(){
				var Name = $(this).find(".Opt_Sub_INP[data-inpid=Ogts_Name_OptINP]").val();
				var Price = $(this).find(".Opt_Sub_INP[data-inpid=Ogts_Price_OptINP]").val();
				var Suffix = $(this).find(".BTN_PlusMinus_Selected").data("val");
				
				if(Name != "" && Price != "")
				{
					SubOptions[CountSubOption] = [$(this).data('optid'),Name,Price,Suffix];
					CountSubOption++;
				}
				else
				{
					Go = false;
					Err_Msg += "- Option fields can't not be blank.<br />";
				}
				
			});
			
			if(_Get['pID'] != "undefined")
				Argv.append("OptGrp_ID_OptINP",_Get['TplID']);
			
			if(CountSubOption > 0)
			{
				Argv.append("OptGrp_SubOption_OptINP",JSON.stringify(SubOptions));
			}
			else
			{
				Go = false;
				Err_Msg += "- Please add at least one option.<br />";
			}
			
			
			if(getHash()['TplID'] != undefined)
				Argv.append("OptGrp_ID_OptINP",getHash()['TplID']);
				
			if(Go)
			{
				Argv.append("OptionDelete_IDs",JSON.stringify(OptionDelete_IDs));
				timconfirm("Save","Do you want to save?",function(){
					
					Argv.append('menu','saveOptionTemplate');
					
					$("#Save_BTN").hide();
					$.ajax({
						type: "POST",
						url: "<?php echo $AjaxURL;?>",
						data: Argv,
						processData: false,
						contentType: false,
						xhr: function() {
							myXhr = $.ajaxSettings.xhr();
							return myXhr;
						},
						success: function(d){
							$("#Save_BTN").show();
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-save"></i> Saved Successfully.','msgBox_One_1');
								
								if(res.newTplID != undefined)
								{
									window.location = "<?php echo __AdminPath__;?>catalog/product-options/edit?TplID="+res.newTplID;
								}
								else
									location.reload();
								
								
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_1');
						}
					});
				
					
				});
			}
			else
				showSideMSGBox(Err_Msg,"msgBox_One_2");
			
		});
	});
	
</script>
<h2 id="PG_Title"><i class="fa fa-plus"></i> <?php echo $Title_Text;?></h2>
<div id="PG_Menu">
	<a href="<?php echo __AdminPath__;?>catalog/product-options/" class="square_button square_button_white" data-tooltip="Back"><i class="fa fa-mail-reply"></i></a>
	<div id="Refresh_BTN" class=" square_button  square_button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
	<div id="Save_BTN" class=" square_button  square_button_blue" data-tooltip="Save"><i class="fa fa-save"></i></div>
</div>
<?php echo $optionGroupModAdd_HTML;?>