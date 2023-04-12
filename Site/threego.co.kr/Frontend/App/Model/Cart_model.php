<?php
class Cart_model extends GGoRok {
	function Add($Data)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."store_items_cart
				(
					customers_id,
					Store_ID,
					Item_ID,
					Item_Name,
					QTY
				)
				VALUES
				(
					'".$this->db->escape($Data['customers_id'])."',
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($Data['Item_ID'])."',
					'".$this->db->escape($Data['Item_Name'])."',
					'".$this->db->escape($Data['AddedQty'])."'
				)
		",TRUE);
	}
	
	function Remove($Data)
	{
		
	}
	
	function Update($Data)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? " AND Store_ID = '".$Data['Store_ID']."'" : "");
		
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."store_items_cart
			SET
				QTY = QTY + '".$this->db->escape($Data['QTY'])."'
			WHERE
				customers_id = '".$this->db->escape($Data['customers_id'])."' AND
				Item_ID = '".$this->db->escape($Data['Item_ID'])."'".
				$Where."
		");
	}
	
	function Get($Data)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? " AND IC.Store_ID = '".$Data['Store_ID']."'" : "");
		$Where .= (isset($Data['Item_ID']) ? " AND IC.Item_ID = '".$Data['Item_ID']."'" : "");
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_items_cart IC,
				".DB_Table_Prefix."store_items I,
				".DB_Table_Prefix."store S
			WHERE
				IC.Item_ID = I.Item_ID AND
				S.Store_ID = IC.Store_ID AND
				IC.customers_id = '".$this->db->escape($Data['customers_id'])."'".
				$Where."
		");
	}
}
?>