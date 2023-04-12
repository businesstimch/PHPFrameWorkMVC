<div class="Extension_One" data-code="<?php echo $Ext_Temp_F->_Code;?>" data-group="<?php echo $Ext_Temp_F->_Group;?>">
	<div class="Ext_Name Glow noSelect"><?php echo $Ext_Temp_F->_Icon.' '.$Ext_Temp_F->_Name;?></div>
	<div class="Ext_InstallStatus<?php echo $Ext_Status['Install']['Class'];?>" data-installed="<?php echo ($is_Installed ? 1 : 0);?>" data-tooltip="<?php echo $Ext_Status['Install']['Msg'];?>"><i class="fa fa-thumb-tack"></i></div>
	<?php echo ($is_Installed ? '<div class="Ext_Detail">'.$Ext_Temp_F->_setting_html().'</div>':'');?>
</div>