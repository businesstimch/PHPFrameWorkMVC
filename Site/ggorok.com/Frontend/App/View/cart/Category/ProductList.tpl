<div class="TDI_One" data-pid="<?php echo $Prd_ID;?>">
	<a href="<?php echo $P_Url;?>" class="TDI_Pic"><?php echo $Prd_Image;?></a>
	<div class="TDI_DescBox">
		<a href="<?php echo $P_Url;?>" class="TDI_Name block"><?php echo $Prd_Name;?></a>
	</div>
	<div class="TDI_Price">
		List Price : <span><?php echo $Prd_ListPrice;?></span><br />
		Our Price : <b><?php echo $Prd_Price;?></b>
	</div>
	<div class="TDI_ShortD"><?php echo $Prd_Desc_Short;?></div>
	<div class="TDI_Menus">
		<div class="TDI_Menus_One TDI_AddCart noSelect<?php echo ($hasMandatoryOption ? " hasMandatoryOptions":"");?>"><i class="fa fa-cart-plus"></i> Add to Cart</div>
		<a class="TDI_Menus_One TDI_View block" href="<?php echo $P_Url;?>"><i class="fa fa-search"></i> Detail</a>
	</div>
</div>