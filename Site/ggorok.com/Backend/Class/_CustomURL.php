<?
class _CustomURL extends GGoRok
{
	public $csURLs;
	function __construct()
	{
		$this->setCustom_URL("/^c\/[a-zA-Z-_0-9]+\//", "c", _SubDomain_);
		$this->setCustom_URL("/^p\/[a-zA-Z-_0-9\/]+\.html/", "p/home", _SubDomain_);
		
		$this->setCustom_URL("/^corp\/modules\/google-merchant\/feed\.txt$/", "/corp/modules/google-merchant/getfeed", _SubDomain_);
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
	
	function setCustom_URL($_Regex, $_ControllerName, $SubDomain = null)
	{
		$this->csURLs[] = array($_Regex, $_ControllerName, $SubDomain);
	}
	
	
}
?>