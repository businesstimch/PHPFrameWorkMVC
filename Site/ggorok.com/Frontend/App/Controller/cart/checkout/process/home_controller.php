<?
class CartCheckoutProcessHome_Controller extends GGoRok
{
	var $Ext = array();
	
	function __construct()
	{
		$this->Ext['Payment'] = $this->_Extensions->load('Payment');
		$this->Ext['Shipping'] = $this->_Extensions->load('Shipping');
	}
	function home()
	{
		$CartInfo = $this->_Cart->getInfo();
		
		$Checkout_HTML = '';
		if(isset($CartInfo['Cart_Items']) && sizeof($CartInfo['Cart_Items']) > 0)
		{
			
			# Load 'Payment', 'Shipping' Extensions
			$Ext['Payment'] = $this->Ext['Payment'];
			$Ext['Shipping'] = $this->Ext['Shipping'];
			
			# Initiate block html
			$Ext['Payment']['selection_html'] = '';
			$Ext['Payment']['field_html'] = '';
			$Ext['Shipping']['selection_html'] = '';
			$Ext['Shipping']['field_html'] = '';
			
			# If there is any installed payment extension
			if(sizeof($Ext['Payment']['Class']) > 0)
			{
				$Count = 0;
				foreach($Ext['Payment']['Class'] AS $K => $Ext_F)
				{
					
					# Is it actually activated?
					if($Ext_F->_isActivated())
					{
						$Ext['Payment']['selection_html'] .= '<div data-code="'.$Ext_F->_Code.'" class="Pymt_Selection_P Pymt_Selection_One noSelect'.($Count == 0 ? ' Pymt_Selected':'').'"><i class="fa fa-dot-circle-o"></i> '.$Ext_F->_Name.'</div>';
						$Ext['Payment']['field_html'] .= $Ext_F->_script().'<div class="Pymt_Fields_One">'.$Ext_F->__checkout_html().'</div>';
						$Count++;
					}
				}
			}
			
			# If there is any installed shipping extension
			if(sizeof($Ext['Shipping']['Class']) > 0)
			{
				$Count = 0;
				foreach($Ext['Shipping']['Class'] AS $K => $Ext_F)
				{
					
					# Is it actually activated?
					if($Ext_F->_isActivated())
					{
						$Ext['Shipping']['selection_html'] .= '<div data-code="'.$Ext_F->_Code.'" class="Pymt_Selection_S Pymt_Selection_One noSelect'.($Count == 0 ? ' Pymt_Selected':'').'"><i class="fa fa-dot-circle-o"></i> '.$Ext_F->_Name.'</div>';
						$Ext['Shipping']['field_html'] .= $Ext_F->_script().'<div class="Pymt_Fields_One">'.$Ext_F->__checkout_html().'</div>';
						$Count++;
					}
				}
			}
			
			$Additional_Info_Html = '';
			if(!$this->login->isLogin())
			{
				if(isset($_POST['GuestCheckout']))
				{
					$Additional_Info_Html = $this->Load->View('cart/checkout/guestCheckout.tpl');
				}
				else if(isset($_POST['CheckoutRegister']))
				{
					$Additional_Info_Html = $this->Load->View('cart/checkout/checkoutRegister.tpl');
				}
			}
			
			$Checkout_HTML = $this->Load->View('cart/checkout/process_info.tpl',array(
				'Additional_Info_Html' => $Additional_Info_Html,
				'Payment_Selection' => $Ext['Payment']['selection_html'],
				'Payment_Field' => $Ext['Payment']['field_html'],
				'Shipping_Selection' => $Ext['Shipping']['selection_html'],
				'Shipping_Field' => $Ext['Shipping']['field_html'],
				'isLogin' => $this->login->isLogin(),
				'Cart_Summary' => $this->Get_Summary($CartInfo)['html']
				
			));
		
		}
		else
			$Checkout_HTML = 'Your cart is empty, Please add items.';
		
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));
			
		echo $this->Load->View('cart/checkout/process.tpl',array(
			'isLogin' => ($this->login->isLogIn() ? 'false':'true'),
			'Checkout_HTML' => $Checkout_HTML
		));
		
		
		
		echo $this->Load->View('cart/footer.tpl');
	}
	
	function Get_SPQuote()
	{
		$output['ack'] = "error";
		if(
		   isset($_POST['Code']) && $_POST['Code'] != ""
		)
		{
			if(isset($this->Ext['Shipping']['Class'][$_POST['Code']]))
			{
				$output = $this->Ext['Shipping']['Class'][$_POST['Code']]->__getShippingQuote();
			}
		}
		
		return $output;
	}
	
	function Get_Summary($CartInfo = null, $Data = null)
	{
		global $login,$_Setting,$_Cart;
		$output['ack'] = 'error';
		$output['html'] = '';
		
		if(is_null($CartInfo))
			$CartInfo = $this->_Cart->getInfo();
		if(!isset($Data['SHCost']))
			$Data['SHCost'] = 0;
			
		# Has Items in Shopping cart?
		if(isset($CartInfo['Cart_Items']) && sizeof($CartInfo['Cart_Items']) > 0)
		{
			
			
			
			$output['ack'] = 'success';
			# Load cart items for summary block
			foreach($CartInfo['Cart_Items'] AS $Item_Cart_F)
			{
				# Init option html variable.
				$Item_Cart_F['Opt_Html_Tmp'] = '';
				$Item_Cart_F['Opt_Price_Total'] = 0;
				
				#If has option
				if(sizeof($CartInfo['Cart_Opt']) > 0 && isset($CartInfo['Cart_Opt'][$Item_Cart_F['Cart_ID']]))
				{
					foreach($CartInfo['Cart_Opt'][$Item_Cart_F['Cart_ID']] AS $Opt_F)
					{
						$Item_Cart_F['Opt_Html_Tmp'] .= '<br /><span class="CI_Opt_Name">- '.$Opt_F['Opt_Name'].'</span>';
						
						if($Opt_F['Opt_Operand'] == "+")
							$Item_Cart_F['Opt_Price_Total'] = $Item_Cart_F['Opt_Price_Total'] + $Opt_F['Opt_Price'];
						else
							$Item_Cart_F['Opt_Price_Total'] = $Item_Cart_F['Opt_Price_Total'] - $Opt_F['Opt_Price'];
							
					}
				}
				$output['html'] .=
					'<div class="Pymt_ItemCart_One">
						<div class="PIO_Name">'.$Item_Cart_F['Prd_Name'].$Item_Cart_F['Opt_Html_Tmp'].'</div>
						<div class="PIO_PriceQty">'.$Item_Cart_F['Cart_Qty'].' x $'.number_format($Item_Cart_F['Prd_Price'] + $Item_Cart_F['Opt_Price_Total'],2).'</div>
					</div>';
					
				
			}
			$output['html'] = '
				<div id="Pymt_ItemCart_Block">'.$output['html'].'</div>';
			$output['html'] .= '
				<div id="Pymt_Summaries">
					<div class="PS_One">
						<div class="PSO_Name">Subtotal :</div>
						<div class="PSO_Amount">$'.$CartInfo['Cart_Sub_Total'].'</div>
					</div>
					
					
					<div class="PS_One">
						<div class="PSO_Name">Shipping Cost :</div>
						<div class="PSO_Amount">'.(!is_null($Data) && isset($Data['SHCost']) ? '$'.$Data['SHCost']:'Please select a shipping method').'</div>
					</div>
					
					'.(!is_null($Data) && isset($Data['isTaxable']) && $Data['isTaxable'] ? '<div class="PS_One"><div class="PSO_Name">Taxes ('.$this->_Setting->Data['General']['TaxState'].' : '.$this->_Setting->Data['General']['SalesTax'].'%) :</div><div class="PSO_Amount">$'.$CartInfo['Tax'].'</div></div>':'').'
					
					<div class="PS_One" id="PS_Total">
						<div class="PSO_Name">TOTAL :</div>
						<div class="PSO_Amount">$'.
							number_format(!is_null($Data) && isset($Data['isTaxable']) && $Data['isTaxable'] ?
								$CartInfo['Cart_Sub_Total_wTax'] + $Data['SHCost']:
								$CartInfo['Cart_Sub_Total'] + $Data['SHCost']
							,2).
						'</div>
					</div>
				</div>';
			
		}
		return $output;
	}
	
	function process()
	{
		global $login,$account,$_Cart,$_Orders,$mail,$_Mail,$_Setting,$_Orders;
		$output['ack'] = 'error';
		$General_Data = array();
		if(
		   (isset($_POST['Shipping_Code']) || (isset($_POST['Shipping_Code']) && isset($_POST['Payment_Code']))) # Shipping Process Or Shipping + Payment Process (Not only Payment process)
		)
		{
			
			# Check if the shipping module does exist in system.
			if(isset($_POST['Shipping_Code']) && isset($this->Ext['Shipping']['Class'][$_POST['Shipping_Code']]))
			{
				
				$Shipping_Data = $this->Ext['Shipping']['Class'][$_POST['Shipping_Code']]->_process();
				# Only get summary when custmer pick shipping method because when proces payment customer donen't need to see summary again.
				if(!isset($_POST['Payment_Code']) && $Shipping_Data['ack'] == 'success')
				{
					
					$Summary_HTML = $this->Get_Summary(null, $Shipping_Data);
					if(isset($Summary_HTML['html']))
					{
						$output['ack'] = 'success'; # This is for summary request.
						$output['Target_Summary_Block'] = $Summary_HTML['html'];
					}
				}
			}
			
			# Check if the payment module does exist in system.
			if(isset($_POST['Payment_Code']) && isset($this->Ext['Payment']['Class'][$_POST['Payment_Code']]))
			{
				if($Shipping_Data['ack'] == 'success')
					$Payment_Data = $this->Ext['Payment']['Class'][$_POST['Payment_Code']]->_process();
				else
				{
					$output['ack'] = 'error';
					$output['error_msg'] = 'There was some problem while we processing shipping. Please check and try again.';
				}
			}
			
			
			
			# Place an order below : Check Shipping & Payment
			if(
				(isset($Shipping_Data) && isset($Payment_Data)) &&
				($Shipping_Data['ack'] == 'success' && $Payment_Data['ack'] == 'success')
			)
			{
				
				if(
					(!$this->login->isLogin() && isset($_POST['GuestCheckout']) && $CheckOutMethod = 'GuestCheckout') ||
					(!$this->login->isLogin() && isset($_POST['CheckoutRegister']) && $CheckOutMethod = 'CheckoutRegister') ||
					($this->login->isLogin() && $CheckOutMethod = 'Member')
				)
				{
					# Null : Don't need to specify anycode here.
				}
				else
					$CheckOutMethod = 'GuestCheckout'; # Default
					
				
				
				# Checkout and Register
				if($CheckOutMethod == 'CheckoutRegister')
				{
					if(isset($_POST['ChkReg_Email_Inp']) && isset($_POST['ChkReg_FirstName_Inp']) && isset($_POST['ChkReg_LastName_Inp']) && isset($_POST['ChkReg_Password_Inp']))
					{
						$NotifyEmail = $_POST['ChkReg_Email_Inp'];
						$accInfo = array(
							'Reg_Email' => $_POST['ChkReg_Email_Inp'],
							'Reg_Pass' => $_POST['ChkReg_Password_Inp'],
							'Reg_FName' => $_POST['ChkReg_FirstName_Inp'],
							'Reg_LName' => $_POST['ChkReg_LastName_Inp']
						);
						$createdAcc_Info = $account->registerRequest($accInfo, TRUE);
						if($createdAcc_Info['ack'] == 'success')
						{
							$_customerID = $createdAcc_Info['_customerID'];
							
						}
						else
						{
							$output = $createdAcc_Info;
							return $output;
						}
					}
					else
					{
						$output['ack'] = 'error';
						$output['error_msg'] = 'Please fill out all fields in registration box.';
						return $output;
					}
					
					
					
				}
				else if($this->login->isLogin()) # Or Checkout by existing Customer
				{
					$NotifyEmail = ($this->login->_customerInfo[0]['customers_email'] != "" ? $this->login->_customerInfo[0]['customers_email'] : $this->login->_customerInfo[0]['customers_logon_id']);
					$_customerID = $this->login->_customerID;
				}
				else #Guest Checkout
				{
					
					if(isset($_POST['ChkGuest_Email_Inp']) && verifyEmailAddress($_POST['ChkGuest_Email_Inp']))
						$NotifyEmail = $_POST['ChkGuest_Email_Inp'];
					
					
					$_customerID = null;
				}
				
				
				if(isset($_POST['oComment']) && $_POST['oComment'] != "")
					$General_Data['oComment'] = urldecode($_POST['oComment']);
				
				if(isset($NotifyEmail) && $NotifyEmail != "")
					$General_Data['NotifyEmail'] = $NotifyEmail;
				
				
				# Place an order
				$Order_Data = $this->make_order($Shipping_Data, $Payment_Data, $General_Data, $_customerID);
				if($Order_Data['ack'] == 'success')
				{
					$MakeOrder_Shipping = $this->Ext['Shipping']['Class'][$_POST['Shipping_Code']]->__make_order($Order_Data['Order_ID'], $Shipping_Data);
					$MakeOrder_Payment = $this->Ext['Payment']['Class'][$_POST['Payment_Code']]->__make_order($Order_Data['Order_ID'], $Payment_Data);
					
					if($MakeOrder_Shipping['ack'] == 'success' && $MakeOrder_Payment['ack'] == 'success')
					{
						
						
						$OrderSummary_HTML = '';
						
						# Send Confirmation Email
						if(isset($NotifyEmail) && $NotifyEmail != "")
						{
							$CartInfo = $this->_Cart->getInfo();
							if(!isset($Data['SHCost']))
								$Data['SHCost'] = 0;
								
							# Has Items in Shopping cart?
							if(isset($CartInfo['Cart_Items']) && sizeof($CartInfo['Cart_Items']) > 0)
							{
								
								# Load cart items for summary block
								foreach($CartInfo['Cart_Items'] AS $Item_Cart_F)
								{
									# Init option html variable.
									$Item_Cart_F['Opt_Html_Tmp'] = '';
									$Item_Cart_F['Opt_Price_Total'] = 0;
									
									#If has option
									if(sizeof($CartInfo['Cart_Opt']) > 0 && isset($CartInfo['Cart_Opt'][$Item_Cart_F['Cart_ID']]))
									{
										foreach($CartInfo['Cart_Opt'][$Item_Cart_F['Cart_ID']] AS $Opt_F)
										{
											$Item_Cart_F['Opt_Html_Tmp'] .= '<br /><span class="CI_Opt_Name">- '.$Opt_F['Opt_Name'].'</span>';
											
											if($Opt_F['Opt_Operand'] == "+")
												$Item_Cart_F['Opt_Price_Total'] = $Item_Cart_F['Opt_Price_Total'] + $Opt_F['Opt_Price'];
											else
												$Item_Cart_F['Opt_Price_Total'] = $Item_Cart_F['Opt_Price_Total'] - $Opt_F['Opt_Price'];
												
										}
									}
									$OrderSummary_HTML .=
										'<div style="width:569px;border-bottom:1px dotted gray;background-color:white;padding:10px;box-sizing:border-box;float:left;">
											<div style="width:400px;float:left;">'.$Item_Cart_F['Prd_Name'].$Item_Cart_F['Opt_Html_Tmp'].'</div>
											<div style="width:149px;float:left;">'.$Item_Cart_F['Cart_Qty'].' x $'.number_format($Item_Cart_F['Prd_Price'] + $Item_Cart_F['Opt_Price_Total'],2).'</div>
										</div>';
										
									
								}
								
								$OrderSummary_HTML .= '
									<div style="width:100%;float:left;margin-top:10px;">
										<div style="width:470px;text-align:right;margin-bottom:10px;float:left;margin-right:10px;"><b>Subtotal</b> :</div>
										<div style="clear:right;float:left;width:100px;">$'.$CartInfo['Cart_Sub_Total'].'</div>
									</div>
									<div style="width:100%;float:left;">
										<div style="width:470px;text-align:right;margin-bottom:10px;float:left;margin-right:10px;"><b>Shipping Cost</b> :</div>
										<div style="clear:right;float:left;width:100px;">'.(!is_null($Shipping_Data['SHCost']) && isset($Shipping_Data['SHCost']) ? '$'.$Shipping_Data['SHCost']:'Please select a shipping method').'</div>
									</div>
									'.(isset($Shipping_Data['isTaxable']) && $Shipping_Data['isTaxable'] ? '<div style="width:100%;float:left;"><div style="width:470px;text-align:right;margin-bottom:10px;float:left;margin-right:10px;"><b>Taxes ('.$this->_Setting->Data['General']['TaxState'].' : '.$this->_Setting->Data['General']['SalesTax'].'%)</b> :</div><div style="clear:right;float:left;width:100px;">$'.$CartInfo['Tax'].'</div></div>':'').'
									<div style="width:100%;float:left;">
										<div style="width:470px;text-align:right;margin-bottom:10px;float:left;margin-right:10px;"><b>TOTAL</b> :</div><div style="clear:right;float:left;width:100px;font-size:15px;color:#18a0ff;"><b>$'.
												number_format(isset($Shipping_Data['SHCost']) && isset($Shipping_Data['isTaxable']) && $Shipping_Data['isTaxable'] ?
													$CartInfo['Cart_Sub_Total_wTax'] + $Shipping_Data['SHCost']:
													$CartInfo['Cart_Sub_Total'] + $Shipping_Data['SHCost']
												,2).
									'	</b></div>
									</div>';
								
							}
							
							
							$MailVariable_HTML = array(
								$Order_Data['Order_ID'],
								($CheckOutMethod == 'GuestCheckout' ? '' :'').
								($CheckOutMethod == 'CheckoutRegister' ? '' :'').
								($CheckOutMethod == 'Member' ? '' :''),
								$OrderSummary_HTML
							);
							
							$MailVariable_PLAIN = array(
								$Order_Data['Order_ID'],
								($CheckOutMethod == 'GuestCheckout' ? '' :'').
								($CheckOutMethod == 'CheckoutRegister' ? '' :'').
								($CheckOutMethod == 'Member' ? '' :''),
								$OrderSummary_HTML
							);
							
							# Send Email to customer
							$MailSetting = $_Mail->Setting();
							$MailSetting['Subject'] = '[Janilink] Your Order #'.$Order_Data['Order_ID'].' Confirmation';
							$MailSetting['Body_HTML'] = $_Mail->getTemplate('Template_OrderCompleted_HTML',$MailVariable_HTML);
							$MailSetting['Body_Plain'] = $_Mail->getTemplate('Template_OrderCompleted_PLAIN',$MailVariable_PLAIN);
							$MailSetting['To'] = $NotifyEmail;
							$mail->sendGMail($MailSetting);
							
						}
						
						#Empty Cart
						$this->_Cart->emptyCart();
						$CHO_Data['oID'] = $Order_Data['Order_ID'];
						$CHO_Data['osID'] = 1;
						$CHO_Data['NotifyCustomer'] = 0; 
						$_Orders->changeOrderStatus($CHO_Data); // Status : Pending, No notification
						$output['oID'] = $Order_Data['Order_ID'];
						$output['TK'] = md5($Order_Data['Order_ID'].$_Orders->Order_Encrypt_Key);
						
						$output['ack'] = 'success';
					}
				}
				else
					$output = $Order_Data; # Print Error from '$this->make_order' function.
			}
			else if(isset($Shipping_Data) && isset($Payment_Data)) # Only when placing order : Error Print
			{
				$output['error_msg'] = (isset($Shipping_Data) && $Shipping_Data['ack'] == 'error' && isset($Shipping_Data['error_msg']) ? '<b>Shipping</b> : '.$Shipping_Data['error_msg'].'<br />' : '').(isset($Payment_Data) && $Payment_Data['ack'] == 'error' && isset($Payment_Data['error_msg']) ? '<b>Payment</b> : '.$Payment_Data['error_msg'].'<br />' : '');
			}
		}
		return $output;
	}
	
	function make_order($Shipping_Data, $Payment_Data, $General_Data, $_customerID = NULL)
	{
		$Cart = $this->_Cart->getInfo();
		$output['ack'] = 'error';
		$output['error_msg'] = '';
		$Go = True;
		
		
		if($Cart['Cart_Qty'] <= 0 || !is_numeric($Cart['Cart_Qty']))
		{
			$Go = False;
			$output['error_msg'] .= '- Your Cart is Empty.<br />';
		}
		
		
			
		
		#Check Stock
		
		foreach($Cart['Cart_Items'] AS $Cart_Prd_F)
		{
			if(!isset($Prd_inCart[$Cart_Prd_F['Prd_ID']]))
				$Prd_inCart[$Cart_Prd_F['Prd_ID']] = 0;
			
			$Prd_inCart[$Cart_Prd_F['Prd_ID']] = $Cart_Prd_F['Cart_Qty'] + $Prd_inCart[$Cart_Prd_F['Prd_ID']];
		}
		
		$CheckStock_WhereSQL = '';
		foreach($Prd_inCart AS $PrdID_InCart => $Prd_inCart_F)
		{
			$CheckStock_WhereSQL_Arr[] = "(Prd_ID = '".$this->db->escape($PrdID_InCart)."' AND (Prd_Qty = -1 OR Prd_Qty >= ".$this->db->escape($Prd_inCart_F)."))";
		}
		
		$CheckStock_WhereSQL = (sizeof($CheckStock_WhereSQL_Arr) > 0 ? "AND (".implode( " OR ",$CheckStock_WhereSQL_Arr).")":"");
		$CheckStock = $this->db->QRY("
			SELECT
				Prd_ID,
				Prd_Qty
			FROM
				gc_products
			WHERE
				Store_ID = '".__StoreID__."'
				".$CheckStock_WhereSQL."
		");
		
		if(sizeof($CheckStock) != sizeof($Prd_inCart))
		{
			$Go = False;
			$output['error_msg'] .= '- One or more products are not in our stock please check quantity or contact us.<br />';
		}
				
				
				
		if($Go)
		{
		
			
			if($Shipping_Data['isTaxable'])
			{
				$GrandTotal = $Cart['Cart_Sub_Total_wTax'] + $Shipping_Data['SHCost'];
			}
			else
			{
				$GrandTotal = $Cart['Cart_Sub_Total'] + $Shipping_Data['SHCost'];
			}
			
			
			$output['ack'] = 'success';
			
			# Insert Order
			$output['Order_ID'] = $this->db->QRY("
				INSERT INTO
					gc_orders
					(
						Orders_Subtotal,
						Orders_ShippingCost,
						Orders_Grandtotal,
						Orders_isTaxable,
						Orders_Tax,
						Orders_Ext_Shipping,
						Orders_Ext_Payment,
						OStatus_ID,
						Store_ID,
						customers_id
						".(isset($General_Data['oComment']) ? ',Orders_Comment' : '')."
						".(isset($General_Data['NotifyEmail']) ? ',Orders_NotifyEmail' : '')."
						
					)
					VALUES
					(
						'".$Cart['Cart_Sub_Total']."',
						'".$Shipping_Data['SHCost']."',
						'".$GrandTotal."',
						'".($Shipping_Data['isTaxable'] ? 1 : 0 )."',
						'".($Shipping_Data['isTaxable'] ? $this->_Setting->Data['General']['SalesTax'] : 0.00 )."',
						'".$this->db->escape($_POST['Shipping_Code'])."',
						'".$this->db->escape($_POST['Payment_Code'])."',
						1,
						'".__StoreID__."'
						".($this->login->isLogin() ? ",'".$this->login->_customerID."'" : ",'".$_customerID."'")."
						".(isset($General_Data['oComment']) ? ",'".$this->db->escape(urldecode($General_Data['oComment']))."'" : '')."
						".(isset($General_Data['NotifyEmail']) ? ",'".$this->db->escape(urldecode($General_Data['NotifyEmail']))."'" : '')."
					)
			",TRUE);
			
			if(is_numeric($output['Order_ID']))
			{
				foreach($Cart['Cart_Items'] AS $Cart_Prd_F)
				{
						
					$OI_ID = $this->db->QRY("
						INSERT INTO
							gc_orders_Items
							(
								Orders_ID,
								Prd_ID,
								OI_Name,
								OI_Qty,
								OI_Price,
								OI_Taxable,
								OI_Sku,
								OI_RewardPoint
							)
							VALUES
							(
								'".$output['Order_ID']."',
								'".$this->db->escape($Cart_Prd_F['Prd_ID'])."',
								'".$this->db->escape($Cart_Prd_F['Prd_Name'])."',
								'".$this->db->escape($Cart_Prd_F['Cart_Qty'])."',
								'".$this->db->escape($Cart_Prd_F['Prd_Price'])."',
								'".$this->db->escape($Cart_Prd_F['Prd_isTaxble'])."',
								'".$this->db->escape($Cart_Prd_F['Prd_SKU'])."',
								'".$this->db->escape($Cart_Prd_F['Prd_RewardPoint'])."'
							)
					",TRUE);
					
					# Stock Management
					$this->db->QRY("
						UPDATE
							gc_products
						SET
							Prd_Qty =
								CASE
									WHEN
										Prd_Qty != -1 AND Prd_Qty != 0
									THEN
										(Prd_Qty - ".$this->db->escape($Cart_Prd_F['Cart_Qty']).")
								END
						WHERE
							Prd_ID = '".$this->db->escape($Cart_Prd_F['Prd_ID'])."'
					");
					
					
					$OI_Opt = json_decode($Cart_Prd_F['Cart_Options'],TRUE);
					if(sizeof($OI_Opt) > 0)
					{
						
						foreach($OI_Opt AS $OI_Opt_F)
						{
							$Opt_Data = $this->db->QRY("
								SELECT
									*
								FROM
									gc_products_option_group OG,
									gc_products_option_group_item OGI
								WHERE
									OG.OptGrp_ID = OGI.OptGrp_ID AND
									OGI.Opt_ID = '".$OI_Opt_F."'
							");
							if(sizeof($Opt_Data) > 0)
							{
							
								$this->db->QRY("
									INSERT INTO
										gc_orders_Items_option
										(
											OI_ID,
											OIO_OptGrp_Name,
											OIO_Opt_ID,
											OIO_Opt_Name,
											OIO_Opt_Price,
											OIO_Opt_Operand,
											OIO_Opt_Sku
										)
										VALUES
										(
											'".$OI_ID."',
											'".$this->db->escape($Opt_Data[0]['OptGrp_Name'])."',
											'".$this->db->escape($OI_Opt_F)."',
											'".$this->db->escape($Opt_Data[0]['Opt_Name'])."',
											'".$this->db->escape($Opt_Data[0]['Opt_Price'])."',
											'".$this->db->escape($Opt_Data[0]['Opt_Operand'])."',
											'".$this->db->escape($Opt_Data[0]['Opt_SKU'])."'
										)
								");
							}
						}
					}
				
				}
			}
		}
		
		
		return $output;
		
	}
}