<?

class AdminHeader_Model extends GGoRok_Model{
	function getCategory()
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_admin_menu
			WHERE
				Store_ID = '".__StoreID__."'
			ORDER BY
				AM_Parent_ID, AM_Sort ASC
		");
	}
}