<?php
class CartCorpSalesOrdersDetailHome_Controller extends GGoRok
{
	var $_isAdminPage = true;
	function home()
	{
		$Data['title'] = 'Orders | GGoRok Cart';
		$Data['metaK'] = 'GGoRok';
		$Data['metaD'] = 'GGoRok';
		
		if(isset($_GET['oID']))
		{
			$O = $this->_Model_Order->getOrderby_oID($_GET['oID']);

			if(sizeof($O) > 0)
			{
				$Data['O'] = $O[0];
				$this->loadOrder($Data);
				
				$Data['MAIN_HTML'] = $this->Load->View('cart/corp/sales/orders/detail/home.tpl',array(
					'PG_Contents' => $this->loadOrder($Data)
				));
				
				
			}
			else
			{
				
				$Data['MAIN_HTML'] = $this->Load->View('cart/corp/sales/orders/detail/home.tpl',array(
					'PG_Contents' => 'The order not found.'
				));
			}
				
		}
		$Home_Controller = $this->Load->Controller('cart/corp/home');
		echo $Home_Controller->loadHeader($Data);
	}
	
	function changeOrderStatus()
	{
		$output['ack'] = 'error';
		if(
		   isset($_POST['oID']) && is_numeric($_POST['oID']) &&
		   isset($_POST['osID']) && is_numeric($_POST['osID'])
		)
		{
			$output['ack'] = 'success';
			$Data['oID'] = $_POST['oID'];
			$Data['osID'] = $_POST['osID'];
			$Data['NotifyCustomer'] = (isset($_POST['NotifyCustomer']) ? $_POST['NotifyCustomer'] : null);
			$Data['Memo'] = (isset($_POST['Memo']) && $_POST['Memo'] != "" ? urldecode($_POST['Memo']) : null);
			$output = $this->_Orders->changeOrderStatus($Data);
			
			$output['OrderStatusHistory_Block'] = $this->getOrderStatusHistory_HTML(array(
				'Orders_ID' => $_POST['oID']
			));
		}
		return $output;
	}
	
	function getOrderStatusHistory_HTML($Data)
	{
		$HTML = "";
		$O_Status_History = $this->_Orders->getOrderStatusHistoryByID($Data);
		
		
		# HTML Block : Order History
		if(sizeof($O_Status_History) > 0)
		{
			foreach($O_Status_History AS $K => $O_Status_History_F)
			{
				$HTML .= $this->Load->View('cart/corp/sales/orders/detail/home_detail_orderstatus.tpl', array(
					'isCurrent_Class' => ( sizeof($O_Status_History) - 1 == $K ? ' OSH_Current':'' ),
					'Status_Name' => $O_Status_History_F['OStatus_Name'],
					'Processed_On' => $O_Status_History_F['OSH_ProcessedOn']
				));
			}
		}
		else
			$HTML .= 'There is no status yet.';
		return $HTML;
	}

	function loadOrder($Data)
	{
		$output = array();
		$Data['Orders_ID'] = $Data['O']['Orders_ID'];
		
		if(isset($Data['O']))
		{
			
			$Order_StatusHistory_HTML = $this->getOrderStatusHistory_HTML($Data);
			
			# Load Payment and Shipping Information
			if(isset($Data['O']['Orders_Ext_Shipping']))
			{
				
				$P_Info = $this->_Extensions->load('Payment',$Data['O']['Orders_Ext_Payment']);
				$S_Info = $this->_Extensions->load('Shipping',$Data['O']['Orders_Ext_Shipping']);
				
				if(isset($P_Info['Class'][$Data['O']['Orders_Ext_Payment']]))
					$Ext['P'] = $P_Info['Class'][$Data['O']['Orders_Ext_Payment']];
				
				if(isset($S_Info['Class'][$Data['O']['Orders_Ext_Shipping']]))
					$Ext['S'] = $S_Info['Class'][$Data['O']['Orders_Ext_Shipping']];
			}
			
			$OrderedItems_HTML = $this->Load->View('cart/corp/sales/orders/detail/home_detail_option.tpl', array(
				'OrderItem' => $this->_Orders->getOrderItemsByID($Data)
			));
		}
		
		$O_Status = $this->_Model_Order->getOrderStatus();
		
		$Order_Status_HTML = '<select id="OrderStatusHistory_List_SLT">';
		foreach($O_Status as $O_Status_F)
		{
			$Order_Status_HTML .= '<option value="'.$O_Status_F['OStatus_ID'].'">'.$O_Status_F['OStatus_Name'].'</option>';
		}
		
		$Order_Status_HTML .= '</select>';
		
		return $this->Load->View('cart/corp/sales/orders/detail/home_detail.tpl', array(
			'Order_StatusHistory_HTML' => $Order_StatusHistory_HTML,
			'CheckoutType' => (!is_null($Data) ? ($Data['O']['customers_id'] == 0 ? "Guest Checkout":"Registered Customer's Order" ) : "Select Checkout Type"),
			'hasCustomerInfo' => (!is_null($Data) && $Data['O']['customers_id'] != 0 ? TRUE : FALSE),
			'customerInfo' => $Data['O'],
			'OrderedItems_HTML' => (isset($OrderedItems_HTML) ? $OrderedItems_HTML : "It's weird but there is No Item."),
			'Orders_Subtotal' => (!is_null($Data) ? "$".$Data['O']['Orders_Subtotal'] : ""),
			'Orders_ShippingCost' => (!is_null($Data) ? "$".$Data['O']['Orders_ShippingCost'] : ""),
			'Orders_Tax' => (!is_null($Data) ? $Data['O']['Orders_Tax']."%" : ""),
			'Orders_Grandtotal' => (!is_null($Data) ? "$".$Data['O']['Orders_Grandtotal'] : ""),
			'PaymentInfo' => (!is_null($Data) ? $Ext['P']->_admin_orderInfo($Data['O'])['html'] : ""),
			'ShipmentInfo' => (!is_null($Data) ? $Ext['S']->_admin_orderInfo($Data['O'])['html'] : ""),
			'Order_Status_HTML' => $Order_Status_HTML,
			'hasNotificationEmail' => (verifyEmailAddress($Data['O']['Orders_NotifyEmail']) ? TRUE : FALSE)
		));
		
		
	}
	
	
}

?>