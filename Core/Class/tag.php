<?
class tag extends GGoRok
{
	var $code;
	
	function __construct()
	{
		$this->code[0]['tag']['a'] = '[newline]';
		$this->code[0]['html']['a'] = '<br />';
		
		
	}
	
	function convert($txtToConvert)
	{
		foreach($this->code as $code)
		{
			$txtToConvert = str_replace($code['tag']['a'], $code['html']['a'], $txtToConvert);
		}
		
		return $txtToConvert;
	}
	
}
?>