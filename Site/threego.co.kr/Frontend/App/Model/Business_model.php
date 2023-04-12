<?php
class Business_model extends GGoRok {
	
	function Update($Data)
	{
		
		return $this->db->QRY('
			UPDATE
				'.DB_Table_Prefix.'store
			SET
				Store_OwnerName = "'.$this->db->escape($Data['StoreOwnerName_INP']).'",
				Store_Name = "'.$this->db->escape($Data['StoreName_INP']).'",
				Store_ShortDesc = "'.$this->db->escape($Data['StoreShortDesc_INP']).'",
				Store_Desc = "'.$this->db->escape($Data['StoreDescLong_INP']).'",
				Store_URL = "'.$this->db->escape($Data['SEOUrl_INP']).'",
				Store_ItemTitle = "'.$this->db->escape($Data['ItemTitle_INP']).'",
				Store_Service_Pickup = "'.$this->db->escape($Data['PickupService_INP']).'",
				Store_Service_Delivery = "'.$this->db->escape($Data['DeliveryService_INP']).'",
				Store_Service_Reservation = "'.$this->db->escape($Data['ReservationService_INP']).'",
				Store_Address1 = "'.$this->db->escape($Data['Address1_INP']).'",
				Store_Address2 = "'.$this->db->escape($Data['Address2_INP']).'",
				Store_ContactNumber = "'.$this->db->escape($Data['StoreContactNumber_INP']).'",'.
				(isset($Data['Store_Lng']) && isset($Data['Store_Lat']) ?
					'Store_Lng = "'.$this->db->escape($Data['Store_Lng']).'",
					Store_Lat = "'.$this->db->escape($Data['Store_Lat']).'",'
				:
					""
				).'
				Store_Country_Code = "KR"
			WHERE
				Store_ID = "'.$this->db->escape($Data['Store_ID']).'"
				'.(isset($Data['customers_id']) ? ' AND customers_id = "'.$Data['customers_id'].'"' : "").'
				
		');
	
	}
	
	function getCustomersIDbyBusinessID($Business_ID)
	{
		$R = $this->db->QRY("
			SELECT
				customers_id
			FROM
				".DB_Table_Prefix."store
			WHERE
				Store_ID = '".$this->db->escape($Business_ID)."'
			LIMIT
				1
		");
		return (sizeof($R) > 0 ? $R[0]['customers_id'] : false);
	}
	
	
	function deleteBusiness($Store_ID)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store
			WHERE
				Store_ID = '".$this->db->escape($Store_ID)."'
		");
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_hours
			WHERE
				Store_ID = '".$this->db->escape($Store_ID)."'
		");
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_image
			WHERE
				Store_ID = '".$this->db->escape($Store_ID)."'
		");
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items
			WHERE
				Store_ID = '".$this->db->escape($Store_ID)."'
		");
		
		$this->_Model_CardKeyword->deleteCardAllKeywords(array(
			'Card_ID' => $Store_ID
		));
	}
	function isMyBusiness($Store_ID, $Data = null)
	{
		$isMine = false;
		if($this->login->isLogIn())
		{
			$B = $this->db->QRY("
				SELECT
					Store_ID
				FROM
					".DB_Table_Prefix."store
				WHERE
					Store_ID = '".$this->db->escape($Store_ID)."' AND
					customers_id = '".$this->db->escape(isset($Data['customers_id']) ? $Data['customers_id'] : $this->login->_customerID)."'
			");
			if(sizeof($B) > 0)
				$isMine = true;
		}
		
		return $isMine;
	}
	function getImage($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_image
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				Img_Type = '".$this->db->escape($Data['Img_Type'])."'
		");
	}
	function isNewAddress($Data)
	{
		return $this->db->QRY("
			SELECT
				Store_ID
			FROM
				".DB_Table_Prefix."store
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				Store_Address1 = '".$this->db->escape($Data['Store_Address1'])."' AND
				Store_Address2 = '".$this->db->escape($Data['Store_Address2'])."'
		");
	}
	function deleteImage($Data)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_image
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				Img_Type = '".$this->db->escape($Data['Img_Type'])."'
		");
	}
	function addImage($Data)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."store_image
				(
					Store_ID,
					Img_Type,
					Img_FileName
				)
				VALUES
				(
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($Data['Img_Type'])."',
					'".$this->db->escape($Data['Img_FileName'])."'
				)
		",True);
	}
	
	function getBusiness_SQL()
	{
		return "
			SELECT
				*
			FROM
				".DB_Table_Prefix."store S
		";
	}
	
	function getStore($Data)
	{
		
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? "Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		$Where .= (isset($Data['customers_id']) ? " customers_id = '".$this->db->escape($Data['customers_id'])."' AND" : '');
		
		$Where = ($Where != "" ? ' WHERE '.$Where : '');
		
		$output['B'] = $this->db->QRY(
			$this->getBusiness_SQL().
			preg_replace("/AND$/","",$Where)
		);
		
		if(sizeof($output['B']) > 0)
		{
			
			
			foreach($output['B'] AS $Key => $Business_F)
			{
				# Load Images
				$Img = $this->db->QRY("
					SELECT
						*
					FROM
						".DB_Table_Prefix."store_image
					WHERE
						Store_ID = '".$this->db->escape($Business_F['Store_ID'])."'
				");
				foreach($Img AS $Img_F)
				{
					
					if($Img_F['Img_Type'] == 1)
					{
						$output['B'][$Key]['MainImage'] = $Img_F['Img_FileName'];
					}
				}
				# Load Business Keywords
				$output['B'][$Key]['BusinessKeywords'] = $this->_Model_CardKeyword->loadKeywords(array(
					'Card_ID' => $Business_F['Store_ID'],
					'Card_Type' => 1
				));
				
				# Business Hours
				$output['B'][$Key]['BusinessHours'] = $this->getBusinessHours(array('Store_ID' => $Business_F['Store_ID']));
				
				# Business Item Group
				$output['B'][$Key]['ItemGroups'] = $this->getItemGroup(array('Store_ID' => $Business_F['Store_ID']));
				
				# Business Item
				$output['B'][$Key]['Items'] = $this->getItems(array('Store_ID' => $Business_F['Store_ID']));
			}
		}
		
		return $output;
	}
	function getItemGroup($Data = null)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? "Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		
		$Where = ($Where != "" ? ' WHERE '.preg_replace("/AND$/","",$Where) : '');
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_items_group
			".$Where."
			ORDER BY
				ItemGrp_Sort ASC
		");
	}
	function deleteItemGroup($ItemGrp_ID)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items_to_group
			WHERE
				".(is_array($ItemGrp_ID) ? "ItemGrp_ID IN (".implode(',',$ItemGrp_ID).")" : "ItemGrp_ID = '".$this->db->escape($ItemGrp_ID)."'" )."
		");
		
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items_group
			WHERE
				".(is_array($ItemGrp_ID) ? "ItemGrp_ID IN (".implode(',',$ItemGrp_ID).")" : "ItemGrp_ID = '".$this->db->escape($ItemGrp_ID)."'" )."
		");
	}
	function deleteItem($ItemID)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items
			WHERE
				".(is_array($ItemID) ? "Item_ID IN (".implode(',',$ItemID).")" : "Item_ID = '".$this->db->escape($ItemID)."'" )."
		");
		
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items_group
			WHERE
				".(is_array($ItemID) ? "Item_ID IN (".implode(',',$ItemID).")" : "Item_ID = '".$this->db->escape($ItemID)."'" )."
		");
	}
	function getItemsInGroup($Data = null)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? " I2G.Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		$Where .= (isset($Data['ItemGrp_ID']) ? " I2G.ItemGrp_ID = '".$this->db->escape($Data['ItemGrp_ID'])."' AND": '');
		
		$Where = ($Where != "" ? ' WHERE '.preg_replace("/AND$/","",$Where) : '');
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_items_to_group I2G
					LEFT JOIN
						".DB_Table_Prefix."store_items SI
					ON
						SI.Item_ID = I2G.Item_ID
			".$Where."
			ORDER BY
				Item_Sort ASC
		");
	}
	
	function getItems($Data = null)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? " Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		
		$Where .= (isset($Data['Item_Activated']) ? " Item_Activated = '".$this->db->escape($Data['Item_Activated'])."' AND": '');
		
		if(isset($Data['Item_ID']))
			$Where .= (is_array($Data['Item_ID']) ? " Item_ID IN (".implode(',',$Data['Item_ID']).") AND" : " Item_ID = '".$this->db->escape($Data['Item_ID'])."' AND" );
		
		$Where = ($Where != "" ? ' WHERE '.preg_replace("/AND$/","",$Where) : '');
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_items
			".$Where."
			ORDER BY
				Item_Sort ASC
		");
	}
	function addItemGroup($Data = null)
	{
		$this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."store_items_group
				(
					Store_ID,
					ItemGrp_Name,
					ItemGrp_Sort
				)
				VALUES
				(
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($Data['ItemGrp_Name'])."',
					'".$this->db->escape($Data['ItemGrp_Sort'])."'
				)
		");
	}
	function deleteCurrentItemToGroup($Data)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_items_to_group
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				Item_ID = '".$this->db->escape($Data['Item_ID'])."'
		");
	}
	function getItemToGroup($Data = null)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? "IG.Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		
		$Where = ($Where != "" ? ' WHERE '.preg_replace("/AND$/","",$Where) : '');
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."store_items_to_group I2G
					LEFT JOIN
						".DB_Table_Prefix."store_items SI
					ON
						I2G.Item_ID = SI.Item_ID
					LEFT JOIN
						".DB_Table_Prefix."store_items_group IG
					ON
						I2G.ItemGrp_ID = IG.ItemGrp_ID
			".$Where."
			ORDER BY
				IG.ItemGrp_Sort ASC,
				I2G.Sort ASC
		");
	}
	function addItemToGroup($Data)
	{
		$this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."store_items_to_group
				(
					Store_ID,
					Item_ID,
					ItemGrp_ID,
					Sort
				)
				VALUES
				(
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($Data['Item_ID'])."',
					'".$this->db->escape($Data['ItemGrp_ID'])."',
					'".$this->db->escape($Data['Sort'])."'
				)
		");
	}
	function updateItemGroup($Data = null)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."store_items_group
			SET
				ItemGrp_Name = '".$this->db->escape($Data['ItemGrp_Name'])."',
				ItemGrp_Sort = '".$this->db->escape($Data['ItemGrp_Sort'])."'
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				ItemGrp_ID = '".$this->db->escape($Data['ItemGrp_ID'])."'
		");
	}
	function addItem($Data = null)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."store_items
				(
					Store_ID,
					Item_Name,
					Item_Desc,
					Item_Price,
					Item_Qty,
					Item_Sort,
					customers_id,
					".(isset($Data['Item_Image']) ? 'Item_Image,': '')."
					Item_Activated
				)
				VALUES
				(
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($Data['Item_Name'])."',
					'".$this->db->escape($Data['Item_Desc'])."',
					'".$this->db->escape($Data['Item_Price'])."',
					'".$this->db->escape($Data['Item_Qty'])."',
					'".$this->db->escape($Data['Item_Sort'])."',
					'".$this->db->escape($Data['customers_id'])."',
					".(isset($Data['Item_Image']) ? "'".$this->db->escape($Data['Item_Image'])."'," : '')."
					'".$this->db->escape($Data['Item_Activated'])."'
					
				)
		",true);
	}
	function updateItem($Data = null)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."store_items
			SET
				Item_Name = '".$this->db->escape($Data['Item_Name'])."',
				Item_Desc = '".$this->db->escape($Data['Item_Desc'])."',
				Item_Price = '".$this->db->escape($Data['Item_Price'])."',
				Item_Qty = '".$this->db->escape($Data['Item_Qty'])."',
				Item_Sort = '".$this->db->escape($Data['Item_Sort'])."',
				".(isset($Data['Item_Image']) ? "Item_Image = '".$this->db->escape($Data['Item_Image'])."'," : '')."
				Item_Activated = '".$this->db->escape($Data['Item_Activated'])."'
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND
				Item_ID = '".$this->db->escape($Data['Item_ID'])."'
		");
	}
	function getBusinessHours($Data = null)
	{
		$Where = "";
		$Where .= (isset($Data['Store_ID']) ? "Store_ID = '".$this->db->escape($Data['Store_ID'])."' AND": '');
		
		$Where = ($Where != "" ? ' WHERE '.preg_replace("/AND$/","",$Where) : '');
		
		return $this->db->QRY("
			SELECT
				Store_ID,
				Date_ID,
				DATE_FORMAT(OpenTime,'%H:%i') AS OpenTime,
				DATE_FORMAT(CloseTime,'%H:%i') AS CloseTime
			FROM
				".DB_Table_Prefix."store_hours
			".$Where."
		");
	}
	function getStore_By_CustomerID($Data = null)
	{
		return $this->db->QRY(
				$this->getBusiness_SQL()."
			WHERE
				customers_id = '".$this->db->escape(isset($Data['customers_id']) ? $Data['customers_id'] : $this->login->_customerID)."'
		");
	}
	function addStore($Data)
	{
		return $this->db->QRY('
			INSERT INTO
				'.DB_Table_Prefix.'store
				(
					Store_OwnerName,
					Store_Country_Code,
					Store_Name,
					Store_ShortDesc,
					Store_Desc,
					Store_URL,
					Store_Address1,
					Store_Address2,
					Store_Lng,
					Store_Lat,
					Store_ContactNumber,
					Store_ItemTitle,
					Store_Service_Pickup,
					Store_Service_Delivery,
					Store_Service_Reservation,
					customers_id
				)
				VALUES
				(
					"'.$this->db->escape($Data['StoreOwnerName_INP']).'",
					"KR",
					"'.$this->db->escape($Data['StoreName_INP']).'",
					"'.$this->db->escape($Data['StoreShortDesc_INP']).'",
					"'.$this->db->escape($Data['StoreDescLong_INP']).'",
					"'.$this->db->escape($Data['SEOUrl_INP']).'",
					"'.$this->db->escape($Data['Address1_INP']).'",
					"'.$this->db->escape($Data['Address2_INP']).'",
					"'.$this->db->escape($Data['Store_Lng']).'",
					"'.$this->db->escape($Data['Store_Lat']).'",
					"'.$this->db->escape($Data['StoreContactNumber_INP']).'",
					"'.$this->db->escape($Data['ItemTitle_INP']).'",
					"'.$this->db->escape($Data['PickupService_INP']).'",
					"'.$this->db->escape($Data['DeliveryService_INP']).'",
					"'.$this->db->escape($Data['ReservationService_INP']).'",
					"'.$this->db->escape($this->login->_customerID).'"
				)
		',TRUE);
	}
	
	function SaveStoreHours($Data)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."store_hours
			WHERE
				Store_ID = '".$this->db->escape($Data['Store_ID'])."'
		");
		
		foreach($Data['Arr'] AS $_F)
		{
			$this->db->QRY("
				INSERT INTO
					".DB_Table_Prefix."store_hours
					(
						Store_ID,
						Date_ID,
						OpenTime,
						CloseTime
					)
				VALUES
				(
					'".$this->db->escape($Data['Store_ID'])."',
					'".$this->db->escape($_F['ID'])."',
					'".$this->db->escape($_F['O'])."',
					'".$this->db->escape($_F['C'])."'
				)
			");
		}
		
	}
	
	function getStoreID_By_SeoURL($Data)
	{
		$C = $this->db->QRY("
			SELECT
				Store_ID
			FROM
				".DB_Table_Prefix."store
			WHERE
				Store_URL = '".$Data['Store_URL']."'
				".(isset($Data['Store_ID']) ? " AND Store_URL = '".$Data['Store_ID']."'" : '')."
		");
		
		return (sizeof($C) > 0 ? $C[0]['Store_ID'] : false);
	}
}
?>