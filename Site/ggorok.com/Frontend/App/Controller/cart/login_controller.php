<?
class CartLogin_Controller extends GGoRok
{
	
	function home()
	{
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'Cat' => $this->_Model_Category->getCategory(),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data']
		));
		$LoginToken = $this->token->login_token(true);
		echo $this->Load->View('cart/Login.tpl', array(
			'Redirect' => $this->manageRedirectAfterLogin((isset($_GET['Redirect']) ? $_GET['Redirect'] : null)),
			'loginTK' => $LoginToken['loginTK'],
			'loginST' => $LoginToken['loginST']
		));
		echo $this->Load->View('cart/footer.tpl');
	
	}
	
	function loginRequest($Data = null)
	{
		//sleep(2);
		$output['ack'] = 'error';
		$Error = True;
		
		if(!is_null($Data))
		{
			$Data['isSecure'] = true;
		}
		else
		{
			$Data['isSecure'] = false;
			$Data['LogInID'] = (isset($_POST['LogInID']) ? $_POST['LogInID'] : "");
			$Data['LogInPASS'] = (isset($_POST['LogInPASS']) ? $_POST['LogInPASS'] : "");
			$Data['loginTK'] = (isset($_POST['loginTK']) ? $_POST['loginTK'] : "");
		}
		
		if(
			(!$Data['isSecure'] && isset($_POST['loginTK']) && $_POST['loginTK'] != "") ||
			($Data['isSecure']) && ($Data['LogInID'] != "" && $Data['LogInPASS'] != "")
		)
		{
			
			
			
			if(!filter_var($Data['LogInID'], FILTER_VALIDATE_EMAIL))
			{
				$output['error_msg'] = "Your Login ID must be email address.";
				$Error = true;
			}
			else if(!$this->ValidatePassword($Data['LogInPASS']))
			{
				$output['error_msg'] = "Password Error";
				$Error = true;
			}
			else
			{
				if($this->login->do_LogIn($Data['LogInID'],$Data['LogInPASS'],($Data['isSecure'] ? null : $_POST['loginTK'] ),$Data['isSecure']) && $this->login->isLogIn())
				{
					$output['ack'] = 'success';
				}
				else
				{
					$output['error_msg'] = "Email or Password didn't match, please try again.";
					$Error = true;
				}
			}
		}
		else
		{
			$output['error_msg'] = "We're sorry for the inconvenience. There was an error, please try again or contact customer service.";
			$Error = true;
		}
		if($Error)
		{
			$Token = $this->token->login_token(true);
			$output['loginTK'] = $Token['loginTK'];
			$output['loginST'] = $Token['loginST'];
		}
		
		return $output;
	}
	
	private function manageRedirectAfterLogin($URL)
	{
		return htmlspecialchars($URL);
	}
	
	private function ValidatePassword()
	{
		return true;
	}
	function Logout()
	{
		$output['ack'] = 'success';
		$this->login->logout(false);
		return $output;
	}

	
	
	
}


?>