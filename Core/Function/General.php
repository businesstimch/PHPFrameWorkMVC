<?

function addGetURL($Data)
{
	$URL_Tmp = array();
	$URL = array();
	foreach($_GET AS $K => $_F)
	{
		$URL_Tmp[$K] = $_F;
	}
	
	if(is_array($Data))
	{
		foreach($Data AS $_AddK => $Data_F)
		{
			
			$URL_Tmp[$_AddK] = $Data_F;
			
		}
	}
	
	foreach($URL_Tmp AS $_K => $_F)
	{
		$URL[] .= $_K."=".$_F;
	}
	
	return implode($URL,'&');
}

function verifyURL($URL)
{
	
	if(preg_match("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i",$URL))
	{
		return $URL;
	}
	else if(preg_match("|^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i",$URL))
	{
		$URL = 'http://'.$URL;
		return $URL;
	}
	else
		return false;
	
}

function removeDirectory($path)
{
	$files = glob($path . '/*');
	foreach ($files as $file) {
		is_dir($file) ? removeDirectory($file) : unlink($file);
	}
	rmdir($path);
}
function autoInsertSQL($Prefix)
{
	global $db;
	$Qry['Update'] = "";
	foreach($_POST as $K => $_POST_F)
	{
		
		if(preg_match("/^".$Prefix."/",$K))
		{
			
			$Tmp_Field = $db->escape(preg_replace("/^".$Prefix."/","",$K));
			$Tmp_Values = $db->escape($_POST[$K]);
			
			$Qry['Fields'][] = $Tmp_Field;
			$Qry['Values'][] = "'".$Tmp_Values."'";
			$Qry['Update'] .= $Tmp_Field."='".$Tmp_Values."',";
		}
		
	}
	$Qry['Update'] = preg_replace("/\,$/","",$Qry['Update']);
	
	
	$Qry['ack'] = (sizeof($Qry['Fields']) > 0 && $Qry['Update'] != "" ? true:false);
	return $Qry;
	
}
function printTimeZoneSelect($attr)
{
	$timezones = array (
		'(GMT-12:00) International Date Line West' => 'Pacific/Wake',
		'(GMT-11:00) Midway Island' => 'Pacific/Apia',
		'(GMT-11:00) Samoa' => 'Pacific/Apia',
		'(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
		'(GMT-09:00) Alaska' => 'America/Anchorage',
		'(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana' => 'America/Los_Angeles',
		'(GMT-07:00) Arizona' => 'America/Phoenix',
		'(GMT-07:00) Chihuahua' => 'America/Chihuahua',
		'(GMT-07:00) La Paz' => 'America/Chihuahua',
		'(GMT-07:00) Mazatlan' => 'America/Chihuahua',
		'(GMT-07:00) Mountain Time (US &amp; Canada)' => 'America/Denver',
		'(GMT-06:00) Central America' => 'America/Managua',
		'(GMT-06:00) Central Time (US &amp; Canada)' => 'America/Chicago',
		'(GMT-06:00) Guadalajara' => 'America/Mexico_City',
		'(GMT-06:00) Mexico City' => 'America/Mexico_City',
		'(GMT-06:00) Monterrey' => 'America/Mexico_City',
		'(GMT-06:00) Saskatchewan' => 'America/Regina',
		'(GMT-05:00) Bogota' => 'America/Bogota',
		'(GMT-05:00) Eastern Time (US &amp; Canada)' => 'America/New_York',
		'(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
		'(GMT-05:00) Lima' => 'America/Bogota',
		'(GMT-05:00) Quito' => 'America/Bogota',
		'(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
		'(GMT-04:00) Caracas' => 'America/Caracas',
		'(GMT-04:00) La Paz' => 'America/Caracas',
		'(GMT-04:00) Santiago' => 'America/Santiago',
		'(GMT-03:30) Newfoundland' => 'America/St_Johns',
		'(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
		'(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
		'(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
		'(GMT-03:00) Greenland' => 'America/Godthab',
		'(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
		'(GMT-01:00) Azores' => 'Atlantic/Azores',
		'(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
		'(GMT) Casablanca' => 'Africa/Casablanca',
		'(GMT) Edinburgh' => 'Europe/London',
		'(GMT) Greenwich Mean Time : Dublin' => 'Europe/London',
		'(GMT) Lisbon' => 'Europe/London',
		'(GMT) London' => 'Europe/London',
		'(GMT) Monrovia' => 'Africa/Casablanca',
		'(GMT+01:00) Amsterdam' => 'Europe/Berlin',
		'(GMT+01:00) Belgrade' => 'Europe/Belgrade',
		'(GMT+01:00) Berlin' => 'Europe/Berlin',
		'(GMT+01:00) Bern' => 'Europe/Berlin',
		'(GMT+01:00) Bratislava' => 'Europe/Belgrade',
		'(GMT+01:00) Brussels' => 'Europe/Paris',
		'(GMT+01:00) Budapest' => 'Europe/Belgrade',
		'(GMT+01:00) Copenhagen' => 'Europe/Paris',
		'(GMT+01:00) Ljubljana' => 'Europe/Belgrade',
		'(GMT+01:00) Madrid' => 'Europe/Paris',
		'(GMT+01:00) Paris' => 'Europe/Paris',
		'(GMT+01:00) Prague' => 'Europe/Belgrade',
		'(GMT+01:00) Rome' => 'Europe/Berlin',
		'(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
		'(GMT+01:00) Skopje' => 'Europe/Sarajevo',
		'(GMT+01:00) Stockholm' => 'Europe/Berlin',
		'(GMT+01:00) Vienna' => 'Europe/Berlin',
		'(GMT+01:00) Warsaw' => 'Europe/Sarajevo',
		'(GMT+01:00) West Central Africa' => 'Africa/Lagos',
		'(GMT+01:00) Zagreb' => 'Europe/Sarajevo',
		'(GMT+02:00) Athens' => 'Europe/Istanbul',
		'(GMT+02:00) Bucharest' => 'Europe/Bucharest',
		'(GMT+02:00) Cairo' => 'Africa/Cairo',
		'(GMT+02:00) Harare' => 'Africa/Johannesburg',
		'(GMT+02:00) Helsinki' => 'Europe/Helsinki',
		'(GMT+02:00) Istanbul' => 'Europe/Istanbul',
		'(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
		'(GMT+02:00) Kyiv' => 'Europe/Helsinki',
		'(GMT+02:00) Minsk' => 'Europe/Istanbul',
		'(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
		'(GMT+02:00) Riga' => 'Europe/Helsinki',
		'(GMT+02:00) Sofia' => 'Europe/Helsinki',
		'(GMT+02:00) Tallinn' => 'Europe/Helsinki',
		'(GMT+02:00) Vilnius' => 'Europe/Helsinki',
		'(GMT+03:00) Baghdad' => 'Asia/Baghdad',
		'(GMT+03:00) Kuwait' => 'Asia/Riyadh',
		'(GMT+03:00) Moscow' => 'Europe/Moscow',
		'(GMT+03:00) Nairobi' => 'Africa/Nairobi',
		'(GMT+03:00) Riyadh' => 'Asia/Riyadh',
		'(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
		'(GMT+03:00) Volgograd' => 'Europe/Moscow',
		'(GMT+03:30) Tehran' => 'Asia/Tehran',
		'(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
		'(GMT+04:00) Baku' => 'Asia/Tbilisi',
		'(GMT+04:00) Muscat' => 'Asia/Muscat',
		'(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
		'(GMT+04:00) Yerevan' => 'Asia/Tbilisi',
		'(GMT+04:30) Kabul' => 'Asia/Kabul',
		'(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
		'(GMT+05:00) Islamabad' => 'Asia/Karachi',
		'(GMT+05:00) Karachi' => 'Asia/Karachi',
		'(GMT+05:00) Tashkent' => 'Asia/Karachi',
		'(GMT+05:30) Chennai' => 'Asia/Calcutta',
		'(GMT+05:30) Kolkata' => 'Asia/Calcutta',
		'(GMT+05:30) Mumbai' => 'Asia/Calcutta',
		'(GMT+05:30) New Delhi' => 'Asia/Calcutta',
		'(GMT+05:45) Kathmandu' => 'Asia/Katmandu',
		'(GMT+06:00) Almaty' => 'Asia/Novosibirsk',
		'(GMT+06:00) Astana' => 'Asia/Dhaka',
		'(GMT+06:00) Dhaka' => 'Asia/Dhaka',
		'(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
		'(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
		'(GMT+06:30) Rangoon' => 'Asia/Rangoon',
		'(GMT+07:00) Bangkok' => 'Asia/Bangkok',
		'(GMT+07:00) Hanoi' => 'Asia/Bangkok',
		'(GMT+07:00) Jakarta' => 'Asia/Bangkok',
		'(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
		'(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
		'(GMT+08:00) Chongqing' => 'Asia/Hong_Kong',
		'(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
		'(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
		'(GMT+08:00) Kuala Lumpur' => 'Asia/Singapore',
		'(GMT+08:00) Perth' => 'Australia/Perth',
		'(GMT+08:00) Singapore' => 'Asia/Singapore',
		'(GMT+08:00) Taipei' => 'Asia/Taipei',
		'(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
		'(GMT+08:00) Urumqi' => 'Asia/Hong_Kong',
		'(GMT+09:00) Osaka' => 'Asia/Tokyo',
		'(GMT+09:00) Sapporo' => 'Asia/Tokyo',
		'(GMT+09:00) Seoul' => 'Asia/Seoul',
		'(GMT+09:00) Tokyo' => 'Asia/Tokyo',
		'(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
		'(GMT+09:30) Adelaide' => 'Australia/Adelaide',
		'(GMT+09:30) Darwin' => 'Australia/Darwin',
		'(GMT+10:00) Brisbane' => 'Australia/Brisbane',
		'(GMT+10:00) Canberra' => 'Australia/Sydney',
		'(GMT+10:00) Guam' => 'Pacific/Guam',
		'(GMT+10:00) Hobart' => 'Australia/Hobart',
		'(GMT+10:00) Melbourne' => 'Australia/Sydney',
		'(GMT+10:00) Port Moresby' => 'Pacific/Guam',
		'(GMT+10:00) Sydney' => 'Australia/Sydney',
		'(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
		'(GMT+11:00) Magadan' => 'Asia/Magadan',
		'(GMT+11:00) New Caledonia' => 'Asia/Magadan',
		'(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
		'(GMT+12:00) Auckland' => 'Pacific/Auckland',
		'(GMT+12:00) Fiji' => 'Pacific/Fiji',
		'(GMT+12:00) Kamchatka' => 'Pacific/Fiji',
		'(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
		'(GMT+12:00) Wellington' => 'Pacific/Auckland',
		'(GMT+13:00) Nuku\'alofa' => 'Pacific/Tongatapu',
	);
	$html = '<select '.$attr.'>';
	
	foreach($timezones as $timezones_F =>$key)
	{
		$html .= '<option value="'.$key.'">'.$timezones_F.'</option>';
	}
	$html .= '</select>';
	return $html;
}

function verifyEmailAddress($email)
{

	// First, we check that there's one @ symbol, and that the lengths are right
	if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
			return false;
		}
	}
	if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
				return false;
			}
		}
	}

	return true;
	
	
}

function isJson($Json)
{
	json_decode($Json);
	return (json_last_error() == JSON_ERROR_NONE);
}
function cleanHTML($HTML)
{
	$HTML = preg_replace("/\t/", "", $HTML);
	$HTML = preg_replace("/\n/", "", $HTML);
	
	return $HTML;
}

function getAlexa($domain){
	$url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=".$domain;
	//Initialize the Curl
	$ch = curl_init();  
	//Set curl to return the data instead of printing it to the browser.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2); 
	//Set the URL
	curl_setopt($ch, CURLOPT_URL, $url);  
	//Execute the fetch
	$data = curl_exec($ch);  
	//Close the connection
	curl_close($ch);  
	$xml = new SimpleXMLElement($data);  
			//Get popularity node
	$popularity = $xml->xpath("//POPULARITY");
			//Get the Rank attribute
	if(isset($popularity[0]['TEXT']))
		$rank = (string)$popularity[0]['TEXT'];
	else
		$rank = false;
	return $rank;
}

function loadSettings()
{

	$Core_Path = preg_replace("/Function$/","",dirname(__FILE__));

	foreach(scandir($Core_Path.'Settings') as $Settings_F)
	{
		$SettingFileName = $Core_Path.'Settings/'.$Settings_F;
		if(is_file($SettingFileName))
			include_once($SettingFileName);
	}
	if(is_dir(__BackendPath__.'Settings'))
		foreach(scandir(__BackendPath__.'Settings') as $Settings_F)
		{
			$SettingFileName = __BackendPath__.'Settings/'.$Settings_F;
			if(is_file($SettingFileName))
				include_once($SettingFileName);
		}
}

function loadClass($Class = null) 
{
	$loadedClass = array();
	if(is_null($Class))
	{
		$Class = array();
		
		# Load Core Classes
		foreach(scandir(__DocumentPath__.'/Core/Class') as $Class_F)
		{
			if(preg_match('/\.php$/',$Class_F))
				$Class[] = preg_replace('/\.php$/','',$Class_F);
		}
		
		# Load Site's Core Classes : Rule -> File name must be started with _(underbar)
		if(is_dir(__BackendPath__.'Class'))
			foreach(scandir(__BackendPath__.'Class') as $Class_F)
			{
				if(preg_match('/^_(.*)\.php$/',$Class_F))
					$Class[] = preg_replace('/\.php$/','',$Class_F);
			}
		
	}
	else
		$Class = explode(",",$Class);
	
	foreach($Class AS $Class_F)
	{
		if(!isset($$Class_F) || !class_exists($Class_F))
		{
			
			if(is_file(__DocumentPath__.'Core/Class/'.$Class_F.'.php'))
			{
		
				require_once(__DocumentPath__.'Core/Class/'.$Class_F.'.php');
				global $$Class_F;
				$$Class_F = new $Class_F;
				$loadedClass[] = $Class_F;
				
			}
			else if(is_file(__BackendPath__.'Class/'.$Class_F.'.php'))
			{
				require_once(__BackendPath__.'Class/'.$Class_F.'.php');
				$loadedClass[] = $Class_F;
				global $$Class_F;
				$$Class_F = new $Class_F;
			}
			else{
				return false;
			}
		}
	}
	return $loadedClass;
}


?>