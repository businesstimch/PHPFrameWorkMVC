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
			if(isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$StoreID = $_GET['id'];
				$Data['Business'] = $this->_Model_Business->getStore(array(
					'Store_ID' => $StoreID,
					'customers_id' => $this->login->_customerID
				));
				
				
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
					
					# HTML : Item Groups
					$ItemGroup_HTML = '';
					if(sizeof($B['ItemGroups']) > 0)
					{
						foreach($B['ItemGroups'] AS $ItemGroup_F)
						{
							$ItemGroup_HTML .= $this->Load->View('ceo/business/add-group.tpl',array(
								'ItemGrp_ID' => $ItemGroup_F['ItemGrp_ID'],
								'ItemGrp_Name' => $ItemGroup_F['ItemGrp_Name']
							));
						}
					}
					
					# Final Output
					echo $this->Load->View('ceo/business/business.tpl',array(
						'Business' => $Data['Business'],
						'Business_Hours_HTML' => $Business_Hours_HTML,
						'ItemGroup_HTML' => $ItemGroup_HTML
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