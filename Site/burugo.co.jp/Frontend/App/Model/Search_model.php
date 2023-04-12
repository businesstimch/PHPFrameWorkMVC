<?php
class Search_model extends GGoRok {
	
	
	function SearchByKeyword($Data)
	{
		$Where = "";
		if(is_array($Data['RelatedKeyword']) && sizeof($Data['RelatedKeyword']) > 0)
		{
			$Where_RK = "";
			foreach($Data['RelatedKeyword'] AS $RelatedKeyword_F)
			{
				
				if($RelatedKeyword_F != "")
				{
					
					$Where_RK .= " K.Keyword = '".$this->db->escape($RelatedKeyword_F)."' OR";
				}
			}
			
			$Where .= " AND (".preg_replace('/OR$/','',$Where_RK).") ";
		}
		$output['B'] = $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords K,
				".DB_Table_Prefix."card_keywords_to_card K2C,
				".DB_Table_Prefix."store S
					LEFT JOIN
						".DB_Table_Prefix."store_image SI
					ON
						SI.Store_ID = S.Store_ID AND
						SI.Img_Type = 1
				
			WHERE
				K.Keyword_ID = K2C.Keyword_ID AND
				S.Store_ID = K2C.Card_ID AND
				K.Keyword like '%".$this->db->escape($Data['Keyword'])."%'
				".$Where."
				
			GROUP BY
				K2C.Card_ID
			LIMIT
				".(isset($Data['Limit']) ? $Data['Limit'] : 20)."
		");
		
		$output['F'] = $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords K,
				".DB_Table_Prefix."card_keywords_to_card K2C,
				".DB_Table_Prefix."friend F
			WHERE
				K.Keyword_ID = K2C.Keyword_ID AND
				F.Card_ID = K2C.Card_ID AND
				K.Keyword like '%".$this->db->escape($Data['Keyword'])."%'
				".$Where."
				
			GROUP BY
				K2C.Card_ID
			LIMIT
				".(isset($Data['Limit']) ? $Data['Limit'] : 20)."
		");
		
		foreach($output['F'] AS $K => $_F)
		{
			
			$output['F'][$K]['CardImg'] = $this->db->QRY("
				SELECT
					*
				FROM
					".DB_Table_Prefix."friend_image
				WHERE
					Card_ID = '".$this->db->escape($_F['Card_ID'])."'
			");
		}
		
		return $output;
	}
	
	
	
}
?>