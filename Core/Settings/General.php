<?
/*
*	This Framework Developed by Kyung Min Choi
*	Contact at businesstimch@gmail.com for any question.
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("default_charset", 'utf-8');
if(isset($_POST['PHPSESSID'])) //For Uploadify Session Problem
session_id($_POST['PHPSESSID']);
	
$Domain = new Domain($_SERVER['HTTP_HOST']);
$Domain->Info['Domain'];
$Domain->Info['Sub'];

date_default_timezone_set('America/New_York');
header("Content-Type: text/html; charset=utf-8");


define('_Tax_',7.00);
define('_FileUploadUniqueToken_','Your File Upload Unique Token (Ex. #&Ejuoinio1789^GYUI^G^&*g678)');
define('_LoginToken_','Insert Your Login Token (Ex. #&879HUhji1g686G^G^&*g678)');

# Want to use SSL protocol?
define('__USE_SSL__',false);

# Domain Name
define('__domain__',$Domain->Info['Domain']);
define('_SubDomain_',$Domain->Info['Sub']);
define('__HTTP__','http://'.__domain__);
define('__HTTPS__', (__USE_SSL__? 'https://'.__domain__:__HTTP__));
define('__SSL__', (__USE_SSL__? 'https://':'http://'));
define('__SITE__',$Domain->Info['Domain']);

# Root for JS, CSS
define('__DocumentRoot__','/');

# Real Path of Document
define('__DocumentPath__',preg_replace("/Core\/Settings$/","",dirname(__FILE__)));

# Template Path
define('__FrontendPath__', __DocumentPath__.'Site/'.__domain__.'/Frontend/');
define('__BackendPath__', __DocumentPath__.'Site/'.__domain__.'/Backend/');
define('__TemplatePath__', __DocumentRoot__.'Template/');
define('__UploadPath__',__FrontendPath__.'Upload/');


$__AjaxURL__ = preg_replace('/\/jsPage/','',preg_replace('/\.js/','/',$_SERVER['REQUEST_URI']));
define('__AjaxURL__', ($__AjaxURL__ == '/home/' ? '/' : $__AjaxURL__));

unset($__AjaxURL__);
# When customers register, this is the minimum length of password.
define('__minimum_password_length__',5);
define('__CookiePath__',".".__domain__);

#Load XML Settings
$Settings = function(){
	$xmlFiles = scandir(__DocumentPath__."Core/XML");
	$Output = array();
	foreach($xmlFiles as $xmlFiles_F)
	{
		if(is_file(__DocumentPath__."Core/XML/".$xmlFiles_F))
		{
			$XML = simplexml_load_file(__DocumentPath__.'Core/XML/'.$xmlFiles_F);
			$Count = 0;
			foreach($XML as $K => $XML_F)
			{
				$Count++;
				foreach($XML_F as $K2 => $XML_F_F)
				{
					
					$Output[$K][$Count][$K2] = (string)$XML_F->$K2;
				}
			}
		}
	}
	return $Output;
};

$Settings = $Settings();

class Domain
{
	private $URL;
	public $Info = array();
	private $DomainType = array();
	function __construct($URL)
	{
		$this->Info['Sub'] = '';
		$this->Info['Domain'] = '';
		$this->URL = preg_replace('/\:[0-9]+/','',$URL); # Get rid of port just in case.
		$this->LoadDomainType();
		$this->ParseURL();
	}
	function LoadDomainType()
	{
		# FIFO way Algorithim
		$this->DomainType[] = '.co.kr';
		$this->DomainType[] = '.co.jp';
		$this->DomainType[] = '.jp';
		$this->DomainType[] = '.kr';
		$this->DomainType[] = '.org';
		$this->DomainType[] = '.net';
		$this->DomainType[] = '.com';
	}
	
	function RegEx($Val)
	{
		return '/'.preg_replace('/\.+/','\.',$Val).'$/';
	}
	
	function parseURL()
	{
		
		$DomainType = "";
		foreach($this->DomainType AS $DomainType_F)
		{
			
			if(preg_match($this->RegEx($DomainType_F), $this->URL))
			{
				$DomainType = $DomainType_F;
				break;
			}
		}
		
		if(!empty($DomainType))
		{
			
			$Exploded_URL = explode('.',preg_replace($this->RegEx($DomainType),'',$this->URL));
			$this->Info['Domain'] = $Exploded_URL[sizeof($Exploded_URL) - 1].$DomainType;
			foreach($Exploded_URL AS $K => $Exploded_URL_F)
			{
				if($K + 1 < sizeof($Exploded_URL))
					$this->Info['Sub'] .= $Exploded_URL_F.'.';
			}
			$this->Info['Sub'] = preg_replace('/\.$/','',$this->Info['Sub']);
		}
	}
	
}



?>
