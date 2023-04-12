<?php
class XML extends GGoRok
{
	
	var $Loaded;
	
	function __construct()
	{
		$this->Loaded = $this->LoadXMLs();
	}
	function LoadXMLs()
	{
		$XML_Path = __BackendPath__."XML/";
		$Output = array();
		
		if(is_dir($XML_Path))
		{
			
			$xmlFiles = scandir($XML_Path);
			
			foreach($xmlFiles as $xmlFiles_F)
			{
				
				if(is_file($XML_Path.$xmlFiles_F))
				{
					
					$XML = simplexml_load_file($XML_Path.$xmlFiles_F);
					$Count = 0;
					foreach($XML as $K => $XML_F)
					{
						$Count++;
						foreach($XML_F as $K2 => $XML_F_F)
						{
							
							$Output[$K][$Count][$K2] = (string)$XML_F->$K2;
						}
					}
				}
			}
		}
		return $Output;
	}
	
	function generateXML($Data, $Path)
	{
		
	}
	
}

?>