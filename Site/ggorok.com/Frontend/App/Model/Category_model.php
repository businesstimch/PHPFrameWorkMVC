<?

class Category_Model extends GGoRok_Model{
	function getCategory($Data = null)
	{
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_category
			WHERE
				Store_ID = '".__StoreID__."' AND
				".(isset($Data['Cat_SEO_URL']) ? "Cat_SEO_URL = '".$this->db->escape($Data['Cat_SEO_URL'])."' AND" : '' )."
				".(isset($Data['Cat_ID']) ? " Cat_ID = '".$this->db->escape($Data['Cat_ID'])."' AND" : '' )."
				Cat_isActive = 1
			ORDER BY
				Cat_Sort ASC
		");
	}
	
	function AllCat()
	{
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_category
			WHERE
				Store_ID = ".__StoreID__."
			ORDER BY
				Cat_Parent_ID ASC,
				Cat_Sort ASC
		");
	}
	
	function getParent_From_URL($URL)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_category C
			WHERE
				Store_ID = ".__StoreID__." AND
				Cat_ID = (
					SELECT
						Cat_Parent_ID
					FROM
						gc_category
					WHERE
						Cat_SEO_URL = '".$this->db->escape($URL)."'
				)
		");
	}
	
	function getInfo_From_URL($URL)
	{
		$C['General'] = $this->db->QRY("
			SELECT
				*
			FROM
				gc_category
			WHERE
				Cat_SEO_URL = '".$this->db->escape($URL)."' AND
				Cat_isActive = 1 AND
				Store_ID = ".__StoreID__."
		");
		
		
		if(sizeof($C) > 0)
			return $C;
		else
			return false;
		
	}
	
	function getProductList_SQL($Data = null)
	{
		# Product Info
		$Select = '';
		$Where = '';
		$OrderBy = '';
		$From = '';
		$GroubBy = 'GROUP BY';
		
		$LimitScore = 1;
		
		
		if(isset($Data['cID']))
		{
			$From .= ',gc_products_to_categories P2C';
			$Where .= "
			P.Prd_ID = P2C.Prd_ID AND
			P2C.Cat_ID ".(is_array($Data['cID'])? "IN (".implode(",",$Data['cID']).")" : " = ".$this->db->escape($Data['cID']))." AND";
		}
		
		# Search Mode
		if(isset($Data['Search']) && $Data['Search'] != "")
		{
			
			
			$Match[0] = 'MATCH (P.Prd_Name) AGAINST ("'.$this->db->escape($Data['Search']).'" IN BOOLEAN MODE)';
			$Match[1] = 'MATCH (P.Prd_Desc_Short) AGAINST ("'.$this->db->escape($Data['Search']).'")';
			$Match[2] = 'MATCH (P.Prd_Desc_Long) AGAINST ("'.$this->db->escape($Data['Search']).'")';
			$Match[3] = 'MATCH (P.Prd_SKU) AGAINST ("'.$this->db->escape($Data['Search']).'" IN BOOLEAN MODE)';
			$Match[4] = 'MATCH (P.Prd_Tags) AGAINST ("'.$this->db->escape($Data['Search']).'")';
			
			$Select .=
				','.$Match[0].' AS Score_Prd_Name'.
				','.$Match[1].' AS Score_Prd_Desc_Short'.
				','.$Match[2].' AS Score_Prd_Desc_Long'.
				','.$Match[3].' AS Score_Prd_SKU'.
				','.$Match[4].' AS Score_Prd_Tags'
			;
			
			
			$Where .= '
				(
					(
						(
							'.$Match[0].' OR
							'.$Match[1].' OR
							'.$Match[2].' OR
							'.$Match[3].' OR
							'.$Match[4].'
							
						)
						AND
						(
							'.$Match[0].' > '.$LimitScore.' OR
							'.$Match[1].' > '.$LimitScore.' OR
							'.$Match[2].' > '.$LimitScore.' OR
							'.$Match[3].' > '.$LimitScore.' OR
							'.$Match[4].' > '.$LimitScore.'
						)
						
					)
					
				)
				AND
			';
			
			if(isset($Data['Search_CategoryID']) && sizeof($Data['Search_CategoryID']) > 0)
			{
				$From .= ',gc_products_to_categories P2C';
				$Where .= "
					P.Prd_ID = P2C.Prd_ID AND
					P2C.Cat_ID IN (".implode(",",$Data['Search_CategoryID']).") AND";
					
					
			}
			$OrderBy .= "
				Score_Prd_SKU DESC,
				Score_Prd_Name DESC,
				Score_Prd_Tags DESC,
				Score_Prd_Desc_Short DESC,
				Score_Prd_Desc_Long DESC,
				P.Prd_id ASC
			";
		}
		
		
		if(isset($Data['Page']) && is_numeric($Data['Page']) && $Data['Page'] > 1)
		{
			$Prd_Limit_From = ($Data['Page'] - 1) * $this->_Setting->Data['General']['ProductPerPage'];
		}
		else
			$Prd_Limit_From = 0;
			
		$Limit = $Prd_Limit_From.','.$this->_Setting->Data['General']['ProductPerPage'];
		
		$P['P'] = $this->db->QRY("
			SELECT
				SQL_CALC_FOUND_ROWS
				P.Prd_ID,
				P.Prd_Name,
				P.Prd_Desc_Short,
				P.Prd_SEO_URL,
				P.Prd_Price,
				P.Prd_ListPrice,
				P.isCall4Price,
				PI.Img_ID,
				PI.Img_FileName,
				PI.Img_isDefault,
				PI.Img_Sort,
				GOP.isMandatory
				".$Select."
			FROM
				gc_products P
					LEFT JOIN
						gc_products_images PI
					ON
						PI.Prd_ID = P.Prd_ID AND
						PI.Img_isDefault = 1
					LEFT JOIN
						gc_products_option_group GOP
					ON
						GOP.`OptGrp_ID` =
						(
							/* Check If this item has any mandatory option. If it has, customer cant put this item into cart from list page . */
							SELECT
								OptGrp_ID
							FROM
								gc_products_option_group pog
							WHERE
								pog.Prd_ID = P.Prd_ID AND
								isMandatory = 1
							LIMIT
								1
						)
				".$From."
			WHERE
				
				P.Prd_isActive = 1 AND
				".$Where."
				P.Store_ID = ".__StoreID__."
				
			".$GroubBy."
				P.Prd_ID
			 
			 ".($OrderBy != "" ? "ORDER BY ".$OrderBy : "")."
			
			
			
			LIMIT
				".$Limit."
		");
		
		$P['T'] = $this->db->QRY("SELECT FOUND_ROWS() AS Total");
		
		# Do this on only search mode
		if(isset($Data['Search']) && $Data['Search'] != "")
		{
			$Prd_IDs = array();
			foreach($P['P'] AS $P_F)
			{
				$Prd_IDs[] = $P_F['Prd_ID'];
			}
			
			if(sizeof($Prd_IDs) > 0)
			{
				$Link_Tmp = $this->db->QRY("
					SELECT
						P.Prd_ID,
						C.Cat_SEO_URL
					FROM
						gc_products P,
						gc_category C,
						gc_products_to_categories P2C
					WHERE
						C.Cat_ID = P2C.Cat_ID AND
						P2C.Prd_ID = P.Prd_ID AND
						P.Prd_ID IN (".implode(',',$Prd_IDs).")
					GROUP BY
						P.Prd_ID
				");
				foreach($Link_Tmp AS $Link_Tmp_F)
				{
					$Tmp['Cat_Links'][$Link_Tmp_F['Prd_ID']] = $Link_Tmp_F['Cat_SEO_URL'];
				}
				foreach($P['P'] AS $K => $P_F)
				{
					if(isset($Tmp['Cat_Links'][$P_F['Prd_ID']]))
					{
						$P['P'][$K]['Cat_SEO_URL'] = $Tmp['Cat_Links'][$P_F['Prd_ID']];
					}
					
				}
			}
		}
		# Total Number : Found
		
		
		
		return $P;
	}
	
	
	
}


?>