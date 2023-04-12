<?

class _Category extends GGoRok
{
	public $AllCat;
	function __construct()
	{
		
		$this->AllCat = $this->db->QRY("
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
	function getBreadCrumb($cID, $Data = null, $output = null)
	{
		
		if(is_null($Data))
		{
			$Data = $this->getCategoryList_SQL();
			$output[] = array(0,"Home","/");
		}
		
		if($cID != 0)
		{
			foreach($Data as $Data_F)
			{
				if($Data_F['Cat_ID'] == $cID)
				{
					$output[] = array($cID,$Data_F['Cat_Name'],$Data_F['Cat_Name'],$Data_F['Cat_SEO_URL']);
					$this->getBreadCrumb($Data_F['Cat_Parent_ID'],$Data, $output);
					break;
				}
				
			}
		}
		
		return $output;
		
		
	}
	function getTotalPrd_InCat($cID)
	{
		
		$ChildTree = $this->getChildCat_Tree($cID,$this->AllCat);
		
		$Prd_Total_InThisCat = 0;
		
		
		$Prd_Total_InThisCat_Tmp = $this->db->QRY("
			SELECT
				COUNT(P.Prd_ID) AS TotalPrd
			FROM
				gc_products_to_categories P2C
					LEFT JOIN
						gc_products P
					ON
						P2C.Prd_ID = P.Prd_ID AND
						P.Prd_isActive = 1
			WHERE
				P2C.Cat_ID IN (".( sizeof($ChildTree) > 0 ? implode(',', $ChildTree).',' :'' ).$cID.")
		");
		$Prd_Total_InThisCat = $Prd_Total_InThisCat_Tmp[0]['TotalPrd'];
		
		return $Prd_Total_InThisCat;
	}
	function getChildCat_Tree($CatID, $CatArr)
	{
		
		
		
		$IDs = array();
		foreach($CatArr as $K => $CatArr_F)
		{
			if($CatArr_F['Cat_Parent_ID'] == $CatID)
			{
				$IDs[] = $CatArr_F['Cat_ID'];
				$IDs = array_merge($IDs,$this->getChildCat_Tree($CatArr_F['Cat_ID'], $CatArr));
				unset($CatArr[$K]);
			}
			
		}
		
		return $IDs;
		
	}
	
	function getProductList_SQL($cID,$Data = null)
	{
		
		# Product Info
		$Select = '';
		$Where = '';
		$OrderBy = '';
		$From = '';
		$GroubBy = 'GROUP BY';
		
		$LimitScore = 1;
		
		
		if(!is_null($cID))
		{
			$From .= ',gc_products_to_categories P2C';
			$Where .= "
			P.Prd_ID = P2C.Prd_ID AND
			P2C.Cat_ID ".(is_array($cID)? "IN (".implode(",",$cID).")" : " = ".$this->db->escape($cID))." AND";
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
		$P['T'] = $this->db->QRY("SELECT FOUND_ROWS() AS Total");
		
		
		return $P;
	}
	
	function getFullURL($cID, $Data = null, $output = array())
	{
		
		if(is_null($Data))
		{
			$Data = $this->db->QRY("
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
		
		foreach($Data as $Data_F)
		{
			if($Data_F['Cat_ID'] == $cID)
			{
				$output[] = array($Data_F['Cat_SEO_URL'],$Data_F['Cat_Name']);
				$output = $this->getFullURL($Data_F['Cat_Parent_ID'],$Data,$output);
				break;
			}
			
		}
		
		if($cID == 0)
		{
			$output = array_reverse($output);
		}
		return $output;
		
	}
	function getCategoryList_SQL($cID = null)
	{
		
		return $this->AllCat;
	}
	function getCategoryList($cID = null)
	{
		
		$output['ack'] = 'success';
		$C = $this->getCategoryList_SQL($cID);
		$output['html'] = '';
		
		if(sizeof($C) > 0)
		{
			$output['html'] = $this->getCategoryList_Recursive($C);
		}
		
		return $output;
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
	function getParents_FromUrl($URL, $output = array())
	{
		$Parent = $this->_Model_Category->getParent_From_URL($URL);
		
		if(sizeof($Parent) > 0)
		{
			$output[] = $Parent[0];
		}
		
		if(sizeof($Parent) > 0)
		{
			return $this->getParents_FromUrl($Parent[0]['Cat_SEO_URL'],$output);
		}
		else
			return (sizeof($output) > 0 ? array_reverse($output) : $output);
	}
	
	function getCategoryList_Recursive($Data,$ParentID = 0, $Depth = 0)
	{
		$HTML = '<div class="CatList_Block">';
		foreach($Data as $K => $Data_F)
		{
			
			if($Data_F['Cat_Parent_ID'] == $ParentID)
			{
				$HTML .= '<div class="CatList_Group">';
				$HTML .= '	<div class="CatList_One Glow noSelect" data-catid="'.$Data_F['Cat_ID'].'"><div class="changeOrder"></div><i class="fa fa-folder-open-o"></i> '.$Data_F['Cat_Name'].'</div>';
				unset($Data[$K]);
				
				foreach($Data as $K2 => $Data2_F)
				{
					
					if($Data2_F['Cat_Parent_ID'] == $Data_F['Cat_ID'])
					{
						$HTML .= $this->getCategoryList_Recursive($Data, $Data2_F['Cat_Parent_ID'],$Depth + 1);
						break;
					}
				}
				$HTML .= '</div>';
			}
			
		}
		
		$HTML .= '</div>';
		return $HTML;
	}
		
	
}
?>