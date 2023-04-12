<div class="CartPage_Items">
	<div class="CI_One CI_One_H">
		<div class="CI_H CI_PImg_W"></div>
		<div class="CI_H CI_Name_W">Product Name</div>
		<div class="floatR">
			<div class="CI_H CI_Price_W">Unit Price</div>
			<div class="CI_H CI_SKU_W">SKU</div>
			<div class="CI_H CI_Qty_W">Qty</div>
			<div class="CI_H CI_Menu_W">Menu</div>
		</div>
		
	</div>
	
	<?php
	foreach($CartItems AS $_I)
	{
	?>
	<div class="CI_One CI_One_C Glow" data-cartid="<?php echo $_I['Cart_ID'];?>" data-cartuid="<?php echo $_I['Cart_UniqueID'];?>">
		<div class="CI_PImg CI_PImg_W"><?php echo ($_I['Img_FileName'] != "" ? '<img src="/Template/Upload/'.__StoreID__.'/Products/'.$_I['Prd_ID'].'/SC_Thumb/'.$_I['Img_FileName'].'" />' : "<span>No Img</span>");?></div>
		<div class="CI_Name CI_Name_W"><?php echo $_I['Prd_Name'].$_I['Opt_Html_Tmp'];?></div>
		<div class="floatR">
			<div class="CI_Price CI_Price_W"></div>
			<div class="CI_SKU CI_SKU_W"><?php echo $_I['Prd_SKU'];?></div>
			<div class="CI_Qty CI_Qty_W"><input value="<?php echo $_I['Cart_Qty'];?>" class="PQty_Inp Glow" /></div>
			<div class="CI_Menu CI_Menu_W">
				<div class="CI_Menu_One CI_Update_Btn" data-tooltip="Update"><i class="fa fa-refresh"></i></div>
				<div class="CI_Menu_One CI_Delete_Btn" data-tooltip="Remove" data-type="onpage"><i class="fa fa-scissors"></i></div>
			</div>
		</div>
		
	</div>
	<?php }?>
</div>
<div id="PCart_Summary">
	<table id="PCart_Summary_Tbl">
		<tr>
			<td class="PST_T">Items</td>
			<td class="PST_C"><?php echo $Cart_Qty;?> Item(s)</td>
		</tr>
		<tr>
			<td class="PST_T">Sub-Total</td>
			<td class="PST_C"><?php echo $Cart_Sub_Total;?></td>
		</tr>
	</table>
</div>
<div class="PCart_Buttons">
	<a href="/checkout/process/" class="block PCart_Button PCart_ChkoutBtn">Checkout</a>
</div>