<?
class pull extends GGoRok
{
	
	function refresh_TimeStamp($timestamp_name_JS)
	{
		global $login, $db,$login_pos,$store;
		
		$db->QRY("
			UPDATE
				hq_pos_auto_refresh
			SET
				timestamp_updated = NOW()
			WHERE
				Store_ID = '".$db->escape($store->Store_ID)."' AND
				customers_id = '".$db->escape($login->_customerID)."' AND
				timestamp_name_JS = '".$timestamp_name_JS."'
		");
	}
	
}
?>