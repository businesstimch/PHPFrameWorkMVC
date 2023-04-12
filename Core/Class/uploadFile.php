<?

class uploadFile extends GGoRok
{
	
	function duplicate_file_series($dir = null, $fileName = null)
	{
		preg_match('/\.[^\.]+$/i',$fileName,$ext);
		$F['ext'] = (isset($ext[0])?$ext[0] : null);
		$F['name'] = preg_replace('/\.[^\.]+$/i','',$fileName);
		
		if(is_file($dir.$fileName))
		{
			for($fileSerial = 0;is_file($dir.$fileNameTobe);$fileSerial++)
			{
				$fileNameTobe = $F['name'].'_'.$fileSerial.(is_null($F['ext']) ? "" : $F['ext']);
			}
			return $fileNameTobe;
		}
	}
	function randomize_filename($fileOriginalName,$FileID = '')
	{
		$Ext = explode(".", $fileOriginalName);
		
		$new_FileName = rand(100000000,900000000).'_'.rand(10000000000000,90000000000000).'_'.rand(1000000,9000000).($FileID != ""? '_'.$FileID:'').(sizeof($Ext) > 1 ? '.'.$Ext[sizeof($Ext) - 1] : '');
		return $new_FileName;
	}
	function upload_File($dir = null,$fileName = null, $fileArray_Argv = null, $onlyImage = true)
	{
		global $login;
		
		$Go = true;
		if($fileArray_Argv == null)
			$fileArray_Argv = 'Filedata'; // Uploadify Default : Tim
			
		if(!empty($_FILES))
		{
			
			//echo '[/['.$dir.']/]';
			if(!is_dir($dir))
				mkdir($dir,0777,true);
			
			if(!is_null($dir))
			{
				$tempFile = $_FILES[$fileArray_Argv]['tmp_name'];
				$targetPath = $dir;
				$targetFile = rtrim($targetPath,'/') . '/' . (is_null($fileName) ? $_FILES[$fileArray_Argv]['name'] : $fileName);
				
				
				if($onlyImage)
				{
					$img = getimagesize($tempFile);
					if($img !== false)
					{
						if($img['mime'] != "image/jpeg" &&  $img['mime'] != "image/gif" && $img['mime'] != "image/png" && $img['mime'] != "image/bmp")
						{
							$Go = false;
						}
						
					}
					else
					{
						$Go = false;
					}
				}
				
				if($Go)
				{
					if(move_uploaded_file($tempFile,$targetFile))
						return true;
				}
				else
					return false;
					
				
			}
		}
		
	}
}

/*
echo __DocumentPath__.'img\restaurants\\'.$login->_customerID;
if($login->isLogIn())
{
	if(!is_dir(__DocumentPath__.'img/restaurants/'.$login->_customerID))
		mkdir(__DocumentPath__.'img/restaurants/'.$login->_customerID);
	
	

}
*/
?>