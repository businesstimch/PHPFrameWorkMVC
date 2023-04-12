<?php
class CartPHome_Controller extends GGoRok
{
	function home()
	{
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => ''.'GGoRok Cart',
			'metaK' => '',
			'metaD' => '',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));
		
		
		$URL_Arr = $this->Controllers->getRequestArray();
		
		if(sizeof($URL_Arr) > 0 && preg_match("/\.html$/",$URL_Arr[sizeof($URL_Arr) - 1]))
		{
			
			?>

			<div id="BreadCrumb_Block">
				
			</div>

			<?

			$P = $this->_Product->getInfo_From_URL($URL_Arr[sizeof($URL_Arr) - 1]);
			
			if(is_array($P))
			{
				
				
				$Price_HTML = "";
				if($P['Prd']['Prd_Price'] > 0)
				{
					$Price_HTML = '$'.number_format($P['Prd']['Prd_Price'],2);
				}
				else if(isset($P['hasMandatoryOpt']))
				{
					if($P['hasMandatoryOpt'])
					{
						$Price_HTML = 'Please Select Options';
					}
					else
					{
						$Price_HTML = 'Free';
					}
				}
					
				# Has Option?
				$Option_HTML = '';
				$Option_HTML = '';
				if(is_array($P['Opt']) && sizeof($P['Opt']) > 0)
				{
					
					
					foreach($P['Opt'] as $Opt_F)
					{
						
						$OptData = $this->db->QRY("
							SELECT
								*
							FROM
								gc_products_option_group_item
							WHERE
								OptGrp_ID = '".$Opt_F['OptGrp_ID']."'
							
						");
						
						if($Opt_F['OptGrp_Type_ID'] == 1)
						{
							$OptionElement_HTML = '';
							foreach($OptData as $OptData_F)
							{
								$OptionElement_HTML .= $this->Load->View('cart/p/option_type_1_element.tpl',array(
									
									'Opt_ID' => $OptData_F['Opt_ID'],
									'Opt_Operand' => $OptData_F['Opt_Operand'],
									'Opt_Price' => $OptData_F['Opt_Price'],
									'Option_Text' => $OptData_F['Opt_Name'].($OptData_F['Opt_Price'] > 0 ? ' ('.$OptData_F['Opt_Operand'].'$'.''.number_format($OptData_F['Opt_Price'],2).')' : "")
								));
							}
							$Option_HTML .= $this->Load->View('cart/p/option_type_1.tpl',array(
								'Opt_F' => $Opt_F,
								'OptData' => $OptData,
								'OptionElement_HTML' => $OptionElement_HTML
							));
							
							
							
						}
						
						
					}
					
					
				}
				
				echo $this->Load->View('cart/p/home.tpl',array(
					'Prd_ID' => $P['Prd']['Prd_ID'],
					'Prd_SKU' => $P['Prd']['Prd_SKU'],
					'Prd_Name' => $P['Prd']['Prd_Name'],
					'Prd_Price' => $P['Prd']['Prd_Price'],
					'Prd_ListPrice' => $P['Prd']['Prd_ListPrice'],
					'Prd_Desc_Short' => $P['Prd']['Prd_Desc_Short'],
					'Prd_Desc_Long' => $P['Prd']['Prd_Desc_Long'],
					'Prd_Img' => $P['Img'],
					'Price_HTML' => $Price_HTML,
					'Option_HTML' => $Option_HTML,
					'Tubes' => $P['Files']['Tubes']
					
				));
			}
			else
				echo 404;
			
			
			
		}
		
		echo $this->Load->View('cart/footer.tpl');
	}
	
}

?>