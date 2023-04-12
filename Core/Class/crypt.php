<?
class crypt extends GGoRok
{
	private $iv = 'QjWBbAHg^5$!*927';
	function encrypt($string,$key,$iv = null)
	{

		return openssl_encrypt(
		  $string,
		  'aes-256-cbc',
		  $key,
		  null,
		  (is_null($iv) ? $this->iv:$iv)
		);

	}
	function decrypt($Encrypted,$key,$iv = null)
	{
/*
		echo openssl_decrypt(
		  $Encrypted,
		  'aes-256-cbc',
		  $key,
		  null,
		  (is_null($iv) ? $this->iv:$iv)
		);
*/
		return openssl_decrypt(
		  $Encrypted,
		  'aes-256-cbc',
		  $key,
		  null,
		  (is_null($iv) ? $this->iv:$iv)
		);
		//return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	function encryptPassword($txt,$salt)
	{
		$en = crypt(md5($txt),md5($salt));
		return $en;
	}


}

?>
