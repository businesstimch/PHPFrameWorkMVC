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
<link href="<?php echo __DocumentRoot__;?>Template/CSS/Admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on(touchOrClick,"#Edit_OptionTemplate",function(){
			if($(".OPT_List_Contents_Selected").length > 0)
			{
				window.location = "<?php echo __AdminPath__;?>catalog/product-options/edit?TplID="+$(".OPT_List_Contents_Selected").data("tplid");
			}
			else
				showSideMSGBox("Please select a category first.",'msgBox_One_1');
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
		
		$(document).on(touchOrClick,"#Delete_OptionTemplate",function(){
			if($(".OPT_List_Contents_Selected").length > 0)
				timconfirm('<i class="fa fa-trash"></i> Delete Option Template','Do you want to delete this?<br /><i>(This is a option template. It will not effect on existing options in products.)</i>',function(){
					var TplID = $(".OPT_List_Contents_Selected").data("tplid");
					
					$.ajax({
						type: "POST",
						url: "<?echo __AjaxURL__?>?ajaxProcess",
						data: "menu=deleteOptionTemplate&TplID="+TplID,
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-trash"></i> Deleted Successfully.','msgBox_One_1');
								$(".OPT_List_Contents_Selected").slideUp(1000).remove();
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
					
				});
		});
		
	});
	
</script>
<h2 id="PG_Title"><i class="fa fa-archive"></i> Option Templates</h2>
<div id="PG_Menu">
	<div class="PdSelectedMenu square_button square_button_white" data-tooltip="Edit Option Group" id="Edit_OptionTemplate" style="display:none;"><i class="fa fa-edit"></i></div>
	<div class="PdSelectedMenu square_button square_button_red" data-tooltip="Delete Option Group" id="Delete_OptionTemplate" style="display:none;"><i class="fa fa-trash"></i></div>
	<a id="Add_OptionTemplate" href="<?php echo __AdminPath__;?>catalog/product-options/add" data-tooltip="Add Option Group Template" class="square_button square_button_blue"><i class="fa fa-plus"></i></a>
	<div id="Search_Block"><input type="text" placeholder="Search by keyword, name, item number." /></div>
	<div class="square_button square_button_white" data-tooltip="Search" id="Search_Product"><i class="fa fa-search"></i></div>
</div>
<div id="PG_Contents">
	<?php echo $OptionTemplateList;?>
</div>