<?

class Order_Model extends GGoRok_Model{
	
	function getOrderby_oID($oID)
	{
		return $this->db->QRY("
			SELECT
				O.*,
				C.customers_firstname,
				C.customers_lastname,
				C.customers_telephone,
				C.customers_fax,
				C.customers_logon_id
			FROM
				gc_orders O
					LEFT JOIN
						gc_customers C
					ON
						C.customers_id = O.customers_id
			WHERE
				O.Orders_ID = '".$this->db->escape($_GET['oID'])."'
		");
	}
	
	function getOrderStatus()
	{
		return $this->db->QRY("
			SELECT
				OStatus_ID,
				OStatus_Name
			FROM
				gc_orders_status
			ORDER BY
				OStatus_ID ASC
		");
	}
}
?>