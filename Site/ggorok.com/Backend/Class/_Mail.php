<?
loadClass('_Setting');
class _Mail extends GGoRok
{
	var $Setting_Group_Key = 'Email';
	function Setting()
	{
		global $_Setting;
		$Setting = array(
			"From" => $this->_Setting->Data[$this->Setting_Group_Key]['DefaultEmail'],
			"FromName" => $this->_Setting->Data[$this->Setting_Group_Key]['DefaultEmailName'],
			"To" => "",
			"Password" => $this->_Setting->Data[$this->Setting_Group_Key]['DefaultEmailPassword'],
			"Subject" => "",
			"Body_HTML" => "",
			"Body_Plain" => ""
		);
		
		return $Setting;
	}
	function getTemplate($Template_Name,$Data = null)
	{
		global $_Setting;
		if(isset($this->_Setting->Data[$this->Setting_Group_Key][$Template_Name]))
		{
			$Template = $this->_Setting->Data[$this->Setting_Group_Key][$Template_Name];
			if(is_array($Data))
				foreach($Data AS $K => $Data_F)
				{
					$Template = str_replace("[__Variable_".($K + 1)."__]",$Data_F,$Template);
				}
			
			return $Template;
		}
		
	}
}

?>