<?
class CartHome_Controller extends GGoRok
{
	
	function home()
	{
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data']
		));
		
		echo $this->Load->View('cart/home.tpl');
		echo $this->Load->View('cart/footer.tpl');
	
	}
	
	
	
	
}


?>