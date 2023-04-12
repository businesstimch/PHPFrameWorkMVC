<?
class _Product extends GGoRok
{
	function getInfo_From_URL($URL)
	{
		
		$P['Prd'] = $this->db->QRY("
			SELECT
				*
			FROM
				gc_products
			WHERE
				Prd_SEO_URL = '".$this->db->escape(preg_replace("/\.html$/","",$URL))."' AND
				Store_ID = ".__StoreID__."
			LIMIT
				1
		");
		
		
		# If this is an existing product
		if(sizeof($P['Prd']) > 0)
		{
			$P['Prd'] = $P['Prd'][0];
			#Load Images
			$P['Img'] = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_images
				WHERE
					Prd_ID = '".$P['Prd']['Prd_ID']."'
				ORDER BY
					Img_isDefault DESC,
					Img_Sort ASC
			");
			
			#Load Options
			$P['Opt'] = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_option_group
				WHERE
					Prd_ID = '".$P['Prd']['Prd_ID']."'
				ORDER BY
					OptGrp_ID ASC
			");
			if(sizeof($P['Opt']) > 0)
			{
				$P['hasMandatoryOpt'] = false;
				foreach($P['Opt'] as $OP_F)
				{
					if($OP_F['isMandatory'] == 1)
						$P['hasMandatoryOpt'] = true;
				}
			}
			
			#Load Files
			$Tmp = $this->db->QRY("
				SELECT
					*
				FROM
					gc_products_files
				WHERE
					Prd_ID = '".$P['Prd']['Prd_ID']."'
				ORDER BY
					Media_ID ASC
			");
			$P['Files']['Tubes'] = array();
			foreach($Tmp as $Tmp_F)
			{
				if($Tmp_F['File_Type'] == 1)
					$P['Files']['Tubes'][] = $Tmp_F['File_Name'];
			}
			
			return $P;
		}
		else
			return false;
	}
}
?>