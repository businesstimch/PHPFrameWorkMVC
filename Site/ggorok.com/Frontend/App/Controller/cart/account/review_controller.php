<?php
class CartAccountReview_Controller extends GGoRok
{
	function home()
	{
		
		echo $this->Load->View('cart/header_blank.tpl',array(
			'title' => 'Review',
			'metaK' => '',
			'metaD' => '',
		));

		echo $this->Load->View('cart/account/review.tpl', array(
		));
		echo $this->Load->View('cart/footer_blank.tpl');

		
	}
	
	function optout()
	{
		
		
	}
	
	function save()
	{
		
	}
	
}

?>