<?
class HelperAdd_Controller extends GGoRok
{
	
	public function home()
	{
		$Data['title'] = 'Burugo Helper | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '부르미 추가';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));
		echo $this->Load->View('no-service.tpl');
		echo $this->Load->View('www/footer.tpl');
	}
	
}


?>