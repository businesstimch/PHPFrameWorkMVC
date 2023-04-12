<div data-supplierid="<?php echo $ItemList['SupplierID'];?>" data-peaksold="<?php echo max($ItemList['M1'],$ItemList['M2'],$ItemList['M3'],$ItemList['M4'],$ItemList['M5'],$ItemList['M6']);?>" data-parentid="<?php echo $ItemList['ParentItem'];?>" data-oh="<?php echo ($ItemList['Quantity'] < 0 ? 0 : $ItemList['Quantity']);?>" data-rp="<?php echo $ItemList['New_RP'];?>" data-totalsoldeach="<?php echo ($ItemList['M1'] + $ItemList['M2'] + $ItemList['M3'] + $ItemList['M4'] + $ItemList['M5'] + $ItemList['M6']);?>" data-parentqty="<?php echo $ItemList['ParentQuantity'];?>" class="IH_ROW" data-rowid="<?php echo $ItemList['ItemID'];?>" data-rp="<?php echo $ItemList['New_RP'];?>">
	<div class="IH_COL IH_Col_Supplier"><?php echo $ItemList['SupplierName'];?></div>
	<div class="IH_COL IH_Col_SKU"><?php echo $ItemList['ItemLookupCode'];?></div>
	<div class="IH_COL IH_Col_DESC<?php echo ($ItemList['Ordered'] == 1 ? ' IH_Col_Ordered' : '');?>"><?php echo $ItemList['Description'];?></div>
	<div class="IH_COL IH_Col_RP">

	</div>
	<div class="IH_COL IH_Col_OH"><?php echo (is_numeric($ItemList['Quantity']) ? number_format($ItemList['Quantity']) : $ItemList['Quantity']);?></div>
	<div class="IH_COL IH_Col_Price">
		<?php echo (is_numeric($ItemList['Price']) ? money_format('%(#10n',$ItemList['Price']) : $ItemList['Price']);?>
	</div>
	<div class="IH_COL IH_Col_Cost">
		<?php echo (is_numeric($ItemList['Cost']) ? money_format('%(#10n',$ItemList['Cost']) : $ItemList['Cost']);?>
	</div>
	<div class="IH_COL IH_Col_M IH_Col_M_Hidden">
		<?php echo $ItemList['M1'].'/'.$ItemList['M2'].'/'.$ItemList['M3'].'/'.$ItemList['M4'].'/'.$ItemList['M5'].'/'.$ItemList['M6'];?>
	</div>
	<div class="IH_COL IH_Col_Menu"></div>




</div>
