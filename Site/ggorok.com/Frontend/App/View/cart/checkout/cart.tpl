<style type="text/css">
	#CartPage_Block{width:100%;border:1px solid #e3e3e3;border-radius:5px;min-height:300px;}
	#Cart_Product_List{padding:20px;width:100%;box-sizing:border-box;}
	
	.CartPage_Items{box-sizing:border-box;background-color:white;border-radius:10px;width:100%;overflow-x:auto;min-width:280px;}
	.CartPage_Items .CI_One_H{border-bottom:1px dotted #bcbcbc;border-radius:0px!important;background-color:#e3e3e3!important;cursor:default}
	.CartPage_Items .CI_One{min-width:700px;width:100%;background-color:white;padding-left:5px;padding-right:5px;box-sizing:border-box;border-radius:3px;}
	.CartPage_Items .CI_One_C{padding-bottom:5px;padding-top:5px;border-bottom:1px solid #f4f4f4;width:100%;}
	.CartPage_Items .CI_One:hover{background-color:#f5f5f5;}
	.CartPage_Items .CI_PImg{height:70px;line-height:70px;text-align:center;background-color:#dfdfdf;border-radius:10px;overflow:hidden;}
	.CartPage_Items .CI_PImg span{font-size:0.7em;}
	.CartPage_Items .CI_PImg img{width:100%;height:100%;}
	.CartPage_Items .CI_Name{overflow:hidden;max-height:100px;line-height:25px;}
	.CartPage_Items .CI_Opt_Name{color:#6c6c6c;}
	.CartPage_Items .CI_SKU{line-height:40px;height:40px;}
	.CartPage_Items .CI_Qty{line-height:40px;}
	.CartPage_Items .CI_Qty input{height:40px;width:100%;border:0;margin:0;padding:0;text-align:center;border:1px solid #bcbcbc;box-sizing:border-box;border-radius:10px;vertical-align:top;}
	.CartPage_Items .CI_Qty input:focus{background-color:#fffbdf;}
	.CartPage_Items .CI_Menu{height:40px;line-height:40px;color:white;}
	.CartPage_Items .PQty_Inp{font-size:1em;}
	.CartPage_Items .CI_H{height:30px;line-height:30px;font-weight:bold;text-align:center;}
	.CartPage_Items .CI_PImg_W{width:70px;}
	.CartPage_Items .CI_Name_W{min-width:250px;padding-left:10px;box-sizing:border-box;text-align:left!important;}
	.CartPage_Items .CI_SKU_W{min-width:100px;max-width:200px;margin-right:20px;text-align:center;}
	.CartPage_Items .CI_Qty_W{width:40px;margin-right:20px;}
	.CartPage_Items .CI_Menu_W{width:100px;float:right;}
	
	.CartPage_Items .CI_Menu_One{width:40px;text-align:center;border-radius:10px;font-size:1.5em;cursor:pointer;}
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
</style>
<script type="text/javascript">
	var Refresh_Cart = refreshPage;
	Refresh_Cart.Submit();
</script>
<div id="CartPage_Block">
	<div class="PG_Title">What's In My Cart?</div>
	<div id="Cart_Product_List">
		<i class="fa fa-spin fa-circle-o-notch"></i> Loading Cart
	</div>
</div>