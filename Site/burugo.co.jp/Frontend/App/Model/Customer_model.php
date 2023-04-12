<?php
class Customer_model extends GGoRok {
	function getCustomerByID($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."customers
			WHERE
				customers_id = '".$this->db->escape($Data['customers_id'])."'
		");
	}
}