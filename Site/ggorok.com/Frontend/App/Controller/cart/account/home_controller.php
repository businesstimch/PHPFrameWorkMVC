<?php
class CartAccountHome_Controller extends GGoRok
{
	function home()
	{
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => '',
			'metaD' => '',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));

		echo $this->Load->View('cart/account/home.tpl', array(
		));
		echo $this->Load->View('cart/footer.tpl');

		
		
	}
	
}

?>