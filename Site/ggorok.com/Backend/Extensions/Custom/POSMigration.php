<?php

class POSMigration extends _Extensions
{
	var $_Group = 'Custom';
	var $_Code = 'POSMigration';
	var $_Name = 'Microsoft POS [This is Sample extension]';
	var $_Icon = '<i class="fa fa-laptop"></i>';
	var $inExt_DB;
	# Check if the extension is installed. Code your own checking algorithm depend on the extension.
	function __construct()
	{
		global $db;
		$this->inExt_DB = parent::isInstalled($this->_Code, $this->_Group);
	}
	function _isInstalled()
	{
		global $db;
		# Describe additional uninstalling process
		
		return (sizeof($this->inExt_DB) == 1 ? true : false);
	}
	function _isActivated()
	{
		global $db;
		return (sizeof($this->inExt_DB) == 1 && $this->inExt_DB[0]['Ext_isActive'] == 1 ? true : false);
	}
	
	# Install Extension
	function _install()
	{
		global $db;
		$output['ack'] = 'error';
		if(!$this->_isInstalled())
		{
			$output = parent::install($this->_Code, $this->_Group);
			$AM_ID = $this->db->QRY("SELECT AM_ID FROM gc_admin_menu WHERE AM_Identifier = 'module'");
			
			$this->db->QRY("
				INSERT INTO
					gc_admin_menu
					(
						AM_Name,
						AM_URL,
						AM_Parent_ID,
						AM_Icon,
						Store_ID,
						AM_Identifier
					)
					VALUES
					(
						'".$this->db->escape($this->_Name)."',
						'modules/migrate-pos/',
						'".$AM_ID[0]['AM_ID']."',
						'".$this->db->escape($this->_Icon)."',
						".__StoreID__.",
						'migrate-pos'
					)
			");
			# Describe additional installing process
		}
		else
			$output['error_msg'] = 'The extension is already installed, please uninstall it if you want to reinstall.';
		return $output;
	}
	
	function _uninstall()
	{
		global $db;
		$output['ack'] = 'error';
		if($this->_isInstalled())
		{
			$output = parent::uninstall($this->_Code, $this->_Group);
			# Code additional uninstalling process
			$this->db->QRY("DELETE FROM gc_admin_menu WHERE AM_Identifier = 'migrate-pos'");
		}
		else
			$output['error_msg'] = 'The extension is not installed yet, please refresh the page.';
		return $output;
	}
	
	function _process()
	{
		$output['ack'] = 'error';
		
		return $output;
	}
	
	function _script()
	{
		ob_start();
		?>
		<!--CreditCard Extension-->
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
		</script>
		<?
		return ob_get_clean();
	}
	
	function _setting_html()
	{
		global $db, $_Extensions;
		if(sizeof($this->inExt_DB) > 0)
		{
			
			$Data[0] = $this->inExt_DB[0]['Ext_isActive'];
			$Data[1] = (isJson($this->inExt_DB[0]['Ext_Settings']) ? json_decode($this->inExt_DB[0]['Ext_Settings'],TRUE) : null);
		}
		
		return '
			<div class="Ext_Setting_One">
				<div class="Ext_Setting_T">Activate this extension?</div>
				<div class="Ext_Setting_D">
					<div class="Ext_Setting_Check">
						<i class="fa fa-plug"></i> Use<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','activate',1,$Data[0]).'
					</div>
				</div>
				<div class="Ext_Setting_T">What type of creadit card will be accepted?</div>
				<div class="Ext_Setting_D">
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-visa"></i> Visa<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-visa',1,(isset($Data[1]['cc-visa']) ? $Data[1]['cc-visa'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-mastercard"></i> Master Card<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-master',1,(isset($Data[1]['cc-master']) ? $Data[1]['cc-master'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-amex"></i> Amex<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-amex',1,(isset($Data[1]['cc-amex']) ? $Data[1]['cc-amex'] : '')).'
					</div>
					<div class="Ext_Setting_Check">
						<i class="fa fa-cc-discover"></i> Discover<br />
						'.$_Extensions->create_CheckBox('','Activate','De-Activate','cc-discover',1,(isset($Data[1]['cc-discover']) ? $Data[1]['cc-discover'] : '')).'
					</div>
					
				</div>
				<div class="Ext_Setting_Btns">
					<button class="Ext_Setting_Save_Btn">Save</button>
				</div>
			</div>
		';
	}
	
	function _setting_save($Data = null)
	{
		global $db;
		$output['ack'] = 'error';
		if(!is_null($Data))
		{
			$D = json_decode($Data,TRUE);
			
			if(isset($D['activate']) && isset($D['cc-visa']) && isset($D['cc-master']) && isset($D['cc-amex']) && isset($D['cc-discover']))
			{
				$D_Temp = $D;
				unset($D_Temp['activate']);
				$D_Temp = json_encode($D_Temp);
				$db->QRY("
					UPDATE
						gc_extensions
					SET
						Ext_isActive = '".($D['activate'] == 1?1:0)."',
						Ext_Settings = '".$db->escape($D_Temp)."'
					WHERE
						Store_ID = ".__StoreID__." AND
						Ext_Group = '".$this->_Group."' AND
						Ext_Code = '".$this->_Code."'
				");
				$output['ack'] = 'success';
				
			}
			
			
		}
		return $output;
	}
	
	

}
?>