<?
class wwwHome_Controller extends GGoRok
{

	function home()
	{
		if(isset($_GET['Mode']) && $_GET['Mode'] == 'Music')
			$this->db->QRY("INSERT INTO delete_me (ipaddr) VALUE('".$_SERVER['REMOTE_ADDR']."')");
		if($this->login->isLogIn())
		{
			$this->login->logout();


			if($this->login->customer['is_firstLogin'])
			{
				header('Location: /create-profile');

			}
		}
		else
		{
			$Login_Controller = $this->Load->Controller('www/login');
			$Login_Controller->home();
		}
	}
}


?>
