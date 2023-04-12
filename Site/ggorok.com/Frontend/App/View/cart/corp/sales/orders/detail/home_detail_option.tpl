<div class="Table_Style_1">
	<div class="T_HR">
		<div class="T_HC T_C_Name">Name</div>
		<div class="T_HC T_C_Price">Price</div>
		<div class="T_HC T_C_Qty">Qty</div>
		<div class="T_HC T_C_Sku">Sku</div>
		<div class="T_HC T_C_RewardPoint">Reward Point</div>
	</div>
	
	<?php
	foreach($OrderItem AS $O_F)
	{
		foreach($O_F['Option'] AS $Opts_F)
		{
		?>
			<br />- <?php echo $Opts_F['OIO_Opt_Name'];?>(SKU : <?php echo $Opts_F['OIO_Opt_Sku'];?>)
		<?php
		}
		?>
		<div class="T_R">
			<div class="T_C T_C_Name"><?php echo $O_F['OI_Name'];?></div>
			<div class="T_C T_C_Price"><?php echo $O_F['OI_Price'];?></div>
			<div class="T_C T_C_Qty"><?php echo $O_F['OI_Qty'];?></div>
			<div class="T_C T_C_Sku"><?php echo $O_F['OI_Sku'];?></div>
			<div class="T_C T_C_RewardPoint"><?php echo $O_F['OI_RewardPoint'];?></div>
		</div>
	<?
	}
	?>
</div>