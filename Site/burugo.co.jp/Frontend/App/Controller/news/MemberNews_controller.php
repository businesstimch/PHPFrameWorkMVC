<?php
class NewsMemberNews_controller extends GGoRok
{
	function home()
	{
		$Data['title'] = '국민참여 뉴스 | 부르고';
		$Data['metaK'] = '국민참여 뉴스';
		$Data['metaD'] = '국민참여 뉴스';
		
		echo $this->Load->View('news/header.tpl',$Data);
		echo $this->Load->View('news/MemberNews.tpl');
		echo $this->Load->View('news/footer.tpl');
	}
}
?>