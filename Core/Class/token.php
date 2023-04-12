<?
class token extends GGoRok
{
	function upload_token($create = true, $argv = null)
	{
		if($create)
		{
			$token['timestamp'] = date("smiYHdi");
			$token['token'] = md5(_FileUploadUniqueToken_ . $token['timestamp']);
			return $token;
		}
		else
		{
			$token = md5(_FileUploadUniqueToken_ . (isset($argv['timestamp'])?$argv['timestamp']:''));
			//echo $token.'//'.$argv['token'];
			return (($token == $argv['token'] ? true:false));
		}
	}
	function login_token($create = true, $argv = null)
	{
		
		if($create)
		{
			$TimeStamp = date("smiYHdi");
			$output['loginTK'] = md5(md5(_LoginToken_.md5($TimeStamp)._LoginToken_));
			$output['loginST'] = md5($TimeStamp);
			return $output;
		}
		else
		{
			$prev_token = md5(md5(_LoginToken_.$argv['loginST']._LoginToken_));
			if($prev_token == $argv['loginTK'])
				return true;
			else
				return false;
		}
		
	}
}
?>