<?php
class CartCorpModulesGoogleMerchantGetfeed_Controller extends GGoRok
{
	
	var $Old_DB;
	
	function home()
	{
		$GM_Controller = $this->Load->Controller('cart/corp/modules/google-merchant/home');
		
		$GM_Controller->getFeed();
		
		
	}
	
	
}
?>