<?php
class NewsDomestic_controller extends GGoRok
{
	function home()
	{
		$Data['title'] = '국내뉴스 | 부르고';
		$Data['metaK'] = '국내뉴스';
		$Data['metaD'] = '국내뉴스';
		
		echo $this->Load->View('news/header.tpl',$Data);
		echo $this->Load->View('news/Domestic.tpl');
		echo $this->Load->View('news/footer.tpl');
	}
}
?>