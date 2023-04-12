<?
class _CustomURL extends GGoRok
{
	public $csURLs;
	function __construct()
	{
		$this->setCustom_URL("/^b\//","/CardDetail","www");
	}
	
	function getCustom_URL($URL,$Redirect = false)
	{
		$URL = preg_replace('/^\//','',$URL);
		foreach($this->csURLs as $csURLs_F)
		{
			if(preg_match($csURLs_F[0], $URL))
			{
				return $csURLs_F;
			}
		}
		return false;
	}
	
	function setCustom_URL($_Regex, $_ControllerName, $SubDomain)
	{
		$this->csURLs[] = array($_Regex, $_ControllerName, $SubDomain);
	}
	
	
}
?>