<?
class _Subscription
{
	function __construct()
	{
		
		
	}
	
    
	function get_PackageList($burugoOnly=true)
	{
		global $db;
		//$WHERE = ' WHERE package_active = 1 ';
		$WHERE = '';
		
		if($burugoOnly)
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' pkg.package_type = 0 ';
			
        
		$str_sql = '
			SELECT
				pkg.package_id, pkg.package_group, pkg.package_amt, pkg.package_type, pkg.package_lang_name, pkg.package_desc,
				pkg.recurring_period, pkg.recurring_period_unit, pkg.sort
			FROM b_burugo_store_package pkg
			'.$WHERE.'
			ORDER BY sort 
		';
		
		$arr_list = $db->QRY($str_sql);
		
		return $arr_list;
	}
	
	
    
    function get_MethodList($wCoupon=false)
	{
		global $db;
		$WHERE = '';
		
		if(!$wCoupon)
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' M.subscription_method_id != 3 ';
			
		
        $str_sql = '
			SELECT
				M.subscription_method_id,
				M.subscription_method_name
			FROM b_burugo_store_subscription_method M
            '.$WHERE.'
			ORDER BY M.subscription_method_name
		';
		
		$arr_list = $db->QRY($str_sql);
		
		return $arr_list;
	}
	
	
	
	function get_CouponList($bAll=false)
	{
		global $db;
		$WHERE = '';
		
		if(!$bAll)
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' C.coupon_expire_date > now() ';
			
		
        $str_sql = '
			SELECT
				C.coupon_id,
				C.coupon_code,
				C.coupon_expire_date,
				C.coupon_amt
			FROM b_burugo_store_coupon C
            '.$WHERE.'
			ORDER BY C.coupon_code
		';
		
		$arr_list = $db->QRY($str_sql);
		
		return $arr_list;
	}
	
	
	function get_subscriptioninfo($subscriptionID)
	{
		global $db;
		
		$str_sql = '
			SELECT
				subs.*
			FROM b_burugo_store_subscription subs
			WHERE subs.subscription_id = "'.$subscriptionID.'
			ORDER BY subscription_id DESC ";
		';
		
		$arr_list = $db->QRY($str_sql);
		
		return $arr_list[0];
	}
	
	
	function get_PaymentSubscription($customerID = null, $storeID = null, $subsID = null)
	{
		global $db;
		
		$WHERE = '';
		
		if(!is_null($storeID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' )." Sub.store_id = '".$db->escape($storeID)."' ";
			
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' Sub.customers_id = '.$db->escape($customerID);
		
        if(!is_null($subsID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' Sub.subscription_id = '.$db->escape($subsID);
        /*
		if(!is_null($storeID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' )." Sub.store_id = '".$db->escape($storeID)."' ";
			
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' Sub.customers_id = '.$db->escape($customerID);
		
        if(!is_null($subsID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' Sub.subscription_id = '.$db->escape($subsID);
        */  
           
				$str_sql = '
                            SELECT
                                Sub.subscription_id,
								Sub.customers_id,
								Sub.store_id,
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
                                    
                            '.$WHERE.'
                            
                            ';
		
        //$Output = $str_sql;
		$Output = $db->QRY($str_sql);
            
		return $Output;
	}
    function get_Subscription($subscriptionID = null)
	{
		global $db;
		
		$WHERE = '';
		if(!is_null($subscriptionID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' H.subscription_id = '.$db->escape($subscriptionID);

		$str_sql = "
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
					LEFT JOIN b_burugo_store_package P ON P.package_id = Sub.package_id
			";
						
		$Output = $db->QRY($str_sql.$WHERE);
		
		return $Output;
	}
	
	function get_SubscriptionHistoryList($customerID = null, $storeID = null, $subsID = null)
	{
		global $db;
		
		$WHERE = '';
		
		if(!is_null($customerID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' H.customers_id = '.$db->escape($customerID);
			
		if(!is_null($storeID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' H.store_id = '.$db->escape($storeID);
		
		if(!is_null($subsID))
			$WHERE .= ( $WHERE == '' ? ' WHERE ' : ' AND ' ).' H.subscription_id = '.$db->escape($subsID);
		

        $str_sql = '
			SELECT
                H.subscription_history_id, H.subscription_id, H.subscription_method_id, H.customers_id, H.store_id,
                H.invoice_number, H.payment_amt, H.payment_created_date, H.memo AS H_memo,
                S.package_id, S.subscription_created_date, S.is_active, S.memo AS S_memo,
                M.subscription_method_name,
                
                C.check_id AS C_check_id, C.is_cleared, C.check_no,
                A.payment_id AS A_payment_id, A.transaction_id, A.auth_subscription_id, A.card_type AS A_card_type, A.card_last_4digit AS A_card_last_4digit, A.memo AS A_memo, A.response_code AS A_response_code,
                N.coupon_id AS N_coupon_id, P.coupon_code AS P_coupon_code, P.coupon_expire_date, P.coupon_amt AS P_coupon_amt
                
            FROM  b_burugo_store_subscription_history H
                LEFT JOIN b_burugo_store_subscription S
                    ON S.subscription_id = H.subscription_id

                LEFT JOIN b_burugo_store_subscription_method_check C
                    ON C.subscription_history_id = H.subscription_history_id
                LEFT JOIN b_burugo_store_subscription_method_authorize A
                    ON A.subscription_history_id = H.subscription_history_id
                LEFT JOIN b_burugo_store_subscription_method_coupon N 
                        LEFT JOIN b_burugo_store_coupon P ON P.coupon_id = N.coupon_id
                    ON N.subscription_history_id = H.subscription_history_id
                LEFT JOIN b_burugo_store_subscription_method M
                    ON M.subscription_method_id = H.subscription_method_id
			'.$WHERE.'
            ORDER BY H.subscription_history_id DESC
			';
    
		$Output = $db->QRY($str_sql);
		
		return $Output;
	}
	
	
	function get_Package($package_id)
	{
		global $db;
		$str_sql = "
			SELECT
				package_id,
				package_amt,
				recurring_period,
				recurring_period_unit,
				IF(recurring_period IS NULL,NULL,DATE_FORMAT(DATE_ADD( now(), INTERVAL recurring_period MONTH ),'%Y-%m-%d')) as startDate
			FROM
				b_burugo_store_package
			WHERE
				package_id = '".$db->escape($package_id)."' AND
				package_type = 0 AND
				package_group = 1
			LIMIT
				1
		";
		$arr_list = $db->QRY($str_sql);
		
		return $arr_list;
	}
	
	
	function update_Subscription($subsID, $packageID)
	{
		global $db;
		
		$str_sql = "
			UPDATE b_burugo_store_subscription
			SET
				package_id = ".$db->escape(urldecode($packageID))."
			WHERE subscription_id = ".$db->escape(urldecode($storeID))."; 
		";
		
		$new_ID = $db->QRY($str_sql);
		
		return $new_ID;
	}
	
	function update_ReferenceInfo($storeID, $referID=3)
	{
		global $db;
		$output['ack'] = 'error';
		if($storeID > 0 )
		{
			$str_sql = "
				SELECT reference_id
				FROM b_burugo_refer
				WHERE store_id = ".$db->escape($storeID)."
			";
			
			$ret_sql = $db->QRY($str_sql);
			
			if(sizeof($ret_sql) > 0)
			{
				/*
				$str_sql = ' UPDATE b_burugo_refer
						SET customers_id = '.$db->escape($referID)
					.' WHERE reference_id = '.$db->escape($ret_sql[0]['reference_id']).';';
				$ret_sql = $db->QRY($str_sql);
				*/
				$output['ack'] = 'success';
			}
			else
			{
				$str_sql = "
					INSERT INTO b_burugo_refer(customers_id, store_id, created_date)
					VALUES (".$db->escape($referID).", ".$db->escape($storeID).", now() );
				";
				
				$ret_sql = $db->QRY($str_sql);
				$output['ack'] = 'success';
			}
		}
		else
		{
			$output['error_msg'] = 'Not Available';
		}
		return $output;
	}
	
	function update_StorePaid($storeID, $exp_date)
	{
		global $db;
		
		$str_sql = "
			UPDATE b_burugo_stores
			SET
				service_type_FreeOrPay = 1,
				subscription_expiration_date = '".$db->escape(urldecode($exp_date))."'
			WHERE store_id = ".$db->escape(urldecode($storeID))."; 
		";
		
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
		
	}
	
	function update_SubscriptionStore($storeID)
	{
		global $db;
		
		$str_sql = "
			UPDATE b_burugo_store_subscription
			SET is_active = 0
			WHERE store_id = ".$db->escape(urldecode($storeID))."; 
		";
		
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
	}
	
	function create_Subscription($customerID, $storeID, $package_id, $is_active = 0, $memo=null )
    {
        global $db;
	
		if($is_active == 1)
		{
			$ret = $this->update_SubscriptionStore($storeID);
		}
		
		$str_sql = "
			INSERT INTO b_burugo_store_subscription
			(
				customers_id, package_id, store_id, subscription_created_date, is_active, memo
			)
			VALUES
			(
				".$db->escape(urldecode($customerID)).",
				".$db->escape(urldecode($package_id)).",
				".$db->escape(urldecode($storeID)).",
				now(),
				".$db->escape(urldecode($is_active)).",
				'".$db->escape(urldecode($memo))."'
			)
		";
	
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
    }
	
	function create_SubscriptionHistory($subscription_id, $subscription_method_id, $customers_id, $store_id, $invoice_number,
										$payment_amt, $memo=null)
    {
        global $db;
		
		$str_sql = "
			INSERT INTO b_burugo_store_subscription_history
			(
				subscription_id,
				subscription_method_id,
				customers_id,
				store_id,
				invoice_number,
				
				payment_amt,
				payment_created_date,
				memo
			)
			VALUES
			(
				".$db->escape(urldecode($subscription_id)).",
				".$db->escape(urldecode($subscription_method_id)).",
				".$db->escape(urldecode($customers_id)).",
				".$db->escape(urldecode($store_id)).",
				'".$db->escape(urldecode($invoice_number))."',
				
				'".$db->escape(urldecode($payment_amt))."',
				now(),
				'".$db->escape(urldecode($memo))."'
			)
		";
	
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
    }
	
	function create_SubscriptionAuth($trans_id, $customers_id, $auth_id, $card_type, $card_4digit,
									 $subs_h_id, $response_code, $response_reason_code, $memo=null)
	{
		global $db;

//return '::'.$trans_id. '::'.$auth_id.'::'.$card_type.'::'.$card_4digit.'::'.$response_code.'::'.$response_reason_code;
		$str_sql = "
			INSERT INTO b_burugo_store_subscription_method_authorize
			(
				transaction_id,
				customers_id,
				auth_subscription_id,
				card_type,
				card_last_4digit,
				
				subscription_history_id,
				response_code,
				response_reason_code,
				memo
			)
			VALUES
			(
				'".$db->escape(urldecode($trans_id))."',
				".$db->escape(urldecode($customers_id)).",
				'".$db->escape(urldecode($auth_id))."',
				'".$db->escape(urldecode($card_type))."',
				'".$db->escape(urldecode($card_4digit))."',
				
				".$db->escape(urldecode($subs_h_id)).",
				".$db->escape(urldecode($response_code)).",
				".$db->escape(urldecode($response_reason_code)).",
				'".$db->escape(urldecode($memo))."'
			)
		";

		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
	}
	
	function create_SubscriptionSubscr($auth_id, $subs_id)
	{
		global $db;
		
		$str_sql = "
			INSERT INTO b_burugo_store_subscription_method_authorize_subscr
			(
				auth_subscription_id,
				subscription_id_inSystem
			)
			VALUES
			(
				'".$db->escape(urldecode($auth_id))."',
				".$db->escape(urldecode($subs_id))."
			)
		";
		
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
	}
	
	function create_SubscriptionCheck($is_clear, $subs_h_id, $check_no=null)
	{
		global $db;
		
		$str_sql = "
			INSERT INTO b_burugo_store_subscription_method_check
			(
				is_cleared,
				subscription_history_id,
				check_no
			)
			VALUES
			(
				".$db->escape(urldecode($is_clear)).",
				".$db->escape(urldecode($subs_h_id)).",
				'".$db->escape(urldecode($check_no))."'
			)
		";
	
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
	}
	
	function create_SubscriptionCoupon($coupon_id, $subs_h_id)
	{
		 global $db;
		
		$str_sql = "
			INSERT INTO b_burugo_store_subscription_method_coupon
			(
				coupon_id,
				subscription_history_id
			)
			VALUES
			(
				".$db->escape(urldecode($coupon_id)).",
				".$db->escape(urldecode($subs_h_id))."
			)
		";
		
		$new_ID = $db->QRY($str_sql, true);
		
		return $new_ID;
	}
	
    
    
    
    function create_AuthSubscription()
    {
        
    }
    function update_AuthSubscription()
    {
        
    }
    function create_Payment()
    {
        
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
	
	
	
	
	
	function create_payment_data($is_subs_profile,
								 $card_no, $first_name, $last_name, $invoice_number, $package_amt,
								 $recurr_unit, $recurr_period, $recurr_start_date, $exp_mm, $exp_yy)
	{
		if($is_subs_profile)
		{
			$payment_data['name'] = "Burugo Business Subscription";
			$payment_data['totalOccurrences'] = "9999";
		}
		else	// one time payment
		{
			$payment_data['name'] = "Burugo Business One Time Payment : ".$package_amt.'days';
		}
		
		$payment_data['cardNumber'] = $card_no;
		$payment_data['firstName'] = $first_name;
		$payment_data['lastName'] = $last_name;
		
		$payment_data['invoiceNumber'] = $invoice_number;
		$payment_data['amount'] = $package_amt;
		
		if($recurr_unit == 'm')
		{
			$payment_data['unit'] = "months";
		}
		elseif($recurr_unit == 'd')
		{
			$payment_data['unit'] = "days";
		}
		
		$payment_data['length'] = $recurr_period;
		$payment_data['startDate'] = $recurr_start_date;
		$payment_data['expirationDate'] = $exp_mm.'-'.$exp_yy;
					
		//$subscription_amt = $payment_data['amount'];
		//$paidInfo_Recurr = $payment_authorize->create_subscription($payment_data);
		
		return $payment_data;
	}
	
	function _html_Method_Select($methodID=0, $wCoupon=false)
	{
		$html ='<select id="method_select" name="method_select">';
		if($methodID == 0)
			$html .= '<option value="">select</option>';
			
		$list_arr = $this->get_MethodList($wCoupon);
		
		foreach($list_arr as $arr_F)
		{
			$html .= '<option  '.($methodID==$arr_F['subscription_method_id']?' selected="selected" ':'').
						' value="'.$arr_F['subscription_method_id'].'">
						'.$arr_F['subscription_method_name'].
						'</option>';
		}
		$html .= '</select>';
		
		return $html;
	}
	
	function _html_Package_Select($packageID=0, $burugoOnly=true)
	{
		$html ='<select id="package_select" name="package_select">';
		if($packageID == 0)
			$html .= '<option value="">select</option>';
		
		$package_list = $this->get_PackageList($burugoOnly);
		
		foreach($package_list as $package_F)
		{
			$html .= '<option  '.($packageID==$package_F['package_id']?' selected="selected" ':'').
						' value="'.$package_F['package_id'].'">
						$'.$package_F['package_amt'].'/'.$package_F['recurring_period'].$package_F['recurring_period_unit'].
						'</option>';
		}
		$html .= '</select>';
		
		return $html;
	}
	
	function _html_Coupon_Select($couponeCode=0, $bAll=false)
	{
		$html ='<select id="coupon_select" name="coupon_select">';
		if($couponeCode == 0)
			$html .= '<option value="">select</option>';
		
		$list_arr = $this->get_CouponList($bAll);
		
		foreach($list_arr as $arr_F)
		{
			$html .= '<option  '.($couponeCode==$arr_F['coupon_id']?' selected="selected" ':'').
						' value="'.$arr_F['coupon_id'].'">
						'.$arr_F['coupon_code'].'/'.$arr_F['coupon_amt'].
					'</option>';
		}
		$html .= '</select>';
		
		return $html;
	}
	
	function _html_CardExpDate_Select($mm=null, $yy=null)
	{
			$html = '';
			
			$html .= '
				<select id="Pay_Exp_MM" name="Pay_Exp_MM">
					<option value="">MM</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				<select id="Pay_Exp_YY" name="Pay_Exp_YY">
					<option value="">YY</option>
					<option value="2013">13</option>
					<option value="2014">14</option>
					<option value="2015">15</option>
					<option value="2016">16</option>
					<option value="2017">17</option>
					<option value="2018">18</option>
					<option value="2019">19</option>
					<option value="2020">20</option>
					<option value="2021">21</option>
					<option value="2022">22</option>
					<option value="2023">23</option>
				</select>
			';
			
			return $html;
	}
	
	function _html_CheckClear_Select($chkStatus=0)
	{
		$html = '<select id="check_clear" name="check_clear">';
		if($chkStatus == 0)
			$html .= '<option value="">select</option>';
					
		$html .= '
					<option '.($chkStatus==1?' selected="selected" ':'').' value="1">Cleared</option>
					<option '.($chkStatus==2?' selected="selected" ':'').' value="0">Pending</option>
		';
		
		$html .= '</select>';
		
		return $html;
	}
}



?>