<?
class FriendCard_Controller extends GGoRok
{
	public function home()
	{
		$Data['title'] = 'Burugo Friend | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '카드 추가';
		
		
		echo $this->Load->View('www/header.tpl',$Data);
		echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"card"));
		
		if($this->login->isLogin())
			echo $this->Load->View('friend/card.tpl',array(
				'Cards' => $this->_Model_friend_Card->getCard(array(
					'customers_id' => $this->login->customers_id
				))
			));
		else
			echo $this->Load->View('www/loginRequired.tpl');
			
		echo $this->Load->View('www/footer.tpl');
	}
	
	public function saveCard($Data = null)
	{
		$output['ack'] = 'error';
		
		$Go = true;
		if(is_null($Data))
		{
			if(isJson($_POST['Args']))
			{
				$Data = json_decode($_POST['Args'],True);
			}
			else
				$Go = false;
		}
		
		
		if(
			!(
				(isset($Data['Name_INP']) && $Data['Name_INP'] != "") &&
				(isset($Data['Phone_INP']) && $Data['Phone_INP'] != "") &&
				(isset($Data['ShortDesc_INP']) && $Data['ShortDesc_INP'] != "") &&
				(isset($Data['CurrentStatus_SLT'])) &&
				(isset($Data['BDayY_SLT'])) &&
				(isset($Data['BDayM_SLT'])) &&
				(isset($Data['BDayD_SLT'])) &&
				(isset($Data['Look_INP'])) &&
				(isset($Data['Job_INP'])) &&
				(isset($Data['Character_INP'])) &&
				(isset($Data['Religion_SLT'])) &&
				(isset($Data['ReligionImp_SLT'])) &&
				(isset($Data['Gender_SLT'])) &&
				(isset($Data['GenderImp_SLT']))
				
			) ||
			!$this->login->isLogin()
		)
		{
			$Go = false;
		}
		$isUpdate = false;
		
		if(isset($Data['Card_ID']) && is_numeric($Data['Card_ID']))
			$isUpdate = true;
		
		if($isUpdate && !$this->_Model_friend_Card->isMine($Data['Card_ID']))
		{
			$Go = false;
			$output['error_msg'] = '본인의 카드가 아닙니다.';
		}
		
		if($Go)
		{
			$output['ack'] = 'success';
			
			$Data['Friend_BDay'] = ( $Data['BDayY_SLT'] != -1 && $Data['BDayM_SLT'] != -1 && $Data['BDayD_SLT'] != -1 ? $Data['BDayY_SLT'].'-'.$Data['BDayM_SLT'].'-'.$Data['BDayD_SLT'] : "" );
			
			
			$Data['customers_id'] = $this->login->_customerID;
			# Add/Modify Store
			if($isUpdate)
			{
				$this->_Model_friend_Card->Update($Data);
				$CardID = $Data['Card_ID'];
			}
			else
			{
				$CardID = $this->_Model_friend_Card->addCard($Data);
			}
			
			$List_New = array();
			if($isUpdate)
			{
				# Get keywords in this business first.
				$CardKeywords_F = $this->_Model_CardKeyword->loadKeywords(array(
					'Card_ID' => $CardID,
					'Card_Type' => 2
				));
				$CardKeywords_Arr = array();
				
				# Create Keyword array First to compare
				foreach($CardKeywords_F AS $CardKeywords_F)
				{
					if($CardKeywords_F['Keyword_Activated'] == 1)
						$CardKeywords_Arr[] = $CardKeywords_F['Keyword'];
				}
				
				# Create list will be added and deleted.
				$List_New = array_diff($Data['CardKeywords_INP'], $CardKeywords_Arr);
				$List_Delete = array_diff($CardKeywords_Arr, $Data['CardKeywords_INP']);
				
				
				foreach($List_Delete AS $List_Delete_F)
				{
					
					$KeywordID = $this->_Model_CardKeyword->getKeywordID_ByKeyword($List_Delete_F);
					if(sizeof($KeywordID) > 0)
					{
						$this->_Model_CardKeyword->deactivateKeyword(array(
							'Card_ID' => $CardID ,
							'Keyword_ID' => $KeywordID[0]['Keyword_ID']
						));
					}
				}
			}
			else
			{
				
				
			}
			
			# [Store Keywords]
			# Sanitize by trimming
			foreach($Data['CardKeywords_INP'] AS $KEY => $CardKeywords_INP_F)
			{
				$Data['CardKeywords_INP'][$KEY] = htmlspecialchars(trim($CardKeywords_INP_F));
			}
			
			
			$KeywordID_ADD = array();
			# Keyword Bank : If the keyword doesn't exist in keyword bank then insert one.
			foreach($List_New AS $List_New_F)
			{
				$FoundKeywords_FromBank = $this->_Model_CardKeyword->getKeywordID_ByKeyword($List_New_F);
				if(sizeof($FoundKeywords_FromBank) == 0)
				{
					$KeywordID_ADD[] = $this->_Model_CardKeyword->addKeyword_KeywordBank($List_New_F);
				}
				else
					$KeywordID_ADD[] = $FoundKeywords_FromBank[0]['Keyword_ID'];
			}
			
			foreach($KeywordID_ADD AS $KeywordID_ADD_F)
			{
				$CheckKeyword_In_Business = $this->_Model_CardKeyword->hasKeyword(array(
					'Card_ID' => $CardID,
					'Keyword_ID' => $KeywordID_ADD_F
				));
				
				# Check if the keyword does exist in the business
				if(sizeof($CheckKeyword_In_Business) == 0)
				{
					# Doesn't exist? Add One.
					$this->_Model_CardKeyword->addKeyword(array(
						'Card_ID' => $CardID,
						'Keyword_ID' => $KeywordID_ADD_F,
						'Card_Type' => 2
					));
				}
				else if($CheckKeyword_In_Business[0]['Keyword_Activated'] == 0)
				{
					# Does exist but deactivated?
					$this->_Model_CardKeyword->activateKeyword(array(
						'Card_ID' => $CardID ,
						'Keyword_ID' => $KeywordID_ADD_F
					));
				}
				
			}
			
			$this->_Model_CardKeyword->deleteExpiredDeactivatedKeyword(array(
				'Card_ID' => $CardID
			));
			
			
			
			# [StoreImage]
			$ImgUploadAt = __FrontendPath__.'Img/CData/'.$this->login->_customerID.'/F/'.$CardID.'/';
			$Upload_Path['Card_Image'] = $ImgUploadAt.'CardImg/';
			
			foreach($Upload_Path as $Upload_Path_F)
			{
				if(!is_dir($Upload_Path_F))
				{
					mkdir($Upload_Path_F,0775,true);
				}
			}
			
			foreach($_FILES as $K => $_FILES_F)
			{
				if(preg_match("/^CardPics/",$K))
				{
					$isRealImage = getimagesize($_FILES_F['tmp_name']);
					if($isRealImage !== false)
					{
						$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
						$Data_Img['Card_ID'] = $CardID;
						$Data_Img['Img_Type'] = 1;
						$Data_Img['Img_FileName'] = 'CardImg_'.rand(1111,9999).'_'.rand(1111,9999).'_'.rand(1111,9999).($Extention != "" ? '.'.$Extention : "");
						
						# We currently accept only one image for business
						if(is_file($Upload_Path['Card_Image'].$Data_Img['Img_FileName']))
							unlink($Upload_Path['Card_Image'].$Data_Img['Img_FileName']);
							
						$ImageID = $this->_Model_friend_Card->addImage($Data_Img);
						move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path['Card_Image'].$Data_Img['Img_FileName']);
					}
					
					
				}
			}
			
			
		}
		
		return $output;
		
	}
}
?>