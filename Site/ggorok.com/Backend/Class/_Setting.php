<?

class _Setting extends GGoRok
{
	var $Data;
	function __Construct()
	{
		
		$Settings = $this->db->QRY("
			SELECT
				*
			FROM
				gc_settings
			WHERE
				Store_ID = ".__StoreID__."
			ORDER BY
				Setting_Group_Key ASC
		");
		foreach($Settings AS $K => $Settings_F)
		{
			$this->Data[$Settings_F['Setting_Group_Key']][$Settings_F['Setting_Key']] = $Settings_F['Setting_Data'];
		}
		
	}
}
?>