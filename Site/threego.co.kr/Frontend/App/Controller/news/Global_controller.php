<?php
class NewsGlobal_controller extends GGoRok
{
	function home()
	{
		$Data['title'] = '해외뉴스 | 부르고';
		$Data['metaK'] = '해외뉴스';
		$Data['metaD'] = '해외뉴스';
		
		echo $this->Load->View('news/header.tpl',$Data);
		echo $this->Load->View('news/Global.tpl');
		echo $this->Load->View('news/footer.tpl');
	}
}
?>