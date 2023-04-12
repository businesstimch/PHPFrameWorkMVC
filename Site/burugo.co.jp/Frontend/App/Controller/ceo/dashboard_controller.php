<?
class CEODashboard_Controller extends GGoRok
{
	
	function home()
	{
		$Model['Business'] = $this->Load->Model('Business');
		
		$Data['title'] = 'Burugo | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '부르고';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		
		if($this->login->isLogin())
			$Data['B'] = $this->_Model_Business->getStore(array(
				'customers_id' => $this->login->customers_id
			));
		
		echo $this->Load->View('ceo/dashboard.tpl',$Data);
		echo $this->Load->View('www/footer.tpl');
	
	}
	
	public function deleteBusiness()
	{
		$output['ack'] = 'error';
		if(isset($_POST['bID']) && $this->_Model_Business->isMyBusiness($_POST['bID']))
		{
			$this->_Model_Business->deleteBusiness($_POST['bID']);
			removeDirectory(__FrontendPath__.'Img/CData/'.$this->login->customers_id.'/B/'.$_POST['bID']);
			$output['ack'] = 'success';
		}
		return $output;
	}
	
	
	
	
}


?>