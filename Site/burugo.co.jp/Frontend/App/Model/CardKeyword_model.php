<?php
class CardKeyword_model extends GGoRok {
	
	
	function activateKeyword($Data)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."card_keywords_to_card
			SET
				Keyword_Activated = 1
			WHERE
				Keyword_ID = '".$this->db->escape($Data['Keyword_ID'])."' AND
				Card_ID = '".$this->db->escape($Data['Card_ID'])."'
		");
		$this->increaseKeywordInUse($Data);
	}
	
	function addKeyword_KeywordBank($Keyword)
	{
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."card_keywords
				(
					Keyword
				)
				VALUES
				(
					'".$this->db->escape($Keyword)."'
				)
		",True);
	}
	
	function hasKeyword($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords_to_card
			WHERE
				Keyword_ID = '".$this->db->escape($Data['Keyword_ID'])."' AND
				Card_ID = '".$this->db->escape($Data['Card_ID'])."'
		");
	}
	
	function getKeywordID_ByKeyword($Keyword)
	{
		
		return $this->db->QRY("
			SELECT
				Keyword_ID
			FROM
				".DB_Table_Prefix."card_keywords
			WHERE
				Keyword = '".$this->db->escape($Keyword)."'
		");
	
	}
	
	function increaseKeywordInUse($Data)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."card_keywords
			SET
				Keyword_Popularity = Keyword_Popularity + 1
			WHERE
				Keyword_ID = '".$this->db->escape($Data['Keyword_ID'])."'
		");
	}
	
	function decreaseKeywordInUse($Data)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."card_keywords
			SET
				Keyword_Popularity = Keyword_Popularity - 1
			WHERE
				Keyword_ID = '".$this->db->escape($Data['Keyword_ID'])."'
		");
	}
	
	function deleteCardAllKeywords($Data)
	{
		$Keywords = $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords_to_card
			WHERE
				Card_ID = '".$this->db->escape($Data['Card_ID'])."'
		");
		
		foreach($Keywords AS $Keywords_F)
		{
			$this->decreaseKeywordInUse($Keywords_F);
		}
		
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."card_keywords_to_card
			WHERE
				Card_ID = '".$this->db->escape($Data['Card_ID'])."'
		");
	}
	
	function getRelatedKeyword($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords
			WHERE
				Keyword like '%".$this->db->escape($Data['Keyword'])."%' AND
				Keyword_Popularity > 0
		");
	}
	
	function resetKeywordPopularity()
	{
		// Reset Keyword_Popularity
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."card_keywords
			SET
				Keyword_Popularity = 0
		");
		
		$K2S = $this->db->QRY("
			SELECT
				Keyword_ID
			FROM
				".DB_Table_Prefix."card_keywords_to_card
		");
		foreach($K2S AS $K2S_F)
		{
			$this->increaseKeywordInUse($K2S_F);
		}
		
	}
	
	function addKeyword($Data)
	{
		$this->increaseKeywordInUse($Data);
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."card_keywords_to_card
				(
					Keyword_ID,
					Card_ID,
					Card_Type
				)
				VALUES
				(
					'".$this->db->escape($Data['Keyword_ID'])."',
					'".$this->db->escape($Data['Card_ID'])."',
					'".$this->db->escape($Data['Card_Type'])."'
				)
		",true);
	}
	
	function deactivateKeyword($Data)
	{
		$this->db->QRY("
			UPDATE
				".DB_Table_Prefix."card_keywords_to_card
			SET
				Keyword_Activated = 0,
				DeactivatedOn = CURRENT_TIMESTAMP
			WHERE
				Keyword_ID = '".$this->db->escape($Data['Keyword_ID'])."' AND
				Card_ID = '".$this->db->escape($Data['Card_ID'])."'
		");
		$this->decreaseKeywordInUse($Data);
	}
	
	function deleteExpiredDeactivatedKeyword($Data)
	{
		$this->db->QRY("
			DELETE FROM
				".DB_Table_Prefix."card_keywords_to_card
			WHERE
				Card_ID = '".$this->db->escape($Data['Card_ID'])."' AND
				DeactivatedOn < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 14 DAY))
		");
	}
	
	function loadKeywords($Data)
	{
		return $this->db->QRY("
			SELECT
				*
			FROM
				".DB_Table_Prefix."card_keywords K,
				".DB_Table_Prefix."card_keywords_to_card K2S
			WHERE
				K.Keyword_ID = K2S.Keyword_ID AND
				K2S.Card_ID = '".$this->db->escape($Data['Card_ID'])."' AND
				K2S.Card_Type = '".$this->db->escape($Data['Card_Type'])."'
		");
	}
}