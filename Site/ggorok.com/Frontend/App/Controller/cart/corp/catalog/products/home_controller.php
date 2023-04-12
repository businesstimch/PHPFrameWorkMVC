<?php
class CartCorpCatalogProductsHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	var $imgFolder_Arr = array();
	
	function home()
	{
		
		$Data['title'] = 'Product List | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		$Data['CurrentCategory'] = '';
		
		$Args['p'] = (isset($_POST['p']) && is_numeric($_POST['p']) && $_POST['p'] > 0 ? $_POST['p'] : 1);
		if(isset($_POST['Search']))
		{
			$Args['Search'] = $_POST['Search'];
		}
		
		
			
		$Data['MAIN_HTML'] = $this->Load->View('cart/corp/catalog/products/home.tpl', array(
			'ProductList' => $this->ProductList($Args)['html'],
			'Search_Keyword' => (isset($_POST['Search']) && $_POST['Search'] != "" ? htmlspecialchars($_POST['Search']) : "")
		));
		
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	
	}
	
	function ProductList($Args = null)
	{
		
		
		$Args['p'] = (isset($Args['p']) ? $Args['p'] : 1);
		
		$Select = '';
		$Where = '';
		$OrderBy = '';
		if(isset($Args['Search']))
		{
			
			
			$Match[0] = 'MATCH (Prd_Name) AGAINST ("'.$this->db->escape($Args['Search']).'")';
			$Match[1] = 'MATCH (Prd_Desc_Short) AGAINST ("'.$this->db->escape($Args['Search']).'")';
			$Match[2] = 'MATCH (Prd_Desc_Long) AGAINST ("'.$this->db->escape($Args['Search']).'")';
			$Match[3] = 'MATCH (Prd_SKU) AGAINST ("'.$this->db->escape($Args['Search']).'")';
			$Match[4] = 'MATCH (Prd_Tags) AGAINST ("'.$this->db->escape($Args['Search']).'")';
			
			$Select .=
				','.$Match[0].' AS Score_Prd_Name'.
				','.$Match[1].' AS Score_Prd_Desc_Short'.
				','.$Match[2].' AS Score_Prd_Desc_Long'.
				','.$Match[3].' AS Score_Prd_SKU'.
				','.$Match[4].' AS Score_Prd_Tags'
			;
			
			$Where .= '
				AND
					(
						('.$Match[0].') OR
						('.$Match[1].') OR
						('.$Match[2].') OR
						('.$Match[3].') OR
						('.$Match[4].') OR
						Prd_SKU LIKE "%'.$this->db->escape($Args['Search']).'%"
					)
				
					
								
			';
			$OrderBy .= "
				Score_Prd_SKU DESC,
				Score_Prd_Name DESC,
				Score_Prd_Tags DESC,
				Score_Prd_Desc_Short DESC,
				Score_Prd_Desc_Long DESC,
				Prd_id ASC
			";
		}
		
		$Limit = 20;
		$output['ack'] = 'success';
		$P = $this->db->QRY("
			SELECT
				SQL_CALC_FOUND_ROWS
				*
				".$Select."
			FROM
				".DB_Table_Prefix."products
			WHERE
				Store_ID = ".__StoreID__."
				".$Where."
			ORDER BY
				".($OrderBy == "" ? ' Prd_id ASC ' : $OrderBy )."
			LIMIT
				".($Args['p'] * $Limit - $Limit).','.$Limit."
		");
		$Total_Rows = $this->db->QRY("SELECT FOUND_ROWS() as Total;");
		
		$output['html'] = '';
		if(sizeof($P) > 0)
		{
			$output['html'] .= '
					<div class="List_One List_Header">
						<div class="PD_List_Name List_Col">Product Name</div>
						<div class="PD_List_Sku List_Col">SKU</div>
						<div class="PD_List_Price List_Col">Price</div>
						<div class="PD_List_Qty List_Col">Qty</div>
					</div>
			';
			foreach($P AS $P_F)
			{
				$output['html'] .= '
					<div class="List_One List_Contents hand Glow" data-pid="'.$P_F['Prd_ID'].'">
						<div class="PD_List_Name List_Col">'.$P_F['Prd_Name'].'</div>
						<div class="PD_List_Sku List_Col">'.$P_F['Prd_SKU'].'</div>
						<div class="PD_List_Price List_Col">$'.$P_F['Prd_Price'].'</div>
						<div class="PD_List_Qty List_Col">'.$P_F['Prd_Qty'].'</div>
					</div>
				';
			}
		}
		else
		{
			$output['html'] .= 'No Product Found';
		}
		
		if($Total_Rows[0]['Total'] > 0)
		{
			$output['html'] .= '<div class="w100" id="Total_Found">'.($Args['p'] * $Limit - $Limit).' - '.($Args['p'] * $Limit).' of '.$Total_Rows[0]['Total'].' Products Found</div>';
			
			$PG['Prev'] = false;
			$PG['Next'] = false;
			
			if($Total_Rows[0]['Total'] > ($Args['p'] * $Limit))
			{
				$PG['Next'] = true;
			}
			
			if($Args['p'] > 1)
			{
				$PG['Prev'] = true;
			}
			
			$output['html'] .= '
				<div id="Pagination">
					<div class="Pagi_Btn PagiPrev_Btn'.($PG['Prev'] ? '' : ' PagiDisabled').'"><i class="fa fa-caret-left"></i></div>
					<div class="Pagi_Btn PagiNext_Btn'.($PG['Next'] ? '' : ' PagiDisabled').'" id="Pagi_Next"><i class="fa fa-caret-right"></i></div>
				</div>
			';
				
		}
		
		$output['html'] = '<div class="GGoRok_Table_1">'.$output['html'].'</div>';
		return $output;
	}
	
	function deleteProduct()
	{
		global $login, $db, $_HTMLs;
		$output['ack'] = 'error';
		if(isset($_POST['pID']))
		{
			
			$P = $db->QRY("
				SELECT
					Prd_ID
				FROM
					gc_products
				WHERE
					Store_ID = '".__StoreID__."' AND
					Prd_ID = '".$db->escape($_POST['pID'])."'
			");
			
			if(sizeof($P) > 0)
			{
				
				$db->QRY("DELETE FROM gc_products WHERE Prd_ID = '".$db->escape($_POST['pID'])."' AND Store_ID = '".__StoreID__."'");
				$db->QRY("DELETE FROM gc_products_to_categories WHERE Prd_ID = '".$db->escape($_POST['pID'])."'");
				$db->QRY("DELETE FROM gc_products_images WHERE Prd_ID = '".$db->escape($_POST['pID'])."'");
				$this->File->DeleteDirectory(__UploadPath__.__StoreID__.'/Products/'.$_POST['pID']);
				$output['ack'] = 'success';
			}
			else
			{
				$output['error_msg'] = "This product doesn't exsist or is already deleted.";
			}
			
			/*
			$db->QRY("
				DELETE FROM
					gc_category
				WHERE
					Prd_ID = '".$db->escape($_POST['pID'])."'
			");
			*/
		}
		return $output;
	}
}

?>