<script type="text/javascript">
	$(document).ready(function(){
		Checkout.init();

		$(document).on(touchOrClick,"#Pymt_Submit_Btn",function(){
			var Args = "";
			
			
			if(!$(this).hasClass('Pymt_inProgress'))
			{
				
				if($("#termsOfSale_Chk:checked").length > 0)
				{
					var P_S = process_shipping();
					var P_P = process_payment();
					var Go = true;
					var error_msg = '';
					if(P_S['ack'] != false)
					{
						Args += P_S['args'];
						if(P_P['ack'] != false)
						{
							Args += P_P['args'];
							
							if(getHash()['CheckoutRegister'] != undefined && <?echo $isLogin;?>)
							{
								$('.ChkReg_Inp').each(function(){
									Args += '&'+$(this).prop('id')+'='+encodeURIComponent($(this).val());
								});
								if($("#ChkReg_Password_Inp").val() != $("#ChkReg_PasswordConf_Inp").val())
								{
									Go = false;
									error_msg += "Password does not match the confirm password.<br />";
								}
							}
							
						}
						else
						{
							Go = false;
							error_msg += P_P['error_msg'];
						}
						
					}
					else
					{
						Go = false;
						error_msg += P_S['error_msg'];
					}
					
					if ($("#ChkGuest_Email_Inp").length > 0 && $("#ChkGuest_Email_Inp").val() != "" && !validateEmail($("#ChkGuest_Email_Inp").val()))
					{
						
						Go = false;
						error_msg += "Your email address is not a valid address.<br />";
					}
					
					if(Go)
					{
						Args += '&oComment='+encodeURIComponent($('#Pymt_Comment_Inp').val());
						
						if ($("#ChkGuest_Email_Inp").length > 0 && $("#ChkGuest_Email_Inp").val() != "")
							Args += '&ChkGuest_Email_Inp='+encodeURIComponent($('#ChkGuest_Email_Inp').val());
							
						process(Args,true);
					}
					else
					{
						$(this).removeClass('Pymt_inProgress');
						showSideMSGBox(error_msg,'msgBox_One_2');
					}
					//var Args['Payment_Info'] = process_payment();
					
					//var Shipping_Code = $(".Pymt_Selection_P").
				}
				else
					showSideMSGBox("Please check our terms of sale.",'msgBox_One_2');
			}
			else
				showSideMSGBox("<i class='fa fa-spinner fa-spin'></i> We are currently processing your payment. Thank you for your patience.",'msgBox_One_1');
			
		
		});
		
	});
	
	var Checkout = new function(){
		this.init = function(){
			
			$(document).on(touchOrClick,"#Chk_GuestReg_Selection [data-val]",function(){
				if($(this).data('val') == 0)
				{
					$('#AIB_GuestChk').slideDown(100);
					$('#AIB_RegisterChk').slideUp(100);
					
				}
				else
				{
					$('#AIB_GuestChk').slideUp(100);
					$('#AIB_RegisterChk').slideDown(100);
				}
				
			});
		};
		
		
	};
	
	function process(Args,Checkout)
	{
		$(this).addClass('Pymt_inProgress');
		$.ajax({
			type: "POST",
			url: "<?echo __AjaxURL__?>?ajaxProcess",
			data: "menu=process"+Args+hashToUrl(),
			success: function(d){
				$("#Pymt_Submit_Btn").removeClass('Pymt_inProgress');
				$(this).removeClass('Pymt_inProgress');
				var res = $.parseJSON(d);
				if(res.ack == 'success')
				{
					
					
					if(Checkout && res.oID != undefined && res.TK != undefined)
						location.href ="/checkout/completed/?oID="+res.oID+"&Token="+res.TK;
					
					
					/*$('#Summary_Block').html(res.html);*/
					for(var key in res)
					{
						if(res.hasOwnProperty(key) && key.match(/Target_/))
						{
							$("#"+key.replace(/Target_/,"")).html(res[key]);
						}
					
					}
					
					
				}
				else
				{
					showSideMSGBox(res.error_msg,'msgBox_One_2');
				}
				
			}
		});
	}
</script>

<style type="text/css">
	#CheckoutPG_Block{padding:20px;width:100%;box-sizing:border-box;}
	#CheckoutPG_Block .ChkBlock_T{width:100%;font-size:1.4em;margin-bottom:20px;}
	#CheckoutPG_Block .ChkFields{width:100%;}
	#CheckoutPG_Block .ChkField_T{width:100%;margin-bottom:5px;}
	#CheckoutPG_Block .ChkField_F{width:100%;margin-bottom:10px;}
	#CheckoutPG_Block .ChkField_F input{color:#5b5b5b;}
	#CheckoutPG_Block .ChkField_F input.one[type="password"],
	#CheckoutPG_Block .ChkField_F input.one[type="text"]{width:100%;margin:0;padding:10px;box-sizing:border-box;border-radius:5px;line-height:40px;height:40px;border:1px solid #cbcbcd;}
	#CheckoutPG_Block .ChkField_F textarea{width:100%;border-radius:5px;min-height:50px;padding:10px;box-sizing:border-box;border:1px solid #cbcbcd;}
	
	#CheckoutPG_Block .ChkField_F input.two[type="password"],
	#CheckoutPG_Block .ChkField_F input.two[type="text"]{width:calc(50% - 10px);margin:0;padding:10px;box-sizing:border-box;border-radius:5px;line-height:40px;height:40px;border:1px solid #cbcbcd;}
	#CheckoutPG_Block .ChkField_F select.one{width:100%;margin:0;padding:10px;box-sizing:border-box;border-radius:5px;line-height:40px;height:40px;border:1px solid #dddddd;}
	#CheckoutPG_Block .ChkField_F input.two:first-child{margin-right:10px;}

	#CheckoutPG_Block .Pymt_Selection_One{width:100%;border:1px solid #cbcbcd;box-sizing:border-box;line-height:39px;padding-left:10px;border-radius:5px;cursor:pointer;}
	#CheckoutPG_Block .Pymt_Selection_One:hover{background-color:#f8f8f8;}
	#CheckoutPG_Block .Pymt_Selection_One i{margin-right:5px;}
	#CheckoutPG_Block #ExtensionsSelection_Block{width:100%;margin-bottom:10px;}
	#CheckoutPG_Block .Pymt_Selected{background-color:#edf8ff;}
	#CheckoutPG_Block #Pymt_Method_Msg{margin-bottom:5px;width:100%;}
	#CheckoutPG_Block #Pymt_Submit_Block{width:100%;text-align:center;margin-top:30px;}
	#CheckoutPG_Block #Pymt_Submit_Btn{background-color:#2f9fed;color:white;border:0;line-height:50px;text-align:center;width:50%;border-radius:5px;font-size:1.3em;display:inline-block;cursor:pointer;}
	#CheckoutPG_Block .Pymt_inProgress{background-color:#8d8d8d!important;}
	#CheckoutPG_Block #Pymt_Submit_Btn:hover{background-color:#31a7fb;}
	#CheckoutPG_Block #Pymt_Submit_Btn:active{background-color:#164e76;}
	#TermCondition_Txt{border:0;text-align:left;width:50%;border-radius:5px;font-size:1.2em;display:inline-block;clear:both;margin-bottom:10px;}
	#CheckoutPG_Block #Pymt_Submit_Btn i{margin-right:5px;}
	#CheckoutPG_Block .AdditionalInfo_Block{display:none;}
	
	#Pymt_ItemCart_Block{width:100%;padding:10px 10px 0 10px;background-color:#f7f7f7;box-sizing:border-box;border-radius:10px;border:1px solid #d3d3d3;}
	#Pymt_ItemCart_Block .Pymt_ItemCart_One{line-height:25px;width:100%;margin-bottom:10px;border-bottom:1px dotted white;}
	#Pymt_ItemCart_Block .Pymt_ItemCart_One .PIO_Name{min-width:120px;margin-right:5px;}
	#Pymt_ItemCart_Block .Pymt_ItemCart_One .PIO_PriceQty{float:right;width:10%;min-width:95px;}
	#Pymt_Summaries{width:100%;margin-top:10px;}
	#Pymt_Summaries .PS_One{width:100%;border-bottom:1px solid gray;line-height:40px;}
	#Pymt_Summaries .PSO_Name{margin-left:10px;}
	#Pymt_Summaries .PSO_Amount{float:right;margin-right:10px;}
	#Pymt_Summaries #PS_Total{color:#18a0ff;}
	#Pymt_Summaries #PS_Total .PSO_Name,
	#Pymt_Summaries #PS_Total .PSO_Amount{font-size:1.5em;font-weight:bold;}
	
	#Chk_GuestReg_T{font-size:1.5em;width:100%;margin-bottom:5px;}
	#Chk_GuestReg_M{width:100%;margin-bottom:20px;}
	#Summary_Block{margin-bottom:20px;}
	
	.CartPage_Items .CI_One_H{border-bottom:1px dotted #bcbcbc;border-radius:0px!important;}
	.CartPage_Items .CI_One_H:hover{background-color:white!important;}
	.CartPage_Items .CI_One{min-width:700px;width:100%;background-color:white;padding-left:5px;padding-right:5px;box-sizing:border-box;border-radius:3px;}
	.CartPage_Items .CI_One_C{padding-bottom:5px;padding-top:5px;border-bottom:1px solid #f4f4f4;width:100%;}
	.CartPage_Items .CI_One:hover{background-color:#f5f5f5;}
	.CartPage_Items .CI_PImg{height:70px;line-height:70px;text-align:center;background-color:#dfdfdf;border-radius:10px;overflow:hidden;}
	.CartPage_Items .CI_PImg span{font-size:0.7em;}
	.CartPage_Items .CI_PImg img{width:100%;height:100%;}
	.CartPage_Items .CI_Name{overflow:hidden;max-height:100px;line-height:25px;}
	.CartPage_Items .CI_SKU{line-height:70px;height:70px;}
	.CartPage_Items .CI_Qty{line-height:70px;}
	.CartPage_Items .CI_Qty input{height:70px;width:100%;border:0;margin:0;padding:0;text-align:center;border:1px solid #bcbcbc;box-sizing:border-box;border-radius:10px;vertical-align:top;}
	.CartPage_Items .CI_Qty input:focus{background-color:#fffbdf;}
	.CartPage_Items .CI_Menu{height:70px;line-height:70px;color:white;}
	
	.CartPage_Items .CI_H{height:30px;line-height:30px;font-weight:bold;text-align:center;}
	.CartPage_Items .CI_PImg_W{width:70px;}
	.CartPage_Items .CI_Name_W{min-width:250px;padding-left:10px;box-sizing:border-box;text-align:left!important;}
	.CartPage_Items .CI_SKU_W{min-width:100px;max-width:200px;margin-right:20px;}
	.CartPage_Items .CI_Qty_W{width:70px;margin-right:20px;}
	.CartPage_Items .CI_Menu_W{width:150px;float:right;}
	
	.CartPage_Items .CI_Menu_One{width:70px;text-align:center;border-radius:10px;font-size:1.3em;cursor:pointer;}
	.CartPage_Items .CI_Update_Btn{background-color:#d3d3d3;margin-right:5px;}
	.CartPage_Items .CI_Update_Changed{background-color:#1caae7!important;}
	.CartPage_Items .CI_Delete_Btn{background-color:#e9615f;}
	
	.PCart_Buttons{margin-top:30px;width:100%;text-align:center;}
	.PCart_Buttons .PCart_Button{height:45px;line-height:45px;width:300px;text-align:center;border-radius:10px;color:white;font-weight:bold;display:inline-block;float:none;font-size:1.3em;border:1px solid white;text-shadow:0 -1px 0 #6f6f6f;}
	.PCart_Buttons .PCart_ChkoutBtn{background-color:#00a9ea;margin-right:15px;}
	
	#PCart_Summary{width:100%;text-align:right;margin-top:30px;}
	#PCart_Summary #PCart_Summary_Tbl{float:right;border-collapse:collapse;background-color:white;}
	#PCart_Summary #PCart_Summary_Tbl tr,
	#PCart_Summary #PCart_Summary_Tbl td{border:1px solid #c5c5c5;}
	#PCart_Summary #PCart_Summary_Tbl td{padding:20px;}
	#PCart_Summary .PST_T{width:200px;font-weight:bold;}
	#PCart_Summary .PST_C{width:100px;}
	
	#RegisterOrGuest_Block{margin-bottom:20px;}
	
</style>

<div class="w100">
	<div class="PG_Title"><i class="fa fa-shield"></i> Secured Checkout</div>
	<div id="CheckoutPG_Block">
		<?php echo $Checkout_HTML;?>
	</div>
</div>