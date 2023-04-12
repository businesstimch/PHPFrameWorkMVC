<?
class CEOEdit_Controller extends GGoRok
{
	
	public function home()
	{
		$Data['title'] = 'Burugo | Easy Life with Burugo';
		$Data['metaK'] = '부르고';
		$Data['metaD'] = '비지니스 추가';
		
		//$Register = $this->Load->Controller('www/Register');
		
		echo $this->Load->View('www/header.tpl',$Data);
		
		
		
		//$Data_Business['Store_ID'];
		if($this->login->isLogin())
		{
			if(isset($_GET['id']) && is_numeric($_GET['id']) && $this->_Model_Business->isMyBusiness($_GET['id']))
			{
				$StoreID = $_GET['id'];
				$Data['Business'] = $this->_Model_Business->getStore(array(
					'Store_ID' => $StoreID,
					'customers_id' => $this->login->_customerID
				));
				
				$ImgLocation = 'Img/CData/'.$this->login->_customerID.'/B/'.$StoreID.'/';
				$Business_Hours_HTML = $this->_Lang_ceo_business['no_hours'];
				
				if(sizeof($Data['Business']['B'] > 0))
				{
					$B = $Data['Business']['B'][0];
					
					# HTML : Business Hours
					if(isset($B['BusinessHours']))
					{
						$Business_Hours_HTML = '';
						foreach($B['BusinessHours'] AS $BH_F)
						{
							
							$Business_Hours_HTML .= $this->_Controller_ceo_add->businessHours_HTML(array(
								'dID' => $BH_F['Date_ID'],
								'OT' => $BH_F['OpenTime'],
								'CT' => $BH_F['CloseTime']
							))['html'];
							
						}
					}
					
					$AllItemToGroups = $this->_Model_Business->getItemToGroup(array('Store_ID' => $StoreID));
					
					# HTML : Item Groups
					$ItemGroup_HTML = '';
					if(sizeof($B['ItemGroups']) > 0)
					{
						foreach($B['ItemGroups'] AS $ItemGroup_F)
						{
							$ItemsInGroup = array();
							foreach($AllItemToGroups AS $AllItemToGroups_F)
							{
								if($AllItemToGroups_F['ItemGrp_ID'] == $ItemGroup_F['ItemGrp_ID'])
									$ItemsInGroup[] = $AllItemToGroups_F;
							}
							$ItemGroup_HTML .= $this->Load->View('ceo/business/add-group.tpl',array(
								'ItemGrp_ID' => $ItemGroup_F['ItemGrp_ID'],
								'ItemGrp_Name' => $ItemGroup_F['ItemGrp_Name'],
								'ItemsInGroup' => $ItemsInGroup
							));
							
							unset($ItemsInGroup);
						}
					}
					
					$ItemGroups = $this->_Model_Business->getItemGroup(array('Store_ID' => $StoreID));
					
					
					
					# HTML : Item Groups
					$Items_HTML = '';
					if(sizeof($B['Items']) > 0)
					{
						foreach($B['Items'] AS $Items_F)
						{
							
							$Items_HTML .= $this->Load->View('ceo/business/add-item.tpl',array(
								'Item_ID' => $Items_F['Item_ID'],
								'Item_Name' => $Items_F['Item_Name'],
								'Item_Desc' => $Items_F['Item_Desc'],
								'Item_Price' => $Items_F['Item_Price'],
								'Item_Qty' => $Items_F['Item_Qty'],
								'Item_Sort' => $Items_F['Item_Sort'],
								'Item_SKU' => $Items_F['Item_SKU'],
								'Item_Activated' => $Items_F['Item_Activated'],
								'Item_Image' => ($Items_F['Item_Image'] != "" && is_file(__FrontendPath__.$ImgLocation.'Item/'.$Items_F['Item_Image']) ? '/Template/'.$ImgLocation.'Item/'.$Items_F['Item_Image'] : ""),
								'ItemGroups' => $ItemGroups,
								'ItemToGroup' => $AllItemToGroups
							));
						}
					}
					
					# Final Output
					echo $this->Load->View('ceo/business/business.tpl',array(
						'Business' => $Data['Business'],
						'Business_Hours_HTML' => $Business_Hours_HTML,
						'ItemGroup_HTML' => $ItemGroup_HTML,
						'Items_HTML' => $Items_HTML
					));
					
					
				}
				else
					echo $this->Load->View('404.tpl');
				
				
				
				
				
				
					
				
			}
		}
		else
			echo $this->Load->View('www/loginRequired.tpl');
			
		echo $this->Load->View('www/footer.tpl');
	}
	
	
	
}


?>