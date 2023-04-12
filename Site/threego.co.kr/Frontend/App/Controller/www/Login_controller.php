<?
class wwwLogin_controller extends GGoRok
{
	
	public function loginRequest($Data = null)
	{
		sleep(2);
		$output['ack'] = 'error';
		
		if(!is_null($Data))
		{
			$Data['isSecure'] = true;
		}
		else
		{
			$Data['isSecure'] = false;
			$Data['LogInID'] = (isset($_POST['LogInID_INP']) ? $_POST['LogInID_INP'] : "");
			$Data['LogInPASS'] = (isset($_POST['LogInPASS_INP']) ? $_POST['LogInPASS_INP'] : "");
			$Data['loginTK'] = (isset($_POST['loginTK']) ? $_POST['loginTK'] : "");
		}
		
		if(
			(!$Data['isSecure'] && isset($_POST['loginTK']) && $_POST['loginTK'] != "") || ($Data['isSecure']) &&
			$Data['LogInID'] != "" && $Data['LogInPASS'] != ""
		)
		{
		
		
			if($this->login->do_LogIn($Data['LogInID'],$Data['LogInPASS'],($Data['isSecure'] ? null : $_POST['loginTK'] ),$Data['isSecure']) && $this->login->isLogIn())
			{
				$output['customerName'] = $this->login->customer['customers_fullname'];
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = "존재하지 않는 계정이거나 잘못된 비밀번호 입니다. 다시 시도해 주세요.";
				$Token = $this->token->login_token(true);
				$output['loginTK'] = $Token['loginTK'];
				$output['loginST'] = $Token['loginST'];
			}
		}
		return $output;
	}
	
	function Logout()
	{
		$output['ack'] = 'success';
		$this->login->logout(false);
		return $output;
	}
}

?>