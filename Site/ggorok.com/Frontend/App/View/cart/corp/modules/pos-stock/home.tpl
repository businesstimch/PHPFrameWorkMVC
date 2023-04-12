<script type="text/javascript">
	$(document).ready(function(){
		StockManagement.init();
		SearchSupplier.init();
		PurchaseOrder.init();
		$(document).on(touchOrClick,"#Print_BTN",function(){
			window.print();
		});
	});

	var OpenedCart = {};
	var StoreSelected = false;
	var CurrentSupplier;

	var PurchaseOrder = new function(){
		this.init = function(){


			$(document).on(touchOrClick,".SupplierName_Cart",function(){
				$(this).parents('.Cart_One').find('.Cart_Detail').toggle();
			});
			$(document).on(touchOrClick,".CM_MakePurchaseOrder",function(){
				makePurchaseOrder($(this));

			});

			$(document).on(touchOrClick,".CM_DeleteCart",function(){
				deleteCart($(this));
			});

			$(document).on(touchOrClick,".CIOM_One",function(){
				if($(this).data('action') == 'update')
					updateQty($(this));
				if($(this).data('action') == 'delete')
					deleteItemInCart($(this));
			});

			$(document).on(touchOrClick,".AddCartBTN",function(){
				addToCart($(this));
			});
		};

		var deleteCart = function(Obj){
			var Parent = Obj.parents('.Cart_One');
			var SupplierID = Parent.data('supplierid');

			timconfirm('<i class="fa fa-trash"></i> Submit','Do you want to delete this cart?',function(){
				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=deleteCart&StoreID="+encodeURIComponent(StoreSelected)+"&SupplierID="+encodeURIComponent(SupplierID),
					success: function(d){
						var res = $.parseJSON(d);

						if(res.ack == 'success')
						{
							Obj.parents('.Cart_One').remove();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			});
		};

		var makePurchaseOrder = function(Obj){

			var Parent = Obj.parents('.Cart_One');
			var SupplierID = Parent.data('supplierid');

			timconfirm('<i class="fa fa-trash"></i> Submit','Do you want to create a purchase order?',function(){

				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=makePurchaseOrder&StoreID="+encodeURIComponent(StoreSelected)+"&SupplierID="+encodeURIComponent(SupplierID),
					success: function(d){
						var res = $.parseJSON(d);

						if(res.ack == 'success')
						{
							Parent.remove();
							showSideMSGBox("<i class='fa fa-cart-plus'></i>Purchase order has been created.",'msgBox_One_1');
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			});
		};
		this.getCart = function(){
			getCart();
		};

		var getCart = function(){

			$.ajax({
				type: "POST",
				url: '<?echo __AjaxURL__?>?ajaxProcess',
				data: "menu=getCart&StoreID="+encodeURIComponent(StoreSelected),
				success: function(d){
					var res = $.parseJSON(d);

					if(res.ack == 'success')
					{
						$('#Cart_Block').html(res.HTML);
					}
					else if(res.error_msg != undefined && res.error_msg != "")
					{
						showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
					}
				}
			});
		};

		var updateQty = function(Obj){
			var QTY_Inp = Obj.parents('.CartItem_One').find('.CIO_Qty_Inp');
			var Parent = Obj.parents('.CartItem_One');
			if(QTY_Inp.val() >= 0)
			{
				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=updateQty&StoreID="+encodeURIComponent(StoreSelected)+"&ItemID="+encodeURIComponent(Parent.data('itemid'))+"&Qty="+encodeURIComponent(QTY_Inp.val()),
					success: function(d){
						var res = $.parseJSON(d);

						if(res.ack == 'success')
						{
							getCart();
							/*showSideMSGBox("<i class='fa fa-cart-plus'></i> Updated Successfully.",'msgBox_One_1');*/
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			}
			else
				deleteItemInCart(Obj);
		};

		var deleteItemInCart = function(Obj){
			var ItemID = Obj.parents('.CartItem_One').data('itemid');

			timconfirm('<i class="fa fa-trash"></i> Delete','Do you want to delete?',function(){

				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=deleteItemInCart&StoreID="+encodeURIComponent(StoreSelected)+"&ItemID="+encodeURIComponent(ItemID),
					success: function(d){
						var res = $.parseJSON(d);

						if(res.ack == 'success')
						{
							PurchaseOrder.getCart();
							/*showSideMSGBox("<i class='fa fa-cart-plus'></i> Deleted Successfully.",'msgBox_One_1');*/
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			});

		};


		var addToCart = function(Obj){
			var Row = Obj.parents('.IH_ROW');
			var SupplierID = Row.data('supplierid');
			var ItemID = Row.data('rowid');
			var QTY = Row.find('.CartInp').val();
			var Go = true;

			//console.log(SupplierID + '/' + ItemID + '/' + QTY);
			if(QTY <= 0)
			{
				showSideMSGBox("<i class='fa fa-save'></i> Set quantity you want to order",'msgBox_One_2');
			}

			if(Go)
			{
				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=addToCart&StoreID="+encodeURIComponent(StoreSelected)+"&ItemID="+encodeURIComponent(ItemID)+"&Qty="+encodeURIComponent(QTY)+"&SupplierID="+encodeURIComponent(SupplierID),
					success: function(d){

						var res = $.parseJSON(d);
						if(res.ack == 'success')
						{

							showSideMSGBox("<i class='fa fa-cart-plus'></i> Added Successfully.",'msgBox_One_1');
							PurchaseOrder.getCart();
						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			}
			else
			{
				showSideMSGBox("<i class='fa fa-save'></i> Please make sure all input methods are correct, otherwise referesh this page.",'msgBox_One_2');
			}


		};
	};
	var SearchSupplier = new function(){
		var Keyword = $('#SupplierName_INP').val();
		var Keyword_Prev = Keyword;

		this.init = function(){

			$(document).on(touchOrClick,".SP_One",function(){
				addSupplierList($(this));
				resetSearch();
				Keyword_Prev = '';
			});

			$(document).on("focusout","#SupplierName_INP",function(){


			});

			$(document).on(touchOrClick,".SABDel_BTN",function(){
				removeSupplierList($(this));
			});

			$(document).on("keyup","#SupplierName_INP",function(){
				Keyword = $('#SupplierName_INP').val();
				if(Keyword != "")
				{
					$('#SupplierFound_List').show();
				}
				else
				{
					resetSearch();
				}

				if(Keyword != Keyword_Prev && Keyword != "")
				{
					if(!StoreSelected && $('.StoreSelect_Selected').length > 0)
						StoreSelected = $('.StoreSelect_Selected').data('store');

					if(StoreSelected != false)
					{
						Keyword_Prev = Keyword;
						$.ajax({
							type: "POST",
							url: '<?echo __AjaxURL__?>?ajaxProcess',
							data: "menu=searchSupplier&Name="+encodeURIComponent(Keyword)+"&StoreID="+encodeURIComponent(StoreSelected),
							success: function(d){

								var res = $.parseJSON(d);
								if(res.ack == 'success')
								{
									$('#SupplierFound_List').html(res.html);
								}
								else if(res.error_msg != undefined && res.error_msg != "")
								{

								}
							}
						});
					}
				}
			});
		};

		var addSupplierList = function(obj){

			var HTML = '';
			if($('.SAB_One[data-spid='+obj.data('spid')+']').length == 0)
				HTML = '<div class="SAB_One" data-spid="'+obj.data('spid')+'">'+obj.text()+'<div class="SABDel_BTN"><i class="fa fa-trash"></i></div></div>';

			$('#SupplierAdded_Block').append(HTML);
		};

		var removeSupplierList = function(obj){
			var SPObj = obj.parents('.SAB_One');
			var SPID = SPObj.data('spid');

			SPObj.remove();
		};


		var resetSearch = function(){
			$('#SupplierFound_List').hide();
			$('#SupplierFound_List').html('');
			$('#SupplierName_INP').val('');
		};

	};

	var StockManagement = new function(){
		this.init = function(){

			$(document).on(touchOrClick,"#GetList_BTN",function(){
				getData();
			});

			$(document).on(touchOrClick,".BySelect",function(){
				selectBy($(this));
			});

			$(document).on(touchOrClick,".StoreSelect",function(){
				selectStore($(this));
			});

			$(document).on(touchOrClick,".MKBox",function(){
				$(this).toggleClass('MK_Activated');
			});



			$(document).on(touchOrClick,".optionToggle",function(){
				optionToggle($(this));
			});


			$(document).on(touchOrClick,"#CANCEL_BTN",function(){
				$('#Add_Block').slideToggle(100);
				resetADD_Form();
			});


			$(document).on(touchOrClick,".OpenMarket_ID",function(){
				$(this).toggleClass('Add_Selected');
			});
		};

		var resetData = function(){
			$('#POS_ItemList_Contents').html('<div id="PIC_MSG"><i class="fa fa-envelope-open-o"> Please select a store and press \'Get Data\'.</i></div>');
			$('#Cart_Block').html('');

		};
		var resetSupplier = function(){
			$('#SupplierAdded_Block').html('');
		};
		var selectBy = function(Obj){

			$(".BySelect").removeClass('BySelect_Selected');
			Obj.addClass('BySelect_Selected');
			if($(".BySelect_Selected").data('by') == 'Supplier')
				$('.SupplierRelated').show();
			else
				$('.SupplierRelated').hide();

		};

		var optionToggle = function(Obj){
			Obj.toggleClass('optionToggle_Selected');
		};

		var selectStore = function(Obj){

			$(".StoreSelect").removeClass('StoreSelect_Selected');
			Obj.addClass('StoreSelect_Selected');

		};

		var getData_Verify = function(){

			if($('#GetList_BTN').hasClass('GettingList'))
			{
				showSideMSGBox("<i class='fa fa-save'></i> Please wait",'msgBox_One_2');
			}
			else if($('.StoreSelect_Selected').length > 0 && $('.BySelect_Selected').length > 0)
			{
				return true;
			}
			else
			{
				showSideMSGBox("<i class='fa fa-save'></i> Select a 'Store : ' and 'By : '.",'msgBox_One_2');
			}
		};
		var getData = function(){

			if(getData_Verify())
			{
				var addParam = '';
				var By = $('.BySelect_Selected').data('by');


				if(!StoreSelected)
					StoreSelected = $('.StoreSelect_Selected').data('store');
				else if(StoreSelected != $('.StoreSelect_Selected').data('store') || By == 'All')
					resetSupplier();

				$('#GetList_BTN').addClass('GettingList');

				StoreSelected = $('.StoreSelect_Selected').data('store');
				PurchaseOrder.getCart();
				resetData();


				if(By == 'Supplier')
				{
					addParam += '&SupplierIDs=';
					var SupplierIDs = new Array();
					$('.SAB_One').each(function(){
						SupplierIDs.push($(this).data('spid'));
					});
					addParam += JSON.stringify(SupplierIDs);
				}

				$.ajax({
					type: "POST",
					url: '<?echo __AjaxURL__?>?ajaxProcess',
					data: "menu=getData&StoreID="+StoreSelected+"&Mode=" + By + addParam,
					success: function(d){
						var res = $.parseJSON(d);

						$('#GetList_BTN').removeClass('GettingList');
						if(res.ack == 'success')
						{
							$('#POS_ItemList_Contents').html(res.ItemList_HTML);
							pairWithParent(0,function(){
								pairWithChildren(0,function(){
									finalizeStockList();
								});
							});


						}
						else if(res.error_msg != undefined && res.error_msg != "")
						{
							showSideMSGBox("<i class='fa fa-cart-plus'></i>"+res.error_msg+".",'msgBox_One_2');
						}
					}
				});
			}
		};

		var finalizeStockList = function(){

			var TotalOnHand;
			var Obj;
			var By = $('.BySelect_Selected').data('by');
			var TotalSoldGroup = 0;

			$('.IH_ROW_GROUP').each(function(){

				TotalOnHand = 0;
				TotalSoldGroup = 0;
				Obj = $(this).find('.IH_ROW');


				if(Obj.length == 1)
				{
					Obj.find('.IH_Col_RP').text(Obj.data('rp'));
					if(Obj.data('rp') >= Obj.data('oh'))
						Obj.find('.IH_Col_RP').addClass('IH_Col_RP_Bad');

					TotalSoldGroup = Obj.data('totalsoldeach');

					$(this).find('.IH_Col_Menu').append(getCartBlock(Obj.data('rp')));
				}
				else
				{
					var ParentQTY = 1;
					var ParentQTY_OH = 0;
					var TotalQTY_OH = 0;
					var TotalSoldEach = 0;
					var EachQtyPerLevel = 1;
					var RP = 0;
					var i = 0;

					$(Obj.get().reverse()).each(function(){
						i++;
						/*console.log($(this).find('.IH_Col_SKU').text());*/

						if(i == 1)
						{
							TotalQTY_OH = TotalQTY_OH + $(this).data('oh');
							TotalSoldEach = $(this).data('totalsoldeach');


							/*console.log($(this).find('.IH_Col_SKU').text() + ']]' +TotalQTY_OH + '+' + $(this).data('oh'))*/
						}
						else if(i > 1)
						{
							TotalQTY_OH = TotalQTY_OH + (ParentQTY * $(this).data('oh'));

							/*console.log('(' + ParentQTY + ' * ' + $(this).data('totalsoldeach') + ' ) + ' + TotalSoldEach);*/
							TotalSoldEach = (ParentQTY * $(this).data('totalsoldeach')) + TotalSoldEach;
							/*console.log($(this).find('.IH_Col_SKU').text() + ']]' + TotalQTY_OH + '+' + '(' + ParentQTY + '*' + $(this).data('oh') + ')')*/


						}
						TotalSoldGroup = TotalSoldGroup + TotalSoldEach;

						if(i == Obj.length)
						{
							RP = Math.ceil((TotalSoldEach / 6 ) / ParentQTY);
							$(this).find('.IH_Col_RP').text(RP);

							if(RP >= Obj.data('oh'))
								$(this).find('.IH_Col_RP').addClass('IH_Col_RP_Bad');



							$(this).find('.IH_Col_Menu').append(getCartBlock(RP));


							/*console.log('RP = '+ RP +' : (' + TotalSoldEach + '/ 6) / ' + ParentQTY);*/
						}

						/*console.log('Total Sold : ' + TotalSoldEach);*/
						ParentQTY = $(this).data('parentqty') * ParentQTY;


					});
					/*console.log(TotalQTY_OH);*/
				}

				$(this).data('soldtotal',TotalSoldGroup);

				if(By == 'Supplier')
				{
					if($('#showOnlySold6M').hasClass('optionToggle_Selected'))
					{
						if($(this).data('soldtotal') == 0)
						{
							$(this).hide();
						}

					}
				}





			});




		};

		var getCartBlock = function(QTY){
			return '<div class="cartInp_Block"><input class="CartInp" value="'+QTY+'" type="text" /></div><div class="AddCartBTN MenuBTN" data-tooltip="Add to Cart"><i class="fa fa-cart-plus"></i></div>'
		};

		var pairWithParent = function(Loop,Callback){

			var parentToFind;
			$('.IH_ROW_GROUP .IH_ROW[data-parentid!=0]').each(function(){
				parentToFind = $('.IH_ROW_PARENTGROUP .IH_ROW[data-rowid='+$(this).data('parentid')+']');
				$(this).parents('.IH_ROW_GROUP').prepend(parentToFind.clone());
				parentToFind.remove();
			});

			if($('.IH_ROW_PARENTGROUP .IH_ROW').length > 0 && Loop < 5)
				pairWithParent(Loop + 1,Callback);
			else
				Callback();

		};

		var pairWithChildren = function(Loop,Callback){

			var objToFind;
			$('.IH_ROW_CHILDRENGROUP .IH_ROW').each(function(){
				objToFind = $('.IH_ROW[data-rowid='+$(this).data('parentid')+']');
				if(objToFind.length > 0)
				{
					objToFind.parents('.IH_ROW_GROUP').append($(this).clone());
					$(this).remove();
				}

			});

			if($('.IH_ROW_CHILDRENGROUP .IH_ROW').length > 0 && Loop < 5)
				pairWithChildren(Loop + 1);
			else
				Callback();

		};
		var removeDuplicatedFamily = function(){

			var currentList = {};
			var listToRemove = new Array();
			/* Build up list */
			$('.IH_ROW').each(function(){
				currentList[$(this).data('rowid')] = $(this).data('parentid');
			});

			jQuery.each(currentList, function(_i, _f){
				if(typeof currentList[_f] !== 'undefined')
				{
					console.log($('.IH_ROW[data-rowid='+_f+']').find('.IH_Col_DESC').text());
				}

			});
		 };

		 var resetADD_Form = function(){
			$('.OpenMarket_ID').removeClass('Add_Selected');
			$('#SKU_INP').val("");
			$('#UPC_INP').val("");
		 };

		var validateADD_Form = function(){
			var output = {};
			output['ack'] = true;
			output['msg'] = "Error<br />";
			if(!$('.Add_Selected').length)
			{
				output['ack'] = false;
				output['msg'] += "- Select Market Type.<br />";
			}

			if($('#SKU_INP').val() == "")
			{
				output['ack'] = false;
				output['msg'] += "- Insert Item Lookup Code.<br />";
			}

			return output;
		};
	};
</script>
<style type="text/css">

	#PG_Menu{float:right;}
	#PG_Contents{width:100%;}
	#GM_Table_Grid div{float:none;}
	#GM_Table_Grid .w2ui-col-header{text-align:center;}
	#GM_Table{border:1px solid gray;}
	#GM_Table th{background-color:#f2f2f2;padding-left:10px;padding-right:10px;}
	#GM_Table th,#GM_Table td{white-space: nowrap;border-right:1px solid gray;border-bottom:1px solid gray;line-height:20px;font-weight:normal;}
	#GM_Table td div{height:22px;width:100%;}
	#GM_Table .CL_Title div{width:300px;}
	#GM_Table .CL_Desc div{width:300px;overflow:hidden;}
	#GM_Table .CL_ADPower div{div:50px;text-align:center;}
	#GM_Table .CL_ADPower .ADOff{background-color:#9c9c9c;color:#00324c;}
	#GM_Table .CL_ADPower .ADOn{background-color:#7bc1e6;color:#00324c;}
	#GM_Table .hasInput{width:100%;}

	#GM_Table .noInput{text-align:center;padding-left:10px;padding-right:10px;background-color:#e1e1e1;width:100%;box-sizing:border-box;}
	#GM_Table input.hasChanged{background-color:#ffe9a7;}
	#GM_Table input{text-align:center;width:100%;border:0;padding:0 10px 0 10px;margin:0px;box-sizing:border-box;line-height:20px;height:20px;}
	#GM_Table input:focus{background-color:#ffebbb;border:0;outline:none;}
	#GM_Table input:hover{background-color:#d9f1ff;}
	#Add_Block{display:none;}
	#SKU_INP,#UPC_INP{
		border: 1px solid gray;
		line-height: 40px;
		padding-top: 0;
		padding-bottom: 0;
		padding-left: 15px;
		padding-right: 15px;
		text-align: center;
		font-size: 15px;
		border-radius: 5px;
		margin-left: 10px;
	}
	.SQ_BTN_1{
		cursor: pointer;
		border: 1px solid #gray;
		line-height: 40px;
		padding-top: 0;
		padding-bottom: 0;
		padding-left: 15px;
		padding-right: 15px;
		text-align: center;
		font-size: 15px;
		border-radius: 5px;
		margin-left: 10px;
	}


	#ADD_BTN{background-color: #309df1;color: white;border:1px solid #1288e2;}
	#CANCEL_BTN{background-color: #8f8f8f;color: white;border:1px solid #6a6a6a;}
	#Amazon_BTN,#Ebay_BTN{background-color: #e7e7e7;color: white;border:1px solid #c0c0c0;color:#5d5d5d;}
	#Amazon_BTN.Add_Selected{background-color: #f79331;color: white;border:1px solid #ae5e10;}
	#Ebay_BTN.Add_Selected{background-color: #ff6357;color: white;border:1px solid #cd3226;}
	.disabledItem{background-color:#ffbcbc!important;}
	.outOfStock{background-color:#fee6ff!important;}
	.CL_Col{cursor:pointer;}
	.OnAd{width:100%;height:20px;line-height:20px;}
	.OnNoAD_Block{position:absolute;overflow:hidden;top:0;bottom:0;overflow:auto;box-sizing:border-box;padding:20px;left:0;right:0}
	#GM_Table_Grid{width:100%;height:100%;}

	#POS_ItemList{width:100%;min-width:1500px;margin-top:10px;}
	#POS_ItemList_Header{width:100%;background-color:#53bbf1;}
	#POS_ItemList_Header .IH_COL{line-height:40px;color:white;}
	#POS_ItemList_Contents .IH_COL{line-height:35px;height:35px;overflow:hidden;}
	#POS_ItemList_Contents{width:100%;background-color: #ececec;}
	#POS_ItemList_Contents #PIC_MSG{width:100%;text-align:center;line-height:300px;color:gray;font-size:1.2em;}
	.MKBox{width:78px;height:22px;line-height:22px;background-color:#c8c8c8;color:white;border-radius:3px;margin-top:7px;}
	.IH_COL{padding-left:10px;padding-right:10px;text-align:center;font-size:1.2em;border-right:1px solid white;}
	.IH_Col_SKU{width:150px;}
	.IH_Col_DESC{width:300px;overflow:hidden;}
	.IH_Col_Menu{width:89px;}
	.IH_Col_Ordered{color:red;}
	.IH_Col_OH{width:50px;}
	.IH_Col_RP{width:50px;}
	.IH_Col_RP_Bad{background-color:#f2afaf;}
	.IH_Col_RP_Good{}
	.IH_Col_Price{width:100px;}
	.IH_Col_Cost{width:74px;}
	.IH_ROW{width:100%;font-size:12px;border-bottom:1px dotted white;}
	.IH_Col_Supplier{width:150px;}
	.IH_Col_M_Hidden{width:140px;display:hidden;}
	.status_on{color:#0090ff;}
	.status_off{color:#646464;}

	.IH_ROW_Color_0{background-color:#ececec;}
	.IH_ROW_Color_1{background-color:#dedede;}
	.IH_ROW_Color_ASM_0{background-color:#ffecdb;}
	.IH_ROW_Color_ASM_1{background-color:#dedede;}
	.IH_ROW_ASM_Head{font-weight:bold;}
	.IH_ROW_GROUP{width:100%;cursor:pointer;border-bottom:2px dotted #4d88e5;}
	.IH_ROW_GROUP:hover{background-color:#addcf3;}
	.SupplierRelated{display:none;}
	#Search_Supplier{width:400px;height:30px;border:1px solid gray;padding-left:10px;padding-right:10px;border-radius:5px;position:relative;margin-right:10px;}
	#Search_Supplier input{height:30px;width:100%;height:100%;padding:0;border:0;font-size:15px;text-align:center;}
	#SupplierFound_List{display:none;position:absolute;left:0;top:35px;height:300px;background-color:white;width:100%;overflow:auto;border-radius:5px;border:1px solid gray;}

	.Cart_One{height:30px;border:1px solid #b0b0b0;padding-right:10px;border-radius:5px;position:relative;line-height:30px;background-color:#ececec;margin-left:10px;}
	.Cart_Detail{overflow:hidden;display:none;width:800px;position:absolute;top:35px;right:0;background-color:white;border:1px solid gray;z-index:100;border-radius:5px;}
	.Cart_One .CIO_Col{padding-left:5px;padding-right:5px;overflow:hidden;line-height:30px;height:30px;text-align:center;}

	.Cart_One .TopCartAmount_Block{margin-left:5px;}
	.Cart_One .CartItem_One,
	.Cart_One .CIO_Row_Head,
	.Cart_One .CIO_Row_Footer{overflow:hidden;width:100%;height:30px;line-height:30px;border-bottom:1px solid gray;}
	.Cart_One .CIO_Row_Footer{background-color:#e1f2ff;font-weight:bold;}
	.Cart_One .CartItem_One:hover{background-color:#f0ffeb;}
	.CIO_Qty{width:50px;}
	.CIO_Qty .CIO_Qty_Inp{width:100%;height:100%;float:left;padding:0;border:0;margin:0;background-color:#fff6d1;text-align:center;}
	.CIO_Row_Head{background-color:#e8e8e8;}
	.Cart_One .CIO_SKU{width:150px;}
	.Cart_One .CIO_ItemName{width:250px;}
	.Cart_One .CIO_Cost{width:80px;text-align:center;}
	.Cart_One .CIO_Price{width:80px;text-align:center;}
	.Cart_One .CIO_Menu{width:80px;}
	.CIOM_One{width:30px;text-align:center;border-radius:3px;}
	.CIOM_One:hover{background-color:#d1eaff;}
	.Cart_One .SupplierName_Cart{cursor:pointer;border-radius:3px;padding-left:10px;padding-right:10px;background-color:#53bbf1;margin-right:5px;font-weight:bold;color:white;}
	.Cart_One .Cart_Menu{width:100%;padding-top:5px;padding-bottom:5px;}
	.Cart_One .CM_One{padding-left:10px;padding-right:10px;margin-right:10px;border-radius:4px;color:white;}
	.Cart_One .CM_Wrap{float:right;}
	.Cart_One .CM_MakePurchaseOrder{background-color:#38a8ff;border:1px solid #118dec;margin-left:50px;}
	.Cart_One .CM_DeleteCart{background-color:#ff5a5a;border:1px solid #ff3737;}
	#TopGap_Block{width:100%;margin-top:10px;font-size:15px;}

	.SP_One{width:100%;height:30px;line-height:30px;cursor:pointer;}
	.SP_One:hover{background-color:#e8e8e8;}
	.SP_One span{margin-left:10px;}
	#SupplierAdded_Block{width:100%;}
	#SupplierAdded_Block .SAB_One{position:relative;background-color:#15a4df;line-height:35px;padding:0px 40px 0px 15px;margin-right:10px;color:white;border-radius:5px;}
	#SupplierAdded_Block .SABDel_BTN{position:absolute;right:8px;top:6px;width:25px;height:25px;line-height:25px;background-color:#124357;color:white;text-align:center;border-radius:3px;cursor:pointer;}
	#Store_Menu{width:100%;margin-top:10px;display:none;}
	.StoreSelect,.BySelect,.optionToggle{padding-left:10px;padding-right:10px;line-height:30px;text-align:center;border:1px solid #7f7f7f;border-radius:5px;margin-right:10px;cursor:pointer;}
	.StoreSelect_Selected,.BySelect_Selected{background-color:#38a8ff;color:white;border:1px solid #118dec;}
	.optionToggle_Selected{background-color:#ff8a8a;color:white;border:1px solid #c22525;}
	.TXTPGMenu{padding-left:10px;padding-right:10px;line-height:30px;text-align:center;cursor:pointer;}

	#GetList_BTN{background-color:#53bbf1;color:white;padding-left:10px;padding-right:10px;line-height:30px;text-align:center;border:1px solid #1fa7ed;border-radius:5px;margin-right:10px;margin-left:10px;cursor:pointer;}

	#GeneralMenuTop{margin-top:10px;width:100%;}
	.DeviderSLT{border-left:1px solid #c5c5c5;height:30px;margin-left:5px;margin-right:5px;}
	.GettingList{background-color:#ff5a5a!important;color:white!important;}
	.cartInp_Block{width:50px;height:27px;overflow:hidden;border-radius:3px;margin-top:4px;}
	.cartInp_Block input{width:100%;height:100%;padding:0;margin:0;text-align:center;font-size:13px;border:0px;float:left;}
	.AddCartBTN{background-color:#5a5a5a;color:white;}
	.MenuBTN{height:27px;line-height:27px;margin-top:4px;padding-left:10px;padding-right:10px;border-radius:3px;margin-left:5px;}
	#Cart_Block{cursor:pointer;}
	@media print {
		#Top,
		#PG_Menu,
		#Navigation{display:none;}
		#Main{width:100%;left:0;position:relative;}

		#POS_ItemList{font-size:10px;}
		.IH_Col_SKU{width:126px;}
		.IH_Col_Price{width:60px;}
		.IH_COL{padding:0;}
	}
</style>

<h2 id="PG_Title">
	<i class="fa fa-desktop"></i> POS Stock Management
</h2>

<div id="PG_Menu">
	<div id="Cart_Block"></div>
	<div id="Print_BTN" data-tooltip="Print this page" class="Glow button button_white"><i id="UploadingIcon" class="fa fa-print"></i></div>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
</div>

<div id="GeneralMenuTop">
	<div class="TXTPGMenu">Store : </div>
	<div class="StoreSelect noSelect" data-store="1">Atlanta</div>
	<div class="StoreSelect noSelect" data-store="2">Nashville</div>
	<div class="DeviderSLT"></div>
	<div class="TXTPGMenu">By : </div>
	<div class="BySelect noSelect" data-by="All">All</div>
	<div class="BySelect noSelect" data-by="Supplier">Supplier</div>
	<div id="Search_Supplier" class="SupplierRelated">
		<input id="SupplierName_INP" placeholder="Search Supplier Name" type="text" />
		<div id="SupplierFound_List"></div>
	</div>
	<div class="SupplierRelated">
		<div class="DeviderSLT"></div>
		<div class="TXTPGMenu">Option : </div>
		<div class="optionToggle optionToggle_Selected" id="showOnlySold6M">Show only sold within 6M</div>
	</div>
	<div class="DeviderSLT"></div>
	<div id="GetList_BTN" data-tooltip="Get Data"><i class="fa fa-paper-plane-o"></i> Get Data</div>

</div>


<div id="Store_Menu">



</div>
<div id="TopGap_Block">
	<div id="SupplierAdded_Block"></div>
</div>
<div id="PG_Contents">
	<div id="POS_ItemList">
	 <div id="POS_ItemList_Header">
		<div class="IH_COL IH_Col_Supplier">Supplier</div>
		<div class="IH_COL IH_Col_SKU">MPN</div>
		<div class="IH_COL IH_Col_DESC">Description</div>
		<div class="IH_COL IH_Col_RP" data-tooltip="Reorder Point">RP</div>
		<div class="IH_COL IH_Col_OH" data-tooltip="On Hand">OH</div>
		<div class="IH_COL IH_Col_Price">Price</div>
		<div class="IH_COL IH_Col_Cost">Cost</div>

		<div class="IH_COL IH_Col_M_Hidden" data-tooltip="Total sale monthly (1,2,3,4,5,6)">M(1,2,...)</div>
		<div class="IH_COL IH_Col_M IH_Col_Menu">Menu</div>
	 </div>
	 <div id="POS_ItemList_Contents">

	 </div>
	</div>
</div>
