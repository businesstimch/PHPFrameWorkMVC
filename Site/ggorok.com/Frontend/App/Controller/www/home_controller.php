<?php
class wwwHome_Controller extends GGoRok
{
	
	function home()
	{
			
		$Data['title'] = 'GGoRok';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		echo $this->Load->View('www/header.tpl', array(
			'title' => '',
			'metaK' => '',
			'metaD' => ''
		));
		
		echo $this->Load->View('www/home.tpl', array(
			
		));
		
		echo $this->Load->View('www/footer.tpl', array(
			
		));
	
	}
	
}


?>