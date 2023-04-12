<?
class CEOHome_Controller extends GGoRok
{
	
	function home()
	{
		
		$Data['title'] = 'Burugo | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '부르고';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('ceo/home.tpl');
		echo $this->Load->View('www/footer.tpl');
	
	}
	
	
	
	
}


?>