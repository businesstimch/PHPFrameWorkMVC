<?
class address extends GGoRok
{
	function get_Country()
	{
		global $db;
		$Countries = $db->QRY("
			SELECT
				code,
				country_name
			FROM
				iso_countrycode
			ORDER BY
				country_name
		");
		
		return $Countries;
	}
	
	function get_US_States()
	{
		global $db;
		$States = $db->QRY("
			SELECT
				Country_Code,
				City_Name,
				City_Code
			FROM
				city
			WHERE
				Country_Code = 'US'
			ORDER BY
				City_ID ASC
		");
		
		return $States;
	}
	
	function get_Country_Html($customTag = null)
	{
		$html = "<select ".$customTag.">";
		foreach($this->get_Country() as $C)
		{
			$html .= '<option value="'.$C['code'].'">'.$C['country_name'].'</option>';
		}
		
		$html .= "</select>";
		return $html;
	}
	
	function getCurrent()
	{
		global $db, $login;
		$Address = $db->QRY("
			SELECT
				*
			FROM
				b_burugo_customer_address
			WHERE
				customers_id = '".$login->_customerID."'
			ORDER BY
				address_id ASC
		");
		return $Address;
	}
	
	function getAddress_By_ID($Address_ID)
	{
		global $db, $login;
		$Address = $db->QRY("
			SELECT
				*
			FROM
				b_burugo_customer_address
			WHERE
				customers_id = '".$login->_customerID."' AND
				address_id = '".$db->escape($Address_ID)."'
			ORDER BY
				address_id ASC
		");
		if(sizeof($Address) > 0)
		{
			$Address = $Address[0];
			return $Address;
		}
		else
			return false;
		
	}
	
	function refresh_Address_Bank()
	{
		global $db;
		$SQL = '';
		$db->QRY("DELETE FROM b_address_bank");
		
		ini_set('memory_limit', '512M');
		$Address = csv_to_array(__DocumentPath__.'cache/address/US.txt',"\t");

		foreach($Address AS $A)
		{
			
			$SQL .= "('".
								$db->escape($A['Zipcode'])."','".
								$db->escape($A['State'])."','".
								$db->escape($A['City'])."','".
								$db->escape($A['County'])."','".
								$db->escape($A['long'])."','".
								$db->escape($A['lat']).
						"'),";
			
		}
		
		$SQL = preg_replace('/\,$/',"",$SQL);
		
		$db->QRY("
				INSERT INTO
					b_address_bank
					(
						zipcode,
						state_abbr,
						city,
						county,
						longitudes,
						latitude
					)
					VALUES
					".$SQL."
			 ");
	}
 
}


?>