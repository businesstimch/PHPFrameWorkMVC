<?
class File extends GGoRok
{
	
	public function getMime($Type)
	{
		$Mine = array(
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'png' => 'image/png',
			'png' => 'image/png',
			'png' => 'image/x-citrix-png',
			'png' => 'image/x-png',
			'tiff' => 'image/tiff',
			'avi' => 'video/x-msvideo',
			'flv' => 'video/x-flv',
			'mov' => 'video',
			'ogg' => 'video/ogg',
			'mp4' => 'video/mp4'
		);
		if(isset($Mine[$Type]))
			return $Mine[$Type];
		
	}
	public function DeleteDirectory($Dir)
	{
		if(is_dir($Dir))
		{
			$files = array_diff(scandir($Dir), array('.','..'));
			foreach ($files as $file) {
				(is_dir("$Dir/$file")) ? $this->DeleteDirectory("$Dir/$file") : unlink("$Dir/$file");
			}
			return rmdir($Dir);
		}
	}
	public function ValidateFiles($_FILE ,$Allowed_Extensions = array())
	{
		
		$output['ack'] = 'error';
		
		
		// Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
		if (!isset($_FILE['error']) || is_array($_FILE['error'])) {
			$output['error_msg'] = 'Invalid parameters.';
		}
		else
		{
			
			// Check $_FILES['upfile']['error'] value.
			switch ($_FILE['error']) {
				case UPLOAD_ERR_OK:
			break;
				case UPLOAD_ERR_NO_FILE:
					$output['error_msg'] = 'No file sent.';
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					$output['error_msg'] = 'Exceeded filesize limit.';
			default:
				$output['error_msg'] = 'Unknown errors.';
			}
			
			// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
			// Check MIME Type by yourself.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			
			
			
			if (false === $ext = array_search( $finfo->file($_FILE['tmp_name']),$Allowed_Extensions, true ))
			{
				$output['error_msg'] = 'Invalid file format.';
			}
			
			if(!isset($output['error_msg']))
				$output['ack'] = 'success';
			
		}
		
		return $output;
	}
}
?>