<?
class _Payment extends GGoRok
{
	function __construct()
	{
		
		
	}
	
	function isPaid_Store($StoreID)
	{
	
		$Paid_Info = $this->db->QRY("
			SELECT
				store_id
			FROM
				b_burugo_stores
			WHERE
				store_id = '".$this->db->escape($StoreID)."' AND
				subscription_expiration_date > now()
		");
		
	}
	
	function get_Subscription_Packages()
	{
		
		$Package = $this->db->QRY("
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
		
		$WHERE = '';
		
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : '' )." Sub.customers_id = ".$this->db->escape($customerID);
			
		if(!is_null($storeID))
			$WHERE .= ( $WHERE != '' ? ' AND ' : '' )." Sub.store_id = ".$this->db->escape($storeID);
		
				
		$Output = $this->db->QRY("
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
		
		$WHERE = '';
		
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' )." Sub.customers_id = ".$this->db->escape($customerID);
			
		if(!is_null($storeID))
			$WHERE .= ( $WHERE != '' ? ' WHERE ' : ' AND ' )." Sub.store_id = ".$this->db->escape($storeID);
		
				
		$Output = $this->db->QRY("
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
		
		$ret = $this->db->QRY("
			UPDATE b_burugo_store_payment
				subscription_id = 	'".$this->db->escape($arrReponse['x_subscription_id'])."',
				invoice_number = 	'".$this->db->escape($arrReponse['x_invoice_num'])."',
				transation_id = 	'".$this->db->escape($arrReponse['x_trans_id'])."',
				payment_amt = 		'".$this->db->escape($arrReponse['x_amount'])."',
				card_type = 		'".$this->db->escape($arrReponse['x_card_type'])."',
				card_desc = 		'".$this->db->escape($arrReponse['x_account_number'])."',
				response_code = 	'".$this->db->escape($arrReponse['x_response_code'])."'
				response_reason = 	'".$this->db->escape($arrReponse['x_response_code'])."'
			WHERE
				payment_id = '".$this->db->escape($paymentID)."'
		");
		
		return $ret;
	}
	
	//function insert_PyamentReturn($customerID, $storeID, $paymentType, $svcExpDate, $arrReponse)
	function insert_PyamentReturn($customerID, $storeID, $paymentType, $svcExpDate, $subscriptionID,
								  $invoiceNum, $transID, $payAmt, $cardType, $cardNum, $responseCode )
	{
		

		$ret = $this->db->QRY("
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
				'".$this->db->escape($customerID)."',
				'".$this->db->escape($storeID)."',
				'".$this->db->escape($paymentType)."',
				now(),
				'".$this->db->escape($svcExpDate)."',
				
				'".$this->db->escape($subscriptionID)."',
				'".$this->db->escape($invoiceNum)."',
				'".$this->db->escape($transID)."',
				'".$this->db->escape($payAmt)."',
				'".$this->db->escape($cardType)."',
				
				'".$this->db->escape($cardNum)."',
				'".$this->db->escape($responseCode)."',
			)
		");
		
		return $ret;		
	}
}



?>