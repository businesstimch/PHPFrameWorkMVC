<?

class Controller extends GGoRok_Controller
{
	function __construct()
	{
		global $language;
		$this->allowPOST_Function[] = 'loadWeather_Block';
	}
	
	
	
	function refreshPage()
	{
		$output['ack'] = 'error';
		return $output;
	}
	
	
}


?>