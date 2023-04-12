<?
class _Location
{
	function getLocation_By_LatLng($lat,$lng)
	{
		global $db;
		$ListLimitDistance = 100;
		
		// [Tim] Find closest city by lng and lat
		$Loc = $db->QRY("
			
			SELECT
				zipcode,
				state_abbr,
				city,
				county,
				3956 * 2 * ASIN(SQRT( POWER(SIN((".$lat." - latitude) *  pi()/180 / 2), 2) +COS(".$lat." * pi()/180) * COS(latitude * pi()/180) * POWER(SIN((".$lng." - longitudes) * pi()/180 / 2), 2) )) as distance
			FROM
				b_address_bank
			
			WHERE
				MBRContains(
					GeomFromText(
						'LineString(
							".
							($lat + $ListLimitDistance / ( 111.1 / cos($lat)))." ".
							($lng + $ListLimitDistance / 111.1).", ".
							($lat - $ListLimitDistance / ( 111.1 / cos($lat)))." ".
							($lng - $ListLimitDistance / 111.1).")'), latlng)
			ORDER BY
				distance ASC
			LIMIT
				1
		");
		
		
		return $Loc;
	}
}

?>