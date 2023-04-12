<?

class Search_Model extends GGoRok_Model{
	function loadSearchKeyword($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				gc_search_autocomplete
			WHERE
				AC_Keyword LIKE '".$Data['Keyword']."%'
			ORDER BY
				AC_Searched
			LIMIT
				5
		");
	}
	
	function addSearchKeyword($Data)
	{
		return $this->db->QRY("
			REPLACE INTO
				gc_search_autocomplete
				(
					AC_Keyword,
					AC_Searched
				)
				VALUES
				(
					'".$Data['Keyword']."',
					AC_Searched + 1
				)
		");
	}
	
}

?>