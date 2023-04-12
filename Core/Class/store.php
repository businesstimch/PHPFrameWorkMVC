<?

class store extends GGoRok
{
	
	var $lang;
	var $Store_ID;
	var $StoreInfo;
	//Errors
	var $_error = array();
	var $Cookie_Name = "Tm*xhd%jZn$#zl";
	var $Cookie_Key = "Tm*xhd%jZn$#zl";
	var $Cookie_Expiration;
	public function __construct()
	{
		global $db, $language,$token,$cookie,$crypt;
		
		$this->Cookie_Expiration = time() + (10 * 365 * 24 * 60 * 60);
	}
	
	public function start($Store_ID_ToLoad = null)
	{
		global $cookie,$crypt;;
		if(is_null($Store_ID_ToLoad) && isset($_cookie[$this->Cookie_Name]))
			$Store_ID_ToLoad = $crypt->decrypt($_cookie[$this->Cookie_Name],$this->Cookie_Key);
		
		$this->StoreInfo = $this->GetStore_Info($Store_ID_ToLoad);
		
		if(isset($this->StoreInfo['Store_ID']))
		{
			$this->Store_ID = $this->StoreInfo['Store_ID'];
			
			//Set Cookie
			if($this->StoreInfo['Store_ID'] != $this->getStoreID_FromCookie())
				$cookie->create_NormalCookie($this->Cookie_Name, $crypt->encrypt($this->StoreInfo['Store_ID'],$this->Cookie_Key), $this->Cookie_Expiration);
		}
	}
	public function GetStore_Info($Store_ID_ToLoad)
	{
		global $login,$db,$cookie,$crypt;
				
		//Only can get stores that customer owns.
		if($login->isLogin())
		{
			$StoreInfo = $db->QRY("
				SELECT
					*
				FROM
					hq_pos_store
				WHERE
					Store_ID = '".$db->escape($Store_ID_ToLoad)."' AND
					customers_id = '".$db->escape($login->_customerID)."'
			");
			
			if(sizeof($StoreInfo) > 0)
			{
				return $StoreInfo[0];
			}
		}
		
		return false;
	}
	private function getStoreID_FromCookie()
	{
		global $crypt;
		
		if(isset($_COOKIE[$this->Cookie_Name]))
			return $crypt->decrypt($_COOKIE[$this->Cookie_Name],$this->Cookie_Key);
	}
	
	
}




?>