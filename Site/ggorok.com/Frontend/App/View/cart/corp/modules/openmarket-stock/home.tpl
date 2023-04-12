<script type="text/javascript">
  $(document).ready(function(){
    StockManagement.init();

    $(document).on(touchOrClick,"#Print_BTN",function(){
      window.print();

    });
  });

  var StockManagement = new function(){
    this.init = function(){

      getList();
      $(document).on(touchOrClick,"#ADD_BTN",function(){
        if(validateADD_Form()['ack'])
        {
          var Data = {};
          Data['ItemLookupCode'] = $('#SKU_INP').val();
          Data['Amazon'] = ($('#Amazon_BTN').hasClass('Add_Selected') ? 1 : 0);
          Data['Ebay'] = ($('#Ebay_BTN').hasClass('Add_Selected') ? 1 : 0);
          Data['UPC'] = $('#UPC_INP').val();

          $.ajax({
    				type: "POST",
    				url: '<?echo __AjaxURL__?>?ajaxProcess',
    				data: "menu=addItem&Data="+JSON.stringify(Data),
    				success: function(d){
              var res = $.parseJSON(d);
              if(res.ack == 'success')
              {
                showSideMSGBox('<i class="fa fa-save"></i> Saved Successfully','msgBox_One_1');
                getList();
              }
              else if(res.error_msg != undefined && res.error_msg != "")
							{
								showSideMSGBox(res.error_msg,'msgBox_One_2');
								ResultBox_Obj.html(res.error_msg);
							}


    				}
    			});
        }
        else
        {
          showSideMSGBox('<i class="fa fa-save"></i> '+validateADD_Form()['msg'],'msgBox_One_2');

        }
      });




      $(document).on(touchOrClick,".MKBox",function(){
        $(this).toggleClass('MK_Activated');
      });


      $(document).on(touchOrClick,"#CANCEL_BTN",function(){
        $('#Add_Block').slideToggle(100);
        resetADD_Form();
      });

      $(document).on(touchOrClick,"#AddButton_BTN",function(){
        $('#Add_Block').slideToggle(100);
      });
      $(document).on(touchOrClick,".OpenMarket_ID",function(){
        $(this).toggleClass('Add_Selected');
      });
    };

    var getList = function(){
      $.ajax({
				type: "POST",
				url: '<?echo __AjaxURL__?>?ajaxProcess',
				data: "menu=getData&Data=",
				success: function(d){
          var res = $.parseJSON(d);
          if(res.ack == 'success')
          {
            $('#POS_ItemList_Contents').html(res.ItemList_HTML);
          }
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
  #POS_Menu_Block{float:right;margin-top:30px;}
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

  #POS_ItemList{width:100%;margin-top:10px;}
  #POS_ItemList_Header{width:100%;background-color:#53bbf1;}
  #POS_ItemList_Header .IH_COL{line-height:40px;color:white;}
  #POS_ItemList_Contents .IH_COL{line-height:35px;height:35px;}
  #POS_ItemList_Contents{width:100%;background-color: #ececec;}
  #POS_ItemList_Contents #PIC_MSG{width:100%;text-align:center;line-height:300px;color:gray;font-size:1.2em;}
  .MKBox{width:78px;height:22px;line-height:22px;background-color:#c8c8c8;color:white;border-radius:3px;margin-top:7px;}
  .AmazonBox{margin-right:10px;}
  .IH_COL{padding-left:10px;padding-right:10px;text-align:center;font-size:1.2em;border-right:1px solid white;}
  .IH_Col_SKU{width:150px;}
  .IH_Col_DESC{width:300px;overflow:hidden;}
  .IH_Col_UPC{width:100px;}
  .IH_Col_MK{width:167px;}
  .IH_Col_Status{width:65px;}
  .IH_Col_Menu{width:100px;}
  .IH_Col_OH{width:50px;}
  .IH_Col_RP{width:50px;}
  .IH_Col_RP_Bad{background-color:#f2afaf;}
  .IH_Col_RP_Good{}
  .IH_Col_Price{width:100px;}
  .IH_Col_Cost{width:100px;}
  .IH_ROW{width:100%;font-size:12px;border-bottom:1px dotted white;}


  .AmazonBox.MK_Activated{background-color:#f79331;}
  .EbayBox.MK_Activated{background-color:#f79331;}
  .status_on{color:#0090ff;}
  .status_off{color:#646464;}

  .IH_ROW_Color_0{background-color:#ececec;}
  .IH_ROW_Color_1{background-color:#dedede;}
  .IH_ROW_Color_ASM_0{background-color:#ffecdb;}
  .IH_ROW_Color_ASM_1{background-color:#dedede;}
  .IH_ROW_ASM_Head{font-weight:bold;}
  .IH_ROW_GROUP{width:100%;cursor:pointer;border-bottom:1px solid #a8a8a8;}
  .IH_ROW_GROUP:hover{background-color:#addcf3;}

  #TopStatus_Block{width:100%;margin-top:10px;font-size:15px;}
  .TSB_One{margin-right:20px;}
  .PG_Val{margin-right:10px;cursor:pointer;}
  .TSB_Title{margin-right:10px;}
</style>

<h2 id="PG_Title">
	<i class="fa fa-desktop"></i> Openmarket Stock Management
</h2>

<div id="PG_Menu">
  <div id="AddButton_BTN" data-tooltip="Upload AdWords .TSV File" class="Glow button button_blue"><i class="fa fa-plus"></i></div>
	<div id="Print_BTN" data-tooltip="Print this page" class="Glow button button_white"><i id="UploadingIcon" class="fa fa-print"></i></div>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
</div>
<div id="TopStatus_Block">
  <div class="TSB_One">Total : (Amazon : , Ebay : )</div>
  <div class="TSB_One">
    <div class="TSB_Title">Show / Page :</div>
    <div class="PG_Val">10</div>
    <div class="PG_Val">50</div>
    <div class="PG_Val">100</div>
  </div>
</div>
<div id="PG_Contents">
  <div id="POS_Menu_Block">
    <div id="Add_Block">
      <div class="SQ_BTN_1 OpenMarket_ID noSelect" data-val="1" id="Amazon_BTN">AMAZON</div>
      <div class="SQ_BTN_1 OpenMarket_ID noSelect" data-val="2" id="Ebay_BTN">EBAY</div>
      <div>
        <input id="SKU_INP" placeholder="Item Lookup Code" />
        <input id="UPC_INP" placeholder="UPC Code" />
      </div>
      <div class="SQ_BTN_1 noSelect" id="ADD_BTN">ADD</div>
      <div class="SQ_BTN_1 noSelect" id="CANCEL_BTN">CANCEL</div>
    </div>
  </div>
  <div id="POS_ItemList">
    <div id="POS_ItemList_Header">
      <div class="IH_COL IH_Col_SKU">Item Lookup Code</div>
      <div class="IH_COL IH_Col_DESC">Description</div>
      <div class="IH_COL IH_Col_UPC">UPC</div>
      <div class="IH_COL IH_Col_OH">Stock</div>
      <div class="IH_COL IH_Col_RP">RP</div>
      <div class="IH_COL IH_Col_Price">Price</div>
      <div class="IH_COL IH_Col_Cost">Cost</div>
      <div class="IH_COL IH_Col_MK">Market</div>
      <div class="IH_COL IH_Col_Status">Status</div>
      <div class="IH_COL IH_Col_Menu">Menu</div>
    </div>
    <div id="POS_ItemList_Contents">
      <div id="PIC_MSG"><i class="fa fa-spinner fa-spin"></i> Loading Data...</div>
    </div>
  </div>
</div>
