<script type="text/javascript">
	
	$(document).ready(function(){
		$(document).on(touchOrClick,"#ChangeOrderStatus_Btn",function(){
			
			var Go = true;
			if(_Get['oID'] != undefined)
			{
				var oID = _Get['oID'];
			}
			else
				Go = false;
			
			if(Go)
			{
				var Args = "";
				
				if($("#NotifyCustomer_Chk").length > 0)
					Args += "&NotifyCustomer="+($("#NotifyCustomer_Chk:checked").length > 0 ? 1 : 0);
					
					
				timconfirm('<i class="fa fa-trash"></i> Change Order Status','Are you sure?',function(){
					$.ajax({
						type: "POST",
						url: '?ajaxProcess',
						data: "menu=changeOrderStatus&osID="+$('#OrderStatusHistory_List_SLT').val()+"&oID="+oID+Args+"&Memo="+encodeURIComponent($("#ChangeOrderStatus_Memu_Txt").val()),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								if(res.OrderStatusHistory_Block != "undefined")
								$('#OrderStatusHistory_Block').html(res.OrderStatusHistory_Block);
								showSideMSGBox('<i class="fa fa-save"></i> Changed Successfully.','msgBox_One_1');
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
				});
			}
			else
				showSideMSGBox('<i class="fa fa-info"></i> There was an error, please refresh this page and try again.','msgBox_One_2');
		});
		
		$(document).on('keyup',"#Search_ProduT1_Keyword",function(e){
			if(e.which == 13)
				SubmitSearch();
		});
		$(document).on(touchOrClick,"#Search_Product",function(){
			SubmitSearch();
		});
		$(document).on(touchOrClick,".PagiNext_Btn,.PagiPrev_Btn",function(){
			var PGtoGo;
			if(getHash()['p'] == undefined && $(this).hasClass('PagiNext_Btn'))
				PGtoGo = 2;
			else if(!isNumber(getHash()['p']) && $(this).hasClass('PagiNext_Btn'))
				PGtoGo = 2;
			else if(!$(this).hasClass('PagiDisabled'))
			{
				if($(this).hasClass('PagiNext_Btn'))
					PGtoGo = parseInt(getHash()['p']) + 1;
				else
					PGtoGo = parseInt(getHash()['p']) - 1;
			}
			if(PGtoGo != undefined)
			{
				addHash('p',PGtoGo);
			}
		});
		
		$(document).on(touchOrClick,".T1_Tab_One",function(){
			var tabID = $(this).data("tabid");
			if($(".T1_Tab_Content_One[data-tabID="+tabID+"]").css("display") != "block")
			{
				$(".T1_Tab_One").removeClass("T1_Tab_Selected");
				$(this).addClass("T1_Tab_Selected");
				$(".T1_Tab_Content_One").hide();
				$(".T1_Tab_Content_One[data-tabID="+tabID+"]").show();
			}
		});
		
		
		$(document).on(touchOrClick,"#Add_Product",function(){
			var hashToAdd = {};
			hashToAdd["PG"] = "addProduct";
			addMultipleHash(hashToAdd,true);
		});
		
		$(document).on(touchOrClick,"#Delete_Order",function(){
			if($(".T1_List_Contents_Selected").length > 0)
				timconfirm('<i class="fa fa-trash"></i> Delete a Order','Are you sure?',function(){
					var pID = $(".T1_List_Contents_Selected").data("pid");
					
					$.ajax({
						type: "POST",
						url: "<?echo __AjaxURL__?>?ajaxProcess",
						data: "menu=deleteOrder&pID="+pID,
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-trash"></i> Deleted Successfully.','msgBox_One_1');
							}
							else if(res.error_msg != undefined && res.error_msg != "")
								showSideMSGBox(res.error_msg,'msgBox_One_2');
						}
					});
					
				});
		});
		
		$(document).on(touchOrClick,".T1_List_Contents",function(){
			if($(this).hasClass("T1_List_Contents_Selected"))
			{
				$(".T1_List_Contents").removeClass("T1_List_Contents_Selected");
				$(".PdSelectedMenu").fadeOut(300);
			}
			else
			{
				
				$(".T1_List_Contents").removeClass("T1_List_Contents_Selected");
				$(this).addClass("T1_List_Contents_Selected");
				$(".PdSelectedMenu").fadeIn(300);
			}
		});
		$(document).on(touchOrClick,"#Refresh_BTN",function(){
			timconfirm("Refresh","Are you sure?",function(){
				location.reload();
			});
		});
		
	});
	
	function SubmitSearch()
	{
		var Keyword = $('#Search_ProduT1_Keyword').val();
		if(Keyword.trim(9) == "")
		{
			removeHash("Search");
		}
		else
		{
			addHash("Search",encodeURIComponent(Keyword));
		}
	}
	
	
</script>
<style type="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;padding-bottom:50px;}
	#Total_Found{padding-left:5px;margin-top:10px;clear:both;}
	
	.T1_Line_One{width:100%;margin-top:5px;margin-bottom:10px;}
	.T1_Line_One .T1_T{width:20%;text-align:right;line-height:30px;}
	.T1_Line_One .T1_T span{margin-right:15px;}
	.T1_Line_One .T1_T i{color:red;margin-right:3px;}
	.T1_Line_One .T1_I{width:80%;line-height:30px;}
	.T1_Line_One .T1_I input[type=text],
	.T1_Line_One .T1_I textarea,
	.T1_Line_One .T1_I select{box-sizing:border-box;width:100%;border:1px solid gray;padding:0;margin:0;border-radius:5px;padding:5px;}
	.T1_Line_One .T1_I input{height:30px;line-height:30px;}
	.T1_Line_One .T1_I textarea{height:150px;}
	
	.CatList_Selected{background-color:#b0d6f3!important;}
	
	#T1_Tab{width:100%;height:100%;}
	#T1_Tab #T1_Tab_Menu{width:100%;min-height:30px;line-height:30px;border-bottom:1px solid #e7e7e7;margin-bottom:20px;}
	#T1_Tab .T1_Tab_One{padding-left:10px;padding-right:10px;margin-right:8px;border-radius:7px 7px 0 0;cursor:pointer;border:1px solid white;}
	#T1_Tab .T1_Tab_One:hover{background-color:#f2f2f2;}
	#T1_Tab .T1_Tab_Selected{border-left:1px solid #e7e7e7;border-top:1px solid #e7e7e7;border-right:1px solid #e7e7e7;background-color:white!important;box-sizing:border-box;}
	#T1_Tab .T1_Tab_Content_One{width:100%;display:none;}
	#GenerateSEOUrl_Btn{color:#309df1;text-decoration:normal;font-size:0.8em;text-decoration:underline;cursor:pointer;}
	#Prd_Desc_Botton_PrdINP{height:300px;}
	
	#Option_Block{width:100%;}
	#Search_Block{width:300px;margin-left:10px;}
	#Search_Block input[type=text]{width:100%;height:32px;line-height:32px;margin:0;padding:0;padding-left:10px;padding-right:10px;box-sizing:border-box;border-radius:5px;}
	.CatList_Block{width:100%;}
	.CatList_Group{width:100%;padding-left:20px;box-sizing:border-box;}
	.CatList_One{width:100%;background-color:#f7f7f7;line-height:30px;box-sizing:border-box;padding-left:20px;border-radius:5px;margin-bottom:3px;position:relative;}
	.CatList_One:hover{background-color:#e6e6e6;}
	
	.T1_Image_One{width:100px;height:130px;border:1px solid #dcdce1;background-color:white;margin-left:20px;border-radius:5px;margin-bottom:10px;position:relative;}
	.T1_Image_One .ItemImage_Selected{background-color:#ffa62e!important;}
	.T1_Image_One .T1_Img_Preview{width:90px;height:80px;line-height:80px;background-color:#dadae1;color:#616165;margin-left:5px;margin-top:5px;text-align:center;cursor:pointer;color:white;border-radius:5px;}
	.T1_Image_One .T1_Img_Preview img{width:100%;height:100%;}
	.T1_Image_One .T1_Img_Default_Btn{width:90px;height:35px;margin-left:5px;margin-top:5px;background-color:#bdbdcd;color:white;text-align:center;cursor:pointer;line-height:35px;border-radius:5px;}
	.T1_Image_One .T1_ImgDefault_Selected{background-color:#309df1;}
	.T1_Image_One .T1_Img_Inp{display:none;}
	.T1_Image_One .deleteImg_BTN{display:none;}
	.T1_Image_One .T1_IMG{width:100%;height:100%;}
	.T1_Img_Selected{background-color:#dfdfdf!important;border:1px dotted #bcbcbc;}
	
	.T1_List_One{width:100%;height:40px;line-height:40px;margin-bottom:1px;background-color:#f8f8f8;}
	.T1_List_One .T1_List_Col{box-sizing:border-box;padding-left:10px;height:100%;border-right:1px solid white;}
	.T1_List_One .List_OrderID{width:10%;}
	.T1_List_One .List_OrderTotalPrice{width:15%;}
	.T1_List_One .List_CustomerName{width:30%;}
	.T1_List_One .List_OrderPlacedOn{width:30%;}
	.T1_List_One .List_OrderStatus{width:15%;}
	#Prd_Desc_Long_PrdINP{height:500px;}
	
	.T1_List_Header{background-color:#f2f2f2;margin-top:10px;border-radius:10px 10px 0 0;}
	.T1_List_Header .T1_List_Col{background:none!important;color:#545454;font-weight:bold;}
	.T1_List_Contents_Selected{background-color:#b0d6f3!important}
	.T1_List_Contents:hover{background-color:#8c8c8c;color:white;}
	
	.T_C_Name{width:300px;}
	.T_C_Price{width:100px;}
	.T_C_Sku{width:100px;min-height:30px;}
	.T_C_Qty{width:50px;}
	.T_C_RewardPoint{width:100px;}
	.Mandatory_Btn_Selected{background-color:#f55757;color:white;}
	.Mandatory_Btn_Selected:hover i{color:white;}
	
	#Pagination{width:100%;margin-top:10px;}
	#Pagination .Pagi_Btn{cursor:pointer;width:35px;height:35px;line-height:35px;text-align:center;font-size:1.5em;background-color:#f2f2f2;border-radius:5px;border:1px solid #dedede;margin-right:10px;}
	#Pagination .PagiDisabled{color:#d0d0d0;}
	
	#ChangeOrderStatus_Btn{width:200px;line-height:45px;box-sizing:border-box;border-radius:5px;border:1px solid #1288e2;text-align:center;background-color:#309df1;color:white;cursor:pointer;}
	#ChangeOrderStatus_Btn:hover{background-color:#33a7ff;}
	#OrderStatusHistory_Block .OSH_One{box-sizing:border-box;padding-left:10px;background-color:#e6e6e6;border-bottom:1px dotted white;border-radius:5px;margin-bottom:2px}
	#OrderStatusHistory_Block .OSH_Name{width:200px;}
	#OrderStatusHistory_Block .OSH_Time{float:right;margin-right:10px;}
	#OrderStatusHistory_Block .OSH_Current{background-color:#63d483;color:white;font-weight:bold;}
	#ChangeOrderStatus_Memu_Txt{margin-top:10px;height:80px;}
</style>
<h2 id="PG_Title">
	<i class="fa fa fa-edit"></i> Order Detail
</h2>
<div id="PG_Menu">
	<a href="<?php echo __AdminPath__;?>sales/orders/" class="button button_white" data-tooltip="Back"><i class="fa fa-mail-reply"></i></a>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
</div>

<div id="PG_Contents">
	<?php echo $PG_Contents;?>
</div>