<?
require_once __DocumentPath__.'Core/Module/maxmind/vendor/autoload.php';
use GeoIp2\Database\Reader;

class ip_geoLocation extends GGoRok {
	
	function get_GeoLocation()
	{
		
		
		
		/*
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://freegeoip.net/json/".$_SERVER['REMOTE_ADDR']);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		
		$Geo = json_decode($server_output);
		
		curl_close ($ch);
		$output['geoplugin_latitude'] = $Geo->latitude;
		$output['geoplugin_longitude'] = $Geo->longitude;
		$output['geoplugin_city'] = $Geo->city;
		$output['geoplugin_region'] = $Geo->region_code;
	 	$output['geoplugin_countryName'] = $Geo->country_code;
		return $output;

		*/
		
		$geoReader = new Reader(__DocumentPath__.'Core/Module/maxmind/db/GeoLite2-City.mmdb');
		$geo = $geoReader->city($_SERVER['REMOTE_ADDR']);
		//echo print_r($geo);
/*		
		print $geo->country_code . " " . $geo->country_code3 . " " . $geo->country_name . "\n";
	print $geo->region . " " . $GEOIP_REGION_NAME[$geo->country_code][$geo->region] . "\n";
	print $geo->city . "\n";
	print $geo->postal_code . "\n";
	print $geo->latitude . "\n";
	print $geo->longitude . "\n";
	print $geo->metro_code . "\n";
	print $geo->area_code . "\n";
	print $geo->continent_code . "\n";

*/
		$output['geoplugin_latitude'] = $geo->location->latitude;
		$output['geoplugin_longitude'] = $geo->location->longitude;
		$output['geoplugin_city'] = $geo->city->name;
		$output['geoplugin_region'] = $geo->mostSpecificSubdivision->name;
		$output['geoplugin_state'] = $geo->mostSpecificSubdivision->isoCode;
	 	$output['geoplugin_countryName'] = $geo->country->isoCode;
		return $output;
	}
}







?>