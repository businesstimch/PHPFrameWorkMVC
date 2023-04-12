<?php
/*
 *
 *
 * Extension Rules
 * - File name and extension class name must be matched
 *
 * Required Functions
 * - isInstalled() : Returns True / Flase
 * - 
*/
class _Extensions extends GGoRok
{
	
	
	function load($Ext_GroupCode, $Ext_Code = null)
	{
		$output['ack'] = 'error';
		$output['Class'] = array();
		$Ext_GroupCode = urldecode($Ext_GroupCode);
		$Ext_Code = (!is_null($Ext_Code) ? urldecode($Ext_Code) : $Ext_Code);
		$Extension_Path = __BackendPath__.'Extensions/'.$Ext_GroupCode;
		
		if(is_dir($Extension_Path))
		{
			
			$Ext_Dir = scandir(__BackendPath__.'Extensions/'.$Ext_GroupCode);
			foreach($Ext_Dir as $Ext_Dir_F)
			{
				if(is_file($Extension_Path.'/'.$Ext_Dir_F))
				{
					include_once($Extension_Path.'/'.$Ext_Dir_F);
					$Ext_Code_Tmp = pathinfo($Ext_Dir_F)['filename'];
					if(	 (!is_null($Ext_Code) && $Ext_Code == $Ext_Code_Tmp) || is_null($Ext_Code)	)
						$output['Class'][$Ext_Code_Tmp] = new $Ext_Code_Tmp;
				}
				
				
			}
			
			$output['ack'] = 'success';
		}
		
		return $output;
	}
	function isInstalled($_Code,$_Group)
	{
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_extensions
			WHERE
				Ext_Code = '".$_Code."' AND
				Ext_Group = '".$_Group."' AND
				Store_ID = '".__StoreID__."'
			LIMIT
				1
		");
	}
	function uninstall($_Code,$_Group)
	{
		
		$output['ack'] = 'success';
		
		$this->db->QRY("
			DELETE FROM
				gc_extensions
			WHERE
				Ext_Code = '".$this->_Code."' AND
				Ext_Group = '".$this->_Group."' AND
				Store_ID = '".__StoreID__."'
		");
		return $output;
		
	}
	
	function install($_Code,$_Group)
	{
		
		$output['ack'] = 'success';
		
		$this->db->QRY("
			INSERT INTO
				gc_extensions
				(
					Ext_Code,
					Ext_Group,
					Ext_isActive,
					Ext_InstalledOn,
					Ext_Settings,
					Store_ID
				)
				VALUES
				(
					'".$_Code."',
					'".$_Group."',
					0 /*Because some setting is required before activate it*/,
					now(),
					'[]',
					'".__StoreID__."'
				)
		");
		return $output;
		
	}
	
	function create_CheckBox($Class, $On, $Off, $Name, $Value, $Activated)
	{
		return '<button class="Ext_Inp '.$Class.($Activated == 1 ? ' Ext_Setting_Check_Activated' : '').'" data-name="'.$Name.'" data-on="'.$On.'" data-off="'.$Off.'" data-value="'.$Value.'">'.($Activated == 1 ? $Off : $On).'</button>';
	}
}
?>