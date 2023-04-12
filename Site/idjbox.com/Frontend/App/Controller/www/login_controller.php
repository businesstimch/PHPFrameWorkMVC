<?
class wwwLogin_Controller extends GGoRok
{
	function home()
	{
		
		echo $this->Load->View('www/header.tpl',array(
			'title' => 'IDJBox.com',
			'metaK' => 'IDJBox',
			'metaD' => 'IdjBox'
		));
		
		if($this->login->isLogin())
		{
			$Data_Home = array();
			echo $this->Load->View('www/home.tpl',$Data_Home);
		}
		else
		{
			$LoginToken = $this->token->login_token(true);
			echo $this->Load->View('www/login.tpl',array(
				'loginTK' => $LoginToken['loginTK'],
				'loginST' => $LoginToken['loginST']
			));
		}
		
		echo $this->Load->View('www/footer.tpl');
		if(isset($_GET['Music']))
			$this->db->QRY('
				INSERT INTO
					delete_me
					(
						ipaddr
					)
					VALUES
					(
						"'.$_SERVER['REMOTE_ADDR'].'"
					)
			');
	}
	
	public function loginRequest($Data = null)
	{
		//sleep(2);
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
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = $this->login->_error;
				$Token = $this->token->login_token(true);
				$output['loginTK'] = $Token['loginTK'];
				$output['loginST'] = $Token['loginST'];
			}
		}
		return $output;
	}
	
	public function Logout()
	{
		$output['ack'] = 'success';
		$this->login->logout(false);
		return $output;
	}
	
	
	
}


?>