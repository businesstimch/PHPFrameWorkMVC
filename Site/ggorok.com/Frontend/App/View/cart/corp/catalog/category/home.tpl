<style type="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;}
	
	.TP_Image_One{width:100px;height:130px;border:1px solid #dcdce1;background-color:white;margin-right:20px;border-radius:5px;margin-bottom:10px;position:relative;}
	.TP_Image_One .ItemImage_Selected{background-color:#ffa62e!important;}
	.TP_Image_One .TP_Img_Preview{width:90px;height:80px;line-height:80px;background-color:#dadae1;color:#616165;margin-left:5px;margin-top:5px;text-align:center;cursor:pointer;color:white;border-radius:5px;}
	.TP_Image_One .TP_Img_Preview img{width:100%;height:100%;}
	.TP_Image_One .TP_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	.TP_Image_One .TP_ImgDefault_Selected{background-color:#309df1;}
	.TP_Image_One .TP_Img_Inp{display:none;}
	.TP_Image_One .deleteImg_BTN{display:none;}
	.TP_Image_One .TP_IMG{width:100%;height:100%;}
	.TP_Img_Selected{background-color:#dfdfdf!important;border:1px dotted #bcbcbc;}
	
	.CatList_One{width:100%;background-color:#f7f7f7;line-height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;}
	.CatList_One:hover{background-color:#e6e6e6;}
	
	.CatList_One .changeOrder{width:35px;height:100%;position:absolute;left:0;top:0;text-align:center;color:#d0cece;cursor:all-scroll;}
	.CatList_One .changeOrder:before{content:"\f047";}
	.CatList_One .changeOrder:hover{color:#656565;}
	.CatList_Selected{background-color:#b0d6f3!important;}
	.CatList_Selected .changeOrder{color:white;}
	
	.CatList_Block{width:100%;min-height:5px;position:relative;}
	
	.CatList_OuterMost{padding-left:35px;box-sizing:border-box;}
	.CG_Top{border-left:0!important;padding-left:0!important;}
	.OpenCloseCategory_BTN{position:absolute;left:0;top:5px;width:30px;height:30px;line-height:30px;text-align:center;background-color:#f7f7f7;border-radius:4px;cursor:pointer;}
	.error{background-color:#ffdbdb;}
	.CatList_Placeholder{margin-left:20px;width:100%;background-color:#f7f7f7;line-height:30px;height:30px;box-sizing:border-box;padding-left:35px;border-radius:5px;position:relative;margin-bottom:5px;margin-top:5px;background-color:#ffeda6;}
	.CatList_Group{width:100%;padding-left:20px;box-sizing:border-box;border-left:1px dotted #c5c5c5;}
	.CatList_Group .fa-folder-open-o{margin-right:5px;}
	
	.foldMenu{width:35px;height:100%;line-height:30px;position:absolute;right:0;top:0;text-align:center;color:gray;cursor:pointer;}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		
		Category.init();
		initDom();
		
		
		$(document).on(touchOrClick,"#Delete_Category",function(){
			if($(".CatList_Selected").length > 0)
				timconfirm('<i class="fa fa-trash"></i> Delete','Are you sure? All sub categories will be also deleted.<br /><input type="checkbox" id="deleteItems_Chk" /> <span style="font-size:0.8em;">Delete items too.</span>',function(){
					var cID = $(".CatList_Selected").data("catid");
					var ItemsToo = ($("#deleteItems_Chk").is(":checked") > 0 ? 1 : 0);
					$.ajax({
						type: "POST",
						url: "<?echo __AjaxURL__?>?ajaxProcess",
						data: "menu=deleteCategory&cID="+cID+"&ItemsToo="+ItemsToo,
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-trash"></i> Deleted Successfully.','msgBox_One_1');
								$('.CatList_Selected').closest('.CatList_Group').slideUp(1000).remove();
								$(".CatSelectedMenu").fadeOut(300);
								Category.checkTotalCategory();
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
					
				});
		});
		$(document).on(touchOrClick,"#Edit_Category",function(){
			if($(".CatList_Selected").length > 0)
			{
				window.location = "<?php echo __AdminPath__;?>catalog/category/edit?cID="+$(".CatList_Selected").data("catid");
			}
			else
				showSideMSGBox("Please select a category first.",'msgBox_One_1');
		});
		$(document).on(touchOrClick,".CatList_One",function(){
			if($(this).hasClass("CatList_Selected"))
			{
				$("#Add_Category").data("tooltip","Add Category");
				$(".CatList_One").removeClass("CatList_Selected");
				$(".CatSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(".CatList_One").removeClass("CatList_Selected");
				$(this).addClass("CatList_Selected");
				$("#Add_Category").data("tooltip","Add Category : Under '<span style='color:#f3c922;'>"+$(this).text()+"</span>' Category");
				$(".CatSelectedMenu").fadeIn(300);
			}
		});
		$(document).on(touchOrClick,"#Refresh_BTN",function(){
			timconfirm("Refresh","Are you sure?",function(){
				location.reload();
			});
		});
		
	});
				
	
	var Category = new function(){
		
		this.init = function(){
			this.openCloseCategory();
		};
		
		this.openCloseCategory = function(){
			
			$(document).on(touchOrClick,".OpenCloseCategory_BTN",function(){
				$(this).closest('.CatList_Block').slideUp(1000);
			});
			
		};
		
		
		this.checkTotalCategory = function(){
			if($('.CatList_One').length == 0)
				$('#PG_Contents').html('No Category Found');
			
		};
	};
	
	function initDom()
	{
		
		
		$(".CatList_Block").sortable({
			placeholder : "CatList_Placeholder",
			connectWith: ".CatList_Block",
			handle:".changeOrder",
			start: function(event,ui){
				ui.helper.find('.CatList_Group').css("border-left","0");
				/*
				$(".CatList_Block").css('min-height','5px');
				$(".CatList_One").css('margin-bottom','0');
				*/
			},
			stop: function(){
				$('.CatList_Group').css("border-left","1px dotted #c5c5c5");
				/*
				$(".CatList_Block").removeAttr('style');
				$(".CatList_One").css('margin-bottom','5px');
				*/
			},
			update: function( event, ui ) {
				
				if (this === ui.item.parent()[0])
				{
					
					var OBJ = $('.CatList_One');
					var Tree = {};
					OBJ.each(function(){
						
						if(typeof(Tree[$(this).closest('.CatList_Block').data('parentcatid')]) == "undefined")
							Tree[$(this).closest('.CatList_Block').data('parentcatid')] = new Array();
							
						Tree[$(this).closest('.CatList_Block').data('parentcatid')].push($(this).data('catid'));
						
					});
					
					$.ajax({
						type: "POST",
						url: "<?echo __AjaxURL__?>?ajaxProcess",
						data: "menu=rearrangeCategory&Tree="+JSON.stringify(Tree),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								
								initDom();
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_1');
						}
					});
					
				}
				
				
				
				
			}
		});
	}
	
	
	
</script>

<h2 id="PG_Title"><i class="fa fa-folder-o"></i> Category</h2>
<div id="PG_Menu">
	<div class="CatSelectedMenu square_button square_button_white" data-tooltip="Edit Category" id="Edit_Category" style="display:none;"><i class="fa fa-edit"></i></div>
	<div class="CatSelectedMenu square_button square_button_red" data-tooltip="Delete Category" id="Delete_Category" style="display:none;"><i class="fa fa-trash"></i></div>
	<div id="Refresh_BTN" class="square_button square_button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
	<a id="Add_Category" href="<?php echo __AdminPath__;?>catalog/category/add" data-tooltip="Add Category" class="Block square_button square_button_blue"><i class="fa fa-plus"></i></a>
</div>
<div id="PG_Contents">
	<?php echo $CategoryList;?>
</div>