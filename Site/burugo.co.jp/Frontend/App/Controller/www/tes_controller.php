<?
class WWWtes_Controller extends GGoRok
{
	function home()
	{
		//require_once(__DocumentPath__."Core/Module/phpwee-php-minifier/phpwee.php");
		//echo PHPWee\Minify::html($html);
		echo $this->Load->View('www/test.tpl');
		
	}
}
?>