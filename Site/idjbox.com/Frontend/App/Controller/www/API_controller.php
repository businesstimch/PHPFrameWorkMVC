<?php

class wwwAPI_Controller extends GGoRok
{
	
	public function home()
	{
		if(isset($_GET['API_Key']) && $_GET['API_Key'] == 'Okq23jm2Danqjk41wbeb12nqwEjw1')
		{
			echo $this->Load->View('www/header.tpl');
			echo $this->Load->View('www/API.tpl');
			echo $this->Load->View('www/footer.tpl');
		}
		
	}
	
	public function Login()
	{
		$Login = $this->Load->Controller('www/Login');
		return $Login->loginRequest();
	}
	
	public function Logout()
	{
		$Login = $this->Load->Controller('www/Login');
		return $Login->Logout();
	}
	
	public function registerBy_PhoneNumber()
	{
		$Register = $this->Load->Controller('www/Register');
		$Register->registerBy_PhoneNumber();
	}
}

?>