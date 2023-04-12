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
					
					$Data_Card['BusinessHours_CurrentStatus_Icon'] = ($OpenedNow ? 'fa-clock-o fa-spin' : 'fa-moon-o');
					$Data_Card['BusinessHours_CurrentStatus'] = ($OpenedNow ? '현재영업중' : '현재영업종료');
					
					$Data_Card['Card_Class'] = '';
					$Data_Card['Store_ItemTitle'] = ($CardInfo['B'][0]['Store_ItemTitle'] != "" ? $CardInfo['B'][0]['Store_ItemTitle'] : "상품 / 아이템" );
					$Data_Card['Card_ItemGroups'] = $this->_Model_Business->getItemGroup(array(
						'Store_ID' => $CardInfo['B'][0]['Store_ID']
					));
					
					$Data_Card['Date_Today'] = date('Y-m-d');
					$Data_Card['TimeNow_H'] = date('h');
					$Data_Card['TimeNow_M'] = date('i');
					$Data_Card['TimeNow_Meridiem'] = date('A');
					$Data_Card['TimeNow_Now'] = date('h:i:A');
					$Data_Card['TimeNow_30M'] = date('h:i:A',strtotime("+30 minute"));
					$Data_Card['TimeNow_1H'] = date('h:i:A',strtotime("+1 hour"));
					$Data_Card['TimeNow_2H'] = date('h:i:A',strtotime("+2 hour"));
					
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
	public function refreshCart()
	{
		$output['ack'] = 'error';
		$CardID = $this->getCardIDbyURL();
		
		if($CardID != false && $this->login->isLogin())
		{
			$Cart = $this->_Model_Cart->Get(array(
				'Store_ID' => $CardID,
				'customers_id' => $this->login->customers_id
			));
			
			$output['popupCart_HTML'] = '장바구니에 담긴 상품/아이템이 없습니다.';
			
			if(sizeof($Cart) > 0)
			{
				$output['popupCart_HTML'] = '';
				
				foreach($Cart AS $Items_F)
				{
					$output['popupCart_HTML'] .= $this->Load->View('www/CardDetail/PopupCart_Item.tpl',array(
						'Cart_ID' => $Items_F['Cart_ID'],
						'Item_Image' => ($Items_F['Item_Image'] != "" ? '<img src="/Template/Img/CData/'.$Items_F['customers_id'].'/B/'.$Items_F['Store_ID'].'/Item/'.$Items_F['Item_Image'].'" />' : '<i class="fa fa-image"></i>'),
						'Item_Name' => $Items_F['Item_Name'],
						'QTY' => $Items_F['QTY'].'개',
						'Store_URL' => $Items_F['Store_URL'],
						'Item_Price' => ($Items_F['Item_Price'] == 0 ? '무료' : number_format($Items_F['Item_Price'],0).'원')
					));
				}
				$output['ack'] = 'success';
				$output['qty'] = sizeof($Cart);
			}
		}
		
		return $output;
	}
	private function getCardIDbyURL()
	{
		
		$URL_Arr = explode('/',preg_replace('/^\//','',$_SERVER['REQUEST_URI']));
		if(sizeof($URL_Arr) > 1)
		{
			$URL_Arr = explode('?',$URL_Arr[1]);
			return $this->_Model_Business->getStoreID_By_SeoURL(array('Store_URL' => $URL_Arr[0]));
		}
	}
	public function getItemList()
	{
		$output['ack'] = 'error';
		$CardID = $this->getCardIDbyURL();
		
		if(is_numeric($CardID) && isset($_POST['ItmGrpID']))
		{
			$Items = $this->_Model_Business->getItemsInGroup(array(
				'Store_ID' => $CardID,
				'ItemGrp_ID' => $_POST['ItmGrpID']
			));
			
			if(sizeof($Items) > 0)
			{
				$output['html'] = '';
				foreach($Items AS $Items_F)
				{
					$output['html'] .= cleanHTML('
						<div class="Item_One Glow" data-itemid="'.$Items_F['Item_ID'].'">
							<div class="Item_Img">'.($Items_F['Item_Image'] != "" ? '<img src="/Template/Img/CData/'.$Items_F['customers_id'].'/B/'.$Items_F['Store_ID'].'/Item/'.$Items_F['Item_Image'].'" />' : '<i class="fa fa-image"></i>').'</div>
							<div class="Item_Name">'.$Items_F['Item_Name'].'</div>
							<div class="Item_AddCart noSelect Glow"><i class="fa fa-plus-square"></i><i class="fa fa-shopping-cart"></i>'.($Items_F['Item_Price'] == 0 ? '무료' : number_format($Items_F['Item_Price'],0).'원').'</div>
						</div>
					');
				}
			}
			else
				$output['html'] = '<div class="noItemsAdded">등록된 아이템이 없습니다.</div>';
			$output['ack'] = 'success';
		}
		
		return $output;
	}
}
?>