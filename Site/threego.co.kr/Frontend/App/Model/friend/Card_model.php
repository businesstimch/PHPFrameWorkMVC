<?php
class FriendCard_model extends GGoRok {
	
	function getCard($Data)
	{
		$Where = "";
		$Where .= (isset($Data['Card_ID']) ? "Card_ID = '".$this->db->escape($Data['Card_ID'])."' AND": '');
		$Where .= (isset($Data['customers_id']) ? " customers_id = '".$this->db->escape($Data['customers_id'])."' AND" : '');
		$Where = ($Where != "" ? ' WHERE '.$Where : '');
		
		$output['C'] = $this->db->QRY(
			$this->getCard_SQL().
			preg_replace("/AND$/","",$Where)
		);
		
		if(sizeof($output['C']) > 0)
		{
			
			foreach($output['C'] AS $Key => $Card_F)
			{
				# Load Images
				$Img = $this->db->QRY("
					SELECT
						*
					FROM
						".DB_Table_Prefix."friend_image
					WHERE
						Card_ID = '".$this->db->escape($Card_F['Card_ID'])."'
					ORDER BY
						Img_ID ASC
				");
				foreach($Img AS $Img_F)
				{
					
					if($Img_F['Img_Type'] == 1)
					{
						$output['C'][$Key]['CardPics'][] = $Img_F['Img_FileName'];
					}
				}
				
				# Load Card Keywords
				$output['C'][$Key]['CardKeywords'] = $this->_Model_CardKeyword->loadKeywords(array(
					'Card_ID' => $Card_F['Card_ID'],
					'Card_Type' => 2
				));
				
			}
		}
		
		return $output;
	}
	
	function Update($Data)
	{
		
		return $this->db->QRY('
			UPDATE
				'.DB_Table_Prefix.'friend
			SET
				Friend_Name = "'.$this->db->escape($Data['Name_INP']).'",
				Friend_Relationship = "'.$this->db->escape($Data['CurrentStatus_SLT']).'",
				Friend_Telephone = "'.$this->db->escape($Data['Phone_INP']).'",
				Friend_BDay = "'.$this->db->escape($Data['Friend_BDay']).'",
				Friend_ShortDesc = "'.$this->db->escape($Data['ShortDesc_INP']).'",
				Friend_Look = "'.$this->db->escape($Data['Look_INP']).'",
				Friend_Job = "'.$this->db->escape($Data['Job_INP']).'",
				Friend_Character = "'.$this->db->escape($Data['Character_INP']).'",
				Friend_Religion = "'.$this->db->escape($Data['Religion_SLT']).'",
				Friend_ReligionImp = "'.$this->db->escape($Data['ReligionImp_SLT']).'",
				Friend_Gender = "'.$this->db->escape($Data['Gender_SLT']).'",
				Friend_GenderImp = "'.$this->db->escape($Data['GenderImp_SLT']).'"
			WHERE
				Card_ID = "'.$this->db->escape($Data['Card_ID']).'"
				'.(isset($Data['customers_id']) ? ' AND customers_id = "'.$Data['customers_id'].'"' : "").'
				
		');
	
	}
	
	function isMine($Card_ID, $Data = null)
	{
		$isMine = false;
		if($this->login->isLogIn())
		{
			$B = $this->db->QRY("
				SELECT
					Card_ID
				FROM
					".DB_Table_Prefix."friend
				WHERE
					Card_ID = '".$this->db->escape($Card_ID)."' AND
					customers_id = '".$this->db->escape(isset($Data['customers_id']) ? $Data['customers_id'] : $this->login->_customerID)."'
			");
			if(sizeof($B) > 0)
				$isMine = true;
		}
		
		return $isMine;
	}
	
	function getCard_SQL()
	{
		return "
			SELECT
				*
			FROM
				".DB_Table_Prefix."friend C
		";
	}
	
	function addCard($Data = null)
	{
		return $this->db->QRY('
			INSERT INTO
				'.DB_Table_Prefix.'friend
				(
					Friend_Name,
					Friend_Relationship,
					Friend_Telephone,
					Friend_BDay,
					Friend_ShortDesc,
					Friend_Look,
					Friend_Job,
					Friend_Character,
					Friend_Religion,
					Friend_ReligionImp,
					Friend_Gender,
					Friend_GenderImp,
					customers_id
				)
				VALUES
				(
					"'.$this->db->escape($Data['Name_INP']).'",
					"'.$this->db->escape($Data['CurrentStatus_SLT']).'",
					"'.$this->db->escape($Data['Phone_INP']).'",
					"'.$this->db->escape($Data['Friend_BDay']).'",
					"'.$this->db->escape($Data['ShortDesc_INP']).'",
					"'.$this->db->escape($Data['Look_INP']).'",
					"'.$this->db->escape($Data['Job_INP']).'",
					"'.$this->db->escape($Data['Character_INP']).'",
					"'.$this->db->escape($Data['Religion_SLT']).'",
					"'.$this->db->escape($Data['ReligionImp_SLT']).'",
					"'.$this->db->escape($Data['Gender_SLT']).'",
					"'.$this->db->escape($Data['GenderImp_SLT']).'",
					"'.$this->db->escape($this->login->_customerID).'"
				)
		',TRUE);
	}
	
	function addImage($Data)
	{
	
		return $this->db->QRY("
			INSERT INTO
				".DB_Table_Prefix."friend_image
				(
					Card_ID,
					Img_Type,
					Img_FileName
				)
				VALUES
				(
					'".$this->db->escape($Data['Card_ID'])."',
					'".$this->db->escape($Data['Img_Type'])."',
					'".$this->db->escape($Data['Img_FileName'])."'
				)
		",True);	
	
	}
}	
?>