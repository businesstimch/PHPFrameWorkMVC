<?
class FriendHome_Controller extends GGoRok
{
	
	function home()
	{
		
		$Data['title'] = 'Burugo Friend | Easy Life with Burugo';
		$Data['metaK'] = '부르고 프렌드';
		$Data['metaD'] = '부르고';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('friend/home.tpl');
		echo $this->Load->View('www/footer.tpl');
	
	}
	
	
	
	
}


?>