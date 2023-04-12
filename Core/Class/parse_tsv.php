<?php
class parse_tsv extends GGoRok
{
	function Load($FileName, $Path = null, $ignoreFirstLine = true)
	{
		if(is_null($Path))
			$Path = __UploadPath__;
			
		$FullPath = $Path.$FileName;
		
		if(is_file($FullPath))
		{
			$F = fopen($FullPath, 'r');
			
			$Result = array();
			
			$Count = 0;
			while (!feof($F))
			{
				
				$Line = fgets($F, 2048);
				$Data = str_getcsv($Line, '\t');
				
				if($ignoreFirstLine && $Count++ == 0)
				{
					continue;
				}
				else
				{
					foreach($Data AS $K => $Data_F)
					{
						$DataArr = preg_split('/\t/',$Data_F);
						if(sizeof($DataArr) > 0)
							$Result[$Count - 2] = $DataArr;
					}
				}
				
				
			}
			fclose($F);
			return $Result;
			
			
		}
	}
	
}

?>