<?
class CartHome_Controller extends GGoRok
{
	
	function home()
	{
		
		$Data['title'] = 'GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('cart/home.tpl');
		echo $this->Load->View('www/footer.tpl');
	
	}
	
	
	
	
}


?>