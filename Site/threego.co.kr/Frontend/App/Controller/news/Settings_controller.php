<?php
class NewsSettings_controller extends GGoRok
{
	function home()
	{
		$Data['title'] = '세팅 | 부르고';
		$Data['metaK'] = '세팅';
		$Data['metaD'] = '세팅';
		
		echo $this->Load->View('news/header.tpl',$Data);
		echo $this->Load->View('news/Settings.tpl');
		echo $this->Load->View('news/footer.tpl');
	}
}
?>