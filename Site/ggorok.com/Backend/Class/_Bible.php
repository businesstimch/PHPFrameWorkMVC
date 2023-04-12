<?
class _Bible extends GGoRok
{
	
	# Random Verses Array
	var $RVs = array();
	
	function __construct()
	{
		
		$this->addRVs('Genesis','1:1');
		$this->addRVs('Isaiah','9:6');
		$this->addRVs('Isaiah','40:28');
		$this->addRVs('John','3:16');
		$this->addRVs('Romans','3:23');
		$this->addRVs('Romans','6:23');
		$this->addRVs('Revelation','3:20');
		$this->addRVs('John','14:6');
		$this->addRVs('Ephesians','2:8');
		$this->addRVs('2 Corinthians','5:17');
		$this->addRVs('Romans','8:23');
		
		$this->addRVs('Romans','8:38');
		$this->addRVs('1 Thessalonians','5:18');
		$this->addRVs('Psalms','19:14');
		$this->addRVs('Philippians','4:6');
		$this->addRVs('Psalms','145:18');
	}
	
	function addRVs($Book,$Addr)
	{
		$this->RVs[] = array($Book,$Addr);
	}
	
	function getRandomVerse()
	{
		
		
		if(sizeof($this->RVs) > 0)
		{
			
			$Selected = rand(0,sizeof($this->RVs) - 1);
			
			$Selected_T = $this->RVs[$Selected];
			
			$Where = explode(':',$Selected_T[1]);
			$B = $this->db->QRY("
				SELECT
					B.t
				FROM
					gc_bible_key K,
					gc_bible_kjv B
				WHERE
					B.b = K.b AND
					K.n = '".$this->db->escape($Selected_T[0])."' AND
					B.c = '".$Where[0]."' AND
					B.v = '".$Where[1]."'
					
			");
			if(sizeof($B) > 0)
				return $B[0]['t'].' ('.$Selected_T[0].' '.$Selected_T[1].')';
			else
				return $Selected_T[0].' '.$Selected_T[1];
		}
		
	}
}

?>