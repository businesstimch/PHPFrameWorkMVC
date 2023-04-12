<?
class wwwCreateProfile_Controller extends GGoRok
{
	function home()
	{
		echo $this->Load->View('www/header.tpl',array(
			'title' => 'Create Your Profile | IDJBox.com',
			'metaK' => 'Create Profile',
			'metaD' => 'Create Your Profile.'
		));
		
		echo $this->Load->View('www/create-profile.tpl',array(
			
		));
	}
	
}
?>