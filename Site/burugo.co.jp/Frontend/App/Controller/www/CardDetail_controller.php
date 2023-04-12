<?
class wwwCardDetail_controller extends GGoRok
{
	function home()
	{
		$Data_Header['title'] = '비지니스 카드';
		$Data_Header['metaK'] = '비지니스 카드';
		$Data_Header['metaD'] = '비지니스 카드';
		
		$Date['1'] = '일요일';
		$Date['2'] = '월요일';
		$Date['3'] = '화요일';
		$Date['4'] = '수요일';
		$Date['5'] = '목요일';
		$Date['6'] = '금요일';
		$Date['7'] = '토요일';
		
		$URL_Arr = explode('/',preg_replace('/^\//','',$_SERVER['REQUEST_URI']));
		
		
		if(sizeof($URL_Arr) > 1)
		{
			$Go = true;
			$CardID = $this->_Model_Business->getStoreID_By_SeoURL(array('Store_URL' => $URL_Arr[1]));
			
			if(is_numeric($CardID))
			{
				$CardInfo = $this->_Model_Business->getStore(array('Store_ID' => $CardID));
				
				if(sizeof($CardInfo['B']) > 0)
				{
					$CardInfo['B'][0]['Store_Desc'] = ($CardInfo['B'][0]['Store_Desc'] == "" ? "<span style='color:gray;'>자세한 소개글이 없습니다.</span>" : $CardInfo['B'][0]['Store_Desc']);
					
					$Data_Card['FrontImage'] = (isset($CardInfo['B'][0]['MainImage']) ? '/Template/Img/CData/'.$CardInfo['B'][0]['customers_id'].'/B/'.$CardInfo['B'][0]['Store_ID'].'/MainImg/'.$CardInfo['B'][0]['MainImage'] : null);
					$Data_Card['Google_Marker_Icon'] = '/Template/Img/map-marker-business.png'; //map-marker-helper.png,map-marker-friend.png
					$Data_Card['C'] = $CardInfo['B'][0];
					
					
					
					
					
					$OpenedNow = false;
					$Data_Card['BusinessHours'] = '';
					foreach($CardInfo['B'][0]['BusinessHours'] AS $BHours_F)
					{
						/*[ TIM ] Please finish this IF clasues, This one is not yet finished logic*/
						if(
							(date('w') == $BHours_F['Date_ID'] - 1) /* Today Opened ? */ &&
							(time() >= strtotime(date('F j, Y, ').$BHours_F['OpenTime']) /* Based on Open Time */) &&
							(time() < strtotime(date('F j, Y, ').$BHours_F['CloseTime']))
						)
						{
							
							$OpenedNow = true;
						}
						
						$Data_Card['BusinessHours'] .= '<div class="BH_One'.(date('w') == $BHours_F['Date_ID'] - 1 ? ' BH_Today' : '').'">'.$Date[$BHours_F['Date_ID']].' '.$BHours_F['OpenTime'].' ~ '.$BHours_F['CloseTime'].'</div>';
					}
					$Data_Card['BusinessHours_CurrentStatus'] = ($OpenedNow ? '<i class="fa fa-circle-o-notch fa-spin"></i> 현재영업중' : '<i class="fa fa-moon-o"></i> 현재영업종료');
					
					$Data_Card['Card_Class'] = '';
					
				}
				else
					$Go = false;
			}
			else
				$Go = false;
			
			if($Go)
			{
				echo $this->Load->View('www/header.tpl',$Data_Header);
				echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));
				echo $this->Load->View('www/CardDetail.tpl',$Data_Card);
				echo $this->Load->View('www/footer.tpl');
			}
			else
				echo $this->Load->View('404.tpl');
		}
		
		
		
		
		
		
	}
}
?>