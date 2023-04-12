<?
class FriendCardEdit_Controller extends GGoRok
{
	function home()
	{
		$Data['title'] = 'Burugo Friend | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '카드수정';
		
		echo $this->Load->View('www/header.tpl',$Data);
		
		if($this->login->isLogin())
		{	
			if(isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$CardID = $_GET['id'];
				$C = $this->_Model_friend_Card->getCard(array(
					'Card_ID' => $CardID,
					'customers_id' => $this->login->_customerID
				));
				
				
				if(sizeof($C['C'] > 0))
				{
					
					# Final Output
					echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"card"));
					echo $this->Load->View('friend/card/add-edit.tpl',array(
						'Card' => $C['C'][0]
					));
					echo $this->Load->View('www/footer.tpl');
					
				}
				else
					echo $this->Load->View('404.tpl');
				
				
				
				
				
				
					
				
			}
			
		}
		else
			echo $this->Load->View('www/loginRequired.tpl');
	}
}
?>