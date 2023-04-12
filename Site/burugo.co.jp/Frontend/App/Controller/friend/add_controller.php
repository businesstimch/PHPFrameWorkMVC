<?
class FriendAdd_Controller extends GGoRok
{
	
	public function home()
	{
		$Data['title'] = 'Burugo Friend | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '친구 추가';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"add"));
		echo $this->Load->View('friend/add.tpl');
		echo $this->Load->View('www/footer.tpl');
	}
	
}


?>