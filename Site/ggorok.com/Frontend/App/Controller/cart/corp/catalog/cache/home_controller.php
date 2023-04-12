<?php
class CartCorpCatalogCacheHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	
	function home()
	{
		$Data['title'] = 'Cache Control | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/cache/home.tpl', array(
			
			
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function refreshCache()
	{
		$output['ack'] = 'error';
		if(isset($_POST['Cache']))
		{
			$output = $this->_Cache->Generate();
		}
		return $output;
	}
}

?>