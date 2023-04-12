<?
class image extends GGoRok
{
	var $setting;
	
	function __construct()
	{
	
		/***
		 * 'uploadpath' Must Set
		 * 'img' is one element of folder for resampling.
		***/
		
		
		/* Profile Group : */
		
		$this->setting['profile']['setting']['uploadpath'] = 'original';
		$this->setting['profile']['img'][0]['folder'] = 'large';
		$this->setting['profile']['img'][0]['width'] = 600;
		$this->setting['profile']['img'][0]['height'] = -1;
		$this->setting['profile']['img'][1]['folder'] = 'thumbnail';
		$this->setting['profile']['img'][1]['width'] = 66;
		$this->setting['profile']['img'][1]['height'] = 66;
		/* Profile Group ; */
		
		/* Store Picture Group : */
		
		$this->setting['storepic']['setting']['uploadpath'] = 'original';
		$this->setting['storepic']['img'][0]['folder'] = 'large';
		$this->setting['storepic']['img'][0]['width'] = 600;
		$this->setting['storepic']['img'][0]['height'] = 600;
		$this->setting['storepic']['img'][1]['folder'] = 'showcase';
		$this->setting['storepic']['img'][1]['width'] = 155;
		$this->setting['storepic']['img'][1]['height'] = 155;
		$this->setting['storepic']['img'][2]['folder'] = 'list';
		$this->setting['storepic']['img'][2]['width'] = 122;
		$this->setting['storepic']['img'][2]['height'] = 70;
		$this->setting['storepic']['img'][3]['folder'] = 'thumbnail';
		$this->setting['storepic']['img'][3]['width'] = 50;
		$this->setting['storepic']['img'][3]['height'] = 50;
		/* Store Picture Group ; */
		
	}
	
	function delete_junkIMG($setting_arr_name)
	{
		global $db, $login;
		if($setting_arr_name == 'profile')
		{
			$pathToCheck = __DocumentPath__.'img/cData/'.$login->_customerID.'/profilePic/';
			$currentIMG_inDB = $db->QRY('
				SELECT
					customers_profile_picture AS img
				FROM
					b_customers
				WHERE
					customers_id = "'.$db->escape($login->_customerID).'"
				LIMIT
					1
			');
			
			//Must Set
			$basePath = __DocumentPath__.'img/cData/'.$login->_customerID.'/profilePic/';
			
		}
		
		//Put all image files into a variable to check easily.
		foreach($currentIMG_inDB as $currentIMG_inDB_F)
		{
			if($currentIMG_inDB_F['img'] != '')
				$imgs_in_DB_arr[] =$currentIMG_inDB_F['img'];
		}
		
		//If Only images were exist in DB
		if(isset($imgs_in_DB_arr) && sizeof($imgs_in_DB_arr) > 0)
		{
			//Get All files from target directory : Refer from "Setting" variable.
			$imgFiles = glob($basePath.$this->setting[$setting_arr_name]['setting']['uploadpath'].'/*');
			
			foreach($imgFiles as $imgFiles_F)
			{
				//If it is not a directory but a file. && The file is not exsist in the array got from DB.
				if(is_file($imgFiles_F) && !in_array(basename($imgFiles_F), $imgs_in_DB_arr))
				{
					//Delete a single file from uploaded default folder first.
					//echo basename($imgFiles_F).'//'.$imgs_in_DB_arr[0];
					unlink($imgFiles_F);
					foreach($this->setting[$setting_arr_name]['img'] as $folderToDelete)
					{
						$toDelete = $basePath.$folderToDelete['folder'].'/'.basename($imgFiles_F);
						if(is_file($toDelete))
							unlink($toDelete);
					}
				
				}
			}
		}	
		
	}
	
	function extract_image_files($Text = '')
	{
		# Tim : This function will extract image path from HTML, CSS
		$Ext_Arr = array(
			"png",
			"jpg",
			"gif",
			"bmp",
			"tiff",
			"jpeg"
		);
		
		$Path_RegExArr = array(
			'a-z',
			'A-Z',
			'0-9',
			'\ ',
			'\/',
			'\-',
			'\_',
			'\:',
			'\.'
		
		);
		$RegEx = "";
		foreach($Ext_Arr AS $Ext_Arr_F)
		{
			$RegEx .= "\.".$Ext_Arr_F.'|';
		}
		$RegEx = preg_replace('/\|$/',"",$RegEx);
		$output = array();
		
		if($Text != "")
		{
			$RegEx = '/[^\"\'\(]+\.('.implode('|',$Ext_Arr).')/i';
			preg_match_all($RegEx, $Text, $output);
			
		}
		
		
		return $output;
		
	}
	
	function resample_loop($sourceFile, $baseDir, $setting_arr_name)
	{
	
		foreach($this->setting[$setting_arr_name]['img'] as $setting_arr_F)
		{
			$this->resample($sourceFile,$baseDir.'/'.$setting_arr_F['folder'].'/',$setting_arr_F['width'],$setting_arr_F['height']);
		}
		
	}
	function resample($sourceFile ,$outputDirectory ,$width_Argv ,$height_Argv)
	{
		
		ini_set('memory_limit', '512M');
		if(!is_dir($outputDirectory))
		{
			mkdir($outputDirectory,0777,true);
		}
		
		$sourceFileInfo = pathinfo($sourceFile);
		if(is_file($sourceFile) && filesize($sourceFile) > 11)
		{
			if(exif_imagetype($sourceFile) == IMAGETYPE_GIF)
			{
				$img = imagecreatefromgif( $sourceFile );
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_JPEG)
			{
				$img = imagecreatefromjpeg( $sourceFile );
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_PNG)
			{
				$img = imagecreatefrompng( $sourceFile );
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_BMP)
			{
				$img = imagecreatefrombmp( $sourceFile );
			}
			
		
			
			
			$width_Final = $width_Argv;
			$height_Final = $height_Argv;
			$width_original = imagesx($img);
			$height_original = imagesy($img);
			
			if($width_Argv == -1 && $height_Argv == -1)
			{
				$width_Final = $width_original;
				$height_Final = $height_original;
			}
			/* If {Height} is negative, go strained image resize */
			if($height_Argv == -1)
				$height_Final = floor(($width_Argv / $width_original) * $height_original);
			
			
			
			
			
			//echo '[WidthOri:'.$width_original.']'.'[HeightOri:'.$height_original.']'.'[Width:'.$width_Final.']'.'[Height:'.$height_Final.']'.'<br />';
			
			/* create a new, "virtual" image */
			$virtual_image = imagecreatetruecolor($width_Final, $height_Final);
			
			/* copy source image at a resized size */
			imagecopyresampled($virtual_image, $img, 0, 0, 0, 0, $width_Final, $height_Final, $width_original, $height_original);
			if(exif_imagetype($sourceFile) == IMAGETYPE_GIF)
			{
				/* create the physical thumbnail image to its destination */
				imagegif($virtual_image, $outputDirectory.$sourceFileInfo['filename'].'.'.$sourceFileInfo['extension']);
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_JPEG)
			{
				/* create the physical thumbnail image to its destination */
				imagejpeg($virtual_image, $outputDirectory.$sourceFileInfo['filename'].'.'.$sourceFileInfo['extension']);
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_PNG)
			{
				/* create the physical thumbnail image to its destination */
				imagejpeg($virtual_image, $outputDirectory.$sourceFileInfo['filename'].'.'.$sourceFileInfo['extension']);
			}
			else if(exif_imagetype($sourceFile) == IMAGETYPE_BMP)
			{
				/* create the physical thumbnail image to its destination */
				imagejpeg($virtual_image, $outputDirectory.$sourceFileInfo['filename'].'.'.$sourceFileInfo['extension']);
			}
			
			
		}
		
	}
}


?>