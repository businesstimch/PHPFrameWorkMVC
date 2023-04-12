<script type="text/javascript">
	$(document).ready(function(){
		getList.init();
		WrongLookupCode.init();
		buttonBehavior.init();
		$(document).on(touchOrClick,"#Print_BTN",function(){
			window.print();
		});
	});
	
	var WrongLookupCode = new function(){
		this.init = function(){
			$(document).on(touchOrClick,".WrongCodeSave_BTN",function(){
				var pid = $(this).parents('.List_One').data('pid');
				var SKU = $(this).parents('.List_One').find('.P_SKU_INP').val();
				$.ajax({
						type: "POST",
						url: '?ajaxProcess',
						data: "menu=updateSKU&pid="+pid+"&SKU="+encodeURIComponent(SKU),
						success: function(d){
							var res = $.parseJSON(d);
							if(res.ack == 'success')
							{
								showSideMSGBox('<i class="fa fa-save"></i> Updated','msgBox_One_1');
							}
							else if(res.error_msg != undefined && res.error_msg != "")
							{
								showSideMSGBox(res.error_msg,'msgBox_One_2');
								ResultBox_Obj.html(res.error_msg);
							}
						}
					});
				
			});
		};	
	};
	
	var buttonBehavior = new function(){
		this.init = function(){
			this.selectDeselectALL();
		};
		
		this.selectDeselectALL = function(){
			$(document).on(touchOrClick, '[data-button]',function(){
				var Obj_selectDeSelect = $(this).parents('.Box_One').find('[data-buttongroup="selectDeselect"]');
				if($(this).data('button') == 'selectAll')
				{
					Obj_selectDeSelect.each(function(){
						$(this).attr('checked','checked');
					});
				}
				else if($(this).data('button') == 'deSelectAll')
					Obj_selectDeSelect.each(function(){
						$(this).removeAttr('checked');
					});
					
			});
		};
	};
	
	var getList = new function(){
		var loadingMSG = '<div class="MessageBox"><i class="fa fa-circle-o-notch fa-spin"></i> Loading ...</div>';
		
		this.init = function(){
			$(document).on(touchOrClick,".getButton",function(){
				
				geResult($(this).parents('.Box_One'));
			});
			
			
			$(document).on(touchOrClick,"#DeleteItemSelected_BTN",function(){
				var Obj = $('#NotActive_Box').find('.P_Select_INP:checked');
				if(Obj.length > 0)
				{
					timconfirm('<i class="fa fa-trash"></i> Delete Items','Are you sure?',function(){
						
						var ItemIDs = {};
						var i = 0;
						Obj.each(function(){
							var Obj2 = $(this).parents('.List_One');
							ItemIDs[i] = Obj2.data('id');
							i++;
						});
						
						$.ajax({
							type: "POST",
							url: '?ajaxProcess',
							data: "menu=deleteItemWebsite&Data="+JSON.stringify(ItemIDs),
							success: function(d){
								var res = $.parseJSON(d);
								if(res.ack == 'success')
								{
									Obj.parents('.List_One').slideUp(1000).remove();
								}
								else if(res.error_msg != undefined && res.error_msg != "")
								{
									showSideMSGBox(res.error_msg,'msgBox_One_2');
									ResultBox_Obj.html(res.error_msg);
								}
							}
						});
					});
				}
				else
					showSideMSGBox('<i class="fa fa-info-circle"></i> There is nothing to update.','msgBox_One_2');
			});
			
			
			
			
			$(document).on(touchOrClick,"#UpdatePriceDiffSelected_BTN",function(){
				var Obj = $('#PriceDiff_Box').find('.P_Select_INP:checked');
				if(Obj.length > 0)
				{
					timconfirm('<i class="fa fa-trash"></i> Update','Are you sure?',function(){
						
						var ItemIDs = {};
						Obj.each(function(){
							var Obj = $(this).parents('.List_One');
							
								
							ItemIDs[Obj.data('id')] = {};
							ItemIDs[Obj.data('id')]['Price'] = Obj.data('priceto');
							ItemIDs[Obj.data('id')]['Type'] = Obj.data('type');
							
						});
						
						$.ajax({
							type: "POST",
							url: '?ajaxProcess',
							data: "menu=updatePrice&Data="+JSON.stringify(ItemIDs),
							success: function(d){
								var res = $.parseJSON(d);
								if(res.ack == 'success')
								{
									Obj.slideUp(1000).remove();
								}
								else if(res.error_msg != undefined && res.error_msg != "")
								{
									showSideMSGBox(res.error_msg,'msgBox_One_2');
									ResultBox_Obj.html(res.error_msg);
								}
							}
						});
					});
				}
				else
					showSideMSGBox('<i class="fa fa-info-circle"></i> There is nothing to update.','msgBox_One_2');
			});
			
		};
		
		var geResult = function(Container_Obj){
			
			var ResultBox_Obj = Container_Obj.find('.Box_Result');
			var Data = '';
			var Error_Msg = '';
			var Go = true;
			if(Container_Obj.attr('id') == 'GoogleADChecker_Box')
			{
				
				var Codes_Arr = Container_Obj.find('textarea').val().split(/\r?\n/);
				if(Codes_Arr.length > 0)
					Data += '&Data='+JSON.stringify(Codes_Arr);
				else
				{
					Go = false;
					Error_Msg = 'Insert Item Lookup Code';
				}
			}
			
			if(Go)
			{
				ResultBox_Obj.html(loadingMSG);
				$.ajax({
					type: "POST",
					url: '?ajaxProcess',
					data: "menu="+Container_Obj.data('menu')+Data,
					success: function(d){
						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{
							ResultBox_Obj.html(res.html);
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox(res.error_msg,'msgBox_One_2');
							ResultBox_Obj.html(res.error_msg);
						}
					}
				});
			}
			else if(Error_Msg != "")
				showSideMSGBox(res.error_msg,'msgBox_One_2');
		};
	};
</script>
<style type="text/css">
	#PG_Menu{float:right;}
	#PG_Contents{width:100%;margin-top:10px;padding-bottom:50px;}
	.Btn{
		cursor: pointer;
		line-height: 30px;
		padding-top: 0;
		padding-bottom: 0;
		padding-left: 15px;
		padding-right: 15px;
		text-align: center;
		border-radius: 5px;
		margin-right: 10px;
	}
	
	.Btn_Blue{background-color: #bedaf4;border: 1px solid #719cc5;color: #265a8c;}
	.Btn_Blue:hover{background-color:#7dabd5;color:white;}
	
	.Btn_Red{background-color: #f4b5b5;border: 1px solid #c57171;color: #8c2626;}
	.Btn_Red:hover{background-color:#e34848;color:white;}
	
	.Box_One{margin-right:10px;margin-bottom:10px;padding:10px;border:1px solid #c2c2c2;border-radius:15px;}
	.Box_One .Box_Title{width:100%;margin-bottom:10px;}
	.Box_One .Box_Menu{width:100%;}
	.Box_One .Box_Result{background-color:#ededed;width:100%;min-height:50px;border-radius:10px;padding:10px;box-sizing:border-box;margin-top:10px;overflow:auto;height:500px;}
	.Box_One .MessageBox{width:100%;margin-top:25px;margin-bottom:25px;text-align:center;}
	#GoogleADChecker_Box, #PriceDiff_Box, #NotActive_Box,#WrngCode_Box{width:700px;}
	
	
	.List_One{width:100%;line-height:30px;border-bottom:1px dotted white;padding-top:3px;padding-bottom:3px;}
	.List_One:hover{background-color:#ffdd74;cursor:pointer;}
	.List_One .P_Img {border:1px solid #969696;border-radius:3px;overflow:hidden;width:28px;height:28px;}
	.List_One .P_Img img{width:100%;height:100%;}
	.List_One .P_ItemLookupCode{margin-left:5px;width:100px;height:30px;margin-right:5px;}
	.List_One .P_ItemLookupCode input{width:100%;height:30px;padding:0;margin:0;border:0;text-align:center;}
	.List_One .P_Name{margin-left:5px;width:224px;height:30px;overflow:hidden;}
	.List_One .P_Link{width:50px;height:30px;text-align:center;}
	.List_One .P_Link a{display:block;float:left;color:white;border-radius:5px;background-color:#2bace8;width:100%;height:100%;}
	.List_One .P_Select{width:26px;height:30px;text-align:center;}
	.List_One .P_PricePOS{width:80px;height:30px;text-align:center;}
	.List_One .P_PriceWeb{width:80px;height:30px;text-align:center;}
	.List_One .P_Col{margin-left:3px;}
	.List_One .P_Existance{padding-left:10px;}
	.List_One .P_SaveBtn{display: block;float: left;color: white;border-radius: 5px;background-color: #f4b5b5;width: 100%;height: 100%;cursor:pointer;color:#8c2626;}
	.List_One .P_SelectOption{background-color:#acacac;}
	.ActiveItem{background-color:#eff5ff;}
	.InActiveItem{background-color:#ffefef;}
	.Box_Insert{margin-top:10px;width:100%;}
	.Box_Insert textarea{width:100%;height:300px;padding:10px;box-sizing:border-box;border:1px dotted #c2c2c2;border-radius:10px;}
	.P_Has{background-color:#0b83ff;color:white;}
	.P_NoHas{background-color:#ee4d4d;color:white;}
	
	@media print {
		#Top,
		#Navigation,
		#GoogleADChecker_Box textarea
		{display:none;}
		#Main{position:static;}
		
		.Box_One{width:100%!important;}
		.Box_Result{width:100%;overflow:visible;max-height:none;}
		
		
		
	}
</style>
<h2 id="PG_Title">
	<i class="fa fa fa-edit"></i> Migrate POS
</h2>
<div id="PG_Menu">
	<div id="Print_BTN" data-tooltip="Print this page" class="Glow button button_white"><i id="UploadingIcon" class="fa fa-print"></i></div>
</div>
<div id="PG_Contents">
	
	<div class="Box_One" id="PriceDiff_Box" data-menu="getPriceDiff">
		<div class="Box_Title">Price Sync (Website & POS)</div>
		<div class="Box_Menu">
			<div class="getButton Glow Btn Btn_Blue noSelect">Get List</div>
			<div class="Btn Btn_Blue Glow noSelect" data-button="selectAll">Select All</div>
			<div class="Btn Btn_Blue Glow noSelect" data-button="deSelectAll">Deselect All</div>
			<div class="Btn Btn_Red Glow noSelect" id="UpdatePriceDiffSelected_BTN">Update Selected</div>
		</div>
		<div class="Box_Result">
			<div class="MessageBox">Press button to get result</div>
		</div>
	</div>
	
	<div class="Box_One" id="WrngCode_Box" data-menu="NoLookupCodeInPOS">
		<div class="Box_Title">Wrong <b>Item Lookup Code</b> in Website(Not in POS)</div>
		<div class="Box_Menu">
			<div class="getButton Glow Btn Btn_Blue noSelect">Get List</div>
		</div>
		<div class="Box_Result">
			<div class="MessageBox">Press button to get result</div>
		</div>
	</div>
	
	<div class="Box_One" id="NotActive_Box" data-menu="itemsNotActivated">
		<div class="Box_Title">Items Deavtivated (Website)</div>
		<div class="Box_Menu">
			<div class="getButton Glow Btn Btn_Blue noSelect">Get List</div>
			<div class="Btn Btn_Blue Glow noSelect" data-button="selectAll">Select All</div>
			<div class="Btn Btn_Blue Glow noSelect" data-button="deSelectAll">Deselect All</div>
			<div class="Btn Btn_Red Glow noSelect" id="DeleteItemSelected_BTN">Delete Selected</div>
		</div>
		<div class="Box_Result">
			<div class="MessageBox">Press button to get result</div>
		</div>
	</div>
	
	<div class="Box_One" id="GoogleADChecker_Box" data-menu="checkGoogleAD">
		<div class="Box_Title">Google Adwords Item Checker</div>
		<div class="Box_Menu">
			<div class="getButton Glow Btn Btn_Blue noSelect">Get List</div>
		</div>
		<div class="Box_Insert">
			<textarea placeholder="Insert Item Lookup Codes(Delimited by enter)" id=""></textarea>
		</div>
		<div class="Box_Result">
			<div class="MessageBox">Press button to get result</div>
		</div>
	</div>
</div>