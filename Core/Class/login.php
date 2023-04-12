<?


class login extends GGoRok
{

	public $_customerID,$customers_id;
	public $customer = array();
	public $lang;
	public $tok;
	//Errors
	var $_error = array();
	var $_message = array(
		'EmailPassDoNotMatch' => 'Username and password do not match.',
		'TokenError' => 'Token Error.',
		'TokenEmpty' => 'Token is Empty.',
		'DataVerificationErr' => 'Data verification error.',
		'ValidEmailRequired' => 'Please use valid email for login.',
		'ValidPasswordRequired' => 'Username and password do not match.'
	);

	function __construct()
	{
		global $GR,$token,$language;
		$this->customers_id = &$this->_customerID;
		loadClass('language,token');

		$this->lang = $language->login();
		$this->tok = $token->login_token(true);

		$this->checkLogin_or_GetCurrentINFO();

	}



	function checkLogin_or_GetCurrentINFO()
	{
		global $cookie,$crypt;

		session_start();
		// 1 Step : Session first
		if(isset($_SESSION['customerID']) && $_SESSION['customerID'] != "")
		{
			$cID = $_SESSION['customerID'];
		}
		else if(defined('__Cookie_LoginName__') && isset($_COOKIE[__Cookie_LoginName__]) && $_COOKIE[__Cookie_LoginName__] != "")
		{

			$cID = $crypt->decrypt($_COOKIE[__Cookie_LoginName__],__Cookie_Key__);
		}

		if(isset($cID))
		{

			$_SESSION['customerID'] = $cID;
			$this->_customerID = $cID;
			$this->customer = $this->getCustomerInfo($cID);
		}
		session_write_close();
	}

	public function saveCustomerCookie_DB($Cookie_Val)
	{
		global $db;
		if(!$this->getCustomerID_By_EntryptedCookie_DB($Cookie_Val))
		{
			$db->QRY("
				 INSERT INTO
					".DB_Table_Prefix."loginhash
					(
						hash,
						customers_id
					)
					VALUE
					(
						'".$this->do_cryptCookie_ServerSide($Cookie_Val)."',
						'".$this->_customerID."'
					)
			");

		}
	}


	public function getCustomerID_By_EntryptedCookie_DB($val)
	{
		global $db;

		$hash = $this->do_cryptCookie_ServerSide($val);

		$Cdata = $db->QRY("
			SELECT
				customers_id
			FROM
				".DB_Table_Prefix."_loginhash
			WHERE
				hash = '".$hash."'
		");
		if(sizeof($Cdata) > 0)
			return ($Cdata[0]['customers_id']);
	}


	protected function getCustomerInfo($cID)
	{
		global $db;

		$info = $db->QRY("
			SELECT
				*,
				DATE_FORMAT(customers_account_created, '%b/%d/%Y') as customers_account_created
			FROM
				".DB_Table_Prefix."customers
			WHERE
				customers_id = '".$cID."'
			LIMIT
				1

		");

		return $info[0];

	}


	public function isLogIn()
	{
		global $cookie;
		return ($this->_customerID != "") ? true : false;
	}


	public function do_LogIn($id,$ps,$token,$login_without_verify = false /*$login_without_verify is for inside programming. If you want to login instantly, forcefully*/)
	{
		global $db,$cookie,$token;

		session_start();
		if($login_without_verify || verifyEmailAddress($id))
		{
			if($login_without_verify || $this->do_verifyLegitPassword($ps))
			{
				if($login_without_verify || isset($_POST['loginST']) && isset($_POST['loginTK']))
				{

					if(!$login_without_verify)
					{
						$token_argv['loginST'] = $_POST['loginST'];
						$token_argv['loginTK'] = $_POST['loginTK'];
					}
					if($login_without_verify || $this->token->login_token(false, $token_argv))
					{

						$customerID = $this->do_verifyCustomer($id, $ps);

						if(is_numeric($customerID) && $customerID > -1)
						{

							$_SESSION['customerID'] = $customerID;
							$this->customer = $this->getCustomerInfo($customerID);
							$cookie->create_SecureCookie(__Cookie_LoginName__,$customerID, time() + (10 * 365 * 24 * 60 * 60) /*Never Expiry*/);
							$this->_customerID = $_SESSION['customerID'];
							return true;
						}
						else
							$this->_error[] = $this->_message['EmailPassDoNotMatch'];
					}
					else
						$this->_error[] = $this->_message['TokenError'];
				}
				else
					$this->_error[] = $this->_message['TokenEmpty'];

			}
			else
				$this->_error[] = $this->_message['ValidPasswordRequired'];

		}
		else
			$this->_error[] = $this->_message['ValidEmailRequired'];

		session_write_close();
		return false;

	}


	public function do_verifyCustomer($id,$ps)
	{
		global $db,$crypt;
		//echo $id;
		$verifyC = $db->QRY('
			SELECT
				customers_id
			FROM
				'.DB_Table_Prefix.'customers
			WHERE
				customers_logon_id = "'.$id.'" AND
				customers_logon_ps = "'.$crypt->encryptPassword($id,$ps).'" AND
				customers_email_verified = 1

		');


		return (sizeof($verifyC) > 0) ? $verifyC[0]['customers_id']:false;
	}

	public function do_verifyLegitPassword($ps)
	{
		$output['ack'] = 'success';
		if(strlen($ps) < __minimum_password_length__)
		{
			$output['ack'] = 'error';
			$output['error_msg'] = '- Minimum password length is '.__minimum_password_length__.' characters';
		}

		return $output;
	}

	public function do_verifySubmittedData($id,$ps)
	{
		//verifyEmailAddress function is from general.php
		$Go = true;

		if(!verifyEmailAddress($id))
		{
			$Go = false;
			$this->_error[] = $this->_message['ValidEmailRequired'];
		}

		if($this->do_verifyLegitPassword($ps)['ack'] != 'success')
		{
			$Go = false;
			$this->_error[] = $this->_message['ValidPasswordRequired'];
		}

		return $Go;
	}

	public function logout($redirect = true)
	{
		global $cookie;

		$cookie->deleteCookie(__Cookie_LoginName__);
		session_start();
		unset($_SESSION['customerID']);
		session_write_close();
		if($redirect)
			header('Location:'.'http://'.$_SERVER['HTTP_HOST']);
	}

}




?>
