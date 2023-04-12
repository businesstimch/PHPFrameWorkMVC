<?
class FriendCardAdd_Controller extends GGoRok
{
	function home()
	{
		$Data['title'] = 'Burugo Friend | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '친구 추가';
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"card"));
		echo $this->Load->View('friend/card/add-edit.tpl');
		echo $this->Load->View('www/footer.tpl');
	}
}
?>