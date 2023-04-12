<?php
class posHome_Controller extends GGoRok
{
	
	public function home()
	{
			
		$Data['title'] = 'GGoRok';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		echo $this->Load->View('pos/header.tpl', array(
			'title' => '',
			'metaK' => '',
			'metaD' => ''
		));
		
		
		if($this->login->isLogIn())
		{
		
			echo $this->Load->View('pos/home.tpl', array(
				
			));
		}
		else
		{
			
			echo $this->Load->View('pos/login-pos.tpl', array(
				
			));
		}
			
		echo $this->Load->View('pos/footer.tpl', array(
			
		));
	
	}
	
	public function OrderList()
	{
		
	}
	
	public function loginEmployer()
	{
		
		
	}
	
	
}


?>