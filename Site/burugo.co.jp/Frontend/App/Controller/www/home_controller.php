<?
class wwwHome_Controller extends GGoRok
{
	
	function home()
	{
		
		$Data['title'] = 'Burugo | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '부르고';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/home.tpl',$Data);
		echo $this->Load->View('www/footer.tpl');
	
	}
	function refreshPage()
	{
		$output['ack'] = 'error';
		if(isset($_POST['K']) && $_POST['K'] != "")
		{
			$output['ack'] = 'success';
			$SearchResult = $this->_Model_Search->SearchByKeyword(array(
				'Keyword' => $_POST['K'],
				'RelatedKeyword' => (isset($_POST['RK']) ? explode('+',$_POST['RK']) : NULL)
			));
			$output['BusinessLists'] = '';
			$output['FriendLists'] = '';
			$output['HelperLists'] = '';
			
			$output['FriendCards'] = '';
			
			if(sizeof($SearchResult['B']) > 0)
			{
				$i = 0;
				foreach($SearchResult['B'] AS $_F)
				{
					$ImgFileLocation = 'Img/CData/'.$_F['customers_id'].'/B/'.$_F['Store_ID'].'/MainImg/'.$_F['Img_FileName'];
					$CardURL = '/b/'.$_F['Store_URL'];
					
					$output['Business'][] = array(
						'bID' => $_F['Store_ID'],
						'cID' => $_F['customers_id'],
						'Lon' => $_F['Store_Lng'],
						'Lat' => $_F['Store_Lat'],
						'T' => 1,
						'U' => $CardURL,
						'Name' => $_F['Store_Name'],
						'CNum' => $_F['Store_ContactNumber'],
						'OwnerName' => $_F['Store_OwnerName'],
						'ShortD' => $_F['Store_ShortDesc'],
						'Addr1' => $_F['Store_Address1'],
						'Addr2' => $_F['Store_Address2'],
						'I' => (is_file(__FrontendPath__.$ImgFileLocation) ? '/Template/'.$ImgFileLocation:""));
					
					$output['BusinessLists'] .= '
						<div class="LVT_Business_One Glow" data-index="'.$i.'">
							<div class="LVTB_MainImg">'.'<img src="/Template/'.$ImgFileLocation.'" /></div>
							<div class="LVTB_DescWrap">
								<div class="LVTB_Name"><i class="LVTB_Viewing fa fa-spin fa-star"></i><a href="'.$CardURL.'">'.$_F['Store_Name'].'</a></div>
								<div class="LVTB_ShortDesc">'.$_F['Store_ShortDesc'].'</div>
								<div class="LVTB_CardKeywords">#'.$_F['Keyword'].'</div>
							</div>
						</div>
					';
					$i++;
				}
			}
			
			if(sizeof($SearchResult['F']) > 0)
			{
				$i = 0;
				foreach($SearchResult['F'] AS $_F)
				{
					$ImgFileLocation = '/Template/Img/CData/'.$_F['customers_id'].'/F/'.$_F['Card_ID'].'/CardImg/';
					if(isset($_F['CardImg'][0]['Img_FileName']))
						$F_MainImg = $ImgFileLocation.$_F['CardImg'][0]['Img_FileName'];
					
					$AddtImg_HTML = '';
					for($j = 2 ; $j < 8 ; $j++)
					{
						$AddtImg_HTML .= '<div class="Card_Pic Card_Pic_Addt_One" data-picaddtid="'.$j.'">'.( isset($_F['CardImg'][$j - 1]) ? '<img src="'.$ImgFileLocation.$_F['CardImg'][$j - 1]['Img_FileName'].'" />' : '' ).'</div>';
					}
					
					$output['FriendLists'] .= '
						<div class="LVT_Business_One Glow" data-index="'.$i.'">
							<div class="LVTB_MainImg">'.(isset($F_MainImg) ? '<img src="'.$F_MainImg.'" />' : '').'</div>
							<div class="LVTB_DescWrap">
								<div class="LVTB_Name"><i class="LVTB_Viewing fa fa-spin fa-star"></i><a>'.$_F['Friend_Name'].'</a></div>
								<div class="LVTB_ShortDesc">'.$_F['Friend_ShortDesc'].'</div>
								<div class="LVTB_CardKeywords">#'.$_F['Keyword'].'</div>
							</div>
							<div class="LVTB_Card hidden">
								<div class="F_Card">
									<div class="Card_One Glow">
										<div class="Card_Pic Card_Pic_Main Glow C_Comon" data-picaddtid="1">'.(isset($F_MainImg) ? '<img src="'.$F_MainImg.'" />' : '').'</div>
										<div class="Card_Pic_Addt C_Comon">
											'.$AddtImg_HTML.'
										</div>
										<div class="Card_Name C_Comon"><span id="CN_Name">'.$_F['Friend_Name'].'</span> <span id="CN_Status">( <i class="fa fa-heart-o"></i> 싱글 )</span></div>
										
										<div class="Card_Menu C_Comon">
											<div class="CM_Icon_One CMI_Phone Glow" data-tooltip="연락처"><i class="fa fa-phone"></i></div>
											<div class="CM_Icon_One CMI_Chat Glow" data-tooltip="채팅"><i class="fa fa-commenting-o"></i></div>
											<div class="CM_Icon_One CMI_Map Glow" data-tooltip="위치"><i class="fa fa fa-map-o"></i></div>
											<div class="CM_Icon_One CMI_Detail Glow" data-tooltip="자세히"><i class="fa fa-folder-open-o"></i></div>
										</div>
										<div id="Card_ShortD" class="C_Comon">
											<p id="Card_ShortD_Contents">'.$_F['Friend_ShortDesc'].'</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					';
					
					
					$i++;
				}
			}
		}
		
		
		return $output;
	}
	
	function getCardInfo()
	{
		$output['ack'] = 'error';
		if(
			isset($_POST['CT']) &&
			isset($_POST['cID']) && is_numeric($_POST['cID'])
		)
		{
			if($_POST['CT'] == 'B')
			{
				$Card = $this->_Model_Business->getStore(array(
				
				));
				
				if(sizeof($Card['B']) > 0)
				{
					$Data['FrontImage'] = (isset($Card['B'][0]['MainImage']) ? '<img src="/Template/Img/CData/'.$Card['B'][0]['customers_id'].'/B/'.$Card['B'][0]['Store_ID'].'/MainImg/'.$Card['B'][0]['MainImage'].'" />' : '<i class="fa fa-file-image-o"></i>');
					$Data['Card_Class'] = 'CDB_Business';
					$output['html'] = $this->Load->View('www/CardDetail.tpl',$Data);
					$output['ack'] = 'success';
				}
			}	
			
			
		}
		return $output;
	}
	
	function getRelatedKeyword()
	{
		$output['ack'] = 'error';
		if(isset($_POST['K']) && $_POST['K'] != "")
		{

			$output['ack'] = 'success';
			$Model['Business'] = $this->Load->Model('Business');
			$RelatedKeywords = $this->_Model_CardKeyword->getRelatedKeyword(
				array('Keyword' => $_POST['K'])
			);
			
			foreach($RelatedKeywords AS $RelatedKeywords_F)
			{
				$output['Result'][] = array('K'=>$RelatedKeywords_F['Keyword'],'S'=>'0.42');
			}
			
		}
		return $output;
	}
	
	
	
	
	function random_float ($min,$max) {
		return round($min + lcg_value()*(abs($max - $min)),6);
	}
	
	
	
	
	
}


?>