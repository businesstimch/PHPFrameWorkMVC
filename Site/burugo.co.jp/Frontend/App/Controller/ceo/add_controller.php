<?
class CEOAdd_Controller extends GGoRok
{
	private $Max_BusinessKeyword = 10;
	
	public function home()
	{
		$Data['title'] = 'Burugo | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '비지니스 추가';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		
		if($this->login->isLogin())
			echo $this->Load->View('ceo/business/business.tpl',array(
				'Business_Hours_HTML' => $this->_Lang_ceo_business['no_hours'],
				'Left_Menu' => 'add'
			));
		else
			echo $this->Load->View('www/loginRequired.tpl');
			
		echo $this->Load->View('www/footer.tpl');
	}
	
	public function uploadLongDescImg()
	{
		$output['ack'] = 'error';
		if(isset($_POST['Store_ID']) && $this->_Model_Business->isMyBusiness($_POST['Store_ID']))
		{
			$output['ack'] = 'success';
			$ImgUploadPathShort = 'Img/CData/'.$this->login->_customerID.'/B/'.$_POST['Store_ID'].'/LDesc/';
			$Upload_Path['Store_Image'] = __FrontendPath__.$ImgUploadPathShort;
			$output['imgs'] = array();
			foreach($Upload_Path as $Upload_Path_F)
			{
				if(!is_dir($Upload_Path_F))
				{
					mkdir($Upload_Path_F,0775,true);
				}
			}
			
			foreach($_FILES as $K => $_FILES_F)
			{
				if(preg_match("/^ImgFile/",$K))
				{
					$isRealImage = getimagesize($_FILES_F['tmp_name']);
					if($isRealImage !== false)
					{
						$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
						move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path['Store_Image'].$_FILES_F["name"]);
						$output['imgs'][] = $ImgUploadPathShort.$_FILES_F["name"];
					}
					else
					{
						$output['ack'] = 'error';
						$output['error_msg'] = '<i class="fa fa-info-circle"></i> 사진 파일만 업로드 가능 합니다.';
						break;
						
					}
				}
			}
		}
		
			
		return $output;
	}
	function dd()
	{
		if(isset($this->_Lang_ceo_business))
		{
			
		}
	}
	public function businessHours_HTML($Data = null)
	{
		$output['ack'] = 'error';
		$output['html'] = '';
		if(is_null($Data))
			$Data = $_POST;
			
		$Data[1] = $this->_Lang_general['sunday'];
		$Data[2] = $this->_Lang_general['monday'];
		$Data[3] = $this->_Lang_general['tuesday'];
		$Data[4] = $this->_Lang_general['wednesday'];
		$Data[5] = $this->_Lang_general['thursday'];
		$Data[6] = $this->_Lang_general['friday'];
		$Data[7] = $this->_Lang_general['saturday'];
		
		if(isset($Data['dID']) && is_numeric($Data['dID']) && $Data['dID'] > 0 && $Data['dID'] < 8)
		{
			
			$output['ack'] = 'success';
			$OH = '';
			$OM = '';
			$CH = '';
			$CM = '';
			
			
			for($i = 0 ; $i < 24 ; $i++)
			{
				$OH .= '<option'.(isset($Data['OT']) && date('H',strtotime($Data['OT'])) == $i ? ' selected="selected"':'').'>'.sprintf("%02d", $i).'</option>';
				$CH .= '<option'.(isset($Data['CT']) && date('H',strtotime($Data['CT'])) == $i ? ' selected="selected"':'').'>'.sprintf("%02d", $i).'</option>';
			}
			
			for($i = 0 ; $i < 60 ; $i++)
			{
				$OM .= '<option'.(isset($Data['OT']) && date('i',strtotime($Data['OT'])) == $i ? ' selected="selected"':'').'>'.sprintf("%02d", $i).'</option>';
				$CM .= '<option'.(isset($Data['CT']) && date('i',strtotime($Data['CT'])) == $i ? ' selected="selected"':'').'>'.sprintf("%02d", $i).'</option>';
			}
			
			$output['html'] = $this->Load->View('ceo/business/business-hours.tpl',array(
				'OH' => $OH,
				'OM' => $OM,
				'CH' => $CH,
				'CM' => $CM,
				'dID' => $Data['dID'],
				'Date' => $Data[$Data['dID']]
			));
		}
		
		return $output;
	}
	
	public function getAddressIdea()
	{
		
		$output['ack'] = 'error';
		if(isset($_POST['K']) && $_POST['K'] != "")
		{
			$output['ack'] = 'success';
			$output['html'] = '';
			$Model_Address = $this->Load->Model('Address');
			
			if(preg_match('/co\.jp/',$_SERVER['HTTP_HOST']))
			{
				$AddrIdea = $Model_Address->getAddressIdea_Japan($_POST['K']);
				foreach($AddrIdea AS $AddrIdea_F)
				{
					$output['html'] .= '<div><span>'.$AddrIdea_F['Prefectures'].' '.$AddrIdea_F['City_Kanji'].' '.$AddrIdea_F['Townarea_Kanji'].'</span></div>';
				}
			}
			else
			{
				$AddrIdea = $Model_Address->getAddressIdea_Korea($_POST['K']);
				foreach($AddrIdea AS $AddrIdea_F)
				{
					$output['html'] .= '<div><span>'.$AddrIdea_F['CityDo_Name'].' '.$AddrIdea_F['CityGunGu_Name'].' '.$AddrIdea_F['EubMyunDong_Name'].' '.$AddrIdea_F['Street_Name'].'</span></div>';
				}
			}
		}
		return $output;
	}
	
	public function getAddItemAndGroup_HTML()
	{
		$output['ack'] = 'success';
		$output['itemgroup_html'] = $this->Load->View('ceo/business/add-group.tpl');
		$output['item_html'] = $this->Load->View('ceo/business/add-item.tpl');
		return $output;
	}
	
	public function saveStore($Data = null)
	{
		$output['ack'] = 'error';
		$Model['Business'] = $this->Load->Model('Business');
		
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
				(isset($Data['StoreName_INP']) && $Data['StoreName_INP'] != "") &&
				(isset($Data['SEOUrl_INP']) && $Data['SEOUrl_INP'] != "") &&
				(isset($Data['CardKeywords_INP']) && $Data['CardKeywords_INP'] != "") &&
				(isset($Data['Address1_INP']) && $Data['Address1_INP'] != "") &&
				(isset($Data['Address2_INP']) && $Data['Address2_INP'] != "") &&
				(isset($Data['StoreShortDesc_INP']) ) &&
				(isset($Data['StoreDescLong_INP'])) &&
				(isset($Data['StoreOwnerName_INP'])) &&
				(isset($Data['StoreBusinessHours_INP'])) &&
				(isset($Data['ItemTitle_INP']))
			)
		)
		{
			$Go = false;
		}
		
		
		if($Go)
		{
			$output['ack'] = 'success';
			
			
			
			$isUpdate = false;
			$Data['customers_id'] = $this->login->_customerID;
			# Add/Modify Store
			if(isset($Data['Store_ID']) && is_numeric($Data['Store_ID']))
			{
				$isNewAddr = $Model['Business']->isNewAddress(
					array(
						'Store_ID' => $Data['Store_ID'],
						'Store_Address1' => $Data['Address1_INP'],
						'Store_Address2' => $Data['Address2_INP']
					)
				);
				if(sizeof($isNewAddr) == 0)
				{
					$GeoInfo = $this->Geo->getInfo(array("Address" => preg_replace('/ /','+',$Data['Address1_INP'].$Data['Address2_INP'])));
					$Data['Store_Lng'] = $GeoInfo['lng'];
					$Data['Store_Lat'] = $GeoInfo['lat'];
				}
				
				$Model['Business']->Update($Data);
				$isUpdate = true;
				$StoreID = $Data['Store_ID'];
			}
			else
			{
				$GeoInfo = $this->Geo->getInfo(array("Address" => preg_replace('/ /','+',$Data['Address1_INP'].$Data['Address2_INP'])));
				$Data['Store_Lng'] = $GeoInfo['lng'];
				$Data['Store_Lat'] = $GeoInfo['lat'];
				$StoreID = $Model['Business']->addStore($Data);
			}
			
			# [Store Keywords]
			
			# Sanitize by trimming
			foreach($Data['CardKeywords_INP'] AS $KEY => $CardKeywords_INP_F)
			{
				$Data['CardKeywords_INP'][$KEY] = htmlspecialchars(trim($CardKeywords_INP_F));
			}
			
			if($isUpdate)
			{
				# Get keywords in this business first.
				$BusinesssKeywords = $this->_Model_CardKeyword->loadKeywords(array(
					'Card_ID' => $StoreID,
					'Card_Type' => 2
				));
				$CardKeywords_Arr = array();
				
				# Create Keyword array First to compare
				foreach($BusinesssKeywords AS $CardKeywords_F)
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
							'Card_ID' => $StoreID ,
							'Keyword_ID' => $KeywordID[0]['Keyword_ID']
						));
					}
				}
			}
			else
			{
				# Simply pass the variable to be added.
				$List_New = $Data['CardKeywords_INP'];
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
				$CheckKeyword_In_Business = $this->_Model_CardKeyword->hasKeyword(array('Card_ID' => $StoreID , 'Keyword_ID' => $KeywordID_ADD_F));
				
				# Check if the keyword does exist in the business
				if(sizeof($CheckKeyword_In_Business) == 0)
				{
					# Doesn't exist? Add One.
					$this->_Model_CardKeyword->addKeyword(array('Card_ID' => $StoreID , 'Keyword_ID' => $KeywordID_ADD_F, 'Card_Type' => 1));
				}
				else if($CheckKeyword_In_Business[0]['Keyword_Activated'] == 0)
				{
					# Does exist but deactivated?
					$this->_Model_CardKeyword->activateKeyword(array('Card_ID' => $StoreID , 'Keyword_ID' => $KeywordID_ADD_F));
				}
				
			}
			
			$this->_Model_CardKeyword->deleteExpiredDeactivatedKeyword(array(
				'Card_ID' => $StoreID
			));
			
			# Item Group
			$i = 0;
			foreach($Data['ItemGrp'] AS $ItemGrp_F)
			{
				
				if(is_numeric($ItemGrp_F['ID']))
				{
					// Update Item Grouop
					$this->_Model_Business->updateItemGroup(array(
						'Store_ID' => $StoreID,
						'ItemGrp_ID' => $ItemGrp_F['ID'],
						'ItemGrp_Name' => $ItemGrp_F['N'],
						'ItemGrp_Sort' => $i
					));
				}
				else if($ItemGrp_F['ID'] == "")
				{
					// Add Item Group
					$this->_Model_Business->addItemGroup(array(
						'Store_ID' => $StoreID,
						'ItemGrp_Name' => $ItemGrp_F['N'],
						'ItemGrp_Sort' => $i
					));
				}
				$i++;
			}
			
			
			
			
			
			# Store Hours
			$Data_Hour['Store_ID'] = $StoreID;
			$Data_Hour['Arr'] = $Data['StoreBusinessHours_INP'];
			$Model['Business']->SaveStoreHours($Data_Hour);
			
			# StoreImage
			$ImgUploadAt = __FrontendPath__.'Img/CData/'.$this->login->_customerID.'/B/'.$StoreID.'/';
			$Upload_Path['Store_Image'] = $ImgUploadAt.'MainImg/';
			
			foreach($Upload_Path as $Upload_Path_F)
			{
				if(!is_dir($Upload_Path_F))
				{
					mkdir($Upload_Path_F,0775,true);
				}
			}
			
			foreach($_FILES as $K => $_FILES_F)
			{
				if(preg_match("/^StoreImage$/",$K))
				{
					$isRealImage = getimagesize($_FILES_F['tmp_name']);
					if($isRealImage !== false)
					{
						$Extention = pathinfo(basename($_FILES_F["name"]), PATHINFO_EXTENSION);
						$Data_Img['Store_ID'] = $StoreID;
						$Data_Img['Img_Type'] = 1;
						$Data_Img['Img_FileName'] = 'BMain'.($Extention != "" ? '.'.$Extention : "");
						
						# We currently accept only one image for business
						if(is_file($Upload_Path['Store_Image'].$Data_Img['Img_FileName']))
							unlink($Upload_Path['Store_Image'].$Data_Img['Img_FileName']);
						
						$ImageID = $Model['Business']->deleteImage($Data_Img);
						$ImageID = $Model['Business']->addImage($Data_Img);
						move_uploaded_file($_FILES_F["tmp_name"], $Upload_Path['Store_Image'].$Data_Img['Img_FileName']);
					}
					
					
				}
			}
			
			#Delete not using images in long description section.
			
			if(!is_dir($ImgUploadAt.'LDesc/'))
			{
				mkdir($ImgUploadAt.'LDesc/',0775,true);
			}
			
			$LDescImgs = scandir($ImgUploadAt.'LDesc/');
			
			foreach($LDescImgs AS $LDescImgs_F)
			{
				if(is_file($ImgUploadAt.'LDesc/'.$LDescImgs_F))
				{
					
					if(!preg_match('/LDesc\/'.preg_quote($LDescImgs_F).'/',$Data['StoreDescLong_INP']))
					{
						// Delete the image since it is not used anymore
						unlink($ImgUploadAt.'LDesc/'.$LDescImgs_F);
					}
				}
			}
		}
		
		return $output;
		
	}
	
	public function checkSEOURL($Data = null)
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['Store_URL']) || isset($Data['Store_URL']))
		{
			$output['ack'] = 'success';
			
			if(!isset($Data['Store_URL']))
				$Data['Store_URL'] = preg_replace('/[^a-zA-Z0-9]+/','',$_POST['Store_URL']);
				
			if($Data['Store_URL'] != "")
			{
				
				$Model['Business'] = $this->Load->Model('Business');
				$Result = $Model['Business']->getStoreID_By_SeoURL($Data);
				if(sizeof($Result) > 0)
				{
					$output['dupl'] = 1;
				}
				else
					$output['dupl'] = 0;
				
			}
			else
				$output['dupl'] = 2;
		}
		return $output;
	}
}


?>