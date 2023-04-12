<?php

class Geo extends GGoRok
{
	function getInfo($Data)
	{
		$Addr = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($Data['Address'])."&sensor=false&key=YourKey";
		$response = json_decode(file_get_contents($Addr),TRUE);
		$output['lat'] = '';
		$output['lng'] = '';
		
		if(isset($response['results'][0]['geometry']['location']['lat']))
		{
			$output['lat'] = $response['results'][0]['geometry']['location']['lat'];
			$output['lng'] = $response['results'][0]['geometry']['location']['lng'];
		}
		return $output;
	}
    
}

?>
