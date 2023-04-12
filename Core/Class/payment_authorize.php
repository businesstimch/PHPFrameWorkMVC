<?
class payment_authorize extends GGoRok
{
	var $account;
	
	function __construct()
	{
		$this->account['loginname']="Login Name";
		$this->account['transactionkey']="Transaction Key";
		$this->account['host_recurring'] = "api.authorize.net";
		$this->account['host_onetime'] = "https://secure.authorize.net/gateway/transact.dll";
		$this->account['path'] = "/xml/v1/request.api";
	}
	function make_onetime_payment($data = null)
	{
		if(is_array($data))
		{
			$post_values = array(
	
				// the API Login ID and Transaction Key must be replaced with valid values
				"x_login"			=> $this->account['loginname'],
				"x_tran_key"		=> $this->account['transactionkey'],
				"x_invoice_num" => $data["invoiceNumber"],
				"x_version"			=> "3.1",
				"x_delim_data"		=> "TRUE",
				"x_delim_char"		=> "|",
				"x_relay_response"	=> "FALSE",
			
				"x_type"			=> "AUTH_CAPTURE",
				"x_method"			=> "CC",
				"x_card_num"		=> $data["cardNumber"],
				"x_exp_date"		=> $data["expirationDate"],
			
				"x_amount"			=> $data["amount"],
				"x_description"		=> $data["name"],
			
				// Additional fields can be added here as outlined in the AIM integration
				// guide at: http://developer.authorize.net
			);
			
			$post_string = "";
			foreach( $post_values as $key => $value )
			{
				$post_string .= "$key=" . urlencode( $value ) . "&";
			}
			$post_string = rtrim( $post_string, "& " );
			// The following section provides an example of how to add line item details to
			// the post string.  Because line items may consist of multiple values with the
			// same key/name, they cannot be simply added into the above array.
			//
			// This section is commented out by default.
			/*
			$line_items = array(
				"item1<|>golf balls<|><|>2<|>18.95<|>Y",
				"item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
				"item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
				
			foreach( $line_items as $value )
				{ $post_string .= "&x_line_item=" . urlencode( $value ); }
			*/
			
			// This sample code uses the CURL library for php to establish a connection,
			// submit the post, and record the response.
			// If you receive an error, you may want to ensure that you have the curl
			// library enabled in your php configuration
			$request = curl_init($this->account['host_onetime']); // initiate curl object
				curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
				curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
				curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
				curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
				$post_response = curl_exec($request); // execute curl post and store results in $post_response
				// additional options may be required depending upon your server configuration
				// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close ($request); // close curl object
			// This line takes the response and breaks it into an array using the specified delimiting character
			$response_array = explode($post_values["x_delim_char"],$post_response);
			//ECHO $response_array[2];
			$result['ack'] = $response_array[0];
			return $result;
			
		}
		
		
		
	}
	function makeInvoiceNumber($Prefix = null)
	{
		global $db,$login;
		
		$allPay = $db->QRY("
			SELECT
				payment_id
			FROM
				b_burugo_store_payment_history
			WHERE
				customers_id = '".$db->escape($login->_customerID)."'
		");
		
		$invoiceNumber = $Prefix.$login->_customerID.'_'.sizeof($allPay).'_'.rand(1000,9999);
		return $invoiceNumber;
	}
	function create_subscription($data = null)
	{
		if(is_array($data))
		{
			$amount = $data["amount"];
			$refId = (isset($data["refId"])?$data["refId"]:"");
			$name = $data["name"];
			$length = $data["length"];
			$unit = $data["unit"];
			$startDate = $data["startDate"];
			$totalOccurrences = $data["totalOccurrences"];
			$invoicenumber = $data["invoiceNumber"];
			
			$cardNumber = $data["cardNumber"];
			$expirationDate = $data["expirationDate"];
			$firstName = $data["firstName"];
			$lastName = $data["lastName"];
		}
		
		$content =
		"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
		"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			"<merchantAuthentication>".
				"<name>" . $this->account['loginname'] . "</name>".
				"<transactionKey>" . $this->account['transactionkey'] . "</transactionKey>".
			"</merchantAuthentication>".
			"<refId>" . $refId . "</refId>".
			"<subscription>".
				"<name>" . $name . "</name>".
				"<paymentSchedule>".
					"<interval>".
						"<length>". $length ."</length>".
						"<unit>". $unit ."</unit>".
					"</interval>".
					"<startDate>" . $startDate . "</startDate>".
					"<totalOccurrences>". $totalOccurrences . "</totalOccurrences>".
				"</paymentSchedule>".
				"<amount>". $amount ."</amount>".
				"<payment>".
					"<creditCard>".
						"<cardNumber>" . $cardNumber . "</cardNumber>".
						"<expirationDate>" . $expirationDate . "</expirationDate>".
					"</creditCard>".
				"</payment>".
				"<order>".
					"<invoiceNumber>". $invoicenumber . "</invoiceNumber>".
				"</order>".
				"<billTo>".
					"<firstName>". $firstName . "</firstName>".
					"<lastName>" . $lastName . "</lastName>".
				"</billTo>".
			"</subscription>".
		"</ARBCreateSubscriptionRequest>";


		//send the xml via curl
		$response = $this->send_request_via_curl($this->account['host_recurring'],$this->account['path'],$content);
		

		//if the connection and send worked $response holds the return from Authorize.net
		if ($response)
		{
			/*
			a number of xml functions exist to parse xml results, but they may or may not be avilable on your system
			please explore using SimpleXML in php 5 or xml parsing functions using the expat library
			in php 4
			parse_return is a function that shows how you can parse though the xml return if these other options are not avilable to you
			*/
			list ($refId, $resultCode, $code, $text, $subscriptionId) = $this->parse_return($response);
			//ECHO $resultCode;
			
			$result['ack'] = $resultCode;
			$result['subcription_id'] = $subscriptionId;
			$result['msg'] = $text;
			return $result;
			
		  
			
		}
		else
		{
			echo "Transaction Failed. <br>";
		}
	}
	
	
	
	
	
	function send_request_via_fsockopen($host,$path,$content)
	{
		$posturl = "ssl://" . $host;
		$header = "Host: $host\r\n";
		$header .= "User-Agent: PHP Script\r\n";
		$header .= "Content-Type: text/xml\r\n";
		$header .= "Content-Length: ".strlen($content)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($posturl, 443, $errno, $errstr, 30);
		if (!$fp)
		{
			$response = false;
		}
		else
		{
			error_reporting(E_ERROR);
			fputs($fp, "POST $path  HTTP/1.1\r\n");
			fputs($fp, $header.$content);
			fwrite($fp, $out);
			$response = "";
			while (!feof($fp))
			{
				$response = $response . fgets($fp, 128);
			}
			fclose($fp);
			error_reporting(E_ALL ^ E_NOTICE);
		}
		return $response;
	}
	
	//function to send xml request via curl
	function send_request_via_curl($host,$path,$content)
	{
		$posturl = "https://" . $host . $path;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		return $response;
	}
	
	
	//function to parse Authorize.net response
	function parse_return($content)
	{
		$refId = $this->substring_between($content,'<refId>','</refId>');
		$resultCode = $this->substring_between($content,'<resultCode>','</resultCode>');
		$code = $this->substring_between($content,'<code>','</code>');
		$text = $this->substring_between($content,'<text>','</text>');
		$subscriptionId = $this->substring_between($content,'<subscriptionId>','</subscriptionId>');
		return array ($refId, $resultCode, $code, $text, $subscriptionId);
	}
	
	//helper function for parsing response
	function substring_between($haystack,$start,$end) 
	{
		if (strpos($haystack,$start) === false || strpos($haystack,$end) === false) 
		{
			return false;
		} 
		else 
		{
			$start_position = strpos($haystack,$start)+strlen($start);
			$end_position = strpos($haystack,$end);
			return substr($haystack,$start_position,$end_position-$start_position);
		}
	}
}
?>
