<?php
class Notification_model extends GGoRok
{	
	function Push($_D)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."notification
				(
					customers_id,
					Notification_Type
				)
				VALUES
				(
					'".$this->db->escape($_D['customers_id'])."',
					'".$this->db->escape($_D['Notification_Type'])."'
				)
			
		",true);
	}
	
	function Get($_D)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."notification
			WHERE
				Notified = 0 AND
				customers_id = '".$this->db->escape($_D['customers_id'])."'
		");
	}
	
	function Notified($_D)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."notification
			SET
				Notified = 1,
				NotifiedOn = CURRENT_TIMESTAMP
			WHERE
				Notified = 0 AND
				customers_id = '".$this->db->escape($_D['customers_id'])."' AND
				CreatedOn >= '".$this->db->escape($_D['CreatedOn'])."'
				
		");
	}
	
}
?>