<?php
class wwwCart_Controller extends GGoRok
{
	public function Add($Data = null)
	{
		$output['ack'] = 'error';
		if(is_null($Data))
		{
			$Data = $_POST;
		}
		
		if($this->login->isLogin())
		{
			if(
				isset($Data['cID']) &&
				isset($Data['ItemID']) &&
				isset($Data['QTY'])
			)
			{
				
				$Item = $this->_Model_Business->getItems(array(
					'Store_ID' => $_POST['cID'],
					'Item_ID' => $_POST['ItemID'],
					'Item_Activated' => 1
				));
				
				# Existing Item?
				if(sizeof($Item) > 0)
				{
					$ItemInCart = $this->_Model_Cart->Get(array(
						"Store_ID" => $_POST['cID'],
						"Item_ID" => $_POST['ItemID'],
						"customers_id" => $this->login->customers_id
					));
					
					# Update Quantity Only
					if(sizeof($ItemInCart) > 0)
					{
						$output = $this->Update($_POST);
					}
					else # Add Item Newly
					{
						$Cart_ID = $this->_Model_Cart->Add(array(
							'customers_id' => $this->login->customers_id,
							'Store_ID' => $_POST['cID'],
							'Item_ID' => $_POST['ItemID'],
							'Item_Name' => $Item[0]['Item_Name'],
							'AddedQty' => $_POST['QTY']
						));
						
						if(is_numeric($Cart_ID))
						{
							$output['ack'] = 'success';
						}
					}
				}
			}
		}
		else
			$output['error_msg'] = '<i class="fa fa-info"></i> 로그인이 필요한 서비스 입니다.';
		
		return $output;
	}
	
	public function Remove($Data = null)
	{
		
	}
	
	public function Update($Data = null)
	{
		$output['ack'] = 'error';
		if(is_null($Data))
		{
			$Data = $_POST;
		}
		
		if($this->login->isLogin())
		{
			if(
				isset($Data['cID']) &&
				isset($Data['ItemID']) &&
				isset($Data['QTY'])
			)
			{
				$this->_Model_Cart->Update(array(
					'customers_id' => $this->login->customers_id,
					'Store_ID' => $Data['cID'],
					'Item_ID' => $Data['ItemID'],
					'QTY' => $Data['QTY']
				));
				
				$output['ack'] = 'success';
			}
		}
		else
			$output['error_msg'] = '<i class="fa fa-info"></i> 로그인이 필요한 서비스 입니다.';
		
		return $output;
	}
	
	public function Get($Data = null)
	{
		$output['ack'] = 'error';
		
		if($this->login->isLogin())
		{
			$Items = $this->_Model_Cart->Get(array(
				'customers_id' => $this->login->customers_id
			));
			$output['ack'] = 'success';
			$output['html'] = '';
			foreach($Items AS $Items_F)
			{
				
				$output['html'] .= $this->Load->View('www/inc/TopCart_Item.tpl',array(
					'Cart_ID' => $Items_F['Cart_ID'],
					'Item_Image' => ($Items_F['Item_Image'] != "" ? '<img src="/Template/Img/CData/'.$Items_F['customers_id'].'/B/'.$Items_F['Store_ID'].'/Item/'.$Items_F['Item_Image'].'" />' : '<i class="fa fa-image"></i>'),
					'Item_Name' => $Items_F['Item_Name'],
					'QTY' => $Items_F['QTY'].'개',
					'Store_URL' => $Items_F['Store_URL'],
					'Item_Price' => ($Items_F['Item_Price'] == 0 ? '무료' : number_format($Items_F['Item_Price'],0).'원')
				));
			}
			
		}
		
		return $output;
	}
	
}

?>