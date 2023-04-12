<?
class _Admin
{
	public function getAdminInfo_IF_Admin($Page_Admin_Level)
	{
		global $db,$login;
		$err = false;
		$output['Page_Permission'] = false;
		$output['Admin_Level'] = null;
		$Page = null;
		
		if(isset($_GET['page']) && $_GET['page'] != "")
			$Page = preg_replace('/\[slash\]/','/',$_GET['page']);
			
			
		if(!$login->isLogin())
		{
			$err = true;
		}
	
		if(!$err)
		{
			$Admin = $db->QRY("
				SELECT
					admin_level
				FROM
					b_burugo_admin
				WHERE
					customers_id = '".$db->escape($login->_customerID)."'
			");
			
			if(sizeof($Admin) > 0)
			{
				
				$output['Admin_Level'] = $Admin[0]['admin_level'];
				if($Admin[0]['admin_level'] <= $Page_Admin_Level)
					$output['Page_Permission'] = true;
			}
			if(!is_null($Page) && !$output['Page_Permission'])
			{
					$Admin_Specific_Page_Permission = $db->QRY("
						SELECT
							customers_id
						FROM
							b_burugo_admin_page_permission
						WHERE
							page = '".$db->escape($Page)."' AND
							customers_id = '".$db->escape($this->_customerID)."'
					");
					if($Admin_Specific_Page_Permission > 0)
						$output['Page_Permission'] = true;
				
			}
		}
		return $output;
	}
}

?>