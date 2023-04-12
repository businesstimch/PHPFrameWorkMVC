<?

class cookie extends GGoRok
{
		// Cookie Extend : in Second
		var $exntendCookie = 3600;
		//How long login cookie hash will live?
		var $expireLoginCookie;
		
		
	public function __construct()
	{
		//Extend Cookie - Every Refresh (Extend cookie : Current Time + Extended Time)
		$this->expireLoginCookie = time() + ($this->exntendCookie);
	}
	
	public function create_NormalCookie($CookieName, $CookieValue, $expire = null)
	{
		return setcookie($CookieName, $CookieValue ,	$expire , __DocumentRoot__, __CookiePath__);
	}
	
	public function create_SecureCookie($CookieName, $CookieValue, $Expire = null)
	{
		global $crypt;
		
		$Encrypted_Cookie = $crypt->encrypt($CookieValue,__Cookie_Key__);
		
		setcookie($CookieName, $Encrypted_Cookie ,	time()-3600 ,	__DocumentRoot__, __CookiePath__);
		setcookie($CookieName, $Encrypted_Cookie ,	$Expire ,	__DocumentRoot__, __CookiePath__);
		return $Encrypted_Cookie;
	}
	
	
	
	
	public function do_cryptCookie_ServerSide($val)
	{
		return md5(__CookiePath__.$val);
	}
	
	public function do_getCustomerIDByHash($hash)
	{
		global $db;
		return $this->do_verifyValidCustomerCookie($hash);
	}
	
	public function deleteCookie($CookieName)
	{
		setcookie($CookieName, "", time() - 3600, __DocumentRoot__, __CookiePath__);
	}

	
	
}


?>