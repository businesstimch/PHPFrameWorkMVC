<?php
class CartCorpExtensionsHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $_AvailableExt = array(
		'Shipping',
		'Payment',
		'Custom'
	);
	
	function home()
	{
		
		if(isset($_GET['GroupName']) && in_array($_GET['GroupName'],$this->_AvailableExt))
		{
			$GroupName = $_GET['GroupName'];
			
			$Data['title'] = $GroupName.' Extensions | GGoRok Cart';
			$Data['metaK'] = 'GGoRok';
			$Data['metaD'] = 'GGoRok';
			
			$Extensions = $this->_Extensions->load($GroupName);
			$Extension_List = "";
			
			if(isset($Extensions) && $Extensions['ack'] == 'success' && sizeof($Extensions['Class']) > 0)
			{
				foreach($Extensions['Class'] as $K => $Ext_Temp_F)
				{
					$is_Installed = $Ext_Temp_F->_isInstalled();
						
					if($is_Installed)
					{
						
						$Ext_Status['Install'] =
							array(
								'Class' => ' Ext_Installed',
								'Msg' => 'Installed',
								'Data' => 1
							);
						
					}
					else
					{
						$Ext_Status['Install'] =
							array(
								'Class' => '',
								'Msg' => 'Not Installed',
								'Data' => 0
							);
						
					}
					
					$Extension_List .= $Ext_Temp_F->_script() . $this->Load->View('cart/corp/extensions/extensions_list.tpl', array(
						'Ext_Temp_F' => $Ext_Temp_F,
						'is_Installed' => $is_Installed,
						'Ext_Status' => $Ext_Status
					)); 
				}
			}
			else
				$Extension_List .= 'There is no '.$GroupName.' extension.';
			
			
			$Data['MAIN_HTML'] = $this->Load->View('cart/corp/extensions/home.tpl', array(
				'Extension_List' => $Extension_List
			));
			
			$Home_Controller = $this->Load->Controller('cart/corp/home');
			echo $Home_Controller->loadHeader($Data);
		}
		else
		{
			echo $this->Load->View('404.tpl');
		}
	}
	
	function Ext_Command()
	{
		
		$Go = true;
		$output['ack'] = 'error';
		
		$AllowedFunction = array(
			"_install",
			"_uninstall",
			"_setting_save"
		);
		
		if(
			isset($_POST['Group']) && isset($_POST['Code']) &&
			isset($_POST['method']) && in_array($_POST['method'], $AllowedFunction)
		)
		{
			
			$Ext = $this->_Extensions->load($_POST['Group'],$_POST['Code']);
			
			if(class_exists($_POST['Code']))
			{
				$output['ack'] = $Ext['Class'][$_POST['Code']]->{$_POST['method']}((isset($_POST['Data'])?$_POST['Data']:null))['ack'];
			}
		}
		return $output;
	}
}
?>