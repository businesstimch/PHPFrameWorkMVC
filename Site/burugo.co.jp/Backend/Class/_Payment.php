<?
class _Payment
{
	function __construct()
	{
		
		
	}
	
	function isPaid_Store($StoreID)
	{
		global $login, $db;
		
		$Paid_Info = $db->QRY("
			SELECT
				store_id
			FROM
				b_burugo_stores
			WHERE
				store_id = '".$db->escape($StoreID)."' AND
				subscription_expiration_date > now()
		");
		
	}
	
	function get_Subscription_Packages()
	{
		global $db;
		
		$Package = $db->QRY("
			SELECT
				*
			FROM
				b_burugo_store_package
			WHERE
				package_group = 1 AND
				package_active = 1
			ORDER BY
				sort ASC
		");
		
		return $Package;
	}
	
	
	
	function get_PaymentSubscription($customerID = null, $storeID = null)
	{
		global $db;
		
		$WHERE = '';
		
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : '' )." Sub.customers_id = ".$db->escape($customerID);
			
		if(!is_null($storeID))
			$WHERE .= ( $WHERE != '' ? ' AND ' : '' )." Sub.store_id = ".$db->escape($storeID);
		
				
		$Output = $db->QRY("
			SELECT
				Sub.subscription_id,
				Sub.subscription_created_date,
				Sub.is_active,
				P.package_type,
				
				P.package_lang_name,
				P.package_amt,
				P.recurring_period,
				P.recurring_period_unit,
				P.package_type
				
			FROM
				b_burugo_store_subscription Sub
					LEFT JOIN
						b_burugo_store_package P
					ON
						P.package_id = Sub.package_id
					
			".$WHERE."
			
			  
			");
		
		return $Output;
	}
	
	function get_SubscriptionHistory($customerID = null, $storeID = null)
	{
		global $db;
		
		$WHERE = '';
		
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' )." Sub.customers_id = ".$db->escape($customerID);
			
		if(!is_null($storeID))
			$WHERE .= ( $WHERE != '' ? ' WHERE ' : ' AND ' )." Sub.store_id = ".$db->escape($storeID);
		
				
		$Output = $db->QRY("
			SELECT
				Sub.subscription_id,
				Sub.subscription_created_date,
				Sub.is_active,
				P.package_type,
				
				P.package_lang_name,
				P.package_amt,
				P.recurring_period,
				P.recurring_period_unit,
				P.package_type
				
			FROM
				b_burugo_store_subscription Sub
					LEFT JOIN
						b_burugo_store_package P
					ON
						P.package_id = Sub.package_id
					
			".$WHERE."
			
			  
			");
		
		return $Output;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function update_PaymentReturn($paymentID, $arrResponse)
	{
		global $db;
		
		$ret = $db->QRY("
			UPDATE b_burugo_store_payment
				subscription_id = 	'".$db->escape($arrReponse['x_subscription_id'])."',
				invoice_number = 	'".$db->escape($arrReponse['x_invoice_num'])."',
				transation_id = 	'".$db->escape($arrReponse['x_trans_id'])."',
				payment_amt = 		'".$db->escape($arrReponse['x_amount'])."',
				card_type = 		'".$db->escape($arrReponse['x_card_type'])."',
				card_desc = 		'".$db->escape($arrReponse['x_account_number'])."',
				response_code = 	'".$db->escape($arrReponse['x_response_code'])."'
				response_reason = 	'".$db->escape($arrReponse['x_response_code'])."'
			WHERE
				payment_id = '".$db->escape($paymentID)."'
		");
		
		return $ret;
	}
	
	//function insert_PyamentReturn($customerID, $storeID, $paymentType, $svcExpDate, $arrReponse)
	function insert_PyamentReturn($customerID, $storeID, $paymentType, $svcExpDate, $subscriptionID,
								  $invoiceNum, $transID, $payAmt, $cardType, $cardNum, $responseCode )
	{
		global $db;
		
		
		
		$ret = $db->QRY("
			INSERT INTO b_burugo_store_payment_history
			(
				customers_id,
				store_id,
				payment_type,
				payment_create_date,
				service_exp_date,
				
				subscription_id,
				invoice_number,
				transaction_id,
				payment_amt,
				coupon_code,
				
				card_type,
				card_desc,
				response_code
			)
			VALUES
			(
				'".$db->escape($customerID)."',
				'".$db->escape($storeID)."',
				'".$db->escape($paymentType)."',
				now(),
				'".$db->escape($svcExpDate)."',
				
				'".$db->escape($subscriptionID)."',
				'".$db->escape($invoiceNum)."',
				'".$db->escape($transID)."',
				'".$db->escape($payAmt)."',
				'".$db->escape($cardType)."',
				
				'".$db->escape($cardNum)."',
				'".$db->escape($responseCode)."',
			)
		");
		
		return $ret;		
	}
}



?>