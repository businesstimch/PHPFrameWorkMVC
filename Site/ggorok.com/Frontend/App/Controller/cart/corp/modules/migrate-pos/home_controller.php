<?php
class CartCorpModulesMigratePOSHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $POS_DB, $Web_DB;
	
	function __construct()
	{
		//ini_set('max_execution_time', 30);
		$this->Web_DB = new $this->db;
		$this->Web_DB->connect(array(
			'DB_Name' => 'janilink_new',
			'DB_Server' => '76.74.252.180',
			'DB_UserName' => 'remote',
			'DB_Password' => 'MJaCall@MQNb^!%'
		));
		
		$this->POS_DB = new $this->mssql;
		$this->POS_DB->connect(array(
			'DB_Name' => 'JANIRMS2DB',
			'DB_Server' => '24.99.45.248:1433',
			'DB_UserName' => 'sa',
			'DB_Password' => 'janilinkDaniel'
		));
		
	}
	
	function deleteItemWebsite()
	{
		$output['ack'] = 'error';
		if(isset($_POST['Data']))
		{
			$Data = json_decode($_POST['Data'],TRUE);
			$Go = true;
			foreach($Data AS $_F)
			{
				if(!is_numeric($_F))
					$Go = false;
			}
			
			if($Go)
			{
				$this->Web_DB->QRY("DELETE FROM products WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_description WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_to_categories WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_to_products_extra_fields WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_video_variables WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_videos WHERE products_id IN (".implode(',',$Data).")");
				$this->Web_DB->QRY("DELETE FROM products_attributes WHERE products_id IN (".implode(',',$Data).")");
				
				$output['ack'] = 'success';
			}
			/*
			$this->Web_DB->QRY("
				DELETE FROM products WHERE products_id IN ('""')
			");
			*/
		}
		return $output;
	}
	
	function home()
	{
		$Data['title'] = 'Migration POS | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/modules/migrate-pos/home.tpl',array(
			'NoLookupCodeInPOS' => ''
		));
		
		//$this->NoLookupCodeInPOS();
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function itemsNotActivated()
	{
		$output['ack'] = 'success';
		$output['html'] = '';
		$Web_SQL = $this->Web_DB->QRY("
			SELECT
				*
			FROM
				products P,
				products_description PD
			WHERE
				P.products_id = PD.products_id AND
				P.products_status = 0
			ORDER BY
				P.products_id ASC
		");
		
		foreach($Web_SQL AS $_F)
		{
			$output['html'] .=
				'<div data-id="'.$_F['products_id'].'" class="List_One">'.
					'<div class="P_Select"><input data-buttongroup="selectDeselect"  type="checkbox" class="P_Select_INP" /></div>'.
					'<div class="P_Img"><img src="https://www.janilink.com/img/p/M/'.$_F['products_image'].'" /></div>'.
					'<div class="P_ItemLookupCode">'.$_F['products_model'].'</div>'.
					'<div class="P_Name">'.$_F['products_name'].'</div>'.
					'<div class="P_Link">'.($_F['products_status'] == 1 ? '<a target="_blank" href="https://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'">Go</a>' : '' ).'</div>'.
				'</div>'
			;
		}
		
		return $output;
	}
	
	function updatePrice()
	{
		$output['ack'] = 'error';
		if(isset($_POST['Data']))
		{
			$Data = json_decode($_POST['Data'],TRUE);
			if(sizeof($Data) > 0)
			{
				foreach($Data AS $_K => $_F)
				{
					if($_F['Type'] == 'Item')
					{
					
						$this->Web_DB->QRY('
							UPDATE
								products
							SET
								products_price = "'.$this->Web_DB->escape($_F['Price']).'"
							WHERE
								products_id = "'.$this->Web_DB->escape($_K).'"
						');
						
					}
					else if($_F['Type'] == 'Option')
					{
						
						$this->Web_DB->QRY('
							UPDATE
								products_attributes
							SET
								options_values_price = "'.$this->Web_DB->escape($_F['Price']).'"
							WHERE
								products_attributes_id = "'.$this->Web_DB->escape($_K).'"
						');
						
					}
				}
			
				$output['ack'] = 'success';
				
			}
		}
		
		return $output;
	}
	
	
	
	function checkGoogleAD()
	{
		$output['ack'] = 'error';
		
		if(isset($_POST['Data']))
		{
			$Data = json_decode($_POST['Data']);
			if(sizeof($Data) > 0)
			{
				$output['ack'] = 'success';
				$output['html'] = '';
				
				$Codes = array();
				foreach($Data AS $Data_F)
				{
					if($Data_F != "")
					{
						$Codes[$Data_F]['POS'] = false;
						$Codes[$Data_F]['Web'] = false;
					}
				}
				
				$Web_SQL = $this->Web_DB->QRY("
					SELECT
						p.products_id, 
						p.products_image, 
						p.products_model,
						p.products_price,
						p.products_status,
						pd.products_name
		
					FROM
						products p,
						products_description pd
					WHERE
						p.products_model != '' AND
						p.products_id = pd.products_id AND
						p.products_model IN ('".implode("','",$Data)."')
				");
				
				
				$POS_SQL = $this->POS_DB->QRY("
					SELECT
						ItemLookupCode,
						Description,
						Price
					FROM
						Item
					WHERE
						itemLookupCode IN ('".implode("','",$Data)."')
				");
				
				
				foreach($Web_SQL AS $_F)
				{
					if(isset($Codes[$_F['products_model']]))
					{
						$Codes[$_F['products_model']]['Web'] = true;
						$Codes[$_F['products_model']]['Web_Name'] = $_F['products_name'];
					}
					
				}
				
				foreach($POS_SQL AS $_F)
				{
					if(isset($Codes[$_F['ItemLookupCode']]))
					{
						$Codes[$_F['ItemLookupCode']]['POS'] = true;
						$Codes[$_F['ItemLookupCode']]['POS_Name'] = $_F['Description'];
					}
					
				}
				
				foreach($Codes AS $_K => $_F)
				{
					$output['html'] .=
						'<div class="List_One">'.
							'<div class="P_Existance '.($_F['Web'] ? 'P_Has':'P_NoHas').' P_Has P_Col">Web</div>'.
							'<div class="P_Existance '.($_F['POS'] ? 'P_Has':'P_NoHas').' P_Col">POS</div>'.
							'<div data-tooltip="Name on POS" class="P_Name P_Col">'.($_F['POS'] ? $_F['POS_Name'] : '').'</div>'.
							'<div data-tooltip="Name on Web" class="P_Name P_Col">'.($_F['Web'] ? $_F['Web_Name'] : '').'</div>'.
							'<div class="P_ItemLookupCode P_Col"><span>'.$_K.'</span></div>'.
						'</div>'
					;
				}
				
				
				
			}
		}
		return $output;
	}
	
	function getPriceDiff()
	{
		
		$output['ack'] = 'success';
		$output['html'] = '';
		
		$Web_SQL = $this->Web_DB->QRY("
			SELECT
				p.products_id, 
				p.products_image, 
				p.products_model,
				p.products_price,
				p.products_status,
				pd.products_name

			FROM
				products p,
				products_description pd
			WHERE
				p.products_model != '' AND
				p.products_id = pd.products_id
		");
		
		
		$Item = array();
		$ItemLookups_Arr = array();
		foreach($Web_SQL AS $_F)
		{
			if($_F['products_model'] != "")
			{
				$Item[$_F['products_model']] = $_F;
				$Item[$_F['products_model']]['Price_Web'] = $_F['products_price'];
				$ItemLookups_Arr[] = $_F['products_model'];
			}
		}
		
		$WebAttribute_SQL = $this->Web_DB->QRY("
			SELECT
				PA.products_attributes_id,
				PA.options_values_model_no,
				PA.products_id,
				PA.options_values_price,
				PA.price_prefix,
				P.products_price,
				P.products_status,
				P.products_image,
				PD.products_name,
				POV.products_options_values_name
			FROM
				products_attributes PA
					LEFT JOIN
						products P
					ON
						P.products_id = PA.products_id
					LEFT JOIN
						products_description PD
					ON
						PD.products_id = PA.products_id
					LEFT JOIN
						products_options PO
					ON
						PO.products_options_id = PA.options_id
					LEFT JOIN
						products_options_values POV
					ON
						POV.products_options_values_id = PA.options_values_id AND
						POV.language_id = 1
						
			WHERE
				PA.options_values_model_no != ''
			ORDER BY
				PA.products_id
		");
		
		foreach($WebAttribute_SQL AS $_F)
		{
			$ItemAttribute[$_F['options_values_model_no']] = $_F;
			$ItemAttribute[$_F['options_values_model_no']]['Price_Web'] = $_F['options_values_price'];
		}
		
		
		$POS_SQL = $this->POS_DB->QRY("
			SELECT
				ItemLookupCode,
				Price
			FROM
				Item
			WHERE
				itemLookupCode IN ('".implode("','",$ItemLookups_Arr)."')
		");
	
		foreach($POS_SQL AS $_F)
		{
			if(isset($Item[$_F['ItemLookupCode']]) && $Item[$_F['ItemLookupCode']]['Price_Web'] != $_F['Price'])
			{
				$Item[$_F['ItemLookupCode']]['Price_POS'] = $_F['Price'];
			}
			
			if(isset($ItemAttribute[$_F['ItemLookupCode']]) && $ItemAttribute[$_F['ItemLookupCode']]['Price_Web'] != $_F['Price'])
			{
				$ItemAttribute[$_F['ItemLookupCode']]['Price_POS'] = $_F['Price'];
			}
		}
		
		
		foreach($Item AS $_K => $_F)
		{
			if(isset($_F['Price_POS']))
			{
				$output['html'] .=
					'<div data-type="Item" data-id="'.$_F['products_id'].'" data-priceto="'.number_format($_F['Price_POS'],2,'.','').'" class="List_One'.($_F['products_status'] == 1 ? ' ActiveItem':' InActiveItem').'">'.
						'<div class="P_Select"><input data-buttongroup="selectDeselect" type="checkbox" class="P_Select_INP" /></div>'.
						'<div class="P_Img P_Col"><img src="https://www.janilink.com/img/p/M/'.$_F['products_image'].'" /></div>'.
						'<div class="P_ItemLookupCode P_Col">'.$_K.'</div>'.
						'<div class="P_Name P_Col">'.$_F['products_name'].'</div>'.
						'<div class="P_Link P_Col">'.($_F['products_status'] == 1 ? '<a target="_blank" href="https://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'">Go</a>' : '' ).'</div>'.
						'<div class="P_PricePOS P_Col" data-tooltip="POS">'.number_format($_F['Price_POS'],2).'</div>'.
						'<div class="P_PriceWeb P_Col" data-tooltip="Web">'.number_format($_F['Price_Web'],2).'</div>'.
					'</div>';
			}	
		}
		
		foreach($ItemAttribute AS $_K => $_F)
		{
			if(isset($_F['Price_POS']))
			{
				$output['html'] .=
					'<div data-type="Option" data-id="'.$_F['products_attributes_id'].'" data-priceto="'.number_format($_F['Price_POS'],2,'.','').'" class="List_One'.($_F['products_status'] == 1 ? ' ActiveItem':' InActiveItem').'">'.
						'<div class="P_Select P_SelectOption"><input data-buttongroup="selectDeselect" type="checkbox" class="P_Select_INP" /></div>'.
						'<div class="P_Img P_Col"><img src="https://www.janilink.com/img/p/M/'.$_F['products_image'].'" /></div>'.
						'<div class="P_ItemLookupCode P_Col">'.$_K.'</div>'.
						'<div class="P_Name P_Col">'.$_F['products_options_values_name'].'</div>'.
						'<div class="P_Link P_Col">'.($_F['products_status'] == 1 ? '<a target="_blank" href="https://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'">Go</a>' : '' ).'</div>'.
						'<div class="P_PricePOS P_Col" data-tooltip="POS">'.number_format($_F['Price_POS'],2).'</div>'.
						'<div class="P_PriceWeb P_Col" data-tooltip="Web">'.number_format($_F['Price_Web'],2).'</div>'.
					'</div>';
			}	
		}
			
		
		return $output;
	}
	
	function NoLookupCodeInPOS()
	{
		$output['ack'] = 'success';
		$output['html'] = '';
		$Web_SQL = $this->Web_DB->QRY("
			SELECT
				*
			FROM
				products P
			WHERE
				P.products_id NOT IN (
					SELECT
						PA.products_id
					FROM
						products_attributes PA
					
				)
		");
		
		$POS_SQL = $this->POS_DB->QRY("
			SELECT
				ID,
				ItemLookupCode
			FROM
				Item
		");
		
		
		$POS_Class_SQL = $this->POS_DB->QRY("
			SELECT
				ID,
				ItemLookupCode
			FROM
				ItemClass
		");
		
		$Web = array();
		$POS = array();
		foreach($Web_SQL AS $_F)
		{
			$Web[$_F['products_id']] = $_F['products_model'];
		}
		
		foreach($POS_SQL AS $_F)
		{
			$POS[$_F['ID']] = $_F['ItemLookupCode'];
		}
		
		foreach($POS_Class_SQL AS $_F)
		{
			$POS[$_F['ID']] = $_F['ItemLookupCode'];
		}
		
		$WrongCode_Arr = array_diff($Web,$POS);
	
		
		
		if(sizeof($WrongCode_Arr) > 0)
		{
			$IDs = array();
			foreach($WrongCode_Arr AS $_K => $_F)
			{
				$IDs[] = '"'.$_F.'"';
			}
			
			$WrongCode_SQL = $this->Web_DB->QRY("
				SELECT
					*
				FROM
					products P,
					products_description PD
				WHERE
					P.products_id = PD.products_id AND
					P.products_model IN (".implode(',',$IDs).")
			");
			
			foreach($WrongCode_SQL AS $_F)
			{
				$output['html'] .=
					'<div data-pid="'.$_F['products_id'].'" class="List_One'.($_F['products_status'] == 1 ? ' ActiveItem':' InActiveItem').'">'.
						'<div class="P_Img"><img src="https://www.janilink.com/img/p/M/'.$_F['products_image'].'" /></div>'.
						'<div class="P_ItemLookupCode"><input class="P_SKU_INP" value="'.htmlspecialchars($_F['products_model']).'" /></div>'.
						'<div class="P_Name">'.$_F['products_name'].'</div>'.
						'<div class="P_PricePOS">'.number_format($_F['products_price'],2).'</div>'.
						'<div class="P_Link" style="margin-right:10px;"><div class="P_SaveBtn WrongCodeSave_BTN">Save</div></div>'.
						'<div class="P_Link">'.($_F['products_status'] == 1 ? '<a target="_blank" href="https://www.janilink.com/product_info.php?products_id='.$_F['products_id'].'">Go</a>' : '' ).'</div>'.
					'</div>'
				;
			}
		}
		
		//$output['html'] = print_r(array_diff($Web,$POS),true);
		//echo print_r($Web);
		
		return $output;
	}
	
	function updateSKU()
	{
		$output['ack'] = 'success';
		
		$Web_SQL = $this->Web_DB->QRY("
			UPDATE
				products
			SET
				products_model = '".$this->Web_DB->escape($_POST['SKU'])."'
			WHERE
				products_id = '".$this->Web_DB->escape($_POST['pid'])."'
			
		");
		
		return $output;
	}
	
	
}


?>