<?php
class Chat_model extends GGoRok {
	
	function Send($_D)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."chat
				(
					Chat_Members_ID,
					customers_id,
					Message
				)
				VALUES
				(
					'".$this->db->escape($_D['Chat_Members_ID'])."',
					'".$this->db->escape($_D['customers_id'])."',
					'".$this->db->escape($_D['Message'])."'
				)
			
		",true);
	}
	
	function getChatMembersID($_D)
	{
		$Where = "";
		$Where .= (isset($_D['Notified']) ? " AND Notified = '".$_D['Notified']."'" : "");
		
		$QRY = "
			SELECT
				Chat_Members_ID
			FROM
				".DB_Table_Prefix."chat
			WHERE
				(
					Chat_Members_ID = '".$this->db->escape($_D['customers_id'])."' OR
					Chat_Members_ID LIKE '".$this->db->escape($_D['customers_id']).":%' OR
					Chat_Members_ID LIKE '%:".$this->db->escape($_D['customers_id']).":%' OR
					Chat_Members_ID LIKE '%:".$this->db->escape($_D['customers_id'])."' OR
					Chat_Members_ID RLIKE '".$this->db->escape($_D['customers_id'])."[-]'
				)
				".$Where."
			GROUP BY
				Chat_Members_ID
			ORDER BY
				Chat_ID ASC
		";
		
		$ChatMembersID = array();
		
		foreach($this->db->QRY($QRY) AS $Val)
		{
			$ChatMembersID[] = $Val['Chat_Members_ID'];
		}
		
		return $ChatMembersID;
	}
	
	function getChatSummaryByMembersID($_D)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."chat
			WHERE
				Chat_Members_ID = '".$this->db->escape($_D['Chat_Members_ID'])."'
			ORDER BY
				Chat_ID DESC
			LIMIT
				1
		");
	}
	
	function SetNotify($_D)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."chat
			SET
				Notified = 1
			WHERE
				Notified = 0 AND
				Chat_Members_ID = '".$this->db->escape($_D['Chat_Members_ID'])."'
		");
		
	}
	
	
	
	function getUnnotifiedChatBoxID($_D)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."chat
			WHERE
				customers_id_to = '".$this->db->escape($_D['customers_id_to'])."'
				Notified = 0
			ORDER BY
				Chat_ID ASC
		");
	}
	
	
	
	function getChat($_D)
	{
		$Where = "";
		$Where .= (isset($_D['Chat_Members_ID']) ? " Chat_Members_ID = '".$this->db->escape($_D['Chat_Members_ID'])."' AND" : "");
		$Where .= (isset($_D['Last_Chat_ID']) ? " Chat_ID > '".$this->db->escape($_D['Last_Chat_ID'])."' AND" : "");
		
		$Where = preg_replace('/AND$/','',$Where);
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."chat
			WHERE
				".$Where."
			ORDER BY
				Chat_ID ASC
			".(isset($_D['Limit']) ? ' LIMIT '.$this->db->escape($_D['Limit']) : '')."
			
		");
	}
}
?>