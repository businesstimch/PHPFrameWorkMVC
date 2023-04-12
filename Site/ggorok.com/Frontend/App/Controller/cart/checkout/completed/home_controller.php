<?
class CartCheckoutCompletedHome_Controller extends GGoRok
{
	function home()
	{
		$foundOrder = false;
		if(isset($_GET['oID']) && is_numeric($_GET['oID']) && isset($_GET['Token']))
		{
			$OrderDetail = $this->_Orders->getOrderByID(
			array(
					  "Orders_ID"=>$_GET['oID'],
					  "Token"=>$_GET['Token']
			),TRUE);
			
			if($OrderDetail['ack'] == 'success')
			{
				$foundOrder = true;
			}
		}
		
	
			
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));
			
		echo $this->Load->View('cart/checkout/completed.tpl',array(
			'OrderTXT' => ($foundOrder ? 'Your order has been placed successfully.' : "Oops, We couldn't find your order. There must some mistake please check your URL and try again.")
		));
		
		
		
		echo $this->Load->View('cart/footer.tpl');
	}
}
?>