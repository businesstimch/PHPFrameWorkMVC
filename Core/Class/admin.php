<?
class admin extends GGoRok
{
	public function __construct()
	{
		//global $db;
		
	}
	
	public function isAdminUser($customerID = null)
	{
		if(is_null($customerID) && $this->login->isLogIn())
		{
			$customerID = $this->login->customers_id;
		}
		
		if(!is_null($customerID))
		{
			
			$AdminUser = $this->db->QRY("
				SELECT
					*
				FROM
					gc_admin
				WHERE
					customers_id = '".$customerID."'
			");
			
			if(sizeof($AdminUser) > 0)
				return true;
		}
		else
			return false;
	}
}