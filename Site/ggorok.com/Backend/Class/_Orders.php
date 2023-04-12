<?
loadClass('mail,_Mail,_Extensions');
class _Orders extends GGoRok
{
	
	var $Order_Encrypt_Key = "ggorokJAniLin!";
	
	function getOrders($Data)
	{
		
		$O['All'] = $this->db->QRY("
			SELECT
				OStatus_ID
			FROM
				gc_orders
			ORDER BY
				Orders_ID
		");
		
		$O['Pending'] = 0;
		
		if(isset($Data['Status']))
			foreach($O['All'] AS $O_F)
			{
				if($O_F['OStatus_ID'] == 1)
					$O['Pending']++;
			}
		
		$O['Total'] = sizeof($O['All']);
		
		return $O;
	}
	
	function getOrderListByCustomerID($_customersID)
	{
		
		
		return $this->db->QRY("
			SELECT
				O.*,
				DATE_FORMAT(O.Orders_CreatedOn,'%d/%b/%Y %T') AS Orders_CreatedOn_Display,
				OS.*
			FROM
				gc_orders O,
				gc_orders_status OS
			WHERE
				O.customers_id = '".$this->db->escape($_customersID)."' AND
				O.OStatus_ID = OS.OStatus_ID
			ORDER BY
				O.Orders_ID DESC
		");
		
	}
	
	function getOrderItemsByID($Data)
	{
		
		$Items = $this->db->QRY("
			SELECT
				*
			FROM
				gc_orders_Items
			WHERE
				Orders_ID = '".$this->db->escape($Data['Orders_ID'])."'
		");
		
		foreach($Items AS $K => $Items_F)
		{
			$Items_OPs = $this->db->QRY("
				SELECT
					*
				FROM
					gc_orders_Items_option
				WHERE
					OI_ID = '".$Items_F['OI_ID']."'
			");
			
			$CountOPs = 0;
			$Items[$K]['Option'] = array();
			foreach($Items_OPs AS $K2 => $Items_OPs_F)
			{
				$Items[$K]['Option'][$CountOPs] = $Items_OPs_F;
				$CountOPs++;
			}
			
		}
		return $Items;
		
	}
	
	function getOrderStatusHistoryByID($Data)
	{
		
		return $this->db->QRY("
			SELECT
				S.OStatus_Name,
				DATE_FORMAT(SH.OSH_ProcessedOn, '%b/%d/%Y, %T') AS OSH_ProcessedOn
			FROM
				gc_orders_status S,
				gc_orders_status_history SH
			WHERE
				SH.Orders_ID = '".$this->db->escape($Data['Orders_ID'])."' AND
				S.OStatus_ID = SH.OStatus_ID
			ORDER BY
				SH.OSH_ProcessedOn ASC
		");
	}
	
	function getOrderPaymentShippingInfoByID($Data)
	{
		
		$output['ack'] = 'error';
		$output['S_Info'] = '';
		$output['P_Info'] = '';
		if(isset($Data['Orders_Ext_Shipping']) && $Data['Orders_Ext_Shipping'] != "")
		{
			$S_Info = $this->_Extensions->load('Shipping',$Data['Orders_Ext_Shipping']);
			if(isset($S_Info['Class'][$Data['Orders_Ext_Shipping']]))
			{
				$output['S_Info'] = $S_Info['Class'][$Data['Orders_Ext_Shipping']];
				$output['ack'] = 'success';
			}
		}
		
		if(isset($Data['Orders_Ext_Payment']) && $Data['Orders_Ext_Payment'] != "")
		{
			$P_Info = $this->_Extensions->load('Payment',$Data['Orders_Ext_Payment']);
			if(isset($P_Info['Class'][$Data['Orders_Ext_Payment']]))
			{
				$output['P_Info'] = $P_Info['Class'][$Data['Orders_Ext_Payment']];
				$output['ack'] = 'success';
			}
		}
		 
		 return $output;
	}
	function getOrderByID($Data, $Secure = false)
	{
		$output['ack'] = 'error';
		$output['Info'] = $this->db->QRY("
			SELECT
				*
			FROM
				gc_orders
			WHERE
				Orders_ID = '".$this->db->escape($Data['Orders_ID'])."'
			ORDER BY
				Orders_ID DESC
			LIMIT
				1
		");
		
		if(sizeof($output['Info']) > 0 && ((!$Secure) || ($Secure && $Data['Token'] == md5($Data['Orders_ID'].$this->Order_Encrypt_Key))))
		{
			$output['ack'] = 'success';
			
		}
		
		return $output;
	}
	
	function orderStatusInfoByID($OStatus_ID)
	{
		
		$S = $this->db->QRY("
			SELECT
				OStatus_Name,
				OStatus_StockBack
			FROM
				gc_orders_status
			WHERE
				OStatus_ID = '".$this->db->escape($OStatus_ID)."'
		");
		if(sizeof($S) > 0)
		{
			return array(
				'OStatus_Name' => $S[0]['OStatus_Name'],
				'OStatus_StockBack' => $S[0]['OStatus_StockBack']
			);
		}
		else
			return false;
		
		
	}
	function changeOrderStatus($Data)
	{
		
		$Go = true;
		
		$output['ack'] = 'error';
		$Data['Memo'] = (isset($Data['Memo']) ? $Data['Memo'] : null);
		$StatusInfo = $this->orderStatusInfoByID($Data['osID']);
		$LastStatus = $this->db->QRY("
			SELECT
				SH.OStatus_ID
			FROM
				gc_orders_status S,
				gc_orders_status_history SH
			WHERE
				SH.Orders_ID = ".$this->db->escape($Data['oID'])." AND
				S.OStatus_ID = SH.OStatus_ID
			ORDER BY
				SH.OSH_ProcessedOn DESC
			LIMIT
				1
		");
		
		
		# If the last order status was associated cancelling, then processing
		if(sizeof($LastStatus) > 0)
		{
			if($LastStatus[0]['OStatus_ID'] == 5 || $LastStatus[0]['OStatus_ID'] == 6)
			{
				$Go = false;
				$output['error_msg'] = "Changing status of previously cancelled order is not available.";
			}
		}
		
		if($StatusInfo == false)
		{
			$Go = false;
			$output['error_msg'] = "We couldn't find the status that you have requested please try it again.";
		}
		
		if($Go)
		{
			$output['ack'] = 'success';
			
			
			
			# Check if the last status was associated item stock.
			# If current status is about cancelling order. We have to add up the stock quantity of the product as we took out when the customer ordered.
			
			if($StatusInfo['OStatus_StockBack'] == 1)
			{
				$this->db->QRY("
					UPDATE
						gc_products P,
						gc_orders O,
						gc_orders_Items OI
					SET
						P.Prd_Qty = P.Prd_Qty + OI.OI_Qty
					WHERE
						O.Orders_ID = '".$this->db->escape($Data['oID'])."' AND
						O.Orders_ID = OI.Orders_ID AND
						P.Prd_ID= OI.Prd_ID
				");
			}
			
			$this->db->QRY("
				UPDATE
					gc_orders
				SET
					OStatus_ID = '".$this->db->escape($Data['osID'])."'
				WHERE
					Orders_ID = '".$this->db->escape($Data['oID'])."'
			");
			$this->db->QRY("
				INSERT INTO
					gc_orders_status_history
					(
						Orders_ID,
						OStatus_ID,
						OSH_Notified,
						OSH_Memo
					)
					VALUES
					(
						'".$this->db->escape($Data['oID'])."',
						'".$this->db->escape($Data['osID'])."',
						'".$this->db->escape((is_null($Data['NotifyCustomer']) ? 0 : $Data['NotifyCustomer']))."',
						'".$this->db->escape($Data['Memo'])."'
						
					)
			");
			
			if(!is_null($Data['NotifyCustomer']) && $Data['NotifyCustomer'] == 1)
			{
				$Data['Orders_ID'] = $Data['oID'];
				$O = $this->getOrderByID($Data);
				
				if(sizeof($O['Info']) > 0 && verifyEmailAddress($O['Info'][0]['Orders_NotifyEmail']))
				{
					$MailVariable_HTML = array(
						$Data['oID'],
						$StatusInfo['OStatus_Name'],
						$Data['Memo']
					);
					
					$MailVariable_PLAIN = array(
						$Data['oID'],
						$StatusInfo['OStatus_Name'],
						$Data['Memo']
					);
					
					# Send Email to customer
					$MailSetting = $this->_Mail->Setting();
					$MailSetting['Subject'] = '[Janilink] Your Order #'.$Data['oID'].' Status Changed to '.$StatusInfo['OStatus_Name'];
					$MailSetting['Body_HTML'] = $this->_Mail->getTemplate('Template_OrderStatusChanged_HTML',$MailVariable_HTML);
					$MailSetting['Body_Plain'] = $this->_Mail->getTemplate('Template_OrderStatusChanged_PLAIN',$MailVariable_PLAIN);
					$MailSetting['To'] = $O['Info'][0]['Orders_NotifyEmail'];
					$this->mail->sendGMail($MailSetting);
				}
				
			}
		}
		return $output;
	}
}

?>