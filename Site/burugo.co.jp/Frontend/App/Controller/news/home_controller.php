<?php
class NewsHome_controller extends GGoRok
{
	function home()
	{
		$Data['title'] = '국민참여 뉴스 | 부르고';
		$Data['metaK'] = '뉴스,찾아가는 뉴스,뉴스검색';
		$Data['metaD'] = '뉴스 검색';
		
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('news/home.tpl');
		echo $this->Load->View('www/footer.tpl');
	}
	
	function getRelatedKeyword()
	{
		$output['ack'] = 'error';
		if(isset($_POST['K']) && $_POST['K'] != "")
		{

			$output['ack'] = 'success';
			if($_POST['K'] == '박근혜')
			{
				$output['Result'][] = array('K'=>'북방권교류<br />협의회','S'=>'0.42');
				$output['Result'][] = array('K'=>'세월호','S'=>'0.592');
				$output['Result'][] = array('K'=>'대통령','S'=>'0.191');
				$output['Result'][] = array('K'=>'대통령 후보','S'=>'0.033');
				$output['Result'][] = array('K'=>'비서실 실장','S'=>'0.592');
				$output['Result'][] = array('K'=>'서명운동','S'=>'0.392');
				$output['Result'][] = array('K'=>'인터뷰','S'=>'0.392');
				$output['Result'][] = array('K'=>'예비후보','S'=>'0.392');
				$output['Result'][] = array('K'=>'외교순방','S'=>'0.42');
				
			}
			
			
			
		}
		return $output;
	}
}
?>