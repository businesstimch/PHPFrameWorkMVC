<?php
class Address_model extends GGoRok {
	function getAddressIdea_Korea($Keyword)
	{
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."address_korea
			WHERE
				concat_ws(' ',CityGunGu_Name,EubMyunDong_Name,Street_Name) like '%".$this->db->escape($Keyword)."%' OR
				concat_ws(' ',CityGunGu_Name,Street_Name) like '%".$this->db->escape($Keyword)."%'
			GROUP BY
				Street_Name,EubMyunDong_Name
			ORDER BY
				CityDo_Name,
				CityGunGu_Name,
				EubMyunDong_Name,
				Street_Name ASC
			LIMIT
				50
		");
	
	}
	
	function getAddressIdea_Japan($Keyword)
	{
		
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."address_japan
			WHERE
				concat_ws(' ',City_Kanji,Townarea_Kanji) like '%".$this->db->escape($Keyword)."%' OR
				concat_ws(' ',Prefectures,City_Kanji,Townarea_Kanji) like '%".$this->db->escape($Keyword)."%'
			GROUP BY
				Townarea_Kanji
			ORDER BY
				Prefectures,
				City_Kanji,
				Townarea_Kanji ASC
			LIMIT
				50
		");
	
	}
	
}
?>