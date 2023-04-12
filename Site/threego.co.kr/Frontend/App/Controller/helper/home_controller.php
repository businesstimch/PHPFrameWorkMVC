<?
class HelperHome_Controller extends GGoRok
{
	
	function home()
	{
		
		$Data['title'] = 'Burugo Hepler | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '부르고';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('helper/home.tpl');
		echo $this->Load->View('www/footer.tpl');
	
	}
	
	
	
	
}


?>