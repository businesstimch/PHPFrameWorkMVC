<?
class payment extends GGoRok
{
	function __construct()
	{
		
		
	}
	
	function processPayment($Argv = null)
	{
		$output['PaymentACK'] = true;
		return $output;
	}
}



?>