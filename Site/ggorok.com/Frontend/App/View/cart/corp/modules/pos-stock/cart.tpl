<div class="Cart_One Glow" data-supplierid="<?php echo $Supplier['ID'];?>">
	<div class="SupplierName_Cart" data-tooltip="Supplier Name"><?php echo $Supplier['SupplierName'];?></div>
	<div>Cart Total :</div>

	<div class="TopCartAmount_Block">$ <span class="CartTotal"><?php echo $Summary['Cost_Total'];?></span></div>
	<div class="Cart_Detail">
		<div class="CIO_Row_Head">
			<div class="CIO_Col CIO_SKU">SKU</div>
			<div class="CIO_Col CIO_ItemName">Name</div>
			<div class="CIO_Col CIO_Cost">Price</div>
			<div class="CIO_Col CIO_Price">Cost</div>
			<div class="CIO_Col CIO_Qty">Qty</div>
			<div class="CIO_Col CIO_Menu">Menu</div>
		</div>
		<?php
		foreach($Item AS $_F)
		{
			echo '<div class="CartItem_One Glow" data-itemid="'.$_F['ItemID'].'">';
			echo 		'<div class="CIO_Col CIO_SKU">'.$_F['ItemLookupCode'].'</div>';
			echo 		'<div class="CIO_Col CIO_ItemName">'.$_F['Description'].'</div>';
			echo 		'<div class="CIO_Col CIO_Price">$'.number_format($_F['Price'] * $_F['Qty'],2).'</div>';
			echo 		'<div class="CIO_Col CIO_Cost">$'.number_format($_F['Cost'] * $_F['Qty'],2).'</div>';
			echo 		'<div class="CIO_Col CIO_Qty"><input class="CIO_Qty_Inp" value="'.$_F['Qty'].'" /></div>';
			echo 		'<div class="CIO_Col CIO_Menu">
							<div class="CIOM_One Glow" data-action="update" data-tooltip="Update"><i class="fa fa-refresh"></i></div>
							<div class="CIOM_One Glow" data-action="delete" data-tooltip="Remove"><i class="fa fa-times"></i></div>
						</div>';
			echo '</div>';
		}
		?>
		<div class="CIO_Row_Footer">
			<div class="CIO_Col CIO_ItemName"><?php echo $Summary['ItemQty'];?> Item(s)</div>
			<div class="CIO_Col CIO_Cost">$<?php echo $Summary['Cost_Total'];?></div>
			<div class="CIO_Col CIO_Price">$<?php echo $Summary['Price_Total'];?></div>
			<div class="CIO_Col CIO_Qty"><?php echo $Summary['Qty_Total'];?></div>
			<div class="CIO_Col CIO_Menu"></div>
		</div>

		<div class="Cart_Menu">
			<div class="CM_Wrap">
				<div class="CM_MakePurchaseOrder CM_One">Make Purchase Order</div>
				<div class="CM_DeleteCart CM_One">Delete</div>
			</div>
		</div>
	</div>

</div>
