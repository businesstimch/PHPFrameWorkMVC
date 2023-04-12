<div class="IH_ROW<?php echo (isset($ItemList['isASM']) && $ItemList['isASM'] ? ' IH_ROW_ASM_Head' : '' );?>" data-rowid="<?php echo (isset($ItemList['PSO_ID']) ? $ItemList['PSO_ID'] : '');?>">
	<div class="IH_COL IH_Col_SKU"><?php echo $ItemList['ItemLookupCode'];?></div>
	<div class="IH_COL IH_Col_DESC"><?php echo $ItemList['Description'];?></div>
	<div class="IH_COL IH_Col_UPC"><?php echo (isset($ItemList['UPC']) ? $ItemList['UPC'] : '');?></div>
	<div class="IH_COL IH_Col_OH"><?php echo (is_numeric($ItemList['Quantity']) ? number_format($ItemList['Quantity']) : $ItemList['Quantity']);?></div>
	<div class="IH_COL IH_Col_RP<?php echo ($ItemList['Quantity'] <= $ItemList['New_RP'] ? " IH_Col_RP_Bad" : " IH_Col_RP_Good");?>">
		<?php echo (is_numeric($ItemList['New_RP']) ? number_format($ItemList['New_RP']) : $ItemList['New_RP']);?>
	</div>
	<div class="IH_COL IH_Col_Price">
		<?php echo (is_numeric($ItemList['Price']) ? money_format('%(#10n',$ItemList['Price']) : $ItemList['Price']);?>
	</div>
	<div class="IH_COL IH_Col_Cost">
		<?php echo (is_numeric($ItemList['Cost']) ? money_format('%(#10n',$ItemList['Cost']) : $ItemList['Cost']);?>
	</div>
	<div class="IH_COL IH_Col_MK">
		<?php if(isset($ItemList['Amazon']))
		{
		?>
			<div class="noSelect MKBox AmazonBox<?php echo ($ItemList['Amazon'] == 1 ? ' MK_Activated':'');?>">Amazon</div>
			<div class="noSelect MKBox EbayBox<?php echo ($ItemList['Ebay'] == 1 ? ' MK_Activated':'');?>">Ebay</div>
		<?php
		}
		?>


	</div>
	<div class="IH_COL IH_Col_Status"><?php
		if(isset($ItemList['Status']))
			echo ( $ItemList['Status'] == 1 ? '<i class="fa fa-circle status_on"></i>' : '<i class="fa fa-circle status_off"></i>' );
	?></div>
	<div class="IH_COL IH_Col_Menu">
		<div><i class="fa fa-save"></i></div>
		<div><i class="fa fa-remove"></i></div>
	</div>
</div>
